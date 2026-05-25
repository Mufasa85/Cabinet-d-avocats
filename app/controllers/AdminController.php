<?php 
  namespace App\controllers;

 use App\View;
 use Override;

  class AdminController extends Controller
  {

     public function __construct()
     {
         // // Vérifier si l'utilisateur est connecté et a le rôle admin
         // if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] ?? '') !== 'admin') {
         //     // Redirection vers la page de connexion
         //     $this->redirect('/login');
         //     exit;
         // }
     }

     public function index()
     {
         View::view('admin.dashboard');
     }
    
  
    public function users()
    {
       View::view('admin.users');
    }
    public function settings()
    {
       View::view('admin.settings');
    }
    public function reports()
    {
       View::view('admin.reports');
    }
    public function analytics()
    {
       View::view('admin.analytics');
    }
    public function notifications()
    {
       View::view('admin.notifications');
    }
    public function lawyers()
    {
       View::view('admin.lawyers');
    }
    public function publications()
    {
       View::view('admin.publications');
    }
    public function contacts()
    {
       View::view('admin.contacts');
    }
     public function documents()
     {
        View::view('admin.documents');
     }
     public function candidatures()
     {
        View::view('admin.candidatures');
     }

 }
?>