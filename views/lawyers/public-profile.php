<?php
$avatar = $avocat['avatar'] ?? null;
$defaultAvatar = 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=300&q=80';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Profil Avocat | ELMD' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <style>
        .profile-hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            padding: 4rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .profile-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="%23c9a227" stroke-width="0.5"/></svg>');
            opacity: 0.05;
        }

        .profile-container {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
        }

        .profile-avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--gold, #c9a227);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            margin-bottom: 1.5rem;
        }

        .profile-name {
            font-family: 'Cinzel', serif;
            font-size: 2.5rem;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .profile-titre {
            font-size: 1.25rem;
            color: var(--gold, #c9a227);
            margin-bottom: 1rem;
        }

        .profile-specialties {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
            margin-top: 1rem;
        }

        .specialty-tag {
            background: rgba(201, 162, 39, 0.15);
            border: 1px solid var(--gold, #c9a227);
            color: var(--gold, #c9a227);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .profile-content {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .profile-section {
            background: var(--card-bg, #fff);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .profile-section h2 {
            font-family: 'Cinzel', serif;
            font-size: 1.5rem;
            color: var(--text-primary, #1a1a2e);
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--gold, #c9a227);
        }

        .profile-bio {
            line-height: 1.8;
            color: var(--text-secondary, #666);
        }

        .profile-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .info-icon {
            width: 48px;
            height: 48px;
            background: rgba(201, 162, 39, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold, #c9a227);
            flex-shrink: 0;
        }

        .info-label {
            font-size: 0.85rem;
            color: var(--text-secondary, #999);
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-weight: 500;
            color: var(--text-primary, #1a1a2e);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gold, #c9a227);
            text-decoration: none;
            margin-bottom: 2rem;
            padding: 0.75rem 1.5rem;
            border: 1px solid var(--gold, #c9a227);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            background: var(--gold, #c9a227);
            color: #fff;
        }

        @media (max-width: 768px) {
            .profile-name {
                font-size: 1.75rem;
            }

            .profile-avatar {
                width: 140px;
                height: 140px;
            }
        }
    </style>
</head>

<body>
    <?php include dirname(__DIR__) . '/layouts/public/header.php'; ?>

    <main>
        <section class="profile-hero">
            <div class="profile-container">
                <img
                    src="<?= $avatar ? htmlspecialchars($avatar) : $defaultAvatar ?>"
                    alt="<?= htmlspecialchars($avocat['fullname'] ?? 'Avocat') ?>"
                    class="profile-avatar">
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
        </section>

        <section class="profile-content">
            <a href="<?= Router\Router::route('/') ?>" class="back-link">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Retour a l'accueil
            </a>

            <?php if (!empty($avocat['bio'])): ?>
                <div class="profile-section">
                    <h2>A propos</h2>
                    <p class="profile-bio"><?= nl2br(htmlspecialchars($avocat['bio'])) ?></p>
                </div>
            <?php endif; ?>

            <div class="profile-section">
                <h2>Informations</h2>
                <div class="profile-info-grid">
                    <?php if (!empty($avocat['email_professionnel'])): ?>
                        <div class="info-item">
                            <div class="info-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                            </div>
                            <div>
                                <p class="info-label">Email professionnel</p>
                                <p class="info-value"><?= htmlspecialchars($avocat['email_professionnel']) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($avocat['telephone'])): ?>
                        <div class="info-item">
                            <div class="info-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                </svg>
                            </div>
                            <div>
                                <p class="info-label">Telephone</p>
                                <p class="info-value"><?= htmlspecialchars($avocat['telephone']) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($avocat['bureau'])): ?>
                        <div class="info-item">
                            <div class="info-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                            </div>
                            <div>
                                <p class="info-label">Bureau</p>
                                <p class="info-value"><?= htmlspecialchars($avocat['bureau']) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($avocat['experience'])): ?>
                        <div class="info-item">
                            <div class="info-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                            </div>
                            <div>
                                <p class="info-label">Annees d'experience</p>
                                <p class="info-value"><?= (int)$avocat['experience'] ?> ans</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="profile-section">
                <h2>Nous contacter</h2>
                <p style="margin-bottom: 1rem; color: var(--text-secondary, #666);">
                    Pour prendre rendez-vous avec <?= htmlspecialchars($avocat['fullname'] ?? 'cet avocat') ?>, contactez-nous directement.
                </p>
                <a href="<?= Router\Router::route('/#contact') ?>" class="btn-premium">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    Prendre rendez-vous
                </a>
            </div>
        </section>
    </main>

    <?php include dirname(__DIR__) . '/layouts/public/footer.php'; ?>
</body>

</html>