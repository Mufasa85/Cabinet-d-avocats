<?php
$pageTitle = 'Formations';
$inscStatuts = ['en_attente' => 'En attente', 'acceptee' => 'Acceptée', 'refusee' => 'Refusée', 'annulee' => 'Annulée'];
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
        <header class="admin-header"><h1 class="header-title">Formations disponibles</h1></header>
        <div class="page-content">
            <?php if (!empty($_SESSION['success'])): ?><div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div><?php unset($_SESSION['success']); endif; ?>
            <?php if (!empty($_SESSION['error'])): ?><div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div><?php unset($_SESSION['error']); endif; ?>

            <div class="grid-2">
                <?php foreach ($formations ?? [] as $f): ?>
                <div class="card">
                    <div class="card-body">
                        <h4 style="color:var(--white);"><?= htmlspecialchars($f['titre']) ?></h4>
                        <p style="color:var(--gray-400);font-size:0.875rem;"><?= htmlspecialchars($f['description'] ?? '') ?></p>
                        <p style="font-size:0.8125rem;color:var(--gray-500);">
                            <?= $f['date_debut'] ? date('d/m/Y', strtotime($f['date_debut'])) : '—' ?>
                            · Places : <?= (int)$f['places_reservees'] ?>/<?= (int)$f['places_max'] ?>
                        </p>
                        <form method="post" action="<?= Router\Router::route('/interns/trainings/inscrire') ?>" class="mt-2">
                            <?= $csrf ?? '' ?>
                            <input type="hidden" name="formation_id" value="<?= (int)$f['id'] ?>">
                            <button type="submit" class="btn btn-primary btn-sm" <?= (int)$f['places_reservees'] >= (int)$f['places_max'] ? 'disabled' : '' ?>>S'inscrire</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="card mt-4">
                <div class="card-header"><h2 class="card-title">Mes inscriptions</h2></div>
                <div class="card-body" style="padding:0;">
                    <table class="table">
                        <thead><tr><th>Formation</th><th>Statut</th><th>Date</th></tr></thead>
                        <tbody>
                        <?php foreach ($inscriptions ?? [] as $i): ?>
                            <tr>
                                <td><?= htmlspecialchars($i['formation_titre']) ?></td>
                                <td><?= $inscStatuts[$i['statut']] ?? $i['statut'] ?></td>
                                <td><?= date('d/m/Y', strtotime($i['created_at'])) ?></td>
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
