<?php
// Configuración principal del sitio CLEV

// Información del sitio
define('SITE_TITLE', 'Corporacion CLEV');
define('SITE_DESCRIPTION', 'Corporación Latinoamericana de Educación Virtual (CLEV) - Líder en educación virtual y capacitación empresarial en Latinoamérica. Ofrecemos cursos, diplomados y programas de formación online de alta calidad.');

// URLs de APIs
define('API_ALL_ENROLLMENTS', 'http://localhost:4030/kayros/api/v1/enrollments/');
define('API_ENROLLMENT_DETAILS', 'http://localhost:4025/api/enrollments/');

// Mensajes de error
define('ERROR_FETCH_FAILED', 'Error al obtener los enrollments');
define('ERROR_NO_ENROLLMENTS', 'No se encontraron enrollments');
define('ERROR_DETAILS_FETCH_FAILED', 'No se pudieron obtener los detalles para el enrollment ID');

// Configuración de cache (en segundos)
define('CACHE_DURATION', 300); // 5 minutos

// Testimoniales
$testimonials = [
    [
        'id' => 1,
        'name' => 'Carlos Rodríguez',
        'role' => 'Director, InnovateCorp',
        'videoUrl' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
        'thumbnail' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&h=300&fit=crop&crop=face',
        'quote' => 'Increíble servicio al cliente y una solución que realmente funciona. Altamente recomendado.'
    ],
    [
        'id' => 2,
        'name' => 'Ana López',
        'role' => 'Fundadora, CreativeStudio',
        'videoUrl' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4',
        'thumbnail' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=300&h=300&fit=crop&crop=face',
        'quote' => 'La mejor inversión que hemos hecho. Nuestro ROI se triplicó en los primeros 6 meses.'
    ],
    [
        'id' => 3,
        'name' => 'David Martín',
        'role' => 'CTO, DataFlow',
        'videoUrl' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4',
        'thumbnail' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&h=300&fit=crop&crop=face',
        'quote' => 'Implementación sencilla y resultados inmediatos. Exactamente lo que necesitábamos.'
    ],
    [
        'id' => 4,
        'name' => 'David Martín',
        'role' => 'CTO, DataFlow',
        'videoUrl' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4',
        'thumbnail' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&h=300&fit=crop&crop=face',
        'quote' => 'Implementación sencilla y resultados inmediatos. Exactamente lo que necesitábamos.'
    ],
    [
        'id' => 5,
        'name' => 'David Martín',
        'role' => 'CTO, DataFlow',
        'videoUrl' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4',
        'thumbnail' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&h=300&fit=crop&crop=face',
        'quote' => 'Implementación sencilla y resultados inmediatos. Exactamente lo que necesitábamos.'
    ],
    [
        'id' => 6,
        'name' => 'David Martín',
        'role' => 'CTO, DataFlow',
        'videoUrl' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4',
        'thumbnail' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&h=300&fit=crop&crop=face',
        'quote' => 'Implementación sencilla y resultados inmediatos. Exactamente lo que necesitábamos.'
    ]
];

// Enlaces de redes sociales
$social_links = [
    [
        'name' => 'Facebook',
        'url' => 'https://www.facebook.com/EducacionVirtualCLEV',
        'icon' => 'facebook'
    ],
    [
        'name' => 'Instagram',
        'url' => 'https://www.instagram.com/educacionvirtuallatam/',
        'icon' => 'instagram'
    ],
    [
        'name' => 'Youtube',
        'url' => 'https://www.youtube.com/@educacionvirtuallatam',
        'icon' => 'youtube'
    ],
    [
        'name' => 'LinkedIn',
        'url' => 'https://www.linkedin.com/company/corporaci%C3%B3n-latinoamericana-de-educaci%C3%B3n-virtual/',
        'icon' => 'linkedin'
    ],
    [
        'name' => 'TikTok',
        'url' => 'https://www.tiktok.com/@corporacionclev',
        'icon' => 'tiktok'
    ]
];

// Colores de redes sociales
$social_colors = [
    'Facebook' => '#1877F2',
    'Instagram' => '#E4405F',
    'Youtube' => '#FF0000',
    'LinkedIn' => '#0A66C2',
    'TikTok' => '#000000'
];

// Funciones de utilidad
function formatDate($dateString) {
    $date = new DateTime($dateString);
    $months = [
        1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
        5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
        9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
    ];
    
    $day = $date->format('j');
    $month = $months[(int)$date->format('n')];
    $year = $date->format('Y');
    
    return "$day de $month de $year";
}

function getSocialColor($name) {
    global $social_colors;
    return isset($social_colors[$name]) ? $social_colors[$name] : '#6B7280';
}
?>
