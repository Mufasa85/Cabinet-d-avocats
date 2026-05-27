-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cabinet_platform
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `avocat_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `titre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `extrait` text,
  `contenu` longtext NOT NULL,
  `image_couverture` varchar(500) DEFAULT NULL,
  `statut` enum('brouillon','publie','archive') DEFAULT 'brouillon',
  `publie_le` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `avocat_id` (`avocat_id`),
  KEY `idx_statut` (`statut`),
  KEY `category_id` (`category_id`),
  FULLTEXT KEY `titre` (`titre`,`contenu`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`avocat_id`) REFERENCES `avocats` (`id`) ON DELETE CASCADE,
  CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

--
-- Table structure for table `avocat_specialites`
--

DROP TABLE IF EXISTS `avocat_specialites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avocat_specialites` (
  `avocat_id` bigint unsigned NOT NULL,
  `specialite_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`avocat_id`,`specialite_id`),
  KEY `specialite_id` (`specialite_id`),
  CONSTRAINT `avocat_specialites_ibfk_1` FOREIGN KEY (`avocat_id`) REFERENCES `avocats` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avocat_specialites_ibfk_2` FOREIGN KEY (`specialite_id`) REFERENCES `specialites` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avocat_specialites`
--

/*!40000 ALTER TABLE `avocat_specialites` DISABLE KEYS */;
/*!40000 ALTER TABLE `avocat_specialites` ENABLE KEYS */;

--
-- Table structure for table `avocats`
--

DROP TABLE IF EXISTS `avocats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avocats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `email_professionnel` varchar(255) DEFAULT NULL,
  `bio` text,
  `experience` smallint unsigned DEFAULT NULL,
  `bureau` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `avocats_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avocats`
--

/*!40000 ALTER TABLE `avocats` DISABLE KEYS */;
/*!40000 ALTER TABLE `avocats` ENABLE KEYS */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(120) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Droit des Affaires','droit-affaires','2026-05-26 21:09:51'),(2,'Droit Minier','droit-minier','2026-05-26 21:09:51'),(3,'Droit Fiscal','droit-fiscal','2026-05-26 21:09:51'),(4,'Droit du Travail','droit-travail','2026-05-26 21:09:51'),(5,'OHADA','ohada','2026-05-26 21:09:51');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

--
-- Table structure for table `formations`
--

DROP TABLE IF EXISTS `formations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `contenu` longtext,
  `image_couverture` varchar(500) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `places_max` smallint unsigned DEFAULT '20',
  `places_reservees` smallint unsigned DEFAULT '0',
  `public_cible` enum('avocat','stagiaire','tous') DEFAULT 'tous',
  `statut` enum('brouillon','ouverte','completee','archivee') DEFAULT 'brouillon',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formations`
--

/*!40000 ALTER TABLE `formations` DISABLE KEYS */;
INSERT INTO `formations` VALUES (1,'Formation continue — Due diligence M&A','due-diligence-ma','Atelier pratique sur la due diligence en fusions-acquisitions.',NULL,NULL,'2026-06-15','2026-06-17',NULL,15,0,'avocat','ouverte','2026-05-26 21:09:51','2026-05-26 21:09:51'),(2,'Perfectionnement — Fiscalité des sociétés','fiscalite-societes','Programme de mise à jour en droit fiscal des sociétés en RDC.',NULL,NULL,'2026-07-01','2026-07-03',NULL,20,0,'tous','ouverte','2026-05-26 21:09:51','2026-05-26 21:09:51'),(3,'Atelier stagiaires — Rédaction d\'actes','redaction-actes-stagiaires','Formation dédiée aux stagiaires sur la rédaction d\'actes juridiques.',NULL,NULL,'2026-05-30','2026-05-31',NULL,10,0,'stagiaire','ouverte','2026-05-26 21:09:51','2026-05-26 21:09:51');
/*!40000 ALTER TABLE `formations` ENABLE KEYS */;

--
-- Table structure for table `inscriptions`
--

DROP TABLE IF EXISTS `inscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `formation_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `message` text,
  `statut` enum('en_attente','acceptee','refusee','annulee') DEFAULT 'en_attente',
  `motif_rejet` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_formation_user` (`formation_id`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `inscriptions_ibfk_1` FOREIGN KEY (`formation_id`) REFERENCES `formations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `inscriptions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscriptions`
--

/*!40000 ALTER TABLE `inscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `inscriptions` ENABLE KEYS */;

--
-- Table structure for table `internship_applications`
--

DROP TABLE IF EXISTS `internship_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `internship_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `post_nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `universite` varchar(255) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `niveau_etude` enum('L1','L2','L3','M1','M2','Doctorat') NOT NULL,
  `departement_souhaite` varchar(150) NOT NULL,
  `motivation` text NOT NULL,
  `statut` enum('en_attente','analyse','retenu','refuse') DEFAULT 'en_attente',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_statut` (`statut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internship_applications`
--

/*!40000 ALTER TABLE `internship_applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `internship_applications` ENABLE KEYS */;

--
-- Table structure for table `internship_documents`
--

DROP TABLE IF EXISTS `internship_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `internship_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `type` enum('cv','lettre','academique') NOT NULL,
  `fichier` varchar(500) NOT NULL,
  `taille` bigint unsigned DEFAULT NULL,
  `mime` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `application_id` (`application_id`),
  CONSTRAINT `internship_documents_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `internship_applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internship_documents`
--

/*!40000 ALTER TABLE `internship_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `internship_documents` ENABLE KEYS */;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `fichier` varchar(500) NOT NULL,
  `mime` varchar(100) DEFAULT NULL,
  `taille` bigint unsigned DEFAULT NULL,
  `type` enum('avatar','publication','galerie','slider','document') DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `article_id` bigint unsigned DEFAULT NULL,
  `est_public` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `media_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `media_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `type` enum('validation_document','rejet_document','rappel_stage','nouveau_message','changement_affectation','evaluation_stage','inscription_formation','autre') NOT NULL,
  `titre` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `lien` varchar(500) DEFAULT NULL,
  `est_lu` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_lu` (`user_id`,`est_lu`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `contenu` longtext,
  `fichier` varchar(500) DEFAULT NULL,
  `type` enum('brochure','etude_cas','distinction','autre') DEFAULT 'autre',
  `image_couverture` varchar(500) DEFAULT NULL,
  `statut` enum('brouillon','publie','archive') DEFAULT 'brouillon',
  `publie_le` timestamp NULL DEFAULT NULL,
  `cree_par` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `cree_par` (`cree_par`),
  CONSTRAINT `publications_ibfk_1` FOREIGN KEY (`cree_par`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
/*!40000 ALTER TABLE `publications` ENABLE KEYS */;

--
-- Table structure for table `specialites`
--

DROP TABLE IF EXISTS `specialites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `specialites` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(120) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `descriptions` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialites`
--

/*!40000 ALTER TABLE `specialites` DISABLE KEYS */;
INSERT INTO `specialites` VALUES (1,'Droit des Affaires','droit-affaires','Conseil et contentieux en droit des affaires','2026-05-26 21:09:51','2026-05-26 21:09:51'),(2,'Droit Fiscal','droit-fiscal','Fiscalité nationale et internationale','2026-05-26 21:09:51','2026-05-26 21:09:51'),(3,'Droit du Travail','droit-travail','Relations individuelles et collectives','2026-05-26 21:09:51','2026-05-26 21:09:51'),(4,'Droit Minier','droit-minier','Permis, contrats et compliance minière','2026-05-26 21:09:51','2026-05-26 21:09:51'),(5,'Droit OHADA','ohada','Actes uniformes et droit commercial harmonisé','2026-05-26 21:09:51','2026-05-26 21:09:51');
/*!40000 ALTER TABLE `specialites` ENABLE KEYS */;

--
-- Table structure for table `stagiaire_documents`
--

DROP TABLE IF EXISTS `stagiaire_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stagiaire_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stagiaire_id` bigint unsigned NOT NULL,
  `type` enum('convention','rapport','autre') NOT NULL DEFAULT 'autre',
  `titre` varchar(255) NOT NULL,
  `fichier` varchar(500) NOT NULL,
  `taille` bigint unsigned DEFAULT NULL,
  `mime` varchar(100) DEFAULT NULL,
  `statut` enum('en_attente','valide','rejete') DEFAULT 'en_attente',
  `motif_rejet` text,
  `valide_par` bigint unsigned DEFAULT NULL,
  `valide_le` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `stagiaire_id` (`stagiaire_id`),
  KEY `valide_par` (`valide_par`),
  CONSTRAINT `stagiaire_documents_ibfk_1` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stagiaire_documents_ibfk_2` FOREIGN KEY (`valide_par`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stagiaire_documents`
--

/*!40000 ALTER TABLE `stagiaire_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `stagiaire_documents` ENABLE KEYS */;

--
-- Table structure for table `stagiaires`
--

DROP TABLE IF EXISTS `stagiaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stagiaires` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `application_id` bigint unsigned DEFAULT NULL,
  `universite` varchar(255) DEFAULT NULL,
  `filiere` varchar(255) DEFAULT NULL,
  `niveau_etude` varchar(50) DEFAULT NULL,
  `departement` varchar(150) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `tuteur_avocat_id` bigint unsigned DEFAULT NULL,
  `statut` enum('actif','termine','suspendu') DEFAULT 'actif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `application_id` (`application_id`),
  KEY `tuteur_avocat_id` (`tuteur_avocat_id`),
  CONSTRAINT `stagiaires_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stagiaires_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `internship_applications` (`id`) ON DELETE SET NULL,
  CONSTRAINT `stagiaires_ibfk_3` FOREIGN KEY (`tuteur_avocat_id`) REFERENCES `avocats` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stagiaires`
--

/*!40000 ALTER TABLE `stagiaires` DISABLE KEYS */;
/*!40000 ALTER TABLE `stagiaires` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `roles` enum('admin','avocat','secretaire','stagiaire') NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_role` (`roles`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@admin.com','$2y$10$YqfU63jFadH/am3VuwoZgOtmb70GiqJT4y0ts.VZ/SGS3yDjjnG7u','admin','0000',NULL,1,NULL,'2026-05-26 21:42:38','2026-05-26 22:26:46'),(2,'César Paysayo','16paysayocesar@gmail.com','$2y$10$YqfU63jFadH/am3VuwoZgOtmb70GiqJT4y0ts.VZ/SGS3yDjjnG7u','avocat','+243895511485',NULL,1,NULL,'2026-05-26 22:27:41','2026-05-27 12:35:19');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Dumping routines for database 'cabinet_platform'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-27 16:21:49
