<?php

namespace App\controllers;

use App\models\ArticleModel;
use App\models\AvocatModel;
use App\models\CategoryModel;
use App\models\UserModel;
use App\models\FormationModel;
use App\models\InscriptionModel;
use App\models\MediaModel;
use App\models\NotificationModel;
use App\models\SpecialiteModel;
use App\View;
use Core\Auth;
use Core\Security;
use Router\Router;
use Service\FileStorage;

class LawyerController extends Controller
{
    private ?array $avocat = null;
    private const ARTICLE_STATUTS = ['brouillon', 'publie', 'archive'];

    public function __construct()
    {
        // Allow public profile without authentication
        $currentMethod = $_SERVER['REQUEST_URI'] ?? '';
        if (strpos($currentMethod, '/avocat/') === 0) {
            return;
        }

        if (!Auth::hasRole(Auth::ROLE_LAWYER)) {
            $this->redirect(Router::route('/login'));
            exit;
        }
        $this->avocat = (new AvocatModel())->findByUserId((int) Auth::id());

        if (!$this->avocat) {
            $this->redirect(Router::route('/login'));
            exit;
        }
    }

    public function index()
    {
        $userId = (int) Auth::id();
        $avocatId = (int) $this->avocat['id'];

        $articleModel = new ArticleModel();
        $mediaModel = new MediaModel();
        $inscriptionModel = new InscriptionModel();
        $notificationModel = new NotificationModel();

        // Statistiques dynamiques
        $stats = [
            'publications' => $articleModel->countByStatut('publie', $avocatId),
            'documents' => count($mediaModel->byUserId($userId, 'document')),
            'trainings' => count($inscriptionModel->byUserId($userId)),
            'activities' => $notificationModel->unreadCount($userId),
        ];

        // Activités récentes (notifications des 7 derniers jours)
        $recentActivities = $notificationModel->recentByUserId($userId, 7, 5);

        // Publications récentes (3 derniers articles)
        $recentArticles = $articleModel->recentByAvocatId($avocatId, 3);

        // Documents récents (3 derniers documents)
        $recentDocuments = $mediaModel->recentByUserId($userId, 'document', 3);

        // Formations disponibles
        $formations = (new FormationModel())->availableForPublic('avocat');

        View::view('lawyers.dashboard', [
            'avocat' => $this->avocat,
            'stats' => $stats,
            'recentActivities' => $recentActivities,
            'recentArticles' => $recentArticles,
            'recentDocuments' => $recentDocuments,
            'availableTrainings' => $formations,
            'notifications' => $notificationModel->unreadCount($userId),
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

        $statut = $this->sanitaze($_POST['statut'] ?? 'brouillon');
        if (!in_array($statut, self::ARTICLE_STATUTS, true)) {
            $statut = 'brouillon';
        }

        $data = [
            'avocat_id' => (int) $this->avocat['id'],
            'category_id' => (int) ($_POST['category_id'] ?? 0) ?: null,
            'titre' => $this->sanitaze($_POST['titre'] ?? ''),
            'extrait' => $this->sanitaze($_POST['extrait'] ?? ''),
            'contenu' => $this->sanitaze($_POST['contenu'] ?? ''),
            'statut' => $statut,
        ];

        if (trim($data['titre']) === '' || trim($data['contenu']) === '') {
            $this->error('Le titre et le contenu sont obligatoires.');
            $this->redirect(Router::route('/lawyers/articles'));
            return;
        }

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

        // Upload PDF
        try {
            if (!empty($_FILES['pdf_file']['name'])) {
                $pdf = FileStorage::storeUpload($_FILES['pdf_file'], 'documents/articles', 'article');
                $data['pdf_file'] = $pdf['fichier'];
            }
        } catch (\RuntimeException $e) {
            $this->error($e->getMessage());
            $this->redirect(Router::route('/lawyers/articles'));
            return;
        }

        try {
            (new ArticleModel())->create($data);
            $_SESSION['success'] = 'Article enregistré.';
        } catch (\Throwable $e) {
            $this->error('Impossible d\'enregistrer l\'article. Vérifiez les champs puis réessayez.');
        }
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

        $statut = $this->sanitaze($_POST['statut'] ?? 'brouillon');
        if (!in_array($statut, self::ARTICLE_STATUTS, true)) {
            $statut = 'brouillon';
        }

        $data = [
            'category_id' => (int) ($_POST['category_id'] ?? 0) ?: null,
            'titre' => $this->sanitaze($_POST['titre'] ?? ''),
            'extrait' => $this->sanitaze($_POST['extrait'] ?? ''),
            'contenu' => $this->sanitaze($_POST['contenu'] ?? ''),
            'statut' => $statut,
        ];

        if (trim($data['titre']) === '' || trim($data['contenu']) === '') {
            $this->error('Le titre et le contenu sont obligatoires.');
            $this->redirect(Router::route('/lawyers/articles'));
            return;
        }

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

        // Upload PDF
        if (!empty($_FILES['pdf_file']['name'])) {
            try {
                $pdf = FileStorage::storeUpload($_FILES['pdf_file'], 'documents/articles', 'article');
                $data['pdf_file'] = $pdf['fichier'];
            } catch (\RuntimeException $e) {
                $this->error($e->getMessage());
                $this->redirect(Router::route('/lawyers/articles'));
                return;
            }
        }

        try {
            (new ArticleModel())->update($id, $data);
            $_SESSION['success'] = 'Article mis à jour.';
        } catch (\Throwable $e) {
            $this->error('Impossible de mettre à jour l\'article.');
        }
        $this->redirect(Router::route('/lawyers/articles'));
    }

    public function deleteArticle($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/lawyers/articles'));
            return;
        }

        $id = (int) ($params['id'] ?? 0);
        $article = (new ArticleModel())->findById($id);
        if (!$article || (int) $article['avocat_id'] !== (int) $this->avocat['id']) {
            $this->error('Article introuvable.');
            $this->redirect(Router::route('/lawyers/articles'));
            return;
        }

        if (!empty($article['image_couverture'])) {
            FileStorage::delete((string) $article['image_couverture']);
        }

        (new ArticleModel())->delete($id);
        $_SESSION['success'] = 'Article supprimé.';
        $this->redirect(Router::route('/lawyers/articles'));
    }

    public function profile()
    {
        $userId = (int) Auth::id();
        $avocatId = (int) $this->avocat['id'];

        $articleModel = new ArticleModel();
        $mediaModel = new MediaModel();
        $avocatModel = new AvocatModel();

        // Statistiques dynamiques pour le profil
        $profileStats = [
            'cases' => 0, // Pas de table dossiers dans le schema
            'clients' => 0, // Pas de table clients dans le schema  
            'publications' => $articleModel->countByStatut('publie', $avocatId),
            'articles' => count($articleModel->byAvocatId($avocatId)),
            'draft' => $articleModel->countByStatut('brouillon', $avocatId),
            'documents' => count($mediaModel->byUserId($userId, 'document')),
        ];

        View::view('lawyers.profile', [
            'avocat' => $this->avocat,
            'specialites' => (new SpecialiteModel())->all(),
            'selectedSpecialites' => $avocatModel->specialiteIds($avocatId),
            'profileStats' => $profileStats,
            'csrf' => Security::csrf_tokken(),
        ]);
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/lawyers/profile'));
            return;
        }

        // Update users table (fullname, telephone)
        $userData = [];
        if (!empty($_POST['fullname'])) {
            $userData['fullname'] = $this->sanitaze($_POST['fullname']);
        }
        if (!empty($_POST['telephone'])) {
            $userData['telephone'] = $this->sanitaze($_POST['telephone']);
        }
        if (!empty($userData)) {
            (new UserModel())->update((int) Auth::id(), $userData);
        }

        // Update avocats table (email_professionnel, bio, bureau, titre, experience)
        $avocatData = [
            'email_professionnel' => $this->sanitaze($_POST['email_professionnel'] ?? ''),
            'bio' => $this->sanitaze($_POST['bio'] ?? ''),
            'bureau' => $this->sanitaze($_POST['bureau'] ?? ''),
        ];

        // Ajouter titre et experience si présents
        if (isset($_POST['titre'])) {
            $avocatData['titre'] = $this->sanitaze($_POST['titre']);
        }
        if (isset($_POST['experience'])) {
            $avocatData['experience'] = (int) $_POST['experience'];
        }

        (new AvocatModel())->update((int) $this->avocat['id'], $avocatData);

        $_SESSION['success'] = 'Profil mis à jour.';
        $this->redirect(Router::route('/lawyers/profile'));
    }

