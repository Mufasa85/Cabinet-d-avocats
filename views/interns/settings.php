<?php
$pageTitle = 'Paramètres';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> | Cabinet ELMD</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dash_admin.css">
    <link rel="stylesheet" href="../css/interns.css">
    <script src="../js/theme.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{ sidebarOpen: false }">
    <div class="admin-wrapper">
        <?php require dirname(__DIR__) . '/layouts/intern/sidebar.php'; ?>
        <main class="main-content">
            <header class="admin-header">
                <h1 class="header-title"><?= htmlspecialchars($pageTitle) ?></h1>
            </header>
            <div class="page-content">
                <?php if (!empty($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <?= htmlspecialchars($_SESSION['success']) ?>
                    </div>
                <?php unset($_SESSION['success']);
                endif; ?>
                <?php if (!empty($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <?= htmlspecialchars($_SESSION['error']) ?>
                    </div>
                <?php unset($_SESSION['error']);
                endif; ?>

                <div class="settings-container">
                    <!-- Change Password Section -->
                    <div class="settings-card">
                        <div class="settings-card-header">
                            <div class="settings-card-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div>
                                <h2 class="settings-card-title">Changer le mot de passe</h2>
                                <p class="settings-card-subtitle">Mettez à jour votre mot de passe pour sécuriser votre compte.</p>
                            </div>
                        </div>
                        <div class="settings-card-body">
                            <form method="post" action="<?= Router\Router::route('/interns/settings/password') ?>">
                                <?= $csrf ?? '' ?>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-key"></i>
                                        Mot de passe actuel
                                    </label>
                                    <input type="password" name="current_password" class="form-input" placeholder="Entrez votre mot de passe actuel" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-key"></i>
                                        Nouveau mot de passe
                                    </label>
                                    <input type="password" name="new_password" class="form-input" placeholder="Entrez le nouveau mot de passe" required minlength="8">
                                    <small class="form-hint">Minimum 8 caractères</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-key"></i>
                                        Confirmer le nouveau mot de passe
                                    </label>
                                    <input type="password" name="confirm_password" class="form-input" placeholder="Confirmez le nouveau mot de passe" required>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        Mettre à jour le mot de passe
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Theme Section -->
                    <div class="settings-card">
                        <div class="settings-card-header">
                            <div class="settings-card-icon">
                                <i class="fas fa-palette"></i>
                            </div>
                            <div>
                                <h2 class="settings-card-title">Apparence</h2>
                                <p class="settings-card-subtitle">Personnalisez l'apparence de l'interface.</p>
                            </div>
                        </div>
                        <div class="settings-card-body">
                            <div class="theme-options">
                                <label class="theme-option" data-theme-default>
                                    <input type="radio" name="theme" value="default" checked>
                                    <div class="theme-preview">
                                        <div class="theme-preview-bg dark"></div>
                                    </div>
                                    <div class="theme-info">
                                        <i class="fas fa-moon"></i>
                                        <span>Sombre</span>
                                        <small>Par défaut</small>
                                    </div>
                                    <div class="theme-check"><i class="fas fa-check"></i></div>
                                </label>
                                <label class="theme-option" data-theme-light>
                                    <input type="radio" name="theme" value="light">
                                    <div class="theme-preview">
                                        <div class="theme-preview-bg light"></div>
                                    </div>
                                    <div class="theme-info">
                                        <i class="fas fa-sun"></i>
                                        <span>Clair</span>
                                        <small>Mode jour</small>
                                    </div>
                                    <div class="theme-check"><i class="fas fa-check"></i></div>
                                </label>
                                <label class="theme-option" data-theme-royal>
                                    <input type="radio" name="theme" value="royal">
                                    <div class="theme-preview">
                                        <div class="theme-preview-bg royal"></div>
                                    </div>
                                    <div class="theme-info">
                                        <i class="fas fa-crown"></i>
                                        <span>Royal</span>
                                        <small>Élégant</small>
                                    </div>
                                    <div class="theme-check"><i class="fas fa-check"></i></div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Account Info -->
                    <div class="settings-card">
                        <div class="settings-card-header">
                            <div class="settings-card-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h2 class="settings-card-title">Informations du compte</h2>
                                <p class="settings-card-subtitle">Vos informations personnelles.</p>
                            </div>
                        </div>
                        <div class="settings-card-body">
                            <div class="account-info-grid">
                                <div class="account-info-item">
                                    <span class="account-info-label">Nom</span>
                                    <span class="account-info-value"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Stagiaire') ?></span>
                                </div>
                                <div class="account-info-item">
                                    <span class="account-info-label">Email</span>
                                    <span class="account-info-value"><?= htmlspecialchars($_SESSION['user_email'] ?? '—') ?></span>
                                </div>
                                <div class="account-info-item">
                                    <span class="account-info-label">Rôle</span>
                                    <span class="account-info-value">
                                        <span class="badge badge-info">Stagiaire</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Theme switching functionality - saves to database and localStorage
        document.querySelectorAll('.theme-option input').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const theme = this.value;

                // Remove active from all
                document.querySelectorAll('.theme-option').forEach(function(option) {
                    option.classList.remove('active');
                });
                // Add active to selected
                this.closest('.theme-option').classList.add('active');

                // Set theme attribute on body immediately
                document.body.setAttribute('data-theme', theme);

                // Save to localStorage for immediate effect
                localStorage.setItem('theme', theme);

                // Save to database via AJAX
                fetch('<?= Router\Router::route('/interns/settings/theme') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'theme=' + encodeURIComponent(theme)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Theme saved to database:', theme);
                        }
                    })
                    .catch(error => {
                        console.error('Error saving theme:', error);
                    });
            });
        });

        // Load saved theme on page load (from database via session/localStorage)
        const savedTheme = localStorage.getItem('theme') || '<?= htmlspecialchars($_SESSION['theme'] ?? 'default') ?>';
        if (savedTheme) {
            const radio = document.querySelector('.theme-option input[value="' + savedTheme + '"]');
            if (radio) {
                radio.checked = true;
                document.body.setAttribute('data-theme', savedTheme);
                radio.closest('.theme-option').classList.add('active');
            }
        }
    </script>
</body>

</html>