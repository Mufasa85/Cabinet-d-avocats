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
            'SELECT * FROM users ORDER BY name ASC'
        );
        return $stmt->fetchAll() ?: [];
    }

    public function findById(int $id): ?array
    {
        $stmt = Dic::get(Database::class)->prepare(
            'SELECT id, name, email, role, phone AS telephone, avatar, status, created_at FROM users WHERE id = :id LIMIT 1',
            [':id' => $id]
        );
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function findAuthById(int $id): ?array
    {
        $stmt = Dic::get(Database::class)->prepare(
            'SELECT id, name, email, role, phone, avatar, status, passwords FROM users WHERE id = :id LIMIT 1',
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
        $sql = 'INSERT INTO users (name, email, passwords, role, phone, avatar, status) VALUES (:name, :email, :passwords, :role, :phone, :avatar, :status)';
        $params = [
            ':name' => $data['name'] ?? $data['fullname'] ?? null,
            ':email' => $data['email'] ?? null,
            ':passwords' => isset($data['password']) ? password_hash($data['password'], PASSWORD_BCRYPT) : null,
            ':role' => $data['role'] ?? $data['roles'] ?? 'stagiaire',
            ':phone' => $data['telephone'] ?? null,
            ':avatar' => $data['avatar'] ?? null,
            ':status' => isset($data['status']) ? (int) $data['status'] : (isset($data['is_active']) ? (int) $data['is_active'] : 1),
        ];

        Dic::get(Database::class)->prepare($sql, $params);
        return (int) Dic::get(Database::class)->lastInsertId();
    }

    public function update(int $id, array $data)
    {
        $fields = [];
        $params = [':id' => $id];

        if (isset($data['name'])) {
            $fields[] = 'name = :name';
            $params[':name'] = $data['name'];
        } elseif (isset($data['fullname'])) {
            $fields[] = 'name = :fullname';
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
        if (isset($data['role'])) {
            $fields[] = 'role = :role';
            $params[':role'] = $data['role'];
        } elseif (isset($data['roles'])) {
            $fields[] = 'role = :role';
            $params[':role'] = $data['roles'];
        }
        if (array_key_exists('telephone', $data)) {
            $fields[] = 'telephone = :telephone';
            $params[':telephone'] = $data['telephone'];
        }
        if (array_key_exists('avatar', $data)) {
            $fields[] = 'avatar = :avatar';
            $params[':avatar'] = $data['avatar'];
        }
        if (isset($data['status'])) {
            $fields[] = 'status = :status';
            $params[':status'] = (int) $data['status'];
        } elseif (isset($data['is_active'])) {
            $fields[] = 'status = :status';
            $params[':status'] = (int) $data['is_active'];
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
