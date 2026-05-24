<?php

namespace App\controllers;

use App\View;

class HomeController extends Controller
{
    public function index()
    {
       View::view('index');
    }
    public function login()
    {
      //  if (isset($_SESSION['user_id'])) {
      //     header('Location: dashboard.php');
      //     exit;
      //  }
       View::view('login',[
        'title' => 'Connexion | ELMD - Cabinet d\'Avocats'
       ]);
    }
    
    public function stages()
    {
       View::view('stages');
    }


}
