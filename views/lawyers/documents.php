<?php
/**
 * ELMD - Cabinet d'Avocats
 * Lawyer Documents Page
 */



if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$pageTitle = 'Mes Documents';
$currentPage = 'documents';

$lawyerName = $_SESSION['lawyer_name'] ?? 'Me. Laurent Mbako';
$lawyerAvatar = $_SESSION['lawyer_avatar'] ?? 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=100&q=80';

// Documents
$documents = [
    ['id' => 1, 'name' => 'Contrat_de_travail.pdf', 'type' => 'pdf', 'size' => '2.4 MB', 'date' => '15 Jan 2024', 'category' => 'Contrats'],
    ['id' => 2, 'name' => 'Mémoire_préparatoire.pdf', 'type' => 'pdf', 'size' => '5.1 MB', 'date' => '12 Jan 2024', 'category' => 'Juridique'],
    ['id' => 3, 'name' => 'Convention_minière.pdf', 'type' => 'pdf', 'size' => '3.8 MB', 'date' => '8 Jan 2024', 'category' => 'Droit Minier'],
    ['id' => 4, 'name' => 'Facture_2024_01.pdf', 'type' => 'pdf', 'size' => '156 KB', 'date' => '5 Jan 2024', 'category' => 'Comptabilité'],
    ['id' => 5, 'name' => 'Pouvoir_judiciaire.docx', 'type' => 'docx', 'size' => '890 KB', 'date' => '20 Déc 2023', 'category' => 'Juridique'],
    ['id' => 6, 'name' => 'Tableau_récapitulatif.xlsx', 'type' => 'xlsx', 'size' => '1.2 MB', 'date' => '15 Déc 2023', 'category' => 'Comptabilité'],
];

require dirname(__DIR__) . '/layouts/lawyer/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div>
            <h1 class="page-title">Mes Documents</h1>
            <p class="page-subtitle">Gérez vos documents juridiques et fichiers</p>
        </div>
        <div class="page-actions">
            <button class="btn btn-secondary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7 10 12 15 17 10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                Importer
            </button>
            <button class="btn btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Nouveau dossier
            </button>
        </div>
    </div>
</div>

<!-- Quick Access -->
<div class="content-grid grid-4 mb-4">
    <div class="card" style="cursor: pointer;">
        <div class="card-body flex items-center gap-3">
            <div class="stat-card-icon icon-gold">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                </svg>
            </div>
            <div>
                <h4 class="font-semibold">Contrats</h4>
                <p class="text-sm text-muted">12 fichiers</p>
            </div>
        </div>
    </div>
    <div class="card" style="cursor: pointer;">
        <div class="card-body flex items-center gap-3">
            <div class="stat-card-icon icon-info">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83M16.62 12l-5.74 9.94"/>
                </svg>
            </div>
            <div>
                <h4 class="font-semibold">Juridique</h4>
                <p class="text-sm text-muted">28 fichiers</p>
            </div>
        </div>
    </div>
    <div class="card" style="cursor: pointer;">
        <div class="card-body flex items-center gap-3">
            <div class="stat-card-icon icon-success">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>
            <div>
                <h4 class="font-semibold">Comptabilité</h4>
                <p class="text-sm text-muted">8 fichiers</p>
            </div>
        </div>
    </div>
    <div class="card" style="cursor: pointer;">
        <div class="card-body flex items-center gap-3">
            <div class="stat-card-icon icon-warning">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24">
                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                </svg>
            </div>
            <div>
                <h4 class="font-semibold">Droit Minier</h4>
                <p class="text-sm text-muted">15 fichiers</p>
            </div>
        </div>
    </div>
</div>

<!-- Documents List -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
            </svg>
            Tous les documents
        </h2>
        <div class="card-actions">
            <input type="text" class="form-input" placeholder="Rechercher..." style="width: 200px;">
        </div>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Taille</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($documents as $doc): ?>
                    <tr>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="stat-card-icon icon-<?= $doc['type'] === 'pdf' ? 'danger' : 'info' ?>" style="width: 36px; height: 36px;">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                        <polyline points="14 2 14 8 20 8"/>
                                    </svg>
                                </div>
                                <span class="font-semibold"><?= htmlspecialchars($doc['name']) ?></span>
                            </div>
                        </td>
                        <td><span class="badge badge-gold"><?= htmlspecialchars($doc['category']) ?></span></td>
                        <td><?= htmlspecialchars($doc['size']) ?></td>
                        <td><?= htmlspecialchars($doc['date']) ?></td>
                        <td>
                            <div class="table-actions">
                                <button class="btn btn-ghost btn-sm" title="Télécharger">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                        <polyline points="7 10 12 15 17 10"/>
                                        <line x1="12" y1="15" x2="12" y2="3"/>
                                    </svg>
                                </button>
                                <button class="btn btn-ghost btn-sm" title="Partager">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <circle cx="18" cy="5" r="3"/>
                                        <circle cx="6" cy="12" r="3"/>
                                        <circle cx="18" cy="19" r="3"/>
                                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                                    </svg>
                                </button>
                                <button class="btn btn-ghost btn-sm text-danger" title="Supprimer">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div><!-- End page-content -->

<script src="../js/lawyer.js"></script>

</body>
</html>