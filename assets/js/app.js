// CLEV Landing - JavaScript Principal

// Inicialización principal cuando el DOM está listo
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 CLEV Landing - Inicializando...');
    
    // Verificar librerías disponibles
    console.log('📚 Librerías disponibles:');
    console.log('   Swiper:', typeof Swiper !== 'undefined' ? '✅' : '❌');
    console.log('   GSAP:', typeof gsap !== 'undefined' ? '✅' : '❌');
    
    // Dar tiempo al DOM para cargar completamente
    setTimeout(() => {
        initFormationsSwiper();
        initTestimonialsSwiper();
        initBottomNav();
        
        console.log('✅ Inicialización completada');
    }, 100);
});

// === FORMATIONS SWIPER ===
function initFormationsSwiper() {
    if (typeof Swiper === 'undefined') {
        console.warn('Swiper no está disponible');
        return;
    }

    console.log('🔄 Inicializando Swiper de formaciones...');
    
    // Verificar que el elemento existe
    const swiperElement = document.querySelector('.formations-swiper');
    if (!swiperElement) {
        console.error('❌ No se encontró el elemento .formations-swiper');
        return;
    }
    
    const slides = document.querySelectorAll('.formations-swiper .swiper-slide');
    console.log(`📊 Slides encontradas: ${slides.length}`);

    const formationsSwiper = new Swiper('.formations-swiper', {
        // Configuración fija: 3 formaciones por vista
        slidesPerView: 3,
        spaceBetween: 25,
        centeredSlides: false,
        loop: slides.length > 3, // Solo loop si hay más de 3 slides
        
        // Autoplay solo si hay múltiples slides
        autoplay: slides.length > 3 ? {
            delay: 4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        } : false,
        
        // Navegación
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        
        // Responsive: Siempre 3 en desktop, ajustar solo para pantallas pequeñas
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 25,
            }
        },
        
        // Eventos
        on: {
            init: function() {
                console.log('✅ Swiper de formaciones inicializado correctamente');
                console.log(`📊 Total de slides: ${this.slides.length}`);
                console.log(`🔍 Slide activa: ${this.activeIndex}`);
            },
            slideChange: function() {
                console.log(`🔄 Cambio de slide: ${this.activeIndex + 1}/${this.slides.length}`);
            }
        }
    });
    
    // Debug adicional
    if (formationsSwiper) {
        console.log('✅ Swiper creado exitosamente');
        console.log('📊 Estado del swiper:', {
            slides: formationsSwiper.slides.length,
            activeIndex: formationsSwiper.activeIndex,
            isLocked: formationsSwiper.isLocked
        });
        
        // Forzar actualización después de un breve retraso
        setTimeout(() => {
            formationsSwiper.update();
            formationsSwiper.updateSlides();
            formationsSwiper.updateProgress();
            formationsSwiper.updateSlidesClasses();
            console.log('🔄 Swiper actualizado forzosamente');
            console.log('📊 Estado después de actualización:', {
                slides: formationsSwiper.slides.length,
                realIndex: formationsSwiper.realIndex,
                isLocked: formationsSwiper.isLocked
            });
        }, 500);
        
        // Guardar referencia global para debug
        window.formationsSwiper = formationsSwiper;
        
    } else {
        console.error('❌ Error al crear el swiper de formaciones');
    }
}

