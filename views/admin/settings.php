<?php
$pageTitle = 'Paramètres'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> | Cabinet d'Avocats</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dash_admin.css">
    <link rel="stylesheet" href="../css/settings.css">
    <script src="../js/theme.js"></script>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="modal-overlay" id="modalOverlay"></div>
    <div class="admin-wrapper">
        <?php require dirname(__DIR__) . '/layouts/admin/sidebar.php'; ?>
        <main class="main-content">
            <header class="admin-header">
                <div class="header-left">
                    <button class="header-toggle" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                    <div>
                        <h1 class="header-title"><?= $pageTitle ?></h1>
                    </div>
                </div>
            </header>
            <div class="page-content">
                <?php if (!empty($success)): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
                <?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

                <!-- Stack Profil et Sécurité pour mobile, côte à côte pour desktop -->
                <div class="settings-grid">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title"><i class="fas fa-user"></i> Profil</h2>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?= Router\Router::route('/admin/settings/profile') ?>">
                                <?= $csrf ?? '' ?>
                                <div class="form-group"><label class="form-label">Nom</label><input type="text" class="form-input" name="name" value="<?= htmlspecialchars($admin['name'] ?? '') ?>" required></div>
                                <div class="form-group"><label class="form-label">Email</label><input type="email" class="form-input" name="email" value="<?= htmlspecialchars($admin['email'] ?? '') ?>" required></div>
                                <button class="btn btn-primary mt-md" type="submit"><i class="fas fa-save"></i> Enregistrer</button>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title"><i class="fas fa-key"></i> Sécurité</h2>
                        </div>
                        <div class="card-body">
                            <button class="settings-btn hover-lift" id="openPasswordModal">
                                <i class="fas fa-lock"></i>
                                <div>
                                    <h3>Changer Mot de Passe</h3>
                                    <p>Modifier votre mot de passe</p>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card" style="grid-column: span 2;">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-palette"></i> Apparence</h2>
                    </div>
                    <div class="card-body">
                        <p style="color: var(--gray-400); margin-bottom: 1.5rem;">Choisissez le thème pour l'interface.</p>
                        <div class="theme-selector" id="themeSelector">
                            <div class="theme-options">
                                <button class="theme-option active" id="themeDark" data-theme="dark" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border-color: var(--gray-700);">
                                    <div class="theme-preview" style="background: #0f0f1a;">
                                        <div style="background: #eaeaea; width: 60%; height: 4px; border-radius: 2px; margin-bottom: 4px;"></div>
                                        <div style="background: #d4af37; width: 40%; height: 4px; border-radius: 2px;"></div>
                                    </div>
                                    <div class="theme-info"><i class="fas fa-moon" style="color: #d4af37;"></i><span>Dark Luxury</span><small style="color: var(--gray-500);">Mode sombre élégant</small></div>
                                    <div class="theme-check" id="themeCheckDark"><i class="fas fa-check"></i></div>
                                </button>
                                <button class="theme-option" id="themeLight" data-theme="light" style="background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%); border-color: var(--gray-300);">
                                    <div class="theme-preview" style="background: #f8f9fa;">
                                        <div style="background: #333; width: 60%; height: 4px; border-radius: 2px; margin-bottom: 4px;"></div>
                                        <div style="background: #2563eb; width: 40%; height: 4px; border-radius: 2px;"></div>
                                    </div>
                                    <div class="theme-info"><i class="fas fa-sun" style="color: #2563eb;"></i><span style="color: #333;">Light Professional</span><small style="color: #666;">Mode clair professionnel</small></div>
                                    <div class="theme-check" id="themeCheckLight" style="display: none;"><i class="fas fa-check"></i></div>
                                </button>
                                <button class="theme-option" id="themeRoyal" data-theme="royal" style="background: linear-gradient(135deg, #1e3a5f 0%, #0c1929 100%); border-color: #1e3a5f;">
                                    <div class="theme-preview" style="background: #0f1929;">
                                        <div style="background: #f8f9fa; width: 60%; height: 4px; border-radius: 2px; margin-bottom: 4px;"></div>
                                        <div style="background: #6366f1; width: 40%; height: 4px; border-radius: 2px;"></div>
                                    </div>
                                    <div class="theme-info"><i class="fas fa-crown" style="color: #6366f1;"></i><span>Royal Blue</span><small style="color: var(--gray-400);">Thème royal bleu</small></div>
                                    <div class="theme-check" id="themeCheckRoyal" style="display: none;"><i class="fas fa-check"></i></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="modal" id="passwordModal">
        <form method="post" action="<?= Router\Router::route('/admin/settings/password') ?>">
            <?= $csrf ?? '' ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon"><i class="fas fa-lock"></i></div>
                    <div>
                        <h3 class="modal-title">Changer Mot de Passe</h3>
                        <p class="modal-subtitle">Sécurité du compte</p>
                    </div>
                </div>
                <button type="button" class="modal-close" id="closePasswordModalBtn"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group"><label class="form-label">Actuel</label><input type="password" class="form-input" name="current_password" required></div>
                <div class="form-group"><label class="form-label">Nouveau</label><input type="password" class="form-input" name="new_password" required></div>
                <div class="form-group"><label class="form-label">Confirmer</label><input type="password" class="form-input" name="confirm_password" required></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelPasswordModal">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
    <script src="../js/dash_admin.js"></script>
    <script>
        window.openModal = function(modalId) {
            var modal = document.getElementById(modalId);
            var overlay = document.getElementById('modalOverlay');
            if (modal) {
                modal.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        };
        window.closeAllModals = function() {
            var modals = document.querySelectorAll('.modal');
            for (var i = 0; i < modals.length; i++) {
                modals[i].classList.remove('active');
            }
            var overlay = document.getElementById('modalOverlay');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        };

        function setActiveTheme(theme) {
            var buttons = document.querySelectorAll('.theme-option');
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].classList.remove('active');
            }
            var themes = ['dark', 'light', 'royal'];
            for (var j = 0; j < themes.length; j++) {
                var check = document.getElementById('themeCheck' + themes[j].charAt(0).toUpperCase() + themes[j].slice(1));
                if (check) check.style.display = 'none';
            }
            var activeBtn = document.querySelector('[data-theme="' + theme + '"]');
            if (activeBtn) activeBtn.classList.add('active');
            var check = document.getElementById('themeCheck' + theme.charAt(0).toUpperCase() + theme.slice(1));
            if (check) check.style.display = 'flex';
            if (window.themeManager) window.themeManager.setTheme(theme);
        }
        document.addEventListener('DOMContentLoaded', function() {
            var savedTheme = localStorage.getItem('themis-theme') || 'dark';
            setActiveTheme(savedTheme);
            var darkBtn = document.getElementById('themeDark');
            if (darkBtn) darkBtn.addEventListener('click', function() {
                setActiveTheme('dark');
            });
            var lightBtn = document.getElementById('themeLight');
            if (lightBtn) lightBtn.addEventListener('click', function() {
                setActiveTheme('light');
            });
            var royalBtn = document.getElementById('themeRoyal');
            if (royalBtn) royalBtn.addEventListener('click', function() {
                setActiveTheme('royal');
            });
            var openBtn = document.getElementById('openPasswordModal');
            if (openBtn) openBtn.addEventListener('click', function() {
                window.openModal('passwordModal');
            });
            var closeBtn = document.getElementById('closePasswordModalBtn');
            if (closeBtn) closeBtn.addEventListener('click', window.closeAllModals);
            var cancelBtn = document.getElementById('cancelPasswordModal');
            if (cancelBtn) cancelBtn.addEventListener('click', window.closeAllModals);
            var overlay = document.getElementById('modalOverlay');
            if (overlay) overlay.addEventListener('click', window.closeAllModals);
        });
    </script>
</body>

</html>