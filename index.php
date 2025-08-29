<?php
// Archivo principal - Landing CLEV en PHP para CPanel
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Obtener datos de formaciones
$formations = fetchAllEnrollments();

// Configuración de auto-refresh (opcional)
$enableAutoRefresh = true; // Cambiar a false para desactivar
$autoRefreshInterval = 5;  // Minutos entre checks
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_TITLE; ?></title>
    <meta name="description" content="<?php echo SITE_DESCRIPTION; ?>">
    <link rel="icon" type="image/png" href="assets/favicon.svg">
    
    <!-- Preload fonts -->
    <link rel="preload" href="assets/fonts/Gilroy-Light.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="assets/fonts/Gilroy-Regular.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="assets/fonts/Gilroy-Medium.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="assets/fonts/Gilroy-Bold.ttf" as="font" type="font/ttf" crossorigin>
    <link rel="preload" href="assets/fonts/Gilroy-Heavy.ttf" as="font" type="font/ttf" crossorigin>
    
    <!-- CSS -->
    <link href="assets/css/styles.css" rel="stylesheet">
    
    <!-- External Libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
</head>
<body class="overflow-hidden">
    <!-- Background -->
    <div class="fixed inset-0 z-0">
        <img 
            src="assets/images/bg-image.webp" 
            alt="Fondo" 
            class="w-full h-full object-cover opacity-40"
            loading="lazy"
        />
    </div>
    <div class="fixed inset-0 z-10 bg-black opacity-70"></div>
    
    <!-- Main Content -->
    <main class="relative z-10 h-screen overflow-hidden">
        <?php include 'components/main-content.php'; ?>
    </main>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <?php if ($enableAutoRefresh): ?>
    <!-- Auto-refresh automático -->
    <script>
        // Esperar a que la aplicación esté completamente cargada
        document.addEventListener('DOMContentLoaded', function() {
            // Dar tiempo para que CLEV se inicialice completamente
            setTimeout(() => {
                if (typeof CLEV !== 'undefined' && CLEV.enableAutoRefresh) {
                    console.log('🔄 Iniciando auto-refresh automático...');
                    CLEV.enableAutoRefresh(<?php echo $autoRefreshInterval; ?>);
                    
                    // Agregar información en consola
                    console.log('ℹ️ Auto-refresh configurado:');
                    console.log(`   ⏰ Intervalo: <?php echo $autoRefreshInterval; ?> minutos`);
                    console.log(`   📊 Cache duration: <?php echo round(CACHE_DURATION/60, 1); ?> minutos`);
                    console.log('   🛑 Para desactivar: CLEV.autoRefresh.stop()');
                } else {
                    console.warn('⚠️ CLEV no disponible para auto-refresh');
                }
            }, 2000); // 2 segundos de espera
        });
    </script>
    <?php else: ?>
    <!-- Auto-refresh desactivado -->
    <script>
        console.log('ℹ️ Auto-refresh desactivado en configuración');
        console.log('🔄 Para activar manualmente: CLEV.enableAutoRefresh(5)');
    </script>
    <?php endif; ?>
</body>
</html>
