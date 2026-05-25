<?php
namespace App\controllers;

use App\models\UserModel;
use Container\Dic;
use Core\Auth;
use Core\Security;
use Helper\Build\Database;
use Helper\Log\LogManagement;
use Helper\String\Stringy;
use Router\Router;

class AuthController extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(Router::route('/login'));
            return;
        }

        $email = $this->sanitaze($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $remember = isset($_POST['remember']);

        if (!Security::verify_csrf_token()) {
            Router::respondWithError(419, 'Token CSRF expiré. Veuillez rafraîchir la page et réessayer.');
            return;
        }

        if (Stringy::empty($email) || Stringy::empty($password)) {
            $this->error('Tous les champs sont requis.');
            $this->redirect(Router::route('/login'));
            return;
        }

        if (!Stringy::lengthError($password, 8, 64) || !Stringy::lengthError($email, 8, 255)) {
            $this->error('Email ou mot de passe ont une longueur incorrecte.');
            $this->redirect(Router::route('/login'));
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Format d\'email invalide.');
            $this->redirect(Router::route('/login'));
            return;
        }

        try {
            $db = Dic::get(Database::class);
            $stmt = $db->prepare(
                'SELECT * FROM users WHERE email = :email LIMIT 1',
                [':email' => $email]
            );
            $user = $stmt->fetch();
        } catch (\PDOException $e) {
            $logManagement = Dic::get(LogManagement::class);
            $logManagement->create($e->getMessage());
            Router::respondWithError(500, 'Erreur interne.');
            return;
        }

        if (!$user || !password_verify($password, $user['passwords'])) {
            $this->error('Email ou mot de passe incorrect.');
            $this->redirect(Router::route('/login'));
            return;
        }

        if (isset($user['is_active']) && !$user['is_active']) {
            $this->error('Votre compte est désactivé.');
            $this->redirect(Router::route('/login'));
            return;
        }

        Auth::login($user);

        if ($remember) {
            setcookie('remember_email', $email, time() + 86400 * 30, '/');
        }

        $this->redirect(Auth::redirectUrlForDbRole($user['roles']));
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        if (!Auth::hasRole(Auth::ROLE_ADMIN)) {
            $this->error('Seul un administrateur peut créer des comptes.');
            $this->redirect(Router::route('/login'));
            return;
        }

        if (!Security::verify_csrf_token()) {
            Router::respondWithError(419, 'Token CSRF expiré. Veuillez rafraîchir la page et réessayer.');
            return;
        }

        $fullname = $this->sanitaze($_POST['fullname'] ?? '');
        $email = $this->sanitaze($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['password_confirmation'] ?? '';
        $telephone = $this->sanitaze($_POST['telephone'] ?? '');
        $role = $this->sanitaze($_POST['role'] ?? '');
        $is_active = isset($_POST['is_active']) ? (int) $this->sanitaze((string) ($_POST['is_active'] ?? '1')) : 1;

        if (Stringy::empty($fullname) || Stringy::empty($email) || Stringy::empty($password) || Stringy::empty($confirmPassword)) {
            $this->error('Tous les champs requis ne sont pas remplis.');
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Format d\'email invalide.');
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        if (!Stringy::lengthError($fullname, 2, 100) || !Stringy::lengthError($email, 8, 255) || !Stringy::lengthError($password, 8, 64)) {
            $this->error('Nom, email ou mot de passe ont une longueur incorrecte.');
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        if ($password !== $confirmPassword) {
            $this->error('Les mots de passe ne correspondent pas.');
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        if (!in_array($role, Auth::DB_ROLES, true)) {
            $this->error('Rôle sélectionné invalide.');
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        try {
            $userModel = new UserModel();
            if ($userModel->findByEmail($email)) {
                $this->error('Cet email est déjà utilisé.');
                $this->redirect(Router::route('/admin/users'));
                return;
            }

            $userModel->create([
                'fullname' => $fullname,
                'email' => $email,
                'password' => $password,
                'roles' => $role,
                'telephone' => $telephone ?: null,
                'is_active' => $is_active,
            ]);
        } catch (\PDOException $e) {
            $logManagement = Dic::get(LogManagement::class);
            $logManagement->create($e->getMessage());
            Router::respondWithError(500, 'Erreur interne.');
            return;
        }

        $_SESSION['success'] = 'Compte créé avec succès.';
        $this->redirect(Router::route('/admin/users'));
    }

    public function logout()
    {
        Auth::logout();
        header('Location: ' . Router::route('/login'));
        exit;
    }
}
