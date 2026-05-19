<?php
$pageTitle = 'Publications';
$publications = [
    ['id' => 1, 'title' => 'Guide du Droit des Sociétés en RDC', 'author' => 'Maître Kabongo', 'date' => '10 Mai 2026', 'status' => 'published', 'views' => 1250],
    ['id' => 2, 'title' => 'Fiscalité des Entreprises Mining', 'author' => 'Maître Lukoji', 'date' => '05 Mai 2026', 'status' => 'published', 'views' => 890],
    ['id' => 3, 'title' => 'Nouveau Cadre Réglementaire', 'author' => 'Maître Ngalulu', 'date' => '28 Avril 2026', 'status' => 'draft', 'views' => 0],
];
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
                <div class="header-actions">
                    <button class="btn btn-primary" @click="activeModal = 'create'; modalOpen = true"><i class="fas fa-plus"></i> Nouvel Article</button>
                </div>
            </header>
            <div class="page-content">
                <div class="filter-bar">
                    <div class="search-input"><i class="fas fa-search"></i><input type="text" placeholder="Rechercher..."></div>
                    <select class="filter-select"><option value="">Tous</option><option value="published">Publié</option><option value="draft">Brouillon</option></select>
                </div>
                <div class="card">
                    <div class="card-body" style="padding: 0;">
                        <div class="table-container">
                            <table class="table">
                                <thead><tr><th>Article</th><th>Auteur</th><th>Date</th><th>Statut</th><th>Vues</th><th>Actions</th></tr></thead>
                                <tbody>
                                    <?php foreach ($publications as $p): ?>
                                    <tr>
                                        <td><h4 style="color: var(--white);"><?= htmlspecialchars($p['title']) ?></h4></td>
                                        <td><?= htmlspecialchars($p['author']) ?></td>
                                        <td><?= $p['date'] ?></td>
                                        <td><span class="badge <?= $p['status'] === 'published' ? 'badge-success' : 'badge-warning' ?>"><?= $p['status'] === 'published' ? 'Publié' : 'Brouillon' ?></span></td>
                                        <td><?= $p['views'] ?></td>
                                        <td>
                                            <div class="flex gap-sm">
                                                <button class="btn btn-sm btn-ghost" @click="activeModal = 'preview'"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-ghost" @click="activeModal = 'edit'"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-ghost" @click="activeModal = 'delete'"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="modal-overlay" :class="{ 'active': modalOpen }" @click="modalOpen = false"></div>

    <div class="modal" :class="{ 'active': activeModal === 'create' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content"><div class="modal-icon"><i class="fas fa-newspaper"></i></div><div><h3 class="modal-title">Nouvel Article</h3><p class="modal-subtitle">Créer une publication</p></div></div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-group"><label class="form-label">Titre</label><input type="text" class="form-input" placeholder="Titre de l'article"></div>
            <div class="form-group"><label class="form-label">Contenu</label><textarea class="form-textarea" rows="6" placeholder="Contenu de l'article..."></textarea></div>
            <div class="form-group"><label class="form-label">Statut</label><select class="form-select"><option value="draft">Brouillon</option><option value="published">Publié</option></select></div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false">Annuler</button>
            <button class="btn btn-primary"><i class="fas fa-save"></i> Publier</button>
        </div>
    </div>

    <div class="modal confirm-modal" :class="{ 'active': activeModal === 'delete' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content"><div class="modal-icon"><i class="fas fa-exclamation-triangle"></i></div><div><h3 class="modal-title">Supprimer</h3><p class="modal-subtitle">Action irréversible</p></div></div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body"><p>Êtes-vous sûr de vouloir supprimer cet article ?</p></div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false">Annuler</button>
            <button class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
        </div>
    </div>
</body>
</html>