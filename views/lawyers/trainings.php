<?php
if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$pageTitle = 'Formations';
$currentPage = 'trainings';
$inscStatuts = ['en_attente' => 'En attente', 'acceptee' => 'Acceptée', 'refusee' => 'Refusée', 'annulee' => 'Annulée'];

require dirname(__DIR__) . '/layouts/lawyer/header.php';
?>

<div class="page-header">
    <div class="page-header-content">
        <div>
            <h1 class="page-title">Formations Professionnelles</h1>
            <p class="page-subtitle">Développez vos compétences et restez à jour avec nos formations spécialisées.</p>
        </div>
    </div>
</div>

<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
<?php unset($_SESSION['success']);
endif; ?>
<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
<?php unset($_SESSION['error']);
endif; ?>

<!-- Enrolled Trainings -->
<?php if (!empty($inscriptionsEnCours)): ?>
    <div class="mb-4">
        <h2 class="card-title">
            <i class="fas fa-spinner fa-spin"></i>
            Mes formations en cours
        </h2>
        <div class="grid-2">
            <?php foreach ($inscriptionsEnCours as $i): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="flex justify-between items-center mb-sm">
                            <span class="badge badge-warning">En cours</span>
                            <span class="badge <?= $i['statut'] === 'acceptee' ? 'badge-success' : 'badge-secondary' ?>">
                                <?= $inscStatuts[$i['statut']] ?? htmlspecialchars($i['statut']) ?>
                            </span>
                        </div>
                        <h4 style="color:var(--white);"><?= htmlspecialchars($i['formation_titre']) ?></h4>
                        <p style="font-size:0.8125rem;color:var(--gray-500);">
                            Début : <?= !empty($i['date_debut']) ? date('d/m/Y', strtotime($i['date_debut'])) : '—' ?>
                            <?php if (!empty($i['lieu'])): ?> · Lieu : <?= htmlspecialchars($i['lieu']) ?><?php endif; ?>
                        </p>
                        <button class="btn btn-secondary btn-sm mt-2">
                            <i class="fas fa-play"></i> Continuer
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Available Trainings -->
<div class="mb-4">
    <h2 class="card-title">
        <i class="fas fa-book-open"></i>
        Formations disponibles
    </h2>
    <?php if (empty($formationsDisponibles ?? [])): ?>
        <div class="card">
            <div class="card-body">
                <p style="color:var(--gray-500);">Aucune formation disponible pour le moment.</p>
            </div>
        </div>
    <?php else: ?>
        <div class="grid-2">
            <?php foreach ($formationsDisponibles as $f): ?>
                <div class="card">
                    <div class="card-body">
                        <div class="flex justify-between items-center mb-sm">
                            <span class="badge badge-info">À venir</span>
                            <span style="font-size:0.75rem;color:var(--gray-500);">
                                <i class="fas fa-users"></i>
                                <?= (int) $f['places_reservees'] ?>/<?= (int) $f['places_max'] ?>
                            </span>
                        </div>
                        <h4 style="color:var(--white);"><?= htmlspecialchars($f['titre']) ?></h4>
                        <p style="color:var(--gray-400);font-size:0.875rem;margin-bottom:1rem;">
                            <?= htmlspecialchars($f['description'] ?? '') ?>
                        </p>
                        <p style="font-size:0.8125rem;color:var(--gray-500);">
                            <?= !empty($f['date_debut']) ? date('d/m/Y', strtotime($f['date_debut'])) : '—' ?>
                            <?php if (!empty($f['lieu'])): ?> · <?= htmlspecialchars($f['lieu']) ?><?php endif; ?>
                                <?php if (!empty($f['duree'])): ?> · <?= htmlspecialchars($f['duree']) ?><?php endif; ?>
                        </p>
                        <form method="post" action="<?= Router\Router::route('/lawyers/trainings/inscrire') ?>" class="mt-2">
                            <?= $csrf ?? '' ?>
                            <input type="hidden" name="formation_id" value="<?= (int) $f['id'] ?>">
                            <button type="submit" class="btn btn-primary btn-sm" style="width:100%;">
                                <i class="fas fa-plus"></i> S'inscrire
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- History -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">
            <i class="fas fa-history"></i>
            Historique de mes inscriptions
        </h2>
    </div>
    <div class="card-body" style="padding:0;">
        <table class="table">
            <thead>
                <tr>
                    <th>Formation</th>
                    <th>Statut</th>
                    <th>Date d'inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($inscriptions ?? []) as $i): ?>
                    <?php
                    $statusClass = match ($i['statut']) {
                        'acceptee' => 'badge-success',
                        'refusee' => 'badge-danger',
                        'annulee' => 'badge-secondary',
                        default => 'badge-warning'
                    };
                    ?>
                    <tr>
                        <td style="font-weight:500;"><?= htmlspecialchars($i['formation_titre']) ?></td>
                        <td><span class="badge <?= $statusClass ?>"><?= $inscStatuts[$i['statut']] ?? htmlspecialchars($i['statut']) ?></span></td>
                        <td><?= date('d/m/Y', strtotime($i['created_at'])) ?></td>
                        <td>
                            <button class="btn btn-secondary btn-sm">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($inscriptions ?? [])): ?>
                    <tr>
                        <td colspan="4" style="color:var(--gray-500);">Aucune inscription.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
<script src="../js/lawyer.js"></script>
</body>

</html>