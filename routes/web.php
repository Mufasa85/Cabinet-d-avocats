<?php

use App\controllers\AdminController;
use App\controllers\HomeController;
use Router\Router;

Router::get('/', [HomeController::class,'index']);
Router::get('/login', [HomeController::class,'login']);
Router::get('/stages', [HomeController::class,'stages']);



Router::get('/admin/dashboard', [AdminController::class,'dashboard']);
Router::get('/admin/users', [AdminController::class,'users']);
Router::get('/admin/settings', [AdminController::class,'settings']);
Router::get('/admin/reports', [AdminController::class,'reports']);
Router::get('/admin/app', [AdminController::class,'analytics']);
Router::get('/admin/notifications', [AdminController::class,'notifications']);
Router::get('/admin/profile', [AdminController::class,'profile']);
Router::get('/admin/publications', [AdminController::class,'publications']);
Router::get('/admin/layers', [AdminController::class,'contacts']);
Router::get('/admin/documents', [AdminController::class,'documents']);