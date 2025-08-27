<?php
// Sección de testimoniales
global $testimonials;
?>
<section class="flex flex-col"> 
    <?php 
    $title = "Testimonios";
    $description = "Lo que dicen nuestros clientes sobre nosotros";
    include 'header-section.php'; 
    ?>
    
    <div>
        <div class="swiper testimonials-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($testimonials as $index => $testimonial): ?>
                    <div class="swiper-slide">
                        <div 
                            class="relative group cursor-pointer testimonial-video-card max-w-xs mx-auto" 
                            data-video-url="<?php echo e($testimonial['videoUrl']); ?>"
                            data-index="<?php echo $index; ?>"
                        >
                            <div class="relative aspect-video rounded-2xl overflow-hidden bg-gradient-to-br from-clev-blue/20 to-clev-green/20 backdrop-blur-sm">
                                <img 
                                    src="<?php echo e($testimonial['thumbnail']); ?>" 
                                    alt=""
                                    width="100%"
                                    height="100%"
                                    loading="eager"
                                    class="w-full h-full object-cover"
                                />
                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                    <div class="play-button w-16 h-16 bg-white/80 backdrop-blur-lg rounded-full flex items-center justify-center shadow-lg">
                                        <?php echo getSocialIcon('play', 'w-5 h-5'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <!-- Modal de video -->
    <div id="video-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-lg rounded-lg">
        <div class="relative max-w-4xl w-full mx-4">
            <button id="close-modal" class="absolute -top-12 right-0 text-white hover:text-clev-yellow transition-colors duration-200 cursor-pointer">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <video 
                id="modal-video" 
                class="w-full aspect-video rounded-2xl" 
                controls 
                preload="none"
            >
                Tu navegador no soporta el elemento video.
            </video>
        </div>
    </div>
</section>
