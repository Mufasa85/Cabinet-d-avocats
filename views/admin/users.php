<?php
/**
 * ==============================================
 * ADMIN USERS MANAGEMENT
 * Cabinet d'Avocats
 * ==============================================
 */

$pageTitle = 'Gestion des Utilisateurs';
$users = [
    ['id' => 1, 'name' => 'Maître Jean Kabongo', 'email' => 'jean.kabongo@cabinet.cd', 'role' => 'Avocat', 'status' => 'active', 'avatar' => 'JK'],
    ['id' => 2, 'name' => 'Marie Lukoji', 'email' => 'marie.lukoj@cabinet.cd', 'role' => 'Avocat', 'status' => 'active', 'avatar' => 'ML'],
    ['id' => 3, 'name' => 'Pierre Diallo', 'email' => 'pierre.diallo@cabinet.cd', 'role' => 'Admin', 'status' => 'active', 'avatar' => 'PD'],
    ['id' => 4, 'name' => 'Aminata Mwamba', 'email' => 'aminata.mwamba@cabinet.cd', 'role' => 'Secrétaire', 'status' => 'active', 'avatar' => 'AM'],
    ['id' => 5, 'name' => 'Jean Mukamba', 'email' => 'jean.mukamba@gmail.com', 'role' => 'Stagiaire', 'status' => 'pending', 'avatar' => 'JM'],
    ['id' => 6, 'name' => 'Sophie Kasaï', 'email' => 'sophie.kasai@cabinet.cd', 'role' => 'Juriste', 'status' => 'active', 'avatar' => 'SK'],
    ['id' => 7, 'name' => 'Robert Ngalulu', 'email' => 'robert.ngalulu@cabinet.cd', 'role' => 'Avocat', 'status' => 'inactive', 'avatar' => 'RN'],
    ['id' => 8, 'name' => 'Claire Bemba', 'email' => 'claire.bemba@cabinet.cd', 'role' => 'Comptable', 'status' => 'active', 'avatar' => 'CB'],
];

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
<body x-data="{ sidebarOpen: false, modalOpen: false, activeModal: null, selectedUser: null }">
    
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
                
                <div class="header-search">
                    <i class="fas fa-search header-search-icon"></i>
                    <input type="text" class="header-search-input" placeholder="Rechercher un utilisateur...">
                </div>
                
                <div class="header-actions">
                    <button class="btn btn-primary" @click="activeModal = 'add-user'; modalOpen = true">
                        <i class="fas fa-plus"></i>
                        Nouvel Utilisateur
                    </button>
                </div>
            </header>
            
            <div class="page-content">
                <div class="filter-bar">
                    <div class="search-input">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Rechercher par nom, email...">
                    </div>
                    <select class="filter-select">
                        <option value="">Tous les rôles</option>
                        <option value="admin">Administrateur</option>
                        <option value="avocat">Avocat</option>
                        <option value="juriste">Juriste</option>
                        <option value="secretaire">Secrétaire</option>
                        <option value="stagiaire">Stagiaire</option>
                    </select>
                    <select class="filter-select">
                        <option value="">Tous les statuts</option>
                        <option value="active">Actif</option>
                        <option value="pending">En attente</option>
                        <option value="inactive">Inactif</option>
                    </select>
                </div>
                
                <div class="card">
                    <div class="card-body" style="padding: 0;">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Utilisateur</th>
                                        <th>Email</th>
                                        <th>Rôle</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td>
                                            <div class="user-info">
                                                <div class="avatar"><?= $user['avatar'] ?></div>
                                                <div class="user-details">
                                                    <h4><?= htmlspecialchars($user['name']) ?></h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td>
                                            <span class="badge <?= $user['role'] === 'Admin' ? 'badge-gold' : 'badge-info' ?>">
                                                <?= htmlspecialchars($user['role']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge <?= $user['status'] === 'active' ? 'badge-success' : ($user['status'] === 'pending' ? 'badge-warning' : 'badge-danger') ?>">
                                                <span class="status-dot <?= $user['status'] === 'active' ? 'success' : ($user['status'] === 'pending' ? 'warning' : 'danger') ?>"></span>
                                                <?= ucfirst($user['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="flex gap-sm">
                                                <button class="btn btn-sm btn-ghost" @click="selectedUser = <?= htmlspecialchars(json_encode($user)) ?>; activeModal = 'view-user'; modalOpen = true" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-ghost" @click="selectedUser = <?= htmlspecialchars(json_encode($user)) ?>; activeModal = 'edit-user'; modalOpen = true" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-ghost" @click="selectedUser = <?= htmlspecialchars(json_encode($user)) ?>; activeModal = 'delete-user'; modalOpen = true" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex justify-between items-center">
                            <span style="color: var(--gray-500); font-size: 0.875rem;">Affichage des utilisateurs</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <div class="modal-overlay" :class="{ 'active': modalOpen }" @click="modalOpen = false; activeModal = null"></div>
    
    <!-- ADD USER MODAL -->
    <div class="modal" :class="{ 'active': activeModal === 'add-user' && modalOpen }">
        <form method="POST" action="<?= Router\Router::route('/register') ?>">
        <?= \Core\Security::csrf_tokken() ?>
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-user-plus"></i></div>
                <div>
                    <h3 class="modal-title">Nouvel Utilisateur</h3>
                    <p class="modal-subtitle">Créer un nouveau compte utilisateur</p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false; activeModal = null"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nom Complet</label>
                    <input type="text" name="fullname" class="form-input" placeholder="Entrez le nom complet" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" placeholder="exemple@email.com" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" name="telephone" class="form-input" placeholder="+243 XX XXX XXXX">
                </div>
                <div class="form-group">
                    <label class="form-label">Rôle</label>
                    <select name="role" class="form-select">
                        <option value="">Sélectionner un rôle</option>
                        <option value="admin">Administrateur</option>
                        <option value="avocat">Avocat</option>
                        <option value="juriste">Juriste</option>
                        <option value="secretaire">Secrétaire</option>
                        <option value="stagiaire">Stagiaire</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Mot de Passe</label>
                    <input type="password" name="password" class="form-input" placeholder="Minimum 8 caractères" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Confirmer Mot de Passe</label>
                    <input type="password" name="password_confirmation" class="form-input" placeholder="Confirmez le mot de passe" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Statut</label>
                <select name="is_active" class="form-select">
                    <option value="1">Actif</option>
                    <option value="0">En Attente</option>
                    <option value="0">Inactif</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="modalOpen = false; activeModal = null">Annuler</button>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Créer l'Utilisateur</button>
        </div>
        </form>
    </div>
    
    <!-- EDIT USER MODAL -->
    <div class="modal" :class="{ 'active': activeModal === 'edit-user' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-user-edit"></i></div>
                <div>
                    <h3 class="modal-title">Modifier l'Utilisateur</h3>
                    <p class="modal-subtitle" x-text="selectedUser ? selectedUser.name : ''"></p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false; activeModal = null"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nom Complet</label>
                    <input type="text" class="form-input" x-model="selectedUser.name" placeholder="Entrez le nom complet">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" x-model="selectedUser.email" placeholder="exemple@email.com">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" class="form-input" placeholder="+243 XX XXX XXXX">
                </div>
                <div class="form-group">
                    <label class="form-label">Rôle</label>
                    <select class="form-select">
                        <option value="avocat">Avocat</option>
                        <option value="juriste">Juriste</option>
                        <option value="secretaire">Secrétaire</option>
                        <option value="stagiaire">Stagiaire</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Statut</label>
                <select class="form-select">
                    <option value="active">Actif</option>
                    <option value="pending">En Attente</option>
                    <option value="inactive">Inactif</option>
                </select>
            </div>
            <div style="background: rgba(212, 175, 55, 0.05); padding: 1rem; border-radius: 0.5rem; margin-top: 1rem;">
                <h4 style="color: var(--white); font-size: 0.875rem; margin-bottom: 0.5rem;"><i class="fas fa-key" style="margin-right: 0.5rem;"></i> Changer le Mot de Passe</h4>
                <div class="form-row">
                    <div class="form-group" style="margin-bottom: 0;">
                        <input type="password" class="form-input" placeholder="Nouveau mot de passe">
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <input type="password" class="form-input" placeholder="Confirmer">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false; activeModal = null">Annuler</button>
            <button class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
        </div>
    </div>
    
    <!-- VIEW USER MODAL -->
    <div class="modal" :class="{ 'active': activeModal === 'view-user' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-user"></i></div>
                <div>
                    <h3 class="modal-title">Profil Utilisateur</h3>
                    <p class="modal-subtitle" x-text="selectedUser ? selectedUser.name : ''"></p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false; activeModal = null"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div class="avatar avatar-xl" style="margin: 0 auto 1rem;" x-text="selectedUser ? selectedUser.avatar : ''"></div>
                <h4 style="color: var(--white); font-size: 1.25rem;" x-text="selectedUser ? selectedUser.name : ''"></h4>
                <p style="color: var(--gold-primary);" x-text="selectedUser ? 'Rôle: ' + selectedUser.role : ''"></p>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <span style="color: var(--gray-500);">Email</span>
                    <span style="color: var(--white);" x-text="selectedUser ? selectedUser.email : ''"></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <span style="color: var(--gray-500);">Rôle</span>
                    <span style="color: var(--white);" x-text="selectedUser ? selectedUser.role : ''"></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <span style="color: var(--gray-500);">Statut</span>
                    <span style="color: var(--white);" x-text="selectedUser ? selectedUser.status : ''"></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <span style="color: var(--gray-500);">Date d'inscription</span>
                    <span style="color: var(--white);">15 Mars 2024</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <span style="color: var(--gray-500);">Dernière connexion</span>
                    <span style="color: var(--white);">18 Mai 2026, 14:32</span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="activeModal = 'edit-user'">Modifier</button>
            <button class="btn btn-primary" @click="modalOpen = false; activeModal = null">Fermer</button>
        </div>
    </div>
    
    <!-- DELETE USER MODAL -->
    <div class="modal confirm-modal" :class="{ 'active': activeModal === 'delete-user' && modalOpen }">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div>
                    <h3 class="modal-title">Confirmer la Suppression</h3>
                    <p class="modal-subtitle">Cette action est irréversible</p>
                </div>
            </div>
            <button class="modal-close" @click="modalOpen = false; activeModal = null"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p>Êtes-vous sûr de vouloir supprimer l'utilisateur <strong x-text="selectedUser ? selectedUser.name : ''"></strong> ?</p>
            <p style="color: var(--gray-500); margin-top: 0.5rem; font-size: 0.875rem;">Toutes les données associées seront définitivement supprimées.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" @click="modalOpen = false; activeModal = null">Annuler</button>
            <button class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
        </div>
    </div>
    
</body>
</html>