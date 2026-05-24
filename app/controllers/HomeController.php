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

    public function domaines()
    {
       View::view('domaines');
    }

    public function droitOhada()
    {
       View::view('droit-ohada');
    }

    public function droitMinier()
    {
       View::view('droit-minier');
    }

    public function droitTravail()
    {
       View::view('droit-travail');
    }

    public function droitFiscal()
    {
       View::view('droit-fiscal');
    }

    public function administrationAffaires()
    {
       View::view('administration-affaires');
    }

    public function autresDomaines()
    {
       View::view('autres-domaines');
    }

}
