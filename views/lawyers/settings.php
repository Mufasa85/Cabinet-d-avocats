<?php

/**
 * ELMD - Cabinet d'Avocats
 * Lawyer Settings Page
 */

if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$pageTitle = 'Paramètres';
$currentPage = 'settings';

// Récupérer les données depuis le controller si disponibles
$lawyerName = $avocat['fullname'] ?? $_SESSION['lawyer_name'] ?? $_SESSION['user_name'] ?? 'Avocat';
$defaultAvatar = 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=100&q=80';
$lawyerAvatar = $avocat['avatar_url'] ?? (!empty($avocat['avatar']) ? \Service\FileStorage::url($avocat['avatar']) : $defaultAvatar);

require dirname(__DIR__) . '/layouts/lawyer/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div>
            <h1 class="page-title">Paramètres</h1>
            <p class="page-subtitle">Gérez vos préférences et configurations</p>
        </div>
    </div>
</div>

<!-- Settings Content -->
<div class="settings-container">

    <!-- Account Settings -->
    <div class="settings-section">
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </div>
                <div>
                    <h2 class="settings-card-title">Compte</h2>
                    <p class="settings-card-subtitle">Informations de votre compte</p>
                </div>
            </div>
            <div class="settings-card-body">
                <form class="settings-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                                Email professionnel
                            </label>
                            <input type="email" class="form-input" value="<?= htmlspecialchars($avocat['email_professionnel'] ?? 'avocat@elmd-law.com') ?>">
                        </div>
                    </div>
                    <div class="form-row grid-2">
                        <div class="form-group">
                            <label class="form-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                </svg>
                                Téléphone
                            </label>
                            <input type="tel" class="form-input" value="<?= htmlspecialchars($_SESSION['telephone'] ?? '+243 81 234 5678') ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                </svg>
                                Bureau
                            </label>
                            <input type="text" class="form-input" value="<?= htmlspecialchars($avocat['bureau'] ?? 'Kinshasa') ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Security Section -->
    <div class="settings-section">
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                </div>
                <div>
                    <h2 class="settings-card-title">Sécurité</h2>
                    <p class="settings-card-subtitle">Modifier votre mot de passe</p>
                </div>
            </div>
            <div class="settings-card-body">
                <form class="settings-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Mot de passe actuel</label>
                            <input type="password" class="form-input" placeholder="Entrez votre mot de passe actuel">
                        </div>
                    </div>
                    <div class="form-row grid-2">
                        <div class="form-group">
                            <label class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-input" placeholder="Minimum 8 caractères">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirmer le mot de passe</label>
                            <input type="password" class="form-input" placeholder="Confirmer le nouveau mot de passe">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <polyline points="17 21 17 13 7 13 7 21" />
                                <polyline points="7 3 7 8 15 8" />
                            </svg>
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Appearance Section -->
    <div class="settings-section">
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="5" />
                        <line x1="12" y1="1" x2="12" y2="3" />
                        <line x1="12" y1="21" x2="12" y2="23" />
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                        <line x1="1" y1="12" x2="3" y2="12" />
                        <line x1="21" y1="12" x2="23" y2="12" />
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                    </svg>
                </div>
                <div>
                    <h2 class="settings-card-title">Apparence</h2>
                    <p class="settings-card-subtitle">Personnalisez l'interface</p>
                </div>
            </div>
            <div class="settings-card-body">
                <div class="appearance-options">
                    <div class="appearance-option">
                        <label class="form-label">Thème de l'interface</label>
                        <div class="theme-selector">
                            <button class="theme-option active" data-theme="dark">
                                <div class="theme-preview dark-preview"></div>
                                <span class="theme-name">Sombre</span>
                                <svg class="theme-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </button>
                            <button class="theme-option" data-theme="light">
                                <div class="theme-preview light-preview"></div>
                                <span class="theme-name">Clair</span>
                                <svg class="theme-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </button>
                            <button class="theme-option" data-theme="royal">
                                <div class="theme-preview royal-preview"></div>
                                <span class="theme-name">Royal</span>
                                <svg class="theme-check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications Section -->
    <div class="settings-section">
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="settings-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                    </svg>
                </div>
                <div>
                    <h2 class="settings-card-title">Notifications</h2>
                    <p class="settings-card-subtitle">Comment vous souhaitez être notifié</p>
                </div>
            </div>
            <div class="settings-card-body">
                <div class="notification-settings">
                    <div class="notification-item">
                        <div class="notification-info">
                            <div class="notification-icon-wrapper email">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="notification-title">Notifications par email</h4>
                                <p class="notification-desc">Recevez des emails pour les nouvelles notifications importantes</p>
                            </div>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="notification-item">
                        <div class="notification-info">
                            <div class="notification-icon-wrapper message">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="notification-title">Messages des clients</h4>
                                <p class="notification-desc">Soyez notifié des nouveaux messages de vos clients</p>
                            </div>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="notification-item">
                        <div class="notification-info">
                            <div class="notification-icon-wrapper calendar">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="notification-title">Rappels de formations</h4>
                                <p class="notification-desc">Recevez des rappels pour vos formations à venir</p>
                            </div>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="notification-item">
                        <div class="notification-info">
                            <div class="notification-icon-wrapper publish">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                    <line x1="16" y1="13" x2="8" y2="13" />
                                    <line x1="16" y1="17" x2="8" y2="17" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="notification-title">Publications acceptées</h4>
                                <p class="notification-desc">Notifications lorsque vos articles sont acceptés</p>
                            </div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="settings-section">
        <div class="settings-card danger-card">
            <div class="settings-card-header">
                <div class="settings-card-icon danger">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                </div>
                <div>
                    <h2 class="settings-card-title">Zone dangereuse</h2>
                    <p class="settings-card-subtitle">Actions irréversibles</p>
                </div>
            </div>
            <div class="settings-card-body">
                <div class="danger-actions">
                    <div class="danger-item">
                        <div class="danger-info">
                            <h4>Authentification à deux facteurs</h4>
                            <p>Ajoutez une couche de sécurité supplémentaire à votre compte</p>
                        </div>
                        <button class="btn btn-outline">Activer</button>
                    </div>
                    <div class="danger-item">
                        <div class="danger-info">
                            <h4>Sessions actives</h4>
                            <p>Vous êtes connecté sur 2 appareils</p>
                        </div>
                        <button class="btn btn-outline">Gérer les sessions</button>
                    </div>
                    <div class="danger-item danger-warning">
                        <div class="danger-info">
                            <h4>Supprimer mon compte</h4>
                            <p>Cette action est irréversible. Toutes vos données seront supprimées définitivement.</p>
                        </div>
                        <button class="btn btn-danger">Supprimer le compte</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div><!-- End page-content -->

