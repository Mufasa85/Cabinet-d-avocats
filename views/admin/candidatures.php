<?php

use Core\Auth;
use Core\Security;
use Service\FileStorage;

$pageTitle = 'Candidatures';
$statutMap = [
    'en_attente' => ['label' => 'En attente', 'badge' => 'badge-warning'],
    'analyse' => ['label' => 'En analyse', 'badge' => 'badge-info'],
    'retenu' => ['label' => 'Retenu', 'badge' => 'badge-success'],
    'refuse' => ['label' => 'Refusé', 'badge' => 'badge-danger'],
];
$applications = $applications ?? [];
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
                    <button class="btn btn-primary" id="exportPdfBtn"><i class="fas fa-download"></i> Exporter PDF</button>
                </div>
            </header>

            <div class="page-content">
                <?php if (!empty($success)): ?><div class="alert alert-success" style="margin: 1rem;"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div><?php endif; ?>
                <?php if (!empty($error)): ?><div class="alert alert-danger" style="margin: 1rem;"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div><?php endif; ?>

                <div class="filter-bar">
                    <div class="search-input"><i class="fas fa-search"></i><input type="text" id="filterSearch" placeholder="Rechercher par nom, email..."></div>
                    <select class="filter-select" id="filterStatus">
                        <option value="">Tous les statuts</option>
                        <option value="en_attente">En attente</option>
                        <option value="analyse">En analyse</option>
                        <option value="retenu">Retenu</option>
                        <option value="refuse">Refusé</option>
                    </select>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-user-graduate"></i> Liste des Candidatures</h2>
                    </div>
                    <div class="card-body" style="padding:0;">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Candidat</th>
                                        <th>Domaine</th>
                                        <th>Niveau</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="candidatures-table-body">
                                    <?php foreach ($applications as $app): ?>
                                        <?php
                                        $names = explode(' ', $app['nom'] ?? '');
                                        $initials = '';
                                        foreach (array_slice($names, 0, 2) as $n) {
                                            $initials .= mb_strtoupper(mb_substr($n, 0, 1));
                                        }
                                        $appData = array_merge($app, ['initials' => $initials ?: '??']);
                                        ?>
                                        <tr data-statut="<?= $app['statut'] ?>">
                                            <td>
                                                <div class="user-info">
                                                    <div class="avatar"><?= $initials ?: '??' ?></div>
                                                    <div class="user-details">
                                                        <h4><?= htmlspecialchars($app['nom']) . " " . htmlspecialchars($app['prenom'])
                                                            ?></h4>
                                                        <span style="color: var(--gray-500); font-size: 0.75rem;"><?= htmlspecialchars($app['email']) ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-info"><?= htmlspecialchars($app['domaine'] ?? '-') ?></span></td>
                                            <td><?= htmlspecialchars($app['niveau'] ?? '-') ?></td>
                                            <td>
                                                <span class="badge <?= $statutMap[$app['statut']]['badge'] ?? 'badge-warning' ?>">
                                                    <?= $statutMap[$app['statut']]['label'] ?? $app['statut'] ?>
                                                </span>
                                            </td>
                                            <td><?= htmlspecialchars($app['date'] ?? '-') ?></td>
                                            <td>
                                                <div class="flex gap-sm">
                                                    <button class="btn btn-sm btn-ghost view-app-btn" data-app='<?= json_encode($appData) ?>' title="Voir"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-ghost edit-app-btn" data-app='<?= json_encode($appData) ?>' title="Modifier"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-ghost delete-app-btn" data-app='<?= json_encode($appData) ?>' title="Supprimer"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($applications)): ?>
                                        <tr>
                                            <td colspan="6" style="text-align: center; padding: 3rem; color: var(--gray-500);">
                                                <i class="fas fa-user-graduate" style="font-size: 2rem; opacity: 0.3;"></i>
                                                <p style="margin-top: 1rem;">Aucune candidature</p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span id="appCount" style="color: var(--gray-500); font-size: 0.875rem;"><?= count($applications) ?> candidature(s)</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- VIEW APPLICATION MODAL -->
    <div class="modal modal-lg" id="view-application">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-user-graduate"></i></div>
                <div>
                    <h3 class="modal-title">Détails de la Candidature</h3>
                    <p class="modal-subtitle" id="viewAppTitle"></p>
                </div>
            </div>
            <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
                <div style="text-align: center;">
                    <div class="avatar avatar-xl" id="viewAppAvatar" style="margin: 0 auto 1rem; width: 100px; height: 100px; font-size: 2rem;"></div>
                    <h4 id="viewAppName" style="color: var(--white);"></h4>
                    <p id="viewAppNiveau" style="color: var(--gray-500);"></p>
                    <div style="margin-top: 1.5rem; text-align: left;">
                        <p style="color: var(--gray-500); font-size: 0.75rem;">Email</p>
                        <p id="viewAppEmail" style="color: var(--white);"></p>
                        <p style="color: var(--gray-500); font-size: 0.75rem; margin-top: 0.75rem;">Téléphone</p>
                        <p id="viewAppTelephone" style="color: var(--white);"></p>
                        <p style="color: var(--gray-500); font-size: 0.75rem; margin-top: 0.75rem;">Université</p>
                        <p id="viewAppUniversite" style="color: var(--white);"></p>
                    </div>
                </div>
                <div>
                    <h4 style="color: var(--white);">Domaine</h4>
                    <span class="badge badge-info" id="viewAppDomaine"></span>
                    <h4 style="color: var(--white); margin-top: 1.5rem;">Documents</h4>
                    <div style="display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                        <i class="fas fa-file-pdf" style="color: var(--danger);"></i>
                        <span style="flex: 1; color: var(--gray-300);">CV_Candidat.pdf</span>
                        <button class="btn btn-sm btn-ghost"><i class="fas fa-download"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Fermer</button>
            <button type="button" class="btn btn-success" id="acceptAppBtn"><i class="fas fa-check"></i> Accepter</button>
            <button type="button" class="btn btn-danger" id="rejectAppBtn"><i class="fas fa-times"></i> Refuser</button>
        </div>
    </div>

    <!-- EDIT APPLICATION MODAL -->
    <div class="modal" id="edit-application">
        <form method="POST" id="editAppForm">
            <?= Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon"><i class="fas fa-edit"></i></div>
                    <div>
                        <h3 class="modal-title">Modifier la Candidature</h3>
                        <p class="modal-subtitle" id="editAppTitle"></p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="application_id" id="editAppId">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nom Complet</label>
                        <input type="text" name="fullname" id="editFullname" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="editEmail" class="form-input" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" name="telephone" id="editTelephone" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Université</label>
                        <input type="text" name="universite" id="editUniversite" class="form-input">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Domaine</label>
                        <select name="domaine" id="editDomaine" class="form-select">
                            <option>Droit des Affaires</option>
                            <option>Droit Fiscal</option>
                            <option>Droit du Travail</option>
                            <option>Droit OHADA</option>
                            <option>Droit Minier</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Niveau</label>
                        <select name="niveau" id="editNiveau" class="form-select">
                            <option>Licence</option>
                            <option>Master I</option>
                            <option>Master II</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <select name="statut" id="editStatut" class="form-select">
                        <option value="en_attente">En attente</option>
                        <option value="analyse">En analyse</option>
                        <option value="retenu">Retenu</option>
                        <option value="refuse">Refusé</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>

    <!-- DELETE APPLICATION MODAL -->
    <div class="modal confirm-modal" id="delete-application">
        <form method="POST" id="deleteAppForm">
            <?= Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon" style="background: rgba(239,68,68,0.1); color: #ef4444;"><i class="fas fa-exclamation-triangle"></i></div>
                    <div>
                        <h3 class="modal-title">Supprimer la Candidature</h3>
                        <p class="modal-subtitle">Cette action est irréversible</p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p style="color: var(--gray-300);">Êtes-vous sûr de vouloir supprimer la candidature de <strong id="deleteAppName" style="color: var(--white);"></strong> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
            </div>
        </form>
    </div>

    <style>
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
            let currentApp = null;

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

            // Export PDF button
            document.getElementById('exportPdfBtn').addEventListener('click', function() {
                alert('Export PDF - À implémenter');
            });

            // View application
            document.querySelectorAll('.view-app-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentApp = JSON.parse(this.dataset.app);
                    document.getElementById('viewAppAvatar').textContent = currentApp.initials || '??';
                    document.getElementById('viewAppTitle').textContent = currentApp.fullname;
                    document.getElementById('viewAppName').textContent = currentApp.fullname;
                    document.getElementById('viewAppNiveau').textContent = currentApp.niveau || '';
                    document.getElementById('viewAppEmail').textContent = currentApp.email || '-';
                    document.getElementById('viewAppTelephone').textContent = currentApp.telephone || '-';
                    document.getElementById('viewAppUniversite').textContent = currentApp.universite || '-';
                    document.getElementById('viewAppDomaine').textContent = currentApp.domaine || '-';
                    openModal('view-application');
                });
            });

            // Edit application
            document.querySelectorAll('.edit-app-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentApp = JSON.parse(this.dataset.app);
                    document.getElementById('editAppId').value = currentApp.id;
                    document.getElementById('editAppTitle').textContent = currentApp.fullname;
                    document.getElementById('editFullname').value = currentApp.fullname || '';
                    document.getElementById('editEmail').value = currentApp.email || '';
                    document.getElementById('editTelephone').value = currentApp.telephone || '';
                    document.getElementById('editUniversite').value = currentApp.universite || '';
                    document.getElementById('editDomaine').value = currentApp.domaine || '';
                    document.getElementById('editNiveau').value = currentApp.niveau || '';
                    document.getElementById('editStatut').value = currentApp.statut || 'en_attente';
                    document.getElementById('editAppForm').action = '<?= Router\Router::route('/admin/candidatures') ?>/' + currentApp.id + '/update';
                    openModal('edit-application');
                });
            });

            // Delete application
            document.querySelectorAll('.delete-app-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentApp = JSON.parse(this.dataset.app);
                    document.getElementById('deleteAppName').textContent = currentApp.fullname;
                    document.getElementById('deleteAppForm').action = '<?= Router\Router::route('/admin/candidatures') ?>/' + currentApp.id + '/delete';
                    openModal('delete-application');
                });
            });

            // Accept / Reject buttons
            document.getElementById('acceptAppBtn').addEventListener('click', function() {
                if (currentApp) {
                    alert('Candidature acceptée: ' + currentApp.fullname);
                    closeAllModals();
                }
            });

            document.getElementById('rejectAppBtn').addEventListener('click', function() {
                if (currentApp) {
                    alert('Candidature refusée: ' + currentApp.fullname);
                    closeAllModals();
                }
            });

            // Filter function
            function filterApps() {
                const query = document.getElementById('filterSearch')?.value?.toLowerCase() || '';
                const status = document.getElementById('filterStatus')?.value || '';
                const rows = document.querySelectorAll('#candidatures-table-body tr[data-statut]');
                let count = 0;

                rows.forEach(function(row) {
                    const name = row.querySelector('h4')?.textContent?.toLowerCase() || '';
                    const email = row.querySelector('span')?.textContent?.toLowerCase() || '';
                    const rowStatus = row.dataset.statut || '';
                    const matchSearch = !query || name.includes(query) || email.includes(query);
                    const matchStatus = !status || rowStatus === status;
                    row.style.display = (matchSearch && matchStatus) ? '' : 'none';
                    if (matchSearch && matchStatus) count++;
                });

                document.getElementById('appCount').textContent = count + ' candidature(s)';
            }

            document.getElementById('filterSearch')?.addEventListener('input', filterApps);
            document.getElementById('filterStatus')?.addEventListener('change', filterApps);

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