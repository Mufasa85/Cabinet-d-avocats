<?php

use Core\Security;
use Service\FileStorage;

$pageTitle = 'Publications';
$publications = $publications ?? [];
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
    <style>
        @media (max-width: 480px) {
            .modal .modal-footer .btn {
                flex: 1 1 calc(50% - 0.5rem);
                min-width: 0;
                padding: 0.625rem 0.5rem !important;
                font-size: 0.8125rem !important;
                white-space: nowrap;
            }

            .modal .modal-footer {
                gap: 0.5rem !important;
            }
        }

        @media (min-width: 481px) {
            .modal .modal-footer .btn {
                flex: 0 0 auto;
                min-width: 110px;
                padding: 0.75rem 1.25rem !important;
            }
        }
    </style>
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
                    <button class="btn btn-primary" id="addPublicationBtn"><i class="fas fa-plus"></i> Nouvel Article</button>
                </div>
            </header>

            <div class="page-content">
                <?php if (!empty($success)): ?><div class="alert alert-success" style="margin: 1rem;"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div><?php endif; ?>

                <div class="filter-bar">
                    <div class="search-input"><i class="fas fa-search"></i><input type="text" id="filterSearch" placeholder="Rechercher..."></div>
                    <select class="filter-select" id="filterStatus">
                        <option value="">Tous</option>
                        <option value="publie">Publié</option>
                        <option value="brouillon">Brouillon</option>
                    </select>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-newspaper"></i> Liste des Publications</h2>
                    </div>
                    <div class="card-body" style="padding:0;">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Article</th>
                                        <th>Auteur</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                        <th>Vues</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="publications-table-body">
                                    <?php foreach ($publications as $p): ?>
                                        <tr data-status="<?= $p['statut'] ?>">
                                            <td>
                                                <h4 style="color: var(--white); margin: 0;"><?= htmlspecialchars($p['titre']) ?></h4>
                                                <?php if (!empty($p['fichier'])): ?>
                                                    <a href="<?= FileStorage::url($p['fichier']) ?>" target="_blank" class="btn btn-sm btn-ghost" style="margin-top: 0.25rem;"><i class="fas fa-file-pdf"></i> PDF</a>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($p['auteur_nom'] ?? '—') ?></td>
                                            <td><?= $p['publie_le'] ? date('d/m/Y', strtotime($p['publie_le'])) : date('d/m/Y', strtotime($p['created_at'])) ?></td>
                                            <td><span class="badge <?= $p['statut'] === 'publie' ? 'badge-success' : 'badge-warning' ?>"><?= htmlspecialchars($p['statut']) ?></span></td>
                                            <td>—</td>
                                            <td>
                                                <div class="flex gap-sm">
                                                    <button class="btn btn-sm btn-ghost view-pub-btn" data-pub='<?= json_encode($p) ?>' title="Voir"><i class="fas fa-eye"></i></button>
                                                    <button class="btn btn-sm btn-ghost edit-pub-btn" data-pub='<?= json_encode($p) ?>' title="Modifier"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-ghost delete-pub-btn" data-pub='<?= json_encode($p) ?>' title="Supprimer"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($publications)): ?>
                                        <tr>
                                            <td colspan="6" style="text-align: center; padding: 3rem; color: var(--gray-500);">
                                                <i class="fas fa-newspaper" style="font-size: 2rem; opacity: 0.3;"></i>
                                                <p style="margin-top: 1rem;">Aucune publication</p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span style="color: var(--gray-500); font-size: 0.875rem;"><?= count($publications) ?> publication(s)</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- ADD PUBLICATION MODAL -->
    <div class="modal modal-lg" id="add-publication">
        <form method="POST" action="<?= Router\Router::route('/admin/publications') ?>" enctype="multipart/form-data">
            <?= Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon"><i class="fas fa-plus"></i></div>
                    <div>
                        <h3 class="modal-title">Nouvel Article</h3>
                        <p class="modal-subtitle">Créer une nouvelle publication</p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Titre <span class="required">*</span></label>
                    <input type="text" name="titre" class="form-input" placeholder="Titre de l'article" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Contenu</label>
                    <textarea name="contenu" class="form-input" rows="6" placeholder="Contenu de l'article..."></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select">
                            <option value="article">Article</option>
                            <option value="actualite">Actualité</option>
                            <option value="jurisprudence">Jurisprudence</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-select">
                            <option value="brouillon">Brouillon</option>
                            <option value="publie">Publié</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Fichier PDF</label>
                    <input type="file" name="fichier" class="form-input" accept=".pdf">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Publier</button>
            </div>
        </form>
    </div>

    <!-- VIEW PUBLICATION MODAL -->
    <div class="modal" id="view-publication">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-newspaper"></i></div>
                <div>
                    <h3 class="modal-title">Détails</h3>
                    <p class="modal-subtitle" id="viewPubTitle"></p>
                </div>
            </div>
            <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
            <div id="viewPubContent"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Fermer</button>
            <button type="button" class="btn btn-primary" id="viewEditPubBtn"><i class="fas fa-edit"></i> Modifier</button>
        </div>
    </div>

    <!-- EDIT PUBLICATION MODAL -->
    <div class="modal modal-lg" id="edit-publication">
        <form method="POST" id="editPubForm" enctype="multipart/form-data">
            <?= Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon"><i class="fas fa-edit"></i></div>
                    <div>
                        <h3 class="modal-title">Modifier l'Article</h3>
                        <p class="modal-subtitle" id="editPubTitle"></p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="publication_id" id="editPubId">
                <div class="form-group">
                    <label class="form-label">Titre</label>
                    <input type="text" name="titre" id="editPubTitre" class="form-input" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Contenu</label>
                    <textarea name="contenu" id="editPubContenu" class="form-input" rows="6"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <select name="type" id="editPubType" class="form-select">
                            <option value="article">Article</option>
                            <option value="actualite">Actualité</option>
                            <option value="jurisprudence">Jurisprudence</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Statut</label>
                        <select name="statut" id="editPubStatut" class="form-select">
                            <option value="brouillon">Brouillon</option>
                            <option value="publie">Publié</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Fichier PDF (laisser vide pour ne pas changer)</label>
                    <input type="file" name="fichier" class="form-input" accept=".pdf">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>

    <!-- DELETE PUBLICATION MODAL -->
    <div class="modal confirm-modal" id="delete-publication">
        <form method="POST" id="deletePubForm">
            <?= Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon" style="background: rgba(239,68,68,0.1); color: #ef4444;"><i class="fas fa-exclamation-triangle"></i></div>
                    <div>
                        <h3 class="modal-title">Supprimer l'Article</h3>
                        <p class="modal-subtitle">Cette action est irréversible</p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p style="color: var(--gray-300);">Êtes-vous sûr de vouloir supprimer l'article <strong id="deletePubName" style="color: var(--white);"></strong> ?</p>
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
    </style>

    <script src="../js/dash_admin.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentPub = null;

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
            document.getElementById('addPublicationBtn').addEventListener('click', function() {
                openModal('add-publication');
            });

            // View publication
            document.querySelectorAll('.view-pub-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentPub = JSON.parse(this.dataset.pub);
                    document.getElementById('viewPubTitle').textContent = currentPub.titre;
                    document.getElementById('viewPubContent').innerHTML = '<p><strong>Contenu:</strong></p><p>' + (currentPub.contenu || 'Aucun contenu') + '</p><p style="margin-top: 1rem;"><strong>Type:</strong> ' + (currentPub.type || '-') + '</p>';
                    document.getElementById('viewEditPubBtn').dataset.pub = this.dataset.pub;
                    openModal('view-publication');
                });
            });

            // Edit publication
            document.querySelectorAll('.edit-pub-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentPub = JSON.parse(this.dataset.pub);
                    document.getElementById('editPubId').value = currentPub.id;
                    document.getElementById('editPubTitle').textContent = currentPub.titre;
                    document.getElementById('editPubTitre').value = currentPub.titre || '';
                    document.getElementById('editPubContenu').value = currentPub.contenu || '';
                    document.getElementById('editPubType').value = currentPub.type || 'article';
                    document.getElementById('editPubStatut').value = currentPub.statut || 'brouillon';
                    document.getElementById('editPubForm').action = '<?= Router\Router::route('/admin/publications') ?>/' + currentPub.id + '/update';
                    openModal('edit-publication');
                });
            });

            // Delete publication
            document.querySelectorAll('.delete-pub-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentPub = JSON.parse(this.dataset.pub);
                    document.getElementById('deletePubName').textContent = currentPub.titre;
                    document.getElementById('deletePubForm').action = '<?= Router\Router::route('/admin/publications') ?>/' + currentPub.id + '/delete';
                    openModal('delete-publication');
                });
            });

            // View edit button
            document.getElementById('viewEditPubBtn').addEventListener('click', function() {
                if (currentPub) {
                    closeAllModals();
                    setTimeout(function() {
                        document.getElementById('editPubId').value = currentPub.id;
                        document.getElementById('editPubTitle').textContent = currentPub.titre;
                        document.getElementById('editPubTitre').value = currentPub.titre || '';
                        document.getElementById('editPubContenu').value = currentPub.contenu || '';
                        document.getElementById('editPubType').value = currentPub.type || 'article';
                        document.getElementById('editPubStatut').value = currentPub.statut || 'brouillon';
                        document.getElementById('editPubForm').action = '<?= Router\Router::route('/admin/publications') ?>/' + currentPub.id + '/update';
                        openModal('edit-publication');
                    }, 100);
                }
            });

            // Filter function
            function filterPublications() {
                const query = document.getElementById('filterSearch')?.value?.toLowerCase() || '';
                const status = document.getElementById('filterStatus')?.value || '';
                const rows = document.querySelectorAll('#publications-table-body tr[data-status]');

                rows.forEach(function(row) {
                    const title = row.querySelector('h4')?.textContent?.toLowerCase() || '';
                    const rowStatus = row.dataset.status || '';
                    const matchSearch = !query || title.includes(query);
                    const matchStatus = !status || rowStatus === status;
                    row.style.display = (matchSearch && matchStatus) ? '' : 'none';
                });
            }

            document.getElementById('filterSearch')?.addEventListener('input', filterPublications);
            document.getElementById('filterStatus')?.addEventListener('change', filterPublications);

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