<?php

namespace App\models;

class FormationModel extends Model
{
    protected string $table = 'formations';

    public function all(?string $public = null): array
    {
        $sql = 'SELECT * FROM formations WHERE statut = :archive';
        $params = [':archive' => 'ouverte'];
        if ($public) {
            $sql .= " AND (public_cible = :pub OR public_cible = 'tous')";
            $params[':pub'] = $public;
        }
        $sql .= ' ORDER BY date_debut ASC, titre ASC';
        return $this->db()->prepare($sql, $params)->fetchAll() ?: [];
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db()->prepare('SELECT * FROM formations WHERE id = :id LIMIT 1', [':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): int
    {
        $slug = $this->uniqueSlug($data['titre'] ?? 'formation');
        $dateDebut = isset($data['date_debut']) && $data['date_debut'] !== '' ? $data['date_debut'] : null;
        $dateFin = isset($data['date_fin']) && $data['date_fin'] !== '' ? $data['date_fin'] : null;

        $this->db()->prepare(
            'INSERT INTO formations (titre, slug, description, contenu, date_debut, date_fin, lieu, places_max, public_cible, statut)
             VALUES (:titre, :slug, :description, :contenu, :date_debut, :date_fin, :lieu, :places_max, :public, :statut)',
            [
                ':titre' => $data['titre'],
                ':slug' => $slug,
                ':description' => $data['description'] ?? null,
                ':contenu' => $data['contenu'] ?? null,
                ':date_debut' => $dateDebut,
                ':date_fin' => $dateFin,
                ':lieu' => $data['lieu'] ?? null,
                ':places_max' => (int) ($data['places_max'] ?? 20),
                ':public' => $data['public_cible'] ?? 'tous',
                ':statut' => $data['statut'] ?? 'ouverte',
            ]
        );
        return (int) $this->db()->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        if (array_key_exists('date_debut', $data) && $data['date_debut'] === '') {
            $data['date_debut'] = null;
        }
        if (array_key_exists('date_fin', $data) && $data['date_fin'] === '') {
            $data['date_fin'] = null;
        }

        $fields = [];
        $params = [':id' => $id];
        foreach (['titre', 'description', 'contenu', 'image_couverture', 'date_debut', 'date_fin', 'lieu', 'places_max', 'public_cible', 'statut', 'places_reservees'] as $col) {
            if (array_key_exists($col, $data)) {
                $fields[] = "{$col} = :{$col}";
                $params[":{$col}"] = $data[$col];
            }
        }
        if (!empty($data['titre'])) {
            $fields[] = 'slug = :slug';
            $params[':slug'] = $this->uniqueSlug($data['titre'], $id);
        }
        if (empty($fields)) {
            return;
        }
        $this->db()->prepare('UPDATE formations SET ' . implode(', ', $fields) . ' WHERE id = :id', $params);
    }

    public function delete(int $id): void
    {
        $this->db()->prepare('DELETE FROM formations WHERE id = :id', [':id' => $id]);
    }

    public function hasPlaces(int $id): bool
    {
        $f = $this->findById($id);
        if (!$f) {
            return false;
        }
        return (int) $f['places_reservees'] < (int) $f['places_max'];
    }
}
