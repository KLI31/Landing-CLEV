<?php
// Gestor de cache optimizado para CLEV Landing
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Permitir solo acceso local o con parámetro de seguridad
$allowedIps = ['127.0.0.1', '::1', 'localhost'];
$clientIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$securityKey = $_GET['key'] ?? '';

if (!in_array($clientIp, $allowedIps) && $securityKey !== 'clev2024') {
    http_response_code(403);
    die('Acceso denegado');
}

$action = $_GET['action'] ?? 'status';

echo "<h1>🚀 CLEV Cache Manager - Optimizado</h1>";
echo "<style>
    body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
    .container { max-width: 800px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    .action-buttons { margin: 20px 0; }
    .btn { display: inline-block; padding: 10px 20px; margin: 5px; background: #007cba; color: white; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
    .btn:hover { background: #005a87; }
    .btn.danger { background: #dc3545; }
    .btn.danger:hover { background: #c82333; }
    .status { padding: 15px; margin: 10px 0; border-radius: 4px; }
    .status.success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
    .status.warning { background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; }
    .status.error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
    pre { background: #f8f9fa; padding: 15px; border-radius: 4px; overflow-x: auto; font-size: 14px; }
    .metric { display: inline-block; margin: 10px 20px 10px 0; padding: 10px; background: #e9ecef; border-radius: 4px; }
    .performance-box { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 8px; margin: 20px 0; }
</style>";

echo "<div class='container'>";

// Botones de acción
echo "<div class='action-buttons'>";
echo "<a href='?action=status' class='btn'>📊 Estado</a>";
echo "<a href='?action=clear' class='btn danger'>🗑️ Limpiar Cache</a>";
echo "<a href='?action=test' class='btn'>⚡ Test Performance</a>";
echo "<a href='?action=force-reload' class='btn'>🔄 Forzar Recarga</a>";
echo "</div>";

switch ($action) {
    case 'clear':
        echo "<h2>🗑️ Limpiando Cache...</h2>";
        $cleared = clearAllCache();
        echo "<div class='status success'>✅ Cache limpiado exitosamente. $cleared archivos eliminados.</div>";
        break;
        
    case 'force-reload':
        echo "<h2>🔄 Forzando Recarga Completa...</h2>";
        $startTime = microtime(true);
        
        // Limpiar cache primero
        clearAllCache();
        
        // Forzar recarga
        $formations = fetchAllEnrollments();
        
        $loadTime = round((microtime(true) - $startTime) * 1000, 2);
        $count = count($formations);
        
        echo "<div class='status success'>✅ Recarga completada: $count formaciones en {$loadTime}ms</div>";
        break;
        
    case 'test':
        echo "<h2>⚡ Test de Performance</h2>";
        
        echo "<div class='performance-box'>";
        echo "<h3>🏃‍♂️ Ejecutando tests de velocidad...</h3>";
        
        // Test 1: Cache hit
        echo "<p><strong>Test 1: Carga desde cache</strong></p>";
        $start = microtime(true);
        $formations1 = fetchAllEnrollments();
        $time1 = round((microtime(true) - $start) * 1000, 2);
        echo "<p>✅ {$time1}ms - " . count($formations1) . " formaciones</p>";
        
        // Test 2: Cache miss
        echo "<p><strong>Test 2: Carga sin cache (forzada)</strong></p>";
        clearAllCache();
        $start = microtime(true);
        $formations2 = fetchAllEnrollments();
        $time2 = round((microtime(true) - $start) * 1000, 2);
        echo "<p>✅ {$time2}ms - " . count($formations2) . " formaciones</p>";
        
        // Test 3: Cache hit después de regeneración
        echo "<p><strong>Test 3: Segunda carga (debería usar cache)</strong></p>";
        $start = microtime(true);
        $formations3 = fetchAllEnrollments();
        $time3 = round((microtime(true) - $start) * 1000, 2);
        echo "<p>✅ {$time3}ms - " . count($formations3) . " formaciones</p>";
        
        $improvement = $time2 > 0 ? round(($time2 - $time3) / $time2 * 100, 1) : 0;
        echo "<p><strong>🚀 Mejora de velocidad con cache: {$improvement}%</strong></p>";
        echo "</div>";
        break;
        
    default: // status
        echo "<h2>📊 Estado del Cache</h2>";
        
        $status = getCacheStatus();
        
        echo "<div class='metric'>";
        echo "<strong>Cache Base:</strong> " . ($status['base'] === 'exists' ? '✅ Existe' : '❌ No existe');
        if ($status['base'] === 'exists') {
            $ageMinutes = round($status['base_age'] / 60, 1);
            echo "<br>Edad: {$ageMinutes} minutos";
        }
        echo "</div>";
        
        echo "<div class='metric'>";
        echo "<strong>Cache Final:</strong> " . ($status['final'] === 'exists' ? '✅ Existe' : '❌ No existe');
        if ($status['final'] === 'exists') {
            $ageMinutes = round($status['final_age'] / 60, 1);
            echo "<br>Edad: {$ageMinutes} minutos";
        }
        echo "</div>";
        
        echo "<div class='metric'>";
        echo "<strong>Tamaño Total:</strong> " . round($status['total_size'] / 1024, 1) . " KB";
        echo "</div>";
        
        // Configuración actual
        echo "<h3>⚙️ Configuración Optimizada</h3>";
        echo "<pre>";
        echo "Cache Duration: " . CACHE_DURATION . " segundos (" . round(CACHE_DURATION/60, 1) . " min)\n";
        echo "Cache Duration Long: " . CACHE_DURATION_LONG . " segundos (" . round(CACHE_DURATION_LONG/60, 1) . " min)\n";
        echo "Max Parallel Requests: " . MAX_PARALLEL_REQUESTS . "\n";
        echo "API Timeout: " . API_TIMEOUT . " segundos\n";
        echo "API Enrollments: " . API_ALL_ENROLLMENTS . "\n";
        echo "API Details: " . API_ENROLLMENT_DETAILS . "\n";
        echo "</pre>";
        
        // Información de archivos de cache
        echo "<h3>📁 Archivos de Cache</h3>";
        $cacheFiles = [
            'Base' => getCacheFilePath('base'),
            'Final' => getCacheFilePath('final'),
            'Legacy' => 'cache/enrollments.json'
        ];
        
        foreach ($cacheFiles as $name => $file) {
            echo "<div class='metric'>";
            echo "<strong>$name:</strong> ";
            if (file_exists($file)) {
                $size = round(filesize($file) / 1024, 1);
                $age = round((time() - filemtime($file)) / 60, 1);
                echo "✅ {$size}KB, {$age}min";
            } else {
                echo "❌ No existe";
            }
            echo "</div>";
        }
        break;
}

echo "</div>";

// JavaScript para auto-refresh en test de performance
if ($action === 'test') {
    echo "<script>
        console.log('🚀 CLEV Cache Manager - Performance Test completado');
        console.log('Cache sistema optimizado funcionando correctamente');
    </script>";
}
?>
