-- =====================================================
-- BASE DE DONNÉES - CABINET D'AVOCATS ELMD
-- Version: 1.0
-- MySQL 8.0+ / MariaDB 10.5+
-- =====================================================

-- Création de la base
CREATE DATABASE IF NOT EXISTS elmd_cabinet 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE elmd_cabinet;

-- =====================================================
-- TABLE 1: users - Comptes utilisateurs
-- =====================================================
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'avocat', 'stagiaire', 'client') NOT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    remember_token VARCHAR(100) NULL,
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_role (role),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 2: password_reset_tokens - Tokens de réinitialisation
-- =====================================================
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 3: specialites - Spécialités juridiques
-- =====================================================
CREATE TABLE specialites (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT NULL,
    icon VARCHAR(50) NULL,
    est_active TINYINT(1) NOT NULL DEFAULT 1,
    ordre_affichage INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_active (est_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 4: avocats - Profils des avocats
-- =====================================================
CREATE TABLE avocats (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    nom VARCHAR(100) NOT NULL,
    post_nom VARCHAR(100) NULL,
    prenom VARCHAR(100) NULL,
    titre VARCHAR(50) NULL,
    specialite_id BIGINT UNSIGNED NOT NULL,
    telephone VARCHAR(20) NULL,
    email_pro VARCHAR(255) NULL,
    photo VARCHAR(500) NULL,
    bio TEXT NULL,
    linkedin VARCHAR(255) NULL,
    annee_experience INT NULL,
    est_senior TINYINT(1) NOT NULL DEFAULT 0,
    est_actif TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (specialite_id) REFERENCES specialites(id) ON DELETE RESTRICT,
    INDEX idx_senior (est_senior),
    INDEX idx_actif (est_actif)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 5: stagiaires - Informations des stagiaires
-- =====================================================
CREATE TABLE stagiaires (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    avocat_mentor_id BIGINT UNSIGNED NULL,
    nom VARCHAR(100) NOT NULL,
    post_nom VARCHAR(100) NULL,
    prenom VARCHAR(100) NULL,
    telephone VARCHAR(20) NULL,
    email VARCHAR(255) NOT NULL,
    universite VARCHAR(200) NOT NULL,
    filiere VARCHAR(100) NOT NULL,
    niveau ENUM('Licence', 'Master 1', 'Master 2', 'Doctorat') NOT NULL,
    lettre_motivation TEXT NULL,
    statut ENUM('candidature', 'en_cours', 'termine', 'rejete') NOT NULL DEFAULT 'candidature',
    date_debut DATE NULL,
    date_fin DATE NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (avocat_mentor_id) REFERENCES avocats(id) ON DELETE SET NULL,
    INDEX idx_statut (statut)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 6: postes_stage - Postes de stage disponibles
-- =====================================================
CREATE TABLE postes_stage (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    specialite_id BIGINT UNSIGNED NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT NULL,
    places_max INT NOT NULL DEFAULT 1,
    places_prises INT NOT NULL DEFAULT 0,
    est_ouvert TINYINT(1) NOT NULL DEFAULT 1,
    statut ENUM('disponible', 'limite', 'complet', 'ferme') NOT NULL DEFAULT 'disponible',
    date_debut_periode DATE NULL,
    date_fin_periode DATE NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (specialite_id) REFERENCES specialites(id) ON DELETE RESTRICT,
    INDEX idx_ouvert (est_ouvert),
    INDEX idx_statut (statut)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 7: candidatures_stage - Candidatures aux stages
-- =====================================================
CREATE TABLE candidatures_stage (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    poste_stage_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    nom_complet VARCHAR(200) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NULL,
    universite VARCHAR(200) NOT NULL,
    filiere VARCHAR(100) NOT NULL,
    niveau VARCHAR(50) NOT NULL,
    motivation TEXT NOT NULL,
    cv_fichier VARCHAR(500) NULL,
    lettre_fichier VARCHAR(500) NULL,
    documents_fichier VARCHAR(500) NULL,
    statut ENUM('soumise', 'en_examen', 'acceptee', 'refusee') NOT NULL DEFAULT 'soumise',
    date_soumission TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (poste_stage_id) REFERENCES postes_stage(id) ON DELETE RESTRICT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_statut (statut)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 8: experiences - Détails des spécialités
-- =====================================================
CREATE TABLE experiences (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    specialite_id BIGINT UNSIGNED NOT NULL,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NULL,
    image VARCHAR(500) NULL,
    est_visible TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (specialite_id) REFERENCES specialites(id) ON DELETE CASCADE,
    INDEX idx_visible (est_visible)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 9: categories - Catégories d'articles
-- =====================================================
CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT NULL,
    est_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_active (est_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 10: actualites - Articles et nouvelles
-- =====================================================
CREATE TABLE actualites (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    auteur_id BIGINT UNSIGNED NULL,
    categorie_id BIGINT UNSIGNED NULL,
    titre VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    extrait TEXT NULL,
    contenu LONGTEXT NULL,
    image VARCHAR(500) NULL,
    categorie ENUM('publication', 'evenement', 'distinction', 'news') NOT NULL DEFAULT 'news',
    statut ENUM('brouillon', 'publie', 'archive') NOT NULL DEFAULT 'brouillon',
    date_publication DATE NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (auteur_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE SET NULL,
    INDEX idx_statut (statut),
    INDEX idx_date_publication (date_publication)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 11: temoignages - Témoignages clients
-- =====================================================
CREATE TABLE temoignages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_nom VARCHAR(200) NOT NULL,
    client_poste VARCHAR(200) NULL,
    temoignage TEXT NOT NULL,
    photo VARCHAR(500) NULL,
    est_active TINYINT(1) NOT NULL DEFAULT 1,
    ordre_affichage INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_active (est_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 12: contacts - Messages de contact
-- =====================================================
CREATE TABLE contacts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom_complet VARCHAR(200) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NULL,
    sujet VARCHAR(255) NOT NULL,
    domaine VARCHAR(100) NULL,
    message TEXT NOT NULL,
    lu TINYINT(1) NOT NULL DEFAULT 0,
    repondu TINYINT(1) NOT NULL DEFAULT 0,
    date_lecture TIMESTAMP NULL,
    date_reponse TIMESTAMP NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_lu (lu),
    INDEX idx_repondu (repondu),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 13: adresses - Adresses du cabinet
-- =====================================================
CREATE TABLE adresses (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type ENUM('siege', 'bureau', 'depot') NOT NULL,
    adresse_complete VARCHAR(500) NOT NULL,
    avenue VARCHAR(100) NULL,
    numero VARCHAR(20) NULL,
    commune VARCHAR(100) NULL,
    ville VARCHAR(100) NOT NULL,
    province VARCHAR(100) NOT NULL,
    pays VARCHAR(100) NOT NULL DEFAULT 'RDC',
    telephone VARCHAR(50) NULL,
    email VARCHAR(255) NULL,
    est_principal TINYINT(1) NOT NULL DEFAULT 0,
    est_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_type (type),
    INDEX idx_principal (est_principal)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 14: newsletter - Abonnés newsletter
-- =====================================================
CREATE TABLE newsletter (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    est_actif TINYINT(1) NOT NULL DEFAULT 1,
    token_unsubscribe VARCHAR(100) NULL,
    date_inscription TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_actif (est_actif)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 15: configurations - Paramètres du site
-- =====================================================
CREATE TABLE configurations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cle VARCHAR(100) NOT NULL UNIQUE,
    valeur TEXT NULL,
    type ENUM('string', 'int', 'boolean', 'json') NOT NULL DEFAULT 'string',
    description VARCHAR(255) NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_cle (cle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 16: logs - Journal d'activité
-- =====================================================
CREATE TABLE logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    action VARCHAR(100) NOT NULL,
    module VARCHAR(50) NOT NULL,
    description TEXT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent VARCHAR(500) NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_created (created_at),
    INDEX idx_module (module),
    INDEX idx_action (action)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- TABLE 17: sessions - Sessions utilisateur
-- =====================================================
CREATE TABLE sessions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload TEXT NOT NULL,
    last_activity INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_last_activity (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- FIN DU SCRIPT
-- =====================================================