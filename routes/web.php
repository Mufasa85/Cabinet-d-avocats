<?php

use App\controllers\AdminController;
use App\controllers\HomeController;
use App\controllers\LawyerController;
use Router\Router;

Router::get('/', [HomeController::class,'index']);
Router::get('/login', [HomeController::class,'login']);
Router::get('/stages', [HomeController::class,'stages']);

Router::get('/lawyers/dashboard', [LawyerController::class,'index']);
Router::get('/lawyers/documents', [LawyerController::class,'documents']);
Router::get('/lawyers/settings', [LawyerController::class,'settings']);
Router::get('/lawyers/notifications', [LawyerController::class,'notifications']);
Router::get('/lawyers/profile', [LawyerController::class,'profile']);
Router::get('/lawyers/trainings', [LawyerController::class,'trainings']);



Router::get('/admin/dashboard', [AdminController::class,'index']);
Router::get('/admin/users', [AdminController::class,'users']);
Router::get('/admin/settings', [AdminController::class,'settings']);
Router::get('/admin/reports', [AdminController::class,'reports']);
Router::get('/admin/candidatures', [AdminController::class,'candidatures']);
Router::get('/admin/notifications', [AdminController::class,'notifications']);
Router::get('/admin/publications', [AdminController::class,'publications']);
Router::get('/admin/lawyers', [AdminController::class,'lawyers']);
Router::get('/admin/documents', [AdminController::class,'documents']);