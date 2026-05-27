<?php

namespace App\models;

class StagiaireDocumentModel extends Model
{
    protected string $table = 'stagiaire_documents';

    public function byStagiaireId(int $stagiaireId): array
    {
        $stmt = $this->db()->prepare(
            'SELECT sd.*, u.name AS validateur_nom
             FROM stagiaire_documents sd
             LEFT JOIN users u ON u.id = sd.valide_par
             WHERE sd.stagiaire_id = :sid
             ORDER BY sd.created_at DESC',
            [':sid' => $stagiaireId]
        );
        return $stmt->fetchAll() ?: [];
    }

    public function allForAdmin(?string $statut = null): array
    {
        $sql = 'SELECT sd.*, st.user_id, u.name AS stagiaire_nom, u.email AS stagiaire_email
                FROM stagiaire_documents sd
                JOIN stagiaires st ON st.id = sd.stagiaire_id
                JOIN users u ON u.id = st.user_id';
        $params = [];
        if ($statut) {
            $sql .= ' WHERE sd.statut = :statut';
            $params[':statut'] = $statut;
        }
        $sql .= ' ORDER BY sd.created_at DESC';
        return $this->db()->prepare($sql, $params)->fetchAll() ?: [];
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db()->prepare(
            'SELECT sd.*, st.user_id, u.name AS fullname, u.email
             FROM stagiaire_documents sd
             JOIN stagiaires st ON st.id = sd.stagiaire_id
             JOIN users u ON u.id = st.user_id
             WHERE sd.id = :id LIMIT 1',
            [':id' => $id]
        );
        return $stmt->fetch() ?: null;
    }

    public function create(int $stagiaireId, array $data, array $fileMeta): int
    {
        $this->db()->prepare(
            'INSERT INTO stagiaire_documents (stagiaire_id, type, titre, fichier, taille, mime, statut)
             VALUES (:sid, :type, :titre, :fichier, :taille, :mime, :statut)',
            [
                ':sid' => $stagiaireId,
                ':type' => $data['type'] ?? 'autre',
                ':titre' => $data['titre'],
                ':fichier' => $fileMeta['fichier'],
                ':taille' => $fileMeta['taille'],
                ':mime' => $fileMeta['mime'],
                ':statut' => 'en_attente',
            ]
        );
        return (int) $this->db()->lastInsertId();
    }

    public function updateStatus(int $id, string $statut, int $adminId, ?string $motif = null): void
    {
        $this->db()->prepare(
            'UPDATE stagiaire_documents
             SET statut = :statut, motif_rejet = :motif, valide_par = :admin, valide_le = NOW()
             WHERE id = :id',
            [
                ':statut' => $statut,
                ':motif' => $motif,
                ':admin' => $adminId,
                ':id' => $id,
            ]
        );
    }
}
