<?php

namespace App\models;

use Container\Dic;
use Helper\Build\Database;

class UserModel extends Model
{
    protected string $table = 'users';

    public function all(): array
    {
        $stmt = Dic::get(Database::class)->prepare(
            'SELECT * FROM users ORDER BY fullname ASC'
        );
        return $stmt->fetchAll() ?: [];
    }

    public function findById(int $id): ?array
    {
        $stmt = Dic::get(Database::class)->prepare(
            'SELECT id, fullname, email, roles, telephone, avatar, is_active, created_at FROM users WHERE id = :id LIMIT 1',
            [':id' => $id]
        );
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function findAuthById(int $id): ?array
    {
        $stmt = Dic::get(Database::class)->prepare(
            'SELECT id, fullname, email, roles, telephone, avatar, is_active, passwords FROM users WHERE id = :id LIMIT 1',
            [':id' => $id]
        );
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = Dic::get(Database::class)->prepare(
            'SELECT id FROM users WHERE email = :email LIMIT 1',
            [':email' => $email]
        );
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $sql = 'INSERT INTO users (fullname, email, passwords, roles, telephone, avatar, is_active) VALUES (:fullname, :email, :passwords, :roles, :telephone, :avatar, :is_active)';
        $params = [
            ':fullname' => $data['fullname'] ?? $data['name'] ?? null,
            ':email' => $data['email'] ?? null,
            ':passwords' => isset($data['password']) ? password_hash($data['password'], PASSWORD_BCRYPT) : null,
            ':roles' => $data['roles'] ?? $data['role'] ?? 'stagiaire',
            ':telephone' => $data['telephone'] ?? null,
            ':avatar' => $data['avatar'] ?? null,
            ':is_active' => isset($data['is_active']) ? (int) $data['is_active'] : (isset($data['status']) ? (int) $data['status'] : 1),
        ];

        Dic::get(Database::class)->prepare($sql, $params);
        return (int) Dic::get(Database::class)->lastInsertId();
    }

    public function update(int $id, array $data)
    {
        $fields = [];
        $params = [':id' => $id];

        if (isset($data['fullname'])) {
            $fields[] = 'fullname = :fullname';
            $params[':fullname'] = $data['fullname'];
        }
        if (isset($data['email'])) {
            $fields[] = 'email = :email';
            $params[':email'] = $data['email'];
        }
        if (!empty($data['password'])) {
            $fields[] = 'passwords = :passwords';
            $params[':passwords'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        if (isset($data['roles'])) {
            $fields[] = 'roles = :roles';
            $params[':roles'] = $data['roles'];
        } elseif (isset($data['role'])) {
            $fields[] = 'roles = :roles';
            $params[':roles'] = $data['role'];
        }
        if (array_key_exists('telephone', $data)) {
            $fields[] = 'telephone = :telephone';
            $params[':telephone'] = $data['telephone'];
        }
        if (array_key_exists('avatar', $data)) {
            $fields[] = 'avatar = :avatar';
            $params[':avatar'] = $data['avatar'];
        }
        if (isset($data['is_active'])) {
            $fields[] = 'is_active = :is_active';
            $params[':is_active'] = (int) $data['is_active'];
        }

        if (empty($fields)) {
            return null;
        }

        $sql = 'UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = :id';
        return Dic::get(Database::class)->prepare($sql, $params);
    }

    public function delete(int $id): void
    {
        Dic::get(Database::class)->prepare(
            'DELETE FROM users WHERE id = :id',
            [':id' => $id]
        );
    }

    public function count(): int
    {
        return (int) (Dic::get(Database::class)->prepare('SELECT COUNT(*) AS c FROM users')->fetch()['c'] ?? 0);
    }
}
