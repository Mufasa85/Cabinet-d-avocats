<?php
if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$pageTitle = 'Mes Articles';
$currentPage = 'articles';
$publishedCount = 0;
$draftCount = 0;
foreach (($articles ?? []) as $a) {
    if (($a['statut'] ?? '') === 'publie') {
        $publishedCount++;
    } elseif (($a['statut'] ?? '') === 'brouillon') {
        $draftCount++;
    }
}

require dirname(__DIR__) . '/layouts/lawyer/header.php';
?>

<div class="page-header">
    <div class="page-header-content">
        <div>
            <h1 class="page-title">Mes Articles</h1>
            <p class="page-subtitle">Créer, modifier et supprimer vos publications</p>
        </div>
    </div>
</div>

<?php if (!empty($_SESSION['success'])): ?><div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div><?php unset($_SESSION['success']); endif; ?>
<?php if (!empty($_SESSION['error'])): ?><div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div><?php unset($_SESSION['error']); endif; ?>

<div class="stats-grid mb-4">
    <div class="stat-card"><div class="stat-card-content"><h3><?= (int) $publishedCount ?></h3><p>Publiés</p></div></div>
    <div class="stat-card"><div class="stat-card-content"><h3><?= (int) $draftCount ?></h3><p>Brouillons</p></div></div>
    <div class="stat-card"><div class="stat-card-content"><h3><?= count($articles ?? []) ?></h3><p>Total</p></div></div>
</div>

<div class="card mb-4">
    <div class="card-header"><h2 class="card-title">Nouvel article</h2></div>
    <div class="card-body">
        <form method="post" action="<?= Router\Router::route('/lawyers/articles') ?>" enctype="multipart/form-data">
            <?= $csrf ?? '' ?>
            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">Titre</label>
                    <input type="text" class="form-input" name="titre" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Catégorie</label>
                    <select class="form-select" name="category_id">
                        <option value="">Sans catégorie</option>
                        <?php foreach (($categories ?? []) as $c): ?>
                            <option value="<?= (int) $c['id'] ?>"><?= htmlspecialchars($c['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Extrait</label>
                <textarea class="form-textarea" rows="2" name="extrait"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Contenu</label>
                <textarea class="form-textarea" rows="6" name="contenu" required></textarea>
            </div>
            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">Image (optionnel)</label>
                    <input type="file" class="form-input" name="image" accept="image/*">
                </div>
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <select class="form-select" name="statut">
                        <option value="brouillon">Brouillon</option>
                        <option value="publie">Publié</option>
                        <option value="archive">Archivé</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Créer l'article</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header"><h2 class="card-title">Mes articles</h2></div>
    <div class="card-body" style="padding:0;">
        <table class="table">
            <thead><tr><th>Titre</th><th>Catégorie</th><th>Statut</th><th>Date</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach (($articles ?? []) as $a): ?>
                <tr>
                    <td><?= htmlspecialchars($a['titre']) ?></td>
                    <td><?= htmlspecialchars($a['category_nom'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($a['statut']) ?></td>
                    <td><?= !empty($a['updated_at']) ? date('d/m/Y', strtotime($a['updated_at'])) : '—' ?></td>
                    <td>
                        <details>
                            <summary class="btn btn-secondary btn-sm">Modifier</summary>
                            <form method="post" action="<?= Router\Router::route('/lawyers/articles/' . (int) $a['id'] . '/update') ?>" enctype="multipart/form-data" class="mt-2">
                                <?= $csrf ?? '' ?>
                                <input type="text" class="form-input mb-2" name="titre" value="<?= htmlspecialchars($a['titre']) ?>" required>
                                <select class="form-select mb-2" name="category_id">
                                    <option value="">Sans catégorie</option>
                                    <?php foreach (($categories ?? []) as $c): ?>
                                        <option value="<?= (int) $c['id'] ?>" <?= (int) ($a['category_id'] ?? 0) === (int) $c['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($c['nom']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <textarea class="form-textarea mb-2" rows="2" name="extrait"><?= htmlspecialchars($a['extrait'] ?? '') ?></textarea>
                                <textarea class="form-textarea mb-2" rows="4" name="contenu" required><?= htmlspecialchars($a['contenu'] ?? '') ?></textarea>
                                <input type="file" class="form-input mb-2" name="image" accept="image/*">
                                <select class="form-select mb-2" name="statut">
                                    <option value="brouillon" <?= ($a['statut'] ?? '') === 'brouillon' ? 'selected' : '' ?>>Brouillon</option>
                                    <option value="publie" <?= ($a['statut'] ?? '') === 'publie' ? 'selected' : '' ?>>Publié</option>
                                    <option value="archive" <?= ($a['statut'] ?? '') === 'archive' ? 'selected' : '' ?>>Archivé</option>
                                </select>
                                <button class="btn btn-primary btn-sm" type="submit">Enregistrer</button>
                            </form>
                        </details>
                        <form method="post" action="<?= Router\Router::route('/lawyers/articles/' . (int) $a['id'] . '/delete') ?>" style="display:inline;">
                            <?= $csrf ?? '' ?>
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Supprimer cet article ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($articles ?? [])): ?>
                <tr><td colspan="5" style="color:var(--gray-500);">Aucun article.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
<script src="../js/lawyer.js"></script>
</body>
</html>
