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
  `pdf_file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `avocat_id` (`avocat_id`),
  KEY `idx_statut` (`statut`),
  KEY `category_id` (`category_id`),
  KEY `idx_pdf_file` (`pdf_file`),
  FULLTEXT KEY `titre` (`titre`,`contenu`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`avocat_id`) REFERENCES `avocats` (`id`) ON DELETE CASCADE,
  CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,5,3,'Avocat','avocat','la bellz','hhbbhjhjh','images/articles/article_7ebe544ce80b73b0.jpg','publie','2026-05-28 20:57:59','2026-05-28 19:57:59','2026-05-28 19:57:59',NULL),(2,5,NULL,'test','test','test','test','images/articles/article_27cabfe3e6031902.png','publie','2026-05-28 20:59:07','2026-05-28 19:59:07','2026-05-28 20:12:01',NULL),(3,1,4,'eu','eu','tattat','ayyayay','images/articles/article_479767e5ce1afe93.png','brouillon','2026-05-30 15:14:19','2026-05-30 14:14:19','2026-06-02 10:36:01',NULL),(4,1,3,'test 3','test-3','dans un monde\r\nouai','ou le temps arrive\r\nil est important de \r\nah ah','images/articles/article_92a20063fd4fdca4.png','publie','2026-06-02 11:34:19','2026-06-02 10:34:19','2026-06-02 10:34:19','documents/articles/article_9c84a88057bb8924.pdf'),(5,1,4,'lorem','lorem','\r\n    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae ipsam neque, deserunt perferendis nam quasi itaque ea veniam velit nulla tempore dolorum debitis dolore iste est quis error unde accusantium.','\r\n    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae ipsam neque, deserunt perferendis nam quasi itaque ea veniam velit nulla tempore dolorum debitis dolore iste est quis error unde accusantium.\r\n\r\n    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae ipsam neque, deserunt perferendis nam quasi itaque ea veniam velit nulla tempore dolorum debitis dolore iste est quis error unde accusantium.\r\n\r\n    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae ipsam neque, deserunt perferendis nam quasi itaque ea veniam velit nulla tempore dolorum debitis dolore iste est quis error unde accusantium.\r\n\r\n    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae ipsam neque, deserunt perferendis nam quasi itaque ea veniam velit nulla tempore dolorum debitis dolore iste est quis error unde accusantium.\r\n\r\n    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae ipsam neque, deserunt perferendis nam quasi itaque ea veniam velit nulla tempore dolorum debitis dolore iste est quis error unde accusantium.\r\n\r\n    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae ipsam neque, deserunt perferendis nam quasi itaque ea veniam velit nulla tempore dolorum debitis dolore iste est quis error unde accusantium.\r\n\r\n    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Beatae ipsam neque, deserunt perferendis nam quasi itaque ea veniam velit nulla tempore dolorum debitis dolore iste est quis error unde accusantium.','images/articles/article_ce4f7bd9f1674400.jpg','publie','2026-06-03 17:45:25','2026-06-03 16:45:25','2026-06-03 16:45:25','documents/articles/article_9069eb77f8604d54.pdf');
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
INSERT INTO `avocat_specialites` VALUES (4,1),(3,5);
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avocats`
--

