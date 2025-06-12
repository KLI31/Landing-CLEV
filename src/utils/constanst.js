import Facebook from "../icons/Facebook.astro";
import Instagram from "../icons/Instagram.astro";
import LinkedIn from "../icons/LinkedIn.astro";
import Tiktok from "../icons/Tiktok.astro";
import Youtube from "../icons/Youtube.astro";

export const SITE_TITLE = "Corporacion CLEV";
export const SITE_DESCRIPTION =
  "Corporación Latinoamericana de Educación Virtual (CLEV) - Líder en educación virtual y capacitación empresarial en Latinoamérica. Ofrecemos cursos, diplomados y programas de formación online de alta calidad.";

export const TESTIMONIALS = [
  {
    id: 1,
    name: "Carlos Rodríguez",
    role: "Director, InnovateCorp",
    videoUrl:
      "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4",
    thumbnail:
      "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&h=300&fit=crop&crop=face",
    quote:
      "Increíble servicio al cliente y una solución que realmente funciona. Altamente recomendado.",
  },
  {
    id: 2,
    name: "Ana López",
    role: "Fundadora, CreativeStudio",
    videoUrl:
      "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4",
    thumbnail:
      "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=300&h=300&fit=crop&crop=face",
    quote:
      "La mejor inversión que hemos hecho. Nuestro ROI se triplicó en los primeros 6 meses.",
  },
  {
    id: 3,
    name: "David Martín",
    role: "CTO, DataFlow",
    videoUrl:
      "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4",
    thumbnail:
      "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&h=300&fit=crop&crop=face",
    quote:
      "Implementación sencilla y resultados inmediatos. Exactamente lo que necesitábamos.",
  },
  {
    id: 4,
    name: "David Martín",
    role: "CTO, DataFlow",
    videoUrl:
      "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4",
    thumbnail:
      "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&h=300&fit=crop&crop=face",
    quote:
      "Implementación sencilla y resultados inmediatos. Exactamente lo que necesitábamos.",
  },
  {
    id: 5,
    name: "David Martín",
    role: "CTO, DataFlow",
    videoUrl:
      "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4",
    thumbnail:
      "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&h=300&fit=crop&crop=face",
    quote:
      "Implementación sencilla y resultados inmediatos. Exactamente lo que necesitábamos.",
  },
  {
    id: 6,
    name: "David Martín",
    role: "CTO, DataFlow",
    videoUrl:
      "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4",
    thumbnail:
      "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&h=300&fit=crop&crop=face",
    quote:
      "Implementación sencilla y resultados inmediatos. Exactamente lo que necesitábamos.",
  },
];

export const SOCIAL_LINKS = [
  {
    name: "Facebook",
    url: "https://www.facebook.com/EducacionVirtualCLEV",
    icon: Facebook,
  },
  {
    name: "Instagram",
    url: "https://www.instagram.com/educacionvirtuallatam/",
    icon: Instagram,
  },
  {
    name: "Youtube",
    url: "https://www.youtube.com/@educacionvirtuallatam",
    icon: Youtube,
  },
  {
    name: "LinkedIn",
    url: "https://www.linkedin.com/company/corporaci%C3%B3n-latinoamericana-de-educaci%C3%B3n-virtual/",
    icon: LinkedIn,
  },
  {
    name: "TikTok",
    url: "https://www.tiktok.com/@corporacionclev",
    icon: Tiktok,
  },
];

