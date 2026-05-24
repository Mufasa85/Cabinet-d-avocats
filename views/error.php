<?php
use Router\Router;

$statusCode = $statusCode ?? 500;
$errorMessage = $errorMessage ?? 'Une erreur est survenue lors du traitement de votre requête.';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Erreur <?= htmlspecialchars($statusCode) ?> - ELMD</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/css/styles.css">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      background: var(--color-background);
      color: var(--color-foreground);
      font-family: var(--font-sans);
    }
    .error-page {
      width: min(980px, 100%);
      text-align: center;
      padding: 3rem 2rem;
      border: 1px solid var(--color-border);
      border-radius: var(--radius-lg);
      backdrop-filter: blur(18px);
      background: var(--color-card);
      box-shadow: var(--shadow-lg);
    }
    .error-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 120px;
      height: 120px;
      margin-bottom: 1.5rem;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--color-primary), #b8911f);
      color: var(--color-primary-foreground);
    }
    .error-icon svg {
      width: 60px;
      height: 60px;
    }
    .error-title {
      font-family: var(--font-serif);
      font-size: clamp(4rem, 10vw, 6rem);
      font-weight: 700;
      margin-bottom: 0.5rem;
      line-height: 1;
      color: var(--color-primary);
      letter-spacing: -0.04em;
    }
    .error-subtitle {
      font-family: var(--font-serif);
      font-size: clamp(1.5rem, 3vw, 2rem);
      font-weight: 500;
      margin-bottom: 1.5rem;
      color: var(--color-muted-foreground);
    }
    .error-description {
      max-width: 720px;
      margin: 0 auto 2rem;
      color: var(--color-muted-foreground);
      font-size: 1rem;
      line-height: 1.8;
    }
    .error-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      justify-content: center;
    }
    .error-actions a {
      display: inline-block;
      min-width: 170px;
      padding: 0.875rem 2rem;
      border-radius: 4px;
      font-weight: 600;
      font-size: 0.875rem;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      text-decoration: none;
      transition: all var(--transition-medium);
    }
    .error-actions a:hover {
      transform: translateY(-2px);
    }
    .error-actions .btn-primary {
      background: linear-gradient(135deg, var(--color-primary), #b8911f);
      color: var(--color-primary-foreground);
    }
    .error-actions .btn-primary:hover {
      box-shadow: 0 10px 30px rgba(201, 162, 39, 0.3);
    }
    .error-actions .btn-secondary {
      background: transparent;
      border: 1px solid var(--color-primary);
      color: var(--color-primary);
    }
    .error-actions .btn-secondary:hover {
      background: var(--color-primary);
      color: var(--color-primary-foreground);
    }
    @media (max-width: 640px) {
      .error-page { padding: 2rem 1.25rem; }
      .error-actions { flex-direction: column; }
    }
  </style>
</head>
<body>
  <main class="error-page">
    <div class="error-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
        <circle cx="12" cy="3" r="1" fill="currentColor"/>
        <path d="M7 21h10M9 21v-3h6v3"/>
      </svg>
    </div>
    <h1 class="error-title"><?= htmlspecialchars($statusCode) ?></h1>
    <h2 class="error-subtitle"><?= htmlspecialchars($errorMessage) ?></h2>
    <p class="error-description">Le site ELMD a rencontré un problème lors du chargement de cette page. Vous pouvez revenir à l'accueil ou contacter l'équipe si le problème persiste.</p>
    <div class="error-actions">
      <a class="btn-primary" href="<?= Router::route('/') ?>">Retour à l'accueil</a>
      <a class="btn-secondary" href="<?= Router::route('/login') ?>">Connexion</a>
    </div>
  </main>
</body>
</html>
