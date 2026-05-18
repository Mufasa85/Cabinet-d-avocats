<?php
/**
 * ELMD - Cabinet d'Avocats
 * Tableau de bord
 */

// Démarrer la session
session_start();

// Définir le chemin de base
define('ELMD_ROOT', __DIR__);

// Titre de la page
$pageTitle = 'Tableau de bord | ELMD - Cabinet d\'Avocats';

// Récupérer les infos utilisateur (valeurs par défaut pour le design)
$userId = $_SESSION['user_id'] ?? 1;
$userName = $_SESSION['user_name'] ?? 'Laurent Mbako';
$userEmail = $_SESSION['user_email'] ?? 'laurentmbako@etudelmbako.com';
$userRole = $_SESSION['user_role'] ?? 'admin';
$userAvatar = $_SESSION['user_avatar'] ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=100&q=80';

// Déterminer le type de sidebar selon le rôle
$isAdmin = ($userRole === 'admin');
$isLawyer = ($userRole === 'lawyer');

// Données simulées pour le tableau de bord (à remplacer par des requêtes en base de données)
$stats = [
    'dossiers' => 12,
    'rdv_aujourdhui' => 3,
    'messages_non_lus' => 5,
    'taches_en_cours' => 8
];

$rendezVous = [
    ['heure' => '09:00', 'client' => 'Pierre Moreau', 'type' => 'Consultation initiale', 'statut' => 'confirmed'],
    ['heure' => '11:30', 'client' => 'Claire Dubois', 'type' => 'Révision contrat', 'statut' => 'confirmed'],
    ['heure' => '14:00', 'client' => 'Marc Lefebvre', 'type' => 'Audience tribunal', 'statut' => 'pending']
];

$taches = [
    ['titre' => 'Préparer dossier Moreau', 'deadline' => 'Aujourd\'hui', 'priorite' => 'high'],
    ['titre' => 'Réviser contrat TechVision', 'deadline' => 'Demain', 'priorite' => 'medium'],
    ['titre' => 'Appeler client Dubois', 'deadline' => 'Cette semaine', 'priorite' => 'low']
];

$dernieresActivites = [
    ['action' => 'Nouveau message de Pierre Moreau', 'temps' => 'Il y a 15 min'],
    ['action' => 'Rendez-vous confirmé avec Claire Dubois', 'temps' => 'Il y a 1h'],
    ['action' => 'Document ajouté au dossier Lefebvre', 'temps' => 'Il y a 3h'],
    ['action' => 'Tâche complétée: Réviser mémoire', 'temps' => 'Hier']
];
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/dash_admin.css">
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <?php if ($isAdmin): ?>
            <?php include dirname(__DIR__) . '/views/layouts/sidebar-admin.php'; ?>
        <?php else: ?>
            <?php include dirname(__DIR__) . '/views/layouts/sidebar-lawyer.php'; ?>
        <?php endif; ?>

        <!-- Main Content -->
        <main class="dashboard-main">
            <!-- Header -->
            <header class="dashboard-header">
                <div class="header-left">
                    <h1>Bienvenue, <?= htmlspecialchars(explode(' ', $userName)[0]) ?></h1>
                    <p class="header-subtitle">Voici un aperçu de votre activité</p>
                </div>
                <div class="header-right">
                    <div class="header-date">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <span><?= date('d/m/Y') ?></span>
                    </div>
                    <a href="deconnexion.php" class="btn-logout">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Déconnexion
                    </a>
                </div>
            </header>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon stat-icon-blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number"><?= $stats['dossiers'] ?></span>
                        <span class="stat-label">Dossiers actifs</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon stat-icon-green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number"><?= $stats['rdv_aujourdhui'] ?></span>
                        <span class="stat-label">Rendez-vous aujourd'hui</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon stat-icon-orange">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number"><?= $stats['messages_non_lus'] ?></span>
                        <span class="stat-label">Messages non lus</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon stat-icon-purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 11l3 3L22 4"/>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                        </svg>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number"><?= $stats['taches_en_cours'] ?></span>
                        <span class="stat-label">Tâches en cours</span>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Rendez-vous du jour -->
                <div class="card rendez-vous-card">
                    <div class="card-header">
                        <h2>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            Rendez-vous du jour
                        </h2>
                        <a href="#" class="card-link">Voir tout</a>
                    </div>
                    <div class="card-body">
                        <?php foreach ($rendezVous as $rdv): ?>
                        <div class="rdv-item <?= $rdv['statut'] ?>">
                            <div class="rdv-time"><?= $rdv['heure'] ?></div>
                            <div class="rdv-details">
                                <span class="rdv-client"><?= htmlspecialchars($rdv['client']) ?></span>
                                <span class="rdv-type"><?= htmlspecialchars($rdv['type']) ?></span>
                            </div>
                            <span class="rdv-status <?= $rdv['statut'] ?>">
                                <?= $rdv['statut'] === 'confirmed' ? 'Confirmé' : 'En attente' ?>
                            </span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Tâches à faire -->
                <div class="card tasks-card">
                    <div class="card-header">
                        <h2>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 11l3 3L22 4"/>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                            </svg>
                            Tâches à faire
                        </h2>
                        <a href="#" class="card-link">Voir tout</a>
                    </div>
                    <div class="card-body">
                        <?php foreach ($taches as $tache): ?>
                        <div class="task-item priority-<?= $tache['priorite'] ?>">
                            <label class="task-checkbox">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <div class="task-details">
                                <span class="task-title"><?= htmlspecialchars($tache['titre']) ?></span>
                                <span class="task-deadline">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    <?= htmlspecialchars($tache['deadline']) ?>
                                </span>
                            </div>
                            <span class="task-priority <?= $tache['priorite'] ?>">
                                <?= $tache['priorite'] === 'high' ? 'Urgent' : ($tache['priorite'] === 'medium' ? 'Normal' : 'Bas') ?>
                            </span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Activités récentes -->
                <div class="card activities-card">
                    <div class="card-header">
                        <h2>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                            </svg>
                            Activités récentes
                        </h2>
                    </div>
                    <div class="card-body">
                        <?php foreach ($dernieresActivites as $activite): ?>
                        <div class="activity-item">
                            <div class="activity-dot"></div>
                            <div class="activity-content">
                                <span class="activity-action"><?= htmlspecialchars($activite['action']) ?></span>
                                <span class="activity-time"><?= htmlspecialchars($activite['temps']) ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script type="module" src="../js/theme.js"></script>
    <script>
        // Toggle sidebar
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.querySelector('.sidebar-admin, .sidebar-lawyer');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                document.body.classList.toggle('sidebar-collapsed');
            });
        }

        // Animation on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
    </script>
</body>
</html>