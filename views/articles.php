<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Publications & Actualités | ELMD Cabinet d'Avocats</title>
  <meta name="description" content="Publications juridiques et actualités du cabinet ELMD. Analyses et commentaries sur l'actualité juridique.">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Styles -->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/articles.css">
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
        <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
          <circle cx="12" cy="3" r="1" fill="currentColor"/>
          <path d="M7 21h10M9 21v-3h6v3"/>
        </svg>
        <span class="logo-text">ELMD</span>
      </a>
      
      <!-- Desktop Menu -->
      <div class="navbar-links">
        <a href="index.php" class="nav-link">Accueil</a>
        <a href="index.php#cabinet" class="nav-link">Le Cabinet</a>
        <a href="index.php#expertises" class="nav-link">Expertises</a>
        <a href="index.php#equipe" class="nav-link">Équipe</a>
        <a href="articles.php" class="nav-link active">Actualités</a>
        <a href="index.php#contact" class="nav-link">Contact</a>
        <a href="connexion.php" class="nav-link nav-link-highlight">Connexion</a>
      </div>
      
      <!-- Theme Switcher -->
      <div id="theme-switcher-container" class="theme-switcher-wrapper"></div>
      
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
            <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
            <circle cx="12" cy="3" r="1" fill="currentColor"/>
            <path d="M7 21h10M9 21v-3h6v3"/>
          </svg>
          <span class="logo-text">ELMD</span>
        </div>
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
        <a href="index.php#expertises" class="mobile-link">
          <span>Expertises</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="index.php#equipe" class="mobile-link">
          <span>Équipe</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="articles.php" class="mobile-link">
          <span>Actualités</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="index.php#contact" class="mobile-link">
          <span>Contact</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="connexion.php" class="mobile-link">
          <span>Connexion</span>
          <span class="mobile-link-arrow">→</span>
        </a>
      </div>
      <div class="mobile-menu-footer">
        <a href="index.php#contact" class="btn-premium mobile-cta">Prendre Rendez-vous</a>
      </div>
    </div>
  </div>

  <!-- Hero Section -->
  <section class="articles-hero">
    <div class="articles-hero-content">
      <span class="articles-hero-subtitle">Publications & Analyses</span>
      <h1 class="articles-hero-title">Nos Publications Juridiques</h1>
      <p class="articles-hero-description">Découvrez nos analyses, commentaries et expertises sur l'actualité juridique africaine et internationale.</p>
    </div>
  </section>

  <!-- Articles Filters -->
  <div class="articles-filters">
    <button class="filter-btn active" data-filter="all">Tous</button>
    <button class="filter-btn" data-filter="droit-affaires">Droit des Affaires</button>
    <button class="filter-btn" data-filter="droit-minier">Droit Minier</button>
    <button class="filter-btn" data-filter="droit-fiscal">Droit Fiscal</button>
    <button class="filter-btn" data-filter="droit-travail">Droit du Travail</button>
    <button class="filter-btn" data-filter="ohada">OHADA</button>
  </div>

  <!-- Articles Grid -->
  <div class="container">
    <div class="articles-grid">
      <!-- Featured Article -->
      <article class="article-card featured-article" data-category="droit-affaires">
        <div class="article-image">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
            <path d="M12 14v7"/>
          </svg>
          <span class="article-category">À la une</span>
        </div>
        <div class="article-content">
          <span class="featured-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
            </svg>
            Article Vedette
          </span>
          <h2 class="article-title">
            <a href="#" onclick="openArticle(0); return false;">Réformes du Code des Investissements en République Démocratique du Congo</a>
          </h2>
          <p class="article-excerpt">Une analyse approfondie des récentes modifications législatives visant à améliorer le climat des investissements et à simplifier les procédures administratives pour les investisseurs étrangers et nationaux.</p>
          <div class="article-meta">
            <span class="article-date">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              15 Mai 2026
            </span>
            <span class="article-author">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
              Jean-Pierre Dupont
            </span>
          </div>
          <div class="article-footer">
            <span class="article-read-time">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
              12 min de lecture
            </span>
            <a href="#" class="article-link" onclick="openArticle(0); return false;">
              Lire l'article
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </div>
        </div>
      </article>

      <!-- Article 1 -->
      <article class="article-card" data-category="droit-minier">
        <div class="article-image">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
          <span class="article-category">Droit Minier</span>
        </div>
        <div class="article-content">
          <h2 class="article-title">
            <a href="#" onclick="openArticle(1); return false;">Les Nouvelles Obligations Environnementales pour les Titulaires de Permis Miniers</a>
          </h2>
          <p class="article-excerpt">Décryptage des nouvelles normes environnementales imposées aux entreprises minières opérant en RDC et leurs implications pratiques.</p>
          <div class="article-meta">
            <span class="article-date">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              10 Mai 2026
            </span>
            <span class="article-author">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
              Marie-Claire Bernard
            </span>
          </div>
          <div class="article-footer">
            <span class="article-read-time">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
              8 min de lecture
            </span>
            <a href="#" class="article-link" onclick="openArticle(1); return false;">
              Lire
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </div>
        </div>
      </article>

      <!-- Article 2 -->
      <article class="article-card" data-category="droit-fiscal">
        <div class="article-image">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <line x1="12" y1="1" x2="12" y2="23"/>
            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
          </svg>
          <span class="article-category">Droit Fiscal</span>
        </div>
        <div class="article-content">
          <h2 class="article-title">
            <a href="#" onclick="openArticle(2); return false;">Optimisation Fiscale Internationale : Stratégies et Conformité</a>
          </h2>
          <p class="article-excerpt">Guide pratique sur les stratégies d'optimisation fiscale dans le respect des nouvelles réglementations nationales et internationales.</p>
          <div class="article-meta">
            <span class="article-date">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              5 Mai 2026
            </span>
            <span class="article-author">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
              Alexandre Martin
            </span>
          </div>
          <div class="article-footer">
            <span class="article-read-time">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
              10 min de lecture
            </span>
            <a href="#" class="article-link" onclick="openArticle(2); return false;">
              Lire
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </div>
        </div>
      </article>

      <!-- Article 3 -->
      <article class="article-card" data-category="droit-travail">
        <div class="article-image">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
          <span class="article-category">Droit du Travail</span>
        </div>
        <div class="article-content">
          <h2 class="article-title">
            <a href="#" onclick="openArticle(3); return false;">Rupture Conventionnelle : Tout ce que l'Employeur Doit Savoir</a>
          </h2>
          <p class="article-excerpt">Procédure, négociation et conséquences fiscales de la rupture conventionnelle du contrat de travail en droit congolais.</p>
          <div class="article-meta">
            <span class="article-date">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              28 Avril 2026
            </span>
            <span class="article-author">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
              Sophie Laurent
            </span>
          </div>
          <div class="article-footer">
            <span class="article-read-time">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
              7 min de lecture
            </span>
            <a href="#" class="article-link" onclick="openArticle(3); return false;">
              Lire
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </div>
        </div>
      </article>

      <!-- Article 4 -->
      <article class="article-card" data-category="ohada">
        <div class="article-image">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
            <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
            <line x1="12" y1="22.08" x2="12" y2="12"/>
          </svg>
          <span class="article-category">OHADA</span>
        </div>
        <div class="article-content">
          <h2 class="article-title">
            <a href="#" onclick="openArticle(4); return false;">L'Acte Uniforme sur le Droit Commercial : Actualités et Jurisprudence</a>
          </h2>
          <p class="article-excerpt">Analyse des récentes décisions de justice interprétant les dispositions de l'AUDCG et leurs impacts sur les opérations commerciales.</p>
          <div class="article-meta">
            <span class="article-date">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              22 Avril 2026
            </span>
            <span class="article-author">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
              Jean-Pierre Dupont
            </span>
          </div>
          <div class="article-footer">
            <span class="article-read-time">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
              9 min de lecture
            </span>
            <a href="#" class="article-link" onclick="openArticle(4); return false;">
              Lire
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </div>
        </div>
      </article>

      <!-- Article 5 -->
      <article class="article-card" data-category="droit-affaires">
        <div class="article-image">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
            <line x1="16" y1="13" x2="8" y2="13"/>
            <line x1="16" y1="17" x2="8" y2="17"/>
            <polyline points="10 9 9 9 8 9"/>
          </svg>
          <span class="article-category">Droit des Affaires</span>
        </div>
        <div class="article-content">
          <h2 class="article-title">
            <a href="#" onclick="openArticle(5); return false;">Fusion et Acquisition : Due Diligence et Évaluation des Risques</a>
          </h2>
          <p class="article-excerpt">Méthodologie de la due diligence dans les opérations de fusions-acquisitions et identification des risques contractuels.</p>
          <div class="article-meta">
            <span class="article-date">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
              18 Avril 2026
            </span>
            <span class="article-author">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
              Marie-Claire Bernard
            </span>
          </div>
          <div class="article-footer">
            <span class="article-read-time">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
              11 min de lecture
            </span>
            <a href="#" class="article-link" onclick="openArticle(5); return false;">
              Lire
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </div>
        </div>
      </article>
    </div>
  </div>

  <!-- Article Modal -->
  <div class="article-modal" id="articleModal">
    <div class="article-modal-content">
      <button class="article-modal-close" onclick="closeArticle()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M18 6L6 18M6 6l12 12"/>
        </svg>
      </button>
      <div class="article-modal-header">
        <span class="article-modal-category" id="modalCategory">Droit des Affaires</span>
        <h2 class="article-modal-title" id="modalTitle">Titre de l'article</h2>
        <div class="article-modal-meta">
          <span id="modalDate">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
              <line x1="16" y1="2" x2="16" y2="6"/>
              <line x1="8" y1="2" x2="8" y2="6"/>
              <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            Date
          </span>
          <span id="modalAuthor">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
            Auteur
          </span>
          <span id="modalReadTime">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <polyline points="12 6 12 12 16 14"/>
            </svg>
            Durée
          </span>
        </div>
      </div>
      <div class="article-modal-body" id="modalBody">
        <p>Contenu de l'article...</p>
      </div>
      <div class="article-modal-footer">
        <div class="article-tags" id="modalTags">
          <span class="article-tag">Droit des Affaires</span>
          <span class="article-tag">Investissement</span>
          <span class="article-tag">RDC</span>
        </div>
        <div class="article-share">
          <button class="share-btn" title="Partager sur LinkedIn">
            <svg viewBox="0 0 24 24" fill="currentColor">
              <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
              <rect x="2" y="9" width="4" height="12"/>
              <circle cx="4" cy="4" r="2"/>
            </svg>
          </button>
          <button class="share-btn" title="Partager par email">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
              <polyline points="22,6 12,13 2,6"/>
            </svg>
          </button>
          <button class="share-btn" title="Copier le lien">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
              <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="navbar-logo">
            <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
              <circle cx="12" cy="3" r="1" fill="currentColor"/>
              <path d="M7 21h10M9 21v-3h6v3"/>
            </svg>
            <span class="logo-text">ELMD</span>
          </div>
          <p class="footer-tagline">Cabinet d'avocats d'excellence, alliant tradition et innovation pour servir vos intérêts avec rigueur et détermination.</p>
          <div class="footer-social">
            <a href="#" class="social-link" aria-label="LinkedIn">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                <rect x="2" y="9" width="4" height="12"/>
                <circle cx="4" cy="4" r="2"/>
              </svg>
            </a>
            <a href="#" class="social-link" aria-label="Twitter">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
              </svg>
            </a>
          </div>
        </div>
        
        <div class="footer-links">
          <h4>Navigation</h4>
          <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php#cabinet">Le Cabinet</a></li>
            <li><a href="index.php#expertises">Expertises</a></li>
            <li><a href="index.php#equipe">Équipe</a></li>
            <li><a href="articles.php">Actualités</a></li>
            <li><a href="stages.php">Stages</a></li>
          </ul>
        </div>
        
        <div class="footer-links">
          <h4>Domaines</h4>
          <ul>
            <li><a href="administration-affaires.php">Droit des Affaires</a></li>
            <li><a href="droit-minier.php">Droit Minier</a></li>
            <li><a href="droit-fiscal.php">Droit Fiscal</a></li>
            <li><a href="droit-travail.php">Droit du Travail</a></li>
            <li><a href="droit-ohada.php">Droit OHADA</a></li>
            <li><a href="autres-domaines.php">Autres Domaines</a></li>
          </ul>
        </div>
        
        <div class="footer-links">
          <h4>Contact</h4>
          <ul>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;display:inline-block;vertical-align:middle;margin-right:8px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>Kinshasa, RDC</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;display:inline-block;vertical-align:middle;margin-right:8px;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>+243 81 234 5678</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;display:inline-block;vertical-align:middle;margin-right:8px;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>contact@elmd-avocats.cd</li>
          </ul>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>&copy; 2026 ELMD Cabinet d'Avocats. Tous droits réservés.</p>
        <div class="footer-legal">
          <a href="#">Mentions légales</a>
          <a href="#">Politique de confidentialité</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script type="module" src="js/theme.js"></script>
  <script src="js/main.js"></script>
  <script>
    // Articles data
    const articlesData = [
      {
        category: 'Droit des Affaires',
        title: 'Réformes du Code des Investissements en République Démocratique du Congo',
        date: '15 Mai 2026',
        author: 'Jean-Pierre Dupont',
        readTime: '12 min de lecture',
        content: `
          <p>La République Démocratique du Congo a récemment undergone significant amendments to its Investment Code, marking a pivotal shift in the country's approach to attracting foreign capital. These reforms aim to create a more favorable business environment while ensuring national interests are protected.</p>
          
          <h2>Les Principales Modifications</h2>
          <p>The new legislation introduces several key changes that will impact both local and international investors. Among the most significant are the streamlined registration processes and the enhanced protection of foreign investments against expropriation.</p>
          
          <ul>
            <li>Reduction of administrative hurdles for business creation</li>
            <li>Tax incentives for strategic sectors including mining and agriculture</li>
            <li>Enhanced dispute resolution mechanisms</li>
            <li>Protection of intellectual property rights</li>
          </ul>
          
          <h2>Implications pour les Investisseurs</h2>
          <p>For foreign investors, these changes represent a significant opportunity. The government has also introduced guarantees against political risks, which should provide additional confidence for long-term investments in the country.</p>
          
          <p>Our team at ELMD is closely monitoring these developments and is ready to assist investors in navigating the new regulatory framework. Contact us for a comprehensive analysis of how these reforms may affect your investment strategy.</p>
        `,
        tags: ['Investissement', 'RDC', 'Législation', 'Affaires']
      },
      {
        category: 'Droit Minier',
        title: 'Les Nouvelles Obligations Environnementales pour les Titulaires de Permis Miniers',
        date: '10 Mai 2026',
        author: 'Marie-Claire Bernard',
        readTime: '8 min de lecture',
        content: `
          <p>Les titulaire de permis miniers en République Démocratique du Congo font face à de nouvelles obligations environnementales strictes. Ces mesures visent à garantir une exploitation minière responsable et durable sur le territoire national.</p>
          
          <h2>Cadre Réglementaire</h2>
          <p>Le Code Minier de 2002, tel que modifié en 2018, impose désormais des exigences plus rigoureuses en matière de protection de l'environnement. Les entreprises minières doivent désormais démontrer leur engagement envers des pratiques durables.</p>
          
          <ul>
            <li>Études d'impact environnemental obligatoires avant le démarrage des opérations</li>
            <li>Plans de rehabilitation des sites miniers après exploitation</li>
            <li>Gestion des déchets et eaux usées conforme aux normes internationales</li>
            <li>Programmes de reforestation et compensation environnementale</li>
          </ul>
          
          <h2>Sanctions et Conformité</h2>
          <p>Le non-respect de ces obligations peut entraîner des sanctions sévères, incluant la suspension ou le retrait des permis miniers. Il est crucial pour les entreprises du secteur de se conformer à ces nouvelles exigences.</p>
        `,
        tags: ['Environnement', 'Permis Miniers', 'Compliance', 'ODEP']
      },
      {
        category: 'Droit Fiscal',
        title: 'Optimisation Fiscale Internationale : Stratégies et Conformité',
        date: '5 Mai 2026',
        author: 'Alexandre Martin',
        readTime: '10 min de lecture',
        content: `
          <p>L'optimisation fiscale internationale demeure un sujet brûlant pour les entreprises opérant à travers plusieurs juridictions. Les autorités fiscales congolaises intensifient leurs contrôles et les entreprises doivent adopter des stratégies conformes aux normes internationales.</p>
          
          <h2>Évolution du Paysage Fiscal</h2>
          <p>Les traités de double imposition et les règles de transfert pricing jouent un rôle crucial dans la planification fiscale des multinationales. La RDC a signé plusieurs accords bilatéraux pour éviter la double imposition et favoriser les investissements étrangers.</p>
          
          <h2>Stratégies d'Optimisation</h2>
          <ul>
            <li>Utilisation optimale des incitations fiscales prévues par la loi</li>
            <li>Planification de la structure des sociétés holding</li>
            <li>Gestion des prix de transfert dans le respect des règles OECD</li>
            <li>Structuration des flux de dividendes et royalties</li>
          </ul>
          
          <p>Notre équipe juridique vous accompagne dans l'élaboration de stratégies fiscales responsables tout en maximisant les avantages disponibles dans le cadre légal.</p>
        `,
        tags: ['Fiscalité', 'Optimisation', 'International', 'Transfer Pricing']
      },
      {
        category: 'Droit du Travail',
        title: 'Rupture Conventionnelle : Tout ce que l\'Employeur Doit Savoir',
        date: '28 Avril 2026',
        author: 'Sophie Laurent',
        readTime: '7 min de lecture',
        content: `
          <p>La rupture conventionnelle constitue un mode de séparation amiables entre employeur et salarié, régi par le Code du Travail congolais. Elle offre une alternative aux licenciements et permet une négociation des conditions de départ.</p>
          
          <h2>Procédure à Suivre</h2>
          <p>La rupture conventionnelle doit respecter une procédure stricte incluant une entretien préalable durant lequel les parties discutent des conditions de séparation. Un protocole doit être rédigé et homologué par l'Inspection du Travail.</p>
          
          <ul>
            <li>Entretien de négociation des conditions</li>
            <li>Rédaction du protocole de rupture</li>
            <li>Demande d'homologation auprès de l'Inspection du Travail</li>
            <li>Délai de rétractation de 15 jours</li>
          </ul>
          
          <h2>Conséquences Fiscales</h2>
          <p>Les indemnités versées dans le cadre d'une rupture conventionnelle sont soumises à des règles fiscales spécifiques. Certaines sommes peuvent être exonérées dans certaines limites, tandis que d'autres sont imposables.</p>
        `,
        tags: ['Travail', 'Rupture Conventionnelle', 'Licenciement', 'Droit Social']
      },
      {
        category: 'OHADA',
        title: 'L\'Acte Uniforme sur le Droit Commercial : Actualités et Jurisprudence',
        date: '22 Avril 2026',
        author: 'Jean-Pierre Dupont',
        readTime: '9 min de lecture',
        content: `
          <p>L'Acte Uniforme relatif au Droit Commercial Général (AUDCG) constitue le socle du droit commercial dans les États membres de l'OHADA. Les juridictions nationales rendent régulièrement des décisions qui enrichissent l'interprétation de ce texte fondamental.</p>
          
          <h2>Jurisprudence Récente</h2>
          <p>Les Cours d'appel et la Cour Commune de Justice et d'Arbitrage (CCJA) ont eu à se prononcer sur plusieurs questions essentielles concernant le statut du commerçant, les effets du contrat de vente et la responsabilité des dirigeants sociaux.</p>
          
          <ul>
            <li>Conditions de validité du contrat de vente commerciale</li>
            <li>Responsabilité des administrateurs de société</li>
            <li>Régime des clauses limitatives de responsabilité</li>
            <li>Prescription des actions commerciales</li>
          </ul>
          
          <h2>Impact pour les Entreprises</h2>
          <p>Ces décisions jurisprudentielles ont un impact direct sur les opérations commerciales quotidiennes. Les entreprises doivent adapter leurs pratiques contractuelles pour se conformer aux interprétations les plus récentes de l'AUDCG.</p>
        `,
        tags: ['OHADA', 'AUDCG', 'Jurisprudence', 'Droit Commercial']
      },
      {
        category: 'Droit des Affaires',
        title: 'Fusion et Acquisition : Due Diligence et Évaluation des Risques',
        date: '18 Avril 2026',
        author: 'Marie-Claire Bernard',
        readTime: '11 min de lecture',
        content: `
          <p>Les opérations de fusion et acquisition requieren une analyse approfondie des risques potentiels. La due diligence constitue une étape cruciale qui permet d'identifier les passifs cachés et d'évaluer la valeur réelle de la cible.</p>
          
          <h2>Les Différentes Facettes de la Due Diligence</h2>
          <p>Une due diligence complète doit couvrir plusieurs aspects : juridique, fiscal, financier, opérationnel et environnemental. Chaque domaine présente des risques spécifiques qui doivent être identifiés et évalués avant la conclusion de la transaction.</p>
          
          <ul>
            <li>Analyse des contrats en cours et de leurs clauses de changement de contrôle</li>
            <li>Vérification de la conformité réglementaire</li>
            <li>Évaluation des litiges en cours et potentiels</li>
            <li>Analyse des engagements hors bilan</li>
          </ul>
          
          <h2>Gestion des Risques Identifiés</h2>
          <p>Une fois les risques identifiés, différentes stratégies peuvent être mises en place : négociation du prix, insertion de garanties contractuelles, mise en place d'écrow accounts ou restructuration de la transaction pour limiter l'exposition.</p>
        `,
        tags: ['Fusions-Acquisitions', 'Due Diligence', 'Risques', 'Transaction']
      }
    ];

    // Filter functionality
    document.querySelectorAll('.filter-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const filter = this.dataset.filter;
        
        // Update active state
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        // Filter articles
        document.querySelectorAll('.article-card').forEach(card => {
          if (filter === 'all' || card.dataset.category === filter) {
            card.style.display = '';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });

    // Open article modal
    function openArticle(index) {
      const article = articlesData[index];
      if (!article) return;
      
      document.getElementById('modalCategory').textContent = article.category;
      document.getElementById('modalTitle').textContent = article.title;
      document.getElementById('modalDate').innerHTML = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
          <line x1="16" y1="2" x2="16" y2="6"/>
          <line x1="8" y1="2" x2="8" y2="6"/>
          <line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        ${article.date}
      `;
      document.getElementById('modalAuthor').innerHTML = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
          <circle cx="12" cy="7" r="4"/>
        </svg>
        ${article.author}
      `;
      document.getElementById('modalReadTime').innerHTML = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="10"/>
          <polyline points="12 6 12 12 16 14"/>
        </svg>
        ${article.readTime}
      `;
      document.getElementById('modalBody').innerHTML = article.content;
      
      document.getElementById('modalTags').innerHTML = article.tags.map(tag => 
        `<span class="article-tag">${tag}</span>`
      ).join('');
      
      document.getElementById('articleModal').classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    // Close article modal
    function closeArticle() {
      document.getElementById('articleModal').classList.remove('active');
      document.body.style.overflow = '';
    }

    // Close on click outside
    document.getElementById('articleModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeArticle();
      }
    });

    // Close on escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeArticle();
      }
    });
  </script>
</body>
</html>