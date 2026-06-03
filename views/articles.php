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
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="css/articles.css">
</head>

<body>
  <!-- Loader -->
  <div id="loader" class="loader">
    <div class="loader-content">
      <svg class="loader-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
        <circle cx="12" cy="3" r="1" fill="currentColor" />
        <path d="M7 21h10M9 21v-3h6v3" />
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
          <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
          <circle cx="12" cy="3" r="1" fill="currentColor" />
          <path d="M7 21h10M9 21v-3h6v3" />
        </svg>
        <span class="logo-text">ELMD</span>
      </a>

      <!-- Desktop Menu -->
      <div class="navbar-links">
        <a href="index.php" class="nav-link">Accueil</a>
        <a href="index.php#cabinet" class="nav-link">Le Cabinet</a>
        <a href="index.php#expertises" class="nav-link">Expertises</a>
        <a href="index.php#equipe" class="nav-link">Équipe</a>
        <a href="articles" class="nav-link active">Actualités</a>
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
        <a href="articles" class="mobile-link">
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
    <a href="articles" class="filter-btn <?= empty($activeCategory) ? 'active' : '' ?>">Tous</a>
    <?php if (isset($categories) && is_array($categories)): ?>
      <?php foreach ($categories as $cat): ?>
        <a href="articles?categorie=<?= htmlspecialchars($cat['slug']) ?>"
          class="filter-btn <?= (isset($activeCategory) && $activeCategory === $cat['slug']) ? 'active' : '' ?>">
          <?= htmlspecialchars($cat['nom']) ?>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Articles Grid -->
  <div class="container">
    <?php if (isset($articles) && is_array($articles) && count($articles) > 0): ?>
      <div class="articles-grid">
        <?php
        $first = true;
        foreach ($articles as $article):
          $isFeatured = $first && !$activeCategory;
          $first = false;
        ?>
          <article class="article-card <?= $isFeatured ? 'featured-article' : '' ?>" data-category="<?= htmlspecialchars($article['category_slug'] ?? '') ?>">
            <div class="article-image">
              <?php if (!empty($article['image_couverture'])): ?>
                <img src="<?= 'resources/' . htmlspecialchars($article['image_couverture']) ?>" alt="<?= htmlspecialchars($article['titre']) ?>" loading="lazy">
              <?php else: ?>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                  <path d="M12 14l9-5-9-5-9 5 9 5z" />
                  <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                  <path d="M12 14v7" />
                </svg>
              <?php endif; ?>
              <?php if ($isFeatured): ?>
                <span class="article-category">À la une</span>
              <?php else: ?>
                <span class="article-category"><?= htmlspecialchars($article['category_nom'] ?? 'Non classé') ?></span>
              <?php endif; ?>
            </div>
            <div class="article-content">
              <?php if ($isFeatured): ?>
                <span class="featured-badge">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                  </svg>
                  Article Vedette
                </span>
              <?php endif; ?>
              <h2 class="article-title">
                <a href="articles/<?= htmlspecialchars($article['id']) ?>">
                  <?= htmlspecialchars($article['titre']) ?>
                </a>
              </h2>
              <p class="article-excerpt"><?= htmlspecialchars($article['extrait'] ?? '') ?></p>
              <div class="article-meta">
                <span class="article-date">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                  </svg>
                  <?= isset($article['publie_le']) ? date('d F Y', strtotime($article['publie_le'])) : '' ?>
                </span>
                <span class="article-author">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                  </svg>
                  <?= htmlspecialchars($article['avocat_nom'] ?? 'ELMD Cabinet') ?>
                </span>
              </div>
              <div class="article-footer">
                <span class="article-read-time">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                  </svg>
                  <?= isset($article['contenu']) ? max(5, min(15, strlen(strip_tags($article['contenu'])) / 500)) . ' min de lecture' : '5 min de lecture' ?>
                </span>
                <a href="articles/<?= htmlspecialchars($article['id']) ?>" class="article-link">
                  Lire l'article
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <polyline points="12 5 19 12 12 19" />
                  </svg>
                </a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="no-articles">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
          <polyline points="14 2 14 8 20 8" />
          <line x1="16" y1="13" x2="8" y2="13" />
          <line x1="16" y1="17" x2="8" y2="17" />
        </svg>
        <h3>Aucun article publié</h3>
        <p>Les articles apparaîtront ici une fois publiés par notre équipe.</p>
      </div>
    <?php endif; ?>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="navbar-logo">
            <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
              <circle cx="12" cy="3" r="1" fill="currentColor" />
              <path d="M7 21h10M9 21v-3h6v3" />
            </svg>
            <span class="logo-text">ELMD</span>
          </div>
          <p class="footer-tagline">Cabinet d'avocats d'excellence, alliant tradition et innovation pour servir vos intérêts avec rigueur et détermination.</p>
          <div class="footer-social">
            <a href="#" class="social-link" aria-label="LinkedIn">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                <rect x="2" y="9" width="4" height="12" />
                <circle cx="4" cy="4" r="2" />
              </svg>
            </a>
            <a href="#" class="social-link" aria-label="Twitter">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
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
            <li><a href="articles">Actualités</a></li>
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
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;display:inline-block;vertical-align:middle;margin-right:8px;">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                <circle cx="12" cy="10" r="3" />
              </svg>Kinshasa, RDC</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;display:inline-block;vertical-align:middle;margin-right:8px;">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
              </svg>+243 81 234 5678</li>
            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;display:inline-block;vertical-align:middle;margin-right:8px;">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                <polyline points="22,6 12,13 2,6" />
              </svg>contact@elmd-avocats.cd</li>
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
</body>

</html>