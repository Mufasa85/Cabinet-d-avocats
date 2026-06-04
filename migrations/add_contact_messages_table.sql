-- Migration: Ajouter la table contact_messages
-- Description: Stocke les demandes de contact envoyées depuis le formulaire du site
-- Date: 2026-06-04

CREATE TABLE IF NOT EXISTS `contact_messages` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL COMMENT 'Nom du demandeur',
    `email` VARCHAR(255) NOT NULL COMMENT 'Email du demandeur',
    `phone` VARCHAR(50) NULL COMMENT 'Téléphone du demandeur',
    `subject` VARCHAR(100) NULL COMMENT 'Sujet de la demande',
    `message` TEXT NOT NULL COMMENT 'Contenu du message',
    `ip_address` VARCHAR(45) NULL COMMENT 'Adresse IP de l\'expéditeur',
    `user_agent` VARCHAR(500) NULL COMMENT 'User agent du navigateur',
    `status` ENUM('new', 'read', 'replied', 'archived') DEFAULT 'new' COMMENT 'Statut du message',
    `admin_notes` TEXT NULL COMMENT 'Notes internes de l\'administrateur',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `replied_at` TIMESTAMP NULL COMMENT 'Date de réponse',
    
    INDEX `idx_status` (`status`),
    INDEX `idx_created_at` (`created_at`),
    INDEX `idx_email` (`email`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Messages de contact du formulaire';

-- Insertion d'exemple (optionnel - à supprimer en production)
-- INSERT INTO `contact_messages` (`name`, `email`, `phone`, `subject`, `message`, `status`) VALUES
-- ('Test User', 'test@example.com', '+243 81x xxx xxx', 'Droit des Affaires', 'Ceci est un message de test pour vérifier le bon fonctionnement du formulaire de contact.', 'new');
