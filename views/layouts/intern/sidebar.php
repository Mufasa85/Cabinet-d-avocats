<?php
use Core\Auth;
$uri = $_SERVER['REQUEST_URI'] ?? '';
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <a href="<?= Router\Router::route('/interns/dashboard') ?>" class="sidebar-logo">
            <span class="logo-icon"><i class="fas fa-user-graduate"></i></span>
            <span class="logo-text">Stagiaire</span>
        </a>
    </div>
    <nav class="sidebar-nav">
        <a href="<?= Router\Router::route('/interns/dashboard') ?>" class="nav-item <?= str_contains($uri, 'dashboard') ? 'active' : '' ?>">
            <span class="nav-item-icon"><i class="fas fa-home"></i></span>
            <span class="nav-item-text">Tableau de bord</span>
        </a>
        <a href="<?= Router\Router::route('/interns/documents') ?>" class="nav-item <?= str_contains($uri, 'documents') ? 'active' : '' ?>">
            <span class="nav-item-icon"><i class="fas fa-file-upload"></i></span>
            <span class="nav-item-text">Documents</span>
        </a>
        <a href="<?= Router\Router::route('/interns/trainings') ?>" class="nav-item <?= str_contains($uri, 'trainings') ? 'active' : '' ?>">
            <span class="nav-item-icon"><i class="fas fa-graduation-cap"></i></span>
            <span class="nav-item-text">Formations</span>
        </a>
        <a href="<?= Router\Router::route('/interns/notifications') ?>" class="nav-item <?= str_contains($uri, 'notifications') ? 'active' : '' ?>">
            <span class="nav-item-icon"><i class="fas fa-bell"></i></span>
            <span class="nav-item-text">Notifications</span>
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="sidebar-user-row">
            <div class="sidebar-user-avatar"><?= Auth::initials($_SESSION['user_name'] ?? 'ST') ?></div>
            <div class="sidebar-user-info-row">
                <span class="sidebar-user-name"><?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></span>
                <span class="sidebar-user-role">Stagiaire</span>
            </div>
        </div>
        <a href="<?= Router\Router::route('/logout') ?>" class="sidebar-logout">
            <i class="fas fa-sign-out-alt"></i><span>Déconnexion</span>
        </a>
    </div>
</aside>
