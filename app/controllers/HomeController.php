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
       View::view('login');
    }
    
    public function stages()
    {
       View::view('stages');
    }


}
