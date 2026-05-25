<?php
/**
 * ELMD - Cabinet d'Avocats
 * Lawyer Dashboard
 */



if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$pageTitle = 'Tableau de bord';
$currentPage = 'dashboard';

// Données simulées (à remplacer par des données de la base de données)
$lawyerName = $_SESSION['lawyer_name'] ?? $_SESSION['user_name'] ?? 'Me. Laurent Mbako';
$lawyerAvatar = $_SESSION['lawyer_avatar'] ?? 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=100&q=80';

// Statistiques
$stats = [
    'publications' => 12,
    'documents' => 48,
    'trainings' => 5,
    'activities' => 23
];

// Activités récentes
$recentActivities = [
    ['type' => 'publication', 'title' => 'Article publié: "Les nouvelles réglementations OHADA"', 'time' => 'Il y a 2 heures'],
    ['type' => 'document', 'title' => 'Document uploadé: Contrat_de_travail.pdf', 'time' => 'Il y a 5 heures'],
    ['type' => 'training', 'title' => 'Formation complétée: Droit minier avancé', 'time' => 'Hier'],
    ['type' => 'notification', 'title' => 'Nouveau message du client Kabongo', 'time' => 'Hier'],
    ['type' => 'publication', 'title' => 'Article modifié: "Procédures fiscales"', 'time' => 'Il y a 2 jours']
];

// Publications récentes
$recentArticles = [
    ['title' => 'Les nouvelles réglementations OHADA', 'category' => 'Droit des Affaires', 'date' => '15 Jan 2024', 'status' => 'published'],
    ['title' => 'Procédures fiscales en RDC', 'category' => 'Droit Fiscal', 'date' => '10 Jan 2024', 'status' => 'published'],
    ['title' => 'Guide du droit du travail', 'category' => 'Droit du Travail', 'date' => '5 Jan 2024', 'status' => 'draft']
];

// Documents récents
$recentDocuments = [
    ['name' => 'Contrat_de_travail.pdf', 'type' => 'PDF', 'size' => '2.4 MB', 'date' => '15 Jan 2024'],
    ['name' => 'Mémoire_préparatoire.pdf', 'type' => 'PDF', 'size' => '5.1 MB', 'date' => '12 Jan 2024'],
    ['name' => 'Convention_minière.pdf', 'type' => 'PDF', 'size' => '3.8 MB', 'date' => '8 Jan 2024']
];

// Formations disponibles
$availableTrainings = [
    ['title' => 'Droit minier avancé', 'duration' => '12 heures', 'progress' => 75],
    ['title' => 'Procédures OHADA', 'duration' => '8 heures', 'progress' => 30],
    ['title' => 'Négociation internationale', 'duration' => '16 heures', 'progress' => 0]
];

