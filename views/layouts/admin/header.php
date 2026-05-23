<?php
/**
 * ELMD - Cabinet d'Avocats
 * Admin Header Layout
 */

if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$pageTitle = $pageTitle ?? 'Administration - ELMD';
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="Administration du Cabinet d'Avocats ELMD">
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Styles -->
  <link rel="stylesheet" href="/css/dash_admin.css">
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="/images/logo.png">
</head>
<body>
  <!-- Sidebar Overlay for Mobile -->
  <div class="sidebar-overlay"></div>
  
  <!-- Admin Wrapper -->
  <div class="admin-wrapper">