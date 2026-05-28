<?php
// echo "<pre>";
// var_dump($avocat);
// echo "</pre>";
// die;

/**
 * ELMD - Cabinet d'Avocats
 * Lawyer Profile Page
 */



if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$pageTitle = 'Mon Profil';
$currentPage = 'profile';

// Build avatar URL from database or use default
$defaultAvatar = 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=200&q=80';
// Utilise avatar_url (URL complete) si disponible, sinon avatar (chemin relatif), sinon default
$lawyerAvatar = $avocat['avatar_url'] ?? (!empty($avocat['avatar']) ? \Service\FileStorage::url($avocat['avatar']) : $defaultAvatar);
$lawyerName = $avocat['fullname'] ?? 'Me. Laurent Mbako';

// Données avocat
$lawyer = [
    'name' => $avocat['name'] ?? 'Me. Laurent Mbako',
    'email' => $avocat['email_professionnel'] ?? 'laurent.mbako@elmd-law.com',
    'phone' => $avocat['phone'] ?? '+243 81 234 5678',
    'role' => $avocat['titre'] ?? 'Avocat Principal',
    'specialties' => $avocat['specialties'] ?? ['Droit OHADA', 'Droit Fiscal', 'Droit Minier', 'Droit du Travail'],
    'bio' => $avocat['biographie'] ?? 'Avocat avec plus de 15 ans d\'expérience dans les domaines du droit des affaires, droit fiscal et droit minier en République Démocratique du Congo.',
    'location' => 'Kinshasa, RDC',
    'bar' => 'Barreau de Kinshasa',
    'joined' => '2018',
    'cases' => 127,
    'clients' => 85,
    'publications' => 24
];

require dirname(__DIR__) . '/layouts/lawyer/header.php';
?>

<!-- Profile Header -->
<div class="profile-header">
    <div class="profile-avatar">
        <img id="avatar-preview" src="<?= htmlspecialchars($lawyerAvatar) ?>" alt="<?= htmlspecialchars($avocat['fullname'] ?? '') ?>">
        <label class="profile-avatar-edit" for="avatar-upload">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                <circle cx="12" cy="13" r="4" />
            </svg>
        </label>

    </div>
    <div>
        <h1 class="profile-name"><?= htmlspecialchars($avocat['fullname'] ?? '') ?></h1>
        <p class="profile-role"><?= htmlspecialchars($lawyer['role']) ?></p>
        <div class="profile-specialties">
            <?php foreach ($lawyer['specialties'] as $specialty): ?>
                <span class="profile-specialty"><?= htmlspecialchars($specialty) ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Avatar Upload Form -->
<form method="POST" action="<?= \Router\Router::route('/lawyers/avatar') ?>" enctype="multipart/form-data" id="avatar-form" style="display: none;">
    <?= \Core\Security::csrf_tokken() ?>
    <input type="file" name="avatar" id="avatar-upload" accept="image/*" onchange="submitAvatarForm()">
</form>

<!-- Profile Content -->
<div class="content-grid grid-2">

    <!-- Personal Info -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Informations personnelles
            </h2>
        </div>
        <div class="card-body">
            <form method="POST" action="<?= \Router\Router::route('/lawyers/profile/update') ?>">
                <?= \Core\Security::csrf_tokken() ?>
                <div class="form-group">
                    <label class="form-label">Nom complet</label>
                    <input type="text" class="form-input" name="fullname" value="<?= htmlspecialchars($avocat['fullname'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Email professionnel</label>
                    <input type="email" class="form-input" name="email_professionnel" value="<?= htmlspecialchars($avocat['email_professionnel'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" class="form-input" name="telephone" value="<?= htmlspecialchars($avocat['telephone'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Bureau</label>
                    <input type="text" class="form-input" name="bureau" value="<?= htmlspecialchars($avocat['bureau'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Biographie</label>
                    <textarea class="form-textarea" name="bio"><?= htmlspecialchars($avocat['bio'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>

    <!-- Stats & Activity -->
    <div>
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="20" x2="18" y2="10" />
                        <line x1="12" y1="20" x2="12" y2="4" />
                        <line x1="6" y1="20" x2="6" y2="14" />
                    </svg>
                    Statistiques
                </h2>
            </div>
            <div class="card-body">
                <div class="stats-grid" style="grid-template-columns: repeat(3, 1fr);">
                    <div class="stat-card">
                        <div class="stat-card-icon icon-gold">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z" />
                            </svg>
                        </div>
                        <div class="stat-card-content">
                            <h3><?= $lawyer['cases'] ?></h3>
                            <p>Dossiers</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-icon icon-info">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                            </svg>
                        </div>
                        <div class="stat-card-content">
                            <h3><?= $lawyer['clients'] ?></h3>
                            <p>Clients</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-icon icon-success">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg>
                        </div>
                        <div class="stat-card-content">
                            <h3><?= $lawyer['publications'] ?></h3>
                            <p>Publications</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                    Informations professionnelles
                </h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Barreau</label>
                    <input type="text" class="form-input" value="<?= htmlspecialchars($lawyer['bar']) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Années d'expérience</label>
                    <input type="text" class="form-input" value="15 ans">
                </div>
                <div class="form-group">
                    <label class="form-label">Membre depuis</label>
                    <input type="text" class="form-input" value="<?= htmlspecialchars($lawyer['joined']) ?>">
                </div>
            </div>
        </div>
    </div>

</div>

</div><!-- End page-content -->

<script src="../js/lawyer.js"></script>

<script>
    // Submit avatar form when file is selected
    function submitAvatarForm() {
        const form = document.getElementById('avatar-form');
        const input = document.getElementById('avatar-upload');

        if (input.files && input.files[0]) {
            // Preview image before upload
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);

            // Submit form after preview
            setTimeout(function() {
                form.submit();
            }, 500);
        }
    }
</script>

</body>

</html>