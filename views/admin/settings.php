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
                    <div><h1 class="header-title"><?= $pageTitle ?></h1></div>
                </div>
            </header>

            <div class="page-content">
                <?php if (!empty($success)): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
                <?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

                <div class="grid-2">
                    <div class="card">
                        <div class="card-header"><h2 class="card-title"><i class="fas fa-user"></i> Profil</h2></div>
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
                        <div class="card-header"><h2 class="card-title"><i class="fas fa-key"></i> Sécurité</h2></div>
                        <div class="card-body">
                            <button class="settings-btn hover-lift" @click="activeModal = 'password'; modalOpen = true">
                                <i class="fas fa-lock"></i><div><h3>Changer Mot de Passe</h3><p>Modifier votre mot de passe</p></div>
                            </button>
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
                    <div><h3 class="modal-title">Changer Mot de Passe</h3><p class="modal-subtitle">Sécurité du compte</p></div>
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
