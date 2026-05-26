<?php

namespace Core;

class Security
{
    public static function csrf_tokken(): string
    {
        // Réutiliser le token existant s'il y en a un
        if (empty($_SESSION['csrf'])) {
            $token = bin2hex(random_bytes(32));
            $_SESSION['csrf'] = $token;
        }

        return <<<HTML
  <input type="hidden" name="csrf_token" value="{$_SESSION['csrf']}"/>
HTML;

    }


    private static function set_up_csrf_token(string $tokken): void
    {
        $_SESSION['csrf'] = $tokken;
    }

    public static function verify_csrf_token(): bool
    {
        // Vérifier d'abord si les deux sont définis
        if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf'])) {
            return false;
        }
        
        // Puis comparer les valeurs
        if ($_POST['csrf_token'] !== $_SESSION['csrf']) {
            return false;
        }
        
        return true;
    }

}
