<?php
$pageTitle = 'Mes documents';
$statutLabels = ['en_attente' => 'En attente', 'valide' => 'Validé', 'rejete' => 'Refusé'];
use Service\FileStorage;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> | Cabinet ELMD</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dash_admin.css">
</head>
<body>
<div class="admin-wrapper">
    <?php require dirname(__DIR__) . '/layouts/intern/sidebar.php'; ?>
    <main class="main-content">
        <header class="admin-header"><h1 class="header-title"><?= htmlspecialchars($pageTitle) ?></h1></header>
        <div class="page-content">
            <?php if (!empty($_SESSION['success'])): ?><div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div><?php unset($_SESSION['success']); endif; ?>
            <?php if (!empty($_SESSION['error'])): ?><div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div><?php unset($_SESSION['error']); endif; ?>

            <div class="card mb-4">
                <div class="card-header"><h2 class="card-title">Envoyer un document</h2></div>
                <div class="card-body">
                    <form method="post" action="<?= Router\Router::route('/interns/documents') ?>" enctype="multipart/form-data">
                        <?= $csrf ?? '' ?>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Titre</label>
                                <input type="text" name="titre" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-select">
                                    <option value="convention">Convention</option>
                                    <option value="rapport">Rapport</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Fichier PDF (max 5 Mo)</label>
                            <input type="file" name="fichier" accept=".pdf,application/pdf" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Envoyer</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h2 class="card-title">Historique</h2></div>
                <div class="card-body" style="padding:0;">
                    <table class="table">
                        <thead><tr><th>Titre</th><th>Type</th><th>Statut</th><th>Motif</th><th>Fichier</th><th>Date</th></tr></thead>
                        <tbody>
                        <?php foreach ($documents ?? [] as $doc): ?>
                            <tr>
                                <td><?= htmlspecialchars($doc['titre']) ?></td>
                                <td><?= htmlspecialchars($doc['type']) ?></td>
                                <td><span class="badge badge-<?= $doc['statut'] === 'valide' ? 'success' : ($doc['statut'] === 'rejete' ? 'danger' : 'warning') ?>"><?= $statutLabels[$doc['statut']] ?? $doc['statut'] ?></span></td>
                                <td><?= htmlspecialchars($doc['motif_rejet'] ?? '—') ?></td>
                                <td><a href="<?= FileStorage::url($doc['fichier']) ?>" target="_blank" class="btn btn-sm btn-ghost"><i class="fas fa-download"></i></a></td>
                                <td><?= date('d/m/Y H:i', strtotime($doc['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
