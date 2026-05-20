<?php
/**
 * Cabinet d'Avocats - Admin Sidebar Layout
 * Premium Sidebar for Admin Dashboard
 */

$currentPage = basename($_SERVER['PHP_SELF'], '.php');
$dashboardPath = '/dashboard';
?>

<!-- Sidebar Admin Premium -->
<aside class="sidebar" :class="{ 'collapsed': sidebarOpen }">
    <div class="sidebar-header">
        <a href="<?= $dashboardPath ?>/dashboard.php" class="sidebar-logo" style="display: flex; align-items: center; gap: 10px;">
            <span class="logo-icon" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: var(--gold-gradient); border-radius: 8px; font-size: 1.2rem;"><i class="fas fa-balance-scale"></i></span>
            <span class="logo-text" style="font-family: var(--font-display); font-size: 1rem; font-weight: 600; color: var(--white);">Cabinet</span>
        </a>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <span class="nav-section-title">Principal</span>
            
            <a href="<?= $dashboardPath ?>/dashboard.php" class="nav-item <?= $currentPage === 'dashboard' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-chart-pie"></i></span>
                <span class="nav-item-text">Tableau de Bord</span>
            </a>
            
            <a href="<?= $dashboardPath ?>/users.php" class="nav-item <?= $currentPage === 'users' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-users"></i></span>
                <span class="nav-item-text">Utilisateurs</span>
            </a>
            
            <a href="<?= $dashboardPath ?>/lawyers.php" class="nav-item <?= $currentPage === 'lawyers' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-user-tie"></i></span>
                <span class="nav-item-text">Avocats</span>
            </a>
            
            <a href="<?= $dashboardPath ?>/applications.php" class="nav-item <?= $currentPage === 'applications' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-file-alt"></i></span>
                <span class="nav-item-text">Candidatures</span>
                <span class="nav-item-badge">5</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">Contenu</span>
            
            <a href="<?= $dashboardPath ?>/trainings.php" class="nav-item <?= $currentPage === 'trainings' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-graduation-cap"></i></span>
                <span class="nav-item-text">Formations</span>
            </a>
            
            <a href="<?= $dashboardPath ?>/publications.php" class="nav-item <?= $currentPage === 'publications' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-newspaper"></i></span>
                <span class="nav-item-text">Publications</span>
            </a>
            
            <a href="<?= $dashboardPath ?>/documents.php" class="nav-item <?= $currentPage === 'documents' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-folder-open"></i></span>
                <span class="nav-item-text">Documents</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">Analyse</span>
            
            <a href="<?= $dashboardPath ?>/reports.php" class="nav-item <?= $currentPage === 'reports' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-chart-bar"></i></span>
                <span class="nav-item-text">Rapports</span>
            </a>
            
            <a href="<?= $dashboardPath ?>/notifications.php" class="nav-item <?= $currentPage === 'notifications' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-bell"></i></span>
                <span class="nav-item-text">Notifications</span>
                <span class="nav-item-badge">3</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">Système</span>
            
            <a href="<?= $dashboardPath ?>/settings.php" class="nav-item <?= $currentPage === 'settings' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-cog"></i></span>
                <span class="nav-item-text">Paramètres</span>
            </a>
        </div>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user-row">
            <div class="sidebar-user-avatar">RN</div>
            <div class="sidebar-user-info-row">
                <span class="sidebar-user-name">Randy N</span>
                <span class="sidebar-user-role">Admin Système</span>
            </div>
        </div>
        <a href="../deconnexion.php" class="sidebar-logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Déconnexion</span>
        </a>
    </div>
</aside>