<?php

namespace App\controllers;

use App\models\FormationModel;
use App\models\InscriptionModel;
use App\models\NotificationModel;
use App\models\StagiaireDocumentModel;
use App\models\StagiaireModel;
use App\View;
use Core\Auth;
use Core\Security;
use Router\Router;
use Service\FileStorage;

class InternController extends Controller
{
    private ?array $stagiaire = null;

    public function __construct()
    {
        if (!Auth::hasRole(Auth::ROLE_INTERN)) {
            $this->redirect(Router::route('/login'));
            exit;
        }

        $this->stagiaire = (new StagiaireModel())->findByUserId((int) Auth::id());
        if (!$this->stagiaire) {
            (new StagiaireModel())->create(['user_id' => (int) Auth::id()]);
            $this->stagiaire = (new StagiaireModel())->findByUserId((int) Auth::id());
        }
    }

    public function index()
    {
        $docModel = new StagiaireDocumentModel();
        View::view('interns.dashboard', [
            'stagiaire' => $this->stagiaire,
            'documents' => $docModel->byStagiaireId((int) $this->stagiaire['id']),
            'notifications' => (new NotificationModel())->unreadCount((int) Auth::id()),
        ]);
    }

    public function documents()
    {
        View::view('interns.documents', [
            'documents' => (new StagiaireDocumentModel())->byStagiaireId((int) $this->stagiaire['id']),
            'csrf' => Security::csrf_tokken(),
        ]);
    }

    public function uploadDocument()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/interns/documents'));
            return;
        }

        try {
            if (empty($_FILES['fichier']['name'])) {
                throw new \RuntimeException('Aucun fichier sélectionné.');
            }
            $stored = FileStorage::storeUpload($_FILES['fichier'], 'documents/stagiaires', 'stg_' . $this->stagiaire['id']);
            (new StagiaireDocumentModel())->create((int) $this->stagiaire['id'], [
                'type' => $this->sanitaze($_POST['type'] ?? 'autre'),
                'titre' => $this->sanitaze($_POST['titre'] ?? $_FILES['fichier']['name']),
            ], $stored);
            $_SESSION['success'] = 'Document envoyé pour validation.';
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
        }

        $this->redirect(Router::route('/interns/documents'));
    }

    public function trainings()
    {
        $inscriptions = (new InscriptionModel())->byUserId((int) Auth::id());
        $inscriptionsEnCours = array_values(array_filter(
            $inscriptions,
            static fn(array $inscription): bool => in_array($inscription['statut'], ['en_attente', 'acceptee'], true)
        ));

        $inscriptionsFormationIds = [];
        foreach ($inscriptionsEnCours as $inscription) {
            $inscriptionsFormationIds[] = (int) ($inscription['formation_id'] ?? 0);
        }

        $formationsDisponibles = [];
        foreach ((new FormationModel())->availableForPublic('stagiaire') as $formation) {
            if (!in_array((int) ($formation['id'] ?? 0), $inscriptionsFormationIds, true)) {
                $formationsDisponibles[] = $formation;
            }
        }

        View::view('interns.trainings', [
            'formationsDisponibles' => $formationsDisponibles,
            'inscriptionsEnCours' => $inscriptionsEnCours,
            'inscriptions' => $inscriptions,
            'csrf' => Security::csrf_tokken(),
        ]);
    }

    public function enrollTraining()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/interns/trainings'));
            return;
        }

        $formationId = (int) ($_POST['formation_id'] ?? 0);
        $inscriptionModel = new InscriptionModel();

        if (!$formationId || $inscriptionModel->exists($formationId, (int) Auth::id())) {
            $this->error('Inscription impossible.');
            $this->redirect(Router::route('/interns/trainings'));
            return;
        }

        $formationModel = new FormationModel();
        if (!$formationModel->findAvailableForPublic($formationId, 'stagiaire')) {
            $this->error('Plus de places disponibles.');
            $this->redirect(Router::route('/interns/trainings'));
            return;
        }

        if (!$formationModel->reservePlace($formationId)) {
            $this->error('Plus de places disponibles.');
            $this->redirect(Router::route('/interns/trainings'));
            return;
        }

        try {
            $inscriptionModel->create(
                $formationId,
                (int) Auth::id(),
                $this->sanitaze($_POST['message'] ?? ''),
                'acceptee'
            );
            $_SESSION['success'] = 'Inscription validée. Formation ajoutée dans "En cours".';
        } catch (\Throwable $e) {
            $formationModel->releasePlace($formationId);
            $this->error('Inscription impossible pour le moment. Veuillez réessayer.');
        }

        $this->redirect(Router::route('/interns/trainings'));
    }

    public function notifications()
    {
        $notifModel = new NotificationModel();
        View::view('interns.notifications', [
            'notifications' => $notifModel->byUserId((int) Auth::id()),
            'unread' => $notifModel->unreadCount((int) Auth::id()),
        ]);
    }

    public function settings()
    {
        View::view('interns.settings', [
            'csrf' => Security::csrf_tokken(),
        ]);
    }

    public function updatePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/interns/settings'));
            return;
        }

        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($currentPassword === '' || $newPassword === '' || $confirmPassword === '') {
            $this->error('Tous les champs mot de passe sont obligatoires.');
            $this->redirect(Router::route('/interns/settings'));
            return;
        }

        if ($newPassword !== $confirmPassword) {
            $this->error('Le nouveau mot de passe et sa confirmation ne correspondent pas.');
            $this->redirect(Router::route('/interns/settings'));
            return;
        }

        if (!\Helper\String\Stringy::lengthError($newPassword, 8, 64)) {
            $this->error('Le mot de passe doit contenir entre 8 et 64 caractères.');
            $this->redirect(Router::route('/interns/settings'));
            return;
        }

        $userModel = new \App\models\UserModel();
        $user = $userModel->findAuthById((int) Auth::id());
        if (!$user || !password_verify($currentPassword, $user['passwords'] ?? '')) {
            $this->error('Mot de passe actuel incorrect.');
            $this->redirect(Router::route('/interns/settings'));
            return;
        }

        try {
            $userModel->update((int) Auth::id(), ['password' => $newPassword]);
            $_SESSION['success'] = 'Mot de passe modifié avec succès.';
        } catch (\Throwable $e) {
            $this->error('Erreur lors du changement de mot de passe.');
        }

        $this->redirect(Router::route('/interns/settings'));
    }

    public function saveTheme()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $theme = $_POST['theme'] ?? 'default';
        $validThemes = ['default', 'light', 'royal'];

        if (!in_array($theme, $validThemes)) {
            http_response_code(400);
            echo json_encode(['error' => 'Theme invalide']);
            exit;
        }

        $userId = Auth::id();
        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Non connecté']);
            exit;
        }

        $userModel = new \App\models\UserModel();
        $userModel->updateTheme((int) $userId, $theme);

        // Update session
        $_SESSION['theme'] = $theme;

        echo json_encode(['success' => true, 'theme' => $theme]);
    }
}
