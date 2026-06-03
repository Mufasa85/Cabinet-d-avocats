<?php

use Core\Security;
use Service\FileStorage;

$pageTitle = 'Documents stagiaires';
$documents = $documents ?? [];
$statutLabels = ['en_attente' => 'En attente', 'valide' => 'Validé', 'rejete' => 'Refusé'];
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
                    <button class="btn btn-primary" id="uploadDocBtn"><i class="fas fa-upload"></i> Upload</button>
                </div>
            </header>

            <div class="page-content">
                <?php if (!empty($success)): ?><div class="alert alert-success" style="margin: 1rem;"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div><?php endif; ?>
                <?php if (!empty($error)): ?><div class="alert alert-danger" style="margin: 1rem;"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div><?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"><i class="fas fa-file-alt"></i> Liste des Documents</h2>
                    </div>
                    <div class="card-body" style="padding:0;">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Stagiaire</th>
                                        <th>Titre</th>
                                        <th>Type</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($documents as $d): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($d['stagiaire_nom']) ?></td>
                                            <td><?= htmlspecialchars($d['titre']) ?></td>
                                            <td><span class="badge badge-info"><?= htmlspecialchars($d['type']) ?></span></td>
                                            <td><span class="badge badge-<?= $d['statut'] === 'valide' ? 'success' : ($d['statut'] === 'rejete' ? 'danger' : 'warning') ?>"><?= $statutLabels[$d['statut']] ?? $d['statut'] ?></span></td>
                                            <td><?= date('d/m/Y', strtotime($d['created_at'])) ?></td>
                                            <td>
                                                <div class="flex gap-sm">
                                                    <a href="<?= FileStorage::url($d['fichier']) ?>" class="btn btn-sm btn-ghost" target="_blank" title="Télécharger"><i class="fas fa-download"></i></a>
                                                    <?php if ($d['statut'] === 'en_attente'): ?>
                                                        <form method="post" action="<?= Router\Router::route('/admin/documents/' . (int) $d['id'] . '/valider') ?>"><?= Security::csrf_tokken() ?><input type="hidden" name="statut" value="valide"><button type="submit" class="btn btn-sm btn-success" title="Valider"><i class="fas fa-check"></i></button></form>
                                                        <form method="post" action="<?= Router\Router::route('/admin/documents/' . (int) $d['id'] . '/valider') ?>" class="flex gap-sm"><?= Security::csrf_tokken() ?><input type="hidden" name="statut" value="rejete"><input type="text" name="motif" class="form-input" placeholder="Motif" style="max-width:120px; height: 32px; padding: 0.25rem 0.5rem; font-size: 0.75rem;"><button type="submit" class="btn btn-sm btn-danger" title="Rejeter"><i class="fas fa-times"></i></button></form>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($documents)): ?>
                                        <tr>
                                            <td colspan="6" style="text-align:center;padding:3rem;color:var(--gray-500);"><i class="fas fa-file-alt" style="font-size:2rem;opacity:0.3;"></i>
                                                <p style="margin-top:1rem;">Aucun document</p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span style="color:var(--gray-500);font-size:0.875rem;"><?= count($documents) ?> document(s)</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- UPLOAD MODAL -->
    <div class="modal" id="upload-modal">
        <form method="post" action="<?= Router\Router::route('/admin/documents/upload') ?>" enctype="multipart/form-data">
            <?= Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                    <div>
                        <h3 class="modal-title">Upload Document</h3>
                        <p class="modal-subtitle">Télécharger un document stagiaire</p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Stagiaire <span class="required">*</span></label>
                    <select class="form-select" name="stagiaire_id" required>
                        <option value="">Sélectionner...</option>
                        <?php foreach (($stagiaires ?? []) as $s): ?>
                            <option value="<?= (int) ($s['id'] ?? 0) ?>"><?= htmlspecialchars($s['fullname'] ?? '') ?> (<?= htmlspecialchars($s['email'] ?? '') ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Titre <span class="required">*</span></label>
                    <input type="text" class="form-input" name="titre" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="type">
                        <option value="convention">Convention</option>
                        <option value="rapport">Rapport</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Fichier PDF <span class="required">*</span></label>
                    <input type="file" class="form-input" name="fichier" accept="application/pdf" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload</button>
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

            // Upload button
            document.getElementById('uploadDocBtn').addEventListener('click', function() {
                openModal('upload-modal');
            });

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