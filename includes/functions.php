<?php
// Funciones para la aplicación CLEV

/**
 * Obtiene los detalles de un enrollment específico
 */
function fetchEnrollmentDetails($enrollmentId) {
    $detailsUrl = API_ENROLLMENT_DETAILS . $enrollmentId . '/details';
    
    // Configurar contexto para la petición HTTP
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'timeout' => 10,
            'header' => [
                'User-Agent: CLEV-Landing-PHP/1.0',
                'Accept: application/json'
            ]
        ]
    ]);
    
    try {
        $response = @file_get_contents($detailsUrl, false, $context);
        
        if ($response === false) {
            error_log("Error al obtener detalles del enrollment $enrollmentId");
            return null;
        }
        
        $data = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("Error JSON al decodificar detalles del enrollment $enrollmentId: " . json_last_error_msg());
            return null;
        }
        
        return $data;
        
    } catch (Exception $e) {
        error_log("Excepción al obtener detalles del enrollment $enrollmentId: " . $e->getMessage());
        return null;
    }
}

/**
 * Obtiene todos los enrollments disponibles
 */
function fetchAllEnrollments() {
    // Intentar obtener desde cache
    $cacheFile = 'cache/enrollments.json';
    $cacheTime = CACHE_DURATION;
    
    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTime) {
        $cachedData = file_get_contents($cacheFile);
        $enrollments = json_decode($cachedData, true);
        if ($enrollments !== null) {
            return $enrollments;
        }
    }
    
    // Configurar contexto para la petición HTTP
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
    
    try {
        $response = @file_get_contents(API_ALL_ENROLLMENTS, false, $context);
        
        if ($response === false) {
            error_log(ERROR_FETCH_FAILED);
            return [];
        }
        
        $apiData = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("Error JSON al decodificar enrollments: " . json_last_error_msg());
            return [];
        }
        
        if (!isset($apiData['data']) || !is_array($apiData['data']) || empty($apiData['data'])) {
            error_log(ERROR_NO_ENROLLMENTS);
            return [];
        }
        
        $enrollments = $apiData['data'];
        $enrollmentDetails = [];
        
        // Obtener detalles de cada enrollment
        foreach ($enrollments as $enrollment) {
            if (isset($enrollment['id'])) {
                $details = fetchEnrollmentDetails($enrollment['id']);
                if ($details !== null) {
                    $enrollmentDetails[] = $details;
                }
            }
        }
        
        // Guardar en cache
        if (!empty($enrollmentDetails)) {
            if (!is_dir('cache')) {
                mkdir('cache', 0755, true);
            }
            file_put_contents($cacheFile, json_encode($enrollmentDetails));
        }
        
        return $enrollmentDetails;
        
    } catch (Exception $e) {
        error_log("Excepción al obtener enrollments: " . $e->getMessage());
        return [];
    }
}

/**
 * Genera el HTML para un icono SVG social
 */
function getSocialIcon($iconName, $class = 'w-5 h-5') {
    $icons = [
        'facebook' => '<svg class="' . $class . '" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
        
        'instagram' => '<svg class="' . $class . '" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.647.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.596-3.205-1.529.757.933 1.908 1.529 3.205 1.529 2.344 0 4.26-1.916 4.26-4.26S10.793 8.468 8.449 8.468c-2.344 0-4.26 1.916-4.26 4.26 0 .757.198 1.471.546 2.089-.348-.618-.546-1.332-.546-2.089 0-2.344 1.916-4.26 4.26-4.26s4.26 1.916 4.26 4.26-1.916 4.26-4.26 4.26zm7.718-8.209v2.138h2.138v-2.138h-2.138z"/></svg>',
        
        'youtube' => '<svg class="' . $class . '" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
        
        'linkedin' => '<svg class="' . $class . '" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
        
        'tiktok' => '<svg class="' . $class . '" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>',
        
        'play' => '<svg class="' . $class . '" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>'
    ];
    
    return isset($icons[$iconName]) ? $icons[$iconName] : '';
}

/**
 * Escapa cadenas para output HTML
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Genera URL de WhatsApp para inscripción
 */
function getWhatsAppUrl($editionName) {
    $message = "Hola, me gustaría inscribirme en la formación: " . $editionName;
    $encodedMessage = urlencode($message);
    return "https://wa.me/573105993792?text=" . $encodedMessage;
}
?>
