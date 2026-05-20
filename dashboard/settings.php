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
        <?php include __DIR__ . '/../views/layouts/sidebar-admin.php'; ?>
        <main class="main-content">
            <header class="admin-header">
                <div class="header-left">
                    <button class="header-toggle" @click="document.dispatchEvent(new CustomEvent('sidebar:toggle'))"><i class="fas fa-bars"></i></button>
                    <div><h1 class="header-title"><?= $pageTitle ?></h1><nav class="header-breadcrumb"><a href="dashboard.php">Accueil</a><span>/</span><span><?= $pageTitle ?></span></nav></div>
                </div>
            </header>
            <div class="page-content">
                <div class="grid-2">
                    <div class="card">
                        <div class="card-header"><h2 class="card-title"><i class="fas fa-user"></i> Profil</h2></div>
                        <div class="card-body">
                            <div class="form-group"><label class="form-label">Nom</label><input type="text" class="form-input" value="Administrateur"></div>
                            <div class="form-group"><label class="form-label">Email</label><input type="email" class="form-input" value="admin@cabinet.cd"></div>
                            <button class="btn btn-primary mt-md"><i class="fas fa-save"></i> Enregistrer</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header"><h2 class="card-title"><i class="fas fa-key"></i> Sécurité</h2></div>
                        <div class="card-body">
                            <button class="settings-btn hover-lift" @click="activeModal = 'password'; modalOpen = true"><i class="fas fa-lock"></i><div><h3>Changer Mot de Passe</h3><p>Modifier votre mot de passe</p></div></button>
                        </div>
                    </div>
                    <div class="card" style="grid-column: 1 / -1;">
                        <div class="card-header"><h2 class="card-title"><i class="fas fa-palette"></i> Apparence</h2></div>
                        <div class="card-body">
                            <div class="theme-selector">
                                <p class="theme-label">Thème du Dashboard</p>
                                <div class="theme-options">
                                    <button class="theme-btn" data-theme-btn="dark" title="Mode Sombre">
                                        <i class="fas fa-moon"></i>
                                        <span>Sombre</span>
                                    </button>
                                    <button class="theme-btn" data-theme-btn="light" title="Mode Clair">
                                        <i class="fas fa-sun"></i>
                                        <span>Clair</span>
                                    </button>
                                    <button class="theme-btn" data-theme-btn="royal" title="Mode Royal">
                                        <i class="fas fa-crown"></i>
                                        <span>Royal</span>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group mt-lg">
                                <label class="form-label">Taille de police</label>
                                <div class="font-size-options">
                                    <button class="font-btn" onclick="document.body.style.fontSize='14px'">A-</button>
                                    <button class="font-btn active" onclick="document.body.style.fontSize='16px'">A</button>
                                    <button class="font-btn" onclick="document.body.style.fontSize='18px'">A+</button>
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
        <div class="modal-header"><div class="modal-header-content"><div class="modal-icon"><i class="fas fa-lock"></i></div><div><h3 class="modal-title">Changer Mot de Passe</h3><p class="modal-subtitle">Sécurité du compte</p></div></div><button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button></div>
        <div class="modal-body">
            <div class="form-group"><label class="form-label">Actuel</label><input type="password" class="form-input" placeholder="Mot de passe actuel"></div>
            <div class="form-group"><label class="form-label">Nouveau</label><input type="password" class="form-input" placeholder="Nouveau mot de passe"></div>
            <div class="form-group"><label class="form-label">Confirmer</label><input type="password" class="form-input" placeholder="Confirmer le mot de passe"></div>
        </div>
    <div class="modal-footer"><button class="btn btn-secondary" @click="modalOpen = false">Annuler</button><button class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button></div>
    </div>

    <script>
        // Wait for theme.js to initialize ThemeManager
        document.addEventListener('DOMContentLoaded', () => {
            // Theme is already initialized by theme.js
            // Just add font size functionality
            document.querySelectorAll('.font-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.font-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
