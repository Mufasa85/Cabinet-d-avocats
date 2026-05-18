<?php
/**
 * ELMD - Cabinet d'Avocats
 * Admin Sidebar Layout
 */

if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

// Récupérer la page actuelle
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

// Menu actif
$activeMenu = $activeMenu ?? '';
?>
<!-- Sidebar Admin -->
<aside class="sidebar-admin">
  <div class="sidebar-header">
    <a href="<?= ELMD_ROOT ?>/index.php" class="sidebar-logo">
      <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 3v18M3 12h18M5.5 5.5l13 13M5.5 18.5l13-13"/>
        <circle cx="12" cy="3" r="1" fill="currentColor"/>
        <path d="M7 21h10M9 21v-3h6v3"/>
      </svg>
      <span class="logo-text">ELMD</span>
    </a>
    <button id="sidebar-toggle" class="sidebar-toggle" aria-label="Toggle sidebar">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M3 12h18M3 6h18M3 18h18"/>
      </svg>
    </button>
  </div>

  <nav class="sidebar-nav">
    <!-- Tableau de bord -->
    <a href="<?= ELMD_ROOT ?>/admin/dashboard.php" class="sidebar-link <?= $currentPage === 'dashboard' || $activeMenu === 'dashboard' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="7" height="7"/>
        <rect x="14" y="3" width="7" height="7"/>
        <rect x="14" y="14" width="7" height="7"/>
        <rect x="3" y="14" width="7" height="7"/>
      </svg>
      <span>Tableau de bord</span>
    </a>

    <!-- Gestion des avocats -->
    <div class="sidebar-dropdown">
      <button class="sidebar-dropdown-toggle <?= $activeMenu === 'avocats' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
          <circle cx="9" cy="7" r="4"/>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        <span>Avocats</span>
        <svg class="dropdown-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </button>
      <div class="sidebar-dropdown-content">
        <a href="<?= ELMD_ROOT ?>/admin/avocats/liste.php">Liste des avocats</a>
        <a href="<?= ELMD_ROOT ?>/admin/avocats/ajouter.php">Ajouter un avocat</a>
        <a href="<?= ELMD_ROOT ?>/admin/avocats/specialites.php">Spécialités</a>
      </div>
    </div>

    <!-- Gestion des articles -->
    <div class="sidebar-dropdown">
      <button class="sidebar-dropdown-toggle <?= $activeMenu === 'articles' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14 2 14 8 20 8"/>
          <line x1="16" y1="13" x2="8" y2="13"/>
          <line x1="16" y1="17" x2="8" y2="17"/>
          <polyline points="10 9 9 9 8 9"/>
        </svg>
        <span>Articles</span>
        <svg class="dropdown-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </button>
      <div class="sidebar-dropdown-content">
        <a href="<?= ELMD_ROOT ?>/admin/articles/liste.php">Tous les articles</a>
        <a href="<?= ELMD_ROOT ?>/admin/articles/ajouter.php">Nouvel article</a>
        <a href="<?= ELMD_ROOT ?>/admin/articles/categories.php">Catégories</a>
      </div>
    </div>

    <!-- Gestion des stages -->
    <div class="sidebar-dropdown">
      <button class="sidebar-dropdown-toggle <?= $activeMenu === 'stages' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
          <path d="M6 12v5c3 3 9 3 12 0v-5"/>
        </svg>
        <span>Stages</span>
        <svg class="dropdown-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M6 9l6 6 6-6"/>
        </svg>
      </button>
      <div class="sidebar-dropdown-content">
        <a href="<?= ELMD_ROOT ?>/admin/stages/liste.php">Demandes de stage</a>
        <a href="<?= ELMD_ROOT ?>/admin/stages/offres.php">Offres de stage</a>
        <a href="<?= ELMD_ROOT ?>/admin/stages/stagiaires.php">Stagiaires</a>
      </div>
    </div>

    <!-- Messages -->
    <a href="<?= ELMD_ROOT ?>/admin/messages.php" class="sidebar-link <?= $currentPage === 'messages' || $activeMenu === 'messages' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
        <polyline points="22,6 12,13 2,6"/>
      </svg>
      <span>Messages</span>
      <span class="sidebar-badge">3</span>
    </a>

    <!-- Rendez-vous -->
    <a href="<?= ELMD_ROOT ?>/admin/rendez-vous.php" class="sidebar-link <?= $currentPage === 'rendez-vous' || $activeMenu === 'rendez-vous' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
        <line x1="16" y1="2" x2="16" y2="6"/>
        <line x1="8" y1="2" x2="8" y2="6"/>
        <line x1="3" y1="10" x2="21" y2="10"/>
      </svg>
      <span>Rendez-vous</span>
    </a>

    <!-- Paramètres -->
    <div class="sidebar-divider"></div>
    
    <a href="<?= ELMD_ROOT ?>/admin/parametres.php" class="sidebar-link <?= $currentPage === 'parametres' || $activeMenu === 'parametres' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="3"/>
        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
      </svg>
      <span>Paramètres</span>
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="sidebar-user-avatar">
        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=100&q=80" alt="Admin">
      </div>
      <div class="sidebar-user-info">
        <span class="sidebar-user-name"><?= $_SESSION['user_name'] ?? 'Administrateur' ?></span>
        <span class="sidebar-user-role">Administrateur</span>
      </div>
    </div>
    <a href="<?= ELMD_ROOT ?>/deconnexion.php" class="sidebar-logout">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
        <polyline points="16 17 21 12 16 7"/>
        <line x1="21" y1="12" x2="9" y2="12"/>
      </svg>
      <span>Déconnexion</span>
    </a>
  </div>
