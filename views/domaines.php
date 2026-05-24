<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Domaines d'Excellence - ELMD Cabinet d'Avocats</title>
  <meta name="description" content="Explorez nos domaines d'expertise juridique: Droit Ohada, Droit Minier, Droit du Travail, Administration des Affaires et Plus.">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Styles -->
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="css/domaines.css">
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
      <div class="loader-bar">
        <div class="loader-progress"></div>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <nav id="navbar" class="navbar">
    <div class="navbar-container">
      <a href="index.php" class="navbar-logo">
        <img src="logo.png" alt="ELMD" class="logo-icon">
        <span class="logo-text">ELMD</span>
      </a>
      
      <div class="navbar-links">
        <a href="index.php" class="nav-link">Accueil</a>
        <a href="index.php#cabinet" class="nav-link">Le Cabinet</a>
        <a href="domaines.php" class="nav-link">Expertises</a>
        <a href="index.php#equipe" class="nav-link">Équipe</a>
        <a href="index.php#actualites" class="nav-link">Actualités</a>
        <a href="index.php#contact" class="nav-link">Contact</a>
      </div>
      
      <a href="index.php#contact" class="navbar-cta">Consultation</a>
      
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
        <a href="index.php" class="navbar-logo">
          <img src="logo.png" alt="ELMD" class="logo-icon">
          <span class="logo-text">ELMD</span>
        </a>
        <button id="mobile-menu-close" class="mobile-menu-close" aria-label="Fermer">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6L6 18M6 6l12 12"/>
          </svg>
        </button>
      </div>
      <div class="mobile-menu-links">
        <a href="index.php" class="mobile-link">
          <span>Accueil</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="index.php#cabinet" class="mobile-link">
          <span>Le Cabinet</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="domaines.php" class="mobile-link">
          <span>Expertises</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="index.php#equipe" class="mobile-link">
          <span>Équipe</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="index.php#actualites" class="mobile-link">
          <span>Actualités</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="index.php#contact" class="mobile-link">
          <span>Contact</span>
          <span class="mobile-link-arrow">→</span>
        </a>
      </div>
      <div class="mobile-menu-footer">
        <a href="index.php#contact" class="btn-premium mobile-cta">Prendre Rendez-vous</a>
      </div>
    </div>
  </div>

  <!-- Hero Section -->
  <section class="domaines-hero">
    <div class="domaines-hero-content container">
      <span class="section-subtitle">Nos Domaines d'Expertise</span>
      <h1 class="section-title">Une Excellence<br>Juridique Complète</h1>
      <div class="section-line"></div>
      <p style="max-width: 600px; margin: 1.5rem auto 0; color: var(--color-muted-foreground);">
        Découvrez l'étendue de notre expertise juridique pour accompagner vos projets en République Démocratique du Congo et en Afrique.
      </p>
    </div>
  </section>

  <!-- Domaines Content -->
  <section class="section">
    <div class="container">
      <div class="domaines-grid-nav">
        <a href="#ohada" class="domaine-nav-card">
          <div class="domaine-nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
              <circle cx="12" cy="3" r="1" fill="currentColor"/>
              <path d="M7 21h10M9 21v-3h6v3"/>
            </svg>
          </div>
          <h3 class="domaine-nav-title">Droit Ohada</h3>
          <p class="domaine-nav-desc">Expertise en droit des affaires</p>
        </a>
        
        <a href="#minier" class="domaine-nav-card">
          <div class="domaine-nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
              <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
              <line x1="12" y1="22.08" x2="12" y2="12"/>
            </svg>
          </div>
          <h3 class="domaine-nav-title">Droit Minier</h3>
          <p class="domaine-nav-desc">Ressources naturelles & mines</p>
        </a>
        
        <a href="#travail" class="domaine-nav-card">
          <div class="domaine-nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </div>
          <h3 class="domaine-nav-title">Droit du Travail</h3>
          <p class="domaine-nav-desc">Relations sociales & emploi</p>
        </a>
        
        <a href="#affaires" class="domaine-nav-card">
          <div class="domaine-nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
              <line x1="3" y1="9" x2="21" y2="9"/>
              <line x1="9" y1="21" x2="9" y2="9"/>
            </svg>
          </div>
          <h3 class="domaine-nav-title">Administration des Affaires</h3>
          <p class="domaine-nav-desc">Droit administratif & sociétés</p>
        </a>
        
        <a href="#autres" class="domaine-nav-card">
          <div class="domaine-nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <line x1="12" y1="8" x2="12" y2="16"/>
              <line x1="8" y1="12" x2="16" y2="12"/>
            </svg>
          </div>
          <h3 class="domaine-nav-title">Autres Domaines</h3>
          <p class="domaine-nav-desc">Pénal, civil, fiscal & plus</p>
        </a>
      </div>
    </div>
  </section>

  <!-- Sticky Navigation -->
  <div class="sticky-nav">
    <div class="container">
      <div class="sticky-nav-content">
        <a href="#ohada" class="sticky-nav-link">Droit Ohada</a>
        <a href="#minier" class="sticky-nav-link">Droit Minier</a>
        <a href="#travail" class="sticky-nav-link">Droit du Travail</a>
        <a href="#affaires" class="sticky-nav-link">Administration des Affaires</a>
        <a href="#autres" class="sticky-nav-link">Autres Domaines</a>
      </div>
    </div>
  </div>

  <!-- Droit Ohada Section -->
  <section id="ohada" class="domaine-section">
    <div class="container">
      <div class="domaine-header animate-on-scroll">
        <div class="domaine-icon-large">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
            <circle cx="12" cy="3" r="1" fill="currentColor"/>
            <path d="M7 21h10M9 21v-3h6v3"/>
          </svg>
        </div>
        <div>
          <h2 class="domaine-title">Droit Ohada</h2>
          <p class="domaine-subtitle">Expertise en Droit OHADA & Droit des affaires en RDC</p>
        </div>
      </div>
      
      <div class="domaine-content">
        <div class="animate-on-scroll">
          <p class="domaine-text">
            Le Cabinet d'Avocats Étude Laurent MBAKO accompagne les entreprises, investisseurs et entrepreneurs dans l'ensemble des problématiques liées au droit OHADA, applicable en République Démocratique du Congo.
          </p>
          
          <div class="domaine-cta">
            <a href="index.php#contact" class="btn-premium">Demander une Consultation</a>
            <a href="#minier" class="btn-outline">Suivant →</a>
          </div>
        </div>
        
        <div class="domaine-list animate-on-scroll">
          <h4>Domaines d'intervention</h4>
          <ul>
            <li>
              <strong>Droit des sociétés OHADA</strong>
              <ul class="sub-list">
                <li>Création et structuration des sociétés (SARL, SA, SAS...)</li>
                <li>Gouvernance, restructuration et dissolution</li>
                <li>Secrétariat juridique et conformité OHADA</li>
              </ul>
            </li>
            <li>
              <strong>Droit commercial général</strong>
              <ul class="sub-list">
                <li>Actes de commerce et statut du commerçant</li>
                <li>Fond de commerce et baux commerciaux</li>
                <li>Immatriculation au RCCM</li>
              </ul>
            </li>
            <li>
              <strong>Contrat et sécurisation juridique</strong>
              <ul class="sub-list">
                <li>Rédaction et audit de contrats commerciaux</li>
                <li>Garanties et sûretés OHADA</li>
                <li>Prévention des risques juridiques</li>
              </ul>
            </li>
            <li>
              <strong>Procédures collectives</strong>
              <ul class="sub-list">
                <li>Règlement préventif</li>
                <li>Redressement judiciaire</li>
                <li>Liquidation des biens</li>
              </ul>
            </li>
            <li>
              <strong>Contentieux et règlement des litiges</strong>
              <ul class="sub-list">
                <li>Contentieux commercial OHADA</li>
                <li>Arbitrage et médiation (CCJA et juridictions nationales)</li>
                <li>Exécution des décisions et sentences arbitrales</li>
              </ul>
            </li>
            <li>
              <strong>Conseil aux investisseurs</strong>
              <ul class="sub-list">
                <li>Accompagnement des investissements en RDC</li>
                <li>Sécurisation juridique des projets</li>
                <li>Due diligence juridique</li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Droit Minier Section -->
  <section id="minier" class="domaine-section">
    <div class="container">
      <div class="domaine-header animate-on-scroll">
        <div class="domaine-icon-large">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
            <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
            <line x1="12" y1="22.08" x2="12" y2="12"/>
          </svg>
        </div>
        <div>
          <h2 class="domaine-title">Droit Minier</h2>
          <p class="domaine-subtitle">Expertise en secteur minier et ressources naturelles</p>
        </div>
      </div>
      
      <div class="domaine-content">
        <div class="animate-on-scroll">
          <p class="domaine-text">
            Le cabinet ELMD assiste les entreprises et les investisseurs dans le traitement des problématiques juridiques relatives au secteur des mines et des ressources naturelles en Afrique (forêts, agro-foncier, eau, environnement…). Il traite également différentes problématiques juridiques liées au secteur de l'énergie en Afrique.
          </p>
          
          <p class="domaine-text" style="margin-top: 1.5rem;">
            Le cabinet ELMD intervient dans la gestion des droits et titres miniers ainsi que dans l'analyse et l'élaboration des contrats miniers. Il accompagne aussi bien les États africains dans l'élaboration des législations et des réglementations minières, que les entreprises et les investisseurs dans la réalisation de leurs projets miniers en R.D. Congo et en Afrique.
          </p>
          
          <div class="highlight-box">
            <h4>Nos Prestations Incluent</h4>
            <p class="domaine-text">
              Les opérations de due diligence juridique et fiscale et les grandes phases des opérations minières. Accompagnement complet de vos projets miniers de la phase d'exploration jusqu'à l'exploitation.
            </p>
          </div>
          
          <div class="domaine-cta">
            <a href="index.php#contact" class="btn-premium">Demander une Consultation</a>
            <a href="#travail" class="btn-outline">Suivant →</a>
          </div>
        </div>
        
        <div class="domaine-list animate-on-scroll">
          <h4>Domaines d'intervention</h4>
          <ul>
            <li>Gestion des droits et titres miniers</li>
            <li>Analyse et élaboration des contrats miniers</li>
            <li>Accompagnement des investisseurs</li>
            <li>Conseil aux États africains</li>
            <li>Élaboration de législations minières</li>
            <li>Due diligence juridique et fiscale</li>
            <li>Secteur de l'énergie en Afrique</li>
            <li>Ressources naturelles (forêts, agro-foncier, eau)</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Droit du Travail Section -->
  <section id="travail" class="domaine-section">
    <div class="container">
      <div class="domaine-header animate-on-scroll">
        <div class="domaine-icon-large">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </div>
        <div>
          <h2 class="domaine-title">Droit du Travail</h2>
          <p class="domaine-subtitle">Relations sociales et droit de l'emploi</p>
        </div>
      </div>
      
      <div class="domaine-content">
        <div class="animate-on-scroll">
          <p class="domaine-text">
            Le droit du travail est une matière très vivante qui est, à tort ou à raison, victime d'une forte inflation législative. D'un côté, tous les dirigeants d'entreprises doivent maîtriser l'entretien d'embauche, la rédaction des contrats de travail, les domaines et limites de leurs pouvoirs et autorités hiérarchique et disciplinaire.
          </p>
          
          <p class="domaine-text" style="margin-top: 1.5rem;">
            D'un autre côté, tous les salariés doivent franchir les étapes professionnelles du recrutement, de la négociation du contrat de travail dans ses clauses les plus spécifiques, patrimoniales et extra-patrimoniales, jusqu'à la rupture de leur relation conventionnelle par exemple par démission ou licenciement.
          </p>
          
          <div class="highlight-box">
            <h4>Pourquoi Faire Appel à un Avocat ?</h4>
            <p class="domaine-text">
              Pour les dirigeants de petites ou de moyennes entreprises, comme pour les salariés, la connaissance ou l'application de l'ensemble des dispositions du Code du travail relève de l'illusion tant le législateur a complexifié et multiplié les textes. Faire le choix d'un Avocat vous permettra de cerner les risques qui peuvent vous menacer ou encore de faire face à un contentieux imminent.
            </p>
          </div>
          
          <div class="domaine-cta">
            <a href="index.php#contact" class="btn-premium">Demander une Consultation</a>
            <a href="#affaires" class="btn-outline">Suivant →</a>
          </div>
        </div>
        
        <div class="domaine-list animate-on-scroll">
          <h4>Domaines d'intervention</h4>
          <ul>
            <li>
              <strong>Pour les employeurs</strong>
              <ul class="sub-list">
                <li>Entretiens d'embauche</li>
                <li>Rédaction des contrats de travail</li>
                <li>Pouvoirs et autorités disciplinaires</li>
                <li>Gestion des relations sociales</li>
              </ul>
            </li>
            <li>
              <strong>Pour les salariés</strong>
              <ul class="sub-list">
                <li>Négociation contractuelle</li>
                <li>Clauses patrimoniales et extra-patrimoniales</li>
                <li>Rupture conventionnelle</li>
                <li>Démission et licenciement</li>
              </ul>
            </li>
            <li>
              <strong>Contentieux</strong>
              <ul class="sub-list">
                <li>Gestion des litiges sociaux</li>
                <li>Négociation collective</li>
                <li>Représentation devant les juridictions</li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Administration des Affaires Section -->
  <section id="affaires" class="domaine-section">
    <div class="container">
      <div class="domaine-header animate-on-scroll">
        <div class="domaine-icon-large">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
            <line x1="3" y1="9" x2="21" y2="9"/>
            <line x1="9" y1="21" x2="9" y2="9"/>
          </svg>
        </div>
        <div>
          <h2 class="domaine-title">Administration des Affaires</h2>
          <p class="domaine-subtitle">Droit administratif et des sociétés</p>
        </div>
      </div>
      
      <div class="domaine-content">
        <div class="animate-on-scroll">
          <p class="domaine-text">
            Notre cabinet conseille au niveau national et international tant des sociétés multinationales que des PME et appréhende l'ensemble des problématiques juridiques relatives à l'activité quotidienne des entreprises (p.ex. suivi du juridique courant, conventions d'actionnaires, différends entre actionnaires/partenaires…) ainsi que dans le cadre des opérations de fusion, d'acquisition, de cession et plus généralement de toute restructuration et/ou réorganisation des pouvoirs.
          </p>
          
          <p class="domaine-text" style="margin-top: 1.5rem;">
            Notre cabinet conseille et assiste une clientèle d'entreprises également dans le cadre de leur création, développement, ainsi que pour leurs rapports contractuels avec leurs différents partenaires, clients, prestataires, et/ou fournisseurs.
          </p>
          
          <div class="highlight-box">
            <h4>Expérience en Droit des Sociétés</h4>
            <p class="domaine-text">
              Notre expérience dans le domaine de droit des sociétés nous permet d'assister et défendre les groupes d'entreprises, les entreprises, les dirigeants d'entreprises, les associés lors des contentieux mettant en œuvre le droit des sociétés tant en matière de conseil que de contentieux.
            </p>
          </div>
          
          <div class="domaine-cta">
            <a href="index.php#contact" class="btn-premium">Demander une Consultation</a>
            <a href="#autres" class="btn-outline">Suivant →</a>
          </div>
        </div>
        
        <div class="domaine-list animate-on-scroll">
          <h4>Domaines d'intervention</h4>
          <ul>
            <li>
              <strong>Conseil juridique courant</strong>
              <ul class="sub-list">
                <li>Suivi juridique quotidien</li>
                <li>Conventions d'actionnaires</li>
                <li>Différends entre partenaires</li>
              </ul>
            </li>
            <li>
              <strong>Opérations de restructuration</strong>
              <ul class="sub-list">
                <li>Fusions et acquisitions</li>
                <li>Cessions d'entreprises</li>
                <li>Réorganisation des pouvoirs</li>
              </ul>
            </li>
            <li>
              <strong>Création et développement</strong>
              <ul class="sub-list">
                <li>Accompagnement à la création</li>
                <li>Relations avec partenaires</li>
                <li>Contrats clients/fournisseurs</li>
              </ul>
            </li>
            <li>
              <strong>Contentieux des sociétés</strong>
              <ul class="sub-list">
                <li>Conseil aux entreprises</li>
                <li>Défense des dirigeants</li>
                <li>Litiges entre associés</li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Autres Domaines Section -->
  <section id="autres" class="domaine-section">
    <div class="container">
      <div class="domaine-header animate-on-scroll">
        <div class="domaine-icon-large">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="16"/>
            <line x1="8" y1="12" x2="16" y2="12"/>
          </svg>
        </div>
        <div>
          <h2 class="domaine-title">Autres Domaines de Droits</h2>
          <p class="domaine-subtitle">Droit pénal, civil, fiscal, foncier et familial</p>
        </div>
      </div>
      
      <div class="domaine-content" style="grid-template-columns: 1fr;">
        <div class="animate-on-scroll">
          <!-- Droit Civil -->
          <div style="margin-bottom: 3rem;">
            <h3 style="font-family: var(--font-serif); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--color-primary);">Droit Civil</h3>
            <p class="domaine-text">
              Le cabinet assure conseil, assistance et représentation dans l'ensemble des litiges et procédures relevant du droit civil congolais, tant en phase précontentieuse que contentieuse.
            </p>
            
            <div style="display: grid; gap: 1.5rem; margin-top: 1.5rem;">
              <div class="domaine-list">
                <h4>Droit des obligations</h4>
                <ul>
                  <li>Responsabilité civile (contractuelle et délictuelle)</li>
                  <li>Réparation des préjudices matériels et moraux</li>
                  <li>Exécution et inexécution des obligations</li>
                </ul>
              </div>
              
              <div class="domaine-list">
                <h4>Droit des contrats civils</h4>
                <ul>
                  <li>Rédaction et analyse des contrats civils</li>
                  <li>Résiliation, résolution et nullité des contrats</li>
                  <li>Contentieux contractuel</li>
                </ul>
              </div>
              
              <div class="domaine-list">
                <h4>Droit de la famille</h4>
                <ul>
                  <li>Mariage, divorce et séparation</li>
                  <li>Filiation et autorité parentale</li>
                  <li>Pension alimentaire et garde des enfants</li>
                  <li>Successions et régimes matrimoniaux</li>
                </ul>
              </div>
              
              <div class="domaine-list">
                <h4>Droit des biens</h4>
                <ul>
                  <li>Propriété et possession</li>
                  <li>Litiges fonciers et immobiliers</li>
                  <li>Bornage, servitude et expropriation</li>
                </ul>
              </div>
            </div>
          </div>
          
          <!-- Droit Pénal -->
          <div style="margin-bottom: 3rem;">
            <h3 style="font-family: var(--font-serif); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--color-primary);">Droit Pénal</h3>
            <p class="domaine-text">
              Le cabinet intervient à tous les stades de la procédure pénale, pour la défense des intérêts des prévenus, victimes et parties civiles, conformément au Code pénal et au Code de procédure pénale congolais.
            </p>
            
            <div style="display: grid; gap: 1.5rem; margin-top: 1.5rem;">
              <div class="domaine-list">
                <h4>Défense pénale</h4>
                <ul>
                  <li>Assistance en garde à vue et instruction</li>
                  <li>Défense devant les juridictions répressives</li>
                  <li>Plaidoiries et recours</li>
                </ul>
              </div>
              
              <div class="domaine-list">
                <h4>Infractions pénales courantes</h4>
                <ul>
                  <li>Infractions contre les personnes (coups et blessures, homicide)</li>
                  <li>Infractions contre les biens (vol, abus de confiance, escroquerie)</li>
                  <li>Infractions économiques et financières</li>
                  <li>Infractions liées aux documents et faux</li>
                </ul>
              </div>
              
              <div class="domaine-list">
                <h4>Constitution de la partie civile</h4>
                <ul>
                  <li>Réparation du préjudice</li>
                  <li>Indemnisation des victimes</li>
                  <li>Suivi de l'exécution des décisions</li>
                </ul>
              </div>
            </div>
          </div>
          
          <!-- Droit Foncier et Immobilier -->
          <div style="margin-bottom: 3rem;">
            <h3 style="font-family: var(--font-serif); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--color-primary);">Droit Foncier et Immobilier</h3>
            <p class="domaine-text">
              Le droit immobilier est complexe, bailleurs, constructeurs, vendeurs sont soumis à des législations de plus en plus contraignantes et multiples. Le cabinet est habitué à défendre autant des professionnels que des particuliers (bailleurs, acheteurs, riverains…) qu'il s'agisse de prévenir les risques ou de vous défendre nous saurons defender vos droits et vous éviter les pièges.
            </p>
            <p class="domaine-text" style="margin-top: 1rem;">
              En pratique, il peut par exemple s'agir de défendre un bailleur ou un locataire, de rédiger des clauses, rédiger un cahier des charges ou encore un règlement de copropriété, organiser une expulsion… etc.
            </p>
          </div>
          
          <!-- Droit Fiscal -->
          <div style="margin-bottom: 3rem;">
            <h3 style="font-family: var(--font-serif); font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--color-primary);">Droit Fiscal</h3>
            <p class="domaine-text">
              Notre cabinet aide nos clients à optimiser et maîtriser le poids de la fiscalité dans le cadre de leur activité ou de leurs investissements. Il assure également leur défense face à l'administration fiscale ou douanière, tant au stade des opérations de contrôle que devant les instances ou juridictions nationales et/ou européennes.
            </p>
            <p class="domaine-text" style="margin-top: 1rem;">
              Notre cabinet accompagne également de nombreuses entreprises et investisseurs étrangers pour leurs investissements en République Démocratique du Congo ainsi que des opérateurs Congolais pour leurs investissements à l'étranger.
            </p>
          </div>
          
          <div class="domaine-cta">
            <a href="index.php#contact" class="btn-premium">Demander une Consultation</a>
            <a href="#ohada" class="btn-outline">↑ Retour au début</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact CTA Section -->
  <section class="section" style="background: var(--color-muted);">
    <div class="container" style="text-align: center;">
      <span class="section-subtitle">Besoin d'un Conseil ?</span>
      <h2 class="section-title">Consultation avec<br>nos Experts</h2>
      <div class="section-line"></div>
      <p style="max-width: 600px; margin: 1.5rem auto 2rem; color: var(--color-muted-foreground);">
        Nos avocats sont disponibles pour vous accompagner dans tous vos projets juridiques. Contactez-nous pour une consultation personnalisée.
      </p>
      <a href="index.php#contact" class="btn-premium">Prendre Rendez-vous</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <a href="index.php" class="navbar-logo">
            <img src="logo.png" alt="ELMD" class="logo-icon">
            <span class="logo-text">ELMD</span>
          </a>
          <p class="footer-tagline">Étude Laurent Mbako/Cabinet d'Avocats au service de votre réussite depuis 2007.</p>
          <div class="footer-social">
            <a href="#" class="social-link" aria-label="LinkedIn">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                <rect x="2" y="9" width="4" height="12"/>
                <circle cx="4" cy="4" r="2"/>
              </svg>
            </a>
            <a href="#" class="social-link" aria-label="Twitter">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
              </svg>
            </a>
          </div>
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
        
        <div class="footer-links">
          <h4>Expertises</h4>
          <ul>
            <li><a href="#ohada">Droit Ohada</a></li>
            <li><a href="#minier">Droit Minier</a></li>
            <li><a href="#travail">Droit du Travail</a></li>
            <li><a href="#affaires">Administration des Affaires</a></li>
            <li><a href="#autres">Autres Domaines</a></li>
          </ul>
        </div>
        
        <div class="footer-links">
          <h4>Expertises</h4>
          <ul>
            <li><a href="#ohada">Droit Ohada</a></li>
            <li><a href="#minier">Droit Minier</a></li>
            <li><a href="#travail">Droit du Travail</a></li>
            <li><a href="#affaires">Administration des Affaires</a></li>
            <li><a href="#autres">Autres Domaines</a></li>
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

  <!-- Back to Top -->
  <a href="#" class="back-to-top" aria-label="Retour en haut">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="M18 15l-6-6-6 6"/>
    </svg>
  </a>

  <!-- Scripts -->
  <script type="module" src="main.js"></script>
  <script>
    // Back to top functionality
    document.querySelector('.back-to-top').addEventListener('click', function(e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Smooth scroll for sticky nav links
    document.querySelectorAll('.sticky-nav-link').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          targetElement.scrollIntoView({ behavior: 'smooth' });
        }
      });
    });
    
    // Active state for sticky nav
    const sections = document.querySelectorAll('.domaine-section');
    const navLinks = document.querySelectorAll('.sticky-nav-link');
    
    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (scrollY >= sectionTop - 200) {
          current = section.getAttribute('id');
        }
      });
      
      navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === '#' + current) {
          link.classList.add('active');
        }
      });
    });
  </script>
</body>
</html>