<?php
$avatar = $avocat['avatar'] ?? null;
$defaultAvatar = 'https://minimax-algeng-chat-tts-us.oss-us-east-1.aliyuncs.com/ccv2%2F2026-05-28%2FMiniMax-M2.7%2F2046526872820392610%2F44708c25db26409a60992da9859d025f1c713788a154a1195834e12d9105fbb8..png';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($avocat['fullname'] ?? 'Avocat') ?> | ELMD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary, #f8f9fa);
            color: var(--text-primary, #1a1a2e);
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gold, #c9a227);
            text-decoration: none;
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .back-btn:hover {
            text-decoration: underline;
        }

        .profile-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            padding: 3rem 2rem;
            text-align: center;
        }

        .profile-avatar {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--gold, #c9a227);
            margin-bottom: 1.5rem;
        }

        .profile-name {
            font-family: 'Cinzel', serif;
            font-size: 2rem;
            color: white;
            margin-bottom: 0.5rem;
        }

        .profile-titre {
            font-size: 1.1rem;
            color: var(--gold, #c9a227);
            margin-bottom: 1rem;
        }

        .specialties {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }

        .spec-tag {
            background: rgba(201, 162, 39, 0.2);
            border: 1px solid var(--gold, #c9a227);
            color: var(--gold, #c9a227);
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .profile-body {
            padding: 2rem;
        }

        .section-title {
            font-family: 'Cinzel', serif;
            font-size: 1.3rem;
            color: var(--text-primary);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--gold, #c9a227);
        }

        .bio-text {
            line-height: 1.8;
            color: #555;
            margin-bottom: 1.5rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .info-box {
            background: var(--bg-secondary, #f8f9fa);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
        }

        .info-icon {
            color: var(--gold, #c9a227);
            margin-bottom: 0.5rem;
        }

        .info-label {
            font-size: 0.8rem;
            color: #999;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-weight: 600;
            color: var(--text-primary);
        }

        .cta-section {
            text-align: center;
            padding: 2rem;
            border-top: 1px solid #eee;
        }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--gold, #c9a227);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s;
        }

        .cta-btn:hover {
            background: #b8922a;
        }

        @media (max-width: 768px) {
            .profile-name {
                font-size: 1.5rem;
            }

            .profile-avatar {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>

<body>
    <?php include dirname(__DIR__) . '/../index.php'; // Use main site's header if exists, else minimal header 
    ?>

    <div class="container">
        <a href="<?= Router\Router::route('/') ?>#equipe" class="back-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
            Retour a l'equipe
        </a>

        <div class="profile-card">
            <div class="profile-header">
                <img src="<?= $avatar ? htmlspecialchars($avatar) : $defaultAvatar ?>" alt="<?= htmlspecialchars($avocat['fullname'] ?? 'Avocat') ?>" class="profile-avatar">
                <h1 class="profile-name"><?= htmlspecialchars($avocat['fullname'] ?? 'Avocat') ?></h1>
                <p class="profile-titre"><?= htmlspecialchars($avocat['titre'] ?? 'Avocat') ?></p>
                <?php if (!empty($avocat['specialites'])): ?>
                    <div class="specialties">
                        <?php foreach (explode(',', $avocat['specialites']) as $spec): ?>
                            <span class="spec-tag"><?= htmlspecialchars(trim($spec)) ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="profile-body">
                <?php if (!empty($avocat['bio'])): ?>
                    <h2 class="section-title">A propos</h2>
                    <p class="bio-text"><?= nl2br(htmlspecialchars($avocat['bio'])) ?></p>
                <?php endif; ?>

                <h2 class="section-title">Coordonnees</h2>
                <div class="info-grid">
                    <?php if (!empty($avocat['email_professionnel'])): ?>
                        <div class="info-box">
                            <div class="info-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg></div>
                            <p class="info-label">Email</p>
                            <p class="info-value"><?= htmlspecialchars($avocat['email_professionnel']) ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($avocat['telephone'])): ?>
                        <div class="info-box">
                            <div class="info-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                </svg></div>
                            <p class="info-label">Telephone</p>
                            <p class="info-value"><?= htmlspecialchars($avocat['telephone']) ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($avocat['bureau'])): ?>
                        <div class="info-box">
                            <div class="info-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg></div>
                            <p class="info-label">Bureau</p>
                            <p class="info-value"><?= htmlspecialchars($avocat['bureau']) ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($avocat['experience'])): ?>
                        <div class="info-box">
                            <div class="info-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg></div>
                            <p class="info-label">Experience</p>
                            <p class="info-value"><?= (int)$avocat['experience'] ?> ans</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="cta-section">
                    <a href="<?= Router\Router::route('/#contact') ?>" class="cta-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
</body>

</html>