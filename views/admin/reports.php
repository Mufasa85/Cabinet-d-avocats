<?php
$pageTitle = 'Rapports & Statistiques';
$stats = $stats ?? [];
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../js/theme.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="{ sidebarOpen: false }">
    <div class="admin-wrapper">
        <?php require dirname(__DIR__) . '/layouts/admin/sidebar.php'; ?>
        <main class="main-content">
            <header class="admin-header">
                <div class="header-left">
                    <button class="header-toggle" @click="document.dispatchEvent(new CustomEvent('sidebar:toggle'))"><i class="fas fa-bars"></i></button>
                    <div><h1 class="header-title"><?= $pageTitle ?></h1></div>
                </div>
            </header>

            <div class="page-content">
                <div class="stats-grid" style="margin-bottom: 2rem;">
                    <div class="stat-card"><div class="stat-card-icon icon-gold"><i class="fas fa-users"></i></div><div class="stat-card-content"><span class="stat-card-label">Utilisateurs</span><span class="stat-card-value"><?= (int) ($stats['users'] ?? 0) ?></span></div></div>
                    <div class="stat-card"><div class="stat-card-icon icon-info"><i class="fas fa-user-tie"></i></div><div class="stat-card-content"><span class="stat-card-label">Avocats</span><span class="stat-card-value"><?= (int) ($stats['avocats'] ?? 0) ?></span></div></div>
                    <div class="stat-card"><div class="stat-card-icon icon-success"><i class="fas fa-user-graduate"></i></div><div class="stat-card-content"><span class="stat-card-label">Stagiaires</span><span class="stat-card-value"><?= (int) ($stats['stagiaires'] ?? 0) ?></span></div></div>
                    <div class="stat-card"><div class="stat-card-icon icon-warning"><i class="fas fa-hourglass-half"></i></div><div class="stat-card-content"><span class="stat-card-label">Inscriptions en attente</span><span class="stat-card-value"><?= (int) ($stats['inscriptions_pending'] ?? 0) ?></span></div></div>
                </div>

                <div class="grid-2">
                    <div class="card">
                        <div class="card-header"><h2 class="card-title"><i class="fas fa-chart-pie"></i> Répartition utilisateurs</h2></div>
                        <div class="card-body"><div class="chart-container"><canvas id="pieChart"></canvas></div></div>
                    </div>
                    <div class="card">
                        <div class="card-header"><h2 class="card-title"><i class="fas fa-chart-bar"></i> Candidatures / Documents</h2></div>
                        <div class="card-body"><div class="chart-container"><canvas id="barChart"></canvas></div></div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pieData = {
                labels: ['Avocats', 'Stagiaires'],
                datasets: [{
                    data: [<?= (int) ($stats['avocats'] ?? 0) ?>, <?= (int) ($stats['stagiaires'] ?? 0) ?>],
                    backgroundColor: ['#d4af37', '#3b82f6']
                }]
            };

            const barData = {
                labels: ['Candidatures', 'Docs validés', 'Docs en attente'],
                datasets: [{
                    label: 'Volume',
                    data: [
                        <?= (int) ($stats['candidatures'] ?? 0) ?>,
                        <?= (int) ($stats['documents_valides'] ?? 0) ?>,
                        <?= (int) ($stats['documents_attente'] ?? 0) ?>
                    ],
                    backgroundColor: ['#22c55e', '#d4af37', '#f59e0b']
                }]
            };

            new Chart(document.getElementById('pieChart').getContext('2d'), {
                type: 'doughnut',
                data: pieData,
                options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
            });

            new Chart(document.getElementById('barChart').getContext('2d'), {
                type: 'bar',
                data: barData,
                options: { responsive: true, plugins: { legend: { display: false } } }
            });
        });
    </script>
</body>
</html>
