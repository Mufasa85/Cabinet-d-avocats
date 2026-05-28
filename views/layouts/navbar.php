<?php
/**
 * ELMD - Cabinet d'Avocats
 * Navbar Layout
 */

if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', '/home/mufasa/Public/ArcaneCore/Projet/Avocats/Cabinet-d-avocats');
}

// Navigation actif
$currentPage = $currentPage ?? basename($_SERVER['PHP_SELF'], '.php');
?>
  <!-- Navbar -->
  <nav id="navbar" class="navbar">
    <div class="navbar-container">
      <a href="/index.php" class="navbar-logo">
        <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
          <circle cx="12" cy="3" r="1" fill="currentColor"/>
          <path d="M7 21h10M9 21v-3h6v3"/>
        </svg>
        <span class="logo-text">ELMD</span>
      </a>
      
      <!-- Desktop Menu -->
      <div class="navbar-links">
        <a href="/index.php#accueil" class="nav-link <?= $currentPage === 'index' ? 'active' : '' ?>">Accueil</a>
        <a href="/index.php#cabinet" class="nav-link">Le Cabinet</a>
        <a href="/index.php#expertises" class="nav-link">Expertises</a>
        <a href="/index.php#equipe" class="nav-link">Équipe</a>
        <a href="/index.php#actualites" class="nav-link">Actualités</a>
        <a href="/index.php#contact" class="nav-link">Contact</a>
        <a href="/stages.php" class="nav-link">Stages</a>
        
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="#" class="nav-link nav-link-highlight">Tableau de bord</a>
        <?php else: ?>
          <a href="<?= Router\Router::route('/login') ?>" class="nav-link nav-link-highlight">Connexion</a>
        <?php endif; ?>
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
            <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
            <circle cx="12" cy="3" r="1" fill="currentColor"/>
            <path d="M7 21h10M9 21v-3h6v3"/>
          </svg>
          <span class="logo-text">ELMD</span>
        </div>
        <button id="mobile-menu-close" class="mobile-menu-close" aria-label="Fermer">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6L6 18M6 6l12 12"/>
          </svg>
        </button>
      </div>
      <div class="mobile-menu-links">
        <a href="/index.php#accueil" class="mobile-link">
          <span>Accueil</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="/index.php#cabinet" class="mobile-link">
          <span>Le Cabinet</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="<?= Router\Router::route('/#expertises') ?> " class="mobile-link">
          <span>Expertises</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="<?= Router\Router::route('/#equipe') ?>" class="mobile-link">
          <span>Équipe</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="/index.php#actualites" class="mobile-link">
          <span>Actualités</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="/index.php#contact" class="mobile-link">
          <span>Contact</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <a href="/stages.php" class="mobile-link">
          <span>Stages</span>
          <span class="mobile-link-arrow">→</span>
        </a>
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="/dashboard.php" class="mobile-link">
            <span>Tableau de bord</span>
            <span class="mobile-link-arrow">→</span>
          </a>
        <?php else: ?>
          <a href="/connexion.php" class="mobile-link">
            <span>Connexion</span>
            <span class="mobile-link-arrow">→</span>
          </a>
        <?php endif; ?>
      </div>
      <div class="mobile-menu-footer">
        <a href="/index.php#contact" class="btn-premium mobile-cta">Prendre Rendez-vous</a>
      </div>
    </div>
  </div>