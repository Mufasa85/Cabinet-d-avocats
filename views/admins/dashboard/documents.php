<?php
$pageTitle = 'Documents';
$documents = [
    ['id' => 1, 'name' => 'Contrat_SolarCorp.pdf', 'type' => 'PDF', 'size' => '2.4 MB', 'date' => '15 Mai 2026', 'category' => 'Contrats'],
    ['id' => 2, 'name' => 'Plaidoirie_DroitTravail.pdf', 'type' => 'PDF', 'size' => '1.8 MB', 'date' => '12 Mai 2026', 'category' => 'Plaidoiries'],
    ['id' => 3, 'name' => 'Note_Fiscale_2026.pdf', 'type' => 'PDF', 'size' => '890 KB', 'date' => '10 Mai 2026', 'category' => 'Notes'],
    ['id' => 4, 'name' => 'Accord_MiningCorp.pdf', 'type' => 'PDF', 'size' => '3.2 MB', 'date' => '08 Mai 2026', 'category' => 'Accords'],
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
<body x-data="{ sidebarOpen: false, modalOpen: false, activeModal: null }">
    <div class="admin-wrapper">
        <?php include __DIR__ . '/../views/layouts/sidebar-admin.php'; ?>
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
                <div class="filter-bar">
                    <div class="search-input"><i class="fas fa-search"></i><input type="text" placeholder="Rechercher..."></div>
                    <select class="filter-select"><option value="">Tous</option><option value="contrats">Contrats</option><option value="notes">Notes</option></select>
                </div>
                <div class="card">
                    <div class="card-body" style="padding: 0;">
                        <div class="table-container">
                            <table class="table">
                                <thead><tr><th>Fichier</th><th>Catégorie</th><th>Taille</th><th>Date</th><th>Actions</th></tr></thead>
                                <tbody>
                                    <?php foreach ($documents as $d): ?>
                                    <tr>
                                        <td><div class="flex items-center gap-md"><i class="fas fa-file-pdf" style="color: var(--danger); font-size: 1.5rem;"></i><span style="color: var(--white);"><?= htmlspecialchars($d['name']) ?></span></div></td>
                                        <td><span class="badge badge-gold"><?= $d['category'] ?></span></td>
                                        <td><?= $d['size'] ?></td>
                                        <td><?= $d['date'] ?></td>
                                        <td>
                                            <div class="flex gap-sm">
                                                <button class="btn btn-sm btn-ghost" @click="activeModal = 'preview'"><i class="fas fa-eye"></i></button>
                                                <button class="btn btn-sm btn-ghost"><i class="fas fa-download"></i></button>
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