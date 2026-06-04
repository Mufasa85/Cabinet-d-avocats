-- =====================================================
-- KEY-VALUE STORE (Configuration/Settings)
-- =====================================================

USE cabinet_platform;

CREATE TABLE IF NOT EXISTS key_values (

    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    `key` VARCHAR(255) NOT NULL UNIQUE,

    value TEXT NULL,

    type ENUM('string','integer','float','boolean','json','array') DEFAULT 'string',

    description VARCHAR(500) NULL,

    `group` VARCHAR(100) DEFAULT 'general',

    is_public BOOLEAN DEFAULT FALSE,

    options JSON NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_key (`key`),
    INDEX idx_group (`group`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- =====================================================
-- CONTACT INFO
-- =====================================================

INSERT INTO key_values (`key`, value, type, description, `group`, is_public, options) VALUES
-- Contact
('contact_address', '448, Avenue Maduda, Quartier Biashara, Dilala, Kolwezi, Lualaba', 'string', 'Adresse du cabinet', 'contact', TRUE, NULL),
('contact_phone', '+243 811 403 315', 'string', 'Téléphone du cabinet', 'contact', TRUE, NULL),
('contact_email', 'laurentmbako@etudelmbako.com', 'string', 'Email du cabinet', 'contact', TRUE, NULL),

-- Cabinet
('cabinet_founding_year', '1985', 'integer', 'Année de création du cabinet', 'cabinet', TRUE, NULL),
('site_name', 'ELMD Cabinet d\'Avocats', 'string', 'Nom du cabinet', 'general', TRUE, NULL),
('site_tagline', 'L\'excellence juridique au service de votre réussite', 'string', 'Slogan du cabinet', 'general', TRUE, NULL),

-- SEO
('seo_meta_title', 'ELMD - Cabinet d\'Avocats d\'Excellence', 'string', 'Titre méta SEO', 'seo', FALSE, NULL),
('seo_meta_description', 'Cabinet d\'avocats ELMD à Kolwezi. Expertise en droit OHADA, droit minier, droit du travail et plus.', 'string', 'Description méta SEO', 'seo', FALSE, NULL),

-- Social
('social_facebook', NULL, 'string', 'URL Facebook', 'social', FALSE, NULL),
('social_linkedin', NULL, 'string', 'URL LinkedIn', 'social', FALSE, NULL),
('social_twitter', NULL, 'string', 'URL Twitter/X', 'social', FALSE, NULL),

-- Email
('email_notifications_enabled', 'true', 'boolean', 'Activer les notifications par email', 'email', FALSE, NULL),

-- Stages
('stage_max_duration_months', '6', 'integer', 'Durée maximale d\'un stage en mois', 'internship', FALSE, NULL),
('stage_auto_accept', 'false', 'boolean', 'Accepter automatiquement les candidatures', 'internship', FALSE, NULL),

-- Media
('max_upload_size_mb', '10', 'integer', 'Taille maximale d\'upload en MB', 'media', FALSE, NULL),
('allowed_image_types', '["jpg","jpeg","png","gif","webp"]', 'json', 'Types d\'images autorisés', 'media', FALSE, NULL),

-- Maintenance
('maintenance_mode', 'false', 'boolean', 'Activer le mode maintenance', 'system', FALSE, NULL),
('maintenance_message', 'Le site est en maintenance.', 'string', 'Message de maintenance', 'system', FALSE, NULL);