export const FORMATIONS = [
  {
    id: "1",
    editionId: "ed1",
    formationId: "f1",
    formation: {
      id: "f1",
      name: "Desarrollo Full Stack",
      description: "Aprende desarrollo web desde cero hasta avanzado",
      duration: "6 meses",
      image:
        "https://corporacionclev.com/wp-content/uploads/2025/01/investigacion.jpeg",
    },
    startDate: "2024-04-01",
    endDate: "2024-09-30",
  },
  {
    id: "2",
    editionId: "ed1",
    formationId: "f2",
    formation: {
      id: "f2",
      name: "Data Science",
      description: "Master en análisis de datos y machine learning",
      duration: "8 meses",
      image:
        "https://corporacionclev.com/wp-content/uploads/2025/01/investigacion.jpeg",
    },
    startDate: "2024-05-01",
    endDate: "2024-12-31",
  },
  {
    id: "3",
    editionId: "ed2",
    formationId: "f3",
    formation: {
      id: "f3",
      name: "Marketing Digital",
      description: "Estrategias de marketing en la era digital",
      duration: "4 meses",
      image:
        "https://corporacionclev.com/wp-content/uploads/2025/01/investigacion.jpeg",
    },
    startDate: "2024-06-01",
    endDate: "2024-09-30",
  },
  {
    id: "4",
    editionId: "ed2",
    formationId: "f4",
    formation: {
      id: "f4",
      name: "UX/UI Design",
      description: "Diseño de experiencias de usuario modernas",
      duration: "5 meses",
      image:
        "https://corporacionclev.com/wp-content/uploads/2025/01/investigacion.jpeg",
    },
    startDate: "2024-07-01",
    endDate: "2024-11-30",
  },
  {
    id: "5",
    editionId: "ed3",
    formationId: "f5",
    formation: {
      id: "f5",
      name: "DevOps",
      description: "Automatización y gestión de infraestructura",
      duration: "6 meses",
      image:
        "https://corporacionclev.com/wp-content/uploads/2025/01/investigacion.jpeg",
    },
    startDate: "2024-08-01",
    endDate: "2025-01-31",
  },
  {
    id: "6",
    editionId: "ed3",
    formationId: "f6",
    formation: {
      id: "f6",
      name: "Inteligencia Artificial",
      description: "Fundamentos y aplicaciones de IA",
      duration: "7 meses",
      image:
        "https://corporacionclev.com/wp-content/uploads/2025/01/investigacion.jpeg",
    },
    startDate: "2024-09-01",
    endDate: "2025-03-31",
  },
  {
    id: "7",
    editionId: "ed4",
    formationId: "f7",
    formation: {
      id: "f7",
      name: "Desarrollo de Aplicaciones Móviles",
      description: "Desarrollo de aplicaciones móviles nativas y híbridas",
      duration: "5 meses",
      image:
        "https://corporacionclev.com/wp-content/uploads/2025/01/investigacion.jpeg",
    },
    startDate: "2024-10-01",
    endDate: "2025-02-28",
  },
  {
    id: "8",
    editionId: "ed4",
    formationId: "f8",
    formation: {
      id: "f8",
      name: "Desarrollo de Aplicaciones Móviles",
      description: "Desarrollo de aplicaciones móviles nativas y híbridas",
      duration: "5 meses",
      image:
        "https://corporacionclev.com/wp-content/uploads/2025/01/investigacion.jpeg",
    },
    startDate: "2024-10-01",
    endDate: "2025-02-28",
  },
  {
    id: "9",
    editionId: "ed4",
    formationId: "f9",
    formation: {
      id: "f9",
      name: "Desarrollo de Aplicaciones Móviles",
      description: "Desarrollo de aplicaciones móviles nativas y híbridas",
      duration: "5 meses",
      image:
        "https://corporacionclev.com/wp-content/uploads/2025/01/investigacion.jpeg",
    },
    startDate: "2024-10-01",
    endDate: "2025-02-28",
  },
  {
    id: "10",
    editionId: "ed4",
    formationId: "f10",
    formation: {
      id: "f10",
      name: "Desarrollo de Aplicaciones Móviles",
      description: "Desarrollo de aplicaciones móviles nativas y híbridas",
      duration: "5 meses",
      image:
        "https://corporacionclev.com/wp-content/uploads/2025/01/investigacion.jpeg",
    },
    startDate: "2024-10-01",
    endDate: "2025-02-28",
  },
  {
    id: "11",
    editionId: "ed4",
    formationId: "f11",
    formation: {
      id: "f11",
      name: "Desarrollo de Aplicaciones Móviles",
      description: "Desarrollo de aplicaciones móviles nativas y híbridas",
      duration: "5 meses",
      image:
        "https://corporacionclev.com/wp-content/uploads/2025/01/investigacion.jpeg",
    },
    startDate: "2024-10-01",
    endDate: "2025-02-28",
  },
  {
    id: "12",
    editionId: "ed4",
    formationId: "f12",
    formation: {
      id: "f12",
      name: "Desarrollo de Aplicaciones Móviles",
      description: "Desarrollo de aplicaciones móviles nativas y híbridas",
      duration: "5 meses",
      image:
        "https://corporacionclev.com/wp-content/uploads/2025/01/investigacion.jpeg",
    },
    startDate: "2024-10-01",
    endDate: "2025-02-28",
  },
];
