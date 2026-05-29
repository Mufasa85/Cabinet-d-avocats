<?php

if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$pageTitle = 'Tableau de bord';
$currentPage = 'dashboard';

// Récupérer les données du lawyer depuis la session ou l'avatar
$lawyerName = $avocat['fullname'] ?? $_SESSION['lawyer_name'] ?? $_SESSION['user_name'] ?? 'Me. Laurent Mbako';

require dirname(__DIR__) . '/layouts/lawyer/header.php';
?>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-icon icon-gold">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                </svg>
            </div>
        </div>
        <div class="stat-card-content">
            <h3 data-counter="<?= $stats['publications'] ?? 0 ?>"><?= $stats['publications'] ?? 0 ?></h3>
            <p>Publications</p>
        </div>
        <div class="stat-card-bg"></div>
    </div>

    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-icon icon-info">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                </svg>
            </div>
        </div>
        <div class="stat-card-content">
            <h3 data-counter="<?= $stats['documents'] ?? 0 ?>"><?= $stats['documents'] ?? 0 ?></h3>
            <p>Documents</p>
        </div>
        <div class="stat-card-bg"></div>
    </div>

    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-icon icon-success">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                    <path d="M6 12v5c3 3 9 3 12 0v-5" />
                </svg>
            </div>
        </div>
        <div class="stat-card-content">
            <h3 data-counter="<?= $stats['trainings'] ?? 0 ?>"><?= $stats['trainings'] ?? 0 ?></h3>
            <p>Formations</p>
        </div>
        <div class="stat-card-bg"></div>
    </div>

    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-icon icon-warning">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                </svg>
            </div>
        </div>
        <div class="stat-card-content">
            <h3 data-counter="<?= $stats['activities'] ?? 0 ?>"><?= $stats['activities'] ?? 0 ?></h3>
            <p>Notifications</p>
        </div>
        <div class="stat-card-bg"></div>
    </div>
</div>

<!-- Content Grid -->
<div class="content-grid">

    <!-- Welcome Message -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                </svg>
                Bienvenue, <?= htmlspecialchars($lawyerName) ?>
            </h2>
        </div>
        <div class="card-body">
            <p class="text-muted">Bonjour Me. <?= htmlspecialchars(explode(' ', $lawyerName)[1] ?? 'Mbako') ?>, voici un aperçu de votre activité récente. Vous avez <strong class="text-gold"><?= $notifications ?? 0 ?> nouvelles notifications</strong> à consulter.</p>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                </svg>
                Activité récente
            </h2>
            <a href="<?= Router\Router::route('/lawyers/notifications') ?>" class="btn btn-sm btn-secondary">Voir tout</a>
        </div>
        <div class="card-body">
            <?php if (!empty($recentActivities)): ?>
                <div class="activity-list">
                    <?php foreach ($recentActivities as $activity): ?>
                        <div class="activity-item">
                            <div class="activity-icon icon-<?= $activity['type'] === 'publication' ? 'gold' : ($activity['type'] === 'document' ? 'info' : 'gold') ?>">
                                <?php if ($activity['type'] === 'publication'): ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <polyline points="14 2 14 8 20 8" />
                                    </svg>
                                <?php elseif ($activity['type'] === 'document'): ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <polyline points="14 2 14 8 20 8" />
                                        <line x1="12" y1="18" x2="12" y2="12" />
                                        <line x1="9" y1="15" x2="15" y2="15" />
                                    </svg>
                                <?php elseif ($activity['type'] === 'training'): ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                                        <path d="M6 12v5c3 3 9 3 12 0v-5" />
                                    </svg>
                                <?php else: ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <div class="activity-content">
                                <h4><?= htmlspecialchars($activity['titre'] ?? $activity['message'] ?? 'Activité') ?></h4>
                                <p><?= formatTimeAgo($activity['created_at'] ?? date('Y-m-d H:i:s')) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">Aucune activité récente.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<!-- Second Row -->
