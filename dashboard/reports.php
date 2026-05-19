<?php
$pageTitle = 'Rapports & Statistiques';
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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="{ sidebarOpen: false, modalOpen: false, activeModal: null }">
    <div class="admin-wrapper">
        <?php include __DIR__ . '/../views/layouts/sidebar-admin.php'; ?>
        <main class="main-content">
            <header class="admin-header">
                <div class="header-left">
                    <button class="header-toggle" @click="document.dispatchEvent(new CustomEvent('sidebar:toggle'))"><i class="fas fa-bars"></i></button>
                    <div><h1 class="header-title"><?= $pageTitle ?></h1><nav class="header-breadcrumb"><a href="dashboard.php">Accueil</a><span>/</span><span><?= $pageTitle ?></span></nav></div>
                </div>
                <div class="header-actions">
                    <button class="btn btn-secondary" @click="activeModal = 'export'; modalOpen = true"><i class="fas fa-download"></i> Exporter</button>
                </div>
            </header>
            <div class="page-content">
                <div class="stats-grid" style="margin-bottom: 2rem;">
                    <div class="stat-card"><div class="stat-card-icon icon-gold"><i class="fas fa-file-alt"></i></div><div class="stat-card-content"><span class="stat-card-label">Dossiers</span><span class="stat-card-value">89</span></div></div>
                    <div class="stat-card"><div class="stat-card-icon icon-success"><i class="fas fa-check-circle"></i></div><div class="stat-card-content"><span class="stat-card-label">Traités</span><span class="stat-card-value">156</span></div></div>
                    <div class="stat-card"><div class="stat-card-icon icon-info"><i class="fas fa-users"></i></div><div class="stat-card-content"><span class="stat-card-label">Clients</span><span class="stat-card-value">234</span></div></div>
                    <div class="stat-card"><div class="stat-card-icon icon-warning"><i class="fas fa-clock"></i></div><div class="stat-card-content"><span class="stat-card-label">En Attente</span><span class="stat-card-value">12</span></div></div>
                </div>
                <div class="grid-2">
                    <div class="card">
                        <div class="card-header"><h2 class="card-title"><i class="fas fa-chart-pie"></i> Répartition par Domaine</h2></div>
                        <div class="card-body"><div class="chart-container"><canvas id="pieChart"></canvas></div></div>
                    </div>
                    <div class="card">
                        <div class="card-header"><h2 class="card-title"><i class="fas fa-chart-bar"></i> Activité Mensuelle</h2></div>
                        <div class="card-body"><div class="chart-container"><canvas id="barChart"></canvas></div></div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="modal-overlay" :class="{ 'active': modalOpen }" @click="modalOpen = false"></div>

    <div class="modal" :class="{ 'active': activeModal === 'export' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content"><div class="modal-icon"><i class="fas fa-file-export"></i></div><div><h3 class="modal-title">Exporter Rapport</h3><p class="modal-subtitle">Format d'export</p></div></div>
            <button class="modal-close" @click="modalOpen = false"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div class="report-card hover-lift" style="cursor: pointer;"><div class="report-icon"><i class="fas fa-file-pdf"></i></div><div class="report-info"><h3>Rapport PDF</h3><p>Export complet en format PDF</p></div></div>
                <div class="report-card hover-lift" style="cursor: pointer;"><div class="report-icon"><i class="fas fa-file-excel"></i></div><div class="report-info"><h3>Rapport Excel</h3><p>Tableur avec données détaillées</p></div></div>
            </div>
        </div>
        <div class="modal-footer"><button class="btn btn-primary" @click="modalOpen = false">Fermer</button></div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Chart(document.getElementById('pieChart').getContext('2d'), {type:'doughnut',data:{labels:['Droit Affaires','Droit Fiscal','Droit Travail','Droit Minier'],datasets:[{data:[35,25,20,20],backgroundColor:['#d4af37','#22c55e','#3b82f6','#f59e0b']}]},options:{responsive:true,plugins:{legend:{position:'bottom',labels:{color:'#a3a3a3'}}}}});
            new Chart(document.getElementById('barChart').getContext('2d'), {type:'bar',data:{labels:['Jan','Fév','Mar','Avr','Mai'],datasets:[{label:'Dossiers',data:[12,19,15,25,28],backgroundColor:'#d4af37'}]},options:{responsive:true,plugins:{legend:{display:false}},scales:{x:{ticks:{color:'#737373'},grid:{color:'rgba(255,255,255,0.05)'}},y:{ticks:{color:'#737373'},grid:{color:'rgba(255,255,255,0.05)'}}}}});
        });
    </script>
</body>
</html>