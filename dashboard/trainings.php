<?php
$pageTitle = 'Formations';
$trainings = [
    ['id' => 1, 'title' => 'Formation Droit des Sociétés', 'date' => '20 Juin 2026', 'duration' => '3 jours', 'participants' => 15, 'status' => 'upcoming'],
    ['id' => 2, 'title' => 'Séminaire Fiscalité Internationale', 'date' => '25 Juin 2026', 'duration' => '2 jours', 'participants' => 20, 'status' => 'upcoming'],
    ['id' => 3, 'title' => 'Atelier Propriété Intellectuelle', 'date' => '10 Mai 2026', 'duration' => '1 jour', 'participants' => 12, 'status' => 'completed'],
    ['id' => 4, 'title' => 'Conférence Droit Minier', 'date' => '05 Avril 2026', 'duration' => '1 jour', 'participants' => 30, 'status' => 'completed'],
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
                    <div>
                        <h1 class="header-title"><?= $pageTitle ?></h1>
                        <nav class="header-breadcrumb"><a href="dashboard.php">Accueil</a><span>/</span><span><?= $pageTitle ?></span></nav>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-primary" @click="activeModal = 'create'; modalOpen = true"><i class="fas fa-plus"></i> Nouvelle Formation</button>
                </div>
            </header>
            <div class="page-content">
                <div class="filter-bar">
                    <div class="search-input"><i class="fas fa-search"></i><input type="text" placeholder="Rechercher..."></div>
                    <select class="filter-select">
                        <option value="">Tous les statuts</option>
                        <option value="upcoming">À venir</option>
                        <option value="completed">Terminée</option>
                    </select>
                </div>
                <div class="grid-2">
                    <?php foreach ($trainings as $t): ?>
                    <div class="card hover-lift">
                        <div class="card-body">
                            <div class="flex justify-between items-center mb-md">
                                <span class="badge <?= $t['status'] === 'upcoming' ? 'badge-gold' : 'badge-success' ?>"><?= $t['status'] === 'upcoming' ? 'À venir' : 'Terminée' ?></span>
                                <div class="flex gap-sm">
                                    <button class="btn btn-sm btn-ghost" @click="activeModal = 'edit'"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-ghost" @click="activeModal = 'details'"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-ghost" @click="activeModal = 'delete'"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            <h4 style="color: var(--white); font-size: 1.125rem; margin-bottom: 1rem;"><?= htmlspecialchars($t['title']) ?></h4>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem; color: var(--gray-400); font-size: 0.875rem;">
                                <p><i class="fas fa-calendar" style="margin-right: 0.5rem; color: var(--gold-primary);"></i><?= $t['date'] ?></p>
                                <p><i class="fas fa-clock" style="margin-right: 0.5rem; color: var(--gold-primary);"></i><?= $t['duration'] ?></p>
                                <p><i class="fas fa-users" style="margin-right: 0.5rem; color: var(--gold-primary);"></i><?= $t['participants'] ?> participants</p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>
    <div class="modal-overlay" :class="{ 'active': modalOpen }" @click="modalOpen = false"></div>

    <div class="modal" :class="{ 'active': activeModal === 'create' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content"><div class="modal-icon"><i class="fas fa-graduation-cap"></i></div><div><h3 class="modal-title">Nouvelle Formation</h3><p class="modal-subtitle">Créer une nouvelle formation</p></div></div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-group"><label class="form-label">Titre</label><input type="text" class="form-input" placeholder="Titre de la formation"></div>
            <div class="form-row">
                <div class="form-group"><label class="form-label">Date</label><input type="date" class="form-input"></div>
                <div class="form-group"><label class="form-label">Durée</label><input type="text" class="form-input" placeholder="Ex: 3 jours"></div>
            </div>
            <div class="form-group"><label class="form-label">Description</label><textarea class="form-textarea" placeholder="Description de la formation..."></textarea></div>
            <div class="form-group"><label class="form-label">Nombre de places</label><input type="number" class="form-input" placeholder="30"></div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false">Annuler</button>
            <button class="btn btn-primary"><i class="fas fa-save"></i> Créer</button>
        </div>
    </div>

    <div class="modal" :class="{ 'active': activeModal === 'details' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content"><div class="modal-icon"><i class="fas fa-info-circle"></i></div><div><h3 class="modal-title">Détails Formation</h3><p class="modal-subtitle">Informations complètes</p></div></div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div style="padding: 1rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <h4 style="color: var(--gold-primary); margin-bottom: 0.5rem;">Formation Droit des Sociétés</h4>
                    <p style="color: var(--gray-400); font-size: 0.875rem;">Cette formation couvre les aspects fondamentaux du droit des sociétés en RDC...</p>
                </div>
                <div><h4 style="color: var(--white); margin-bottom: 0.5rem;">Participants (15/30)</h4></div>
            </div>
        </div>
        <div class="modal-footer"><button class="btn btn-primary" @click="modalOpen = false">Fermer</button></div>
    </div>

    <div class="modal confirm-modal" :class="{ 'active': activeModal === 'delete' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content"><div class="modal-icon"><i class="fas fa-exclamation-triangle"></i></div><div><h3 class="modal-title">Supprimer</h3><p class="modal-subtitle">Action irréversible</p></div></div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body"><p>Êtes-vous sûr de vouloir supprimer cette formation ?</p></div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false">Annuler</button>
            <button class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
        </div>
    </div>
</body>
</html>