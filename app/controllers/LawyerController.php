<?php 
  namespace App\controllers;

 use App\View;

  class LawyerController extends Controller {
  
    public function __construct()
    {
        // Vérifier si l'utilisateur est connecté et a le rôle avocat
        if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'lawyer') {
            // Redirection vers la page de connexion
            $this->redirect('/login');
            exit;
        }
    }
  
    public function index() {
      View::view('lawyers.dashboard');
    }
    public function documents() {
      View::view('lawyers.documents');
    }
    public function settings() {
      View::view('lawyers.settings');
    }
    public function notifications() {
      View::view('lawyers.notifications');
    }
    public function profile() {
      View::view('lawyers.profile');
    }
    public function trainings() {
      View::view('lawyers.trainings');
    }
    
 }
?>