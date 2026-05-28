<?php
if (!defined('ELMD_ROOT')) {
    define('ELMD_ROOT', dirname(__DIR__, 2));
}

$pageTitle = 'Mes Documents';
$currentPage = 'documents';

require dirname(__DIR__) . '/layouts/lawyer/header.php';
?>

<div class="page-header">
    <div class="page-header-content">
        <div>
            <h1 class="page-title">Mes Documents</h1>
            <p class="page-subtitle">Créer, modifier et supprimer vos documents PDF</p>
        </div>
    </div>
</div>

<?php if (!empty($_SESSION['success'])): ?><div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div><?php unset($_SESSION['success']); endif; ?>
<?php if (!empty($_SESSION['error'])): ?><div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div><?php unset($_SESSION['error']); endif; ?>

<div class="card mb-4">
    <div class="card-header"><h2 class="card-title">Nouveau document</h2></div>
    <div class="card-body">
        <form method="post" action="<?= Router\Router::route('/lawyers/documents') ?>" enctype="multipart/form-data">
            <?= $csrf ?? '' ?>
            <div class="form-row form-row-2">
                <div class="form-group">
                    <label class="form-label">Nom du document</label>
                    <input type="text" class="form-input" name="nom" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Fichier PDF</label>
                    <input type="file" class="form-input" name="fichier" accept="application/pdf" required>
                </div>
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="est_public" value="1" checked> Document public</label>
            </div>
            <button class="btn btn-primary" type="submit">Ajouter le document</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header"><h2 class="card-title">Mes documents</h2></div>
    <div class="card-body" style="padding:0;">
        <table class="table">
            <thead><tr><th>Nom</th><th>Taille</th><th>Visibilité</th><th>Date</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach (($documents ?? []) as $d): ?>
                <tr>
                    <td>
                        <a href="<?= \Service\FileStorage::url($d['fichier']) ?>" target="_blank" rel="noopener">
                            <?= htmlspecialchars($d['nom']) ?>
                        </a>
                    </td>
                    <td><?= number_format(((int) ($d['taille'] ?? 0)) / 1024, 0) ?> KB</td>
                    <td><?= (int) ($d['est_public'] ?? 0) === 1 ? 'Public' : 'Privé' ?></td>
                    <td><?= !empty($d['created_at']) ? date('d/m/Y', strtotime($d['created_at'])) : '—' ?></td>
                    <td>
                        <details>
                            <summary class="btn btn-secondary btn-sm">Modifier</summary>
                            <form method="post" action="<?= Router\Router::route('/lawyers/documents/' . (int) $d['id'] . '/update') ?>" class="mt-2">
                                <?= $csrf ?? '' ?>
                                <input type="text" class="form-input mb-2" name="nom" value="<?= htmlspecialchars($d['nom']) ?>" required>
                                <label><input type="checkbox" name="est_public" value="1" <?= (int) ($d['est_public'] ?? 0) === 1 ? 'checked' : '' ?>> Document public</label><br><br>
                                <button class="btn btn-primary btn-sm" type="submit">Enregistrer</button>
                            </form>
                        </details>
                        <form method="post" action="<?= Router\Router::route('/lawyers/documents/' . (int) $d['id'] . '/delete') ?>" style="display:inline;">
                            <?= $csrf ?? '' ?>
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Supprimer ce document ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($documents ?? [])): ?>
                <tr><td colspan="5" style="color:var(--gray-500);">Aucun document.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
<script src="../js/lawyer.js"></script>
</body>
</html>
