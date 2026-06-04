<?php

use App\controllers\Controller;
use App\models\NotificationModel;
use App\models\UserModel;
use Router\Router;
use Container\Dic;

Router::get('/api', function () {
    Controller::status(200)->json(['message' => 'home api']);
});

// Route pour le formulaire de contact
Router::post('/api/contact', function () {
    // Autoriser les requêtes cross-origin
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-Type: application/json');

    // Gérer les requêtes preflight OPTIONS
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit(0);
    }

    // Vérifier la méthode
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        Controller::status(405)->json(['success' => false, 'message' => 'Méthode non autorisée.']);
        return;
    }

    try {
        // Récupérer et nettoyer les données
        $data = [
            'name' => trim(htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8')),
            'email' => trim(htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8')),
            'phone' => trim(htmlspecialchars($_POST['phone'] ?? '', ENT_QUOTES, 'UTF-8')),
            'subject' => trim(htmlspecialchars($_POST['subject'] ?? '', ENT_QUOTES, 'UTF-8')),
            'message' => trim(htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8')),
        ];

        // Validation
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Le nom est requis.';
        } elseif (strlen($data['name']) < 2 || strlen($data['name']) > 100) {
            $errors['name'] = 'Le nom doit contenir entre 2 et 100 caractères.';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'L\'email est requis.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Le format de l\'email est invalide.';
        }

        if (empty($data['message'])) {
            $errors['message'] = 'Le message est requis.';
        } elseif (strlen($data['message']) < 10) {
            $errors['message'] = 'Le message doit contenir au moins 10 caractères.';
        }

        if (!empty($errors)) {
            Controller::status(400)->json([
                'success' => false,
                'message' => 'Veuillez corriger les erreurs.',
                'errors' => $errors
            ]);
            return;
        }

        // Map subjects
        $subjects = [
            'affaires' => 'Droit des Affaires',
            'fiscal' => 'Droit Fiscal',
            'international' => 'Droit International',
            'social' => 'Droit Social',
            'ip' => 'Propriété Intellectuelle',
            'immobilier' => 'Droit Immobilier',
            'autre' => 'Autre',
        ];
        $subjectLabel = $subjects[$data['subject']] ?? ($data['subject'] ?: 'Contact');
        
        // Créer une notification pour l'admin
        $userModel = new UserModel();
        $adminUsers = $userModel->findByRole('admin');
        
        $notificationModel = new NotificationModel();
        
        $notificationTitle = 'Nouvelle demande de contact - ' . $subjectLabel;
        $notificationMessage = "<strong>De:</strong> " . $data['name'] . " (" . $data['email'] . ")<br>"
            . "<strong>Téléphone:</strong> " . ($data['phone'] ?: 'Non renseigné') . "<br>"
            . "<strong>Sujet:</strong> " . $subjectLabel . "<br><br>"
            . "<strong>Message:</strong><br>" . nl2br($data['message']);
        
        // Type autorisé: 'autre' car c'est le seul qui peut contenir des notifications personnalisées
        $notifType = 'autre';
        
        // Envoyer la notification à TOUS les admins
        foreach ($adminUsers as $admin) {
            $notificationModel->create(
                (int) $admin['id'],
                $notifType,
                $notificationTitle,
                $notificationMessage,
                '/admin/notifications'
            );
        }
        
        // Si aucun admin trouvé, créer pour l'utilisateur ID 1 par défaut
        if (empty($adminUsers)) {
            $notificationModel->create(
                1,
                $notifType,
                $notificationTitle,
                $notificationMessage,
                '/admin/notifications'
            );
        }

        Controller::status(200)->json([
            'success' => true,
            'message' => 'Votre demande a été envoyée avec succès. Nous vous répondrons dans les plus brefs délais.'
        ]);

    } catch (\Throwable $e) {
        error_log('[Contact API] Erreur: ' . $e->getMessage() . ' | Fichier: ' . $e->getFile() . ':' . $e->getLine());
        Controller::status(500)->json([
            'success' => false,
            'message' => 'Une erreur est survenue. Veuillez réessayer. (' . $e->getMessage() . ')'
        ]);
    }
});
?>
