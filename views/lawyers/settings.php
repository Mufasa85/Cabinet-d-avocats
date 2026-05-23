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

$lawyerName = $_SESSION['lawyer_name'] ?? 'Me. Laurent Mbako';
$lawyerAvatar = $_SESSION['lawyer_avatar'] ?? 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=100&q=80';

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

<div class="content-grid grid-2">
    
    <!-- Account Settings -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Compte
            </h2>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" value="laurent.mbako@elmd-law.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" class="form-input" value="+243 81 234 5678">
                </div>
                <div class="form-group">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-input" placeholder="Laisser vide pour ne pas changer">
                </div>
                <div class="form-group">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-input" placeholder="Confirmer le nouveau mot de passe">
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
    
    <!-- Appearance -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="5"/>
                    <line x1="12" y1="1" x2="12" y2="3"/>
                    <line x1="12" y1="21" x2="12" y2="23"/>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                    <line x1="1" y1="12" x2="3" y2="12"/>
                    <line x1="21" y1="12" x2="23" y2="12"/>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                </svg>
                Apparence
            </h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Thème</label>
                <div class="flex gap-2 mt-2">
                    <button class="btn btn-primary theme-btn" data-theme="dark">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                        </svg>
                        Sombre
                    </button>
                    <button class="btn btn-secondary theme-btn" data-theme="light">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                            <circle cx="12" cy="12" r="5"/>
                            <line x1="12" y1="1" x2="12" y2="3"/>
                            <line x1="12" y1="21" x2="12" y2="23"/>
                        </svg>
                        Clair
                    </button>
                    <button class="btn btn-secondary theme-btn" data-theme="royal">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                        Royal
                    </button>
                </div>
            </div>
            <div class="form-group mt-3">
                <label class="form-label">Taille de police</label>
                <select class="form-select">
                    <option>Petite</option>
                    <option selected>Moyenne</option>
                    <option>Grande</option>
                </select>
            </div>
        </div>
    </div>
    
    <!-- Notifications Settings -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
                Notifications
            </h2>
        </div>
        <div class="card-body">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h4 class="font-semibold">Notifications par email</h4>
                    <p class="text-sm text-muted">Recevez des emails pour les nouvelles notifications</p>
                </div>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h4 class="font-semibold">Messages des clients</h4>
                    <p class="text-sm text-muted">Soyez notifié des nouveaux messages</p>
                </div>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h4 class="font-semibold">Rappels de formations</h4>
                    <p class="text-sm text-muted">Recevez des rappels pour vos formations</p>
                </div>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider"></span>
                </label>
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="font-semibold">Publications</h4>
                    <p class="text-sm text-muted">Notifications sur vos articles</p>
                </div>
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
    </div>
    
    <!-- Privacy & Security -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
                Sécurité
            </h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Authentification à deux facteurs</label>
                <div class="flex items-center justify-between mt-2">
                    <p class="text-sm text-muted">Ajoutez une couche de sécurité supplémentaire</p>
                    <button class="btn btn-sm btn-secondary">Activer</button>
                </div>
            </div>
            <div class="form-group mt-3">
                <label class="form-label">Sessions actives</label>
                <p class="text-sm text-muted mb-2">2 sessions actives</p>
                <div class="flex items-center justify-between p-2" style="background: rgba(255,255,255,0.03); border-radius: var(--radius-md);">
                    <div>
                        <p class="font-semibold text-sm">Chrome - Kinshasa</p>
                        <p class="text-xs text-muted">Actif maintenant</p>
                    </div>
                    <button class="btn btn-ghost btn-sm text-danger">Déconnecter</button>
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-danger w-full">Supprimer mon compte</button>
            </div>
        </div>
    </div>
    
</div>

</div><!-- End page-content -->

<style>
/* Switch Toggle */
.switch {
    position: relative;
    display: inline-block;
    width: 48px;
    height: 24px;
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

input:checked + .slider {
    background: var(--gold-gradient);
}

input:checked + .slider:before {
    transform: translateX(24px);
}
</style>

<script src="<?= ELMD_ROOT ?>/lawyer/js/lawyer.js"></script>

</body>
</html>