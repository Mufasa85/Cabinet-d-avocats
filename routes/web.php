<?php

use App\controllers\AdminController;
use App\controllers\ArticleController;
use App\controllers\HomeController;
use App\controllers\LawyerController;
use App\controllers\InternController;
use App\controllers\AuthController;
use App\controllers\ResourceController;
use Router\Router;

Router::get('/', [HomeController::class,'index']);
Router::get('/login', [HomeController::class,'login']);
Router::get('/stages', [HomeController::class,'stages']);
Router::post('/stages/candidature', [HomeController::class,'applyInternship']);
Router::get('/articles', [ArticleController::class,'index']);
Router::get('/articles/[a:slug]', [ArticleController::class,'show']);
Router::get('/resources/[**:file]', [ResourceController::class,'serve']);

Router::get('/domaines', [HomeController::class,'domaines']);
Router::get('/droit-ohada', [HomeController::class,'droitOhada']);
Router::get('/droit-minier', [HomeController::class,'droitMinier']);
Router::get('/droit-travail', [HomeController::class,'droitTravail']);
Router::get('/droit-fiscal', [HomeController::class,'droitFiscal']);
Router::get('/administration-affaires', [HomeController::class,'administrationAffaires']);
Router::get('/autres-domaines', [HomeController::class,'autresDomaines']);

Router::get('/lawyers/dashboard', [LawyerController::class,'index']);
Router::get('/lawyers/articles', [LawyerController::class,'articles']);
Router::post('/lawyers/articles', [LawyerController::class,'storeArticle']);
Router::post('/lawyers/articles/[i:id]/update', [LawyerController::class,'updateArticle']);
Router::get('/lawyers/documents', [LawyerController::class,'documents']);
Router::get('/lawyers/settings', [LawyerController::class,'settings']);
Router::get('/lawyers/notifications', [LawyerController::class,'notifications']);
Router::get('/lawyers/profile', [LawyerController::class,'profile']);
Router::post('/lawyers/profile', [LawyerController::class,'updateProfile']);
Router::get('/lawyers/trainings', [LawyerController::class,'trainings']);
Router::post('/lawyers/trainings/inscrire', [LawyerController::class,'enrollTraining']);

Router::get('/interns/dashboard', [InternController::class,'index']);
Router::get('/interns/documents', [InternController::class,'documents']);
Router::post('/interns/documents', [InternController::class,'uploadDocument']);
Router::get('/interns/trainings', [InternController::class,'trainings']);
Router::post('/interns/trainings/inscrire', [InternController::class,'enrollTraining']);
Router::get('/interns/notifications', [InternController::class,'notifications']);

Router::get('/logout', [AuthController::class,'logout']);
Router::post('/logout', [AuthController::class,'logout']);

Router::get('/admin/dashboard', [AdminController::class,'index']);
Router::get('/admin/users', [AdminController::class,'users']);
Router::get('/admin/settings', [AdminController::class,'settings']);
Router::get('/admin/reports', [AdminController::class,'reports']);
Router::get('/admin/candidatures', [AdminController::class,'candidatures']);
Router::post('/admin/candidatures/[i:id]/statut', [AdminController::class,'updateCandidature']);
Router::get('/admin/notifications', [AdminController::class,'notifications']);
Router::get('/admin/publications', [AdminController::class,'publications']);
Router::post('/admin/publications', [AdminController::class,'storePublication']);
Router::get('/admin/lawyers', [AdminController::class,'lawyers']);
Router::post('/admin/lawyers', [AdminController::class,'storeLawyer']);
Router::post('/admin/lawyers/[i:id]/update', [AdminController::class,'updateLawyer']);
Router::get('/admin/documents', [AdminController::class,'documents']);
Router::post('/admin/documents/[i:id]/valider', [AdminController::class,'validateDocument']);
Router::get('/admin/trainings', [AdminController::class,'trainings']);
Router::post('/admin/trainings', [AdminController::class,'storeFormation']);
Router::post('/admin/inscriptions/[i:id]/statut', [AdminController::class,'updateInscription']);

Router::post('/login', [AuthController::class,'login']);
Router::post('/register', [AuthController::class,'register']);
Router::post('/admin/users/create', [AdminController::class,'create']);
Router::post('/admin/users/[i:id]/update', [AdminController::class,'updateUser']);
Router::post('/admin/users/[i:id]/delete', [AdminController::class,'deleteUser']);
