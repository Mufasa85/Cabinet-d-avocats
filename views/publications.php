<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications & Analyses | ELMD Cabinet d'Avocats</title>
    <meta name="description" content="Publications juridiques et analyses du cabinet ELMD. Études, commentaires et expertises sur l'actualité juridique.">

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
                <a href="/publications" class="nav-link active">Publications</a>
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
                <a href="/publications" class="mobile-link">
                    <span>Publications</span>
                    <span class="mobile-link-arrow">→</span>
                </a>
                <a href="/login" class="mobile-link">
                    <span>Connexion</span>
                    <span class="mobile-link-arrow">→</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="articles-hero">
        <div class="articles-hero-content">
            <span class="articles-hero-subtitle">Études & Analyses</span>
            <h1 class="articles-hero-title">Nos Publications Juridiques</h1>
            <p class="articles-hero-description">Explorez nos analyses approfondies, commentaires et expertises sur l'actualité juridique africaine et internationale.</p>
        </div>
    </section>

    <!-- Publications Grid -->
    <div class="container">
        <?php if (isset($publications) && is_array($publications) && count($publications) > 0): ?>
            <div class="articles-grid">
                <?php
                $first = true;
                foreach ($publications as $pub):
                    $isFeatured = $first;
                    $first = false;
                ?>
                    <article class="article-card <?= $isFeatured ? 'featured-article' : '' ?>">
                        <div class="article-image">
                            <?php if (!empty($pub['image_couverture'])): ?>
                                <img src="<?= \Service\FileStorage::url($pub['image_couverture']) ?>" alt="<?= htmlspecialchars($pub['titre']) ?>" loading="lazy">
                            <?php else: ?>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    <path d="M12 14v7" />
                                </svg>
                            <?php endif; ?>
                            <span class="article-category"><?= htmlspecialchars($pub['type'] ?? 'Publication') ?></span>
                        </div>
                        <div class="article-content">
                            <?php if ($isFeatured): ?>
                                <span class="featured-badge">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                    </svg>
                                    Publication Vedette
                                </span>
                            <?php endif; ?>
                            <h2 class="article-title">
                                <a href="/publications/<?= htmlspecialchars($pub['slug']) ?>">
                                    <?= htmlspecialchars($pub['titre']) ?>
                                </a>
                            </h2>
                            <p class="article-excerpt"><?= htmlspecialchars($pub['description'] ?? '') ?></p>
                            <div class="article-meta">
                                <span class="article-date">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                    <?= isset($pub['publie_le']) ? date('d F Y', strtotime($pub['publie_le'])) : (isset($pub['created_at']) ? date('d F Y', strtotime($pub['created_at'])) : '') ?>
                                </span>
                            </div>
                            <div class="article-footer">
                                <span class="article-read-time">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    <?= isset($pub['contenu']) ? max(5, min(15, strlen(strip_tags($pub['contenu'])) / 500)) . ' min de lecture' : '5 min de lecture' ?>
                                </span>
                                <a href="/publications/<?= htmlspecialchars($pub['slug']) ?>" class="article-link">
                                    Lire la publication
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
                <h3>Aucune publication disponible</h3>
                <p>Les publications apparaîtront ici une fois publiées par notre équipe.</p>
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
                        <li><a href="/">Accueil</a></li>
                        <li><a href="/#cabinet">Le Cabinet</a></li>
                        <li><a href="/#expertises">Expertises</a></li>
                        <li><a href="/#equipe">Équipe</a></li>
                        <li><a href="/publications">Publications</a></li>
                        <li><a href="/stages">Stages</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Domaines</h4>
                    <ul>
                        <li><a href="/administration-affaires">Droit des Affaires</a></li>
                        <li><a href="/droit-minier">Droit Minier</a></li>
                        <li><a href="/droit-fiscal">Droit Fiscal</a></li>
                        <li><a href="/droit-travail">Droit du Travail</a></li>
                        <li><a href="/droit-ohada">Droit OHADA</a></li>
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