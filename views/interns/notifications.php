<?php $pageTitle = 'Notifications'; ?>
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
        <header class="admin-header"><h1 class="header-title">Notifications</h1></header>
        <div class="page-content">
            <div class="notification-list">
                <?php foreach ($notifications ?? [] as $n): ?>
                <div class="notification-item <?= $n['est_lu'] ? '' : 'unread' ?>">
                    <div class="notification-content">
                        <h4><?= htmlspecialchars($n['titre']) ?></h4>
                        <p><?= htmlspecialchars($n['message']) ?></p>
                        <span class="notification-time"><?= date('d/m/Y H:i', strtotime($n['created_at'])) ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if (empty($notifications)): ?>
                    <p style="color:var(--gray-400);">Aucune notification.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>
</body>
</html>
