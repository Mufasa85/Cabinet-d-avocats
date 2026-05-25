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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="{ sidebarOpen: false, modalOpen: false, activeModal: null }">
    <div class="admin-wrapper">
  <?php require dirname(__DIR__) . '/layouts/admin/sidebar.php'; ?>
        <main class="main-content">
            <header class="admin-header">
                <div class="header-left">
                    <button class="header-toggle" @click="document.dispatchEvent(new CustomEvent('sidebar:toggle'))"><i class="fas fa-bars"></i></button>
                    <div><h1 class="header-title"><?= $pageTitle ?></h1><nav class="header-breadcrumb"><a href="dashboard.php">Accueil</a><span>/</span><span><?= $pageTitle ?></span></nav></div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-primary" @click="activeModal = 'upload'; modalOpen = true"><i class="fas fa-upload"></i> Upload</button>
                </div>
            </header>
            <div class="page-content">
                <?php if (!empty($success)): ?><div class="alert alert-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
                <div class="card">
                    <div class="card-body" style="padding: 0;">
                        <div class="table-container">
                            <table class="table">
                                <thead><tr><th>Stagiaire</th><th>Titre</th><th>Type</th><th>Statut</th><th>Date</th><th>Actions</th></tr></thead>
                                <tbody>
                                    <?php foreach ($documents as $d): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($d['stagiaire_nom']) ?></td>
                                        <td><?= htmlspecialchars($d['titre']) ?></td>
                                        <td><?= htmlspecialchars($d['type']) ?></td>
                                        <td><span class="badge badge-<?= $d['statut'] === 'valide' ? 'success' : ($d['statut'] === 'rejete' ? 'danger' : 'warning') ?>"><?= $statutLabels[$d['statut']] ?? $d['statut'] ?></span></td>
                                        <td><?= date('d/m/Y', strtotime($d['created_at'])) ?></td>
                                        <td>
                                            <div class="flex gap-sm">
                                                <a href="<?= FileStorage::url($d['fichier']) ?>" class="btn btn-sm btn-ghost" target="_blank"><i class="fas fa-download"></i></a>
                                                <?php if ($d['statut'] === 'en_attente'): ?>
                                                <form method="post" action="<?= Router\Router::route('/admin/documents/' . (int)$d['id'] . '/valider') ?>"><?= Security::csrf_tokken() ?><input type="hidden" name="statut" value="valide"><button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i></button></form>
                                                <form method="post" action="<?= Router\Router::route('/admin/documents/' . (int)$d['id'] . '/valider') ?>" class="flex gap-sm"><?= Security::csrf_tokken() ?><input type="hidden" name="statut" value="rejete"><input type="text" name="motif" class="form-input" placeholder="Motif" style="max-width:120px;"><button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button></form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($documents)): ?>
                                    <tr><td colspan="6" style="text-align:center;color:var(--gray-500);">Aucun document</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="modal-overlay" :class="{ 'active': modalOpen }" @click="modalOpen = false"></div>

    <div class="modal" :class="{ 'active': activeModal === 'upload' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content"><div class="modal-icon"><i class="fas fa-cloud-upload-alt"></i></div><div><h3 class="modal-title">Upload Document</h3><p class="modal-subtitle">Télécharger un nouveau fichier</p></div></div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="file-upload">
                <div class="file-upload-icon"><i class="fas fa-file-pdf"></i></div>
                <h4>Glissez-déposez ou cliquez pour uploader</h4>
                <p>PDF, DOC, DOCX jusqu'à 10MB</p>
            </div>
            <div class="form-group" style="margin-top: 1.5rem;"><label class="form-label">Catégorie</label><select class="form-select"><option>Contrats</option><option>Notes</option><option>Plaidoiries</option></select></div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false">Annuler</button>
            <button class="btn btn-primary"><i class="fas fa-upload"></i> Upload</button>
        </div>
    </div>

    <div class="modal confirm-modal" :class="{ 'active': activeModal === 'delete' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content"><div class="modal-icon"><i class="fas fa-exclamation-triangle"></i></div><div><h3 class="modal-title">Supprimer</h3><p class="modal-subtitle">Action irréversible</p></div></div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body"><p>Êtes-vous sûr de vouloir supprimer ce document ?</p></div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false">Annuler</button>
            <button class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
        </div>
    </div>
</body>
</html>