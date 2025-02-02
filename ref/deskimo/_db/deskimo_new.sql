-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2021 at 11:35 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deskimo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oauth2_access_tokens`
--

CREATE TABLE `tbl_oauth2_access_tokens` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` int(11) DEFAULT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oauth2_auth_codes`
--

CREATE TABLE `tbl_oauth2_auth_codes` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redirect_uri` longtext COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` int(11) DEFAULT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oauth2_clients`
--

CREATE TABLE `tbl_oauth2_clients` (
  `id` int(11) NOT NULL,
  `random_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redirect_uris` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allowed_grant_types` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_oauth2_refresh_tokens`
--

CREATE TABLE `tbl_oauth2_refresh_tokens` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` int(11) DEFAULT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property`
--

CREATE TABLE `tbl_property` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `code` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1: active, 2: not active, 3: booked',
  `price` double NOT NULL,
  `minimum_charge` double NOT NULL,
  `seat_type` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `open_hour` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `close_hour` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `parking` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Multi address => json_encode(array) and store',
  `image` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1: minute, 2: hour',
  `wifi` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schedule` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_property`
--

INSERT INTO `tbl_property` (`id`, `category_id`, `created_at`, `updated_at`, `code`, `name`, `status`, `price`, `minimum_charge`, `seat_type`, `open_hour`, `close_hour`, `address`, `latitude`, `longitude`, `description`, `parking`, `image`, `unit`, `wifi`, `schedule`, `location_id`) VALUES
(1, 6, '2021-03-20 09:31:37', '2021-03-20 09:31:38', '23', '23', 1, 23, 23, '1', '23', '23', '23', '23', '23', NULL, NULL, '/media/propertyproperty/2021/03/20/6055b2ea20295.png', '23', NULL, '23', NULL),
(2, 6, '2021-03-20 09:32:23', '2021-03-20 11:13:59', '2222', '23', 1, 23, 23, '1', '23', '23', '23', '23', '23', NULL, NULL, '/media/propertyproperty/2021/03/20/6055b317e2081.png', 'hr', NULL, '23', 5),
(3, 6, '2021-03-20 09:40:20', '2021-03-20 11:23:03', '23232fdf', '223fd', 2, 23, 23, '1', '23', '23', '23', '23', '23', NULL, NULL, '/media/property/2021/03/20/6055c9383d95c.png', 'min', NULL, '23', 5),
(4, 6, '2021-03-20 09:47:07', '2021-03-20 10:56:55', '12121fd', '211233', 1, 12, 12, '1', '1212', '121', '1212ee', '1212', '12', NULL, NULL, '/media/property/2021/03/20/6055b68b568b6.png', '121', NULL, '2121', 6),
(5, 6, '2021-03-20 10:22:20', '2021-03-20 11:02:56', '5q', 'test 2', 2, 5, 5, '1', '5', '5', '5', '5', '5', '5', NULL, '/media/property/2021/03/20/6055becc790ba.jpg', '5', '5', '5', 5),
(6, 6, '2021-03-20 12:54:41', '2021-03-20 12:55:56', 'tettt', 'test3', 1, 22, 122, '1', '2', '23', '2', '2', '2', '2', NULL, '/media/property/2021/03/20/6055e28368a9b.png', 'min', '2', '2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property_benefit`
--

CREATE TABLE `tbl_property_benefit` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `image` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1: free, 2: not free',
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_property_benefit`
--

INSERT INTO `tbl_property_benefit` (`id`, `created_at`, `updated_at`, `image`, `name`, `status`, `description`) VALUES
(1, '2021-03-31 13:04:41', '2021-03-20 11:46:51', '/media/property/2021/03/20/6055d29b24e61.png', 'wifi', 1, 'test'),
(2, '2021-03-25 13:04:48', '2021-03-20 11:51:16', 'image2', 'meeting room', 1, 'tstff'),
(5, '2021-03-20 12:55:08', '2021-03-20 12:55:08', '/media/property/2021/03/20/6055e29c76b45.jpg', 'test', 1, 'fd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property_category`
--

CREATE TABLE `tbl_property_category` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_property_category`
--

INSERT INTO `tbl_property_category` (`id`, `created_at`, `updated_at`, `name`, `description`) VALUES
(6, '2021-03-20 08:06:03', '2021-03-20 08:06:04', 'Coworking', 'Desc'),
(7, '2021-03-20 08:08:48', '2021-03-20 08:08:48', 'Meeting Room', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property_location`
--

CREATE TABLE `tbl_property_location` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `parking` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_property_location`
--

INSERT INTO `tbl_property_location` (`id`, `created_at`, `updated_at`, `name`, `country`, `city`, `parking`, `description`) VALUES
(5, '2021-03-20 08:06:38', '2021-03-20 08:06:39', 'Etown', 'Singapore', 'SG', 'City', 'test'),
(6, '2021-03-20 08:07:41', '2021-03-20 08:07:41', 'Venus Center', 'HongKong', 'HongKong', 'HongKong', 'HongKong Desc');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property_property_benefit`
--

CREATE TABLE `tbl_property_property_benefit` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `property_benefit_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_property_property_benefit`
--

INSERT INTO `tbl_property_property_benefit` (`id`, `property_id`, `property_benefit_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-03-20 09:31:38', '2021-03-20 09:31:38'),
(2, 1, 2, '2021-03-20 09:31:38', '2021-03-20 09:31:38'),
(11, 6, 2, '2021-03-20 12:55:55', '2021-03-20 12:55:55'),
(12, 6, 5, '2021-03-20 12:55:55', '2021-03-20 12:55:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_permission`
--

CREATE TABLE `tbl_role_permission` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `hash_token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expired_token_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `created_at`, `updated_at`, `slug`, `username`, `password`, `full_name`, `role_id`, `hash_token`, `expired_token_at`, `status`) VALUES
(1, '2021-03-16 00:00:00', '2021-03-16 00:00:00', NULL, 'admin@gmail.com', '$2y$12$i9QuTTl.g9KMo9XyeTLU1OF/xd1rms2yo8XQWkXDRapH4VQv64hu2', 'admin', 7, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_profile`
--

CREATE TABLE `tbl_user_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_oauth2_access_tokens`
--
ALTER TABLE `tbl_oauth2_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_EAE046D5F37A13B` (`token`),
  ADD KEY `IDX_EAE046D19EB6921` (`client_id`),
  ADD KEY `IDX_EAE046DA76ED395` (`user_id`);

--
-- Indexes for table `tbl_oauth2_auth_codes`
--
ALTER TABLE `tbl_oauth2_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1E196F9F5F37A13B` (`token`),
  ADD KEY `IDX_1E196F9F19EB6921` (`client_id`),
  ADD KEY `IDX_1E196F9FA76ED395` (`user_id`);

--
-- Indexes for table `tbl_oauth2_clients`
--
ALTER TABLE `tbl_oauth2_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_oauth2_refresh_tokens`
--
ALTER TABLE `tbl_oauth2_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6A2E7A235F37A13B` (`token`),
  ADD KEY `IDX_6A2E7A2319EB6921` (`client_id`),
  ADD KEY `IDX_6A2E7A23A76ED395` (`user_id`);

--
-- Indexes for table `tbl_property`
--
ALTER TABLE `tbl_property`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_DCC1FAF377153098` (`code`),
  ADD KEY `IDX_DCC1FAF312469DE2` (`category_id`),
  ADD KEY `IDX_DCC1FAF364D218E` (`location_id`);

--
-- Indexes for table `tbl_property_benefit`
--
ALTER TABLE `tbl_property_benefit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_property_category`
--
ALTER TABLE `tbl_property_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_property_location`
--
ALTER TABLE `tbl_property_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_property_property_benefit`
--
ALTER TABLE `tbl_property_property_benefit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E5076071549213EC` (`property_id`),
  ADD KEY `IDX_E5076071BEF05BBA` (`property_benefit_id`);

--
-- Indexes for table `tbl_role_permission`
--
ALTER TABLE `tbl_role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_38B383A1F85E0677` (`username`);

--
-- Indexes for table `tbl_user_profile`
--
ALTER TABLE `tbl_user_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2709CE93A76ED395` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_oauth2_access_tokens`
--
ALTER TABLE `tbl_oauth2_access_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_oauth2_auth_codes`
--
ALTER TABLE `tbl_oauth2_auth_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_oauth2_clients`
--
ALTER TABLE `tbl_oauth2_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_oauth2_refresh_tokens`
--
ALTER TABLE `tbl_oauth2_refresh_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_property`
--
ALTER TABLE `tbl_property`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_property_benefit`
--
ALTER TABLE `tbl_property_benefit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_property_category`
--
ALTER TABLE `tbl_property_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_property_location`
--
ALTER TABLE `tbl_property_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_property_property_benefit`
--
ALTER TABLE `tbl_property_property_benefit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_role_permission`
--
ALTER TABLE `tbl_role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user_profile`
--
ALTER TABLE `tbl_user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_oauth2_access_tokens`
--
ALTER TABLE `tbl_oauth2_access_tokens`
  ADD CONSTRAINT `FK_EAE046D19EB6921` FOREIGN KEY (`client_id`) REFERENCES `tbl_oauth2_clients` (`id`),
  ADD CONSTRAINT `FK_EAE046DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_oauth2_auth_codes`
--
ALTER TABLE `tbl_oauth2_auth_codes`
  ADD CONSTRAINT `FK_1E196F9F19EB6921` FOREIGN KEY (`client_id`) REFERENCES `tbl_oauth2_clients` (`id`),
  ADD CONSTRAINT `FK_1E196F9FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_oauth2_refresh_tokens`
--
ALTER TABLE `tbl_oauth2_refresh_tokens`
  ADD CONSTRAINT `FK_6A2E7A2319EB6921` FOREIGN KEY (`client_id`) REFERENCES `tbl_oauth2_clients` (`id`),
  ADD CONSTRAINT `FK_6A2E7A23A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_property`
--
ALTER TABLE `tbl_property`
  ADD CONSTRAINT `FK_DCC1FAF312469DE2` FOREIGN KEY (`category_id`) REFERENCES `tbl_property_category` (`id`),
  ADD CONSTRAINT `FK_DCC1FAF364D218E` FOREIGN KEY (`location_id`) REFERENCES `tbl_property_location` (`id`);

--
-- Constraints for table `tbl_property_property_benefit`
--
ALTER TABLE `tbl_property_property_benefit`
  ADD CONSTRAINT `FK_E5076071549213EC` FOREIGN KEY (`property_id`) REFERENCES `tbl_property` (`id`),
  ADD CONSTRAINT `FK_E5076071BEF05BBA` FOREIGN KEY (`property_benefit_id`) REFERENCES `tbl_property_benefit` (`id`);

--
-- Constraints for table `tbl_user_profile`
--
ALTER TABLE `tbl_user_profile`
  ADD CONSTRAINT `FK_2709CE93A76ED395` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
