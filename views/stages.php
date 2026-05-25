<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programme de Stage | ELMD - Cabinet d'Avocats</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/stagiaires.css">
</head>
<body>
    <!-- Loader -->
    <div id="loader" class="loader">
        <div class="loader-content">
      <svg class="loader-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
        <circle cx="12" cy="3" r="1" fill="currentColor"/>
        <path d="M7 21h10M9 21v-3h6v3"/>
      </svg>
            <div class="loader-text">ELMD</div>
            <div class="loader-bar"><div class="loader-progress"></div></div>
        </div>
    </div>

    <!-- Navigation -->
    <header id="navbar" class="navbar">
        <div class="container">
            <a href="<?= Router\Router::route('/') ?>" class="logo">
                <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
                    <circle cx="12" cy="3" r="1" fill="currentColor"/>
                    <path d="M7 21h10M9 21v-3h6v3"/>
                </svg>
                <span class="logo-text">ELMD</span>
            </a>
            <nav class="nav-desktop">
                <a href="<?= Router\Router::route('/') ?>">Accueil</a>
                <a href="<?= Router\Router::route('/#about') ?>">Cabinet</a>
                <a href="<?= Router\Router::route('/#services') ?>">Expertises</a>
                <a href="#programme">Programme</a>
                <a href="#postuler">Postuler</a>
                <a href="<?= Router\Router::route('/login') ?>">Connexion</a>
            </nav>
            <a href="#postuler" class="btn-premium nav-cta">Candidater</a>
            <!-- Theme Switcher -->
            <div id="theme-switcher-container" class="theme-switcher-wrapper"></div>
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu">
        <div class="mobile-menu-header">
            <div class="logo">
      <svg class="loader-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
        <circle cx="12" cy="3" r="1" fill="currentColor"/>
        <path d="M7 21h10M9 21v-3h6v3"/>
      </svg>
                <span class="logo-text">ELMD</span>
            </div>
            <button class="mobile-close-btn" id="mobileCloseBtn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="mobile-nav">
            <a href="index.php">Accueil</a>
            <a href="index.php#about">Cabinet</a>
            <a href="index.php#services">Expertises</a>
            <a href="#programme">Programme</a>
            <a href="#postuler">Postuler</a>
            <a href="connexion.php">Connexion</a>
        </nav>
        <a href="#postuler" class="btn-premium mobile-cta">Candidater Maintenant</a>
    </div>

    <!-- Hero Section -->
    <section class="hero-stage">
        <div class="hero-bg">
            <div class="hero-gradient"></div>
            <div class="hero-pattern"></div>
            <div class="hero-particles" id="heroParticles"></div>
        </div>
        <div class="container hero-content">
            <div class="hero-badge animate-on-scroll">
                <span class="badge-icon">✦</span>
                <span>Programme de Stage 2024</span>
            </div>
            <h1 class="hero-title animate-on-scroll">
                <span class="title-line">Forgez Votre</span>
                <span class="title-line title-gold">Excellence Juridique</span>
            </h1>
            <p class="hero-description animate-on-scroll">
                Rejoignez l'un des cabinets les plus prestigieux et développez vos compétences 
                aux côtés d'experts reconnus du droit des affaires international.
            </p>
            <div class="hero-stats animate-on-scroll">
                <div class="hero-stat">
                    <span class="stat-number" data-count="50">0</span>
                    <span class="stat-label">Stagiaires formés</span>
                </div>
                <div class="hero-stat">
                    <span class="stat-number" data-count="10">0</span>
                    <span class="stat-label">Stagiaires cette année</span>
                </div>
            </div>
            <div class="hero-actions animate-on-scroll">
                <a href="#postuler" class="btn-premium btn-large">
                    <span>Déposer ma Candidature</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="#programme" class="btn-outline btn-large">
                    <span>Découvrir le Programme</span>
                </a>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="scroll-mouse">
                <div class="scroll-wheel"></div>
            </div>
            <span>Défiler</span>
        </div>
    </section>

    <!-- Programme Section -->
    <section id="programme" class="section-programme">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <span class="section-tag">Programme</span>
                <h2 class="section-title">Une Formation d'Excellence</h2>
                <p class="section-description">
                    Notre programme de stage offre une immersion complète dans la pratique 
                    du droit des affaires au sein d'un environnement stimulant et formateur.
                </p>
            </div>

            <div class="programme-grid">
                <!-- Card 1 -->
                <div class="programme-card animate-on-scroll" data-delay="0">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                    </div>
                    <h3 class="card-title">Formation Pratique</h3>
                    <p class="card-description">
                        Participation active aux dossiers réels sous la supervision d'avocats seniors. 
                        Rédaction d'actes, recherches juridiques approfondies et analyse de contentieux.
                    </p>
                    <ul class="card-features">
                        <li>Dossiers internationaux</li>
                        <li>Mentorat personnalisé</li>
                        <li>Formations hebdomadaires</li>
                    </ul>
                </div>

                <!-- Card 2 -->
                <div class="programme-card animate-on-scroll" data-delay="100">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>
                        </svg>
                    </div>
                    <h3 class="card-title">Développement Académique</h3>
                    <p class="card-description">
                        Accès à notre bibliothèque juridique et bases de données premium. 
                        Séminaires avec des experts et participation à des conférences.
                    </p>
                    <ul class="card-features">
                        <li>Bases de données Lexis/Westlaw</li>
                        <li>Séminaires exclusifs</li>
                        <li>Publications internes</li>
                    </ul>
                </div>

                <!-- Card 3 -->
                <div class="programme-card animate-on-scroll" data-delay="200">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <h3 class="card-title">Expérience Professionnelle</h3>
                    <p class="card-description">
                        Immersion dans un environnement corporate international. 
                        Networking avec des professionnels reconnus et opportunités de carrière.
                    </p>
                    <ul class="card-features">
                        <li>Réseau international</li>
                        <li>Événements networking</li>
                        <li>Opportunités d'embauche</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Conditions Section -->
    <section id="conditions" class="section-conditions">
        <div class="container">
            <div class="conditions-wrapper">
                <div class="conditions-content animate-on-scroll">
                    <span class="section-tag">Conditions</span>
                    <h2 class="section-title">Critères d'Éligibilité</h2>
                    <p class="section-description">
                        Pour garantir une expérience enrichissante, nous recherchons des candidats 
                        motivés répondant aux critères suivants.
                    </p>
                    
                    <div class="conditions-list">
                        <div class="condition-item">
                            <div class="condition-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="condition-content">
                                <h4>Niveau d'Études</h4>
                                <p>Master 1 ou Master 2 en Droit (Droit des affaires, Droit international, Droit fiscal)</p>
                            </div>
                        </div>
                        
                        <div class="condition-item">
                            <div class="condition-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="condition-content">
                                <h4>Compétences Linguistiques</h4>
                                <p>Français courant et anglais professionnel (TOEIC 850+ ou équivalent)</p>
                            </div>
                        </div>
                        
                        <div class="condition-item">
                            <div class="condition-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="condition-content">
                                <h4>Durée du Stage</h4>
                                <p>Minimum 3 mois, idéalement 6 mois pour une immersion complète</p>
                            </div>
                        </div>
                        
                        <div class="condition-item">
                            <div class="condition-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="condition-content">
                                <h4>Convention de Stage</h4>
                                <p>Convention tripartite obligatoire avec votre établissement</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="conditions-visual animate-on-scroll">
                    <div class="visual-card">
                        <div class="visual-header">
                            <span class="visual-tag">Gratification</span>
                            <h3>Avantages</h3>
                        </div>
                        <ul class="visual-list">
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Gratification légale + prime</span>
                            </li>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Horaires flexibles</span>
                            </li>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span>Bureaux premium Paris 8e</span>
                            </li>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                <span>Formation continue</span>
                            </li>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span>Événements networking</span>
                            </li>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                                <span>Certificat de stage</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Anciens Stagiaires Section -->
    <section id="places" class="section-places">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <span class="section-tag">Témoignages</span>
                <h2 class="section-title">Nos Derniers Stagiaires</h2>
                <p class="section-description">
                    Découvrez les jeunes talents qui ont contribué au cabinet cette année.
                </p>
            </div>

            <!-- Stagiaires Slider -->
            <div class="stagiaires-slider" id="stagiaires-slider">
                <!-- Stagiaire 1 -->
                <div class="stagiaire-card animate-on-scroll">
                    <a href="#" class="stagiaire-card-link">
                        <div class="stagiaire-image">
                            <img src="images/placeholder-user.jpg" alt="Jean Mukamba">
                            <div class="stagiaire-overlay">
                                <div class="stagiaire-social">
                                    <span class="social-link view-profile">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="stagiaire-info">
                            <h3 class="stagiaire-nom">Jean Mukamba</h3>
                            <p class="stagiaire-univ">Université de Kinshasa</p>
                            <span class="stagiaire-badge">Master II</span>
                        </div>
                    </a>
                </div>

                <!-- Stagiaire 2 -->
                <div class="stagiaire-card animate-on-scroll">
                    <a href="#" class="stagiaire-card-link">
                        <div class="stagiaire-image">
                            <img src="images/placeholder-user.jpg" alt="Aminata Ngalulu">
                            <div class="stagiaire-overlay">
                                <div class="stagiaire-social">
                                    <span class="social-link view-profile">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="stagiaire-info">
                            <h3 class="stagiaire-nom">Aminata Ngalulu</h3>
                            <p class="stagiaire-univ">Université Catholique</p>
                            <span class="stagiaire-badge">Master I</span>
                        </div>
                    </a>
                </div>

                <!-- Stagiaire 3 -->
                <div class="stagiaire-card animate-on-scroll">
                    <a href="#" class="stagiaire-card-link">
                        <div class="stagiaire-image">
                            <img src="images/placeholder-user.jpg" alt="Pierre Mbuyi">
                            <div class="stagiaire-overlay">
                                <div class="stagiaire-social">
                                    <span class="social-link view-profile">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="stagiaire-info">
                            <h3 class="stagiaire-nom">Pierre Mbuyi</h3>
                            <p class="stagiaire-univ">Université Protestante</p>
                            <span class="stagiaire-badge">Master II</span>
                        </div>
                    </a>
                </div>

                <!-- Stagiaire 4 -->
                <div class="stagiaire-card animate-on-scroll">
                    <a href="#" class="stagiaire-card-link">
                        <div class="stagiaire-image">
                            <img src="images/placeholder-user.jpg" alt="Marie Kabongo">
                            <div class="stagiaire-overlay">
                                <div class="stagiaire-social">
                                    <span class="social-link view-profile">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="stagiaire-info">
                            <h3 class="stagiaire-nom">Marie Kabongo</h3>
                            <p class="stagiaire-univ">Université de Lubumbashi</p>
                            <span class="stagiaire-badge">Master I</span>
                        </div>
                    </a>
                </div>

                <!-- Stagiaire 5 -->
                <div class="stagiaire-card animate-on-scroll">
                    <a href="#" class="stagiaire-card-link">
                        <div class="stagiaire-image">
                            <img src="images/placeholder-user.jpg" alt="David Tshilombo">
                            <div class="stagiaire-overlay">
                                <div class="stagiaire-social">
                                    <span class="social-link view-profile">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="stagiaire-info">
                            <h3 class="stagiaire-nom">David Tshilombo</h3>
                            <p class="stagiaire-univ">Université de Kinshasa</p>
                            <span class="stagiaire-badge">Master II</span>
                        </div>
                    </a>
                </div>

                <!-- Stagiaire 6 -->
                <div class="stagiaire-card animate-on-scroll">
                    <a href="#" class="stagiaire-card-link">
                        <div class="stagiaire-image">
                            <img src="images/placeholder-user.jpg" alt="Sophie Muteba">
                            <div class="stagiaire-overlay">
                                <div class="stagiaire-social">
                                    <span class="social-link view-profile">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="stagiaire-info">
                            <h3 class="stagiaire-nom">Sophie Muteba</h3>
                            <p class="stagiaire-univ">Université Catholique</p>
                            <span class="stagiaire-badge">Master I</span>
                        </div>
                    </a>
                </div>

                <!-- Stagiaire 7 -->
                <div class="stagiaire-card animate-on-scroll">
                    <a href="#" class="stagiaire-card-link">
                        <div class="stagiaire-image">
                            <img src="images/placeholder-user.jpg" alt="Marc Kalala">
                            <div class="stagiaire-overlay">
                                <div class="stagiaire-social">
                                    <span class="social-link view-profile">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="stagiaire-info">
                            <h3 class="stagiaire-nom">Marc Kalala</h3>
                            <p class="stagiaire-univ">Université de Goma</p>
                            <span class="stagiaire-badge">Master II</span>
                        </div>
                    </a>
                </div>

                <!-- Stagiaire 8 -->
                <div class="stagiaire-card animate-on-scroll">
                    <a href="#" class="stagiaire-card-link">
                        <div class="stagiaire-image">
                            <img src="images/placeholder-user.jpg" alt="Claire Mwape">
                            <div class="stagiaire-overlay">
                                <div class="stagiaire-social">
                                    <span class="social-link view-profile">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="stagiaire-info">
                            <h3 class="stagiaire-nom">Claire Mwape</h3>
                            <p class="stagiaire-univ">Université de Kinshasa</p>
                            <span class="stagiaire-badge">Master I</span>
                        </div>
                    </a>
                </div>

                <!-- Stagiaire 9 -->
                <div class="stagiaire-card animate-on-scroll">
                    <a href="#" class="stagiaire-card-link">
                        <div class="stagiaire-image">
                            <img src="images/placeholder-user.jpg" alt="Antoine Kabamba">
                            <div class="stagiaire-overlay">
                                <div class="stagiaire-social">
                                    <span class="social-link view-profile">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="stagiaire-info">
                            <h3 class="stagiaire-nom">Antoine Kabamba</h3>
                            <p class="stagiaire-univ">Université Protestante</p>
                            <span class="stagiaire-badge">Master II</span>
                        </div>
                    </a>
                </div>

                <!-- Stagiaire 10 -->
                <div class="stagiaire-card animate-on-scroll">
                    <a href="#" class="stagiaire-card-link">
                        <div class="stagiaire-image">
                            <img src="images/placeholder-user.jpg" alt="Grace Bwika">
                            <div class="stagiaire-overlay">
                                <div class="stagiaire-social">
                                    <span class="social-link view-profile">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="stagiaire-info">
                            <h3 class="stagiaire-nom">Grace Bwika</h3>
                            <p class="stagiaire-univ">Université de Lubumbashi</p>
                            <span class="stagiaire-badge">Master I</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Slider Navigation -->
            
        </div>
    </section>

    <!-- Instructions Section -->
    <section id="instructions" class="section-instructions">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <span class="section-tag">Instructions</span>
                <h2 class="section-title">Processus de Candidature</h2>
                <p class="section-description">
                    Suivez ces étapes pour soumettre votre candidature dans les meilleures conditions.
                </p>
            </div>

            <div class="timeline">
                <div class="timeline-item animate-on-scroll" data-delay="0">
                    <div class="timeline-number">01</div>
                    <div class="timeline-content">
                        <h3>Préparez vos Documents</h3>
                        <p>
                            Rassemblez votre CV, lettre de motivation et relevés de notes au format PDF. 
                            Assurez-vous que chaque fichier ne dépasse pas 5 Mo.
                        </p>
                    </div>
                </div>

                <div class="timeline-item animate-on-scroll" data-delay="100">
                    <div class="timeline-number">02</div>
                    <div class="timeline-content">
                        <h3>Complétez le Formulaire</h3>
                        <p>
                            Remplissez soigneusement tous les champs obligatoires du formulaire de candidature. 
                            Votre lettre de motivation doit être personnalisée.
                        </p>
                    </div>
                </div>

                <div class="timeline-item animate-on-scroll" data-delay="200">
                    <div class="timeline-number">03</div>
                    <div class="timeline-content">
                        <h3>Téléversez vos Fichiers</h3>
                        <p>
                            Utilisez la zone de dépôt pour téléverser vos documents. 
                            Seuls les fichiers PDF sont acceptés pour garantir la lisibilité.
                        </p>
                    </div>
                </div>

                <div class="timeline-item animate-on-scroll" data-delay="300">
                    <div class="timeline-number">04</div>
                    <div class="timeline-content">
                        <h3>Validation & Confirmation</h3>
                        <p>
                            Après soumission, vous recevrez un email de confirmation. 
                            Notre équipe RH vous contactera sous 15 jours ouvrés.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Form Section -->
    <section id="postuler" class="section-application">
        <div class="container">
            <div class="application-wrapper">
                <div class="application-info animate-on-scroll">
                    <span class="section-tag">Candidature</span>
                    <h2 class="section-title">Déposez votre Dossier</h2>
                    <p class="section-description">
                        Complétez le formulaire ci-dessous pour soumettre votre candidature. 
                        Tous les champs marqués d'un astérisque (*) sont obligatoires.
                    </p>
                    
                    <div class="info-cards">
                        <div class="info-card">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <div>
                                <h4>Format PDF uniquement</h4>
                                <p>Tous les documents doivent être au format PDF</p>
                            </div>
                        </div>
                        <div class="info-card">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                            </svg>
                            <div>
                                <h4>Taille maximale 5 Mo</h4>
                                <p>Chaque fichier ne doit pas dépasser 5 Mo</p>
                            </div>
                        </div>
                        <div class="info-card">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <div>
                                <h4>Données sécurisées</h4>
                                <p>Vos informations sont traitées confidentiellement</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="application-form-wrapper animate-on-scroll">
                    <form id="applicationForm" class="application-form" method="post" action="<?= htmlspecialchars($applyUrl ?? Router\Router::route('/stages/candidature')) ?>" enctype="multipart/form-data">
                        <?= $csrf ?? '' ?>
                        <!-- Personal Info Section -->
                        <div class="form-section">
                            <h3 class="form-section-title">
                                <span class="section-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </span>
                                Informations Personnelles
                            </h3>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="fullName">Nom complet *</label>
                                    <input type="text" id="fullName" name="fullName" required placeholder="Jean Dupont">
                                    <span class="form-error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" id="email" name="email" required placeholder="jean.dupont@email.com">
                                    <span class="form-error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="phone">Téléphone *</label>
                                    <input type="tel" id="phone" name="phone" required placeholder="+33 6 12 34 56 78">
                                    <span class="form-error"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Info Section -->
                        <div class="form-section">
                            <h3 class="form-section-title">
                                <span class="section-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                        <path d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                                    </svg>
                                </span>
                                Parcours Académique
                            </h3>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="university">Université / École *</label>
                                    <input type="text" id="university" name="university" required placeholder="Université Paris 1 Panthéon-Sorbonne">
                                    <span class="form-error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="field">Filière *</label>
                                    <select id="field" name="field" required>
                                        <option value="">Sélectionnez votre filière</option>
                                        <option value="droit-affaires">Droit des Affaires</option>
                                        <option value="droit-international">Droit International</option>
                                        <option value="droit-fiscal">Droit Fiscal</option>
                                        <option value="droit-prive">Droit Privé</option>
                                        <option value="droit-public">Droit Public</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                    <span class="form-error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="level">Niveau d'étude *</label>
                                    <select id="level" name="level" required>
                                        <option value="">Sélectionnez votre niveau</option>
                                        <option value="m1">Master 1</option>
                                        <option value="m2">Master 2</option>
                                        <option value="doctorat">Doctorat</option>
                                    </select>
                                    <span class="form-error"></span>
                                </div>

                            </div>
                        </div>

                        <div class="form-section">
                            <h3 class="form-section-title">Lettre de motivation</h3>
                            <div class="form-group">
                                <label for="motivation">Motivation *</label>
                                <textarea id="motivation" name="motivation" rows="5" required placeholder="Expliquez votre motivation pour rejoindre le cabinet..."></textarea>
                            </div>
                        </div>

                        <!-- Documents Upload Section -->
                        <div class="form-section">
                            <h3 class="form-section-title">
                                <span class="section-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </span>
                                Documents à Fournir
                            </h3>
                            
                            <div class="upload-grid">
                                <!-- CV Upload -->
                                <div class="upload-zone" id="cvUpload" data-type="cv">
                                    <div class="upload-content">
                                        <div class="upload-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <h4>Curriculum Vitae *</h4>
                                        <p>Glissez-déposez ou <span class="upload-link">parcourez</span></p>
                                        <span class="upload-hint">PDF uniquement, max 5 Mo</span>
                                    </div>
                                    <div class="upload-preview" style="display: none;">
                                        <div class="preview-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="preview-info">
                                            <span class="preview-name"></span>
                                            <span class="preview-size"></span>
                                        </div>
                                        <button type="button" class="preview-remove">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="upload-progress" style="display: none;">
                                        <div class="progress-bar"><div class="progress-fill"></div></div>
                                        <span class="progress-text">0%</span>
                                    </div>
                                    <input type="file" id="cvFile" name="cvFile" accept=".pdf" required>
                                </div>

                                <!-- Cover Letter Upload -->
                                <div class="upload-zone" id="letterUpload" data-type="letter">
                                    <div class="upload-content">
                                        <div class="upload-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <h4>Lettre de Motivation *</h4>
                                        <p>Glissez-déposez ou <span class="upload-link">parcourez</span></p>
                                        <span class="upload-hint">PDF uniquement, max 5 Mo</span>
                                    </div>
                                    <div class="upload-preview" style="display: none;">
                                        <div class="preview-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="preview-info">
                                            <span class="preview-name"></span>
                                            <span class="preview-size"></span>
                                        </div>
                                        <button type="button" class="preview-remove">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="upload-progress" style="display: none;">
                                        <div class="progress-bar"><div class="progress-fill"></div></div>
                                        <span class="progress-text">0%</span>
                                    </div>
                                    <input type="file" id="letterFile" name="letterFile" accept=".pdf" required>
                                </div>

                                <!-- Academic Documents Upload -->
                                <div class="upload-zone" id="academicUpload" data-type="academic">
                                    <div class="upload-content">
                                        <div class="upload-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <h4>Documents Académiques *</h4>
                                        <p>Glissez-déposez ou <span class="upload-link">parcourez</span></p>
                                        <span class="upload-hint">Relevés de notes, diplômes (PDF, max 5 Mo)</span>
                                    </div>
                                    <div class="upload-preview" style="display: none;">
                                        <div class="preview-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="preview-info">
                                            <span class="preview-name"></span>
                                            <span class="preview-size"></span>
                                        </div>
                                        <button type="button" class="preview-remove">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="upload-progress" style="display: none;">
                                        <div class="progress-bar"><div class="progress-fill"></div></div>
                                        <span class="progress-text">0%</span>
                                    </div>
                                    <input type="file" id="academicFile" name="academicFile" accept=".pdf" required>
                                </div>
                            </div>
                        </div>

                        <!-- Consent & Submit -->
                        <div class="form-section">
                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" id="consent" name="consent" required>
                                    <span class="checkbox-custom"></span>
                                    <span class="checkbox-text">
                                        J'accepte que mes données personnelles soient traitées conformément à la 
                                        <a href="#" class="link-gold">politique de confidentialité</a> du cabinet. *
                                    </span>
                                </label>
                            </div>

                            <button type="submit" class="btn-submit" id="submitBtn">
                                <span class="btn-text">Envoyer ma Candidature</span>
                                <span class="btn-loader">
                                    <svg class="spinner" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" fill="none" stroke-dasharray="32" stroke-linecap="round"/>
                                    </svg>
                                </span>
                                <span class="btn-success">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                        <path d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-backdrop"></div>
        <div class="modal-content">
            <div class="modal-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3>Candidature Envoyée !</h3>
            <p>
                Votre dossier a été transmis avec succès à notre équipe RH. 
                Vous recevrez un email de confirmation dans les prochaines minutes.
            </p>
            <p class="modal-note">
                Notre équipe examinera votre candidature et vous contactera sous 15 jours ouvrés.
            </p>
            <button class="btn-premium" id="closeModal">Fermer</button>
        </div>
    </div>

    <!-- Error Toast -->
    <div id="errorToast" class="toast toast-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span class="toast-message"></span>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-main">
                <div class="footer-brand">
                    <div class="logo">
                        <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
                            <circle cx="12" cy="3" r="1" fill="currentColor"/>
                            <path d="M7 21h10M9 21v-3h6v3"/>
                        </svg>
                        <span class="logo-text">ELMD & ASSOCIÉS</span>
                    </div>
                    <p>Cabinet d'avocats d'affaires internationales, reconnu pour son excellence et son engagement envers ses clients depuis 1985.</p>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Navigation</h4>
                        <a href="index.php">Accueil</a>
                        <a href="index.php#about">Cabinet</a>
                        <a href="index.php#services">Expertises</a>
                        <a href="index.php#contact">Contact</a>
                    </div>
                    <div class="footer-column">
                        <h4>Stage</h4>
                        <a href="#programme">Programme</a>
                        <a href="#conditions">Conditions</a>
                        <a href="#places">Places</a>
                        <a href="#postuler">Postuler</a>
                    </div>
                    <div class="footer-column">
                        <h4>Contact</h4>
                        <p>448, Avenue Maduda</p>
                        <p>Quartier Biashara, Dilala, Kolwezi, Lualaba</p>
                        <p>+243 811 403 315</p>
                        <p>laurentmbako@etudelmbako.com</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 ELMD & Associés. Tous droits réservés.</p>
                <div class="footer-legal">
                    <a href="#">Mentions légales</a>
                    <a href="#">Politique de confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

    <script type="module" src="js/theme.js"></script>
    <script type="module" src="js/stagiaires.js"></script>
</body>
</html>
