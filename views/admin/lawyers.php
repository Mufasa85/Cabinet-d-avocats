<?php
/**
 * ==============================================
 * ADMIN LAWYERS MANAGEMENT
 * Cabinet d'Avocats
 * ==============================================
 */

$pageTitle = 'Gestion des Avocats';
// $lawyers = [
//     ['id' => 1, 'name' => 'Maître Jean Kabongo', 'specialty' => 'Droit des Affaires', 'phone' => '+243 81 234 5678', 'email' => 'jean.kabongo@cabinet.cd', 'status' => 'available', 'avatar' => 'JK', 'cases' => 12],
//     ['id' => 2, 'name' => 'Maître Marie Lukoji', 'specialty' => 'Droit Fiscal', 'phone' => '+243 81 345 6789', 'email' => 'marie.lukoj@cabinet.cd', 'status' => 'available', 'avatar' => 'ML', 'cases' => 8],
//     ['id' => 3, 'name' => 'Maître Robert Ngalulu', 'specialty' => 'Droit du Travail', 'phone' => '+243 81 456 7890', 'email' => 'robert.ngalulu@cabinet.cd', 'status' => 'busy', 'avatar' => 'RN', 'cases' => 15],
//     ['id' => 4, 'name' => 'Maître Sophie Kasaï', 'specialty' => 'Droit Minier', 'phone' => '+243 81 567 8901', 'email' => 'sophie.kasai@cabinet.cd', 'status' => 'available', 'avatar' => 'SK', 'cases' => 6],
//     ['id' => 5, 'name' => 'Maître Pierre Diallo', 'specialty' => 'Droit des Sociétés', 'phone' => '+243 81 678 9012', 'email' => 'pierre.diallo@cabinet.cd', 'status' => 'unavailable', 'avatar' => 'PD', 'cases' => 0],
// ];

