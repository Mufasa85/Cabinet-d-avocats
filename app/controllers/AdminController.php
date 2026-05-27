<?php

namespace App\controllers;

use App\models\AvocatModel;
use App\models\FormationModel;
use App\models\InscriptionModel;
use App\models\InternshipApplicationModel;
use App\models\InternshipDocumentModel;
use App\models\NotificationModel;
use App\models\PublicationModel;
use App\models\SpecialiteModel;
use App\models\StagiaireDocumentModel;
use App\models\StagiaireModel;
use App\models\UserModel;
use App\View;
use Core\Auth;
use Core\Security;
use Helper\String\Stringy;
use Router\Router;
use Service\FileStorage;
use Service\Messagerie;

class AdminController extends Controller
{
    public function __construct()
    {
        if (!Auth::hasRole(Auth::ROLE_ADMIN)) {
            $this->redirect(Router::route('/login'));
            exit;
        }
    }

    public function index()
    {
        $userModel = new UserModel();
        $avocatModel = new AvocatModel();
        $appModel = new InternshipApplicationModel();
        $inscriptionModel = new InscriptionModel();

        View::view('admin.dashboard', [
            'stats' => [
                'users' => $userModel->count(),
                'lawyers' => $avocatModel->count(),
                'pending' => $appModel->countPending() + $inscriptionModel->countPending(),
                'documents' => count((new StagiaireDocumentModel())->allForAdmin('en_attente')),
            ],
            'recentApplications' => $appModel->recent(5),
        ]);
    }

