<?php
// Componente principal del contenido
global $formations, $testimonials, $social_links;
?>
<div class="p-4 h-screen flex flex-col items-center">
    <div class="w-[60%] h-full flex flex-col p-12 bg-clev-white border border-clev-white/10 backdrop-blur-sm drop-shadow-2xl shadow-black rounded-lg">
        <div class="flex-1">
            <?php include 'formations-section.php'; ?>
        </div>
        
        <div class="h-[35vh] min-h-[280px]">
            <?php include 'testimonials-section.php'; ?>
        </div>
        
        <div class="flex-shrink-0">
            <?php include 'bottom-nav.php'; ?>
        </div>
    </div>
</div>