?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> | Cabinet d'Avocats</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dash_admin.css">
    <script src="../js/theme.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="{ sidebarOpen: false, modalOpen: false, activeModal: null, selectedLawyer: null }">
    
    <div class="admin-wrapper">
   <?php require dirname(__DIR__) . '/layouts/admin/sidebar.php'; ?>
        
        <main class="main-content">
            <header class="admin-header">
                <div class="header-left">
                    <button class="header-toggle" @click="document.dispatchEvent(new CustomEvent('sidebar:toggle'))">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h1 class="header-title"><?= $pageTitle ?></h1>
                        <nav class="header-breadcrumb">
                            <a href="dashboard.php">Accueil</a>
                            <span>/</span>
                            <span><?= $pageTitle ?></span>
                        </nav>
                    </div>
                </div>
                
                <div class="header-actions">
                    <button class="btn btn-primary" @click="activeModal = 'add-lawyer'; modalOpen = true">
                        <i class="fas fa-plus"></i>
                        Nouvel Avocat
                    </button>
                </div>
            </header>
            
            <div class="page-content">
                <div class="filter-bar">
                    <div class="search-input">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Rechercher un avocat...">
                    </div>
                    <select class="filter-select">
                        <option value="">Toutes spécialités</option>
                        <option value="affaires">Droit des Affaires</option>
                        <option value="fiscal">Droit Fiscal</option>
                        <option value="travail">Droit du Travail</option>
                        <option value="minier">Droit Minier</option>
                        <option value="societes">Droit des Sociétés</option>
                    </select>
                    <select class="filter-select">
                        <option value="">Tous statuts</option>
                        <option value="available">Disponible</option>
                        <option value="busy">Occupé</option>
                        <option value="unavailable">Indisponible</option>
                    </select>
                </div>
                
                <div class="grid-2">
                    <?php foreach ($lawyers as $lawyer): ?>
                    <div class="card hover-lift">
                        <div class="card-body">
                            <div class="flex gap-lg">
                                <div class="avatar avatar-lg"><?= $lawyer['avatar'] ?></div>
                                <div style="flex: 1;">
                                    <div class="flex justify-between items-center mb-sm">
                                        <h4 style="color: var(--white); font-size: 1rem;"><?= htmlspecialchars($lawyer['name']) ?></h4>
                                        <span class="badge <?= $lawyer['status'] === 'available' ? 'badge-success' : ($lawyer['status'] === 'busy' ? 'badge-warning' : 'badge-danger') ?>">
                                            <span class="status-dot <?= $lawyer['status'] === 'available' ? 'success' : ($lawyer['status'] === 'busy' ? 'warning' : 'danger') ?>"></span>
                                            <?= ucfirst($lawyer['status']) ?>
                                        </span>
                                    </div>
                                    <p style="color: var(--gold-primary); font-size: 0.875rem; margin-bottom: 0.5rem;">
                                        <i class="fas fa-briefcase" style="margin-right: 0.25rem;"></i>
                                        <?= htmlspecialchars($lawyer['specialty']?? 'Aucune specialité renseigner') ?>
                                    </p>
                                    <div style="font-size: 0.8125rem; color: var(--gray-500); margin-bottom: 1rem;">
                                        <p><i class="fas fa-envelope" style="margin-right: 0.5rem;"></i><?= htmlspecialchars($lawyer['email']) ?></p>
                                        <p><i class="fas fa-phone" style="margin-right: 0.5rem;"></i><?= htmlspecialchars($lawyer['phone']) ?></p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span style="color: var(--gray-400); font-size: 0.875rem;">
                                            <i class="fas fa-folder" style="margin-right: 0.25rem;"></i>
                                            <?= $lawyer['cases'] ?? 'Aucun' ?> dossiers actifs
                                        </span>
                                        <div class="flex gap-sm">
                                            <button class="btn btn-sm btn-ghost" @click="selectedLawyer = <?= htmlspecialchars(json_encode($lawyer)) ?>; activeModal = 'view-lawyer'; modalOpen = true" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-ghost" @click="selectedLawyer = <?= htmlspecialchars(json_encode($lawyer)) ?>; activeModal = 'edit-lawyer'; modalOpen = true" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-ghost" @click="selectedLawyer = <?= htmlspecialchars(json_encode($lawyer)) ?>; activeModal = 'delete-lawyer'; modalOpen = true" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>
    
    <div class="modal-overlay" :class="{ 'active': modalOpen }" @click="modalOpen = false; activeModal = null"></div>
    
    <!-- ADD LAWYER MODAL -->
    <div class="modal" :class="{ 'active': activeModal === 'add-lawyer' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-user-tie"></i></div>
                <div>
                    <h3 class="modal-title">Nouvel Avocat</h3>
                    <p class="modal-subtitle">Ajouter un nouveau avocat au cabinet</p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false; activeModal = null"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nom Complet</label>
                    <input type="text" class="form-input" placeholder="Maître Nom Prénom">
                </div>
                <div class="form-group">
                    <label class="form-label">Spécialité</label>
                    <select class="form-select">
                        <option value="">Sélectionner</option>
                        <option value="affaires">Droit des Affaires</option>
                        <option value="fiscal">Droit Fiscal</option>
                        <option value="travail">Droit du Travail</option>
                        <option value="minier">Droit Minier</option>
                        <option value="societes">Droit des Sociétés</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" placeholder="avocat@cabinet.cd">
                </div>
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" class="form-input" placeholder="+243 XX XXX XXXX">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Barreau</label>
                <input type="text" class="form-input" placeholder="Barreau de Kinshasa">
            </div>
            <div class="form-group">
                <label class="form-label">Disponibilité</label>
                <select class="form-select">
                    <option value="available">Disponible</option>
                    <option value="busy">Occupé</option>
                    <option value="unavailable">Indisponible</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false; activeModal = null">Annuler</button>
            <button class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
        </div>
    </div>
    
    <!-- EDIT LAWYER MODAL -->
    <div class="modal" :class="{ 'active': activeModal === 'edit-lawyer' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-user-edit"></i></div>
                <div>
                    <h3 class="modal-title">Modifier l'Avocat</h3>
                    <p class="modal-subtitle" x-text="selectedLawyer ? selectedLawyer.name : ''"></p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false; activeModal = null"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nom Complet</label>
                    <input type="text" class="form-input" x-model="selectedLawyer.name" placeholder="Maître Nom Prénom">
                </div>
                <div class="form-group">
                    <label class="form-label">Spécialité</label>
                    <select class="form-select">
                        <option value="affaires">Droit des Affaires</option>
                        <option value="fiscal">Droit Fiscal</option>
                        <option value="travail">Droit du Travail</option>
                        <option value="minier">Droit Minier</option>
                        <option value="societes">Droit des Sociétés</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" x-model="selectedLawyer.email" placeholder="avocat@cabinet.cd">
                </div>
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" class="form-input" x-model="selectedLawyer.phone" placeholder="+243 XX XXX XXXX">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Disponibilité</label>
                <select class="form-select">
                    <option value="available">Disponible</option>
                    <option value="busy">Occupé</option>
                    <option value="unavailable">Indisponible</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false; activeModal = null">Annuler</button>
            <button class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
        </div>
    </div>
    
    <!-- VIEW LAWYER MODAL -->
    <div class="modal" :class="{ 'active': activeModal === 'view-lawyer' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-user-tie"></i></div>
                <div>
                    <h3 class="modal-title">Profil Avocat</h3>
                    <p class="modal-subtitle" x-text="selectedLawyer ? selectedLawyer.name : ''"></p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false; activeModal = null"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div class="avatar avatar-xl" style="margin: 0 auto 1rem;" x-text="selectedLawyer ? selectedLawyer.avatar : ''"></div>
                <h4 style="color: var(--white); font-size: 1.25rem;" x-text="selectedLawyer ? selectedLawyer.name : ''"></h4>
                <p style="color: var(--gold-primary);" x-text="selectedLawyer ? 'Spécialité: ' + selectedLawyer.specialty : ''"></p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2rem;">
                <div style="text-align: center; padding: 1rem; background: rgba(212, 175, 55, 0.05); border-radius: 0.5rem;">
                    <h4 style="color: var(--gold-primary); font-size: 1.5rem;" x-text="selectedLawyer ? selectedLawyer.cases : '0'"></h4>
                    <p style="color: var(--gray-500); font-size: 0.75rem;">DOSSiers</p>
                </div>
                <div style="text-align: center; padding: 1rem; background: rgba(34, 197, 94, 0.05); border-radius: 0.5rem;">
                    <h4 style="color: var(--success); font-size: 1.5rem;">87</h4>
                    <p style="color: var(--gray-500); font-size: 0.75rem;">TRAITÉS</p>
                </div>
                <div style="text-align: center; padding: 1rem; background: rgba(59, 130, 246, 0.05); border-radius: 0.5rem;">
                    <h4 style="color: var(--info); font-size: 1.5rem;">5.0</h4>
                    <p style="color: var(--gray-500); font-size: 0.75rem;">NOTE</p>
                </div>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <span style="color: var(--gray-500);">Email</span>
                    <span style="color: var(--white);" x-text="selectedLawyer ? selectedLawyer.email : ''"></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <span style="color: var(--gray-500);">Téléphone</span>
                    <span style="color: var(--white);" x-text="selectedLawyer ? selectedLawyer.phone : ''"></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <span style="color: var(--gray-500);">Statut</span>
                    <span class="badge" :class="selectedLawyer && selectedLawyer.status === 'available' ? 'badge-success' : (selectedLawyer && selectedLawyer.status === 'busy' ? 'badge-warning' : 'badge-danger')" x-text="selectedLawyer ? selectedLawyer.status : ''"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary"><i class="fas fa-calendar"></i> Rendez-vous</button>
            <button class="btn btn-primary" @click="modalOpen = false; activeModal = null">Fermer</button>
        </div>
    </div>
    
    <!-- DELETE LAWYER MODAL -->
    <div class="modal confirm-modal" :class="{ 'active': activeModal === 'delete-lawyer' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div>
                    <h3 class="modal-title">Supprimer l'Avocat</h3>
                    <p class="modal-subtitle">Action irréversible</p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false; activeModal = null"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p>Êtes-vous sûr de vouloir supprimer <strong x-text="selectedLawyer ? selectedLawyer.name : ''"></strong> ?</p>
            <p style="color: var(--gray-500); margin-top: 0.5rem; font-size: 0.875rem;">Cette action désassociera tous les dossiers de cet avocat.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false; activeModal = null">Annuler</button>
            <button class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
        </div>
    </div>
    
</body>
</html>