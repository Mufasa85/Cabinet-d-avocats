<?php

namespace App\models;

class NotificationModel extends Model
{
    protected string $table = 'notifications';

    public function byUserId(int $userId, int $limit = 50): array
    {
        $stmt = $this->db()->prepare(
            "SELECT * FROM notifications WHERE user_id = :uid ORDER BY created_at DESC LIMIT {$limit}",
            [':uid' => $userId]
        );
        return $stmt->fetchAll() ?: [];
    }

    public function unreadCount(int $userId): int
    {
        $row = $this->db()->prepare(
            'SELECT COUNT(*) AS c FROM notifications WHERE user_id = :uid AND est_lu = 0',
            [':uid' => $userId]
        )->fetch();
        return (int) ($row['c'] ?? 0);
    }

    public function create(int $userId, string $type, string $titre, string $message, ?string $lien = null): int
    {
        $this->db()->prepare(
            'INSERT INTO notifications (user_id, type, titre, message, lien) VALUES (:uid, :type, :titre, :message, :lien)',
            [
                ':uid' => $userId,
                ':type' => $type,
                ':titre' => $titre,
                ':message' => $message,
                ':lien' => $lien,
            ]
        );
        return (int) $this->db()->lastInsertId();
    }

    public function markRead(int $id, int $userId): void
    {
        $this->db()->prepare(
            'UPDATE notifications SET est_lu = 1 WHERE id = :id AND user_id = :uid',
            [':id' => $id, ':uid' => $userId]
        );
    }

    public function markAllRead(int $userId): void
    {
        $this->db()->prepare(
            'UPDATE notifications SET est_lu = 1 WHERE user_id = :uid',
            [':uid' => $userId]
        );
    }
}
