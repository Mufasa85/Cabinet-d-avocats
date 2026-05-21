<?php
/**
 * ELMD - Cabinet d'Avocats
 * Lawyer Trainings Page
 */

session_start();

if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$pageTitle = 'Formations';
$currentPage = 'trainings';

$lawyerName = $_SESSION['lawyer_name'] ?? 'Me. Laurent Mbako';
$lawyerAvatar = $_SESSION['lawyer_avatar'] ?? 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=100&q=80';

// Formations
$trainings = [
    ['id' => 1, 'title' => 'Droit minier avancé', 'description' => 'Maîtrisez les subtilités du droit minier en RDC, des contrats aux litiges.', 'duration' => '12 heures', 'progress' => 75, 'lessons' => 8, 'completed' => 6, 'status' => 'in_progress'],
    ['id' => 2, 'title' => 'Procédures OHADA', 'description' => 'Comprendre et appliquer les procédures OHADA dans votre pratique quotidienne.', 'duration' => '8 heures', 'progress' => 30, 'lessons' => 6, 'completed' => 2, 'status' => 'in_progress'],
    ['id' => 3, 'title' => 'Négociation internationale', 'description' => 'Développez vos compétences en négociation pour des transactions internationales.', 'duration' => '16 heures', 'progress' => 0, 'lessons' => 10, 'completed' => 0, 'status' => 'available'],
    ['id' => 4, 'title' => 'Fiscalité des entreprises', 'description' => 'Les bases de la fiscalité des entreprises en République Démocratique du Congo.', 'duration' => '10 heures', 'progress' => 100, 'lessons' => 7, 'completed' => 7, 'status' => 'completed'],
    ['id' => 5, 'title' => 'Droit du travail approfondi', 'description' => 'Maîtrisez les aspects complexes du droit du travail congolais.', 'duration' => '14 heures', 'progress' => 100, 'lessons' => 9, 'completed' => 9, 'status' => 'completed'],
];

require_once __DIR__ . '/views/layouts/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div>
            <h1 class="page-title">Formations</h1>
            <p class="page-subtitle">Développez vos compétences juridiques</p>
        </div>
    </div>
</div>

<!-- Progress Overview -->
<div class="card mb-4">
    <div class="card-body">
        <div class="content-grid grid-4">
            <div class="text-center">
                <h3 class="font-display text-gold" style="font-size: 2rem;">2/5</h3>
                <p class="text-muted">Formations complétées</p>
            </div>
            <div class="text-center">
                <h3 class="font-display text-gold" style="font-size: 2rem;">50h</h3>
                <p class="text-muted">Heures de formation</p>
            </div>
            <div class="text-center">
                <h3 class="font-display text-gold" style="font-size: 2rem;">2</h3>
                <p class="text-muted">En cours</p>
            </div>
            <div class="text-center">
                <h3 class="font-display text-gold" style="font-size: 2rem;">3</h3>
                <p class="text-muted">Certificats obtenus</p>
            </div>
        </div>
    </div>
</div>

<!-- In Progress -->
<div class="mb-4">
    <h2 class="font-display mb-3">En cours</h2>
    <div class="content-grid grid-2">
        <?php foreach (array_filter($trainings, fn($t) => $t['status'] === 'in_progress') as $training): ?>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-3">
                    <span class="badge badge-warning">En cours</span>
                    <span class="text-sm text-muted"><?= $training['completed'] ?>/<?= $training['lessons'] ?> leçons</span>
                </div>
                <h3 class="font-display mb-2"><?= htmlspecialchars($training['title']) ?></h3>
                <p class="text-muted mb-3"><?= htmlspecialchars($training['description']) ?></p>
                <div class="mb-3">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm">Progression</span>
                        <span class="text-sm text-gold"><?= $training['progress'] ?>%</span>
                    </div>
                    <div style="height: 6px; background: rgba(255,255,255,0.1); border-radius: 3px;">
                        <div style="height: 100%; width: <?= $training['progress'] ?>%; background: var(--gold-gradient); border-radius: 3px;"></div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="btn btn-primary flex-1">Continuer</button>
                    <button class="btn btn-secondary">Vue d'ensemble</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Available & Completed -->
<div>
    <h2 class="font-display mb-3">Toutes les formations</h2>
    <div class="content-grid grid-3">
        <?php foreach ($trainings as $training): ?>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-3">
                    <span class="badge <?= $training['status'] === 'completed' ? 'badge-success' : 'badge-info' ?>">
                        <?= $training['status'] === 'completed' ? 'Complété' : 'Disponible' ?>
                    </span>
                    <span class="text-sm text-muted"><?= $training['duration'] ?></span>
                </div>
                <h4 class="font-display mb-2"><?= htmlspecialchars($training['title']) ?></h4>
                <p class="text-muted text-sm mb-3"><?= htmlspecialchars($training['description']) ?></p>
                <?php if ($training['status'] === 'completed'): ?>
                <div class="flex items-center gap-2 mb-3">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-success" width="20" height="20">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    <span class="text-sm text-success">Certificat obtenu</span>
                </div>
                <button class="btn btn-secondary w-full">Voir le certificat</button>
                <?php else: ?>
                <div class="flex gap-2">
                    <button class="btn btn-primary w-full">Commencer</button>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

</div><!-- End page-content -->

<script src="<?= ELMD_ROOT ?>/lawyer/js/lawyer.js"></script>

</body>
</html>