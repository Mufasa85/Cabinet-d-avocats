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
  <link rel="stylesheet" href="css/styles.css">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      background: radial-gradient(circle at top, rgba(255,255,255,0.18), transparent 28%),
                  linear-gradient(180deg, #0f172a 0%, #010817 100%);
      color: #f8fafc;
      font-family: 'Inter', sans-serif;
    }
    .error-page {
      width: min(980px, 100%);
      text-align: center;
      padding: 3rem 2rem;
      border: 1px solid rgba(148,163,184,0.22);
      border-radius: 28px;
      backdrop-filter: blur(18px);
      background: rgba(15, 23, 42, 0.85);
      box-shadow: 0 32px 120px rgba(15, 23, 42, 0.45);
    }
    .error-code {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 120px;
      height: 120px;
      margin-bottom: 1.5rem;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(236,72,153,0.95), rgba(59,130,246,0.95));
      font-size: clamp(3rem, 5vw, 4.8rem);
      font-weight: 800;
      color: #fff;
      letter-spacing: -0.04em;
      box-shadow: 0 24px 80px rgba(59,130,246,0.22);
    }
    .error-title {
      font-size: clamp(2.2rem, 4vw, 3.2rem);
      font-weight: 700;
      margin-bottom: 1rem;
      line-height: 1.05;
    }
    .error-description {
      max-width: 720px;
      margin: 0 auto 2rem;
      color: #cbd5e1;
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
      min-width: 170px;
      padding: 0.95rem 1.35rem;
      border-radius: 999px;
      font-weight: 600;
      text-decoration: none;
      color: #fff;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .error-actions a:hover {
      transform: translateY(-2px);
      box-shadow: 0 18px 48px rgba(59,130,246,0.2);
    }
    .error-actions .btn-primary {
      background: linear-gradient(135deg, #22c55e, #14b8a6);
    }
    .error-actions .btn-secondary {
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(148,163,184,0.25);
    }
    @media (max-width: 640px) {
      .error-page { padding: 2rem 1.25rem; }
      .error-actions { flex-direction: column; }
    }
  </style>
</head>
<body>
  <main class="error-page">
    <div class="error-code"><?= htmlspecialchars($statusCode) ?></div>
    <h1 class="error-title">Oops. <?= htmlspecialchars($errorMessage) ?></h1>
    <p class="error-description">Le site ELMD a rencontré un problème lors du chargement de cette page. Vous pouvez revenir à l’accueil ou contacter l’équipe si le problème persiste.</p>
    <div class="error-actions">
      <a class="btn-primary" href="<?= Router::route('/') ?>">Retour à l’accueil</a>
      <a class="btn-secondary" href="<?= Router::route('/login') ?>">Connexion</a>
    </div>
  </main>
</body>
</html>
