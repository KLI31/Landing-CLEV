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
    modalVideo.src = videoUrl;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';

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
console.log('🔧 GENERAL:');
console.log('   CLEV.reinitialize() - Reinicializar todo');
console.log('📱 Responsive automático: 1 en móvil, 2 en tablet, 3 en desktop');
