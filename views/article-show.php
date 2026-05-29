<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['titre'] ?? 'Article') ?> | ELMD Cabinet d'Avocats</title>
    <meta name="description" content="<?= htmlspecialchars($article['extrait'] ?? '') ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/articles.css">
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
            <a href="/" class="navbar-logo">
                <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
                    <circle cx="12" cy="3" r="1" fill="currentColor" />
                    <path d="M7 21h10M9 21v-3h6v3" />
                </svg>
                <span class="logo-text">ELMD</span>
            </a>

            <div class="navbar-links">
                <a href="/" class="nav-link">Accueil</a>
                <a href="/#cabinet" class="nav-link">Le Cabinet</a>
                <a href="/#expertises" class="nav-link">Expertises</a>
                <a href="/#equipe" class="nav-link">Équipe</a>
                <a href="/articles" class="nav-link active">Actualités</a>
                <a href="/#contact" class="nav-link">Contact</a>
                <a href="/login" class="nav-link nav-link-highlight">Connexion</a>
            </div>

            <div id="theme-switcher-container" class="theme-switcher-wrapper"></div>

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
                <a href="/" class="mobile-link">
                    <span>Accueil</span>
                    <span class="mobile-link-arrow">→</span>
                </a>
                <a href="/articles" class="mobile-link">
                    <span>Actualités</span>
                    <span class="mobile-link-arrow">→</span>
                </a>
                <a href="/login" class="mobile-link">
                    <span>Connexion</span>
                    <span class="mobile-link-arrow">→</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <article class="article-detail">
        <div class="container">
            <!-- Breadcrumb -->
            <nav class="breadcrumb">
                <a href="/">Accueil</a>
                <span class="separator">›</span>
                <a href="/articles">Actualités</a>
                <span class="separator">›</span>
                <span class="current"><?= htmlspecialchars($article['category_nom'] ?? 'Article') ?></span>
            </nav>

            <!-- Article Header -->
            <header class="article-header">
                <span class="article-category-badge"><?= htmlspecialchars($article['category_nom'] ?? 'Non classé') ?></span>
                <h1 class="article-title"><?= htmlspecialchars($article['titre']) ?></h1>

                <div class="article-meta">
                    <span class="meta-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                        <?= isset($article['publie_le']) ? date('d F Y', strtotime($article['publie_le'])) : '' ?>
                    </span>
                    <span class="meta-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <?= htmlspecialchars($article['avocat_nom'] ?? 'ELMD Cabinet') ?>
                    </span>
                    <span class="meta-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        <?= isset($article['contenu']) ? max(5, min(15, strlen(strip_tags($article['contenu'])) / 500)) . ' min de lecture' : '5 min de lecture' ?>
                    </span>
                </div>
            </header>

            <!-- Article Body -->
            <div class="article-body">
                <?= $article['contenu'] ?? '' ?>
            </div>

            <!-- Article Footer -->
            <footer class="article-footer">
                <div class="article-share">
                    <span class="share-label">Partager cet article :</span>
                    <div class="share-buttons">
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/articles/' . $article['slug']) ?>" target="_blank" rel="noopener" class="share-btn" title="Partager sur LinkedIn">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                <rect x="2" y="9" width="4" height="12" />
                                <circle cx="4" cy="4" r="2" />
                            </svg>
                        </a>
                        <a href="mailto:?subject=<?= urlencode($article['titre']) ?>&body=<?= urlencode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/articles/' . $article['slug']) ?>" class="share-btn" title="Partager par email">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                        </a>
                    </div>
                </div>

                <a href="/articles" class="back-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12" />
                        <polyline points="12 19 5 12 12 5" />
                    </svg>
                    Retour aux articles
                </a>
            </footer>
        </div>
    </article>

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
                </div>

                <div class="footer-links">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="/">Accueil</a></li>
                        <li><a href="/articles">Actualités</a></li>
                        <li><a href="/#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Contact</h4>
                    <ul>
                        <li>Kinshasa, RDC</li>
                        <li>+243 81 234 5678</li>
                        <li>contact@elmd-avocats.cd</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 ELMD Cabinet d'Avocats. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script type="module" src="/js/theme.js"></script>
    <script src="/js/main.js"></script>
</body>

</html>