# 📊 Base de Données - Cabinet d'Avocats ELMD

## 📋 Table des Matières
1. [Vue d'ensemble](#vue-densemble)
2. [Tables Utilisateurs & Authentification](#tables-utilisateurs--authentification)
3. [Tables Cabinet & Équipe](#tables-cabinet--équipe)
4. [Tables Stages & Candidatures](#tables-stages--candidatures)
5. [Tables Domaines & Expertises](#tables-domaines--expertises)
6. [Tables Contenu & Publications](#tables-contenu--publications)
7. [Tables Contact & Messages](#tables-contact--messages)
8. [Tables Configuration & Thèmes](#tables-configuration--thèmes)
9. [Index et Contraintes](#index-et-contraintes)

---

## 🎯 Vue d'ensemble

**Version:** 1.0  
**Cabinet:** ELMD - Étude Laurent Mbako/D Cabinet d'Avocats  
**Localisation:** 448, Avenue Maduda, Kolwezi, Lualaba, RDC  
**Base:** MySQL 8.0+ / MariaDB 10.5+

---

## 👥 Tables Utilisateurs & Authentification

### 1. `users` - Comptes utilisateurs
> Gestion centralisée de tous les comptes utilisateurs du système

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire auto-incrémentée |
| email | VARCHAR(255) | NO | Email unique |
| password | VARCHAR(255) | NO | Mot de passe hashé (bcrypt) |
| role | ENUM('admin', 'avocat', 'stagiaire', 'client') | NO | Rôle dans le système |
| is_active | TINYINT(1) | NO | Compte actif (1) ou désactivé (0) |
| remember_token | VARCHAR(100) | YES | Token "Se souvenir de moi" |
| last_login | TIMESTAMP | YES | Dernière connexion |
| created_at | TIMESTAMP | NO | Date de création |
| updated_at | TIMESTAMP | NO | Dernière modification |

**INDEX:** `UNIQUE(email)`, `INDEX(role)`, `INDEX(is_active)`

---

### 2. `password_reset_tokens` - Tokens de réinitialisation
> Gestion des tokens pour mot de passe oublié

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| email | VARCHAR(255) | NO | Email de l'utilisateur |
| token | VARCHAR(255) | NO | Token unique |
| created_at | TIMESTAMP | NO | Date de création du token |

---

## 🏛 Tables Cabinet & Équipe

### 3. `avocats` - Profils des avocats
> Informations détaillées de tous les avocats du cabinet

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| user_id | BIGINT UNSIGNED | NO | FK vers users |
| nom | VARCHAR(100) | NO | Nom complet |
| post_nom | VARCHAR(100) | YES | Post-nom |
| prenom | VARCHAR(100) | YES | Prénom |
| titre | VARCHAR(50) | YES | Titre (Maître, Bâtonnier, etc.) |
| specialite_id | BIGINT UNSIGNED | NO | FK vers specialites |
| telephone | VARCHAR(20) | YES | Numéro de téléphone |
| email_pro | VARCHAR(255) | YES | Email professionnel |
| photo | VARCHAR(500) | YES | Chemin vers la photo |
| bio | TEXT | YES | Biographie |
|LinkedIn | VARCHAR(255) | YES | Profil LinkedIn |
| annee_experience | INT | YES | Années d'expérience |
| est_senior | TINYINT(1) | NO | Avocat senior (1) ou collaborateur (0) |
| est_actif | TINYINT(1) | NO | Disponible (1) ou non (0) |
| created_at | TIMESTAMP | NO | Date d'ajout |
| updated_at | TIMESTAMP | NO | Dernière modification |

**FK:** `user_id` → `users(id)`, `specialite_id` → `specialites(id)`

---

### 4. `stagiaires` - Informations des stagiaires
> Suivi des stagiaires actuels et passés du cabinet

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| user_id | BIGINT UNSIGNED | NO | FK vers users |
| avocat_mentor_id | BIGINT UNSIGNED | YES | FK vers avocats (mentor) |
| nom | VARCHAR(100) | NO | Nom complet |
| post_nom | VARCHAR(100) | YES | Post-nom |
| prenom | VARCHAR(100) | YES | Prénom |
| telephone | VARCHAR(20) | YES | Numéro de téléphone |
| email | VARCHAR(255) | NO | Email personnel |
| universite | VARCHAR(200) | NO | Université / École |
| filiere | VARCHAR(100) | NO | Filière d'études |
| niveau | ENUM('M1', 'M2', 'Doctorat') | NO | Niveau d'études |
| lettre_motivation | TEXT | YES | Texte de motivation |
| statut | ENUM('candidature', 'en_cours', 'termine', 'rejete') | NO | Statut du stage |
| date_debut | DATE | YES | Date de début |
| date_fin | DATE | YES | Date de fin |
| created_at | TIMESTAMP | NO | Date d'ajout |
| updated_at | TIMESTAMP | NO | Dernière modification |

**FK:** `user_id` → `users(id)`, `avocat_mentor_id` → `avocats(id)`

---

## 🎓 Tables Stages & Candidatures

### 5. `postes_stage` - Postes de stage disponibles
> Gestion des places de stage ouvertes par département

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| specialite_id | BIGINT UNSIGNED | NO | FK vers specialites |
| titre | VARCHAR(255) | NO | Titre du poste |
| description | TEXT | YES | Description détaillée |
| places_max | INT | NO | Nombre de places |
| places_prises | INT | NO | Places occupées |
| est_ouvert | TINYINT(1) | NO | Postulation ouverte (1) ou fermée (0) |
| statut | ENUM('disponible', 'limite', 'complet', 'ferme') | NO | État du poste |
| date_debut_periode | DATE | YES | Début de la période |
| date_fin_periode | DATE | YES | Fin de la période |
| created_at | TIMESTAMP | NO | Date de création |
| updated_at | TIMESTAMP | NO | Dernière modification |

**FK:** `specialite_id` → `specialites(id)`

---

### 6. `candidatures_stage` - Candidatures aux stages
> Suivi des candidatures déposées

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| poste_stage_id | BIGINT UNSIGNED | NO | FK vers postes_stage |
| user_id | BIGINT UNSIGNED | NO | FK vers users |
| nom_complet | VARCHAR(200) | NO | Nom du candidat |
| email | VARCHAR(255) | NO | Email du candidat |
| telephone | VARCHAR(20) | YES | Téléphone |
| universite | VARCHAR(200) | NO | Université |
| filiere | VARCHAR(100) | NO | Filière |
| niveau | VARCHAR(50) | NO | Niveau d'études |
| motivation | TEXT | NO | Lettre de motivation |
| cv_fichier | VARCHAR(500) | YES | Chemin CV |
| lettre_fichier | VARCHAR(500) | YES | Chemin lettre |
| documents_fichier | VARCHAR(500) | YES | Chemin autres docs |
| statut | ENUM('soumise', 'en_examen', 'acceptee', 'refusee') | NO | État |
| date_soumission | TIMESTAMP | NO | Date de dépôt |
| created_at | TIMESTAMP | NO | Date de création |
| updated_at | TIMESTAMP | NO | Dernière modification |

**FK:** `poste_stage_id` → `postes_stage(id)`, `user_id` → `users(id)`

---

## ⚖️ Tables Domaines & Expertises

### 7. `specialites` - Spécialités juridiques
> Catalogue des domaines d'expertise du cabinet

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| nom | VARCHAR(100) | NO | Nom de la spécialité |
| slug | VARCHAR(100) | NO | URL amigable |
| description | TEXT | YES | Description |
| icon | VARCHAR(50) | YES | Nom de l'icône SVG |
| est_active | TINYINT(1) | NO | Affichée (1) ou non (0) |
| ordre_affichage | INT | NO | Ordre d'affichage |
| created_at | TIMESTAMP | NO | Date de création |
| updated_at | TIMESTAMP | NO | Dernière modification |

**INDEX:** `UNIQUE(slug)`, `INDEX(est_active)`

---

### 8. `experiences` - Détails des spécialités
> Contenu détaillé de chaque page de spécialité

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| specialite_id | BIGINT UNSIGNED | NO | FK vers specialites |
| titre | VARCHAR(255) | NO | Titre de la section |
| contenu | TEXT | YES | Contenu HTML |
| image | VARCHAR(500) | YES | Image de couverture |
| est_visible | TINYINT(1) | NO | Section visible (1) |
| created_at | TIMESTAMP | NO | Date de création |
| updated_at | TIMESTAMP | NO | Dernière modification |

**FK:** `specialite_id` → `specialites(id)`

---

## 📰 Tables Contenu & Publications

### 9. `actualites` - Articles et nouvelles
> Gestion du blog/actualités du cabinet

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| auteur_id | BIGINT UNSIGNED | YES | FK vers users (auteur) |
| categorie_id | BIGINT UNSIGNED | YES | FK vers categories |
| titre | VARCHAR(255) | NO | Titre de l'article |
| slug | VARCHAR(255) | NO | URL amigable |
| extrait | TEXT | YES | Extrait (preview) |
| contenu | LONGTEXT | YES | Contenu complet |
| image | VARCHAR(500) | YES | Image de couverture |
| categorie | ENUM('publication', 'evenement', 'distinction', 'news') | NO | Type |
| statut | ENUM('brouillon', 'publie', 'archive') | NO | État |
| date_publication | DATE | YES | Date de publication |
| created_at | TIMESTAMP | NO | Date de création |
| updated_at | TIMESTAMP | NO | Dernière modification |

**FK:** `auteur_id` → `users(id)`, `categorie_id` → `categories(id)`  
**INDEX:** `UNIQUE(slug)`, `INDEX(statut)`, `INDEX(date_publication)`

---

### 10. `categories` - Catégories d'articles
> Organisation des actualités par thématiques

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| nom | VARCHAR(100) | NO | Nom de la catégorie |
| slug | VARCHAR(100) | NO | URL amigable |
| description | TEXT | YES | Description |
| est_active | TINYINT(1) | NO | Catégorie active (1) |
| created_at | TIMESTAMP | NO | Date de création |
| updated_at | TIMESTAMP | NO | Dernière modification |

**INDEX:** `UNIQUE(slug)`

---

### 11. `temoignages` - Témoignages clients
> Galerie des témoignages affichés sur le site

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| client_nom | VARCHAR(200) | NO | Nom du client |
| client_poste | VARCHAR(200) | YES | Fonction/entreprise |
| temoignage | TEXT | NO | Texte du témoignage |
| photo | VARCHAR(500) | YES | Photo du client |
| est_active | TINYINT(1) | NO | Affiché (1) ou non (0) |
| ordre_affichage | INT | NO | Ordre d'affichage |
| created_at | TIMESTAMP | NO | Date d'ajout |
| updated_at | TIMESTAMP | NO | Dernière modification |

---

## 📬 Tables Contact & Messages

### 12. `contacts` - Messages de contact
> Gestion des messages reçus via le formulaire

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| nom_complet | VARCHAR(200) | NO | Nom de l'expéditeur |
| email | VARCHAR(255) | NO | Email |
| telephone | VARCHAR(20) | YES | Téléphone |
| sujet | VARCHAR(255) | NO | Sujet du message |
| domaine | VARCHAR(100) | YES | Domaine juridique |
| message | TEXT | NO | Contenu du message |
| lu | TINYINT(1) | NO | Message lu (1) ou non (0) |
| repondu | TINYINT(1) | NO | Message répondu (1) ou non (0) |
| date_lecture | TIMESTAMP | YES | Date de lecture |
| date_reponse | TIMESTAMP | YES | Date de réponse |
| created_at | TIMESTAMP | NO | Date d'envoi |

**INDEX:** `INDEX(lu)`, `INDEX(repondu)`, `INDEX(created_at)`

---

### 13. `adresses` - Adresses du cabinet
> Informations de contact et adresses

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| type | ENUM('siege', 'bureau', 'depot') | NO | Type d'adresse |
| adresse_complete | VARCHAR(500) | NO | Adresse complète |
| avenue | VARCHAR(100) | YES | Avenue |
| numero | VARCHAR(20) | YES | Numéro |
| commune | VARCHAR(100) | YES | Commune |
| ville | VARCHAR(100) | NO | Ville |
| province | VARCHAR(100) | NO | Province |
| pays | VARCHAR(100) | NO | Pays (défaut: RDC) |
| telephone | VARCHAR(50) | YES | Téléphone |
| email | VARCHAR(255) | YES | Email contact |
| est_principal | TINYINT(1) | NO | Adresse principale (1) |
| est_active | TINYINT(1) | NO | Active (1) ou inactive (0) |
| created_at | TIMESTAMP | NO | Date de création |
| updated_at | TIMESTAMP | NO | Dernière modification |

---

### 14. `newsletter` - Abonnés newsletter
> Gestion des abonnés à la newsletter

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| email | VARCHAR(255) | NO | Email de l'abonné |
| est_actif | TINYINT(1) | NO | Abonné actif (1) |
| token_unsubscribe | VARCHAR(100) | YES | Token désinscription |
| date_inscription | TIMESTAMP | NO | Date d'inscription |
| created_at | TIMESTAMP | NO | Date de création |

**INDEX:** `UNIQUE(email)`

---

## 🎨 Tables Configuration & Thèmes

### 15. `configurations` - Paramètres du site
> Configuration générale du site

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| cle | VARCHAR(100) | NO | Clé de configuration |
| valeur | TEXT | YES | Valeur |
| type | ENUM('string', 'int', 'boolean', 'json') | NO | Type de valeur |
| description | VARCHAR(255) | YES | Description |
| created_at | TIMESTAMP | NO | Date de création |
| updated_at | TIMESTAMP | NO | Dernière modification |

**INDEX:** `UNIQUE(cle)`

---

### 16. `logs` - Journal d'activité
> Historique des actions sur le site

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| user_id | BIGINT UNSIGNED | YES | FK vers users (si connecté) |
| action | VARCHAR(100) | NO | Type d'action |
| module | VARCHAR(50) | NO | Module concerné |
| description | TEXT | YES | Description |
| ip_address | VARCHAR(45) | YES | Adresse IP |
| user_agent | VARCHAR(500) | YES | User agent |
| created_at | TIMESTAMP | NO | Date de l'action |

**FK:** `user_id` → `users(id)`  
**INDEX:** `INDEX(created_at)`, `INDEX(module)`, `INDEX(action)`

---

### 17. `sessions` - Sessions utilisateur
> Gestion des sessions (pour remember me)

| Colonne | Type | Nullable | Description |
|---------|------|----------|-------------|
| id | BIGINT UNSIGNED | NO | Clé primaire |
| user_id | BIGINT UNSIGNED | NO | FK vers users |
| ip_address | VARCHAR(45) | YES | IP |
| user_agent | TEXT | YES | User agent |
| payload | TEXT | NO | Données session |
| last_activity | INT | NO | Dernière activité |

**FK:** `user_id` → `users(id)`  
**INDEX:** `INDEX(user_id)`

---

## 🔗 Relations entre Tables

```
users (1) ──────< (N) avocats
users (1) ──────< (N) users_stagiaires
users (1) ──────< (N) users_candidatures
users (1) ──────< (N) users_contacts
users (1) ──────< (N) users_sessions
users (1) ──────< (N) users_logs

avocats (1) ───< (N) specialites
avocats (1) ───< (N) stagiaires (mentor)

stagiaires (1) ─< (N) Candidatures

postes_stage (1) ─< (N) Candidatures
postes_stage (N) ─< (1) specialites

specialites (1) ─< (N) experiences
specialites (1) ─< (N) postes_stage

actualites (N) ─< (1) categories
actualites (N) ─< (1) users (auteur)
```

---

## 📊 Index Recommandés

### Index uniques
- `users.email`
- `users_stagiaires.email`
- `specialites.slug`
- `actualites.slug`
- `categories.slug`
- `newsletter.email`
- `configurations.cle`
- `password_reset_tokens.email`

### Index de performance
- `users.role, users.is_active`
- `actualites.statut, actualites.date_publication`
- `postes_stage.est_ouvert`
- `contacts.lu, contacts.created_at`
- `candidatures.statut`
- `logs.created_at, logs.module`
- `sessions.user_id, sessions.last_activity`

---

## 🔒 Contraintes de Sécurité

### Mot de passe
- Hashage obligatoire avec bcrypt (coût 12)
- Longueur minimum: 8 caractères
- Stockage: `password` VARCHAR(255)

### Upload fichiers
- Extensions autorisées: PDF uniquement
- Taille maximale: 5 Mo par fichier
- Stockage: chemin relatif dans `uploads/` (hors webroot)

### Validation email
- Format RFC 5322
- Vérification de format avant insertion
- Normalisation: lowercase, trim

### Protection XSS
- Échappement HTML de toutes les entrées utilisateur
- Utilisation de prepared statements (PDO)
- Validation côté serveur obligatoire

---

## 📝 Notes d'implémentation

### Conventions
- **UTF-8** pour tous les textes
- **InnoDB** pour toutes les tables (support transactions)
- **Timestamps** automatiques via `DEFAULT CURRENT_TIMESTAMP`
- **Soft delete** possible avec colonne `deleted_at`

### Champs universels
Toutes les tables contiennent:
- `created_at` TIMESTAMP
- `updated_at` TIMESTAMP

### Audit trail
- Journalisation de toutes les modifications
- IP et user agent conservés dans `logs`

### Maintenance
- Purge des sessions expirées (> 2 semaines)
- Purge des tokens reset (> 1 heure)
- Purge des logs (> 90 jours)

---

## 📦 Script SQL de création

```sql
-- Création de la base
CREATE DATABASE IF NOT EXISTS elmd_cabinet 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE elmd_cabinet;

-- Table users
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

-- Table specialites
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

-- Table avocats
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

-- Table postes_stage
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

-- Table contacts
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

-- etc. pour les autres tables...
```

---

## ✅ Checklist de Migration

- [ ] Créer la base de données
- [ ] Exécuter le script SQL complet
- [ ] Vérifier les contraintes de clé étrangère
- [ ] Tester les index
- [ ] Vérifier l'encodage UTF-8
- [ ] Configurer les permissions
- [ ] Préparer les migrations Eloquent (Laravel)