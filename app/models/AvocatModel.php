<?php

namespace App\models;

class AvocatModel extends Model
{
    protected string $table = 'avocats';

    public function allWithUser(): array
    {
        $stmt = $this->db()->prepare(
            'SELECT a.*, u.fullname, u.email, u.telephone, u.avatar, u.is_active,
                    GROUP_CONCAT(DISTINCT s.nom ORDER BY s.nom SEPARATOR ", ") AS specialites
             FROM avocats a
             JOIN users u ON u.id = a.user_id
             LEFT JOIN avocat_specialites asp ON asp.avocat_id = a.id
             LEFT JOIN specialites s ON s.id = asp.specialite_id
             GROUP BY a.id
             ORDER BY u.fullname ASC'
        );
        return $stmt->fetchAll() ?: [];
    }

    public function findByUserId(int $userId): ?array
    {
        $stmt = $this->db()->prepare(
            'SELECT a.*, u.fullname, u.email, u.telephone, u.avatar
             FROM avocats a
             JOIN users u ON u.id = a.user_id
             WHERE a.user_id = :uid LIMIT 1',
            [':uid' => $userId]
        );
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db()->prepare(
            'SELECT a.*, u.fullname, u.email, u.telephone
             FROM avocats a
             JOIN users u ON u.id = a.user_id
             WHERE a.id = :id LIMIT 1',
            [':id' => $id]
        );
        return $stmt->fetch() ?: null;
    }

    public function createForUser(int $userId, array $data): int
    {
        $this->db()->prepare(
            'INSERT INTO avocats (user_id, titre, email_professionnel, bio, experience, bureau)
             VALUES (:user_id, :titre, :email_professionnel, :bio, :experience, :bureau)',
            [
                ':user_id' => $userId,
                ':titre' => $data['titre'] ?? 'Avocat',
                ':email_professionnel' => $data['email_professionnel'] ?? null,
                ':bio' => $data['bio'] ?? null,
                ':experience' => $data['experience'] ?? null,
                ':bureau' => $data['bureau'] ?? null,
            ]
        );
        return (int) $this->db()->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $fields = [];
        $params = [':id' => $id];
        foreach (['titre', 'email_professionnel', 'bio', 'experience', 'bureau'] as $col) {
            if (array_key_exists($col, $data)) {
                $fields[] = "{$col} = :{$col}";
                $params[":{$col}"] = $data[$col];
            }
        }
        if (empty($fields)) {
            return;
        }
        $this->db()->prepare(
            'UPDATE avocats SET ' . implode(', ', $fields) . ' WHERE id = :id',
            $params
        );
    }

    public function setSpecialites(int $avocatId, array $specialiteIds): void
    {
        $this->db()->prepare('DELETE FROM avocat_specialites WHERE avocat_id = :id', [':id' => $avocatId]);
        foreach ($specialiteIds as $sid) {
            $this->db()->prepare(
                'INSERT INTO avocat_specialites (avocat_id, specialite_id) VALUES (:a, :s)',
                [':a' => $avocatId, ':s' => (int) $sid]
            );
        }
    }

    public function count(): int
    {
        return (int) ($this->db()->prepare('SELECT COUNT(*) AS c FROM avocats')->fetch()['c'] ?? 0);
    }

    public function delete(int $id): void
    {
        // Supprimer d'abord les specialites associees
        $this->db()->prepare('DELETE FROM avocat_specialites WHERE avocat_id = :id', [':id' => $id]);
        // Puis supprimer l'avocat
        $this->db()->prepare('DELETE FROM avocats WHERE id = :id', [':id' => $id]);
    }
}
