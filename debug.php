<?php
// Debug de APIs CLEV
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/config.php';
require_once 'includes/functions.php';

echo "<h1>Debug CLEV APIs</h1>";

// Test variables básicas
echo "<h2>1. Variables de configuración:</h2>";
echo "<p><strong>API_ALL_ENROLLMENTS:</strong> " . API_ALL_ENROLLMENTS . "</p>";
echo "<p><strong>API_ENROLLMENT_DETAILS:</strong> " . API_ENROLLMENT_DETAILS . "</p>";
echo "<p><strong>CACHE_DURATION:</strong> " . CACHE_DURATION . " segundos</p>";

// Test testimoniales
echo "<h2>2. Testimoniales (desde config.php):</h2>";
echo "<p>Total testimoniales: " . count($testimonials) . "</p>";
foreach ($testimonials as $i => $testimonial) {
    echo "<p>Testimonial $i: " . $testimonial['name'] . " - " . $testimonial['role'] . "</p>";
}

// Test redes sociales
echo "<h2>3. Redes sociales (desde config.php):</h2>";
echo "<p>Total redes: " . count($social_links) . "</p>";
foreach ($social_links as $i => $social) {
    echo "<p>Red $i: " . $social['name'] . " - " . $social['url'] . "</p>";
}

// Test de APIs
echo "<h2>4. Test de APIs de formaciones:</h2>";
echo "<p>Iniciando fetch de enrollments...</p>";

$formations = fetchAllEnrollments();

echo "<p><strong>Resultado:</strong></p>";
if (empty($formations)) {
    echo "<p style='color: red;'>❌ No se obtuvieron formaciones. Revisar logs de error.</p>";
    
    // Test directo a la API principal
    echo "<h3>Test directo API principal:</h3>";
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 15,
            'header' => [
                'User-Agent: CLEV-Landing-PHP/1.0',
                'Accept: application/json'
            ]
        ]
    ]);
    
    $response = @file_get_contents(API_ALL_ENROLLMENTS, false, $context);
    if ($response === false) {
        echo "<p style='color: red;'>❌ Error al conectar con API principal</p>";
    } else {
        $data = json_decode($response, true);
        if ($data === null) {
            echo "<p style='color: red;'>❌ Error al decodificar JSON de API principal</p>";
            echo "<p>Respuesta raw: " . htmlentities(substr($response, 0, 500)) . "...</p>";
        } else {
            echo "<p style='color: green;'>✅ API principal responde correctamente</p>";
            echo "<p>Datos recibidos: " . count($data['data'] ?? []) . " enrollments</p>";
            echo "<pre>" . htmlentities(json_encode($data, JSON_PRETTY_PRINT)) . "</pre>";
        }
    }
} else {
    echo "<p style='color: green;'>✅ Se obtuvieron " . count($formations) . " formaciones</p>";
    foreach ($formations as $i => $formation) {
        echo "<p>Formación $i: " . ($formation['edition']['editionName'] ?? 'Sin nombre') . "</p>";
    }
}

// Test cache
echo "<h2>5. Estado del cache:</h2>";
$cacheFile = 'cache/enrollments.json';
if (file_exists($cacheFile)) {
    $cacheAge = time() - filemtime($cacheFile);
    echo "<p style='color: green;'>✅ Cache existe. Edad: $cacheAge segundos</p>";
    echo "<p>Contenido del cache: " . strlen(file_get_contents($cacheFile)) . " bytes</p>";
} else {
    echo "<p style='color: orange;'>⚠️ Cache no existe</p>";
}

// Test permisos
echo "<h2>6. Test de permisos:</h2>";
if (is_writable('cache')) {
    echo "<p style='color: green;'>✅ Directorio cache es escribible</p>";
} else {
    echo "<p style='color: red;'>❌ Directorio cache NO es escribible</p>";
}

echo "<hr>";
echo "<p><strong>Test completado:</strong> " . date('Y-m-d H:i:s') . "</p>";
?>
