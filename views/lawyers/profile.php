<?php
$pageTitle = 'Mon Profil';
$currentPage = 'profile';
$stats = $stats ?? [];
$selectedSpecialites = $selectedSpecialites ?? [];
require dirname(__DIR__) . '/layouts/lawyer/header.php';
?>

<div class="page-header">
    <div class="page-header-content">
        <div>
            <h1 class="page-title">Mon Profil</h1>
            <p class="page-subtitle">Informations personnelles et professionnelles</p>
        </div>
    </div>
</div>

<?php if (!empty($_SESSION['success'])): ?><div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div><?php unset($_SESSION['success']); endif; ?>
<?php if (!empty($_SESSION['error'])): ?><div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div><?php unset($_SESSION['error']); endif; ?>

<div class="content-grid grid-2">
    <div class="card">
        <div class="card-header"><h2 class="card-title">Profil avocat</h2></div>
        <div class="card-body">
            <form method="post" action="<?= Router\Router::route('/lawyers/profile') ?>">
                <?= $csrf ?? '' ?>
                <div class="form-group">
                    <label class="form-label">Nom complet</label>
                    <input type="text" class="form-input" value="<?= htmlspecialchars($avocat['name'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="form-label">Email compte</label>
                    <input type="email" class="form-input" value="<?= htmlspecialchars($avocat['email'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="text" class="form-input" value="<?= htmlspecialchars($avocat['phone'] ?? '') ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="form-label">Titre</label>
                    <input type="text" class="form-input" name="titre" value="<?= htmlspecialchars($avocat['titre'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Email professionnel</label>
                    <input type="email" class="form-input" name="email_professionnel" value="<?= htmlspecialchars($avocat['email_professionnel'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Bureau</label>
                    <input type="text" class="form-input" name="bureau" value="<?= htmlspecialchars($avocat['bureau'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Expérience (années)</label>
                    <input type="number" class="form-input" name="experience" min="0" value="<?= (int) ($avocat['experience'] ?? 0) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Spécialités</label>
                    <select class="form-select" name="specialites[]" multiple>
                        <?php foreach (($specialites ?? []) as $s): ?>
                            <option value="<?= (int) ($s['id'] ?? 0) ?>" <?= in_array((int) ($s['id'] ?? 0), $selectedSpecialites, true) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($s['nom'] ?? '') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Bio</label>
                    <textarea class="form-textarea" name="bio" rows="5"><?= htmlspecialchars($avocat['bio'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h2 class="card-title">Statistiques</h2></div>
        <div class="card-body">
            <div class="stats-grid" style="grid-template-columns: repeat(2, 1fr);">
                <div class="stat-card"><div class="stat-card-content"><h3><?= (int) ($stats['articles'] ?? 0) ?></h3><p>Articles</p></div></div>
                <div class="stat-card"><div class="stat-card-content"><h3><?= (int) ($stats['published'] ?? 0) ?></h3><p>Publiés</p></div></div>
                <div class="stat-card"><div class="stat-card-content"><h3><?= (int) ($stats['draft'] ?? 0) ?></h3><p>Brouillons</p></div></div>
                <div class="stat-card"><div class="stat-card-content"><h3><?= (int) ($stats['documents'] ?? 0) ?></h3><p>Documents</p></div></div>
            </div>
        </div>
    </div>
</div>

</div>
<script src="../js/lawyer.js"></script>
</body>
</html>
<?php

$pageTitle = 'Mon Profil';
$currentPage = 'profile';

$lawyerName = $avocat['name'] ?? 'Me. Laurent Mbako';
$lawyerAvatar = $avocat['lawyer_avatar'] ?? 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=200&q=80';

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
        <img src="<?= htmlspecialchars($lawyerAvatar) ?>" alt="<?= htmlspecialchars($lawyer['name']) ?>">
        <label class="profile-avatar-edit" for="avatar-upload">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                <circle cx="12" cy="13" r="4"/>
            </svg>
        </label>
        <input type="file" id="avatar-upload" hidden accept="image/*">
    </div>
    <div>
        <h1 class="profile-name"><?= htmlspecialchars($lawyer['name']) ?></h1>
        <p class="profile-role"><?= htmlspecialchars($lawyer['role']) ?></p>
        <div class="profile-specialties">
            <?php foreach ($lawyer['specialties'] as $specialty): ?>
            <span class="profile-specialty"><?= htmlspecialchars($specialty) ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Profile Content -->
<div class="content-grid grid-2">
    
    <!-- Personal Info -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Informations personnelles
            </h2>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label class="form-label">Nom complet</label>
                    <input type="text" class="form-input" value="<?= htmlspecialchars($lawyer['name']) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" value="<?= htmlspecialchars($lawyer['email']) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="tel" class="form-input" value="<?= htmlspecialchars($lawyer['phone']) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Localisation</label>
                    <input type="text" class="form-input" value="<?= htmlspecialchars($lawyer['location']) ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Biographie</label>
                    <textarea class="form-textarea"><?= htmlspecialchars($lawyer['bio']) ?></textarea>
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
                        <line x1="18" y1="20" x2="18" y2="10"/>
                        <line x1="12" y1="20" x2="12" y2="4"/>
                        <line x1="6" y1="20" x2="6" y2="14"/>
                    </svg>
                    Statistiques
                </h2>
            </div>
            <div class="card-body">
                <div class="stats-grid" style="grid-template-columns: repeat(3, 1fr);">
                    <div class="stat-card">
                        <div class="stat-card-icon icon-gold">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
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
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
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
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
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
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
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

</body>
</html>