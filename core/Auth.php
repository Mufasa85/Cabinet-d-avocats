<?php

namespace Core;

class Auth
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_LAWYER = 'lawyer';
    public const ROLE_INTERN = 'intern';

    /** Rôles stockés en base (colonne users.roles) */
    public const DB_ROLES = ['admin', 'avocat', 'secretaire', 'stagiaire'];

    public static function check(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public static function role(): ?string
    {
        return $_SESSION['user_role'] ?? null;
    }

    public static function id(): ?int
    {
        return isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
    }

    public static function hasRole(string ...$roles): bool
    {
        $current = self::role();
        return $current !== null && in_array($current, $roles, true);
    }

    /** Convertit le rôle BDD vers le rôle de session */
    public static function sessionRoleFromDb(string $dbRole): string
    {
        return match ($dbRole) {
            'avocat' => self::ROLE_LAWYER,
            'stagiaire' => self::ROLE_INTERN,
            default => $dbRole,
        };
    }

    public static function label(string $dbRole): string
    {
        return match ($dbRole) {
            'admin' => 'Administrateur',
            'avocat' => 'Avocat',
            'secretaire' => 'Secrétaire',
            'stagiaire' => 'Stagiaire',
            default => ucfirst($dbRole),
        };
    }

    public static function initials(string $fullname): string
    {
        $parts = preg_split('/\s+/', trim($fullname), -1, PREG_SPLIT_NO_EMPTY);
        if (empty($parts)) {
            return '?';
        }
        if (count($parts) === 1) {
            return strtoupper(substr($parts[0], 0, 2));
        }
        return strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
    }

    public static function login(array $user): void
    {
        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['user_name'] = $user['fullname'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = self::sessionRoleFromDb($user['roles']);
        $_SESSION['user_db_role'] = $user['roles'];

        if (!empty($user['avatar'])) {
            $_SESSION['user_avatar'] = $user['avatar'];
        } else {
            unset($_SESSION['user_avatar']);
        }
    }

    public static function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }

    public static function redirectUrlForDbRole(string $dbRole): string
    {
        return match ($dbRole) {
            'admin' => \Router\Router::route('/admin/dashboard'),
            'avocat' => \Router\Router::route('/lawyers/dashboard'),
            'stagiaire' => \Router\Router::route('/interns/dashboard'),
            'secretaire' => \Router\Router::route('/admin/dashboard'),
            default => \Router\Router::route('/'),
        };
    }
}
