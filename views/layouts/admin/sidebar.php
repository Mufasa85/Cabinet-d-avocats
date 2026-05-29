<?php
$currentPage = $_SERVER['REQUEST_URI'] ?? '';
?>

<!-- Sidebar Admin Premium -->
<aside class="sidebar" :class="{ 'collapsed': sidebarOpen }">
    <div class="sidebar-header">
        <a href="<?= Router\Router::route('/dashboard') ?>" style="display: flex; align-items: center; gap: 10px;">
        </a>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <span class="nav-section-title">Principal</span>

            <a href="<?= Router\Router::route('/admin/dashboard') ?>" class="nav-item <?= $currentPage === 'dashboard' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-chart-pie"></i></span>
                <span class="nav-item-text">Tableau de Bord</span>
            </a>

            <a href="<?= Router\Router::route('/admin/users') ?>" class="nav-item <?= $currentPage === 'users' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-users"></i></span>
                <span class="nav-item-text">Utilisateurs</span>
            </a>

            <a href="<?= Router\Router::route('/admin/lawyers') ?>" class="nav-item <?= $currentPage === 'lawyers' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-user-tie"></i></span>
                <span class="nav-item-text">Avocats</span>
            </a>

            <a href="<?= Router\Router::route('/admin/candidatures') ?>" class="nav-item <?= $currentPage === 'candidatures' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-file-alt"></i></span>
                <span class="nav-item-text">Candidatures</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">Contenu</span>

            <a href="<?= Router\Router::route('/admin/trainings') ?>" class="nav-item <?= $currentPage === 'trainings' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-graduation-cap"></i></span>
                <span class="nav-item-text">Formations</span>
            </a>

            <a href="<?= Router\Router::route('/admin/publications') ?>" class="nav-item <?= $currentPage === 'publications' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-newspaper"></i></span>
                <span class="nav-item-text">Publications</span>
            </a>

            <a href="<?= Router\Router::route('/admin/documents') ?>" class="nav-item <?= $currentPage === 'documents' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-folder-open"></i></span>
                <span class="nav-item-text">Documents</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">Analyse</span>

            <a href="<?= Router\Router::route('/admin/reports') ?>" class="nav-item <?= $currentPage === 'reports' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-chart-bar"></i></span>
                <span class="nav-item-text">Rapports</span>
            </a>

            <a href="<?= Router\Router::route('/admin/notifications') ?>" class="nav-item <?= $currentPage === 'notifications' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-bell"></i></span>
                <span class="nav-item-text">Notifications</span>
            </a>
        </div>

        <div class="nav-section">
            <span class="nav-section-title">Système</span>

            <a href="<?= Router\Router::route('/admin/settings') ?> " class="nav-item <?= $currentPage === 'settings' ? 'active' : '' ?>">
                <span class="nav-item-icon"><i class="fas fa-cog"></i></span>
                <span class="nav-item-text">Paramètres</span>
            </a>
        </div>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user-row">
            <div class="sidebar-user-avatar"><?= \Core\Auth::initials($_SESSION['user_name'] ?? 'AD') ?></div>
            <div class="sidebar-user-info-row">
                <span class="sidebar-user-name"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?></span>
                <span class="sidebar-user-role"><?= htmlspecialchars($_SESSION['user_role'] ?? 'Administrateur') ?></span>
            </div>
        </div>
        <form action="<?= Router\Router::route('/logout') ?>" method="post">
            <button class="sidebar-logout" type="submit">
                <i class="fas fa-sign-out-alt"></i>
                <span>Déconnexion</span>
            </button>
        </form>
    </div>
</aside>