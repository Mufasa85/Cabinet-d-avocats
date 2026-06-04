<?php

namespace Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

class Messagerie
{
    public function send(string $toEmail, string $toName, string $subject, string $bodyHtml): bool
    {
        if (empty($_ENV['MAIL_HOST']) || empty($_ENV['MAIL_USER'])) {
            error_log("[Messagerie] Mail non configuré — sujet: {$subject}, destinataire: {$toEmail}");
            return false;
        }

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USER'];
            $mail->Password = $_ENV['MAIL_PASS'] ?? '';
            $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'] ?? PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = (int) ($_ENV['MAIL_PORT'] ?? 587);
            $mail->CharSet = 'UTF-8';

            $mail->setFrom($_ENV['MAIL_FROM'] ?? $_ENV['MAIL_USER'], $_ENV['MAIL_FROM_NAME'] ?? 'Cabinet ELMD');
            $mail->addAddress($toEmail, $toName);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $bodyHtml;
            $mail->AltBody = strip_tags($bodyHtml);

            $mail->send();
            return true;
        } catch (MailException $e) {
            error_log('[Messagerie] ' . $e->getMessage());
            return false;
        }
    }

    public function notifyApplicationReceived(string $email, string $name): void
    {
        $this->send(
            $email,
            $name,
            'Candidature de stage reçue — Cabinet ELMD',
            '<p>Bonjour ' . htmlspecialchars($name) . ',</p>'
                . '<p>Nous avons bien reçu votre candidature de stage. Notre équipe l\'examinera sous 15 jours ouvrés.</p>'
                . '<p>Cordialement,<br>Cabinet ELMD</p>'
        );
    }

    public function notifyApplicationStatus(string $email, string $name, string $statut, ?string $motif = null): void
    {
        $labels = [
            'retenu' => 'acceptée',
            'refuse' => 'refusée',
            'analyse' => 'en cours d\'analyse',
        ];
        $label = $labels[$statut] ?? $statut;
        $body = '<p>Bonjour ' . htmlspecialchars($name) . ',</p>'
            . '<p>Votre candidature de stage a été <strong>' . htmlspecialchars($label) . '</strong>.</p>';
        if ($motif) {
            $body .= '<p><strong>Motif :</strong> ' . nl2br(htmlspecialchars($motif)) . '</p>';
        }
        $body .= '<p>Cordialement,<br>Cabinet ELMD</p>';

        $this->send($email, $name, 'Décision candidature stage — Cabinet ELMD', $body);
    }

    public function notifyDocumentStatus(string $email, string $name, string $statut, ?string $motif = null): void
    {
        $subject = $statut === 'valide'
            ? 'Document validé — Cabinet ELMD'
            : 'Document refusé — Cabinet ELMD';

        $body = '<p>Bonjour ' . htmlspecialchars($name) . ',</p>';
        if ($statut === 'valide') {
            $body .= '<p>Votre document a été <strong>validé</strong> par l\'administration du cabinet.</p>';
        } else {
            $body .= '<p>Votre document a été <strong>refusé</strong>.</p>';
            if ($motif) {
                $body .= '<p><strong>Motif :</strong> ' . nl2br(htmlspecialchars($motif)) . '</p>';
            }
        }
        $body .= '<p>Cordialement,<br>Cabinet ELMD</p>';

        $this->send($email, $name, $subject, $body);
    }

    public function sendStagiaireWelcome(string $email, string $name, string $tempPassword): void
    {
        $subject = 'Bienvenue au Cabinet ELMD - Vos identifiants';
        $body = "
            <h2>Bienvenue {$name},</h2>
            <p>Votre candidature a été acceptée ! Un compte staitaire vous a été créé.</p>
            <p><strong>Vos identifiants temporaires :</strong></p>
            <ul>
                <li>Email : {$email}</li>
                <li>Mot de passe : {$tempPassword}</li>
            </ul>
            <p>Veuillez vous connecter et changer votre mot de passe.</p>
            <p><a href='http://localhost/login'>Se connecter</a></p>
        ";
        $this->send($email, $name, $subject, $body);
    }

    public function notifyInscriptionStatus(string $email, string $name, string $formationTitre, string $statut): void
    {
        $accepted = $statut === 'acceptee';
        $this->send(
            $email,
            $name,
            ($accepted ? 'Inscription confirmée' : 'Inscription refusée') . ' — ' . $formationTitre,
            '<p>Bonjour ' . htmlspecialchars($name) . ',</p>'
                . '<p>Votre inscription à la formation <strong>' . htmlspecialchars($formationTitre) . '</strong> a été '
                . ($accepted ? '<strong>confirmée</strong>.' : '<strong>refusée</strong>.')
                . '</p><p>Cordialement,<br>Cabinet ELMD</p>'
        );
    }

    /**
     * Envoie une notification de demande de contact/rendez-vous
     */
    public function notifyContactRequest(array $data): bool
    {
        $toEmail = 'rmusafiri30@gmail.com';
        $toName = 'Cabinet ELMD';
        
        $subject = 'Nouvelle demande de contact - ' . htmlspecialchars($data['subject'] ?? 'Sans sujet');
        
        $body = "
            <h2>Nouvelle demande de contact</h2>
            <p><strong>Nom:</strong> " . htmlspecialchars($data['name'] ?? 'Non renseigné') . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($data['email'] ?? 'Non renseigné') . "</p>
            <p><strong>Téléphone:</strong> " . htmlspecialchars($data['phone'] ?? 'Non renseigné') . "</p>
            <p><strong>Sujet:</strong> " . htmlspecialchars($data['subject'] ?? 'Non renseigné') . "</p>
            <hr>
            <p><strong>Message:</strong></p>
            <p>" . nl2br(htmlspecialchars($data['message'] ?? '')) . "</p>
            <hr>
            <p><em>Ce message a été envoyé depuis le formulaire de contact du site ELMD.</em></p>
        ";
        
        $sent = $this->send($toEmail, $toName, $subject, $body);
        
        // Envoyer aussi un email de confirmation au client
        if ($sent && !empty($data['email'])) {
            $this->send(
                $data['email'],
                $data['name'] ?? 'Client',
                'Confirmation de réception - Cabinet ELMD',
                '<p>Bonjour ' . htmlspecialchars($data['name'] ?? '') . ',</p>'
                    . '<p>Nous avons bien reçu votre demande de contact. Notre équipe vous répondra dans les plus brefs délais.</p>'
                    . '<p><strong>Récapitulatif de votre demande:</strong></p>'
                    . '<p><em>' . nl2br(htmlspecialchars($data['message'] ?? '')) . '</em></p>'
                    . '<p>Cordialement,<br>Cabinet ELMD<br>Bâtonnier Laurent Mbako Ditend</p>'
            );
        }
        
        return $sent;
    }
}