    public function updateAvatar()
    {
        // Debug logging
        \Helper\Log\Logger::info('updateAvatar: debut', [
            'method' => $_SERVER['REQUEST_METHOD'],
            'files' => !empty($_FILES) ? array_keys($_FILES) : 'empty',
            'post' => isset($_POST) ? 'has post data' : 'no post data'
        ]);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            \Helper\Log\Logger::warning('updateAvatar: pas POST');
            $this->redirect(Router::route('/lawyers/profile'));
            return;
        }

        if (!Security::verify_csrf_token()) {
            \Helper\Log\Logger::warning('updateAvatar: CSRF invalide');
            $_SESSION['error'] = 'Token de sécurité invalide.';
            $this->redirect(Router::route('/lawyers/profile'));
            return;
        }

        if (empty($_FILES['avatar']) || empty($_FILES['avatar']['name'])) {
            \Helper\Log\Logger::warning('updateAvatar: pas de fichier');
            $_SESSION['error'] = 'Aucune image sélectionnée.';
            $this->redirect(Router::route('/lawyers/profile'));
            return;
        }

        try {
            $userId = (int) Auth::id();
            \Helper\Log\Logger::debug('updateAvatar: upload pour user', ['userId' => $userId]);

            $stored = FileStorage::storeUpload($_FILES['avatar'], 'images/avatars', 'avatar_' . $userId);

            \Helper\Log\Logger::info('updateAvatar: fichier stocke', ['fichier' => $stored['fichier']]);

            // Update avatar in users table
            (new UserModel())->update($userId, [
                'avatar' => $stored['fichier']
            ]);

            $_SESSION['success'] = 'Photo de profil mise à jour.';
            \Helper\Log\Logger::info('updateAvatar: succes');
        } catch (\RuntimeException $e) {
            \Helper\Log\Logger::error('updateAvatar: erreur', ['message' => $e->getMessage()]);
            $this->error($e->getMessage());
        }

