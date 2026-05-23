<?php
/**
 * ELMD - Cabinet d'Avocats
 * Lawyer Articles Page
 */



if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$pageTitle = 'Mes Articles';
$currentPage = 'articles';

$lawyerName = $_SESSION['lawyer_name'] ?? 'Me. Laurent Mbako';
$lawyerAvatar = $_SESSION['lawyer_avatar'] ?? 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=100&q=80';

// Articles
$articles = [
    ['id' => 1, 'title' => 'Les nouvelles réglementations OHADA', 'category' => 'Droit des Affaires', 'date' => '15 Jan 2024', 'status' => 'published', 'views' => 245],
    ['id' => 2, 'title' => 'Procédures fiscales en République Démocratique du Congo', 'category' => 'Droit Fiscal', 'date' => '10 Jan 2024', 'status' => 'published', 'views' => 189],
    ['id' => 3, 'title' => 'Guide du droit du travail', 'category' => 'Droit du Travail', 'date' => '5 Jan 2024', 'status' => 'draft', 'views' => 0],
    ['id' => 4, 'title' => 'Les contrats miniers en RDC', 'category' => 'Droit Minier', 'date' => '20 Déc 2023', 'status' => 'published', 'views' => 312],
    ['id' => 5, 'title' => 'La médiation en droit civil', 'category' => 'Droit Civil', 'date' => '15 Déc 2023', 'status' => 'archived', 'views' => 156],
];

require dirname(__DIR__) . '/layouts/lawyer/header.php';
?>

<!-- Page Header -->
<div class="page-header">
    <div class="page-header-content">
        <div>
            <h1 class="page-title">Mes Articles</h1>
            <p class="page-subtitle">Gérez vos publications et articles juridiques</p>
        </div>
        <div class="page-actions">
            <button class="btn btn-primary" data-modal="new-article-modal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Nouvel article
            </button>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="stats-grid mb-4">
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-icon icon-success">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                </svg>
            </div>
        </div>
        <div class="stat-card-content">
            <h3>3</h3>
            <p>Publiés</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-icon icon-warning">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </div>
        </div>
        <div class="stat-card-content">
            <h3>1</h3>
            <p>Brouillons</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-icon icon-info">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
            </div>
        </div>
        <div class="stat-card-content">
            <h3>902</h3>
            <p>Vues totales</p>
        </div>
    </div>
</div>

<!-- Articles List -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="8" y1="6" x2="21" y2="6"/>
                <line x1="8" y1="12" x2="21" y2="12"/>
                <line x1="8" y1="18" x2="21" y2="18"/>
                <line x1="3" y1="6" x2="3.01" y2="6"/>
                <line x1="3" y1="12" x2="3.01" y2="12"/>
                <line x1="3" y1="18" x2="3.01" y2="18"/>
            </svg>
            Tous les articles
        </h2>
        <div class="card-actions">
            <select class="form-select" style="width: auto;">
                <option>Tous</option>
                <option>Publiés</option>
                <option>Brouillons</option>
                <option>Archivés</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Date</th>
                        <th>Vues</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                    <tr>
                        <td>
                            <a href="#" class="text-gold font-semibold"><?= htmlspecialchars($article['title']) ?></a>
                        </td>
                        <td><?= htmlspecialchars($article['category']) ?></td>
                        <td><?= htmlspecialchars($article['date']) ?></td>
                        <td><?= $article['views'] ?></td>
                        <td>
                            <span class="badge <?= $article['status'] === 'published' ? 'badge-success' : ($article['status'] === 'draft' ? 'badge-warning' : 'badge-info') ?>">
                                <?= $article['status'] === 'published' ? 'Publié' : ($article['status'] === 'draft' ? 'Brouillon' : 'Archivé') ?>
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <button class="btn btn-ghost btn-sm" title="Éditer">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <button class="btn btn-ghost btn-sm" title="Aperçu">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                                <button class="btn btn-ghost btn-sm text-danger" title="Supprimer">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- New Article Modal -->
<div class="modal-overlay" id="new-article-modal"></div>
<div class="modal">
    <div class="modal-header">
        <div class="modal-header-content">
            <div class="modal-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="12" y1="18" x2="12" y2="12"/>
                    <line x1="9" y1="15" x2="15" y2="15"/>
                </svg>
            </div>
            <div>
                <h3 class="modal-title">Nouvel Article</h3>
                <p class="modal-subtitle">Créer un nouvel article juridique</p>
            </div>
        </div>
        <button class="modal-close">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>
    <div class="modal-body">
        <form>
            <div class="form-group">
                <label class="form-label">Titre</label>
                <input type="text" class="form-input" placeholder="Titre de l'article">
            </div>
            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">Catégorie</label>
                    <select class="form-select">
                        <option>Droit des Affaires</option>
                        <option>Droit Fiscal</option>
                        <option>Droit du Travail</option>
                        <option>Droit Minier</option>
                        <option>Droit Civil</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <select class="form-select">
                        <option value="draft">Brouillon</option>
                        <option value="published">Publié</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Contenu</label>
                <textarea class="form-textarea" rows="10" placeholder="Contenu de l'article..."></textarea>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" data-modal-close>Annuler</button>
        <button class="btn btn-primary">Publier</button>
    </div>
</div>

</div><!-- End page-content -->

<script src="<?= ELMD_ROOT ?>/lawyer/js/lawyer.js"></script>

</body>
</html>