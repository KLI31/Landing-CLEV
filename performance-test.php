<?php
// Test de rendimiento CLEV Landing - Antes vs Después
require_once 'includes/config.php';
require_once 'includes/functions.php';

header('Content-Type: application/json');

$startTime = microtime(true);
$results = [
    'timestamp' => date('Y-m-d H:i:s'),
    'test_type' => $_GET['type'] ?? 'standard',
    'cache_status' => 'unknown',
    'load_time_ms' => 0,
    'formations_count' => 0,
    'success' => false,
    'errors' => [],
    'optimizations' => [
        'parallel_requests' => 'enabled',
        'smart_cache' => 'enabled',
        'timeout_optimized' => API_TIMEOUT . 's',
        'cache_duration' => CACHE_DURATION . 's',
        'max_parallel' => MAX_PARALLEL_REQUESTS
    ]
];

try {
    // Determinar si viene de cache
    $finalCacheFile = getCacheFilePath('final');
    $results['cache_status'] = (file_exists($finalCacheFile) && (time() - filemtime($finalCacheFile)) < CACHE_DURATION) ? 'hit' : 'miss';
    
    // Ejecutar test según tipo
    switch ($results['test_type']) {
        case 'force-fresh':
            // Limpiar cache para forzar carga fresca
            clearAllCache();
            $results['cache_status'] = 'forced_miss';
            break;
            
        case 'cache-only':
            // Solo devolver si hay cache válido
            if ($results['cache_status'] === 'miss') {
                throw new Exception('No hay cache válido disponible');
            }
            break;
    }
    
    // Obtener formaciones
    $formations = fetchAllEnrollments();
    
    $results['load_time_ms'] = round((microtime(true) - $startTime) * 1000, 2);
    $results['formations_count'] = count($formations);
    $results['success'] = true;
    
    // Información adicional del cache
    $cacheStatus = getCacheStatus();
    $results['cache_info'] = [
        'base_exists' => $cacheStatus['base'] === 'exists',
        'final_exists' => $cacheStatus['final'] === 'exists',
        'base_age_minutes' => round($cacheStatus['base_age'] / 60, 2),
        'final_age_minutes' => round($cacheStatus['final_age'] / 60, 2),
        'total_cache_size_kb' => round($cacheStatus['total_size'] / 1024, 2)
    ];
    
    // Análisis de rendimiento
    if ($results['load_time_ms'] < 100) {
        $results['performance_rating'] = 'excellent';
        $results['performance_message'] = '🚀 Excelente - Ultra rápido';
    } elseif ($results['load_time_ms'] < 500) {
        $results['performance_rating'] = 'good';
        $results['performance_message'] = '✅ Bueno - Rápido';
    } elseif ($results['load_time_ms'] < 2000) {
        $results['performance_rating'] = 'average';
        $results['performance_message'] = '⚠️ Promedio - Aceptable';
    } else {
        $results['performance_rating'] = 'slow';
        $results['performance_message'] = '🐌 Lento - Necesita optimización';
    }
    
} catch (Exception $e) {
    $results['success'] = false;
    $results['errors'][] = $e->getMessage();
    $results['load_time_ms'] = round((microtime(true) - $startTime) * 1000, 2);
}

echo json_encode($results, JSON_PRETTY_PRINT);
?>
