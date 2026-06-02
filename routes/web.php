<?php

use App\controllers\AdminController;
use App\controllers\ArticleController;
use App\controllers\HomeController;
use App\controllers\LawyerController;
use App\controllers\ResourceController;
use App\controllers\InternController;
use App\controllers\AuthController;
use Router\Router;

Router::get('/', [HomeController::class, 'index']);
Router::get('/login', [HomeController::class, 'login']);
Router::get('/stages', [HomeController::class, 'stages']);
Router::post('/stages/candidature', [HomeController::class, 'applyInternship']);
Router::get('/stages/document/[i:id]/download', [HomeController::class, 'downloadDocument']);
Router::get('/admin/document/[i:id]/download', [AdminController::class, 'downloadDocument']);
Router::get('/articles', [ArticleController::class, 'index']);
Router::get('/articles/[a:slug]', [ArticleController::class, 'show']);
Router::get('/publications', [ArticleController::class, 'publications']);
Router::get('/publications/[a:slug]', [ArticleController::class, 'showPublication']);
Router::get('/resources/[**:file]', [ResourceController::class, 'serve']);

Router::get('/domaines', [HomeController::class, 'domaines']);
Router::get('/droit-ohada', [HomeController::class, 'droitOhada']);
Router::get('/droit-minier', [HomeController::class, 'droitMinier']);
Router::get('/droit-travail', [HomeController::class, 'droitTravail']);
Router::get('/droit-fiscal', [HomeController::class, 'droitFiscal']);
Router::get('/administration-affaires', [HomeController::class, 'administrationAffaires']);
Router::get('/autres-domaines', [HomeController::class, 'autresDomaines']);

// Lawyer routes
Router::get('/lawyers/dashboard', [LawyerController::class, 'index']);
Router::get('/lawyers/articles', [LawyerController::class, 'articles']);
Router::post('/lawyers/articles', [LawyerController::class, 'storeArticle']);
Router::post('/lawyers/articles/[i:id]/update', [LawyerController::class, 'updateArticle']);
Router::post('/lawyers/articles/[i:id]/delete', [LawyerController::class, 'deleteArticle']);
Router::get('/lawyers/documents', [LawyerController::class, 'documents']);
Router::post('/lawyers/documents', [LawyerController::class, 'storeDocument']);
Router::post('/lawyers/documents/[i:id]/update', [LawyerController::class, 'updateDocument']);
Router::post('/lawyers/documents/[i:id]/delete', [LawyerController::class, 'deleteDocument']);
Router::get('/lawyers/settings', [LawyerController::class, 'settings']);
Router::get('/lawyers/notifications', [LawyerController::class, 'notifications']);
Router::post('/lawyers/notifications/read/[i:id]', [LawyerController::class, 'markNotificationRead']);
Router::post('/lawyers/notifications/read-all', [LawyerController::class, 'markAllNotificationsRead']);
Router::get('/lawyers/profile', [LawyerController::class, 'profile']);
Router::post('/lawyers/profile', [LawyerController::class, 'updateProfile']);
Router::post('/lawyers/profile/update', [LawyerController::class, 'updateProfile']);
Router::get('/avocat/[i:id]', [LawyerController::class, 'publicProfile']);
Router::post('/lawyers/avatar', [LawyerController::class, 'updateAvatar']);
Router::get('/lawyers/trainings', [LawyerController::class, 'trainings']);
Router::post('/lawyers/trainings/inscrire', [LawyerController::class, 'enrollTraining']);

// Intern routes
Router::get('/interns/dashboard', [InternController::class, 'index']);
Router::get('/interns/documents', [InternController::class, 'documents']);
Router::post('/interns/documents', [InternController::class, 'uploadDocument']);
Router::get('/interns/trainings', [InternController::class, 'trainings']);
Router::post('/interns/trainings/inscrire', [InternController::class, 'enrollTraining']);
Router::get('/interns/notifications', [InternController::class, 'notifications']);
Router::get('/interns/settings', [InternController::class, 'settings']);
Router::post('/interns/settings/password', [InternController::class, 'updatePassword']);
Router::post('/interns/settings/theme', [InternController::class, 'saveTheme']);

// Auth routes
Router::get('/logout', [AuthController::class, 'logout']);
Router::post('/logout', [AuthController::class, 'logout']);
Router::post('/login', [AuthController::class, 'login']);
Router::post('/register', [AuthController::class, 'register']);

// Admin routes
Router::get('/admin/dashboard', [AdminController::class, 'index']);
Router::get('/admin/users', [AdminController::class, 'users']);
Router::post('/admin/users/create', [AdminController::class, 'create']);
Router::post('/admin/users/[i:id]/update', [AdminController::class, 'updateUser']);
Router::post('/admin/users/[i:id]/delete', [AdminController::class, 'deleteUser']);
Router::get('/admin/settings', [AdminController::class, 'settings']);
Router::post('/admin/settings/profile', [AdminController::class, 'updateSettingsProfile']);
Router::post('/admin/settings/password', [AdminController::class, 'updateSettingsPassword']);
Router::get('/admin/reports', [AdminController::class, 'reports']);
Router::get('/admin/candidatures', [AdminController::class, 'candidatures']);
Router::post('/admin/candidatures/[i:id]/statut', [AdminController::class, 'updateCandidature']);
Router::get('/admin/notifications', [AdminController::class, 'notifications']);
Router::post('/admin/notifications/read/[i:id]', [AdminController::class, 'markNotificationRead']);
Router::post('/admin/notifications/read-all', [AdminController::class, 'markAllNotificationsRead']);
Router::post('/admin/notifications/[i:id]/delete', [AdminController::class, 'deleteNotification']);
Router::get('/admin/publications', [AdminController::class, 'publications']);
Router::post('/admin/publications', [AdminController::class, 'storePublication']);
Router::get('/admin/lawyers', [AdminController::class, 'lawyers']);
Router::post('/admin/lawyers', [AdminController::class, 'storeLawyer']);
Router::post('/admin/lawyers/[i:id]/update', [AdminController::class, 'updateLawyer']);
Router::post('/admin/lawyers/[i:id]/delete', [AdminController::class, 'deleteLawyer']);
Router::get('/admin/documents', [AdminController::class, 'documents']);
Router::post('/admin/documents/upload', [AdminController::class, 'uploadDocument']);
Router::post('/admin/documents/[i:id]/valider', [AdminController::class, 'validateDocument']);
Router::get('/admin/trainings', [AdminController::class, 'trainings']);
Router::post('/admin/trainings', [AdminController::class, 'storeFormation']);
Router::post('/admin/inscriptions/[i:id]/statut', [AdminController::class, 'updateInscription']);
