<?php
$pageTitle = 'Paramètres';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> | Cabinet d'Avocats</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dash_admin.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="../js/theme.js"></script>
</head>

<body x-data="{ sidebarOpen: false, modalOpen: false, activeModal: null }">
    <div class="admin-wrapper">
        <?php require dirname(__DIR__) . '/layouts/admin/sidebar.php'; ?>
        <main class="main-content">
            <header class="admin-header">
                <div class="header-left">
                    <button class="header-toggle" @click="document.dispatchEvent(new CustomEvent('sidebar:toggle'))"><i class="fas fa-bars"></i></button>
                    <div>
                        <h1 class="header-title"><?= $pageTitle ?></h1>
                    </div>
                </div>
            </header>

            <div class="page-content">
                <?php if (!empty($success)): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
                <?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

                <div class="grid-2">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title"><i class="fas fa-user"></i> Profil</h2>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?= Router\Router::route('/admin/settings/profile') ?>">
                                <?= $csrf ?? '' ?>
                                <div class="form-group">
                                    <label class="form-label">Nom</label>
                                    <input type="text" class="form-input" name="name" value="<?= htmlspecialchars($admin['name'] ?? '') ?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-input" name="email" value="<?= htmlspecialchars($admin['email'] ?? '') ?>" required>
                                </div>
                                <button class="btn btn-primary mt-md" type="submit"><i class="fas fa-save"></i> Enregistrer</button>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title"><i class="fas fa-key"></i> Sécurité</h2>
                        </div>
                        <div class="card-body">
                            <button class="settings-btn hover-lift" @click="activeModal = 'password'; modalOpen = true">
                                <i class="fas fa-lock"></i>
                                <div>
                                    <h3>Changer Mot de Passe</h3>
                                    <p>Modifier votre mot de passe</p>
                                </div>
                            </button>
                        </div>
                    </div>

                    <div class="card" style="grid-column: span 2;">
                        <div class="card-header">
                            <h2 class="card-title"><i class="fas fa-palette"></i> Apparence</h2>
                        </div>
                        <div class="card-body">
                            <p style="color: var(--gray-400); margin-bottom: 1.5rem;">Choisissez le thème qui vous convient le mieux pour l'interface.</p>

                            <div class="theme-selector" x-data="{ activeTheme: localStorage.getItem('themis-theme') || 'dark' }">
                                <div class="theme-options">
                                    <!-- Dark Theme -->
                                    <button class="theme-option"
                                        data-theme-btn="dark"
                                        :class="{ 'active': activeTheme === 'dark' }"
                                        @click="activeTheme = 'dark'; window.themeManager?.setTheme('dark')"
                                        style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border-color: var(--gray-700);">
                                        <div class="theme-preview" style="background: #0f0f1a;">
                                            <div style="background: #eaeaea; width: 60%; height: 4px; border-radius: 2px; margin-bottom: 4px;"></div>
                                            <div style="background: #d4af37; width: 40%; height: 4px; border-radius: 2px;"></div>
                                        </div>
                                        <div class="theme-info">
                                            <i class="fas fa-moon" style="color: #d4af37;"></i>
                                            <span>Dark Luxury</span>
                                            <small style="color: var(--gray-500);">Mode sombre élégant</small>
                                        </div>
                                        <div class="theme-check" x-show="activeTheme === 'dark'">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </button>

                                    <!-- Light Theme -->
                                    <button class="theme-option"
                                        data-theme-btn="light"
                                        :class="{ 'active': activeTheme === 'light' }"
                                        @click="activeTheme = 'light'; window.themeManager?.setTheme('light')"
                                        style="background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%); border-color: var(--gray-300);">
                                        <div class="theme-preview" style="background: #f8f9fa;">
                                            <div style="background: #333; width: 60%; height: 4px; border-radius: 2px; margin-bottom: 4px;"></div>
                                            <div style="background: #2563eb; width: 40%; height: 4px; border-radius: 2px;"></div>
                                        </div>
                                        <div class="theme-info">
                                            <i class="fas fa-sun" style="color: #2563eb;"></i>
                                            <span style="color: #333;">Light Professional</span>
                                            <small style="color: #666;">Mode clair professionnel</small>
                                        </div>
                                        <div class="theme-check" x-show="activeTheme === 'light'">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </button>

                                    <!-- Royal Theme -->
                                    <button class="theme-option"
                                        data-theme-btn="royal"
                                        :class="{ 'active': activeTheme === 'royal' }"
                                        @click="activeTheme = 'royal'; window.themeManager?.setTheme('royal')"
                                        style="background: linear-gradient(135deg, #1e3a5f 0%, #0c1929 100%); border-color: #1e3a5f;">
                                        <div class="theme-preview" style="background: #0f1929;">
                                            <div style="background: #f8f9fa; width: 60%; height: 4px; border-radius: 2px; margin-bottom: 4px;"></div>
                                            <div style="background: #6366f1; width: 40%; height: 4px; border-radius: 2px;"></div>
                                        </div>
                                        <div class="theme-info">
                                            <i class="fas fa-crown" style="color: #6366f1;"></i>
                                            <span>Royal Blue</span>
                                            <small style="color: var(--gray-400);">Thème royal bleu</small>
                                        </div>
                                        <div class="theme-check" x-show="activeTheme === 'royal'">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="modal-overlay" :class="{ 'active': modalOpen }" @click="modalOpen = false"></div>

    <div class="modal" :class="{ 'active': activeModal === 'password' && modalOpen }">
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
                <button type="button" class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group"><label class="form-label">Actuel</label><input type="password" class="form-input" name="current_password" required></div>
                <div class="form-group"><label class="form-label">Nouveau</label><input type="password" class="form-input" name="new_password" required></div>
                <div class="form-group"><label class="form-label">Confirmer</label><input type="password" class="form-input" name="confirm_password" required></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="modalOpen = false">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>
</body>

</html>