<?php
// Carrusel de formaciones
global $formations;
?>
<div class="formations-swiper overflow-hidden h-full">
    <div class="swiper-wrapper">
        <?php if (!empty($formations)): ?>
            <?php foreach ($formations as $formation): ?>
                <div class="swiper-slide min-h-full">
                    <div class="flex flex-col bg-clev-white border border-clev-text/10 rounded-lg shadow-xl overflow-hidden h-full min-h-[200px]">
                        <div class="w-full h-70 relative">
                            <?php 
                            $imageUrl = 'https://clev-payments.s3.us-east-1.amazonaws.com/formations/1744899433042-logo-clev.png';
                            if (isset($formation['formations'][0]['imageUrl']) && !empty($formation['formations'][0]['imageUrl'])) {
                                $imageUrl = $formation['formations'][0]['imageUrl'];
                            }
                            ?>
                            <img
                                src="<?php echo e($imageUrl); ?>"
                                alt="<?php echo e($formation['edition']['editionName']); ?>"
                                class="w-full h-full object-cover"
                                loading="eager"
                            />
                            <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full text-xs font-medium text-gray-700 shadow-sm">
                                <?php echo e($formation['edition']['editionCode']); ?>
                            </div>
                        </div>
                        <div class="flex-1 p-4 flex flex-col justify-between">
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-800 text-clev-white font-medium">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    En línea
                                </span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-700 text-clev-white font-medium">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                    </svg>
                                    Zoom
                                </span>
                            </div>
                            
                            <div class="flex flex-col gap-1 text-xs text-clev-text mb-3">
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 flex-shrink-0 text-clev-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="truncate">Inicio: <?php echo formatDate($formation['edition']['startDate']); ?></span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 flex-shrink-0 text-clev-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="truncate">Fin: <?php echo formatDate($formation['edition']['endDate']); ?></span>
                                </div>
                            </div>
                            
                            <a 
                                href="<?php echo getWhatsAppUrl($formation['edition']['editionName']); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-auto w-full bg-gradient-to-r from-clev-blue to-blue-700 hover:from-blue-700 text-white py-2.5 px-3 rounded-lg transition-all duration-300 text-md font-semibold cursor-pointer hover:scale-105 hover:shadow-lg active:scale-95"
                            >
                                <span class="flex items-center justify-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Inscribirse
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="swiper-slide min-h-full">
                <div class="flex flex-col items-center justify-center bg-clev-white border border-clev-text/10 rounded-lg shadow-xl overflow-hidden h-full min-h-[200px] p-8">
                    <h3 class="text-lg font-semibold text-clev-text mb-2">No hay formaciones disponibles</h3>
                    <p class="text-sm text-gray-500 text-center">En este momento no hay formaciones activas. Pronto tendremos nuevos cursos disponibles.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>

<script>
// Debug de formaciones por consola
console.group('🎓 CLEV FORMACIONES DEBUG');
console.log('📊 Estado de las formaciones:');

<?php if (!empty($formations)): ?>
    console.log('✅ Formaciones recibidas: <?php echo count($formations); ?>');
    
    // Verificar slides HTML generadas
    setTimeout(() => {
        const slides = document.querySelectorAll('.formations-swiper .swiper-slide');
        console.log(`🏗️ Slides HTML generadas: ${slides.length}`);
        
        if (slides.length !== <?php echo count($formations); ?>) {
            console.error(`❌ Mismatch: ${slides.length} slides HTML vs <?php echo count($formations); ?> formaciones PHP`);
        } else {
            console.log('✅ Número de slides HTML coincide con formaciones PHP');
        }
        
        // Verificar que las slides tengan contenido
        slides.forEach((slide, index) => {
            const hasContent = slide.querySelector('img') && slide.querySelector('.text-lg, .text-md, h1, h2, h3');
            console.log(`Slide ${index + 1}: ${hasContent ? '✅ Tiene contenido' : '❌ Sin contenido'}`);
        });
        
        console.log('🎯 Configuración del carrusel: 3 formaciones por vista en desktop');
        console.log('📱 Responsive: 1 en móvil, 2 en tablet, 3 en desktop');
    }, 100);
    
    console.log('📋 Listado completo de formaciones:', <?php echo json_encode($formations, JSON_PRETTY_PRINT); ?>);
    
    <?php foreach ($formations as $index => $formation): ?>
        console.group('📚 Formación <?php echo $index + 1; ?>:');
        console.log('🏷️ Nombre:', '<?php echo addslashes($formation['edition']['editionName'] ?? 'Sin nombre'); ?>');
        console.log('🔢 Código:', '<?php echo addslashes($formation['edition']['editionCode'] ?? 'Sin código'); ?>');
        console.log('📅 Inicio:', '<?php echo addslashes($formation['edition']['startDate'] ?? 'Sin fecha'); ?>');
        console.log('📅 Fin:', '<?php echo addslashes($formation['edition']['endDate'] ?? 'Sin fecha'); ?>');
        console.log('🖼️ Imagen:', '<?php echo addslashes($formation['formations'][0]['imageUrl'] ?? 'Sin imagen'); ?>');
        console.log('💰 Precio:', '<?php echo addslashes($formation['edition']['price'] ?? 'Sin precio'); ?>');
        console.groupEnd();
    <?php endforeach; ?>
    
<?php else: ?>
    console.warn('⚠️ No se recibieron formaciones');
    console.log('🔍 Verificar:');
    console.log('   - APIs están funcionando');
    console.log('   - URLs de APIs son correctas');
    console.log('   - Cache está funcionando');
    console.log('   - Variable $formations está definida');
<?php endif; ?>

console.log('🌐 URLs de APIs:');
console.log('   📡 Enrollments:', '<?php echo API_ALL_ENROLLMENTS; ?>');
console.log('   📡 Details:', '<?php echo API_ENROLLMENT_DETAILS; ?>');

console.log('⚙️ Configuración:');
console.log('   ⏱️ Cache duration:', '<?php echo CACHE_DURATION; ?> segundos');
console.log('   📁 Cache file:', 'cache/enrollments.json');

console.groupEnd();
</script>
