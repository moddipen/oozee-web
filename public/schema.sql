-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: oozee-db.c1bfswmey9j3.us-east-2.rds.amazonaws.com    Database: oozee
-- ------------------------------------------------------
-- Server version	5.7.22-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_password_resets`
--

DROP TABLE IF EXISTS `admin_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `admin_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`),
  UNIQUE KEY `admin_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `blocked_contacts`
--

DROP TABLE IF EXISTS `blocked_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocked_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blocked_contacts_user_id_foreign` (`user_id`),
  CONSTRAINT `blocked_contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cms`
--

DROP TABLE IF EXISTS `cms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `phone_number_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_circle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `max_count` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `contacts_phone_number_id_foreign` (`phone_number_id`),
  KEY `part_of_uid` (`user_id`),
  CONSTRAINT `contacts_phone_number_id_foreign` FOREIGN KEY (`phone_number_id`) REFERENCES `phone_numbers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=89104132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cron_contacts`
--

DROP TABLE IF EXISTS `cron_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cron_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dead_contacts`
--

DROP TABLE IF EXISTS `dead_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dead_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dead_contacts_user_id_foreign` (`user_id`),
  CONSTRAINT `dead_contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `image_templates`
--

DROP TABLE IF EXISTS `image_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `login_histories`
--

DROP TABLE IF EXISTS `login_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `login_histories_admin_user_id_foreign` (`admin_user_id`),
  CONSTRAINT `login_histories_admin_user_id_foreign` FOREIGN KEY (`admin_user_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `manipulations` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_properties` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsive_images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_column` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4167 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `message_reads`
--

DROP TABLE IF EXISTS `message_reads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_reads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `message_id` int(11) NOT NULL,
  `room` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NOT NULL DEFAULT '2019-06-08 04:35:44',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(20) NOT NULL,
  `receiver_id` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1613 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_user_id_foreign` (`user_id`),
  CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1685 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `online_users`
--

DROP TABLE IF EXISTS `online_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `online_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `status` int(11) DEFAULT '0',
  `last_seen` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24774 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `phone_numbers`
--

DROP TABLE IF EXISTS `phone_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone_numbers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `number` bigint(20) NOT NULL,
  `country_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phone_numbers_number_index` (`number`),
  KEY `phone_numbers_country_id_index` (`country_id`),
  CONSTRAINT `phone_numbers_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=81137786 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `plan_features`
--

DROP TABLE IF EXISTS `plan_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan_features` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `for` tinyint(4) NOT NULL COMMENT '0 = free, 1 = premium, 2 = any',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0 = free, 1 = premium',
  `features` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `quick_lists`
--

DROP TABLE IF EXISTS `quick_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quick_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quick_lists_user_id_foreign` (`user_id`),
  CONSTRAINT `quick_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `recordings`
--

DROP TABLE IF EXISTS `recordings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recordings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recordings_user_id_foreign` (`user_id`),
  CONSTRAINT `recordings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_user_id_foreign` (`user_id`),
  CONSTRAINT `settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `spam_numbers`
--

DROP TABLE IF EXISTS `spam_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spam_numbers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `number` bigint(20) NOT NULL,
  `spam_by` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = admin, 1 = user',
  `counts` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `spam_series`
--

DROP TABLE IF EXISTS `spam_series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spam_series` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `number` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `std_codes`
--

DROP TABLE IF EXISTS `std_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `std_codes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `msc` varchar(191) DEFAULT NULL,
  `number_details` varchar(191) DEFAULT NULL,
  `operator` varchar(191) DEFAULT NULL,
  `state_circle` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `service_type` varchar(191) DEFAULT NULL,
  `city_location` varchar(191) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `msc` (`msc`)
) ENGINE=InnoDB AUTO_INCREMENT=80276 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sub_tags`
--

DROP TABLE IF EXISTS `sub_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_tags_tag_id_index` (`tag_id`),
  CONSTRAINT `sub_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tag_to_numbers`
--

DROP TABLE IF EXISTS `tag_to_numbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_to_numbers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `sub_tag_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_to_numbers_user_id_foreign` (`user_id`),
  KEY `tag_to_numbers_tag_id_foreign` (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=456 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_contacts`
--

DROP TABLE IF EXISTS `temp_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `active_date` date NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_circle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender2` int(2) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`phone_number`,`active_date`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_contacts_1_jio`
--

DROP TABLE IF EXISTS `temp_contacts_1_jio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_contacts_1_jio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `active_date` date NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_circle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender2` int(2) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`phone_number`,`active_date`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=490008 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_contacts_airtel`
--

DROP TABLE IF EXISTS `temp_contacts_airtel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_contacts_airtel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `active_date` date NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Idea',
  `state_circle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Gujarat',
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Mobile',
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender2` int(2) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`phone_number`,`active_date`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=929 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_contacts_airtel_guj_01`
--

DROP TABLE IF EXISTS `temp_contacts_airtel_guj_01`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_contacts_airtel_guj_01` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `active_date` date NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Idea',
  `state_circle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Gujarat',
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Mobile',
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender2` int(2) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`phone_number`,`active_date`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15147740 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_contacts_bsnl_guj_01`
--

DROP TABLE IF EXISTS `temp_contacts_bsnl_guj_01`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_contacts_bsnl_guj_01` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `active_date` date NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Idea',
  `state_circle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Gujarat',
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Mobile',
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender2` int(2) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`phone_number`,`active_date`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5707379 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_contacts_idea_guj_03`
--

DROP TABLE IF EXISTS `temp_contacts_idea_guj_03`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_contacts_idea_guj_03` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `active_date` date NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Idea',
  `state_circle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Gujarat',
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Mobile',
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender2` int(2) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`phone_number`,`active_date`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_contacts_jio_guj_01`
--

DROP TABLE IF EXISTS `temp_contacts_jio_guj_01`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_contacts_jio_guj_01` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `active_date` date NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Idea',
  `state_circle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Gujarat',
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Mobile',
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender2` int(2) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`phone_number`,`active_date`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21580001 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_contacts_tc`
--

DROP TABLE IF EXISTS `temp_contacts_tc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_contacts_tc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `country_id` int(11) NOT NULL DEFAULT '99',
  `phone_number` bigint(20) NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_circle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38861370 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_contacts_vodafone_guj_01`
--

DROP TABLE IF EXISTS `temp_contacts_vodafone_guj_01`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_contacts_vodafone_guj_01` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `active_date` date NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Idea',
  `state_circle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Gujarat',
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Mobile',
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender2` int(2) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`phone_number`,`active_date`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14239326 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_media`
--

DROP TABLE IF EXISTS `temp_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_new_contacts`
--

DROP TABLE IF EXISTS `temp_new_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_new_contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_circle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80998 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `text_templates`
--

DROP TABLE IF EXISTS `text_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `text_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_locations`
--

DROP TABLE IF EXISTS `user_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `login_lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `login_long` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_locations_user_id_foreign` (`user_id`),
  CONSTRAINT `user_locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_plan_histories`
--

DROP TABLE IF EXISTS `user_plan_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_plan_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `plan_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `renew_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_plan_histories_user_id_foreign` (`user_id`),
  CONSTRAINT `user_plan_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=328 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_plans`
--

DROP TABLE IF EXISTS `user_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_plans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `plan_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `renew_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_plans_user_id_foreign` (`user_id`),
  CONSTRAINT `user_plans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=294 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `nick_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `dob` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `about` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `industry` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `company_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=334 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_statuses`
--

DROP TABLE IF EXISTS `user_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20775 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `phone_number_id` bigint(20) unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'manual' COMMENT 'SignUp type eg. manual, google, facebook',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = suspend',
  `device_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_imei` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_phone_number_id_foreign` (`phone_number_id`),
  CONSTRAINT `users_phone_number_id_foreign` FOREIGN KEY (`phone_number_id`) REFERENCES `phone_numbers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=334 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `voice_messages`
--

DROP TABLE IF EXISTS `voice_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voice_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender_user_id` bigint(20) unsigned NOT NULL,
  `receiver_user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `voice_messages_sender_user_id_foreign` (`sender_user_id`),
  KEY `voice_messages_receiver_user_id_foreign` (`receiver_user_id`),
  CONSTRAINT `voice_messages_receiver_user_id_foreign` FOREIGN KEY (`receiver_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `voice_messages_sender_user_id_foreign` FOREIGN KEY (`sender_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `web_users`
--

DROP TABLE IF EXISTS `web_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `web_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'oozee'
--
/*!50003 DROP PROCEDURE IF EXISTS `add_tag_to_number` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `add_tag_to_number`(IN pnumber BIGINT, IN cid BIGINT, IN userId BIGINT, IN tagId BIGINT)
BEGIN
	SELECT @tagId := tag_id FROM sub_tags WHERE sub_tags.id = tagId;
	IF NOT @tagId IS NULL
	THEN 
		SELECT @numberTag := id FROM tag_to_numbers WHERE tag_to_numbers.sub_tag_id = tagId AND tag_to_numbers.phone_number=pnumber;
		IF @numberTag IS NULL
		THEN
			INSERT INTO `tag_to_numbers` (`tag_id`, `sub_tag_id`, `phone_number`, `user_id`, `country_id`) VALUES (@tagId, tagId, pnumber, userId, cid);
		END IF;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `check_gender_show` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `check_gender_show`(IN `uid` BIGINT, OUT `outShow` INT)
BEGIN
    SET outShow = 1;
    SELECT @planID := id FROM user_plans WHERE user_plans.plan_id = 2 AND user_plans.user_id = uid;
    IF NOT @planID IS NULL
    THEN
	    SELECT @settindId := id FROM settings WHERE settings.user_id = uid AND settings.name = 'gender';
	    IF NOT @settindId IS NULL
	    THEN
	    	SET outShow = (SELECT value FROM settings WHERE settings.id = @settindId);
	    END IF;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_contact_lists` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_contact_lists`()
BEGIN
	SELECT v1.first_name, v1.last_name, v2.code, v3.number FROM contacts v1  
    JOIN phone_numbers v3 ON (v1.phone_number_id = v3.id)
    JOIN countries v2 ON (v3.country_id = v2.id);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_contact_users` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_contact_users`(IN user_id BIGINT)
BEGIN
	SELECT v3.id, v3.device_token FROM contacts v1  
    JOIN phone_numbers v2 ON (v1.phone_number_id = v2.id)
    JOIN users v3 ON (v2.id = v3.phone_number_id)
    WHERE v1.user_id = user_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_contact_users_for_chat` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_contact_users_for_chat`(IN user_id BIGINT)
BEGIN
	SELECT v2.number, v3.id as user_id, v4.photo, v4.first_name, v4.last_name FROM contacts v1  
    JOIN phone_numbers v2 ON (v1.phone_number_id = v2.id)
    JOIN users v3 ON (v2.id = v3.phone_number_id)
    JOIN user_profiles v4 ON (v3.id = v4.user_id)
    WHERE v1.user_id = user_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_contact_users_for_chat_new` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_contact_users_for_chat_new`(IN user_id BIGINT)
BEGIN
	SELECT v1.id as user_id, v2.number, v3.photo, v3.first_name, v3.last_name FROM users v1
	JOIN phone_numbers v2 ON (v1.phone_number_id = v2.id)
	JOIN user_profiles v3 ON (v1.id = v3.user_id) WHERE v1.device_type = 'ios';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_contact_users_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_contact_users_id`(IN user_id BIGINT)
BEGIN
    SELECT v3.id FROM contacts v1  
    JOIN phone_numbers v2 ON (v1.phone_number_id = v2.id)
    JOIN users v3 ON (v2.id = v3.phone_number_id)
    WHERE v1.user_id = user_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_contact_users_with_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_contact_users_with_status`(IN user_id BIGINT)
BEGIN
	SELECT v2.number, v5.status, v4.photo FROM contacts v1  
    JOIN phone_numbers v2 ON (v1.phone_number_id = v2.id)
    JOIN users v3 ON (v2.id = v3.phone_number_id)
    JOIN user_profiles v4 ON (v3.id = v4.user_id)
    JOIN (
              SELECT    MAX(id) max_id, user_id 
              FROM      user_statuses 
              GROUP BY  user_id
          ) c_max ON (c_max.user_id = v3.id)
    JOIN user_statuses v5 ON (v5.id = c_max.max_id)
    WHERE v1.user_id = user_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_contact_users_with_status_new` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_contact_users_with_status_new`(IN `user_id` BIGINT)
BEGIN
SELECT v2.number, v5.status, v3.id, v4.photo, v4.gender , v6.plan_id FROM contacts v1  
    JOIN phone_numbers v2 ON (v1.phone_number_id = v2.id)
    JOIN users v3 ON (v2.id = v3.phone_number_id)
    JOIN user_profiles v4 ON (v3.id = v4.user_id)
    JOIN user_statuses v5 ON (v3.id = v5.user_id)
    JOIN user_plans v6 ON (v6.user_id = v3.id)
    WHERE v1.user_id = user_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_location_users` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_location_users`(IN startlat VARCHAR(191), IN startlng VARCHAR(191), IN redius BIGINT)
BEGIN
    SELECT user_id, login_lat, login_long, SQRT(
    POW(69.1 * (login_lat - startlat), 2) +
    POW(69.1 * (startlng - login_long) * COS(login_lat / 57.3), 2)) AS distance
	FROM user_locations HAVING distance < redius ORDER BY distance;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_messages_by_user_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_messages_by_user_id`(IN uid BIGINT)
BEGIN
    SELECT v1.id, 
    v1.message, 
    v1.status, 
    v1.created_at, 
    v1.sender_id, 
    v1.receiver_id, 
    v4.first_name as sender_first_name, 
    v4.last_name as sender_last_name, 
    v4.photo as sender_photo, 
    v3.number as sender_number 
    FROM messages v1 
    JOIN users v2 ON (v2.id = v1.sender_id)
    JOIN user_profiles v4 ON (v2.id = v4.user_id)
    JOIN phone_numbers v3 ON (v2.phone_number_id = v3.id)
    WHERE v1.sender_id = uid OR v1.receiver_id = uid ORDER BY id DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_mutual_contacts` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_mutual_contacts`(IN aUid BIGINT, IN uid BIGINT)
BEGIN
	SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
    
    SELECT v1.first_name, v1.last_name, v3.number FROM contacts v1 
    INNER JOIN contacts v2 ON (v1.phone_number_id = v2.phone_number_id) 
    INNER JOIN phone_numbers v3 ON (v1.phone_number_id = v3.id) 
    WHERE v1.user_id = aUid AND v2.user_id = uid ORDER BY RAND() LIMIT 3;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_mutual_contacts_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_mutual_contacts_count`(IN aUid BIGINT, IN uid BIGINT)
BEGIN
	SET TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;
    
    SELECT count(v1.first_name) as mutual FROM contacts v1 
    INNER JOIN contacts v2 ON (v1.phone_number_id = v2.phone_number_id) 
    INNER JOIN phone_numbers v3 ON (v1.phone_number_id = v3.id) 
    WHERE v1.user_id = aUid AND v2.user_id = uid;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_notifications` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_notifications`(IN `user_id` BIGINT)
BEGIN
	SELECT * FROM notifications WHERE notifications.user_id = user_id ORDER BY id DESC LIMIT 10;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_notification_free_users` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_notification_free_users`()
BEGIN
	SELECT v1.id, v1.device_token FROM users v1
	    JOIN user_plans v2 ON (v1.id = v2.user_id) 
	    JOIN plans v3 ON (v2.plan_id = v3.id) WHERE v3.type = 0 AND v1.deleted_at IS NULL AND v1.status = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_notification_paid_users` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_notification_paid_users`()
BEGIN
	SELECT v1.id, v1.device_token FROM users v1
	    JOIN user_plans v2 ON (v1.id = v2.user_id) 
	    JOIN plans v3 ON (v2.plan_id = v3.id) WHERE v3.type = 1 AND v1.deleted_at IS NULL AND v1.status = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_notification_users` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_notification_users`()
BEGIN
	SELECT id, device_token FROM users WHERE deleted_at IS NULL AND status = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_number_details` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_number_details`(IN `pnumber` BIGINT, IN `cid` BIGINT, IN `uid` BIGINT, OUT `OutFirstName` VARCHAR(191) CHARSET utf8mb4, OUT `OutLastName` VARCHAR(191) CHARSET utf8mb4, OUT `OutEmail` VARCHAR(191), OUT `OutUserID` BIGINT, OUT `OutNumberID` BIGINT, OUT `OutContactID` BIGINT, OUT `OutAddress` VARCHAR(191), OUT `OutServiceProvider` VARCHAR(191), OUT `OutPhoto` VARCHAR(191), OUT `OutGender` VARCHAR(191), OUT `OutSpam` BIGINT, OUT `OutBlock` INT)
BEGIN
    SET OutFirstName = NULL;
    SET OutLastName = NULL;
    SET OutEmail = NULL;
    SET OutAddress = NULL;
    SET OutServiceProvider = NULL;
    SET OutPhoto = NULL;
    SET OutGender = NULL;
    SET OutUserID = 0;
    SET OutNumberID = 0;
    SET OutContactID = 0;
    SET OutSpam = 0;
    SET OutBlock = 0;
    
    SELECT @numberID := id FROM phone_numbers WHERE phone_numbers.country_id = cid AND phone_numbers.number = pnumber;
    IF NOT @numberID IS NULL
    THEN
        SELECT @userID := id FROM users WHERE users.phone_number_id = @numberID AND users.deleted_at IS NULL;
        IF NOT @userID IS NULL
        THEN 
            SET OutFirstName = (SELECT first_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutLastName = (SELECT last_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutEmail = (SELECT email FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutAddress = (SELECT address FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutPhoto = (SELECT photo FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutGender = (SELECT gender FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutUserID = @userID;
            SET OutNumberID = @numberID;
            SELECT COUNT(*) INTO OutSpam FROM blocked_contacts WHERE blocked_contacts.country_id = cid AND blocked_contacts.phone_number = pnumber;

        ELSE
            IF NOT @numberID IS NULL
            THEN 
                SET OutFirstName = (SELECT first_name FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
                SET OutLastName = (SELECT last_name FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
                SET OutEmail = (SELECT email FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
                SET OutAddress = (SELECT location FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
                SET OutContactID = (SELECT id FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
                SET OutPhoto = (SELECT photo FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
                SET OutGender = (SELECT gender FROM contacts WHERE contacts.user_id = @userID);
                SET OutUserID = 0;
                SET OutNumberID = @numberID;
                SELECT COUNT(*) INTO OutSpam FROM blocked_contacts WHERE blocked_contacts.country_id = cid AND blocked_contacts.phone_number = pnumber;
            END IF;
        END IF;
    END IF;
    SELECT @BlockId := id FROM blocked_contacts WHERE blocked_contacts.country_id = cid AND blocked_contacts.phone_number = pnumber AND blocked_contacts.user_id = uid;
    IF NOT @BlockId IS NULL
    THEN
    	SET OutBlock = @BlockId;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_number_details_new` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_number_details_new`(IN `pnumber` BIGINT, IN `cid` BIGINT, IN `uid` BIGINT, OUT `OutFirstName` VARCHAR(191) CHARSET utf8mb4, OUT `OutLastName` VARCHAR(191) CHARSET utf8mb4, OUT `OutEmail` VARCHAR(191), OUT `OutUserID` BIGINT, OUT `OutNumberID` BIGINT, OUT `OutContactID` BIGINT, OUT `OutAddress` VARCHAR(191), OUT `OutServiceProvider` VARCHAR(191), OUT `OutPhoto` VARCHAR(191), OUT `OutGender` VARCHAR(191), OUT `OutSpam` BIGINT, OUT `OutSpamCount` BIGINT, OUT `OutBlock` INT, OUT `OutSubscribed` INT, OUT `OutWebsite` VARCHAR(191), OUT `OutBusiness` VARCHAR(191))
BEGIN
    SET OutFirstName = NULL;
    SET OutLastName = NULL;
    SET OutEmail = NULL;
    SET OutAddress = NULL;
    SET OutPhoto = NULL;
    SET OutServiceProvider = NULL;
    SET OutGender = NULL;
    SET OutUserID = 0;
    SET OutNumberID = 0;
    SET OutContactID = 0;
    SET OutSpam = 0;
    SET OutSpamCount = 0;
    SET OutBlock = 0;
    SET OutSubscribed = 0;
    SET OutWebsite = NULL;
    SET OutBusiness = NULL;
    
    SELECT @numberID := id FROM phone_numbers WHERE phone_numbers.country_id = cid AND phone_numbers.number = pnumber;
    IF NOT @numberID IS NULL
    THEN
        SELECT @userID := id FROM users WHERE users.phone_number_id = @numberID AND users.deleted_at IS NULL;
        IF NOT @userID IS NULL
        THEN 
            SET OutFirstName = (SELECT first_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutLastName = (SELECT last_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutEmail = (SELECT email FROM user_profiles WHERE user_profiles.user_id = @userID);
            SELECT @Address := (SELECT address FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutPhoto = (SELECT photo FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutGender = (SELECT gender FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutWebsite = (SELECT website FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutBusiness = (SELECT company_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutUserID = @userID;
            SET OutNumberID = @numberID;
            SELECT count(*) INTO OutSubscribed FROM user_plans c1 JOIN plans c2 ON (c1.plan_id = c2.id) WHERE c2.type = 1 AND c1.user_id = @userID;

            SELECT @spamID := id FROM spam_numbers WHERE spam_numbers.number = pnumber AND (spam_numbers.spam_by = 0 OR spam_numbers.counts >= 25);
		    IF NOT @spamID IS NULL
		    THEN
		    	SET OutSpam = 1;
		    	SET OutSpamCount = (SELECT counts FROM spam_numbers WHERE spam_numbers.number = pnumber AND (spam_numbers.spam_by = 0 OR spam_numbers.counts >= 25));
		    ELSE
		    	SELECT @spamSeriesID := id FROM spam_series WHERE pnumber LIKE CONCAT(number, '%');
		    	IF NOT @spamSeriesID IS NULL
		    	THEN
		    		SET OutSpam = 1;
		    	END IF;
		    END IF;

            SET OutServiceProvider = ( SELECT CONCAT(operator, '-', service_type) FROM std_codes WHERE pnumber LIKE CONCAT(msc, '%') ORDER BY id DESC LIMIT 1 );
            IF(@Address IS NULL OR @Address = '')
            THEN
            	SET OutAddress = ( SELECT CONCAT(state_circle, ' ', country) FROM std_codes WHERE pnumber LIKE CONCAT(msc, '%') ORDER BY id DESC LIMIT 1 );
            ELSE
            	SET OutAddress = @Address;
            END IF;
        ELSE
            IF NOT @numberID IS NULL
            THEN 
                SELECT @maxContactId := id FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.max_count = 1;
                IF NOT @maxContactId IS NULL
                THEN 
                    SET OutFirstName = (SELECT first_name FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.max_count = 1 LIMIT 1);
                    SET OutLastName = (SELECT last_name FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.max_count = 1 LIMIT 1);
                    SET OutEmail = (SELECT email FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.max_count = 0 LIMIT 1);
                    SET OutContactID = (SELECT id FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.max_count = 0 LIMIT 1);
                    SET OutPhoto = (SELECT photo FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.max_count = 0 LIMIT 1);
                ELSE
                    SET OutFirstName = (SELECT first_name FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = 0 LIMIT 1);
                    SET OutLastName = (SELECT last_name FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = 0 LIMIT 1);
                    SET OutEmail = (SELECT email FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = 0 LIMIT 1);
                    SET OutContactID = (SELECT id FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = 0 LIMIT 1);
                    SET OutPhoto = (SELECT photo FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = 0 LIMIT 1);
                END IF;
                SET OutGender = (SELECT gender FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = 0 LIMIT 1);
                SET OutAddress = ( SELECT CONCAT(state_circle, ' ', country) FROM std_codes WHERE pnumber LIKE CONCAT(msc, '%') ORDER BY id DESC LIMIT 1 );
                SET OutServiceProvider = ( SELECT CONCAT(operator, '-', service_type) FROM std_codes WHERE pnumber LIKE CONCAT(msc, '%') ORDER BY id DESC LIMIT 1 );
                SET OutUserID = 0;
                SET OutNumberID = @numberID;
                SELECT @spamID := id FROM spam_numbers WHERE spam_numbers.number = pnumber AND (spam_numbers.spam_by = 0 OR spam_numbers.counts >= 25);
			    IF NOT @spamID IS NULL
			    THEN
			    	SET OutSpam = 1;
			    	SET OutSpamCount = (SELECT counts FROM spam_numbers WHERE spam_numbers.number = pnumber AND (spam_numbers.spam_by = 0 OR spam_numbers.counts >= 25));
			    ELSE
			    	SELECT @spamSeriesID := id FROM spam_series WHERE pnumber LIKE CONCAT(number, '%');
			    	IF NOT @spamSeriesID IS NULL
			    	THEN
			    		SET OutSpam = 1;
			    	END IF;
			    END IF;
            END IF;
        END IF;
    ELSE
    	SET OutAddress = ( SELECT CONCAT(state_circle, ' ', country) FROM std_codes WHERE pnumber LIKE CONCAT(msc, '%') ORDER BY id DESC LIMIT 1 );
		SET OutServiceProvider = ( SELECT CONCAT(operator, '-', service_type) FROM std_codes WHERE pnumber LIKE CONCAT(msc, '%') ORDER BY id DESC LIMIT 1 );
    END IF;
    SELECT @BlockId := id FROM blocked_contacts WHERE blocked_contacts.country_id = cid AND blocked_contacts.phone_number = pnumber AND blocked_contacts.user_id = uid;
    IF NOT @BlockId IS NULL
    THEN
    	SET OutBlock = @BlockId;
    END IF;

    SELECT @spamID := id FROM spam_numbers WHERE spam_numbers.number = pnumber AND (spam_numbers.spam_by = 0 OR spam_numbers.counts >= 25);
    IF NOT @spamID IS NULL
    THEN
        SET OutSpam = 1;
        SET OutSpamCount = (SELECT counts FROM spam_numbers WHERE spam_numbers.number = pnumber AND (spam_numbers.spam_by = 0 OR spam_numbers.counts >= 25));
    ELSE
        SELECT @spamSeriesID := id FROM spam_series WHERE pnumber LIKE CONCAT(number, '%');
        IF NOT @spamSeriesID IS NULL
        THEN
            SET OutSpam = 1;
        END IF;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_number_tags` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_number_tags`(IN `pnumber` BIGINT, IN `cid` BIGINT, IN `uid` BIGINT)
BEGIN
    SELECT v1.id, IFNULL(v2.id, 0) as tag_id, IFNULL(v2.name, '') as tag_name, IFNULL(v3.id, 0) as sub_tag_id, IFNULL(v3.name, '') as sub_tag_name FROM tag_to_numbers v1 
    LEFT JOIN tags v2 ON (v1.tag_id = v2.id) 
    LEFT JOIN sub_tags v3 ON (v1.sub_tag_id = v3.id) 
    WHERE v1.user_id = uid AND v1.phone_number = pnumber AND v1.country_id = cid AND v1.tag_id != 0 AND v1.sub_tag_id != 0;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_statistics` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_statistics`(OUT OutFreeUsers BIGINT, OUT OutPaidUsers BIGINT, OUT OutAndroidUsers BIGINT, OUT OutIOSUsers BIGINT)
BEGIN
	SELECT count(*) INTO OutFreeUsers FROM user_plans c1 JOIN plans c2 ON (c1.plan_id = c2.id) WHERE c2.type = 0;
	SELECT count(*) INTO OutPaidUsers FROM user_plans c1 JOIN plans c2 ON (c1.plan_id = c2.id) WHERE c2.type = 1;
	SELECT count(*) INTO OutAndroidUsers FROM users WHERE users.device_type = 'Android';
	SELECT count(*) INTO OutIOSUsers FROM users WHERE users.device_type = 'IOS';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_temp_contacts` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_temp_contacts`()
BEGIN
	SELECT * FROM temp_contacts;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_temp_contact_lists` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_temp_contact_lists`(lm bigint)
BEGIN
	SELECT * from temp_contacts limit lm;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_temp_contact_tc_lists` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_temp_contact_tc_lists`(lm bigint)
BEGIN
	SELECT * from temp_contacts_tc limit lm;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_uername_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_uername_by_id`(IN id BIGINT, OUT firstName VARCHAR(191), OUT lastName VARCHAR(191))
BEGIN
    SET firstName = NULL;
    SET lastName = NULL;

    SET firstName = (SELECT first_name FROM user_profiles WHERE user_profiles.user_id = id);
    SET lastName = (SELECT last_name FROM user_profiles WHERE user_profiles.user_id = id);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_users_details_by_number` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_users_details_by_number`(IN `pnumber` BIGINT, IN `cid` BIGINT, OUT `OutFirstName` VARCHAR(191), OUT `OutLastName` VARCHAR(191), OUT `OutEmail` VARCHAR(191), OUT `OutUserID` BIGINT, OUT `OutDOB` VARCHAR(191), OUT `OutGender` VARCHAR(191), OUT `OutPhoto` VARCHAR(191), OUT `OutNickName` VARCHAR(191), OUT `OutAbout` VARCHAR(191), OUT `OutAddress` VARCHAR(191), OUT `OutWebsite` VARCHAR(191), OUT `OutIndustry` VARCHAR(191), OUT `OutCompanyName` VARCHAR(191), OUT `OutCompanyAddress` VARCHAR(191))
BEGIN
    SET OutFirstName = NULL;
    SET OutLastName = NULL;
    SET OutEmail = NULL;
    SET OutDOB = NULL;
    SET OutUserID = 0;
    SET OutGender = NULL;
    SET OutPhoto = NULL;
    SET OutNickName = NULL;
    SET OutAbout = NULL;
    SET OutAddress = NULL;
    SET OutWebsite = NULL;
    SET OutIndustry = NULL;
    SET OutCompanyName = NULL;
    SET OutCompanyAddress = NULL;
    
    SELECT @numberID := id FROM phone_numbers WHERE phone_numbers.country_id = cid AND phone_numbers.number = pnumber;
    IF NOT @numberID IS NULL
    THEN
        SELECT @userID := id FROM users WHERE users.phone_number_id = @numberID AND users.deleted_at IS NULL;
        IF NOT @userID IS NULL
        THEN 
            SET OutFirstName = (SELECT first_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutLastName = (SELECT last_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutEmail = (SELECT email FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutDOB = (SELECT dob FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutGender = (SELECT gender FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutPhoto = (SELECT photo FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutNickName = (SELECT nick_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutAbout = (SELECT about FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutAddress = (SELECT address FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutWebsite = (SELECT website FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutIndustry = (SELECT industry FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutCompanyName = (SELECT company_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutCompanyAddress = (SELECT company_address FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutUserID = @userID;
        END IF;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_user_details_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_user_details_by_id`(IN user_id BIGINT)
BEGIN
	SELECT v1.device_imei, v1.created_at, v2.*, v3.number, COUNT(v4.id) as contacts 
	FROM users v1 
	JOIN user_profiles v2 ON (v1.id = v2.user_id) 
	JOIN phone_numbers v3 ON (v1.phone_number_id = v3.id) 
	JOIN contacts v4 ON (v1.id = v4.user_id) 
	WHERE v1.id = user_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_user_details_by_id_for_message` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_user_details_by_id_for_message`(IN uid BIGINT)
BEGIN
SELECT 
    v2.first_name, 
    v2.last_name, 
    v2.photo, 
    v3.number
    FROM users v1
    JOIN user_profiles v2 ON (v1.id = v2.user_id)
    JOIN phone_numbers v3 ON (v1.phone_number_id = v3.id)
    WHERE v1.id = uid;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_user_locations` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_user_locations`(IN `user_id` BIGINT)
BEGIN
    SELECT login_lat, login_long, latitude, longitude FROM user_locations WHERE user_locations.user_id = user_id LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_user_temp_contact_lists` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `get_user_temp_contact_lists`(lm bigint)
BEGIN
	SELECT * from temp_new_contacts limit lm;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insert_or_update_user` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `insert_or_update_user`(IN pnumber BIGINT, IN cid BIGINT, IN fname VARCHAR(191), IN lname VARCHAR(191), IN email VARCHAR(191), IN type VARCHAR(191), IN gender VARCHAR(191))
BEGIN
	SELECT @userID := id FROM users WHERE users.country_id = cid AND users.phone_number = pnumber;
	IF NOT @userID IS NULL
	THEN 
	UPDATE `users` SET `email` = email, `type` = type WHERE users.id = @userID;
	UPDATE `user_profiles` SET `first_name` = fname, `last_name` = lname, `gender` = gender WHERE user_profiles.user_id = @userID;
	ELSE
	INSERT INTO `users` (`email`, `phone_number`, `type`, `country_id`) VALUES (email, pnumber, type, cid);
	SELECT @userID := LAST_INSERT_ID();
	INSERT INTO `user_profiles` (`first_name`, `last_name`, `user_id`, `gender`) VALUES (fname, lname, @userID, gender);
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `search_contact` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `search_contact`(IN `authUserId` BIGINT, IN `pnumber` BIGINT, IN `cid` BIGINT, OUT `OutFirstName` VARCHAR(191) CHARSET utf8mb4, OUT `OutLastName` VARCHAR(191) CHARSET utf8mb4, OUT `OutEmail` VARCHAR(191), OUT `OutAddress` VARCHAR(191), OUT `OutPhoto` VARCHAR(191), OUT `OutGender` VARCHAR(191), OUT `OutUserID` BIGINT, OUT `OutSpam` BIGINT, OUT `OutServiceProvider` VARCHAR(191), OUT `OutSubscribed` INT, OUT `OutWebsite` VARCHAR(191), OUT `OutBusiness` VARCHAR(191))
BEGIN
    SET OutFirstName = NULL;
    SET OutLastName = NULL;
    SET OutEmail = NULL;
    SET OutAddress = NULL;
    SET OutPhoto = NULL;
    SET OutGender = NULL;
    SET OutSpam = 0;
    SET OutUserID = 0;
    SET OutServiceProvider = NULL;
    SET OutWebsite = NULL;
    SET OutBusiness = NULL;
    SET OutSubscribed = 0;
    
    SELECT @numberID := id FROM phone_numbers WHERE phone_numbers.country_id = cid AND phone_numbers.number = pnumber;
    IF NOT @numberID IS NULL
    THEN
        SELECT @userID := id FROM users WHERE users.phone_number_id = @numberID AND users.deleted_at IS NULL;
        IF NOT @userID IS NULL
        THEN 
        	SET OutUserID = @userID;
            SET OutFirstName = (SELECT first_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutLastName = (SELECT last_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutEmail = (SELECT email FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutAddress = (SELECT address FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutPhoto = (SELECT photo FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutGender = (SELECT gender FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutWebsite = (SELECT website FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutBusiness = (SELECT company_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SELECT count(*) INTO OutSubscribed FROM user_plans c1 JOIN plans c2 ON (c1.plan_id = c2.id) WHERE c2.type = 1 AND c1.user_id = @userID;
            SELECT COUNT(*) INTO OutSpam FROM blocked_contacts WHERE blocked_contacts.country_id = cid AND blocked_contacts.phone_number = pnumber;
        ELSE
            IF NOT @numberID IS NULL
            THEN 
            	SELECT @userContactID := id FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = authUserId;
            	IF NOT @userContactID IS NULL
            	THEN
	                SET OutFirstName = (SELECT first_name FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = authUserId);
	                SET OutLastName = (SELECT last_name FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = authUserId);
	                SET OutEmail = (SELECT email FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = authUserId);
	                SET OutAddress = (SELECT location FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = authUserId);
	                SET OutPhoto = (SELECT photo FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = authUserId);
	                SET OutGender = (SELECT gender FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = authUserId);
	                SET OutServiceProvider = (SELECT service_provider FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = authUserId);
	                SELECT COUNT(*) INTO OutSpam FROM blocked_contacts WHERE blocked_contacts.country_id = cid AND blocked_contacts.phone_number = pnumber;
	            ELSE
	            	SET OutFirstName = (SELECT first_name FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
	                SET OutLastName = (SELECT last_name FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
	                SET OutEmail = (SELECT email FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
	                SET OutAddress = (SELECT location FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
	                SET OutPhoto = (SELECT photo FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
	                SET OutGender = (SELECT gender FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
	                SET OutServiceProvider = (SELECT service_provider FROM contacts WHERE contacts.phone_number_id = @numberID ORDER BY id DESC LIMIT 1);
	                SELECT COUNT(*) INTO OutSpam FROM blocked_contacts WHERE blocked_contacts.country_id = cid AND blocked_contacts.phone_number = pnumber;
	            END IF;
            END IF;
        END IF;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `search_contact_new` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `search_contact_new`(IN `authUserId` BIGINT, IN `pnumber` BIGINT, IN `cid` BIGINT, OUT `OutFirstName` VARCHAR(191) CHARSET utf8mb4, OUT `OutLastName` VARCHAR(191) CHARSET utf8mb4, OUT `OutEmail` VARCHAR(191), OUT `OutAddress` VARCHAR(191), OUT `OutPhoto` VARCHAR(191), OUT `OutGender` VARCHAR(191), OUT `OutUserID` BIGINT, OUT `OutSpam` BIGINT, OUT `OutSpamCount` BIGINT, OUT `OutServiceProvider` VARCHAR(191), OUT `OutSubscribed` INT, OUT `OutWebsite` VARCHAR(191), OUT `OutBusiness` VARCHAR(191))
BEGIN
    SET OutFirstName = NULL;
    SET OutLastName = NULL;
    SET OutEmail = NULL;
    SET OutAddress = NULL;
    SET OutPhoto = NULL;
    SET OutGender = NULL;
    SET OutSpam = 0;
    SET OutSpamCount = 0;
    SET OutUserID = 0;
    SET OutServiceProvider = NULL;
    SET OutWebsite = NULL;
    SET OutBusiness = NULL;
    SET OutSubscribed = 0;
    
    SELECT @numberID := id FROM phone_numbers WHERE phone_numbers.country_id = cid AND phone_numbers.number = pnumber;
    IF NOT @numberID IS NULL
    THEN
        SELECT @userID := id FROM users WHERE users.phone_number_id = @numberID AND users.deleted_at IS NULL;
        IF NOT @userID IS NULL
        THEN 
            SET OutUserID = @userID;
            SET OutFirstName = (SELECT first_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutLastName = (SELECT last_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutEmail = (SELECT email FROM user_profiles WHERE user_profiles.user_id = @userID);
            SELECT @Address := (SELECT address FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutPhoto = (SELECT photo FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutGender = (SELECT gender FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutWebsite = (SELECT website FROM user_profiles WHERE user_profiles.user_id = @userID);
            SET OutBusiness = (SELECT company_name FROM user_profiles WHERE user_profiles.user_id = @userID);
            SELECT count(*) INTO OutSubscribed FROM user_plans c1 JOIN plans c2 ON (c1.plan_id = c2.id) WHERE c2.type = 1 AND c1.user_id = @userID;
            
            SELECT @spamID := id FROM spam_numbers WHERE spam_numbers.number = pnumber AND (spam_numbers.spam_by = 0 OR spam_numbers.counts >= 25);
            IF NOT @spamID IS NULL
            THEN
                SET OutSpam = 1;
                SET OutSpamCount = (SELECT counts FROM spam_numbers WHERE spam_numbers.number = pnumber AND (spam_numbers.spam_by = 0 OR spam_numbers.counts >= 25));
            ELSE
                SELECT @spamSeriesID := id FROM spam_series WHERE pnumber LIKE CONCAT(number, '%');
                IF NOT @spamSeriesID IS NULL
                THEN
                    SET OutSpam = 1;
                END IF;
            END IF;
  
            SET OutServiceProvider = ( SELECT CONCAT(operator, '-', service_type) FROM std_codes WHERE pnumber LIKE CONCAT(msc, '%') ORDER BY id DESC LIMIT 1 );
            IF NULLIF(@Address, '') IS NULL
            THEN
                SET OutAddress = ( SELECT CONCAT(state_circle, ' ', country) FROM std_codes WHERE pnumber LIKE CONCAT(msc, '%') ORDER BY id DESC LIMIT 1 );
            ELSE
                SET OutAddress = @Address;
            END IF;
        ELSE
            IF NOT @numberID IS NULL
            THEN 
                SELECT @maxContactId := id FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.max_count = 1;
                IF NOT @maxContactId IS NULL
                THEN 
                    SET OutFirstName = (SELECT first_name FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.max_count = 1 LIMIT 1);
                    SET OutLastName = (SELECT last_name FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.max_count = 1 LIMIT 1);
                    SET OutEmail = (SELECT email FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.max_count = 0 LIMIT 1);
                    SET OutPhoto = (SELECT photo FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.max_count = 0 LIMIT 1);
                ELSE
                    SET OutFirstName = (SELECT first_name FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = 0 LIMIT 1);
                    SET OutLastName = (SELECT last_name FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = 0 LIMIT 1);
                    SET OutEmail = (SELECT email FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = 0 LIMIT 1);
                    SET OutPhoto = (SELECT photo FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = 0 LIMIT 1);
                END IF;
                SET OutGender = (SELECT gender FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = 0 LIMIT 1);
                SET OutAddress = ( SELECT CONCAT(state_circle, ' ', country) FROM std_codes WHERE pnumber LIKE CONCAT(msc, '%') ORDER BY id DESC LIMIT 1 );
                SET OutServiceProvider = ( SELECT CONCAT(operator, '-', service_type) FROM std_codes WHERE pnumber LIKE CONCAT(msc, '%') ORDER BY id DESC LIMIT 1 );

                SELECT @spamID := id FROM spam_numbers WHERE spam_numbers.number = pnumber AND (spam_numbers.spam_by = 0 OR spam_numbers.counts >= 25);
                IF NOT @spamID IS NULL
                THEN
                    SET OutSpam = 1;
                ELSE
                    SELECT @spamSeriesID := id FROM spam_series WHERE pnumber LIKE CONCAT(number, '%');
                    IF NOT @spamSeriesID IS NULL
                    THEN
                        SET OutSpam = 1;
                    END IF;
                END IF;
            END IF;
        END IF;
    ELSE
        SELECT @spamID := id FROM spam_numbers WHERE spam_numbers.number = pnumber AND (spam_numbers.spam_by = 0 OR spam_numbers.counts >= 25);
        IF NOT @spamID IS NULL
        THEN
            SET OutSpam = 1;
        ELSE
            SELECT @spamSeriesID := id FROM spam_series WHERE pnumber LIKE CONCAT(number, '%');
            IF NOT @spamSeriesID IS NULL
            THEN
                SET OutSpam = 1;
            END IF;
        END IF;
        SET OutAddress = ( SELECT CONCAT(state_circle, ' ', country) FROM std_codes WHERE pnumber LIKE CONCAT(msc, '%') ORDER BY id DESC LIMIT 1 );
        SET OutServiceProvider = ( SELECT CONCAT(operator, '-', service_type) FROM std_codes WHERE pnumber LIKE CONCAT(msc, '%') ORDER BY id DESC LIMIT 1 );
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_admin_users` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_admin_users`()
BEGIN
                SELECT * FROM admin_users WHERE deleted_at IS NULL;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_admin_users_except_current` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_admin_users_except_current`(IN idx int)
BEGIN
                SELECT * FROM admin_users where id != idx AND deleted_at IS NULL;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_admin_user_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_admin_user_by_id`(IN idx int)
BEGIN
                SELECT * FROM admin_users WHERE id = idx AND deleted_at IS NULL;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_blogs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_blogs`()
BEGIN
                SELECT * FROM blogs;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_blog_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_blog_by_id`(IN idx int)
BEGIN
                SELECT * FROM blogs WHERE id = idx;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_by_permission_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_by_permission_id`(IN idx int)
BEGIN
                SELECT * FROM permissions WHERE id = idx;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_cms` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_cms`()
BEGIN
                SELECT * FROM cms;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_cms_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_cms_by_id`(IN idx int)
BEGIN
                SELECT * FROM cms WHERE id = idx;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_news` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_news`()
BEGIN
                SELECT * FROM news;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_news_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_news_by_id`(IN idx int)
BEGIN
                SELECT * FROM news WHERE id = idx;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_permissions` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_permissions`()
BEGIN
                SELECT * FROM permissions;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_permission_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_permission_by_id`(IN idx int)
BEGIN
                SELECT * FROM permissions WHERE id = idx;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_roles` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_roles`()
BEGIN
                SELECT * FROM roles;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `select_role_by_id` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `select_role_by_id`(IN idx int)
BEGIN
                SELECT * FROM roles WHERE id = idx;
            END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `store_notifications` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `store_notifications`(IN user_id BIGINT, IN title VARCHAR(191), IN body VARCHAR(191), IN type VARCHAR(191))
BEGIN
	INSERT INTO `notifications` (`user_id`,`title`, `body`, `type`, `created_at`, `updated_at`) VALUES (user_id, title, body, type, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sync_contacts` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `sync_contacts`(IN `pnumber` BIGINT, IN `cid` BIGINT, IN `userId` BIGINT, IN `fname` VARCHAR(191) CHARSET utf8mb4, IN `lname` VARCHAR(191) CHARSET utf8mb4, IN `email` VARCHAR(191), IN `photo` VARCHAR(191), IN `gender` VARCHAR(191), IN `service_provider` VARCHAR(191), IN `state_circle` VARCHAR(191), IN `location` VARCHAR(191), IN `OutActiveDate` VARCHAR(191))
BEGIN
    SET @numberID = NULL;
    SET @contactID = NULL;
    SET @activeDate = NULL;
    SET @activeContactID = NULL;
    SELECT @numberID := id FROM phone_numbers WHERE phone_numbers.country_id = cid AND phone_numbers.number = pnumber;
    IF NOT @numberID IS NULL
    THEN 
        SELECT @contactID := id FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = userId;
        IF NOT @contactID IS NULL
        THEN
        	SELECT @activeDate := active_date FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = userId AND contacts.user_id = 0;
        	IF NOT @activeDate IS NULL
        	THEN
        		IF NOT OutActiveDate IS NULL
        		THEN
	        		SELECT @activeContactID := id FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = userId AND contacts.user_id = 0;
	        		UPDATE `contacts` SET 
	        		`first_name` = fname,
	        		`last_name` = lname, 
	        		`email` = email, 
	        		`photo` = photo, 
	        		`gender` = gender, 
	        		`service_provider` = service_provider, 
	        		`state_circle` = state_circle, 
	        		`location` = location, 
	        		`active_date` = OutActiveDate 
	        		WHERE contacts.id = @activeContactID 
	        		AND str_to_date(contacts.active_date, '%Y-%m-%d') < str_to_date(OutActiveDate, '%Y-%m-%d' );
	        	END IF;
        	ELSE	
            	UPDATE `contacts` SET 
            	`first_name` = fname, 
            	`last_name` = lname, 
            	`email` = email, 
            	`photo` = photo, 
            	`gender` = gender, 
            	`service_provider` = service_provider, 
            	`state_circle` = state_circle, 
            	`location` = location, 
            	`active_date` = OutActiveDate 
            	WHERE contacts.id = @contactID;
            END IF;
        ELSE
            INSERT INTO `contacts` (`first_name`, `last_name`, `user_id`, `phone_number_id`, `email`, `photo`, `gender`, `active_date`, `service_provider`, `location`, `state_circle`, `created_at`, `updated_at`) 
            VALUES (fname, lname, userId, @numberID, email, photo, gender, OutActiveDate, service_provider, location, state_circle, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
        END IF;
    ELSE
        INSERT INTO `phone_numbers` (`number`, `country_id`) 
        VALUES (pnumber, cid);
        SELECT @numberID := LAST_INSERT_ID();
        INSERT INTO `contacts` (`first_name`, `last_name`, `user_id`, `phone_number_id`, `email`, `photo`, `gender`, `active_date`, `service_provider`, `location`, `state_circle`, `created_at`, `updated_at`) 
        VALUES (fname, lname, userId, @numberID, email, photo, gender, OutActiveDate, service_provider, location, state_circle, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
    END IF;
    
    SELECT @maxID := A.id, count(A.first_name) as counts FROM contacts A WHERE A.phone_number_id = @numberID group by A.first_name, A.last_name ORDER BY counts DESC LIMIT 1;
    UPDATE contacts set max_count = 0 where  contacts.phone_number_id = @numberID;
    UPDATE contacts set max_count = 1 where  contacts.id = @maxID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sync_contacts_new` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `sync_contacts_new`(IN `pnumber` BIGINT, IN `cid` BIGINT, IN `userId` BIGINT, IN `fname` VARCHAR(191) CHARSET utf8mb4, IN `lname` VARCHAR(191) CHARSET utf8mb4, IN `email` VARCHAR(191), IN `photo` VARCHAR(191), IN `gender` VARCHAR(191), IN `service_provider` VARCHAR(191), IN `state_circle` VARCHAR(191), IN `location` VARCHAR(191), IN `OutActiveDate` VARCHAR(191))
BEGIN
    SET @numberID = NULL;
    SET @contactID = NULL;
    SET @activeDate = NULL;
    SET @activeContactID = NULL;
    SELECT @numberID := id FROM phone_numbers WHERE phone_numbers.country_id = cid AND phone_numbers.number = pnumber;
    IF NOT @numberID IS NULL
    THEN 
        SELECT @contactID := id FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = userId;
        IF NOT @contactID IS NULL
        THEN
        	SELECT @activeDate := active_date FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = userId AND contacts.user_id = 0;
        	IF NOT @activeDate IS NULL
        	THEN
        		IF NOT OutActiveDate IS NULL
        		THEN
	        		SELECT @activeContactID := id FROM contacts WHERE contacts.phone_number_id = @numberID AND contacts.user_id = userId AND contacts.user_id = 0;
	        		UPDATE `contacts` SET 
	        		`first_name` = fname,
	        		`last_name` = lname, 
	        		`email` = email, 
	        		`photo` = photo, 
	        		`gender` = gender, 
	        		`service_provider` = service_provider, 
	        		`state_circle` = state_circle, 
	        		`location` = location, 
	        		`active_date` = OutActiveDate 
	        		WHERE contacts.id = @activeContactID 
	        		AND str_to_date(contacts.active_date, '%Y-%m-%d') < str_to_date(OutActiveDate, '%Y-%m-%d' );
	        	END IF;
        	ELSE	
            	UPDATE `contacts` SET 
            	`first_name` = fname, 
            	`last_name` = lname, 
            	`email` = email, 
            	`photo` = photo, 
            	`gender` = gender, 
            	`service_provider` = service_provider, 
            	`state_circle` = state_circle, 
            	`location` = location, 
            	`active_date` = OutActiveDate 
            	WHERE contacts.id = @contactID;
            END IF;
        ELSE
            INSERT INTO `contacts` (`first_name`, `last_name`, `user_id`, `phone_number_id`, `email`, `photo`, `gender`, `active_date`, `service_provider`, `location`, `state_circle`, `created_at`, `updated_at`) 
            VALUES (fname, lname, userId, @numberID, email, photo, gender, OutActiveDate, service_provider, location, state_circle, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
        END IF;
    ELSE
        INSERT INTO `phone_numbers` (`number`, `country_id`) 
        VALUES (pnumber, cid);
        SELECT @numberID := LAST_INSERT_ID();
        INSERT INTO `contacts` (`first_name`, `last_name`, `user_id`, `phone_number_id`, `email`, `photo`, `gender`, `active_date`, `service_provider`, `location`, `state_circle`, `created_at`, `updated_at`) 
        VALUES (fname, lname, userId, @numberID, email, photo, gender, OutActiveDate, service_provider, location, state_circle, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
    END IF;

    SELECT @maxID := A.id, count(A.first_name) as counts FROM contacts A WHERE A.phone_number_id = @numberID group by A.first_name, A.last_name ORDER BY counts DESC LIMIT 1;
    UPDATE contacts set max_count = 0 where  contacts.phone_number_id = @numberID;
    UPDATE contacts set max_count = 1 where  contacts.id = @maxID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_contacts_with_flag` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `update_contacts_with_flag`()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE j INT DEFAULT (SELECT id FROM phone_numbers ORDER BY id DESC LIMIT 1);
    WHILE (i <= j) DO
    	SELECT @numberID := id FROM phone_numbers WHERE phone_numbers.id = i;
	    IF NOT @numberID IS NULL
	    THEN
	      	SELECT @maxID := A.id, count(A.first_name) as counts FROM contacts A WHERE A.phone_number_id = @numberID AND A.user_id != 0 group by A.first_name, A.last_name ORDER BY counts DESC LIMIT 1;
		    UPDATE contacts set max_count = 0 where  contacts.phone_number_id = @numberID;
		    UPDATE contacts set max_count = 1 where  contacts.id = @maxID;
		    SET i = i + 1;
		END IF;
    END WHILE;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_message_status` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `update_message_status`(IN user_id BIGINT, IN statusTo INT, IN statusFrom INT)
BEGIN
    UPDATE messages SET status = statusTo WHERE receiver_id = user_id AND status = statusFrom;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_message_status_to_delivered` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `update_message_status_to_delivered`(IN user_id BIGINT, IN statusTo INT, IN statusFrom INT)
BEGIN
    UPDATE messages SET status = statusTo WHERE receiver_id = user_id AND status = statusFrom;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_message_status_to_read` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `update_message_status_to_read`(IN user_id BIGINT, IN sender_id BIGINT)
BEGIN
    UPDATE messages SET status = 2 WHERE receiver_id = user_id AND sender_id = sender_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_register_or_login` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `user_register_or_login`(IN `pnumber` BIGINT, IN `cid` BIGINT, IN `fname` VARCHAR(191) CHARSET utf8mb4, IN `lname` VARCHAR(191) CHARSET utf8mb4, IN `email` VARCHAR(191), IN `type` VARCHAR(191), IN `gender` VARCHAR(191), IN `device_type` VARCHAR(191), IN `device_token` VARCHAR(191), IN `device_imei` VARCHAR(191), IN `dob` VARCHAR(191), IN `photo` VARCHAR(191), OUT `Out_UserID` BIGINT)
BEGIN
    SELECT @numberID := id FROM phone_numbers WHERE phone_numbers.country_id = cid AND phone_numbers.number = pnumber;
    IF NOT @numberID IS NULL
    THEN 
        SELECT @userID := id FROM `users` WHERE users.phone_number_id = @numberID;
        IF NOT @userID IS NULL
        THEN
        	UPDATE `users` SET `deleted_at` = NULL, `device_type` = device_type, `device_token` = device_token, `device_imei` = device_imei WHERE users.id = @userID;
            UPDATE `user_profiles` SET `first_name` = fname, `last_name` = lname, `gender` = gender, `email` = email, `dob` = dob, `photo` = photo, `updated_at` = CURRENT_TIMESTAMP() WHERE user_profiles.user_id = @userID;
            SET Out_UserID = @userID;
        ELSE
            INSERT INTO `users` (`phone_number_id`, `type`, `device_type`, `device_token`, `device_imei`, `created_at`, `updated_at`) VALUES (@numberID, type, device_type, device_type, device_imei, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
            SELECT @userID := LAST_INSERT_ID();
            INSERT INTO `user_profiles` (`first_name`, `last_name`, `user_id`, `gender`, `email`, `dob`, `photo`, `created_at`, `updated_at`) VALUES (fname, lname, @userID, gender, email, dob, photo, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
            SET Out_UserID = @userID;
        END IF;
    ELSE
        INSERT INTO `phone_numbers` (`number`, `country_id`) VALUES (pnumber, cid);
        SELECT @numberID := LAST_INSERT_ID();
        INSERT INTO `users` (`phone_number_id`, `type`, `device_type`, `device_token`, `device_imei`, `created_at`, `updated_at`) VALUES (@numberID, type, device_type, device_type, device_imei, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
        SELECT @userID := LAST_INSERT_ID();
        INSERT INTO `user_profiles` (`first_name`, `last_name`, `user_id`, `gender`, `email`, `dob`, `photo`, `created_at`, `updated_at`) VALUES (fname, lname, @userID, gender, email, dob, photo, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
        SET Out_UserID = @userID;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `user_status_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`%` PROCEDURE `user_status_update`(IN user_id BIGINT, IN status VARCHAR(191))
BEGIN
	DELETE FROM user_statuses WHERE user_statuses.user_id = user_id;
	SELECT @userID := id FROM user_statuses WHERE user_statuses.user_id = user_id;
    IF NOT @userID IS NULL
    THEN
    	UPDATE `user_statuses` SET `status` = status, `updated_at` = CURRENT_TIMESTAMP() WHERE user_statuses.id = @userID;
    ELSE
		INSERT INTO `user_statuses` (`user_id`,`status`, `created_at`, `updated_at`) VALUES (user_id, status, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-28  7:29:31
