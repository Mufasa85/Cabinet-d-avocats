<?php

/**
 * ==============================================
 * ADMIN USERS MANAGEMENT
 * Cabinet d'Avocats
 * ==============================================
 */

$pageTitle = 'Gestion des Utilisateurs';

// Formater les utilisateurs pour la vue (adapter les champs DB)
$formattedUsers = array_map(function ($user) {
    $names = explode(' ', $user['fullname'] ?? '');
    $initials = '';
    foreach (array_slice($names, 0, 2) as $n) {
        $initials .= mb_strtoupper(mb_substr($n, 0, 1));
    }

    $roleLabels = [
        'admin' => 'Admin',
        'avocat' => 'Avocat',
        'stagiaire' => 'Stagiaire',
    ];

    $statusMap = [
        1 => 'active',
        0 => 'inactive',
    ];

    return [
        'id' => (int) $user['id'],
        'name' => $user['fullname'] ?? '',
        'email' => $user['email'] ?? '',
        'role' => $roleLabels[$user['roles']] ?? ucfirst($user['roles'] ?? ''),
        'role_key' => $user['roles'] ?? 'stagiaire',
        'status' => $statusMap[$user['is_active']] ?? 'pending',
        'status_key' => $user['is_active'] ?? 1,
        'avatar' => $initials ?: '??',
        'telephone' => $user['telephone'] ?? '',
        'created_at' => $user['created_at'] ?? null,
    ];
}, $users ?? []);

?>
<!DOCTYPE html>
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
</head>

