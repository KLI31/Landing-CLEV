<?php
// Sistema de auto-refresh inteligente para detectar nuevos enrollments
require_once 'includes/config.php';
require_once 'includes/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    // Obtener información del cache actual
    $cacheStatus = getCacheStatus();
    $finalCacheFile = getCacheFilePath('final');
    
    // Si no hay cache, devolver que necesita actualización
    if ($cacheStatus['final'] !== 'exists') {
        echo json_encode([
            'needs_refresh' => true,
            'reason' => 'no_cache',
            'cache_age_minutes' => 0,
            'current_count' => 0,
            'api_count' => 0
        ]);
        exit;
    }
    
    // Obtener conteo actual desde cache
    $cachedData = file_get_contents($finalCacheFile);
    $cachedEnrollments = json_decode($cachedData, true) ?: [];
    $currentCount = count($cachedEnrollments);
    
    // Obtener conteo desde API (solo la lista base, rápido)
    $baseEnrollments = fetchBaseEnrollments();
    $apiCount = count($baseEnrollments);
    
    // Determinar si necesita refresh
    $needsRefresh = false;
    $reason = 'up_to_date';
    
    // Verificar si hay enrollments nuevos
    if ($apiCount > $currentCount) {
        $needsRefresh = true;
        $reason = 'new_enrollments_detected';
    }
    
    // Verificar si el cache es muy viejo (basado en configuración)
    $cacheAgeMinutes = $cacheStatus['final_age'] / 60;
    $maxAgeMinutes = CACHE_DURATION / 60;
    
    if ($cacheAgeMinutes > $maxAgeMinutes) {
        $needsRefresh = true;
        $reason = $reason === 'new_enrollments_detected' ? 'new_enrollments_and_expired' : 'cache_expired';
    }
    
    // Respuesta
    echo json_encode([
        'needs_refresh' => $needsRefresh,
        'reason' => $reason,
        'cache_age_minutes' => round($cacheAgeMinutes, 1),
        'max_age_minutes' => round($maxAgeMinutes, 1),
        'current_count' => $currentCount,
        'api_count' => $apiCount,
        'new_enrollments_count' => max(0, $apiCount - $currentCount),
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'needs_refresh' => false,
        'reason' => 'error',
        'error' => $e->getMessage(),
        'cache_age_minutes' => 0,
        'current_count' => 0,
        'api_count' => 0
    ]);
}
?>
