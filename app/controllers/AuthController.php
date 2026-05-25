<?php 
  namespace App\controllers;

  use Container\Dic;
  use Helper\Build\Database;
  use Helper\Log\LogManagement;
  use Helper\String\Stringy;
  use Router\Router;
  use Core\Security;

 class AuthController extends Controller {

    private const ALLOWED_ROLES = ['admin','avocat','secretaire','stagiaire','juriste'];

      public function login()
      {
          if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
              $this->redirect(Router::route('/login'));
              return;
          }

          $email = $this->sanitaze($_POST['email'] ?? '');
          $password = $this->sanitaze($_POST['password'] ?? '');
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

          if (!Stringy::lengthError($password, 8, 16) || !Stringy::lengthError($email, 8, 255)) {
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

          $_SESSION['user_id'] = $user['id'];
          $_SESSION['user_name'] = $user['fullname'];
          $_SESSION['user_email'] = $user['email'];
          $_SESSION['user_role'] = $user['roles'];

          if (!empty($user['avatar'])) {
              $_SESSION['user_avatar'] = $user['avatar'];
          }

          if ($remember) {
              setcookie('remember_email', $email, time() + 86400 * 30, '/');
          }

          $this->redirect($this->getRedirectUrlByRole($user['roles']));
      }

      public function register()
      {
          if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
              $this->redirect(Router::route('/login'));
              return;
          }

          if (!Security::verify_csrf_token()) {
              Router::respondWithError(419, 'Token CSRF expiré. Veuillez rafraîchir la page et réessayer.');
              return;
          }

          $fullname = $this->sanitaze($_POST['fullname'] ?? '');
          $email = $this->sanitaze($_POST['email'] ?? '');
          $password = $this->sanitaze($_POST['password'] ?? '');
          $confirmPassword = $this->sanitaze($_POST['password_confirmation'] ?? '');
          $telephone = $this->sanitaze($_POST['telephone'] ?? '');
          $requestedRole = $this->sanitaze($_POST['role'] ?? '');
          $is_active = isset($_POST['is_active']) ? (int) $this->sanitaze((string)($_POST['is_active'] ?? '1')) : 1;

          if (Stringy::empty($fullname) || Stringy::empty($email) || Stringy::empty($password) || Stringy::empty($confirmPassword)) {
              $this->error('Tous les champs requis ne sont pas remplis.');
              $this->redirect(Router::route('/login'));
              return;
          }

          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $this->error('Format d\'email invalide.');
              $this->redirect(Router::route('/login'));
              return;
          }

          if (!Stringy::lengthError($fullname, 3, 100) || !Stringy::lengthError($email, 8, 255) || !Stringy::lengthError($password, 8, 16)) {
              $this->error('Nom, email ou mot de passe ont une longueur incorrecte.');
              $this->redirect(Router::route('/login'));
              return;
          }

          if ($password !== $confirmPassword) {
              $this->error('Les mots de passe ne correspondent pas.');
              $this->redirect(Router::route('/login'));
              return;
          }

          $role = 'stagiaire';
          if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin' && in_array($requestedRole, self::ALLOWED_ROLES, true)) {
              $role = $requestedRole;
          }

          try {
              $db = Dic::get(Database::class);
              $check = $db->prepare('SELECT id FROM users WHERE email = :email LIMIT 1', [':email' => $email]);
              if ($check->fetch()) {
                  $this->error('Cet email est déjà utilisé.');
                  $this->redirect(Router::route('/login'));
                  return;
              }

              $db->prepare(
                  'INSERT INTO users (fullname, email, passwords, roles, telephone, avatar, is_active) VALUES (:fullname, :email, :passwords, :roles, :telephone, :avatar, :is_active)',
                  [
                      ':fullname' => $fullname,
                      ':email' => $email,
                      ':passwords' => password_hash($password, PASSWORD_BCRYPT),
                      ':roles' => $role,
                      ':telephone' => $telephone ?: null,
                      ':avatar' => null,
                      ':is_active' => $is_active,
                  ]
              );
          } catch (\PDOException $e) {
              $logManagement = Dic::get(LogManagement::class);
              $logManagement->create($e->getMessage());
              Router::respondWithError(500, 'Erreur interne.');
              return;
          }

          $_SESSION['success'] = 'Compte créé avec succès.';
          $this->redirect(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin' ? Router::route('/admin/users') : Router::route('/login'));
      }

      private function getRedirectUrlByRole(string $role): string
      {
          return match ($role) {
              'admin' => Router::route('/admin/dashboard'),
              'avocat' => Router::route('/lawyers/dashboard'),
              default => Router::route('/'),
          };
      }

 }
