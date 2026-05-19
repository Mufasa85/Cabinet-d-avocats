<?php
$pageTitle = 'Notifications';
$notifications = [
    ['id' => 1, 'title' => 'Nouvelle candidature', 'message' => 'Jean Mukamba a postulé pour un stage', 'time' => 'Il y a 5 min', 'read' => false, 'icon' => 'user-plus', 'color' => 'gold'],
    ['id' => 2, 'title' => 'Document signé', 'message' => 'Contrat SolarCorp.pdf a été signé', 'time' => 'Il y a 1h', 'read' => false, 'icon' => 'file-signature', 'color' => 'success'],
    ['id' => 3, 'title' => 'Rendez-vous', 'message' => 'RDV confirmé avec Maître Kabongo', 'time' => 'Il y a 3h', 'read' => true, 'icon' => 'calendar', 'color' => 'info'],
    ['id' => 4, 'title' => 'Alerte système', 'message' => 'Mise à jour disponible', 'time' => 'Hier', 'read' => true, 'icon' => 'exclamation-circle', 'color' => 'warning'],
];
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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="{ sidebarOpen: false, modalOpen: false, activeModal: null, selectedNotif: null }">
    <div class="admin-wrapper">
        <?php include __DIR__ . '/../views/layouts/sidebar-admin.php'; ?>
        <main class="main-content">
            <header class="admin-header">
                <div class="header-left">
                    <button class="header-toggle" @click="document.dispatchEvent(new CustomEvent('sidebar:toggle'))"><i class="fas fa-bars"></i></button>
                    <div><h1 class="header-title"><?= $pageTitle ?></h1><nav class="header-breadcrumb"><a href="dashboard.php">Accueil</a><span>/</span><span><?= $pageTitle ?></span></nav></div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-secondary"><i class="fas fa-check-double"></i> Tout marquer lu</button>
                </div>
            </header>
            <div class="page-content">
                <div class="card">
                    <div class="card-body" style="padding: 0;">
                        <div class="notification-list">
                            <?php foreach ($notifications as $n): ?>
                            <div class="notification-item <?= !$n['read'] ? 'unread' : '' ?>">
                                <div class="notification-icon notification-<?= $n['color'] ?>"><i class="fas fa-<?= $n['icon'] ?>"></i></div>
                                <div class="notification-content">
                                    <h4><?= htmlspecialchars($n['title']) ?></h4>
                                    <p><?= htmlspecialchars($n['message']) ?></p>
                                    <span class="notification-time"><?= $n['time'] ?></span>
                                </div>
                                <div class="notification-actions">
                                    <button class="btn btn-sm btn-ghost" @click="selectedNotif = <?= htmlspecialchars(json_encode($n)) ?>; activeModal = 'view'; modalOpen = true"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-sm btn-ghost" @click="activeModal = 'delete'; modalOpen = true"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="modal-overlay" :class="{ 'active': modalOpen }" @click="modalOpen = false"></div>

    <div class="modal" :class="{ 'active': activeModal === 'view' && modalOpen }">
        <div class="modal-header"><div class="modal-header-content"><div class="modal-icon"><i class="fas fa-bell"></i></div><div><h3 class="modal-title">Notification</h3><p class="modal-subtitle" x-text="selectedNotif ? selectedNotif.title : ''"></p></div></div><button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button></div>
        <div class="modal-body">
            <p style="color: var(--gray-300);" x-text="selectedNotif ? selectedNotif.message : ''"></p>
            <p style="color: var(--gray-500); font-size: 0.875rem; margin-top: 1rem;" x-text="selectedNotif ? selectedNotif.time : ''"></p>
        </div>
        <div class="modal-footer"><button class="btn btn-primary" @click="modalOpen = false">Fermer</button></div>
    </div>

    <div class="modal confirm-modal" :class="{ 'active': activeModal === 'delete' && modalOpen }">
        <div class="modal-header"><div class="modal-header-content"><div class="modal-icon"><i class="fas fa-exclamation-triangle"></i></div><div><h3 class="modal-title">Supprimer</h3><p class="modal-subtitle">Action irréversible</p></div></div><button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button></div>
        <div class="modal-body"><p>Êtes-vous sûr de vouloir supprimer cette notification ?</p></div>
        <div class="modal-footer"><button class="btn btn-secondary" @click="modalOpen = false">Annuler</button><button class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button></div>
    </div>
</body>
</html>