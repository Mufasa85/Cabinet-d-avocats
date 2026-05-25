<?php

namespace App\models;

use Container\Dic;
use Helper\Build\Database;

abstract class Model
{
    protected string $table = '';

    protected function db(): Database
    {
        return Dic::get(Database::class);
    }

    protected function slugify(string $text): string
    {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text) ?: $text;
        $text = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $text) ?? '');
        return trim($text, '-') ?: 'item-' . bin2hex(random_bytes(4));
    }

    protected function uniqueSlug(string $base, ?int $excludeId = null): string
    {
        $slug = $this->slugify($base);
        $candidate = $slug;
        $n = 1;
        while ($this->slugExists($candidate, $excludeId)) {
            $candidate = $slug . '-' . $n++;
        }
        return $candidate;
    }

    protected function slugExists(string $slug, ?int $excludeId): bool
    {
        $sql = "SELECT id FROM {$this->table} WHERE slug = :slug";
        $params = [':slug' => $slug];
        if ($excludeId) {
            $sql .= ' AND id != :id';
            $params[':id'] = $excludeId;
        }
        $sql .= ' LIMIT 1';
        return (bool) $this->db()->prepare($sql, $params)->fetch();
    }
}
