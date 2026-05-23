<?php
/**
 * ELMD - Cabinet d'Avocats
 * Lawyer Notifications Page
 */

if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$pageTitle = 'Notifications';
$currentPage = 'notifications';

$lawyerName = $_SESSION['lawyer_name'] ?? 'Me. Laurent Mbako';
$lawyerAvatar = $_SESSION['lawyer_avatar'] ?? 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=100&q=80';

// Notifications
$notifications = [
    ['id' => 1, 'type' => 'success', 'title' => 'Article publié avec succès', 'message' => 'Votre article "Les nouvelles réglementations OHADA" a été publié et est maintenant visible par tous les visiteurs.', 'time' => 'Il y a 2 heures', 'read' => false],
    ['id' => 2, 'type' => 'info', 'title' => 'Nouveau document partagé', 'message' => 'Me. Kabongo a partagé un nouveau document: Convention_minière.pdf', 'time' => 'Il y a 5 heures', 'read' => false],
    ['id' => 3, 'type' => 'warning', 'title' => 'Rappel de formation', 'message' => 'Votre formation "Droit minier avancé" reprend demain à 9h00.', 'time' => 'Hier', 'read' => false],
    ['id' => 4, 'type' => 'info', 'title' => 'Nouveau message client', 'message' => 'Vous avez reçu un nouveau message de M. Tshilobo concernant votre affaire en cours.', 'time' => 'Hier', 'read' => true],
    ['id' => 5, 'type' => 'success', 'title' => 'Formation terminée', 'message' => 'Félicitations ! Vous avez terminé la formation "Fiscalité des entreprises".', 'time' => 'Il y a 3 jours', 'read' => true],
    ['id' => 6, 'type' => 'warning', 'title' => 'Document à signer', 'message' => 'Un document en attente de signature: Contrat_de_prestation.pdf', 'time' => 'Il y a 4 jours', 'read' => true],
];

require dirname(__DIR__) . '/layouts/lawyer/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div>
            <h1 class="page-title">Notifications</h1>
            <p class="page-subtitle"><?= count(array_filter($notifications, fn($n) => !$n['read'])) ?> non lues</p>
        </div>
        <div class="page-actions">
            <button class="btn btn-secondary" id="mark-all-read">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                    <polyline points="9 11 12 14 22 4"/>
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                </svg>
                Tout marquer comme lu
            </button>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="flex gap-2 mb-4">
    <button class="btn btn-primary">Toutes</button>
    <button class="btn btn-secondary">Non lues</button>
    <button class="btn btn-secondary">Messages</button>
    <button class="btn btn-secondary">Alertes</button>
</div>

<!-- Notifications List -->
<div class="card">
    <div class="card-body">
        <div class="activity-list">
            <?php foreach ($notifications as $notif): ?>
            <div class="notification-item <?= !$notif['read'] ? 'unread' : '' ?>">
                <div class="notification-icon notif-<?= $notif['type'] ?>">
                    <?php if ($notif['type'] === 'success'): ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    <?php elseif ($notif['type'] === 'warning'): ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    <?php else: ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="16" x2="12" y2="12"/>
                        <line x1="12" y1="8" x2="12.01" y2="8"/>
                    </svg>
                    <?php endif; ?>
                </div>
                <div class="notification-content">
                    <h4><?= htmlspecialchars($notif['title']) ?></h4>
                    <p><?= htmlspecialchars($notif['message']) ?></p>
                    <span class="notification-time"><?= htmlspecialchars($notif['time']) ?></span>
                </div>
                <div class="table-actions">
                    <?php if (!$notif['read']): ?>
                    <button class="btn btn-ghost btn-sm" title="Marquer comme lu">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                            <polyline points="9 11 12 14 22 4"/>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                        </svg>
                    </button>
                    <?php endif; ?>
                    <button class="btn btn-ghost btn-sm" title="Supprimer">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Load More -->
<div class="text-center mt-4">
    <button class="btn btn-secondary">Charger plus</button>
</div>

</div><!-- End page-content -->

<script src="<?= ELMD_ROOT ?>/lawyer/js/lawyer.js"></script>

</body>
</html>