<?php
/**
 * Script de test pour l'envoi d'email
 * Exécuter: php public/test-email.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

echo "=== Test d'envoi d'email ===\n\n";

// Charger les variables d'environnement avec Dotenv
$envPath = __DIR__ . '/..';
if (file_exists($envPath . '/.env')) {
    $dotenv = Dotenv::createImmutable($envPath);
    $dotenv->load();
}

echo "Configuration:\n";
echo "- HOST: " . ($_ENV['MAIL_HOST'] ?? 'NON CONFIGURÉ') . "\n";
echo "- USER: " . ($_ENV['MAIL_USER'] ?? 'NON CONFIGURÉ') . "\n";
echo "- PASS: " . (empty($_ENV['MAIL_PASS']) ? 'VIDE' : '[CONFIGURÉ]') . "\n";
echo "- FROM: " . ($_ENV['MAIL_FROM'] ?? 'NON CONFIGURÉ') . "\n\n";

if (empty($_ENV['MAIL_HOST']) || empty($_ENV['MAIL_USER']) || empty($_ENV['MAIL_PASS'])) {
    echo "❌ ERREUR: Les variables email ne sont pas configurées dans .env\n";
    exit(1);
}

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $_ENV['MAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['MAIL_USER'];
    $mail->Password = $_ENV['MAIL_PASS'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_NAME'] ?? 'Cabinet ELMD');
    $mail->addAddress($_ENV['MAIL_USER']);

    $mail->isHTML(true);
    $mail->Subject = 'Test Cabinet ELMD - ' . date('d/m/Y H:i:s');
    $mail->Body = '<h2>Test d\'email</h2><p>Cet email confirme que l\'envoi fonctionne.</p>';
    $mail->AltBody = 'Test d\'email';

    echo "Envoi en cours...\n";
    $mail->send();
    echo "✅ SUCCÈS: Email envoyé à " . $_ENV['MAIL_USER'] . "\n";
    echo "Vérifiez votre boîte de réception (y compris spams).\n";

} catch (Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
    
    if (strpos($e->getMessage(), 'Invalid address') !== false) {
        echo "\n→ Vérifiez que MAIL_FROM est une adresse email valide.\n";
    }
    if (strpos($e->getMessage(), 'SMTP connect()') !== false) {
        echo "\n→ Vérifiez votre connexion internet.\n";
        echo "→ Vérifiez que le port 587 n'est pas bloqué.\n";
    }
    if (strpos($e->getMessage(), 'Authentication') !== false) {
        echo "\n→ Le mot de passe ou identifiant est incorrect.\n";
        echo "→ Assurez-vous d'utiliser un 'Mot de passe d'application' Google.\n";
    }
}