    public function users()
    {
        $users = new UserModel();
        View::view('admin.users', [
            'users' => $users->all(),
            'success' => $_SESSION['success'] ?? null,
            'error' => $_SESSION['error'] ?? null,
        ]);
        unset($_SESSION['success'], $_SESSION['error']);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        $fullname = $this->sanitaze($_POST['fullname'] ?? '');
        $email = $this->sanitaze($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $role = $this->sanitaze($_POST['role'] ?? 'stagiaire');
        $telephone = $this->sanitaze($_POST['telephone'] ?? '');
        $is_active = isset($_POST['is_active']) ? (int) $_POST['is_active'] : 1;

        if (!in_array($role, Auth::DB_ROLES, true)) {
            $this->error('Rôle invalide.');
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        $userModel = new UserModel();
        if ($userModel->findByEmail($email)) {
            $this->error('Cet email est déjà utilisé.');
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        $userModel->create([
            'fullname' => $fullname,
            'email' => $email,
            'password' => $password,
            'roles' => $role,
            'telephone' => $telephone ?: null,
            'is_active' => $is_active,
        ]);

        $_SESSION['success'] = 'Utilisateur créé.';
        $this->redirect(Router::route('/admin/users'));
    }

    public function updateUser($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        $id = (int) ($params['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        // Validation du mot de passe si fourni
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['password_confirmation'] ?? '';

        if (!empty($password) || !empty($confirmPassword)) {
            if ($password !== $confirmPassword) {
                $this->error('Les mots de passe ne correspondent pas.');
                $this->redirect(Router::route('/admin/users'));
                return;
            }
            if (!Stringy::lengthError($password, 8, 64)) {
                $this->error('Le mot de passe doit contenir entre 8 et 64 caractères.');
                $this->redirect(Router::route('/admin/users'));
                return;
            }
        }

        $role = $this->sanitaze($_POST['role'] ?? '');
        if ($role !== '' && !in_array($role, Auth::DB_ROLES, true)) {
            $this->error('Rôle invalide.');
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        $updateData = [
            'fullname' => $this->sanitaze($_POST['fullname'] ?? ''),
            'email' => $this->sanitaze($_POST['email'] ?? ''),
            'roles' => $role,
            'telephone' => $this->sanitaze($_POST['telephone'] ?? ''),
            'is_active' => isset($_POST['is_active']) ? (int) $_POST['is_active'] : null,
        ];

        // Ajouter le password seulement s'il est fourni
        if (!empty($password)) {
            $updateData['password'] = $password;
        }

        (new UserModel())->update($id, $updateData);

        $_SESSION['success'] = 'Utilisateur mis à jour.';
        $this->redirect(Router::route('/admin/users'));
    }

    public function deleteUser($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/users'));
            return;
        }

        $id = (int) ($params['id'] ?? 0);
        if ($id > 0 && $id !== Auth::id()) {
            (new UserModel())->delete($id);
            $_SESSION['success'] = 'Utilisateur supprimé.';
        }
        $this->redirect(Router::route('/admin/users'));
    }

    public function lawyers()
    {
        View::view('admin.lawyers', [
            'lawyers' => (new AvocatModel())->allWithUser(),
            'specialites' => (new SpecialiteModel())->all(),
            'success' => $_SESSION['success'] ?? null,
            'error' => $_SESSION['error'] ?? null,
        ]);
        unset($_SESSION['success'], $_SESSION['error']);
    }

    public function storeLawyer()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/lawyers'));
            return;
        }

        $userModel = new UserModel();
        $email = $this->sanitaze($_POST['email'] ?? '');
        if ($userModel->findByEmail($email)) {
            $this->error('Email déjà utilisé.');
            $this->redirect(Router::route('/admin/lawyers'));
            return;
        }

        $userModel->create([
            'fullname' => $this->sanitaze($_POST['fullname'] ?? ''),
            'email' => $email,
            'password' => $_POST['password'] ?? 'avocat123',
            'roles' => 'avocat',
            'telephone' => $this->sanitaze($_POST['telephone'] ?? ''),
            'is_active' => 1,
        ]);

        $user = $userModel->findByEmail($email);
        $userId = (int) ($user['id'] ?? 0);
        if (!$userId) {
            $this->error('Erreur création utilisateur.');
            $this->redirect(Router::route('/admin/lawyers'));
            return;
        }

        $avocatId = (new AvocatModel())->createForUser($userId, [
            'titre' => $this->sanitaze($_POST['titre'] ?? 'Avocat'),
            'email_professionnel' => $email,
            'bio' => $this->sanitaze($_POST['bio'] ?? ''),
            'experience' => (int) ($_POST['experience'] ?? 0) ?: null,
            'bureau' => $this->sanitaze($_POST['bureau'] ?? ''),
        ]);

        $specIds = array_map('intval', $_POST['specialites'] ?? []);
        if ($specIds) {
            (new AvocatModel())->setSpecialites($avocatId, $specIds);
        }

        $_SESSION['success'] = 'Avocat ajouté.';
        $this->redirect(Router::route('/admin/lawyers'));
    }

    public function updateLawyer($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/lawyers'));
            return;
        }

        $id = (int) ($params['id'] ?? 0);
        (new AvocatModel())->update($id, [
            'titre' => $this->sanitaze($_POST['titre'] ?? ''),
            'email_professionnel' => $this->sanitaze($_POST['email_professionnel'] ?? ''),
            'bio' => $this->sanitaze($_POST['bio'] ?? ''),
            'experience' => (int) ($_POST['experience'] ?? 0) ?: null,
            'bureau' => $this->sanitaze($_POST['bureau'] ?? ''),
        ]);

        $specIds = array_map('intval', $_POST['specialites'] ?? []);
        (new AvocatModel())->setSpecialites($id, $specIds);

        $_SESSION['success'] = 'Profil avocat mis à jour.';
        $this->redirect(Router::route('/admin/lawyers'));
    }

    public function deleteLawyer($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/lawyers'));
            return;
        }

        $id = (int) ($params['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect(Router::route('/admin/lawyers'));
            return;
        }

        $avocat = (new AvocatModel())->findById($id);
        $userId = (int) ($avocat['user_id'] ?? 0);
        if ($userId > 0) {
            // Supprimer l'utilisateur supprime l'avocat (FK ON DELETE CASCADE).
            (new UserModel())->delete($userId);
            $_SESSION['success'] = 'Avocat supprimé.';
        }

        $this->redirect(Router::route('/admin/lawyers'));
    }

    public function candidatures()
    {
        $appModel = new InternshipApplicationModel();
        $docModel = new InternshipDocumentModel();
        $applications = $appModel->all();
        foreach ($applications as &$app) {
            $app['documents'] = $docModel->byApplicationId((int) $app['id']);
        }

        View::view('admin.candidatures', [
            'applications' => $applications,
            'success' => $_SESSION['success'] ?? null,
            'error' => $_SESSION['error'] ?? null,
        ]);
        unset($_SESSION['success'], $_SESSION['error']);
    }

    public function updateCandidature($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/candidatures'));
            return;
        }

        $id = (int) ($params['id'] ?? 0);
        $statut = $this->sanitaze($_POST['statut'] ?? '');
        $motif = $this->sanitaze($_POST['motif'] ?? '');

        if (!in_array($statut, ['en_attente', 'analyse', 'retenu', 'refuse'], true)) {
            $this->error('Statut invalide.');
            $this->redirect(Router::route('/admin/candidatures'));
            return;
        }

        $appModel = new InternshipApplicationModel();
        $app = $appModel->findById($id);
        if (!$app) {
            $this->redirect(Router::route('/admin/candidatures'));
            return;
        }

        $appModel->updateStatus($id, $statut);

        $name = trim(($app['prenom'] ?? '') . ' ' . ($app['nom'] ?? ''));
        (new Messagerie())->notifyApplicationStatus($app['email'], $name, $statut, $motif ?: null);

        $_SESSION['success'] = 'Candidature mise à jour.';
        $this->redirect(Router::route('/admin/candidatures'));
    }

    public function trainings()
    {
        View::view('admin.trainings', [
            'formations' => (new FormationModel())->all(),
            'inscriptions' => (new InscriptionModel())->pending(),
            'success' => $_SESSION['success'] ?? null,
            'error' => $_SESSION['error'] ?? null,
        ]);
        unset($_SESSION['success'], $_SESSION['error']);
    }

    public function storeFormation()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/trainings'));
            return;
        }

