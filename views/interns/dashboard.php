<?php
$pageTitle = 'Espace Stagiaire';
$statutLabels = ['en_attente' => 'En attente', 'valide' => 'Validé', 'rejete' => 'Refusé'];
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
    <link rel="stylesheet" href="../css/interns.css">
    <script src="../js/theme.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{ sidebarOpen: false }">
    <div class="admin-wrapper">
        <?php require dirname(__DIR__) . '/layouts/intern/sidebar.php'; ?>
        <main class="main-content">
            <header class="admin-header">
                <h1 class="header-title">Bonjour, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Stagiaire') ?></h1>
            </header>
            <div class="page-content">
                <div class="stats-grid">
                    <div class="stat-card">
                        <span class="stat-card-label">Documents</span>
                        <span class="stat-card-value"><?= count($documents ?? []) ?></span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-card-label">Notifications</span>
                        <span class="stat-card-value"><?= (int) ($notifications ?? 0) ?></span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Mes documents récents</h2>
                    </div>
                    <div class="card-body">
                        <?php if (empty($documents)): ?>
                            <p style="color: var(--gray-400);">Aucun document. <a href="<?= Router\Router::route('/interns/documents') ?>">Envoyer un document</a></p>
                        <?php else: ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Type</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_slice($documents, 0, 5) as $doc): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($doc['titre']) ?></td>
                                            <td><?= htmlspecialchars($doc['type']) ?></td>
                                            <td><span class="badge badge-<?= $doc['statut'] === 'valide' ? 'success' : ($doc['statut'] === 'rejete' ? 'danger' : 'warning') ?>"><?= $statutLabels[$doc['statut']] ?? $doc['statut'] ?></span></td>
                                            <td><?= date('d/m/Y', strtotime($doc['created_at'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>