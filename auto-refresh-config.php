<?php
// Configuración para auto-refresh de enrollments
require_once 'includes/config.php';

// Configuraciones predefinidas para diferentes escenarios
return [
    // Configuración por defecto (equilibrada)
    'default' => [
        'cache_duration' => 1800,        // 30 minutos
        'cache_duration_long' => 3600,   // 1 hora
        'auto_refresh_interval' => 5,    // Check cada 5 minutos
        'description' => 'Equilibrio entre velocidad y datos actualizados'
    ],
    
    // Para entornos de producción estables
    'production' => [
        'cache_duration' => 3600,        // 1 hora
        'cache_duration_long' => 7200,   // 2 horas
        'auto_refresh_interval' => 15,   // Check cada 15 minutos
        'description' => 'Máxima velocidad, actualizaciones menos frecuentes'
    ],
    
    // Para entornos de desarrollo/testing
    'development' => [
        'cache_duration' => 300,         // 5 minutos
        'cache_duration_long' => 900,    // 15 minutos
        'auto_refresh_interval' => 2,    // Check cada 2 minutos
        'description' => 'Datos más frescos, ideal para testing'
    ],
    
    // Para lanzamientos/eventos especiales
    'realtime' => [
        'cache_duration' => 60,          // 1 minuto
        'cache_duration_long' => 300,    // 5 minutos
        'auto_refresh_interval' => 1,    // Check cada 1 minuto
        'description' => 'Casi tiempo real, mayor uso de recursos'
    ],
    
    // Para situaciones de alta demanda
    'high_performance' => [
        'cache_duration' => 7200,        // 2 horas
        'cache_duration_long' => 14400,  // 4 horas
        'auto_refresh_interval' => 30,   // Check cada 30 minutos
        'description' => 'Máximo rendimiento, mínimas actualizaciones'
    ]
];
?>
