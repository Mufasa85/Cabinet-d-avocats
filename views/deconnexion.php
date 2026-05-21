<?php
/**
 * ELMD - Cabinet d'Avocats
 * Déconnexion
 */

// Démarrer la session
session_start();

// Supprimer toutes les variables de session
$_SESSION = array();

// Supprimer le cookie de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Supprimer le cookie "Se souvenir de moi"
if (isset($_COOKIE['remember_email'])) {
    setcookie('remember_email', '', time() - 3600, '/');
}

// Détruire la session
session_destroy();

// Redirection vers la page d'accueil
header('Location: index.php');
exit;