</aside>

<style>
/* Sidebar Admin Styles */
.sidebar-admin {
  position: fixed;
  top: 0;
  left: 0;
  width: 280px;
  height: 100vh;
  background: var(--color-card);
  border-right: 1px solid var(--color-border);
  display: flex;
  flex-direction: column;
  z-index: 1000;
  transition: width var(--transition-medium);
}

.sidebar-admin.collapsed {
  width: 80px;
}

.sidebar-admin.collapsed .logo-text,
.sidebar-admin.collapsed .sidebar-link span,
.sidebar-admin.collapsed .sidebar-dropdown-toggle span,
.sidebar-admin.collapsed .sidebar-dropdown-toggle .dropdown-arrow,
.sidebar-admin.collapsed .sidebar-user-info,
.sidebar-admin.collapsed .sidebar-logout span,
.sidebar-admin.collapsed .sidebar-badge {
  display: none;
}

.sidebar-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1.5rem;
  border-bottom: 1px solid var(--color-border);
}

.sidebar-logo {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.sidebar-logo .logo-icon {
  width: 32px;
  height: 32px;
  color: var(--color-primary);
}

.sidebar-logo .logo-text {
  font-family: var(--font-serif);
  font-size: 1.25rem;
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
  width: 20px;
  height: 20px;
}

.sidebar-nav {
  flex: 1;
  padding: 1rem 0;
  overflow-y: auto;
}

.sidebar-link {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 0.875rem 1.5rem;
  color: var(--color-muted-foreground);
  font-size: 0.875rem;
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
  width: 20px;
  height: 20px;
  flex-shrink: 0;
}

.sidebar-badge {
  margin-left: auto;
  padding: 0.25rem 0.5rem;
  background: var(--color-primary);
  color: var(--color-primary-foreground);
  font-size: 0.75rem;
  font-weight: 600;
  border-radius: 10px;
}

.sidebar-dropdown {
  position: relative;
}

.sidebar-dropdown-toggle {
  display: flex;
  align-items: center;
  gap: 1rem;
  width: 100%;
  padding: 0.875rem 1.5rem;
  color: var(--color-muted-foreground);
  font-size: 0.875rem;
  font-weight: 500;
  text-align: left;
  transition: all var(--transition-fast);
}

.sidebar-dropdown-toggle:hover {
  color: var(--color-primary);
  background: var(--color-glass);
}

.sidebar-dropdown-toggle.active {
  color: var(--color-primary);
  background: var(--color-glass);
}

.sidebar-dropdown-toggle svg {
  width: 20px;
  height: 20px;
  flex-shrink: 0;
}

.sidebar-dropdown-toggle .dropdown-arrow {
  margin-left: auto;
  transition: transform var(--transition-fast);
}

.sidebar-dropdown.open .dropdown-arrow {
  transform: rotate(180deg);
}

.sidebar-dropdown-content {
  display: none;
  padding: 0.5rem 0 0.5rem 3.5rem;
}

.sidebar-dropdown.open .sidebar-dropdown-content {
  display: block;
}

.sidebar-dropdown-content a {
  display: block;
  padding: 0.625rem 1rem;
  color: var(--color-muted-foreground);
  font-size: 0.8125rem;
  border-radius: var(--radius-sm);
  transition: all var(--transition-fast);
}

.sidebar-dropdown-content a:hover {
  color: var(--color-primary);
  background: var(--color-glass);
}

.sidebar-divider {
  height: 1px;
  background: var(--color-border);
  margin: 1rem 1.5rem;
}

.sidebar-footer {
  padding: 1rem 1.5rem;
  border-top: 1px solid var(--color-border);
}

.sidebar-user {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 1rem;
}

.sidebar-user-avatar {
  width: 40px;
  height: 40px;
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
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--color-foreground);
}

.sidebar-user-role {
  font-size: 0.75rem;
  color: var(--color-muted-foreground);
}

.sidebar-logout {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem;
  color: var(--color-muted-foreground);
  font-size: 0.875rem;
  border-radius: var(--radius-sm);
  transition: all var(--transition-fast);
}

.sidebar-logout:hover {
  color: #ef4444;
  background: rgba(239, 68, 68, 0.1);
}

.sidebar-logout svg {
  width: 18px;
  height: 18px;
}
</style>