        (new FormationModel())->create([
            'titre' => $this->sanitaze($_POST['titre'] ?? ''),
            'description' => $this->sanitaze($_POST['description'] ?? ''),
            'date_debut' => $_POST['date_debut'] ?? null,
            'date_fin' => $_POST['date_fin'] ?? null,
            'lieu' => $this->sanitaze($_POST['lieu'] ?? ''),
            'places_max' => (int) ($_POST['places_max'] ?? 20),
            'public_cible' => $this->sanitaze($_POST['public_cible'] ?? 'tous'),
            'statut' => $this->sanitaze($_POST['statut'] ?? 'ouverte'),
        ]);

        $_SESSION['success'] = 'Formation créée.';
        $this->redirect(Router::route('/admin/trainings'));
    }

    public function updateInscription($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/trainings'));
            return;
        }

        $id = (int) ($params['id'] ?? 0);
        $statut = $this->sanitaze($_POST['statut'] ?? '');
        if (!in_array($statut, ['acceptee', 'refusee'], true)) {
            $this->redirect(Router::route('/admin/trainings'));
            return;
        }

        $inscriptionModel = new InscriptionModel();
        $inscription = $inscriptionModel->findById($id);
        $inscriptionModel->updateStatus($id, $statut, $this->sanitaze($_POST['motif'] ?? ''));

        if ($inscription) {
            $user = (new UserModel())->findById((int) $inscription['user_id']);
            $formation = (new FormationModel())->findById((int) $inscription['formation_id']);
            if ($user && $formation) {
                (new Messagerie())->notifyInscriptionStatus(
                    $user['email'],
                    $user['fullname'],
                    $formation['titre'],
                    $statut
                );
                (new NotificationModel())->create(
                    (int) $user['id'],
                    'inscription_formation',
                    'Inscription formation',
                    'Votre inscription à « ' . $formation['titre'] . ' » a été ' . ($statut === 'acceptee' ? 'acceptée' : 'refusée') . '.',
                    Router::route('/interns/trainings')
                );
            }
        }

        $_SESSION['success'] = 'Inscription traitée.';
        $this->redirect(Router::route('/admin/trainings'));
    }

    public function publications()
    {
        View::view('admin.publications', [
            'publications' => (new PublicationModel())->all(),
            'success' => $_SESSION['success'] ?? null,
            'error' => $_SESSION['error'] ?? null,
        ]);
        unset($_SESSION['success'], $_SESSION['error']);
    }

    public function storePublication()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/publications'));
            return;
        }

        $data = [
            'titre' => $this->sanitaze($_POST['titre'] ?? ''),
            'description' => $this->sanitaze($_POST['description'] ?? ''),
            'contenu' => $_POST['contenu'] ?? '',
            'type' => $this->sanitaze($_POST['type'] ?? 'autre'),
            'statut' => $this->sanitaze($_POST['statut'] ?? 'publie'),
            'cree_par' => Auth::id(),
        ];

        try {
            if (!empty($_FILES['fichier']['name'])) {
                $stored = FileStorage::storeUpload($_FILES['fichier'], 'documents/publications', 'pub');
                $data['fichier'] = $stored['fichier'];
            }
            if (!empty($_FILES['image']['name'])) {
                $img = FileStorage::storeUpload($_FILES['image'], 'images/publications', 'cover');
                $data['image_couverture'] = $img['fichier'];
            }
        } catch (\RuntimeException $e) {
            $this->error($e->getMessage());
            $this->redirect(Router::route('/admin/publications'));
            return;
        }

        (new PublicationModel())->create($data);
        $_SESSION['success'] = 'Publication enregistrée.';
        $this->redirect(Router::route('/admin/publications'));
    }

    public function documents()
    {
        View::view('admin.documents', [
            'documents' => (new StagiaireDocumentModel())->allForAdmin(),
            'stagiaires' => (new StagiaireModel())->allWithUser(),
            'success' => $_SESSION['success'] ?? null,
            'error' => $_SESSION['error'] ?? null,
            'csrf' => Security::csrf_tokken(),
        ]);
        unset($_SESSION['success'], $_SESSION['error']);
    }

    public function uploadDocument()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/documents'));
            return;
        }

        $stagiaireId = (int) ($_POST['stagiaire_id'] ?? 0);
        $titre = $this->sanitaze($_POST['titre'] ?? '');
        $type = $this->sanitaze($_POST['type'] ?? 'autre');

        if ($stagiaireId <= 0 || $titre === '') {
            $this->error('Stagiaire et titre sont obligatoires.');
            $this->redirect(Router::route('/admin/documents'));
            return;
        }

        $stagiaire = (new StagiaireModel())->findById($stagiaireId);
        if (!$stagiaire) {
            $this->error('Stagiaire introuvable.');
            $this->redirect(Router::route('/admin/documents'));
            return;
        }

        try {
            if (empty($_FILES['fichier']['name'])) {
                throw new \RuntimeException('Veuillez sélectionner un fichier PDF.');
            }
            $stored = FileStorage::storeUpload($_FILES['fichier'], 'documents/stagiaires', 'adm_stg_' . $stagiaireId);
            (new StagiaireDocumentModel())->create($stagiaireId, [
                'type' => $type,
                'titre' => $titre,
            ], $stored);
            $_SESSION['success'] = 'Document uploadé avec succès.';
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
        }

        $this->redirect(Router::route('/admin/documents'));
    }

    public function validateDocument($params)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/documents'));
            return;
        }

        $id = (int) ($params['id'] ?? 0);
        $statut = $this->sanitaze($_POST['statut'] ?? '');
        $motif = $this->sanitaze($_POST['motif'] ?? '');

        if (!in_array($statut, ['valide', 'rejete'], true)) {
            $this->redirect(Router::route('/admin/documents'));
            return;
        }

        $docModel = new StagiaireDocumentModel();
        $doc = $docModel->findById($id);
        if (!$doc) {
            $this->redirect(Router::route('/admin/documents'));
            return;
        }

        $docModel->updateStatus($id, $statut, (int) Auth::id(), $motif ?: null);

        (new Messagerie())->notifyDocumentStatus(
            $doc['email'],
            $doc['fullname'],
            $statut,
            $motif ?: null
        );

        (new NotificationModel())->create(
            (int) $doc['user_id'],
            $statut === 'valide' ? 'validation_document' : 'rejet_document',
            $statut === 'valide' ? 'Document validé' : 'Document refusé',
            'Votre document « ' . $doc['titre'] . ' » a été ' . ($statut === 'valide' ? 'validé' : 'refusé') . '.',
            Router::route('/interns/documents')
        );

        $_SESSION['success'] = 'Document traité.';
        $this->redirect(Router::route('/admin/documents'));
    }

    public function notifications()
    {
        $notifModel = new NotificationModel();
        View::view('admin.notifications', [
            'notifications' => $notifModel->byUserId((int) Auth::id()),
            'unread' => $notifModel->unreadCount((int) Auth::id()),
        ]);
    }

    public function settings()
    {
        View::view('admin.settings', [
            'admin' => (new UserModel())->findById((int) Auth::id()),
            'success' => $_SESSION['success'] ?? null,
            'error' => $_SESSION['error'] ?? null,
            'csrf' => Security::csrf_tokken(),
        ]);
        unset($_SESSION['success'], $_SESSION['error']);
    }

    public function updateSettingsProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/settings'));
            return;
        }

        $userId = (int) Auth::id();
        $name = trim($this->sanitaze($_POST['name'] ?? ''));
        $email = trim($this->sanitaze($_POST['email'] ?? ''));

        if ($name === '' || $email === '') {
            $this->error('Nom et email sont obligatoires.');
            $this->redirect(Router::route('/admin/settings'));
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Format d\'email invalide.');
            $this->redirect(Router::route('/admin/settings'));
            return;
        }

        $userModel = new UserModel();
        $existing = $userModel->findByEmail($email);
        if ($existing && (int) $existing['id'] !== $userId) {
            $this->error('Cet email est déjà utilisé.');
            $this->redirect(Router::route('/admin/settings'));
            return;
        }

        $userModel->update($userId, [
            'name' => $name,
            'email' => $email,
        ]);

        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;

        $_SESSION['success'] = 'Profil mis à jour.';
        $this->redirect(Router::route('/admin/settings'));
    }

    public function updateSettingsPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !Security::verify_csrf_token()) {
            $this->redirect(Router::route('/admin/settings'));
            return;
        }

        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($currentPassword === '' || $newPassword === '' || $confirmPassword === '') {
            $this->error('Tous les champs mot de passe sont obligatoires.');
            $this->redirect(Router::route('/admin/settings'));
            return;
        }

        if ($newPassword !== $confirmPassword) {
            $this->error('Le nouveau mot de passe et sa confirmation ne correspondent pas.');
            $this->redirect(Router::route('/admin/settings'));
            return;
        }

        if (!Stringy::lengthError($newPassword, 8, 64)) {
            $this->error('Le mot de passe doit contenir entre 8 et 64 caractères.');
            $this->redirect(Router::route('/admin/settings'));
            return;
        }

        $userModel = new UserModel();
        $user = $userModel->findAuthById((int) Auth::id());
        if (!$user || !password_verify($currentPassword, $user['passwords'])) {
            $this->error('Mot de passe actuel incorrect.');
            $this->redirect(Router::route('/admin/settings'));
            return;
        }

        $userModel->update((int) Auth::id(), ['password' => $newPassword]);
        $_SESSION['success'] = 'Mot de passe modifié avec succès.';
        $this->redirect(Router::route('/admin/settings'));
    }

    public function reports()
    {
        $applications = (new InternshipApplicationModel())->all();
        $inscriptionsPending = (new InscriptionModel())->countPending();
        $documents = (new StagiaireDocumentModel())->allForAdmin();
        $documentsValides = count(array_filter($documents, static fn (array $d): bool => ($d['statut'] ?? '') === 'valide'));
        $documentsAttente = count(array_filter($documents, static fn (array $d): bool => ($d['statut'] ?? '') === 'en_attente'));

        View::view('admin.reports', [
            'stats' => [
                'users' => (new UserModel())->count(),
                'avocats' => (new AvocatModel())->count(),
                'stagiaires' => (new StagiaireModel())->count(),
                'candidatures' => count($applications),
                'inscriptions_pending' => $inscriptionsPending,
                'documents_valides' => $documentsValides,
                'documents_attente' => $documentsAttente,
            ],
        ]);
    }
}