// === TESTIMONIALS SWIPER ===
function initTestimonialsSwiper() {
    if (typeof Swiper === 'undefined') {
        console.warn('Swiper no está disponible');
        return;
    }

    console.log('🔄 Inicializando Swiper de testimoniales...');
    
    // Contar testimonios disponibles
    const testimonialSlides = document.querySelectorAll('.testimonials-swiper .swiper-slide');
    console.log(`🎭 Testimonios encontrados: ${testimonialSlides.length}`);
    
    const testimonialsSwiper = new Swiper('.testimonials-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: testimonialSlides.length > 3, // Solo loop si hay suficientes slides
        centeredSlides: true,
        
        autoplay: testimonialSlides.length > 1 ? {
            delay: 6000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
        } : false,
        
        // Configuración responsive optimizada
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 25,
                centeredSlides: false
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
                centeredSlides: false
            }
        },
        on: {
            init: function() {
                console.log('✅ Swiper de testimoniales inicializado');
                console.log(`📊 Configuración: ${this.params.slidesPerView} slides por vista`);
                console.log(`🔄 Loop: ${this.params.loop ? 'Activado' : 'Desactivado'}`);
                console.log(`📱 Autoplay: ${this.params.autoplay ? 'Activado' : 'Desactivado'}`);
                
                // Verificar espacio y slides
                setTimeout(() => {
                    console.log(`📏 Slides totales: ${this.slides.length}`);
                    console.log(`📍 Slide activo: ${this.activeIndex + 1}`);
                }, 100);
                
                animateTestimonialCards();
            },
            slideChange: function() {
                console.log(`🔄 Cambio a slide: ${this.activeIndex + 1}/${this.slides.length}`);
            }
        }
    });

    // Almacenar referencia global
    window.testimonialsSwiper = testimonialsSwiper;
    
    // Configurar modal de video y eventos
    setupVideoModal();
    setupHoverAnimations();
}

// === ANIMACIONES DE TESTIMONIALES ===
function animateTestimonialCards() {
    if (typeof gsap === 'undefined') {
        console.warn('GSAP no está disponible');
        return;
    }

    const cards = document.querySelectorAll('.testimonial-video-card');
    console.log(`🎬 Animando ${cards.length} tarjetas de testimonios`);
    
    // Configurar estado inicial sin afectar opacity (conflicto con Swiper)
    gsap.set(cards, {
        y: 30,
        scale: 0.95,
        rotationY: 10
    });

    // Animar entrada suave
    gsap.to(cards, {
        y: 0,
        scale: 1,
        rotationY: 0,
        duration: 0.6,
        ease: "power2.out",
        stagger: 0.15,
        delay: 0.2
    });
}

// === CONFIGURAR MODAL DE VIDEO ===
function setupVideoModal() {
    const modal = document.getElementById('video-modal');
    const modalVideo = document.getElementById('modal-video');
    const closeModal = document.getElementById('close-modal');
    const videoCards = document.querySelectorAll('.testimonial-video-card');

    if (!modal || !modalVideo || !closeModal) {
        console.warn('Elementos del modal no encontrados');
        return;
    }

    // Eventos de los cards de video
    videoCards.forEach(card => {
        card.addEventListener('click', () => {
            const videoUrl = card.getAttribute('data-video-url');
            if (videoUrl) {
                openVideoModal(videoUrl, modal, modalVideo);
            }
        });
    });

    // Cerrar modal
    closeModal.addEventListener('click', () => closeVideoModal(modal, modalVideo));
    
    // Cerrar modal al hacer clic en el fondo
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeVideoModal(modal, modalVideo);
        }
    });

    // Cerrar modal con Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeVideoModal(modal, modalVideo);
        }
    });
}

function openVideoModal(videoUrl, modal, modalVideo) {
    // Limpiar el video anterior
    modalVideo.pause();
    modalVideo.currentTime = 0;
    modalVideo.src = '';
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';

    // Configurar el nuevo video
    modalVideo.src = videoUrl;
    modalVideo.load();

    // Múltiples intentos para reproducir automáticamente
    const playVideo = () => {
        modalVideo.play().catch(error => {
            console.log('Error al reproducir automáticamente:', error);
            // Intentar de nuevo después de un breve retraso
            setTimeout(() => {
                modalVideo.play().catch(e => console.log('Segundo intento fallido:', e));
            }, 500);
        });
    };

    // Eventos para reproducción automática
    modalVideo.addEventListener('loadeddata', playVideo, { once: true });
    modalVideo.addEventListener('canplay', playVideo, { once: true });
    
    // Intentar reproducir inmediatamente si ya está cargado
    if (modalVideo.readyState >= 3) {
        playVideo();
    }

    if (typeof gsap !== 'undefined') {
        // Animación de apertura con GSAP
        gsap.fromTo(modal, 
            { 
                opacity: 0,
                backdropFilter: 'blur(0px)' 
            },
            { 
                opacity: 1,
                backdropFilter: 'blur(8px)',
                duration: 0.4,
                ease: "power2.out"
            }
        );

        gsap.fromTo(modal.querySelector('.relative'),
            {
                scale: 0.8,
                y: 50,
                opacity: 0
            },
            {
                scale: 1,
                y: 0,
                opacity: 1,
                duration: 0.5,
                ease: "back.out(1.2)",
                delay: 0.1
            }
        );
    }
}

