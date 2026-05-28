<?php

namespace App\models;

class InscriptionModel extends Model
{
    protected string $table = 'inscriptions';

    public function byUserId(int $userId): array
    {
        $stmt = $this->db()->prepare(
            'SELECT i.*, f.titre AS formation_titre, f.date_debut, f.date_fin, f.lieu
             FROM inscriptions i
             JOIN formations f ON f.id = i.formation_id
             WHERE i.user_id = :uid
             ORDER BY i.created_at DESC',
            [':uid' => $userId]
        );
        return $stmt->fetchAll() ?: [];
    }

    public function byFormationId(int $formationId): array
    {
        $stmt = $this->db()->prepare(
            'SELECT i.*, u.fullname, u.email, u.roles
             FROM inscriptions i
             JOIN users u ON u.id = i.user_id
             WHERE i.formation_id = :fid
             ORDER BY i.created_at DESC',
            [':fid' => $formationId]
        );
        return $stmt->fetchAll() ?: [];
    }

    public function pending(): array
    {
        $stmt = $this->db()->prepare(
            "SELECT i.*, f.titre AS formation_titre, u.fullname, u.email
             FROM inscriptions i
             JOIN formations f ON f.id = i.formation_id
             JOIN users u ON u.id = i.user_id
             WHERE i.statut = 'en_attente'
             ORDER BY i.created_at ASC"
        );
        return $stmt->fetchAll() ?: [];
    }

    public function create(int $formationId, int $userId, ?string $message = null, string $statut = 'en_attente'): int
    {
        $this->db()->prepare(
            'INSERT INTO inscriptions (formation_id, user_id, message, statut)
             VALUES (:fid, :uid, :message, :statut)',
            [
                ':fid' => $formationId,
                ':uid' => $userId,
                ':message' => $message,
                ':statut' => $statut,
            ]
        );
        return (int) $this->db()->lastInsertId();
    }

    public function updateStatus(int $id, string $statut, ?string $motif = null): void
    {
        $inscription = $this->findById($id);
        if (!$inscription) {
            return;
        }

        $this->db()->prepare(
            'UPDATE inscriptions SET statut = :statut, motif_rejet = :motif WHERE id = :id',
            [':statut' => $statut, ':motif' => $motif, ':id' => $id]
        );

        if ($statut === 'acceptee' && $inscription['statut'] !== 'acceptee') {
            $this->db()->prepare(
                'UPDATE formations SET places_reservees = places_reservees + 1 WHERE id = :fid',
                [':fid' => $inscription['formation_id']]
            );
        } elseif ($inscription['statut'] === 'acceptee' && in_array($statut, ['refusee', 'annulee'], true)) {
            $this->db()->prepare(
                'UPDATE formations SET places_reservees = GREATEST(places_reservees - 1, 0) WHERE id = :fid',
                [':fid' => $inscription['formation_id']]
            );
        }
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db()->prepare('SELECT * FROM inscriptions WHERE id = :id LIMIT 1', [':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function exists(int $formationId, int $userId): bool
    {
        $row = $this->db()->prepare(
            'SELECT id FROM inscriptions WHERE formation_id = :fid AND user_id = :uid LIMIT 1',
            [':fid' => $formationId, ':uid' => $userId]
        )->fetch();
        return (bool) $row;
    }

    public function countPending(): int
    {
        $row = $this->db()->prepare("SELECT COUNT(*) AS c FROM inscriptions WHERE statut = 'en_attente'")->fetch();
        return (int) ($row['c'] ?? 0);
    }
}
