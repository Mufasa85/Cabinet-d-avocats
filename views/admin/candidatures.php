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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{ sidebarOpen: false, modalOpen: false, activeModal: null, selectedApp: null, searchQuery: '', filterStatus: '' }">
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
                    <button class="btn btn-primary"><i class="fas fa-download"></i> Exporter PDF</button>
                </div>
            </header>
            <div class="page-content">
                <?php if (!empty($success)): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
                <?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
                <div class="filter-bar">
                    <div class="search-input"><i class="fas fa-search"></i><input type="text" placeholder="Rechercher une candidature..." x-model="searchQuery" @input="filterCandidatures()"></div>
                    <select class="filter-select" x-model="filterStatus" @change="filterCandidatures()">
                        <option value="">Tous les statuts</option>
                        <option value="en_attente">En attente</option>
                        <option value="analyse">En analyse</option>
                        <option value="retenu">Retenu</option>
                        <option value="refuse">Refusé</option>
                    </select>
                </div>
                <div class="card">
                    <div class="card-body" style="padding: 0;">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Candidat</th>
                                        <th>Université</th>
                                        <th>Domaine</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($applications as $app):
                                        $name = trim(($app['prenom'] ?? '') . ' ' . ($app['nom'] ?? ''));
                                        $initials = Auth::initials($name);
                                        $st = $statutMap[$app['statut']] ?? ['label' => $app['statut'], 'badge' => 'badge-warning'];
                                        $appJson = htmlspecialchars(json_encode([
                                            'id' => $app['id'],
                                            'name' => $name,
                                            'email' => $app['email'],
                                            'university' => $app['universite'],
                                            'field' => $app['departement_souhaite'],
                                            'motivation' => $app['motivation'],
                                            'documents' => $app['documents'] ?? [],
                                        ]), ENT_QUOTES, 'UTF-8');
                                    ?>
                                        <tr data-status="<?= $app['statut'] ?>">
                                            <td>
                                                <div class="user-info">
                                                    <div class="avatar"><?= htmlspecialchars($initials) ?></div>
                                                    <div class="user-details">
                                                        <h4><?= htmlspecialchars($name) ?></h4><span><?= htmlspecialchars($app['email']) ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= htmlspecialchars($app['universite']) ?></td>
                                            <td><?= htmlspecialchars($app['departement_souhaite']) ?></td>
                                            <td><?= date('d M Y', strtotime($app['created_at'])) ?></td>
                                            <td><span class="badge <?= $st['badge'] ?>"><?= htmlspecialchars($st['label']) ?></span></td>
                                            <td>
                                                <div class="flex gap-sm">
                                                    <button type="button" class="btn btn-sm btn-ghost" @click="selectedApp = <?= $appJson ?>; activeModal = 'preview'; modalOpen = true"><i class="fas fa-eye"></i></button>
                                                    <?php if (in_array($app['statut'], ['en_attente', 'analyse'], true)): ?>
                                                        <form method="post" action="<?= Router\Router::route('/admin/candidatures/' . (int)$app['id'] . '/statut') ?>" style="display:inline;"><?= Security::csrf_tokken() ?><input type="hidden" name="statut" value="retenu"><button type="submit" class="btn btn-sm btn-success" title="Accepter"><i class="fas fa-check"></i></button></form>
                                                        <button type="button" class="btn btn-sm btn-danger" @click="selectedApp = <?= $appJson ?>; activeModal = 'reject'; modalOpen = true"><i class="fas fa-times"></i></button>
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
                <div>
                    <h3 class="modal-title">Candidature</h3>
                    <p class="modal-subtitle" x-text="selectedApp ? selectedApp.name : ''"></p>
                </div>
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
                        <div>
                            <p style="color: var(--gray-500); font-size: 0.75rem;">Domaine</p>
                            <p style="color: var(--white);" x-text="selectedApp ? selectedApp.field : ''"></p>
                        </div>
                        <div>
                            <p style="color: var(--gray-500); font-size: 0.75rem;">Date</p>
                            <p style="color: var(--white);" x-text="selectedApp ? selectedApp.date : ''"></p>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 style="color: var(--white); margin-bottom: 0.5rem;">Lettre de Candidature</h4>
                    <p style="color: var(--gray-400); line-height: 1.7; margin-bottom: 1.5rem;" x-text="selectedApp ? selectedApp.motivation : ''"></p>
                    <h4 style="color: var(--white); margin-bottom: 0.5rem;">Documents</h4>
                    <template x-if="selectedApp && selectedApp.documents">
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <template x-for="doc in selectedApp.documents" :key="doc.id">
                                <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                                    <i class="fas fa-file-pdf" style="color: var(--danger);"></i>
                                    <span style="color: var(--gray-300); font-size: 0.875rem; flex: 1;" x-text="doc.type"></span>
                                    <a :href="'<?= Router\Router::route('/resources/') ?>' + doc.fichier" class="btn btn-sm btn-ghost" target="_blank"><i class="fas fa-download"></i></a>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" @click="activeModal = 'reject'"><i class="fas fa-times"></i> Refuser</button>
            <form method="post" :action="'<?= Router\Router::route('/admin/candidatures/') ?>' + (selectedApp ? selectedApp.id : '') + '/statut'" x-show="selectedApp">
                <?= Security::csrf_tokken() ?>
                <input type="hidden" name="statut" value="retenu">
                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Accepter</button>
            </form>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal confirm-modal" :class="{ 'active': activeModal === 'reject' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-times-circle"></i></div>
                <div>
                    <h3 class="modal-title">Refuser la Candidature</h3>
                    <p class="modal-subtitle">Motif du refus</p>
                </div>
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
            <button type="button" class="btn btn-secondary" @click="modalOpen = false">Annuler</button>
            <form method="post" :action="'<?= Router\Router::route('/admin/candidatures/') ?>' + (selectedApp ? selectedApp.id : '') + '/statut'" x-show="selectedApp">
                <?= Security::csrf_tokken() ?>
                <input type="hidden" name="statut" value="refuse">
                <div class="form-group" style="text-align:left;margin-bottom:1rem;">
                    <textarea name="motif" class="form-textarea" placeholder="Motif du refus..." required></textarea>
                </div>
                <button type="submit" class="btn btn-danger"><i class="fas fa-paper-plane"></i> Envoyer</button>
            </form>
        </div>
    </div>

    <script>
        function filterCandidatures() {
            const query = document.querySelector('[x-model="searchQuery"]')?.value?.toLowerCase() || '';
            const status = document.querySelector('[x-model="filterStatus"]')?.value || '';
            const rows = document.querySelectorAll('tbody tr[data-status]');

            rows.forEach(row => {
                const name = row.querySelector('h4')?.textContent?.toLowerCase() || '';
                const email = row.querySelector('.user-details span')?.textContent?.toLowerCase() || '';
                const rowStatus = row.dataset.status || '';

                const matchesSearch = !query || name.includes(query) || email.includes(query);
                const matchesStatus = !status || rowStatus === status;

                row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.search-input input, .filter-select').forEach(el => {
                el.addEventListener('input', filterCandidatures);
                el.addEventListener('change', filterCandidatures);
            });
            filterCandidatures();
        });
    </script>
</body>

</html>