<style>
    /* Settings Page Styles */
    .settings-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .settings-section {
        width: 100%;
    }

    .settings-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition-base);
    }

    .settings-card:hover {
        border-color: var(--gold-primary);
        box-shadow: 0 0 0 1px var(--gold-primary);
    }

    .settings-card-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem 1.5rem;
        background: rgba(255, 255, 255, 0.02);
        border-bottom: 1px solid var(--border-color);
    }

    .settings-card-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gold-gradient);
        border-radius: var(--radius-md);
        color: var(--dark);
    }

    .settings-card-icon.danger {
        background: var(--danger-gradient);
        color: var(--white);
    }

    .settings-card-icon svg {
        width: 24px;
        height: 24px;
    }

    .settings-card-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
    }

    .settings-card-subtitle {
        font-size: 0.875rem;
        color: var(--text-muted);
        margin: 0.25rem 0 0;
    }

    .settings-card-body {
        padding: 1.5rem;
    }

    /* Form Styles */
    .settings-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .form-row {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .form-row.grid-2 {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        padding-top: 0.5rem;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
    }

    .form-label svg {
        opacity: 0.7;
    }

    /* Appearance Options */
    .appearance-options {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .appearance-option {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .theme-selector {
        display: flex;
        gap: 0.75rem;
    }

    .theme-option {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        background: var(--card-bg);
        border: 2px solid var(--border-color);
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: var(--transition-base);
        position: relative;
    }

    .theme-option:hover {
        border-color: var(--gold-primary);
    }

    .theme-option.active {
        border-color: var(--gold-primary);
        background: rgba(212, 175, 55, 0.1);
    }

    .theme-preview {
        width: 100%;
        height: 60px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border-color);
    }

    .dark-preview {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    }

    .light-preview {
        background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
    }

    .royal-preview {
        background: linear-gradient(135deg, #1a1a2e 0%, #2d1f3d 50%, #1a1a2e 100%);
    }

    .theme-name {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-primary);
    }

    .theme-check {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 20px;
        height: 20px;
        background: var(--gold-primary);
        border-radius: 50%;
        color: var(--dark);
        opacity: 0;
        transform: scale(0);
        transition: var(--transition-base);
    }

    .theme-option.active .theme-check {
        opacity: 1;
        transform: scale(1);
    }

    /* Notification Settings */
    .notification-settings {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .notification-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.02);
        border-radius: var(--radius-md);
        transition: var(--transition-base);
    }

    .notification-item:hover {
        background: rgba(255, 255, 255, 0.04);
    }

    .notification-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .notification-icon-wrapper {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-sm);
    }

    .notification-icon-wrapper.email {
        background: rgba(59, 130, 246, 0.15);
        color: #3b82f6;
    }

    .notification-icon-wrapper.message {
        background: rgba(34, 197, 94, 0.15);
        color: #22c55e;
    }

    .notification-icon-wrapper.calendar {
        background: rgba(212, 175, 55, 0.15);
        color: var(--gold-primary);
    }

    .notification-icon-wrapper.publish {
        background: rgba(168, 85, 247, 0.15);
        color: #a855f7;
    }

    .notification-icon-wrapper svg {
        width: 20px;
        height: 20px;
    }

    .notification-title {
        font-size: 0.9375rem;
        font-weight: 500;
        color: var(--text-primary);
        margin: 0;
    }

    .notification-desc {
        font-size: 0.8125rem;
        color: var(--text-muted);
        margin: 0.25rem 0 0;
    }

    /* Danger Zone */
    .danger-card {
        border-color: rgba(239, 68, 68, 0.3);
    }

    .danger-card:hover {
        border-color: var(--danger);
    }

    .danger-actions {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .danger-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.02);
        border-radius: var(--radius-md);
    }

    .danger-item.danger-warning {
        background: rgba(239, 68, 68, 0.05);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .danger-info h4 {
        font-size: 0.9375rem;
        font-weight: 500;
        color: var(--text-primary);
        margin: 0;
    }

    .danger-item.danger-warning .danger-info h4 {
        color: var(--danger);
    }

    .danger-info p {
        font-size: 0.8125rem;
        color: var(--text-muted);
        margin: 0.25rem 0 0;
    }

    /* Switch Toggle */
    .switch {
        position: relative;
        display: inline-block;
        width: 48px;
        height: 24px;
        flex-shrink: 0;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        background: var(--gray-700);
        border-radius: 24px;
        transition: var(--transition-base);
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background: var(--white);
        border-radius: 50%;
        transition: var(--transition-base);
    }

    input:checked+.slider {
        background: var(--gold-gradient);
    }

    input:checked+.slider:before {
        transform: translateX(24px);
    }

    /* Button Variants */
    .btn-outline {
        background: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
    }

    .btn-outline:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: var(--text-muted);
        color: var(--text-primary);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-row.grid-2 {
            grid-template-columns: 1fr;
        }

        .theme-selector {
            flex-direction: column;
        }

        .notification-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .danger-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
    }
</style>

<script src="../js/lawyer.js"></script>

</body>

</html>