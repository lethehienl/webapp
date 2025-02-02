/*
 Navicat MySQL Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 80023
 Source Host           : 127.0.0.1:3306
 Source Schema         : deskimo

 Target Server Type    : MySQL
 Target Server Version : 80023
 File Encoding         : 65001

 Date: 30/03/2021 19:46:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_amenity
-- ----------------------------
DROP TABLE IF EXISTS `tbl_amenity`;
CREATE TABLE `tbl_amenity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `code` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `icon_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `icon_key` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_F033711777153098` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_amenity
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_customer_payment_gateway
-- ----------------------------
DROP TABLE IF EXISTS `tbl_customer_payment_gateway`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_customer_payment_gateway
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_oauth2_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `tbl_oauth2_access_tokens`;
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

-- ----------------------------
-- Records of tbl_oauth2_access_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_oauth2_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_oauth2_auth_codes`;
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

-- ----------------------------
-- Records of tbl_oauth2_auth_codes
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_oauth2_clients
-- ----------------------------
DROP TABLE IF EXISTS `tbl_oauth2_clients`;
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

-- ----------------------------
-- Records of tbl_oauth2_clients
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_oauth2_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `tbl_oauth2_refresh_tokens`;
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

-- ----------------------------
-- Records of tbl_oauth2_refresh_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_payment_activity
-- ----------------------------
DROP TABLE IF EXISTS `tbl_payment_activity`;
CREATE TABLE `tbl_payment_activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `payment_info_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `log` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_E66CC94044C2CF12` (`payment_info_id`),
  CONSTRAINT `FK_E66CC94044C2CF12` FOREIGN KEY (`payment_info_id`) REFERENCES `tbl_payment_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_payment_activity
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_payment_info
-- ----------------------------
DROP TABLE IF EXISTS `tbl_payment_info`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_payment_info
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_property
-- ----------------------------
DROP TABLE IF EXISTS `tbl_property`;
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DCC1FAF377153098` (`code`),
  KEY `IDX_DCC1FAF3979B1AD6` (`company_id`),
  CONSTRAINT `FK_DCC1FAF3979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `tbl_property_company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_property
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_property_amenity
-- ----------------------------
DROP TABLE IF EXISTS `tbl_property_amenity`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_property_amenity
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_property_company
-- ----------------------------
DROP TABLE IF EXISTS `tbl_property_company`;
CREATE TABLE `tbl_property_company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `share_revenue_percent` double DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_property_company
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_property_company_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_property_company_user`;
CREATE TABLE `tbl_property_company_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `property_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B8410151549213EC` (`property_id`),
  KEY `IDX_B8410151A76ED395` (`user_id`),
  CONSTRAINT `FK_B8410151549213EC` FOREIGN KEY (`property_id`) REFERENCES `tbl_property` (`id`),
  CONSTRAINT `FK_B8410151A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_property_company_user
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_property_picture
-- ----------------------------
DROP TABLE IF EXISTS `tbl_property_picture`;
CREATE TABLE `tbl_property_picture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `property_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `file_key` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_45C88783549213EC` (`property_id`),
  CONSTRAINT `FK_45C88783549213EC` FOREIGN KEY (`property_id`) REFERENCES `tbl_property` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_property_picture
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_property_staff
-- ----------------------------
DROP TABLE IF EXISTS `tbl_property_staff`;
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

-- ----------------------------
-- Records of tbl_property_staff
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `tbl_role_permission`;
CREATE TABLE `tbl_role_permission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_role_permission
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_transaction
-- ----------------------------
DROP TABLE IF EXISTS `tbl_transaction`;
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
  PRIMARY KEY (`id`),
  KEY `IDX_F556E549427EB8A5` (`request_id`),
  KEY `IDX_F556E54944C2CF12` (`payment_info_id`),
  KEY `IDX_F556E54975FA0FF2` (`visit_id`),
  CONSTRAINT `FK_F556E549427EB8A5` FOREIGN KEY (`request_id`) REFERENCES `tbl_transaction_request` (`id`),
  CONSTRAINT `FK_F556E54944C2CF12` FOREIGN KEY (`payment_info_id`) REFERENCES `tbl_payment_info` (`id`),
  CONSTRAINT `FK_F556E54975FA0FF2` FOREIGN KEY (`visit_id`) REFERENCES `tbl_visit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_transaction
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_transaction_activity
-- ----------------------------
DROP TABLE IF EXISTS `tbl_transaction_activity`;
CREATE TABLE `tbl_transaction_activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `log` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3EEF86442FC0CB0F` (`transaction_id`),
  CONSTRAINT `FK_3EEF86442FC0CB0F` FOREIGN KEY (`transaction_id`) REFERENCES `tbl_transaction` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_transaction_activity
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_transaction_request
-- ----------------------------
DROP TABLE IF EXISTS `tbl_transaction_request`;
CREATE TABLE `tbl_transaction_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `visit_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expired_date` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_72960A5375FA0FF2` (`visit_id`),
  CONSTRAINT `FK_72960A5375FA0FF2` FOREIGN KEY (`visit_id`) REFERENCES `tbl_visit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_transaction_request
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
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
  `status` int NOT NULL,
  `otp` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_38B383A1F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
BEGIN;
INSERT INTO `tbl_user` VALUES (1, '2020-10-10 00:00:00', '2020-10-10 00:00:00', NULL, 'admin@yopmail.com', '$2y$12$EKqDbk9nQYBJ9yQrYzPxA.8ZQK4KiZo7RUldKsMX51HpSMxAGHpU.', 'Admin', 7, '$2y$12$EKqDbk9nQYBJ9yQrYzPxA.8ZQK4KiZo7RUldKsMX51HpSMxAGHpU.', NULL, 1, NULL, '0908267307', NULL);
COMMIT;

-- ----------------------------
-- Table structure for tbl_visit
-- ----------------------------
DROP TABLE IF EXISTS `tbl_visit`;
CREATE TABLE `tbl_visit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_id` int DEFAULT NULL,
  `property_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `code` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_per_hour` double DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `total_time` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ED1AA326427EB8A5` (`request_id`),
  KEY `IDX_ED1AA326549213EC` (`property_id`),
  KEY `IDX_ED1AA326A76ED395` (`user_id`),
  CONSTRAINT `FK_ED1AA326427EB8A5` FOREIGN KEY (`request_id`) REFERENCES `tbl_visit_request` (`id`),
  CONSTRAINT `FK_ED1AA326549213EC` FOREIGN KEY (`property_id`) REFERENCES `tbl_property` (`id`),
  CONSTRAINT `FK_ED1AA326A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_visit
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_visit_request
-- ----------------------------
DROP TABLE IF EXISTS `tbl_visit_request`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_visit_request
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_visit_tracking
-- ----------------------------
DROP TABLE IF EXISTS `tbl_visit_tracking`;
CREATE TABLE `tbl_visit_tracking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `visit_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expired_time` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3AE1F7E675FA0FF2` (`visit_id`),
  CONSTRAINT `FK_3AE1F7E675FA0FF2` FOREIGN KEY (`visit_id`) REFERENCES `tbl_visit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_visit_tracking
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
