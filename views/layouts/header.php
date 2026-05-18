<?php
/**
 * ELMD - Cabinet d'Avocats
 * Header Layout
 * 
 * Inclure dans chaque page:
 * require_once __DIR__ . '/../layouts/header.php';
 */

if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

// Récupérer le titre de la page ou utiliser un默认值
$pageTitle = $pageTitle ?? 'ELMD - Cabinet d\'Avocats d\'Excellence';
$pageDescription = $pageDescription ?? 'Cabinet d\'avocats prestigieux offrant une expertise juridique d\'excellence depuis 1985.';
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Styles -->
  <link rel="stylesheet" href="/css/styles.css">
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="/images/logo.png">
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