/*!40000 ALTER TABLE `avocats` DISABLE KEYS */;
INSERT INTO `avocats` VALUES (1,3,'Avocat','cesar@gmail.com',' lorem 222',8,'Kinshasa Gombe','2026-05-27 21:47:52','2026-05-28 09:13:03'),(2,6,'Avocat','baki@gmail.com','baki baki',2,'Kinshasa lemba','2026-05-28 11:54:21','2026-05-28 11:54:21'),(3,1,'Avocat','admi@mail.com','lala ',7,'','2026-05-28 12:13:04','2026-05-28 12:13:42'),(4,5,'Avocat','randy@gmail.com','mufasa mufasa',8,'Kinshasa lemba','2026-05-28 13:07:52','2026-05-28 13:07:52'),(5,9,'Avocat','Laurent@gmail.com','',NULL,'448, Avenue Maduda, Quartier Biashara, Dilala, Kolwezi, Lualaba','2026-05-28 16:13:01','2026-05-28 16:13:01'),(6,10,'Avocat','Pierre@gmail.com','',NULL,'448, Avenue Maduda, Quartier Biashara, Dilala, Kolwezi, Lualaba','2026-05-28 16:14:41','2026-05-28 16:14:41'),(7,11,'Avocat','Olivier@gmail.com','',NULL,'448, Avenue Maduda, Quartier Biashara, Dilala, Kolwezi, Lualaba','2026-05-28 16:16:19','2026-05-28 16:16:19'),(8,12,'Avocat','Ghislain@gmail.com','',NULL,'448, Avenue Maduda, Quartier Biashara, Dilala, Kolwezi, Lualaba','2026-05-28 16:17:21','2026-05-28 16:17:21'),(9,13,'Avocat','MUMBA@gmail.com','',NULL,'448, Avenue Maduda, Quartier Biashara, Dilala, Kolwezi, Lualaba','2026-05-28 16:18:07','2026-05-28 16:18:07'),(10,14,'Avocat','NSENGA@gmail.com','',NULL,'448, Avenue Maduda, Quartier Biashara, Dilala, Kolwezi, Lualaba','2026-05-28 16:20:03','2026-05-28 16:20:03'),(11,15,'Avocat','Cecilemande@gmail.com','',NULL,'','2026-06-04 12:35:28','2026-06-04 12:35:28'),(12,16,'Avocat','josephkahasha@gmail.com','',NULL,'Kinshasa Gombe','2026-06-04 12:41:29','2026-06-04 12:41:29'),(13,17,'Avocat','gracekafumu@gmail.com','',NULL,'Kinshasa Gombe','2026-06-04 12:48:13','2026-06-04 12:48:13'),(14,18,'Avocat','chistiansapu@gmail.com','',NULL,'Kinshasa Gombe','2026-06-04 12:50:59','2026-06-04 12:50:59'),(15,19,'Avocat','bijoumukesi@mail.com','',NULL,'Kinshasa Gombe','2026-06-04 12:54:57','2026-06-04 12:54:57'),(16,20,'Avocat','dominiccassini@gmail.com','',NULL,'Kinshasa Gombe','2026-06-04 13:01:42','2026-06-04 13:01:42'),(17,21,'Avocat','eliathakalunga@gmail.com','',NULL,'Kinshasa Gombe','2026-06-04 13:04:41','2026-06-04 13:04:41'),(18,22,'Avocat','victorkazad@gmail.com','',NULL,'Kinshasa Gombe','2026-06-04 13:07:44','2026-06-04 13:07:44');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formations`
--

/*!40000 ALTER TABLE `formations` DISABLE KEYS */;
INSERT INTO `formations` VALUES (1,'Formation continue — Due diligence M&A','due-diligence-ma','Atelier pratique sur la due diligence en fusions-acquisitions.',NULL,NULL,'2026-06-15','2026-06-17',NULL,15,0,'avocat','ouverte','2026-05-26 21:09:51','2026-05-26 21:09:51'),(2,'Perfectionnement — Fiscalité des sociétés','fiscalite-societes','Programme de mise à jour en droit fiscal des sociétés en RDC.',NULL,NULL,'2026-07-01','2026-07-03',NULL,20,3,'tous','ouverte','2026-05-26 21:09:51','2026-05-29 14:35:11'),(3,'Atelier stagiaires — Rédaction d\'actes','redaction-actes-stagiaires','Formation dédiée aux stagiaires sur la rédaction d\'actes juridiques.',NULL,NULL,'2026-05-30','2026-05-31',NULL,10,2,'stagiaire','ouverte','2026-05-26 21:09:51','2026-06-03 17:08:04'),(4,'beach','beach','bonne meuf',NULL,NULL,'2026-05-29','2026-06-05','kin',200,1,'avocat','ouverte','2026-05-28 13:30:56','2026-05-29 09:37:19');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscriptions`
--

