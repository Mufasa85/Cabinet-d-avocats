<?php

$pageTitle = 'Notifications';
$notifications = $notifications ?? [];
$unread = $unread ?? 0;

use Core\Security;

// Fonction simple pour formater le temps relatif
function timeAgo(string $datetime): string
{
    $timestamp = strtotime($datetime);
    $diff = time() - $timestamp;

    if ($diff < 60) return 'À l\'instant';
    if ($diff < 3600) return 'Il y a ' . floor($diff / 60) . ' min';
    if ($diff < 86400) return 'Il y a ' . floor($diff / 3600) . 'h';
    if ($diff < 604800) return 'Il y a ' . floor($diff / 86400) . ' jours';
    return date('d M Y', $timestamp);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> | Cabinet d'Avocats</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dash_admin.css">
    <script src="../js/theme.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{ sidebarOpen: false, modalOpen: false, activeModal: null, selectedNotif: null, notifications: <?= htmlspecialchars(json_encode(array_map(function ($n) {
                                                                                                                    $typeIcons = ['info' => 'info-circle', 'candidature' => 'user-plus', 'document' => 'file-alt', 'formation' => 'graduation-cap', 'message' => 'envelope', 'alert' => 'exclamation-triangle'];
                                                                                                                    $typeColors = ['info' => 'gold', 'candidature' => 'success', 'document' => 'info', 'formation' => 'warning', 'message' => 'info', 'alert' => 'danger'];
                                                                                                                    return [
                                                                                                                        'id' => $n['id'],
                                                                                                                        'title' => $n['titre'],
                                                                                                                        'message' => $n['message'],
                                                                                                                        'time' => timeAgo($n['created_at'] ?? date('Y-m-d H:i:s')),
                                                                                                                        'read' => (bool)($n['est_lu'] ?? false),
                                                                                                                        'icon' => $typeIcons[$n['type']] ?? 'bell',
                                                                                                                        'color' => $typeColors[$n['type']] ?? 'gold',
                                                                                                                        'lien' => $n['lien'] ?? null,
                                                                                                                    ];
                                                                                                                }, $notifications))) ?>, unreadCount: <?= (int)$unread ?> }">
    <div class="admin-wrapper">
        <?php require dirname(__DIR__) . '/layouts/admin/sidebar.php'; ?>
        <main class="main-content">
            <header class="admin-header">
                <div class="header-left">
                    <button class="header-toggle" @click="document.dispatchEvent(new CustomEvent('sidebar:toggle'))"><i class="fas fa-bars"></i></button>
                    <div>
                        <h1 class="header-title"><?= $pageTitle ?></h1>
                        <nav class="header-breadcrumb"><a href="dashboard.php">Accueil</a><span>/</span><span><?= $pageTitle ?></span></nav>
                    </div>
                </div>
                <div class="header-actions">
                    <?php if ($unread > 0): ?>
                        <form method="POST" action="<?= Router\Router::route('/admin/notifications/read-all') ?>" style="display:inline;">
                            <?= Security::csrf_tokken() ?>
                            <button type="submit" class="btn btn-secondary"><i class="fas fa-check-double"></i> Tout marquer lu</button>
                        </form>
                    <?php endif; ?>
                </div>
            </header>
            <div class="page-content">
                <?php if (!empty($_SESSION['success'])): ?>
                    <div class="alert alert-success" style="margin-bottom: 1rem;"><?= htmlspecialchars($_SESSION['success']) ?></div>
                <?php unset($_SESSION['success']);
                endif; ?>

                <div class="card">
                    <div class="card-body" style="padding: 0;">
                        <div class="notification-list" x-show="notifications.length > 0">
                            <template x-for="notif in notifications" :key="notif.id">
                                <div class="notification-item" :class="{ 'unread': !notif.read }">
                                    <div class="notification-icon" :class="'notification-' + notif.color"><i class="fas fa-" x-text="notif.icon"></i></div>
                                    <div class="notification-content">
                                        <h4 x-text="notif.title"></h4>
                                        <p x-text="notif.message"></p>
                                        <span class="notification-time" x-text="notif.time"></span>
                                    </div>
                                    <div class="notification-actions">
                                        <template x-if="!notif.read">
                                            <form method="POST" :action="'<?= Router\Router::route('/admin/notifications/read/') ?>' + notif.id" style="display:inline;">
                                                <?= Security::csrf_tokken() ?>
                                                <button type="submit" class="btn btn-sm btn-ghost" title="Marquer lu"><i class="fas fa-check"></i></button>
                                            </form>
                                        </template>
                                        <button class="btn btn-sm btn-ghost" @click="selectedNotif = notif; activeModal = 'view'; modalOpen = true" title="Voir"><i class="fas fa-eye"></i></button>
                                        <form method="POST" :action="'<?= Router\Router::route('/admin/notifications/') ?>' + notif.id + '/delete'" style="display:inline;">
                                            <?= Security::csrf_tokken() ?>
                                            <button type="submit" class="btn btn-sm btn-ghost" title="Supprimer" onclick="return confirm('Supprimer cette notification ?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div x-show="notifications.length === 0" style="padding: 3rem; text-align: center; color: var(--gray-500);">
                            <i class="fas fa-bell-slash" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                            <p>Aucune notification</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="modal-overlay" :class="{ 'active': modalOpen }" @click="modalOpen = false"></div>

    <!-- VIEW NOTIFICATION MODAL -->
    <div class="modal" :class="{ 'active': activeModal === 'view' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-bell"></i></div>
                <div>
                    <h3 class="modal-title">Notification</h3>
                    <p class="modal-subtitle" x-text="selectedNotif ? selectedNotif.title : ''"></p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p style="color: var(--gray-300);" x-text="selectedNotif ? selectedNotif.message : ''"></p>
            <p style="color: var(--gray-500); font-size: 0.875rem; margin-top: 1rem;" x-text="selectedNotif ? selectedNotif.time : ''"></p>
        </div>
        <div class="modal-footer">
            <template x-if="selectedNotif && selectedNotif.lien">
                <a :href="selectedNotif.lien" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Voir</a>
            </template>
            <button class="btn btn-secondary" @click="modalOpen = false">Fermer</button>
        </div>
    </div>
</body>

</html>