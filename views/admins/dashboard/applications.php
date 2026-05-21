<?php
$pageTitle = 'Candidatures';
$applications = [
    ['id' => 1, 'name' => 'Jean Mukamba', 'university' => 'Université de Kinshasa', 'field' => 'Droit des Affaires', 'date' => '15 Mai 2026', 'status' => 'pending', 'avatar' => 'JM'],
    ['id' => 2, 'name' => 'Aminata Ngalulu', 'university' => 'Université Catholique', 'field' => 'Droit Fiscal', 'date' => '14 Mai 2026', 'status' => 'pending', 'avatar' => 'AN'],
    ['id' => 3, 'name' => 'Pierre Mbuyi', 'university' => 'Université Protestante', 'field' => 'Droit du Travail', 'date' => '13 Mai 2026', 'status' => 'pending', 'avatar' => 'PM'],
    ['id' => 4, 'name' => 'Marie Kasaï', 'university' => 'Université de Lubumbashi', 'field' => 'Droit Minier', 'date' => '10 Mai 2026', 'status' => 'accepted', 'avatar' => 'MK'],
    ['id' => 5, 'name' => 'Robert Diallo', 'university' => 'Université de Kinshasa', 'field' => 'Droit des Sociétés', 'date' => '08 Mai 2026', 'status' => 'rejected', 'avatar' => 'RD'],
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
    <script src="../js/theme.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="{ sidebarOpen: false, modalOpen: false, activeModal: null, selectedApp: null }">
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
                    <button class="btn btn-primary"><i class="fas fa-download"></i> Exporter PDF</button>
                </div>
            </header>
            <div class="page-content">
                <div class="filter-bar">
                    <div class="search-input"><i class="fas fa-search"></i><input type="text" placeholder="Rechercher une candidature..."></div>
                    <select class="filter-select">
                        <option value="">Tous les statuts</option>
                        <option value="pending">En attente</option>
                        <option value="accepted">Acceptée</option>
                        <option value="rejected">Refusée</option>
                    </select>
                </div>
                <div class="card">
                    <div class="card-body" style="padding: 0;">
                        <div class="table-container">
                            <table class="table">
                                <thead><tr><th>Candidat</th><th>Université</th><th>Domaine</th><th>Date</th><th>Statut</th><th>Actions</th></tr></thead>
                                <tbody>
                                    <?php foreach ($applications as $app): ?>
                                    <tr>
                                        <td><div class="user-info"><div class="avatar"><?= $app['avatar'] ?></div><div class="user-details"><h4><?= htmlspecialchars($app['name']) ?></h4></div></div></td>
                                        <td><?= htmlspecialchars($app['university']) ?></td>
                                        <td><?= htmlspecialchars($app['field']) ?></td>
                                        <td><?= $app['date'] ?></td>
                                        <td><span class="badge <?= $app['status'] === 'pending' ? 'badge-warning' : ($app['status'] === 'accepted' ? 'badge-success' : 'badge-danger') ?>"><?= ucfirst($app['status']) ?></span></td>
                                        <td>
                                            <div class="flex gap-sm">
                                                <button class="btn btn-sm btn-ghost" @click="selectedApp = <?= htmlspecialchars(json_encode($app)) ?>; activeModal = 'preview'; modalOpen = true"><i class="fas fa-eye"></i></button>
                                                <?php if ($app['status'] === 'pending'): ?>
                                                <button class="btn btn-sm btn-success" title="Accepter"><i class="fas fa-check"></i></button>
                                                <button class="btn btn-sm btn-danger" title="Refuser" @click="selectedApp = <?= htmlspecialchars(json_encode($app)) ?>; activeModal = 'reject'; modalOpen = true"><i class="fas fa-times"></i></button>
                                                <?php endif; ?>
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

    <!-- Preview Modal -->
    <div class="modal modal-lg" :class="{ 'active': activeModal === 'preview' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-user-graduate"></i></div>
                <div><h3 class="modal-title">Candidature</h3><p class="modal-subtitle" x-text="selectedApp ? selectedApp.name : ''"></p></div>
            </div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
                <div>
                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        <div class="avatar avatar-xl" style="margin: 0 auto 1rem;" x-text="selectedApp ? selectedApp.avatar : ''"></div>
                        <h4 style="color: var(--white);" x-text="selectedApp ? selectedApp.name : ''"></h4>
                        <p style="color: var(--gray-500); font-size: 0.875rem;" x-text="selectedApp ? selectedApp.university : ''"></p>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <div><p style="color: var(--gray-500); font-size: 0.75rem;">Domaine</p><p style="color: var(--white);" x-text="selectedApp ? selectedApp.field : ''"></p></div>
                        <div><p style="color: var(--gray-500); font-size: 0.75rem;">Date</p><p style="color: var(--white);" x-text="selectedApp ? selectedApp.date : ''"></p></div>
                    </div>
                </div>
                <div>
                    <h4 style="color: var(--white); margin-bottom: 0.5rem;">Lettre de Motivation</h4>
                    <p style="color: var(--gray-400); line-height: 1.7; margin-bottom: 1.5rem;">Madame, Monsieur, Ayant terminé ma formation en Master II, je suis vivement intéressé par une opportunité de stage au sein de votre cabinet...</p>
                    <h4 style="color: var(--white); margin-bottom: 0.5rem;">Documents</h4>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                            <i class="fas fa-file-pdf" style="color: var(--danger);"></i>
                            <span style="color: var(--gray-300); font-size: 0.875rem; flex: 1;">CV_Complete.pdf</span>
                            <button class="btn btn-sm btn-ghost"><i class="fas fa-download"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" @click="activeModal = 'reject'"><i class="fas fa-times"></i> Refuser</button>
            <button class="btn btn-success"><i class="fas fa-check"></i> Accepter</button>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal confirm-modal" :class="{ 'active': activeModal === 'reject' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-times-circle"></i></div>
                <div><h3 class="modal-title">Refuser la Candidature</h3><p class="modal-subtitle">Motif du refus</p></div>
            </div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Motif du refus</label>
                <textarea class="form-textarea" placeholder="Expliquez la raison du refus..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false">Annuler</button>
            <button class="btn btn-danger"><i class="fas fa-paper-plane"></i> Envoyer</button>
        </div>
    </div>
</body>
</html>