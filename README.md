# CLEV Landing - PHP Version

Este es el landing page de la Corporación Latinoamericana de Educación Virtual (CLEV) convertido de Astro a PHP para despliegue en CPanel.

## Características

- ✅ **Diseño responsivo** con el mismo aspecto visual que el proyecto original
- ✅ **Formaciones dinámicas** obtenidas desde la API de CLEV
- ✅ **Testimoniales interactivos** con videos modales
- ✅ **Navegación social** con enlaces a redes sociales
- ✅ **Animaciones suaves** usando GSAP
- ✅ **Carruseles** con Swiper
- ✅ **Cache inteligente** para mejorar rendimiento
- ✅ **Compatible con CPanel** hosting

## Estructura de Archivos

```
├── index.php                 # Página principal
├── includes/
│   ├── config.php            # Configuración y constantes
│   └── functions.php         # Funciones PHP para APIs
├── components/
│   ├── main-content.php      # Contenido principal
│   ├── header-section.php    # Componente de encabezado
│   ├── formations-section.php # Sección de formaciones
│   ├── formations-carousel.php # Carrusel de formaciones
│   ├── testimonials-section.php # Sección de testimoniales
│   └── bottom-nav.php        # Navegación social
├── assets/
│   ├── css/
│   │   └── styles.css        # Estilos compilados
│   ├── js/
│   │   └── app.js           # JavaScript principal
│   ├── fonts/               # Fuentes Gilroy
│   ├── images/              # Imágenes del sitio
│   └── favicon.svg          # Icono del sitio
└── cache/                   # Cache de APIs (se crea automáticamente)
```

## Instalación en CPanel

### 1. Subir archivos

1. **Comprimir** todos los archivos del proyecto en un archivo ZIP
2. **Acceder** a tu cuenta de CPanel
3. **Abrir** el File Manager
4. **Navegar** a la carpeta `public_html` (o la carpeta de tu dominio)
5. **Subir** el archivo ZIP
6. **Extraer** todos los archivos

### 2. Configurar permisos

Asegúrate de que los siguientes directorios tengan permisos de escritura (755 o 777):

```bash
chmod 755 cache/
chmod 755 includes/
```

### 3. Verificar PHP

- Asegúrate de que tu hosting tenga **PHP 7.4 o superior**
- Verifica que las funciones `file_get_contents()` y `json_decode()` estén habilitadas
- Asegúrate de que `allow_url_fopen` esté habilitado para las llamadas a la API

### 4. Configurar dominio

- El archivo `index.php` debe estar en la raíz de tu dominio
- Accede a tu sitio desde `https://tudominio.com`

## APIs Utilizadas

El sitio consume las siguientes APIs de CLEV:

- **Enrollments**: `https://api.corporacionclev.com/kayros/api/v1/enrollments/`
- **Detalles**: `https://plutus.corporacionclev.com/api/enrollments/{id}/details`

### Cache

- Los datos de las APIs se cachean por **5 minutos** para mejorar el rendimiento
- El cache se almacena en el directorio `/cache/`
- Se actualiza automáticamente cuando expira

## Librerías Externas

El proyecto utiliza CDN para las siguientes librerías:

- **GSAP** (3.13.0): Animaciones
- **Swiper** (11.x): Carruseles
- **Fuentes**: Gilroy incluidas localmente

## Personalización

### Modificar configuración

Edita el archivo `includes/config.php` para:

- Cambiar títulos y descripciones
- Modificar testimoniales
- Actualizar enlaces de redes sociales
- Ajustar tiempo de cache

### Cambiar estilos

Los estilos están en `assets/css/styles.css`. Incluye:

- Variables CSS de colores CLEV
- Estilos responsivos
- Animaciones personalizadas
- Compatibilidad con Swiper

### Modificar JavaScript

El archivo `assets/js/app.js` contiene:

- Inicialización de Swiper
- Manejo de modales de video
- Animaciones GSAP
- Eventos de interacción

## Mantenimiento

### Logs de errores

- Los errores se registran en el log de PHP del servidor
- Revisa regularmente los logs para detectar problemas con las APIs

### Actualizar cache

Para forzar la actualización del cache:

1. Elimina el archivo `cache/enrollments.json`
2. Recarga la página

### Backup

Haz backup regular de:

- Todos los archivos PHP
- Directorio de assets
- Configuración personalizada

## Soporte

Para problemas técnicos:

1. Verifica los logs de error de PHP
2. Confirma que las APIs de CLEV estén funcionando
3. Revisa que los permisos de archivos sean correctos
4. Verifica la conectividad del servidor con las APIs externas

## Diferencias con la versión original

- **Sin build process**: No requiere Node.js ni build tools
- **CDN para librerías**: GSAP y Swiper se cargan desde CDN
- **Cache PHP**: Sistema de cache nativo en PHP
- **Iconos en PHP**: SVGs generados mediante funciones PHP
- **Estilos compilados**: CSS pre-compilado incluido

El diseño y funcionalidad son **idénticos** al proyecto original en Astro.