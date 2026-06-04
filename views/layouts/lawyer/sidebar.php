<?php

$currentPage = basename($_SERVER['PHP_SELF'], '.php');

// Menu actif
$activeMenu = $activeMenu ?? '';

// Récupérer les infos de l'avocat depuis la session
$lawyerName = $_SESSION['user_name'] ?? 'Avocat';
$lawyerRole = $_SESSION['user_role'] ?? 'Avocat';
$lawyerInitials = \Core\Auth::initials($lawyerName);
$lawyerAvatar = $_SESSION['avatar'] ?? null;
?>
<!-- Sidebar Lawyer -->
<aside class="sidebar-lawyer">
  <div class="sidebar-header">
    <a href="<?= Router\Router::route('/') ?>" class="sidebar-logo">
      <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13" />
        <circle cx="12" cy="3" r="1" fill="currentColor" />
        <path d="M7 21h10M9 21v-3h6v3" />
      </svg>
      <span class="logo-text">ELMD</span>
    </a>
    <button id="sidebar-toggle" class="sidebar-toggle" aria-label="Toggle sidebar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M3 12h18M3 6h18M3 18h18" />
      </svg>
    </button>
  </div>

  <nav class="sidebar-nav">
    <!-- Tableau de bord avocat -->
    <a href="<?= Router\Router::route('/lawyers/dashboard') ?>" class="sidebar-link <?= $currentPage === 'dashboard' || $activeMenu === 'dashboard' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="7" height="7" />
        <rect x="14" y="3" width="7" height="7" />
        <rect x="14" y="14" width="7" height="7" />
        <rect x="3" y="14" width="7" height="7" />
      </svg>
      <span>Tableau de bord</span>
    </a>

    <!-- Articles du cabinet -->
    <a href="<?= Router\Router::route('/lawyers/articles') ?>" class="sidebar-link <?= $currentPage === 'articles' || $activeMenu === 'articles' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
        <polyline points="14 2 14 8 20 8" />
        <line x1="16" y1="13" x2="8" y2="13" />
        <line x1="16" y1="17" x2="8" y2="17" />
      </svg>
      <span>Articles</span>
    </a>

    <!-- Documents -->
    <a href="<?= Router\Router::route('/lawyers/documents') ?>" class="sidebar-link <?= $currentPage === 'documents' || $activeMenu === 'documents' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
        <polyline points="14 2 14 8 20 8" />
      </svg>
      <span>Documents</span>
    </a>

    <!-- Formations -->
    <a href="<?= Router\Router::route('/lawyers/trainings') ?>" class="sidebar-link <?= $currentPage === 'trainings' || $activeMenu === 'trainings' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
        <path d="M6 12v5c3 3 9 3 12 0v-5" />
      </svg>
      <span>Formations</span>
    </a>

    <div class="sidebar-divider"></div>

    <!-- Notifications -->
    <a href="<?= Router\Router::route('/lawyers/notifications') ?>" class="sidebar-link <?= $currentPage === 'notifications' || $activeMenu === 'notifications' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
      </svg>
      <span>Notifications</span>
      <?php if (!empty($unreadCount) && $unreadCount > 0): ?>
        <span class="sidebar-badge"><?= $unreadCount > 99 ? '99+' : $unreadCount ?></span>
      <?php endif; ?>
    </a>

    <!-- Profil -->
    <a href="<?= Router\Router::route('/lawyers/profile') ?>" class="sidebar-link <?= $currentPage === 'profil' || $currentPage === 'profile' || $activeMenu === 'profil' || $activeMenu === 'profile' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
        <circle cx="12" cy="7" r="4" />
      </svg>
      <span>Mon profil</span>
    </a>

    <!-- Paramètres -->
    <a href="<?= Router\Router::route('/lawyers/settings') ?>" class="sidebar-link <?= $currentPage === 'parametres' || $currentPage === 'settings' || $activeMenu === 'parametres' || $activeMenu === 'settings' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="3" />
        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
      </svg>
      <span>Paramètres</span>
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="sidebar-user-avatar">
        <?php if ($lawyerAvatar): ?>
          <img src="<?= htmlspecialchars($lawyerAvatar) ?>" alt="<?= htmlspecialchars($lawyerName) ?>">
        <?php else: ?>
          <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; font-size: 0.875rem; font-weight: 600; color: var(--color-primary);"><?= htmlspecialchars($lawyerInitials) ?></span>
        <?php endif; ?>
      </div>
      <div class="sidebar-user-info">
        <span class="sidebar-user-name"><?= htmlspecialchars($lawyerName) ?></span>
        <span class="sidebar-user-role"><?= htmlspecialchars($lawyerRole) ?></span>
      </div>
    </div>

    <form action="<?= Router\Router::route('/logout') ?>" method="post">
      <button class="sidebar-logout" type="submit">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
          <polyline points="16 17 21 12 16 7" />
          <line x1="21" y1="12" x2="9" y2="12" />
        </svg>
        <span>Déconnexion</span>
      </button>
    </form>

  </div>
