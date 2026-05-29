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
    <link rel="stylesheet" href="../css/interns.css">
    <script src="../js/theme.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{ sidebarOpen: false }">
    <div class="admin-wrapper">
        <?php require dirname(__DIR__) . '/layouts/intern/sidebar.php'; ?>
        <main class="main-content">
            <header class="admin-header">
                <h1 class="header-title">Formations stagiaire</h1>
            </header>
            <div class="page-content">
                <?php if (!empty($_SESSION['success'])): ?><div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div><?php unset($_SESSION['success']);
                                                                                                                                            endif; ?>
                <?php if (!empty($_SESSION['error'])): ?><div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div><?php unset($_SESSION['error']);
                                                                                                                                        endif; ?>

                <div class="mb-4">
                    <h2 class="card-title">En cours</h2>
                    <div class="grid-2">
                        <?php if (empty($inscriptionsEnCours ?? [])): ?>
                            <div class="card">
                                <div class="card-body">
                                    <p style="color:var(--gray-500);">Aucune formation en cours.</p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php foreach (($inscriptionsEnCours ?? []) as $i): ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="flex justify-between items-center mb-sm">
                                        <span class="badge badge-warning">En cours</span>
                                        <span style="font-size:0.8125rem;color:var(--gray-500);">
                                            <?= $inscStatuts[$i['statut']] ?? htmlspecialchars($i['statut']) ?>
                                        </span>
                                    </div>
                                    <h4 style="color:var(--white);"><?= htmlspecialchars($i['formation_titre']) ?></h4>
                                    <p style="font-size:0.8125rem;color:var(--gray-500);">
                                        Début : <?= !empty($i['date_debut']) ? date('d/m/Y', strtotime($i['date_debut'])) : '—' ?>
                                        <?php if (!empty($i['lieu'])): ?> · Lieu : <?= htmlspecialchars($i['lieu']) ?><?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mb-4">
                    <h2 class="card-title">Formations disponibles</h2>
                    <div class="formation-cards-grid">
                        <?php if (empty($formationsDisponibles ?? [])): ?>
                            <div class="formation-empty">
                                <div class="formation-empty-icon"><i class="fas fa-calendar-alt"></i></div>
                                <p>Aucune formation disponible pour le moment.</p>
                                <span>Revenez bientôt pour voir de nouvelles formations.</span>
                            </div>
                        <?php else: ?>
                            <?php foreach (($formationsDisponibles ?? []) as $f): ?>
                                <div class="formation-card">
                                    <div class="formation-card-header">
                                        <div class="formation-icon">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                        <div class="formation-meta">
                                            <?php if (!empty($f['date_debut'])): ?>
                                                <span class="formation-date">
                                                    <i class="far fa-calendar"></i>
                                                    <?= date('d M Y', strtotime($f['date_debut'])) ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if (!empty($f['lieu'])): ?>
                                                <span class="formation-location">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <?= htmlspecialchars($f['lieu']) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="formation-card-body">
                                        <h3 class="formation-title"><?= htmlspecialchars($f['titre']) ?></h3>
                                        <p class="formation-description"><?= htmlspecialchars($f['description'] ?? 'Description non disponible.') ?></p>
                                    </div>
                                    <div class="formation-card-footer">
                                        <div class="formation-places">
                                            <div class="places-progress">
                                                <?php
                                                $total = (int) ($f['places_max'] ?? 1);
                                                $reserved = (int) ($f['places_reservees'] ?? 0);
                                                $available = max(0, $total - $reserved);
                                                $percent = $total > 0 ? (($reserved / $total) * 100) : 0;
                                                ?>
                                                <div class="places-bar" style="width: <?= min(100, $percent) ?>%"></div>
                                            </div>
                                            <span class="places-text">
                                                <strong><?= $available ?></strong> places restantes sur <?= $total ?>
                                            </span>
                                        </div>
                                        <form method="post" action="<?= Router\Router::route('/interns/trainings/inscrire') ?>">
                                            <?= $csrf ?? '' ?>
                                            <input type="hidden" name="formation_id" value="<?= (int) $f['id'] ?>">
                                            <button type="submit" class="btn btn-primary formation-btn">
                                                <i class="fas fa-user-plus"></i> S'inscrire
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h2 class="card-title">Historique de mes inscriptions</h2>
                    </div>
                    <div class="card-body" style="padding:0;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Formation</th>
                                    <th>Statut</th>
                                    <th>Date d'inscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (($inscriptions ?? []) as $i): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($i['formation_titre']) ?></td>
                                        <td><?= $inscStatuts[$i['statut']] ?? htmlspecialchars($i['statut']) ?></td>
                                        <td><?= date('d/m/Y', strtotime($i['created_at'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($inscriptions ?? [])): ?>
                                    <tr>
                                        <td colspan="3" style="color:var(--gray-500);">Aucune inscription.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>