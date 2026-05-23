<?php 
  namespace App\controllers;

use App\View;
use Override;

 class AdminController extends Controller
 {

    public function index()
    {
      
    }
     public function dashboard()
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
     public function profile()
     {
        View::view('admin.profile');
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

 }
?>