/*!40000 ALTER TABLE `inscriptions` DISABLE KEYS */;
INSERT INTO `inscriptions` VALUES (1,3,7,'','acceptee',NULL,'2026-05-28 14:55:38','2026-05-28 14:55:38'),(2,2,7,'','acceptee',NULL,'2026-05-28 14:55:40','2026-05-28 14:55:40'),(3,4,3,'','acceptee',NULL,'2026-05-29 09:37:19','2026-05-29 09:37:19'),(4,2,3,'','acceptee',NULL,'2026-05-29 12:33:40','2026-05-29 12:33:40'),(5,2,2,'','acceptee',NULL,'2026-05-29 14:35:11','2026-05-29 14:35:11'),(6,3,2,'','acceptee',NULL,'2026-06-03 17:08:04','2026-06-03 17:08:04');
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
  `user_id` int DEFAULT NULL,
  `stagiaire_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_statut` (`statut`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internship_applications`
--

/*!40000 ALTER TABLE `internship_applications` DISABLE KEYS */;
INSERT INTO `internship_applications` VALUES (1,'Paysayo',NULL,'Paysayo','16paysayocesar@gmail.com','+243895511485','upc','Autre','M2','Autre','Candidature transmise via le formulaire en ligne.','retenu','2026-05-28 12:45:05','2026-05-28 13:08:35',NULL,NULL),(2,'Peter',NULL,'Peter','peter@gmail.com','+243815252159','upc','Autre','M2','Autre','Candidature transmise via le formulaire en ligne.','retenu','2026-05-28 13:37:37','2026-05-28 13:38:34',NULL,NULL),(3,'Paysayo',NULL,'César','16paysayocesar@gmail.com','+243895511485','upc congo','Autre','M1','Autre','Candidature transmise via le formulaire en ligne.','retenu','2026-05-28 15:32:53','2026-05-28 15:33:49',NULL,NULL),(4,'satan',NULL,'satan','satan@gmail.com','+243878945610','kin la belle','Autre','M1','Autre','Candidature transmise via le formulaire en ligne.','retenu','2026-05-28 15:36:49','2026-05-28 15:37:14',8,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `internship_documents`
--

/*!40000 ALTER TABLE `internship_documents` DISABLE KEYS */;
INSERT INTO `internship_documents` VALUES (1,1,'cv','documents/candidatures/cv_1_50ad56fb076a935c.pdf',148779,'application/pdf','2026-05-28 12:45:05'),(2,1,'lettre','documents/candidatures/lettre_1_efa1106f04bc7d03.pdf',148779,'application/pdf','2026-05-28 12:45:05'),(3,1,'academique','documents/candidatures/academique_1_18f5bf499f5ad9f7.pdf',219142,'application/pdf','2026-05-28 12:45:05'),(4,2,'cv','documents/candidatures/cv_2_1b7d3c8d34307779.pdf',73836,'application/pdf','2026-05-28 13:37:37'),(5,2,'lettre','documents/candidatures/lettre_2_09e2fa7e019e313a.pdf',178509,'application/pdf','2026-05-28 13:37:37'),(6,2,'academique','documents/candidatures/academique_2_fef84b7d2850881a.pdf',1503556,'application/pdf','2026-05-28 13:37:37'),(7,3,'cv','documents/candidatures/cv_3_d909604f100737cf.pdf',216230,'application/pdf','2026-05-28 15:32:53'),(8,3,'lettre','documents/candidatures/lettre_3_d36c34d57a02defc.pdf',148779,'application/pdf','2026-05-28 15:32:53'),(9,3,'academique','documents/candidatures/academique_3_13465ab7f34e4398.pdf',73836,'application/pdf','2026-05-28 15:32:53'),(10,4,'cv','documents/candidatures/cv_4_149b7c1dc1881640.pdf',148779,'application/pdf','2026-05-28 15:36:49'),(11,4,'lettre','documents/candidatures/lettre_4_d9dc9c09338ee33f.pdf',216230,'application/pdf','2026-05-28 15:36:49'),(12,4,'academique','documents/candidatures/academique_4_ae631754b28d33bb.pdf',73836,'application/pdf','2026-05-28 15:36:49');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'code arduino','documents/avocats/av_3_65c677d98759d7a8.pdf','application/pdf',1108964,'document',3,NULL,1,'2026-05-29 12:44:46');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,2,'validation_document','Document validé','Votre document « rapport de stage » a été validé.','http://localhost:8000/interns/documents',0,'2026-06-03 17:10:23');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` VALUES (1,'beach','beach','\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nsfdghjk','ghjk','documents/publications/pub_7ce1b718390c424d.pdf','brochure','images/publications/cover_3229c7123859ec15.jpg','publie','2026-05-29 15:17:29',1,'2026-05-29 14:17:29','2026-05-29 14:17:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stagiaire_documents`
--

/*!40000 ALTER TABLE `stagiaire_documents` DISABLE KEYS */;
INSERT INTO `stagiaire_documents` VALUES (1,3,'rapport','rapport de stage','documents/stagiaires/stg_3_af8c3ab6695d1fb2.pdf',1108964,'application/pdf','valide',NULL,1,'2026-06-03 17:10:23','2026-06-03 17:10:05','2026-06-03 17:10:23');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stagiaires`
--

/*!40000 ALTER TABLE `stagiaires` DISABLE KEYS */;
INSERT INTO `stagiaires` VALUES (1,7,NULL,'upc','Autre','M2',NULL,NULL,NULL,NULL,'actif','2026-05-28 13:38:34','2026-05-28 13:38:34'),(2,8,NULL,'kin la belle','Autre','M1',NULL,NULL,NULL,NULL,'actif','2026-05-28 15:37:14','2026-05-28 15:37:14'),(3,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'actif','2026-05-29 14:27:08','2026-05-29 14:27:08');
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@admin.com','$2y$10$YqfU63jFadH/am3VuwoZgOtmb70GiqJT4y0ts.VZ/SGS3yDjjnG7u','admin','0000',NULL,1,NULL,'2026-05-26 21:42:38','2026-05-28 12:50:02'),(2,'issac','16paysayocesar@gmail.com','$2y$10$sbShCVwJId5R8pox1.JG2ePdMzfCjBFljc0L6HjXEz.mDseX5/l86','stagiaire','+243895511485',NULL,1,NULL,'2026-05-26 22:27:41','2026-05-28 14:54:23'),(3,'César Paysayo','cesar@gmail.com','$2y$10$PwupqSrj4wZiCQl.IiC/yuFRP.R3Pl6CzEsSVTdlgmydUfby9nPIO','avocat','+243895511485','images/avatars/avatar_3_8f815d66cb029056.jpg',1,NULL,'2026-05-27 21:47:52','2026-06-02 15:37:29'),(5,'randy','king@gmail.com','$2y$10$lQe/wX9rPl9G/IYYFEaYqe5eeCdwIB7J4IreMOKQQDXI5J3vkzK42','avocat','0816060100',NULL,1,NULL,'2026-05-28 11:18:03','2026-05-28 11:18:03'),(6,'baki','baki@gmail.com','$2y$10$6yZmO0kzgZ.Q1yMlRsnjG.eorT/OWPFbQASWxwKKX2MMtzHDU0Vpm','avocat','0816065651',NULL,1,NULL,'2026-05-28 11:52:56','2026-05-28 11:52:56'),(7,'Peter Peter','peter@gmail.com','$2y$10$4U1EnlriN9Y7OojSPOzkR.QttvdWLgNynCYUZzp2VdwW9A8fsYvIe','stagiaire','+243815252159',NULL,1,NULL,'2026-05-28 13:38:34','2026-05-28 14:54:59'),(8,'satan satan','satan@gmail.com','$2y$10$ncdYW60CAKq3BSFppgMrH.FJyRydmKyic..rPIcj52OZyfUkZjUxK','stagiaire','+243878945610',NULL,1,NULL,'2026-05-28 15:37:14','2026-05-28 15:37:14'),(9,'Bâtonnier Laurent MBAKO','Laurent@gmail.com','$2y$10$RT75sORqh8V60VWjFjLaIusddgQ9EjlfhFUkv/GSkDoDJV5tGPjKe','avocat','0811010100','images/avatars/avatar_9_c49586af663a7fa5.jpg',1,NULL,'2026-05-28 16:13:01','2026-06-01 20:13:10'),(10,'Maître Pierre KAHADI','Pierre@gmail.com','$2y$10$5FtzQHVqSM7CnJEFzadR6ORk.TdaMRRN.162Bd2.jdO98guEmhK52','avocat','+2430816067100','images/avatars/avatar_10_c768f02085b27094.jpg',1,NULL,'2026-05-28 16:14:41','2026-06-01 20:15:49'),(11,'Maître Olivier ABELI','Olivier@gmail.com','$2y$10$nep1evO7tXwZl6PNkTaxUe5/8uEQLxCz25BsZThRgNcnROQkRTXnW','avocat','+243895511159','images/avatars/avatar_11_d1b1c3a9fbbfe10f.jpg',1,NULL,'2026-05-28 16:16:19','2026-06-01 20:15:12'),(12,'Maître Ghislain MUSAS','Ghislain@gmail.com','$2y$10$5QqN4do/aKzcwOKC0xrvAObKWzuxzD1Kep52au92V.cucP2dgToS6','avocat','+243895511753','images/avatars/avatar_12_0b72c0deead835c2.jpg',1,NULL,'2026-05-28 16:17:21','2026-06-01 20:13:59'),(13,'Maître Rosy MUMBA','MUMBA@gmail.com','$2y$10$iikTo3XWPbnLK62c7ajQRuXU7LBvYEwJLqS1sWTPL2niTW54BvT2S','avocat','+243895511852','images/avatars/avatar_13_648a60d67207ea5e.jpg',1,NULL,'2026-05-28 16:18:07','2026-06-01 20:16:15'),(14,'Maître Justine NSENGA','NSENGA@gmail.com','$2y$10$zfO0673tRdKpGc274W2GRuIeDjEBarZ/ncNQw.nCCMG/1F.DKMK5G','avocat','+243895511456','images/avatars/avatar_14_83f521c7a8b405de.jpeg',1,NULL,'2026-05-28 16:20:03','2026-06-01 20:14:34'),(15,'Maitre Cécile MANDE','cecilemande@gmail.com','$2y$10$OxFTL0YEloXfjNdNYh/.0.gYKe44Uhc7LSCq9KlChdMoAkQNfLggS','avocat',NULL,'images/avatars/avatar_15_014cdbe0d902fcd8.jpg',1,NULL,'2026-06-04 12:25:48','2026-06-04 12:38:06'),(16,'Maître Joseph KAHASHA','josephkahasha@gmail.com','$2y$10$xka29WxprmMk5hZAP6Kzmu.qvNwvzVIQP2q48D4afMlbfUtEjpNY.','avocat','','images/avatars/avatar_16_dbd13c2b1c9ba6ab.jpg',1,NULL,'2026-06-04 12:41:29','2026-06-04 12:42:19'),(17,'Maitre Grâce KAFUMBU','gracekafumu@gmail.com','$2y$10$HNp7O8cxWVIBBhhDCcXgPOAwAicjg2vZKm4uEJeMGK5.p2YHE17SS','avocat','',NULL,1,NULL,'2026-06-04 12:48:13','2026-06-04 12:48:13'),(18,'Maitre Christian SAPU','chistiansapu@gmail.com','$2y$10$fSxkQ7nADbqgQREQRyzWsek6V.TgO/GHhzlX3CahOaZMCU9UTSNDO','avocat','','images/avatars/avatar_18_8bef188c51c8b808.jpg',1,NULL,'2026-06-04 12:50:59','2026-06-04 12:52:59'),(19,'Maître Bijou MUKESI','bijoumukesi@mail.com','$2y$10$g5saIutAx3DntpXP9XecLeR.Y8QXjXMxAvFgv6sfi0gfWosN1DrvG','avocat','','images/avatars/avatar_19_c9c048aad55fec5b.jpg',1,NULL,'2026-06-04 12:54:57','2026-06-04 12:55:36'),(20,'Maitre Dominic CASSINI','dominiccassini@gmail.com','$2y$10$gt/ntm/E9hTxojCKJJ/Jo.zczL9dK4vV5DPmhaoyle1BrpE9/Z4i.','avocat','','images/avatars/avatar_20_bea5057b24c98daf.jpg',1,NULL,'2026-06-04 13:01:42','2026-06-04 13:02:27'),(21,'Maitre Eliatha KALUNGA','eliathakalunga@gmail.com','$2y$10$E3pFGwo6N7AT5vThh/a89.ZJ.ZZJvcpctclMyWuS7zsZ8WZfMIWW.','avocat','','images/avatars/avatar_21_6a818203cf0d5350.jpg',1,NULL,'2026-06-04 13:04:41','2026-06-04 13:05:27'),(22,'Maitre Victor KAZAD','victorkazad@gmail.com','$2y$10$.rIEDRyuvq/sIAndCuMWRuWDM5OVrsntFiMwDLAAzpEZgCP.ADmgC','avocat','','images/avatars/avatar_22_208dce30904f192d.jpeg',1,NULL,'2026-06-04 13:07:44','2026-06-04 13:09:04');
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

-- Dump completed on 2026-06-04 17:20:02
