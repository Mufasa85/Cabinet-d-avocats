<?php

namespace App\models;

class InternshipDocumentModel extends Model
{
    protected string $table = 'internship_documents';

    public function byApplicationId(int $applicationId): array
    {
        $stmt = $this->db()->prepare(
            'SELECT * FROM internship_documents WHERE application_id = :aid ORDER BY type ASC',
            [':aid' => $applicationId]
        );
        return $stmt->fetchAll() ?: [];
    }

    public function create(int $applicationId, string $type, array $fileMeta): int
    {
        $this->db()->prepare(
            'INSERT INTO internship_documents (application_id, type, fichier, taille, mime)
             VALUES (:aid, :type, :fichier, :taille, :mime)',
            [
                ':aid' => $applicationId,
                ':type' => $type,
                ':fichier' => $fileMeta['fichier'],
                ':taille' => $fileMeta['taille'],
                ':mime' => $fileMeta['mime'],
            ]
        );
        return (int) $this->db()->lastInsertId();
    }
}
