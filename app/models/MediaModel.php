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
}
