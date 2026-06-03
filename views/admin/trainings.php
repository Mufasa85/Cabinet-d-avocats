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
</head>

<body>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <!-- Modal Overlay -->
    <div class="modal-overlay" id="modalOverlay"></div>

    <div class="admin-wrapper">
        <?php require dirname(__DIR__) . '/layouts/admin/sidebar.php'; ?>
        <main class="main-content">
            <header class="admin-header">
                <div class="header-left">
                    <button class="header-toggle" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                    <div>
                        <h1 class="header-title"><?= $pageTitle ?></h1>
                        <nav class="header-breadcrumb"><a href="<?= Router\Router::route('/admin/dashboard') ?>">Accueil</a><span>/</span><span><?= $pageTitle ?></span></nav>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-primary" id="addFormationBtn"><i class="fas fa-plus"></i> Nouvelle Formation</button>
                </div>
            </header>

            <div class="page-content">
                <?php if (!empty($success)): ?><div class="alert alert-success" style="margin: 1rem;"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div><?php endif; ?>
                <?php if (!empty($error)): ?><div class="alert alert-danger" style="margin: 1rem;"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div><?php endif; ?>

                <?php if (!empty($inscriptions)): ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2 class="card-title"><i class="fas fa-user-graduate"></i> Inscriptions en attente</h2>
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
                                                <form method="post" action="<?= Router\Router::route('/admin/inscriptions/' . (int) $ins['id'] . '/statut') ?>"><?= Security::csrf_tokken() ?><input type="hidden" name="statut" value="acceptee"><button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Accepter</button></form>
                                                <form method="post" action="<?= Router\Router::route('/admin/inscriptions/' . (int) $ins['id'] . '/statut') ?>"><?= Security::csrf_tokken() ?><input type="hidden" name="statut" value="refusee"><button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Refuser</button></form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="filter-bar">
                    <div class="search-input"><i class="fas fa-search"></i><input type="text" id="filterSearch" placeholder="Rechercher une formation..."></div>
                    <select class="filter-select" id="filterStatus">
                        <option value="">Tous les statuts</option>
                        <option value="upcoming">À venir</option>
                        <option value="completed">Terminée</option>
                        <option value="cancelled">Annulée</option>
                    </select>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-graduation-cap"></i> Liste des Formations</h2>
                    </div>
                    <div class="card-body" style="padding:0;">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Date</th>
                                        <th>Lieu</th>
                                        <th>Participants</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="formations-table-body">
                                    <?php foreach ($formations as $formation): ?>
                                        <tr data-status="<?= $formation['statut'] ?? 'upcoming' ?>">
                                            <td>
                                                <div class="user-info">
                                                    <div class="avatar" style="background: linear-gradient(135deg, #d4af37, #b8860b);"><i class="fas fa-book"></i></div>
                                                    <div class="user-details">
                                                        <h4><?= htmlspecialchars($formation['titre']) ?></h4>
                                                        <span style="color: var(--gray-500); font-size: 0.75rem;"><?= htmlspecialchars($formation['description'] ?? '') ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= date('d/m/Y', strtotime($formation['date_debut'] ?? date('Y-m-d'))) ?></td>
                                            <td><?= htmlspecialchars($formation['lieu'] ?? '-') ?></td>
                                            <td><?= (int) ($formation['participants_count'] ?? 0) ?> / <?= (int) ($formation['capacite'] ?? 0) ?></td>
                                            <td>
                                                <?php
                                                $statut = $formation['statut'] ?? 'upcoming';
                                                $statutLabels = ['upcoming' => 'À venir', 'completed' => 'Terminée', 'cancelled' => 'Annulée'];
                                                $statutClasses = ['upcoming' => 'badge-info', 'completed' => 'badge-success', 'cancelled' => 'badge-danger'];
                                                ?>
                                                <span class="badge <?= $statutClasses[$statut] ?? 'badge-info' ?>"><?= $statutLabels[$statut] ?? 'À venir' ?></span>
                                            </td>
                                            <td>
                                                <div class="flex gap-sm">
                                                    <button class="btn btn-sm btn-ghost view-formation-btn" data-formation='<?= json_encode($formation) ?>' title="Voir"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-ghost edit-formation-btn" data-formation='<?= json_encode($formation) ?>' title="Modifier"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-ghost delete-formation-btn" data-formation='<?= json_encode($formation) ?>' title="Supprimer"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($formations)): ?>
                                        <tr>
                                            <td colspan="6" style="text-align: center; padding: 3rem; color: var(--gray-500);">
                                                <i class="fas fa-graduation-cap" style="font-size: 2rem; opacity: 0.3;"></i>
                                                <p style="margin-top: 1rem;">Aucune formation enregistrée</p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span style="color: var(--gray-500); font-size: 0.875rem;"><?= count($formations) ?> formation(s)</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- ADD FORMATION MODAL -->
    <div class="modal modal-lg" id="add-formation">
        <form method="POST" action="<?= Router\Router::route('/admin/trainings') ?>">
            <?= Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon"><i class="fas fa-plus"></i></div>
                    <div>
                        <h3 class="modal-title">Nouvelle Formation</h3>
                        <p class="modal-subtitle">Créer une nouvelle formation</p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Titre <span class="required">*</span></label>
                    <input type="text" name="titre" class="form-input" placeholder="Titre de la formation" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-input" rows="3" placeholder="Description de la formation"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Date de début</label>
                        <input type="date" name="date_debut" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date de fin</label>
                        <input type="date" name="date_fin" class="form-input">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Lieu</label>
                        <input type="text" name="lieu" class="form-input" placeholder="Lieu de la formation">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Capacité</label>
                        <input type="number" name="capacite" class="form-input" placeholder="Nombre max de participants" min="1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select">
                        <option value="upcoming">À venir</option>
                        <option value="completed">Terminée</option>
                        <option value="cancelled">Annulée</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Créer</button>
            </div>
        </form>
    </div>

    <!-- VIEW FORMATION MODAL -->
    <div class="modal" id="view-formation">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-graduation-cap"></i></div>
                <div>
                    <h3 class="modal-title">Détails Formation</h3>
                    <p class="modal-subtitle" id="viewFormationTitle"></p>
                </div>
            </div>
            <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div id="viewFormationContent"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Fermer</button>
            <button type="button" class="btn btn-primary" id="viewEditFormationBtn"><i class="fas fa-edit"></i> Modifier</button>
        </div>
    </div>

    <!-- EDIT FORMATION MODAL -->
    <div class="modal modal-lg" id="edit-formation">
        <form method="POST" id="editFormationForm">
            <?= Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon"><i class="fas fa-edit"></i></div>
                    <div>
                        <h3 class="modal-title">Modifier Formation</h3>
                        <p class="modal-subtitle" id="editFormationTitle"></p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="formation_id" id="editFormationId">
                <div class="form-group">
                    <label class="form-label">Titre</label>
                    <input type="text" name="titre" id="editTitre" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="editDescription" class="form-input" rows="3"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Date de début</label>
                        <input type="date" name="date_debut" id="editDateDebut" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date de fin</label>
                        <input type="date" name="date_fin" id="editDateFin" class="form-input">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Lieu</label>
                        <input type="text" name="lieu" id="editLieu" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Capacité</label>
                        <input type="number" name="capacite" id="editCapacite" class="form-input" min="1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <select name="statut" id="editStatut" class="form-select">
                        <option value="upcoming">À venir</option>
                        <option value="completed">Terminée</option>
                        <option value="cancelled">Annulée</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>

    <!-- DELETE FORMATION MODAL -->
    <div class="modal confirm-modal" id="delete-formation">
        <form method="POST" id="deleteFormationForm">
            <?= Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon" style="background: rgba(239,68,68,0.1); color: #ef4444;"><i class="fas fa-exclamation-triangle"></i></div>
                    <div>
                        <h3 class="modal-title">Supprimer la Formation</h3>
                        <p class="modal-subtitle">Cette action est irréversible</p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p style="color: var(--gray-300);">Êtes-vous sûr de vouloir supprimer la formation <strong id="deleteFormationName" style="color: var(--white);"></strong> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
            </div>
        </form>
    </div>

    <style>
        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .confirm-modal {
            max-width: 450px;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-success {
            background: #22c55e;
            color: white;
            border: none;
        }

        .btn-success:hover {
            background: #16a34a;
        }
    </style>

    <script src="../js/dash_admin.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentFormation = null;

            // Modal functions
            window.openModal = function(modalId) {
                const modal = document.getElementById(modalId);
                const overlay = document.getElementById('modalOverlay');
                if (modal && overlay) {
                    modal.classList.add('active');
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            };

            window.closeAllModals = function() {
                document.querySelectorAll('.modal.active').forEach(function(modal) {
                    modal.classList.remove('active');
                });
                document.getElementById('modalOverlay').classList.remove('active');
                document.body.style.overflow = '';
            };

            // Add button
            document.getElementById('addFormationBtn').addEventListener('click', function() {
                openModal('add-formation');
            });

            // View formation
            document.querySelectorAll('.view-formation-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentFormation = JSON.parse(this.dataset.formation);
                    document.getElementById('viewFormationTitle').textContent = currentFormation.titre;
                    document.getElementById('viewFormationContent').innerHTML = '<p><strong>Description:</strong> ' + (currentFormation.description || 'Aucune') + '</p><p><strong>Date:</strong> ' + (currentFormation.date_debut || '-') + '</p><p><strong>Lieu:</strong> ' + (currentFormation.lieu || '-') + '</p>';
                    document.getElementById('viewEditFormationBtn').dataset.formation = this.dataset.formation;
                    openModal('view-formation');
                });
            });

            // Edit formation
            document.querySelectorAll('.edit-formation-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentFormation = JSON.parse(this.dataset.formation);
                    document.getElementById('editFormationId').value = currentFormation.id;
                    document.getElementById('editFormationTitle').textContent = currentFormation.titre;
                    document.getElementById('editTitre').value = currentFormation.titre || '';
                    document.getElementById('editDescription').value = currentFormation.description || '';
                    document.getElementById('editDateDebut').value = currentFormation.date_debut || '';
                    document.getElementById('editDateFin').value = currentFormation.date_fin || '';
                    document.getElementById('editLieu').value = currentFormation.lieu || '';
                    document.getElementById('editCapacite').value = currentFormation.capacite || '';
                    document.getElementById('editStatut').value = currentFormation.statut || 'upcoming';
                    document.getElementById('editFormationForm').action = '<?= Router\Router::route('/admin/trainings') ?>/' + currentFormation.id + '/update';
                    openModal('edit-formation');
                });
            });

            // Delete formation
            document.querySelectorAll('.delete-formation-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentFormation = JSON.parse(this.dataset.formation);
                    document.getElementById('deleteFormationName').textContent = currentFormation.titre;
                    document.getElementById('deleteFormationForm').action = '<?= Router\Router::route('/admin/trainings') ?>/' + currentFormation.id + '/delete';
                    openModal('delete-formation');
                });
            });

            // View edit button
            document.getElementById('viewEditFormationBtn').addEventListener('click', function() {
                if (currentFormation) {
                    closeAllModals();
                    setTimeout(function() {
                        document.getElementById('editFormationId').value = currentFormation.id;
                        document.getElementById('editFormationTitle').textContent = currentFormation.titre;
                        document.getElementById('editTitre').value = currentFormation.titre || '';
                        document.getElementById('editDescription').value = currentFormation.description || '';
                        document.getElementById('editDateDebut').value = currentFormation.date_debut || '';
                        document.getElementById('editDateFin').value = currentFormation.date_fin || '';
                        document.getElementById('editLieu').value = currentFormation.lieu || '';
                        document.getElementById('editCapacite').value = currentFormation.capacite || '';
                        document.getElementById('editStatut').value = currentFormation.statut || 'upcoming';
                        document.getElementById('editFormationForm').action = '<?= Router\Router::route('/admin/trainings') ?>/' + currentFormation.id + '/update';
                        openModal('edit-formation');
                    }, 100);
                }
            });

            // Filter function
            function filterTrainings() {
                const query = document.getElementById('filterSearch')?.value?.toLowerCase() || '';
                const status = document.getElementById('filterStatus')?.value || '';
                const rows = document.querySelectorAll('#formations-table-body tr[data-status]');

                rows.forEach(function(row) {
                    const title = row.querySelector('h4')?.textContent?.toLowerCase() || '';
                    const rowStatus = row.dataset.status || '';
                    const matchSearch = !query || title.includes(query);
                    const matchStatus = !status || rowStatus === status;
                    row.style.display = (matchSearch && matchStatus) ? '' : 'none';
                });
            }

            document.getElementById('filterSearch')?.addEventListener('input', filterTrainings);
            document.getElementById('filterStatus')?.addEventListener('change', filterTrainings);

            // Close on escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeAllModals();
            });

            // Overlay click to close
            document.getElementById('modalOverlay')?.addEventListener('click', closeAllModals);
        });
    </script>

</body>

</html>