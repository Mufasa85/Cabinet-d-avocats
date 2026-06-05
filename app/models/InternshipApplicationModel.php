<?php

namespace App\models;

class InternshipApplicationModel extends Model
{
    protected string $table = 'internship_applications';

    public function all(?string $statut = null): array
    {
        $sql = 'SELECT * FROM internship_applications';
        $params = [];
        if ($statut) {
            $sql .= ' WHERE statut = :statut';
            $params[':statut'] = $statut;
        }
        $sql .= ' ORDER BY created_at DESC';
        return $this->db()->prepare($sql, $params)->fetchAll() ?: [];
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db()->prepare('SELECT * FROM internship_applications WHERE id = :id LIMIT 1', [':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): int
    {
        $this->db()->prepare(
            'INSERT INTO internship_applications
             (nom, post_nom, prenom, email, telephone, universite, filiere, niveau_etude, departement_souhaite, motivation, statut)
             VALUES (:nom, :post_nom, :prenom, :email, :telephone, :universite, :filiere, :niveau, :departement, :motivation, :statut)',
            [
                ':nom' => $data['nom'],
                ':post_nom' => $data['post_nom'] ?? null,
                ':prenom' => $data['prenom'] ?? null,
                ':email' => $data['email'],
                ':telephone' => $data['telephone'],
                ':universite' => $data['universite'],
                ':filiere' => $data['filiere'],
                ':niveau' => $data['niveau_etude'],
                ':departement' => $data['departement_souhaite'],
                ':motivation' => $data['motivation'],
                ':statut' => 'en_attente',
            ]
        );
        return (int) $this->db()->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $fields = [];
        $params = [':id' => $id];

        if (isset($data['user_id'])) {
            $fields[] = 'user_id = :user_id';
            $params[':user_id'] = $data['user_id'];
        }
        if (isset($data['stagiaire_id'])) {
            $fields[] = 'stagiaire_id = :stagiaire_id';
            $params[':stagiaire_id'] = $data['stagiaire_id'];
        }
        if (isset($data['statut'])) {
            $fields[] = 'statut = :statut';
            $params[':statut'] = $data['statut'];
        }

        if (!empty($fields)) {
            $this->db()->prepare(
                'UPDATE internship_applications SET ' . implode(', ', $fields) . ' WHERE id = :id',
                $params
            );
        }
    }

    public function updateStatus(int $id, string $statut, ?string $motif = null): void
    {
        $this->db()->prepare(
            'UPDATE internship_applications SET statut = :statut WHERE id = :id',
            [':statut' => $statut, ':id' => $id]
        );
    }

    public function countPending(): int
    {
        $row = $this->db()->prepare(
            "SELECT COUNT(*) AS c FROM internship_applications WHERE statut IN ('en_attente','analyse')"
        )->fetch();
        return (int) ($row['c'] ?? 0);
    }

    public function recent(int $limit = 5): array
    {
        $stmt = $this->db()->prepare(
            "SELECT * FROM internship_applications ORDER BY created_at DESC LIMIT {$limit}"
        );
        return $stmt->fetchAll() ?: [];
    }

    public function delete(int $id): void
    {
        $this->db()->prepare(
            'DELETE FROM internship_applications WHERE id = :id',
            [':id' => $id]
        );
    }
}