function closeVideoModal(modal, modalVideo) {
    if (typeof gsap !== 'undefined') {
        // Animación de cierre con GSAP
        gsap.to(modal, {
            opacity: 0,
            backdropFilter: 'blur(0px)',
            duration: 0.3,
            ease: "power2.out",
            onComplete: () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modalVideo.src = '';
                modalVideo.pause();
                document.body.style.overflow = '';
            }
        });
    } else {
        // Fallback sin animación
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modalVideo.src = '';
        modalVideo.pause();
        document.body.style.overflow = '';
    }
}

// === ANIMACIONES DE HOVER ===
function setupHoverAnimations() {
    if (typeof gsap === 'undefined') {
        console.warn('GSAP no está disponible para animaciones de hover');
        return;
    }

    const videoCards = document.querySelectorAll('.testimonial-video-card');

    videoCards.forEach(card => {
        const img = card.querySelector('img');
        const playButton = card.querySelector('.play-button');
        const overlay = card.querySelector('.video-overlay');

        // Hover in
        card.addEventListener('mouseenter', () => {
            gsap.to(img, {
                scale: 1.1,
                duration: 0.4,
                ease: "power2.out"
            });

            gsap.to(playButton, {
                scale: 1.15,
                rotation: 5,
                duration: 0.3,
                ease: "back.out(1.2)"
            });

            if (overlay) {
                gsap.to(overlay, {
                    backgroundColor: 'rgba(0, 0, 0, 0.2)',
                    duration: 0.3,
                    ease: "power2.out"
                });
            }
        });

        // Hover out
        card.addEventListener('mouseleave', () => {
            gsap.to(img, {
                scale: 1,
                duration: 0.4,
                ease: "power2.out"
            });

            gsap.to(playButton, {
                scale: 1,
                rotation: 0,
                duration: 0.3,
                ease: "power2.out"
            });

            if (overlay) {
                gsap.to(overlay, {
                    backgroundColor: 'rgba(0, 0, 0, 0.4)',
                    duration: 0.3,
                    ease: "power2.out"
                });
            }
        });

        // Click animation
        card.addEventListener('click', () => {
            gsap.to(playButton, {
                scale: 0.9,
                duration: 0.1,
                ease: "power2.out",
                yoyo: true,
                repeat: 1
            });
        });
    });
}

// === BOTTOM NAV ANIMATIONS ===
function initBottomNav() {
    if (typeof gsap === 'undefined') {
        console.warn('GSAP no está disponible para bottom nav');
        return;
    }

    animateBottomNav();
}

function animateBottomNav() {
    const bottomNav = document.getElementById('bottom-nav');
    const socialIcons = bottomNav?.querySelectorAll('.social-icon');
    
    if (!bottomNav || !socialIcons) {
        console.warn('Bottom nav no encontrado');
        return;
    }

    // Timeline principal
    const tl = gsap.timeline();

    // Configurar estado inicial
    gsap.set(bottomNav, {
        y: 100,
        opacity: 0,
        scale: 0.8
    });

    gsap.set(socialIcons, {
        y: 20,
        opacity: 0,
        scale: 0.5
    });

    // Animación del contenedor principal
    tl.to(bottomNav, {
        y: 0,
        opacity: 1,
        scale: 1,
        duration: 0.8,
        ease: "back.out(1.7)",
        delay: 0.5
    });

    // Animación escalonada de los iconos sociales
    tl.to(socialIcons, {
        y: 0,
        opacity: 1,
        scale: 1,
        duration: 0.6,
        ease: "back.out(1.2)",
        stagger: 0.1
    }, "-=0.4");

    // Pequeño rebote final
    tl.to(bottomNav, {
        y: -5,
        duration: 0.2,
        ease: "power2.out"
    }).to(bottomNav, {
        y: 0,
        duration: 0.3,
        ease: "bounce.out"
    });
}