<div class="content-grid grid-2 mt-4">

    <!-- Recent Articles -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                </svg>
                Mes publications
            </h2>
            <a href="<?= Router\Router::route('/lawyers/articles') ?>" class="btn btn-sm btn-primary">Nouveau</a>
        </div>
        <div class="card-body">
            <?php if (!empty($recentArticles)): ?>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Catégorie</th>
                                <th>Date</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentArticles as $article): ?>
                                <tr>
                                    <td><?= htmlspecialchars($article['titre'] ?? 'Sans titre') ?></td>
                                    <td><?= htmlspecialchars($article['category_nom'] ?? '-') ?></td>
                                    <td><?= formatDate($article['updated_at'] ?? $article['created_at'] ?? date('Y-m-d')) ?></td>
                                    <td>
                                        <span class="badge <?= ($article['statut'] ?? '') === 'publie' ? 'badge-success' : 'badge-warning' ?>">
                                            <?= ($article['statut'] ?? 'brouillon') === 'publie' ? 'Publié' : 'Brouillon' ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">Aucune publication pour le moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Documents -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                </svg>
                Mes documents
            </h2>
            <a href="<?= Router\Router::route('/lawyers/documents') ?>" class="btn btn-sm btn-secondary">Voir tout</a>
        </div>
        <div class="card-body">
            <?php if (!empty($recentDocuments)): ?>
                <div class="activity-list">
                    <?php foreach ($recentDocuments as $doc): ?>
                        <div class="activity-item">
                            <div class="activity-icon icon-info">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                </svg>
                            </div>
                            <div class="activity-content">
                                <h4><?= htmlspecialchars($doc['nom'] ?? 'Document') ?></h4>
                                <p><?= strtoupper($doc['mime'] ?? 'PDF') ?> • <?= formatFileSize($doc['taille'] ?? 0) ?> • <?= formatDate($doc['created_at'] ?? date('Y-m-d')) ?></p>
                            </div>
                            <?php if (!empty($doc['fichier'])): ?>
                                <a href="<?= Router\Router::route('/resources/' . urlencode($doc['fichier'])) ?>" class="btn btn-ghost btn-sm" download>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                        <polyline points="7 10 12 15 17 10" />
                                        <line x1="12" y1="15" x2="12" y2="3" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">Aucun document pour le moment.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<!-- Third Row -->
<div class="content-grid mt-4">

    <!-- Trainings -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                    <path d="M6 12v5c3 3 9 3 12 0v-5" />
                </svg>
                Formations disponibles
            </h2>
            <a href="<?= Router\Router::route('/lawyers/trainings') ?>" class="btn btn-sm btn-secondary">Toutes les formations</a>
        </div>
        <div class="card-body">
            <?php if (!empty($availableTrainings)): ?>
                <div class="grid-3">
                    <?php foreach (array_slice($availableTrainings, 0, 3) as $training): ?>
                        <div class="card" style="background: rgba(255,255,255,0.02); border: 1px solid var(--glass-border);">
                            <div class="card-body">
                                <h4 class="font-display mb-2"><?= htmlspecialchars($training['titre'] ?? 'Formation') ?></h4>
                                <p class="text-muted text-sm mb-4"><?= $training['lieu'] ?? '' ?> • <?= $training['places_max'] - $training['places_reservees'] ?? 0 ?> places</p>
                                <a href="<?= Router\Router::route('/lawyers/trainings') ?>" class="btn btn-sm btn-primary w-full">Voir la formation</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">Aucune formation disponible.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

</div><!-- End page-content -->

<script src="../js/lawyer.js"></script>

</body>

</html>

<?php
// Functions helpers for the view
function formatTimeAgo(string $datetime): string
{
    $time = strtotime($datetime);
    $diff = time() - $time;

    if ($diff < 60) return 'À l\'instant';
    if ($diff < 3600) return 'Il y a ' . floor($diff / 60) . ' min';
    if ($diff < 86400) return 'Il y a ' . floor($diff / 3600) . 'h';
    if ($diff < 604800) return 'Il y a ' . floor($diff / 86400) . ' jours';

    return date('d M Y', $time);
}

function formatDate(string $date): string
{
    return date('d M Y', strtotime($date));
}

function formatFileSize(int $bytes): string
{
    if ($bytes >= 1048576) return number_format($bytes / 1048576, 1) . ' MB';
    if ($bytes >= 1024) return number_format($bytes / 1024, 1) . ' KB';
    return $bytes . ' B';
}
?>