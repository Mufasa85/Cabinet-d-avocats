<?php
namespace App\controllers;

use App\models\ArticleModel;
use App\models\AvocatModel;
use App\models\CategoryModel;
use App\models\FormationModel;
use App\models\InscriptionModel;
use App\models\NotificationModel;
use App\View;
use Core\Auth;
use Core\Security;
use Router\Router;
use Service\FileStorage;

class LawyerController extends Controller
{
    private ?array $avocat = null;

    public function __construct()
    {
        if (!Auth::hasRole(Auth::ROLE_LAWYER)) {
            $this->redirect(Router::route('/login'));
            exit;
        }
        $this->avocat = (new AvocatModel())->findByUserId((int) Auth::id());
        if (!$this->avocat) {
            (new AvocatModel())->createForUser((int) Auth::id(), [
                'titre' => 'Avocat',
                'email_professionnel' => $_SESSION['user_email'] ?? null,
            ]);
            $this->avocat = (new AvocatModel())->findByUserId((int) Auth::id());
        }
    }

    public function index()
    {
        $articleModel = new ArticleModel();
        View::view('lawyers.dashboard', [
            'avocat' => $this->avocat,
            'stats' => [
                'published' => $articleModel->countByStatut('publie', (int) $this->avocat['id']),
                'draft' => $articleModel->countByStatut('brouillon', (int) $this->avocat['id']),
            ],
            'notifications' => (new NotificationModel())->unreadCount((int) Auth::id()),
        ]);
    }

    public function articles()
    {
        View::view('lawyers.articles', [
            'articles' => (new ArticleModel())->byAvocatId((int) $this->avocat['id']),
            'categories' => (new CategoryModel())->all(),
            'csrf' => Security::csrf_tokken(),
        ]);
    }

    public function storeArticle()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/lawyers/articles'));
            return;
        }

        $data = [
            'avocat_id' => (int) $this->avocat['id'],
            'category_id' => (int) ($_POST['category_id'] ?? 0) ?: null,
            'titre' => $this->sanitaze($_POST['titre'] ?? ''),
            'extrait' => $this->sanitaze($_POST['extrait'] ?? ''),
            'contenu' => $_POST['contenu'] ?? '',
            'statut' => $this->sanitaze($_POST['statut'] ?? 'brouillon'),
        ];

        try {
            if (!empty($_FILES['image']['name'])) {
                $img = FileStorage::storeUpload($_FILES['image'], 'images/articles', 'article');
                $data['image_couverture'] = $img['fichier'];
            }
        } catch (\RuntimeException $e) {
            $this->error($e->getMessage());
            $this->redirect(Router::route('/lawyers/articles'));
            return;
        }

        (new ArticleModel())->create($data);
        $_SESSION['success'] = 'Article enregistré.';
        $this->redirect(Router::route('/lawyers/articles'));
    }

    public function updateArticle($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/lawyers/articles'));
            return;
        }

        $id = (int) ($params['id'] ?? 0);
        $article = (new ArticleModel())->findById($id);
        if (!$article || (int) $article['avocat_id'] !== (int) $this->avocat['id']) {
            $this->redirect(Router::route('/lawyers/articles'));
            return;
        }

        $data = [
            'category_id' => (int) ($_POST['category_id'] ?? 0) ?: null,
            'titre' => $this->sanitaze($_POST['titre'] ?? ''),
            'extrait' => $this->sanitaze($_POST['extrait'] ?? ''),
            'contenu' => $_POST['contenu'] ?? '',
            'statut' => $this->sanitaze($_POST['statut'] ?? 'brouillon'),
        ];

        if (!empty($_FILES['image']['name'])) {
            try {
                $img = FileStorage::storeUpload($_FILES['image'], 'images/articles', 'article');
                $data['image_couverture'] = $img['fichier'];
            } catch (\RuntimeException $e) {
                $this->error($e->getMessage());
                $this->redirect(Router::route('/lawyers/articles'));
                return;
            }
        }

        (new ArticleModel())->update($id, $data);
        $_SESSION['success'] = 'Article mis à jour.';
        $this->redirect(Router::route('/lawyers/articles'));
    }

    public function profile()
    {
        View::view('lawyers.profile', [
            'avocat' => $this->avocat,
            'specialites' => (new \App\models\SpecialiteModel())->all(),
            'csrf' => Security::csrf_tokken(),
        ]);
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/lawyers/profile'));
            return;
        }

        (new AvocatModel())->update((int) $this->avocat['id'], [
            'titre' => $this->sanitaze($_POST['titre'] ?? ''),
            'email_professionnel' => $this->sanitaze($_POST['email_professionnel'] ?? ''),
            'bio' => $this->sanitaze($_POST['bio'] ?? ''),
            'experience' => (int) ($_POST['experience'] ?? 0) ?: null,
            'bureau' => $this->sanitaze($_POST['bureau'] ?? ''),
        ]);

        $specIds = array_map('intval', $_POST['specialites'] ?? []);
        (new AvocatModel())->setSpecialites((int) $this->avocat['id'], $specIds);

        $_SESSION['success'] = 'Profil mis à jour.';
        $this->redirect(Router::route('/lawyers/profile'));
    }

    public function trainings()
    {
        $formationModel = new FormationModel();
        View::view('lawyers.trainings', [
            'formations' => $formationModel->all('avocat'),
            'inscriptions' => (new InscriptionModel())->byUserId((int) Auth::id()),
            'csrf' => Security::csrf_tokken(),
        ]);
    }

    public function enrollTraining()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/lawyers/trainings'));
            return;
        }

        $formationId = (int) ($_POST['formation_id'] ?? 0);
        $inscriptionModel = new InscriptionModel();

        if (!$formationId || $inscriptionModel->exists($formationId, (int) Auth::id())) {
            $this->error('Inscription impossible.');
            $this->redirect(Router::route('/lawyers/trainings'));
            return;
        }

        if (!(new FormationModel())->hasPlaces($formationId)) {
            $this->error('Plus de places disponibles.');
            $this->redirect(Router::route('/lawyers/trainings'));
            return;
        }

        $inscriptionModel->create($formationId, (int) Auth::id(), $this->sanitaze($_POST['message'] ?? ''));
        $_SESSION['success'] = 'Demande d\'inscription envoyée.';
        $this->redirect(Router::route('/lawyers/trainings'));
    }

    public function documents()
    {
        View::view('lawyers.documents');
    }

    public function settings()
    {
        View::view('lawyers.settings');
    }

    public function notifications()
    {
        $notifModel = new NotificationModel();
        View::view('lawyers.notifications', [
            'notifications' => $notifModel->byUserId((int) Auth::id()),
            'unread' => $notifModel->unreadCount((int) Auth::id()),
        ]);
    }
}