// === MANEJO DE ERRORES ===
window.addEventListener('error', function(event) {
    console.error('Error en CLEV Landing:', event.error);
});

// === UTILIDADES ===
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Reinicializar en caso de cambios dinámicos
function reinitialize() {
    initFormationsSwiper();
    initTestimonialsSwiper();
    initBottomNav();
}

// Exportar funciones para uso externo si es necesario
window.CLEV = {
    reinitialize,
    initFormationsSwiper,
    initTestimonialsSwiper,
    initBottomNav,
    
    // Funciones de debug manual
    debugFormations: function() {
        console.group('🔍 DEBUG MANUAL - Formaciones');
        
        const slides = document.querySelectorAll('.formations-swiper .swiper-slide');
        console.log(`📊 Slides en DOM: ${slides.length}`);
        
        if (window.formationsSwiper) {
            console.log('✅ Swiper instance disponible');
            console.log('📊 Estado actual:', {
                slides: window.formationsSwiper.slides.length,
                activeIndex: window.formationsSwiper.activeIndex,
                isLocked: window.formationsSwiper.isLocked,
                slidesPerView: window.formationsSwiper.slidesPerViewDynamic(),
                spaceBetween: window.formationsSwiper.spaceBetween
            });
            
            // Intentar ir a la siguiente slide
            console.log('🔄 Intentando ir a siguiente slide...');
            window.formationsSwiper.slideNext();
            
        } else {
            console.error('❌ No hay instancia de Swiper disponible');
            console.log('🔄 Intentando reinicializar...');
            initFormationsSwiper();
        }
        
        console.groupEnd();
    },
    
    goToSlide: function(slideNumber) {
        if (window.formationsSwiper) {
            window.formationsSwiper.slideTo(slideNumber - 1);
            console.log(`🎯 Navegando a slide ${slideNumber}`);
        } else {
            console.error('❌ Swiper no disponible');
        }
    },
    
    nextSlide: function() {
        if (window.formationsSwiper) {
            window.formationsSwiper.slideNext();
            console.log(`➡️ Siguiente slide: ${window.formationsSwiper.activeIndex + 1}`);
        }
    },
    
    prevSlide: function() {
        if (window.formationsSwiper) {
            window.formationsSwiper.slidePrev();
            console.log(`⬅️ Slide anterior: ${window.formationsSwiper.activeIndex + 1}`);
        }
    },
    
    // Cambiar configuración dinámicamente
    changeSlidesPerView: function(slides) {
        if (window.formationsSwiper) {
            window.formationsSwiper.destroy(true, true);
            setTimeout(() => {
                // Recrear con nueva configuración
                const newSwiper = new Swiper('.formations-swiper', {
                    slidesPerView: slides,
                    spaceBetween: 25,
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    }
                });
                window.formationsSwiper = newSwiper;
                console.log(`🔄 Swiper reconfigurado para mostrar ${slides} formaciones por vista`);
            }, 100);
        }
    },
    
    // Debug de testimonios
    debugTestimonials: function() {
        if (window.testimonialsSwiper) {
            const swiper = window.testimonialsSwiper;
            console.log('🎭 === DEBUG TESTIMONIOS ===');
            console.log(`📊 Slides totales: ${swiper.slides.length}`);
            console.log(`📍 Slide activo: ${swiper.activeIndex + 1}`);
            console.log(`🔄 Loop: ${swiper.params.loop ? 'Activado' : 'Desactivado'}`);
            console.log(`📱 Autoplay: ${swiper.params.autoplay ? 'Activado' : 'Desactivado'}`);
            console.log(`📐 Slides por vista: ${swiper.params.slidesPerView}`);
            console.log(`📏 Espacio entre slides: ${swiper.params.spaceBetween}px`);
            console.log(`🎯 Centrado: ${swiper.params.centeredSlides ? 'Sí' : 'No'}`);
        } else {
            console.warn('❌ Swiper de testimonios no encontrado');
        }
    },
    
    // Test de rendimiento de la aplicación
    performanceTest: function(type = 'standard') {
        console.log('🚀 === TEST DE RENDIMIENTO ===');
        console.log(`Tipo de test: ${type}`);
        
        const startTime = performance.now();
        
        return fetch(`performance-test.php?type=${type}`)
            .then(response => response.json())
            .then(data => {
                const clientTime = Math.round(performance.now() - startTime);
                
                console.log('📊 Resultados del test:');
                console.log(`⏱️ Tiempo de carga: ${data.load_time_ms}ms (servidor) + ${clientTime}ms (cliente)`);
                console.log(`📚 Formaciones cargadas: ${data.formations_count}`);
                console.log(`💾 Estado del cache: ${data.cache_status}`);
                console.log(`⭐ Rendimiento: ${data.performance_message}`);
                
                if (data.cache_info) {
                    console.log('📁 Info del cache:');
                    console.log(`   📄 Cache base: ${data.cache_info.base_exists ? 'Existe' : 'No existe'} (${data.cache_info.base_age_minutes} min)`);
                    console.log(`   📄 Cache final: ${data.cache_info.final_exists ? 'Existe' : 'No existe'} (${data.cache_info.final_age_minutes} min)`);
                    console.log(`   💽 Tamaño total: ${data.cache_info.total_cache_size_kb} KB`);
                }
                
                if (data.optimizations) {
                    console.log('🔧 Optimizaciones activas:');
                    Object.entries(data.optimizations).forEach(([key, value]) => {
                        console.log(`   ${key}: ${value}`);
                    });
                }
                
                return data;
            })
            .catch(error => {
                console.error('❌ Error en test de rendimiento:', error);
                return null;
            });
    },
    
    // Comparar rendimiento con/sin cache
    performanceComparison: async function() {
        console.log('🔬 === COMPARACIÓN DE RENDIMIENTO ===');
        
        // Test 1: Con cache (si existe)
        console.log('Test 1: Carga normal (con cache si existe)');
        const test1 = await CLEV.performanceTest('standard');
        
        // Test 2: Sin cache (forzar recarga)
        console.log('Test 2: Carga sin cache (forzada)');
        const test2 = await CLEV.performanceTest('force-fresh');
        
        // Test 3: Con cache recién creado
        console.log('Test 3: Carga con cache recién creado');
        const test3 = await CLEV.performanceTest('cache-only');
        
        if (test1 && test2) {
            const improvement = test2.load_time_ms > 0 ? 
                Math.round((test2.load_time_ms - test1.load_time_ms) / test2.load_time_ms * 100) : 0;
            
            console.log('🏆 === RESUMEN DE OPTIMIZACIÓN ===');
            console.log(`📈 Mejora de velocidad: ${improvement}% más rápido con cache`);
            console.log(`🚀 Sin cache: ${test2.load_time_ms}ms`);
            console.log(`⚡ Con cache: ${test1.load_time_ms}ms`);
            
            if (improvement > 80) {
                console.log('🎉 ¡Excelente optimización!');
            } else if (improvement > 50) {
                console.log('✅ Buena optimización');
            } else if (improvement > 20) {
                console.log('⚠️ Optimización moderada');
            } else {
                console.log('🔧 Necesita más optimización');
            }
        }
    },
    
    // Limpiar cache desde el frontend
    clearCache: function() {
        console.log('🗑️ Limpiando cache...');
        
        return fetch('cache-manager.php?action=clear&key=clev2024')
            .then(response => response.text())
            .then(data => {
                console.log('✅ Cache limpiado exitosamente');
                console.log('🔄 Recomendación: Recarga la página para ver los cambios');
                return true;
            })
            .catch(error => {
                console.error('❌ Error al limpiar cache:', error);
                return false;
            });
    },
    
    // Auto-refresh inteligente para detectar nuevos enrollments
    autoRefresh: {
        intervalId: null,
        isEnabled: false,
        
        // Verificar si hay nuevos enrollments
        checkForUpdates: function() {
            return fetch('auto-refresh.php')
                .then(response => response.json())
                .then(data => {
                    console.log('🔍 Check de actualización:', data);
                    
                    if (data.needs_refresh) {
                        let message = '';
                        
                        switch (data.reason) {
                            case 'new_enrollments_detected':
                                message = `🆕 ${data.new_enrollments_count} nueva(s) formación(es) detectada(s)`;
                                break;
                            case 'new_enrollments_and_expired':
                                message = `🆕 ${data.new_enrollments_count} nueva(s) formación(es) + cache expirado`;
                                break;
                            case 'cache_expired':
                                message = `⏰ Cache expirado (${data.cache_age_minutes} min)`;
                                break;
                            default:
                                message = `🔄 Actualización disponible`;
                        }
                        
                        console.log(`🔔 ${message}`);
                        console.log(`📊 Actual: ${data.current_count} | API: ${data.api_count}`);
                        
                        // Mostrar notificación al usuario
                        CLEV.autoRefresh.showUpdateNotification(message, data);
                    } else {
                        console.log('✅ No hay actualizaciones disponibles');
                    }
                    
                    return data;
                })
                .catch(error => {
                    console.error('❌ Error al verificar actualizaciones:', error);
                    return null;
                });
        },
        
        // Mostrar notificación de actualización
        showUpdateNotification: function(message, data) {
            // Remover notificación anterior si existe
            const existingNotification = document.getElementById('update-notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Crear notificación
            const notification = document.createElement('div');
            notification.id = 'update-notification';
            notification.innerHTML = `
                <div style="
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    padding: 16px 20px;
                    border-radius: 12px;
                    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
                    z-index: 9999;
                    font-family: 'Gilroy', sans-serif;
                    max-width: 350px;
                    animation: slideInRight 0.4s ease;
                ">
                    <div style="display: flex; align-items: center; margin-bottom: 12px;">
                        <span style="font-size: 20px; margin-right: 8px;">🆕</span>
                        <strong>Nuevas Formaciones</strong>
                    </div>
                    <div style="font-size: 14px; margin-bottom: 16px; opacity: 0.9;">
                        ${message}
                    </div>
                    <div style="display: flex; gap: 12px;">
                        <button 
                            onclick="CLEV.autoRefresh.updateNow()" 
                            style="
                                background: rgba(255,255,255,0.2);
                                border: 1px solid rgba(255,255,255,0.3);
                                color: white;
                                padding: 8px 16px;
                                border-radius: 6px;
                                cursor: pointer;
                                font-size: 13px;
                                transition: all 0.2s;
                            "
                            onmouseover="this.style.background='rgba(255,255,255,0.3)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.2)'"
                        >
                            🔄 Actualizar Ahora
                        </button>
                        <button 
                            onclick="CLEV.autoRefresh.dismissNotification()" 
                            style="
                                background: transparent;
                                border: 1px solid rgba(255,255,255,0.3);
                                color: white;
                                padding: 8px 16px;
                                border-radius: 6px;
                                cursor: pointer;
                                font-size: 13px;
                                transition: all 0.2s;
                            "
                            onmouseover="this.style.background='rgba(255,255,255,0.1)'"
                            onmouseout="this.style.background='transparent'"
                        >
                            ❌ Cerrar
                        </button>
                    </div>
                </div>
                <style>
                    @keyframes slideInRight {
                        from { transform: translateX(100%); opacity: 0; }
                        to { transform: translateX(0); opacity: 1; }
                    }
                </style>
            `;
            
            document.body.appendChild(notification);
            
            // Auto-cerrar después de 30 segundos
            setTimeout(() => {
                CLEV.autoRefresh.dismissNotification();
            }, 30000);
        },
        
        // Actualizar ahora
        updateNow: function() {
            console.log('🔄 Actualizando formaciones...');
            CLEV.autoRefresh.dismissNotification();
            
            // Limpiar cache y recargar
            CLEV.clearCache().then(() => {
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            });
        },
        
        // Cerrar notificación
        dismissNotification: function() {
            const notification = document.getElementById('update-notification');
            if (notification) {
                notification.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }
        },
        
        // Iniciar auto-refresh
        start: function(intervalMinutes = 5) {
            if (this.isEnabled) {
                console.log('⚠️ Auto-refresh ya está activo');
                return;
            }
            
            console.log(`🔄 Iniciando auto-refresh cada ${intervalMinutes} minutos`);
            this.isEnabled = true;
            
            // Check inicial
            this.checkForUpdates();
            
            // Configurar intervalo
            this.intervalId = setInterval(() => {
                this.checkForUpdates();
            }, intervalMinutes * 60 * 1000);
        },
        
        // Detener auto-refresh
        stop: function() {
            if (this.intervalId) {
                clearInterval(this.intervalId);
                this.intervalId = null;
                this.isEnabled = false;
                console.log('⏹️ Auto-refresh detenido');
            }
        },
        
        // Estado del auto-refresh
        status: function() {
            console.log('📊 Estado del Auto-refresh:');
            console.log(`   Activo: ${this.isEnabled ? '✅ Sí' : '❌ No'}`);
            console.log(`   Interval ID: ${this.intervalId}`);
            
            if (this.isEnabled) {
                console.log('🔧 Comandos disponibles:');
                console.log('   CLEV.autoRefresh.stop() - Detener');
                console.log('   CLEV.autoRefresh.checkForUpdates() - Check manual');
            } else {
                console.log('🔧 Para iniciar: CLEV.autoRefresh.start(5) // 5 minutos');
            }
        }
    },
    
    // Iniciar auto-refresh por defecto
    enableAutoRefresh: function(intervalMinutes = 5) {
        console.log(`🚀 Habilitando auto-refresh inteligente (${intervalMinutes} min)`);
        this.autoRefresh.start(intervalMinutes);
    }
};

