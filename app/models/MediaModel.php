<?php

namespace App\models;

class MediaModel extends Model
{
    protected string $table = 'media';

    public function create(array $data): int
    {
        $this->db()->prepare(
            'INSERT INTO media (nom, fichier, mime, taille, type, user_id, article_id, est_public)
             VALUES (:nom, :fichier, :mime, :taille, :type, :user_id, :article_id, :est_public)',
            [
                ':nom' => $data['nom'],
                ':fichier' => $data['fichier'],
                ':mime' => $data['mime'] ?? null,
                ':taille' => $data['taille'] ?? null,
                ':type' => $data['type'],
                ':user_id' => $data['user_id'] ?? null,
                ':article_id' => $data['article_id'] ?? null,
                ':est_public' => isset($data['est_public']) ? (int) $data['est_public'] : 1,
            ]
        );
        return (int) $this->db()->lastInsertId();
    }

    public function byUserId(int $userId, string $type = 'document'): array
    {
        $stmt = $this->db()->prepare(
            'SELECT * FROM media WHERE user_id = :uid AND type = :type ORDER BY created_at DESC',
            [':uid' => $userId, ':type' => $type]
        );
        return $stmt->fetchAll() ?: [];
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db()->prepare('SELECT * FROM media WHERE id = :id LIMIT 1', [':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function update(int $id, array $data): void
    {
        $fields = [];
        $params = [':id' => $id];
        foreach (['nom', 'est_public'] as $col) {
            if (array_key_exists($col, $data)) {
                $fields[] = "{$col} = :{$col}";
                $params[":{$col}"] = $data[$col];
            }
        }

        if (empty($fields)) {
            return;
        }

        $this->db()->prepare('UPDATE media SET ' . implode(', ', $fields) . ' WHERE id = :id', $params);
    }

    public function delete(int $id): void
    {
        $this->db()->prepare('DELETE FROM media WHERE id = :id', [':id' => $id]);
    }
}
