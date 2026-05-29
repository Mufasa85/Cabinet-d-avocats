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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Responsive Modal Footer Buttons */
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
                    <button class="btn btn-primary" @click="activeModal = 'create'; modalOpen = true"><i class="fas fa-plus"></i> Nouvel Article</button>
                </div>
            </header>
            <div class="page-content">
                <?php if (!empty($success)): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
                <div class="filter-bar">
                    <div class="search-input"><i class="fas fa-search"></i><input type="text" placeholder="Rechercher..." x-model="searchQuery" @input="filterPublications()"></div>
                    <select class="filter-select" x-model="filterStatus" @change="filterPublications()">
                        <option value="">Tous</option>
                        <option value="publie">Publié</option>
                        <option value="brouillon">Brouillon</option>
                    </select>
                </div>
                <div class="card">
                    <div class="card-body" style="padding: 0;">
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
                                <tbody>
                                    <?php foreach ($publications as $p): ?>
                                        <tr>
                                            <td>
                                                <h4 style="color: var(--white);"><?= htmlspecialchars($p['titre']) ?></h4>
                                                <?php if (!empty($p['fichier'])): ?><a href="<?= FileStorage::url($p['fichier']) ?>" target="_blank" class="btn btn-sm btn-ghost">PDF</a><?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($p['auteur_nom'] ?? '—') ?></td>
                                            <td><?= $p['publie_le'] ? date('d/m/Y', strtotime($p['publie_le'])) : date('d/m/Y', strtotime($p['created_at'])) ?></td>
                                            <td><span class="badge <?= $p['statut'] === 'publie' ? 'badge-success' : 'badge-warning' ?>"><?= htmlspecialchars($p['statut']) ?></span></td>
                                            <td>—</td>
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
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-newspaper"></i></div>
                <div>
                    <h3 class="modal-title">Nouvel Article</h3>
                    <p class="modal-subtitle">Créer une publication</p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <form method="post" action="<?= Router\Router::route('/admin/publications') ?>" enctype="multipart/form-data">
            <?= Security::csrf_tokken() ?>
            <div class="modal-body">
                <div class="form-group"><label class="form-label">Titre</label><input type="text" name="titre" class="form-input" required></div>
                <div class="form-group"><label class="form-label">Description</label><textarea name="description" class="form-textarea" rows="3"></textarea></div>
                <div class="form-group"><label class="form-label">Contenu</label><textarea name="contenu" class="form-textarea" rows="6"></textarea></div>
                <div class="form-row">
                    <div class="form-group"><label class="form-label">Type</label>
                        <select name="type" class="form-select">
                            <option value="brochure">Brochure</option>
                            <option value="etude_cas">Étude de cas</option>
                            <option value="distinction">Distinction</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label">Statut</label>
                        <select name="statut" class="form-select">
                            <option value="publie">Publié</option>
                            <option value="brouillon">Brouillon</option>
                        </select>
                    </div>
                </div>
                <div class="form-group"><label class="form-label">Fichier PDF (optionnel)</label><input type="file" name="fichier" accept=".pdf"></div>
                <div class="form-group"><label class="form-label">Image couverture (optionnel)</label><input type="file" name="image" accept="image/*"></div>
            </div>
            <div class="modal-footer" style="display: flex; gap: 0.75rem; justify-content: flex-end; flex-wrap: wrap; padding: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
                <button type="button" class="btn btn-secondary" @click="modalOpen = false" style="padding: 0.75rem 1.25rem; font-size: 0.875rem; border-radius: 0.5rem;">Annuler</button>
                <button type="submit" name="action" value="brouillon" class="btn btn-secondary" style="padding: 0.75rem 1.25rem; font-size: 0.875rem; border-radius: 0.5rem;"><i class="fas fa-save"></i>&nbsp;Brouillon</button>
                <button type="submit" name="action" value="publier" class="btn btn-primary" style="padding: 0.75rem 1.25rem; font-size: 0.875rem; border-radius: 0.5rem;"><i class="fas fa-paper-plane"></i>&nbsp;Publier</button>
            </div>
        </form>
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
            <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false">Annuler</button>
            <button class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
        </div>
    </div>
</body>

<script>
    function filterPublications() {
        const query = document.querySelector('[x-model="searchQuery"]')?.value?.toLowerCase() || '';
        const status = document.querySelector('[x-model="filterStatus"]')?.value || '';
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const title = row.querySelector('h4')?.textContent?.toLowerCase() || '';
            const author = row.cells[1]?.textContent?.toLowerCase() || '';
            const badge = row.querySelector('.badge')?.textContent?.toLowerCase() || '';

            const matchesSearch = !query || title.includes(query) || author.includes(query);
            const statusMap = {
                'publié': 'publie',
                'brouillon': 'brouillon'
            };
            const normalizedStatus = statusMap[badge] || badge;
            const matchesStatus = !status || normalizedStatus === status;

            row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.search-input input, .filter-select').forEach(el => {
            el.addEventListener('input', filterPublications);
            el.addEventListener('change', filterPublications);
        });
        filterPublications();
    });
</script>

</html>