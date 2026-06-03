<?php

namespace App\models;

class ArticleModel extends Model
{
    protected string $table = 'articles';

    public function published(?string $categorySlug = null): array
    {
        $sql = 'SELECT ar.*, c.nom AS category_nom, c.slug AS category_slug,
                       u.fullname AS avocat_nom
                FROM articles ar
                JOIN avocats av ON av.id = ar.avocat_id
                JOIN users u ON u.id = av.user_id
                LEFT JOIN categories c ON c.id = ar.category_id
                WHERE ar.statut = :statut';
        $params = [':statut' => 'publie'];
        if ($categorySlug) {
            $sql .= ' AND c.slug = :slug';
            $params[':slug'] = $categorySlug;
        }
        $sql .= ' ORDER BY ar.publie_le DESC, ar.created_at DESC';
        return $this->db()->prepare($sql, $params)->fetchAll() ?: [];
    }

    public function byAvocatId(int $avocatId): array
    {
        $stmt = $this->db()->prepare(
            'SELECT ar.*, c.nom AS category_nom
             FROM articles ar
             LEFT JOIN categories c ON c.id = ar.category_id
             WHERE ar.avocat_id = :aid
             ORDER BY ar.updated_at DESC',
            [':aid' => $avocatId]
        );
        return $stmt->fetchAll() ?: [];
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db()->prepare(
            'SELECT ar.*, c.nom AS category_nom, c.slug AS category_slug, u.fullname AS avocat_nom
             FROM articles ar
             JOIN avocats av ON av.id = ar.avocat_id
             JOIN users u ON u.id = av.user_id
             LEFT JOIN categories c ON c.id = ar.category_id
             WHERE ar.slug = :slug LIMIT 1',
            [':slug' => $slug]
        );
        return $stmt->fetch() ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db()->prepare('SELECT * FROM articles WHERE id = :id LIMIT 1', [':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): int
    {
        $slug = $this->uniqueSlug($data['titre'] ?? 'article');
        $statut = $data['statut'] ?? 'brouillon';
        $this->db()->prepare(
            'INSERT INTO articles (avocat_id, category_id, titre, slug, extrait, contenu, image_couverture, pdf_file, statut, publie_le)
             VALUES (:avocat_id, :category_id, :titre, :slug, :extrait, :contenu, :image, :pdf_file, :statut, :publie_le)',
            [
                ':avocat_id' => $data['avocat_id'],
                ':category_id' => $data['category_id'] ?? null,
                ':titre' => $data['titre'],
                ':slug' => $slug,
                ':extrait' => $data['extrait'] ?? null,
                ':contenu' => $data['contenu'],
                ':image' => $data['image_couverture'] ?? null,
                ':pdf_file' => $data['pdf_file'] ?? null,
                ':statut' => $statut,
                ':publie_le' => $statut === 'publie' ? date('Y-m-d H:i:s') : null,
            ]
        );
        return (int) $this->db()->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $article = $this->findById($id);
        if (!$article) {
            return;
        }

        $fields = [];
        $params = [':id' => $id];

        foreach (['titre', 'extrait', 'contenu', 'image_couverture', 'pdf_file', 'statut', 'category_id'] as $col) {
            if (array_key_exists($col, $data)) {
                $fields[] = "{$col} = :{$col}";
                $params[":{$col}"] = $data[$col];
            }
        }

        if (!empty($data['titre'])) {
            $fields[] = 'slug = :slug';
            $params[':slug'] = $this->uniqueSlug($data['titre'], $id);
        }

        if (isset($data['statut'])) {
            if ($data['statut'] === 'publie' && empty($article['publie_le'])) {
                $fields[] = 'publie_le = :publie_le';
                $params[':publie_le'] = date('Y-m-d H:i:s');
            }
        }

        if (empty($fields)) {
            return;
        }

        $this->db()->prepare(
            'UPDATE articles SET ' . implode(', ', $fields) . ' WHERE id = :id',
            $params
        );
    }

    public function delete(int $id): void
    {
        $this->db()->prepare('DELETE FROM articles WHERE id = :id', [':id' => $id]);
    }

    public function countByStatut(string $statut, ?int $avocatId = null): int
    {
        $sql = 'SELECT COUNT(*) AS c FROM articles WHERE statut = :s';
        $params = [':s' => $statut];
        if ($avocatId) {
            $sql .= ' AND avocat_id = :aid';
            $params[':aid'] = $avocatId;
        }
        $row = $this->db()->prepare($sql, $params)->fetch();
        return (int) ($row['c'] ?? 0);
    }

    public function recentByAvocatId(int $avocatId, int $limit = 3): array
    {
        $stmt = $this->db()->prepare(
            "SELECT ar.*, c.nom AS category_nom
             FROM articles ar
             LEFT JOIN categories c ON c.id = ar.category_id
             WHERE ar.avocat_id = :aid
             ORDER BY ar.updated_at DESC
             LIMIT {$limit}",
            [':aid' => $avocatId]
        );
        return $stmt->fetchAll() ?: [];
    }
}
