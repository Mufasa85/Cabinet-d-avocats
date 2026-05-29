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

// Récupérer le nom et avatar depuis les données du controller
$lawyerName = $avocat['fullname'] ?? $_SESSION['lawyer_name'] ?? $_SESSION['user_name'] ?? 'Avocat';
$defaultAvatar = 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=100&q=80';
$lawyerAvatar = $avocat['avatar_url'] ?? (!empty($avocat['avatar']) ? \Service\FileStorage::url($avocat['avatar']) : $defaultAvatar);

// Compter les non lues
$unreadCount = is_array($notifications) ? count(array_filter($notifications, fn($n) => !($n['est_lu'] ?? false))) : 0;

require dirname(__DIR__) . '/layouts/lawyer/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div>
            <h1 class="page-title">Notifications</h1>
            <p class="page-subtitle"><?= $unreadCount ?> non lues</p>
        </div>
        <div class="page-actions">
            <?php if ($unreadCount > 0): ?>
                <form method="POST" action="<?= \Router\Router::route('/lawyers/notifications/read-all') ?>" style="display:inline;">
                    <?= \Core\Security::csrf_tokken() ?>
                    <button type="submit" class="btn btn-secondary">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                            <polyline points="9 11 12 14 22 4" />
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                        </svg>
                        Tout marquer comme lu
                    </button>
                </form>
            <?php endif; ?>
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
        <?php if (!empty($notifications)): ?>
            <div class="activity-list">
                <?php foreach ($notifications as $notif): ?>
                    <?php $isUnread = !($notif['est_lu'] ?? false); ?>
                    <div class="notification-item <?= $isUnread ? 'unread' : '' ?>">
                        <div class="notification-icon notif-<?= getNotifType($notif['type'] ?? 'info') ?>">
                            <?php
                            $type = $notif['type'] ?? 'info';
                            if ($type === 'success' || $type === 'publication'): ?>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            <?php elseif ($type === 'warning' || $type === 'alert'): ?>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                                    <line x1="12" y1="9" x2="12" y2="13" />
                                    <line x1="12" y1="17" x2="12.01" y2="17" />
                                </svg>
                            <?php else: ?>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                                </svg>
                            <?php endif; ?>
                        </div>
                        <div class="notification-content">
                            <h4><?= htmlspecialchars($notif['titre'] ?? 'Notification') ?></h4>
                            <p><?= htmlspecialchars($notif['message'] ?? '') ?></p>
                            <span class="notification-time"><?= timeAgo($notif['created_at'] ?? date('Y-m-d H:i:s')) ?></span>
                        </div>
                        <div class="table-actions">
                            <?php if ($isUnread): ?>
                                <form method="POST" action="<?= \Router\Router::route('/lawyers/notifications/read/' . ($notif['id'] ?? 0)) ?>" style="display:inline;">
                                    <?= \Core\Security::csrf_tokken() ?>
                                    <button type="submit" class="btn btn-ghost btn-sm" title="Marquer comme lu">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                            <polyline points="9 11 12 14 22 4" />
                                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                                        </svg>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted text-center py-8">Aucune notification pour le moment.</p>
        <?php endif; ?>
    </div>
</div>

</div><!-- End page-content -->

<script src="../js/lawyer.js"></script>

</body>

</html>

<?php
// Helper function
function getNotifType(string $type): string
{
    $map = [
        'publication' => 'success',
        'document' => 'info',
        'training' => 'info',
        'alert' => 'warning',
        'success' => 'success',
        'info' => 'info',
        'warning' => 'warning',
    ];
    return $map[$type] ?? 'info';
}

function timeAgo(string $datetime): string
{
    $time = strtotime($datetime);
    $diff = time() - $time;

    if ($diff < 60) return 'À l\'instant';
    if ($diff < 3600) return 'Il y a ' . floor($diff / 60) . ' min';
    if ($diff < 86400) return 'Il y a ' . floor($diff / 3600) . 'h';
    if ($diff < 604800) return 'Il y a ' . floor($diff / 86400) . ' jours';

    return date('d M Y', $time);
}
?>