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
        View::view('interns.trainings', [
            'formations' => (new FormationModel())->all('stagiaire'),
            'inscriptions' => (new InscriptionModel())->byUserId((int) Auth::id()),
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

        if (!(new FormationModel())->hasPlaces($formationId)) {
            $this->error('Plus de places disponibles.');
            $this->redirect(Router::route('/interns/trainings'));
            return;
        }

        $inscriptionModel->create($formationId, (int) Auth::id(), $this->sanitaze($_POST['message'] ?? ''));
        $_SESSION['success'] = 'Demande d\'inscription envoyée.';
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
}
