<?php

namespace App\controllers;

use App\models\InternshipApplicationModel;
use App\models\InternshipDocumentModel;
use App\View;
use Core\Auth;
use Core\Security;
use Router\Router;
use Service\FileStorage;
use Service\Messagerie;

class HomeController extends Controller
{
    public function index()
    {
        View::view('index');
    }

    public function login()
    {
        if (Auth::check() && isset($_SESSION['user_db_role'])) {
            header('Location: ' . Auth::redirectUrlForDbRole($_SESSION['user_db_role']));
            exit;
        }

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        View::view('login', [
            'title' => 'Connexion | ELMD - Cabinet d\'Avocats',
            'error' => $error,
            'rememberEmail' => $_COOKIE['remember_email'] ?? '',
        ]);
    }

    public function stages()
    {
        View::view('stages', [
            'csrf' => Security::csrf_tokken(),
            'applyUrl' => Router::route('/stages/candidature'),
        ]);
    }

    public function applyInternship()
    {
        header('Content-Type: application/json; charset=utf-8');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
            return;
        }

        if (!Security::verify_csrf_token()) {
            http_response_code(419);
            echo json_encode(['success' => false, 'message' => 'Session expirée. Rafraîchissez la page.']);
            return;
        }

        $fullName = trim($this->sanitaze($_POST['fullName'] ?? $_POST['fullname'] ?? ''));
        $parts = preg_split('/\s+/', $fullName, 2, PREG_SPLIT_NO_EMPTY);
        $prenom = $parts[0] ?? $fullName;
        $nom = $parts[1] ?? $parts[0] ?? 'Candidat';

        $levelMap = [
            'm1' => 'M1',
            'm2' => 'M2',
            'doctorat' => 'Doctorat',
            'l3' => 'L3',
        ];
        $level = strtolower($_POST['level'] ?? 'm2');

        $fieldLabels = [
            'droit-affaires' => 'Droit des Affaires',
            'droit-international' => 'Droit International',
            'droit-fiscal' => 'Droit Fiscal',
            'droit-prive' => 'Droit Privé',
            'droit-public' => 'Droit Public',
            'autre' => 'Autre',
        ];
        $fieldKey = $_POST['field'] ?? 'autre';

        try {
            $appId = (new InternshipApplicationModel())->create([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $this->sanitaze($_POST['email'] ?? ''),
                'telephone' => $this->sanitaze($_POST['phone'] ?? $_POST['telephone'] ?? ''),
                'universite' => $this->sanitaze($_POST['university'] ?? ''),
                'filiere' => $fieldLabels[$fieldKey] ?? $this->sanitaze($fieldKey),
                'niveau_etude' => $levelMap[$level] ?? 'M2',
                'departement_souhaite' => $fieldLabels[$fieldKey] ?? $this->sanitaze($fieldKey),
                'motivation' => $this->sanitaze($_POST['motivation'] ?? 'Candidature transmise via le formulaire en ligne.'),
            ]);

            $docModel = new InternshipDocumentModel();
            $uploads = [
                'cv' => $_FILES['cvFile'] ?? $_FILES['cv'] ?? null,
                'lettre' => $_FILES['letterFile'] ?? $_FILES['lettre'] ?? null,
                'academique' => $_FILES['academicFile'] ?? $_FILES['academique'] ?? null,
            ];

            foreach ($uploads as $type => $file) {
                if ($file && ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK) {
                    $stored = FileStorage::storeUpload($file, 'documents/candidatures', $type . '_' . $appId);
                    $docModel->create($appId, $type, $stored);
                }
            }

            (new Messagerie())->notifyApplicationReceived(
                $this->sanitaze($_POST['email'] ?? ''),
                $fullName ?: $nom
            );

            echo json_encode(['success' => true, 'message' => 'Candidature envoyée avec succès.']);
        } catch (\Throwable $e) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function domaines()
    {
        View::view('domaines');
    }

    public function droitOhada()
    {
        View::view('droit-ohada');
    }

    public function droitMinier()
    {
        View::view('droit-minier');
    }

    public function droitTravail()
    {
        View::view('droit-travail');
    }

    public function droitFiscal()
    {
        View::view('droit-fiscal');
    }

    public function administrationAffaires()
    {
        View::view('administration-affaires');
    }

    public function autresDomaines()
    {
        View::view('autres-domaines');
    }
}