</aside>

<style>
  /* Sidebar Lawyer Styles - Version plus épurée pour les avocats */
  .sidebar-lawyer {
    position: fixed;
    top: 0;
    left: 0;
    width: 260px;
    height: 100vh;
    background: var(--color-card);
    border-right: 1px solid var(--color-border);
    display: flex;
    flex-direction: column;
    z-index: 1000;
    transition: width var(--transition-medium);
  }

  .sidebar-lawyer.collapsed {
    width: 80px;
  }

  .sidebar-lawyer.collapsed .logo-text,
  .sidebar-lawyer.collapsed .sidebar-link span,
  .sidebar-lawyer.collapsed .sidebar-user-info,
  .sidebar-lawyer.collapsed .sidebar-logout span,
  .sidebar-lawyer.collapsed .sidebar-badge {
    display: none;
  }

  .sidebar-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--color-border);
  }

  .sidebar-logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .sidebar-logo .logo-icon {
    width: 28px;
    height: 28px;
    color: var(--color-primary);
  }

  .sidebar-logo .logo-text {
    font-family: var(--font-serif);
    font-size: 1.125rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    color: var(--color-foreground);
  }

  .sidebar-toggle {
    padding: 0.5rem;
    color: var(--color-muted-foreground);
    transition: color var(--transition-fast);
  }

  .sidebar-toggle:hover {
    color: var(--color-primary);
  }

  .sidebar-toggle svg {
    width: 18px;
    height: 18px;
  }

  .sidebar-nav {
    flex: 1;
    padding: 0.75rem 0;
    overflow-y: auto;
  }

  .sidebar-link {
    display: flex;
    align-items: center;
    gap: 0.875rem;
    padding: 0.75rem 1.5rem;
    color: var(--color-muted-foreground);
    font-size: 0.8125rem;
    font-weight: 500;
    transition: all var(--transition-fast);
    position: relative;
  }

  .sidebar-link:hover {
    color: var(--color-primary);
    background: var(--color-glass);
  }

  .sidebar-link.active {
    color: var(--color-primary);
    background: var(--color-glass);
  }

  .sidebar-link.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: var(--color-primary);
  }

  .sidebar-link svg {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
  }

  .sidebar-badge {
    margin-left: auto;
    padding: 0.125rem 0.5rem;
    background: var(--color-primary);
    color: var(--color-primary-foreground);
    font-size: 0.6875rem;
    font-weight: 600;
    border-radius: 10px;
  }

  .sidebar-badge-warning {
    background: #f59e0b;
    color: #fff;
  }

  .sidebar-divider {
    height: 1px;
    background: var(--color-border);
    margin: 0.75rem 1.5rem;
  }

  .sidebar-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--color-border);
  }

  .sidebar-user {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.875rem;
  }

  .sidebar-user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid var(--color-primary);
  }

  .sidebar-user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .sidebar-user-info {
    display: flex;
    flex-direction: column;
  }

  .sidebar-user-name {
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--color-foreground);
  }

  .sidebar-user-role {
    font-size: 0.6875rem;
    color: var(--color-muted-foreground);
  }

  .sidebar-logout {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.625rem;
    color: var(--color-muted-foreground);
    font-size: 0.8125rem;
    border-radius: var(--radius-sm);
    transition: all var(--transition-fast);
  }

  .sidebar-logout:hover {
    color: #ef4444;
    background: rgba(239, 68, 68, 0.1);
  }

  .sidebar-logout svg {
    width: 16px;
    height: 16px;
  }
</style>