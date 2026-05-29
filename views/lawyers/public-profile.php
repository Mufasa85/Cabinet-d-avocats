<?php
$defaultAvatar = 'https://minimax-algeng-chat-tts-us.oss-us-east-1.aliyuncs.com/ccv2%2F2026-05-28%2FMiniMax-M2.7%2F2046526872820392610%2F44708c25db26409a60992da9859d025f1c713788a154a1195834e12d9105fbb8..png';
$avatar = $avocat['avatar_url'] ?? (!empty($avocat['avatar']) ? \Service\FileStorage::url($avocat['avatar']) : $defaultAvatar);
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($avocat['fullname'] ?? 'Avocat') ?> | ELMD - Cabinet d'Avocats</title>
    <meta name="description" content="Profil de <?= htmlspecialchars($avocat['fullname'] ?? 'Avocat') ?> - <?= htmlspecialchars($avocat['titre'] ?? 'Avocat') ?> au Cabinet ELMD">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
    <!-- Navbar -->
    <nav id="navbar" class="navbar">
        <div class="navbar-container">
            <a href="<?= Router\Router::route('/') ?>" class="navbar-logo">
                <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
                    <circle cx="12" cy="3" r="1" fill="currentColor" />
                    <path d="M7 21h10M9 21v-3h6v3" />
                </svg>
                <span class="logo-text">ELMD</span>
            </a>

            <!-- Desktop Menu -->
            <div class="navbar-links">
                <a href="<?= Router\Router::route('/') ?>#accueil" class="nav-link">Accueil</a>
                <a href="<?= Router\Router::route('/') ?>#cabinet" class="nav-link">Cabinet</a>
                <a href="<?= Router\Router::route('/') ?>#expertises" class="nav-link">Expertises</a>
                <a href="<?= Router\Router::route('/') ?>#equipe" class="nav-link">Équipe</a>
                <a href="<?= Router\Router::route('/') ?>#actualites" class="nav-link">Actualités</a>
                <a href="<?= Router\Router::route('/') ?>#contact" class="nav-link">Contact</a>
                <a href="<?= Router\Router::route('/stages') ?>" class="nav-link">Stages</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?= Core\Auth::redirectUrlForDbRole(Core\Auth::role()) ?>" class="nav-link">Tableau de bord</a>
                <?php else: ?>
                    <a href="<?= Router\Router::route('/login') ?>" class="nav-link nav-link-highlight">Connexion</a>
                <?php endif; ?>
            </div>

            <a href="<?= Router\Router::route('/') ?>#contact" class="navbar-cta">Consultation</a>

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
                <a href="<?= Router\Router::route('/') ?>#accueil" class="mobile-link">
                    <span>Accueil</span>
                    <span class="mobile-link-arrow">→</span>
                </a>
                <a href="<?= Router\Router::route('/') ?>#cabinet" class="mobile-link">
                    <span>Le Cabinet</span>
                    <span class="mobile-link-arrow">→</span>
                </a>
                <a href="<?= Router\Router::route('/') ?>#expertises" class="mobile-link">
                    <span>Expertises</span>
                    <span class="mobile-link-arrow">→</span>
                </a>
                <a href="<?= Router\Router::route('/') ?>#equipe" class="mobile-link">
                    <span>Équipe</span>
                    <span class="mobile-link-arrow">→</span>
                </a>
                <a href="<?= Router\Router::route('/') ?>#actualites" class="mobile-link">
                    <span>Actualités</span>
                    <span class="mobile-link-arrow">→</span>
                </a>
                <a href="<?= Router\Router::route('/') ?>#contact" class="mobile-link">
                    <span>Contact</span>
                    <span class="mobile-link-arrow">→</span>
                </a>
                <a href="<?= Router\Router::route('/login') ?>" class="mobile-link">
                    <span>Connexion</span>
                    <span class="mobile-link-arrow">→</span>
                </a>
            </div>
            <div class="mobile-menu-footer">
                <a href="<?= Router\Router::route('/') ?>#contact" class="btn-premium mobile-cta">Prendre Rendez-vous</a>
            </div>
        </div>
    </div>

    <!-- Profile Hero -->
    <section class="profile-hero" style="margin-top: 80px;">
        <div class="profile-hero-bg"></div>
        <div class="profile-hero-overlay"></div>
        <div class="container">
            <a href="<?= Router\Router::route('/') ?>#equipe" class="back-link">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Retour à l'équipe
            </a>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="profile-section">
        <div class="container">
            <div class="profile-grid">
                <!-- Profile Card -->
                <div class="profile-card animate-on-scroll">
                    <div class="profile-header">
                        <div class="profile-avatar-wrapper">
                            <img src="<?= $avatar ? htmlspecialchars($avatar) : $defaultAvatar ?>" alt="<?= htmlspecialchars($avocat['fullname'] ?? 'Avocat') ?>" class="profile-avatar">
                            <div class="profile-avatar-ring"></div>
                        </div>
                        <div class="profile-badge">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
                            </svg>
                        </div>
                    </div>
                    <div class="profile-info">
                        <h1 class="profile-name"><?= htmlspecialchars($avocat['fullname'] ?? 'Avocat') ?></h1>
                        <p class="profile-titre"><?= htmlspecialchars($avocat['titre'] ?? 'Avocat') ?></p>
                        <?php if (!empty($avocat['specialites'])): ?>
                            <div class="profile-specialties">
                                <?php foreach (explode(',', $avocat['specialites']) as $spec): ?>
                                    <span class="specialty-tag"><?= htmlspecialchars(trim($spec)) ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Profile Details -->
                <div class="profile-details">
                    <?php if (!empty($avocat['bio'])): ?>
                        <div class="profile-about animate-on-scroll">
                            <h2 class="profile-section-title">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                                À propos
                            </h2>
                            <p class="profile-bio"><?= nl2br(htmlspecialchars($avocat['bio'])) ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="profile-contact animate-on-scroll">
                        <h2 class="profile-section-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                            </svg>
                            Coordonnées
                        </h2>
                        <div class="contact-cards">
                            <?php if (!empty($avocat['email_professionnel'])): ?>
                                <a href="mailto:<?= htmlspecialchars($avocat['email_professionnel']) ?>" class="contact-card">
                                    <div class="contact-card-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                            <polyline points="22,6 12,13 2,6" />
                                        </svg>
                                    </div>
                                    <div class="contact-card-content">
                                        <span class="contact-card-label">Email</span>
                                        <span class="contact-card-value"><?= htmlspecialchars($avocat['email_professionnel']) ?></span>
                                    </div>
                                    <svg class="contact-card-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M5 12h14M12 5l7 7-7 7" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($avocat['telephone'])): ?>
                                <a href="tel:<?= htmlspecialchars($avocat['telephone']) ?>" class="contact-card">
                                    <div class="contact-card-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                        </svg>
                                    </div>
                                    <div class="contact-card-content">
                                        <span class="contact-card-label">Téléphone</span>
                                        <span class="contact-card-value"><?= htmlspecialchars($avocat['telephone']) ?></span>
                                    </div>
                                    <svg class="contact-card-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M5 12h14M12 5l7 7-7 7" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($avocat['bureau'])): ?>
                                <div class="contact-card">
                                    <div class="contact-card-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                    </div>
                                    <div class="contact-card-content">
                                        <span class="contact-card-label">Bureau</span>
                                        <span class="contact-card-value"><?= htmlspecialchars($avocat['bureau']) ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($avocat['experience'])): ?>
                                <div class="contact-card">
                                    <div class="contact-card-icon">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10" />
                                            <polyline points="12 6 12 12 16 14" />
                                        </svg>
                                    </div>
                                    <div class="contact-card-content">
                                        <span class="contact-card-label">Expérience</span>
                                        <span class="contact-card-value"><?= (int)$avocat['experience'] ?> ans</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="profile-cta animate-on-scroll">
                        <a href="<?= Router\Router::route('/') ?>#contact" class="btn-premium profile-cta-btn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                            Prendre rendez-vous
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="<?= Router\Router::route('/') ?>" class="navbar-logo">
                        <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
                            <circle cx="12" cy="3" r="1" fill="currentColor" />
                            <path d="M7 21h10M9 21v-3h6v3" />
                        </svg>
                        <span class="logo-text">ELMD</span>
                    </a>
                    <p class="footer-tagline">L'excellence juridique au service de votre réussite depuis 1985.</p>
                </div>

                <div class="footer-links">
                    <h4>Le Cabinet</h4>
                    <ul>
                        <li><a href="<?= Router\Router::route('/') ?>#cabinet">Notre Histoire</a></li>
                        <li><a href="<?= Router\Router::route('/') ?>#equipe">Notre Équipe</a></li>
                        <li><a href="<?= Router\Router::route('/') ?>#expertises">Nos Expertises</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Contact</h4>
                    <ul>
                        <li>448, Avenue Maduda</li>
                        <li>Kolwezi, Lualaba</li>
                        <li>+243 811 403 315</li>
                        <li>laurentmbako@etudelmbako.com</li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 ELMD Avocats. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script type="module" src="/js/theme.js"></script>
    <script type="module" src="/js/main.js"></script>
