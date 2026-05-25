<?php

namespace App\models;

class SpecialiteModel extends Model
{
    protected string $table = 'specialites';

    public function all(): array
    {
        return $this->db()->prepare('SELECT * FROM specialites ORDER BY nom ASC')->fetchAll() ?: [];
    }
}
