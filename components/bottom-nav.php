<?php
// Navegación inferior con redes sociales
global $social_links;
?>
<nav 
    class="bottom-nav fixed bottom-1 left-1/2 transform -translate-x-1/2 z-50"
    aria-label="Navegación de redes sociales CLEV"
    id="bottom-nav"
>
    <div class="bg-clev-text/70 backdrop-blur-xl rounded-2xl shadow-2xl px-6 py-4">
        <div>
            <div class="flex items-center gap-3">
                <?php foreach ($social_links as $index => $socialLink): ?>
                    <a 
                        href="<?php echo e($socialLink['url']); ?>" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="social-icon group relative flex items-center justify-center w-10 h-10 rounded-xl bg-transparent transition-all duration-300 hover:scale-110 hover:shadow-lg active:scale-95"
                        aria-label="Visitar <?php echo e($socialLink['name']); ?> de CLEV"
                        title="Síguenos en <?php echo e($socialLink['name']); ?>"
                        data-social="<?php echo strtolower($socialLink['name']); ?>"
                        data-index="<?php echo $index; ?>"
                    >
                        <?php echo getSocialIcon($socialLink['icon'], 'w-5 h-5 text-clev-white group-hover:text-white transition-all duration-300 z-10 relative'); ?>
                        
                        <div 
                            class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-0 group-hover:scale-100"
                            style="background: linear-gradient(135deg, <?php echo getSocialColor($socialLink['name']); ?>, <?php echo getSocialColor($socialLink['name']); ?>dd);"
                        ></div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</nav>