// Mensaje de ayuda en consola
console.log('🚀 CLEV Landing cargado! - Configuración: 3 formaciones por vista');
console.log('💡 Comandos de debug disponibles:');
console.log('🎓 FORMACIONES:');
console.log('   CLEV.debugFormations() - Debug completo del carrusel');
console.log('   CLEV.goToSlide(N) - Ir a slide número N');
console.log('   CLEV.nextSlide() - Siguiente slide');
console.log('   CLEV.prevSlide() - Slide anterior');
console.log('   CLEV.changeSlidesPerView(N) - Cambiar a N formaciones por vista');
console.log('🎭 TESTIMONIOS:');
console.log('   CLEV.debugTestimonials() - Debug completo de testimonios');
console.log('⚡ RENDIMIENTO:');
console.log('   CLEV.performanceTest() - Test de velocidad de carga');
console.log('   CLEV.performanceComparison() - Comparar con/sin cache');
console.log('   CLEV.clearCache() - Limpiar cache para forzar recarga');
console.log('🔄 AUTO-REFRESH (NUEVO):');
console.log('   CLEV.enableAutoRefresh(5) - Activar detección cada 5 min');
console.log('   CLEV.autoRefresh.checkForUpdates() - Check manual');
console.log('   CLEV.autoRefresh.status() - Ver estado actual');
console.log('   CLEV.autoRefresh.stop() - Detener auto-refresh');
console.log('🔧 GENERAL:');
console.log('   CLEV.reinitialize() - Reinicializar todo');
console.log('📱 Responsive automático: 1 en móvil, 2 en tablet, 3 en desktop');
console.log('🚀 OPTIMIZACIONES ACTIVAS: Paralelo, Cache inteligente, Auto-refresh, Timeouts optimizados');
