-- MySQL dump 10.13  Distrib 8.0.21, for macos10.15 (x86_64)
--
-- Host: 127.0.0.1    Database: deskimo
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_oauth2_access_tokens`
--

DROP TABLE IF EXISTS `tbl_oauth2_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_oauth2_access_tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` int DEFAULT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EAE046D5F37A13B` (`token`),
  KEY `IDX_EAE046D19EB6921` (`client_id`),
  KEY `IDX_EAE046DA76ED395` (`user_id`),
  CONSTRAINT `FK_EAE046D19EB6921` FOREIGN KEY (`client_id`) REFERENCES `tbl_oauth2_clients` (`id`),
  CONSTRAINT `FK_EAE046DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_oauth2_access_tokens`
--

LOCK TABLES `tbl_oauth2_access_tokens` WRITE;
/*!40000 ALTER TABLE `tbl_oauth2_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_oauth2_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_oauth2_auth_codes`
--

DROP TABLE IF EXISTS `tbl_oauth2_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_oauth2_auth_codes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redirect_uri` longtext COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` int DEFAULT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1E196F9F5F37A13B` (`token`),
  KEY `IDX_1E196F9F19EB6921` (`client_id`),
  KEY `IDX_1E196F9FA76ED395` (`user_id`),
  CONSTRAINT `FK_1E196F9F19EB6921` FOREIGN KEY (`client_id`) REFERENCES `tbl_oauth2_clients` (`id`),
  CONSTRAINT `FK_1E196F9FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_oauth2_auth_codes`
--

LOCK TABLES `tbl_oauth2_auth_codes` WRITE;
/*!40000 ALTER TABLE `tbl_oauth2_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_oauth2_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_oauth2_clients`
--

DROP TABLE IF EXISTS `tbl_oauth2_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_oauth2_clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `random_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redirect_uris` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allowed_grant_types` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_oauth2_clients`
--

LOCK TABLES `tbl_oauth2_clients` WRITE;
/*!40000 ALTER TABLE `tbl_oauth2_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_oauth2_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_oauth2_refresh_tokens`
--

DROP TABLE IF EXISTS `tbl_oauth2_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_oauth2_refresh_tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` int DEFAULT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6A2E7A235F37A13B` (`token`),
  KEY `IDX_6A2E7A2319EB6921` (`client_id`),
  KEY `IDX_6A2E7A23A76ED395` (`user_id`),
  CONSTRAINT `FK_6A2E7A2319EB6921` FOREIGN KEY (`client_id`) REFERENCES `tbl_oauth2_clients` (`id`),
  CONSTRAINT `FK_6A2E7A23A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_oauth2_refresh_tokens`
--

LOCK TABLES `tbl_oauth2_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `tbl_oauth2_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_oauth2_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_role_permission`
--

DROP TABLE IF EXISTS `tbl_role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_role_permission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_role_permission`
--

LOCK TABLES `tbl_role_permission` WRITE;
/*!40000 ALTER TABLE `tbl_role_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_role_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `hash_token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expired_token_at` datetime DEFAULT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_38B383A1F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'2021-03-16 00:00:00','2021-03-16 00:00:00',NULL,'admin@yopmail.com','$2y$10$2wSBIYa6sPuZHS33W0a60.IeRbZYi7yYLXKuJxinmF7gDc/cVPGou','admin',7,NULL,NULL,1);
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_profile`
--

DROP TABLE IF EXISTS `tbl_user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user_profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employee_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2709CE93A76ED395` (`user_id`),
  CONSTRAINT `FK_2709CE93A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_profile`
--

LOCK TABLES `tbl_user_profile` WRITE;
/*!40000 ALTER TABLE `tbl_user_profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_user_profile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-16 21:26:51