require dirname(__DIR__) . '/layouts/lawyer/header.php';
?>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-icon icon-gold">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
            </div>
            <div class="stat-card-trend up">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                    <polyline points="17 6 23 6 23 12"/>
                </svg>
                +2
            </div>
        </div>
        <div class="stat-card-content">
            <h3 data-counter="<?= $stats['publications'] ?>"><?= $stats['publications'] ?></h3>
            <p>Publications</p>
        </div>
        <div class="stat-card-bg"></div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-icon icon-info">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                </svg>
            </div>
            <div class="stat-card-trend up">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                    <polyline points="17 6 23 6 23 12"/>
                </svg>
                +5
            </div>
        </div>
        <div class="stat-card-content">
            <h3 data-counter="<?= $stats['documents'] ?>"><?= $stats['documents'] ?></h3>
            <p>Documents</p>
        </div>
        <div class="stat-card-bg"></div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-icon icon-success">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                </svg>
            </div>
            <div class="stat-card-trend up">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                    <polyline points="17 6 23 6 23 12"/>
                </svg>
                +1
            </div>
        </div>
        <div class="stat-card-content">
            <h3 data-counter="<?= $stats['trainings'] ?>"><?= $stats['trainings'] ?></h3>
            <p>Formations</p>
        </div>
        <div class="stat-card-bg"></div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-icon icon-warning">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <div class="stat-card-trend up">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                    <polyline points="17 6 23 6 23 12"/>
                </svg>
                +8
            </div>
        </div>
        <div class="stat-card-content">
            <h3 data-counter="<?= $stats['activities'] ?>"><?= $stats['activities'] ?></h3>
            <p>Activités</p>
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
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                </svg>
                Bienvenue, <?= htmlspecialchars($lawyerName) ?>
            </h2>
        </div>
        <div class="card-body">
            <p class="text-muted">Bonjour Me. <?= htmlspecialchars(explode(' ', $lawyerName)[1] ?? 'Mbako') ?>, voici un aperçu de votre activité récente. Vous avez <strong class="text-gold">3 nouvelles notifications</strong> à consulter.</p>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
                Activité récente
            </h2>
            <a href="notifications.php" class="btn btn-sm btn-secondary">Voir tout</a>
        </div>
        <div class="card-body">
            <div class="activity-list">
                <?php foreach ($recentActivities as $activity): ?>
                <div class="activity-item">
                    <div class="activity-icon icon-<?= $activity['type'] === 'publication' ? 'gold' : ($activity['type'] === 'document' ? 'info' : 'gold') ?>">
                        <?php if ($activity['type'] === 'publication'): ?>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                        </svg>
                        <?php elseif ($activity['type'] === 'document'): ?>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="12" y1="18" x2="12" y2="12"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                        </svg>
                        <?php elseif ($activity['type'] === 'training'): ?>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                        </svg>
                        <?php else: ?>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>
                        <?php endif; ?>
                    </div>
                    <div class="activity-content">
                        <h4><?= htmlspecialchars($activity['title']) ?></h4>
                        <p><?= htmlspecialchars($activity['time']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
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
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
                Mes publications
            </h2>
            <a href="articles.php" class="btn btn-sm btn-primary">Nouveau</a>
        </div>
        <div class="card-body">
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
                            <td><?= htmlspecialchars($article['title']) ?></td>
                            <td><?= htmlspecialchars($article['category']) ?></td>
                            <td><?= htmlspecialchars($article['date']) ?></td>
                            <td>
                                <span class="badge <?= $article['status'] === 'published' ? 'badge-success' : 'badge-warning' ?>">
                                    <?= $article['status'] === 'published' ? 'Publié' : 'Brouillon' ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Recent Documents -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                </svg>
                Mes documents
            </h2>
            <a href="documents.php" class="btn btn-sm btn-secondary">Voir tout</a>
        </div>
        <div class="card-body">
            <div class="activity-list">
                <?php foreach ($recentDocuments as $doc): ?>
                <div class="activity-item">
                    <div class="activity-icon icon-info">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                        </svg>
                    </div>
                    <div class="activity-content">
                        <h4><?= htmlspecialchars($doc['name']) ?></h4>
                        <p><?= $doc['type'] ?> • <?= $doc['size'] ?> • <?= $doc['date'] ?></p>
                    </div>
                    <button class="btn btn-ghost btn-sm">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
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
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                </svg>
                Formations disponibles
            </h2>
            <a href="trainings.php" class="btn btn-sm btn-secondary">Toutes les formations</a>
        </div>
        <div class="card-body">
            <div class="grid-3">
                <?php foreach ($availableTrainings as $training): ?>
                <div class="card" style="background: rgba(255,255,255,0.02); border: 1px solid var(--glass-border);">
                    <div class="card-body">
                        <h4 class="font-display mb-2"><?= htmlspecialchars($training['title']) ?></h4>
                        <p class="text-muted text-sm mb-3"><?= $training['duration'] ?></p>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-muted">Progression</span>
                            <span class="text-sm text-gold"><?= $training['progress'] ?>%</span>
                        </div>
                        <div style="height: 4px; background: rgba(255,255,255,0.1); border-radius: 2px;">
                            <div style="height: 100%; width: <?= $training['progress'] ?>%; background: var(--gold-gradient); border-radius: 2px;"></div>
                        </div>
                        <?php if ($training['progress'] === 0): ?>
                        <button class="btn btn-sm btn-primary w-full mt-3">Commencer</button>
                        <?php elseif ($training['progress'] < 100): ?>
                        <button class="btn btn-sm btn-secondary w-full mt-3">Continuer</button>
                        <?php else: ?>
                        <button class="btn btn-sm btn-success w-full mt-3">Certificat</button>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
</div>

<!-- Quick Actions Modal -->
<div class="modal-overlay" id="stats-modal"></div>
<div class="modal" id="stats-modal-content">
    <div class="modal-header">
        <div class="modal-header-content">
            <div class="modal-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"/>
                    <rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/>
                </svg>
            </div>
            <div>
                <h3 class="modal-title">Statistiques détaillées</h3>
                <p class="modal-subtitle">Aperçu complet de votre activité</p>
            </div>
        </div>
        <button class="modal-close">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>
    <div class="modal-body">
        <p class="text-muted">Contenu du modal de statistiques...</p>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" data-modal-close>Fermer</button>
        <button class="btn btn-primary">Voir plus</button>
    </div>
</div>

</div><!-- End page-content -->

<script src="../js/lawyer.js"></script>

</body>
</html>