<body>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <!-- Modal Overlay -->
    <div class="modal-overlay" id="modalOverlay"></div>

    <div class="admin-wrapper">
        <?php require dirname(__DIR__) . '/layouts/admin/sidebar.php'; ?>

        <main class="main-content">
            <header class="admin-header">
                <div class="header-left">
                    <button class="header-toggle" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h1 class="header-title"><?= $pageTitle ?></h1>
                        <nav class="header-breadcrumb">
                            <a href="<?= Router\Router::route('/admin/dashboard') ?>">Accueil</a>
                            <span>/</span>
                            <span><?= $pageTitle ?></span>
                        </nav>
                    </div>
                </div>

                <div class="header-search">
                    <i class="fas fa-search header-search-icon"></i>
                    <input type="text" class="header-search-input" id="searchInput" placeholder="Rechercher un utilisateur...">
                </div>

                <div class="header-actions">
                    <button class="btn btn-primary" id="addUserBtn">
                        <i class="fas fa-plus"></i>
                        Nouvel Utilisateur
                    </button>
                </div>
            </header>

            <div class="page-content">
                <div class="filter-bar">
                    <div class="search-input">
                        <i class="fas fa-search"></i>
                        <input type="text" id="filterSearch" placeholder="Rechercher par nom, email...">
                    </div>
                    <select class="filter-select" id="filterRole">
                        <option value="">Tous les rôles</option>
                        <option value="admin">Administrateur</option>
                        <option value="avocat">Avocat</option>
                        <option value="stagiaire">Stagiaire</option>
                    </select>
                    <select class="filter-select" id="filterStatus">
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
                                    <?php foreach ($formattedUsers as $user): ?>
                                        <tr data-user-id="<?= $user['id'] ?>">
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
                                                    <?= htmlspecialchars($user['status']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="flex gap-sm">
                                                    <button class="btn btn-sm btn-ghost view-user-btn" data-user='<?= json_encode($user) ?>' title="Voir">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-ghost edit-user-btn" data-user='<?= json_encode($user) ?>' title="Modifier">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-ghost delete-user-btn" data-user='<?= json_encode($user) ?>' title="Supprimer">
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
                            <span id="userCount" style="color: var(--gray-500); font-size: 0.875rem;"><?= count($formattedUsers) ?> utilisateur(s)</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- ADD USER MODAL -->
    <div class="modal" id="add-user">
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
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
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
                        <select name="roles" class="form-select">
                            <option value="">Sélectionner un rôle</option>
                            <option value="avocat">Avocat</option>
                            <option value="admin">Administrateur</option>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Créer l'Utilisateur</button>
            </div>
        </form>
    </div>

    <!-- EDIT USER MODAL -->
    <div class="modal" id="edit-user">
        <form method="POST" id="editUserForm">
            <?= \Core\Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon"><i class="fas fa-user-edit"></i></div>
                    <div>
                        <h3 class="modal-title">Modifier l'Utilisateur</h3>
                        <p class="modal-subtitle" id="editUserName"></p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nom Complet</label>
                        <input type="text" name="fullname" id="editFullname" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="editEmail" class="form-input" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" name="telephone" id="editTelephone" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Rôle</label>
                        <select name="roles" id="editRole" class="form-select">
                            <option value="avocat">Avocat</option>
                            <option value="admin">Administrateur</option>
                            <option value="stagiaire">Stagiaire</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <select name="is_active" id="editStatus" class="form-select">
                        <option value="1">Actif</option>
                        <option value="0">Inactif</option>
                    </select>
                </div>
                <div style="background: rgba(212, 175, 55, 0.05); padding: 1rem; border-radius: 0.5rem; margin-top: 1rem;">
                    <h4 style="color: var(--white); font-size: 0.875rem; margin-bottom: 0.5rem;"><i class="fas fa-key" style="margin-right: 0.5rem;"></i> Changer le Mot de Passe</h4>
                    <p style="color: var(--gray-500); font-size: 0.75rem; margin-bottom: 0.5rem;">Laisser vide pour ne pas modifier</p>
                    <div class="form-row">
                        <div class="form-group" style="margin-bottom: 0;">
                            <input type="password" name="password" class="form-input" placeholder="Nouveau mot de passe">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <input type="password" name="password_confirmation" class="form-input" placeholder="Confirmer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>

    <!-- VIEW USER MODAL -->
    <div class="modal" id="view-user">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-user"></i></div>
                <div>
                    <h3 class="modal-title">Profil Utilisateur</h3>
                    <p class="modal-subtitle" id="viewUserName"></p>
                </div>
            </div>
            <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div class="avatar avatar-xl" id="viewAvatar" style="margin: 0 auto 1rem;"></div>
                <h4 style="color: var(--white); font-size: 1.25rem;" id="viewName"></h4>
                <p style="color: var(--gold-primary);" id="viewRole"></p>
            </div>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <span style="color: var(--gray-500);">Email</span>
                    <span style="color: var(--white);" id="viewEmail"></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <span style="color: var(--gray-500);">Téléphone</span>
                    <span style="color: var(--white);" id="viewTelephone"></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <span style="color: var(--gray-500);">Rôle</span>
                    <span style="color: var(--white);" id="viewRoleDetail"></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 0.5rem;">
                    <span style="color: var(--gray-500);">Statut</span>
                    <span style="color: var(--white);" id="viewStatus"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="viewEditBtn">Modifier</button>
            <button type="button" class="btn btn-primary" onclick="closeAllModals()">Fermer</button>
        </div>
    </div>

    <!-- DELETE USER MODAL -->
    <div class="modal confirm-modal" id="delete-user">
        <form method="POST" id="deleteUserForm">
            <?= \Core\Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon"><i class="fas fa-exclamation-triangle"></i></div>
                    <div>
                        <h3 class="modal-title">Confirmer la Suppression</h3>
                        <p class="modal-subtitle">Cette action est irréversible</p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer l'utilisateur <strong id="deleteUserName"></strong> ?</p>
                <p style="color: var(--gray-500); margin-top: 0.5rem; font-size: 0.875rem;">Toutes les données associées seront définitivement supprimées.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
            </div>
        </form>
    </div>

    <!-- Admin Dashboard JavaScript -->
    <script src="../js/dash_admin.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal functions
            window.openModal = function(modalId) {
                const modal = document.getElementById(modalId);
                const overlay = document.getElementById('modalOverlay');
                if (modal && overlay) {
                    modal.classList.add('active');
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            };

            window.closeAllModals = function() {
                document.querySelectorAll('.modal.active').forEach(modal => modal.classList.remove('active'));
                document.getElementById('modalOverlay').classList.remove('active');
                document.body.style.overflow = '';
            };

            // Current user for modals
            let currentUser = null;

            // Open add user modal
            document.getElementById('addUserBtn').addEventListener('click', function() {
                openModal('add-user');
            });

            // View user
            document.querySelectorAll('.view-user-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentUser = JSON.parse(this.dataset.user);
                    document.getElementById('viewAvatar').textContent = currentUser.avatar;
                    document.getElementById('viewName').textContent = currentUser.name;
                    document.getElementById('viewUserName').textContent = currentUser.name;
                    document.getElementById('viewRole').textContent = 'Rôle: ' + currentUser.role;
                    document.getElementById('viewEmail').textContent = currentUser.email;
                    document.getElementById('viewTelephone').textContent = currentUser.telephone || '-';
                    document.getElementById('viewRoleDetail').textContent = currentUser.role;
                    document.getElementById('viewStatus').textContent = currentUser.status;
                    document.getElementById('viewEditBtn').dataset.user = this.dataset.user;
                    openModal('view-user');
                });
            });

            // Edit user
            document.querySelectorAll('.edit-user-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentUser = JSON.parse(this.dataset.user);
                    document.getElementById('editUserName').textContent = currentUser.name;
                    document.getElementById('editFullname').value = currentUser.name;
                    document.getElementById('editEmail').value = currentUser.email;
                    document.getElementById('editTelephone').value = currentUser.telephone || '';
                    document.getElementById('editRole').value = currentUser.role_key;
                    document.getElementById('editStatus').value = currentUser.status_key;
                    document.getElementById('editUserForm').action = '<?= Router\Router::route('/admin/users') ?>/' + currentUser.id + '/update';
                    openModal('edit-user');
                });
            });

            // Delete user
            document.querySelectorAll('.delete-user-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentUser = JSON.parse(this.dataset.user);
                    document.getElementById('deleteUserName').textContent = currentUser.name;
                    document.getElementById('deleteUserForm').action = '<?= Router\Router::route('/admin/users') ?>/' + currentUser.id + '/delete';
                    openModal('delete-user');
                });
            });

            // View edit button
            document.getElementById('viewEditBtn').addEventListener('click', function() {
                if (currentUser) {
                    closeAllModals();
                    setTimeout(function() {
                        document.getElementById('editUserName').textContent = currentUser.name;
                        document.getElementById('editFullname').value = currentUser.name;
                        document.getElementById('editEmail').value = currentUser.email;
                        document.getElementById('editTelephone').value = currentUser.telephone || '';
                        document.getElementById('editRole').value = currentUser.role_key;
                        document.getElementById('editStatus').value = currentUser.status_key;
                        document.getElementById('editUserForm').action = '<?= Router\Router::route('/admin/users') ?>/' + currentUser.id + '/update';
                        openModal('edit-user');
                    }, 100);
                }
            });

            // Filter functions
            function filterUsers() {
                const search = document.getElementById('filterSearch')?.value?.toLowerCase() || '';
                const roleFilter = document.getElementById('filterRole')?.value?.toLowerCase() || '';
                const statusFilter = document.getElementById('filterStatus')?.value?.toLowerCase() || '';

                const rows = document.querySelectorAll('table tbody tr');
                let count = 0;

                rows.forEach(row => {
                    const name = row.querySelector('h4')?.textContent?.toLowerCase() || '';
                    const email = row.querySelector('td:nth-child(2)')?.textContent?.toLowerCase() || '';
                    const badges = row.querySelectorAll('.badge');
                    const role = badges.length > 0 ? badges[0].textContent?.trim()?.toLowerCase() || '' : '';
                    const status = badges.length > 1 ? badges[1].textContent?.trim()?.toLowerCase() || '' : '';

                    const matchSearch = !search || name.includes(search) || email.includes(search);
                    const matchRole = !roleFilter || role.includes(roleFilter);
                    const matchStatus = !statusFilter || status.includes(statusFilter);

                    row.style.display = (matchSearch && matchRole && matchStatus) ? '' : 'none';
                    if (matchSearch && matchRole && matchStatus) count++;
                });

                document.getElementById('userCount').textContent = count + ' utilisateur(s)';
            }

            document.getElementById('filterSearch')?.addEventListener('input', filterUsers);
            document.getElementById('filterRole')?.addEventListener('change', filterUsers);
            document.getElementById('filterStatus')?.addEventListener('change', filterUsers);

            // Close on escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeAllModals();
            });

            // Overlay click to close
            document.getElementById('modalOverlay').addEventListener('click', closeAllModals);
        });
    </script>

</body>

</html>