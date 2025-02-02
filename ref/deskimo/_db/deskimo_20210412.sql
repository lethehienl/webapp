-- MariaDB dump 10.17  Distrib 10.4.13-MariaDB, for Win64 (AMD64)
--
-- Host: deskimo.cw3vwfv4xp1c.ap-southeast-1.rds.amazonaws.com    Database: deskimo
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_amenity`
--

DROP TABLE IF EXISTS `tbl_amenity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_amenity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `code` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `icon_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon_key` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F033711777153098` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_amenity`
--

LOCK TABLES `tbl_amenity` WRITE;
/*!40000 ALTER TABLE `tbl_amenity` DISABLE KEYS */;
INSERT INTO `tbl_amenity` VALUES (1,'2021-04-04 14:10:26','2021-04-04 14:10:26','Amenity 1','Name','test'),(2,'2021-04-04 14:10:35','2021-04-04 14:10:35','Amenity 2','Name','tete'),(3,'2021-04-04 14:42:48','2021-04-04 14:42:48','amenity 3','icon 3','icon 3'),(9,'2021-04-08 14:25:34','2021-04-08 14:25:34','Test 3',NULL,NULL),(10,'2021-04-09 12:44:00','2021-04-09 12:44:00','Test 1',NULL,NULL),(11,'2021-04-09 12:44:25','2021-04-09 12:44:25','test 2',NULL,NULL),(12,'2021-04-09 12:54:17','2021-04-09 12:54:17','Test 4',NULL,NULL),(13,'2021-04-09 12:54:33','2021-04-09 12:54:33','Test 5',NULL,NULL),(14,'2021-04-09 12:54:42','2021-04-09 12:54:42','Test 6',NULL,NULL),(15,'2021-04-09 12:54:53','2021-04-09 12:54:53','Test 7',NULL,NULL),(16,'2021-04-09 12:55:00','2021-04-09 12:55:00','Test 8',NULL,NULL),(17,'2021-04-09 12:55:14','2021-04-09 12:55:14','Test 9',NULL,NULL),(18,'2021-04-09 12:55:24','2021-04-09 12:55:24','Test 10',NULL,NULL),(19,'2021-04-09 14:11:08','2021-04-09 14:11:08','a',NULL,NULL);
/*!40000 ALTER TABLE `tbl_amenity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_customer_payment_gateway`
--

DROP TABLE IF EXISTS `tbl_customer_payment_gateway`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_customer_payment_gateway` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `customer_ref` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E5E79DC7A76ED395` (`user_id`),
  CONSTRAINT `FK_E5E79DC7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_customer_payment_gateway`
--

LOCK TABLES `tbl_customer_payment_gateway` WRITE;
/*!40000 ALTER TABLE `tbl_customer_payment_gateway` DISABLE KEYS */;
INSERT INTO `tbl_customer_payment_gateway` VALUES (1,3,'2021-04-04 04:52:38','2021-04-04 04:52:38','cus_JErgF5ebywDQQJ','stripe',2),(2,7,'2021-04-04 15:25:26','2021-04-04 15:25:26','cus_JF1tzXrSaKQHv6','stripe',2),(3,9,'2021-04-05 11:56:30','2021-04-05 11:56:30','cus_JFLkDjY37GU3yf','stripe',2),(4,10,'2021-04-05 12:19:48','2021-04-05 12:19:48','cus_JFM7RJLODYz6q2','stripe',2),(5,8,'2021-04-05 12:23:30','2021-04-05 12:23:30','cus_JFMBmlI5UhyROO','stripe',2);
/*!40000 ALTER TABLE `tbl_customer_payment_gateway` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_device_token`
--

DROP TABLE IF EXISTS `tbl_device_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_device_token` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `device_token` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_os` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67E13BCAA76ED395` (`user_id`),
  CONSTRAINT `FK_67E13BCAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_device_token`
--

LOCK TABLES `tbl_device_token` WRITE;
/*!40000 ALTER TABLE `tbl_device_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_device_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_invoice`
--

DROP TABLE IF EXISTS `tbl_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `property_company_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `invocie_no` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `invoice_from` datetime DEFAULT NULL,
  `invoice_to` datetime DEFAULT NULL,
  `invoice_pdf` varchar(511) COLLATE utf8_unicode_ci DEFAULT NULL,
  `share_revenue_percent` decimal(11,4) DEFAULT NULL,
  `share_revenue_total` decimal(11,4) DEFAULT NULL,
  `sub_total` decimal(11,4) DEFAULT NULL,
  `tax_rate` decimal(11,4) DEFAULT NULL,
  `tax_total` decimal(11,4) DEFAULT NULL,
  `total` decimal(11,4) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `currency` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `processing_free` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CB361F301A318575` (`invocie_no`),
  KEY `IDX_CB361F30223A3AE5` (`property_company_id`),
  CONSTRAINT `FK_CB361F30223A3AE5` FOREIGN KEY (`property_company_id`) REFERENCES `tbl_property_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_invoice`
--

LOCK TABLES `tbl_invoice` WRITE;
/*!40000 ALTER TABLE `tbl_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_invoice_item`
--

DROP TABLE IF EXISTS `tbl_invoice_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_invoice_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `invoice_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price` decimal(11,4) DEFAULT NULL,
  `tax_time` decimal(11,0) DEFAULT NULL,
  `rate_per_hour` decimal(11,4) DEFAULT NULL,
  `total` decimal(11,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E38D3DED2989F1FD` (`invoice_id`),
  CONSTRAINT `FK_E38D3DED2989F1FD` FOREIGN KEY (`invoice_id`) REFERENCES `tbl_invoice` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_invoice_item`
--

LOCK TABLES `tbl_invoice_item` WRITE;
/*!40000 ALTER TABLE `tbl_invoice_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_invoice_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_invoice_item_visit`
--

DROP TABLE IF EXISTS `tbl_invoice_item_visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_invoice_item_visit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `visit_id` int DEFAULT NULL,
  `invoice_item_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8EBA71D175FA0FF2` (`visit_id`),
  KEY `IDX_8EBA71D1E0B6648D` (`invoice_item_id`),
  CONSTRAINT `FK_8EBA71D175FA0FF2` FOREIGN KEY (`visit_id`) REFERENCES `tbl_visit` (`id`),
  CONSTRAINT `FK_8EBA71D1E0B6648D` FOREIGN KEY (`invoice_item_id`) REFERENCES `tbl_invoice_item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_invoice_item_visit`
--

LOCK TABLES `tbl_invoice_item_visit` WRITE;
/*!40000 ALTER TABLE `tbl_invoice_item_visit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_invoice_item_visit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_oauth2_access_tokens`
--

DROP TABLE IF EXISTS `tbl_oauth2_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_oauth2_access_tokens`
--

LOCK TABLES `tbl_oauth2_access_tokens` WRITE;
/*!40000 ALTER TABLE `tbl_oauth2_access_tokens` DISABLE KEYS */;
INSERT INTO `tbl_oauth2_access_tokens` VALUES (1,1,1,'Y2NkNTRmZTdkM2Q3NGQyYzNiMDA5OTZhOWU1ZTllNzIyOWE0NzFiNzhiMjNlOWRmZWZjOGU0ZWQ0MmEyYWJkZg',1620012346,NULL,'2021-04-03 03:25:46','2021-04-03 03:25:46'),(2,1,1,'ZGQzNjUwNGQ2MzViZTYyNGQyYWNjMWQ5MmI0OWI1Mzk3NjE3YTM5MTZlYTVhNWNjYWYzMTVmNThiMjJkZjUwYQ',1620013633,NULL,'2021-04-03 03:47:13','2021-04-03 03:47:13'),(3,1,1,'MzVmNDgzNTdiNTc0YWI0ODA4ZTkwODMxYjM5MWFhY2MwMDgxN2JiOTgxMTgxOTk2Y2VlZjliMGJiODViMGI2YQ',1620013879,NULL,'2021-04-03 03:51:19','2021-04-03 03:51:19'),(4,1,1,'MzE1MDM3NzE4NDE3ZDk3YzI1N2NkNTBjZDc5YjMzYTZiZjVlMjM2OWM3ZjAxZDJkNDdjOTJkOThkMDhkNTAyOA',1620014156,NULL,'2021-04-03 03:55:56','2021-04-03 03:55:56'),(5,1,1,'OWQ0MmUyY2ZhM2UxNzRlYTUzZWM3NGEyZjFiYWU3ZTc3NDQ3NDgzNDRhNmViYjU5NjMxYmNkZmJiNDEwNDdlNQ',1620014234,NULL,'2021-04-03 03:57:14','2021-04-03 03:57:14'),(6,1,2,'YzZhZDRkZjFiMTdhOTBjNTg1NGFkOWVlMGE5ZWQ3NzE0ZGZmZTdjMThkZjQ1N2ZhNTc4ZjUwNTEzOWY3OWViNw',1620016985,NULL,'2021-04-03 04:43:05','2021-04-03 04:43:05'),(7,1,2,'OTQ1NTZiNzg2Y2Q5NWUwZWYwMDE2MDEyYzZiNGRhMmNjOGM5ZjJlOThlMGEyN2RmOTYwMDY3ZTE0MzIzYjA5Yg',1620017045,NULL,'2021-04-03 04:44:05','2021-04-03 04:44:05'),(8,1,2,'MjdmMjI3NGJmMTM4NjA5NzliYjdjMDY4MmFmMWZmY2YyNGQxMTg5OWU3MzE5YTNlMDNhMmU5OTM0MTU4MTdjNA',1620017172,NULL,'2021-04-03 04:46:12','2021-04-03 04:46:12'),(9,1,2,'YTNjNTlkYzY4MzIwNDQ3YjgxMjE2ODkxNDcyZTAyYjA3ZDU1N2NjYTBiZWJmNTVkNzc3MGE2M2Y2YmYwZmExMg',1620017172,NULL,'2021-04-03 04:46:12','2021-04-03 04:46:12'),(10,1,2,'NDFkZTgyY2YwY2M2ZmYyMWMwNTE4MzJkZTNmYjdlZjY2N2JhZmM2YmQzMDJlODk3OGJlNmM1MTVmZjU5Nzc5ZA',1620018508,NULL,'2021-04-03 05:08:28','2021-04-03 05:08:28'),(11,1,3,'MTlhM2MyMmVkYjFjMTE1YTRiOTMzN2U3OTQyZTFjMWFhNDExM2Y5ODk0MGZlZjE4OTY4YWUwODg2MTRlMjZhYQ',1620020701,NULL,'2021-04-03 05:45:01','2021-04-03 05:45:01'),(12,1,3,'NDgzZTM1ZjBlYjVhYjg5OTQ3YTlkMjNlYWVhMWYwYTNlYTc1Y2U5OWRhY2JiZjdhYzhkNDkxMzA4ZWNjNTZjZg',1620020728,NULL,'2021-04-03 05:45:28','2021-04-03 05:45:28'),(13,1,3,'M2NiZWMzZjdmMzRhMDUzMGU0MjU4OGU5ODZjMDRiNjc5OWY4YTEyMWI0NDRmOTdkMTJmYTMyMGYyMDU0YjIxZQ',1620020771,NULL,'2021-04-03 05:46:11','2021-04-03 05:46:11'),(14,1,3,'MmE2MDI4OWY1NGU5NGJhMDgzZmYyNmRhNGU0NjQxZWZkZDU2MjNjZDdmMGJkZDFjOGI1NDZiN2I4MDEyMTk5MQ',1620029310,NULL,'2021-04-03 08:08:30','2021-04-03 08:08:30'),(15,1,3,'MDIzMjQyNThiZTE4NmQ4MTkyNmNjNGQxZDg3MTcwZjg0MTNmZmVmNTdkMjY3NmUwMDVlMTVjNmE1ZDgzNzdiMw',1620132371,NULL,'2021-04-04 12:46:11','2021-04-04 12:46:11'),(16,1,3,'MzllMzI3OWJhMWI0YmY2ZTIzZjU2OTFkZTdlYjYwZjU2OGQ0ZDViN2ExM2U5NDhiNjIwNjY0NWI4YTQyMzNkOQ',1620132390,NULL,'2021-04-04 12:46:30','2021-04-04 12:46:30'),(17,1,3,'OWY4ZmVkMTI2MDk0ZmM0ODFkMGY2ZDAzNDM4OGNjZDQyYjhkMzBmNGVhY2Q4OTc5MDQ2MTE4ZmVkNDZmZTgyNA',1620132485,NULL,'2021-04-04 12:48:05','2021-04-04 12:48:05'),(18,1,3,'ZWY1NjFiZDRjOWZkMTNiNWZkZmQ2ZGYyYzU1Y2FhNjkwNjZkYjEzZmMxZTk0ZTBiYzJjN2ExODJhYjAxZTNiNQ',1620132634,NULL,'2021-04-04 12:50:34','2021-04-04 12:50:34'),(19,1,3,'NTJmOTEwNWM5ODE0MzdhODU5ZmQwZWFmZmQ2ZTNiMTcwZDI3YzFkMGUyMWUyNjFlNGIzZTYxNjEzNTdlNjQ4OA',1620133431,NULL,'2021-04-04 13:03:51','2021-04-04 13:03:51'),(20,1,3,'N2IzYWNjMzNkZWU3MmFhOWM4ZjM2NGQ0MTQxOGUxYWFkMWMwZTc1ZjFmNmFlZWMzZmI5YWU1NzhhNGRmMDljOA',1620133431,NULL,'2021-04-04 13:03:51','2021-04-04 13:03:51'),(21,1,1,'ZDFjNjM2NWVhYjRjNTZhZGNjMTdhNWY5Y2ExYTU3MWI0Mjk4MzVjMGUxZmI4NmY5MjFjYmEwNjY2NmZlNGNjZg',1620133510,NULL,'2021-04-04 13:05:10','2021-04-04 13:05:10'),(22,1,3,'N2FlMDU1MzdmYzNkNTYwMGIyOWFhMDM5MzJmNjQ4YTU2MGFkYzc1NTRlMzZkYTI2MTQyZDU4OWU4MWQwZGI5MA',1620133612,NULL,'2021-04-04 13:06:52','2021-04-04 13:06:52'),(23,1,3,'YTY3ZTE4ZmQwZWQyMzNkM2I3Y2IwZTkyZjU4MjA0ODhhODhmY2RiMTY2MzFkMTExYzY3ZTYwZTM1MGNjODQxNA',1620135827,NULL,'2021-04-04 13:43:47','2021-04-04 13:43:47'),(24,1,3,'NDI3NTJmN2FhNDA1MWM1MjdhOGMwNmQyOTA0N2VkMDBhODU2NDBiODViMjA3ZjU2MDc2MjlkMzIxZGFlYWQ4Zg',1620136001,NULL,'2021-04-04 13:46:41','2021-04-04 13:46:41'),(25,1,3,'NjBmZGE0NzQzNWQ4YTY3MDMyOWMxOThkM2VmMWI4MzdhZWVlYjk1YTE1MTY1MmRlMTM5MzI5NDc2YTFlZjYzZA',1620136037,NULL,'2021-04-04 13:47:17','2021-04-04 13:47:17'),(26,1,3,'OTEyN2EyYTg3NjQyY2VkNTlhMmExMDM2YTQxMzBkNjRiN2QzMmYzNWNiYzk5YjdiMzZmMjljYTgwNWRmYjczNw',1620138473,NULL,'2021-04-04 14:27:53','2021-04-04 14:27:53'),(27,1,7,'ZTAxOTAwMjY2MjkyMDVhYzVhYTE1OGI1OGQ3OTQyOTg1MWZjZTlmMThjOTE1YWYyN2UxZDRmYWIwNDU5NTc4Zg',1620141866,NULL,'2021-04-04 15:24:26','2021-04-04 15:24:26'),(28,1,7,'YjRkNjljNDljMmZiNjBiZTUxOWZiYTViOWI4NDg3YTQyMWJjNTc5NmM1YjgzNWIxMTc3Y2Q2YTIyZmZkYjRhOA',1620187612,NULL,'2021-04-05 04:06:52','2021-04-05 04:06:52'),(29,1,7,'OWRiNGJiYTRkNmYyMWM0NWNjMGRkMThmODdmNmQzM2ZlMTJjY2Q3NzgwZWQxNjFiMmQxOTFkZTI3ZGRkNzI5OQ',1620206899,NULL,'2021-04-05 09:28:19','2021-04-05 09:28:19'),(30,1,7,'NjQzZDE0MGUyNzdhMzYzZGJjOGUzZDg5YjljZTQxYWVkMTVhOWY2MGMwMGVlYWM3ZTRmN2YyNjVlODNmMTc5ZA',1620208476,NULL,'2021-04-05 09:54:36','2021-04-05 09:54:36'),(31,1,7,'MTAyNWQ5MDk4MDgxMzBhMDM4Y2MwZDA5ZmI3ZmQ4YzQzOTQxOTkyYWZiMTA0NmE2MDM1MDgxMTI3ZDJjZmI2Ng',1620209135,NULL,'2021-04-05 10:05:35','2021-04-05 10:05:35'),(32,1,7,'ODJhNGQ0MTU2ZjdmMTZiN2I0ODA4ZDA3OWJkMzNhMWYxMDQzMTk2ZDI5ZjFmZTNjMDkwYzA1ZTE4YjRjYzY5Zg',1620213251,NULL,'2021-04-05 11:14:11','2021-04-05 11:14:11'),(33,1,7,'YzVmYWUyOTU0YzE4Nzc5MmUwZmMwNzY3NDlkODk4ZTBjY2ZjZTFhODFlNzVkOTIwYjQ1NDcwYmY0MjVmMmEzMw',1620213808,NULL,'2021-04-05 11:23:28','2021-04-05 11:23:28'),(34,1,8,'NjEwZGVkOTU1NDhlNGRiNDZlMWZkNGFiNmQ3OWY5OGMyYjcyNmVhYjVjODVmYTE0NTliMDhlOGRmYWRmMzRjYg',1620215656,NULL,'2021-04-05 11:54:16','2021-04-05 11:54:16'),(35,1,9,'MDFkZTc0Nzc5YjJmODk3YjUxN2Q0ZDdlOTRlNzQ4MDMwN2JlNjUzMDI3MWUwMjAzMzQwNGU4NTY1OTZlNjRhYg',1620215731,NULL,'2021-04-05 11:55:31','2021-04-05 11:55:31'),(36,1,9,'YmQ5YTYxMzU4ZDBiNGI5MjVmMGYyM2UzMzhjMmYxN2MzZjgxMmY4YmFlMmZjMDY1NjFhMzUyM2I2NmNiMzAzZA',1620216598,NULL,'2021-04-05 12:09:58','2021-04-05 12:09:58'),(37,1,10,'MmE5YzhhZmI3OGU2NDZjYTM0ZThlMzE1ZDJlNzM4MTQ5YjAwMTU4YmI2NGI5OTYyMDJhM2RiODQ4ODU1OWJhNw',1620217121,NULL,'2021-04-05 12:18:41','2021-04-05 12:18:41'),(38,1,8,'OTczMTc1YWUzZGViODlmMzBmYzBlMGFmMzZjYmM3YjFkZTc5ZGJmNDI3NmI4ZDEwNDg0NWVmN2NkYjI0YzA1Nw',1620217377,NULL,'2021-04-05 12:22:57','2021-04-05 12:22:57'),(39,1,8,'Y2Y5ZTEyNDY2Mzc5YWYxMzU3ZmI2MDZiNTk4ZmI0MDdhOTg3YTBiZjk5OTFjYTU3ZWY2MjAwODdmY2NjZDQxMw',1620367072,NULL,'2021-04-07 05:57:52','2021-04-07 05:57:52'),(40,1,8,'NTFiNmUxY2Q1OTFhMTY4ZmUyYTg2OWMwOGNjYmM4MmExODhhYWE3OTI2YjQ0YmE0MGYyMDU0MGEzMDBlMjEzNw',1620386607,NULL,'2021-04-07 11:23:27','2021-04-07 11:23:27'),(41,1,8,'MDk5YTMwYmVlYWQyYmZjMWMzZmFmNmZiOWQ5MGYyNGQ1Mzc3NTExNjZkOWIxNDliNmFhMmY2ZDVhZTUyNmZlNQ',1620403117,NULL,'2021-04-07 15:58:37','2021-04-07 15:58:37'),(42,1,8,'NjllYjBhMzZkMWVhYjc0MDJiZTg1ZTVlYTBiOGEyNjFlOTk1ZWQzZWQwZjljNzRiNDViYTI5Y2YxNDYwNWU3Yg',1620403681,NULL,'2021-04-07 16:08:01','2021-04-07 16:08:01'),(43,1,8,'ZDEzMzI5NTdhOWIzNjYzZWUwZjcxZWI0YjE0ODI5ODVkOGYxMjk5MWNjYWI3MTRiMTgwZGEyNmM0YTMwNTI3ZA',1620404716,NULL,'2021-04-07 16:25:16','2021-04-07 16:25:16'),(44,1,8,'NDFkMmQ3YTYxNWFhYzNlMDIyMjIwZTY1YTNmMDA4NGM1Njg5MzM5YmMyZTBkZjRkZWU4YmY5N2JlNDhiYzkzOA',1620489759,NULL,'2021-04-08 16:02:39','2021-04-08 16:02:39'),(45,1,8,'Nzg5ZjMzYzczNjZlNzJmN2RjM2NmYTI5NTIxZTBiNGQ3NDQwMzEwYTFlZDViZDhhMDY5ZGJkMmU0OGYzZWJkOA',1620528956,NULL,'2021-04-09 02:55:56','2021-04-09 02:55:56'),(46,1,8,'MWJhYTYyYThlZmQ1YmMxMDdkYTAyMzFmYjcxYmRlMTUzMjZkZWFhOWIxNmYyZDJkMmMzYjVmMTZiMWZlMjIxYw',1620543579,NULL,'2021-04-09 06:59:39','2021-04-09 06:59:40'),(47,1,8,'OGM0ZTdkNDYzNjFjNWM1ZmQyNTI1ZmMyN2U1OTJjMmMyOTlkMDM3MTFhY2Y1ZDA4NmVlZGE4NjQ0NDE3YTI4Mg',1620546601,NULL,'2021-04-09 07:50:01','2021-04-09 07:50:01'),(48,1,8,'ODc4NTdjYTAxOTYzYzRkNDY2NzlkM2U0ZTZhMGNkMzBiYjk2OTBjNWEzODM2MmJiZDZmNGVmOTE0ZDdhNDk1Yw',1620546764,NULL,'2021-04-09 07:52:44','2021-04-09 07:52:44'),(49,1,1,'YjEwMGY1ZmEwZGFkNTg4YWRiMzIzMzI5NzBlMjA0YTFmNWRhYjViM2Q4MGQxZGFkYWIwNGVmNzkzMWI0Mzk5NA',1620707202,NULL,'2021-04-11 04:26:42','2021-04-11 04:26:42'),(50,1,8,'ZDZkM2QyYTZmMmQ5ZjA5MjI5MDc0ZWQwOGIzMDc1ZDc2NDU4ODg1YTJlODE2ZWE3Yzg0MGY0MjIyOGM5MmZkNQ',1620712795,NULL,'2021-04-11 05:59:55','2021-04-11 05:59:55'),(51,1,8,'Mzc5MzQ5MTAwMGE1NzE5MTY3ZWE3ZGY4OWQ3NjE0ZmQ4YWRlYjc3OGJlOTNjODNlYWQ2ZjEzYTA2NDJhNzFhOQ',1620818448,NULL,'2021-04-12 11:20:48','2021-04-12 11:20:48'),(52,1,8,'MGZjNWRjODQ0MGEyZDdiMmI0MTk1ZjRmM2U1YThiNDU5NGM2ZGJiNWZkMGFkNDZkODg5MjU0YjI5NzQ1MTJiOQ',1620822933,NULL,'2021-04-12 12:35:33','2021-04-12 12:35:33');
/*!40000 ALTER TABLE `tbl_oauth2_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_oauth2_auth_codes`
--

DROP TABLE IF EXISTS `tbl_oauth2_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_oauth2_clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `random_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redirect_uris` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allowed_grant_types` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_oauth2_clients`
--

LOCK TABLES `tbl_oauth2_clients` WRITE;
/*!40000 ALTER TABLE `tbl_oauth2_clients` DISABLE KEYS */;
INSERT INTO `tbl_oauth2_clients` VALUES (1,'4zq76kxvc30okw0o08o4ogw8c80cgok80c80wg444884s8kcos','a:1:{i:0;s:19:\"https://deskimo.com\";}','27gpf700f78kwwo84scwo40444o40ows80gk8scw0w048k4w4s','a:2:{i:0;s:8:\"password\";i:1;s:30:\"https://deskimo.com/grants/otp\";}','2021-04-03 03:10:05','2021-04-03 03:10:05');
/*!40000 ALTER TABLE `tbl_oauth2_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_oauth2_refresh_tokens`
--

DROP TABLE IF EXISTS `tbl_oauth2_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_oauth2_refresh_tokens`
--

LOCK TABLES `tbl_oauth2_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `tbl_oauth2_refresh_tokens` DISABLE KEYS */;
INSERT INTO `tbl_oauth2_refresh_tokens` VALUES (1,1,1,'NDBlZjAxNTI0OTlmMDY0MTk1ZWQyZjFlM2U3M2I4OTVkMmZmN2M4Yzc2MWExODk0N2M0OTgzZDFmNGYyZDc0NA',1621308346,NULL,'2021-04-03 03:25:46','2021-04-03 03:25:46'),(2,1,1,'NTYzNGVmZGI5MDU5ZjQ4YjBiYzU1NTA3OTNkYzdlMDIyZjIwYzE4Y2ViMDRkZTAyNzBmMTZjMjlkNTUwNzE2NA',1621309633,NULL,'2021-04-03 03:47:13','2021-04-03 03:47:13'),(3,1,1,'MTY5MzQyNDljNWE3MzlhZTZlMjFiZmU5NTU5ZDliMGZhYzg4YjIyZGZjNjc3M2MwOTU5NWEwMjk5MzFlMmRiOQ',1621309879,NULL,'2021-04-03 03:51:19','2021-04-03 03:51:19'),(4,1,1,'YzEzODA2NjI5ZjE2MDc0YjYwNjg4ZWVlZGQ4Yjg3NzFiNzAwNzA5ODIxMjRiMDg3OWNmN2I5N2M0YjQ0NTJjOA',1621310156,NULL,'2021-04-03 03:55:56','2021-04-03 03:55:56'),(5,1,1,'ZDhiMjIxYTE2OWQyMzhjZDc5MDM0ZGMxYTFlN2NlMTlhOTcyM2RkYjBlMGI0NTEwNGU3MTA2MjgxODc2ZTQzYQ',1621310234,NULL,'2021-04-03 03:57:14','2021-04-03 03:57:14'),(6,1,2,'NGExMzFjYTY5MTI2NWI2ZmE5MDg5YzU4NTNhNjcxZjJmMzE0OTAyMGQ2YTY0NTY0ZjU4ZmZlZGExMmJjMzFjOQ',1621312985,NULL,'2021-04-03 04:43:05','2021-04-03 04:43:05'),(7,1,2,'MjkxZmI2NDU0ZjNkMDgwYjc4MmQzN2M1Mjk5MWNhZTljN2Q1NTZmNDliM2E1NDA0ZTU4ODlmMDZiYWZmNDhlOA',1621313045,NULL,'2021-04-03 04:44:05','2021-04-03 04:44:05'),(8,1,2,'MDk0MTVjYWI5MGNmNDJiMjIxMzE2NGIzNTRhMzhhNTUwNmFjMjA0OGIzZjBlZTA1YmExYjM0NjRhYTE5OGE3Yw',1621313172,NULL,'2021-04-03 04:46:12','2021-04-03 04:46:12'),(9,1,2,'Yzg5NTgzNDczZjZiZTI0YTYyMjI3MWZkYTAxY2UyYTcwNjZkMzVmNTViYmY1NjY3OTA2Y2IzOWYxNzYzM2U2ZA',1621313172,NULL,'2021-04-03 04:46:12','2021-04-03 04:46:12'),(10,1,2,'NjEzNWRmZTY4ZGI5YmY0YWZkNTcwZWQ4Y2UyNmRhYjQxOWU3YjRjNjUzN2U0MWUwNDRhMzg0MWU0YjI0NGRhNA',1621314508,NULL,'2021-04-03 05:08:28','2021-04-03 05:08:28'),(11,1,3,'NDI3YzEzYTg1YjkxMTRjODdhMmNjY2FiMDMzZmEyY2Q3MTQ0ZGZkNWVmZDcwZWM2OWI1ODMzZTNhM2QzNTA1MQ',1621316701,NULL,'2021-04-03 05:45:01','2021-04-03 05:45:01'),(12,1,3,'ZmZlODYxMGI3NTZjNzJlNWU5YzJiZjM3NjI0OGY4M2JjNjUwOTc3NzdmMDdiZDUzNGVkODUyZWVjNjE4OWI0MQ',1621316728,NULL,'2021-04-03 05:45:28','2021-04-03 05:45:28'),(13,1,3,'M2EzMTExOWQyYzliNmE2ZGUzOWYxZDQ0ZDdmZTNiYjNmN2FhZTljMmZlYTQ1MTAxNWY4YWQ1NTVlMWM4MTRjNA',1621316771,NULL,'2021-04-03 05:46:11','2021-04-03 05:46:11'),(14,1,3,'ODE2OWY1M2YyYjJjYWVkZjQ1ZTIwNTUxYzU2YTU2MjRlNzZmYWIyMTAxMmI0ZWNjZGI4MjEyYjY4NjMwOTZiYg',1621325310,NULL,'2021-04-03 08:08:30','2021-04-03 08:08:30'),(15,1,3,'Y2M2NmNhNTg0M2VhNWEzMTVmZWNlMzU1MGFmZmQ4NTcyY2YzNGQyMDY5MDA2NWU0OWVhYTljZWQ3NWU1MTFjMQ',1621428371,NULL,'2021-04-04 12:46:11','2021-04-04 12:46:11'),(16,1,3,'NDQ3ZTE3YzlmZjQ1NThlZmY4ZmY0MmM4NzEzNDgyYjg1NTFlOWFkZWMxMWJiMDMzYWM4N2ZkMGM5NGJkZGYyMA',1621428390,NULL,'2021-04-04 12:46:30','2021-04-04 12:46:30'),(17,1,3,'MmZhYTYxMzA4Y2Q4MjgyNDNjMmZhZWQ1ZjBiMTcxZDIxZWY3Zjc2ZDg0YzExZGQxZTVlNzIwZjMxN2U5NmNmZg',1621428485,NULL,'2021-04-04 12:48:05','2021-04-04 12:48:05'),(18,1,3,'MTRiMDAxMDU1MmI3NmYyYTFkYzNmZjUzMTA0MDI3MzRlZGM0ZDM3MTYxNzI0OWM1MTM2ZTQ2YmI0MDBlYjY0ZA',1621428634,NULL,'2021-04-04 12:50:34','2021-04-04 12:50:34'),(19,1,3,'MzJlYTcyYjJhZGFkOGU4NTg3NjA1MWIyZTkxZDI1ODQwZjE2MTQ4MWM2NGRiOGM5MzRkMzNmMjk2YTRmY2RiMA',1621429431,NULL,'2021-04-04 13:03:51','2021-04-04 13:03:51'),(20,1,3,'YTFkYWY0MjJkNjdlNjkyZjkwNjYwNzI3YWU5Yjg1NzMzNjY2NTcxOGQ2YTI4NmM5ZDk5YjBhZGE4M2EzMDFlZQ',1621429431,NULL,'2021-04-04 13:03:51','2021-04-04 13:03:51'),(21,1,1,'YTM4YjQwMWE0ODgzODgyZDhjYTdhNGJmOWMyYjAzNzI4MzEyMWVkYWRlZGUwODk0MzAyMTRmZThmZGYzNGJlYg',1621429510,NULL,'2021-04-04 13:05:10','2021-04-04 13:05:10'),(22,1,3,'N2FlM2QzNzRiYmIyNDRiODYyOTAzMmM0NTFmZTAyMDQ4YWNiMDdjNTVjYTc4OTgxM2MzODAwOTdmNjYxNjQxMg',1621429612,NULL,'2021-04-04 13:06:52','2021-04-04 13:06:52'),(23,1,3,'YzY4NzQ2NTI4ZDk4ZjYyMTI3NTg5N2U2NjViOGMwZjQ0MDk3YWIwZDY2ZDgyODMxZjYxMWY5NzA5NjkyYzU5OA',1621431827,NULL,'2021-04-04 13:43:47','2021-04-04 13:43:47'),(24,1,3,'NThkYTBjYzkxZTFhZDMzZDkwMjg1ZTNiOTFhY2Y3YmIyYTVmM2RkYWIxMzI3NmZmNDJmMTRmN2I4OWFiNWVjMQ',1621432001,NULL,'2021-04-04 13:46:41','2021-04-04 13:46:41'),(25,1,3,'MTZmZDRjNDFhYWY1NjY2YmY3YjE5MzliMWM0NDI3ODUwMThiMzA1NzIxMDYwOGJmYmRkZmIxN2RiOWI2ZTcyYQ',1621432037,NULL,'2021-04-04 13:47:17','2021-04-04 13:47:17'),(26,1,3,'ODhkMTk2OTZlOTA3MDBlNGNjNTQ4YzIzMGZiNGUzZmVhZmZmZjEzMzUyZGUwYzcyMWRjMjYyN2YyY2QwYzkwNg',1621434473,NULL,'2021-04-04 14:27:53','2021-04-04 14:27:53'),(27,1,7,'YTQ3ODAxNWQxN2MzYzg2ZTljY2QwNTM3ZDM0YTViMDNhMWMzNTdiMTYyZjU1ZDg1ZTYxNjM0NDhhY2YzZGE4ZA',1621437866,NULL,'2021-04-04 15:24:26','2021-04-04 15:24:26'),(28,1,7,'Y2Q3ODc2ZmY4OGJiMTgwYmI3M2IyYzcyNzVlN2IwMGZmMmUxMmIzN2FlMWVkM2NlY2Q5ZDRmYzgyMmEyNGYzOQ',1621483612,NULL,'2021-04-05 04:06:52','2021-04-05 04:06:52'),(29,1,7,'ZDNiZjkyZTQ5OWUzZmQ2OWRlNGE4ZGU5YjAyMTViMDY4ODBhNzAzYjVkMDczYzYyNjMzMWUzODYzMjNiZDk4MA',1621502899,NULL,'2021-04-05 09:28:19','2021-04-05 09:28:19'),(30,1,7,'ZWFjNGExMmIxYjA0ZGFhNzBhM2FmYWNkODFhMzE5NGFjYTdjMGJmMDVjZjJjZmRjMzk0ZmI4M2VmY2U0NWI5NA',1621504476,NULL,'2021-04-05 09:54:36','2021-04-05 09:54:36'),(31,1,7,'N2E2MjdhYjJjZjM5OTk3MjZkYzIzMzY4MDQ3ZGE2NzdmNGRhMjI2NDQwNmQ2ZDg0YTA5Y2RjNjczMjFiOGQ1MA',1621505135,NULL,'2021-04-05 10:05:35','2021-04-05 10:05:35'),(32,1,7,'ODhhYTY0MzQ4YjM1ZWZjOWYyOTYxMmJjNzQ0YzhlM2RlNGJhZjViMjFhM2ZhZTBhMWNkZWI4M2RkNzhkMTM4Mg',1621509251,NULL,'2021-04-05 11:14:11','2021-04-05 11:14:11'),(33,1,7,'NGMxMDg0ODQ1NzMzNDY2NDA4NDA1NjQxZjc2MGU3ZWFlNTRmMDk4NGIwNThlNGZlOTA0N2YxMzI1NmI3ZjIwMg',1621509808,NULL,'2021-04-05 11:23:28','2021-04-05 11:23:28'),(34,1,8,'NTgyMzg3OTZmODk2ZTQ4ODdiZjM5OGNlYjQ4ZWRlZjk0YTUyOTY2MTJkMDUwNjQ3NjFmYTQxZDcyMDNhMjljNw',1621511656,NULL,'2021-04-05 11:54:16','2021-04-05 11:54:16'),(35,1,9,'YjliMDE2NjhiMzBjNjljZWJmY2E1YTg5MjEyMGU0OTlhZjI1ZWNjMzEwYWY4YzNkMDViY2Y1N2YxMzBmZTNhZQ',1621511731,NULL,'2021-04-05 11:55:31','2021-04-05 11:55:31'),(36,1,9,'MzQzYzA1ZDE2ZDNmZjhmMzRlZDgxODAwMDZkZGY3MTI5YzRjYTg0YjBjODJjOGU3M2YxM2UyZGIxYWUxNmVjNw',1621512598,NULL,'2021-04-05 12:09:58','2021-04-05 12:09:58'),(37,1,10,'NDE1ODE1ODU4ZDg2MzI1MTg1MDkzZjNhMzk5YzFkMzQzNTVlYzJlOTNmNGU5ZTViN2E1MzgyZmZlNjA1ODhmZA',1621513121,NULL,'2021-04-05 12:18:41','2021-04-05 12:18:41'),(38,1,8,'YTg3ZmQxMzJmODJiNjlhMDY1OTE2NzA5MWYwMjVlNTIyYTcxYWNiOWM0YzRiYzI3OGJmMzQyMDQ4YWRiZTMyZA',1621513377,NULL,'2021-04-05 12:22:57','2021-04-05 12:22:57'),(39,1,8,'MTYwNDNkN2ZiZjc3NTdkOGUyYTNhYjVmNjI3ZjE0N2IzNmNjZmUwZTNiNzFjNjZkYWM1MDExN2NhNjUyYTFmOA',1621663072,NULL,'2021-04-07 05:57:52','2021-04-07 05:57:52'),(40,1,8,'MmZlMGVjYmVhN2EwZDQyNjgyYTQwYWZlNGIzZGYzYTRjN2U3YTY0YjllNDVjNDQyNzQ4NjFkZmMyMzA2ZjgxYw',1621682607,NULL,'2021-04-07 11:23:27','2021-04-07 11:23:27'),(41,1,8,'NWNkNmY5YmVjNDhlMGU5MGJjNDI5NThiMmMxNjJmNTgyYjNiNzBkZDYzYzNjNmI4NTlmMzUyY2M1ZGJjZDk0ZA',1621699117,NULL,'2021-04-07 15:58:37','2021-04-07 15:58:37'),(42,1,8,'ODE5MjhiMDU0NzE4NjRjYTFjMDUwZGViMDZkOTYzMGYxMDhkM2ZkOTc4NzRmNGM4ODhlZWE3MTg2ZjFiNWI4YQ',1621699681,NULL,'2021-04-07 16:08:01','2021-04-07 16:08:01'),(43,1,8,'NTk2ZDMwNTIwY2I0OTk5MWNhMzgyNmMzZGM2YmE3NDg5MGE4NTc0ZmIwZGEwNTNmOTMzZWYzNTYzMjdhMzUyNA',1621700716,NULL,'2021-04-07 16:25:16','2021-04-07 16:25:16'),(44,1,8,'ZGVmMzY2YjM3ZTM1MTZlYzg1MDU0YTNmNTI0OGIzNDUzNTMyZDVmMGNjODNhNWQzNTk4ZThkMjRmZTk3MzY0NA',1621785759,NULL,'2021-04-08 16:02:39','2021-04-08 16:02:39'),(45,1,8,'NDFhMzNlYjUzOTNjODg3NWM1N2EzODBiODdlZjZiODUxZjJkMGRhMGU4YzEzOGNhOWE1NGU5M2VmZmJkYWY3ZQ',1621824956,NULL,'2021-04-09 02:55:56','2021-04-09 02:55:56'),(46,1,8,'ZDA2OTgzYWYwMjAwNzFmMjlkYjIxMjQ0ODg4OTQxNTJiMDE3MmUyNjlhMWY2MzM0MWU3MTMzMGE3NmU0NjhkYQ',1621839580,NULL,'2021-04-09 06:59:40','2021-04-09 06:59:40'),(47,1,8,'ZjU1YjdkODU4NGI5MTFkNjIzY2Y2NDk2ZWNlOWU4NmI1NDc0ZjA5ZTFhOGRhOGRkZThiNDMyYjYxZjM5ZTUxNQ',1621842601,NULL,'2021-04-09 07:50:01','2021-04-09 07:50:01'),(48,1,8,'MzY5YTYyNTMwZmM0M2FhYzM3ODcyYzMyYjAzNzFmYmJhZDA0YzI1ZDcwMDQ0YmMyYWY3MmM5MDE2MjI2MTlmZQ',1621842764,NULL,'2021-04-09 07:52:44','2021-04-09 07:52:44'),(49,1,1,'MmRjYjdjMjlmMTJjNmZjZmVjYzk5M2VjYjcxMjE2YmE3MDdkNWE2ZTIwZjQxMjQ0YTA3NWJkMGE0YzQxNTcxNg',1622003202,NULL,'2021-04-11 04:26:42','2021-04-11 04:26:42'),(50,1,8,'MjIxY2U3NGEzZWI2NWJiOWJlOWRkODVjNTkyZDRiNzAxZDYyNDZjZjJkNjNkZGMxNDE3ZDBlOTQzNjZmOTc1Yg',1622008795,NULL,'2021-04-11 05:59:55','2021-04-11 05:59:55'),(51,1,8,'MjExMjczOGQyZDRmYTlmZjJiNDQzOTY1ZTdmYTY2ZmM2YmI2ODE2MzhhZjYzZTBlMWI4MmU3ZGM0ODVjM2UwZA',1622114448,NULL,'2021-04-12 11:20:48','2021-04-12 11:20:48'),(52,1,8,'MWYzYzc0ZDhhMmIxZTA1ZTc5MjJmODg2ODI1YTIzMzFhYzdiN2JjN2M2MDlkNGYyMzZlNzQyY2QwYmY3NTY4MA',1622118933,NULL,'2021-04-12 12:35:33','2021-04-12 12:35:33');
/*!40000 ALTER TABLE `tbl_oauth2_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_payment_activity`
--

DROP TABLE IF EXISTS `tbl_payment_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_payment_activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `payment_info_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `log` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_E66CC94044C2CF12` (`payment_info_id`),
  CONSTRAINT `FK_E66CC94044C2CF12` FOREIGN KEY (`payment_info_id`) REFERENCES `tbl_payment_info` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_payment_activity`
--

LOCK TABLES `tbl_payment_activity` WRITE;
/*!40000 ALTER TABLE `tbl_payment_activity` DISABLE KEYS */;
INSERT INTO `tbl_payment_activity` VALUES (1,1,'2021-04-04 04:52:38','2021-04-04 04:52:38','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 12,\n    \"exp_year\": 2021,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}'),(2,2,'2021-04-04 04:55:12','2021-04-04 04:55:12','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 12,\n    \"exp_year\": 2021,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}'),(3,3,'2021-04-04 04:55:33','2021-04-04 04:55:33','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 12,\n    \"exp_year\": 2021,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}'),(4,4,'2021-04-04 10:22:39','2021-04-04 10:22:39','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 12,\n    \"exp_year\": 2021,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}'),(5,5,'2021-04-04 10:27:48','2021-04-04 10:27:48','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 12,\n    \"exp_year\": 2021,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}'),(6,6,'2021-04-04 10:30:15','2021-04-04 10:30:15','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 12,\n    \"exp_year\": 2021,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}'),(7,7,'2021-04-04 10:34:43','2021-04-04 10:34:43','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 12,\n    \"exp_year\": 2021,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}'),(8,8,'2021-04-04 10:39:37','2021-04-04 10:39:37','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 12,\n    \"exp_year\": 2021,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}'),(9,9,'2021-04-04 15:25:26','2021-04-04 15:25:26','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 12,\n    \"exp_year\": 2021,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}'),(10,10,'2021-04-05 10:09:56','2021-04-05 10:09:56','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 12,\n    \"exp_year\": 2021,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}'),(11,11,'2021-04-05 11:56:30','2021-04-05 11:56:30','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 2,\n    \"exp_year\": 2023,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}'),(12,12,'2021-04-05 12:19:48','2021-04-05 12:19:48','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 2,\n    \"exp_year\": 2022,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}'),(13,13,'2021-04-05 12:23:30','2021-04-05 12:23:30','{\n    \"brand\": \"visa\",\n    \"checks\": {\n        \"address_line1_check\": null,\n        \"address_postal_code_check\": null,\n        \"cvc_check\": \"pass\"\n    },\n    \"country\": \"US\",\n    \"exp_month\": 2,\n    \"exp_year\": 2025,\n    \"fingerprint\": \"UARdHsHb4oIWWTNm\",\n    \"funding\": \"credit\",\n    \"generated_from\": null,\n    \"last4\": \"1111\",\n    \"networks\": {\n        \"available\": [\n            \"visa\"\n        ],\n        \"preferred\": null\n    },\n    \"three_d_secure_usage\": {\n        \"supported\": true\n    },\n    \"wallet\": null\n}');
/*!40000 ALTER TABLE `tbl_payment_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_payment_info`
--

DROP TABLE IF EXISTS `tbl_payment_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_payment_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `customer_ref` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method_ref` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_gateway` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_info` longtext COLLATE utf8_unicode_ci,
  `status` smallint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1459DCB5A76ED395` (`user_id`),
  CONSTRAINT `FK_1459DCB5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_payment_info`
--

LOCK TABLES `tbl_payment_info` WRITE;
/*!40000 ALTER TABLE `tbl_payment_info` DISABLE KEYS */;
INSERT INTO `tbl_payment_info` VALUES (1,3,'2021-04-04 04:52:36','2021-04-04 04:52:38','cus_JErgF5ebywDQQJ','pm_1IcNwvCIT3hnKWce2CI0zQ78','stripe','Array',2),(2,3,'2021-04-04 04:55:11','2021-04-04 04:55:12','cus_JErgF5ebywDQQJ','pm_1IcNzPCIT3hnKWcedZc3PD1A','stripe','Array',2),(3,3,'2021-04-04 04:55:32','2021-04-04 04:55:33','cus_JErgF5ebywDQQJ','pm_1IcNzkCIT3hnKWceGdkFU37n','stripe','Array',2),(4,3,'2021-04-04 10:22:37','2021-04-04 10:22:39','cus_JErgF5ebywDQQJ','pm_1IcT6ICIT3hnKWceLDnFXS44','stripe','Array',2),(5,3,'2021-04-04 10:27:46','2021-04-04 10:27:48','cus_JErgF5ebywDQQJ','pm_1IcTBGCIT3hnKWceUv8Wh6tp','stripe','Array',2),(6,3,'2021-04-04 10:30:13','2021-04-04 10:30:15','cus_JErgF5ebywDQQJ','pm_1IcTDeCIT3hnKWcexR7O5CrK','stripe','Array',2),(7,3,'2021-04-04 10:34:42','2021-04-04 10:34:43','cus_JErgF5ebywDQQJ','pm_1IcTHyCIT3hnKWce3oVPktOX','stripe','Array',2),(8,3,'2021-04-04 10:39:36','2021-04-04 10:39:37','cus_JErgF5ebywDQQJ','pm_1IcTMiCIT3hnKWceMGxqglH8','stripe','Array',2),(9,7,'2021-04-04 15:25:24','2021-04-04 15:25:26','cus_JF1tzXrSaKQHv6','pm_1IcXpJCIT3hnKWceNclHNVad','stripe','Array',2),(10,7,'2021-04-05 10:09:55','2021-04-05 10:09:56','cus_JF1tzXrSaKQHv6','pm_1IcpNXCIT3hnKWce5BhrJGwm','stripe','Array',2),(11,9,'2021-04-05 11:56:28','2021-04-05 11:56:30','cus_JFLkDjY37GU3yf','pm_1Icr2fCIT3hnKWceMb7aDCqu','stripe','Array',2),(12,10,'2021-04-05 12:19:46','2021-04-05 12:19:48','cus_JFM7RJLODYz6q2','pm_1IcrPDCIT3hnKWcezLGUeCeD','stripe','Array',2),(13,8,'2021-04-05 12:23:29','2021-04-05 12:23:30','cus_JFMBmlI5UhyROO','pm_1IcrSnCIT3hnKWced3cUARD4','stripe','Array',2);
/*!40000 ALTER TABLE `tbl_payment_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_property`
--

DROP TABLE IF EXISTS `tbl_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_property` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `code` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `is_open` int DEFAULT NULL,
  `address` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `rate_per_hour` double DEFAULT NULL,
  `currency_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `how_to_get_there` longtext COLLATE utf8_unicode_ci,
  `wifi_info` longtext COLLATE utf8_unicode_ci,
  `parking_addresses` longtext COLLATE utf8_unicode_ci,
  `type` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` longtext COLLATE utf8_unicode_ci,
  `contact_email` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schedule` longtext COLLATE utf8_unicode_ci,
  `country_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avg_rating` double DEFAULT NULL,
  `total_rating` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DCC1FAF377153098` (`code`),
  KEY `IDX_DCC1FAF3979B1AD6` (`company_id`),
  CONSTRAINT `FK_DCC1FAF3979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `tbl_property_company` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_property`
--

LOCK TABLES `tbl_property` WRITE;
/*!40000 ALTER TABLE `tbl_property` DISABLE KEYS */;
INSERT INTO `tbl_property` VALUES (1,1,'2021-04-03 09:36:59','2021-04-11 08:31:20','123456','The centerpoint 1',1,NULL,'Tannery Lane, Teston Landscape & Contractor, Singapore',1.32736660,103.87829270,10,'SGD','65','Singapore','Thuan Vo','0908267307','{\"howToGetThere1\":\"Go to the bus\",\"howToGetThere2\":\"Go to the bus\",\"howToGetThere3\":\"Go to the bus\"}','{\"wifiName\":\"Nothing\",\"wifiPass\":\"Test\"}','{\"parkingAddresses1\":\"Duong So 3, Larvita Garden Apartment\",\"parkingAddresses2\":\"Duong So 3, Larvita Garden Apartmen\",\"parkingAddresses3\":\"Duong So 3, Larvita Garden Apartmen\"}','1','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','mrbean@yopmail.com','{\"openHour\":{\"monday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\",\"24\":\"true\"},\"tuesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"close\":\"true\",\"24\":\"true\"},\"wednesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\"},\"thursday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\"},\"friday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\"},\"saturday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\",\"24\":\"true\"},\"sunday\":{\"openHour\":\"5:00 AM\",\"closeHour\":\"12:00 AM\",\"custom\":\"true\"}},\"community\":{\"monday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\"},\"tuesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\"},\"wednesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\"},\"thursday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\"},\"friday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\"},\"saturday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\"},\"sunday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\"}},\"aircon\":{\"monday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"close\":\"true\"},\"tuesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"custom\":\"true\",\"24\":\"true\"},\"wednesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"close\":\"true\",\"24\":\"true\"},\"thursday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"close\":\"true\",\"24\":\"true\"},\"friday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"close\":\"true\"},\"saturday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 AM\",\"close\":\"true\"},\"sunday\":{\"openHour\":\"5:00 AM\",\"closeHour\":\"12:00 AM\",\"custom\":\"true\",\"24\":\"true\"}}}',NULL,NULL,NULL),(2,1,'2021-04-03 10:29:45','2021-04-04 13:00:07','654321','Building 2',1,NULL,'Duong So 3, Larvita Garden Apartment',NULL,NULL,1000,'SGD','65','TP.HCM','Test','0908267307','{\"howToGetThere1\":\"Option 1\",\"howToGetThere2\":\"Go to the bus\",\"howToGetThere3\":\"Go to the bus\"}','{\"wifiName\":\"ddeee\",\"wifiPass\":\"eee\"}','{\"parkingAddresses1\":\"Hai Ba Trung\",\"parkingAddresses2\":\"testsd\",\"parkingAddresses3\":\"dddddd\"}','1','Test','mrbean@yopmail.com','{\"scheduleMonOpen\":\"\",\"scheduleMonClose\":\"\",\"scheduleTueOpen\":\"\",\"scheduleTueClose\":\"\",\"scheduleWedOpen\":\"\",\"scheduleWedClose\":\"\",\"scheduleThuOpen\":\"\",\"scheduleThuClose\":\"\",\"scheduleFriOpen\":\"\",\"scheduleFriClose\":\"\",\"scheduleSatOpen\":\"\",\"scheduleSatClose\":\"\",\"scheduleSunOpen\":\"\",\"scheduleSunClose\":\"\"}',NULL,NULL,NULL),(3,1,'2021-04-03 10:30:36','2021-04-04 13:55:48','555555','The center 3',1,NULL,'Hai Ba Trung',NULL,NULL,323242343,'SGD','65','TP.HCM','Thuan','0908267307','{\"howToGetThere1\":\"tetetetetete\",\"howToGetThere2\":\"tete\",\"howToGetThere3\":\"tete\"}','{\"wifiName\":\"tetetetet\",\"wifiPass\":\"tete\"}','{\"parkingAddresses1\":\"Hai Ba Trung\",\"parkingAddresses2\":\"tetet\",\"parkingAddresses3\":\"tete\"}','1','test33','mrbean@yopmail.com','{\"scheduleMonOpen\":\"\",\"scheduleMonClose\":\"\",\"scheduleTueOpen\":\"\",\"scheduleTueClose\":\"\",\"scheduleWedOpen\":\"\",\"scheduleWedClose\":\"\",\"scheduleThuOpen\":\"\",\"scheduleThuClose\":\"\",\"scheduleFriOpen\":\"\",\"scheduleFriClose\":\"\",\"scheduleSatOpen\":\"\",\"scheduleSatClose\":\"\",\"scheduleSunOpen\":\"\",\"scheduleSunClose\":\"\"}',NULL,NULL,NULL),(4,1,'2021-04-03 11:08:42','2021-04-04 14:48:24','999999','Property 3',1,1,'Duong So 3, Larvita Garden Apartment',NULL,NULL,333,'SGD','65','TP.HCM','tete','tete','{\"howToGetThere1\":\"\",\"howToGetThere2\":\"\",\"howToGetThere3\":\"\"}','{\"wifiName\":\"tetet\",\"wifiPass\":\"tetete\"}','{\"parkingAddresses1\":\"testetetete\",\"parkingAddresses2\":\"tetete\",\"parkingAddresses3\":\"etete\"}','1','etest','tete',NULL,NULL,NULL,NULL),(5,1,'2021-04-04 04:40:19','2021-04-04 13:20:57','888888','Thuan Vo',0,1,'Duong So 3, Larvita Garden Apartment',NULL,NULL,10,'SGD','65','TP.HCM','test','0908267307','{\"howToGetThere1\":\"tetetetetete\",\"howToGetThere2\":\"rererere\",\"howToGetThere3\":\"tetere\"}','{\"wifiName\":\"343434\",\"wifiPass\":\"434343\"}','{\"parkingAddresses1\":\"Duong So 3, Larvita Garden Apartment\",\"parkingAddresses2\":\"r3er3er3\",\"parkingAddresses3\":\"43434343\"}','1','test','mrbean@yopmail.com',NULL,NULL,NULL,NULL),(6,1,'2021-04-04 05:25:45','2021-04-04 13:21:06','777777','Prop 6',0,1,'12121',NULL,NULL,1000,'SGD','65','1212','1212','12','{\"howToGetThere1\":\"1212\",\"howToGetThere2\":\"1212\",\"howToGetThere3\":\"12\"}','{\"wifiName\":\"334343\",\"wifiPass\":\"4343\"}','{\"parkingAddresses1\":\"4343\",\"parkingAddresses2\":\"4343\",\"parkingAddresses3\":\"4343\"}','1','1212','1212',NULL,NULL,NULL,NULL),(7,1,'2021-04-04 08:03:03','2021-04-04 08:03:03','666666','Property 4',1,1,'Viettel Tower, Hẻm 285 Cách Mạng Tháng Tám, Phường 12 (Quận 10), District 10, Ho Chi Minh City, Vietnam',10.77809480,106.67988460,10,'SGD','65','Singapore','Thuan Vo','0908267307','{\"howToGetThere1\":\"N\\/A\",\"howToGetThere2\":\"N\\/A\",\"howToGetThere3\":\"N\\/A\"}','{\"wifiName\":\"N\\/A\",\"wifiPass\":\"N\\/A\"}','{\"parkingAddresses1\":\"Duong So 3, Larvita Garden Apartment\",\"parkingAddresses2\":\"N\\/A\",\"parkingAddresses3\":\"N\\/A\"}','1','Test','mrbean@yopmail.com',NULL,NULL,NULL,NULL),(8,1,'2021-04-04 08:41:09','2021-04-04 12:43:56','222222','Thuan Vo 1000',1,1,'DDA Hotel District 1, De Tham, St, Pham Ngu Lao, District 1, Ho Chi Minh City, Vietnam',10.76719470,106.69393920,1,'SGD','65','TP.HCM','Test','tete','{\"howToGetThere1\":\"yrdyr\",\"howToGetThere2\":\"tr\",\"howToGetThere3\":\"test\"}','{\"wifiName\":\"tetet\",\"wifiPass\":\"etete\"}','{\"parkingAddresses1\":\"tetet\",\"parkingAddresses2\":\"etetete\",\"parkingAddresses3\":\"\"}','1','Test','yrtrtrtr@gmail.com',NULL,NULL,NULL,NULL),(9,4,'2021-04-04 13:02:57','2021-04-05 11:27:20','XE9RX7','The Center Point 10003',1,1,'Jalan Tan Tock Seng, Tan Tock Seng Hospital, Singapore',1.32138890,103.84583330,10,'SGD','65','TP.HCM','Thuan Vo','0908267307','{\"howToGetThere1\":\"ee\",\"howToGetThere2\":\"ee\",\"howToGetThere3\":\"ee\"}','{\"wifiName\":\"eee\",\"wifiPass\":\"ee\"}','{\"parkingAddresses1\":\"Duong So 3, Larvita Garden Apartment\",\"parkingAddresses2\":\"eee\",\"parkingAddresses3\":\"\"}','1','Test','yrtrtrtr@gmail.com','{\"scheduleMonOpen\":\"\",\"scheduleMonClose\":\"\",\"scheduleTueOpen\":\"\",\"scheduleTueClose\":\"\",\"scheduleWedOpen\":\"\",\"scheduleWedClose\":\"\",\"scheduleThuOpen\":\"\",\"scheduleThuClose\":\"\",\"scheduleFriOpen\":\"\",\"scheduleFriClose\":\"\",\"scheduleSatOpen\":\"\",\"scheduleSatClose\":\"\",\"scheduleSunOpen\":\"\",\"scheduleSunClose\":\"\"}',NULL,NULL,NULL),(10,6,'2021-04-04 13:38:47','2021-04-05 11:27:40','VMNSR3','The Center property',1,1,'New Bridge Road, Chinatown Point, Singapore',1.28520930,103.84472280,12,'SGD','65','Singapore','Oscar','1231231212','{\"howToGetThere1\":\"\",\"howToGetThere2\":\"\",\"howToGetThere3\":\"\"}','{\"wifiName\":\"112312\",\"wifiPass\":\"123123\"}','{\"parkingAddresses1\":\"\",\"parkingAddresses2\":\"\",\"parkingAddresses3\":\"\"}','1','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','oscar@deskimo.com','{\"scheduleMonOpen\":\"\",\"scheduleMonClose\":\"\",\"scheduleTueOpen\":\"\",\"scheduleTueClose\":\"\",\"scheduleWedOpen\":\"\",\"scheduleWedClose\":\"\",\"scheduleThuOpen\":\"\",\"scheduleThuClose\":\"\",\"scheduleFriOpen\":\"\",\"scheduleFriClose\":\"\",\"scheduleSatOpen\":\"\",\"scheduleSatClose\":\"\",\"scheduleSunOpen\":\"\",\"scheduleSunClose\":\"\"}',NULL,NULL,NULL),(11,7,'2021-04-04 13:40:00','2021-04-05 11:22:54','BYN4QY','The centerpoint 100',1,1,'Kallang Avenue, Aperia Mall, Singapore',1.31005910,103.86437560,12,'SGD','65','Singapore','asd','asdasdasda','{\"howToGetThere1\":\"asd\",\"howToGetThere2\":\"asd\",\"howToGetThere3\":\"\"}','{\"wifiName\":\"asda\",\"wifiPass\":\"asdad\"}','{\"parkingAddresses1\":\"\",\"parkingAddresses2\":\"\",\"parkingAddresses3\":\"\"}','1','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','asdas','{\"scheduleMonOpen\":\"\",\"scheduleMonClose\":\"\",\"scheduleTueOpen\":\"\",\"scheduleTueClose\":\"\",\"scheduleWedOpen\":\"\",\"scheduleWedClose\":\"\",\"scheduleThuOpen\":\"\",\"scheduleThuClose\":\"\",\"scheduleFriOpen\":\"\",\"scheduleFriClose\":\"\",\"scheduleSatOpen\":\"\",\"scheduleSatClose\":\"\",\"scheduleSunOpen\":\"\",\"scheduleSunClose\":\"\"}',NULL,NULL,NULL),(12,8,'2021-04-04 13:40:27','2021-04-05 11:26:23','ZDOX3C','The Center 10004',1,1,'Tiong Bahru Road, Tiong Bahru Plaza, Singapore',1.28631290,103.82714020,1000,'SGD','65','Singapore','Thuan Vo','0908267307','{\"howToGetThere1\":\"\",\"howToGetThere2\":\"\",\"howToGetThere3\":\"\"}','{\"wifiName\":\"asd\",\"wifiPass\":\"asdas\"}','{\"parkingAddresses1\":\"\",\"parkingAddresses2\":\"\",\"parkingAddresses3\":\"\"}','1','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','vanthuankhtn@gmail.com','{\"scheduleMonOpen\":\"\",\"scheduleMonClose\":\"\",\"scheduleTueOpen\":\"\",\"scheduleTueClose\":\"\",\"scheduleWedOpen\":\"\",\"scheduleWedClose\":\"\",\"scheduleThuOpen\":\"\",\"scheduleThuClose\":\"\",\"scheduleFriOpen\":\"\",\"scheduleFriClose\":\"\",\"scheduleSatOpen\":\"\",\"scheduleSatClose\":\"\",\"scheduleSunOpen\":\"\",\"scheduleSunClose\":\"\"}',NULL,NULL,NULL),(13,9,'2021-04-04 13:42:45','2021-04-05 11:24:36','FJWHWV','The center 10001',1,1,'asdasd',NULL,NULL,12000,'SGD','65','asdasd','asdas','0930232323','{\"howToGetThere1\":\"asdad\",\"howToGetThere2\":\"asdasd\",\"howToGetThere3\":\"asdasd\"}','{\"wifiName\":\"asdasd\",\"wifiPass\":\"asdasd\"}','{\"parkingAddresses1\":\"\",\"parkingAddresses2\":\"\",\"parkingAddresses3\":\"\"}','1','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','test@gmail.com','{\"scheduleMonOpen\":\"\",\"scheduleMonClose\":\"\",\"scheduleTueOpen\":\"\",\"scheduleTueClose\":\"\",\"scheduleWedOpen\":\"\",\"scheduleWedClose\":\"\",\"scheduleThuOpen\":\"\",\"scheduleThuClose\":\"\",\"scheduleFriOpen\":\"\",\"scheduleFriClose\":\"\",\"scheduleSatOpen\":\"\",\"scheduleSatClose\":\"\",\"scheduleSunOpen\":\"\",\"scheduleSunClose\":\"\"}',NULL,NULL,NULL),(14,10,'2021-04-04 13:44:58','2021-04-05 11:24:09','Y5ZHF0','The center 10004',1,1,'123123',NULL,NULL,120000,'SGD','65','12123','123','12312','{\"howToGetThere1\":\"123\",\"howToGetThere2\":\"123\",\"howToGetThere3\":\"123\"}','{\"wifiName\":\"123\",\"wifiPass\":\"123\"}','{\"parkingAddresses1\":\"\",\"parkingAddresses2\":\"\",\"parkingAddresses3\":\"\"}','1',NULL,'123','{\"scheduleMonOpen\":\"\",\"scheduleMonClose\":\"\",\"scheduleTueOpen\":\"\",\"scheduleTueClose\":\"\",\"scheduleWedOpen\":\"\",\"scheduleWedClose\":\"\",\"scheduleThuOpen\":\"\",\"scheduleThuClose\":\"\",\"scheduleFriOpen\":\"\",\"scheduleFriClose\":\"\",\"scheduleSatOpen\":\"\",\"scheduleSatClose\":\"\",\"scheduleSunOpen\":\"\",\"scheduleSunClose\":\"\"}',NULL,NULL,NULL),(15,11,'2021-04-04 14:04:49','2021-04-05 11:23:49','JAYMJG','The Center 200',1,1,'Alexandra Road, Alexandra Hospital, Singapore',1.28658820,103.80127490,1200,'SGD','65','Singapore','asdasd','asdasd','{\"howToGetThere1\":\"\",\"howToGetThere2\":\"\",\"howToGetThere3\":\"\"}','{\"wifiName\":\"asdasd\",\"wifiPass\":\"asdasd\"}','{\"parkingAddresses1\":\"\",\"parkingAddresses2\":\"\",\"parkingAddresses3\":\"\"}','1','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','asdasd','{\"scheduleMonOpen\":\"\",\"scheduleMonClose\":\"\",\"scheduleTueOpen\":\"\",\"scheduleTueClose\":\"\",\"scheduleWedOpen\":\"\",\"scheduleWedClose\":\"\",\"scheduleThuOpen\":\"\",\"scheduleThuClose\":\"\",\"scheduleFriOpen\":\"\",\"scheduleFriClose\":\"\",\"scheduleSatOpen\":\"\",\"scheduleSatClose\":\"\",\"scheduleSunOpen\":\"\",\"scheduleSunClose\":\"\"}',NULL,NULL,NULL),(16,4,'2021-04-04 14:16:28','2021-04-05 11:24:52','ZKWAOG','The Center 10005',1,1,'Clementi Avenue 3, 321 Clementi, Singapore',1.31199800,103.76501400,100000,'SGD','65','TP.HCM','fdfdfdfd','fdfd','{\"howToGetThere1\":\"fdfd\",\"howToGetThere2\":\"fdfd\",\"howToGetThere3\":\"fdfd\"}','{\"wifiName\":\"fdfd\",\"wifiPass\":\"fdfd\"}','{\"parkingAddresses1\":\"fdfd\",\"parkingAddresses2\":\"fdfd\",\"parkingAddresses3\":\"\"}','1','3333','fdfd','{\"scheduleMonOpen\":\"\",\"scheduleMonClose\":\"\",\"scheduleTueOpen\":\"\",\"scheduleTueClose\":\"\",\"scheduleWedOpen\":\"\",\"scheduleWedClose\":\"\",\"scheduleThuOpen\":\"\",\"scheduleThuClose\":\"\",\"scheduleFriOpen\":\"\",\"scheduleFriClose\":\"\",\"scheduleSatOpen\":\"\",\"scheduleSatClose\":\"\",\"scheduleSunOpen\":\"\",\"scheduleSunClose\":\"\"}',NULL,NULL,NULL),(17,3,'2021-04-04 14:25:22','2021-04-09 12:01:25','EOTPEC','The center 1000',1,1,'Geylang Road, 123 ZÔ Vietnamese BBQ Skewers and Hotpot, Singapore',1.31492320,103.89069780,1200,'SGD','65','Singapore','123','123','{\"howToGetThere1\":\"123\",\"howToGetThere2\":\"123\",\"howToGetThere3\":\"123\"}','{\"wifiName\":\"123\",\"wifiPass\":\"123\"}','{\"parkingAddresses1\":\"\",\"parkingAddresses2\":\"\",\"parkingAddresses3\":\"\"}','1','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','123','{\"scheduleMonOpen\":\"\",\"scheduleMonClose\":\"\",\"scheduleTueOpen\":\"\",\"scheduleTueClose\":\"\",\"scheduleWedOpen\":\"\",\"scheduleWedClose\":\"\",\"scheduleThuOpen\":\"\",\"scheduleThuClose\":\"\",\"scheduleFriOpen\":\"\",\"scheduleFriClose\":\"\",\"scheduleSatOpen\":\"\",\"scheduleSatClose\":\"\",\"scheduleSunOpen\":\"\",\"scheduleSunClose\":\"\"}',NULL,NULL,NULL),(18,1,'2021-04-05 11:45:01','2021-04-05 11:57:58','8RVZEO','Hive',1,1,'Geylang Serai, Geylang Serai Malay Market and Food Centre, Singapore',1.31672840,103.89827670,4000,'SGD','65','Singapore','Oscar lopez alegre','555999999','{\"howToGetThere1\":\"Parking 1\",\"howToGetThere2\":\"Subway 1\",\"howToGetThere3\":\"Others 1\"}','{\"wifiName\":\"Wifi\",\"wifiPass\":\"password\"}','{\"parkingAddresses1\":\"\",\"parkingAddresses2\":\"\",\"parkingAddresses3\":\"\"}','1','The Hive is a co-working space for creative freelancers and entrepreneurs in the heart of Hong Kong. Based in Wan Chai, the Hive has over 6000 sq ft of open plan co working space, as well as a 1200 sq ft decked terrace which is directly alongside the 21st Floor. This terrace provides the social hub for all our members. \r\n\r\nThe space has been designed to be a comfortable and inspiring place to work with excellent natural light and the use of wood throughout. The Hive runs events for learning and to encourage networking and new business connections. \r\n\r\nWe collaborate closely with StartUpsHK and other accelerator and incubator groups in Hong Kong. \r\n\r\nMemberships start from HK$2800/month and give all the business facilities you would want - meeting rooms, fast broadband, printers, free coffee and tea. The Hive is a friendly place that aims to be the best place to work from in Hong Kong.','oscar@deskimo.com',NULL,NULL,NULL,NULL),(19,1,'2021-04-05 12:29:14','2021-04-05 12:44:56','NVSSN4','Hive 2',1,1,'301 Boon Keng Rd, Singapore 339779',1.31575134,103.86479141,2300,'SGD','65','Singapore','Oscar','123456789','{\"howToGetThere1\":\"parking\",\"howToGetThere2\":\"subway\",\"howToGetThere3\":\"bus\"}','{\"wifiName\":\"wifi\",\"wifiPass\":\"password\"}','{\"parkingAddresses1\":\"\",\"parkingAddresses2\":\"\",\"parkingAddresses3\":\"\"}','1','The Hive is a co-working space for creative freelancers and entrepreneurs in the heart of Hong Kong. Based in Wan Chai, the Hive has over 6000 sq ft of open plan co working space, as well as a 1200 sq ft decked terrace which is directly alongside the 21st Floor. This terrace provides the social hub for all our members. \r\n\r\nThe space has been designed to be a comfortable and inspiring place to work with excellent natural light and the use of wood throughout. The Hive runs events for learning and to encourage networking and new business connections. \r\n\r\nWe collaborate closely with StartUpsHK and other accelerator and incubator groups in Hong Kong. \r\n\r\nMemberships start from HK$2800/month and give all the business facilities you would want - meeting rooms, fast broadband, printers, free coffee and tea. The Hive is a friendly place that aims to be the best place to work from in Hong Kong.','oscar@deskimo.com','{\"openHour\":{\"monday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"tuesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"wednesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"thursday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"friday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"saturday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"sunday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"cLoseOnHolidays\":\"true\"},\"community\":{\"monday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"close\":\"true\"},\"tuesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"wednesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"thursday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"friday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"saturday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"sunday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"}},\"aircon\":{\"monday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"tuesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"wednesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"thursday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"friday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"saturday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"sunday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"}}}',NULL,NULL,NULL),(20,1,'2021-04-08 14:30:15','2021-04-09 11:23:17','BBTXFJ','test',1,1,NULL,NULL,NULL,2,'SGD','65','a','a','a','{\"howToGetThere1\":\"\",\"howToGetThere2\":\"\",\"howToGetThere3\":\"\"}','{\"wifiName\":\"a\",\"wifiPass\":\"a\"}','{\"parkingAddresses1\":\"\",\"parkingAddresses2\":\"\",\"parkingAddresses3\":\"\"}','1',NULL,'a','{\"openHour\":{\"monday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"24\":\"true\"},\"tuesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"wednesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"thursday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"friday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"saturday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"sunday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"}},\"community\":{\"monday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"tuesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"wednesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"thursday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"friday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"saturday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"sunday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"}},\"aircon\":{\"monday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"tuesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"wednesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"thursday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"friday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"saturday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"sunday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"}}}',NULL,NULL,NULL),(21,1,'2021-04-09 13:26:17','2021-04-09 13:26:17','GY5Q9B','hrgjgs',1,1,NULL,NULL,NULL,23,'SGD','65','nha','ABC','00000000000000000000','{\"howToGetThere1\":\"\",\"howToGetThere2\":\"\",\"howToGetThere3\":\"\"}','{\"wifiName\":\"r\\u1eb9wegfwe\",\"wifiPass\":\"\\u1eb9gjrgkrgh\"}','{\"parkingAddresses1\":\"\",\"parkingAddresses2\":\"\",\"parkingAddresses3\":\"\"}','1','https://www.google.com/search?q=translate&oq=tr&aqs=chrome.0.69i59j69i57j0i131i433j46j0l2j69i61l2.1600j0j7&sourceid=chrome&ie=UTF-8','abc#gmail/com',NULL,NULL,NULL,NULL),(22,5,'2021-04-11 03:31:20','2021-04-11 05:53:16','HKAU9LZW','Test Property',1,1,NULL,NULL,NULL,12,'SGD','65','<script>alert(123)</script>','<script>alert(123)</script>','<script>alert(123)</script>','{\"howToGetThere1\":\"<script>alert(123)<\\/script>\",\"howToGetThere2\":\"<script>alert(123)<\\/script>\",\"howToGetThere3\":\"<script>alert(123)<\\/script>\"}','{\"wifiName\":\"<script>alert(123)<\\/script>\",\"wifiPass\":\"<script>alert(123)<\\/script>\"}','{\"parkingAddresses1\":\"<script>alert(123)<\\/script>\",\"parkingAddresses2\":\"<script>alert(123)<\\/script>\",\"parkingAddresses3\":\"\"}','1','In this comprehensive article, we’ll talk about the basics of a coworking space, how to choose a good one (some things you should look for, some things you should avoid), what types of people can benefit from this sort of space, and we’ll go over any other common questions you might be thinking about','<script>alert(123)</script>','{\"openHour\":{\"monday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"11:00 PM\",\"custom\":\"true\"},\"tuesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"11:00 PM\",\"custom\":\"true\"},\"wednesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"11:00 PM\",\"custom\":\"true\"},\"thursday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"11:00 PM\",\"custom\":\"true\"},\"friday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"11:00 PM\",\"custom\":\"true\"},\"saturday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"},\"sunday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"10:00 PM\",\"custom\":\"true\"}},\"community\":{\"monday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"11:00 PM\",\"custom\":\"true\"},\"tuesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"11:00 PM\",\"custom\":\"true\"},\"wednesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"110:00 PM\",\"custom\":\"true\"},\"thursday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"11:00 PM\",\"custom\":\"true\"},\"friday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"11:00 PM\",\"custom\":\"true\"},\"saturday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"6:00 PM\",\"custom\":\"true\"},\"sunday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"6:00 PM\",\"custom\":\"true\"}},\"aircon\":{\"monday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"8:00 PM\",\"custom\":\"true\"},\"tuesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"8:00 PM\",\"custom\":\"true\"},\"wednesday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"8:00 PM\",\"custom\":\"true\"},\"thursday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"8:00 PM\",\"custom\":\"true\"},\"friday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"8:00 PM\",\"custom\":\"true\"},\"saturday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"8:00 PM\",\"custom\":\"true\"},\"sunday\":{\"openHour\":\"6:00 AM\",\"closeHour\":\"8:00 PM\",\"custom\":\"true\"}}}','Singapore',NULL,NULL),(23,1,'2021-04-11 09:30:40','2021-04-11 10:28:37','PS4EIQ6A','abc',1,1,NULL,NULL,NULL,12,'SGD','65','sđ','ff','ff','{\"howToGetThere1\":\"\",\"howToGetThere2\":\"\",\"howToGetThere3\":\"\"}','{\"wifiName\":\"ff\",\"wifiPass\":\"ff\"}','{\"parkingAddresses1\":\"\",\"parkingAddresses2\":\"\",\"parkingAddresses3\":\"\"}','1',NULL,'f',NULL,'Singapore',NULL,NULL);
/*!40000 ALTER TABLE `tbl_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_property_amenity`
--

DROP TABLE IF EXISTS `tbl_property_amenity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_property_amenity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `property_id` int DEFAULT NULL,
  `amenity_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_free` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F873B169549213EC` (`property_id`),
  KEY `IDX_F873B1699F9F1305` (`amenity_id`),
  CONSTRAINT `FK_F873B169549213EC` FOREIGN KEY (`property_id`) REFERENCES `tbl_property` (`id`),
  CONSTRAINT `FK_F873B1699F9F1305` FOREIGN KEY (`amenity_id`) REFERENCES `tbl_amenity` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_property_amenity`
--

LOCK TABLES `tbl_property_amenity` WRITE;
/*!40000 ALTER TABLE `tbl_property_amenity` DISABLE KEYS */;
INSERT INTO `tbl_property_amenity` VALUES (1,15,1,'2021-04-04 14:10:47','2021-04-04 14:10:47',1),(2,15,2,'2021-04-04 14:10:47','2021-04-04 14:10:47',0),(6,1,3,'2021-04-05 11:18:07','2021-04-05 11:18:07',1),(7,1,3,'2021-04-05 11:18:07','2021-04-05 11:18:07',0),(8,18,1,'2021-04-05 11:46:49','2021-04-05 11:46:49',1),(9,18,3,'2021-04-05 11:46:49','2021-04-05 11:46:49',1),(10,18,2,'2021-04-05 11:46:49','2021-04-05 11:46:49',0),(11,19,2,'2021-04-05 12:35:56','2021-04-05 12:35:56',1),(12,19,3,'2021-04-05 12:35:56','2021-04-05 12:35:56',1),(13,19,1,'2021-04-05 12:35:56','2021-04-05 12:35:56',0),(15,17,1,'2021-04-11 04:14:02','2021-04-11 04:14:02',0),(16,17,2,'2021-04-11 04:14:02','2021-04-11 04:14:02',0),(17,17,3,'2021-04-11 04:14:02','2021-04-11 04:14:02',0),(22,22,1,'2021-04-11 05:00:38','2021-04-11 05:00:38',1),(23,22,2,'2021-04-11 05:00:38','2021-04-11 05:00:38',1),(24,22,12,'2021-04-11 05:00:38','2021-04-11 05:00:38',1),(25,22,13,'2021-04-11 05:00:38','2021-04-11 05:00:38',1),(26,22,3,'2021-04-11 05:00:38','2021-04-11 05:00:38',0),(27,22,9,'2021-04-11 05:00:38','2021-04-11 05:00:38',0),(28,22,14,'2021-04-11 05:00:38','2021-04-11 05:00:38',0),(29,22,15,'2021-04-11 05:00:38','2021-04-11 05:00:38',0);
/*!40000 ALTER TABLE `tbl_property_amenity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_property_company`
--

DROP TABLE IF EXISTS `tbl_property_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_property_company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `share_revenue_percent` double DEFAULT NULL,
  `status` int DEFAULT NULL,
  `invoice_due_time` int DEFAULT NULL,
  `invoice_duration_time` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `processing_free` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_property_company`
--

LOCK TABLES `tbl_property_company` WRITE;
/*!40000 ALTER TABLE `tbl_property_company` DISABLE KEYS */;
INSERT INTO `tbl_property_company` VALUES (1,'2021-05-05 00:00:00','2021-04-11 06:19:25','Company 1','+84','Quach Minh T',10,1,NULL,NULL,NULL,NULL),(2,'2021-04-04 03:08:41','2021-04-08 13:40:52','Company 101','0908267307','Robin',9,1,NULL,NULL,NULL,NULL),(3,'2021-04-04 07:41:50','2021-04-04 07:41:50','Company 3','09383838383','Tony',0.5,1,NULL,NULL,NULL,NULL),(4,'2021-05-05 00:00:00','2021-04-04 13:02:57','Company 1','+84355527245','Quach Minh Tri',10,1,NULL,NULL,NULL,NULL),(5,'2021-04-04 13:22:08','2021-04-05 11:21:16','Company 1000','094434343','Thuan',12,1,NULL,NULL,NULL,NULL),(6,'2021-04-04 13:22:08','2021-04-05 11:20:59','Company 100','0939323232','Tony',12,1,NULL,NULL,NULL,NULL),(7,'2021-04-04 13:22:08','2021-04-11 07:13:10','Company 10','09744','Mr Bean',12,1,NULL,NULL,NULL,NULL),(8,'2021-04-04 13:22:08','2021-04-05 11:20:18','Company 8','0908267307','Thuan Vo',12,1,NULL,NULL,NULL,NULL),(9,'2021-04-04 13:22:08','2021-04-05 11:19:59','Company 6','asdasd','asda',12,1,NULL,NULL,NULL,NULL),(10,'2021-04-04 13:22:08','2021-04-05 11:19:45','Company 3','0908267307','Thuan Vo',12,1,NULL,NULL,NULL,NULL),(11,'2021-04-04 13:22:08','2021-04-05 11:19:33','Company 2','0908267307','Thuan Vo',12,1,NULL,NULL,NULL,NULL),(12,'2021-04-08 13:46:14','2021-04-08 13:46:14','Company T1','1','a1',100,1,NULL,NULL,NULL,NULL),(13,'2021-04-08 13:47:30','2021-04-08 13:47:30','Company T2','2','a2',100,1,NULL,NULL,NULL,NULL),(14,'2021-04-11 03:45:09','2021-04-11 03:45:09','<script>alert(12345)</script>','<script>alert(12345)</script>','<script>alert(12345)</script>',20,1,NULL,NULL,NULL,NULL),(15,'2021-04-11 03:45:57','2021-04-11 03:45:57','<script>alert(12345)</script>','<script>alert(12345)</script>','<script>alert(12345)</script>',20,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_property_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_property_company_user`
--

DROP TABLE IF EXISTS `tbl_property_company_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_property_company_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `company_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B8410151A76ED395` (`user_id`),
  KEY `IDX_B8410151979B1AD6` (`company_id`),
  CONSTRAINT `FK_B8410151979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `tbl_property_company` (`id`),
  CONSTRAINT `FK_B8410151A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_property_company_user`
--

LOCK TABLES `tbl_property_company_user` WRITE;
/*!40000 ALTER TABLE `tbl_property_company_user` DISABLE KEYS */;
INSERT INTO `tbl_property_company_user` VALUES (1,1,4,'2021-04-04 08:54:30','2021-04-04 08:54:31'),(2,1,11,'2021-04-05 13:00:38','2021-04-05 13:00:38');
/*!40000 ALTER TABLE `tbl_property_company_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_property_picture`
--

DROP TABLE IF EXISTS `tbl_property_picture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_property_picture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `property_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `file_key` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_45C88783549213EC` (`property_id`),
  CONSTRAINT `FK_45C88783549213EC` FOREIGN KEY (`property_id`) REFERENCES `tbl_property` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_property_picture`
--

LOCK TABLES `tbl_property_picture` WRITE;
/*!40000 ALTER TABLE `tbl_property_picture` DISABLE KEYS */;
INSERT INTO `tbl_property_picture` VALUES (7,4,'2021-04-04 03:36:13','2021-04-04 03:36:13','property/2021/04/04/6069342d96064.jpg',NULL),(8,4,'2021-04-04 03:36:29','2021-04-04 03:36:29','property/2021/04/04/6069343d6920b.jpg',NULL),(13,4,'2021-04-04 03:54:52','2021-04-04 03:54:52','property/2021/04/04/6069388ce6e21.jpg',NULL),(14,4,'2021-04-04 03:55:03','2021-04-04 03:55:03','property/2021/04/04/60693897b3426.jpg',NULL),(15,4,'2021-04-04 03:55:12','2021-04-04 03:55:12','property/2021/04/04/606938a01ec0f.jpg',NULL),(16,16,'2021-04-04 14:19:46','2021-04-04 14:19:46','property/2021/04/04/6069cb025bdeb.png',NULL),(17,16,'2021-04-04 14:19:53','2021-04-04 14:19:53','property/2021/04/04/6069cb0979c46.png',NULL),(18,16,'2021-04-04 14:19:59','2021-04-04 14:19:59','property/2021/04/04/6069cb0f0fc99.png',NULL),(20,16,'2021-04-04 14:20:45','2021-04-04 14:20:45','property/2021/04/04/6069cb3db4e86.png',NULL),(30,17,'2021-04-04 14:38:26','2021-04-04 14:38:26','property/2021/04/04/6069cf61f41d4.png',NULL),(31,17,'2021-04-04 14:38:35','2021-04-04 14:38:35','property/2021/04/04/6069cf6b8c0cf.png',NULL),(32,15,'2021-04-04 14:49:46','2021-04-04 14:49:46','property/2021/04/04/6069d20a8b014.jpg',NULL),(40,18,'2021-04-05 11:46:20','2021-04-05 11:46:20','property/2021/04/05/606af88ce8d67.jpeg',NULL),(41,18,'2021-04-05 11:46:21','2021-04-05 11:46:21','property/2021/04/05/606af88d05f05.jpeg',NULL),(42,18,'2021-04-05 11:46:21','2021-04-05 11:46:21','property/2021/04/05/606af88d1ddf5.jpeg',NULL),(43,19,'2021-04-05 12:31:16','2021-04-05 12:31:16','property/2021/04/05/606b03146a275.jpeg',NULL),(44,19,'2021-04-05 12:31:16','2021-04-05 12:31:16','property/2021/04/05/606b03147d017.jpeg',NULL),(45,19,'2021-04-05 12:31:16','2021-04-05 12:31:16','property/2021/04/05/606b0314a79f8.jpeg',NULL),(63,1,'2021-04-11 09:35:23','2021-04-11 09:35:23','property/2021/04/11/6072c2db24c7b.jpg',NULL),(64,23,'2021-04-11 11:13:50','2021-04-11 11:13:50','property/2021/04/11/6072d9ee12656.jpeg',NULL),(65,23,'2021-04-11 11:13:50','2021-04-11 11:13:50','property/2021/04/11/6072d9ee3a3e7.jpeg',NULL),(66,23,'2021-04-11 11:13:50','2021-04-11 11:13:50','property/2021/04/11/6072d9ee5a63f.jpeg',NULL),(67,1,'2021-04-12 12:55:15','2021-04-12 12:55:15','property/2021/04/12/60744333eaa1c.jpg',NULL),(73,1,'2021-04-12 13:55:24','2021-04-12 13:55:24','property/2021/04/12/6074514cbfb7f.jpg',NULL),(74,1,'2021-04-12 13:55:24','2021-04-12 13:55:24','property/2021/04/12/6074514cd7ecf.jpg',NULL),(75,1,'2021-04-12 13:55:25','2021-04-12 13:55:25','property/2021/04/12/6074514d58269.jpg',NULL);
/*!40000 ALTER TABLE `tbl_property_picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_property_staff`
--

DROP TABLE IF EXISTS `tbl_property_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_property_staff` (
  `id` int NOT NULL AUTO_INCREMENT,
  `property_id` int DEFAULT NULL,
  `staff_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_13B67972549213EC` (`property_id`),
  KEY `IDX_13B67972D4D57CD` (`staff_id`),
  CONSTRAINT `FK_13B67972549213EC` FOREIGN KEY (`property_id`) REFERENCES `tbl_property` (`id`),
  CONSTRAINT `FK_13B67972D4D57CD` FOREIGN KEY (`staff_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_property_staff`
--

LOCK TABLES `tbl_property_staff` WRITE;
/*!40000 ALTER TABLE `tbl_property_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_property_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_role_permission`
--

DROP TABLE IF EXISTS `tbl_role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_role_permission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_role_permission`
--

LOCK TABLES `tbl_role_permission` WRITE;
/*!40000 ALTER TABLE `tbl_role_permission` DISABLE KEYS */;
INSERT INTO `tbl_role_permission` VALUES (63,'2021-04-11 07:00:12','2021-04-11 07:00:12','list.user.admin',7),(64,'2021-04-11 07:00:12','2021-04-11 07:00:12','create.user.admin',7),(65,'2021-04-11 07:00:12','2021-04-11 07:00:12','edit.user.admin',7),(66,'2021-04-11 07:00:12','2021-04-11 07:00:12','manage.property.per',7),(67,'2021-04-11 07:00:12','2021-04-11 07:00:12','view.property.per',7),(68,'2021-04-11 07:00:12','2021-04-11 07:00:12','edit.property.per',7),(69,'2021-04-11 07:00:12','2021-04-11 07:00:12','add.property.per',7),(70,'2021-04-11 07:00:12','2021-04-11 07:00:12','manage.property.picture.per',7),(71,'2021-04-11 07:00:12','2021-04-11 07:00:12','manage.company.per',7),(72,'2021-04-11 07:00:12','2021-04-11 07:00:12','view.company.property.per',7),(73,'2021-04-11 07:00:12','2021-04-11 07:00:12','edit.company.property.per',7),(74,'2021-04-11 07:00:12','2021-04-11 07:00:12','add.company.property.per',7),(75,'2021-04-11 07:00:12','2021-04-11 07:00:12','delete.company.property.per',7);
/*!40000 ALTER TABLE `tbl_role_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_transaction`
--

DROP TABLE IF EXISTS `tbl_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_id` int DEFAULT NULL,
  `payment_info_id` int DEFAULT NULL,
  `visit_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `amount` double DEFAULT NULL,
  `currency` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_ref` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint DEFAULT NULL,
  `code` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F556E549427EB8A5` (`request_id`),
  KEY `IDX_F556E54944C2CF12` (`payment_info_id`),
  KEY `IDX_F556E54975FA0FF2` (`visit_id`),
  CONSTRAINT `FK_F556E549427EB8A5` FOREIGN KEY (`request_id`) REFERENCES `tbl_transaction_request` (`id`),
  CONSTRAINT `FK_F556E54944C2CF12` FOREIGN KEY (`payment_info_id`) REFERENCES `tbl_payment_info` (`id`),
  CONSTRAINT `FK_F556E54975FA0FF2` FOREIGN KEY (`visit_id`) REFERENCES `tbl_visit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_transaction`
--

LOCK TABLES `tbl_transaction` WRITE;
/*!40000 ALTER TABLE `tbl_transaction` DISABLE KEYS */;
INSERT INTO `tbl_transaction` VALUES (1,8,NULL,12,'2021-04-04 09:00:43','2021-04-04 09:00:45',NULL,'SGD','pi_1IcRp2CIT3hnKWceH6jllgKW',1,'2F2EST','1c081f0901b7c8282c918b9c11f72e5bf402c645e275161359f9beac38b46d58'),(2,9,NULL,13,'2021-04-04 09:08:02','2021-04-04 09:08:04',NULL,'SGD','pi_1IcRw7CIT3hnKWcesFD4ItDZ',1,'PS5IAO','da322aaa6957daebe392aa9969964e54af28a620ea4824cbb4e77a0d81154de0'),(3,10,1,14,'2021-04-04 09:13:59','2021-04-04 09:14:01',2.2222,'SGD','pi_1IcS1sCIT3hnKWce46jUmlhE',1,'K0JWNF','38ed76f2865112401a33bac67a30f9da528d5a60b3d42cb816415a5204b3fd53'),(4,11,1,15,'2021-04-04 09:18:37','2021-04-04 09:18:38',11.1111,'SGD','pi_1IcS6LCIT3hnKWceE18PUvlU',1,'MDIIFV','268d57050f1882b42e4e97d9363876458ada64344427eaf0aabd2627dcb4bff5'),(5,13,1,17,'2021-04-04 12:10:22','2021-04-04 12:10:23',3.3333,'SGD','pi_1IcUmYCIT3hnKWcekEJ5HSsW',1,'G2XC17','bc4c9752a129effcad1bc2df116a16671082a93861a035564625d040c5f5d89c'),(6,14,1,18,'2021-04-04 12:12:25','2021-04-04 12:12:27',4.1667,'SGD','pi_1IcUoYCIT3hnKWcel7gDoyBa',1,'6TICEK','8c13ec8774b32d242659ba895680101f2921353ce44a175ee99e26e978d2d3d7'),(7,17,1,21,'2021-04-04 13:13:28','2021-04-04 13:13:29',51.9444,'SGD','pi_1IcVlcCIT3hnKWcepHMLDUWb',1,'R2KG4B','814415ff9cd5c3fb24cd7b40fdcaad1f2253e088e45bb10660b455faa14dcd20'),(8,18,1,22,'2021-04-04 13:17:05','2021-04-04 13:17:06',17.7778,'SGD','pi_1IcVp7CIT3hnKWcerhJkeVeN',1,'RIZDYE','0ff130fdc96ad001eff8810eb07e76aae33a2c42eb3d6db0081ce118ecd3c728'),(9,20,1,24,'2021-04-04 14:42:25','2021-04-04 14:42:26',65.6683,'SGD','pi_1IcX9hCIT3hnKWceonLhnqHH',1,'ZINVPF','437bfd614f995bc0ae301651bb5907ce93aa6233b08df886afa2b3f987e1eb7e'),(10,21,1,25,'2021-04-04 15:02:17','2021-04-04 15:02:18',0.95,'SGD','pi_1IcXSvCIT3hnKWcekarkBsEf',1,'UVMAHA','84017ecc25bf8b2919fac2d4a2c70357c258a88c9a808070f7a415dac96aae34'),(11,23,1,27,'2021-04-04 15:20:39','2021-04-04 15:20:40',194444.4425,'SGD','pi_1IcXkhCIT3hnKWceiLuXyVCO',1,'1AICYK','97f41b228d84b14841e3bbce4e317f2dba31ca13f2d722997f48640f3935284f'),(12,29,9,33,'2021-04-05 04:53:37','2021-04-05 04:53:38',25,'SGD','pi_1IckRRCIT3hnKWceG6aHksRK',1,'RUGVGF','87d82c0b2a64072b93cf927e866319d85934235d71277edfefb20d7110214e99'),(13,30,9,34,'2021-04-05 04:54:41','2021-04-05 04:54:42',25,'SGD','pi_1IckSTCIT3hnKWcey8QJRtDJ',1,'NNY9AU','f26a0a99f8262fc4116d1f47f8aa28d896c604b2d87304e34ac2a58835b9c5f6'),(14,32,9,36,'2021-04-05 05:02:03','2021-04-05 05:02:04',0.0917,'SGD',NULL,0,'459LFU','b7713a4985a437c108640e353d7a7ba46b2c65be01e802db5a54cb36868d496c'),(15,34,9,38,'2021-04-05 05:25:40','2021-04-05 05:25:40',0.0278,'SGD',NULL,0,'0PVMT8','532a8022c3eaaff2aeb460241a8add982dda20b3eb30a870cfbb491778a442dd'),(16,35,9,39,'2021-04-05 05:27:03','2021-04-05 05:27:03',0.0306,'SGD',NULL,0,'I9ZMOW','2dba77a54e4ab01c19379a4b39472769e34b1bb7e6b78f13eb64906c2ed47a0a'),(17,40,9,44,'2021-04-05 06:12:53','2021-04-05 06:12:54',0.0417,'SGD',NULL,0,'IGNSC0','994468369479692d8a2ca8fc1dd5a7db410c323a74869bbefe8472d540bc0ce9'),(18,41,9,45,'2021-04-05 06:41:25','2021-04-05 06:41:27',3.9361,'SGD','pi_1Icm7mCIT3hnKWcedBfeqUVo',1,'VCVBK3','3aa927d978701b8926292005042a4d6c57771b50baa75ad6fd277970361f08a8'),(19,42,9,46,'2021-04-05 06:43:43','2021-04-05 06:43:44',0.1944,'SGD',NULL,0,'4OYKQG','29c62b319f20a0cd2e4a4fefae7040e86fae24f1c97243f634e386f95960819e'),(20,43,9,47,'2021-04-05 07:42:52','2021-04-05 07:42:54',3.5167,'SGD','pi_1Icn5FCIT3hnKWceP1GpXbC0',1,'6R9URZ','4670d078b4face51254705c1bd10f006bc5220d8b48f4e4f6248e08171c4b806'),(21,44,9,48,'2021-04-05 09:28:44','2021-04-05 09:28:46',17.5583,'SGD','pi_1IcojgCIT3hnKWceTOXiVWZI',1,'IQ9RFY','32e7f2baa964b5fe7e94bc87c8413f03a39a815953129e452ab8a7f530cdeaeb'),(22,45,9,49,'2021-04-05 10:08:57','2021-04-05 10:08:57',0.3139,'SGD',NULL,0,'SBEKNW','ac768e604715d1053b8358b86645626b2023aa774362a149b38d75d879e10e48'),(23,46,9,50,'2021-04-05 10:34:50','2021-04-05 10:34:50',0.05,'SGD',NULL,0,'IOV2DU','5a1fe714131303d3035e7476cc983eafe2fa66cdbc6583326d84a0fef0a1736a'),(24,47,9,51,'2021-04-05 10:39:49','2021-04-05 10:39:49',0.0222,'SGD',NULL,0,'J0PEIC','e8127f4c0a226277d7ad1ff9c612326f29324aa6197d5c458a9c5df97b2af3ba'),(25,48,9,52,'2021-04-05 10:40:23','2021-04-05 10:40:23',0.2222,'SGD',NULL,0,'AZ5KFN','a6b9b4c95cd6cf7be20e103533d0b6607aaa7f0b4a733d8e2fa909b8f067b991'),(26,49,9,53,'2021-04-05 10:40:55','2021-04-05 10:40:56',1.9444,'SGD','pi_1IcprXCIT3hnKWcepxbgtdXQ',1,'VA26QV','fbdf9e0e32266046f2b254e958358f06cdd094b826116bf89d0a8c85195c053e'),(27,50,9,54,'2021-04-05 11:19:03','2021-04-05 11:19:03',0.06,'SGD',NULL,0,'CD3JDF','040090f22e4e50519ae51a3a4accee586f2bc0e189bebf1ad4928dc75e7f45a7'),(28,51,9,55,'2021-04-05 11:25:04','2021-04-05 11:25:05',6.1111,'SGD','pi_1IcqYGCIT3hnKWcesdTN7gtX',1,'2VGSP1','b7ba56ec0bf5524f3e5db0911a9c025cf41b24d8c6adf80efe4069b9d998620e'),(29,52,9,56,'2021-04-05 11:31:47','2021-04-05 11:31:48',23.6111,'SGD','pi_1IcqelCIT3hnKWcec54qpUai',1,'SGMCLW','cd047463f4aa5d2d0551a70423193a2156b78b499a105b893c1d0677073e59d4'),(30,53,9,57,'2021-04-05 11:32:53','2021-04-05 11:32:54',5.5556,'SGD','pi_1IcqfpCIT3hnKWceW8IDFgRw',1,'ZKSO2L','2fbdc06a1f8312f0dfa0b4777253a358152b1fea41032746b429b0936b2b0352'),(31,54,9,58,'2021-04-05 11:34:47','2021-04-05 11:34:48',9.4444,'SGD','pi_1IcqhfCIT3hnKWceEbAyMflW',1,'4P2PYV','53a8cbecd551aeee87a444db6e601e583a490a962abb852403db201546aada31'),(32,55,9,59,'2021-04-05 11:48:30','2021-04-05 11:48:32',13.055555555556,'SGD','pi_1IcquwCIT3hnKWceeK5H59sy',1,'EN4CLB','941eb3396e44c90bcfc9c2d0ea2aeb9baa11afcd16f5906ef68621ef70ed552b'),(33,57,11,60,'2021-04-05 11:57:29','2021-04-05 11:57:30',0.033333333333333,'SGD',NULL,0,'RUQ0VT','219ec4f904cd2364a23f41089e86658a73ba80f71c68d2479af383015176246b'),(34,58,11,61,'2021-04-05 11:58:55','2021-04-05 11:58:57',8.8888888888889,'SGD','pi_1Icr51CIT3hnKWceIi2gMtV3',1,'0VECAP','b427b1993e456d96c4810ffbc0f90f4ae21cfda8c8c4ff60c5b5a20ce26547f8'),(35,59,11,62,'2021-04-05 12:15:03','2021-04-05 12:15:04',155.55555555556,'SGD','pi_1IcrKdCIT3hnKWce9J2ouu8V',1,'DWVG7P','332fe09abb3877071905b655a86ddec989990c09738c897dd5899fd515af25e6'),(36,60,13,63,'2021-04-05 12:25:49','2021-04-05 12:25:50',143.33333333333,'SGD','pi_1IcrV3CIT3hnKWcefiF7z1vu',1,'0B8POG','ee53cceccd5d2d15382a2a2506dc11cc732885e6a9ea27a3b3c2a735978ec0d2'),(37,68,13,71,'2021-04-09 12:14:27','2021-04-09 12:14:29',13.416666666667,'SGD','pi_1IeJEGCIT3hnKWceh7ZfsjyX',1,'JDAYTN','cd4899de40b16f964a7c3365a4e0fa5a400f574db1799e45dcd78b739866144d'),(38,69,13,72,'2021-04-11 04:35:18','2021-04-11 04:35:20',4.7855555555556,'SGD','pi_1Iev10CIT3hnKWceH94gu5Lj',1,'69_4G3JSVU3','c04259bd6ac71d07da38bbc7f5d246345c74dc4217129a13fe29ec05436d9196'),(39,70,13,73,'2021-04-11 07:34:27','2021-04-11 07:34:28',10.05,'SGD','pi_1IexoNCIT3hnKWcelt8bORcb',1,'70_TXQBGDEJ','1a7d8fc625be504fe8422654c34106fb37577352b92b4ed2185cf2c8c139a56b'),(40,71,13,74,'2021-04-11 08:08:56','2021-04-11 08:08:58',1.1694444444444,'SGD','pi_1IeyLkCIT3hnKWce9WxHrV9q',1,'71_DBAT7UNN','b257e908afc609357c01f7c341b6c1d209fef3537b4f80251f30defc1457f518'),(41,72,13,74,'2021-04-11 08:10:07','2021-04-11 08:10:08',1.3666666666667,'SGD','pi_1IeyMtCIT3hnKWceLAI7GmUB',1,'72_KHXQTXLZ','e8244e9db07bae1938ff257af1facf3c26b45d145591397e60fcc55d12339272'),(42,73,13,75,'2021-04-11 08:10:55','2021-04-11 08:10:56',1.3,'SGD','pi_1IeyNfCIT3hnKWceBWEPcjCC',1,'73_5IY9NADF','df539a8a0f54b8f4a724bf90a98d374a6c51d611a5967c503b7c4818604904fe'),(43,75,13,76,'2021-04-11 08:21:51','2021-04-11 08:21:52',1.1222222222222,'SGD','pi_1IeyYFCIT3hnKWce348GYebH',1,'75_MYLM6UTC','44bd37b1a3663e7595de7f3a6f809fec83b8cc96017c7cd9ed930f42dc7f0a6a'),(44,76,13,74,'2021-04-11 08:27:25','2021-04-11 08:27:27',4.25,'SGD','pi_1IeyddCIT3hnKWcetZjd4Os3',1,'76_C6CHKRK2','515ef27c4d4eddf9fa1fda34168c37f3f0b993e65bda8d996494730db553362e'),(45,77,13,77,'2021-04-11 09:14:43','2021-04-11 09:14:45',9.3972222222222,'SGD','pi_1IezNQCIT3hnKWceH7QEQJqv',1,'77_ICNE7CPG','d71f7a6a201e140d567db9b804cba7df5242e703dac5c0a8d0b1747f2ceb96cd'),(46,79,13,78,'2021-04-11 09:20:20','2021-04-11 09:20:20',0.068611111111111,'SGD',NULL,0,'79_D6BFWCBJ','5d8b9ccc99b52e5c1a7b9aa8aea72cc4ed3ced1a9531f2495af0f5007ee0f929'),(47,81,13,79,'2021-04-11 10:40:12','2021-04-11 10:40:13',12.133333333333,'SGD','pi_1If0i8CIT3hnKWceOhPXJjvM',1,'81_AB2SK9BA','89d54e054f1ba0c88438c03e9677ac6751faffba3e8781b6dbfef33e49daa4af'),(48,82,13,83,'2021-04-12 11:34:39','2021-04-12 11:34:41',0.53888888888889,'SGD','pi_1IfO2OCIT3hnKWce19t1p6d2',1,'82_ZR4MJXOV','cb1c89a3ba79609ded5872339f725b4e54f7019d9e8d47b7f8bd5ee83045343e'),(49,84,13,84,'2021-04-12 11:40:59','2021-04-12 11:40:59',0.35833333333333,'SGD',NULL,0,'84_EIETHCJE','37edacfa0120a58f036abb331b3e7c88926a3678f3227ece735f61b505dfd0ca'),(50,85,13,85,'2021-04-12 11:47:29','2021-04-12 11:47:30',0.775,'SGD','pi_1IfOEnCIT3hnKWce0kAAHdkB',1,'85_Q1TQXGER','2b45395c110ec2de3d02b0ea4389cdfbe197c0423ed35481987c8f98e72c1943'),(51,86,13,86,'2021-04-12 11:49:24','2021-04-12 11:49:24',0.10833333333333,'SGD',NULL,0,'86_RJRKXI8Z','46986df339a4c4ced21d0add325ff5ae382488db53aea688d0e9bed14060bd44'),(52,87,13,87,'2021-04-12 11:55:24','2021-04-12 11:55:26',0.63888888888889,'SGD','pi_1IfOMTCIT3hnKWceEohUnRj0',1,'87_HSKBKPQM','4f923f2b56071e4310a82f73d7a866f964302fd0f9df9f7ea7e93c2ad2741155'),(53,88,13,88,'2021-04-12 12:05:04','2021-04-12 12:05:05',1.4388888888889,'SGD','pi_1IfOVoCIT3hnKWceFeNpO0XZ',1,'88_Y1CFUL0O','4c311e155d773b9ba2fac9b186fed8b05d501e13ae4598f404d32291fd6cc0b5'),(54,90,13,91,'2021-04-12 12:23:33','2021-04-12 12:23:33',0.058333333333333,'SGD',NULL,0,'90_A3MS8PP2','5e839f16c70fcedd3166ec5251b38e09c8ae74d5752829da503de875c58cec89'),(55,92,13,92,'2021-04-12 13:09:12','2021-04-12 13:09:14',2.8805555555556,'SGD','pi_1IfPVsCIT3hnKWceXr2HsVtk',1,'92_SFJVPSMQ','29a19a24b12a3741fd5dfdebc46c1424e8d802392068400e746acc83dc0e2eb6');
/*!40000 ALTER TABLE `tbl_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_transaction_activity`
--

DROP TABLE IF EXISTS `tbl_transaction_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_transaction_activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `log` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3EEF86442FC0CB0F` (`transaction_id`),
  CONSTRAINT `FK_3EEF86442FC0CB0F` FOREIGN KEY (`transaction_id`) REFERENCES `tbl_transaction` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_transaction_activity`
--

LOCK TABLES `tbl_transaction_activity` WRITE;
/*!40000 ALTER TABLE `tbl_transaction_activity` DISABLE KEYS */;
INSERT INTO `tbl_transaction_activity` VALUES (1,1,'2021-04-04 09:00:45','2021-04-04 09:00:45','{\"transaction_ref\":\"pi_1IcRp2CIT3hnKWceH6jllgKW\",\"status\":\"succeeded\",\"amount\":1000,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcNwvCIT3hnKWce2CI0zQ78\",\"customer\":\"cus_JErgF5ebywDQQJ\",\"cancel_reason\":null,\"created_at\":1617526844}'),(2,2,'2021-04-04 09:08:04','2021-04-04 09:08:04','{\"transaction_ref\":\"pi_1IcRw7CIT3hnKWcesFD4ItDZ\",\"status\":\"succeeded\",\"amount\":1000,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcNwvCIT3hnKWce2CI0zQ78\",\"customer\":\"cus_JErgF5ebywDQQJ\",\"cancel_reason\":null,\"created_at\":1617527283}'),(3,3,'2021-04-04 09:14:01','2021-04-04 09:14:01','{\"transaction_ref\":\"pi_1IcS1sCIT3hnKWce46jUmlhE\",\"status\":\"succeeded\",\"amount\":223,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcNwvCIT3hnKWce2CI0zQ78\",\"customer\":\"cus_JErgF5ebywDQQJ\",\"cancel_reason\":null,\"created_at\":1617527640}'),(4,4,'2021-04-04 09:18:38','2021-04-04 09:18:38','{\"transaction_ref\":\"pi_1IcS6LCIT3hnKWceE18PUvlU\",\"status\":\"succeeded\",\"amount\":1112,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcNwvCIT3hnKWce2CI0zQ78\",\"customer\":\"cus_JErgF5ebywDQQJ\",\"cancel_reason\":null,\"created_at\":1617527917}'),(5,5,'2021-04-04 12:10:23','2021-04-04 12:10:23','{\"transaction_ref\":\"pi_1IcUmYCIT3hnKWcekEJ5HSsW\",\"status\":\"succeeded\",\"amount\":334,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcNwvCIT3hnKWce2CI0zQ78\",\"customer\":\"cus_JErgF5ebywDQQJ\",\"cancel_reason\":null,\"created_at\":1617538222}'),(6,6,'2021-04-04 12:12:27','2021-04-04 12:12:27','{\"transaction_ref\":\"pi_1IcUoYCIT3hnKWcel7gDoyBa\",\"status\":\"succeeded\",\"amount\":417,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcNwvCIT3hnKWce2CI0zQ78\",\"customer\":\"cus_JErgF5ebywDQQJ\",\"cancel_reason\":null,\"created_at\":1617538346}'),(7,7,'2021-04-04 13:13:29','2021-04-04 13:13:29','{\"transaction_ref\":\"pi_1IcVlcCIT3hnKWcepHMLDUWb\",\"status\":\"succeeded\",\"amount\":5195,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcNwvCIT3hnKWce2CI0zQ78\",\"customer\":\"cus_JErgF5ebywDQQJ\",\"cancel_reason\":null,\"created_at\":1617542008}'),(8,8,'2021-04-04 13:17:06','2021-04-04 13:17:06','{\"transaction_ref\":\"pi_1IcVp7CIT3hnKWcerhJkeVeN\",\"status\":\"succeeded\",\"amount\":1778,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcNwvCIT3hnKWce2CI0zQ78\",\"customer\":\"cus_JErgF5ebywDQQJ\",\"cancel_reason\":null,\"created_at\":1617542225}'),(9,9,'2021-04-04 14:42:26','2021-04-04 14:42:26','{\"transaction_ref\":\"pi_1IcX9hCIT3hnKWceonLhnqHH\",\"status\":\"succeeded\",\"amount\":6567,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcNwvCIT3hnKWce2CI0zQ78\",\"customer\":\"cus_JErgF5ebywDQQJ\",\"cancel_reason\":null,\"created_at\":1617547345}'),(10,10,'2021-04-04 15:02:18','2021-04-04 15:02:18','{\"transaction_ref\":\"pi_1IcXSvCIT3hnKWcekarkBsEf\",\"status\":\"succeeded\",\"amount\":95,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcNwvCIT3hnKWce2CI0zQ78\",\"customer\":\"cus_JErgF5ebywDQQJ\",\"cancel_reason\":null,\"created_at\":1617548537}'),(11,11,'2021-04-04 15:20:40','2021-04-04 15:20:40','{\"transaction_ref\":\"pi_1IcXkhCIT3hnKWceiLuXyVCO\",\"status\":\"succeeded\",\"amount\":19444445,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcNwvCIT3hnKWce2CI0zQ78\",\"customer\":\"cus_JErgF5ebywDQQJ\",\"cancel_reason\":null,\"created_at\":1617549639}'),(12,12,'2021-04-05 04:53:38','2021-04-05 04:53:38','{\"transaction_ref\":\"pi_1IckRRCIT3hnKWceG6aHksRK\",\"status\":\"succeeded\",\"amount\":2500,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":null,\"created_at\":1617598417}'),(13,13,'2021-04-05 04:54:42','2021-04-05 04:54:42','{\"transaction_ref\":\"pi_1IckSTCIT3hnKWcey8QJRtDJ\",\"status\":\"succeeded\",\"amount\":2500,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":null,\"created_at\":1617598481}'),(14,14,'2021-04-05 05:02:04','2021-04-05 05:02:04','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":10,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-05 05:02:04.136760\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(15,15,'2021-04-05 05:25:40','2021-04-05 05:25:40','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":3,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-05 05:25:40.811808\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(16,16,'2021-04-05 05:27:03','2021-04-05 05:27:03','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":4,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-05 05:27:03.410309\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(17,17,'2021-04-05 06:12:54','2021-04-05 06:12:54','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":5,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-05 06:12:54.135140\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(18,18,'2021-04-05 06:41:27','2021-04-05 06:41:27','{\"transaction_ref\":\"pi_1Icm7mCIT3hnKWcedBfeqUVo\",\"status\":\"succeeded\",\"amount\":394,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":null,\"created_at\":1617604886}'),(19,19,'2021-04-05 06:43:44','2021-04-05 06:43:44','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":20,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-05 06:43:44.082844\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(20,20,'2021-04-05 07:42:54','2021-04-05 07:42:54','{\"transaction_ref\":\"pi_1Icn5FCIT3hnKWceP1GpXbC0\",\"status\":\"succeeded\",\"amount\":352,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":null,\"created_at\":1617608573}'),(21,21,'2021-04-05 09:28:46','2021-04-05 09:28:46','{\"transaction_ref\":\"pi_1IcojgCIT3hnKWceTOXiVWZI\",\"status\":\"succeeded\",\"amount\":1756,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":null,\"created_at\":1617614924}'),(22,22,'2021-04-05 10:08:57','2021-04-05 10:08:57','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":32,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-05 10:08:57.966276\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(23,23,'2021-04-05 10:34:50','2021-04-05 10:34:50','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":5,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-05 10:34:50.370026\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(24,24,'2021-04-05 10:39:49','2021-04-05 10:39:49','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":3,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-05 10:39:49.674740\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(25,25,'2021-04-05 10:40:23','2021-04-05 10:40:23','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":23,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-05 10:40:23.513204\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(26,26,'2021-04-05 10:40:56','2021-04-05 10:40:56','{\"transaction_ref\":\"pi_1IcprXCIT3hnKWcepxbgtdXQ\",\"status\":\"succeeded\",\"amount\":195,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":null,\"created_at\":1617619255}'),(27,27,'2021-04-05 11:19:03','2021-04-05 11:19:03','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":6,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-05 11:19:03.584438\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(28,28,'2021-04-05 11:25:05','2021-04-05 11:25:05','{\"transaction_ref\":\"pi_1IcqYGCIT3hnKWcesdTN7gtX\",\"status\":\"succeeded\",\"amount\":612,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":null,\"created_at\":1617621904}'),(29,29,'2021-04-05 11:31:48','2021-04-05 11:31:48','{\"transaction_ref\":\"pi_1IcqelCIT3hnKWcec54qpUai\",\"status\":\"succeeded\",\"amount\":2362,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":null,\"created_at\":1617622307}'),(30,30,'2021-04-05 11:32:54','2021-04-05 11:32:54','{\"transaction_ref\":\"pi_1IcqfpCIT3hnKWceW8IDFgRw\",\"status\":\"succeeded\",\"amount\":556,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":null,\"created_at\":1617622373}'),(31,31,'2021-04-05 11:34:48','2021-04-05 11:34:48','{\"transaction_ref\":\"pi_1IcqhfCIT3hnKWceEbAyMflW\",\"status\":\"succeeded\",\"amount\":945,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":null,\"created_at\":1617622487}'),(32,32,'2021-04-05 11:48:32','2021-04-05 11:48:32','{\"transaction_ref\":\"pi_1IcquwCIT3hnKWceeK5H59sy\",\"status\":\"succeeded\",\"amount\":1306,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcXpJCIT3hnKWceNclHNVad\",\"customer\":\"cus_JF1tzXrSaKQHv6\",\"cancel_reason\":null,\"created_at\":1617623310}'),(33,33,'2021-04-05 11:57:30','2021-04-05 11:57:30','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":4,\"currency\":\"sgd\",\"payment_method\":\"pm_1Icr2fCIT3hnKWceMb7aDCqu\",\"customer\":\"cus_JFLkDjY37GU3yf\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-05 11:57:30.284426\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(34,34,'2021-04-05 11:58:57','2021-04-05 11:58:57','{\"transaction_ref\":\"pi_1Icr51CIT3hnKWceIi2gMtV3\",\"status\":\"succeeded\",\"amount\":889,\"currency\":\"sgd\",\"payment_method\":\"pm_1Icr2fCIT3hnKWceMb7aDCqu\",\"customer\":\"cus_JFLkDjY37GU3yf\",\"cancel_reason\":null,\"created_at\":1617623935}'),(35,35,'2021-04-05 12:15:04','2021-04-05 12:15:04','{\"transaction_ref\":\"pi_1IcrKdCIT3hnKWce9J2ouu8V\",\"status\":\"succeeded\",\"amount\":15556,\"currency\":\"sgd\",\"payment_method\":\"pm_1Icr2fCIT3hnKWceMb7aDCqu\",\"customer\":\"cus_JFLkDjY37GU3yf\",\"cancel_reason\":null,\"created_at\":1617624903}'),(36,36,'2021-04-05 12:25:50','2021-04-05 12:25:50','{\"transaction_ref\":\"pi_1IcrV3CIT3hnKWcefiF7z1vu\",\"status\":\"succeeded\",\"amount\":14334,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1617625549}'),(37,37,'2021-04-09 12:14:29','2021-04-09 12:14:29','{\"transaction_ref\":\"pi_1IeJEGCIT3hnKWceh7ZfsjyX\",\"status\":\"succeeded\",\"amount\":1342,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1617970468}'),(38,38,'2021-04-11 04:35:20','2021-04-11 04:35:20','{\"transaction_ref\":\"pi_1Iev10CIT3hnKWceH94gu5Lj\",\"status\":\"succeeded\",\"amount\":479,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618115718}'),(39,39,'2021-04-11 07:34:28','2021-04-11 07:34:28','{\"transaction_ref\":\"pi_1IexoNCIT3hnKWcelt8bORcb\",\"status\":\"succeeded\",\"amount\":1005,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618126467}'),(40,40,'2021-04-11 08:08:58','2021-04-11 08:08:58','{\"transaction_ref\":\"pi_1IeyLkCIT3hnKWce9WxHrV9q\",\"status\":\"succeeded\",\"amount\":117,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618128536}'),(41,41,'2021-04-11 08:10:08','2021-04-11 08:10:08','{\"transaction_ref\":\"pi_1IeyMtCIT3hnKWceLAI7GmUB\",\"status\":\"succeeded\",\"amount\":137,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618128607}'),(42,42,'2021-04-11 08:10:56','2021-04-11 08:10:56','{\"transaction_ref\":\"pi_1IeyNfCIT3hnKWceBWEPcjCC\",\"status\":\"succeeded\",\"amount\":130,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618128655}'),(43,43,'2021-04-11 08:21:52','2021-04-11 08:21:52','{\"transaction_ref\":\"pi_1IeyYFCIT3hnKWce348GYebH\",\"status\":\"succeeded\",\"amount\":113,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618129311}'),(44,44,'2021-04-11 08:27:27','2021-04-11 08:27:27','{\"transaction_ref\":\"pi_1IeyddCIT3hnKWcetZjd4Os3\",\"status\":\"succeeded\",\"amount\":425,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618129645}'),(45,45,'2021-04-11 09:14:45','2021-04-11 09:14:45','{\"transaction_ref\":\"pi_1IezNQCIT3hnKWceH7QEQJqv\",\"status\":\"succeeded\",\"amount\":940,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618132484}'),(46,46,'2021-04-11 09:20:20','2021-04-11 09:20:20','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":7,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-11 09:20:20.526773\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(47,47,'2021-04-11 10:40:13','2021-04-11 10:40:13','{\"transaction_ref\":\"pi_1If0i8CIT3hnKWceOhPXJjvM\",\"status\":\"succeeded\",\"amount\":1214,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618137612}'),(48,48,'2021-04-12 11:34:41','2021-04-12 11:34:41','{\"transaction_ref\":\"pi_1IfO2OCIT3hnKWce19t1p6d2\",\"status\":\"succeeded\",\"amount\":54,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618227280}'),(49,49,'2021-04-12 11:40:59','2021-04-12 11:40:59','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":36,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-12 11:40:59.669511\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(50,50,'2021-04-12 11:47:30','2021-04-12 11:47:30','{\"transaction_ref\":\"pi_1IfOEnCIT3hnKWce0kAAHdkB\",\"status\":\"succeeded\",\"amount\":78,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618228049}'),(51,51,'2021-04-12 11:49:24','2021-04-12 11:49:24','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":11,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-12 11:49:24.859927\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(52,52,'2021-04-12 11:55:26','2021-04-12 11:55:26','{\"transaction_ref\":\"pi_1IfOMTCIT3hnKWceEohUnRj0\",\"status\":\"succeeded\",\"amount\":64,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618228525}'),(53,53,'2021-04-12 12:05:05','2021-04-12 12:05:05','{\"transaction_ref\":\"pi_1IfOVoCIT3hnKWceFeNpO0XZ\",\"status\":\"succeeded\",\"amount\":144,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618229104}'),(54,54,'2021-04-12 12:23:33','2021-04-12 12:23:33','{\"transaction_ref\":null,\"status\":\"Fail\",\"amount\":6,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":\"Amount must be at least $0.50 sgd\",\"created_at\":{\"date\":\"2021-04-12 12:23:33.663610\",\"timezone_type\":3,\"timezone\":\"UTC\"}}'),(55,55,'2021-04-12 13:09:14','2021-04-12 13:09:14','{\"transaction_ref\":\"pi_1IfPVsCIT3hnKWceXr2HsVtk\",\"status\":\"succeeded\",\"amount\":289,\"currency\":\"sgd\",\"payment_method\":\"pm_1IcrSnCIT3hnKWced3cUARD4\",\"customer\":\"cus_JFMBmlI5UhyROO\",\"cancel_reason\":null,\"created_at\":1618232952}');
/*!40000 ALTER TABLE `tbl_transaction_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_transaction_request`
--

DROP TABLE IF EXISTS `tbl_transaction_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_transaction_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `visit_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `payment_method_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `code` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expired_date` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_72960A5375FA0FF2` (`visit_id`),
  KEY `IDX_72960A53A76ED395` (`user_id`),
  KEY `IDX_72960A535AA1164F` (`payment_method_id`),
  CONSTRAINT `FK_72960A535AA1164F` FOREIGN KEY (`payment_method_id`) REFERENCES `tbl_payment_info` (`id`),
  CONSTRAINT `FK_72960A5375FA0FF2` FOREIGN KEY (`visit_id`) REFERENCES `tbl_visit` (`id`),
  CONSTRAINT `FK_72960A53A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_transaction_request`
--

LOCK TABLES `tbl_transaction_request` WRITE;
/*!40000 ALTER TABLE `tbl_transaction_request` DISABLE KEYS */;
INSERT INTO `tbl_transaction_request` VALUES (8,12,3,1,'2021-04-04 08:54:54','2021-04-04 09:00:45','2F2EST','1c081f0901b7c8282c918b9c11f72e5bf402c645e275161359f9beac38b46d58','2021-04-04 08:59:54',1),(9,13,3,1,'2021-04-04 09:03:25','2021-04-04 09:08:04','PS5IAO','da322aaa6957daebe392aa9969964e54af28a620ea4824cbb4e77a0d81154de0','2021-04-04 09:08:25',1),(10,14,3,1,'2021-04-04 09:10:35','2021-04-04 09:14:01','K0JWNF','38ed76f2865112401a33bac67a30f9da528d5a60b3d42cb816415a5204b3fd53','2021-04-04 09:15:35',1),(11,15,3,1,'2021-04-04 09:17:44','2021-04-04 09:18:38','MDIIFV','268d57050f1882b42e4e97d9363876458ada64344427eaf0aabd2627dcb4bff5','2021-04-04 09:22:44',1),(12,16,3,1,'2021-04-04 12:09:21','2021-04-04 12:09:21','Z523KZ','b034a89948fab53babfecb87d465bfba4984eab5cd6a0b9c7e27084435047df3','2021-04-04 12:14:21',0),(13,17,3,1,'2021-04-04 12:10:19','2021-04-04 12:10:23','G2XC17','bc4c9752a129effcad1bc2df116a16671082a93861a035564625d040c5f5d89c','2021-04-04 12:15:19',1),(14,18,3,1,'2021-04-04 12:12:23','2021-04-04 12:12:27','6TICEK','8c13ec8774b32d242659ba895680101f2921353ce44a175ee99e26e978d2d3d7','2021-04-04 12:17:23',1),(15,19,3,1,'2021-04-04 12:45:56','2021-04-04 12:49:46','FYNT5F','0d0f0b471db9f8e04c8536a05f06efb0869f5852b2fef1c3b3630aff8db3c488','2021-04-04 12:54:46',0),(16,20,3,1,'2021-04-04 13:07:35','2021-04-04 13:07:35','DINTUH','2b08b05123521d9941df9b5fda83bb539eee5ba66204418f798e7dd5618ca8e2','2021-04-04 13:12:35',0),(17,21,3,1,'2021-04-04 13:13:20','2021-04-04 13:13:29','R2KG4B','814415ff9cd5c3fb24cd7b40fdcaad1f2253e088e45bb10660b455faa14dcd20','2021-04-04 13:18:20',1),(18,22,3,1,'2021-04-04 13:16:51','2021-04-04 13:17:06','RIZDYE','0ff130fdc96ad001eff8810eb07e76aae33a2c42eb3d6db0081ce118ecd3c728','2021-04-04 13:21:51',1),(19,23,3,1,'2021-04-04 13:20:00','2021-04-04 13:20:00','6A9FOG','2e5ca418061a90ec02f5f5f39d2fa86dd1c6415f7ede18495ef152f9f08cff7e','2021-04-04 13:25:00',0),(20,24,3,1,'2021-04-04 14:42:23','2021-04-04 14:42:26','ZINVPF','437bfd614f995bc0ae301651bb5907ce93aa6233b08df886afa2b3f987e1eb7e','2021-04-04 14:47:23',1),(21,25,3,1,'2021-04-04 15:02:11','2021-04-04 15:02:18','UVMAHA','84017ecc25bf8b2919fac2d4a2c70357c258a88c9a808070f7a415dac96aae34','2021-04-04 15:07:11',1),(22,26,3,1,'2021-04-04 15:19:18','2021-04-04 15:19:18','CWSKF4','6d95ce1c7638971f5ea73408e440881d5cefeafa51976d833f3000a0b8432804','2021-04-04 15:24:18',0),(23,27,3,1,'2021-04-04 15:20:37','2021-04-04 15:20:40','1AICYK','97f41b228d84b14841e3bbce4e317f2dba31ca13f2d722997f48640f3935284f','2021-04-04 15:25:37',1),(24,28,3,1,'2021-04-04 15:23:16','2021-04-04 15:23:16','C5F11Y','5424731dd7498b29373e5f7e9cbd02d91e5d2c390052ee56d0d56ba70d1fd4d7','2021-04-04 15:28:16',0),(25,29,7,9,'2021-04-04 15:26:06','2021-04-04 15:26:06','9AN68B','7778f9a3112fdc155b1054af4e2c781682c0e8bd075fa54be8e7cb45359db008','2021-04-04 15:31:06',0),(26,30,7,9,'2021-04-04 15:28:40','2021-04-04 15:28:40','N36D9C','02ecab87e631c3d7fa028aac92f5569d1d28b521f1b42a832c9a4225a3e9a917','2021-04-04 15:33:40',0),(27,31,7,9,'2021-04-05 03:30:25','2021-04-05 03:30:25','NDO5LU','c882a15b17bc92ee156a2d4bc4094245afa96f3b30c7aa5b0dda09518c77c996','2021-04-05 03:35:25',0),(28,32,7,9,'2021-04-05 04:38:28','2021-04-05 04:38:28','WKZRLR','ba20c903fdf984fa821963370f9c56851a33b45561e91b21ebdc9e092691a423','2021-04-05 04:43:28',0),(29,33,7,9,'2021-04-05 04:53:25','2021-04-05 04:53:38','RUGVGF','87d82c0b2a64072b93cf927e866319d85934235d71277edfefb20d7110214e99','2021-04-05 04:58:25',1),(30,34,7,9,'2021-04-05 04:54:38','2021-04-05 04:54:42','NNY9AU','f26a0a99f8262fc4116d1f47f8aa28d896c604b2d87304e34ac2a58835b9c5f6','2021-04-05 04:59:38',1),(31,35,7,9,'2021-04-05 04:55:23','2021-04-05 05:01:13','QZNATM','f4c67918410d202aa639ffaa17ee076187210b5f3debe7c3299d89a44ac382ca','2021-04-05 05:06:13',0),(32,36,7,9,'2021-04-05 05:01:59','2021-04-05 05:02:04','459LFU','b7713a4985a437c108640e353d7a7ba46b2c65be01e802db5a54cb36868d496c','2021-04-05 05:06:59',1),(33,37,7,9,'2021-04-05 05:12:08','2021-04-05 05:12:45','1H4FHZ','fab420e2498ecd64ee4681809437bd94c3f76b8dc25ed3c96a1748184a658017','2021-04-05 05:17:45',0),(34,38,7,9,'2021-04-05 05:25:35','2021-04-05 05:25:40','0PVMT8','532a8022c3eaaff2aeb460241a8add982dda20b3eb30a870cfbb491778a442dd','2021-04-05 05:30:35',1),(35,39,7,9,'2021-04-05 05:26:59','2021-04-05 05:27:03','I9ZMOW','2dba77a54e4ab01c19379a4b39472769e34b1bb7e6b78f13eb64906c2ed47a0a','2021-04-05 05:31:59',1),(36,40,7,9,'2021-04-05 05:31:17','2021-04-05 05:31:17','SURPAM','c9695e6c4f28f455a7071bab4b093b3e7f10ee70980eabeee3987359ae97c5e7','2021-04-05 05:36:17',0),(37,41,7,9,'2021-04-05 05:34:03','2021-04-05 05:36:14','KZVHIB','b8aa90eda0ba38c3ce198be9db4cb20dae122ad75f27b12873cc4daf59cfa7a8','2021-04-05 05:41:14',0),(38,42,7,9,'2021-04-05 05:36:41','2021-04-05 05:37:56','DHKHKR','236258d44db3a7dd950f5b55dc8e364857411c16f50244de35ade66c1fb00328','2021-04-05 05:42:56',0),(39,43,7,9,'2021-04-05 06:09:59','2021-04-05 06:11:29','NXQHCX','d873277cc2f78734325219260a7802f8e3c8a6ce083e75bb7e2e0935e012a0ce','2021-04-05 06:16:29',0),(40,44,7,9,'2021-04-05 06:12:35','2021-04-05 06:12:54','IGNSC0','994468369479692d8a2ca8fc1dd5a7db410c323a74869bbefe8472d540bc0ce9','2021-04-05 06:17:35',1),(41,45,7,9,'2021-04-05 06:41:00','2021-04-05 06:41:27','VCVBK3','3aa927d978701b8926292005042a4d6c57771b50baa75ad6fd277970361f08a8','2021-04-05 06:46:00',1),(42,46,7,9,'2021-04-05 06:43:25','2021-04-05 06:43:44','4OYKQG','29c62b319f20a0cd2e4a4fefae7040e86fae24f1c97243f634e386f95960819e','2021-04-05 06:48:25',1),(43,47,7,9,'2021-04-05 07:42:50','2021-04-05 07:42:54','6R9URZ','4670d078b4face51254705c1bd10f006bc5220d8b48f4e4f6248e08171c4b806','2021-04-05 07:47:50',1),(44,48,7,9,'2021-04-05 09:28:41','2021-04-05 09:28:46','IQ9RFY','32e7f2baa964b5fe7e94bc87c8413f03a39a815953129e452ab8a7f530cdeaeb','2021-04-05 09:33:41',1),(45,49,7,9,'2021-04-05 10:08:55','2021-04-05 10:08:57','SBEKNW','ac768e604715d1053b8358b86645626b2023aa774362a149b38d75d879e10e48','2021-04-05 10:13:55',1),(46,50,7,9,'2021-04-05 10:34:46','2021-04-05 10:34:50','IOV2DU','5a1fe714131303d3035e7476cc983eafe2fa66cdbc6583326d84a0fef0a1736a','2021-04-05 10:39:46',1),(47,51,7,9,'2021-04-05 10:39:45','2021-04-05 10:39:49','J0PEIC','e8127f4c0a226277d7ad1ff9c612326f29324aa6197d5c458a9c5df97b2af3ba','2021-04-05 10:44:45',1),(48,52,7,9,'2021-04-05 10:40:21','2021-04-05 10:40:23','AZ5KFN','a6b9b4c95cd6cf7be20e103533d0b6607aaa7f0b4a733d8e2fa909b8f067b991','2021-04-05 10:45:21',1),(49,53,7,9,'2021-04-05 10:40:48','2021-04-05 10:40:56','VA26QV','fbdf9e0e32266046f2b254e958358f06cdd094b826116bf89d0a8c85195c053e','2021-04-05 10:45:48',1),(50,54,7,9,'2021-04-05 11:19:01','2021-04-05 11:19:03','CD3JDF','040090f22e4e50519ae51a3a4accee586f2bc0e189bebf1ad4928dc75e7f45a7','2021-04-05 11:24:01',1),(51,55,7,9,'2021-04-05 11:24:59','2021-04-05 11:25:05','2VGSP1','b7ba56ec0bf5524f3e5db0911a9c025cf41b24d8c6adf80efe4069b9d998620e','2021-04-05 11:29:59',1),(52,56,7,9,'2021-04-05 11:31:10','2021-04-05 11:31:48','SGMCLW','cd047463f4aa5d2d0551a70423193a2156b78b499a105b893c1d0677073e59d4','2021-04-05 11:36:39',1),(53,57,7,9,'2021-04-05 11:32:49','2021-04-05 11:32:54','ZKSO2L','2fbdc06a1f8312f0dfa0b4777253a358152b1fea41032746b429b0936b2b0352','2021-04-05 11:37:49',1),(54,58,7,9,'2021-04-05 11:34:17','2021-04-05 11:34:48','4P2PYV','53a8cbecd551aeee87a444db6e601e583a490a962abb852403db201546aada31','2021-04-05 11:39:31',1),(55,59,7,9,'2021-04-05 11:48:04','2021-04-05 11:48:32','EN4CLB','941eb3396e44c90bcfc9c2d0ea2aeb9baa11afcd16f5906ef68621ef70ed552b','2021-04-05 11:53:20',1),(56,59,7,9,'2021-04-05 11:49:36','2021-04-05 11:49:36','EN4CLB','5764e260222eff414f7b819f68da8a09cb71e7f0cd8fbaea844744c65f839fdb','2021-04-05 11:54:36',0),(57,60,9,11,'2021-04-05 11:57:26','2021-04-05 11:57:30','RUQ0VT','219ec4f904cd2364a23f41089e86658a73ba80f71c68d2479af383015176246b','2021-04-05 12:02:26',1),(58,61,9,11,'2021-04-05 11:58:54','2021-04-05 11:58:57','0VECAP','b427b1993e456d96c4810ffbc0f90f4ae21cfda8c8c4ff60c5b5a20ce26547f8','2021-04-05 12:03:54',1),(59,62,9,11,'2021-04-05 12:15:01','2021-04-05 12:15:04','DWVG7P','332fe09abb3877071905b655a86ddec989990c09738c897dd5899fd515af25e6','2021-04-05 12:20:01',1),(60,63,8,13,'2021-04-05 12:25:18','2021-04-05 12:25:50','0B8POG','ee53cceccd5d2d15382a2a2506dc11cc732885e6a9ea27a3b3c2a735978ec0d2','2021-04-05 12:30:18',1),(61,64,8,13,'2021-04-07 11:28:35','2021-04-07 11:28:37','LANLXB','1e83e680183885c990c9a53ecaae502ba4d3029a69e64bcfdca353c527efc9c2','2021-04-07 11:33:35',1),(62,65,8,13,'2021-04-07 11:30:11','2021-04-07 11:30:18','BGK8HI','52235cfd85a175b23bd938428fbaffed0d149c94713b29773957d06b2805272d','2021-04-07 11:35:11',1),(63,66,8,13,'2021-04-07 11:32:32','2021-04-07 11:32:40','JIFGS5','22193bade114db73a3cc7c7e057f3908c34d2c498908f32cf4dab2d7059a4ca0','2021-04-07 11:37:38',1),(64,67,8,13,'2021-04-07 11:40:09','2021-04-07 11:40:12','SOVAHR','b126a436eb4cc5256b7ef1417fd0c02727b78ca80970f954fe201cd96e5c9e1d','2021-04-07 11:45:09',1),(65,68,8,13,'2021-04-09 12:00:07','2021-04-09 12:00:11','UDAPMQ','959faf21afe383049ac69722f73d549f43a344124951d6d3186dbd1047eb4545','2021-04-09 12:05:07',1),(66,69,8,13,'2021-04-09 12:01:05','2021-04-09 12:01:08','MVMLLV','eec9a70d43de411315090ac158f6583689a1ad2606ed61571d414ffcbb0c67ff','2021-04-09 12:06:05',1),(67,70,8,13,'2021-04-09 12:10:42','2021-04-09 12:10:45','S6MKEB','e195062eb53d1dd3ae7ab93ccc5d520c078a83dd089ac28ebba64365e5576741','2021-04-09 12:15:42',1),(68,71,8,13,'2021-04-09 12:14:26','2021-04-09 12:14:27','JDAYTN','cd4899de40b16f964a7c3365a4e0fa5a400f574db1799e45dcd78b739866144d','2021-04-09 12:19:26',1),(69,72,8,13,'2021-04-11 04:18:49','2021-04-11 04:35:18','69_4G3JSVU3','c04259bd6ac71d07da38bbc7f5d246345c74dc4217129a13fe29ec05436d9196','2021-04-11 04:39:52',1),(70,73,8,13,'2021-04-11 07:34:24','2021-04-11 07:34:27','70_TXQBGDEJ','1a7d8fc625be504fe8422654c34106fb37577352b92b4ed2185cf2c8c139a56b','2021-04-11 07:39:24',1),(71,74,8,13,'2021-04-11 08:04:29','2021-04-11 08:08:56','71_DBAT7UNN','b257e908afc609357c01f7c341b6c1d209fef3537b4f80251f30defc1457f518','2021-04-11 08:13:44',1),(72,74,8,13,'2021-04-11 08:10:00','2021-04-11 08:10:07','72_KHXQTXLZ','e8244e9db07bae1938ff257af1facf3c26b45d145591397e60fcc55d12339272','2021-04-11 08:15:00',1),(73,75,8,13,'2021-04-11 08:10:33','2021-04-11 08:10:55','73_5IY9NADF','df539a8a0f54b8f4a724bf90a98d374a6c51d611a5967c503b7c4818604904fe','2021-04-11 08:15:51',1),(74,75,8,13,'2021-04-11 08:13:47','2021-04-11 08:13:47','AVZE4IAX','d83dbd7929be6b0f5cf48cd4526d0c19139d43a6ddde48665f911ad00a9474ed','2021-04-11 08:18:47',0),(75,76,8,13,'2021-04-11 08:21:43','2021-04-11 08:21:51','75_MYLM6UTC','44bd37b1a3663e7595de7f3a6f809fec83b8cc96017c7cd9ed930f42dc7f0a6a','2021-04-11 08:26:43',1),(76,74,8,13,'2021-04-11 08:27:18','2021-04-11 08:27:25','76_C6CHKRK2','515ef27c4d4eddf9fa1fda34168c37f3f0b993e65bda8d996494730db553362e','2021-04-11 08:32:18',1),(77,77,8,13,'2021-04-11 08:28:00','2021-04-11 09:14:43','77_ICNE7CPG','d71f7a6a201e140d567db9b804cba7df5242e703dac5c0a8d0b1747f2ceb96cd','2021-04-11 09:19:42',1),(78,77,8,13,'2021-04-11 09:15:29','2021-04-11 09:15:29','NSBBCPB5','9b43489facad03805b45f321ced6855316a243063e3570757bbbfc89f9a9c2c9','2021-04-11 09:20:29',0),(79,78,8,13,'2021-04-11 09:20:11','2021-04-11 09:20:20','79_D6BFWCBJ','5d8b9ccc99b52e5c1a7b9aa8aea72cc4ed3ced1a9531f2495af0f5007ee0f929','2021-04-11 09:25:11',1),(80,78,8,13,'2021-04-11 09:21:58','2021-04-11 09:21:58','E0IEWU6H','37741364f9d68a78f8e6227063268e3fa92c8b0fb27debf6702df6186f239e34','2021-04-11 09:26:58',0),(81,79,8,13,'2021-04-11 10:23:26','2021-04-11 10:40:12','81_AB2SK9BA','89d54e054f1ba0c88438c03e9677ac6751faffba3e8781b6dbfef33e49daa4af','2021-04-11 10:44:57',1),(82,83,8,13,'2021-04-12 11:34:36','2021-04-12 11:34:39','82_ZR4MJXOV','cb1c89a3ba79609ded5872339f725b4e54f7019d9e8d47b7f8bd5ee83045343e','2021-04-12 11:39:36',1),(83,83,8,13,'2021-04-12 11:35:22','2021-04-12 11:35:22','X4RHF2HR','389d9ab005902263fc95c9cc9d5d671942de801d832cf247b9d0162e07a4aa51','2021-04-12 11:40:22',0),(84,84,8,13,'2021-04-12 11:40:40','2021-04-12 11:40:59','84_EIETHCJE','37edacfa0120a58f036abb331b3e7c88926a3678f3227ece735f61b505dfd0ca','2021-04-12 11:45:54',1),(85,85,8,13,'2021-04-12 11:46:30','2021-04-12 11:47:29','85_Q1TQXGER','2b45395c110ec2de3d02b0ea4389cdfbe197c0423ed35481987c8f98e72c1943','2021-04-12 11:52:21',1),(86,86,8,13,'2021-04-12 11:48:54','2021-04-12 11:49:24','86_RJRKXI8Z','46986df339a4c4ced21d0add325ff5ae382488db53aea688d0e9bed14060bd44','2021-04-12 11:54:22',1),(87,87,8,13,'2021-04-12 11:52:08','2021-04-12 11:55:24','87_HSKBKPQM','4f923f2b56071e4310a82f73d7a866f964302fd0f9df9f7ea7e93c2ad2741155','2021-04-12 12:00:16',1),(88,88,8,13,'2021-04-12 11:57:17','2021-04-12 12:05:04','88_Y1CFUL0O','4c311e155d773b9ba2fac9b186fed8b05d501e13ae4598f404d32291fd6cc0b5','2021-04-12 12:09:58',1),(89,87,8,13,'2021-04-12 12:03:49','2021-04-12 12:03:49','8CJVB4KW','d07a04353de2abcdd6c0e4c20e805a5e3a89b5856dda304144670d7fe19625cf','2021-04-12 12:08:49',0),(90,91,8,13,'2021-04-12 12:23:31','2021-04-12 12:23:33','90_A3MS8PP2','5e839f16c70fcedd3166ec5251b38e09c8ae74d5752829da503de875c58cec89','2021-04-12 12:28:31',1),(91,90,8,13,'2021-04-12 12:51:18','2021-04-12 12:51:18','UO5GVBDO','fe8f52c80114d366c27b115e6fce74791dca597722e4e046513177be1bc83da8','2021-04-12 12:56:18',0),(92,92,8,13,'2021-04-12 13:08:55','2021-04-12 13:09:12','92_SFJVPSMQ','29a19a24b12a3741fd5dfdebc46c1424e8d802392068400e746acc83dc0e2eb6','2021-04-12 13:13:55',1);
/*!40000 ALTER TABLE `tbl_transaction_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `hash_token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expired_token_at` datetime DEFAULT NULL,
  `expired_otp_at` datetime DEFAULT NULL,
  `status` int NOT NULL,
  `country_code` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `otp` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_updated_profile` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_38B383A1F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'2021-04-03 02:57:44','2021-04-03 02:57:44',NULL,'admin@yopmail.com','$2y$13$eOsIO/mjAsQISBQCrd7ZMePYYeODwUu40Pe5d2cXI4jD/0/8T5p9K',NULL,7,NULL,NULL,'2021-05-05 00:00:00',1,NULL,'123456','+84355527245',NULL,NULL),(2,'2021-04-03 04:13:37','2021-04-03 05:08:12',NULL,'1ed1226c02f076e13efd66cb505cc72b@yopmail.com','71e9eaa5573a1b0eb0c01c308ed4634927b1e6b7da027e100a40fcb49ed9fbca',NULL,NULL,NULL,NULL,'2021-04-03 05:13:12',1,'84','9371','0355527245',NULL,NULL),(3,'2021-04-03 05:22:30','2021-04-04 14:27:37',NULL,'tri.test@yopmail.com','3f545354552432f020ce3900836509c1ad97ebac90b3d4483b357a01fcefac60','Tri',NULL,NULL,NULL,'2021-04-04 14:32:37',1,'84','9633','09851212616',NULL,1),(4,'2021-04-04 08:54:30','2021-04-04 08:54:59',NULL,'qmtri091991@gmail.com','$2y$13$f.WdyJyb9Jh5XTsGnENq2OpGSb9pKBm3NmpqXVQJCwmiZPykop60.','Trí Quách',4,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1),(5,'2021-04-04 12:44:33','2021-04-04 12:44:33',NULL,'f4562cb49857d697950062037866b9c9@yopmail.com','ba80f883c2ef64f6da2abe7b6758bd18f8b46b37ac0ccbfc82949787e930dcca',NULL,NULL,NULL,NULL,'2021-04-04 12:49:33',1,'84','1689','908204105',NULL,0),(6,'2021-04-04 12:48:40','2021-04-04 12:48:40',NULL,'b9c1ee57d8045f40ec507bafcb23d90e@yopmail.com','2b7a7771d3ef0e6c664ae69a5c0b85f0878bce1df94abb62fb603a5f48ae0990',NULL,NULL,NULL,NULL,'2021-04-04 12:53:40',1,'84','6820','0908204105',NULL,0),(7,'2021-04-04 15:24:16','2021-04-05 11:36:39',NULL,'tri@yopmail.com','598cb5056307d0316aa13eb4329e12202a9c21f635248c42b9ad584d16c8ca31','Tri',NULL,NULL,NULL,'2021-04-05 11:28:20',1,'84','9057','0375566519666',NULL,1),(8,'2021-04-05 11:54:09','2021-04-12 12:34:21',NULL,'tri@yopnail.com','947468d6e8be20421c63c4c17e00e50aa034174b15ce265d9fc8a4bc0f1e04db','Tri',NULL,NULL,NULL,'2021-04-12 12:39:21',1,'84','8512','0375566519',NULL,1),(9,'2021-04-05 11:55:23','2021-04-05 12:09:48',NULL,'oscar@deskimo.com','ea96ec96124c5a693eb30f0dff6b669fd85581999a2d9918656c50fe9c4455e6','Oscar',NULL,NULL,NULL,'2021-04-05 12:14:48',1,'84','2997','03755664444519',NULL,1),(10,'2021-04-05 12:18:34','2021-04-05 12:18:34',NULL,'008247b697e9e9b78c1a96ca294aa15a@yopmail.com','dd749c7c64789788dd16bc23ae7175c55f11982b4d621cc84a7775a8741d347d',NULL,NULL,NULL,NULL,'2021-04-05 12:23:34',1,'84','5116','0375566515559',NULL,0),(11,'2021-04-05 13:00:38','2021-04-05 13:00:38',NULL,'oscar.lopez.alegre@gmail.com','afbeb969608439fb67542588a97fc1ae9d790b5a5ea1409f42a080f95a7359eb','OSCAR LOPEZ ALEGRE',5,'afbeb969608439fb67542588a97fc1ae9d790b5a5ea1409f42a080f95a7359eb','2021-04-12 13:00:38',NULL,0,NULL,NULL,NULL,NULL,1),(15,'2021-04-07 15:05:37','2021-04-07 15:05:37',NULL,'test1@gmail.com',NULL,'abc',1,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1),(16,'2021-04-07 15:19:57','2021-04-07 15:19:58',NULL,'test1@abc','$2y$13$/lvYbZdIa9wW5uP16CKIoOKuH8HnVgWnO1pxWsqbuXV7aEO/uS6ou','abc',1,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1),(17,'2021-04-07 15:20:45','2021-04-07 15:20:45',NULL,'test@abcd',NULL,'a',1,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,1),(18,'2021-04-09 12:08:40','2021-04-09 12:08:41',NULL,'nghi.truongthi@gmail.com','$2y$13$OVG1qvVok5dzK0lcHe0FKuHfSvQ7BsNDygsmAe0btJ30w2R8oHEpy','abcd',1,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1),(19,'2021-04-09 14:28:45','2021-04-09 14:28:45',NULL,'hfgjsdgh@hfgsdh',NULL,'test',1,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1),(20,'2021-04-11 09:44:14','2021-04-11 09:44:14',NULL,'nghi.truongthi@1',NULL,'nghi',7,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_visit`
--

DROP TABLE IF EXISTS `tbl_visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_visit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_id` int DEFAULT NULL,
  `property_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `code` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_per_hour` double DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `total_time` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `payment_currency` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price` decimal(11,4) DEFAULT NULL,
  `staff_id` int DEFAULT NULL,
  `address` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_reviewed` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ED1AA326427EB8A5` (`request_id`),
  KEY `IDX_ED1AA326549213EC` (`property_id`),
  KEY `IDX_ED1AA326A76ED395` (`user_id`),
  KEY `IDX_ED1AA326D4D57CD` (`staff_id`),
  CONSTRAINT `FK_ED1AA326427EB8A5` FOREIGN KEY (`request_id`) REFERENCES `tbl_visit_request` (`id`),
  CONSTRAINT `FK_ED1AA326549213EC` FOREIGN KEY (`property_id`) REFERENCES `tbl_property` (`id`),
  CONSTRAINT `FK_ED1AA326A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`),
  CONSTRAINT `FK_ED1AA326D4D57CD` FOREIGN KEY (`staff_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_visit`
--

LOCK TABLES `tbl_visit` WRITE;
/*!40000 ALTER TABLE `tbl_visit` DISABLE KEYS */;
INSERT INTO `tbl_visit` VALUES (12,13,6,3,'2021-04-04 08:54:46','2021-04-04 09:00:45','2F2EST','4d58ba045bd51a6893050439ba1814824ff7ae950d13a4b22e9e0d56d7f97172',1,'2021-04-04 08:54:46','2021-04-04 08:54:54',8,2,'SGD','Prop 6',10.0000,1,'12121',NULL),(13,14,6,3,'2021-04-04 09:03:12','2021-04-04 09:08:04','PS5IAO','f79047933106444d3bec1c896c2d03dad6771e07859cfbed5bf458776e5cb611',1000,'2021-04-04 09:03:12','2021-04-04 09:03:25',13,2,'SGD','Prop 6',10.0000,1,'12121',NULL),(14,15,6,3,'2021-04-04 09:10:27','2021-04-04 09:14:01','K0JWNF','8acdcc9eb53c7f3a65020ea81a319a89c445a33a87e62ec7811604065ed410a9',1000,'2021-04-04 09:10:27','2021-04-04 09:10:35',0,2,'SGD','Prop 6',2.2222,1,'12121',NULL),(15,16,6,3,'2021-04-04 09:17:04','2021-04-04 09:18:38','MDIIFV','903b873093097dd0bb802f6d5d07202c71dc2c802a4e5781d8c5221323b0b95b',1000,'2021-04-04 09:17:04','2021-04-04 09:17:44',0,2,'SGD','Prop 6',11.1111,1,'12121',NULL),(16,18,8,3,'2021-04-04 12:08:57','2021-04-04 12:09:21','Z523KZ','3d94e2687b670865c70b59d65991fd5434c7fe9f30dcdcc67c9f1f8a47f1e482',1,'2021-04-04 12:08:57','2021-04-04 12:09:21',0,1,'SGD','Thuan Vo 1000',0.0067,1,'DDA Hotel District 1, De Tham, St, Pham Ngu Lao, District 1, Ho Chi Minh City, Vietnam',NULL),(17,17,6,3,'2021-04-04 12:10:07','2021-04-04 12:10:23','G2XC17','bc036ce1f9212715bd9810425e0b6574951384d5d5a5a39588a982948677e1e9',1000,'2021-04-04 12:10:07','2021-04-04 12:10:19',0,2,'SGD','Prop 6',3.3333,1,'12121',NULL),(18,19,6,3,'2021-04-04 12:12:08','2021-04-04 12:12:27','6TICEK','8330a7308cf145f7d43539ce6e77037d4cc4e1004422dbc259ad31b5ceeb31ca',1000,'2021-04-04 12:12:08','2021-04-04 12:12:23',0,2,'SGD','Prop 6',4.1667,1,'12121',NULL),(19,20,6,3,'2021-04-04 12:12:47','2021-04-04 12:49:46','FYNT5F','cd06eb7c3a817209c4985f63df5c43fc0366a0a4bb0b5322556645cf5b8e351a',1000,'2021-04-04 12:12:47','2021-04-04 12:49:46',0,1,'SGD','Prop 6',616.3889,1,'12121',NULL),(20,21,6,3,'2021-04-04 13:01:49','2021-04-04 13:07:35','DINTUH','b41d03c87690b904c94b2a5e16110b70cc79813c893407ad9c8e3d3c38a29f5d',1000,'2021-04-04 13:01:49','2021-04-04 13:07:35',0,1,'SGD','Prop 6',96.1111,1,'12121',NULL),(21,23,6,3,'2021-04-04 13:10:13','2021-04-04 13:13:29','R2KG4B','23a44bfc1ef04665d3b41170dcedcb8b55a16cc6b5fc605f732c5ef311a96320',1000,'2021-04-04 13:10:13','2021-04-04 13:13:20',0,2,'SGD','Prop 6',51.9444,1,'12121',NULL),(22,24,6,3,'2021-04-04 13:15:47','2021-04-04 13:17:06','RIZDYE','9fb116e43d5c746fd531ed13c6dbea0f46e5fbcea9346f8b39c8e3ec871f008b',1000,'2021-04-04 13:15:47','2021-04-04 13:16:51',0,2,'SGD','Prop 6',17.7778,1,'12121',NULL),(23,25,6,3,'2021-04-04 13:19:48','2021-04-04 13:20:00','6A9FOG','d075ed069263895038fdea7c35808b1571a15eda73c28bbf17feb4fbaf3d99d1',1000,'2021-04-04 13:19:48','2021-04-04 13:20:00',0,1,'SGD','Prop 6',3.3333,1,'12121',NULL),(24,26,12,3,'2021-04-04 14:10:21','2021-04-04 14:42:26','ZINVPF','504cbfb7c5df70b21e7ca9051ad4f85da328d6aebffa736522f738ad2c785bdb',123,'2021-04-04 14:10:21','2021-04-04 14:42:23',0,2,'SGD','asdasd2',65.6683,1,'asda',NULL),(25,22,1,3,'2021-04-04 14:56:29','2021-04-04 15:02:18','UVMAHA','c5dbdbfb4d4275bc34f742294f19936d3716d315f9ebeb0c86ca3934fd612acd',10,'2021-04-04 14:56:29','2021-04-04 15:02:11',0,2,'SGD','The centerpoint 1',0.9500,1,'test',NULL),(26,27,16,3,'2021-04-04 15:17:05','2021-04-04 15:19:18','CWSKF4','dc06768c795b8a6eef9d469eaa378810d4bbdc842a65cfb29dd526f86e4f6fbe',33333333,'2021-04-04 15:17:05','2021-04-04 15:19:18',0,1,'SGD','Thuan Vo',1231481.4692,1,'Clementi Avenue 3, 321 Clementi, Singapore',NULL),(27,28,16,3,'2021-04-04 15:20:16','2021-04-04 15:20:40','1AICYK','86d033b2f1834cc0ede3d60ea8b66ca4f38ed965a7ba977de50b3af114f1afd8',33333333,'2021-04-04 15:20:16','2021-04-04 15:20:37',0,2,'SGD','Thuan Vo',194444.4425,1,'Clementi Avenue 3, 321 Clementi, Singapore',NULL),(28,29,1,3,'2021-04-04 15:22:34','2021-04-04 15:23:16','C5F11Y','7545c514625893203869cdda99b796495cc3eb9e415fb876bdf1971550a807ec',10,'2021-04-04 15:22:34','2021-04-04 15:23:16',0,1,'SGD','The centerpoint 1',0.1167,1,'test',NULL),(29,30,1,7,'2021-04-04 15:25:36','2021-04-04 15:26:06','9AN68B','583e12a5c9cefaa2f5e0185648b12268f457293e12119c3792f5c0585253bca3',10,'2021-04-04 15:25:36','2021-04-04 15:26:06',0,1,'SGD','The centerpoint 1',0.0833,1,'test',NULL),(30,31,1,7,'2021-04-04 15:28:19','2021-04-04 15:28:40','N36D9C','b60a566abd868f5cf5b13ad86739de554846a49817ba22798c507d94ab08cc73',10,'2021-04-04 15:28:19','2021-04-04 15:28:40',0,1,'SGD','The centerpoint 1',0.0583,1,'test',NULL),(31,32,1,7,'2021-04-05 03:30:01','2021-04-05 03:30:25','NDO5LU','c7174cbc78b85e8a630bc6fce81f210b7bcd366bba13a73ef8dd79a689d035ee',10,'2021-04-05 03:30:01','2021-04-05 03:30:25',0,1,'SGD','The centerpoint 1',0.0667,1,'test',NULL),(32,33,1,7,'2021-04-05 04:38:03','2021-04-05 04:38:28','WKZRLR','29f33b1049e7ff5329aa3dbdb634984cd32ccf5ddd8051d9ddfb8aa9cb06aeca',10,'2021-04-05 04:38:03','2021-04-05 04:38:28',0,1,'SGD','The centerpoint 1',0.0694,1,'test',NULL),(33,34,1,7,'2021-04-05 04:53:16','2021-04-05 04:53:38','RUGVGF','b6233ccf0b8111874433ebe8df97ee90187bde323e375998fbd767f9f4582a74',10000,'2021-04-05 04:53:16','2021-04-05 04:53:25',0,2,'SGD','The centerpoint 1',25.0000,1,'test',NULL),(34,35,1,7,'2021-04-05 04:54:29','2021-04-05 04:54:42','NNY9AU','e55bbaed81c194be9c3d8ae9d0bb50a82ce4f33f229c76c49f6c5dd478078134',10000,'2021-04-05 04:54:29','2021-04-05 04:54:38',0,2,'SGD','The centerpoint 1',25.0000,1,'test',NULL),(35,36,1,7,'2021-04-05 04:55:16','2021-04-05 05:01:13','QZNATM','4cd5f8c0a9a721a8f01a6d1ce6d9a9939914be0ceaa8170fb05ae5ee844a378a',10,'2021-04-05 04:55:16','2021-04-05 05:01:13',0,1,'SGD','The centerpoint 1',0.9917,1,'test',NULL),(36,37,1,7,'2021-04-05 05:01:26','2021-04-05 05:01:59','459LFU','d320adc421d598cb53f1ab14f5157e469ebe22ad08f12c69e4891cf9301bd6fe',10,'2021-04-05 05:01:26','2021-04-05 05:01:59',0,1,'SGD','The centerpoint 1',0.0917,1,'test',NULL),(37,38,1,7,'2021-04-05 05:01:48','2021-04-05 05:12:45','1H4FHZ','05f82c3a752551a11d971ce6127de447268bc2d8e9b457b8b1451130808f041f',10,'2021-04-05 05:01:48','2021-04-05 05:12:45',0,1,'SGD','The centerpoint 1',1.8250,1,'test',NULL),(38,39,1,7,'2021-04-05 05:25:25','2021-04-05 05:25:35','0PVMT8','d90931c66d11bda8df3e4b791bb312a392698ab1c408d8459de5fe930d602304',10,'2021-04-05 05:25:25','2021-04-05 05:25:35',0,1,'SGD','The centerpoint 1',0.0278,1,'test',NULL),(39,40,1,7,'2021-04-05 05:26:48','2021-04-05 05:26:59','I9ZMOW','3421745406a69ac338b30cbac16f22b71f7c77d446369f36fc7b3d3fd44c1e8d',10,'2021-04-05 05:26:48','2021-04-05 05:26:59',0,1,'SGD','The centerpoint 1',0.0306,1,'test',NULL),(40,41,1,7,'2021-04-05 05:30:26','2021-04-05 05:31:17','SURPAM','6506061c84400dfb63c82f20c492cc8c05edd6a4b36967e8d3e211bd5f308cba',10,'2021-04-05 05:30:26','2021-04-05 05:31:17',0,1,'SGD','The centerpoint 1',0.1417,1,'test',NULL),(41,42,1,7,'2021-04-05 05:33:45','2021-04-05 05:36:14','KZVHIB','cc531b919cfa95860e3ca44128f02d09ca06c28d4faec47b1e5c5ff65905002d',10,'2021-04-05 05:33:45','2021-04-05 05:36:14',0,1,'SGD','The centerpoint 1',0.4139,1,'test',NULL),(42,43,1,7,'2021-04-05 05:36:28','2021-04-05 05:37:56','DHKHKR','3793135a90f256169bb4e1991448af0d854c272a380ad1cc268b80a7f6777cbc',10,'2021-04-05 05:36:28','2021-04-05 05:37:56',0,1,'SGD','The centerpoint 1',0.2444,1,'test',NULL),(43,44,1,7,'2021-04-05 06:09:45','2021-04-05 06:11:29','NXQHCX','d74ba96e40dfe1d9396bb9f52a5db5750ed0f209f58c3d7b405a7cb861a49c39',10,'2021-04-05 06:09:45','2021-04-05 06:11:29',0,1,'SGD','The centerpoint 1',0.2889,1,'test',NULL),(44,45,1,7,'2021-04-05 06:12:20','2021-04-05 06:12:35','IGNSC0','eada68a97ff560fb0b8049f7f7f6683cf7c4cc1c26a7396fd9d8273f802bed5e',10,'2021-04-05 06:12:20','2021-04-05 06:12:35',0,1,'SGD','The centerpoint 1',0.0417,1,'test',NULL),(45,46,1,7,'2021-04-05 06:17:23','2021-04-05 06:41:27','VCVBK3','f769c4f4e550189b2c8043e5434bad77bb620fbc1339521232d6c501b456181e',10,'2021-04-05 06:17:23','2021-04-05 06:41:00',0,2,'SGD','The centerpoint 1',3.9361,1,'test',NULL),(46,47,1,7,'2021-04-05 06:42:15','2021-04-05 06:43:25','4OYKQG','16a28e26bf97954d92fc077dc65a050824c6cedca47f2c5b07c4803b667d2190',10,'2021-04-05 06:42:15','2021-04-05 06:43:25',0,1,'SGD','The centerpoint 1',0.1944,1,'test',NULL),(47,48,1,7,'2021-04-05 07:21:44','2021-04-05 07:42:54','6R9URZ','66904b0fd8d27286ea704603abb5f8317f356b754db9391a6abf9a8948b99ee6',10,'2021-04-05 07:21:44','2021-04-05 07:42:50',0,2,'SGD','The centerpoint 1',3.5167,1,'test',NULL),(48,49,1,7,'2021-04-05 07:43:20','2021-04-05 09:28:46','IQ9RFY','4c44ba6820e050b65658860f6e22dc913c2e58c6effd26f49c5c33b5d598fdab',10,'2021-04-05 07:43:20','2021-04-05 09:28:41',1,2,'SGD','The centerpoint 1',17.5583,1,'test',NULL),(49,50,1,7,'2021-04-05 10:07:02','2021-04-05 10:08:55','SBEKNW','c99a7e024c50c8064ba759133e8cfdd70fea925888e983cad5d6010902f5600f',10,'2021-04-05 10:07:02','2021-04-05 10:08:55',0,1,'SGD','The centerpoint 1',0.3139,1,'test',NULL),(50,51,1,7,'2021-04-05 10:34:28','2021-04-05 10:34:46','IOV2DU','f1b5478dcf3c516e677ff1783f4db1860f30f6a3e75dbd32ee6ee85abce0b4f2',10,'2021-04-05 10:34:28','2021-04-05 10:34:46',0,1,'SGD','The centerpoint 1',0.0500,1,'test',NULL),(51,52,1,7,'2021-04-05 10:39:37','2021-04-05 10:39:45','J0PEIC','5ae8cbd70cabaa5ed9535e36e3c0ad9d1bc2ebbb224f6f0374ee3859d9360e3d',10,'2021-04-05 10:39:37','2021-04-05 10:39:45',0,1,'SGD','The centerpoint 1',0.0222,1,'test',NULL),(52,53,1,7,'2021-04-05 10:40:13','2021-04-05 10:40:21','AZ5KFN','1b26dab2239b5f79c3142cea924c6a1f0af46c5b0a79a93fd59a7636239bcddb',100,'2021-04-05 10:40:13','2021-04-05 10:40:21',0,1,'SGD','The centerpoint 1',0.2222,1,'test',NULL),(53,54,1,7,'2021-04-05 10:40:41','2021-04-05 10:40:56','VA26QV','452bdd76398a62e634656adbdce49a24129f8be267fd80e0b3649060cca9c8ce',1000,'2021-04-05 10:40:41','2021-04-05 10:40:48',0,2,'SGD','The centerpoint 1',1.9444,1,'test',NULL),(54,55,14,7,'2021-04-05 11:18:43','2021-04-05 11:19:01','CD3JDF','3ede69e770c7decfa922edeea76c01a9fad7f95975046dda41ee48ffb6e0df26',12,'2021-04-05 11:18:43','2021-04-05 11:19:01',0,1,'SGD','asdasd 4',0.0600,1,'123123',NULL),(55,56,1,7,'2021-04-05 11:24:37','2021-04-05 11:25:05','2VGSP1','1e492e77437dee0e9b913bb86f43f0024ef802639fa0435cf5eaf4135221eeb9',1000,'2021-04-05 11:24:37','2021-04-05 11:24:59',0,2,'SGD','The centerpoint 1',6.1111,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(56,57,1,7,'2021-04-05 11:30:14','2021-04-05 11:31:48','SGMCLW','232c9bc460f66436a42a1c6b167cf883f99969df37195e03edb57dc14d37357c',1000,'2021-04-05 11:30:14','2021-04-05 11:31:39',0,2,'SGD','The centerpoint 1',23.6111,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(57,58,1,7,'2021-04-05 11:32:29','2021-04-05 11:32:54','ZKSO2L','4ee119fab1aaf519554c51e2c576bb5a9ae95754bb220545c335b171819204cd',1000,'2021-04-05 11:32:29','2021-04-05 11:32:49',0,2,'SGD','The centerpoint 1',5.5556,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(58,59,1,7,'2021-04-05 11:33:57','2021-04-05 11:34:48','4P2PYV','289ffe4e8eac8fa942c5e51233ea912241a89c554fea429105e16dfd66e46824',1000,'2021-04-05 11:33:57','2021-04-05 11:34:31',0,2,'SGD','The centerpoint 1',9.4444,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(59,60,1,7,'2021-04-05 11:47:43','2021-04-05 11:48:32','EN4CLB','c3be1d4033fb52d2fdec6447c7b26b775e8e80b8c03b68b3bc9d5f44874e7c2c',1000,'2021-04-05 11:47:43','2021-04-05 11:48:30',0,2,'SGD','The centerpoint 1',13.0556,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(60,61,18,9,'2021-04-05 11:56:59','2021-04-05 11:57:30','RUQ0VT','b77b26b260a72851e46a4921494759c0a43b4982d9f4dfebc72929223426ad3f',4,'2021-04-05 11:56:59','2021-04-05 11:57:29',0,1,'SGD','Hive',0.0333,1,'Geylang Serai, Geylang Serai Malay Market and Food Centre, Singapore',NULL),(61,62,18,9,'2021-04-05 11:58:47','2021-04-05 11:58:57','0VECAP','8053c1467b23c5555b9f81fe5b7602180a49533ffa7fe30b16def94b0cd6c143',4000,'2021-04-05 11:58:47','2021-04-05 11:58:55',0,2,'SGD','Hive',8.8889,1,'Geylang Serai, Geylang Serai Malay Market and Food Centre, Singapore',NULL),(62,63,18,9,'2021-04-05 12:12:43','2021-04-05 12:15:04','DWVG7P','ff03c6264e3b8f72423f70a2c4d45b5fb1d16d8300e01bc21ecbf40e661c112e',4000,'2021-04-05 12:12:43','2021-04-05 12:15:03',0,2,'SGD','Hive',155.5556,1,'Geylang Serai, Geylang Serai Malay Market and Food Centre, Singapore',NULL),(63,66,18,8,'2021-04-05 12:23:40','2021-04-05 12:25:50','0B8POG','fafc694dcf3d483e80cd1fc34ac58031658876498acad55e8973319e017c1fa5',4000,'2021-04-05 12:23:40','2021-04-05 12:25:49',0,2,'SGD','Hive',143.3333,1,'Geylang Serai, Geylang Serai Malay Market and Food Centre, Singapore',NULL),(64,67,19,8,'2021-04-07 11:28:18','2021-04-07 11:28:37','LANLXB','914e6d4318aac8637fea2cdddab17cb2b6a6c59be99485071222e6968a6eb3be',2300,'2021-04-07 11:28:18','2021-04-07 11:28:37',0,1,'SGD','Hive 2',12.1389,1,'301 Boon Keng Rd, Singapore 339779',NULL),(65,69,1,8,'2021-04-07 11:29:59','2021-04-07 11:30:18','BGK8HI','ff7b42e20abe22f925d2617cb0cf7f5bc58a4125970cd06b7cbc98d1a3454753',1000,'2021-04-07 11:29:59','2021-04-07 11:30:18',0,1,'SGD','The centerpoint 1',5.2778,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(66,70,18,8,'2021-04-07 11:32:26','2021-04-07 11:32:40','JIFGS5','e372e4bea06113af9f54eba1e207505ea61cb6d94136ea1f9cb390b94da81960',4000,'2021-04-07 11:32:26','2021-04-07 11:32:40',0,1,'SGD','Hive',15.5556,1,'Geylang Serai, Geylang Serai Malay Market and Food Centre, Singapore',NULL),(67,71,1,8,'2021-04-07 11:40:00','2021-04-07 11:40:12','SOVAHR','ffef28f9d58be52e89c6c25ce27b75a33873fdf2ba4a125e122f11902078ccad',1000,'2021-04-07 11:40:00','2021-04-07 11:40:12',0,1,'SGD','The centerpoint 1',3.3333,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(68,73,19,8,'2021-04-09 11:59:49','2021-04-09 12:00:11','UDAPMQ','66155b1ed161d382bdd84bf93281d0e7a478c221cde427e9e71b9337229a85a1',2300,'2021-04-09 11:59:49','2021-04-09 12:00:11',0,1,'SGD','Hive 2',14.0556,1,'301 Boon Keng Rd, Singapore 339779',NULL),(69,74,19,8,'2021-04-09 12:01:01','2021-04-09 12:01:08','MVMLLV','dba2964501cb2f61d01cee09d1b95b979ef8680692574ad67f6d6f91bd88364b',2300,'2021-04-09 12:01:01','2021-04-09 12:01:08',0,1,'SGD','Hive 2',4.4722,1,'301 Boon Keng Rd, Singapore 339779',NULL),(70,75,19,8,'2021-04-09 12:09:37','2021-04-09 12:10:45','S6MKEB','dc525f5232930664545a3b60218cf2adec7ca3a00689a03d16c501d5bf507d29',2300,'2021-04-09 12:09:37','2021-04-09 12:10:45',0,1,'SGD','Hive 2',43.4444,1,'301 Boon Keng Rd, Singapore 339779',NULL),(71,76,19,8,'2021-04-09 12:14:06','2021-04-09 12:14:29','JDAYTN','2549f01def98f36178e571b5ac00e154ea8fe1f6ecd40c8fb0ec9245bb593fa2',2300,'2021-04-09 12:14:06','2021-04-09 12:14:27',0,2,'SGD','Hive 2',13.4167,1,'301 Boon Keng Rd, Singapore 339779',NULL),(72,77,20,8,'2021-04-11 02:11:44','2021-04-11 04:35:20','CJZWNF7S','c3c8c71b9e32ef9a13fbea1214fb6e87afaf8a3bb5531009de7418b388887005',2,'2021-04-11 02:11:44','2021-04-11 04:35:18',2,2,'SGD','test',4.7856,1,NULL,NULL),(73,79,1,8,'2021-04-11 06:34:09','2021-04-11 07:34:28','ABCDEKLM','34343k4j3k4j34k3j434343434343',10,'2021-04-11 06:34:09','2021-04-11 07:34:27',1,2,'SGD','The centerpoint 1',10.0500,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(74,78,1,8,'2021-04-11 08:01:55','2021-04-11 08:27:27','PI19JT8B','afb524c0320abd697398974ac9765c06a4fb66016d2879ffb89b930196213e7d',10,'2021-04-11 08:01:55','2021-04-11 08:27:25',0,2,'SGD','The centerpoint 1',4.2500,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(75,80,1,8,'2021-04-11 08:03:07','2021-04-11 08:10:56','F3WK0NJB','4dcd3667a4660c5a837c5146e9b2b4414ee4d3d6b5cb655cf1c24e0712838d12',10,'2021-04-11 08:03:07','2021-04-11 08:10:55',0,2,'SGD','The centerpoint 1',1.3000,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(76,81,1,8,'2021-04-11 08:15:07','2021-04-11 08:21:52','ECORBESR','02498168b0b30f6fc6c9abd07ead9c038354cdba39f758b5e760dbcd133c8543',10,'2021-04-11 08:15:07','2021-04-11 08:21:51',0,2,'SGD','The centerpoint 1',1.1222,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(77,82,1,8,'2021-04-11 08:18:20','2021-04-11 09:14:45','NL0TZPKH','831651bd24d923beeb907a1aeac87001f94e2563e593d4d019124ee794540373',10,'2021-04-11 08:18:20','2021-04-11 09:14:43',0,2,'SGD','The centerpoint 1',9.3972,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(78,83,8,8,'2021-04-11 09:16:13','2021-04-11 09:20:20','CTAG6RPB','f0db2edaa1401272c1be37e6e51a45c8693639b691f2eb647a52f37ad4eb87fd',1,'2021-04-11 09:16:13','2021-04-11 09:20:20',0,1,'SGD','Thuan Vo 1000',0.0686,1,'DDA Hotel District 1, De Tham, St, Pham Ngu Lao, District 1, Ho Chi Minh City, Vietnam',NULL),(79,84,1,8,'2021-04-11 09:27:24','2021-04-11 10:40:13','KUD24IFV','deebf067f83d4ad84ad32fe46e957b24de328f001b1b336eb22957350903974d',10,'2021-04-11 09:27:24','2021-04-11 10:40:12',1,2,'SGD','The centerpoint 1',12.1333,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(80,85,1,8,'2021-04-11 10:50:20','2021-04-11 10:51:07','JMPTBRQ7','b7f4a3d98522d63d5089ea7e13eef61bc8278b49c5f0ec3e44569095b0cad8b6',10,'2021-04-11 10:50:20','2021-04-11 10:51:07',0,1,'SGD','The centerpoint 1',0.1306,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',NULL),(81,87,7,8,'2021-04-11 10:56:14','2021-04-11 15:39:33','XGQRZIL6','fa4e15c4f9470dc3b5df80b8ec18f8062e1a56eee00c2b346425e3c8bb6f8978',10,'2021-04-11 10:56:14','2021-04-11 15:39:33',4,1,'SGD','Property 4',47.2194,1,'Viettel Tower, Hẻm 285 Cách Mạng Tháng Tám, Phường 12 (Quận 10), District 10, Ho Chi Minh City, Vietnam',NULL),(82,88,8,8,'2021-04-11 11:02:12','2021-04-11 15:54:05','82_U05PLNZ0','01419524e19c26830e3ef3d388cde851c4590d0aa71cc340e58f9f540c9bef75',1,'2021-04-11 11:02:12','2021-04-11 15:54:05',4,1,'SGD','Thuan Vo 1000',4.8647,1,'DDA Hotel District 1, De Tham, St, Pham Ngu Lao, District 1, Ho Chi Minh City, Vietnam',NULL),(83,86,7,8,'2021-04-12 11:31:25','2021-04-12 11:34:41','83_NBNH2UC0','65bf526825a8f01e3918df3b7dbc6c7821c31a139410b340e83d6f18d03360d6',10,'2021-04-12 11:31:25','2021-04-12 11:34:39',0,2,'SGD','Property 4',0.5389,1,'Viettel Tower, Hẻm 285 Cách Mạng Tháng Tám, Phường 12 (Quận 10), District 10, Ho Chi Minh City, Vietnam',0),(84,89,1,8,'2021-04-12 11:38:50','2021-04-12 11:40:59','84_QYC2MDQF','d39c23c33026814869e7f335e05f90efbbe83dcea76eba1d0d9b838e79e20cb4',10,'2021-04-12 11:38:50','2021-04-12 11:40:59',0,1,'SGD','The centerpoint 1',0.3583,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',0),(85,90,1,8,'2021-04-12 11:42:50','2021-04-12 11:47:30','85_R0YIFWYC','608179e944a545164ea919db945c1f6c29c1f914ee1cef7ca7f287c6020bb814',10,'2021-04-12 11:42:50','2021-04-12 11:47:29',0,2,'SGD','The centerpoint 1',0.7750,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',0),(86,91,1,8,'2021-04-12 11:48:45','2021-04-12 11:49:24','86_OUZACHUE','fe7dfa16413c6e9d4ee09d18fc23eb83e175462a855b835ed898ebd516234023',10,'2021-04-12 11:48:45','2021-04-12 11:49:24',0,1,'SGD','The centerpoint 1',0.1083,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',0),(87,92,1,8,'2021-04-12 11:51:34','2021-04-12 11:55:26','87_BQSMJ6ME','a941b6230c483b1dc49fdb34acc4320e03c5b390fa59b4cfa086b3e875af1861',10,'2021-04-12 11:51:34','2021-04-12 11:55:24',0,2,'SGD','The centerpoint 1',0.6389,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',0),(88,93,1,8,'2021-04-12 11:56:26','2021-04-12 12:05:05','88_0VGXYO8Q','37dafe442effe50709fca58f352a112208eba001ee6524295fd784eec476dc3e',10,'2021-04-12 11:56:26','2021-04-12 12:05:04',0,2,'SGD','The centerpoint 1',1.4389,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',0),(89,94,1,8,'2021-04-12 12:13:02','2021-04-12 12:13:29','89_KULLHSFU','69fc81dc99618977eed14f47c9aba15f0e96cff076f8591879e80fdfa8f43b0e',10,'2021-04-12 12:13:02','2021-04-12 12:13:29',0,1,'SGD','The centerpoint 1',0.0750,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',0),(90,95,1,8,'2021-04-12 12:18:51','2021-04-12 12:21:15','90_3A2WTKU7','8d85b91dda82382660e6832d2fa08e746fd8ca50a1052265e334c8731619a363',10,'2021-04-12 12:18:51','2021-04-12 12:21:15',0,1,'SGD','The centerpoint 1',0.4000,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',0),(91,96,1,8,'2021-04-12 12:23:12','2021-04-12 12:23:33','91_49AVQ9QE','553cd30b01661b47e4d432c129601c69cf8ed5e5934252a0026ebee13bd51260',10,'2021-04-12 12:23:12','2021-04-12 12:23:33',0,1,'SGD','The centerpoint 1',0.0583,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',0),(92,97,1,8,'2021-04-12 12:51:55','2021-04-12 13:09:14','92_OOK1ERP0','85d04e4ab6a578a0e5d928be1c10cddc7131dec0fd2ce4641be2814d49d69bdb',10,'2021-04-12 12:51:55','2021-04-12 13:09:12',0,2,'SGD','The centerpoint 1',2.8806,1,'Tannery Lane, Teston Landscape & Contractor, Singapore',0);
/*!40000 ALTER TABLE `tbl_visit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_visit_evaluation`
--

DROP TABLE IF EXISTS `tbl_visit_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_visit_evaluation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `visit_id` int DEFAULT NULL,
  `property_id` int DEFAULT NULL,
  `reviewer_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `star` int DEFAULT NULL,
  `message` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7D15591475FA0FF2` (`visit_id`),
  KEY `IDX_7D155914549213EC` (`property_id`),
  KEY `IDX_7D15591470574616` (`reviewer_id`),
  CONSTRAINT `FK_7D155914549213EC` FOREIGN KEY (`property_id`) REFERENCES `tbl_property` (`id`),
  CONSTRAINT `FK_7D15591470574616` FOREIGN KEY (`reviewer_id`) REFERENCES `tbl_user` (`id`),
  CONSTRAINT `FK_7D15591475FA0FF2` FOREIGN KEY (`visit_id`) REFERENCES `tbl_visit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_visit_evaluation`
--

LOCK TABLES `tbl_visit_evaluation` WRITE;
/*!40000 ALTER TABLE `tbl_visit_evaluation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_visit_evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_visit_request`
--

DROP TABLE IF EXISTS `tbl_visit_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_visit_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `property_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `code` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expired_time` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_748CEE53A76ED395` (`user_id`),
  KEY `IDX_748CEE53549213EC` (`property_id`),
  CONSTRAINT `FK_748CEE53549213EC` FOREIGN KEY (`property_id`) REFERENCES `tbl_property` (`id`),
  CONSTRAINT `FK_748CEE53A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_visit_request`
--

LOCK TABLES `tbl_visit_request` WRITE;
/*!40000 ALTER TABLE `tbl_visit_request` DISABLE KEYS */;
INSERT INTO `tbl_visit_request` VALUES (13,3,6,'2021-04-04 08:54:30','2021-04-04 08:54:46','2F2EST','4d58ba045bd51a6893050439ba1814824ff7ae950d13a4b22e9e0d56d7f97172','2021-04-04 08:59:34',1),(14,3,6,'2021-04-04 09:03:09','2021-04-04 09:03:12','PS5IAO','f79047933106444d3bec1c896c2d03dad6771e07859cfbed5bf458776e5cb611','2021-04-04 09:08:09',1),(15,3,6,'2021-04-04 09:10:19','2021-04-04 09:10:27','K0JWNF','8acdcc9eb53c7f3a65020ea81a319a89c445a33a87e62ec7811604065ed410a9','2021-04-04 09:15:19',1),(16,3,6,'2021-04-04 09:16:59','2021-04-04 09:17:04','MDIIFV','903b873093097dd0bb802f6d5d07202c71dc2c802a4e5781d8c5221323b0b95b','2021-04-04 09:21:59',1),(17,3,6,'2021-04-04 09:26:38','2021-04-04 12:10:07','G2XC17','bc036ce1f9212715bd9810425e0b6574951384d5d5a5a39588a982948677e1e9','2021-04-04 12:15:00',1),(18,3,8,'2021-04-04 10:18:02','2021-04-04 12:08:57','Z523KZ','3d94e2687b670865c70b59d65991fd5434c7fe9f30dcdcc67c9f1f8a47f1e482','2021-04-04 12:13:45',1),(19,3,6,'2021-04-04 12:11:10','2021-04-04 12:12:08','6TICEK','8330a7308cf145f7d43539ce6e77037d4cc4e1004422dbc259ad31b5ceeb31ca','2021-04-04 12:17:06',1),(20,3,6,'2021-04-04 12:12:46','2021-04-04 12:12:47','FYNT5F','cd06eb7c3a817209c4985f63df5c43fc0366a0a4bb0b5322556645cf5b8e351a','2021-04-04 12:17:46',1),(21,3,6,'2021-04-04 13:01:44','2021-04-04 13:01:49','DINTUH','b41d03c87690b904c94b2a5e16110b70cc79813c893407ad9c8e3d3c38a29f5d','2021-04-04 13:06:44',1),(22,3,NULL,'2021-04-04 13:09:51','2021-04-04 14:56:29','UVMAHA','c5dbdbfb4d4275bc34f742294f19936d3716d315f9ebeb0c86ca3934fd612acd','2021-04-04 15:01:14',1),(23,3,6,'2021-04-04 13:10:01','2021-04-04 13:10:13','R2KG4B','23a44bfc1ef04665d3b41170dcedcb8b55a16cc6b5fc605f732c5ef311a96320','2021-04-04 13:15:01',1),(24,3,6,'2021-04-04 13:15:45','2021-04-04 13:15:47','RIZDYE','9fb116e43d5c746fd531ed13c6dbea0f46e5fbcea9346f8b39c8e3ec871f008b','2021-04-04 13:20:45',1),(25,3,6,'2021-04-04 13:18:55','2021-04-04 13:19:48','6A9FOG','d075ed069263895038fdea7c35808b1571a15eda73c28bbf17feb4fbaf3d99d1','2021-04-04 13:24:46',1),(26,3,12,'2021-04-04 14:10:11','2021-04-04 14:10:21','ZINVPF','504cbfb7c5df70b21e7ca9051ad4f85da328d6aebffa736522f738ad2c785bdb','2021-04-04 14:15:11',1),(27,3,16,'2021-04-04 15:08:56','2021-04-04 15:17:05','CWSKF4','dc06768c795b8a6eef9d469eaa378810d4bbdc842a65cfb29dd526f86e4f6fbe','2021-04-04 15:21:58',1),(28,3,16,'2021-04-04 15:20:08','2021-04-04 15:20:16','1AICYK','86d033b2f1834cc0ede3d60ea8b66ca4f38ed965a7ba977de50b3af114f1afd8','2021-04-04 15:25:08',1),(29,3,NULL,'2021-04-04 15:22:22','2021-04-04 15:22:34','C5F11Y','7545c514625893203869cdda99b796495cc3eb9e415fb876bdf1971550a807ec','2021-04-04 15:27:22',1),(30,7,NULL,'2021-04-04 15:25:27','2021-04-04 15:25:36','9AN68B','583e12a5c9cefaa2f5e0185648b12268f457293e12119c3792f5c0585253bca3','2021-04-04 15:30:27',1),(31,7,NULL,'2021-04-04 15:28:14','2021-04-04 15:28:19','N36D9C','b60a566abd868f5cf5b13ad86739de554846a49817ba22798c507d94ab08cc73','2021-04-04 15:33:14',1),(32,7,NULL,'2021-04-05 03:24:41','2021-04-05 03:30:01','NDO5LU','c7174cbc78b85e8a630bc6fce81f210b7bcd366bba13a73ef8dd79a689d035ee','2021-04-05 03:30:02',1),(33,7,NULL,'2021-04-05 03:50:14','2021-04-05 04:38:03','WKZRLR','29f33b1049e7ff5329aa3dbdb634984cd32ccf5ddd8051d9ddfb8aa9cb06aeca','2021-04-05 04:42:58',1),(34,7,NULL,'2021-04-05 04:43:09','2021-04-05 04:53:16','RUGVGF','b6233ccf0b8111874433ebe8df97ee90187bde323e375998fbd767f9f4582a74','2021-04-05 04:58:13',1),(35,7,NULL,'2021-04-05 04:54:27','2021-04-05 04:54:29','NNY9AU','e55bbaed81c194be9c3d8ae9d0bb50a82ce4f33f229c76c49f6c5dd478078134','2021-04-05 04:59:27',1),(36,7,NULL,'2021-04-05 04:55:13','2021-04-05 04:55:16','QZNATM','4cd5f8c0a9a721a8f01a6d1ce6d9a9939914be0ceaa8170fb05ae5ee844a378a','2021-04-05 05:00:13',1),(37,7,NULL,'2021-04-05 05:01:19','2021-04-05 05:01:26','459LFU','d320adc421d598cb53f1ab14f5157e469ebe22ad08f12c69e4891cf9301bd6fe','2021-04-05 05:06:19',1),(38,7,NULL,'2021-04-05 05:01:41','2021-04-05 05:01:48','1H4FHZ','05f82c3a752551a11d971ce6127de447268bc2d8e9b457b8b1451130808f041f','2021-04-05 05:06:41',1),(39,7,NULL,'2021-04-05 05:13:30','2021-04-05 05:25:25','0PVMT8','d90931c66d11bda8df3e4b791bb312a392698ab1c408d8459de5fe930d602304','2021-04-05 05:30:18',1),(40,7,NULL,'2021-04-05 05:26:44','2021-04-05 05:26:48','I9ZMOW','3421745406a69ac338b30cbac16f22b71f7c77d446369f36fc7b3d3fd44c1e8d','2021-04-05 05:31:44',1),(41,7,NULL,'2021-04-05 05:27:24','2021-04-05 05:30:26','SURPAM','6506061c84400dfb63c82f20c492cc8c05edd6a4b36967e8d3e211bd5f308cba','2021-04-05 05:35:17',1),(42,7,NULL,'2021-04-05 05:33:42','2021-04-05 05:33:45','KZVHIB','cc531b919cfa95860e3ca44128f02d09ca06c28d4faec47b1e5c5ff65905002d','2021-04-05 05:38:42',1),(43,7,NULL,'2021-04-05 05:36:22','2021-04-05 05:36:28','DHKHKR','3793135a90f256169bb4e1991448af0d854c272a380ad1cc268b80a7f6777cbc','2021-04-05 05:41:22',1),(44,7,NULL,'2021-04-05 06:09:43','2021-04-05 06:09:45','NXQHCX','d74ba96e40dfe1d9396bb9f52a5db5750ed0f209f58c3d7b405a7cb861a49c39','2021-04-05 06:14:43',1),(45,7,NULL,'2021-04-05 06:12:12','2021-04-05 06:12:20','IGNSC0','eada68a97ff560fb0b8049f7f7f6683cf7c4cc1c26a7396fd9d8273f802bed5e','2021-04-05 06:17:12',1),(46,7,NULL,'2021-04-05 06:16:13','2021-04-05 06:17:23','VCVBK3','f769c4f4e550189b2c8043e5434bad77bb620fbc1339521232d6c501b456181e','2021-04-05 06:22:09',1),(47,7,NULL,'2021-04-05 06:42:06','2021-04-05 06:42:15','4OYKQG','16a28e26bf97954d92fc077dc65a050824c6cedca47f2c5b07c4803b667d2190','2021-04-05 06:47:06',1),(48,7,NULL,'2021-04-05 07:15:20','2021-04-05 07:21:44','6R9URZ','66904b0fd8d27286ea704603abb5f8317f356b754db9391a6abf9a8948b99ee6','2021-04-05 07:26:41',1),(49,7,NULL,'2021-04-05 07:43:16','2021-04-05 07:43:20','IQ9RFY','4c44ba6820e050b65658860f6e22dc913c2e58c6effd26f49c5c33b5d598fdab','2021-04-05 07:48:16',1),(50,7,NULL,'2021-04-05 10:06:51','2021-04-05 10:07:02','SBEKNW','c99a7e024c50c8064ba759133e8cfdd70fea925888e983cad5d6010902f5600f','2021-04-05 10:11:51',1),(51,7,NULL,'2021-04-05 10:34:07','2021-04-05 10:34:28','IOV2DU','f1b5478dcf3c516e677ff1783f4db1860f30f6a3e75dbd32ee6ee85abce0b4f2','2021-04-05 10:39:26',1),(52,7,NULL,'2021-04-05 10:39:35','2021-04-05 10:39:37','J0PEIC','5ae8cbd70cabaa5ed9535e36e3c0ad9d1bc2ebbb224f6f0374ee3859d9360e3d','2021-04-05 10:44:35',1),(53,7,NULL,'2021-04-05 10:40:10','2021-04-05 10:40:13','AZ5KFN','1b26dab2239b5f79c3142cea924c6a1f0af46c5b0a79a93fd59a7636239bcddb','2021-04-05 10:45:10',1),(54,7,NULL,'2021-04-05 10:40:39','2021-04-05 10:40:41','VA26QV','452bdd76398a62e634656adbdce49a24129f8be267fd80e0b3649060cca9c8ce','2021-04-05 10:45:39',1),(55,7,14,'2021-04-05 10:41:17','2021-04-05 11:18:43','CD3JDF','3ede69e770c7decfa922edeea76c01a9fad7f95975046dda41ee48ffb6e0df26','2021-04-05 11:19:54',1),(56,7,NULL,'2021-04-05 11:24:27','2021-04-05 11:24:37','2VGSP1','1e492e77437dee0e9b913bb86f43f0024ef802639fa0435cf5eaf4135221eeb9','2021-04-05 11:29:27',1),(57,7,NULL,'2021-04-05 11:30:04','2021-04-05 11:30:14','SGMCLW','232c9bc460f66436a42a1c6b167cf883f99969df37195e03edb57dc14d37357c','2021-04-05 11:35:04',1),(58,7,NULL,'2021-04-05 11:32:27','2021-04-05 11:32:29','ZKSO2L','4ee119fab1aaf519554c51e2c576bb5a9ae95754bb220545c335b171819204cd','2021-04-05 11:37:27',1),(59,7,NULL,'2021-04-05 11:33:55','2021-04-05 11:33:57','4P2PYV','289ffe4e8eac8fa942c5e51233ea912241a89c554fea429105e16dfd66e46824','2021-04-05 11:38:55',1),(60,7,NULL,'2021-04-05 11:45:28','2021-04-05 11:47:43','EN4CLB','c3be1d4033fb52d2fdec6447c7b26b775e8e80b8c03b68b3bc9d5f44874e7c2c','2021-04-05 11:50:28',1),(61,9,NULL,'2021-04-05 11:56:30','2021-04-05 11:56:59','RUQ0VT','b77b26b260a72851e46a4921494759c0a43b4982d9f4dfebc72929223426ad3f','2021-04-05 12:01:30',1),(62,9,NULL,'2021-04-05 11:58:40','2021-04-05 11:58:47','0VECAP','8053c1467b23c5555b9f81fe5b7602180a49533ffa7fe30b16def94b0cd6c143','2021-04-05 12:03:40',1),(63,9,18,'2021-04-05 12:11:47','2021-04-05 12:12:43','DWVG7P','ff03c6264e3b8f72423f70a2c4d45b5fb1d16d8300e01bc21ecbf40e661c112e','2021-04-05 12:16:47',1),(64,10,NULL,'2021-04-05 12:19:48','2021-04-05 12:22:21','EFDOD3','142592043ff0f52acd6121a6b37deec22de45e8979bc635c1f1e7407bd163bcf','2021-04-05 12:27:21',0),(65,10,18,'2021-04-05 12:21:33','2021-04-05 12:21:33','RQRAPI','c9c66c30c4b1a8e27451af1ca692d00e0b4fb808a701561b4314aa483b5219c4','2021-04-05 12:26:33',0),(66,8,NULL,'2021-04-05 12:23:31','2021-04-05 12:23:40','0B8POG','fafc694dcf3d483e80cd1fc34ac58031658876498acad55e8973319e017c1fa5','2021-04-05 12:28:31',1),(67,8,19,'2021-04-05 12:44:18','2021-04-07 11:28:18','LANLXB','914e6d4318aac8637fea2cdddab17cb2b6a6c59be99485071222e6968a6eb3be','2021-04-07 11:33:14',1),(68,3,NULL,'2021-04-06 09:59:53','2021-04-09 09:20:18','TT02VD','c82b0396f7b08f548818f2ad00c08c19d6d22326851e67b7de13a4394afc9299','2021-04-09 09:25:18',0),(69,8,NULL,'2021-04-07 11:29:55','2021-04-07 11:29:59','BGK8HI','ff7b42e20abe22f925d2617cb0cf7f5bc58a4125970cd06b7cbc98d1a3454753','2021-04-07 11:34:55',1),(70,8,18,'2021-04-07 11:32:23','2021-04-07 11:32:26','JIFGS5','e372e4bea06113af9f54eba1e207505ea61cb6d94136ea1f9cb390b94da81960','2021-04-07 11:37:23',1),(71,8,NULL,'2021-04-07 11:39:39','2021-04-07 11:40:00','SOVAHR','ffef28f9d58be52e89c6c25ce27b75a33873fdf2ba4a125e122f11902078ccad','2021-04-07 11:44:39',1),(72,7,NULL,'2021-04-07 13:24:36','2021-04-07 14:32:35','U5JMXA','1cf898a1df529061bc533a7e58dd74efb8ad4f2705ddc88b6d721afd4183f2c2','2021-04-07 14:37:35',0),(73,8,NULL,'2021-04-09 11:58:53','2021-04-09 11:59:49','UDAPMQ','66155b1ed161d382bdd84bf93281d0e7a478c221cde427e9e71b9337229a85a1','2021-04-09 12:04:48',1),(74,8,19,'2021-04-09 12:00:57','2021-04-09 12:01:01','MVMLLV','dba2964501cb2f61d01cee09d1b95b979ef8680692574ad67f6d6f91bd88364b','2021-04-09 12:05:57',1),(75,8,NULL,'2021-04-09 12:09:36','2021-04-09 12:09:37','S6MKEB','dc525f5232930664545a3b60218cf2adec7ca3a00689a03d16c501d5bf507d29','2021-04-09 12:14:36',1),(76,8,NULL,'2021-04-09 12:14:04','2021-04-09 12:14:06','JDAYTN','2549f01def98f36178e571b5ac00e154ea8fe1f6ecd40c8fb0ec9245bb593fa2','2021-04-09 12:19:04',1),(77,8,20,'2021-04-11 02:01:45','2021-04-11 02:11:44','77_CJZWNF7S','c3c8c71b9e32ef9a13fbea1214fb6e87afaf8a3bb5531009de7418b388887005','2021-04-11 02:16:42',1),(78,8,NULL,'2021-04-11 06:00:34','2021-04-11 08:01:55','78_PI19JT8B','afb524c0320abd697398974ac9765c06a4fb66016d2879ffb89b930196213e7d','2021-04-11 08:06:37',1),(79,10,NULL,'2021-04-04 08:54:30','2021-04-11 06:34:09','79_ABCDEKLM','34343k4j3k4j34k3j434343434343','2021-04-04 08:59:34',1),(80,8,NULL,'2021-04-11 08:02:39','2021-04-11 08:03:07','80_F3WK0NJB','4dcd3667a4660c5a837c5146e9b2b4414ee4d3d6b5cb655cf1c24e0712838d12','2021-04-11 08:07:39',1),(81,8,NULL,'2021-04-11 08:04:14','2021-04-11 08:15:07','81_ECORBESR','02498168b0b30f6fc6c9abd07ead9c038354cdba39f758b5e760dbcd133c8543','2021-04-11 08:19:54',1),(82,8,NULL,'2021-04-11 08:17:57','2021-04-11 08:18:20','82_NL0TZPKH','831651bd24d923beeb907a1aeac87001f94e2563e593d4d019124ee794540373','2021-04-11 08:22:57',1),(83,8,8,'2021-04-11 08:20:32','2021-04-11 09:16:13','83_CTAG6RPB','f0db2edaa1401272c1be37e6e51a45c8693639b691f2eb647a52f37ad4eb87fd','2021-04-11 09:20:56',1),(84,8,NULL,'2021-04-11 09:26:53','2021-04-11 09:27:24','84_KUD24IFV','deebf067f83d4ad84ad32fe46e957b24de328f001b1b336eb22957350903974d','2021-04-11 09:31:53',1),(85,8,NULL,'2021-04-11 10:49:22','2021-04-11 10:50:20','85_JMPTBRQ7','b7f4a3d98522d63d5089ea7e13eef61bc8278b49c5f0ec3e44569095b0cad8b6','2021-04-11 10:55:17',1),(86,8,7,'2021-04-11 10:55:17','2021-04-12 11:31:25','86_NBNH2UC0','65bf526825a8f01e3918df3b7dbc6c7821c31a139410b340e83d6f18d03360d6','2021-04-12 11:36:11',1),(87,8,7,'2021-04-11 10:56:12','2021-04-11 10:56:14','87_XGQRZIL6','fa4e15c4f9470dc3b5df80b8ec18f8062e1a56eee00c2b346425e3c8bb6f8978','2021-04-11 11:01:12',1),(88,8,8,'2021-04-11 11:02:10','2021-04-11 11:02:12','88_U05PLNZ0','01419524e19c26830e3ef3d388cde851c4590d0aa71cc340e58f9f540c9bef75','2021-04-11 11:07:10',1),(89,8,NULL,'2021-04-12 11:37:16','2021-04-12 11:38:50','89_QYC2MDQF','d39c23c33026814869e7f335e05f90efbbe83dcea76eba1d0d9b838e79e20cb4','2021-04-12 11:43:18',1),(90,8,NULL,'2021-04-12 11:39:55','2021-04-12 11:42:50','90_R0YIFWYC','608179e944a545164ea919db945c1f6c29c1f914ee1cef7ca7f287c6020bb814','2021-04-12 11:47:46',1),(91,8,NULL,'2021-04-12 11:48:43','2021-04-12 11:48:45','91_OUZACHUE','fe7dfa16413c6e9d4ee09d18fc23eb83e175462a855b835ed898ebd516234023','2021-04-12 11:53:43',1),(92,8,NULL,'2021-04-12 11:50:09','2021-04-12 11:51:34','92_BQSMJ6ME','a941b6230c483b1dc49fdb34acc4320e03c5b390fa59b4cfa086b3e875af1861','2021-04-12 11:56:22',1),(93,8,NULL,'2021-04-12 11:56:23','2021-04-12 11:56:26','93_0VGXYO8Q','37dafe442effe50709fca58f352a112208eba001ee6524295fd784eec476dc3e','2021-04-12 12:01:23',1),(94,8,NULL,'2021-04-12 12:11:46','2021-04-12 12:13:02','94_KULLHSFU','69fc81dc99618977eed14f47c9aba15f0e96cff076f8591879e80fdfa8f43b0e','2021-04-12 12:16:46',1),(95,8,NULL,'2021-04-12 12:17:49','2021-04-12 12:18:51','95_3A2WTKU7','8d85b91dda82382660e6832d2fa08e746fd8ca50a1052265e334c8731619a363','2021-04-12 12:23:36',1),(96,8,NULL,'2021-04-12 12:21:54','2021-04-12 12:23:12','96_49AVQ9QE','553cd30b01661b47e4d432c129601c69cf8ed5e5934252a0026ebee13bd51260','2021-04-12 12:28:10',1),(97,8,NULL,'2021-04-12 12:51:41','2021-04-12 12:51:55','97_OOK1ERP0','85d04e4ab6a578a0e5d928be1c10cddc7131dec0fd2ce4641be2814d49d69bdb','2021-04-12 12:56:41',1),(98,8,NULL,'2021-04-12 13:09:45','2021-04-12 13:22:20','FCUOX3US','1087787bf2c53757ffb89bc8bd5141ede9325a235eb30627e31ec98fa6b7d8ee','2021-04-12 13:27:20',0);
/*!40000 ALTER TABLE `tbl_visit_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_visit_tracking`
--

DROP TABLE IF EXISTS `tbl_visit_tracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_visit_tracking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `visit_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `code` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expired_time` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3AE1F7E675FA0FF2` (`visit_id`),
  CONSTRAINT `FK_3AE1F7E675FA0FF2` FOREIGN KEY (`visit_id`) REFERENCES `tbl_visit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_visit_tracking`
--

LOCK TABLES `tbl_visit_tracking` WRITE;
/*!40000 ALTER TABLE `tbl_visit_tracking` DISABLE KEYS */;
INSERT INTO `tbl_visit_tracking` VALUES (1,NULL,'2021-04-04 14:28:20','2021-04-04 14:28:20','ZZ6JGV','0bbf2bc66018cc56f645b1cdb5488d6feabb38e45a100ed2ac09231b606dffb7','2021-04-04 14:33:20',0),(2,NULL,'2021-04-04 14:30:33','2021-04-04 14:30:33','OSBMDD','4dafbc32ab7b0bf0d73b54059bdca5e13ce5af70d8417a05dfdef4ccf9d59f57','2021-04-04 14:35:33',0),(3,NULL,'2021-04-04 14:30:42','2021-04-04 14:30:42','RKUHN4','c47236c1f3245a4146404d27cdf8d76f6d8f71ac9283a48f8563f937493ad892','2021-04-04 14:35:42',0),(4,NULL,'2021-04-04 14:30:49','2021-04-04 14:30:49','VL7JFK','7e968d6aa66a163e7c2102ee663e7bc14b9ec3ca2ab1338dd22608329fbb55d4','2021-04-04 14:35:49',0),(5,NULL,'2021-04-04 14:31:05','2021-04-04 14:31:05','XSEKXJ','c1444319a01997d811f3620705dd904800ae88efc65707198636176a52667f9c','2021-04-04 14:36:05',0),(6,NULL,'2021-04-04 14:32:18','2021-04-04 14:32:18','MFZFEC','3e5229d4a8e8bec1d7b43a28560bb10fd780f0328834bb5c1ec3e327c70d2261','2021-04-04 14:37:18',0),(7,24,'2021-04-04 14:35:42','2021-04-04 14:42:06','IPEZSW','91e3fa188efa84f157c137512109a340326bccbb0cc8d56ca3738dc1623779b6','2021-04-04 14:47:03',1),(8,26,'2021-04-04 15:17:35','2021-04-04 15:17:38','8RL7ZY','baf3a3d9bcd3a379e7426d73429d2080e520aad7c293dba024cd2b8fa207246d','2021-04-04 15:22:35',1),(9,26,'2021-04-04 15:18:11','2021-04-04 15:18:41','C0K9DG','37bdf80e42a176141cce53e8ff485cf69ac24bfb642af61e218ae30d825e3c19','2021-04-04 15:23:11',1),(10,26,'2021-04-04 15:18:46','2021-04-04 15:18:56','DTPGLW','d87349719703b35e81537a355fb92e13e696e4e90d1e1f6b760e5699b6cb982f','2021-04-04 15:23:56',0),(11,27,'2021-04-04 15:20:22','2021-04-04 15:20:25','XP2MZM','5f6fe01aa734369cfab41a2e642a5376ccec083ac38f1d74e60c33941d3f3ae1','2021-04-04 15:25:22',1),(12,27,'2021-04-04 15:20:28','2021-04-04 15:20:30','MTKOBS','5d1707c2c028bb77ed193063c656e8b836af0a286c8916564e483ecbdc1c43d4','2021-04-04 15:25:28',1),(13,27,'2021-04-04 15:20:33','2021-04-04 15:20:35','RLI9HG','1587232d9d2e79d8633d17d458e72b04498772cbf6adbf9b12bd81dce4fe10b7','2021-04-04 15:25:33',1),(14,29,'2021-04-04 15:25:48','2021-04-04 15:25:49','J9QRNI','2a11b24694d20e05151a7ea9a1968cec453069ba81938c2c9380e4af2f24904d','2021-04-04 15:30:48',1),(15,32,'2021-04-05 04:38:18','2021-04-05 04:38:20','BMAHM0','225303d4aea08ea33bd12a3643590d41f7fb5299f6d02d637462a5e8e8fb1a86','2021-04-05 04:43:18',1),(16,45,'2021-04-05 06:19:10','2021-04-05 06:39:57','7XKUFK','19568d409df88e1c31bf78c7aa4dfa49ce2eda38d82398dc83401cd6b04bb347','2021-04-05 06:44:57',0),(17,48,'2021-04-05 08:55:14','2021-04-05 08:55:14','EUECI5','786bb41cfd74258caf02c4d57ba269f97ddd5bfe16a5e9cb143dfbf5ec6fc5c0','2021-04-05 09:00:14',0),(18,49,'2021-04-05 10:08:41','2021-04-05 10:08:48','BMKOGW','79b9dfa274c7aaad7f3c76546e9691a6e5200b358ef2e11c4567f41841c147d2','2021-04-05 10:13:41',1),(19,50,'2021-04-05 10:34:38','2021-04-05 10:34:40','EZE9HT','1b7d229acc2a94adc62c6adf1f9cd879f6e70940d25af877766c86f1a5847ce2','2021-04-05 10:39:38',1),(20,62,'2021-04-05 12:14:06','2021-04-05 12:14:49','LMUIYS','8e7b142e8811d4e6f7c54965668a66a3609c3fe5289004024aaffc091cc96c94','2021-04-05 12:19:49',0),(21,64,'2021-04-07 11:28:26','2021-04-07 11:28:28','FTPBYC','097edddd4da4edab8e1952f7ec3e08315f3a70ab7aa11ae9f59ff12c53f62ad7','2021-04-07 11:33:26',1),(22,65,'2021-04-07 11:30:03','2021-04-07 11:30:06','RO10DU','93554115445af7eb79e6bb846234e417026ec4644de09f5e95962c69b31853d6','2021-04-07 11:35:03',1),(23,66,'2021-04-07 11:32:33','2021-04-07 11:32:35','G83LSZ','db570fd4b23365cf03259ab66b1a2dac375107998c3a4a35e371c9de59acaf2d','2021-04-07 11:37:33',1),(24,68,'2021-04-09 12:00:00','2021-04-09 12:00:02','NKPRYA','20d3ae435ef0ffedf4867d64d4a0ca769b1fb4e971ee464f7dfcbe2c938f559e','2021-04-09 12:05:00',1),(25,72,'2021-04-11 04:18:58','2021-04-11 04:18:58','51FIBE3Y','1c0d79001d742a0ec14b61a8b987a20d1d2f6d41a867f4efa1b3294d52e4aa4b','2021-04-11 04:23:58',0),(26,75,'2021-04-11 08:10:16','2021-04-11 08:10:19','G9GJSJ1H','36e87baf6f6f0594dedbfcf1e12fe8d11192d793fbeb53778f821091e1b5711b','2021-04-11 08:15:16',1),(27,75,'2021-04-11 08:10:44','2021-04-11 08:10:46','ZTNCGIU9','f2fd20307a8c117dbbef3d408b60e31c8e61e546f6d9c9b7735af8c4e14d8869','2021-04-11 08:15:44',1),(28,79,'2021-04-11 10:32:51','2021-04-11 10:39:25','UNZ8EPOP','7a1f435183bf45bb89dd3668dd7916bd8d4c8ee9d7a355127fc203778a1d8abe','2021-04-11 10:44:25',0),(29,81,'2021-04-11 11:02:30','2021-04-11 11:03:27','NIVT4QWN','efdbec30a89365144fe0f27f64fa85931aa0d8cb8d24409c0bb82741dc8d1f27','2021-04-11 11:08:27',0),(30,85,'2021-04-12 11:44:09','2021-04-12 11:46:02','EMFQ58EF','02d2542d809e32273acfd4b774d05b05e9f4cfd5489ca0698c1705373bd84219','2021-04-12 11:51:02',0),(31,92,'2021-04-12 13:08:51','2021-04-12 13:08:51','X5MHBJRU','cc350c46d4ec254e841adfc357ffe40ea5f39cbad341b29be5e3c507ed79aa68','2021-04-12 13:13:51',0);
/*!40000 ALTER TABLE `tbl_visit_tracking` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-12 21:02:10
