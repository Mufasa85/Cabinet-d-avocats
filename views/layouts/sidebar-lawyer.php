<?php
/**
 * ELMD - Cabinet d'Avocats
 * Lawyer Sidebar Layout
 */

if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

// Récupérer la page actuelle
$currentPage = basename($_SERVER['PHP_SELF'], '.php');

// Menu actif
$activeMenu = $activeMenu ?? '';

// Récupérer les infos de l'avocat (à adapter selon votre système d'authentification)
$lawyerName = $_SESSION['lawyer_name'] ?? $_SESSION['user_name'] ?? 'Avocat';
$lawyerRole = $_SESSION['lawyer_role'] ?? 'Avocat';
$lawyerAvatar = $_SESSION['lawyer_avatar'] ?? 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=100&q=80';
?>
<!-- Sidebar Lawyer -->
<aside class="sidebar-lawyer">
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
    <!-- Tableau de bord avocat -->
    <a href="<?= ELMD_ROOT ?>/avocat/dashboard.php" class="sidebar-link <?= $currentPage === 'dashboard' || $activeMenu === 'dashboard' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="7" height="7"/>
        <rect x="14" y="3" width="7" height="7"/>
        <rect x="14" y="14" width="7" height="7"/>
        <rect x="3" y="14" width="7" height="7"/>
      </svg>
      <span>Tableau de bord</span>
    </a>

    <!-- Mes dossiers -->
    <a href="<?= ELMD_ROOT ?>/avocat/dossiers.php" class="sidebar-link <?= $currentPage === 'dossiers' || $activeMenu === 'dossiers' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
      </svg>
      <span>Mes dossiers</span>
      <span class="sidebar-badge">5</span>
    </a>

    <!-- Rendez-vous -->
    <a href="<?= ELMD_ROOT ?>/avocat/rendez-vous.php" class="sidebar-link <?= $currentPage === 'rendez-vous' || $activeMenu === 'rendez-vous' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
        <line x1="16" y1="2" x2="16" y2="6"/>
        <line x1="8" y1="2" x2="8" y2="6"/>
        <line x1="3" y1="10" x2="21" y2="10"/>
      </svg>
      <span>Mes rendez-vous</span>
    </a>

    <!-- Clients -->
    <a href="<?= ELMD_ROOT ?>/avocat/clients.php" class="sidebar-link <?= $currentPage === 'clients' || $activeMenu === 'clients' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
        <circle cx="9" cy="7" r="4"/>
        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
      </svg>
      <span>Mes clients</span>
    </a>

    <!-- Agenda -->
    <a href="<?= ELMD_ROOT ?>/avocat/agenda.php" class="sidebar-link <?= $currentPage === 'agenda' || $activeMenu === 'agenda' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"/>
        <polyline points="12 6 12 12 16 14"/>
      </svg>
      <span>Agenda</span>
    </a>

    <!-- Tâches -->
    <a href="<?= ELMD_ROOT ?>/avocat/taches.php" class="sidebar-link <?= $currentPage === 'taches' || $activeMenu === 'taches' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 11l3 3L22 4"/>
        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
      </svg>
      <span>Mes tâches</span>
      <span class="sidebar-badge sidebar-badge-warning">3</span>
    </a>

    <div class="sidebar-divider"></div>

    <!-- Articles du cabinet -->
    <a href="<?= ELMD_ROOT ?>/avocat/articles.php" class="sidebar-link <?= $currentPage === 'articles' || $activeMenu === 'articles' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
        <polyline points="14 2 14 8 20 8"/>
        <line x1="16" y1="13" x2="8" y2="13"/>
        <line x1="16" y1="17" x2="8" y2="17"/>
      </svg>
      <span>Articles</span>
    </a>

    <!-- Documents -->
    <a href="<?= ELMD_ROOT ?>/avocat/documents.php" class="sidebar-link <?= $currentPage === 'documents' || $activeMenu === 'documents' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
        <polyline points="14 2 14 8 20 8"/>
      </svg>
      <span>Documents</span>
    </a>

    <!-- Messages -->
    <a href="<?= ELMD_ROOT ?>/avocat/messages.php" class="sidebar-link <?= $currentPage === 'messages' || $activeMenu === 'messages' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
        <polyline points="22,6 12,13 2,6"/>
      </svg>
      <span>Messages</span>
      <span class="sidebar-badge">2</span>
    </a>

    <div class="sidebar-divider"></div>

    <!-- Profil -->
    <a href="<?= ELMD_ROOT ?>/avocat/profil.php" class="sidebar-link <?= $currentPage === 'profil' || $activeMenu === 'profil' ? 'active' : '' ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
        <circle cx="12" cy="7" r="4"/>
      </svg>
      <span>Mon profil</span>
    </a>

    <!-- Paramètres -->
    <a href="<?= ELMD_ROOT ?>/avocat/parametres.php" class="sidebar-link <?= $currentPage === 'parametres' || $activeMenu === 'parametres' ? 'active' : '' ?>">
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
        <img src="<?= htmlspecialchars($lawyerAvatar) ?>" alt="<?= htmlspecialchars($lawyerName) ?>">
      </div>
      <div class="sidebar-user-info">
        <span class="sidebar-user-name"><?= htmlspecialchars($lawyerName) ?></span>
        <span class="sidebar-user-role"><?= htmlspecialchars($lawyerRole) ?></span>
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