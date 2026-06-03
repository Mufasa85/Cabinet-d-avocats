<?php

/**
 * ==============================================
 * ADMIN LAWYERS MANAGEMENT
 * Cabinet d'Avocats
 * ==============================================
 */

$pageTitle = 'Gestion des Avocats';

$formattedLawyers = array_map(function ($lawyer) {
    $names = explode(' ', $lawyer['fullname'] ?? '');
    $initials = '';
    foreach (array_slice($names, 0, 2) as $n) {
        $initials .= mb_strtoupper(mb_substr($n, 0, 1));
    }

    $statusMap = [
        1 => 'active',
        0 => 'inactive',
    ];

    return [
        'id' => (int) ($lawyer['avocat_id'] ?? $lawyer['id'] ?? 0),
        'user_id' => (int) $lawyer['user_id'],
        'name' => $lawyer['fullname'] ?? '',
        'email' => $lawyer['email'] ?? '',
        'email_pro' => $lawyer['email_professionnel'] ?? '',
        'telephone' => $lawyer['telephone'] ?? '',
        'avatar' => $initials ?: '??',
        'titre' => $lawyer['titre'] ?? 'Avocat',
        'bio' => $lawyer['bio'] ?? '',
        'experience' => $lawyer['experience'] ?? null,
        'bureau' => $lawyer['bureau'] ?? '',
        'specialites' => $lawyer['specialites'] ?? '',
        'status' => $statusMap[$lawyer['is_active']] ?? 'pending',
        'is_active' => (int) ($lawyer['is_active'] ?? 1),
        'created_at' => $lawyer['created_at'] ?? null,
    ];
}, $lawyers ?? []);

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
                    <input type="text" class="header-search-input" id="headerSearchInput" placeholder="Rechercher un avocat...">
                </div>

                <div class="header-actions">
                    <button class="btn btn-primary" id="addLawyerBtn">
                        <i class="fas fa-plus"></i>
                        Nouvel Avocat
                    </button>
                </div>
            </header>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success" style="margin: 1rem;">
                    <i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-error" style="margin: 1rem;">
                    <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <div class="page-content">
                <div class="filter-bar">
                    <div class="search-input">
                        <i class="fas fa-search"></i>
                        <input type="text" id="filterSearch" placeholder="Rechercher par nom, spécialité...">
                    </div>
                    <select class="filter-select" id="filterStatus">
                        <option value="">Tous les statuts</option>
                        <option value="active">Actif</option>
                        <option value="inactive">Inactif</option>
                    </select>
                </div>

                <div class="card">
                    <div class="card-body" style="padding: 0;">
                        <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Avocat</th>
                                        <th>Titre</th>
                                        <th>Spécialités</th>
                                        <th>Expérience</th>
                                        <th>Bureau</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="lawyers-table-body">
                                    <?php foreach ($formattedLawyers as $lawyer): ?>
                                        <tr data-status="<?= $lawyer['status'] ?>">
                                            <td>
                                                <div class="user-info">
                                                    <div class="avatar"><?= $lawyer['avatar'] ?></div>
                                                    <div class="user-details">
                                                        <h4><?= htmlspecialchars($lawyer['name']) ?></h4>
                                                        <span style="color: var(--gray-500); font-size: 0.75rem;"><?= htmlspecialchars($lawyer['email']) ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= htmlspecialchars($lawyer['titre']) ?></td>
                                            <td>
                                                <span class="specialty-badge">
                                                    <?= htmlspecialchars($lawyer['specialites'] ?: 'Non défini') ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?= $lawyer['experience'] ? $lawyer['experience'] . ' ans' : '-' ?>
                                            </td>
                                            <td><?= htmlspecialchars($lawyer['bureau']) ?: '-' ?></td>
                                            <td>
                                                <span class="badge <?= $lawyer['status'] === 'active' ? 'badge-success' : 'badge-danger' ?>">
                                                    <span class="status-dot <?= $lawyer['status'] === 'active' ? 'success' : 'danger' ?>"></span>
                                                    <?= ucfirst($lawyer['status']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn btn-sm btn-ghost view-lawyer-btn" data-lawyer='<?= json_encode($lawyer) ?>' title="Voir">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-ghost edit-lawyer-btn" data-lawyer='<?= json_encode($lawyer) ?>' title="Modifier">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-ghost delete-lawyer-btn" data-lawyer='<?= json_encode($lawyer) ?>' title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($formattedLawyers)): ?>
                                        <tr>
                                            <td colspan="7" style="text-align: center; padding: 3rem; color: var(--gray-500);">
                                                <i class="fas fa-user-tie" style="font-size: 2rem; opacity: 0.3;"></i>
                                                <p style="margin-top: 1rem;">Aucun avocat enregistré</p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex justify-between items-center">
                            <span style="color: var(--gray-500); font-size: 0.875rem;">
                                <?= count($formattedLawyers) ?> avocat(s) enregistré(s)
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- ADD LAWYER MODAL -->
    <div class="modal modal-lg" id="add-lawyer">
        <form method="POST" action="<?= Router\Router::route('/admin/lawyers') ?>">
            <?= \Core\Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon"><i class="fas fa-user-tie"></i></div>
                    <div>
                        <h3 class="modal-title">Nouvel Avocat</h3>
                        <p class="modal-subtitle">Créer un profil avocat</p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nom Complet <span class="required">*</span></label>
                        <input type="text" name="fullname" class="form-input" placeholder="Entrez le nom complet" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email <span class="required">*</span></label>
                        <input type="email" name="email" class="form-input" placeholder="email@cabinet.com" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" name="telephone" class="form-input" placeholder="+243 XX XXX XXXX">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Titre / Fonction</label>
                        <input type="text" name="titre" class="form-input" placeholder="Ex: Avocat Principal" value="Avocat">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Années d'expérience</label>
                        <input type="number" name="experience" class="form-input" placeholder="Ex: 10" min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Bureau</label>
                        <input type="text" name="bureau" class="form-input" placeholder="Ex: Kinshasa - Gombe">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Spécialités</label>
                    <select name="specialites[]" class="form-select" multiple style="height: 120px;">
                        <option value="1">Droit des Affaires</option>
                        <option value="2">Droit du Travail</option>
                        <option value="3">Droit Fiscal</option>
                        <option value="4">Droit Minier</option>
                        <option value="5">Droit OHADA</option>
                    </select>
                    <small style="color: var(--gray-500);">Maintenez Ctrl/Cmd pour sélectionner plusieurs spécialités</small>
                </div>
                <div class="form-group">
                    <label class="form-label">Biographie</label>
                    <textarea name="bio" class="form-input" rows="4" placeholder="Courte présentation professionnelle..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Mot de passe initial</label>
                    <input type="password" name="password" class="form-input" placeholder="Minimum 8 caractères" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Créer l'Avocat</button>
            </div>
        </form>
    </div>

    <!-- EDIT LAWYER MODAL -->
    <div class="modal modal-lg" id="edit-lawyer">
        <form method="POST" id="editLawyerForm">
            <?= \Core\Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon"><i class="fas fa-user-edit"></i></div>
                    <div>
                        <h3 class="modal-title">Modifier l'Avocat</h3>
                        <p class="modal-subtitle" id="editLawyerName"></p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_id" id="editUserId">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nom Complet</label>
                        <input type="text" name="fullname" id="editFullname" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Titre / Fonction</label>
                        <input type="text" name="titre" id="editTitre" class="form-input">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Email Professionnel</label>
                        <input type="email" name="email_professionnel" id="editEmailPro" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" name="telephone" id="editTelephone" class="form-input">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Années d'expérience</label>
                        <input type="number" name="experience" id="editExperience" class="form-input" min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Bureau</label>
                        <input type="text" name="bureau" id="editBureau" class="form-input">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Spécialités</label>
                    <select name="specialites[]" id="editSpecialites" class="form-select" multiple style="height: 120px;">
                        <option value="1">Droit des Affaires</option>
                        <option value="2">Droit du Travail</option>
                        <option value="3">Droit Fiscal</option>
                        <option value="4">Droit Minier</option>
                        <option value="5">Droit OHADA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Biographie</label>
                    <textarea name="bio" id="editBio" class="form-input" rows="4"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
            </div>
        </form>
    </div>

    <!-- VIEW LAWYER MODAL -->
    <div class="modal" id="view-lawyer">
        <div class="modal-header">
            <div class="modal-header-content">
                <div class="modal-icon"><i class="fas fa-user-tie"></i></div>
                <div>
                    <h3 class="modal-title">Overview - Avocat</h3>
                    <p class="modal-subtitle" id="viewLawyerName"></p>
                </div>
            </div>
            <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <div class="avatar avatar-xl" id="viewAvatar" style="margin: 0 auto 1rem; width: 100px; height: 100px; font-size: 2rem; background: linear-gradient(135deg, #d4af37, #b8860b); display: flex; align-items: center; justify-content: center;"></div>
                <h3 style="color: var(--white); font-size: 1.5rem;" id="viewName"></h3>
                <p style="color: var(--gold-primary); font-size: 1.1rem; font-weight: 600;" id="viewTitre"></p>
                <div style="margin-top: 0.5rem;">
                    <span class="badge badge-success" id="viewStatusBadge" style="font-size: 0.875rem;">
                        <span class="status-dot success"></span>
                        <span id="viewStatusText">Actif</span>
                    </span>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="info-card">
                    <div class="info-icon"><i class="fas fa-envelope"></i></div>
                    <div class="info-content">
                        <span class="info-label">Email</span>
                        <span class="info-value" id="viewEmail">-</span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-icon"><i class="fas fa-phone"></i></div>
                    <div class="info-content">
                        <span class="info-label">Téléphone</span>
                        <span class="info-value" id="viewTelephone">-</span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-icon"><i class="fas fa-briefcase"></i></div>
                    <div class="info-content">
                        <span class="info-label">Expérience</span>
                        <span class="info-value" id="viewExperience">-</span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-icon"><i class="fas fa-building"></i></div>
                    <div class="info-content">
                        <span class="info-label">Bureau</span>
                        <span class="info-value" id="viewBureau">-</span>
                    </div>
                </div>
            </div>

            <div style="margin-top: 1.5rem;">
                <h4 style="color: var(--gold-primary); margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-tags"></i> Spécialités
                </h4>
                <div style="padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 0.5rem;">
                    <span style="color: var(--gray-300);" id="viewSpecialites">Aucune spécialité définie</span>
                </div>
            </div>

            <div style="margin-top: 1.5rem;">
                <h4 style="color: var(--gold-primary); margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-file-alt"></i> Biographie
                </h4>
                <div style="padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 0.5rem; min-height: 80px;">
                    <p style="color: var(--gray-300); line-height: 1.6;" id="viewBio">Aucune biographie disponible</p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Fermer</button>
            <button type="button" class="btn btn-primary" id="viewEditBtn"><i class="fas fa-edit"></i> Modifier</button>
        </div>
    </div>

    <!-- DELETE LAWYER MODAL -->
    <div class="modal confirm-modal" id="delete-lawyer">
        <form method="POST" id="deleteLawyerForm">
            <?= \Core\Security::csrf_tokken() ?>
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-icon" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;"><i class="fas fa-exclamation-triangle"></i></div>
                    <div>
                        <h3 class="modal-title">Supprimer l'Avocat</h3>
                        <p class="modal-subtitle">Cette action est irréversible</p>
                    </div>
                </div>
                <button type="button" class="modal-close" onclick="closeAllModals()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <p style="color: var(--gray-300);">Êtes-vous sûr de vouloir supprimer l'avocat <strong style="color: var(--white);" id="deleteLawyerName"></strong> ?</p>
                <p style="color: var(--gray-500); margin-top: 0.75rem; font-size: 0.875rem;">Cette action supprimera définitivement le compte utilisateur et toutes les données associées.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAllModals()">Annuler</button>
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
            </div>
        </form>
    </div>

    <style>
        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-buttons .btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .action-buttons .btn i {
            font-size: 16px;
        }

        .action-buttons .btn:first-child {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.3);
        }

        .action-buttons .btn:first-child i {
            color: #60a5fa;
        }

        .action-buttons .btn:first-child:hover {
            background: rgba(59, 130, 246, 0.25);
            transform: scale(1.05);
        }

        .action-buttons .btn:nth-child(2) {
            background: rgba(212, 175, 55, 0.1);
            border-color: rgba(212, 175, 55, 0.3);
        }

        .action-buttons .btn:nth-child(2) i {
            color: #d4af37;
        }

        .action-buttons .btn:nth-child(2):hover {
            background: rgba(212, 175, 55, 0.25);
            transform: scale(1.05);
        }

        .action-buttons .btn:last-child {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
        }

        .action-buttons .btn:last-child i {
            color: #f87171;
        }

        .action-buttons .btn:last-child:hover {
            background: rgba(239, 68, 68, 0.25);
            transform: scale(1.05);
        }

        .confirm-modal {
            max-width: 450px;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background: #dc2626;
        }
    </style>

    <script src="../js/dash_admin.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentLawyer = null;

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
                document.querySelectorAll('.modal.active').forEach(function(modal) {
                    modal.classList.remove('active');
                });
                document.getElementById('modalOverlay').classList.remove('active');
                document.body.style.overflow = '';
            };

            // Add lawyer button
            document.getElementById('addLawyerBtn').addEventListener('click', function() {
                openModal('add-lawyer');
            });

            // View lawyer
            document.querySelectorAll('.view-lawyer-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentLawyer = JSON.parse(this.dataset.lawyer);
                    document.getElementById('viewAvatar').textContent = currentLawyer.avatar;
                    document.getElementById('viewName').textContent = currentLawyer.name;
                    document.getElementById('viewLawyerName').textContent = currentLawyer.name;
                    document.getElementById('viewTitre').textContent = currentLawyer.titre;
                    document.getElementById('viewEmail').textContent = currentLawyer.email || '-';
                    document.getElementById('viewTelephone').textContent = currentLawyer.telephone || '-';
                    document.getElementById('viewExperience').textContent = currentLawyer.experience ? currentLawyer.experience + ' ans' : 'Non renseignée';
                    document.getElementById('viewBureau').textContent = currentLawyer.bureau || '-';
                    document.getElementById('viewSpecialites').textContent = currentLawyer.specialites || 'Aucune spécialité définie';
                    document.getElementById('viewBio').textContent = currentLawyer.bio || 'Aucune biographie disponible';

                    const statusBadge = document.getElementById('viewStatusBadge');
                    const statusText = document.getElementById('viewStatusText');
                    if (currentLawyer.status === 'active') {
                        statusBadge.className = 'badge badge-success';
                        statusText.textContent = 'Actif';
                    } else {
                        statusBadge.className = 'badge badge-danger';
                        statusText.textContent = 'Inactif';
                    }

                    document.getElementById('viewEditBtn').dataset.lawyer = this.dataset.lawyer;
                    openModal('view-lawyer');
                });
            });

            // Edit lawyer
            document.querySelectorAll('.edit-lawyer-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentLawyer = JSON.parse(this.dataset.lawyer);
                    document.getElementById('editUserId').value = currentLawyer.user_id;
                    document.getElementById('editLawyerName').textContent = currentLawyer.name;
                    document.getElementById('editFullname').value = currentLawyer.name;
                    document.getElementById('editTitre').value = currentLawyer.titre;
                    document.getElementById('editEmailPro').value = currentLawyer.email_pro || '';
                    document.getElementById('editTelephone').value = currentLawyer.telephone || '';
                    document.getElementById('editExperience').value = currentLawyer.experience || '';
                    document.getElementById('editBureau').value = currentLawyer.bureau || '';
                    document.getElementById('editBio').value = currentLawyer.bio || '';
                    document.getElementById('editLawyerForm').action = '<?= Router\Router::route('/admin/lawyers') ?>/' + currentLawyer.id + '/update';
                    openModal('edit-lawyer');
                });
            });

            // Delete lawyer
            document.querySelectorAll('.delete-lawyer-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    currentLawyer = JSON.parse(this.dataset.lawyer);
                    document.getElementById('deleteLawyerName').textContent = currentLawyer.name;
                    document.getElementById('deleteLawyerForm').action = '<?= Router\Router::route('/admin/lawyers') ?>/' + currentLawyer.id + '/delete';
                    openModal('delete-lawyer');
                });
            });

            // View edit button
            document.getElementById('viewEditBtn').addEventListener('click', function() {
                if (currentLawyer) {
                    closeAllModals();
                    setTimeout(function() {
                        document.getElementById('editUserId').value = currentLawyer.user_id;
                        document.getElementById('editLawyerName').textContent = currentLawyer.name;
                        document.getElementById('editFullname').value = currentLawyer.name;
                        document.getElementById('editTitre').value = currentLawyer.titre;
                        document.getElementById('editEmailPro').value = currentLawyer.email_pro || '';
                        document.getElementById('editTelephone').value = currentLawyer.telephone || '';
                        document.getElementById('editExperience').value = currentLawyer.experience || '';
                        document.getElementById('editBureau').value = currentLawyer.bureau || '';
                        document.getElementById('editBio').value = currentLawyer.bio || '';
                        document.getElementById('editLawyerForm').action = '<?= Router\Router::route('/admin/lawyers') ?>/' + currentLawyer.id + '/update';
                        openModal('edit-lawyer');
                    }, 100);
                }
            });

            // Filter functions
            function filterLawyers() {
                const query = document.getElementById('filterSearch')?.value?.toLowerCase() || '';
                const status = document.getElementById('filterStatus')?.value || '';
                const rows = document.querySelectorAll('#lawyers-table-body tr[data-status]');

                rows.forEach(function(row) {
                    const name = row.querySelector('h4')?.textContent?.toLowerCase() || '';
                    const specialties = row.querySelector('.specialty-badge')?.textContent?.toLowerCase() || '';
                    const rowStatus = row.dataset.status || '';

                    const matchesSearch = !query || name.includes(query) || specialties.includes(query);
                    const matchesStatus = !status || rowStatus === status;

                    row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
                });
            }

            document.getElementById('filterSearch')?.addEventListener('input', filterLawyers);
            document.getElementById('filterStatus')?.addEventListener('change', filterLawyers);
            document.getElementById('headerSearchInput')?.addEventListener('input', function() {
                document.getElementById('filterSearch').value = this.value;
                filterLawyers();
            });

            // Close on escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeAllModals();
            });

            // Overlay click to close
            document.getElementById('modalOverlay')?.addEventListener('click', closeAllModals);
        });
    </script>

</body>

</html>