<?php 
  namespace App\controllers;
  use Helper\String\Stringy;
  use Router\Router;
  use Core\Security;

 class AuthController extends Controller {

      public function login()
      {
        $email = $this->sanitaze($_POST['email']);
        $password = $this->sanitaze($_POST['password']);

        if(!Security::verify_csrf_token())
        {
            Router::respondWithError(419, 'Token CSRF expiré. Veuillez rafraîchir la page et réessayer.');
            return;
        }

        if(Stringy::empty($email) || Stringy::empty($password))
        {
            $this->error("All fields are required");
            $this->redirect(Router::route("/login"));
            return;
        }

        if(!Stringy::lengthError($password, 8, 16) || !Stringy::lengthError($email, 8, 50))
        {
            $this->error("Password or email have an incorrect length");
            $this->redirect(Router::route("/login"));
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->error("Invalid email format");
            $this->redirect(Router::route("/login"));
            return;
        }

          // $user = $db->query("SELECT * FROM users WHERE email = ?", [$email])->fetch();
           // if ($user && password_verify($password, $user['password']))
      
      }
 
 }