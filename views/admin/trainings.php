<?php

use Core\Security;

$pageTitle = 'Formations';
$formations = $formations ?? [];
$inscriptions = $inscriptions ?? [];
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

<body x-data="{ sidebarOpen: false, modalOpen: false, activeModal: null, searchQuery: '', filterStatus: '' }">
    <div class="admin-wrapper">
        <?php require dirname(__DIR__) . '/layouts/admin/sidebar.php'; ?>
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
                <?php if (!empty($success)): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
                <?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
                <?php if (!empty($inscriptions)): ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2 class="card-title">Inscriptions en attente</h2>
                        </div>
                        <div class="card-body" style="padding:0;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Formation</th>
                                        <th>Candidat</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($inscriptions as $ins): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($ins['formation_titre']) ?></td>
                                            <td><?= htmlspecialchars($ins['fullname']) ?> (<?= htmlspecialchars($ins['email']) ?>)</td>
                                            <td><?= date('d/m/Y', strtotime($ins['created_at'])) ?></td>
                                            <td class="flex gap-sm">
                                                <form method="post" action="<?= Router\Router::route('/admin/inscriptions/' . (int)$ins['id'] . '/statut') ?>"><?= Security::csrf_tokken() ?><input type="hidden" name="statut" value="acceptee"><button type="submit" class="btn btn-sm btn-success">Accepter</button></form>
                                                <form method="post" action="<?= Router\Router::route('/admin/inscriptions/' . (int)$ins['id'] . '/statut') ?>"><?= Security::csrf_tokken() ?><input type="hidden" name="statut" value="refusee"><button type="submit" class="btn btn-sm btn-danger">Refuser</button></form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="filter-bar">
                    <div class="search-input"><i class="fas fa-search"></i><input type="text" placeholder="Rechercher..." x-model="searchQuery" @input="filterTrainings()"></div>
                    <select class="filter-select" x-model="filterStatus" @change="filterTrainings()">
                        <option value="">Tous les statuts</option>
                        <option value="upcoming">À venir</option>
                        <option value="completed">Terminée</option>
                    </select>
                </div>
                <div class="grid-2">
                    <?php foreach ($formations as $t): ?>
                        <div class="card hover-lift">
                            <div class="card-body">
                                <div class="flex justify-between items-center mb-md">
                                    <span class="badge badge-gold"><?= htmlspecialchars($t['statut']) ?></span>
                                </div>
                                <h4 style="color: var(--white); font-size: 1.125rem; margin-bottom: 1rem;"><?= htmlspecialchars($t['titre']) ?></h4>
                                <div style="display: flex; flex-direction: column; gap: 0.5rem; color: var(--gray-400); font-size: 0.875rem;">
                                    <p><i class="fas fa-calendar" style="margin-right: 0.5rem; color: var(--gold-primary);"></i><?= $t['date_debut'] ? date('d/m/Y', strtotime($t['date_debut'])) : '—' ?></p>
                                    <p><i class="fas fa-users" style="margin-right: 0.5rem; color: var(--gold-primary);"></i><?= (int)$t['places_reservees'] ?>/<?= (int)$t['places_max'] ?> places</p>
                                    <p><i class="fas fa-user-tag" style="margin-right: 0.5rem; color: var(--gold-primary);"></i><?= htmlspecialchars($t['public_cible']) ?></p>
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
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-graduation-cap"></i></div>
                <div>
                    <h3 class="modal-title">Nouvelle Formation</h3>
                    <p class="modal-subtitle">Créer une nouvelle formation</p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <form method="post" action="<?= Router\Router::route('/admin/trainings') ?>">
            <?= Security::csrf_tokken() ?>
            <div class="modal-body">
                <div class="form-group"><label class="form-label">Titre</label><input type="text" name="titre" class="form-input" required></div>
                <div class="form-row">
                    <div class="form-group"><label class="form-label">Date début</label><input type="date" name="date_debut" class="form-input"></div>
                    <div class="form-group"><label class="form-label">Date fin</label><input type="date" name="date_fin" class="form-input"></div>
                </div>
                <div class="form-group"><label class="form-label">Lieu</label><input type="text" name="lieu" class="form-input"></div>
                <div class="form-group"><label class="form-label">Description</label><textarea name="description" class="form-textarea"></textarea></div>
                <div class="form-row">
                    <div class="form-group"><label class="form-label">Places max</label><input type="number" name="places_max" class="form-input" value="20"></div>
                    <div class="form-group"><label class="form-label">Public</label>
                        <select name="public_cible" class="form-select">
                            <option value="tous">Tous</option>
                            <option value="avocat">Avocats</option>
                            <option value="stagiaire">Stagiaires</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="modalOpen = false">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Créer</button>
            </div>
        </form>
    </div>

    <div class="modal" :class="{ 'active': activeModal === 'details' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-info-circle"></i></div>
                <div>
                    <h3 class="modal-title">Détails Formation</h3>
                    <p class="modal-subtitle">Informations complètes</p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div style="padding: 1rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <h4 style="color: var(--gold-primary); margin-bottom: 0.5rem;">Formation Droit des Sociétés</h4>
                    <p style="color: var(--gray-400); font-size: 0.875rem;">Cette formation couvre les aspects fondamentaux du droit des sociétés en RDC...</p>
                </div>
                <div>
                    <h4 style="color: var(--white); margin-bottom: 0.5rem;">Participants (15/30)</h4>
                </div>
            </div>
        </div>
        <div class="modal-footer"><button class="btn btn-primary" @click="modalOpen = false">Fermer</button></div>
    </div>

    <div class="modal confirm-modal" :class="{ 'active': activeModal === 'delete' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div>
                    <h3 class="modal-title">Supprimer</h3>
                    <p class="modal-subtitle">Action irréversible</p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p>Êtes-vous sûr de vouloir supprimer cette formation ?</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false">Annuler</button>
            <button class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
        </div>
    </div>
</body>

<script>
    function filterTrainings() {
        const query = document.querySelector('[x-model="searchQuery"]')?.value?.toLowerCase() || '';
        const cards = document.querySelectorAll('.grid-2 .card');

        cards.forEach(card => {
            const title = card.querySelector('h4')?.textContent?.toLowerCase() || '';
            const visible = !query || title.includes(query);
            card.style.display = visible ? '' : 'none';
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.search-input input, .filter-select').forEach(el => {
            el.addEventListener('input', filterTrainings);
            el.addEventListener('change', filterTrainings);
        });
        filterTrainings();
    });
</script>

</html>