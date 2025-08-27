<?php
// Test simple de Swiper para verificar funcionalidad
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Crear datos de prueba simples
$testFormations = [
    [
        'edition' => [
            'editionName' => 'Test Formación 1',
            'editionCode' => 'TEST01',
            'startDate' => '2024-01-01',
            'endDate' => '2024-02-01',
            'price' => '$100'
        ],
        'formations' => [
            ['imageUrl' => 'https://via.placeholder.com/400x300/0066cc/ffffff?text=Formacion+1']
        ]
    ],
    [
        'edition' => [
            'editionName' => 'Test Formación 2',
            'editionCode' => 'TEST02',
            'startDate' => '2024-02-01',
            'endDate' => '2024-03-01',
            'price' => '$200'
        ],
        'formations' => [
            ['imageUrl' => 'https://via.placeholder.com/400x300/cc6600/ffffff?text=Formacion+2']
        ]
    ],
    [
        'edition' => [
            'editionName' => 'Test Formación 3',
            'editionCode' => 'TEST03',
            'startDate' => '2024-03-01',
            'endDate' => '2024-04-01',
            'price' => '$300'
        ],
        'formations' => [
            ['imageUrl' => 'https://via.placeholder.com/400x300/00cc66/ffffff?text=Formacion+3']
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Swiper - CLEV</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f0f0f0;
        }
        
        .test-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
        
        .formations-swiper {
            width: 100%;
            padding: 40px 0;
        }
        
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .formation-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            height: 400px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .formation-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }
        
        .formation-title {
            font-size: 16px;
            font-weight: bold;
            margin: 10px 0;
            color: #333;
        }
        
        .formation-code {
            background: #0066cc;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            display: inline-block;
            margin: 5px 0;
        }
        
        .formation-dates {
            font-size: 12px;
            color: #666;
            margin: 10px 0;
        }
        
        .formation-price {
            font-size: 18px;
            font-weight: bold;
            color: #0066cc;
            margin: 10px 0;
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            background: #0066cc;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        
        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 16px;
            color: white;
        }
        
        .debug-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>🧪 Test de Swiper para Formaciones CLEV</h1>
        
        <div class="debug-info">
            <h3>📊 Información de Debug:</h3>
            <p><strong>Formaciones de prueba:</strong> <?php echo count($testFormations); ?></p>
            <p><strong>Swiper version:</strong> <span id="swiper-version">Cargando...</span></p>
        </div>
        
        <div class="formations-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($testFormations as $index => $formation): ?>
                    <div class="swiper-slide">
                        <div class="formation-card">
                            <img src="<?php echo $formation['formations'][0]['imageUrl']; ?>" alt="<?php echo $formation['edition']['editionName']; ?>">
                            <div class="formation-title"><?php echo $formation['edition']['editionName']; ?></div>
                            <div class="formation-code"><?php echo $formation['edition']['editionCode']; ?></div>
                            <div class="formation-dates">
                                Inicio: <?php echo formatDate($formation['edition']['startDate']); ?><br>
                                Fin: <?php echo formatDate($formation['edition']['endDate']); ?>
                            </div>
                            <div class="formation-price"><?php echo $formation['edition']['price']; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        
        <div class="debug-info">
            <h3>🔍 Debug del Swiper:</h3>
            <div id="debug-output">Inicializando...</div>
        </div>
        
        <p><a href="index.php">← Volver al sitio principal</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        console.log('🧪 Test de Swiper iniciando...');
        
        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar versión de Swiper
            if (typeof Swiper !== 'undefined') {
                document.getElementById('swiper-version').textContent = 'Swiper cargado ✅';
            } else {
                document.getElementById('swiper-version').textContent = 'Swiper NO cargado ❌';
                return;
            }
            
            // Contar slides
            const slides = document.querySelectorAll('.formations-swiper .swiper-slide');
            console.log(`📊 Slides encontradas: ${slides.length}`);
            
            // Inicializar Swiper - Configuración: 3 formaciones por vista
            const swiper = new Swiper('.formations-swiper', {
                slidesPerView: 3,
                spaceBetween: 25,
                centeredSlides: false,
                loop: slides.length > 3,
                
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                
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
                
                on: {
                    init: function() {
                        console.log('✅ Swiper inicializado correctamente');
                        updateDebugInfo(this);
                    },
                    slideChange: function() {
                        console.log(`🔄 Slide activa: ${this.activeIndex + 1}/${this.slides.length}`);
                        updateDebugInfo(this);
                    }
                }
            });
            
            function updateDebugInfo(swiperInstance) {
                const debugOutput = document.getElementById('debug-output');
                debugOutput.innerHTML = `
                    <p><strong>Estado del Swiper:</strong></p>
                    <ul>
                        <li>Total slides: ${swiperInstance.slides.length}</li>
                        <li>Slide activa: ${swiperInstance.activeIndex + 1}</li>
                        <li>Loop habilitado: ${swiperInstance.loopedSlides ? 'Sí' : 'No'}</li>
                        <li>Slides visibles: ${swiperInstance.slidesPerViewDynamic()}</li>
                    </ul>
                `;
            }
        });
    </script>
</body>
</html>
