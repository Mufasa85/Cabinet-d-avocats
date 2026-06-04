<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ELMD - Cabinet d'Avocats d'Excellence</title>
  <meta name="description" content="Cabinet d'avocats prestigieux offrant une expertise juridique d'excellence depuis 1985.">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
  <!-- Loader -->


  <!-- Navbar -->
  <nav id="navbar" class="navbar">
    <div class="navbar-container">
      <a href="#" class="navbar-logo">
        <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
          <circle cx="12" cy="3" r="1" fill="currentColor" />
          <path d="M7 21h10M9 21v-3h6v3" />
        </svg>
        <span class="logo-text">ELMD</span>
      </a>

      <!-- Desktop Menu -->
      <div class="navbar-links">
        <a href="#accueil" class="nav-link">Accueil</a>
        <a href="#cabinet" class="nav-link">Cabinet</a>
        <a href="#expertises" class="nav-link">Expertises</a>
        <a href="#equipe" class="nav-link">Équipe</a>

        <!-- Actualités Dropdown -->
        <div class="nav-item-dropdown">
          <a href="#" class="nav-link nav-dropdown-toggle">
            Actualités
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </a>
          <div class="nav-dropdown-menu">
            <a href="<?= Router\Router::route('/articles') ?>" class="nav-dropdown-item">Articles</a>
            <div class="nav-dropdown-divider"></div>
            <a href="<?= Router\Router::route('/publications') ?>" class="nav-dropdown-item">Publications</a>
          </div>
        </div>

        <a href="#contact" class="nav-link">Contact</a>
        <a href="<?= Router\Router::route('/stages') ?>" class="nav-link">Stages</a>
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="<?= Core\Auth::redirectUrlForDbRole(Core\Auth::role()) ?>" class="nav-link">Tableau de bord</a>
        <?php else: ?>
          <a href="<?= Router\Router::route('/login') ?>" class="nav-link nav-link-highlight">Connexion</a>
        <?php endif; ?>
      </div>

      <a href="#contact" class="navbar-cta">Consultation</a>

      <!-- Theme Switcher -->
      <div class="theme-switcher-wrapper">
        <button type="button" class="theme-btn" data-theme="default" title="Sombre">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
          </svg>
        </button>
        <button type="button" class="theme-btn" data-theme="light" title="Clair">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5" />
            <line x1="12" y1="1" x2="12" y2="3" />
            <line x1="12" y1="21" x2="12" y2="23" />
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
            <line x1="1" y1="12" x2="3" y2="12" />
            <line x1="21" y1="12" x2="23" y2="12" />
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
          </svg>
        </button>
        <button type="button" class="theme-btn" data-theme="royal" title="Royal">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 4l3 12h14l3-12-6 7-4-7-4 7-6-7z" />
            <path d="M5 16v4h14v-4" />
            <path d="M12 4v2" />
          </svg>
        </button>
      </div>

      <!-- Mobile Menu Button -->
      <button id="mobile-menu-btn" class="mobile-menu-btn" aria-label="Menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
      </button>
    </div>
  </nav>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="mobile-menu">
    <div class="mobile-menu-bg-circle mobile-menu-bg-circle-1"></div>
    <div class="mobile-menu-bg-circle mobile-menu-bg-circle-2"></div>
    <div class="mobile-menu-content">
      <div class="mobile-menu-header">
        <div class="navbar-logo">
          <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
            <circle cx="12" cy="3" r="1" fill="currentColor" />
            <path d="M7 21h10M9 21v-3h6v3" />
          </svg>
          <span class="logo-text">ELMD</span>
        </div>
        <button id="mobile-menu-close" class="mobile-menu-close" aria-label="Fermer">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6L6 18M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="mobile-menu-links">
        <a href="#accueil" class="mobile-link">
          <span>Accueil</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="#cabinet" class="mobile-link">
          <span>Le Cabinet</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="#expertises" class="mobile-link">
          <span>Expertises</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="#equipe" class="mobile-link">
          <span>Équipe</span>
          <span class="mobile-link-arrow">→</span>
        </a>

        <!-- Mobile Actualités Dropdown -->
        <div class="mobile-dropdown">
          <button type="button" class="mobile-dropdown-toggle">
            <span>Actualités</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </button>
          <div class="mobile-dropdown-content">
            <a href="<?= Router\Router::route('/articles') ?>" class="mobile-dropdown-item">Articles</a>
            <a href="<?= Router\Router::route('/publications') ?>" class="mobile-dropdown-item">Publications</a>
          </div>
        </div>

        <a href="#contact" class="mobile-link">
          <span>Contact</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="<?= Router\Router::route('/stages') ?>" class="mobile-link">
          <span>Stages</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="<?= Router\Router::route('/login') ?>" class="mobile-link">
          <span>Connexion</span>
          <span class="mobile-link-arrow">→</span>
        </a>
      </div>
      <div class="mobile-menu-footer">
        <a href="#contact" class="btn-premium mobile-cta">Prendre Rendez-vous</a>
      </div>
    </div>
  </div>

  <!-- Hero Section -->
  <section id="accueil" class="hero">
    <div class="hero-slider">
      <div class="hero-slide active" data-slide="0">
        <div class="hero-slide-bg" style="background-image: url('/assets/images/fond_1.jpeg')"></div>
        <div class="hero-slide-overlay"></div>
        <div class="hero-slide-content">
          <span class="hero-subtitle">Excellence Juridique</span>
          <h1 class="hero-title">L'Art du Droit<br>au Service de<br>Votre Réussite</h1>
          <p class="hero-description">Une expertise juridique d'exception pour défendre vos intérêts avec rigueur et détermination.</p>
          <div class="hero-buttons">
            <a href="#contact" class="btn-premium">Nous Consulter</a>
            <a href="#expertises" class="btn-outline">Nos Expertises</a>
          </div>
        </div>
      </div>
      <div class="hero-slide" data-slide="1">
        <div class="hero-slide-bg" style="background-image: url('/assets/images/fond_2.jpeg')"></div>
        <div class="hero-slide-overlay"></div>
        <div class="hero-slide-content">
          <span class="hero-subtitle">Tradition & Innovation</span>
          <h1 class="hero-title">40 Ans<br>d'Excellence<br>Juridique</h1>
          <p class="hero-description">Un cabinet fondé sur des valeurs d'intégrité, de rigueur et d'engagement envers nos clients.</p>
          <div class="hero-buttons">
            <a href="#cabinet" class="btn-premium">Notre Histoire</a>
            <a href="#equipe" class="btn-outline">Notre Équipe</a>
          </div>
        </div>
      </div>
      <div class="hero-slide" data-slide="2">
        <div class="hero-slide-bg" style="background-image: url('/assets/images/fond_3.jpeg')"></div>
        <div class="hero-slide-overlay"></div>
        <div class="hero-slide-content">
          <span class="hero-subtitle">Rayonnement International</span>
          <h1 class="hero-title">Une Présence<br>Mondiale au<br>Service du Droit</h1>
          <p class="hero-description">Des bureaux stratégiquement situés pour accompagner vos projets à l'international.</p>
          <div class="hero-buttons">
            <a href="#contact" class="btn-premium">Nous Contacter</a>
            <a href="#actualites" class="btn-outline">Actualités</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Slider Controls -->
    <div class="hero-controls">
      <button class="hero-control-btn hero-prev" aria-label="Précédent">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M15 18l-6-6 6-6" />
        </svg>
      </button>
      <div class="hero-dots">
        <button class="hero-dot active" data-slide="0"></button>
        <button class="hero-dot" data-slide="1"></button>
        <button class="hero-dot" data-slide="2"></button>
      </div>
      <button class="hero-control-btn hero-next" aria-label="Suivant">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M9 18l6-6-6-6" />
        </svg>
      </button>
    </div>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
      <div class="scroll-mouse">
        <div class="scroll-wheel"></div>
      </div>
      <span>Découvrir</span>
    </div>

    <!-- Gold Particles -->
    <div id="particles" class="particles"></div>
  </section>

  <!-- About Section -->
  <section id="cabinet" class="section about-section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-subtitle">Notre Cabinet</span>
        <h2 class="section-title">Une Institution<br>Juridique d'Exception</h2>
        <div class="section-line"></div>
      </div>

      <div class="about-grid">
        <div class="about-content animate-on-scroll">
          <p class="about-text">
            Créée en 2007 par le Bâtonnier Laurent Mbako Ditend, « Étude Laurent Mbako/Cabinet d’Avocats » (ELMD) est située au n°448 de l’avenue Maduda (6ème Avenue), dans la commune de Dilala à Kolwezi, Province du Lualaba en République Démocratique du Congo. </p>
          <p class="about-text">
            Étude Laurent Mbako/Cabinet d’Avocats a pour mission de représenter, d’assister, de postuler, de conseiller, de concilier de conclure et de plaider pour le compte de ses clients ainsi que d’émettre les avis juridiques dans toutes les branches de Droit et le Due Diligent. </p>
          <p class="about-text">
            A ce jour, ELMD/Cabinet d’Avocats connait une redynamisation liée essentiellement à l’évolution du Droit dans plusieurs domaines qui, d’office, la remet à un standard professionnel avisé. ELMD/Cabinet d’avocats est constituée de plusieurs Avocats dont onze Avocats seniors collaborateurs qui assurent la conduite d’une spécialité du Droit lorsque les questions idoines sont posées et deux Avocats collaborateurs en période de stage qui assurent l’appui nécessaire en étude, consultance, rédaction des actes de procédure, de correspondances aux Avocats seniors pour un résultat approprié dans chaque branche du Droit. </p>
        </div>

        <div class="about-image animate-on-scroll">
          <div class="themes-showcase">
            <div class="theme-item" data-theme-default>
              <img src="/assets/images/sombre.png" alt="Thème Sombre">
            </div>
            <div class="theme-item" data-theme-light>
              <img src="/assets/images/claire.png" alt="Thème Clair">
            </div>
            <div class="theme-item" data-theme-royal>
              <img src="/assets/images/royal.png" alt="Thème Royal">
            </div>
          </div>
          <div class="about-image-overlay"></div>
          <div class="about-image-frame"></div>
        </div>
      </div>

      <!-- Features Slider -->
      <div class="features-section">
        <div class="features-slider" id="features-slider">
          <div class="feature-card animate-on-scroll">
            <div class="feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              </svg>
            </div>
            <h3 class="feature-title">Intégrité</h3>
            <p class="feature-text">Une éthique irréprochable au cœur de chaque dossier</p>
          </div>
          <div class="feature-card animate-on-scroll">
            <div class="feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
              </svg>
            </div>
            <h3 class="feature-title">Excellence</h3>
            <p class="feature-text">La recherche constante de la perfection juridique</p>
          </div>
          <div class="feature-card animate-on-scroll">
            <div class="feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <line x1="2" y1="12" x2="22" y2="12" />
                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
              </svg>
            </div>
            <h3 class="feature-title">International</h3>
            <p class="feature-text">Un réseau mondial pour vos ambitions globales</p>
          </div>
          <div class="feature-card animate-on-scroll">
            <div class="feature-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              </svg>
            </div>
            <h3 class="feature-title">Proximité</h3>
            <p class="feature-text">Une relation de confiance privilégiée avec chaque client</p>
          </div>
        </div>

        <!-- Slider Navigation -->
        <div class="slider-nav features-nav">
          <button class="slider-btn slider-prev" data-slider="features">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M15 18l-6-6 6-6" />
            </svg>
          </button>
          <div class="slider-dots" id="features-dots"></div>
          <button class="slider-btn slider-next" data-slider="features">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M9 18l6-6-6-6" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="stats-section">
    <div class="stats-bg" style="background-image: url('/assets/images/logo.png')"></div>
    <div class="stats-overlay"></div>
    <div class="container stats-container">
      <div class="stat-item animate-on-scroll">
        <span class="stat-number" data-target="40">0</span>
        <span class="stat-suffix">+</span>
        <span class="stat-label">Années d'Excellence</span>
      </div>
      <div class="stat-item animate-on-scroll">
        <span class="stat-number" data-target="2500">0</span>
        <span class="stat-suffix">+</span>
        <span class="stat-label">Dossiers Traités</span>
      </div>
      <div class="stat-item animate-on-scroll">
        <span class="stat-number" data-target="98">0</span>
        <span class="stat-suffix">%</span>
        <span class="stat-label">Clients Satisfaits</span>
      </div>
      <div class="stat-item animate-on-scroll">
        <span class="stat-number" data-target="15">0</span>
        <span class="stat-suffix"></span>
        <span class="stat-label">Bureaux Internationaux</span>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="expertises" class="section services-section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-subtitle">Nos Expertises</span>
        <h2 class="section-title">Domaines<br>d'Excellence</h2>
        <div class="section-line"></div>
      </div>

      <div class="services-slider" id="services-slider">
        <div class="service-card animate-on-scroll">
          <div class="service-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
              <circle cx="12" cy="3" r="1" fill="currentColor" />
              <path d="M7 21h10M9 21v-3h6v3" />
            </svg>
          </div>
          <h3 class="service-title">Droit Ohada</h3>
          <p class="service-text">Expertise en droit OHADA pour les entreprises opérant dans les États parties, garantissant conformité et sécurité juridique.</p>
          <a href="<?= Router\Router::route('/droit-ohada') ?>" class="service-link">
            <span>En savoir plus</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
        </div>

        <div class="service-card animate-on-scroll">
          <div class="service-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
              <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
              <line x1="12" y1="22.08" x2="12" y2="12" />
            </svg>
          </div>
          <h3 class="service-title">Droit Minier</h3>
          <p class="service-text">Accompagnement spécialisé dans l'exploration, l'exploitation et la gestion des ressources minières et minérales.</p>
          <a href="<?= Router\Router::route('/droit-minier') ?>" class="service-link">
            <span>En savoir plus</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
        </div>

        <div class="service-card animate-on-scroll">
          <div class="service-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
              <circle cx="9" cy="7" r="4" />
              <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
          </div>
          <h3 class="service-title">Droit Travail</h3>
          <p class="service-text">Conseil et défense en droit du travail pour employeurs et salariés, gestion des conflits et négociation collective.</p>
          <a href="<?= Router\Router::route('/droit-travail') ?>" class="service-link">
            <span>En savoir plus</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
        </div>

        <div class="service-card animate-on-scroll">
          <div class="service-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="12" y1="1" x2="12" y2="23" />
              <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
            </svg>
          </div>
          <h3 class="service-title">Droit Fiscal</h3>
          <p class="service-text">Optimisation fiscale, conseil en structuration et représentation devant les administrations fiscales.</p>
          <a href="<?= Router\Router::route('/droit-fiscal') ?>" class="service-link">
            <span>En savoir plus</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
        </div>

        <div class="service-card animate-on-scroll">
          <div class="service-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
              <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
            </svg>
          </div>
          <h3 class="service-title">Administration des Affaires</h3>
          <p class="service-text">Gestion administrative, gouvernance d'entreprise et conformité réglementaire pour les sociétés.</p>
          <a href="<?= Router\Router::route('/administration-affaires') ?>" class="service-link">
            <span>En savoir plus</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
        </div>

        <div class="service-card animate-on-scroll">
          <div class="service-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              <path d="M9 12l2 2 4-4" />
            </svg>
          </div>
          <h3 class="service-title">Autres Domaines de Droits</h3>
          <p class="service-text">Large palette de compétences juridiques pour répondre à tous vos besoins spécifiques et cas particuliers.</p>
          <a href="<?= Router\Router::route('/autres-domaines') ?>" class="service-link">
            <span>En savoir plus</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
          </a>
        </div>
      </div>

      <!-- Slider Navigation -->
      <div class="slider-nav services-nav">
        <button class="slider-btn slider-prev" data-slider="services">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6" />
          </svg>
        </button>
        <div class="slider-dots" id="services-dots"></div>
        <button class="slider-btn slider-next" data-slider="services">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18l6-6-6-6" />
          </svg>
        </button>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section id="equipe" class="section team-section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-subtitle">Notre Équipe</span>
        <h2 class="section-title">Avocats<br>d'Excellence</h2>
        <div class="section-line"></div>
      </div>

      <div class="team-slider" id="team-slider">
        <?php if (!empty($avocats)): ?>
          <?php foreach ($avocats as $avocat): ?>
            <div class="team-card animate-on-scroll">
              <a href="<?= Router\Router::route('/avocat/' . ($avocat['avocat_id'] ?? $avocat['id'] ?? '')) ?>" class="team-card-link">
                <div class="team-image">
                  <img src="<?= $avatarSrc = $avocat['avatar_url'] ?? ($avocat['avatar'] ? \Service\FileStorage::url($avocat['avatar']) : $defaultAvatar); ?>" alt="<?= htmlspecialchars($avocat['fullname'] ?? 'Avocat') ?>">
                  <div class="team-overlay">
                    <div class="team-social">
                      <a href="mailto:<?= htmlspecialchars($avocat['email_professionnel'] ?? $avocat['email'] ?? '') ?>" class="social-link" aria-label="Email">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                          <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                          <polyline points="22,6 12,13 2,6" />
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="team-info">
                  <h3 class="team-name"><?= htmlspecialchars($avocat['fullname'] ?? ($avocat['titre'] ?? 'Avocat')) ?></h3>
                  <p class="team-role"><?= htmlspecialchars($avocat['titre'] ?? 'Avocat') ?></p>
                  <?php if (!empty($avocat['specialites'])): ?>
                    <p class="team-specialty"><?= htmlspecialchars($avocat['specialites']) ?></p>
                  <?php endif; ?>
                  <a href="<?= Router\Router::route('/avocat/' . ($avocat['avocat_id'] ?? $avocat['id'] ?? '')) ?>" class="team-profile-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                      <circle cx="12" cy="7" r="4" />
                    </svg>
                    Voir le profil
                  </a>
                </div>
              </a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p style="text-align:center;padding:2rem;color:#666;">Aucun avocat disponible pour le moment.</p>
        <?php endif; ?>
      </div>

      <!-- Slider Navigation -->
      <div class="slider-nav team-nav">
        <button class="slider-btn slider-prev" data-slider="team">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6" />
          </svg>
        </button>
        <div class="slider-dots" id="team-dots"></div>
        <button class="slider-btn slider-next" data-slider="team">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18l6-6-6-6" />
          </svg>
        </button>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="section testimonials-section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-subtitle">Témoignages</span>
        <h2 class="section-title">La Parole<br>à Nos Clients</h2>
        <div class="section-line"></div>
      </div>

      <div class="testimonials-slider" id="testimonials-slider">
        <div class="testimonial-card active" data-testimonial="0">
          <div class="testimonial-quote">"</div>
          <p class="testimonial-text">Le cabinet ELMD a su défendre nos intérêts avec une expertise remarquable. Leur approche stratégique et leur disponibilité ont fait toute la différence dans notre restructuration.</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar">
              <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=100&q=80" alt="Pierre Moreau">
            </div>
            <div class="testimonial-info">
              <h4 class="testimonial-name">Pierre Moreau</h4>
              <p class="testimonial-role">PDG, Groupe Moreau Industries</p>
            </div>
          </div>
        </div>

        <div class="testimonial-card" data-testimonial="1">
          <div class="testimonial-quote">"</div>
          <p class="testimonial-text">Une équipe d'une compétence exceptionnelle. Leur connaissance approfondie du droit fiscal international nous a permis d'optimiser notre expansion européenne.</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar">
              <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=100&q=80" alt="Claire Dubois">
            </div>
            <div class="testimonial-info">
              <h4 class="testimonial-name">Claire Dubois</h4>
              <p class="testimonial-role">Directrice Financière, TechVision SA</p>
            </div>
          </div>
        </div>

        <div class="testimonial-card" data-testimonial="2">
          <div class="testimonial-quote">"</div>
          <p class="testimonial-text">Professionnalisme, réactivité et résultats. Le cabinet ELMD a dépassé toutes nos attentes dans la gestion de notre contentieux commercial.</p>
          <div class="testimonial-author">
            <div class="testimonial-avatar">
              <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=100&q=80" alt="Marc Lefebvre">
            </div>
            <div class="testimonial-info">
              <h4 class="testimonial-name">Marc Lefebvre</h4>
              <p class="testimonial-role">Fondateur, Lefebvre & Associés</p>
            </div>
          </div>
        </div>
      </div>

      <div class="testimonials-nav">
        <button class="testimonial-btn testimonial-prev" aria-label="Précédent">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6" />
          </svg>
        </button>
        <div class="testimonial-dots">
          <button class="testimonial-dot active" data-testimonial="0"></button>
          <button class="testimonial-dot" data-testimonial="1"></button>
          <button class="testimonial-dot" data-testimonial="2"></button>
        </div>
        <button class="testimonial-btn testimonial-next" aria-label="Suivant">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18l6-6-6-6" />
          </svg>
        </button>
      </div>
    </div>
  </section>

  <!-- News Section -->
  <section id="actualites" class="section news-section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-subtitle">Actualités</span>
        <h2 class="section-title">Publications<br>& Événements</h2>
        <div class="section-line"></div>
      </div>

      <div class="news-slider" id="news-slider">
        <?php if (!empty($publications)): ?>
          <?php foreach ($publications as $pub): ?>
            <?php
            // Déterminer la catégorie selon le type
            $typeLabels = [
              'brochure' => 'Publication',
              'etude_cas' => 'Étude de cas',
              'distinction' => 'Distinction',
              'autre' => 'Article',
            ];
            $category = $typeLabels[$pub['type']] ?? 'Article';

            // Image de couverture ou image par défaut selon le type
            $defaultImages = [
              'brochure' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=600&q=80',
              'etude_cas' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=600&q=80',
              'distinction' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80',
              'autre' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=600&q=80',
            ];
            $imageUrl = !empty($pub['image_couverture'])
              ? \Service\FileStorage::url($pub['image_couverture'])
              : ($defaultImages[$pub['type']] ?? $defaultImages['autre']);

            // Date formatée
            $pubDate = !empty($pub['publie_le'])
              ? date('d F Y', strtotime($pub['publie_le']))
              : date('d F Y', strtotime($pub['created_at'] ?? 'now'));
            ?>
            <article class="news-card animate-on-scroll">
              <div class="news-image">
                <img src="<?= htmlspecialchars($imageUrl) ?>" alt="<?= htmlspecialchars($pub['titre'] ?? 'Publication') ?>">
                <span class="news-category"><?= htmlspecialchars($category) ?></span>
              </div>
              <div class="news-content">
                <time class="news-date"><?= htmlspecialchars($pubDate) ?></time>
                <h3 class="news-title"><?= htmlspecialchars($pub['titre'] ?? 'Sans titre') ?></h3>
                <p class="news-excerpt"><?= htmlspecialchars($pub['description'] ?? '') ?></p>
                <a href="<?= Router\Router::route('/articles/' . ($pub['id'] ?? '#')) ?>" class="news-link">Lire l'article</a>
              </div>
            </article>
          <?php endforeach; ?>
        <?php else: ?>
          <!-- Fallback si aucune publication -->
          <article class="news-card animate-on-scroll">
            <div class="news-image">
              <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=600&q=80" alt="Actualités ELMD">
              <span class="news-category">Publication</span>
            </div>
            <div class="news-content">
              <time class="news-date"><?= date('d F Y') ?></time>
              <h3 class="news-title">Bienvenue chez ELMD</h3>
              <p class="news-excerpt">Découvrez nos publications et événements juridiques.</p>
              <a href="<?= Router\Router::route('/publications') ?>" class="news-link">Voir les articles</a>
            </div>
          </article>
        <?php endif; ?>
      </div>

      <!-- Slider Navigation -->
      <div class="slider-nav news-nav">
        <button class="slider-btn slider-prev" data-slider="news">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M15 18l-6-6 6-6" />
          </svg>
        </button>
        <div class="slider-dots" id="news-dots"></div>
        <button class="slider-btn slider-next" data-slider="news">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 18l6-6-6-6" />
          </svg>
        </button>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="section contact-section">
    <div class="container">
      <div class="contact-grid">
        <div class="contact-info animate-on-scroll">
          <span class="section-subtitle">Contact</span>
          <h2 class="section-title">Prenons<br>Rendez-vous</h2>
          <div class="section-line"></div>
          <p class="contact-text">Notre équipe est à votre disposition pour étudier votre dossier et vous accompagner dans vos démarches juridiques.</p>

          <div class="contact-details">
            <div class="contact-item">
              <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
              </div>
              <div>
                <h4>Téléphone</h4>
                <p>+243 811 403 315</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                  <polyline points="22,6 12,13 2,6" />
                </svg>
              </div>
              <div>
                <h4>Email</h4>
                <p>laurentmbako@etudelmbako.com</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                  <circle cx="12" cy="10" r="3" />
                </svg>
              </div>
              <div>
                <h4>Adresse</h4>
                <p>448, Avenue Maduda, Quartier Biashara<br>Dilala, Kolwezi, Lualaba</p>
              </div>
            </div>
          </div>
        </div>

        <form class="contact-form animate-on-scroll" id="contact-form">
          <div class="form-row">
            <div class="form-group">
              <label for="name">Nom complet</label>
              <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="phone">Téléphone</label>
              <input type="tel" id="phone" name="phone">
            </div>
            <div class="form-group">
              <label for="subject">Sujet</label>
              <select id="subject" name="subject">
                <option value="">Sélectionnez un domaine</option>
                <option value="affaires">Droit des Affaires</option>
                <option value="fiscal">Droit Fiscal</option>
                <option value="international">Droit International</option>
                <option value="social">Droit Social</option>
                <option value="ip">Propriété Intellectuelle</option>
                <option value="immobilier">Droit Immobilier</option>
                <option value="autre">Autre</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn-premium form-submit">Envoyer votre message</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <a href="#" class="navbar-logo">
            <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
              <circle cx="12" cy="3" r="1" fill="currentColor" />
              <path d="M7 21h10M9 21v-3h6v3" />
            </svg>
            <span class="logo-text">ELMD</span>
          </a>
          <p class="footer-tagline">L'excellence juridique au service de votre réussite depuis 1985.</p>
          <div class="footer-social">
            <a href="#" class="social-link" aria-label="LinkedIn">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                <rect x="2" y="9" width="4" height="12" />
                <circle cx="4" cy="4" r="2" />
              </svg>
            </a>
            <a href="#" class="social-link" aria-label="Twitter">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
              </svg>
            </a>
          </div>
        </div>

        <div class="footer-links">
          <h4>Le Cabinet</h4>
          <ul>
            <li><a href="#cabinet">Notre Histoire</a></li>
            <li><a href="#equipe">Notre Équipe</a></li>
            <li><a href="#expertises">Nos Expertises</a></li>
            <li><a href="#actualites">Actualités</a></li>
          </ul>
        </div>

        <div class="footer-links">
          <h4>Expertises</h4>
          <ul>
            <li><a href="#expertises">Droit des Affaires</a></li>
            <li><a href="#expertises">Droit Fiscal</a></li>
            <li><a href="#expertises">Droit International</a></li>
            <li><a href="#expertises">Droit Social</a></li>
          </ul>
        </div>

        <div class="footer-links">
          <h4>Contact</h4>
          <ul>
            <li>448, Avenue Maduda</li>
            <li>Quartier Biashara, Dilala, Kolwezi, Lualaba</li>
            <li>+243 811 403 315</li>
            <li>laurentmbako@etudelmbako.com</li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2024 ELMD Avocats. Tous droits réservés.</p>
        <div class="footer-legal">
          <a href="#">Mentions légales</a>
          <a href="#">Politique de confidentialité</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script type="module" src="/js/theme.js"></script>
  <script type="module" src="/js/main.js"></script>
</body>

</html>