        $this->redirect(Router::route('/lawyers/profile'));
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
        foreach ((new FormationModel())->availableForPublic('avocat') as $formation) {
            if (!in_array((int) ($formation['id'] ?? 0), $inscriptionsFormationIds, true)) {
                $formationsDisponibles[] = $formation;
            }
        }

        View::view('lawyers.trainings', [
            'formationsDisponibles' => $formationsDisponibles,
            'inscriptionsEnCours' => $inscriptionsEnCours,
            'inscriptions' => $inscriptions,
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

        $formationModel = new FormationModel();
        if (!$formationModel->findAvailableForPublic($formationId, 'avocat')) {
            $this->error('Plus de places disponibles.');
            $this->redirect(Router::route('/lawyers/trainings'));
            return;
        }

        if (!$formationModel->reservePlace($formationId)) {
            $this->error('Plus de places disponibles.');
            $this->redirect(Router::route('/lawyers/trainings'));
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

        $this->redirect(Router::route('/lawyers/trainings'));
    }

    public function documents()
    {
        View::view('lawyers.documents', [
            'documents' => (new MediaModel())->byUserId((int) Auth::id(), 'document'),
            'csrf' => Security::csrf_tokken(),
        ]);
    }

    public function storeDocument()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/lawyers/documents'));
            return;
        }

        try {
            if (empty($_FILES['fichier']['name'])) {
                throw new \RuntimeException('Veuillez choisir un fichier PDF.');
            }

            $stored = FileStorage::storeUpload($_FILES['fichier'], 'documents/avocats', 'av_' . Auth::id());
            (new MediaModel())->create([
                'nom' => $this->sanitaze($_POST['nom'] ?? $_FILES['fichier']['name']),
                'fichier' => $stored['fichier'],
                'mime' => $stored['mime'],
                'taille' => $stored['taille'],
                'type' => 'document',
                'user_id' => (int) Auth::id(),
                'est_public' => isset($_POST['est_public']) ? 1 : 0,
            ]);
            $_SESSION['success'] = 'Document ajouté.';
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
        }

        $this->redirect(Router::route('/lawyers/documents'));
    }

    public function updateDocument($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/lawyers/documents'));
            return;
        }

        $id = (int) ($params['id'] ?? 0);
        $doc = (new MediaModel())->findById($id);
        if (!$doc || (int) ($doc['user_id'] ?? 0) !== (int) Auth::id() || ($doc['type'] ?? '') !== 'document') {
            $this->error('Document introuvable.');
            $this->redirect(Router::route('/lawyers/documents'));
            return;
        }

        $update = [
            'nom' => $this->sanitaze($_POST['nom'] ?? ''),
            'est_public' => isset($_POST['est_public']) ? 1 : 0,
        ];

        (new MediaModel())->update($id, $update);
        $_SESSION['success'] = 'Document mis à jour.';
        $this->redirect(Router::route('/lawyers/documents'));
    }

    public function deleteDocument($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/lawyers/documents'));
            return;
        }

        $id = (int) ($params['id'] ?? 0);
        $doc = (new MediaModel())->findById($id);
        if (!$doc || (int) ($doc['user_id'] ?? 0) !== (int) Auth::id() || ($doc['type'] ?? '') !== 'document') {
            $this->error('Document introuvable.');
            $this->redirect(Router::route('/lawyers/documents'));
            return;
        }

        if (!empty($doc['fichier'])) {
            FileStorage::delete((string) $doc['fichier']);
        }
        (new MediaModel())->delete($id);
        $_SESSION['success'] = 'Document supprimé.';
        $this->redirect(Router::route('/lawyers/documents'));
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

    public function markNotificationRead($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/lawyers/notifications'));
            return;
        }

        $id = (int) ($params['id'] ?? 0);
        if ($id > 0) {
            (new NotificationModel())->markRead($id, (int) Auth::id());
        }

        $this->redirect(Router::route('/lawyers/notifications'));
    }

    public function markAllNotificationsRead()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/lawyers/notifications'));
            return;
        }

        (new NotificationModel())->markAllRead((int) Auth::id());
        $this->redirect(Router::route('/lawyers/notifications'));
    }

    public function publicProfile($params)
    {
        $id = (int) ($params['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect(Router::route('/'));
            return;
        }

        $avocat = (new AvocatModel())->findById($id);
        if (!$avocat) {
            $this->redirect(Router::route('/'));
            return;
        }

        View::view('lawyers.public-profile', [
            'title' => htmlspecialchars($avocat['fullname'] ?? 'Avocat') . ' | ELMD',
            'avocat' => $avocat,
        ]);
    }
}
