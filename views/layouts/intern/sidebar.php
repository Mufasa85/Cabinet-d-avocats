<?php

use Core\Auth;

$uri = $_SERVER['REQUEST_URI'] ?? '';
?>
<!-- Mobile Menu Toggle Button -->
<button class="sidebar-mobile-toggle" @click="sidebarOpen = !sidebarOpen" aria-label="Menu">
    <i class="fas fa-bars"></i>
</button>

<!-- Mobile Overlay -->
<div class="sidebar-overlay" :class="{ 'active': sidebarOpen }" @click="sidebarOpen = false"></div>

<aside class="sidebar" :class="{ 'mobile-open': sidebarOpen }">
    <div class="sidebar-header">
        <a href="<?= Router\Router::route('/interns/dashboard') ?>" class="sidebar-logo">
        </a>
        <button class="sidebar-close" @click="sidebarOpen = false" aria-label="Fermer">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <nav class="sidebar-nav">
        <a href="<?= Router\Router::route('/interns/dashboard') ?>" class="nav-item <?= str_contains($uri, 'dashboard') ? 'active' : '' ?>" @click="sidebarOpen = false">
            <span class="nav-item-icon"><i class="fas fa-home"></i></span>
            <span class="nav-item-text">Tableau de bord</span>
        </a>
        <a href="<?= Router\Router::route('/interns/documents') ?>" class="nav-item <?= str_contains($uri, 'documents') ? 'active' : '' ?>" @click="sidebarOpen = false">
            <span class="nav-item-icon"><i class="fas fa-file-upload"></i></span>
            <span class="nav-item-text">Documents</span>
        </a>
        <a href="<?= Router\Router::route('/interns/trainings') ?>" class="nav-item <?= str_contains($uri, 'trainings') ? 'active' : '' ?>" @click="sidebarOpen = false">
            <span class="nav-item-icon"><i class="fas fa-graduation-cap"></i></span>
            <span class="nav-item-text">Formations</span>
        </a>
        <a href="<?= Router\Router::route('/interns/notifications') ?>" class="nav-item <?= str_contains($uri, 'notifications') ? 'active' : '' ?>" @click="sidebarOpen = false">
            <span class="nav-item-icon"><i class="fas fa-bell"></i></span>
            <span class="nav-item-text">Notifications</span>
        </a>
        <a href="<?= Router\Router::route('/interns/settings') ?>" class="nav-item <?= str_contains($uri, 'settings') ? 'active' : '' ?>" @click="sidebarOpen = false">
            <span class="nav-item-icon"><i class="fas fa-cog"></i></span>
            <span class="nav-item-text">Paramètres</span>
        </a>
    </nav>

    <!-- Theme Selector in Navbar -->
    <div class="theme-nav-selector">
        <span class="theme-nav-label">Thème</span>
        <div class="theme-nav-options">
            <button type="button" class="theme-nav-btn" data-theme="default" title="Sombre">
                <i class="fas fa-moon"></i>
            </button>
            <button type="button" class="theme-nav-btn" data-theme="light" title="Clair">
                <i class="fas fa-sun"></i>
            </button>
            <button type="button" class="theme-nav-btn" data-theme="royal" title="Royal">
                <i class="fas fa-crown"></i>
            </button>
        </div>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-user-row">
            <div class="sidebar-user-avatar"><?= Auth::initials($_SESSION['user_name'] ?? 'ST') ?></div>
            <div class="sidebar-user-info-row">
                <span class="sidebar-user-name"><?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></span>
                <span class="sidebar-user-role">Stagiaire</span>
            </div>
        </div>
        <form action="<?= Router\Router::route('/logout') ?>" method="post">
            <button class="sidebar-logout" type="submit">
                <i class="fas fa-sign-out-alt"></i><span>Déconnexion</span>
            </button>
        </form>
    </div>
</aside>