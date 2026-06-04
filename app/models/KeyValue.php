<?php

namespace App\Models;

use PDO;

class KeyValue
{
    private static ?PDO $db = null;

    /**
     * Initialiser la connexion DB
     */
    private static function getDb(): PDO
    {
        if (self::$db === null) {
            $config = require dirname(__DIR__, 2) . '/config/database.php';
            self::$db = new PDO(
                "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']};charset=utf8mb4",
                $config['DB_USER'],
                $config['DB_MDP'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        }
        return self::$db;
    }

    /**
     * Récupérer une valeur par sa clé
     * 
     * @param string $key
     * @param mixed $default Valeur par défaut si non trouvé
     * @return mixed
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        try {
            $db = self::getDb();
            $stmt = $db->prepare("SELECT `key`, value, type FROM key_values WHERE `key` = ?");
            $stmt->execute([$key]);
            $row = $stmt->fetch();

            if (!$row) {
                return $default;
            }

            return self::parseValue($row['value'], $row['type']);
        } catch (\Exception $e) {
            error_log("KeyValue::get error: " . $e->getMessage());
            return $default;
        }
    }

    /**
     * Définir une valeur (insert or update)
     * 
     * @param string $key
     * @param mixed $value
     * @param string|null $type
     * @param string|null $description
     * @param string|null $group
     * @param bool $isPublic
     * @param array|null $options
     * @return bool
     */
    public static function set(
        string $key,
        mixed $value,
        ?string $type = null,
        ?string $description = null,
        ?string $group = 'general',
        bool $isPublic = false,
        ?array $options = null
    ): bool {
        try {
            $db = self::getDb();

            // Déterminer le type automatiquement si non fourni
            if ($type === null) {
                $type = self::detectType($value);
            }

            // Convertir la valeur en string pour le stockage
            $stringValue = self::valueToString($value, $type);

            // Chercher si la clé existe déjà
            $checkStmt = $db->prepare("SELECT id FROM key_values WHERE `key` = ?");
            $checkStmt->execute([$key]);

            if ($checkStmt->fetch()) {
                // UPDATE
                $sql = "UPDATE key_values SET 
                        value = ?, 
                        type = ?,
                        description = COALESCE(?, description),
                        `group` = COALESCE(?, `group`),
                        is_public = ?,
                        options = ?,
                        updated_at = CURRENT_TIMESTAMP
                    WHERE `key` = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    $stringValue,
                    $type,
                    $description,
                    $group,
                    $isPublic ? 1 : 0,
                    $options ? json_encode($options) : null,
                    $key
                ]);
            } else {
                // INSERT
                $sql = "INSERT INTO key_values (`key`, value, type, description, `group`, is_public, options)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    $key,
                    $stringValue,
                    $type,
                    $description,
                    $group,
                    $isPublic ? 1 : 0,
                    $options ? json_encode($options) : null
                ]);
            }

            return true;
        } catch (\Exception $e) {
            error_log("KeyValue::set error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Supprimer une clé
     */
    public static function delete(string $key): bool
    {
        try {
            $db = self::getDb();
            $stmt = $db->prepare("DELETE FROM key_values WHERE `key` = ?");
            $stmt->execute([$key]);
            return $stmt->rowCount() > 0;
        } catch (\Exception $e) {
            error_log("KeyValue::delete error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Vérifier si une clé existe
     */
    public static function has(string $key): bool
    {
        try {
            $db = self::getDb();
            $stmt = $db->prepare("SELECT 1 FROM key_values WHERE `key` = ?");
            $stmt->execute([$key]);
            return $stmt->fetch() !== false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Récupérer toutes les clés d'un groupe
     */
    public static function getGroup(string $group): array
    {
        try {
            $db = self::getDb();
            $stmt = $db->prepare("SELECT `key`, value, type, description, is_public, options FROM key_values WHERE `group` = ? ORDER BY `key`");
            $stmt->execute([$group]);
            $rows = $stmt->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[$row['key']] = [
                    'value' => self::parseValue($row['value'], $row['type']),
                    'type' => $row['type'],
                    'description' => $row['description'],
                    'is_public' => (bool)$row['is_public'],
                    'options' => $row['options'] ? json_decode($row['options'], true) : null
                ];
            }
            return $result;
        } catch (\Exception $e) {
            error_log("KeyValue::getGroup error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupérer toutes les clés publiques
     */
    public static function getPublic(): array
    {
        try {
            $db = self::getDb();
            $stmt = $db->prepare("SELECT `key`, value, type FROM key_values WHERE is_public = TRUE");
            $stmt->execute();
            $rows = $stmt->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[$row['key']] = self::parseValue($row['value'], $row['type']);
            }
            return $result;
        } catch (\Exception $e) {
            error_log("KeyValue::getPublic error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Récupérer toutes les clés (admin)
     */
    public static function all(): array
    {
        try {
            $db = self::getDb();
            $stmt = $db->query("SELECT * FROM key_values ORDER BY `group`, `key`");
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            error_log("KeyValue::all error: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Parser la valeur selon son type
     */
    private static function parseValue(string|null $value, string $type): mixed
    {
        if ($value === null) {
            return null;
        }

        return match ($type) {
            'integer' => (int)$value,
            'float' => (float)$value,
            'boolean' => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode($value, true),
            'array' => json_decode($value, true) ?? [],
            default => $value
        };
    }

    /**
     * Convertir une valeur en string pour le stockage
     */
    private static function valueToString(mixed $value, string $type): string
    {
        return match ($type) {
            'json', 'array' => json_encode($value, JSON_UNESCAPED_UNICODE),
            'boolean' => $value ? 'true' : 'false',
            default => (string)$value
        };
    }

    /**
     * Détecter automatiquement le type d'une valeur
     */
    private static function detectType(mixed $value): string
    {
        if (is_int($value)) return 'integer';
        if (is_float($value)) return 'float';
        if (is_bool($value)) return 'boolean';
        if (is_array($value)) return 'json';
        return 'string';
    }

    /**
     * Incrémenter une valeur numérique
     */
    public static function increment(string $key, int $amount = 1): bool
    {
        try {
            $db = self::getDb();
            $stmt = $db->prepare("UPDATE key_values SET value = CAST(CAST(value AS UNSIGNED) + ? AS CHAR), updated_at = CURRENT_TIMESTAMP WHERE `key` = ? AND type IN ('integer', 'float')");
            $stmt->execute([$amount, $key]);
            return $stmt->rowCount() > 0;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Obtenir plusieurs clés d'un coup
     */
    public static function getMultiple(array $keys, mixed $default = null): array
    {
        try {
            $db = self::getDb();
            $placeholders = implode(',', array_fill(0, count($keys), '?'));
            $stmt = $db->prepare("SELECT `key`, value, type FROM key_values WHERE `key` IN ($placeholders)");
            $stmt->execute($keys);
            $rows = $stmt->fetchAll();

            $result = [];
            foreach ($keys as $key) {
                $result[$key] = $default;
            }
            foreach ($rows as $row) {
                $result[$row['key']] = self::parseValue($row['value'], $row['type']);
            }
            return $result;
        } catch (\Exception $e) {
            return array_fill_keys($keys, $default);
        }
    }
}