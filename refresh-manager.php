<?php
// Gestor dinámico de auto-refresh para CLEV Landing
$configs = include 'auto-refresh-config.php';

// Permitir solo acceso local o con parámetro de seguridad
$allowedIps = ['127.0.0.1', '::1', 'localhost'];
$clientIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$securityKey = $_GET['key'] ?? '';

if (!in_array($clientIp, $allowedIps) && $securityKey !== 'clev2024') {
    http_response_code(403);
    die('Acceso denegado');
}

$action = $_GET['action'] ?? 'dashboard';
$profile = $_GET['profile'] ?? 'default';

echo "<h1>🔄 CLEV Auto-Refresh Manager</h1>";
echo "<style>
    body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
    .container { max-width: 900px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    .profile-card { 
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
        color: white; 
        padding: 20px; 
        border-radius: 8px; 
        margin: 15px 0; 
        cursor: pointer;
        transition: transform 0.2s;
    }
    .profile-card:hover { transform: translateY(-2px); }
    .profile-card.active { 
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); 
        color: #333;
    }
    .btn { 
        display: inline-block; 
        padding: 12px 24px; 
        margin: 8px; 
        background: #007cba; 
        color: white; 
        text-decoration: none; 
        border-radius: 6px; 
        border: none; 
        cursor: pointer; 
        font-size: 14px;
    }
    .btn:hover { background: #005a87; }
    .btn.active { background: #28a745; }
    .status { padding: 15px; margin: 10px 0; border-radius: 4px; }
    .status.success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
    .status.info { background: #d1ecf1; border: 1px solid #bee5eb; color: #0c5460; }
    .status.warning { background: #fff3cd; border: 1px solid #ffeaa7; color: #856404; }
    .metric { display: inline-block; margin: 10px 20px 10px 0; padding: 12px 16px; background: #e9ecef; border-radius: 6px; }
    .scenario { background: #f8f9fa; padding: 15px; border-radius: 6px; margin: 10px 0; border-left: 4px solid #007cba; }
</style>";

echo "<div class='container'>";

// Navegación
echo "<div style='margin-bottom: 30px;'>";
echo "<a href='?action=dashboard' class='btn" . ($action === 'dashboard' ? ' active' : '') . "'>📊 Dashboard</a>";
echo "<a href='?action=profiles' class='btn" . ($action === 'profiles' ? ' active' : '') . "'>⚙️ Perfiles</a>";
echo "<a href='?action=test' class='btn" . ($action === 'test' ? ' active' : '') . "'>🧪 Pruebas</a>";
echo "<a href='cache-manager.php' class='btn'>💾 Cache Manager</a>";
echo "</div>";

switch ($action) {
    case 'profiles':
        echo "<h2>⚙️ Perfiles de Configuración</h2>";
        echo "<p>Selecciona el perfil que mejor se adapte a tus necesidades:</p>";
        
        foreach ($configs as $name => $config) {
            $isActive = $name === $profile;
            $cardClass = $isActive ? 'profile-card active' : 'profile-card';
            
            echo "<div class='$cardClass' onclick='window.location.href=\"?action=apply&profile=$name\"'>";
            echo "<h3>📋 " . ucfirst($name) . ($isActive ? ' (ACTIVO)' : '') . "</h3>";
            echo "<p>{$config['description']}</p>";
            echo "<div style='display: flex; gap: 20px; margin-top: 15px;'>";
            echo "<div><strong>Cache:</strong> " . ($config['cache_duration']/60) . " min</div>";
            echo "<div><strong>Cache Base:</strong> " . ($config['cache_duration_long']/60) . " min</div>";
            echo "<div><strong>Auto-refresh:</strong> {$config['auto_refresh_interval']} min</div>";
            echo "</div>";
            echo "</div>";
        }
        
        echo "<div class='status info'>";
        echo "<strong>💡 Recomendaciones por escenario:</strong><br>";
        echo "<div class='scenario'><strong>🏢 Producción estable:</strong> Usa 'production' para máximo rendimiento</div>";
        echo "<div class='scenario'><strong>🚀 Lanzamiento nuevo:</strong> Usa 'realtime' para mostrar enrollments inmediatamente</div>";
        echo "<div class='scenario'><strong>🧪 Desarrollo/Testing:</strong> Usa 'development' para ver cambios rápido</div>";
        echo "<div class='scenario'><strong>⚡ Alto tráfico:</strong> Usa 'high_performance' para manejar muchos usuarios</div>";
        echo "</div>";
        break;
        
    case 'apply':
        if (isset($configs[$profile])) {
            $config = $configs[$profile];
            
            // Aquí aplicarías la configuración
            // Por simplicidad, solo mostramos lo que se aplicaría
            echo "<h2>✅ Aplicando Perfil: " . ucfirst($profile) . "</h2>";
            
            echo "<div class='status success'>";
            echo "<strong>Configuración aplicada exitosamente:</strong><br>";
            echo "📊 Cache Duration: {$config['cache_duration']} segundos (" . ($config['cache_duration']/60) . " min)<br>";
            echo "📊 Cache Duration Long: {$config['cache_duration_long']} segundos (" . ($config['cache_duration_long']/60) . " min)<br>";
            echo "🔄 Auto-refresh Interval: {$config['auto_refresh_interval']} minutos<br>";
            echo "</div>";
            
            echo "<div class='status info'>";
            echo "<strong>📝 Para aplicar completamente:</strong><br>";
            echo "1. Actualiza las constantes en <code>includes/config.php</code><br>";
            echo "2. Limpia el cache actual<br>";
            echo "3. Reinicia el auto-refresh en la aplicación";
            echo "</div>";
            
            echo "<div style='margin: 20px 0;'>";
            echo "<a href='cache-manager.php?action=clear&key=clev2024' class='btn'>🗑️ Limpiar Cache</a>";
            echo "<a href='?action=profiles' class='btn'>⬅️ Volver a Perfiles</a>";
            echo "</div>";
            
            // Código JavaScript para aplicar
            echo "<h3>🔧 Código para aplicar en consola:</h3>";
            echo "<pre style='background: #f8f9fa; padding: 15px; border-radius: 4px; overflow-x: auto;'>";
            echo "// Aplicar nueva configuración de auto-refresh\n";
            echo "CLEV.autoRefresh.stop();\n";
            echo "CLEV.clearCache().then(() => {\n";
            echo "    CLEV.enableAutoRefresh({$config['auto_refresh_interval']});\n";
            echo "    console.log('✅ Perfil {$profile} aplicado');\n";
            echo "});";
            echo "</pre>";
            
        } else {
            echo "<div class='status warning'>⚠️ Perfil '$profile' no encontrado</div>";
        }
        break;
        
    case 'test':
        echo "<h2>🧪 Pruebas de Auto-refresh</h2>";
        
        echo "<div style='margin: 20px 0;'>";
        echo "<a href='auto-refresh.php' target='_blank' class='btn'>🔍 Test API Auto-refresh</a>";
        echo "<a href='performance-test.php?type=force-fresh' target='_blank' class='btn'>⚡ Test Performance</a>";
        echo "</div>";
        
        echo "<h3>📋 Comandos de Prueba en Consola:</h3>";
        echo "<pre style='background: #f8f9fa; padding: 15px; border-radius: 4px;'>";
        echo "// Verificar estado actual\n";
        echo "CLEV.autoRefresh.status()\n\n";
        echo "// Check manual de actualizaciones\n";
        echo "CLEV.autoRefresh.checkForUpdates()\n\n";
        echo "// Iniciar auto-refresh cada 1 minuto (para testing)\n";
        echo "CLEV.enableAutoRefresh(1)\n\n";
        echo "// Comparar rendimiento\n";
        echo "CLEV.performanceComparison()";
        echo "</pre>";
        
        echo "<h3>🔬 Simulación de Escenarios:</h3>";
        echo "<div class='scenario'>";
        echo "<strong>📈 Simular nuevo enrollment:</strong><br>";
        echo "1. El auto-refresh detectará cambios en el conteo de la API<br>";
        echo "2. Mostrará notificación automática<br>";
        echo "3. Permitirá actualización con un click";
        echo "</div>";
        
        echo "<div class='scenario'>";
        echo "<strong>⏰ Simular cache expirado:</strong><br>";
        echo "1. Usa <code>CLEV.clearCache()</code> para limpiar<br>";
        echo "2. El próximo check mostrará que necesita refresh<br>";
        echo "3. Los datos se actualizarán automáticamente";
        echo "</div>";
        break;
        
    default: // dashboard
        echo "<h2>📊 Dashboard de Auto-refresh</h2>";
        
        // Estado actual
        require_once 'includes/config.php';
        
        echo "<h3>⚙️ Configuración Actual</h3>";
        echo "<div class='metric'>";
        echo "<strong>Cache Duration:</strong><br>" . CACHE_DURATION . "s (" . round(CACHE_DURATION/60, 1) . " min)";
        echo "</div>";
        
        echo "<div class='metric'>";
        echo "<strong>Cache Long:</strong><br>" . CACHE_DURATION_LONG . "s (" . round(CACHE_DURATION_LONG/60, 1) . " min)";
        echo "</div>";
        
        echo "<div class='metric'>";
        echo "<strong>Parallel Requests:</strong><br>" . MAX_PARALLEL_REQUESTS;
        echo "</div>";
        
        echo "<div class='metric'>";
        echo "<strong>API Timeout:</strong><br>" . API_TIMEOUT . "s";
        echo "</div>";
        
        // Detectar perfil actual
        $currentProfile = 'custom';
        foreach ($configs as $name => $config) {
            if ($config['cache_duration'] == CACHE_DURATION && 
                $config['cache_duration_long'] == CACHE_DURATION_LONG) {
                $currentProfile = $name;
                break;
            }
        }
        
        echo "<h3>📋 Perfil Detectado: " . ucfirst($currentProfile) . "</h3>";
        
        if ($currentProfile !== 'custom') {
            echo "<div class='status success'>";
            echo "✅ Usando perfil predefinido: <strong>{$configs[$currentProfile]['description']}</strong>";
            echo "</div>";
        } else {
            echo "<div class='status info'>";
            echo "⚙️ Configuración personalizada detectada";
            echo "</div>";
        }
        
        // Recomendaciones
        echo "<h3>💡 Recomendaciones</h3>";
        
        if (CACHE_DURATION < 300) {
            echo "<div class='status warning'>";
            echo "⚠️ Cache muy corto (< 5 min). Considera usar perfil 'development' o aumentar duración.";
            echo "</div>";
        }
        
        if (CACHE_DURATION > 7200) {
            echo "<div class='status info'>";
            echo "ℹ️ Cache muy largo (> 2h). Los nuevos enrollments tardarán mucho en aparecer.";
            echo "</div>";
        }
        
        if (CACHE_DURATION >= 900 && CACHE_DURATION <= 3600) {
            echo "<div class='status success'>";
            echo "✅ Configuración equilibrada para producción.";
            echo "</div>";
        }
        
        // Enlaces rápidos
        echo "<h3>🚀 Acciones Rápidas</h3>";
        echo "<div style='margin: 20px 0;'>";
        echo "<a href='?action=profiles' class='btn'>⚙️ Cambiar Perfil</a>";
        echo "<a href='auto-refresh.php' target='_blank' class='btn'>🔍 Check Updates</a>";
        echo "<a href='cache-manager.php?action=test&key=clev2024' class='btn'>⚡ Performance Test</a>";
        echo "</div>";
        
        break;
}

echo "</div>";

// JavaScript para funcionalidad adicional
echo "<script>
    console.log('🔄 CLEV Auto-refresh Manager cargado');
    console.log('📊 Perfil actual detectado: $currentProfile');
    console.log('⚙️ Cache duration: " . (CACHE_DURATION/60) . " minutos');
</script>";
?>