</body>

</html>

<style>
    /* Profile Page Specific Styles */
    .profile-hero {
        position: relative;
        height: 150px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .profile-hero-bg {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--color-muted) 0%, var(--color-background) 100%);
    }

    .profile-hero-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 30% 50%, rgba(201, 162, 39, 0.1) 0%, transparent 50%);
    }

    .back-link {
        position: relative;
        z-index: 10;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--color-primary);
        font-weight: 500;
        transition: gap var(--transition-fast);
    }

    .back-link:hover {
        gap: 0.75rem;
    }

    .profile-section {
        padding: 4rem 0;
    }

    .profile-grid {
        display: grid;
        gap: 3rem;
    }

    @media (min-width: 1024px) {
        .profile-grid {
            grid-template-columns: 400px 1fr;
            gap: 4rem;
        }
    }

    .profile-card {
        background: var(--color-card);
        border-radius: var(--radius-lg);
        border: 1px solid var(--color-border);
        overflow: hidden;
    }

    .profile-header {
        position: relative;
        padding: 3rem 2rem;
        background: linear-gradient(135deg, var(--color-muted) 0%, var(--color-card) 100%);
        text-align: center;
    }

    .profile-avatar-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-avatar {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--color-primary);
        position: relative;
        z-index: 2;
    }

    .profile-avatar-ring {
        position: absolute;
        inset: -8px;
        border: 2px solid var(--color-primary);
        border-radius: 50%;
        opacity: 0.3;
    }

    .profile-badge {
        position: absolute;
        bottom: -20px;
        right: calc(50% - 80px);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--color-primary);
        border-radius: 50%;
        color: var(--color-primary-foreground);
        z-index: 3;
    }

    .profile-badge svg {
        width: 20px;
        height: 20px;
    }

    .profile-info {
        padding: 2.5rem 2rem;
        text-align: center;
    }

    .profile-name {
        font-family: var(--font-serif);
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .profile-titre {
        font-size: 1rem;
        color: var(--color-primary);
        margin-bottom: 1.5rem;
    }

    .profile-specialties {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
    }

    .specialty-tag {
        padding: 0.375rem 1rem;
        background: rgba(201, 162, 39, 0.1);
        border: 1px solid var(--color-primary);
        color: var(--color-primary);
        border-radius: var(--radius-sm);
        font-size: 0.8125rem;
    }

    .profile-details {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .profile-section-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-family: var(--font-serif);
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--color-primary);
    }

    .profile-section-title svg {
        width: 24px;
        height: 24px;
        color: var(--color-primary);
    }

    .profile-bio {
        color: var(--color-muted-foreground);
        line-height: 1.8;
    }

    .contact-cards {
        display: grid;
        gap: 1rem;
    }

    @media (min-width: 640px) {
        .contact-cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .contact-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem;
        background: var(--color-card);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-md);
        transition: all var(--transition-fast);
        text-decoration: none;
        color: inherit;
    }

    .contact-card:hover {
        border-color: var(--color-primary);
        transform: translateY(-2px);
    }

    .contact-card-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(201, 162, 39, 0.1);
        border-radius: 8px;
        flex-shrink: 0;
    }

    .contact-card-icon svg {
        width: 24px;
        height: 24px;
        color: var(--color-primary);
    }

    .contact-card-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .contact-card-label {
        font-size: 0.75rem;
        color: var(--color-muted-foreground);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .contact-card-value {
        font-weight: 600;
        font-size: 0.9375rem;
    }

    .contact-card-arrow {
        width: 20px;
        height: 20px;
        color: var(--color-muted-foreground);
        flex-shrink: 0;
    }

    .profile-cta {
        padding-top: 1rem;
    }

    .profile-cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
    }

    .profile-cta-btn svg {
        width: 20px;
        height: 20px;
    }
</style>