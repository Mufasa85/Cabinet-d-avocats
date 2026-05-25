<?php

namespace App\models;

class CategoryModel extends Model
{
    protected string $table = 'categories';

    public function all(): array
    {
        return $this->db()->prepare('SELECT * FROM categories ORDER BY nom ASC')->fetchAll() ?: [];
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db()->prepare('SELECT * FROM categories WHERE slug = :slug LIMIT 1', [':slug' => $slug]);
        return $stmt->fetch() ?: null;
    }
}
