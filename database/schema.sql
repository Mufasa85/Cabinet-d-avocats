-- =====================================================
-- DATABASE
-- =====================================================

DROP DATABASE IF EXISTS cabinet_platform;
CREATE DATABASE IF NOT EXISTS cabinet_platform
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE cabinet_platform;



-- =====================================================
-- USERS
-- =====================================================

CREATE TABLE users (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

fullname VARCHAR(100) NOT NULL,
email VARCHAR(255) NOT NULL UNIQUE,
passwords VARCHAR(255) NOT NULL,

roles ENUM('admin','avocat','secretaire', 'stagiaire') NOT NULL,
telephone VARCHAR(20),
avatar VARCHAR(500),
is_active BOOLEAN DEFAULT TRUE,

email_verified_at TIMESTAMP NULL,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

INDEX idx_role(roles)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- SPECIALITES
-- =====================================================

CREATE TABLE specialites (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

nom VARCHAR(120) NOT NULL UNIQUE,

slug VARCHAR(120) NOT NULL UNIQUE,

descriptions TEXT,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- AVOCATS
-- =====================================================

CREATE TABLE avocats (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

user_id BIGINT UNSIGNED NOT NULL UNIQUE,

titre VARCHAR(100),

email_professionnel VARCHAR(255),

bio TEXT,

experience SMALLINT UNSIGNED,

bureau VARCHAR(150),

created_at TIMESTAMP
DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP
DEFAULT CURRENT_TIMESTAMP
ON UPDATE CURRENT_TIMESTAMP,

FOREIGN KEY (user_id)
REFERENCES users(id)
ON DELETE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- AVOCAT ↔ SPECIALITES
-- =====================================================

CREATE TABLE avocat_specialites (

avocat_id BIGINT UNSIGNED,
specialite_id BIGINT UNSIGNED,

PRIMARY KEY (
avocat_id,
specialite_id
),

FOREIGN KEY (avocat_id)
REFERENCES avocats(id)
ON DELETE CASCADE,

FOREIGN KEY (specialite_id)
REFERENCES specialites(id)
ON DELETE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- =====================================================
-- ARTICLES
-- =====================================================

CREATE TABLE articles (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

avocat_id BIGINT UNSIGNED NOT NULL,

titre VARCHAR(255) NOT NULL,

slug VARCHAR(255) UNIQUE NOT NULL,

extrait TEXT,

contenu LONGTEXT NOT NULL,

image_couverture VARCHAR(500),

statut ENUM(
'brouillon',
'publie',
'archive'
)
DEFAULT 'brouillon',

publie_le TIMESTAMP NULL,

created_at TIMESTAMP
DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP
DEFAULT CURRENT_TIMESTAMP
ON UPDATE CURRENT_TIMESTAMP,

FOREIGN KEY (avocat_id)
REFERENCES avocats(id)
ON DELETE CASCADE,

FULLTEXT (
titre,
contenu
),

INDEX idx_statut(statut)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- MEDIA
-- =====================================================

CREATE TABLE media (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

nom VARCHAR(255) NOT NULL,

fichier VARCHAR(500) NOT NULL,

mime VARCHAR(100),

taille BIGINT UNSIGNED,

type ENUM(
'avatar',
'publication',
'galerie',
'slider',
'document'
),

user_id BIGINT UNSIGNED NULL,

article_id BIGINT UNSIGNED NULL,

est_public BOOLEAN DEFAULT TRUE,

created_at TIMESTAMP
DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (user_id)
REFERENCES users(id)
ON DELETE CASCADE,

FOREIGN KEY (article_id)
REFERENCES articles(id)
ON DELETE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- CANDIDATURES STAGE
-- =====================================================

CREATE TABLE internship_applications (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

nom VARCHAR(100) NOT NULL,

post_nom VARCHAR(100),

prenom VARCHAR(100),

email VARCHAR(255) NOT NULL,

telephone VARCHAR(30) NOT NULL,

universite VARCHAR(255) NOT NULL,

filiere VARCHAR(255) NOT NULL,

niveau_etude ENUM(
'L1',
'L2',
'L3',
'M1',
'M2',
'Doctorat'
) NOT NULL,

departement_souhaite VARCHAR(150) NOT NULL,

motivation TEXT NOT NULL,

statut ENUM(
'en_attente',
'analyse',
'retenu',
'refuse'
)
DEFAULT 'en_attente',

created_at TIMESTAMP
DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP
DEFAULT CURRENT_TIMESTAMP
ON UPDATE CURRENT_TIMESTAMP,

INDEX idx_statut(statut)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- DOCUMENTS STAGIAIRES
-- =====================================================

CREATE TABLE internship_documents (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

application_id BIGINT UNSIGNED NOT NULL,

type ENUM(
'cv',
'lettre',
'academique'
)
NOT NULL,

fichier VARCHAR(500) NOT NULL,

taille BIGINT UNSIGNED,

mime VARCHAR(100),

created_at TIMESTAMP
DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (application_id)
REFERENCES internship_applications(id)
ON DELETE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- CATEGORIES (blog)
-- =====================================================

CREATE TABLE categories (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

nom VARCHAR(120) NOT NULL UNIQUE,

slug VARCHAR(120) NOT NULL UNIQUE,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- ARTICLE ↔ CATEGORIES
-- =====================================================

ALTER TABLE articles
ADD COLUMN category_id BIGINT UNSIGNED NULL AFTER avocat_id,
ADD FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL;



-- =====================================================
-- STAGIAIRES (comptes actifs)
-- =====================================================

CREATE TABLE stagiaires (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

user_id BIGINT UNSIGNED NOT NULL UNIQUE,

application_id BIGINT UNSIGNED NULL,

universite VARCHAR(255),

filiere VARCHAR(255),

niveau_etude VARCHAR(50),

departement VARCHAR(150),

date_debut DATE NULL,

date_fin DATE NULL,

tuteur_avocat_id BIGINT UNSIGNED NULL,

statut ENUM('actif','termine','suspendu') DEFAULT 'actif',

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,

FOREIGN KEY (application_id) REFERENCES internship_applications(id) ON DELETE SET NULL,

FOREIGN KEY (tuteur_avocat_id) REFERENCES avocats(id) ON DELETE SET NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- DOCUMENTS STAGIAIRES (compte connecté)
-- =====================================================

CREATE TABLE stagiaire_documents (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

stagiaire_id BIGINT UNSIGNED NOT NULL,

type ENUM('convention','rapport','autre') NOT NULL DEFAULT 'autre',

titre VARCHAR(255) NOT NULL,

fichier VARCHAR(500) NOT NULL,

taille BIGINT UNSIGNED,

mime VARCHAR(100),

statut ENUM('en_attente','valide','rejete') DEFAULT 'en_attente',

motif_rejet TEXT NULL,

valide_par BIGINT UNSIGNED NULL,

valide_le TIMESTAMP NULL,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

FOREIGN KEY (stagiaire_id) REFERENCES stagiaires(id) ON DELETE CASCADE,

FOREIGN KEY (valide_par) REFERENCES users(id) ON DELETE SET NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- FORMATIONS
-- =====================================================

CREATE TABLE formations (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

titre VARCHAR(255) NOT NULL,

slug VARCHAR(255) NOT NULL UNIQUE,

description TEXT,

contenu LONGTEXT,

image_couverture VARCHAR(500),

date_debut DATE NULL,

date_fin DATE NULL,

lieu VARCHAR(255),

places_max SMALLINT UNSIGNED DEFAULT 20,

places_reservees SMALLINT UNSIGNED DEFAULT 0,

public_cible ENUM('avocat','stagiaire','tous') DEFAULT 'tous',

statut ENUM('brouillon','ouverte','completee','archivee') DEFAULT 'brouillon',

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- INSCRIPTIONS FORMATIONS
-- =====================================================

CREATE TABLE inscriptions (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

formation_id BIGINT UNSIGNED NOT NULL,

user_id BIGINT UNSIGNED NOT NULL,

message TEXT,

statut ENUM('en_attente','acceptee','refusee','annulee') DEFAULT 'en_attente',

motif_rejet TEXT NULL,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

UNIQUE KEY uk_formation_user (formation_id, user_id),

FOREIGN KEY (formation_id) REFERENCES formations(id) ON DELETE CASCADE,

FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- PUBLICATIONS CABINET
-- =====================================================

CREATE TABLE publications (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

titre VARCHAR(255) NOT NULL,

slug VARCHAR(255) NOT NULL UNIQUE,

description TEXT,

contenu LONGTEXT,

fichier VARCHAR(500),

type ENUM('brochure','etude_cas','distinction','autre') DEFAULT 'autre',

image_couverture VARCHAR(500),

statut ENUM('brouillon','publie','archive') DEFAULT 'brouillon',

publie_le TIMESTAMP NULL,

cree_par BIGINT UNSIGNED NULL,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

FOREIGN KEY (cree_par) REFERENCES users(id) ON DELETE SET NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- =====================================================
-- NOTIFICATIONS
-- =====================================================

CREATE TABLE notifications (

id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

user_id BIGINT UNSIGNED NOT NULL,

type ENUM(
'validation_document',
'rejet_document',
'rappel_stage',
'nouveau_message',
'changement_affectation',
'evaluation_stage',
'inscription_formation',
'autre'
) NOT NULL,

titre VARCHAR(255) NOT NULL,

message TEXT NOT NULL,

lien VARCHAR(500) NULL,

est_lu BOOLEAN DEFAULT FALSE,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,

INDEX idx_user_lu (user_id, est_lu)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;