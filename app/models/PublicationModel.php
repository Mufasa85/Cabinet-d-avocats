<?php

namespace App\models;

class PublicationModel extends Model
{
    protected string $table = 'publications';

    public function all(?string $statut = null): array
    {
        $sql = 'SELECT p.*, u.fullname AS auteur_nom FROM publications p LEFT JOIN users u ON u.id = p.cree_par';
        $params = [];
        if ($statut) {
            $sql .= ' WHERE p.statut = :statut';
            $params[':statut'] = $statut;
        }
        $sql .= ' ORDER BY p.created_at DESC';
        return $this->db()->prepare($sql, $params)->fetchAll() ?: [];
    }

    public function published(): array
    {
        return $this->all('publie');
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db()->prepare('SELECT * FROM publications WHERE id = :id LIMIT 1', [':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db()->prepare(
            'SELECT p.*, u.fullname AS auteur_nom 
             FROM publications p 
             LEFT JOIN users u ON u.id = p.cree_par 
             WHERE p.slug = :slug LIMIT 1',
            [':slug' => $slug]
        );
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): int
    {
        $slug = $this->uniqueSlug($data['titre'] ?? 'publication');
        $statut = $data['statut'] ?? 'brouillon';
        $this->db()->prepare(
            'INSERT INTO publications (titre, slug, description, contenu, fichier, type, image_couverture, statut, publie_le, cree_par)
             VALUES (:titre, :slug, :description, :contenu, :fichier, :type, :image, :statut, :publie_le, :cree_par)',
            [
                ':titre' => $data['titre'],
                ':slug' => $slug,
                ':description' => $data['description'] ?? null,
                ':contenu' => $data['contenu'] ?? null,
                ':fichier' => $data['fichier'] ?? null,
                ':type' => $data['type'] ?? 'autre',
                ':image' => $data['image_couverture'] ?? null,
                ':statut' => $statut,
                ':publie_le' => $statut === 'publie' ? date('Y-m-d H:i:s') : null,
                ':cree_par' => $data['cree_par'] ?? null,
            ]
        );
        return (int) $this->db()->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $pub = $this->findById($id);
        if (!$pub) {
            return;
        }
        $fields = [];
        $params = [':id' => $id];
        foreach (['titre', 'description', 'contenu', 'fichier', 'type', 'image_couverture', 'statut'] as $col) {
            if (array_key_exists($col, $data)) {
                $fields[] = "{$col} = :{$col}";
                $params[":{$col}"] = $data[$col];
            }
        }
        if (!empty($data['titre'])) {
            $fields[] = 'slug = :slug';
            $params[':slug'] = $this->uniqueSlug($data['titre'], $id);
        }
        if (($data['statut'] ?? null) === 'publie' && empty($pub['publie_le'])) {
            $fields[] = 'publie_le = :publie_le';
            $params[':publie_le'] = date('Y-m-d H:i:s');
        }
        if (empty($fields)) {
            return;
        }
        $this->db()->prepare('UPDATE publications SET ' . implode(', ', $fields) . ' WHERE id = :id', $params);
    }

    public function delete(int $id): void
    {
        $this->db()->prepare('DELETE FROM publications WHERE id = :id', [':id' => $id]);
    }
}
