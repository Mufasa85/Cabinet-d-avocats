<?php

namespace App\models;

class StagiaireModel extends Model
{
    protected string $table = 'stagiaires';

    public function findByUserId(int $userId): ?array
    {
        $stmt = $this->db()->prepare(
            'SELECT st.*, u.fullname, u.email
             FROM stagiaires st
             JOIN users u ON u.id = st.user_id
             WHERE st.user_id = :uid LIMIT 1',
            [':uid' => $userId]
        );
        return $stmt->fetch() ?: null;
    }

    public function allWithUser(): array
    {
        $stmt = $this->db()->prepare(
            'SELECT st.*, u.fullname, u.email, u.telephone, u.is_active
             FROM stagiaires st
             JOIN users u ON u.id = st.user_id
             ORDER BY u.fullname ASC'
        );
        return $stmt->fetchAll() ?: [];
    }

    public function create(array $data): int
    {
        $this->db()->prepare(
            'INSERT INTO stagiaires (user_id, application_id, universite, filiere, niveau_etude, departement, date_debut, date_fin, tuteur_avocat_id, statut)
             VALUES (:user_id, :application_id, :universite, :filiere, :niveau, :departement, :date_debut, :date_fin, :tuteur, :statut)',
            [
                ':user_id' => $data['user_id'],
                ':application_id' => $data['application_id'] ?? null,
                ':universite' => $data['universite'] ?? null,
                ':filiere' => $data['filiere'] ?? null,
                ':niveau' => $data['niveau_etude'] ?? null,
                ':departement' => $data['departement'] ?? null,
                ':date_debut' => $data['date_debut'] ?? null,
                ':date_fin' => $data['date_fin'] ?? null,
                ':tuteur' => $data['tuteur_avocat_id'] ?? null,
                ':statut' => $data['statut'] ?? 'actif',
            ]
        );
        return (int) $this->db()->lastInsertId();
    }

    public function count(): int
    {
        return (int) ($this->db()->prepare('SELECT COUNT(*) AS c FROM stagiaires')->fetch()['c'] ?? 0);
    }
}
