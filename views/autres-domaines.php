<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ELMD - Autres Domaines de Droits</title>
  <meta name="description" content="Cabinet ELMD - Expertise en Droit pénal, civil et de la famille">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
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
  <nav id="navbar" class="navbar">
    <div class="navbar-container">
      <a href="<?= Router\Router::route('/') ?>"" class="navbar-logo">
        <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
          <circle cx="12" cy="3" r="1" fill="currentColor"/>
          <path d="M7 21h10M9 21v-3h6v3"/>
        </svg>
        <span class="logo-text">ELMD</span>
      </a>
      <div class="navbar-links">
        <a href="<?= Router\Router::route('/') ?>"#accueil" class="nav-link">Accueil</a>
        <a href="<?= Router\Router::route('/') ?>"#cabinet" class="nav-link">Le Cabinet</a>
        <a href="<?= Router\Router::route('/') ?>"#expertises" class="nav-link">Expertises</a>
        <a href="<?= Router\Router::route('/') ?>"#equipe" class="nav-link">Équipe</a>
        <a href="<?= Router\Router::route('/') ?>"#actualites" class="nav-link">Actualités</a>
        <a href="<?= Router\Router::route('/') ?>"#contact" class="nav-link">Contact</a>
      </div>
      <a href="<?= Router\Router::route('/') ?>"#contact" class="navbar-cta">Consultation</a>
      <div id="theme-switcher-container" class="theme-switcher-wrapper"></div>
      <button id="mobile-menu-btn" class="mobile-menu-btn" aria-label="Menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
      </button>
    </div>
  </nav>
  <div id="mobile-menu" class="mobile-menu">
    <div class="mobile-menu-bg-circle mobile-menu-bg-circle-1"></div>
    <div class="mobile-menu-bg-circle mobile-menu-bg-circle-2"></div>
    <div class="mobile-menu-content">
      <div class="mobile-menu-header">
        <div class="navbar-logo">
          <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
            <circle cx="12" cy="3" r="1" fill="currentColor"/>
            <path d="M7 21h10M9 21v-3h6v3"/>
          </svg>
          <span class="logo-text">ELMD</span>
        </div>
        <button id="mobile-menu-close" class="mobile-menu-close" aria-label="Fermer">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
      </div>
      <div class="mobile-menu-links">
        <a href="<?= Router\Router::route('/') ?>"#accueil" class="mobile-link"><span>Accueil</span><span class="mobile-link-arrow">→</span></a>
        <a href="<?= Router\Router::route('/') ?>"#cabinet" class="mobile-link"><span>Le Cabinet</span><span class="mobile-link-arrow">→</span></a>
        <a href="<?= Router\Router::route('/') ?>"#expertises" class="mobile-link"><span>Expertises</span><span class="mobile-link-arrow">→</span></a>
        <a href="<?= Router\Router::route('/') ?>"#equipe" class="mobile-link"><span>Équipe</span><span class="mobile-link-arrow">→</span></a>
        <a href="<?= Router\Router::route('/') ?>"#actualites" class="mobile-link"><span>Actualités</span><span class="mobile-link-arrow">→</span></a>
        <a href="<?= Router\Router::route('/') ?>"#contact" class="mobile-link"><span>Contact</span><span class="mobile-link-arrow">→</span></a>
      </div>
      <div class="mobile-menu-footer">
        <a href="<?= Router\Router::route('/') ?>"#contact" class="btn-premium mobile-cta">Prendre Rendez-vous</a>
      </div>
    </div>
  </div>

  <section class="domain-hero">
    <div class="domain-hero-bg"></div>
    <div class="domain-hero-overlay"></div>
    <div class="domain-hero-content">
      <span class="domain-subtitle">Expertise Juridique</span>
      <h1 class="domain-title">Autres Domaines de Droits</h1>
      <p class="domain-description">Droit pénal, civil et de la famille</p>
    </div>
  </section>

  <section class="section domain-content-section">
    <div class="container">
      <div class="domain-intro animate-on-scroll">
        <p class="domain-intro-text">
          Le cabinet ELMD assure conseil, assistance et représentation dans l'ensemble des litiges et procédures relevant du droit civil congolais, tant en phase précontentieuse que contentieuse.
        </p>
        <p class="domain-intro-text">
          Il intervient à tous les stades de la procédure pénale, pour la défense des intérêts des prévenus, victimes et parties civiles.
        </p>
        <p class="domain-intro-text">
          Le cabinet ELMD intervient également dans les litiges fonciers et dans les contentieux relevant du droit de la famille en RDC.
        </p>
      </div>

      <div class="domain-grid">
        <div class="domain-card animate-on-scroll">
          <div class="domain-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
          </div>
          <h3 class="domain-card-title">Droit pénal</h3>
          <p class="domain-card-description">Le Droit pénal est une matière exigeante qui touche directement à la liberté, à la responsabilité et à la protection des droits fondamentaux. Il requiert une parfaite maîtrise des règles procédurales et des infractions applicables, mais également une analyse globale de chaque situation afin d'anticiper les conséquences humaines, sociales et professionnelles des décisions prises. Cette matière implique un accompagnement rigoureux aussi bien en prévention qu'en défense des intérêts des personnes concernées.</p>
          <ul class="domain-card-list">
            <li>Défense des prévenus</li>
            <li>Représentation des victimes</li>
            <li>Partie civile</li>
          </ul>
        </div>

        <div class="domain-card animate-on-scroll">
          <div class="domain-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
              <line x1="3" y1="9" x2="21" y2="9"/>
              <line x1="9" y1="21" x2="9" y2="9"/>
            </svg>
          </div>
          <h3 class="domain-card-title">Droit civil</h3>
          <p class="domain-card-description">Le Droit civil constitue le socle des relations entre les personnes et encadre les droits et obligations de chacun dans la vie quotidienne. Il nécessite une connaissance approfondie des règles juridiques applicables ainsi qu'une approche stratégique permettant de préserver les intérêts personnels et patrimoniaux des parties. Cette matière demande une attention particulière aux conséquences juridiques et économiques des engagements pris.</p>
          <ul class="domain-card-list">
            <li>Phase précontentieuse</li>
            <li>Phase contentieuse</li>
            <li>Litiges et procédures</li>
          </ul>
        </div>

        <div class="domain-card animate-on-scroll">
          <div class="domain-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </div>
          <h3 class="domain-card-title">Droit de la famille</h3>
          <p class="domain-card-description">Le Droit de la famille est une matière profondément humaine. Elle nécessite non seulement une solide connaissance des règles techniques applicables mais également une vision globale de la situation, afin de s'attacher aux répercussions indirectes, notamment à l'égard des proches. Cette matière implique une attention particulière sur les conséquences fiscales et patrimoniales de la prise de décision plus particulièrement lors d'une séparation.</p>
          <ul class="domain-card-list">
            <li>Mariage et divorce</li>
            <li>Filiation et adoption</li>
            <li>Successions</li>
          </ul>
        </div>

        <div class="domain-card animate-on-scroll">
          <div class="domain-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
          </div>
          <h3 class="domain-card-title">Droit foncier</h3>
          <p class="domain-card-description">Le Droit foncier est une matière essentielle qui organise les rapports liés à la propriété, à l'occupation et à l'exploitation des biens immobiliers. Il exige une maîtrise des règles administratives, cadastrales et contractuelles afin de sécuriser les droits des propriétaires et des investisseurs. Cette matière implique une vigilance particulière sur les conséquences patrimoniales, économiques et successorales des décisions relatives au foncier.</p>
          <ul class="domain-card-list">
            <li>Litiges fonciers</li>
            <li>Propriété et possession</li>
            <li>Bornage et servitude</li>
          </ul>
        </div>

        <div class="domain-card animate-on-scroll">
          <div class="domain-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
              <path d="M12 8v4M12 16h.01"/>
            </svg>
          </div>
          <h3 class="domain-card-title">Droit de l'environnement</h3>
          <p class="domain-card-description">Notre équipe d'avocats et juristes bénéficie d'une sérieuse expérience dans les domaines du droit de l'aménagement et du droit de l'environnement. Le Cabinet accompagne ainsi de nombreux acteurs publics et aménageurs dans leurs projets, tant en région parisienne que sur l'ensemble du territoire national. Il intervient à toutes les étapes des procédures environnementales imposées par le code de l'environnement et le code de l'urbanisme.</p>
          <ul class="domain-card-list">
            <li>Élaboration de calendriers procéduraux</li>
            <li>Suivi des procédures de concertation</li>
            <li>Évaluation environnementale</li>
            <li>Sécurisation des enquêtes publiques</li>
            <li>Procédures d'autorisation environnementale</li>
          </ul>
        </div>

        <div class="domain-card animate-on-scroll">
          <div class="domain-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <path d="M12 6v6l4 2"/>
            </svg>
          </div>
          <h3 class="domain-card-title">Régimes matrimoniaux</h3>
          <p class="domain-card-description">Les Régimes matrimoniaux encadrent les relations patrimoniales entre époux tout au long de leur vie commune et lors de sa dissolution. Cette matière nécessite une connaissance approfondie des mécanismes juridiques relatifs aux biens, aux dettes et à leur répartition, ainsi qu'une vision d'ensemble des intérêts familiaux et économiques. Elle requiert une attention particulière aux conséquences patrimoniales, successorales et fiscales des choix opérés par les époux.</p>
          <ul class="domain-card-list">
            <li>Contrat de mariage</li>
            <li>Communauté et séparation</li>
            <li>Liquidations</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="section domain-cta-section">
    <div class="container">
      <div class="domain-cta-content animate-on-scroll">
        <h2 class="domain-cta-title">Besoin d'un accompagnement juridique ?</h2>
        <p class="domain-cta-text">Notre équipe est disponible pour vous conseiller et vous accompagner.</p>
        <div class="domain-cta-buttons">
          <a href="<?= Router\Router::route('/') ?>"#contact" class="btn-premium">Nous Contacter</a>
          <a href="<?= Router\Router::route('/') ?>"#expertises" class="btn-outline">Autres Expertises</a>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <a href="<?= Router\Router::route('/') ?>"" class="navbar-logo">
            <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
              <circle cx="12" cy="3" r="1" fill="currentColor"/>
              <path d="M7 21h10M9 21v-3h6v3"/>
            </svg>
            <span class="logo-text">ELMD</span>
          </a>
          <p class="footer-tagline">Étude Laurent Mbako/Cabinet d'Avocats - Excellence juridique au service de vos intérêts.</p>
        </div>
        <div class="footer-links">
          <h4>Expertises</h4>
          <ul>
            <li><a href="<?= Router\Router::route('/droit-ohada') ?>">Droit OHADA</a></li>
            <li><a href="<?= Router\Router::route('/droit-minier') ?>">Droit Minier</a></li>
            <li><a href="<?= Router\Router::route('/droit-travail') ?>">Droit Travail</a></li>
            <li><a href="<?= Router\Router::route('/droit-fiscal') ?>">Droit Fiscal</a></li>
            <li><a href="<?= Router\Router::route('/administration-affaires') ?>">Administration des Affaires</a></li>
            <li><a href="<?= Router\Router::route('/autres-domaines') ?>">Autres Domaines</a></li>
          </ul>
        </div>
        <div class="footer-links">
          <h4>Contact</h4>
          <ul>
            <li>N°448, Avenue Maduda (6ème Avenue)</li>
            <li>Commune de Dilala, Kolwezi</li>
            <li>Province du Lualaba, RDC</li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2024 ELMD Avocats. Tous droits réservés.</p>
      </div>
    </div>
  </footer>

 <script type="module" src="js/theme.js"></script>
  <script type="module" src="js/main.js"></script>
</body>
</html>