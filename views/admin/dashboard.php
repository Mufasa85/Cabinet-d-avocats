<?php


$stats = $stats ?? ['users' => 0, 'lawyers' => 0, 'pending' => 0, 'documents' => 0];
$recentApplications = $recentApplications ?? [];
$recentActivity = $recentActivity ?? [];
$statutCandidature = [
    'en_attente' => ['label' => 'En attente', 'class' => 'badge-warning'],
    'analyse' => ['label' => 'En analyse', 'class' => 'badge-info'],
    'retenu' => ['label' => 'Retenu', 'class' => 'badge-success'],
    'refuse' => ['label' => 'Refusé', 'class' => 'badge-danger'],
];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur | Cabinet d'Avocats</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dash_admin.css">
    <script src="../js/theme.js"></script>
</head>

<body>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="admin-wrapper">
        <!-- SIDEBAR -->
        <?php require dirname(__DIR__) . '/layouts/admin/sidebar.php'; ?>
        <!-- MAIN CONTENT -->
        <main class="main-content">
            <!-- HEADER -->
            <header class="admin-header">
                <div class="header-left">
                    <button class="header-toggle" id="sidebarToggle" title="Menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h1 class="header-title">Tableau de Bord</h1>
                        <nav class="header-breadcrumb">
                            <a href="#">Accueil</a>
                            <span>/</span>
                            <span>Dashboard</span>
                        </nav>
                    </div>
                </div>

                <div class="header-search">
                    <i class="fas fa-search header-search-icon"></i>
                    <input type="text" class="header-search-input" placeholder="Rechercher...">
                </div>

                <div class="header-actions">
                    <button class="header-action" id="notificationsBtn">
                        <i class="fas fa-bell"></i>
                        <span class="header-action-badge">5</span>
                    </button>
                    <button class="header-action">
                        <i class="fas fa-envelope"></i>
                        <span class="header-action-badge">3</span>
                    </button>
                    <button class="header-action">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <div class="page-content">
                <!-- STATS CARDS -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-icon icon-gold">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-card-content">
                            <span class="stat-card-label">Utilisateurs</span>
                            <span class="stat-card-value" data-count="<?= (int)($stats['users'] ?? 0) ?>"><?= (int)($stats['users'] ?? 0) ?></span>
                            <div class="stat-card-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+12% ce mois</span>
                            </div>
                        </div>
                        <div class="stat-card-bg">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-icon icon-success">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="stat-card-content">
                            <span class="stat-card-label">Avocats</span>
                            <span class="stat-card-value" data-count="<?= (int)($stats['lawyers'] ?? 0) ?>"><?= (int)($stats['lawyers'] ?? 0) ?></span>
                            <div class="stat-card-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+3 ce mois</span>
                            </div>
                        </div>
                        <div class="stat-card-bg">
                            <i class="fas fa-gavel fa-3x"></i>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-icon icon-info">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-card-content">
                            <span class="stat-card-label">Documents en attente</span>
                            <span class="stat-card-value" data-count="<?= (int)($stats['documents'] ?? 0) ?>"><?= (int)($stats['documents'] ?? 0) ?></span>
                            <div class="stat-card-change positive">
                                <i class="fas fa-arrow-up"></i>
                                <span>+8% ce mois</span>
                            </div>
                        </div>
                        <div class="stat-card-bg">
                            <i class="fas fa-file-alt fa-3x"></i>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-card-icon icon-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-card-content">
                            <span class="stat-card-label">En Attente</span>
                            <span class="stat-card-value" data-count="<?= (int)($stats['pending'] ?? 0) ?>"><?= (int)($stats['pending'] ?? 0) ?></span>
                            <div class="stat-card-change negative">
                                <i class="fas fa-arrow-down"></i>
                                <span>-5% cette semaine</span>
                            </div>
                        </div>
                        <div class="stat-card-bg">
                            <i class="fas fa-clock fa-3x"></i>
                        </div>
                    </div>
                </div>

                <!-- CONTENT GRID -->
                <div class="content-grid">
                    <!-- MAIN COLUMN -->
                    <div style="display: flex; flex-direction: column; gap: 2rem; width: 100%;">
                        <!-- RECENT ACTIVITY -->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">
                                    <i class="fas fa-history"></i>
                                    Activité Récente
                                </h2>
                                <button class="btn btn-sm btn-secondary" @click="activeModal = 'activity'; modalOpen = true">
                                    Voir Tout
                                </button>
                            </div>
                            <div class="card-body" style="padding: 0;">
                                <div class="activity-list">
                                    <?php foreach ($recentActivity as $activity): ?>
                                        <div class="activity-item">
                                            <div class="activity-icon <?= $activity['icon_class'] ?? 'icon-gold' ?>">
                                                <i class="<?= $activity['icon'] ?? 'fas fa-circle' ?>"></i>
                                            </div>
                                            <div class="activity-content">
                                                <h4><?= htmlspecialchars($activity['title']) ?></h4>
                                                <p><?= htmlspecialchars($activity['description']) ?></p>
                                            </div>
                                            <span class="activity-time"><?= htmlspecialchars($activity['time']) ?></span>
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- Sample Data -->
                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: rgba(34, 197, 94, 0.1); color: var(--success);">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                        <div class="activity-content">
                                            <h4>Nouveau client enregistré</h4>
                                            <p>Maître Diallo a ajouté un nouveau client pour le dossier #1245</p>
                                        </div>
                                        <span class="activity-time">Il y a 5 min</span>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--info);">
                                            <i class="fas fa-file-upload"></i>
                                        </div>
                                        <div class="activity-content">
                                            <h4>Document téléchargé</h4>
                                            <p>Un nouveau contrat a été uploadé dans le dossier fiscal</p>
                                        </div>
                                        <span class="activity-time">Il y a 23 min</span>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: rgba(212, 175, 55, 0.1); color: var(--gold-primary);">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                        <div class="activity-content">
                                            <h4>Rendez-vous confirmé</h4>
                                            <p>Consultation prévue avec le client Mwamba pour le 20 Mai</p>
                                        </div>
                                        <span class="activity-time">Il y a 1h</span>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--warning);">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </div>
                                        <div class="activity-content">
                                            <h4>Délai approaching</h4>
                                            <p>Échéance proche pour le dossier #892 - Droit des sociétés</p>
                                        </div>
                                        <span class="activity-time">Il y a 2h</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PENDING APPLICATIONS -->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">
                                    <i class="fas fa-inbox"></i>
                                    Candidatures en Attente
                                </h2>
                                <a href="<?= Router\Router::route('/admin/candidatures') ?>" class="btn btn-sm btn-secondary">
                                    Voir Toutes
                                </a>
                            </div>
                            <div class="card-body" style="padding: 0;">
                                <div class="table-container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Candidat</th>
                                                <th>Université</th>
                                                <th>Date</th>
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recentApplications as $app):
                                                $name = trim(($app['prenom'] ?? '') . ' ' . ($app['nom'] ?? ''));
                                                $initials = \Core\Auth::initials($name);
                                                $st = $statutCandidature[$app['statut']] ?? ['label' => $app['statut'], 'class' => 'badge-warning'];
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div class="user-info">
                                                            <div class="avatar"><?= htmlspecialchars($initials) ?></div>
                                                            <div class="user-details">
                                                                <h4><?= htmlspecialchars($name) ?></h4>
                                                                <span><?= htmlspecialchars($app['universite']) ?></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?= htmlspecialchars($app['universite']) ?></td>
                                                    <td><?= date('d M Y', strtotime($app['created_at'])) ?></td>
                                                    <td><span class="badge <?= $st['class'] ?>"><?= htmlspecialchars($st['label']) ?></span></td>
                                                    <td>
                                                        <a href="<?= Router\Router::route('/admin/candidatures') ?>" class="btn btn-sm btn-ghost" title="Voir"><i class="fas fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php if (empty($recentApplications)): ?>
                                                <tr>
                                                    <td colspan="5" style="text-align:center;color:var(--gray-500);">Aucune candidature récente</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- QUICK ACTIONS -->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">
                                    <i class="fas fa-bolt"></i>
                                    Actions Rapides
                                </h2>
                            </div>
                            <div class="card-body">
                                <div class="quick-actions">
                                    <a href="<?= Router\Router::route('/admin/users') ?>" class="quick-action">
                                        <div class="quick-action-icon">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                        <span>Ajouter Utilisateur</span>
                                    </a>
                                    <a href="<?= Router\Router::route('/admin/lawyers') ?>" class="quick-action">
                                        <div class="quick-action-icon">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <span>Nouvel Avocat</span>
                                    </a>
                                    <a href="<?= Router\Router::route('/admin/publications') ?>" class="quick-action">
                                        <div class="quick-action-icon">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                        <span>Publication</span>
                                    </a>
                                    <a href="<?= Router\Router::route('/admin/documents') ?>" class="quick-action">
                                        <div class="quick-action-icon">
                                            <i class="fas fa-upload"></i>
                                        </div>
                                        <span>Upload Doc</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- QUICK NOTIFICATIONS -->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">
                                    <i class="fas fa-bell"></i>
                                    Notifications
                                </h2>
                                <button class="btn btn-sm btn-ghost" @click="activeModal = 'notifications'; modalOpen = true">
                                    Tout Voir
                                </button>
                            </div>
                            <div class="card-body" style="padding: 0;">
                                <div class="notification-list">
                                    <div class="notification-item unread">
                                        <div class="notification-icon" style="background: rgba(239, 68, 68, 0.1); color: var(--danger);">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="notification-content">
                                            <h4>Dossier urgent</h4>
                                            <p>Le dossier #1457 nécessite votre attention immédiate</p>
                                            <span class="notification-time">Il y a 10 min</span>
                                        </div>
                                    </div>
                                    <div class="notification-item unread">
                                        <div class="notification-icon" style="background: rgba(212, 175, 55, 0.1); color: var(--gold-primary);">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                        <div class="notification-content">
                                            <h4>Nouveau rendez-vous</h4>
                                            <p>Rendez-vous prévu demain à 10h avec Maître Kabongo</p>
                                            <span class="notification-time">Il y a 1h</span>
                                        </div>
                                    </div>
                                    <div class="notification-item">
                                        <div class="notification-icon" style="background: rgba(34, 197, 94, 0.1); color: var(--success);">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div class="notification-content">
                                            <h4>Candidature acceptée</h4>
                                            <p>La candidature de Jean Mukamba a été traitée</p>
                                            <span class="notification-time">Il y a 3h</span>
                                        </div>
                                    </div>
                                    <div class="notification-item">
                                        <div class="notification-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--info);">
                                            <i class="fas fa-file-signature"></i>
                                        </div>
                                        <div class="notification-content">
                                            <h4>Document signé</h4>
                                            <p>Le contrat avec Solar Corp a été signé numériquement</p>
                                            <span class="notification-time">Il y a 5h</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL OVERLAY -->
    <div class="modal-overlay" id="modalOverlay"></div>

    <!-- NOTIFICATIONS MODAL -->
    <div class="modal modal-lg" id="notificationsModal">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <div>
                    <h3 class="modal-title">Toutes les Notifications</h3>
                    <p class="modal-subtitle">Vous avez 5 notifications non lues</p>
                </div>
            </div>
            <button class="modal-close" onclick="closeAllModals()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" style="padding: 0;">
            <div class="notification-list">
                <div class="notification-item unread">
                    <div class="notification-icon" style="background: rgba(239, 68, 68, 0.1); color: var(--danger);">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="notification-content">
                        <h4>Dossier urgent - Action requise</h4>
                        <p>Le dossier #1457 en Droit des Sociétés nécessite une révision immédiate. Le client attend une réponse pour demain.</p>
                        <span class="notification-time">Il y a 10 min</span>
                    </div>
                </div>
                <div class="notification-item unread">
                    <div class="notification-icon" style="background: rgba(212, 175, 55, 0.1); color: var(--gold-primary);">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="notification-content">
                        <h4>Nouveau rendez-vous confirmé</h4>
                        <p>Rendez-vous prévu demain à 10h avec Maître Kabongo pour une consultation en Droit Fiscal.</p>
                        <span class="notification-time">Il y a 1h</span>
                    </div>
                </div>
                <div class="notification-item unread">
                    <div class="notification-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--info);">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="notification-content">
                        <h4>Nouvelle candidature reçue</h4>
                        <p>Jean Mukamba a postulé pour le poste de stagiaire en Droit des Affaires.</p>
                        <span class="notification-time">Il y a 2h</span>
                    </div>
                </div>
                <div class="notification-item unread">
                    <div class="notification-icon" style="background: rgba(34, 197, 94, 0.1); color: var(--success);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="notification-content">
                        <h4>Candidature acceptée</h4>
                        <p>La candidature de Aminata Ngalulu a été acceptée et envoyée à Maître Lukoji.</p>
                        <span class="notification-time">Il y a 3h</span>
                    </div>
                </div>
                <div class="notification-item unread">
                    <div class="notification-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--warning);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="notification-content">
                        <h4>Rappel d'échéance</h4>
                        <p>Le dossier #892 arrive à échéance dans 3 jours. Merci de procéder aux dernières vérifications.</p>
                        <span class="notification-time">Il y a 5h</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary">Tout marquer comme lu</button>
            <button class="btn btn-primary" @click="modalOpen = false; activeModal = null">Fermer</button>
        </div>
    </div>

    <!-- ACTIVITY MODAL -->
    <div class="modal modal-lg" :class="{ 'active': activeModal === 'activity' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon">
                    <i class="fas fa-history"></i>
                </div>
                <div>
                    <h3 class="modal-title">Activité Récente</h3>
                    <p class="modal-subtitle">Historique complet des 30 derniers jours</p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false; activeModal = null">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon" style="background: rgba(34, 197, 94, 0.1); color: var(--success);">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Nouveau client enregistré</h4>
                        <p>Maître Diallo a ajouté un nouveau client pour le dossier #1245</p>
                    </div>
                    <span class="activity-time">Il y a 5 min</span>
                </div>
                <div class="activity-item">
                    <div class="activity-icon" style="background: rgba(59, 130, 246, 0.1); color: var(--info);">
                        <i class="fas fa-file-upload"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Document téléchargé</h4>
                        <p>Un nouveau contrat a été uploadé dans le dossier fiscal</p>
                    </div>
                    <span class="activity-time">Il y a 23 min</span>
                </div>
                <div class="activity-item">
                    <div class="activity-icon" style="background: rgba(212, 175, 55, 0.1); color: var(--gold-primary);">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Rendez-vous confirmé</h4>
                        <p>Consultation prévue avec le client Mwamba pour le 20 Mai</p>
                    </div>
                    <span class="activity-time">Il y a 1h</span>
                </div>
                <div class="activity-item">
                    <div class="activity-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--warning);">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Délai approaching</h4>
                        <p>Échéance proche pour le dossier #892 - Droit des sociétés</p>
                    </div>
                    <span class="activity-time">Il y a 2h</span>
                </div>
                <div class="activity-item">
                    <div class="activity-icon" style="background: rgba(239, 68, 68, 0.1); color: var(--danger);">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Dossier fermé</h4>
                        <p>Le dossier #756 en Droit du Travail a été finalisé avec succès</p>
                    </div>
                    <span class="activity-time">Il y a 4h</span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary">Exporter en PDF</button>
            <button class="btn btn-primary" @click="modalOpen = false; activeModal = null">Fermer</button>
        </div>
    </div>

    <!-- STATS DETAILS MODAL -->
    <div class="modal" :class="{ 'active': activeModal === 'stats-details' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div>
                    <h3 class="modal-title">Statistiques Détaillées</h3>
                    <p class="modal-subtitle">Analyse complète de l'activité</p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false; activeModal = null">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-bottom: 2rem;">
                <div style="background: rgba(212, 175, 55, 0.05); padding: 1.5rem; border-radius: 0.75rem; text-align: center;">
                    <h4 style="font-size: 2rem; font-weight: 700; color: var(--gold-primary); font-family: 'Playfair Display', serif;">156</h4>
                    <p style="color: var(--gray-400); font-size: 0.875rem;">Utilisateurs Totaux</p>
                </div>
                <div style="background: rgba(34, 197, 94, 0.05); padding: 1.5rem; border-radius: 0.75rem; text-align: center;">
                    <h4 style="font-size: 2rem; font-weight: 700; color: var(--success); font-family: 'Playfair Display', serif;">24</h4>
                    <p style="color: var(--gray-400); font-size: 0.875rem;">Avocats Actifs</p>
                </div>
                <div style="background: rgba(59, 130, 246, 0.05); padding: 1.5rem; border-radius: 0.75rem; text-align: center;">
                    <h4 style="font-size: 2rem; font-weight: 700; color: var(--info); font-family: 'Playfair Display', serif;">89</h4>
                    <p style="color: var(--gray-400); font-size: 0.875rem;">Dossiers Totaux</p>
                </div>
                <div style="background: rgba(245, 158, 11, 0.05); padding: 1.5rem; border-radius: 0.75rem; text-align: center;">
                    <h4 style="font-size: 2rem; font-weight: 700; color: var(--warning); font-family: 'Playfair Display', serif;">12</h4>
                    <p style="color: var(--gray-400); font-size: 0.875rem;">En Attente</p>
                </div>
            </div>

            <div style="margin-top: 1.5rem;">
                <h4 style="color: var(--white); margin-bottom: 1rem;">Répartition par Domaine</h4>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <div>
                        <div class="flex justify-between mb-sm">
                            <span style="font-size: 0.875rem; color: var(--gray-400);">Droit des Affaires</span>
                            <span style="font-size: 0.875rem; font-weight: 600; color: var(--white);">35%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 35%;"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-sm">
                            <span style="font-size: 0.875rem; color: var(--gray-400);">Droit Fiscal</span>
                            <span style="font-size: 0.875rem; font-weight: 600; color: var(--white);">25%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 25%;"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-sm">
                            <span style="font-size: 0.875rem; color: var(--gray-400);">Droit du Travail</span>
                            <span style="font-size: 0.875rem; font-weight: 600; color: var(--white);">20%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 20%;"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-sm">
                            <span style="font-size: 0.875rem; color: var(--gray-400);">Droit Minier</span>
                            <span style="font-size: 0.875rem; font-weight: 600; color: var(--white);">12%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 12%;"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-sm">
                            <span style="font-size: 0.875rem; color: var(--gray-400);">Autres</span>
                            <span style="font-size: 0.875rem; font-weight: 600; color: var(--white);">8%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 8%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary">
                <i class="fas fa-download"></i> Exporter
            </button>
            <button class="btn btn-primary" @click="modalOpen = false; activeModal = null">Fermer</button>
        </div>
    </div>

    <!-- PREVIEW APPLICATION MODAL -->
    <div class="modal modal-lg" :class="{ 'active': activeModal === 'preview-application' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div>
                    <h3 class="modal-title">Candidature - Jean Mukamba</h3>
                    <p class="modal-subtitle">Université de Kinshasa - Master II en Droit des Affaires</p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false; activeModal = null">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
                <div>
                    <div style="text-align: center; margin-bottom: 1.5rem;">
                        <div class="avatar avatar-xl" style="margin: 0 auto 1rem;">JM</div>
                        <h4 style="color: var(--white); font-size: 1.125rem;">Jean Mukamba</h4>
                        <p style="color: var(--gray-500); font-size: 0.875rem;">Candidat Stagiaire</p>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <div>
                            <p style="color: var(--gray-500); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">Email</p>
                            <p style="color: var(--white); font-size: 0.875rem;">jean.mukamba@student.unikin.ac.cd</p>
                        </div>
                        <div>
                            <p style="color: var(--gray-500); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">Téléphone</p>
                            <p style="color: var(--white); font-size: 0.875rem;">+243 81 234 5678</p>
                        </div>
                        <div>
                            <p style="color: var(--gray-500); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">Date de Candidature</p>
                            <p style="color: var(--white); font-size: 0.875rem;">15 Mai 2026</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div style="margin-bottom: 1.5rem;">
                        <h4 style="color: var(--white); margin-bottom: 0.5rem;">Lettre de Motivation</h4>
                        <p style="color: var(--gray-400); font-size: 0.875rem; line-height: 1.7;">
                            Madame, Monsieur,<br><br>
                            Ayant terminé ma formation en Master II en Droit des Affaires à l'Université de Kinshasa,
                            je suis vivement intéressé par une opportunité de stage au sein de votre cabinet reconnu pour son excellence en conseil juridique.<br><br>
                            Mon mémoire de fin d'études portait sur les aspects juridiques des fusions-acquisitions en République Démocratique du Congo,
                            ce qui m'a permis de développer une solide compréhension des défis réglementaires auxquels font face les entreprises locales.<br><br>
                            Je suis convaincu que mon profil correspond aux attentes de votre cabinet et serais honoré de contribuer à vos activités.
                        </p>
                    </div>

                    <div>
                        <h4 style="color: var(--white); margin-bottom: 0.5rem;">Documents Attachés</h4>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                                <i class="fas fa-file-pdf" style="color: var(--danger);"></i>
                                <span style="color: var(--gray-300); font-size: 0.875rem; flex: 1;">CV_JeanMukamba.pdf</span>
                                <button class="btn btn-sm btn-ghost"><i class="fas fa-download"></i></button>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                                <i class="fas fa-file-pdf" style="color: var(--danger);"></i>
                                <span style="color: var(--gray-300); font-size: 0.875rem; flex: 1;">Diplomes_MASTER.pdf</span>
                                <button class="btn btn-sm btn-ghost"><i class="fas fa-download"></i></button>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                                <i class="fas fa-file-pdf" style="color: var(--danger);"></i>
                                <span style="color: var(--gray-300); font-size: 0.875rem; flex: 1;">Lettre_Motivation.pdf</span>
                                <button class="btn btn-sm btn-ghost"><i class="fas fa-download"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger">
                <i class="fas fa-times"></i> Refuser
            </button>
            <button class="btn btn-success">
                <i class="fas fa-check"></i> Accepter
            </button>
        </div>
    </div>

    <!-- Admin Dashboard JavaScript -->
    <script src="../js/dash_admin.js"></script>
    <script>
        // Modal functionality (vanilla JS - no Alpine)
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle modal function
            window.toggleModal = function(modalId) {
                const modal = document.getElementById(modalId);
                const overlay = document.getElementById('modalOverlay');
                if (modal && overlay) {
                    modal.classList.toggle('active');
                    overlay.classList.toggle('active');
                    document.body.style.overflow = modal.classList.contains('active') ? 'hidden' : '';
                }
            };

            window.closeAllModals = function() {
                document.querySelectorAll('.modal.active').forEach(function(modal) {
                    modal.classList.remove('active');
                });
                document.getElementById('modalOverlay').classList.remove('active');
                document.body.style.overflow = '';
            };

            // Open notification modal
            document.getElementById('notificationsBtn').addEventListener('click', function() {
                toggleModal('notificationsModal');
            });

            // Activity modal button
            document.querySelectorAll('[data-open-activity]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    toggleModal('activityModal');
                });
            });

            // Notifications card button
            document.querySelectorAll('[data-open-notifications]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    toggleModal('notificationsModal');
                });
            });

            // Close buttons
            document.querySelectorAll('.modal-close').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    closeAllModals();
                });
            });

            // Overlay click to close
            document.getElementById('modalOverlay').addEventListener('click', function() {
                closeAllModals();
            });

            // Escape key to close modals
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeAllModals();
                }
            });
        });
    </script>
</body>

</html>