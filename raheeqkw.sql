-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: raheeqkw
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.24.04.1

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
-- Table structure for table `ad_translations`
--

DROP TABLE IF EXISTS `ad_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ad_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ad_id` bigint NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad_translations`
--

LOCK TABLES `ad_translations` WRITE;
/*!40000 ALTER TABLE `ad_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ad_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_roles`
--

DROP TABLE IF EXISTS `admin_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL,
  `role_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_roles`
--

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_auth_token` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Admin','admin@raheeq.com','mVROvKMwZgFNj4Z32728161676379899_3594923.jpg','123456789','$2y$10$0qJcxnXgT0nntpstigQZY..SVakSH51a1eG5uX4Qm2lgC12MbcSBW',NULL,NULL,'active',NULL,'2023-11-05 12:35:15');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (1,'lcKVU5MaTb7vD4G27129331670149577_7609278.png',NULL,'active','2022-12-04 11:26:17','2022-12-04 11:26:17',NULL),(2,'pZj8n4yxeJsNWdx33326741670149583_8297665.png',NULL,'active','2022-12-04 11:26:23','2022-12-04 11:26:23',NULL);
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `age_translations`
--

DROP TABLE IF EXISTS `age_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `age_translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `age_id` int NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `age_translations`
--

LOCK TABLES `age_translations` WRITE;
/*!40000 ALTER TABLE `age_translations` DISABLE KEYS */;
INSERT INTO `age_translations` VALUES (1,1,'en','KIDS','2022-12-08 08:23:44','2022-12-08 08:23:44',NULL),(2,1,'ar','أطفال','2022-12-08 08:23:44','2022-12-08 08:23:44',NULL),(3,2,'en','TEENS','2022-12-08 08:23:59','2022-12-08 08:23:59',NULL),(4,2,'ar','مراهقين','2022-12-08 08:23:59','2022-12-08 08:23:59',NULL);
/*!40000 ALTER TABLE `age_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ages`
--

DROP TABLE IF EXISTS `ages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name1` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ages`
--

LOCK TABLES `ages` WRITE;
/*!40000 ALTER TABLE `ages` DISABLE KEYS */;
INSERT INTO `ages` VALUES (1,NULL,'active','2022-12-08 08:23:44','2022-12-08 08:23:44',NULL),(2,NULL,'active','2022-12-08 08:23:59','2022-12-08 08:23:59',NULL);
/*!40000 ALTER TABLE `ages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `area_translations`
--

DROP TABLE IF EXISTS `area_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `area_translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `area_id` int NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_translations`
--

LOCK TABLES `area_translations` WRITE;
/*!40000 ALTER TABLE `area_translations` DISABLE KEYS */;
INSERT INTO `area_translations` VALUES (1,1,'en','salmiya','2023-02-14 09:24:14','2023-02-14 09:24:14',NULL),(2,1,'ar','السالمية','2023-02-14 09:24:14','2023-02-14 09:24:14',NULL),(3,2,'en','Hawally','2023-02-14 10:23:19','2024-01-09 12:39:13',NULL),(4,2,'ar','حولي','2023-02-14 10:23:19','2024-01-09 12:39:13',NULL),(5,3,'en','Jahra','2023-02-15 06:06:46','2023-02-15 06:06:46',NULL),(6,3,'ar','الجهراء','2023-02-15 06:06:46','2023-02-15 06:06:46',NULL),(7,4,'en','Mubarak Al-Kabeer','2023-02-15 06:07:05','2023-02-15 06:07:05',NULL),(8,4,'ar','مبارك الكبير\n','2023-02-15 06:07:05','2023-02-15 06:07:05',NULL),(9,5,'en','Sharq','2023-06-26 07:40:16','2023-06-26 07:40:16',NULL),(10,5,'ar','الشرق\n','2023-06-26 07:40:16','2023-06-26 07:40:16',NULL);
/*!40000 ALTER TABLE `area_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `areas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `delivery_charges` int DEFAULT NULL,
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,1,'active','2023-02-14 09:24:14','2023-02-14 09:24:14',NULL),(2,2,'active','2023-02-14 10:23:19','2023-02-15 05:28:52',NULL),(3,1,'active','2023-02-15 06:06:46','2023-02-15 06:06:46',NULL),(4,4,'active','2023-02-15 06:07:05','2023-02-15 06:07:05',NULL),(5,2,'active','2023-06-26 07:40:16','2023-06-26 07:40:58',NULL);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banner_translations`
--

DROP TABLE IF EXISTS `banner_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banner_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_id` bigint unsigned NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bannertranslations_banner_id_foreign` (`banner_id`),
  CONSTRAINT `bannertranslations_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner_translations`
--

LOCK TABLES `banner_translations` WRITE;
/*!40000 ALTER TABLE `banner_translations` DISABLE KEYS */;
INSERT INTO `banner_translations` VALUES (1,NULL,NULL,'en',1,'qrfFiE155R8gMFp10420691699190217_5308633.jpg',NULL,'2023-11-05 13:16:58','2023-11-05 13:16:58'),(2,NULL,NULL,'en',2,'fGvDVwfrSFd7dQV30331871699274740_2084496.jpg',NULL,'2023-11-06 12:45:40','2023-11-06 12:45:40'),(3,NULL,NULL,'en',3,'8lfXwFGXTwJQwRl53872521699274971_3132451.png',NULL,'2023-11-06 12:49:31','2023-11-06 12:49:31'),(4,NULL,NULL,'en',4,'fBn11x3FKfiIbW724369361719138502_3437315.webp',NULL,'2024-03-07 11:44:14','2024-06-23 10:28:22'),(5,NULL,NULL,'en',5,'DESXcQU2kNgqDuD66828941719139136_3101277.jpg',NULL,'2024-06-23 10:38:57','2024-06-23 10:38:57'),(6,NULL,NULL,'en',6,'jP2bD6P3niZkwwp45027631720595621_1598785.jpg',NULL,'2024-07-10 07:13:42','2024-07-10 07:13:42');
/*!40000 ALTER TABLE `banner_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image1` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type_link` tinyint(1) DEFAULT NULL COMMENT '0=inside , 1=outside',
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,NULL,NULL,NULL,NULL,'https://asal.hamiltonkw.co.in/en',NULL,'active','2023-11-05 13:16:58','2023-11-06 12:46:14','2023-11-06 12:46:14'),(2,NULL,NULL,NULL,NULL,'https://asal.hamiltonkw.co.in/en/vender_category/4',NULL,'active','2023-11-06 12:45:40','2023-11-06 12:47:55','2023-11-06 12:47:55'),(3,NULL,NULL,NULL,NULL,'https://asal.hamiltonkw.co.in/en/vender_category/4',NULL,'active','2023-11-06 12:49:31','2023-11-06 12:51:24','2023-11-06 12:51:24'),(4,NULL,NULL,NULL,NULL,'https://raheeq.app/en/products/5/hayley-fulton',NULL,'not_active','2024-03-07 11:44:14','2024-07-10 07:16:06',NULL),(5,NULL,NULL,NULL,NULL,'https://raheeq.app/en/products/5/hayley-fulton',NULL,'not_active','2024-06-23 10:38:57','2024-07-10 07:16:06',NULL),(6,NULL,NULL,NULL,NULL,'https://raheeq.app/',NULL,'active','2024-07-10 07:13:42','2024-07-10 07:13:42',NULL);
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brand_translations`
--

DROP TABLE IF EXISTS `brand_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brand_translations` (
  `id` bigint unsigned NOT NULL,
  `brand_id` bigint NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand_translations`
--

LOCK TABLES `brand_translations` WRITE;
/*!40000 ALTER TABLE `brand_translations` DISABLE KEYS */;
INSERT INTO `brand_translations` VALUES (1,1,'en','Pipsqueak','2022-12-04 13:32:15','2022-12-04 13:32:15',NULL),(2,1,'ar','Pipsqueak','2022-12-04 13:32:15','2022-12-04 13:32:15',NULL),(3,2,'en','Petit Elephant','2022-12-04 13:33:21','2022-12-04 13:33:21',NULL),(4,2,'ar','Petit Elephant','2022-12-04 13:33:21','2022-12-04 13:33:21',NULL),(5,3,'en','Funkey Monkey','2022-12-04 13:35:26','2022-12-04 13:35:26',NULL),(6,3,'ar','Funkey Monkey','2022-12-04 13:35:26','2022-12-04 13:35:26',NULL),(7,4,'en','Mothercare','2022-12-04 13:36:25','2022-12-04 13:36:25',NULL),(8,4,'ar','Mothercare','2022-12-04 13:36:25','2022-12-04 13:36:25',NULL);
/*!40000 ALTER TABLE `brand_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL,
  `is_featured` int NOT NULL DEFAULT '0',
  `bulk_discount_percentage` int NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,1,0,'gSj3CxmyxXPOHht78102751670157135_7677749.png','active','2022-12-04 13:32:15','2022-12-04 13:32:15',NULL),(2,1,0,'ocTV61GWmrKsAvE50445831670157201_8577577.png','active','2022-12-04 13:33:21','2022-12-04 13:33:21',NULL),(3,1,0,'awhsuyGukTug6au12272801670157326_5355420.png','active','2022-12-04 13:35:26','2022-12-04 13:35:26',NULL),(4,1,0,'go7EPYPQIsA5FX856385431670157385_8263821.png','active','2022-12-04 13:36:25','2022-12-04 13:36:25',NULL);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `user_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `fcm_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,NULL,'6686af24881896ClQip6tgqI',6,1,0,NULL,'2024-07-04 14:18:12','2024-07-04 14:18:23','2024-07-04 14:18:23'),(2,NULL,NULL,5,1,0,'eygqyYVELE41udlNuhLffL:APA91bGex_-uE9qZ5XZkyvYqIc0Lq5ic1ssiZPvasvncMEONGjrGMgI6utgJfX9J4eQIrXqu9uFugk76HJm-zfFKIwv5WarOaxHoOuWMQgJU97KWm4xMIiHkclZZ2x0DH_uhq42KqOnd','2024-07-04 14:18:29','2024-07-10 06:04:41','2024-07-10 06:04:41'),(3,NULL,NULL,6,1,0,'eygqyYVELE41udlNuhLffL:APA91bGex_-uE9qZ5XZkyvYqIc0Lq5ic1ssiZPvasvncMEONGjrGMgI6utgJfX9J4eQIrXqu9uFugk76HJm-zfFKIwv5WarOaxHoOuWMQgJU97KWm4xMIiHkclZZ2x0DH_uhq42KqOnd','2024-07-04 14:18:31','2024-07-10 06:04:49','2024-07-10 06:04:49'),(4,NULL,NULL,4,1,0,'eygqyYVELE41udlNuhLffL:APA91bGex_-uE9qZ5XZkyvYqIc0Lq5ic1ssiZPvasvncMEONGjrGMgI6utgJfX9J4eQIrXqu9uFugk76HJm-zfFKIwv5WarOaxHoOuWMQgJU97KWm4xMIiHkclZZ2x0DH_uhq42KqOnd','2024-07-04 14:18:32','2024-07-10 06:04:50','2024-07-10 06:04:50'),(5,NULL,NULL,1,1,0,'eygqyYVELE41udlNuhLffL:APA91bGex_-uE9qZ5XZkyvYqIc0Lq5ic1ssiZPvasvncMEONGjrGMgI6utgJfX9J4eQIrXqu9uFugk76HJm-zfFKIwv5WarOaxHoOuWMQgJU97KWm4xMIiHkclZZ2x0DH_uhq42KqOnd','2024-07-04 14:18:50','2024-07-11 11:28:35',NULL),(9,NULL,NULL,6,1,0,'e-Ng3DeiTKKXiBigXZqtYg:APA91bGeO_zttHWpRKEHxpAKEwcKQYMdPpcfZeTC8oBnP-6dhpq_h4O6cAC7wuJhhf_C4CyOVi4BsFWfKQKMRxFu4bQbJp75XHaLdz7uvaWSZs-Fa7onGf2Qght100e41h1n40JQ_yEk','2024-07-04 15:14:51','2024-07-10 06:04:49','2024-07-10 06:04:49'),(10,72,NULL,5,1,0,'random-fcm46394976','2024-07-04 15:43:13','2024-07-10 06:04:41','2024-07-10 06:04:41'),(12,NULL,NULL,5,1,0,'eylh5JtFe0Nvi6biH4H76i:APA91bEbWhp7PgfL3OrSoxVKUW0sYIxRdg6xL4Yqtqyst1mW8seHzu6HCRGyOglXQV1cYkZscpAF2hvXyaGs2w8pCCeJ8VwyZr9lHO2eMC0ZEsc1OA2dzMhSn0E1gyT_JzEqiBCkbzMk','2024-07-07 12:39:16','2024-07-10 06:04:41','2024-07-10 06:04:41'),(15,NULL,NULL,6,1,0,NULL,'2024-07-08 06:48:59','2024-07-10 06:04:49','2024-07-10 06:04:49'),(17,NULL,NULL,9,1,0,'dcjd1PDxLUVVr4wVoZZ5HG:APA91bFieL6boI3NSXN-Bib1gaISAfF7CA767Q83k3oP1sNmPmzsmX2Z9OAid8-_z9LS-wAf8wU13FqcXnhJyl3CqqOfRmTU-b6WhiC6eWsybYgu_9GfvRp9Ccx4_kqGCsAOY1AIvU5f','2024-07-08 06:54:47','2024-07-10 06:04:47','2024-07-10 06:04:47'),(23,NULL,NULL,9,1,0,'random-fcm32924651','2024-07-08 10:37:57','2024-07-10 06:04:47','2024-07-10 06:04:47'),(24,NULL,NULL,9,1,0,'random-fcm81256100','2024-07-08 10:38:29','2024-07-10 06:04:47','2024-07-10 06:04:47'),(25,NULL,'668bc57f5ab6e1074sz4aJNn2',10,1,0,NULL,'2024-07-08 10:54:55','2024-07-08 11:18:44','2024-07-08 11:18:44'),(30,NULL,NULL,10,1,0,'cEzqhgXHSfSm6RoPXM-_sx:APA91bF_iV1W9gccm2lDuIf2Txa2vVwRBsFpYuJJlBVifkDXBd8-vxyokRTgZEwf-bAL7cVzpGMC2g8YOYxRdPQplPlqQIrOrDvmKpNW2O696CSCJ160D2L18KA5RsRg_xEB8CsM9NvP','2024-07-08 10:56:20','2024-07-08 10:57:47','2024-07-08 10:57:47'),(31,NULL,NULL,6,1,0,NULL,'2024-07-08 14:16:47','2024-07-10 06:04:49','2024-07-10 06:04:49'),(32,NULL,NULL,9,1,0,NULL,'2024-07-08 14:16:58','2024-07-10 06:04:47','2024-07-10 06:04:47'),(33,NULL,NULL,9,1,0,NULL,'2024-07-08 14:17:34','2024-07-10 06:04:47','2024-07-10 06:04:47'),(34,NULL,NULL,10,2,0,NULL,'2024-07-08 14:18:30','2024-07-10 06:04:46','2024-07-10 06:04:46'),(35,NULL,NULL,10,2,0,NULL,'2024-07-08 14:24:56','2024-07-10 06:04:46','2024-07-10 06:04:46'),(50,30,NULL,5,1,0,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','2024-07-09 14:29:49','2024-07-10 06:04:41','2024-07-10 06:04:41'),(51,NULL,'668e2482e60e440RA3c1kN7x',4,1,0,NULL,'2024-07-10 06:04:50','2024-07-10 06:04:50','2024-07-10 06:04:50'),(52,NULL,'668e2482e60e440RA3c1kN7x',1,1,0,NULL,'2024-07-10 06:04:51','2024-07-10 06:04:51','2024-07-10 06:04:51'),(54,NULL,NULL,10,1,0,NULL,'2024-07-10 13:29:45','2024-07-10 13:29:45',NULL),(55,NULL,NULL,10,1,0,NULL,'2024-07-10 13:30:42','2024-07-10 13:30:42',NULL),(56,NULL,NULL,10,1,0,'dbGqxwts3E0_ueNBI7vf0n:APA91bEWwx6pdpzgsPTDtOjn5CxnfuXuUlyFsCRVFPKs_o6cmuZgKLpt8_Ipv9TsAftDxZbrSXdTyj65Lz1WP2OYtA5e4kgvKwfimasXRK1Ns2n63wxkXOSnVNLkkTf1vXu5GxL5j_23','2024-07-11 05:04:44','2024-07-11 05:04:44',NULL),(57,NULL,NULL,5,2,0,'dilDSqjYVE7jpvDgB3AW4j:APA91bEfUHDUs7r4i4kwXllJqmkLSC7mv6uCjwjU6iKhUSOJv4WCnzW3IxMMjE3dQr-deCS-cReH2bxeVDFRnw36e_W2swjAQU1QNR6IJF3pR3yWyw8oQ_s57gbicp1YFqgVenYNz-uq','2024-07-11 07:32:09','2024-07-11 07:33:03',NULL),(58,NULL,NULL,10,3,0,'dilDSqjYVE7jpvDgB3AW4j:APA91bEfUHDUs7r4i4kwXllJqmkLSC7mv6uCjwjU6iKhUSOJv4WCnzW3IxMMjE3dQr-deCS-cReH2bxeVDFRnw36e_W2swjAQU1QNR6IJF3pR3yWyw8oQ_s57gbicp1YFqgVenYNz-uq','2024-07-11 07:33:22','2024-07-11 07:33:35',NULL),(59,NULL,NULL,6,1,0,NULL,'2024-07-11 10:45:21','2024-07-11 10:45:21',NULL),(60,NULL,NULL,9,1,0,NULL,'2024-07-11 10:48:05','2024-07-11 10:48:05',NULL),(61,NULL,NULL,6,1,0,NULL,'2024-07-11 10:49:14','2024-07-11 10:49:14',NULL),(62,NULL,NULL,5,2,0,'eTrdOiXyMUAWhlLb8jWljE:APA91bEAgn6_HM9V52SkrsDH_094_eTL0YxKFl92tilkSIbabMds176s5jlANxfxKZ2qhb-_F_7oZAz-x3sJaS-aBOcEaLZAVUoxV6UiapR8vWbuAZgT6l9Mbz2CevvVwPV2es6ICNBw','2024-07-11 11:13:38','2024-07-11 11:14:33',NULL),(63,NULL,NULL,5,1,0,'eygqyYVELE41udlNuhLffL:APA91bGex_-uE9qZ5XZkyvYqIc0Lq5ic1ssiZPvasvncMEONGjrGMgI6utgJfX9J4eQIrXqu9uFugk76HJm-zfFKIwv5WarOaxHoOuWMQgJU97KWm4xMIiHkclZZ2x0DH_uhq42KqOnd','2024-07-11 11:28:42','2024-07-11 11:28:42',NULL),(64,NULL,NULL,6,1,0,'eygqyYVELE41udlNuhLffL:APA91bGex_-uE9qZ5XZkyvYqIc0Lq5ic1ssiZPvasvncMEONGjrGMgI6utgJfX9J4eQIrXqu9uFugk76HJm-zfFKIwv5WarOaxHoOuWMQgJU97KWm4xMIiHkclZZ2x0DH_uhq42KqOnd','2024-07-11 11:29:41','2024-07-11 11:29:41',NULL),(66,NULL,NULL,10,1,0,'fyEU8_OlQeSB4ttZIZBWcE:APA91bEbJwa2HJ3DCxpEOHypdZ-RVFrBCalp8YQ5PlvcgK_b8wV44NTyV8osHcSV9bv7vxSzRv0U28pMLic9jTVNWQDmyojkQgr4PAoHqfQ0qwiqj5vhfOfP9POsFynb_muHb2o1Tu3i','2024-07-11 11:31:33','2024-07-11 11:31:33',NULL),(67,NULL,NULL,6,3,0,'di1-A8fL90zNr7Z_LWzS9x:APA91bGVM4O-p9LhF8uBqvBZT4CP3NxZIOF_oRbSpaIon-DWK2xu5LKBclCejg14UWp_fS5ugqDT3-50vKoQUt1F54WjrIX8f5V4_6Qav6KUrSLrA4oUZOaA9XkUL-Chje8oEUxgxY19','2024-07-11 11:32:05','2024-07-14 11:34:37',NULL),(69,NULL,NULL,9,1,0,'fyEU8_OlQeSB4ttZIZBWcE:APA91bEbJwa2HJ3DCxpEOHypdZ-RVFrBCalp8YQ5PlvcgK_b8wV44NTyV8osHcSV9bv7vxSzRv0U28pMLic9jTVNWQDmyojkQgr4PAoHqfQ0qwiqj5vhfOfP9POsFynb_muHb2o1Tu3i','2024-07-11 11:40:32','2024-07-11 11:40:32',NULL),(75,NULL,NULL,10,1,0,'cV4sBTtoWU0Co2M9OzVvsD:APA91bFcYW-q3thprtZZT7YsM6k53UxLwpn5ijqlEuGeRhIwFnvFh1G-sHeyQjqPQ3k-rdEeL1vYpmUZTs0cdi3U-TA01SuM88bBw7G9LqEMsQsZJ8cdjEZGT9nogToyODgA1Hga1Qck','2024-07-11 12:12:17','2024-07-11 12:12:17',NULL),(79,NULL,NULL,5,1,0,NULL,'2024-07-14 11:59:01','2024-07-14 11:59:01',NULL),(80,NULL,NULL,5,1,0,NULL,'2024-07-14 12:00:01','2024-07-14 12:00:01',NULL),(83,NULL,NULL,11,1,0,NULL,'2024-07-15 12:36:29','2024-07-15 12:36:29',NULL),(84,NULL,NULL,6,1,0,NULL,'2024-07-15 12:37:54','2024-07-15 12:37:54',NULL),(85,NULL,NULL,6,1,0,NULL,'2024-07-15 19:10:36','2024-07-15 19:10:36',NULL),(86,NULL,NULL,5,1,0,NULL,'2024-07-15 19:11:15','2024-07-15 19:11:15',NULL),(87,NULL,NULL,6,1,0,NULL,'2024-07-16 11:41:33','2024-07-16 11:41:33',NULL),(88,NULL,NULL,5,1,0,NULL,'2024-07-16 11:42:42','2024-07-16 11:42:42',NULL),(89,NULL,NULL,9,1,0,'e7zuMexBek6vnPyAuJQfOY:APA91bEa8MBbBW06ze0ZqdB973EhRgYtFwOuPgltnub71uHiojOCamXsbks6lAoEt252hwl7QrQzoq-JX3G4SuXy7aJuXRCppPDfHRfEmxpDAntABUoKJtJiFcyysHB_NFURzRxLgavT','2024-07-16 13:54:55','2024-07-16 13:54:55',NULL),(91,NULL,NULL,10,1,0,NULL,'2024-07-18 09:40:37','2024-07-18 09:40:37',NULL),(92,NULL,NULL,6,1,0,NULL,'2024-07-18 15:24:06','2024-07-18 15:24:06',NULL),(93,NULL,NULL,10,1,0,NULL,'2024-07-18 15:24:24','2024-07-18 15:24:24',NULL),(94,NULL,NULL,6,1,0,NULL,'2024-07-18 15:24:58','2024-07-18 15:24:58',NULL),(95,NULL,NULL,10,1,0,NULL,'2024-07-18 15:27:28','2024-07-18 15:27:28',NULL),(96,NULL,NULL,6,1,0,NULL,'2024-07-19 10:07:57','2024-07-19 10:07:57',NULL),(97,NULL,NULL,10,1,0,NULL,'2024-07-19 10:09:09','2024-07-19 10:09:09',NULL),(98,NULL,NULL,6,1,0,NULL,'2024-07-27 16:28:59','2024-07-27 16:28:59',NULL),(99,NULL,NULL,9,1,0,NULL,'2024-07-27 16:29:00','2024-07-27 16:29:00',NULL),(100,NULL,NULL,10,1,0,'fJPLjTjdSQyxEOGCXRBidU:APA91bHMEgZzYIWT0KN2pbfq5wBp8T7V5bPOsyHESahopwd-Jga5aNoyKeVXZCWa0cKbObH4uVI9YClQASy69-AehPQBTTu5uwJRnVnto6HhS6Aq_cgznX0Ykowzk4YCXHgU58CjW07H','2024-07-28 12:23:23','2024-07-28 12:23:23',NULL),(101,NULL,NULL,9,1,0,'fJPLjTjdSQyxEOGCXRBidU:APA91bHMEgZzYIWT0KN2pbfq5wBp8T7V5bPOsyHESahopwd-Jga5aNoyKeVXZCWa0cKbObH4uVI9YClQASy69-AehPQBTTu5uwJRnVnto6HhS6Aq_cgznX0Ykowzk4YCXHgU58CjW07H','2024-07-28 12:23:24','2024-07-28 12:23:24',NULL);
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL DEFAULT '0',
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `image` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,0,'active','afq9eVX7nOonBNv84582481696332073_6644381.jpg','2023-10-03 11:21:13','2023-11-06 13:23:57','2023-11-06 13:23:57'),(2,0,'not_active','5Y2vGnjGsKL6qHc34165561696338465_2518333.jpg','2023-10-03 13:07:45','2023-10-03 13:07:45',NULL),(3,0,'active','jdm3eCRTy9c1PVS51528731720102858_2331873.jpg','2024-07-04 14:20:58','2024-07-04 14:20:58',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_translations`
--

DROP TABLE IF EXISTS `category_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_translations`
--

LOCK TABLES `category_translations` WRITE;
/*!40000 ALTER TABLE `category_translations` DISABLE KEYS */;
INSERT INTO `category_translations` VALUES (1,'bin',1,'2023-10-03 11:21:13','2023-11-06 06:47:32',NULL,'en'),(2,'Demo1',1,'2023-10-03 11:21:13','2023-10-03 11:21:13',NULL,'ar'),(3,'honey',2,'2023-10-03 13:07:45','2023-11-06 06:47:20',NULL,'en'),(4,'test',2,'2023-10-03 13:07:45','2023-10-03 13:07:45',NULL,'ar'),(5,'Vitamin D',3,'2024-07-04 14:20:58','2024-07-04 14:20:58',NULL,'en'),(6,'Vitamin D',3,'2024-07-04 14:20:58','2024-07-04 14:20:58',NULL,'ar');
/*!40000 ALTER TABLE `category_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_users`
--

DROP TABLE IF EXISTS `chat_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_users` (
  `id` int NOT NULL,
  `chat_id` int NOT NULL,
  `user_id` int NOT NULL,
  `deleted` int DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_users`
--

LOCK TABLES `chat_users` WRITE;
/*!40000 ALTER TABLE `chat_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chats` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `type` int NOT NULL COMMENT ' 1=>private;2=>group ',
  `last_used` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chats`
--

LOCK TABLES `chats` WRITE;
/*!40000 ALTER TABLE `chats` DISABLE KEYS */;
/*!40000 ALTER TABLE `chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` int NOT NULL,
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city_translations`
--

DROP TABLE IF EXISTS `city_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city_translations` (
  `id` bigint unsigned NOT NULL,
  `city_id` bigint NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city_translations`
--

LOCK TABLES `city_translations` WRITE;
/*!40000 ALTER TABLE `city_translations` DISABLE KEYS */;
INSERT INTO `city_translations` VALUES (1,1,'en','Al Ahmadi','2022-10-02 11:18:58','2022-10-02 11:18:58',NULL),(2,1,'ar','الاحمدي','2022-10-02 11:18:58','2022-10-02 11:18:58',NULL),(3,2,'en','Al Firwania','2022-10-02 11:19:50','2022-10-02 11:19:50',NULL),(4,2,'ar','الفروانية','2022-10-02 11:19:50','2022-10-02 11:19:50',NULL),(5,3,'en','Jahra Governorate','2022-10-02 12:43:09','2022-10-02 12:43:09',NULL),(6,3,'ar',' محافظة الجهراء','2022-10-02 12:43:09','2022-10-02 12:43:09',NULL),(7,4,'en','Hawalli','2022-10-02 12:45:04','2022-10-02 12:45:04',NULL),(8,4,'ar','حولي','2022-10-02 12:45:04','2022-10-02 12:45:04',NULL);
/*!40000 ALTER TABLE `city_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color_translations`
--

DROP TABLE IF EXISTS `color_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `color_translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `color_id` int NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color_translations`
--

LOCK TABLES `color_translations` WRITE;
/*!40000 ALTER TABLE `color_translations` DISABLE KEYS */;
INSERT INTO `color_translations` VALUES (1,1,'en','Red','2021-06-20 11:48:29','2021-05-09 11:48:29',NULL),(2,1,'ar','احمر','2021-06-20 11:48:29','2021-05-09 11:48:29',NULL),(3,2,'en','Green','2021-06-20 18:38:32','2021-06-06 18:38:32',NULL),(4,2,'ar','اخضر','2021-06-20 18:38:32','2021-06-06 18:38:32',NULL),(5,3,'en','Black','2021-11-06 06:57:10','2021-11-06 06:57:10',NULL),(6,3,'ar','اسود','2021-11-06 06:57:10','2021-11-06 07:01:04',NULL),(7,4,'en','fefe','2021-11-18 04:33:51','2021-11-18 04:33:51',NULL),(8,4,'ar','fb','2021-11-18 04:33:51','2021-11-18 04:34:00',NULL),(9,5,'en','White','2021-12-20 13:57:29','2022-09-10 20:35:01',NULL),(10,5,'ar','ابيض','2021-12-20 13:57:29','2021-12-20 13:57:29',NULL),(11,6,'en','wwwww333','2022-04-13 08:00:46','2022-04-13 08:00:59','2022-12-06 08:58:25'),(12,6,'ar','wsss','2022-04-13 08:00:46','2022-04-13 08:00:46','2022-12-06 08:58:29'),(13,7,'en','ggg','2022-05-19 04:17:12','2022-05-19 04:17:12','2022-12-25 08:25:19'),(14,7,'ar','مجموعة 1','2022-05-19 04:17:12','2022-05-19 04:17:12','2022-12-25 08:25:15'),(15,8,'en','Pink','2022-08-21 07:43:53','2022-08-21 07:43:53',NULL),(16,8,'ar','وردي','2022-08-21 07:43:53','2022-09-06 20:20:19',NULL),(17,9,'en','Navy Blue','2022-09-06 20:21:03','2022-09-06 20:21:03',NULL),(18,9,'ar','كحلي','2022-09-06 20:21:03','2022-09-06 20:21:03',NULL),(19,10,'en','Orange','2022-09-07 01:03:42','2022-09-07 01:03:42',NULL),(20,10,'ar','برتقالي','2022-09-07 01:03:42','2022-09-07 01:03:42',NULL);
/*!40000 ALTER TABLE `color_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `colors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'DaDa App','DaDa@app.com','0521234856',1,'ContactUs Message From Saji','2022-12-04 09:38:01','2023-02-14 12:52:26',NULL),(2,'Test','yash@hamiltonkw.com',NULL,1,'testing','2023-02-13 12:42:08','2023-02-14 12:52:21',NULL),(3,'yash tailor','yash@hamiltonkw.com',NULL,1,'testing','2023-02-14 05:46:04','2023-02-14 12:52:12',NULL),(4,'Test','yash@hamiltonkw.com',NULL,1,'Testing Pido','2023-02-15 09:47:20','2023-02-15 09:47:44',NULL),(5,'yash','yash@hamiltonkw.com',NULL,1,'hello pido testing message','2023-02-16 06:11:45','2023-06-15 07:47:51',NULL),(6,'yash','yash@hamiltonkw.com',NULL,1,'testing','2023-02-16 06:12:20','2023-02-21 08:22:35',NULL),(7,'Jemima Fowler','nihom@mailinator.com',NULL,1,'Sapiente sed reprehe','2023-08-20 11:02:19','2023-10-03 11:58:30',NULL),(8,'yash','yash@hamiltonkw.com',NULL,1,'hello test','2023-11-05 10:53:19','2023-11-05 10:53:29',NULL),(9,'yash','yash@hamiltonkw.com',NULL,1,'test','2023-11-05 10:55:10','2023-11-05 10:55:17',NULL);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` int NOT NULL,
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country_translations`
--

DROP TABLE IF EXISTS `country_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country_translations` (
  `id` bigint unsigned NOT NULL,
  `country_id` bigint NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country_translations`
--

LOCK TABLES `country_translations` WRITE;
/*!40000 ALTER TABLE `country_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `country_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent` int NOT NULL,
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `product_id` int NOT NULL,
  `vender_id` int NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,'test123',50,'active',4,5,'2023-11-06 00:00:00','2023-11-08 00:00:00','2023-11-06 06:56:06','2023-11-06 06:56:06',NULL),(2,'diwali',80,'active',0,0,'2023-11-01 00:00:00','2023-12-07 00:00:00','2023-11-06 07:01:46','2023-11-06 07:01:46',NULL),(3,'test',50,'active',6,6,'2024-06-29 00:00:00','2024-09-24 00:00:00','2024-06-27 11:34:08','2024-06-27 11:34:08',NULL),(4,'yash',10,'active',7,7,'2024-07-01 00:00:00','2024-07-22 00:00:00','2024-07-01 06:38:24','2024-07-01 06:38:24',NULL),(5,'teet',50,'active',10,13,'2024-07-08 00:00:00','2024-07-26 00:00:00','2024-07-08 10:43:00','2024-07-08 10:43:00',NULL);
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_comment_translations`
--

DROP TABLE IF EXISTS `customer_comment_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_comment_translations` (
  `id` int NOT NULL,
  `customer_comment_id` int NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_job` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_comment_translations`
--

LOCK TABLES `customer_comment_translations` WRITE;
/*!40000 ALTER TABLE `customer_comment_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_comment_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_comments`
--

DROP TABLE IF EXISTS `customer_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_comments` (
  `id` int NOT NULL,
  `rate` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_comments`
--

LOCK TABLES `customer_comments` WRITE;
/*!40000 ALTER TABLE `customer_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deleverynotes`
--

DROP TABLE IF EXISTS `deleverynotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deleverynotes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Delivery_note` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deleverynotes`
--

LOCK TABLES `deleverynotes` WRITE;
/*!40000 ALTER TABLE `deleverynotes` DISABLE KEYS */;
INSERT INTO `deleverynotes` VALUES (1,'Ring the bell please','2023-10-02 06:59:45','2023-10-02 13:04:44',NULL),(2,'Leave at the door','2023-10-02 11:26:07','2023-10-02 11:26:07',NULL),(3,'Call when you arrive','2023-10-02 11:26:23','2023-10-02 11:26:23',NULL),(4,'Keeping Hands Clean','2023-10-03 07:22:38','2024-04-03 10:46:23','2024-04-03 10:46:23');
/*!40000 ALTER TABLE `deleverynotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
INSERT INTO `faq` VALUES (1,'active','2022-12-04 08:12:09','2022-12-04 08:12:09',NULL),(2,'active','2022-12-04 08:12:09','2022-12-04 08:12:09',NULL);
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq_translations`
--

DROP TABLE IF EXISTS `faq_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq_translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `faq_id` int NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq_translations`
--

LOCK TABLES `faq_translations` WRITE;
/*!40000 ALTER TABLE `faq_translations` DISABLE KEYS */;
INSERT INTO `faq_translations` VALUES (1,1,'en','What does the app do','It provides you with online shopping service','2022-12-04 08:13:51','2022-12-04 08:13:51',NULL),(2,1,'ar','ماذا يعمل التطبيق','يقدم لك خدمة التسوق الالكتروني ','2022-12-04 08:13:51','2022-12-04 08:13:51',NULL);
/*!40000 ALTER TABLE `faq_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorites` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `product_id` int unsigned NOT NULL,
  `fcm_token` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` VALUES (7,10,5,NULL,'2022-10-27 16:01:10','2022-10-27 16:01:10',NULL),(8,11,1,NULL,'2022-10-30 14:57:36','2022-10-30 14:57:36',NULL),(18,1,1,NULL,'2022-11-03 11:13:11','2023-10-29 07:19:53','2023-10-29 07:19:53'),(19,1,2,NULL,'2022-11-03 11:24:57','2023-11-05 10:38:19','2023-11-05 10:38:19'),(22,8,5,NULL,'2022-11-17 12:01:35','2022-11-17 12:01:35',NULL),(23,NULL,2,'fNoBdSKr-kmEuLr5JwAyW5:APA91bFeAfjPt-kSLKjr2qiL__ZGjBpOIVGwNWGNObHbvuC9YOFJYjysTG0QZDXV-6o7RaOALk_9KJc0T2Hbo5CMLOu416wJozkk8Ea4p6Sl-3q_TZE9clqDPrg6LIn34iQxuom2aWbT','2022-12-10 21:37:26','2022-12-10 21:37:26',NULL),(24,4,2,NULL,'2023-02-13 13:02:51','2023-02-13 13:02:54','2023-02-13 13:02:54'),(26,4,2,NULL,'2023-02-14 05:40:29','2023-02-14 05:40:39','2023-02-14 05:40:39'),(28,NULL,4,'fy_kW8qRSBGyBBkOOyDycH:APA91bEcWzBMZu8eOIqBO3CZkJgoz6BRohcQey1LdbjKAYoQHiYAXdpTWABAitvEr2ybrr1NoOSuYA4GvYosCHk4E7KTjjwW9E7qw4QiSGoxXVowAl99WUunF4u62_iYPzUvEMd3ocb8','2023-02-14 10:26:27','2023-02-14 10:26:27',NULL),(34,4,1,NULL,'2023-02-16 06:28:23','2023-02-19 05:40:38','2023-02-19 05:40:38'),(37,6,5,NULL,'2023-06-22 11:10:09','2023-08-29 11:39:21','2023-08-29 11:39:21'),(38,6,46,NULL,'2023-08-29 11:39:07','2023-08-29 11:39:10','2023-08-29 11:39:10'),(39,6,46,NULL,'2023-08-29 11:39:12','2023-08-29 11:39:22','2023-08-29 11:39:22'),(40,45,49,NULL,'2023-08-30 07:01:03','2023-08-30 07:01:08','2023-08-30 07:01:08'),(41,45,46,NULL,'2023-08-30 08:07:42','2023-08-30 08:07:43','2023-08-30 08:07:43'),(42,45,49,NULL,'2023-08-30 08:14:38','2023-08-30 08:14:38',NULL),(43,45,1,NULL,'2023-08-30 08:36:28','2023-08-30 08:36:29','2023-08-30 08:36:29'),(44,45,46,NULL,'2023-08-30 09:19:07','2023-08-30 09:19:07',NULL),(45,45,52,NULL,'2023-08-30 09:19:11','2023-08-30 09:19:11',NULL),(46,49,45,NULL,'2023-09-04 04:11:56','2023-09-04 04:12:22','2023-09-04 04:12:22'),(47,49,46,NULL,'2023-09-04 04:12:01','2023-09-04 04:12:21','2023-09-04 04:12:21'),(48,49,56,NULL,'2023-09-04 04:12:02','2023-09-04 04:12:19','2023-09-04 04:12:19'),(49,49,1,NULL,'2023-09-04 04:12:26','2023-09-04 04:12:28','2023-09-04 04:12:28'),(50,49,56,NULL,'2023-09-04 10:56:38','2023-09-04 10:56:38',NULL),(51,6,43,NULL,'2023-09-05 07:42:56','2023-09-05 07:42:56',NULL),(52,6,1,NULL,'2023-09-05 07:45:12','2023-09-05 07:45:59','2023-09-05 07:45:59'),(53,6,1,NULL,'2023-09-05 07:46:02','2023-09-05 07:46:03','2023-09-05 07:46:03'),(54,6,1,NULL,'2023-09-05 07:46:04','2023-09-05 07:46:05','2023-09-05 07:46:05'),(55,6,1,NULL,'2023-09-05 07:46:05','2023-09-05 07:46:19','2023-09-05 07:46:19'),(56,6,1,NULL,'2023-09-05 07:46:24','2023-09-05 08:05:03','2023-09-05 08:05:03'),(57,6,45,NULL,'2023-09-05 07:46:41','2023-09-05 08:45:04','2023-09-05 08:45:04'),(58,6,46,NULL,'2023-09-05 07:46:48','2023-09-05 07:46:54','2023-09-05 07:46:54'),(59,6,56,NULL,'2023-09-05 07:47:00','2023-09-05 07:47:13','2023-09-05 07:47:13'),(60,6,56,NULL,'2023-09-05 07:58:15','2023-09-05 07:59:22','2023-09-05 07:59:22'),(61,6,56,NULL,'2023-09-05 08:00:02','2023-09-05 08:00:22','2023-09-05 08:00:22'),(62,6,56,NULL,'2023-09-05 08:00:50','2023-09-05 08:01:57','2023-09-05 08:01:57'),(63,6,46,NULL,'2023-09-05 08:01:53','2023-09-05 08:01:56','2023-09-05 08:01:56'),(64,6,56,NULL,'2023-09-05 08:02:25','2023-09-05 08:08:04','2023-09-05 08:08:04'),(65,6,56,NULL,'2023-09-05 08:26:55','2023-09-05 08:27:24','2023-09-05 08:27:24'),(66,6,46,NULL,'2023-09-05 08:27:55','2023-09-05 08:27:56','2023-09-05 08:27:56'),(67,6,56,NULL,'2023-09-05 08:32:38','2023-09-05 08:32:38',NULL),(68,52,45,NULL,'2023-09-10 11:19:21','2023-09-10 11:19:21',NULL),(69,1,1,NULL,'2023-10-29 07:19:55','2023-10-29 07:19:58','2023-10-29 07:19:58'),(70,1,2,NULL,'2023-11-05 10:38:20','2023-11-05 10:38:21','2023-11-05 10:38:21'),(71,1,2,NULL,'2023-11-05 10:38:21','2023-11-05 10:38:28','2023-11-05 10:38:28'),(72,1,3,NULL,'2023-11-06 13:36:21','2023-11-06 13:36:25','2023-11-06 13:36:25'),(73,1,3,NULL,'2023-11-06 13:36:26','2023-11-06 13:36:30','2023-11-06 13:36:30'),(74,9,3,NULL,'2024-01-09 12:31:53','2024-01-09 12:31:53',NULL),(75,9,2,NULL,'2024-01-09 12:31:58','2024-01-09 12:31:58',NULL),(76,11,4,NULL,'2024-06-04 18:22:11','2024-06-04 18:22:11',NULL),(79,12,4,NULL,'2024-06-09 07:43:54','2024-06-09 07:43:54',NULL),(89,NULL,7,'fId2AalBR-y9z68MM5SaM7:APA91bGAQhQeJAWh5Zzt61Ae21PMUa8EOslhtJ0SrX4ywqJr23SEoMYsrb2U8AG3Da1uzEvR2Wd7PkWMq-GVyd5gKeucQPq7nTTuGWdh-ER2Zx8Kuae48k5v1hGmqTu1c1AqA0i8QTB1','2024-07-01 14:39:06','2024-07-01 14:39:06',NULL),(96,29,5,NULL,'2024-07-02 14:49:18','2024-07-02 14:49:18',NULL),(97,29,6,NULL,'2024-07-02 14:49:23','2024-07-02 14:49:23',NULL),(120,72,5,NULL,'2024-07-09 11:14:51','2024-07-09 11:14:51',NULL),(122,30,6,NULL,'2024-07-09 11:15:56','2024-07-09 11:15:56',NULL),(130,NULL,10,'dcjd1PDxLUVVr4wVoZZ5HG:APA91bFieL6boI3NSXN-Bib1gaISAfF7CA767Q83k3oP1sNmPmzsmX2Z9OAid8-_z9LS-wAf8wU13FqcXnhJyl3CqqOfRmTU-b6WhiC6eWsybYgu_9GfvRp9Ccx4_kqGCsAOY1AIvU5f','2024-07-11 11:55:47','2024-07-11 11:55:47',NULL);
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feature_translations`
--

DROP TABLE IF EXISTS `feature_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feature_translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `feature_id` int NOT NULL,
  `locale` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feature_translations`
--

LOCK TABLES `feature_translations` WRITE;
/*!40000 ALTER TABLE `feature_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `feature_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('active','not_active') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,'ZiYz1rTFyvd6zm174730041668321953_9222586.png','active','2022-11-13 06:45:53','2022-11-13 06:45:53',NULL),(2,'ZnyL0be3tB4txsR20526001668322815_1998267.png','active','2022-11-13 07:00:15','2022-11-13 07:00:15',NULL),(3,'qLENV3xSQnG0yGO39679501668323911_2566966.png','active','2022-11-13 07:18:31','2022-11-13 07:18:31',NULL),(4,'foqycRBQZwR1fmg52390671668323917_8099228.png','active','2022-11-13 07:18:37','2022-11-13 07:18:37',NULL),(5,'osYvJb2mA6Toq4744363591668323926_9223173.png','active','2022-11-13 07:18:46','2022-11-13 07:18:46',NULL),(6,'VzYOSJlSl6UIDbV67881241668324489_9654922.png','active','2022-11-13 07:28:09','2022-11-13 07:28:09',NULL),(7,'WhfmXL2VusYtLx374344311668325479_1215857.png','active','2022-11-13 07:44:39','2022-11-13 07:44:39',NULL);
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_page_translations`
--

DROP TABLE IF EXISTS `landing_page_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `landing_page_translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `locale` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landing_page_id` int DEFAULT NULL,
  `title_slider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_slider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_component_one` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_component_one` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_about` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_about` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_share` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_share` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_screenshot` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_screenshot` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `title_component_two` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descriptin_component_two` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_component_three` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descriptin_component_three` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_page_translations`
--

LOCK TABLES `landing_page_translations` WRITE;
/*!40000 ALTER TABLE `landing_page_translations` DISABLE KEYS */;
INSERT INTO `landing_page_translations` VALUES (1,'en',1,'title slider',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-12-30 06:20:27','2022-01-03 10:57:38',NULL,NULL,NULL,NULL,NULL),(2,'ar',1,'hgyght',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-12-30 06:20:27','2022-01-03 10:57:38',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `landing_page_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `landing_pages`
--

DROP TABLE IF EXISTS `landing_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `landing_pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image_slider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_slider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_about` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features_background` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_background` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `landing_pages`
--

LOCK TABLES `landing_pages` WRITE;
/*!40000 ALTER TABLE `landing_pages` DISABLE KEYS */;
INSERT INTO `landing_pages` VALUES (1,NULL,NULL,NULL,NULL,NULL,NULL,'2022-05-26 04:33:21','2022-05-26 04:33:21',NULL);
/*!40000 ALTER TABLE `landing_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'en','uploads/language/s.png',NULL,NULL,NULL),(2,'ar','uploads/language/s.png',NULL,NULL,NULL);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languge_translations`
--

DROP TABLE IF EXISTS `languge_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languge_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languge_translations`
--

LOCK TABLES `languge_translations` WRITE;
/*!40000 ALTER TABLE `languge_translations` DISABLE KEYS */;
INSERT INTO `languge_translations` VALUES (1,1,'en','English',NULL,NULL),(2,1,'ar','انجليزي',NULL,NULL),(3,2,'en','Arabic',NULL,NULL),(4,2,'ar','عربي',NULL,NULL);
/*!40000 ALTER TABLE `languge_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2022_03_25_124225_create_users_table',1),(2,'2022_05_22_124225_create_age_translations_table',1),(3,'2022_05_22_124225_create_ages_table',1),(4,'2022_05_22_124225_create_areas_table',1),(5,'2022_05_22_124225_create_categories_table',1),(6,'2022_05_23_124225_create_products_table',1),(7,'2022_05_25_124224_create_orders_table',1),(8,'2022_05_25_124225_create_ad_translations_table',1),(9,'2022_05_25_124225_create_admin_roles_table',1),(10,'2022_05_25_124225_create_admins_table',1),(11,'2022_05_25_124225_create_ads_table',1),(12,'2022_05_25_124225_create_area_translations_table',1),(13,'2022_05_25_124225_create_banner_translations_table',1),(14,'2022_05_25_124225_create_banners_table',1),(15,'2022_05_25_124225_create_carts_table',1),(16,'2022_05_25_124225_create_category_translations_table',1),(17,'2022_05_25_124225_create_chat_users_table',1),(18,'2022_05_25_124225_create_chats_table',1),(19,'2022_05_25_124225_create_cities_table',1),(20,'2022_05_25_124225_create_city_translations_table',1),(21,'2022_05_25_124225_create_color_translations_table',1),(22,'2022_05_25_124225_create_colors_table',1),(23,'2022_05_25_124225_create_contacts_table',1),(24,'2022_05_25_124225_create_countries_table',1),(25,'2022_05_25_124225_create_country_translations_table',1),(26,'2022_05_25_124225_create_coupons_table',1),(27,'2022_05_25_124225_create_customer_comment_translations_table',1),(28,'2022_05_25_124225_create_customer_comments_table',1),(29,'2022_05_25_124225_create_faq_table',1),(30,'2022_05_25_124225_create_faq_translations_table',1),(31,'2022_05_25_124225_create_favorites_table',1),(32,'2022_05_25_124225_create_feature_translations_table',1),(33,'2022_05_25_124225_create_landing_page_translations_table',1),(34,'2022_05_25_124225_create_landing_pages_table',1),(35,'2022_05_25_124225_create_languages_table',1),(36,'2022_05_25_124225_create_languge_translations_table',1),(37,'2022_05_25_124225_create_notifications_table',1),(38,'2022_05_25_124225_create_notify_table',1),(39,'2022_05_25_124225_create_notify_translations_table',1),(40,'2022_05_25_124225_create_oauth_access_tokens_table',1),(41,'2022_05_25_124225_create_oauth_auth_codes_table',1),(42,'2022_05_25_124225_create_oauth_clients_table',1),(43,'2022_05_25_124225_create_oauth_personal_access_clients_table',1),(44,'2022_05_25_124225_create_oauth_refresh_tokens_table',1),(45,'2022_05_25_124225_create_order_products_table',1),(46,'2022_05_25_124225_create_page_translations_table',1),(47,'2022_05_25_124225_create_pages_table',1),(48,'2022_05_25_124225_create_password_resets_table',1),(49,'2022_05_25_124225_create_permission_translations_table',1),(50,'2022_05_25_124225_create_permissions_table',1),(51,'2022_05_25_124225_create_product_images_table',1),(52,'2022_05_25_124225_create_product_translations_table',1),(53,'2022_05_25_124225_create_role_permissions_table',1),(54,'2022_05_25_124225_create_role_translations_table',1),(55,'2022_05_25_124225_create_roles_table',1),(56,'2022_05_25_124225_create_setting_translations_table',1),(57,'2022_05_25_124225_create_settings_table',1),(58,'2022_05_25_124225_create_subadmins_table',1),(59,'2022_05_25_124225_create_subscribe_emails_table',1),(60,'2022_05_25_124225_create_tokens_table',1),(61,'2022_05_25_124225_create_user_permissions_table',1),(62,'2022_05_25_124225_create_user_wallet_table',1),(63,'2022_05_25_124225_create_verification_codes_table',1),(64,'2022_05_25_124226_add_foreign_keys_to_banner_translations_table',1),(65,'2022_05_25_124226_create_user_addresses_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notify`
--

DROP TABLE IF EXISTS `notify`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notify` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `admin_id` int DEFAULT NULL,
  `order_id` int NOT NULL DEFAULT '0',
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `seen` int DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notify`
--

LOCK TABLES `notify` WRITE;
/*!40000 ALTER TABLE `notify` DISABLE KEYS */;
INSERT INTO `notify` VALUES (1,0,1,0,'active',0,'2023-10-03 11:57:47','2024-07-04 10:27:37','2024-07-04 10:27:37'),(2,0,1,0,'active',0,'2024-07-04 10:26:32','2024-07-04 10:27:37','2024-07-04 10:27:37'),(3,0,1,0,'active',0,'2024-07-04 10:26:46','2024-07-04 10:27:37','2024-07-04 10:27:37'),(4,0,1,0,'active',0,'2024-07-04 10:27:08','2024-07-04 10:27:37','2024-07-04 10:27:37'),(5,0,1,0,'active',0,'2024-07-04 10:27:09','2024-07-04 10:27:37','2024-07-04 10:27:37'),(6,70,NULL,99,'active',0,'2024-07-04 10:31:49','2024-07-04 10:31:49',NULL),(7,70,NULL,99,'active',0,'2024-07-04 10:32:04','2024-07-04 10:32:04',NULL),(8,70,NULL,99,'active',0,'2024-07-04 10:32:06','2024-07-04 10:32:06',NULL),(9,70,NULL,99,'active',0,'2024-07-04 10:32:36','2024-07-04 10:32:36',NULL),(10,70,NULL,99,'active',0,'2024-07-04 10:32:37','2024-07-04 10:32:37',NULL),(11,70,NULL,99,'active',0,'2024-07-04 10:32:51','2024-07-04 10:32:51',NULL),(12,70,NULL,99,'active',0,'2024-07-04 10:33:11','2024-07-04 10:33:11',NULL),(13,70,NULL,99,'active',0,'2024-07-04 10:33:23','2024-07-04 10:33:23',NULL),(14,70,NULL,99,'active',0,'2024-07-04 10:33:23','2024-07-04 10:33:23',NULL),(15,70,NULL,99,'active',0,'2024-07-04 10:33:24','2024-07-04 10:33:24',NULL),(16,70,NULL,99,'active',0,'2024-07-04 10:33:24','2024-07-04 10:33:24',NULL),(17,70,NULL,99,'active',0,'2024-07-04 10:33:25','2024-07-04 10:33:25',NULL),(18,70,NULL,99,'active',0,'2024-07-04 10:33:25','2024-07-04 12:08:42','2024-07-04 12:08:42'),(19,75,NULL,106,'active',0,'2024-07-08 11:00:40','2024-07-08 11:00:40',NULL),(20,75,NULL,106,'active',0,'2024-07-08 11:00:47','2024-07-08 11:00:47',NULL),(21,1,NULL,1,'active',0,'2024-07-08 11:01:07','2024-07-08 11:01:07',NULL),(22,75,NULL,106,'active',0,'2024-07-08 11:01:20','2024-07-08 11:01:20',NULL),(23,75,NULL,106,'active',0,'2024-07-10 05:32:57','2024-07-10 05:32:57',NULL),(24,75,NULL,106,'active',0,'2024-07-10 09:49:34','2024-07-10 09:49:34',NULL),(25,75,NULL,106,'active',0,'2024-07-10 09:49:47','2024-07-10 09:49:47',NULL),(26,75,NULL,106,'active',0,'2024-07-10 09:49:53','2024-07-10 09:49:53',NULL);
/*!40000 ALTER TABLE `notify` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notify_translations`
--

DROP TABLE IF EXISTS `notify_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notify_translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `notifiy_id` int NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notify_translations`
--

LOCK TABLES `notify_translations` WRITE;
/*!40000 ALTER TABLE `notify_translations` DISABLE KEYS */;
INSERT INTO `notify_translations` VALUES (1,1,'en','Test','2023-10-03 11:57:47','2023-10-03 11:57:47',NULL),(2,1,'ar','Test','2023-10-03 11:57:47','2023-10-03 11:57:47',NULL),(3,2,'en','test','2024-07-04 10:26:32','2024-07-04 10:26:32',NULL),(4,2,'ar','test','2024-07-04 10:26:32','2024-07-04 10:26:32',NULL),(5,3,'en','test','2024-07-04 10:26:46','2024-07-04 10:26:46',NULL),(6,3,'ar','test','2024-07-04 10:26:46','2024-07-04 10:26:46',NULL),(7,4,'en','teeeest','2024-07-04 10:27:08','2024-07-04 10:27:08',NULL),(8,4,'ar','test','2024-07-04 10:27:08','2024-07-04 10:27:08',NULL),(9,5,'en','teeeest','2024-07-04 10:27:09','2024-07-04 10:27:09',NULL),(10,5,'ar','test','2024-07-04 10:27:09','2024-07-04 10:27:09',NULL),(11,6,'en','Your Order in Preparing Now','2024-07-04 10:31:49','2024-07-04 10:31:49',NULL),(12,6,'ar','جاري الآن تحضير طلبك','2024-07-04 10:31:49','2024-07-04 10:31:49',NULL),(13,7,'en','Your Order in Preparing Now','2024-07-04 10:32:04','2024-07-04 10:32:04',NULL),(14,7,'ar','جاري الآن تحضير طلبك','2024-07-04 10:32:04','2024-07-04 10:32:04',NULL),(15,8,'en','Your Order is on Delivery','2024-07-04 10:32:06','2024-07-04 10:32:06',NULL),(16,8,'ar','طلبك في طريقه إليك','2024-07-04 10:32:06','2024-07-04 10:32:06',NULL),(17,9,'en','Your Order is on Delivery','2024-07-04 10:32:36','2024-07-04 10:32:36',NULL),(18,9,'ar','طلبك في طريقه إليك','2024-07-04 10:32:36','2024-07-04 10:32:36',NULL),(19,10,'en','Your Order in Preparing Now','2024-07-04 10:32:37','2024-07-04 10:32:37',NULL),(20,10,'ar','جاري الآن تحضير طلبك','2024-07-04 10:32:37','2024-07-04 10:32:37',NULL),(21,11,'en','Thank You, Your Order is Complete','2024-07-04 10:32:51','2024-07-04 10:32:51',NULL),(22,11,'ar','شكرا لك تم تسليم الطلب','2024-07-04 10:32:51','2024-07-04 10:32:51',NULL),(23,12,'en','Your Order is on Delivery','2024-07-04 10:33:11','2024-07-04 10:33:11',NULL),(24,12,'ar','طلبك في طريقه إليك','2024-07-04 10:33:11','2024-07-04 10:33:11',NULL),(25,13,'en','Your Order is on Delivery','2024-07-04 10:33:23','2024-07-04 10:33:23',NULL),(26,13,'ar','طلبك في طريقه إليك','2024-07-04 10:33:23','2024-07-04 10:33:23',NULL),(27,14,'en','Your Order is on Delivery','2024-07-04 10:33:23','2024-07-04 10:33:23',NULL),(28,14,'ar','طلبك في طريقه إليك','2024-07-04 10:33:23','2024-07-04 10:33:23',NULL),(29,15,'en','Your Order is on Delivery','2024-07-04 10:33:24','2024-07-04 10:33:24',NULL),(30,15,'ar','طلبك في طريقه إليك','2024-07-04 10:33:24','2024-07-04 10:33:24',NULL),(31,16,'en','Your Order is on Delivery','2024-07-04 10:33:24','2024-07-04 10:33:24',NULL),(32,16,'ar','طلبك في طريقه إليك','2024-07-04 10:33:24','2024-07-04 10:33:24',NULL),(33,17,'en','Your Order is on Delivery','2024-07-04 10:33:25','2024-07-04 10:33:25',NULL),(34,17,'ar','طلبك في طريقه إليك','2024-07-04 10:33:25','2024-07-04 10:33:25',NULL),(35,18,'en','Your Order is on Delivery','2024-07-04 10:33:25','2024-07-04 10:33:25',NULL),(36,18,'ar','طلبك في طريقه إليك','2024-07-04 10:33:25','2024-07-04 10:33:25',NULL),(37,19,'en','Your Order is on Delivery','2024-07-08 11:00:40','2024-07-08 11:00:40',NULL),(38,19,'ar','طلبك في طريقه إليك','2024-07-08 11:00:40','2024-07-08 11:00:40',NULL),(39,20,'en','Your Order is on Delivery','2024-07-08 11:00:47','2024-07-08 11:00:47',NULL),(40,20,'ar','طلبك في طريقه إليك','2024-07-08 11:00:47','2024-07-08 11:00:47',NULL),(41,21,'en','Your Order is on Delivery','2024-07-08 11:01:07','2024-07-08 11:01:07',NULL),(42,21,'ar','طلبك في طريقه إليك','2024-07-08 11:01:07','2024-07-08 11:01:07',NULL),(43,22,'en','Your Order is on Delivery','2024-07-08 11:01:20','2024-07-08 11:01:20',NULL),(44,22,'ar','طلبك في طريقه إليك','2024-07-08 11:01:20','2024-07-08 11:01:20',NULL),(45,23,'en','Your Order is on Delivery','2024-07-10 05:32:57','2024-07-10 05:32:57',NULL),(46,23,'ar','طلبك في طريقه إليك','2024-07-10 05:32:57','2024-07-10 05:32:57',NULL),(47,24,'en','Your Order is on Delivery','2024-07-10 09:49:34','2024-07-10 09:49:34',NULL),(48,24,'ar','طلبك في طريقه إليك','2024-07-10 09:49:34','2024-07-10 09:49:34',NULL),(49,25,'en','Sorry!, Your Order is Cancel','2024-07-10 09:49:47','2024-07-10 09:49:47',NULL),(50,25,'ar','عذرا، لقد تم إلغاء طلبك','2024-07-10 09:49:47','2024-07-10 09:49:47',NULL),(51,26,'en','Your Order is on Delivery','2024-07-10 09:49:53','2024-07-10 09:49:53',NULL),(52,26,'ar','طلبك في طريقه إليك','2024-07-10 09:49:53','2024-07-10 09:49:53',NULL);
/*!40000 ALTER TABLE `notify_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `client_id` int NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('00b788af97a7a1f31a06df082ab307f741eeb84195c08c59726b7d782283c41f9014edbf5ca4e840',1,1,'mobile','[]',0,'2022-03-02 12:41:27','2022-03-02 12:41:27','2023-03-02 12:41:27'),('00ea9a8b0856466193c3da616dd0328bbcc69ac096fab9938df11348288519d43e820525370b9544',3,1,'mobile','[]',0,'2022-05-19 13:26:53','2022-05-19 13:26:53','2023-05-19 13:26:53'),('02f1ddc508e75d0c148fd25a8f8f1fbc14e9f1dac2d7ae9380dcef765e54b73460bcff988472c357',16,1,'mobile','[]',1,'2024-07-01 13:45:27','2024-07-01 13:45:27','2025-07-01 13:45:27'),('031f28466261109e84cacad97af726ead2768c3241d012c5d20bcd8928ee2ab14ba01b1c27572ab8',72,1,'mobile','[]',1,'2024-07-09 13:11:21','2024-07-09 13:11:21','2025-07-09 13:11:21'),('0336fc0f30d26dd28dfccb3127f9d9cabbfb7e7624c7d19369a96cd549e97bfac0bdd20da609aa35',1,1,'mobile','[]',0,'2022-04-13 16:17:08','2022-04-13 16:17:08','2023-04-13 16:17:08'),('033c07dea3cc7df139529711a60a6ce4931c24cde20fda20870cdd6d94eb80595317352a2f120a09',7,1,'mobile','[]',1,'2022-10-24 06:18:24','2022-10-24 06:18:24','2023-10-24 09:18:24'),('03505b05a0d82ac2f92b9d8527281acd443c18adb04e7accc5eda12c0fbaace74e2c6264ca0fb530',6,1,'mobile','[]',0,'2022-08-09 14:19:53','2022-08-09 14:19:53','2023-08-09 17:19:53'),('0350ee23e050c7176656241b60e44b046e119fcdfe3fce437797f9ae9456c79fa26e39fecb128212',13,1,'mobile','[]',0,'2024-07-10 05:26:16','2024-07-10 05:26:16','2025-07-10 05:26:16'),('0357c1360cd3e7e915e56b2205e9bb2e859f1cdd455266c89fa6acdc1bfc359cb98af6114b0cd413',1,1,'mobile','[]',0,'2022-03-02 13:40:53','2022-03-02 13:40:53','2023-03-02 13:40:53'),('038b83e0b036535c0aea5123208e9d4762903efa08468d03cdca1c7fd457440e8897ae981e0a005f',6,1,'mobile','[]',0,'2023-09-07 04:00:07','2023-09-07 04:00:07','2024-09-07 07:00:07'),('03c95c54cfe35b66e42cd386253f10c8283da47e359110a4a2029453f2273dc857fc9a5ca17d41bb',3,1,'mobile','[]',0,'2022-05-19 13:27:38','2022-05-19 13:27:38','2023-05-19 13:27:38'),('0406fca5dd19105cd7eb18588b127b1cc9727028a70878f93a1b1499c4e2772bd5cb9bb455180b43',23,1,'mobile','[]',0,'2022-06-27 10:27:59','2022-06-27 10:27:59','2023-06-27 10:27:59'),('048cd336472914f176b21510eb73335e06b1b6a0bd2e17eeb1b943b0e99ed59d9ca6ac2f3a322f0e',6,1,'mobile','[]',0,'2024-06-27 11:43:37','2024-06-27 11:43:37','2025-06-27 11:43:37'),('04a3c2ce645ca4ad5c9a3c60cceae28703a7f2ea0eabfe061963e42c3d2c236ca3b5f71a94b27448',15,1,'mobile','[]',0,'2022-06-19 15:39:45','2022-06-19 15:39:45','2023-06-19 15:39:45'),('04fe661340742a981991efae53c8ab0a3bd42e84996cf8b04bd25a9c94b6838c2231caf8cc77956a',44,1,'mobile','[]',0,'2024-07-03 14:51:21','2024-07-03 14:51:21','2025-07-03 14:51:21'),('0568cf388d8b6c8c4fad9789179926732533558648e7c1a32027750fdde58aa24aea70bb771c5a93',30,1,'mobile','[]',1,'2024-07-11 13:32:25','2024-07-11 13:32:25','2025-07-11 13:32:25'),('056b10f1e4dc443ddb356cd6d69fa65773c7f0580ab0ae681cd9cb0c469bf2ac3d4dc895d049c69b',26,1,'mobile','[]',1,'2022-06-30 15:39:29','2022-06-30 15:39:29','2023-06-30 15:39:29'),('061188f7ce43b433a9814ad021156442639e0edb346ee86f37786c49efa9f15450dc1f7c58e48534',6,1,'mobile','[]',0,'2022-08-09 14:05:53','2022-08-09 14:05:53','2023-08-09 17:05:53'),('061778b3e936fddf1ea323b72f592105c0b223689a9f8ba0ad3df86e97286614f301baa8c5ef9a47',3,1,'mobile','[]',0,'2022-10-09 10:24:17','2022-10-09 10:24:17','2023-10-09 13:24:17'),('0673165eab474d09c5211f5196aeb4fd2464753cde86a10e48030d0aa1597358716b5174d4a04dc0',4,1,'mobile','[]',0,'2022-03-24 08:17:19','2022-03-24 08:17:19','2023-03-24 08:17:19'),('06bfbada279d1de356422069df39ec845dfabdaf371902faa7110f2018e7c636e4065f5e8cd15c5f',2,1,'mobile','[]',1,'2022-10-09 11:43:53','2022-10-09 11:43:53','2023-10-09 14:43:53'),('06e6e9de44ae50c55429ca921ae8e1fac506a86bb94da99f4a4a7eb6864ad3355ff537af31c31f1b',1,1,'mobile','[]',0,'2022-03-13 14:22:12','2022-03-13 14:22:12','2023-03-13 14:22:12'),('071cfbfe1bceb24eb67acc3f87c6c29240944079af4a610e57f28f5a577efc9260d0a28dd91e1634',10,1,'mobile','[]',0,'2022-02-27 07:53:51','2022-02-27 07:53:51','2023-02-27 07:53:51'),('0747f4d268ee07f8630e53042f3b823839c67bffdf9ae9c69b1d289318f89a2650d4e9f2edc1dcd7',57,1,'mobile','[]',0,'2024-07-04 07:20:14','2024-07-04 07:20:14','2025-07-04 07:20:14'),('07f1c843b59c5b3812a6f01c91ad476ab91fd3780eb6c348dcd3be9fdb3fd1244174be712bd4f8ea',59,1,'mobile','[]',1,'2022-03-10 09:25:20','2022-03-10 09:25:20','2023-03-10 09:25:20'),('086b04cadd5f3e2e774bb9c63c7c1eeb98ce45aece92bf50012956c7c7d671005b64891e11d18173',3,1,'mobile','[]',0,'2022-04-20 11:00:58','2022-04-20 11:00:58','2023-04-20 11:00:58'),('08c72ec92bddbc6a07522e36c7c80ad0a5c4e2b5f4869d1affb83d2111e9d640efbce3827d91de72',1,1,'mobile','[]',0,'2022-12-04 08:39:15','2022-12-04 08:39:15','2023-12-04 10:39:15'),('08d1d3b790603c43a4592eb867a20a74575e7aef8c5ed64e1df2daeb91a739ae6a1f6015dc6bd865',49,1,'mobile','[]',1,'2022-03-10 07:02:07','2022-03-10 07:02:07','2023-03-10 07:02:07'),('096daf257a5c1292f68a6e6bb115eff6d2af92b8e3d6428ae1bfe4daae0afd5d87f5a09957108aee',64,1,'mobile','[]',1,'2022-03-10 11:27:57','2022-03-10 11:27:57','2023-03-10 11:27:57'),('09db05fbe04beeb300b262066e1188ac32bcc70aa64786413b635a2656737ac313692cfa07c1bd16',49,1,'mobile','[]',0,'2022-03-10 07:40:37','2022-03-10 07:40:37','2023-03-10 07:40:37'),('09eda2625501fccf5b8bd41b1e6e9f793a4cca292097be1880d44f7bd0401ac59fcd77641d038414',49,1,'mobile','[]',0,'2022-03-10 06:59:58','2022-03-10 06:59:58','2023-03-10 06:59:58'),('0a01682ccd459969fd257c9ac1ba816481adf1350a714b90587f09c91353934de8827fafbcc74dc6',9,1,'mobile','[]',0,'2023-08-24 05:14:40','2023-08-24 05:14:40','2024-08-24 08:14:40'),('0ba6087ad7acb5f13e33f8b253d1ae3046a920d00dc829df877a370f2673da0749394679d4bd61e6',1,1,'mobile','[]',0,'2022-04-19 16:18:56','2022-04-19 16:18:56','2023-04-19 16:18:56'),('0bc1c5e2279e120be8c4595076e8c34de3f42f939ae90753ccbd3f55258f68eac712ac155b8048b4',27,1,'mobile','[]',1,'2022-06-30 15:50:28','2022-06-30 15:50:28','2023-06-30 15:50:28'),('0c3f042046d19fe4c6228ef2deb0b8b6f6135ba26aa5fdd1c416c8d38edc8e614d05f018f378f62e',50,1,'mobile','[]',0,'2024-07-04 06:25:29','2024-07-04 06:25:29','2025-07-04 06:25:29'),('0c60cdc44b116f269c18abbc9dbffa491e6a93d8e545948b21e4dd858c372d0f08055469a86ce33d',1,1,'mobile','[]',0,'2022-12-04 08:29:07','2022-12-04 08:29:07','2023-12-04 10:29:07'),('0c93fac3d7295b4033e17a790f7be0f234760f4ec1e0b27983c10ae4892a0ff38a0ef65073959178',2,1,'mobile','[]',1,'2022-03-24 08:02:49','2022-03-24 08:02:49','2023-03-24 08:02:49'),('0c94a8ea530e2173420e7e216149cd911a482b305877cab97fa8afe5471cb71e8eb496c45f3afff7',28,1,'mobile','[]',0,'2022-06-30 15:59:47','2022-06-30 15:59:47','2023-06-30 15:59:47'),('0c95a714997f6d8b5d147a0ccc322bc77a14fa53f131d787c182c87284f8d5ac7de82cf30659227e',30,1,'mobile','[]',1,'2022-02-23 09:44:12','2022-02-23 09:44:12','2023-02-23 09:44:12'),('0cfba4325d497ef08bf43a90dd44b29b1eb1e49af29caae3791ad5be852a4e493378fbb988b4689c',13,1,'mobile','[]',0,'2024-07-09 15:49:42','2024-07-09 15:49:42','2025-07-09 15:49:42'),('0d07ab0b579ff2e80dbb24b64e49adbf5a75c77c45c01a80188de7e588621c50331c936da4213a74',24,1,'mobile','[]',0,'2022-06-27 12:48:57','2022-06-27 12:48:57','2023-06-27 12:48:57'),('0d77119e96de57060dbca7b6572060b42248d8c0e274e66e72facb3dc9771e4e754e9656aa9f078a',16,1,'mobile','[]',1,'2024-07-01 13:32:17','2024-07-01 13:32:17','2025-07-01 13:32:17'),('0e027609b13a42a1bc207abcb479c98de89ed81463dd0e6ed08dd91173b92c9b9afc435c06567d41',69,1,'mobile','[]',1,'2022-03-10 11:59:30','2022-03-10 11:59:30','2023-03-10 11:59:30'),('0e5476378e8a7d4e7bb6750780a9e5c1f8af1ae23f854c38197c3af854a153a83a1d28d0d1e80b09',31,1,'mobile','[]',0,'2022-02-23 10:13:16','2022-02-23 10:13:16','2023-02-23 10:13:16'),('0e747f2b441bb21ecd861b7de2587cf4ba748c3b402a435c2bbca499b3b177a432362d37ecfac1ec',30,1,'mobile','[]',1,'2024-07-09 10:56:27','2024-07-09 10:56:27','2025-07-09 10:56:27'),('0e9cbb3c8d83972d106d53a803e9b0adab42c887fd4a88b7e0c1f7c9a0a0c8fa5b8aa757c86031f3',8,1,'mobile','[]',0,'2023-07-23 08:52:25','2023-07-23 08:52:25','2024-07-23 11:52:25'),('0eba22bc141ff89bb17e2945ebf249c42f5e9227e638b5defc673ca74b16e13e2411630773e6e255',8,1,'mobile','[]',0,'2022-02-20 12:15:37','2022-02-20 12:15:37','2023-02-20 12:15:37'),('0ed795c3beb9c81d6532dfb268149ec6a73c975f45e69a3ef4d1edaff1fcd0e266d2cd3b11cfd039',30,1,'mobile','[]',0,'2024-07-07 05:06:22','2024-07-07 05:06:22','2025-07-07 05:06:22'),('0eee66290b6836534bb20924885d15d4023770f746b614619437fcc8bd48ba60dd0c3b84f77c384a',3,1,'mobile','[]',0,'2022-04-21 12:55:31','2022-04-21 12:55:31','2023-04-21 12:55:31'),('0f7fbbccfed54d9f1b7655ac780c10624136e81703837a375a09eeb200e1fcd475e634fc5d8f4c61',1,1,'mobile','[]',0,'2022-02-17 09:43:34','2022-02-17 09:43:34','2023-02-17 09:43:34'),('0ff5d2ebd3d4d91f1df166b800f1745c57f2b7a31381a1b8d409a3f53c53cb2b465b5f21c40fdfa6',1,1,'mobile','[]',0,'2022-03-24 07:50:32','2022-03-24 07:50:32','2023-03-24 07:50:32'),('10375ecec053fe996ea9c53a225476e952458c172c97f2f0294fa2a285b7eb4e3eaef80ae9be194e',7,1,'mobile','[]',0,'2022-08-15 17:59:06','2022-08-15 17:59:06','2023-08-15 20:59:06'),('1040bd87b7c2d6e3a9d8658a5d7ca52342b0770c0cc250a5a0f7b33f13cc2cf87627c82554ecbca8',1,1,'mobile','[]',0,'2022-07-06 07:18:04','2022-07-06 07:18:04','2023-07-06 10:18:04'),('1059ab7fee2de717de09553e45f5f9f25db00a410f00349665b4cb80e4a7efa6ce8202c41590ea77',6,1,'mobile','[]',0,'2024-07-08 06:56:58','2024-07-08 06:56:58','2025-07-08 06:56:58'),('114da5bb4d353065a973b5741eecd43e25d5f80612c75d44382dedd17b523be42d1436fadccd3a3a',9,1,'mobile','[]',0,'2023-08-10 05:43:26','2023-08-10 05:43:26','2024-08-10 08:43:26'),('1174197a826ea31c5b67e09ef2cd0654762ba49b2ee2de4ae50c160a5622e3abfbaca4db6e770025',1,1,'mobile','[]',0,'2022-03-03 06:46:32','2022-03-03 06:46:32','2023-03-03 06:46:32'),('126a9b7dfc6a5677a689fe5c3855e871dc0ea768db5a41648a8755e7c8b0bdb641588db1fc3d59d1',8,1,'mobile','[]',0,'2023-07-23 08:52:05','2023-07-23 08:52:05','2024-07-23 11:52:05'),('128f3fefc81be7ef02a5606543482a4f597bb458a0623296022d46f67c38c3012214d03bf09e6ed9',71,1,'mobile','[]',0,'2024-07-04 15:16:05','2024-07-04 15:16:05','2025-07-04 15:16:05'),('129c190e327c7760af2dd42f249c157888c5c6d2aa47cb7bb907aff76b11b1c387537bfe2771326a',25,1,'mobile','[]',1,'2022-02-23 09:08:40','2022-02-23 09:08:40','2023-02-23 09:08:40'),('13cb5fbf10d16103a53f4eeb3eb364a776118e5d1aee1e64eae3c0c55815018a468a4bb8f962c24b',6,1,'mobile','[]',0,'2022-08-11 07:06:26','2022-08-11 07:06:26','2023-08-11 10:06:26'),('13f27abff31cc448a752cef5cfa7a4378fa419aa68ec7b9a56978d2292d5edd70ff76a2851aae951',67,1,'mobile','[]',0,'2024-07-04 09:53:59','2024-07-04 09:53:59','2025-07-04 09:53:59'),('1414d4faea1b073e16da0f759a5567e60555a6fa2a6338fef8fa7f921474db45a94ac864aa0546e7',16,1,'mobile','[]',0,'2024-07-01 14:06:36','2024-07-01 14:06:36','2025-07-01 14:06:36'),('144328ffa1228344ec9a01df38a0212752c14ffe75786092c04055dde3e4b4da3e6577657144c1f3',21,1,'mobile','[]',0,'2022-06-25 11:14:06','2022-06-25 11:14:06','2023-06-25 11:14:06'),('14703226c3bd18b69a20774634cf8c485a148d570e3f2c881229388a3ed3422052dd97fc950f6ab3',1,1,'mobile','[]',0,'2022-12-04 08:39:08','2022-12-04 08:39:08','2023-12-04 10:39:08'),('14a269c68909b664b5bcc9008ddac192b4892aef791c78bf63ee6158566a30a0d8b43031025b4fde',30,1,'mobile','[]',1,'2024-07-08 10:37:21','2024-07-08 10:37:21','2025-07-08 10:37:21'),('152d22b9d381bf2928cace0ef513b3910a6de4a9508cf997cd0352c2873ec4cc2bed447fa422a9ba',2,1,'mobile','[]',0,'2022-10-10 07:27:50','2022-10-10 07:27:50','2023-10-10 10:27:50'),('159be44c58d90b7f78446515d2481e01c467a6cc5910d98a497e77cde726a4f4f765fc7ef6071f60',8,1,'mobile','[]',0,'2022-08-15 18:02:34','2022-08-15 18:02:34','2023-08-15 21:02:34'),('165dc0405da53241726dfd10df538e90388d0043d314f53a60d81df59c9069a0011830f24bb57df8',40,1,'mobile','[]',0,'2024-07-03 13:54:04','2024-07-03 13:54:04','2025-07-03 13:54:04'),('1674a708cc1bf676a17576a91c9e13c1f768dda3e097fff5c1956b1f712dcdda8fb255e5c054f3d4',2,1,'mobile','[]',0,'2022-04-13 14:51:05','2022-04-13 14:51:05','2023-04-13 14:51:05'),('16d5338931838f3484e573f1c87fc71a87c064a3e1913ff3705706762737b9e8081848a190ffc1bd',6,1,'mobile','[]',0,'2022-08-11 07:04:25','2022-08-11 07:04:25','2023-08-11 10:04:25'),('17356594a83b44330ee6fa04cbd882ccbe828e98f083e0592b12a4ca9ca1946881b89a9f5e36fb1a',4,1,'mobile','[]',0,'2022-08-10 07:27:02','2022-08-10 07:27:02','2023-08-10 10:27:02'),('17778b515303961a4a786c6b71b40c8544964746bbf75c66e41e0b0068bb48c96c4da69064713999',16,1,'mobile','[]',1,'2024-07-01 13:38:02','2024-07-01 13:38:02','2025-07-01 13:38:02'),('17c52de86a56bcf262a3dafe59fd0c627c188298d661f6241cdd05992afe62beb8bcc70d1b2544f1',30,1,'mobile','[]',1,'2024-07-03 13:56:27','2024-07-03 13:56:27','2025-07-03 13:56:27'),('17ce5c8471342734dc01881ee178cdb1b79bbe675e1d58293c8957455122d7dff461fb13689fb6f8',32,1,'mobile','[]',0,'2024-07-03 12:56:12','2024-07-03 12:56:12','2025-07-03 12:56:12'),('17d0edab1f65d91906c302a21f9373bc1d3c6dde3e61ccc8e99e3ab455adbb61ae263a8f1058bd87',3,1,'mobile','[]',0,'2022-04-25 12:19:48','2022-04-25 12:19:48','2023-04-25 12:19:48'),('1810e1daa65e737abc7bb486ea73b38ed09b4932652dbbcbd864f8ff0c323fc0a49706e7ca2f7fd3',68,1,'mobile','[]',0,'2022-03-10 11:43:10','2022-03-10 11:43:10','2023-03-10 11:43:10'),('181a75bff64e7ec5ba5892b83638d5975be6f76133af4719d739be33b4ab6f37b000197f89a27ef6',30,1,'mobile','[]',1,'2024-07-09 15:44:52','2024-07-09 15:44:52','2025-07-09 15:44:52'),('192aa9dae49b444fa331942ce82a84823d0ea700aef0790eb4a71a2da2696dde8206fe18073e0ea6',4,1,'mobile','[]',0,'2022-08-25 08:34:32','2022-08-25 08:34:32','2023-08-25 11:34:32'),('1962099fef26d7d14a5daebe18378bae034ee3f2ca7cf43737189c1d077dbb5b8557876e522e9ae8',10,1,'mobile','[]',0,'2022-02-20 12:16:43','2022-02-20 12:16:43','2023-02-20 12:16:43'),('1987e4ecaa980f09d6e302cee0b987be86104d9ebf680653d29c118d38db79372ed597f2e8da8707',1,1,'mobile','[]',0,'2022-02-14 10:48:02','2022-02-14 10:48:02','2023-02-14 12:48:02'),('19cd268f867105550e53bcb932a842d92ae18ab803955113acfde7137f13510118b27093c8f76b3a',38,1,'mobile','[]',0,'2024-07-03 13:39:51','2024-07-03 13:39:51','2025-07-03 13:39:51'),('1a2e6324ace489a5827a046cee5bdf22a8dff6bd9f222199e332a1ef2f733baae00dcaf89b30335f',30,1,'mobile','[]',1,'2024-07-04 12:58:02','2024-07-04 12:58:02','2025-07-04 12:58:02'),('1a384c62060f230613529a1a41e2e170402c01e30f4d622b08d5f11dea2bd1362e1b778056922b69',1,1,'mobile','[]',0,'2022-05-17 09:14:43','2022-05-17 09:14:43','2023-05-17 09:14:43'),('1a6140fbec0314c679efcf7345c03324498f79d2d0fe304bd3242795ab780dcee27fc4868110060d',13,1,'mobile','[]',1,'2024-06-30 06:01:33','2024-06-30 06:01:33','2025-06-30 06:01:33'),('1ae798c399781ac0e8b578078f5a87dd8135b6a7e5a6137522f8d887654ce86f0695b7bf056db1ed',1,1,'mobile','[]',0,'2022-03-06 12:51:18','2022-03-06 12:51:18','2023-03-06 12:51:18'),('1b7333c6e279c385033d250a500db4615a62bb8fe2b32466bd95fb6719cfbd69213616b538a3a73c',39,1,'mobile','[]',0,'2024-07-03 13:48:06','2024-07-03 13:48:06','2025-07-03 13:48:06'),('1b98bf432ed2d696e08f9fc3df4531d4961cc0ec54ae7a18d91c3e9251412db4532a257f110cfde6',1,1,'mobile','[]',0,'2022-03-06 12:57:35','2022-03-06 12:57:35','2023-03-06 12:57:35'),('1bc87e42e0e6bf611a610ec26489248fedc46b044d58a31a373210bd6401ac02a37682e2286829c9',63,1,'mobile','[]',0,'2024-07-04 09:06:55','2024-07-04 09:06:55','2025-07-04 09:06:55'),('1c18f9b0eed5f6522454acba016344ad192d6f53407be7812a7fbaafdb0787f8f63504d0fc193746',1,1,'mobile','[]',0,'2022-02-17 10:34:29','2022-02-17 10:34:29','2023-02-17 10:34:29'),('1c1e0ad80cca3bada2ae3846c89572f48e2d1175dfd0ad5dca5d5d8ce460a826e990f0f2da33ad1e',3,1,'mobile','[]',1,'2022-12-08 08:15:50','2022-12-08 08:15:50','2023-12-08 08:15:50'),('1c5f8b4472408edd0e6a26bc1b9c6dc463694a5dfff95309d064436da1b9b6565ea8c6d3cab2589e',7,1,'mobile','[]',1,'2022-10-09 10:39:46','2022-10-09 10:39:46','2023-10-09 13:39:46'),('1c62f6bbe9a86bf61e12da5c29ad6f7778a946df8bc1596185b051958ba128b0e35b59157191c32e',30,1,'mobile','[]',1,'2024-07-03 08:40:53','2024-07-03 08:40:53','2025-07-03 08:40:53'),('1cc1962ab024f1baa936c35b990001c517ffad3eda5bb220e738c3b72e319a475526ff1acb9cdab1',1,1,'mobile','[]',0,'2022-07-18 12:48:29','2022-07-18 12:48:29','2023-07-18 15:48:29'),('1d4bf76bbd60aff7ff0608a0463d9e3bdc4d55a2559fdc830a441a4923a574cf5d223a2681704027',9,1,'mobile','[]',0,'2022-03-24 11:12:41','2022-03-24 11:12:41','2023-03-24 11:12:41'),('1d5f0ae71f6e69596d22c7c584070883606391c9d96a96b6bc7dd6fd41554fab22158defb44c4119',1,1,'mobile','[]',0,'2022-03-10 13:48:29','2022-03-10 13:48:29','2023-03-10 13:48:29'),('1daa05de960b0f0811ab741d5f97a0b402e23d8e5cba69fd7b6ca8067035493b70ae01492d8be073',9,1,'mobile','[]',0,'2023-08-13 07:58:42','2023-08-13 07:58:42','2024-08-13 10:58:42'),('1dbf59dd2f202c32267f9d412c4d85fbf49739083a36a6ac43af6a11015ca327461334f94b4ce1ed',1,1,'mobile','[]',0,'2022-02-21 10:07:41','2022-02-21 10:07:41','2023-02-21 10:07:41'),('1e6f0b70d47ae0a37a632e9c44ea4c6f62961a30d444ffc547c81b2fa692e39ea0f7b41d6371aa45',7,1,'mobile','[]',1,'2022-10-25 08:19:19','2022-10-25 08:19:19','2023-10-25 11:19:19'),('1e725b3de58f915678a18d2a0bbe6d404fc903664051a8d12faac341fd332a50d105192e3aafd32c',8,1,'mobile','[]',0,'2023-07-24 14:19:21','2023-07-24 14:19:21','2024-07-24 17:19:21'),('1f5e779e3b298833b07287795202b256a1cf78a3bcb3dfa2748978c5906c055dc51525816f02d48d',3,1,'mobile','[]',0,'2022-03-24 09:32:08','2022-03-24 09:32:08','2023-03-24 09:32:08'),('1f9fca62bb1039f83a180c3c75314b528a684a43ce386e905d96d8eb3dc642b4a3d6f16d78334de9',1,1,'mobile','[]',0,'2022-07-06 08:14:36','2022-07-06 08:14:36','2023-07-06 11:14:36'),('20741e79126154f98a89699d38c7cc46f33ff8681573235dc7d9ed6a67c96895b18802b530fc36b8',7,1,'mobile','[]',0,'2024-07-01 06:09:26','2024-07-01 06:09:26','2025-07-01 06:09:26'),('208125f6a7b8008706cdb98e0392c174fe0666306d6c7d7b70d244f440dd6e660a314203bf84c1df',28,1,'mobile','[]',0,'2024-07-02 12:30:14','2024-07-02 12:30:14','2025-07-02 12:30:14'),('20bfec194ffda9f282670bab4e50efa8cf705500498ffbb31d391a13360ddbc95b680d2c8a9d8d98',59,1,'mobile','[]',1,'2022-03-10 08:48:49','2022-03-10 08:48:49','2023-03-10 08:48:49'),('20c384abb4ef2a6683003706a04cbd65424908ea09e3d74025a4702a54940aad7dbeda1bed62acac',1,1,'mobile','[]',0,'2022-07-06 08:14:47','2022-07-06 08:14:47','2023-07-06 11:14:47'),('20d1f07a38dbae8641a67d7254007bfd48358f3a525c8fe8b1a19e4b7a9fffb8921bc556f997763e',1,1,'mobile','[]',0,'2022-02-24 13:49:09','2022-02-24 13:49:09','2023-02-24 13:49:09'),('2151c9c113964cacece70a830f310b0980e8976323c1712726f9f132a84ec4eec46fd7bbf75f2761',1,1,'mobile','[]',0,'2022-04-13 12:23:02','2022-04-13 12:23:02','2023-04-13 12:23:02'),('2162f6079e19fd345ccdb0d072b4f00575b486f355eb8766a87cb508028a5c66f1bc81e18069c753',1,1,'mobile','[]',1,'2022-03-16 13:22:07','2022-03-16 13:22:07','2023-03-16 13:22:07'),('2168a5d33e73aae92750254bc329c1aa2dacfd67c574896d6680fc39f753e23f1ba82d9108a0e168',59,1,'mobile','[]',1,'2022-03-10 09:28:56','2022-03-10 09:28:56','2023-03-10 09:28:56'),('22792068c3e84a10fb4a1ce27072f02d328c8d3a2c9ae6dbad19decd1553bd5cf85c16e4bddeed9f',1,1,'mobile','[]',1,'2022-10-02 10:19:17','2022-10-02 10:19:17','2023-10-02 13:19:17'),('236bd8d34dabe9bbdbb71e603d3698cfcc91526567dabf6fa3b036732aa7a30a831ad4f834a49f25',11,1,'mobile','[]',0,'2022-03-24 13:47:11','2022-03-24 13:47:11','2023-03-24 13:47:11'),('23eccae022574521edc2cb06a58159c367e36928b22382d9bb5e6d64525499a6a82bfffbbfb5d000',5,1,'mobile','[]',0,'2022-02-20 10:52:18','2022-02-20 10:52:18','2023-02-20 10:52:18'),('240d526862f4336c77ae5c5f49a4b1eacc09240d6b85f1dd5ec6f2476f1fe207a9475c26811a299a',9,1,'mobile','[]',0,'2023-08-24 10:02:59','2023-08-24 10:02:59','2024-08-24 13:02:59'),('2465c8cc6d810ba9f1fbbab5db7fccf805ab7f539efaf394cbbe615d481b962978d411347011e244',1,1,'mobile','[]',0,'2022-02-17 10:27:42','2022-02-17 10:27:42','2023-02-17 10:27:42'),('248896047213c75c116c405b1672172a2cd6ef8d3aa8d8ecfeafe7dafc2de5a363e31d3852c333eb',1,1,'mobile','[]',0,'2022-02-20 13:57:52','2022-02-20 13:57:52','2023-02-20 13:57:52'),('249bbfd0f994ea5bb4fe2de49770b682223fd3093c8c7378c8d2dc0015371270fe5c6e830d7af35f',9,1,'mobile','[]',0,'2023-08-07 08:53:04','2023-08-07 08:53:04','2024-08-07 11:53:04'),('24b3ff69375034cbed3e45d320c7268272ee0810c62d06767f197f328c01b55231020e1d80689427',7,1,'mobile','[]',1,'2022-10-24 20:00:04','2022-10-24 20:00:04','2023-10-24 23:00:04'),('253795baa237da7136380132a78243231df6a5b03d1be0e72d9559bf250ae48e90aa329117e0afc2',1,1,'mobile','[]',0,'2022-03-24 07:52:01','2022-03-24 07:52:01','2023-03-24 07:52:01'),('2547de966d29d9e99598d05133591b3648ba7869ada19cdda042a4831c31167c34c738f5633a1bcb',13,1,'mobile','[]',0,'2024-07-15 05:46:51','2024-07-15 05:46:51','2025-07-15 05:46:51'),('25717a9f16aa7d33dd7cad98d950a1c988d5807522cda522cabcaf0ac14f852263262998c18ebc5a',29,1,'mobile','[]',0,'2024-07-03 08:38:50','2024-07-03 08:38:50','2025-07-03 08:38:50'),('25a0d3444d0b10f192921797ce8f5b6370421f3959cc1ed183f6fe2e35c0849ba5b9920f649104c3',31,1,'mobile','[]',0,'2022-02-27 07:23:20','2022-02-27 07:23:20','2023-02-27 07:23:20'),('25bcb0e60f9047a346b482c952760515ea09b1c8b54cec752d56873cf05d84481a603a8832e263cd',58,1,'mobile','[]',1,'2022-03-10 08:44:44','2022-03-10 08:44:44','2023-03-10 08:44:44'),('27910246e60b01559b2de812c01e85e79c2fe98fd72424b61a2e24d973be528a64676e328170e607',37,1,'mobile','[]',1,'2022-03-07 12:31:13','2022-03-07 12:31:13','2023-03-07 12:31:13'),('280ffbbfdd99b22ebd987e8a0d5e7df26c6e2ae43505b78664fdfb119856584b541a666bb66a1911',75,1,'mobile','[]',0,'2024-07-08 10:57:15','2024-07-08 10:57:15','2025-07-08 10:57:15'),('284c6f02f374b99ffd299e2b76bb697958ef40da496a44437c302b6d9a1a26d227f21cb532f03c6a',13,1,'mobile','[]',0,'2024-07-15 05:28:58','2024-07-15 05:28:58','2025-07-15 05:28:58'),('28e7c2c11fb97c96d782f2337b8ab0e3cda4696d20ba7f2768ada8b11550f9a5249c09afe23c79fb',70,1,'mobile','[]',0,'2022-03-14 11:55:51','2022-03-14 11:55:51','2023-03-14 11:55:51'),('297f8f14ad4b2e95c368c811988a4f609cc19782e483a3a905902c1e92134a52b7604dc4439b599f',2,1,'mobile','[]',0,'2022-10-09 10:33:34','2022-10-09 10:33:34','2023-10-09 13:33:34'),('2a220471a8ce4f7eddd8d141fcb287176db247a59e496026232a18e5c74197e19ef34284eff35b98',70,1,'mobile','[]',1,'2022-03-14 12:28:05','2022-03-14 12:28:05','2023-03-14 12:28:05'),('2adc6c965484d2b7b2a58318a3c3dc069eda6c0a8438c4e127608f485794168ef58475b21e07b212',2,1,'mobile','[]',0,'2022-04-13 14:51:07','2022-04-13 14:51:07','2023-04-13 14:51:07'),('2aeed31f6592aa720cb3cd835f0bf71c3b2ae7e650fc2da0a6a2faa5bd2a618e98c8d5e388e20ae5',1,1,'mobile','[]',0,'2022-02-21 11:37:26','2022-02-21 11:37:26','2023-02-21 11:37:26'),('2b21192fe88642e3a852d4a4101dc132151ca4531e2d97dd06548ffb359dfcbabf59828386ef85ed',1,1,'mobile','[]',0,'2022-04-19 16:16:33','2022-04-19 16:16:33','2023-04-19 16:16:33'),('2b2c3df1b7d4be6ff08eee285295761588f4ee1a0c3a4221016b71d413f309c0cd3338efd1472649',3,1,'mobile','[]',1,'2022-12-08 08:14:59','2022-12-08 08:14:59','2023-12-08 08:14:59'),('2b39104e541bc4af59ed3cda0944b227984d33598808523106f15eed95f47dd4ad17614aae658992',1,1,'mobile','[]',1,'2022-03-13 13:35:23','2022-03-13 13:35:23','2023-03-13 13:35:23'),('2b82efa0c8c4e758e481a6983329bb556e97e50da9b085c8d36081ca06128bf8a149c086caf480cf',16,1,'mobile','[]',0,'2024-07-02 06:33:40','2024-07-02 06:33:40','2025-07-02 06:33:40'),('2b8b05213062a38b083296b84cbd7d6123163f022549179d8e823c8300f9975e2ec1f442fdffd393',1,1,'mobile','[]',0,'2022-02-17 09:21:11','2022-02-17 09:21:11','2023-02-17 09:21:11'),('2bdeb487d2c936cb665f33fa75b892eb4f3d0723db5d3662ac759049fe020327af1941242adebd54',13,1,'mobile','[]',0,'2024-07-11 10:55:26','2024-07-11 10:55:26','2025-07-11 10:55:26'),('2bf74e5a12e56bcbb76313461ce169f8a9645a5598b23de6a8f0acba372bb2ff2318c04e7f342e5f',30,1,'mobile','[]',1,'2024-07-08 10:36:52','2024-07-08 10:36:52','2025-07-08 10:36:52'),('2c9408118a8b90169307b2ddbec82f538f8d5ee284944fcc1976d5a666323959c9659566e9c916e8',14,1,'mobile','[]',0,'2022-06-19 15:51:57','2022-06-19 15:51:57','2023-06-19 15:51:57'),('2cc9965aa39b24427115dfa69825335251e595ff0dee52d131b31a2d9585da879a787611aae90e12',54,1,'mobile','[]',0,'2024-07-04 06:43:13','2024-07-04 06:43:13','2025-07-04 06:43:13'),('2d2efdcdb16db1f2d1c3a9a825d10726d1ccbce612dee55c79a084d99012112680c5f30d0dc68205',1,1,'mobile','[]',0,'2022-05-25 12:19:46','2022-05-25 12:19:46','2023-05-25 12:19:46'),('2d461b4686443a665f4c9dd0048f301c3b60090566930dffc2fa5430fc6e5cfaf8d9a0c119d7bc44',10,1,'mobile','[]',1,'2022-10-27 16:01:06','2022-10-27 16:01:06','2023-10-27 19:01:06'),('2d4a806fb9fba951e42196258d78b1a007244ecb9a8cdef917cae9ccbd3607ed88212e2ebccb6b92',9,1,'mobile','[]',0,'2023-07-28 10:53:19','2023-07-28 10:53:19','2024-07-28 13:53:19'),('2d538ff136e8b11330f34049a7b7145518595fe754cbff257682998356c0de117a39d41e2cd90ddc',6,1,'mobile','[]',0,'2022-08-09 13:45:30','2022-08-09 13:45:30','2023-08-09 16:45:30'),('2d739cbf28b2abd6584f1eecccff9d1364f51b3ab4ba998d7154ec158fa692326e54b0b0456a581b',10,1,'mobile','[]',0,'2022-10-27 20:14:32','2022-10-27 20:14:32','2023-10-27 23:14:32'),('2da81d7d56b963aed534b9f26c1f751989b50b931517e1e1df0140decbb38765d2b08e4523002ca0',2,1,'mobile','[]',0,'2022-07-17 06:38:38','2022-07-17 06:38:38','2023-07-17 09:38:38'),('2ddcd97088da4aba20cdc9139c1650b98f266dc32fe23fc8328b01f02d485011f4f1c99dce61d999',1,1,'mobile','[]',0,'2023-11-05 10:56:39','2023-11-05 10:56:39','2024-11-05 10:56:39'),('2e05e4d22b330c60a9bb85cfbac268e8d42d6869d9ed8b6fb1c996528f334f842a14fb1e56ee9134',1,1,'mobile','[]',0,'2022-04-19 16:51:07','2022-04-19 16:51:07','2023-04-19 16:51:07'),('2e567c3aedd33e3d0c7b40dcea23f2f070b6d9ef4d80877b3fb69cc69870d5f21ca4e502e39e4a0c',9,1,'mobile','[]',0,'2023-07-28 10:53:49','2023-07-28 10:53:49','2024-07-28 13:53:49'),('2e7ce47c09d9ae004880741486fe91907cf15d9d10a11ce91d9975382a76dd86ed14dadf0e113e5f',4,1,'mobile','[]',0,'2022-02-20 11:18:01','2022-02-20 11:18:01','2023-02-20 11:18:01'),('2e913361be4a721f3cb85f20b556f282c1fbd3bc7615cc45cbd901211a8fb36d3796b110dd8e65f8',3,1,'mobile','[]',0,'2022-06-27 10:44:55','2022-06-27 10:44:55','2023-06-27 10:44:55'),('2eb77ae6235ce22f1d70aabdfc223bfe4332f563c115b402ec0c67ef0441278392d8f27e9e04b690',50,1,'mobile','[]',1,'2022-03-10 09:12:49','2022-03-10 09:12:49','2023-03-10 09:12:49'),('2ec2b8a604f1deaa6a3515cd0e259c8120c2cf0526692953fd51dffacfd9eb5b96be3628cc92d400',1,1,'mobile','[]',0,'2022-04-13 11:05:29','2022-04-13 11:05:29','2023-04-13 11:05:29'),('2eed6a4ca53cf86abcc2b63252886d607537985d17f70479f439539a5dcb4b1bcb862461843d8165',1,1,'mobile','[]',1,'2022-03-10 11:27:35','2022-03-10 11:27:35','2023-03-10 11:27:35'),('2ef6db4110c231539f5f5e283ae25005801bc5e4456afa485edb057ca83d716079f6b2453cb43dc3',53,1,'mobile','[]',0,'2024-07-04 06:37:54','2024-07-04 06:37:54','2025-07-04 06:37:54'),('2ef9e9e9624b425dea2e0648261cbc8ae77fc1422a69ea4e66a9b7a344a3a891f09edc7d74adb87b',72,1,'mobile','[]',1,'2024-07-09 11:13:05','2024-07-09 11:13:05','2025-07-09 11:13:05'),('2f6fb816c2f4b813613b0f27feead2ebb2f9c7753313527cb55e2fd6c6d0067415febbba07155f8e',1,1,'mobile','[]',0,'2022-02-17 10:35:05','2022-02-17 10:35:05','2023-02-17 10:35:05'),('2fa9a377602d7aed1ddd67271c55876a061444ae4f79fe93db65d6f2d32a94ed3782597ae0c543cb',1,1,'mobile','[]',1,'2022-02-16 11:00:03','2022-02-16 11:00:03','2023-02-16 11:00:03'),('2fff088548227de494e1c10f4a5b5554865a0881638bcc8b1eaa41bfc621370a992f0cb5906fe292',69,1,'mobile','[]',0,'2024-07-04 10:04:26','2024-07-04 10:04:26','2025-07-04 10:04:26'),('302e96772fc71ce1b0ae9833b572e790025c7b71befdcd0068f49e4af150019261e3ed6a93d6fd41',47,1,'mobile','[]',0,'2022-03-09 13:22:35','2022-03-09 13:22:35','2023-03-09 13:22:35'),('305be65220d2dd428f1ef7b0edf8423eeaa8eb039c62b43f3502ebd73975a9402149fc48d653a1f1',1,1,'mobile','[]',0,'2022-02-14 10:34:08','2022-02-14 10:34:08','2023-02-14 12:34:08'),('31000fa065c6df75dad8b332745b431d5a4e92c54618a937b3b2274e54eafc9ffce3963eeed6e550',10,1,'mobile','[]',0,'2022-02-27 07:23:17','2022-02-27 07:23:17','2023-02-27 07:23:17'),('311ea4816f4e3147d81b8b5515be4412349114da5c76838369d988b9173fe970ab27f7ec11efaafd',3,1,'mobile','[]',1,'2022-03-24 08:09:20','2022-03-24 08:09:20','2023-03-24 08:09:20'),('319bbbcbbe9151eafb4daaf3079ba38f36c312e20e849be9854c4a329886f5e485c28206e26b0170',6,1,'mobile','[]',0,'2022-08-18 13:26:24','2022-08-18 13:26:24','2023-08-18 16:26:24'),('31d8c162fb21b97d864512f4a783d27d121c224ad1253d316704c459b5cca42129dc2cb2f05b04ec',1,1,'mobile','[]',0,'2022-02-14 10:51:12','2022-02-14 10:51:12','2023-02-14 12:51:12'),('31e091ff2d974dde135052aa95807da3c6c33d9b41c54bcb3b7f5e082f441784cf6fd38513a1f1ca',1,1,'mobile','[]',0,'2022-07-06 07:24:56','2022-07-06 07:24:56','2023-07-06 10:24:56'),('321b34fc9e3dcdde6d2321a22da138506e207458e05d918de3bd0e381847160641e14bb87d6c26e1',50,1,'mobile','[]',1,'2022-03-10 08:05:06','2022-03-10 08:05:06','2023-03-10 08:05:06'),('3236ababf93617c32153f60e79a6974200d55cd11a865e8c794958d5d78e0849a6310f35dbb1bbbb',11,1,'mobile','[]',0,'2022-10-02 10:09:20','2022-10-02 10:09:20','2023-10-02 13:09:20'),('331f17110c2673f49a4495a774d9d836b675670bedb284a6e3d895f85c5b8d010336064dc12ae6ac',1,1,'mobile','[]',1,'2022-03-10 09:16:48','2022-03-10 09:16:48','2023-03-10 09:16:48'),('332849add91aeb535c3edf09085e8a93b2d7b71953a948847e2b79851900810c4753d72a2a1f484b',1,1,'mobile','[]',1,'2022-03-13 13:29:35','2022-03-13 13:29:35','2023-03-13 13:29:35'),('3388b40532aa07ef03abb3d45c071b349a79dc5d3203f44f142e6d3188ba448e8da74425ea7f173f',36,1,'mobile','[]',1,'2022-02-28 15:28:35','2022-02-28 15:28:35','2023-02-28 15:28:35'),('3388c9dddce7409ef12aa30112089d37c70c749ebdc6bc70fd407e2608e5d71d0e6095a69e643c33',37,1,'mobile','[]',0,'2022-03-07 08:17:09','2022-03-07 08:17:09','2023-03-07 08:17:09'),('33e4a48a9f0256bc9bb12a609e4330dc472476b713cc5d11fa88b50de632dde5f5b4bddf12630b8c',49,1,'mobile','[]',0,'2022-03-10 07:39:48','2022-03-10 07:39:48','2023-03-10 07:39:48'),('3411ae40d05427ef87db7c6a4efa25027bcdd2c35b502b2c5e96568bfd62ceac9539b734cbe2b254',1,1,'mobile','[]',0,'2022-10-02 10:18:31','2022-10-02 10:18:31','2023-10-02 13:18:31'),('346ee94de27c681c6bb524da22b69acb7c9fb16e34fcd043f252baf78102d06bc17974acf0170f28',4,1,'mobile','[]',0,'2023-02-15 09:58:08','2023-02-15 09:58:08','2024-02-15 09:58:08'),('34916015b2a644b87346e053345fab46ac96666c4b2bdae01f827c7d652ab5799bc420a0f96b4a94',7,1,'mobile','[]',1,'2022-10-24 06:06:36','2022-10-24 06:06:36','2023-10-24 09:06:36'),('34bef7b20e180e8b53f80a70170843e6778eececceb9b708b0fd55d794df6eb045a2b870bd2e7cf6',70,1,'mobile','[]',1,'2022-03-16 10:35:40','2022-03-16 10:35:40','2023-03-16 10:35:40'),('34c98283b8ef0c322efa4697d0ab420a4347fa56f65ed4187e315e096825c0b8b4b8d97cda60f5e6',72,1,'mobile','[]',1,'2024-07-04 15:43:07','2024-07-04 15:43:07','2025-07-04 15:43:07'),('351329b50c7cbda77ae1846e90d6fab1f56021c8c58bcaf58f834ef7fc3fe12c86b22af8b6c139d7',30,1,'mobile','[]',0,'2024-07-08 10:47:41','2024-07-08 10:47:41','2025-07-08 10:47:41'),('357dbd520ed21901cf90923cb99c96f52b5fedff5ac25e73d779deff9a85d92ab7fb9b7c8f224a53',15,1,'mobile','[]',0,'2022-06-19 15:39:19','2022-06-19 15:39:19','2023-06-19 15:39:19'),('35a927f2de90ab449f4b2c70b2894cdd86dea8d141e1d2b8acbdf15774c4b3e3e820f4dcb27391ea',78,1,'mobile','[]',0,'2022-03-17 13:08:26','2022-03-17 13:08:26','2023-03-17 13:08:26'),('35ab8b43c8d179e58ddc9227e6375829d64f6e6a2967832b7d75dcc9b9662f4fce40478c9171658c',1,1,'mobile','[]',0,'2022-02-17 10:21:58','2022-02-17 10:21:58','2023-02-17 10:21:58'),('35f00ae8e93a97dc89a0ba0a556986376863a4bdcd6f714e5e278f4feef5e99978d87150d30be577',4,1,'mobile','[]',1,'2023-03-12 09:13:52','2023-03-12 09:13:52','2024-03-12 09:13:52'),('36927918d3f2eadb4ab60b3bfdb4a2e081e82a2c3e6efd254dec3985466e7a72fda5f3f2b7beb2d9',30,1,'mobile','[]',1,'2024-07-09 15:35:21','2024-07-09 15:35:21','2025-07-09 15:35:21'),('36e9d6385f2ded2750360b8bd218da3798dcdb78f5b300132136310680aaed982f8e862d52d5f733',1,1,'mobile','[]',0,'2022-07-06 09:38:14','2022-07-06 09:38:14','2023-07-06 12:38:14'),('37371b94776f2c2691df9f35b327d645bd24599c2378245202fc4cdbdee4c729d83a399660d558aa',31,1,'mobile','[]',0,'2022-02-27 07:12:25','2022-02-27 07:12:25','2023-02-27 07:12:25'),('378ee1f718b5a90eca7969a88f2b59c1ebeb18b8c660722902e16f61732fa0f3cd575e155f857b49',21,1,'mobile','[]',0,'2022-06-25 09:02:35','2022-06-25 09:02:35','2023-06-25 09:02:35'),('37b8cbe860933d8d60f6cf06a627b10ae7c3816dca57b9d7f1721731466fff7b2bd4ac67ce2810cc',78,1,'mobile','[]',0,'2022-03-17 13:05:17','2022-03-17 13:05:17','2023-03-17 13:05:17'),('37ef946777659e347f9dd1935017982c8ff53387ef9085d9268dd47032e3a914c13eb4b5e38b9641',7,1,'mobile','[]',0,'2024-07-01 09:16:58','2024-07-01 09:16:58','2025-07-01 09:16:58'),('37fd2f9fdc6df9ca7927dbfceffe7120f5f8d897a65cf958d52240969d4f380f64c6c4f8c86e9274',3,1,'mobile','[]',0,'2022-05-25 08:54:24','2022-05-25 08:54:24','2023-05-25 08:54:24'),('381f307311605fd0c29c65d89a41c5afd6c5a118522b61eabbaa70d5db5425f75e0b9b077d0a0d36',13,1,'mobile','[]',0,'2024-07-10 09:53:57','2024-07-10 09:53:57','2025-07-10 09:53:57'),('384734a48ec5f6f124361db6818500e7a2cf4a784ad49ccbeb34eaf81c92f3b6541add74071b7eec',2,1,'mobile','[]',0,'2023-09-11 04:21:17','2023-09-11 04:21:17','2024-09-11 07:21:17'),('38726e23040065bd6cc1fde841a165fa98082afea02b0ef6af982227bb3ca442868d1a29f5180888',1,1,'mobile','[]',0,'2022-03-06 10:12:09','2022-03-06 10:12:09','2023-03-06 10:12:09'),('387f8c934274d258edef0af58dc9f54c432a912bc330322f7df60df2df2b40538c0cc59e1be6a183',16,1,'mobile','[]',0,'2024-06-30 09:07:13','2024-06-30 09:07:13','2025-06-30 09:07:13'),('38c6eb86bf3c49735fcf3bbe919ddc5944f049da54f4af3de354c0c6af8460934383374be5083f58',1,1,'mobile','[]',0,'2022-04-13 10:55:26','2022-04-13 10:55:26','2023-04-13 10:55:26'),('38f28cba10f716319febb42376a6769602f17c48cb1e11a82d0575624f408b62f622df4118c57e43',19,1,'mobile','[]',0,'2024-07-01 12:42:44','2024-07-01 12:42:44','2025-07-01 12:42:44'),('395ce280893ffe882f7ef51ea84e6c25bb0a47218de8cde952470cd76236c26b7dfa9a2396fc69f1',47,1,'mobile','[]',0,'2024-07-03 15:19:57','2024-07-03 15:19:57','2025-07-03 15:19:57'),('39611245a7e0b5a582b3001864747f6b329981c5ac43657dde13d6ce659493f4546ee4fdb82baaf8',36,1,'mobile','[]',0,'2022-02-28 15:27:59','2022-02-28 15:27:59','2023-02-28 15:27:59'),('3a331d3f3a8f9391748dd51e45307eb074e07965da9477e8bae9a60415720e3227f895f61b443db9',1,1,'mobile','[]',0,'2022-10-02 10:24:53','2022-10-02 10:24:53','2023-10-02 13:24:53'),('3a6fc02d54381d855b2ba76466fb4834d78c641a6fe0eebf4a72184d7c151db61b4ef3aad67a7cad',1,1,'mobile','[]',0,'2022-12-04 08:39:00','2022-12-04 08:39:00','2023-12-04 10:39:00'),('3ae9b4c19db19eefe7fa539edf81ee88363ea15f67edb1f1357be2d413a0411c4a185f9aa981851b',1,1,'mobile','[]',1,'2022-03-14 07:38:18','2022-03-14 07:38:18','2023-03-14 07:38:18'),('3b75b13b250c90a62668617f73a12d782f06eac4dac833bdd66000cd0ac65101ae28060ffd7b5a00',43,1,'mobile','[]',1,'2022-03-09 11:22:45','2022-03-09 11:22:45','2023-03-09 11:22:45'),('3b9ce0901b4f80eb4ed6bfd1e6447bdd7406c67e99b8b3bb798be36580ee9b003309ec92364b1191',17,1,'mobile','[]',0,'2024-07-01 12:26:50','2024-07-01 12:26:50','2025-07-01 12:26:50'),('3bbb0e71db720673f4b6e8bb19a841a69c293887d1b9908b8ecdb78f7536779db6690ff5f2f27d19',15,1,'mobile','[]',0,'2022-04-06 10:44:46','2022-04-06 10:44:46','2023-04-06 10:44:46'),('3bdd09293f3f36b0830b870dff6a25c25131cb3f210f086cc33da7211d10a9267b24207d0494b7dc',23,1,'mobile','[]',0,'2024-07-02 05:46:10','2024-07-02 05:46:10','2025-07-02 05:46:10'),('3befbefab2d57e4c111b2162b8e3fa02d42e2b5cb053404d14c36c3d520ae687e008df640ddc3ca4',7,1,'mobile','[]',0,'2024-07-01 06:36:20','2024-07-01 06:36:20','2025-07-01 06:36:20'),('3c706f32c2e80c5c9346815b685683dac8a2c9ba5066ab1d71984e59380c2b8e54f1d4055c143d0a',11,1,'mobile','[]',0,'2022-05-10 11:56:07','2022-05-10 11:56:07','2023-05-10 11:56:07'),('3c998d8d73661a6c5c1dc27a263de73f8bf0b99638b893c0341dcda691f13c12854023a5c6db74b6',30,1,'mobile','[]',1,'2022-02-27 07:11:28','2022-02-27 07:11:28','2023-02-27 07:11:28'),('3d1dc6edec1210c36d3d52ee8fda4d07d76203108a76e3cef440c7b13b38932bc253519e0f240a02',41,1,'mobile','[]',1,'2022-03-09 11:07:33','2022-03-09 11:07:33','2023-03-09 11:07:33'),('3dbc95aaa0a12d5f71f784714789c480024672679caebfb4eb394abfc6a7f45478e7fe4331f1a589',3,1,'mobile','[]',0,'2022-03-24 08:08:31','2022-03-24 08:08:31','2023-03-24 08:08:31'),('3e1a0da86eda8d3ff364cd56fbddd8f259d35b1f2e157ccd815c17cdd3e94a15ec2e6cc5301cd93b',12,1,'mobile','[]',0,'2024-06-09 07:02:15','2024-06-09 07:02:15','2025-06-09 07:02:15'),('3e322a5e9f2d89c50ffa0d92a558c1219dcd39056c03f487f4abbbb03ac7cf97cf948d3147766779',8,1,'mobile','[]',0,'2023-09-13 07:07:42','2023-09-13 07:07:42','2024-09-13 10:07:42'),('3e368fc29b3595dbc73645d39f0c2ffcee5fe325226151bf273141bc973486bb5ac3da0d358be76b',14,1,'mobile','[]',0,'2022-06-22 14:49:48','2022-06-22 14:49:48','2023-06-22 14:49:48'),('3e73e72813bae1e78f8c5e4123dc9713b6ff2dad1af69048cbb1971cce072200106068c5cfc4cd04',8,1,'mobile','[]',0,'2023-07-23 08:52:47','2023-07-23 08:52:47','2024-07-23 11:52:47'),('3e87220d82d0262f99a3081b1069310b83ee41e8482e475a0bfc550dc6076333f9bdf3fec3253960',57,1,'mobile','[]',1,'2022-03-10 08:34:54','2022-03-10 08:34:54','2023-03-10 08:34:54'),('3ed2212e347aa530533629d01a0dd6729376de0199a923252f334fbf470a70ef5ee67d6db9861973',2,1,'mobile','[]',0,'2022-04-14 14:03:54','2022-04-14 14:03:54','2023-04-14 14:03:54'),('3ed47de2f9d5ad13547cc5094b549a7f29e1ee4197a78273142ad5d6af198a170be07a6b179776b1',44,1,'mobile','[]',1,'2022-03-09 12:03:13','2022-03-09 12:03:13','2023-03-09 12:03:13'),('3efdaa20acdc81ed1984699efd6f16918f4c1148697b8ea845585ef3dab07f1dc38982b9b4a3133f',3,1,'mobile','[]',1,'2022-03-24 08:10:26','2022-03-24 08:10:26','2023-03-24 08:10:26'),('3f028f39ea31042c8b9cccacf812c80865d20e5fa55ca29788c3123e36318276fe68b023e1925afd',1,1,'mobile','[]',1,'2022-07-06 07:25:13','2022-07-06 07:25:13','2023-07-06 10:25:13'),('3f78926c5f905d4a8880aea7baacbc1d392b73183c8c48f80c985e9c42dffeba0430c6d2fb0c599f',12,1,'mobile','[]',0,'2022-05-10 12:13:52','2022-05-10 12:13:52','2023-05-10 12:13:52'),('3f9f48cfc3f53ad52046671ad14a18e631f81e208ef171c83953f280bd3fb6a815a2eba8ff8e5367',21,1,'mobile','[]',0,'2022-06-25 12:23:48','2022-06-25 12:23:48','2023-06-25 12:23:48'),('3fa615c92a2b28e12c781840554bf8bb83c78216c2018b2823b1438e28cb7b5d4210cfa01ff03c75',24,1,'mobile','[]',0,'2022-06-27 10:42:25','2022-06-27 10:42:25','2023-06-27 10:42:25'),('3fb321e63398ecbbf34b6c26b5e1a2f36e43b032c1f7f4898322fb152e133830bef91e11396be629',45,1,'mobile','[]',0,'2024-07-03 14:53:12','2024-07-03 14:53:12','2025-07-03 14:53:12'),('400042a2e88c2fced96bc6fbd692d2897a1816599bcf5f3101196ebd3b29fedeab2c3ee79dcfef02',50,1,'mobile','[]',1,'2022-03-10 08:33:27','2022-03-10 08:33:27','2023-03-10 08:33:27'),('40af71fe74ea4ed232ac0efd8e5528d78b380d2ddd1eec8abbc8e6c6c46d83e788b2f254e59af3c6',63,1,'mobile','[]',0,'2022-03-10 11:59:20','2022-03-10 11:59:20','2023-03-10 11:59:20'),('4151784e213cb131c61e3f291f852f50c3a3d38682bf15908d937dba491dfd13394854ea66b2b3a0',30,1,'mobile','[]',1,'2024-07-09 11:15:09','2024-07-09 11:15:09','2025-07-09 11:15:09'),('41700a7a95cc2ca898c365a53bcad98d8cb53c38c5e07db96ff019fb9dc7edb11e6190ee51bd00f9',49,1,'mobile','[]',0,'2024-07-04 06:19:21','2024-07-04 06:19:21','2025-07-04 06:19:21'),('41af8110c926c1606a2375b51e12a547ed2ad253fba8bbc5c5cd5fd5042088024d3009f1091955f4',7,1,'mobile','[]',1,'2022-10-26 06:01:00','2022-10-26 06:01:00','2023-10-26 09:01:00'),('42345b7abac1e740dba5d4a1263d3d949402ac8bb114341351810bce2a1bd7d10bbfff80f3846984',3,1,'mobile','[]',0,'2022-06-19 15:51:05','2022-06-19 15:51:05','2023-06-19 15:51:05'),('424819ad6074baa676ddd6a956aed64f4c40ba16daa215cf07a478ab5de63597d5506a233d8346c5',9,1,'mobile','[]',0,'2022-05-10 11:53:35','2022-05-10 11:53:35','2023-05-10 11:53:35'),('4298be76b1a8a0595a9a1dfd68ab9d17d62bb257d11308e487a9c83c47c763d20aa5b02fe769d4c8',2,1,'mobile','[]',0,'2022-10-10 07:27:52','2022-10-10 07:27:52','2023-10-10 10:27:52'),('42a0b7c2fc0fdb06f2829a81256173f07b3009c9cb265a80df32b467e070dc2a4f11b8d0b4d28ae5',30,1,'mobile','[]',0,'2024-07-04 10:05:47','2024-07-04 10:05:47','2025-07-04 10:05:47'),('42d5fc91870e485083e5cc5b1b0cd63ecc02898159078eecbbb088588df6f2460dc7fce9d020f23b',1,1,'mobile','[]',1,'2022-04-13 11:35:50','2022-04-13 11:35:50','2023-04-13 11:35:50'),('43acccd5b3123825613043f69f10cb4ee3baae2242e4715e56e1ddffb974bd2a400c156a2b42e2e5',1,1,'mobile','[]',0,'2022-03-02 12:13:39','2022-03-02 12:13:39','2023-03-02 12:13:39'),('43b0f4e2e41ab02268bf3966af1bdbffc867774429e78247337b3df09b26738bf417cc8d61a040b4',2,1,'mobile','[]',0,'2022-04-27 15:43:01','2022-04-27 15:43:01','2023-04-27 15:43:01'),('4403ce3693b78878fd5af3f7825ee74be657e7c7b3f578fd3b823e10bf28845edb98b7de00f17a14',78,1,'mobile','[]',0,'2022-03-17 13:00:37','2022-03-17 13:00:37','2023-03-17 13:00:37'),('441c6f92dc75907c8a03b94e6004b6e1fc84e45d327dbb99020cc0dea6f4c8818fc2313a98a9c547',30,1,'mobile','[]',1,'2024-07-11 11:32:18','2024-07-11 11:32:18','2025-07-11 11:32:18'),('453451e89989932de495799618618ab5bcd72198811af2cc1e326b8ca91c83978e5f25db93c16a09',1,1,'mobile','[]',0,'2022-02-21 09:21:30','2022-02-21 09:21:30','2023-02-21 09:21:30'),('45c1c2935ffa3342de881ce37b06b63d78f52a3a8acbd770d3c876c078482e53ec5dbf6acb50c800',35,1,'mobile','[]',0,'2024-07-03 13:14:48','2024-07-03 13:14:48','2025-07-03 13:14:48'),('45cd939d8922cf359cbc2f1a5b59c97cecfc3a0b7d7ec132d9715fb8d38cf1d523f73640552feb82',7,1,'mobile','[]',0,'2024-07-01 05:55:01','2024-07-01 05:55:01','2025-07-01 05:55:01'),('469e7bf97a16e0a6b79683d4c674c5c0ed60bd07131ea7be2c620cb2eea2d751989dc08978bf15f2',15,1,'mobile','[]',1,'2024-07-04 14:22:57','2024-07-04 14:22:57','2025-07-04 14:22:57'),('46eba305bc09c8f64d8854dada054674fe0cf5feaed65452a2f7b380ece0c03da2b1f9527301ba83',30,1,'mobile','[]',1,'2024-07-09 13:13:21','2024-07-09 13:13:21','2025-07-09 13:13:21'),('471d9adc173483028fb52be6e8c759259439ae69891dda701789b260afc93cfaa88cca0c35485b95',13,1,'mobile','[]',0,'2022-03-30 11:28:47','2022-03-30 11:28:47','2023-03-30 11:28:47'),('473a605988b3d5d30cc0b72a8db0312074ddc0e2f78c210cfe2ae4e19badd5a4737510422bfb77f9',29,1,'mobile','[]',0,'2022-02-23 09:39:52','2022-02-23 09:39:52','2023-02-23 09:39:52'),('478286320176c59160c851f7a2720bfef64828a1708d65eec257ed258fda53ca332a895f17b7e94d',7,1,'mobile','[]',0,'2024-07-01 05:24:45','2024-07-01 05:24:45','2025-07-01 05:24:45'),('4787204d452e47f437b8a4d5386f524ebcf48da8b1449ef74d0b365d2c3400833ae89ff322c9700a',49,1,'mobile','[]',0,'2022-03-10 07:40:00','2022-03-10 07:40:00','2023-03-10 07:40:00'),('479f4a35434a7e7487193b71e13a7098ccaa1d99654395787105ad12511b521af0a46dcbd629b05e',2,1,'mobile','[]',0,'2023-09-10 07:18:28','2023-09-10 07:18:28','2024-09-10 10:18:28'),('47b75d1cb014542aa9be0133f8a4e964599b6806158bfc6111e7ac611ef87dfca35102f666b05ffc',2,1,'mobile','[]',0,'2022-07-17 06:38:50','2022-07-17 06:38:50','2023-07-17 09:38:50'),('47b9b612848c923da6ed1522df2b44baa6dba5fc4ce37596d97c2c941399c2836d10209ad9cd30a6',1,1,'mobile','[]',0,'2022-03-15 11:41:31','2022-03-15 11:41:31','2023-03-15 11:41:31'),('4812f12a82e171a9e9727d77a7106645c7587090f72deda83319673c6b29b0d1ab272e9ca95c7afc',1,1,'mobile','[]',0,'2022-03-15 11:42:26','2022-03-15 11:42:26','2023-03-15 11:42:26'),('4852df5ce3d5af32cf9096ad9254a1c880aaea3da6fafb362b23fcdfe96d3277914f18fa99e96d3a',14,1,'mobile','[]',0,'2022-04-01 14:35:19','2022-04-01 14:35:19','2023-04-01 14:35:19'),('4896b9fed25598de1eb3da3e3e5c10f32730cf488ff40e90c3656a11d2789d7ce2101c1b619343a7',7,1,'mobile','[]',0,'2024-07-01 06:25:08','2024-07-01 06:25:08','2025-07-01 06:25:08'),('48fdfda22d400f11a7bf26085f39153ecc27478b259b8591e5a45ecfb8444e7c0462a776c0c072d7',63,1,'mobile','[]',1,'2022-03-10 11:35:07','2022-03-10 11:35:07','2023-03-10 11:35:07'),('495a0d00f31d26ee3ef44bafbaade0b791d2fdb0e5bd6697731c6cdcfb05922054bcaf46faf74231',10,1,'mobile','[]',0,'2022-02-27 07:22:47','2022-02-27 07:22:47','2023-02-27 07:22:47'),('499de236add96f9641d6d37bc2367ec7e57243d9b252874ed8c5a41147e299316a28cb98b913b655',30,1,'mobile','[]',1,'2024-07-09 15:47:57','2024-07-09 15:47:57','2025-07-09 15:47:57'),('4a2b1fb729bf931462741caf605ac3b506c8e4a6830b39e91f4403c3140b784473cd51db9869e0e4',9,1,'mobile','[]',0,'2024-07-04 11:15:09','2024-07-04 11:15:09','2025-07-04 11:15:09'),('4a603b94c9ca910a1e70520275be78b6d74b018ac0dfc06893f2373787ac0e82d4e77632eb675b47',55,1,'mobile','[]',0,'2024-07-04 06:46:11','2024-07-04 06:46:11','2025-07-04 06:46:11'),('4abe3b0a9e5038bae12333a5f0727697e40df1cd536a5eb29e949aaed9247ad734ac2ea107ff7a7c',13,1,'mobile','[]',1,'2024-06-27 09:24:36','2024-06-27 09:24:36','2025-06-27 09:24:36'),('4b69794fa61397cefcda28808342c8c2906b2ce9aa21e6f8640280f6f060716a3c85fa237bedb84d',1,1,'mobile','[]',0,'2022-02-17 10:21:02','2022-02-17 10:21:02','2023-02-17 10:21:02'),('4bb3b4a9d135c99ee4abd9fb28cb3f1201840131512bf59e4b83b5b6334b4191c1b51884185e2183',6,1,'mobile','[]',0,'2022-08-09 14:46:42','2022-08-09 14:46:42','2023-08-09 17:46:42'),('4bf900e5f5eec6eeb590207aae1e3decb41b85b840f952767782459a4f6116f8475ca739b123bd3a',2,1,'mobile','[]',1,'2022-10-10 10:49:09','2022-10-10 10:49:09','2023-10-10 13:49:09'),('4c197624b024f691dc18f220054757063f1611f863c7733410b3cb3346d5074a903c0698024b9ad0',30,1,'mobile','[]',0,'2024-07-11 08:49:32','2024-07-11 08:49:32','2025-07-11 08:49:32'),('4c3c72fc9207a1a1c878036231fcf20f22322898c2a06cbb795681b1c2fc112c6419dee3edc7fd3f',19,1,'mobile','[]',0,'2022-02-21 11:56:01','2022-02-21 11:56:01','2023-02-21 11:56:01'),('4c881c4a72ae0e0634c64477dd1a2bd553a86cb6e23aec5c558e8a65169f6a29040600979824d721',1,1,'mobile','[]',0,'2022-03-15 11:40:49','2022-03-15 11:40:49','2023-03-15 11:40:49'),('4c99e77ec8f4448a5082a8bb6fd6b2b0ed96c25a430136ee3612ba8437ecb974958ad0d099d484bc',9,1,'mobile','[]',0,'2022-02-20 12:16:20','2022-02-20 12:16:20','2023-02-20 12:16:20'),('4ca2d1dc4ba8233a95f868230bda1ea7a682f9665fc123e62a14e675d756fd2f71dd1d5a9d9f3469',4,1,'mobile','[]',0,'2022-03-24 08:16:03','2022-03-24 08:16:03','2023-03-24 08:16:03'),('4ca7249097570368739c831474cc8ab1a0bb3a86971a980611b7687d3205f86802e9949d144dec80',3,1,'mobile','[]',0,'2022-06-22 14:53:13','2022-06-22 14:53:13','2023-06-22 14:53:13'),('4cbd31bf824549e9123a2774702d692e1c41a4666dffb4d259f31a9041cb3e8115d5a372557c6b02',30,1,'mobile','[]',1,'2024-07-14 11:22:44','2024-07-14 11:22:44','2025-07-14 11:22:44'),('4cc0a3e9b55946d2a6dbf8ee2a128f5e3030f1416b2cde8b45cc8908b956c075c800088aa7ee9f6b',7,1,'mobile','[]',0,'2024-07-01 05:37:26','2024-07-01 05:37:26','2025-07-01 05:37:26'),('4cd4981c485dd461a4f0a3f37d9c60d43eccc89f5d31b193de253d1524dd6ae6d13884060d0c4e8d',7,1,'mobile','[]',1,'2022-10-24 06:04:37','2022-10-24 06:04:37','2023-10-24 09:04:37'),('4d1342cfd64c836a2c87f64977a97ae0d2547f1e8328df3ec7dac5c8141acee688c6e0a33c83b1ce',2,1,'mobile','[]',1,'2022-10-09 11:33:09','2022-10-09 11:33:09','2023-10-09 14:33:09'),('4d88f66b2866498fde47aa7d883dda91d2465e299d46e558bdee8a0d0c6e43999236728deb62c82d',50,1,'mobile','[]',1,'2022-03-10 06:59:51','2022-03-10 06:59:51','2023-03-10 06:59:51'),('4dec241ba00a3fa70597f5b6b52af2a89725ee2c2ed6cc39ddd4db3a47f94e053bdbd5f6eb4db980',24,1,'mobile','[]',0,'2022-06-27 12:37:28','2022-06-27 12:37:28','2023-06-27 12:37:28'),('4e0a83bba18e6e23d29c9a0b2c1c048fa7ee096acce5138c3f8c637c17070a0fb76ac678987386d3',29,1,'mobile','[]',1,'2024-07-02 14:26:52','2024-07-02 14:26:52','2025-07-02 14:26:52'),('4eb7926f20a6f0a2ef6cc4abcdc11d32ff5f23caeb6f8c2de55e319a565939543336f426688501b5',16,1,'mobile','[]',0,'2024-07-02 05:54:13','2024-07-02 05:54:13','2025-07-02 05:54:13'),('4ed31f0482175d835ca7ba6307ecf646c99674c036b9387731c55cb3cfb692e022057f873d66417e',1,1,'mobile','[]',0,'2022-02-20 13:53:01','2022-02-20 13:53:01','2023-02-20 13:53:01'),('4ed37c8342b67bc07c95bbba65710fa4babd8916371117652bf5def0188b8ec8aed00b2280bb1132',8,1,'mobile','[]',0,'2022-08-15 18:44:53','2022-08-15 18:44:53','2023-08-15 21:44:53'),('4ed95b22cb77aa6a578a1e111007da799c2ad016bac28a4b6e44f723590d6f48f825a0e572a72ae2',78,1,'mobile','[]',0,'2022-03-17 13:06:38','2022-03-17 13:06:38','2023-03-17 13:06:38'),('4ef86a2bfddb137e99267b1bbd5e3b0fe1609773b361fc8494d7efe137044ebb7865e98ddecd53da',1,1,'mobile','[]',1,'2022-02-27 06:51:23','2022-02-27 06:51:23','2023-02-27 06:51:23'),('4f25d12ab04e8523c67432ac18e6f6e7d975eedaddb9684d44c16594133ff16feb9af4ad1d3a5ac0',1,1,'mobile','[]',1,'2022-03-10 08:54:01','2022-03-10 08:54:01','2023-03-10 08:54:01'),('4f60dc82c19e07e9297c0178d9c558c6f8140ab235afaed013c3b81cacc6ea021f6ddafad22440b1',30,1,'mobile','[]',0,'2024-07-15 13:15:17','2024-07-15 13:15:17','2025-07-15 13:15:17'),('50191eabf0e8f09afca095423c9da85cc103bd5542e97310a278926c697e4f6ffa27ce43d6f729a3',8,1,'mobile','[]',0,'2023-06-22 06:45:09','2023-06-22 06:45:09','2024-06-22 09:45:09'),('50803d70894f3b787778c070800c9445b328700453ba7a914dc22e57e17532b3a8ddb71ea77df818',31,1,'mobile','[]',1,'2022-02-27 07:24:20','2022-02-27 07:24:20','2023-02-27 07:24:20'),('50c55b9c0f8c609754d152d6ab5b0f35330105a71e95ca7af9cdbcae7e55ae824c99b51de8441d2f',69,1,'mobile','[]',1,'2022-03-10 11:44:16','2022-03-10 11:44:16','2023-03-10 11:44:16'),('50e42c85e53208b68343773e8015ee882867c5886d719918ec923c356222f46e21cda5b9989328a5',28,1,'mobile','[]',0,'2022-06-30 16:58:08','2022-06-30 16:58:08','2023-06-30 16:58:08'),('510a046b7b5967d6a3336c438bc9451c764cdac384ac4f27a2050a6d517be100edd7f7abc6e29f0a',77,1,'mobile','[]',0,'2022-03-17 13:02:03','2022-03-17 13:02:03','2023-03-17 13:02:03'),('51135852e1731cb4a1096653ba5da557c80b96fa2d1c7d1aee3f5ed218fd8807b0b064742d42f001',1,1,'mobile','[]',0,'2022-02-24 14:06:20','2022-02-24 14:06:20','2023-02-24 14:06:20'),('51397aeafc4e0da9a84bc9fd69e57ef7e81937badd8668d0c7fd496fba6ab9b96d42c48a07065a71',43,1,'mobile','[]',0,'2024-07-03 14:47:54','2024-07-03 14:47:54','2025-07-03 14:47:54'),('517ac8508d77cbd2bd54b0a4684e0e62d9a3d61700dc950e70353c9c525dabd664f4f15b951b79c4',13,1,'mobile','[]',0,'2024-07-15 23:58:33','2024-07-15 23:58:33','2025-07-15 23:58:33'),('53a9155832ffd547d060aa77719bbeede2a562065d3605ff873263dc6107b6cbf925869b9d714d5a',3,1,'mobile','[]',1,'2022-03-24 08:38:57','2022-03-24 08:38:57','2023-03-24 08:38:57'),('54be8c19f0cce55be945e6d4eb24600e33f4c81a95490ab55a10c672cb5914cb2e0ed03d31ff4c15',36,1,'mobile','[]',0,'2022-02-28 13:02:08','2022-02-28 13:02:08','2023-02-28 13:02:08'),('54d2e39552715598b173fc10d8d02800fb927f6461937398a960b3304237fcb0a46fb4206b924d6f',4,1,'mobile','[]',0,'2022-07-24 07:21:57','2022-07-24 07:21:57','2023-07-24 10:21:57'),('54ed0562256e86609a0ba755bc4536881dc066505be3b242509e91983a5efe8d0f040c1cc51c4d27',1,1,'mobile','[]',1,'2022-03-10 09:20:59','2022-03-10 09:20:59','2023-03-10 09:20:59'),('55165804f7491915afd83c5d6c1ef556d816b8949b181c50b3c00a7ab62b64a54ad35f43528ed259',7,1,'mobile','[]',0,'2024-07-01 05:29:57','2024-07-01 05:29:57','2025-07-01 05:29:57'),('55753c8a1de71d20c6be15b2e9df73f11aadb90a811a135f1e7748fa94f1e61b5290a4b7e2cb7450',13,1,'mobile','[]',0,'2024-06-27 11:59:57','2024-06-27 11:59:57','2025-06-27 11:59:57'),('55910e10d3cde06a9c3dcf6c5ceea767d8f278f8a65748d97cc56ee342cfc09fc5cc0206e2320b73',3,1,'mobile','[]',0,'2022-04-19 15:22:40','2022-04-19 15:22:40','2023-04-19 15:22:40'),('55a3bd2e402fae8dfcb9d4522b31e9a615a664661fedd6636bf20ab270669090eb9ff0e9806aff58',40,1,'mobile','[]',1,'2022-03-09 11:06:53','2022-03-09 11:06:53','2023-03-09 11:06:53'),('5638bd7ccab7fa19bdc8712c5785053ad79bcc9a5eb09ae25a955d64ce004d6bb007b66ecc076323',27,1,'mobile','[]',1,'2022-06-30 15:49:47','2022-06-30 15:49:47','2023-06-30 15:49:47'),('56dc2d7cee7adf01155aaece6d5c995ce8919d32519a0de99e70ab3faa7dd4be7f21c65390c47a5f',13,1,'mobile','[]',1,'2024-06-27 09:25:08','2024-06-27 09:25:08','2025-06-27 09:25:08'),('56de7871e8ad0face44839837246ec397b1c102b39119c4bd09a9970561cdd08e5d9d914f18d50eb',21,1,'mobile','[]',0,'2022-06-25 11:13:28','2022-06-25 11:13:28','2023-06-25 11:13:28'),('5811b40a9ed09d1c56025327166a56beee41525cf49b4ca144a9a7a5a6863ead52cfeb5ae910c2c4',1,1,'mobile','[]',0,'2022-02-17 09:44:57','2022-02-17 09:44:57','2023-02-17 09:44:57'),('5827dc96e64fd964a5fddf8627d49cc5cc98bac49d7b25d2f8e0f962ebae9af6d08029a779135fd5',16,1,'mobile','[]',1,'2024-07-01 13:36:38','2024-07-01 13:36:38','2025-07-01 13:36:38'),('58e18806a68fbb04e0e968a53724686c86b462806f0132cf64e796c0b8f8a568da16287b40c7aa9c',36,1,'mobile','[]',0,'2022-02-28 13:10:21','2022-02-28 13:10:21','2023-02-28 13:10:21'),('59403ca0565978ce869c7f5ab8b54d3d8f0a2a9fc650415424eb330f7e965efc1cb84350a55fc776',21,1,'mobile','[]',0,'2022-06-27 08:40:31','2022-06-27 08:40:31','2023-06-27 08:40:31'),('59feed29d1bb1e5ba476c153f37ef295a842529e1bb006ef324242d598a6c63aab653f8d9aecd909',10,1,'mobile','[]',0,'2022-02-27 07:51:49','2022-02-27 07:51:49','2023-02-27 07:51:49'),('5a98ece8d9beb80b9c1fc5e7d572298edc0f3e75f739dbcf06aa0792453c40ba47ee0a34d2d20bb5',30,1,'mobile','[]',1,'2024-07-09 11:12:35','2024-07-09 11:12:35','2025-07-09 11:12:35'),('5a9adc23191c3b6bd7f847aab17cba379f71dd4b703f17ac94bccf24f1eb05a7506e495e23e6dc61',49,1,'mobile','[]',0,'2022-03-10 07:00:32','2022-03-10 07:00:32','2023-03-10 07:00:32'),('5b5916759e400d80b424a8188028c96effce69eb744953b6309130715429f222836b5270a32355dd',39,1,'mobile','[]',1,'2022-03-08 13:35:09','2022-03-08 13:35:09','2023-03-08 13:35:09'),('5b5f9098e817e937d4a174f0ffe0ef2a82d2a1859e23889ea52d848c7f62031626582274573883f6',6,1,'mobile','[]',0,'2023-09-10 03:39:45','2023-09-10 03:39:45','2024-09-10 06:39:45'),('5bc5a9f0f2084416ce06bbb38f0d2b6d2931197d7decf6b0d33a499c7b8771d3cfc6be44fcd91ac8',4,1,'mobile','[]',0,'2022-07-18 12:48:08','2022-07-18 12:48:08','2023-07-18 15:48:08'),('5cd9c89a5b19adeb71e0ef11bab19b38b70924d5748f2e3df0325bfde791703b6003568fe87797dc',70,1,'mobile','[]',1,'2022-03-20 10:28:10','2022-03-20 10:28:10','2023-03-20 10:28:10'),('5d4634758e0471fcdd3994589e0b5ab002702bca0725112a71d0b8460bcc679cda151fca328da0b2',4,1,'mobile','[]',1,'2022-08-10 07:27:33','2022-08-10 07:27:33','2023-08-10 10:27:33'),('5d65e6c82646a68b4b8d93ba3c1653461d2e17c547811d41f7059d1ab9bc3b14f6e9f3adfb838a3e',1,1,'mobile','[]',0,'2022-02-21 08:05:38','2022-02-21 08:05:38','2023-02-21 08:05:38'),('5db949b55a6d4758382294056dbc3213351b8e9715755c5c5501e27f1e7b067002d807397bfd9b80',25,1,'mobile','[]',0,'2022-06-30 11:18:09','2022-06-30 11:18:09','2023-06-30 11:18:09'),('5e500407df6a1daa42332abba649ee3c516eed72d9f345a482276e9efcf7785b60e3a2e8c9f5bf8e',7,1,'mobile','[]',0,'2024-07-01 06:30:27','2024-07-01 06:30:27','2025-07-01 06:30:27'),('5eb098d68e1c20027cddc3080d443258c0017e6671e1514a4a757768db45d08fad302dd425589c17',9,1,'mobile','[]',0,'2023-08-06 09:08:37','2023-08-06 09:08:37','2024-08-06 12:08:37'),('5ebae49257971da063c8643447a6269dc101ff57f8d3d3b4902f1ef014b881883a35f5e23808da41',7,1,'mobile','[]',0,'2024-07-01 05:30:32','2024-07-01 05:30:32','2025-07-01 05:30:32'),('5ec18f1739489607d7d8790db4f08b0b26f2010baa9f3d2a7180ccc93ff02e4d88a6d8127bcee375',70,1,'mobile','[]',0,'2024-07-04 10:22:43','2024-07-04 10:22:43','2025-07-04 10:22:43'),('5f69cdbed39279d6a61f09674fc12dc51c1139dacf3134cdf8523545450fbeeac88b2e40194fd05b',8,1,'mobile','[]',0,'2023-07-23 08:45:49','2023-07-23 08:45:49','2024-07-23 11:45:49'),('5f8dfbbd86f5e7a7bc0716c17f15b472bced3ef28cb09842893c4f5afe35ecc2badcdc4cb52d6305',6,1,'mobile','[]',0,'2023-06-22 07:37:03','2023-06-22 07:37:03','2024-06-22 10:37:03'),('5ffe079122b8540e68a9286e8a7b67a8ec662f4e9cbc83c9aea60abecbecab793f90d23300534872',36,1,'mobile','[]',0,'2024-07-03 13:29:35','2024-07-03 13:29:35','2025-07-03 13:29:35'),('60b3dfb958523469aa6b9934acfc2a4a58e937276a6a53d4111348636d1f1abf4151d6f1f54dd92b',15,1,'mobile','[]',0,'2022-06-22 15:05:20','2022-06-22 15:05:20','2023-06-22 15:05:20'),('613f1bbd879a8c44bed4d8b57a20b646dde3128c021fdd2f96541186f9769bca693780fc945a46a5',1,1,'mobile','[]',0,'2022-03-14 07:35:55','2022-03-14 07:35:55','2023-03-14 07:35:55'),('617a1e2930e274fff1690a94a4c982bcb57126c863624a52ea883de3f758d0b03d8e48c478531a72',6,1,'mobile','[]',1,'2022-03-24 09:19:42','2022-03-24 09:19:42','2023-03-24 09:19:42'),('61ae6ff919b4a6c4bdf2be687b06b4aacea6e2869cb5f866207224612c7e0cdaa3374d61b4920e36',13,1,'mobile','[]',0,'2024-07-14 11:23:23','2024-07-14 11:23:23','2025-07-14 11:23:23'),('61c1de6fac35d11162f720f22f60fa8d2b4e598a3da539a82fd2c1b7c88919ebaed2c9b76a4248e8',46,1,'mobile','[]',0,'2022-03-09 12:59:08','2022-03-09 12:59:08','2023-03-09 12:59:08'),('61c9383f368ee40e8809113c216d00f9da01178691721c5b34a16d9fedf6fb6fbfe1737e2e9359a3',1,1,'mobile','[]',0,'2022-04-13 15:03:34','2022-04-13 15:03:34','2023-04-13 15:03:34'),('61f0c73877a1c621c69a706ac0b62583a451674988fff649a841e4b5279bdeb5a8cdf8a0dd7aadda',49,1,'mobile','[]',1,'2022-03-10 07:00:33','2022-03-10 07:00:33','2023-03-10 07:00:33'),('62294b4455774a4113a785cd625b303e0009a6e792464c8aabf1344cfc6f332ac0cf5583d1a1b9ef',8,1,'mobile','[]',0,'2022-03-24 10:54:47','2022-03-24 10:54:47','2023-03-24 10:54:47'),('62e2dcfd60f2f76bad53382a32d9f5a3af24e35d707f87eec4f52f8eb9bd5fdb62227ec321f054bc',12,1,'mobile','[]',0,'2024-06-05 12:43:10','2024-06-05 12:43:10','2025-06-05 12:43:10'),('62fc4e1e6411b9fd292eaea5ab15979af3782ebdc74f617b7d0e277494220d4c24108be745590883',67,1,'mobile','[]',0,'2022-03-10 11:36:43','2022-03-10 11:36:43','2023-03-10 11:36:43'),('62ff5f3309364930646bde9b41c44e49a748b5671d8a3683e4f13ab47a77eae818c557d22f82dfb3',3,1,'mobile','[]',0,'2023-07-24 14:59:05','2023-07-24 14:59:05','2024-07-24 17:59:05'),('638a7427ba17282bc2510234e240208f260108d7a58fe567b0da380dbc8c704c797c92c627864627',4,1,'mobile','[]',0,'2023-02-14 10:25:06','2023-02-14 10:25:06','2024-02-14 10:25:06'),('6426e6527c484c3b16d3d218a78dacfeaebecbce3d1469ded86638cdc90448863dcc77ecdb773d6f',3,1,'mobile','[]',1,'2022-03-24 10:24:49','2022-03-24 10:24:49','2023-03-24 10:24:49'),('644f3fd0a99cdf9938fd704e5fac53c2f9aa01d51af13f528cb71657f930953bed066cd86f6f5acc',4,1,'mobile','[]',0,'2022-07-19 05:54:29','2022-07-19 05:54:29','2023-07-19 08:54:29'),('647b7a8a9aeef9c004622848315d9cc8705517fc77353ab1db5fdc705ba71bc5c6e91caea8d98db7',3,1,'mobile','[]',1,'2022-03-24 08:28:24','2022-03-24 08:28:24','2023-03-24 08:28:24'),('653d2c8854e013689041692ad06e35d0d967b1a6b0717601c2fae258d5bdcf4ddbf30f705981d8d6',14,1,'mobile','[]',1,'2022-06-27 10:12:21','2022-06-27 10:12:21','2023-06-27 10:12:21'),('6545675ce16fc75b080170478113336d4a4f794185dcfc2b330ab2ceb200a005c09501fff554d4ae',2,1,'mobile','[]',0,'2022-03-24 10:25:15','2022-03-24 10:25:15','2023-03-24 10:25:15'),('65cbe3ee8c37a3199e43f60ec0ccb2df3b9ddba31df0fa7e128b2ace46ff9ad95e9d6cb862b7c64e',36,1,'mobile','[]',0,'2022-02-27 12:50:18','2022-02-27 12:50:18','2023-02-27 12:50:18'),('65df70498c373dc42d18e88767854f1822e040caed616eab68dd780b3852462f466521f98ed8e260',14,1,'mobile','[]',0,'2022-06-22 14:53:21','2022-06-22 14:53:21','2023-06-22 14:53:21'),('65f329ae69a0f58388b7fdf77c6639ebb63ae6470e86af4fd660e5a659bc377a145b59b81987c2e8',2,1,'mobile','[]',1,'2022-10-09 11:41:53','2022-10-09 11:41:53','2023-10-09 14:41:53'),('6604393e717082e17e8c92d2716da00aefbb0d2aacbd5b82df5f4887ca0271f520344608ee6fc43b',30,1,'mobile','[]',1,'2024-07-04 14:18:25','2024-07-04 14:18:25','2025-07-04 14:18:25'),('663e422a890fdc5a11ad2f04b68bf216e85302fb4655e10e895ab52a5f4fdb507b717a86ffaf5410',29,1,'mobile','[]',1,'2024-07-02 14:19:09','2024-07-02 14:19:09','2025-07-02 14:19:09'),('665354ae37deb224d637fa0d32daa24114da89394ffd82aa7b619baa4b434f7bd11b8f05d38c4932',50,1,'mobile','[]',1,'2022-03-10 07:00:29','2022-03-10 07:00:29','2023-03-10 07:00:29'),('666541640a173c9b21b98e574a3e8266401504b6798e856f8b4580e16b643547bae3a116585effef',36,1,'mobile','[]',0,'2022-02-27 10:17:49','2022-02-27 10:17:49','2023-02-27 10:17:49'),('666c63a0bcec41e979f8e74ffa9fbf58e8938e26b8d5bbdb16c5b21adefbaf68554c7e4ee98faf7e',13,1,'mobile','[]',0,'2024-07-16 13:56:10','2024-07-16 13:56:10','2025-07-16 13:56:10'),('666d03f0d3523b6d1d1ebc32907a8b9260c9cea011894c3b8c1d59d27a102778e4e191b66e6eb404',15,1,'mobile','[]',0,'2022-06-23 13:02:48','2022-06-23 13:02:48','2023-06-23 13:02:48'),('66b310fff2c0d802114fc4bbe9200d0306d7d3464db5df94a7f8ad928385dfb138aa25a6eccae97e',73,1,'mobile','[]',0,'2022-03-17 07:40:26','2022-03-17 07:40:26','2023-03-17 07:40:26'),('6767484318ea62cc9fe537a35e71038d46ea7d432d6bec1754656da86e541fee09d85f97a7e489ed',23,1,'mobile','[]',0,'2022-06-27 09:13:12','2022-06-27 09:13:12','2023-06-27 09:13:12'),('67a4f9ff78e59e88730f74947ae0b45ebe0d19ca7f2f53744bdcd0132ecb9ea3c94090ff7ab3f7dd',12,1,'mobile','[]',0,'2024-06-09 08:12:56','2024-06-09 08:12:56','2025-06-09 08:12:56'),('683d816ddabdb609e2ae1a2fb26b3535dbc08b5000957f7f03525d212cdd5dd5de7e57f9058da461',3,1,'mobile','[]',0,'2022-06-19 15:04:25','2022-06-19 15:04:25','2023-06-19 15:04:25'),('68753847e629a7d0836ae3dc72376185e36ea8438c33cca2fe4b444196405c3723c79fce5000bc70',9,1,'mobile','[]',0,'2023-08-08 10:53:43','2023-08-08 10:53:43','2024-08-08 13:53:43'),('6890592c079b1e9365734f4f5953d34ff5906bd6f754c333a8b2bc6e29e3f4d82f9f609d3f52359e',51,1,'mobile','[]',0,'2024-07-04 06:28:55','2024-07-04 06:28:55','2025-07-04 06:28:55'),('68dc7f77905b0a0d3b114d7a82489bc3bca33cd4d5212567c9c2ef2aec299c6bd7d90beb903feced',4,1,'mobile','[]',0,'2022-07-26 10:42:22','2022-07-26 10:42:22','2023-07-26 13:42:22'),('6929658bebf2eec08313162d98395b1ef7b85cad9aa659a39bc6bae540ad44eca9386a7c1a9ec39f',1,1,'mobile','[]',0,'2022-10-02 10:11:10','2022-10-02 10:11:10','2023-10-02 13:11:10'),('69404701f21432dd3bd007d38a4af62953118087755b83fa3a3eb55296f6c6654ce47fb7ee0d4e81',9,1,'mobile','[]',0,'2022-02-22 13:02:28','2022-02-22 13:02:28','2023-02-22 13:02:28'),('6a2dc56d1d13f10d0ca7825686cff0faef3a297b624cfb007518ba06c3fbc6e651e409f8a140d8df',2,1,'mobile','[]',0,'2022-10-09 10:32:24','2022-10-09 10:32:24','2023-10-09 13:32:24'),('6a99bdbbae17c98c9051ef500389e4c99ccafe520a1b64fecf330066f2dfd7a9be396325d84f4c09',1,1,'mobile','[]',1,'2022-03-10 11:29:54','2022-03-10 11:29:54','2023-03-10 11:29:54'),('6ae27bc60928127455e4d783b3947bb75cfe4add4fdf1f52f339127606ae0637f9e7532077fdc7b8',7,1,'mobile','[]',0,'2023-06-22 06:41:02','2023-06-22 06:41:02','2024-06-22 09:41:02'),('6aee550bd04f5ae1f0d30b084735a4cb7d5ec496cd817d2a3a30b101636f7ec1c5afa24e3e507981',70,1,'mobile','[]',1,'2022-03-17 06:59:42','2022-03-17 06:59:42','2023-03-17 06:59:42'),('6af8731b8bd0f278db081d7a25f96536eae5d79a0ac4f2db91293cb47e517597facd04e760b1e7b4',1,1,'mobile','[]',0,'2022-02-27 07:38:49','2022-02-27 07:38:49','2023-02-27 07:38:49'),('6b0b3d16b3017f8fa56a263d47ee3fa87755603db277b624aef143d4ef395ab8e46d8ef85f05af42',6,1,'mobile','[]',0,'2022-08-11 08:03:43','2022-08-11 08:03:43','2023-08-11 11:03:43'),('6b2b52475ce3b954cc110b1b30ab9aeed5ceec75d0bda9eeafcb10b348232af9d0abead893695d21',2,1,'mobile','[]',0,'2022-10-09 10:23:54','2022-10-09 10:23:54','2023-10-09 13:23:54'),('6bad3904fd66313ed43e34d3cf646897eb417394763c1951d71390c03733d76dbd63693ae6321395',48,1,'mobile','[]',0,'2022-03-09 13:15:01','2022-03-09 13:15:01','2023-03-09 13:15:01'),('6bcb3fdb5119bb3938baeeca926c868f08142b26b0a1d0d9361e0ca950e88bef38333e62d2ffa929',13,1,'mobile','[]',0,'2024-07-11 13:34:53','2024-07-11 13:34:53','2025-07-11 13:34:53'),('6c53e9800810cfeef9140338a707b129d35fe561588ad5a2576d875f216f72216550aaae8601103e',58,1,'mobile','[]',1,'2022-03-10 08:53:48','2022-03-10 08:53:48','2023-03-10 08:53:48'),('6c79c4a3ac5a1b9e954ec4886b10a2fb0dcbae50d42a1414c92d26186e3d2a94e70ccde8721b39c9',2,1,'mobile','[]',1,'2022-10-13 06:58:20','2022-10-13 06:58:20','2023-10-13 09:58:20'),('6cbecde29360dacfb689099eb904ce6230bc2478af1d0340f8bc9d8e1872622a7a0aaa3d71a6a916',14,1,'mobile','[]',0,'2022-06-25 12:45:12','2022-06-25 12:45:12','2023-06-25 12:45:12'),('6ce1b0ff3db2563ceb72ee828812082daedae7956d9d19dbcc58ed79e9a6c8d55188301d7249b8b5',52,1,'mobile','[]',0,'2024-07-04 06:32:04','2024-07-04 06:32:04','2025-07-04 06:32:04'),('6ce4c6964dfcf53a4ae2cce19c35c85164b963346ac710ab33c35390cc31c9df715b5d60e2a5d319',73,1,'mobile','[]',1,'2024-07-11 07:06:10','2024-07-11 07:06:10','2025-07-11 07:06:10'),('6cf45c29536fcba12bc7522b3459e2827c10835779d219f786b9f0eaa94ac66e4952772aa89a6c3d',42,1,'mobile','[]',0,'2022-03-09 11:21:44','2022-03-09 11:21:44','2023-03-09 11:21:44'),('6d9050931c4aeb6fed17f7c37216bb7cc3f2d9f1eea50a43f7d14dd8bdb7dc4d87d9928e867c9728',2,1,'mobile','[]',0,'2022-04-20 11:05:05','2022-04-20 11:05:05','2023-04-20 11:05:05'),('6e68c5bded46e16bd80751d8639eb20f6fdf82ea645bbe20a3331279e76159c4108eacfdf72cd568',1,1,'mobile','[]',0,'2022-04-19 16:51:12','2022-04-19 16:51:12','2023-04-19 16:51:12'),('6e6c41db4027f4cbd62a08242ea8c0b13babaf502232c4b22dffe63e8aea4c3159dbd6a3977a88ef',63,1,'mobile','[]',1,'2022-03-10 11:08:08','2022-03-10 11:08:08','2023-03-10 11:08:08'),('6f278d2d8e86b1047e0bfd2b2858e7b8dc00c3ff791048be8a37a0821a52bb24033da0b14c6d0f90',10,1,'mobile','[]',0,'2022-02-27 07:22:19','2022-02-27 07:22:19','2023-02-27 07:22:19'),('6f532ec3fbb199658af6c9407e35f9d7cc67e3d147066990d7f939996f5e0199407579d60a84aaf7',1,1,'mobile','[]',1,'2022-03-10 06:55:00','2022-03-10 06:55:00','2023-03-10 06:55:00'),('6f7dfd2e01a73222134875f0d50fc8230a3849c6a95e8dd94b6772aecaf079f5052389732befd144',1,1,'mobile','[]',0,'2022-02-17 10:21:30','2022-02-17 10:21:30','2023-02-17 10:21:30'),('7018535ed1a51dd67bd700acdcc079f191d615002b44df43a78e5b711a770649a217667cd364ea0a',50,1,'mobile','[]',1,'2022-03-10 10:03:05','2022-03-10 10:03:05','2023-03-10 10:03:05'),('708482bcff3864bb10447569de035fa0954acd5aeef5d1acf90aad512ad7dcec3b238893fb17703b',22,1,'mobile','[]',0,'2022-06-25 12:37:34','2022-06-25 12:37:34','2023-06-25 12:37:34'),('71c0847a2c33aa43e3ff3aa769421d87da86267be375d2581950a66f9fa08a15dbba3e04680a7e50',14,1,'mobile','[]',0,'2022-06-27 09:31:29','2022-06-27 09:31:29','2023-06-27 09:31:29'),('71f55b72aedbf59dbf2dee02cfb00dd34a11a48561fb08a953b533afc000aa46e99df844dbb3a7c2',4,1,'mobile','[]',0,'2022-07-26 10:46:49','2022-07-26 10:46:49','2023-07-26 13:46:49'),('71fde6919de945fd6ae4576a2e1f8451ebe4a9a2f553297eaf98d39ffa1db3302c4d3e7c269a09be',16,1,'mobile','[]',0,'2024-06-30 06:32:00','2024-06-30 06:32:00','2025-06-30 06:32:00'),('7212aa7991f4f95630ef0a2511a1f1f135e5b649eab41ef8692b2a5b3ef879535d2959b552a97d72',7,1,'mobile','[]',0,'2024-07-01 07:32:00','2024-07-01 07:32:00','2025-07-01 07:32:00'),('721cf8af408a8d14aa17a964079a7270860f2829968dc47239c7f372d6ad67a6c88d5c78d7ba2827',30,1,'mobile','[]',1,'2024-07-11 10:51:23','2024-07-11 10:51:23','2025-07-11 10:51:23'),('7290c023602b78adadb3b14349a4c5ed3613b083e01168aa7d122a19615e0748845a52dce3f0ad54',6,1,'mobile','[]',0,'2022-10-09 10:31:05','2022-10-09 10:31:05','2023-10-09 13:31:05'),('730d357be5495b527ed9711e3c13e17eea859b3085e820b7937f7d157b4c8a4f131b0e9496067590',65,1,'mobile','[]',1,'2022-03-10 11:11:48','2022-03-10 11:11:48','2023-03-10 11:11:48'),('7346edab86435a9ec014b94cfb4f4818ab75119bbedf1aee92521349eb7a77d687044bdafbdd0004',5,1,'mobile','[]',1,'2022-03-24 09:07:30','2022-03-24 09:07:30','2023-03-24 09:07:30'),('73f19fa89ba3c2c103b5a6b32b11b0fab47be5f09efe3fa274640107a4193d77ee64a76c3df0f4e5',16,1,'mobile','[]',0,'2024-06-30 11:06:45','2024-06-30 11:06:45','2025-06-30 11:06:45'),('74276bdc8b8354519bd3accca16b48640186fe6c78e9e0db9be787b189de3970ba8694764f54a606',7,1,'mobile','[]',0,'2024-07-01 05:34:00','2024-07-01 05:34:00','2025-07-01 05:34:00'),('7460308724b5f09d1eff75fdad0edd31d23c9bd0ce48fddd5dc52f79b2646d19840dff44ef181a7d',4,1,'mobile','[]',0,'2022-03-24 10:10:25','2022-03-24 10:10:25','2023-03-24 10:10:25'),('7492771818537cd6da2f875a48e3db7b91117b35e02fa3edce2a6bf935bd1760de961f1d2031a694',2,1,'mobile','[]',0,'2022-02-16 09:57:44','2022-02-16 09:57:44','2023-02-16 09:57:44'),('74cd4bbe24ef5044ca1854a46120db3d1053ae3887592192b40b203156b034c5f684a370b71d2e75',5,1,'mobile','[]',0,'2022-10-09 10:30:10','2022-10-09 10:30:10','2023-10-09 13:30:10'),('74fbee8a713c5129d0ca8ecaa7feed95bfe208b57c14b2ff3950d94b23661f33e313acb3ade83c19',70,1,'mobile','[]',0,'2022-03-14 12:27:32','2022-03-14 12:27:32','2023-03-14 12:27:32'),('74fcffb66f9f247d73421233d237e183df7cc9a279c02c5d264eb04d28342495917f8b10ffebbf44',20,1,'mobile','[]',0,'2024-07-01 12:48:51','2024-07-01 12:48:51','2025-07-01 12:48:51'),('755671bec1cbb46d5091ed52d7bba3ee064284937fcaa8f8852600137376ab2703d7cf77e1093b65',57,1,'mobile','[]',1,'2022-03-10 09:19:38','2022-03-10 09:19:38','2023-03-10 09:19:38'),('75b5dbf0e65e5bb2f496e681c1b8c4816b13ce3dde3d40ae0bb5144e70ca37495342bf7974559482',10,1,'mobile','[]',0,'2022-02-27 07:23:12','2022-02-27 07:23:12','2023-02-27 07:23:12'),('76056a6b629224885a6d225a4c4cb9a80e3c7e5d52837540dec595bfbdb8594dc6c7f7e2bc9fda20',9,1,'mobile','[]',0,'2023-08-07 04:39:15','2023-08-07 04:39:15','2024-08-07 07:39:15'),('7631faa72475d355a04563f589c874738b1bf422c04338ffbc57abb677fc69d8a05be76ad857483b',1,1,'mobile','[]',1,'2022-03-07 07:49:14','2022-03-07 07:49:14','2023-03-07 07:49:14'),('7757894930b3d8e9b02c4bdbd1741acad71699c6c1515a955e7a94ede7130bc9669077beb23179ff',1,1,'mobile','[]',0,'2022-02-17 10:27:09','2022-02-17 10:27:09','2023-02-17 10:27:09'),('77e31b5f86f923354ad6b3c92c6437d96756beeb982bf40d8e9a881aaa9c86fa98262b03dea9d5e7',64,1,'mobile','[]',0,'2024-07-04 09:17:36','2024-07-04 09:17:36','2025-07-04 09:17:36'),('7822c299a3ba7f86852fd0adb3ee2203f4e254239e5051f53984c5ed0b5e4f66958e7d573ed594c0',9,1,'mobile','[]',0,'2022-02-22 13:06:53','2022-02-22 13:06:53','2023-02-22 13:06:53'),('783477540c365ffce10eb8029f6c042023fda20e9d05a3dbf329023e852b60792883f94dd4cfc7ba',1,1,'mobile','[]',0,'2022-03-15 11:40:42','2022-03-15 11:40:42','2023-03-15 11:40:42'),('78e39b366a54e7e94c01d3a3ca6da6d183b1a6400441a62946aef6901b8daaf71b13ccd4ec0753c8',16,1,'mobile','[]',1,'2024-07-01 13:54:53','2024-07-01 13:54:53','2025-07-01 13:54:53'),('7991de4e9a70f2d2915165b003a7eda694079b6d6a7dc43a78c045689ed89e1beac6b2166bc40d39',16,1,'mobile','[]',1,'2024-07-01 13:18:20','2024-07-01 13:18:20','2025-07-01 13:18:20'),('79c6b806c1d7695c7c0fdfa4b4c63bf8cea0f2655354050f0f2b74765a578faa694ec0bc50ed5468',4,1,'mobile','[]',0,'2022-02-17 10:08:25','2022-02-17 10:08:25','2023-02-17 10:08:25'),('79e79750079bb60bf3f48fcd19bca2cbfe116c4caca88ac0c5f49ac3e5a4a5b0e930dccf9ca765ab',73,1,'mobile','[]',0,'2024-07-08 10:38:48','2024-07-08 10:38:48','2025-07-08 10:38:48'),('7a1ff4b6e09158d75530325c94cf09b59ba0703448d78a5b2fe80d69083d5254bc14ba83785bf30e',7,1,'mobile','[]',0,'2022-05-10 11:44:14','2022-05-10 11:44:14','2023-05-10 11:44:14'),('7a2bf88fe326270692cb4fd84f82ced663c7ecdb38dc54e200cf0f02612a893f349b20fab5d4fd44',23,1,'mobile','[]',0,'2022-02-22 13:15:50','2022-02-22 13:15:50','2023-02-22 13:15:50'),('7a37295f80181dfc937d57493033c40f100e12dbd6c815f00adf89022b1ac40be09247e2333f5465',46,1,'mobile','[]',0,'2022-03-09 12:08:30','2022-03-09 12:08:30','2023-03-09 12:08:30'),('7a3fa95d28a950d2bb57b9e71e2cbdbb666837e38aeefd617414e9901ffa9afcd65e25c5d3152cd0',8,1,'mobile','[]',0,'2023-09-11 04:41:24','2023-09-11 04:41:24','2024-09-11 07:41:24'),('7a579db62cea5dfbbd4f7b7f37ca6425a2fdb430d658159d4de75783d03447847108c56b4726edb9',44,1,'mobile','[]',0,'2022-03-09 12:03:12','2022-03-09 12:03:12','2023-03-09 12:03:12'),('7acb152c26c1a942bac0476356d48f5b828b24c154c238eabae29b54eccd7649a11bfb9623136945',27,1,'mobile','[]',0,'2022-02-23 09:22:58','2022-02-23 09:22:58','2023-02-23 09:22:58'),('7b173665aeed25e4019eb995d0f2694989b291c273a9bf94535713e09ce564c32bfeb1da768f9f1a',6,1,'mobile','[]',0,'2022-08-11 07:06:16','2022-08-11 07:06:16','2023-08-11 10:06:16'),('7bac18385d0ac13d3523884deb684cb4136e47d7c0979708b0e6448ca3438759dc4a2c7097335b48',1,1,'mobile','[]',0,'2022-02-17 10:13:42','2022-02-17 10:13:42','2023-02-17 10:13:42'),('7bcd2d0cd41c1d6e1f99e9fd466f8e898c0358ae9f4bffec7906fd7186dec84c39de1702bb4e6686',16,1,'mobile','[]',1,'2024-07-01 13:25:48','2024-07-01 13:25:48','2025-07-01 13:25:48'),('7c3a416da49e462742c83f814f79a99204cd931d68b71824f490aede49f65732b7d67945e3f5958b',16,1,'mobile','[]',0,'2024-06-30 11:31:08','2024-06-30 11:31:08','2025-06-30 11:31:08'),('7c3de3040f7aef9f600f4516350ddfb0dbb04f1423230f7ce35c0a438c4d4db6a71136c2bf895297',1,1,'mobile','[]',0,'2022-12-04 08:29:11','2022-12-04 08:29:11','2023-12-04 10:29:11'),('7cd854e195caf06d25bd2ac107fbe4e05e2737769a9f701a0bf3be79d69d945db5233546b40b491a',6,1,'mobile','[]',0,'2023-09-14 09:32:01','2023-09-14 09:32:01','2024-09-14 12:32:01'),('7d06a30585e21fb8d90b68b15b446a74fa927c6d0a39a7d21aa0eb5ade95dfaf57b6cf4ea52fd5f3',1,1,'mobile','[]',0,'2022-03-24 07:50:49','2022-03-24 07:50:49','2023-03-24 07:50:49'),('7d95c530f0e610b90a9618c386ad43e72725b5b95d885a4a398f1c071ba33f8fe5f4daf4d6dc89f0',29,1,'mobile','[]',1,'2024-07-02 14:15:04','2024-07-02 14:15:04','2025-07-02 14:15:04'),('7e1a94df2839b2bbfbbcf1ae7f524ebf755cecff5acd09da11749648a301729938fc002d1f3ac959',13,1,'mobile','[]',0,'2024-06-27 11:40:53','2024-06-27 11:40:53','2025-06-27 11:40:53'),('7e5da0ff6ed91da2e287a810922213a1fef9a0194ef747d457ff190c40cfe6ed950f5dd675cdd0bf',2,1,'mobile','[]',0,'2022-04-27 12:28:55','2022-04-27 12:28:55','2023-04-27 12:28:55'),('7e8fb2be4a41fa21dba09a960e124570e8f083a813fe44b55db42f0ac6fc22ae04cc0f105b186847',9,1,'mobile','[]',0,'2023-07-28 10:54:58','2023-07-28 10:54:58','2024-07-28 13:54:58'),('7f38fba9cc13fd5b2e624bdc190a572fd54af4fa5627959e75c3a1fac22a9ba448767797bc0eda6f',15,1,'mobile','[]',0,'2022-06-15 09:19:26','2022-06-15 09:19:26','2023-06-15 09:19:26'),('7fc9d6e446005657ae3ae1c402ab07f25fded79af49ad8be008fbca22f7a50a7229ef66149d3da31',20,1,'mobile','[]',0,'2022-02-21 12:08:15','2022-02-21 12:08:15','2023-02-21 12:08:15'),('7fd7af84c81595c3fa14666a294880094e9f2674dc753430902e5495f3f64a646330b77dd660a867',4,1,'mobile','[]',0,'2022-07-18 11:42:39','2022-07-18 11:42:39','2023-07-18 14:42:39'),('7fd9a6321f13b2158786eaef313afac5fe3ca2223ca1e3efbc2b1ce8a58fd40458632a6dd248b7ae',3,1,'mobile','[]',1,'2022-03-24 08:11:32','2022-03-24 08:11:32','2023-03-24 08:11:32'),('80058b17e6cf3a540cfadc23d5fae90bf704f82eef4904e17ed3e064fb29aa471b112e72293047e2',1,1,'mobile','[]',0,'2022-02-21 06:57:23','2022-02-21 06:57:23','2023-02-21 06:57:23'),('800a3dc675e89f8da2c27d18f9164d0b534fd0533b0ba5b7507c00508e96f48b4370ba4f18ce86e9',1,1,'mobile','[]',0,'2022-02-17 09:44:11','2022-02-17 09:44:11','2023-02-17 09:44:11'),('80895b855318060d494609bc8c55715ab477bc1ea822cd3b8c52df34a529461cb4060cf9a04acebd',7,1,'mobile','[]',0,'2024-07-01 06:05:32','2024-07-01 06:05:32','2025-07-01 06:05:32'),('80a46241bae60bef8ed6142cd9fb83001bfa222ae2a9cb6e7f42693bfedf22aeab9a312e6733318a',16,1,'mobile','[]',1,'2024-06-30 12:35:24','2024-06-30 12:35:24','2025-06-30 12:35:24'),('80bcc30386724a3057194a77eb2cc010956b0ec3ca11d49e134edc0ec4418decaee771f00fe23eb7',1,1,'mobile','[]',0,'2022-02-20 11:38:46','2022-02-20 11:38:46','2023-02-20 11:38:46'),('80c65a128caec2852e6d54f2f2db167a520e08c69172a099eb265f0c3358eed557c7b2155d0ddae4',72,1,'mobile','[]',0,'2024-07-04 15:50:37','2024-07-04 15:50:37','2025-07-04 15:50:37'),('81285c20aa645112803323ebe8446fada17a6ddc4ee4dc8f61ca8f083e6a2c4fb048aed17c62a191',24,1,'mobile','[]',0,'2022-02-22 13:17:05','2022-02-22 13:17:05','2023-02-22 13:17:05'),('812dfe4c83ea2857589c99a4922e1859f59211567898c2ff6205d31461c55f0262e389cbf4e9238a',1,1,'mobile','[]',0,'2022-03-02 13:35:32','2022-03-02 13:35:32','2023-03-02 13:35:32'),('81a4a7bd270e3d718b3f678819dfcfa9071111ef8c7e8a46c9ccfdba7526b3be555fc71412e5b742',24,1,'mobile','[]',0,'2022-06-27 09:37:32','2022-06-27 09:37:32','2023-06-27 09:37:32'),('81eaa04bddc15d9e3b5f3752d82757119f8ac8db96dfde26eb71ad74bbea22bdbba1634a3f9eaaf3',1,1,'mobile','[]',0,'2022-04-13 12:22:21','2022-04-13 12:22:21','2023-04-13 12:22:21'),('822408aaac299e15d1fddcd4921ad5a9ac5e234921687542d0a7a5ad26e3c93bd65422c051fcc1b6',44,1,'mobile','[]',0,'2022-03-09 11:43:59','2022-03-09 11:43:59','2023-03-09 11:43:59'),('8245efc5dc20c7234e0ac8dda11a0cef6b04aaebd2dc73ff51a6f29388de520b34d23c5b0d2ebadb',3,1,'mobile','[]',0,'2022-06-19 15:35:34','2022-06-19 15:35:34','2023-06-19 15:35:34'),('8259882522c6a2749dca5f316d56f9247ea47906aca5f05697cd722e8adbad788d70c17f77ae633e',7,1,'mobile','[]',1,'2022-03-24 10:41:23','2022-03-24 10:41:23','2023-03-24 10:41:23'),('829ad431a01c6759b705f8c459ba700ce535166211dd132ddf6d7b370bdd2ab214f0a4569f6955a9',10,1,'mobile','[]',0,'2022-08-24 08:48:01','2022-08-24 08:48:01','2023-08-24 11:48:01'),('82d62888d22db6a4dfd7ab9bd8e092a60df3865ccc16d63d54439b2f8b2c36c33d0ecf3e0fdc0649',7,1,'mobile','[]',0,'2024-07-01 06:28:19','2024-07-01 06:28:19','2025-07-01 06:28:19'),('83181675156f690bb659aa10a8e9f99d18fb332b492ef2cbf59a9a71bb4af4d49158183b847404f4',30,1,'mobile','[]',1,'2024-07-10 09:51:49','2024-07-10 09:51:49','2025-07-10 09:51:49'),('83184fef98a9f3d5442bbc84395263c438fc1d7bb2a55ffdcf1e7b4a2bd97a7a9c781e6bd58d2cb0',4,1,'mobile','[]',0,'2022-07-24 08:56:14','2022-07-24 08:56:14','2023-07-24 11:56:14'),('831b0c6da0343aba27cf1016a930a8a6bccd05a7426f5e0cc358472e53b76dac491333689f6f8fe3',15,1,'mobile','[]',0,'2024-06-27 12:24:42','2024-06-27 12:24:42','2025-06-27 12:24:42'),('839390ea9397084eaba0e2ebcd295263758c653d76a87fad1f53f196a5e588d00f5594890df02d08',2,1,'mobile','[]',0,'2022-10-09 10:37:05','2022-10-09 10:37:05','2023-10-09 13:37:05'),('8395147d2e7b38a1fe19f3c1b6f29c95cbbf922e579da9dcbda0ad6afbd13b263146a7ef59fca5a4',78,1,'mobile','[]',0,'2022-03-17 13:06:22','2022-03-17 13:06:22','2023-03-17 13:06:22'),('83ba784374effd2155aba2184c7936b510eb38b21441edda51323a87560cb06b4099e599cf26adaf',1,1,'mobile','[]',1,'2022-02-14 10:39:02','2022-02-14 10:39:02','2023-02-14 12:39:02'),('84080174688f908baf11e3633df1bac46d1fc3ba1df7bc930921764802267b1e6538212fa0f5009a',26,1,'mobile','[]',0,'2024-07-02 09:10:49','2024-07-02 09:10:49','2025-07-02 09:10:49'),('849385c8d9bfe0e8009ca5d57ae4809c5b5b4858d13ed60726103252f3cccce5a54d04ff8877495f',1,1,'mobile','[]',0,'2022-03-15 11:41:28','2022-03-15 11:41:28','2023-03-15 11:41:28'),('84a1bce62eb647b25ab7de243fd379ccd45b0dfb3c66537ddea6aca9389e88b43862a772d0fc098d',7,1,'mobile','[]',1,'2022-10-23 07:36:37','2022-10-23 07:36:37','2023-10-23 10:36:37'),('84a831f4878c2754861a59a584d27ff3b09846d79c3fdb28d40a6bbb1e0e7525ae8df2f98bc6c36c',48,1,'mobile','[]',0,'2024-07-03 15:25:31','2024-07-03 15:25:31','2025-07-03 15:25:31'),('84ba1ad5701b2724b39f390fc7632ecabf788f2bddde8e94ae6a1f79296aa200158c77b15b4d5fe1',49,1,'mobile','[]',0,'2022-03-10 07:03:33','2022-03-10 07:03:33','2023-03-10 07:03:33'),('84e2b9e3933beb07cea695fb67ecd514b524684b0ecbf08fa4ffc7c4ab68bb33667701764efe3bbb',50,1,'mobile','[]',0,'2022-03-10 08:05:04','2022-03-10 08:05:04','2023-03-10 08:05:04'),('852a9f4f55ed4059f135b5fd9d3160325e80e6131c2ba9c98444491d79927d844e96583e6ecff1d8',6,1,'mobile','[]',0,'2022-08-09 14:06:29','2022-08-09 14:06:29','2023-08-09 17:06:29'),('85d9bae57fa2a9841de5a466fab1aad5e929ec1fc1b6cfd643c1c4b39b368fcd439f3e6ba3a70453',11,1,'mobile','[]',1,'2022-03-24 13:12:43','2022-03-24 13:12:43','2023-03-24 13:12:43'),('861a45d21c1385b222ea11b6314fe292cfc2bbbaebfdfa347da8bf398f141fab33568cca8e06a1db',50,1,'mobile','[]',1,'2022-03-10 08:26:49','2022-03-10 08:26:49','2023-03-10 08:26:49'),('86271fb600866c704e245831c6e5c7997de68ecd12fccc8d4bf663c213f94635c6f33ed49a150c3b',70,1,'mobile','[]',0,'2022-03-14 12:08:20','2022-03-14 12:08:20','2023-03-14 12:08:20'),('868063cff6f2e0cb53c471f1aeb44ba7c53f2f81ae6087c493f1cd639e6b73f76aba791d651db364',14,1,'mobile','[]',0,'2022-06-27 10:32:13','2022-06-27 10:32:13','2023-06-27 10:32:13'),('8681ded8cc7f6b90df49618708c25be7ebba2e93b0b21c6c5ac3fdb46a310a9765b930686b8d94ab',64,1,'mobile','[]',1,'2022-03-10 11:23:32','2022-03-10 11:23:32','2023-03-10 11:23:32'),('869f6c37e0192274ea75c59de5a6857c202027d3335984337877058c05dd922c0e16aee6b53fe08f',1,1,'mobile','[]',0,'2022-02-20 11:48:01','2022-02-20 11:48:01','2023-02-20 11:48:01'),('86f5bf80f6a819bf004c3363acf0afde82e046a33ebd3746918744619c2e157884c98ec09d3a12ce',28,1,'mobile','[]',0,'2022-02-23 10:11:58','2022-02-23 10:11:58','2023-02-23 10:11:58'),('88637c809a2022dc129f6d7720b983162816f86c33ceeed9383b70e06596448d20cb86e6a8fdc876',2,1,'mobile','[]',1,'2022-10-09 11:42:40','2022-10-09 11:42:40','2023-10-09 14:42:40'),('89abe358948c5a8c4f09bab9aa8a4abfd44b90bafc3579abe1ebe310d05b07c81191816df3efbab6',9,1,'mobile','[]',0,'2022-02-20 12:17:31','2022-02-20 12:17:31','2023-02-20 12:17:31'),('89be34ac3b8fa185c6a3b0998b3d87906d43fc179fe56eb81ce0edfe6efa85bdfce95e4a489a24e3',60,1,'mobile','[]',0,'2024-07-04 08:50:17','2024-07-04 08:50:17','2025-07-04 08:50:17'),('89c099d00e6d9de9209b9cc78d13a99e19c443817435ddad7c234624bbffabf97a5b35744df52584',5,1,'mobile','[]',1,'2023-02-19 11:42:37','2023-02-19 11:42:37','2024-02-19 11:42:37'),('8a360b004e31cb98807c0d4e0055dc20c81d39591baaf0edd422e2f65cc6abdeee834e97e0fefd48',12,1,'mobile','[]',0,'2024-06-09 06:34:35','2024-06-09 06:34:35','2025-06-09 06:34:35'),('8ab4bb20c765d9e78646c137e8ea0c4ac01114eae4be9d398780063458f9c46419570ddfe226ba84',30,1,'mobile','[]',0,'2024-07-04 13:37:20','2024-07-04 13:37:20','2025-07-04 13:37:20'),('8af3591e446ffa45c8fe3e8aa8712529f9f2efeec48dd472fb0c2f6e23a1f39b8cb0b4a1354b5af6',1,1,'mobile','[]',0,'2022-03-24 07:49:34','2022-03-24 07:49:34','2023-03-24 07:49:34'),('8b0ba45ea326e35ae603cb3a388f2e96293927b3b3d9c845b5246f676da317cb3d41346f77aafab9',50,1,'mobile','[]',1,'2022-03-10 09:17:18','2022-03-10 09:17:18','2023-03-10 09:17:18'),('8b23ff7f834f7e843d11b1853dc736c024b3c7b43954b01d8563cc1441f38eefe39c87ae9f14f0d3',1,1,'mobile','[]',0,'2022-03-16 13:21:27','2022-03-16 13:21:27','2023-03-16 13:21:27'),('8b4b5b95530bd7be220114ccd73ce643d7ca4866410c147affc343036e94580fa8d261007498e971',1,1,'mobile','[]',0,'2022-03-24 07:51:36','2022-03-24 07:51:36','2023-03-24 07:51:36'),('8bacfc69691e250cb23b52b6e6e628c9b9e2454cba086e0f6eeeb0f0265cb468a0b7e81dbd6f2ced',13,1,'mobile','[]',0,'2024-07-14 12:57:31','2024-07-14 12:57:31','2025-07-14 12:57:31'),('8bae2f47ed547d99b1793e0b2edcdabc9c9520144b14273093fbcd569a140a434f87af9737f57b63',9,1,'mobile','[]',0,'2023-08-09 09:01:13','2023-08-09 09:01:13','2024-08-09 12:01:13'),('8bbbb3568b0fd2186b3bd1ef90388b08f23d48be5bb425bf5620cf07e78d63d1593a5225425d68df',73,1,'mobile','[]',1,'2022-03-17 07:40:28','2022-03-17 07:40:28','2023-03-17 07:40:28'),('8c8d2a833b9a747d7bc01b61f6eb4dc0001b54915bec2098de3d16fbf9201e7732836765169ca8c1',13,1,'mobile','[]',0,'2024-07-08 10:41:09','2024-07-08 10:41:09','2025-07-08 10:41:09'),('8cf041539af4794a6e3088ada6263e51600c36c30543e6132ad1e0e12c434b4b5f9fb6af17e00e57',1,1,'mobile','[]',0,'2022-03-14 07:34:26','2022-03-14 07:34:26','2023-03-14 07:34:26'),('8d24e3f31560d6d53b261caec8d3d84ca8b94020b5b9512f336895f2841de7761db4c875e128b6da',30,1,'mobile','[]',1,'2024-07-10 09:53:36','2024-07-10 09:53:36','2025-07-10 09:53:36'),('8d2e80921718d0e53cbb3f2c274242035260bfd338f2582da316180812a478bfe85ee184e454368f',5,1,'mobile','[]',0,'2022-07-18 11:41:25','2022-07-18 11:41:25','2023-07-18 14:41:25'),('8d6c001a4e8d4e89edba925b3593e2f8737075420a22382cb0040c1f5cace75d3c5628915312819e',1,1,'mobile','[]',0,'2022-02-17 10:21:36','2022-02-17 10:21:36','2023-02-17 10:21:36'),('8d72a138d25e3ab58b4d798c24e100dfc855e4edc6a058fba66574505dd57b66c60ed1c210e0000d',9,1,'mobile','[]',0,'2023-08-10 04:19:43','2023-08-10 04:19:43','2024-08-10 07:19:43'),('8d7ecfa0be36f99a9ece0df45e8540cf9196ae612c6ed8dbd50193cd6933fd419d7168ed74cf835e',2,1,'mobile','[]',1,'2022-10-09 11:36:11','2022-10-09 11:36:11','2023-10-09 14:36:11'),('8db82de21ab8b63aaf332a591e903eecfec8f43c0e516443e0193680c8205b89a38b09040489feb7',4,1,'mobile','[]',0,'2022-03-24 08:17:45','2022-03-24 08:17:45','2023-03-24 08:17:45'),('8e68f6e7d039b0db4e59f13569abf9d582578df72597b406352841a196d1b4e41e91c2bd38124f6a',4,1,'mobile','[]',1,'2022-03-24 08:19:36','2022-03-24 08:19:36','2023-03-24 08:19:36'),('8e7a56955eb2375316be25387e50f543b80ca428daaf0ee91e57d41ee8516e28f353ffe57faf84ee',1,1,'mobile','[]',0,'2022-02-17 10:34:17','2022-02-17 10:34:17','2023-02-17 10:34:17'),('8f10c1e2d54918557a357b0d776adea6e5bb07034ded3fb89f1f14a86cf49ae12b17d7480bb7756e',70,1,'mobile','[]',0,'2022-03-14 12:07:25','2022-03-14 12:07:25','2023-03-14 12:07:25'),('9108c4b072cd60b81aeda0918dfa012866acdcc7c5794769fa508833ba844b844ac50aa471f1649b',1,1,'mobile','[]',0,'2022-02-16 09:43:42','2022-02-16 09:43:42','2023-02-16 09:43:42'),('9153c59aff024b3fa16dbe7e462639e5187b2b594734c741e85158b95bd3b6a15a9b0382be182f78',65,1,'mobile','[]',0,'2024-07-04 09:23:15','2024-07-04 09:23:15','2025-07-04 09:23:15'),('91d107ac31efbba40033415015f6b5c913fbaeea0162b431f567dd49f12de913d09eadd71afc617a',9,1,'mobile','[]',0,'2023-08-06 08:55:53','2023-08-06 08:55:53','2024-08-06 11:55:53'),('91d58c4407aef457b7a23910283bec5b0cd4790cd3c6aca120f6fe9c0995363ab35d6bb878029d19',8,1,'mobile','[]',1,'2022-03-24 10:55:47','2022-03-24 10:55:47','2023-03-24 10:55:47'),('91e1520aea1822071c69474031454453adedacc0d1457a438be5550dd103442f7ecb9ac9472b8e9b',30,1,'mobile','[]',1,'2024-07-07 05:16:38','2024-07-07 05:16:38','2025-07-07 05:16:38'),('92561e6ea697ea825362cab99e55ec8ee47545e417eb45545dc6ebead5d0c5abb6c7bb8a2e368d1b',7,1,'mobile','[]',0,'2022-10-23 06:22:35','2022-10-23 06:22:35','2023-10-23 09:22:35'),('92af2dffe43ed5a4db13d25fd1fda4898e6255b9b97c791f1f866859e28c9a4978dedd8f4a7f1d4c',1,1,'mobile','[]',0,'2022-04-20 15:23:03','2022-04-20 15:23:03','2023-04-20 15:23:03'),('92d94cab3192b66b2bbf7a7dcfd13f21ec45a540fa3d77c97c4365ddfbcc07eecddfb403521ac56c',28,1,'mobile','[]',0,'2022-02-23 10:12:05','2022-02-23 10:12:05','2023-02-23 10:12:05'),('932321b00df23b80a71b06d601079cc1d68512060844223e7d142679a0f30a1445b02c560414840f',1,1,'mobile','[]',0,'2022-04-13 12:34:30','2022-04-13 12:34:30','2023-04-13 12:34:30'),('933bfac3355ff5244037975d2a8c29ab7f2c6be131a299cfbb24007d70d47af1c8991ea090e897b2',26,1,'mobile','[]',1,'2022-02-23 09:22:00','2022-02-23 09:22:00','2023-02-23 09:22:00'),('93af20d85fd9874261525608fb3d174396051c78ed71e7753da67dab4aeca6d6df5e99ecab9c27f9',10,1,'mobile','[]',0,'2022-02-27 07:22:45','2022-02-27 07:22:45','2023-02-27 07:22:45'),('93eabecceb64a37db6e38997f4f5418ce0e729f38f11c71364b74d7c93a580125c217177dcc4bead',28,1,'mobile','[]',1,'2022-02-27 07:11:49','2022-02-27 07:11:49','2023-02-27 07:11:49'),('94555a2c40a818bf628cdd9ae7b5466b7678e3bb8a9ded9dd7d276bd78ab6527940f40b2348a1045',1,1,'mobile','[]',0,'2022-10-03 06:27:30','2022-10-03 06:27:30','2023-10-03 09:27:30'),('94792dbb60acddbfecde33543f1858567f9189bcc4391082a5d9689795f5584fa1693c020d5a75dd',23,1,'mobile','[]',0,'2022-06-27 10:29:08','2022-06-27 10:29:08','2023-06-27 10:29:08'),('9586ee77e1503e0e298660848abe66d03c8b62601858d81a8cc87cadbecb78d64bcc6b47672f1171',49,1,'mobile','[]',0,'2022-03-10 07:39:47','2022-03-10 07:39:47','2023-03-10 07:39:47'),('95e23a48000cdcae804803f7e011d8ccf45ade5a6aeea8dff645cab4dfb614c139951f1963453327',11,1,'mobile','[]',0,'2024-06-04 10:27:20','2024-06-04 10:27:20','2025-06-04 10:27:20'),('97567ffa1dbb29e48afd11dbe1ee923762feb85331d2a6080bb498584ab13a3aaf91413d265c2bdf',56,1,'mobile','[]',0,'2024-07-04 06:57:10','2024-07-04 06:57:10','2025-07-04 06:57:10'),('9768f6479bb5a3d312fc9de04496f26758f61db7c3cd1a8e826f9449127b4e1aa749107887bde447',3,1,'mobile','[]',0,'2022-04-25 13:28:33','2022-04-25 13:28:33','2023-04-25 13:28:33'),('97a6588bead15037ef2d70efb6ba20cfdc054c62e3af0dd2c89a98e650959c344276ee33e3e83751',2,1,'mobile','[]',0,'2023-09-07 06:34:45','2023-09-07 06:34:45','2024-09-07 09:34:45'),('97fb8ab8fc63d2e07c144d3b558f325c56bfd6f7324dc8b8490dfdbf94166bce5326abf99dc110eb',1,1,'mobile','[]',0,'2022-02-22 10:42:02','2022-02-22 10:42:02','2023-02-22 10:42:02'),('98d3fb2f2fd2fe563b7aa3ed97987a1e0bccc3ca1b9cc10548aa18d6ca9e942d480dcba776f4f15a',1,1,'mobile','[]',0,'2022-02-17 10:25:28','2022-02-17 10:25:28','2023-02-17 10:25:28'),('9a1c5ff3db1310f3cf1298eb8194b5707966cbb74660fd4b442d1dd5d03d134f69c6abff16d97c5b',17,1,'mobile','[]',0,'2022-06-19 12:16:36','2022-06-19 12:16:36','2023-06-19 12:16:36'),('9a276a335decd4745c9daaafb51d23aca17a6aad15110699bde5ec8fc0764bd869e063c3a57dfd0b',55,1,'mobile','[]',1,'2022-03-10 08:16:13','2022-03-10 08:16:13','2023-03-10 08:16:13'),('9a7d335a406cada2284f818b4e18e65feb8915b2b396a3a6a3bb58aa9c948821c94218e3e19ca0cf',1,1,'mobile','[]',0,'2022-05-17 09:23:00','2022-05-17 09:23:00','2023-05-17 09:23:00'),('9abb485f696f1cf56b64f27bbd2c746a8a4b1d2dda0e87977ea5cbd9060988f510cf12db02bbf002',6,1,'mobile','[]',0,'2024-06-27 11:28:27','2024-06-27 11:28:27','2025-06-27 11:28:27'),('9ac3a7dedee18d085274a9c75585df76e90f8e068777d27acf784a4a026d5b93c4b1cd1663cf19f4',4,1,'mobile','[]',0,'2022-03-24 08:17:13','2022-03-24 08:17:13','2023-03-24 08:17:13'),('9b21dd81147f5f882df65bb5f384a254feb801bc082df6947eca3ebedcc2faac44b62ef0a12f3b18',33,1,'mobile','[]',0,'2024-07-03 13:08:53','2024-07-03 13:08:53','2025-07-03 13:08:53'),('9b478f6efa6da372112b857ef9c95d9a3d41f19947509ff9c00e02aa2217c585753a3c42544532d1',3,1,'mobile','[]',0,'2022-04-25 13:27:15','2022-04-25 13:27:15','2023-04-25 13:27:15'),('9b73df46f65d19ac1ff8dbac35e4b7de6076b8d098bac2038ce0bab4d1b82b0f831a1d1e5cebcbb7',4,1,'mobile','[]',0,'2023-02-13 13:03:17','2023-02-13 13:03:17','2024-02-13 13:03:17'),('9bb0bb42bf0416025894781ecd92fec2a76d880bdbac444b5f7cfd3ce43e325e01761834c0c65c5c',11,1,'mobile','[]',0,'2024-06-05 11:27:06','2024-06-05 11:27:06','2025-06-05 11:27:06'),('9c41cb1a4e42dcbd692c2179b5086db1d5de4e8ea6cf79b959ead1f343fa4cd35ff2ad6e12d31583',79,1,'mobile','[]',0,'2022-03-23 07:55:06','2022-03-23 07:55:06','2023-03-23 07:55:06'),('9cc92fe4a4da12975936fb54bce7f3681e46cfd0097f6eede27bd4a71f2b6e96ce490140779c5036',1,1,'mobile','[]',0,'2022-03-06 12:13:03','2022-03-06 12:13:03','2023-03-06 12:13:03'),('9ce6f0371a09d316f0c166c44de9ed6c0c015138ea6d5290c8f89049962fa01a3bc5502176d562eb',3,1,'mobile','[]',0,'2022-05-17 09:23:10','2022-05-17 09:23:10','2023-05-17 09:23:10'),('9d1ae6fdd9eb83cd9018dd7a8b0c54ccc1cf9318bb560057ae88a6ee55136b5003a612a60199b987',15,1,'mobile','[]',0,'2022-06-15 12:12:47','2022-06-15 12:12:47','2023-06-15 12:12:47'),('9d715c170a56e5a5984506f916f5a355ea3c5958c893de8424def78cc9627ffa883439cba43e2f62',1,1,'mobile','[]',0,'2022-02-17 09:44:09','2022-02-17 09:44:09','2023-02-17 09:44:09'),('9d9e946253c365831166427c0583869553ea77a290a6d93316224d6b9082d22474f70bb2a8872089',16,1,'mobile','[]',1,'2024-07-01 16:28:36','2024-07-01 16:28:36','2025-07-01 16:28:36'),('9daad59b972497a6ce30d20a515f5f78ad60f27d19446cc239dbaa19809a5a69f7e95e2cba6b1f56',1,1,'mobile','[]',0,'2022-02-14 10:33:04','2022-02-14 10:33:04','2023-02-14 12:33:04'),('9de8dc5982163816bc4b685be7a46d75398c2e4c06677a66f74dcc11e97c5ec2c33b2cccaaebc137',16,1,'mobile','[]',1,'2024-06-30 06:05:16','2024-06-30 06:05:16','2025-06-30 06:05:16'),('9e4a6644184ff69196d8939e9acec8ffa7560a10cbded3c630aa851c88511a75a6ee522178e6f6b2',9,1,'mobile','[]',0,'2023-07-28 04:11:28','2023-07-28 04:11:28','2024-07-28 07:11:28'),('9eddafd9e02043c43f61ca21e70da4a7e3e472971044c86f7aaedca759f7bad98f37052e4726ec77',3,1,'mobile','[]',0,'2022-04-14 13:02:15','2022-04-14 13:02:15','2023-04-14 13:02:15'),('9f7113c9e50d2d7edb49cd04dae3077d7bc1436d93f24a7b072b38593dd6021629e1f7b3cfa40fcb',3,1,'mobile','[]',0,'2023-07-24 14:58:27','2023-07-24 14:58:27','2024-07-24 17:58:27'),('9fd41abfa0de1f81c09894fed57e5c27df362447c2e1163c25598a40aeb641b6c8aed67273e16c53',13,1,'mobile','[]',0,'2024-07-15 06:23:43','2024-07-15 06:23:43','2025-07-15 06:23:43'),('a015819b3ac8ffc901b5d1139c363b76dd76ab3ca26268ebbfc9b22a44c7c01cd16dded47af413c3',61,1,'mobile','[]',0,'2024-07-04 08:57:28','2024-07-04 08:57:28','2025-07-04 08:57:28'),('a0278c3cf2c28d5241e05269c75a21e0ac8208c750b733400dbe1a98c394a7c4d91c47066bce0278',55,1,'mobile','[]',1,'2022-03-10 08:17:35','2022-03-10 08:17:35','2023-03-10 08:17:35'),('a057eb8871bd9dac7b6d733806c57050b025841a7a408d54be48a19625725ac87857ad8adcb7217a',30,1,'mobile','[]',0,'2024-07-09 10:07:59','2024-07-09 10:07:59','2025-07-09 10:07:59'),('a059e55112cad9272fdaefc280fa8f673d0e5e012c37f45dd73b812c073cae71c7f23cb184a0ef90',1,1,'mobile','[]',0,'2022-04-13 11:44:24','2022-04-13 11:44:24','2023-04-13 11:44:24'),('a0def54c0167bfa57360e2b8193749c5c4bdb4d563fc83daa18b201138cf4b52554daaeb6c49f7b6',16,1,'mobile','[]',0,'2024-07-01 16:47:51','2024-07-01 16:47:51','2025-07-01 16:47:51'),('a15251b7c9a3cbfe47b2ea69fef4b374dee36e47f025c5dbe55db9099cb3619929353808c805ca05',4,1,'mobile','[]',0,'2022-07-24 08:46:08','2022-07-24 08:46:08','2023-07-24 11:46:08'),('a15c75edbfaeae9b49d0ad94dd04da1169134f48092040a44325a7622ed20b71e65461e8dd126844',63,1,'mobile','[]',0,'2022-03-10 11:34:28','2022-03-10 11:34:28','2023-03-10 11:34:28'),('a1c443d5122d021272c8586342bbbf3fa4d61d4f9219aa6850891c5fd53dd89c0b775ef811883f32',14,1,'mobile','[]',0,'2022-06-20 13:59:45','2022-06-20 13:59:45','2023-06-20 13:59:45'),('a1d6ff4a150c00175ab3c371eb4f254b37aa9f363e0b55926f4157447c945fb37b9a0526cdb669de',1,1,'mobile','[]',0,'2022-02-17 10:20:53','2022-02-17 10:20:53','2023-02-17 10:20:53'),('a1f1518e4bdf6825fb5388f4964b4a08ddca51afd9c543d034e01f3a5a76a31dff44d51ea50cc28d',22,1,'mobile','[]',0,'2022-02-22 13:09:00','2022-02-22 13:09:00','2023-02-22 13:09:00'),('a21ee4e99f499b1a8a0c105009a99a739da31b7e08b0c5e956f99a89993cd88e39479d7158cbc2b0',30,1,'mobile','[]',1,'2024-07-11 11:57:12','2024-07-11 11:57:12','2025-07-11 11:57:12'),('a284452a0693d6968355e776ffdc27a829c86915e852dbfd61ef3d45ba007c392a5b7a3f8f1d193d',30,1,'mobile','[]',1,'2024-07-09 10:53:28','2024-07-09 10:53:28','2025-07-09 10:53:28'),('a2a0cf0d74c2d924470768553f43730aea45538b7aac846e16a67ffa33a517a2a34ae8adf9c49a22',3,1,'mobile','[]',0,'2023-07-24 14:58:09','2023-07-24 14:58:09','2024-07-24 17:58:09'),('a3090dde5a857f3d920175fff07286dc10a5a5bbfda7294e95c6cbe46cf66a60e3d1654ede7c1b3f',62,1,'mobile','[]',0,'2022-03-17 09:41:00','2022-03-17 09:41:00','2023-03-17 09:41:00'),('a3651ccb9893e801ca7755f6bb66e47f26dd219733ca5c41d86a8c022eb0548465633ecd25012a0f',1,1,'mobile','[]',0,'2022-02-17 12:47:39','2022-02-17 12:47:39','2023-02-17 12:47:39'),('a3677c060f4d8af20fe13de68152986803897edff2c61b60940fd0e2a35f22f41e155171bd05277d',4,1,'mobile','[]',0,'2022-07-26 09:24:39','2022-07-26 09:24:39','2023-07-26 12:24:39'),('a36f5d8dde734267162e75029539c7973a7b4af298eb9d767ace02490ac68255b9e3d6eaa25bb43c',16,1,'mobile','[]',0,'2024-07-02 11:59:28','2024-07-02 11:59:28','2025-07-02 11:59:28'),('a37dcc018c55a8bf327f6dd076fd320df5a890b17bd3ec9826ccbb89f099c656ae0527d5d6c421e2',15,1,'mobile','[]',0,'2022-06-19 10:28:46','2022-06-19 10:28:46','2023-06-19 10:28:46'),('a386c2367d5c43eafa45fbebb3051d69b0ef18d1d017b447da058f651860c4d427bac51719bfba8e',46,1,'mobile','[]',1,'2022-03-09 12:45:37','2022-03-09 12:45:37','2023-03-09 12:45:37'),('a3cc62ae7cd2679b2322cf71ac13616bb49f5713b852b977e816f5e58ccb757ca3e003aeb694c008',50,1,'mobile','[]',0,'2022-03-10 08:03:30','2022-03-10 08:03:30','2023-03-10 08:03:30'),('a5b772b033d61610cb2ab84aa7237efe46662f28df378e23289d20248d970adbe2c6d91b27f94c13',30,1,'mobile','[]',0,'2024-07-03 08:54:11','2024-07-03 08:54:11','2025-07-03 08:54:11'),('a61d62d6c3f67abeb0aa62cc133c469cbdd9999d4c2a2da7c1b465bf404cfcd6165b9210aea086c4',1,1,'mobile','[]',0,'2022-02-16 09:37:16','2022-02-16 09:37:16','2023-02-16 09:37:16'),('a62cebdff78f88dd4c1b7ecde86ae799dbee6c3237990e35d82a18dba42218e6b99241ae1470528b',13,1,'mobile','[]',0,'2024-07-18 14:24:21','2024-07-18 14:24:21','2025-07-18 14:24:21'),('a645958092f3f17c33199c4184aad7469ed8e2ed9b1fe02b5603db29c6403ca6e0df602ae68cc1d0',59,1,'mobile','[]',1,'2022-03-10 11:30:23','2022-03-10 11:30:23','2023-03-10 11:30:23'),('a68e7659b9ea20dc503df1134f0bc8b1e17d7cc3a6595b8b778af3dce41106e1be3335b3c8964a9c',68,1,'mobile','[]',0,'2024-07-04 09:59:34','2024-07-04 09:59:34','2025-07-04 09:59:34'),('a6e4d926078419abad0f36e58a73389ec0f3ba2c9800fc117916a2b9bf8537150748161fa060c3a3',65,1,'mobile','[]',0,'2022-03-10 11:52:27','2022-03-10 11:52:27','2023-03-10 11:52:27'),('a6f823250a1c2d1cbaa5ce69a569a46a8fafa657b8a4f009325ef84a347284d4a03f9a4070a1e10c',31,1,'mobile','[]',0,'2022-02-23 10:11:33','2022-02-23 10:11:33','2023-02-23 10:11:33'),('a7539d896366331367d30a48ec8150a3f0f519c14422144db1a5962f52f4ca677cd869b91a1f3e7a',27,1,'mobile','[]',0,'2024-07-02 09:13:45','2024-07-02 09:13:45','2025-07-02 09:13:45'),('a7c8268d325118f8c69a82d4116fc880730d2eea56bfbd5bc1df43cf412fbbe9f3b8ca20b40274ef',4,1,'mobile','[]',1,'2023-02-15 09:57:33','2023-02-15 09:57:33','2024-02-15 09:57:33'),('a88d10daa47d6decd9f82b67a9f0d79e9d84598b28634f2a93d7005f98b87ad6746a7e785e4b525f',2,1,'mobile','[]',0,'2022-10-10 07:06:03','2022-10-10 07:06:03','2023-10-10 10:06:03'),('a8bd079502cdd848ebc8d8ab275e2f9926b73a21baa02406365f778fa365ba8d466acee44a09194e',11,1,'mobile','[]',0,'2022-06-19 10:25:57','2022-06-19 10:25:57','2023-06-19 10:25:57'),('a92b1b0c064a5e77e69e2d705d68824e543e4442a5c221d7d378c656f5302b924ed33fce870b27c3',31,1,'mobile','[]',1,'2022-02-23 10:22:39','2022-02-23 10:22:39','2023-02-23 10:22:39'),('a9f253935197fb8bfcfc894c7fb3bfb70d14584ceb845560c95cc20053c7269db9012928c4c4debd',50,1,'mobile','[]',1,'2022-03-10 09:11:32','2022-03-10 09:11:32','2023-03-10 09:11:32'),('a9f56dcf6c2bf86e7311c0c544441016afb0a7ea3ecac908b0a5dbcb923a249919261f274d3324d5',21,1,'mobile','[]',0,'2024-07-01 12:54:05','2024-07-01 12:54:05','2025-07-01 12:54:05'),('aa08f0e4277382b0dd23088a631a2f90c05226f9a9514885dc2b6000e3a393ade459e890403ad40c',1,1,'mobile','[]',0,'2022-02-21 08:02:25','2022-02-21 08:02:25','2023-02-21 08:02:25'),('aae0cc8463c62613ec2efa9586f90f0c753c5c7bec75799cf711c7329b81c58890b0afc1b0314650',58,1,'mobile','[]',0,'2024-07-04 07:23:42','2024-07-04 07:23:42','2025-07-04 07:23:42'),('aaf6ea66f719cb13ffef36467a13c7f443b9b3d4feb83477cb74c591800497e7679f44bab2a84f0f',1,1,'mobile','[]',0,'2022-03-24 07:51:48','2022-03-24 07:51:48','2023-03-24 07:51:48'),('ab1988b622e31d706bf5dbbaebbdaecd91554cd23bfe84860dece306b3d7d25d6eba600a2bfdad5b',37,1,'mobile','[]',0,'2024-07-03 13:35:35','2024-07-03 13:35:35','2025-07-03 13:35:35'),('ab2e63eb1f464bcadab6fdec72546cb6c168affce847cfe85b9b1d459e4c9bcf5badf10b3998d7ae',31,1,'mobile','[]',1,'2022-02-23 10:14:06','2022-02-23 10:14:06','2023-02-23 10:14:06'),('ab4045d339b1ebd7d7378baca2bdf4e1f5ce08ca68eb8d87d247e58e97ebf48db45c8300fd8652d5',1,1,'mobile','[]',0,'2022-07-24 08:47:19','2022-07-24 08:47:19','2023-07-24 11:47:19'),('ab406b326e2047ed4e7dc62b62ba0269f42844596247221ff40bbb33508afb1c362d7788e92a29f7',35,1,'mobile','[]',1,'2022-02-27 09:22:42','2022-02-27 09:22:42','2023-02-27 09:22:42'),('aba3df6b4bd0108824335c9c61439774067c93bddd112a26b3812f59f514b543992a216778da6a94',49,1,'mobile','[]',0,'2022-03-10 07:40:29','2022-03-10 07:40:29','2023-03-10 07:40:29'),('abc84c29fd75d47f4eb574c525a07bdd539b15a486b81806386002234f79ae074832e93c5f5f4b95',45,1,'mobile','[]',1,'2022-03-09 11:51:03','2022-03-09 11:51:03','2023-03-09 11:51:03'),('abcb44908231a6a0a5c01dab9eb4f332104a43de6c7ce23dded17cc4d42e2fc08096ff7234c3b920',1,1,'mobile','[]',0,'2024-07-08 10:27:37','2024-07-08 10:27:37','2025-07-08 10:27:37'),('ac65fa2b0456627fa1c5d27f2c5bc7f92d074a1fcf924676c33f2c4bb79641e129c69b799f88d340',9,1,'mobile','[]',0,'2023-08-04 05:30:40','2023-08-04 05:30:40','2024-08-04 08:30:40'),('ac760b7f7afb5084b0c0fbb30e18422aa0bda3a7aa59035b5a3ef96dd7c8e188d5184a67fde32d5c',78,1,'mobile','[]',0,'2022-03-17 13:06:02','2022-03-17 13:06:02','2023-03-17 13:06:02'),('ac7d3dec39467a6b6b4400c6997a9ef88c9775a56676703fd9b60d8e12b441d0075809ab0fe5f53b',22,1,'mobile','[]',0,'2024-07-01 13:09:56','2024-07-01 13:09:56','2025-07-01 13:09:56'),('ac9813a9d0d7bae47cfbe2602778e964dd99297ff958af84963d1d87242cbc3b57f27594e182af69',1,1,'mobile','[]',0,'2022-04-13 11:16:24','2022-04-13 11:16:24','2023-04-13 11:16:24'),('ad3c57686cea4b937ff0b3d3cf06826fa40505cbc67bd896627959262f6bf3ae15e9a0e0a0e6e1b7',1,1,'mobile','[]',0,'2022-07-06 08:14:29','2022-07-06 08:14:29','2023-07-06 11:14:29'),('ad9c77a4ec575c0775260956332fa82755468432a7c685bab9b202d78f38bb01389c8a239d2760f6',70,1,'mobile','[]',0,'2022-03-16 10:16:01','2022-03-16 10:16:01','2023-03-16 10:16:01'),('ade8d1ec08fc6fc613dcf02eb722fae21b4c8c0a8ec365ad14742a124de03be5241c5b46749f4521',20,1,'mobile','[]',0,'2022-06-23 13:03:11','2022-06-23 13:03:11','2023-06-23 13:03:11'),('ae24fb0b057c0791569caace5b6b524fd1241046adde9703bf25a3bd4f38f37e42037af547feab89',29,1,'mobile','[]',0,'2024-07-02 14:40:56','2024-07-02 14:40:56','2025-07-02 14:40:56'),('ae681e39f3a6f2d55d5d465b41c1bdfbe4110c4522829b5bbc596e18de079c57869587d7ad34d3d5',24,1,'mobile','[]',0,'2022-06-27 10:37:50','2022-06-27 10:37:50','2023-06-27 10:37:50'),('ae6b570843d9b8b2afd25e4916578ca53c8988878ed8a2f16ae19102f92c52403672e574507bcda4',16,1,'mobile','[]',1,'2024-07-01 05:27:00','2024-07-01 05:27:00','2025-07-01 05:27:00'),('aeb6c88965c1fe1978f52005ed1e4c0fe1c0492008a67638c9dab60727995efd8a43c8933b930b82',77,1,'mobile','[]',0,'2022-03-17 11:40:19','2022-03-17 11:40:19','2023-03-17 11:40:19'),('af266c338536548bec230a0c5342385b80da1f3e6f7432ff40956cd6c741f09b695b1743bc729455',1,1,'mobile','[]',0,'2022-03-06 12:48:26','2022-03-06 12:48:26','2023-03-06 12:48:26'),('af2c6df5ed346fbda027c216af899276f83aa76dd7f67624be474b5c868e4973c117eb5c6421db00',12,1,'mobile','[]',0,'2022-05-10 12:13:32','2022-05-10 12:13:32','2023-05-10 12:13:32'),('af692ad11f4898a5b930fda78c3ee16f3a2a7f226b2d96e9dde276d10b9f194a027b497454f8d6db',59,1,'mobile','[]',0,'2024-07-04 07:42:52','2024-07-04 07:42:52','2025-07-04 07:42:52'),('afefd91d50f6af3389e6a3c2804ccb9b4c66fe5cb68b48fb41700f38e5483825066f60836b41bf95',16,1,'mobile','[]',1,'2024-07-01 13:30:10','2024-07-01 13:30:10','2025-07-01 13:30:10'),('b0634b5cbcb940746e8bfc5bc1db3e78860d76f6240da1f580eb70f7f3a16fce20bb7e00b35fc8a3',1,1,'mobile','[]',0,'2022-03-24 07:52:39','2022-03-24 07:52:39','2023-03-24 07:52:39'),('b14388ad7b240b1c6e83c2d81eddbd5818ff12deb79339589417c0f8870d6d9e05d9143fcfe8e263',4,1,'mobile','[]',0,'2022-05-10 09:09:29','2022-05-10 09:09:29','2023-05-10 09:09:29'),('b1ad56505ad40cedd07dd771317bef4138eeff67efcc372be291f601c2b0832092e5240e8d5f8069',78,1,'mobile','[]',0,'2022-03-17 13:08:04','2022-03-17 13:08:04','2023-03-17 13:08:04'),('b1d865d806f79011eb76596d054e5bf25cee2cb11772f536476f1848be76a5a45a4609c48e9a11c4',1,1,'mobile','[]',0,'2022-02-17 09:45:31','2022-02-17 09:45:31','2023-02-17 09:45:31'),('b2482a928fbbcae70dbe58c9694a8485850fb382178b431178dcc313876500848ad72351de42656e',1,1,'mobile','[]',0,'2022-07-18 09:55:45','2022-07-18 09:55:45','2023-07-18 12:55:45'),('b2d03d6c461628d905d6f45a504d837e5b79674f3fffd5f0f815e4e72f8af5bbb9c57529e92bcad6',13,1,'mobile','[]',1,'2024-06-27 09:22:27','2024-06-27 09:22:27','2025-06-27 09:22:27'),('b2e496c28f3f8aad607f6b6c124c143c532628c69c461df5ff80e76d00355ac52e370ef3427a8350',14,1,'mobile','[]',0,'2022-06-14 12:39:02','2022-06-14 12:39:02','2023-06-14 12:39:02'),('b307e0c0f591984242f4cca8b613fade3f5652c16a0975b4659734578ed320da10ce0b57925daf67',62,1,'mobile','[]',0,'2024-07-04 09:03:32','2024-07-04 09:03:32','2025-07-04 09:03:32'),('b356db8c455cc5769d3efbbb34687042153bbc1e0d21279a4263fdaff82359849a5543388d5fc7d4',8,1,'mobile','[]',0,'2023-07-23 08:53:26','2023-07-23 08:53:26','2024-07-23 11:53:26'),('b363d4ac2dbc411feb48aa26a716114c82623cfe6d672071a6f3dc05f02bbc9d73e762272c5691e2',1,1,'mobile','[]',0,'2022-10-03 07:26:22','2022-10-03 07:26:22','2023-10-03 10:26:22'),('b3840659747c193aea51ca4e9de88e16702b4870a4052aebb02cab549d85ee99fe8792e35e7ac320',16,1,'mobile','[]',1,'2024-07-01 16:18:40','2024-07-01 16:18:40','2025-07-01 16:18:40'),('b3ef5e1de2b9db5fb12781eef084134cb04c0acda42421f5bd04bc3872bfd8746527cabbaa2cf012',31,1,'mobile','[]',0,'2024-07-03 10:01:36','2024-07-03 10:01:36','2025-07-03 10:01:36'),('b4c84ff8df6b49e4499dbbe2347fd56d79a0a66f020a7c055b07ec3637898f7c7088e518780ec72d',6,1,'mobile','[]',0,'2022-08-11 07:32:07','2022-08-11 07:32:07','2023-08-11 10:32:07'),('b572967fe55ca01b91ce844986162f6435e5da24ad0e5c50c5176cb7942c180f99f39f01bbdebfb4',24,1,'mobile','[]',0,'2024-07-02 07:36:37','2024-07-02 07:36:37','2025-07-02 07:36:37'),('b6504070c5d7cbf401b74e919cf998e61b751997810dea959ece7972fa57530b91d360a5116fb00b',14,1,'mobile','[]',0,'2022-06-27 12:40:23','2022-06-27 12:40:23','2023-06-27 12:40:23'),('b69116051dac3eb3e668ba13090cabd486f10273ab0ddbff787cfb989b3ade19246161cf9204491b',70,1,'mobile','[]',0,'2022-03-14 12:28:02','2022-03-14 12:28:02','2023-03-14 12:28:02'),('b770e10bb2c8b1f1dd3249a1176a5a690182a4ff468b65bb3f7ca323a57403a2956cf7d73a6558d3',28,1,'mobile','[]',0,'2022-06-30 17:14:57','2022-06-30 17:14:57','2023-06-30 17:14:57'),('b7be787849206495091e18302481b2b6d697fd622caac682a36684b55e550f793c832fbee72f7be3',23,1,'mobile','[]',0,'2022-06-27 09:54:20','2022-06-27 09:54:20','2023-06-27 09:54:20'),('b7c8a024c1d68e5989f245e997420caae688dc6d4f75bee594f46559bac4071d6e1ac2579eed9ad2',30,1,'mobile','[]',1,'2024-07-09 15:31:30','2024-07-09 15:31:30','2025-07-09 15:31:30'),('b7f019dd79d5bf7afc1da9b81cce255faeab7d92ceb945aadc300c8978c6a1463935ff15ef1a4917',1,1,'mobile','[]',0,'2022-07-06 08:04:22','2022-07-06 08:04:22','2023-07-06 11:04:22'),('ba05986b6f992ad9a4030dec8d2e30cdc3e53cdcba3a5e9aa036d3979ab98f7ce5cd260deab50e66',63,1,'mobile','[]',1,'2022-03-17 08:12:00','2022-03-17 08:12:00','2023-03-17 08:12:00'),('ba6cfb7751661bb6f236e0c8dc116d0e72f5e4757637be2625f1bf74dc94824c7ae1a4586312d274',3,1,'mobile','[]',0,'2022-04-20 10:39:25','2022-04-20 10:39:25','2023-04-20 10:39:25'),('bb45dbac3462b4ad201aca9e742864d661c5d720512352802274283c83bda016081fe5238417af47',77,1,'mobile','[]',1,'2022-03-20 10:37:21','2022-03-20 10:37:21','2023-03-20 10:37:21'),('bbb94aa9098f4608fde8d559df183b10a7f52357ebf1a0dd24f6a991f16c7e3f1df748b2429e7292',7,1,'mobile','[]',0,'2024-07-01 09:26:50','2024-07-01 09:26:50','2025-07-01 09:26:50'),('bc193086329ac576f7850c174304b9f0e6be022dfb70a311db3a346d2089a69bf65817affd1f1f95',1,1,'mobile','[]',0,'2022-02-21 06:56:09','2022-02-21 06:56:09','2023-02-21 06:56:09'),('bc1a747f5111dcaa756476888a8b7619f1af064c6fd3c8a8b12ef102c737207d902e512c40fca5d1',4,1,'mobile','[]',0,'2022-07-24 08:44:12','2022-07-24 08:44:12','2023-07-24 11:44:12'),('bc52a6b5ce81fd22c23aefefad643f1c7e54ca54f4cdf841aef6da92a79ae8341ce1f11c94f4d84f',16,1,'mobile','[]',1,'2024-07-02 04:52:17','2024-07-02 04:52:17','2025-07-02 04:52:17'),('bcb2e5cdd593c8d51db02852b272a6e5b55749b88a0836006de13131efca1cb8a4bd90bdd84185f6',1,1,'mobile','[]',0,'2022-04-13 12:24:39','2022-04-13 12:24:39','2023-04-13 12:24:39'),('bcea759b790c19eb1cad3d8caa9911ed358f0d1e033293bbae85e573fc269d46dc143ae9fe0d9894',1,1,'mobile','[]',0,'2022-02-14 10:34:41','2022-02-14 10:34:41','2023-02-14 12:34:41'),('bcfd6b5d2a1f29185e86ce22b930783e0777f37c1d6a55304fa020f8b47272d9fc34f8d8f7aa260f',47,1,'mobile','[]',1,'2022-03-09 13:09:32','2022-03-09 13:09:32','2023-03-09 13:09:32'),('be7a85aa5d331bbc8dd54dddd446c183f8cc6c6c89dbea919193a37575026b72fc47de899ddab8d7',13,1,'mobile','[]',0,'2024-06-30 09:08:44','2024-06-30 09:08:44','2025-06-30 09:08:44'),('beed084a43dcad3c207a0490be0a63dcbc535ea0f25da01fcd0d0b06d5d375187206c845615ce8fa',46,1,'mobile','[]',0,'2024-07-03 15:02:45','2024-07-03 15:02:45','2025-07-03 15:02:45'),('bf2b17101f0d9a18c0d222613ee8bb9b3c3b61bc1bfc2873ff6046d1f1d73620e7fe785911d9117b',3,1,'mobile','[]',0,'2022-04-25 13:30:02','2022-04-25 13:30:02','2023-04-25 13:30:02'),('bf38bafc74f2e1591de5943e05287d5248faa46f2c0e45228a6cf9b8409b12ae6f8cf81005ad7efa',31,1,'mobile','[]',0,'2022-02-23 10:13:40','2022-02-23 10:13:40','2023-02-23 10:13:40'),('bfee3b951148440343ac84496b49fd691aef7cab25e6e6fb81b2611559764ff98273a17e8effd3c7',6,1,'mobile','[]',0,'2022-08-11 08:18:12','2022-08-11 08:18:12','2023-08-11 11:18:12'),('c131544a08c88ddb4f444f913cc9f540c6680f5abb4bdb10104e163734fd94cfd4d876af8358afa3',4,1,'mobile','[]',0,'2022-07-18 10:49:13','2022-07-18 10:49:13','2023-07-18 13:49:13'),('c145bec2f37f1a042b1474f11862e0bb6e12a6b7d2ab3dc7075971c33ce215b62d24c5b09e86c77b',7,1,'mobile','[]',1,'2022-10-25 11:09:18','2022-10-25 11:09:18','2023-10-25 14:09:18'),('c14750790016ac8392657023f507a2a64260bacce0f7d2d44aaa7e9ec85504f1116fb592efe4d581',72,1,'mobile','[]',1,'2022-03-17 07:05:04','2022-03-17 07:05:04','2023-03-17 07:05:04'),('c15df7f4eced6c37290c6f32f7b54c84d8540108f366df9af35037d380da4542af0fe79c0fb16b9f',34,1,'mobile','[]',0,'2024-07-03 13:10:59','2024-07-03 13:10:59','2025-07-03 13:10:59'),('c1b229f9fca81ef432e0a8482047b11adea32ecdb6d6ee9f3c3128c9b84707a1aca2bd01d48ffdbc',63,1,'mobile','[]',0,'2022-03-10 11:52:47','2022-03-10 11:52:47','2023-03-10 11:52:47'),('c2990f6ee15635a64127531ac830b7a55ef4a7dbdddd8d0bbdaf97a27d85dfe7638cba4f5f4e6f9d',30,1,'mobile','[]',1,'2024-07-11 11:48:17','2024-07-11 11:48:17','2025-07-11 11:48:17'),('c331519d67113d69c81c385ed998fe30f92a1d990f403bab6058629dbefd40873c489a9549d30298',1,1,'mobile','[]',0,'2022-03-16 11:28:03','2022-03-16 11:28:03','2023-03-16 11:28:03'),('c3b66a32ed6b3e5d364c8e665a7e818141a99d071e0fc561d9def781f1b9e1f3f640316816820fdb',13,1,'mobile','[]',0,'2023-08-15 11:16:17','2023-08-15 11:16:17','2024-08-15 14:16:17'),('c3fa5c5614baa3ec39a89236de4a78e0c9584fe1f4e66e93a7a92cea00cc06e286c87abe4e2a46db',3,1,'mobile','[]',0,'2022-04-14 12:41:02','2022-04-14 12:41:02','2023-04-14 12:41:02'),('c421a74f8848fe793bfe3bf775471cb95dc72e087d0565929024ebf41f5259c5db66fac818e2b5d4',1,1,'mobile','[]',0,'2022-04-13 12:24:01','2022-04-13 12:24:01','2023-04-13 12:24:01'),('c4883b0cf0bff4c35c921b2fbc470aac75ae6202e887e6c2976745ce9b5fd46320b6ca85f61d477d',13,1,'mobile','[]',0,'2022-05-26 15:29:17','2022-05-26 15:29:17','2023-05-26 15:29:17'),('c4db6a380c7e8c6962193206ac9c0e056d5946835ddf57e300373f1250217d28d40eb09a0ddbb713',63,1,'mobile','[]',0,'2022-03-10 11:08:31','2022-03-10 11:08:31','2023-03-10 11:08:31'),('c5264ec4d340c27d564afacb773c71e66d1a2092faf2fc81b43443dd965f30f0606bfaf781709aca',78,1,'mobile','[]',0,'2022-03-17 13:04:59','2022-03-17 13:04:59','2023-03-17 13:04:59'),('c5aaf04c5350b0be745a7274271d4aced8e27dea9247ded547943748d1d487e2020323a55349d6cd',1,1,'mobile','[]',0,'2022-02-17 10:26:02','2022-02-17 10:26:02','2023-02-17 10:26:02'),('c5e4a7b77ba483a3ffe309ded71edfc6c71f4f77c416be71b81fe5d3132d6b7034cc5a01113e2ffb',4,1,'mobile','[]',0,'2022-07-26 10:07:20','2022-07-26 10:07:20','2023-07-26 13:07:20'),('c613e4a8d0c3b18bd5b55c038cd56c8aa04815beffb11229d5862595b74179f9a5233fdd0c68df28',30,1,'mobile','[]',1,'2024-07-09 15:26:17','2024-07-09 15:26:17','2025-07-09 15:26:17'),('c6a4ace4e5af14f7ed999e7dfff1374c8e6be905aea35c15fde5bf4d2f62efbd6e9d1d0a368d87e9',20,1,'mobile','[]',0,'2022-06-23 12:13:09','2022-06-23 12:13:09','2023-06-23 12:13:09'),('c784a675365e8605f92f5027a2e320ef6a0b8ae91feafd522dd47ba5c5ee8cdff20589405f6d2b21',1,1,'mobile','[]',0,'2024-07-08 10:22:06','2024-07-08 10:22:06','2025-07-08 10:22:06'),('c7ac1e36363cf0ce3f06d6c89f5bcc877f9a105d390b39f3fe6e6b120d6ff63b93a5e154b8590e4e',4,1,'mobile','[]',0,'2022-03-24 08:19:08','2022-03-24 08:19:08','2023-03-24 08:19:08'),('c7cd53a860aaab7d232500606c637c961e9abe9c276efe5cff0b6a783f73cdc61cf22b1f683eda1c',3,1,'mobile','[]',0,'2022-04-25 13:30:11','2022-04-25 13:30:11','2023-04-25 13:30:11'),('c7f08813b726675333d2214c37d09027c0dc8a78a51c3fe2124dac72020cddf0846570b5cd7f2252',30,1,'mobile','[]',1,'2024-07-09 15:32:02','2024-07-09 15:32:02','2025-07-09 15:32:02'),('c893952abe239cd01c85d6851cc25928d8a863f6878942c395610198d8237677ff6b4bca45ee7be7',1,1,'mobile','[]',0,'2022-03-02 11:49:14','2022-03-02 11:49:14','2023-03-02 11:49:14'),('c8d00a361d2add118d7f0e803bb76352f372a7c1203413b144ecdd412a383ca62f685046e6065e03',2,1,'mobile','[]',0,'2022-10-10 07:24:09','2022-10-10 07:24:09','2023-10-10 10:24:09'),('c8ed42b32b720f7b4cd2779326d6470bf7bbd0ea3ba9baa26c7b668b59a712c393e2a62da259fecb',31,1,'mobile','[]',1,'2022-02-23 09:46:31','2022-02-23 09:46:31','2023-02-23 09:46:31'),('c906a4f167a4a69b2fc3c613107c397b8f7dce493c2a864b1b4ced9f8479c875d403943e41a196b4',13,1,'mobile','[]',0,'2024-07-07 09:56:35','2024-07-07 09:56:35','2025-07-07 09:56:35'),('c9a021114f6cbb483a03f49e9445cd5b46b214d1ef2d7f0ab4a27bee5c7bafa785f91621c2f43bbc',30,1,'mobile','[]',0,'2024-07-11 11:55:41','2024-07-11 11:55:41','2025-07-11 11:55:41'),('c9e2357421ba23c19f0d4113653062027d88497c3c86447b7ed5ff06db11a6fcb4a3ed403bc0299c',6,1,'mobile','[]',0,'2022-08-09 14:03:39','2022-08-09 14:03:39','2023-08-09 17:03:39'),('ca27685274363a3f4036303d6d65d59268075bb99c26dcb1c44547edf826e9228de2cbd1d899a8a5',22,1,'mobile','[]',0,'2022-06-25 12:37:00','2022-06-25 12:37:00','2023-06-25 12:37:00'),('ca2ed1355183b7bae3415f21469a85ad192bc64b45b5e33ae7a752ba9d58bfc83087edd1d0bd0272',59,1,'mobile','[]',1,'2022-03-10 08:54:49','2022-03-10 08:54:49','2023-03-10 08:54:49'),('ca3afd7b1004868b409b61e538011076f3b9e9cadb206562a356974dcf2dfec10367faf91e9994a5',10,1,'mobile','[]',0,'2022-02-23 13:09:21','2022-02-23 13:09:21','2023-02-23 13:09:21'),('ca8fcf42946c0de3d530d1702a2ee123db608ac816f95e47ca021010b85db426f1b732270187460a',73,1,'mobile','[]',0,'2022-03-17 07:07:00','2022-03-17 07:07:00','2023-03-17 07:07:00'),('ca941b5317bb5f00756c1b94be87e84c02ebf26086bf413a5788bc01c6bbdf0e2f555b0e0be74511',3,1,'mobile','[]',1,'2022-12-08 08:38:28','2022-12-08 08:38:28','2023-12-08 08:38:28'),('cbdcd3b63fe1e64247ab3b386c1c58319db513b5fdfd13a96b0b9f5dc3bfb9ca5bc91ca82c1ea436',1,1,'mobile','[]',0,'2022-02-21 07:48:29','2022-02-21 07:48:29','2023-02-21 07:48:29'),('ccb489b46360461737ecc8553dac35a3afe95655f8799822851a10b862132ab9ce7261b3f39b877f',31,1,'mobile','[]',1,'2022-02-24 08:24:39','2022-02-24 08:24:39','2023-02-24 08:24:39'),('cd01c35807ae85da55081ce07b0a42ddb1bfb03d14c8d7217a4a8a5bb334e6f4ad55017660f5f9f0',1,1,'mobile','[]',0,'2022-03-17 09:43:08','2022-03-17 09:43:08','2023-03-17 09:43:08'),('cde1d894c134e2e0c4fed0045aa111409c00839ee772af6f5b00b22f82bc857770c79d2f870fee8e',11,1,'mobile','[]',0,'2022-10-29 14:36:22','2022-10-29 14:36:22','2023-10-29 17:36:22'),('ce351615f2e58f4e94b652cce373c64832c56ec10b107db01fbcc27c9b9a9f3464b1592c3bf69078',1,1,'mobile','[]',0,'2022-03-24 10:20:01','2022-03-24 10:20:01','2023-03-24 10:20:01'),('ce918563933037778b0fef098bc6da346dabcb5526b01e064bcdbe44917dd43c866512bda1eda83c',24,1,'mobile','[]',0,'2022-06-27 09:20:03','2022-06-27 09:20:03','2023-06-27 09:20:03'),('cf5e1d9beb5cc6d83f5463a0bd0748a0e8ec43e5a65aed5e704220454730452b8e3efb1bd1e2ee52',6,1,'mobile','[]',0,'2022-08-25 08:27:47','2022-08-25 08:27:47','2023-08-25 11:27:47'),('cf60f5dc73e714feba9d415d71dc4f276f41d3f97552e63f9d738bfc3a8f1f1d2c16b71679b62ddb',18,1,'mobile','[]',0,'2024-07-01 12:29:16','2024-07-01 12:29:16','2025-07-01 12:29:16'),('d0237ede7974240a5c0377530491b89f1f747ef2a31a326f25b1f0f21a4783f1798fd9004b4a8080',16,1,'mobile','[]',0,'2024-06-30 09:14:00','2024-06-30 09:14:00','2025-06-30 09:14:00'),('d066c62c3298ccad9e6dedc3dbacfce5de9dc4c5b8cdbf860c400ec0bd60f99c622dcad6ccd5d0ce',1,1,'mobile','[]',1,'2022-03-13 13:25:12','2022-03-13 13:25:12','2023-03-13 13:25:12'),('d0b3358a630036cf13f050c2efeb4a71d542968d92d3bcbc044ab00cba5e965ae16d742dfcc91432',3,1,'mobile','[]',0,'2022-02-16 10:47:13','2022-02-16 10:47:13','2023-02-16 10:47:13'),('d1a32b1433b68fa6b38aee29956162b1aa2dc9db1ec49da12591c481ba11cfb1d0bd461db3f4ac52',1,1,'mobile','[]',0,'2022-02-21 06:37:39','2022-02-21 06:37:39','2023-02-21 06:37:39'),('d1cf5836319881d468740239b7588f27eaefe32edc8a290948a7f1025dc323a75316dbc5b31b93cf',1,1,'mobile','[]',0,'2022-03-15 11:41:25','2022-03-15 11:41:25','2023-03-15 11:41:25'),('d20645bbdeaba4a2fe9bb6e9084a08e2df7343ed1cd5deece4836f5d9197c98e9dbb2170ca3607fa',1,1,'mobile','[]',0,'2022-02-14 10:46:44','2022-02-14 10:46:44','2023-02-14 12:46:44'),('d23cc8a4e28eb000bbd0d27a8b09a1d3b965a3cdcc58cb99d04075bd20036a27d6b0f8933751e258',30,1,'mobile','[]',0,'2024-07-15 08:14:57','2024-07-15 08:14:57','2025-07-15 08:14:57'),('d25da605d8fe15b1cee08455a3ec1e991a8664ab39f4d62007b7a91f59eba2ada3fe3073a8bab0a2',1,1,'mobile','[]',0,'2022-02-17 10:23:09','2022-02-17 10:23:09','2023-02-17 10:23:09'),('d2b8de0cd04e73a42812988a4598f1b000199b23e6a5d960f61e025a0264181d4dddb973ab45abd6',30,1,'mobile','[]',1,'2024-07-08 10:32:31','2024-07-08 10:32:31','2025-07-08 10:32:31'),('d2ccf4064bf810085654f82ec1bf4e60faf73e28e0debd8426c2ca776fd476cd59d8ddf81971ce48',9,1,'mobile','[]',0,'2022-08-17 09:54:23','2022-08-17 09:54:23','2023-08-17 12:54:23'),('d2fb9e0aa348352346dd32d2848057ca0463aa26c2c2b50cbddfd16d92e775b2517bbb11c1678358',30,1,'mobile','[]',1,'2024-07-09 10:52:57','2024-07-09 10:52:57','2025-07-09 10:52:57'),('d393e348a05171be379f63983a809deee21012d28fd0ab8e8f0c104ccdf74f7234e6ca006bd463f1',16,1,'mobile','[]',1,'2024-07-01 11:18:23','2024-07-01 11:18:23','2025-07-01 11:18:23'),('d3bd04b385c1cf4f36f51350ebfe3570ebf1630928dc9e3765a42303d53135c806e72f6108a7c126',4,1,'mobile','[]',0,'2022-08-10 08:55:33','2022-08-10 08:55:33','2023-08-10 11:55:33'),('d457211fea0432dfb7a805cfc2f1d1f2ba22d31b16ee03a76ea19a5ae9ff996b15ee73200b29a244',49,1,'mobile','[]',1,'2022-03-10 07:40:57','2022-03-10 07:40:57','2023-03-10 07:40:57'),('d49e9bafcbe3f4cdbb89bb6cd81c78145517e89925a22a5e1d11f83052cd30ecb0e0fcaf8e7d1bbd',20,1,'mobile','[]',0,'2022-06-23 12:13:29','2022-06-23 12:13:29','2023-06-23 12:13:29'),('d5124dc8bb447f3e7ac82621e7b9aca27f86d03819b7dab2d5896d8466cd75494f5486de5c60e49f',70,1,'mobile','[]',0,'2022-03-14 12:02:37','2022-03-14 12:02:37','2023-03-14 12:02:37'),('d5d8614cc31e9c6b4d7e4d609321e458236028c274e0cd55f3e84dae0dbcd08b87b7cadfa23e2ccb',6,1,'mobile','[]',0,'2023-09-07 05:58:14','2023-09-07 05:58:14','2024-09-07 08:58:14'),('d6239e7c0d74561614d39c2633b94fc1e99de314eb0319e1c26b2e4e4c554610fbb50551f88af6b4',6,1,'mobile','[]',0,'2022-08-11 08:09:23','2022-08-11 08:09:23','2023-08-11 11:09:23'),('d62c9ff5e059ab7ca7e4bdc5d9228d52d0df133861ff67320eb1006684e1f770cc6150e9d4c2bc6c',30,1,'mobile','[]',1,'2024-07-09 15:34:42','2024-07-09 15:34:42','2025-07-09 15:34:42'),('d63eeb067e8fde11d0645f94525cd9c3aecffc9a3462ebe895537512238ff495b7edf0ba58e6946a',2,1,'mobile','[]',0,'2022-10-09 12:35:19','2022-10-09 12:35:19','2023-10-09 15:35:19'),('d6a3cf8ede471b95f8b75080afb5023b841ff4da9d499bb372e64936a30c70af99b49852f597b78a',1,1,'mobile','[]',1,'2022-03-14 07:22:05','2022-03-14 07:22:05','2023-03-14 07:22:05'),('d79b6d2a79c5a224655a91bb411863f4c7e3a6d6c1e87990a6856de7403fde0500d475a08f4bb45e',16,1,'mobile','[]',0,'2024-07-02 12:04:44','2024-07-02 12:04:44','2025-07-02 12:04:44'),('d8b503753b191d3d0248a96c50e054d6e0e8f0e69e017b3a3bde28223e92905ab8a91faa7eba2795',1,1,'mobile','[]',1,'2022-03-17 09:03:54','2022-03-17 09:03:54','2023-03-17 09:03:54'),('d924f538e0d819e38c374946574af1e36468e95b1087c64e331d234db1835d350a9c21c61858f427',31,1,'mobile','[]',0,'2022-02-23 10:13:20','2022-02-23 10:13:20','2023-02-23 10:13:20'),('d931d0d1f12086de0624e719875ecb1729f606c4e8d9964696f1f46aba13257893ac7523866c672c',1,1,'mobile','[]',0,'2022-03-24 09:52:18','2022-03-24 09:52:18','2023-03-24 09:52:18'),('d98418d578be2b47b8a830c1673f623538fd5d4d2db38ec6f4293bd00bc9571815a35bf9876fe4d9',9,1,'mobile','[]',1,'2022-10-25 12:07:13','2022-10-25 12:07:13','2023-10-25 15:07:13'),('d98fe1f9e549198ab7d2ff32893680b531d504a8dd27580dc3782a490f883b627ee76e08ba0a72d8',28,1,'mobile','[]',1,'2022-06-30 17:02:45','2022-06-30 17:02:45','2023-06-30 17:02:45'),('d9952bdf05984ae6e372655c85d2ae15f960eb5405345711c9c112a5885eba63ff383c70481c9c9c',28,1,'mobile','[]',0,'2022-02-23 10:12:07','2022-02-23 10:12:07','2023-02-23 10:12:07'),('da019f2c3fef468aa4ec8ec0f1101886b677decb4bc053014f71a1bf94493033c3dc439a9b21de37',1,1,'mobile','[]',0,'2022-07-25 10:41:40','2022-07-25 10:41:40','2023-07-25 13:41:40'),('da035525530527e0384cc9b030acff35ada183a39154862fe4d00ed3fa7637fa48e2a185393ad4fc',1,1,'mobile','[]',0,'2022-03-15 11:27:30','2022-03-15 11:27:30','2023-03-15 11:27:30'),('da117d4869398422f134a8cc40907d865e5acba0194831c8be5408f32ea7c6098ef185557d84271c',30,1,'mobile','[]',0,'2024-07-15 12:25:34','2024-07-15 12:25:34','2025-07-15 12:25:34'),('da8065ab573001e360e77381ca6be3f9d2da1dc802a2f515753e75efda1eb34ec4addcef5b4578e8',25,1,'mobile','[]',0,'2024-07-02 08:48:55','2024-07-02 08:48:55','2025-07-02 08:48:55'),('daab02fdb098be266b087f84eb304a1a97749254e3b0594dca61aca4e4e407015edce3bd1b74344c',30,1,'mobile','[]',1,'2024-07-03 08:41:24','2024-07-03 08:41:24','2025-07-03 08:41:24'),('db50637e8f87ba06d441308709cd31a77582eecfe6519292c600e9d46f0055a8ac598d42b3399a1e',7,1,'mobile','[]',0,'2022-02-20 11:11:55','2022-02-20 11:11:55','2023-02-20 11:11:55'),('dbcf2b14372c66a6a92f5b808fa78bf4c74e20ff8702ef1aa20d88adca48cf75b65e819c103dcb7d',13,1,'mobile','[]',0,'2024-07-11 10:50:32','2024-07-11 10:50:32','2025-07-11 10:50:32'),('dc2e76627b2f9b35484b7ea66bec2da07940968589a8085eaf170f5f74b325a0f2f31f25273af799',13,1,'mobile','[]',0,'2024-07-14 13:02:53','2024-07-14 13:02:53','2025-07-14 13:02:53'),('dc3560dd9b44d84a3386bc4d2856f775064541acf0b90831ae696328318f8dafdbd52681c2e9bd9f',59,1,'mobile','[]',1,'2022-03-10 08:46:42','2022-03-10 08:46:42','2023-03-10 08:46:42'),('dc412c1cb1507bba40adc3d4fe5885a598421d74fdeadd345e3921102232eb08554a15a505b88fbc',49,1,'mobile','[]',0,'2022-03-10 07:40:13','2022-03-10 07:40:13','2023-03-10 07:40:13'),('dc99f6f7503a34e7868ff06aa16142878c8ba19f722474e269ccaf448ac1574ac6e5127be7c2e159',6,1,'mobile','[]',0,'2022-08-09 14:14:35','2022-08-09 14:14:35','2023-08-09 17:14:35'),('dcadc92e29c902311238921aaae69404a8996697e6e247ee9edff505e622a89d00da5c47c8ecc598',21,1,'mobile','[]',0,'2022-02-22 12:54:05','2022-02-22 12:54:05','2023-02-22 12:54:05'),('dcca9f49ce3a568191160cf00a53489a2be0ddc303c75a74bb26eabfe6ffff3dee38732f8c1fd4c5',1,1,'mobile','[]',0,'2022-02-17 08:33:23','2022-02-17 08:33:23','2023-02-17 08:33:23'),('dcd681b7355e7e5f4fe259422e46b9cc1f6d117a3bd635d55cf89c9fbbb3c444ecda30eca4a002c3',25,1,'mobile','[]',0,'2023-08-31 04:16:27','2023-08-31 04:16:27','2024-08-31 07:16:27'),('ddfcf513eb76ad0152cfbaa4e9399a29d4ff0784cd7e9937aa10694d1869218517cc7b5c6e2fa9de',6,1,'mobile','[]',0,'2022-08-11 08:05:02','2022-08-11 08:05:02','2023-08-11 11:05:02'),('de86fbb923ee72d3556ad32fc1baf2aa9ec5da8f140d1606ea434b7723f906edd4374fac8bf9ab08',3,1,'mobile','[]',0,'2022-06-19 10:46:29','2022-06-19 10:46:29','2023-06-19 10:46:29'),('deae04b07ab82343da38dd82f1bfe207a789a610eae48cd327fdf85edc23185f3b4ebcaf2291d12b',63,1,'mobile','[]',0,'2022-03-10 11:34:36','2022-03-10 11:34:36','2023-03-10 11:34:36'),('ded3888744414304761539acc1586f6f7d6fd8285ec58d663ec58cea057fb58ab0119b4b8f5403ef',16,1,'mobile','[]',0,'2024-07-02 06:16:46','2024-07-02 06:16:46','2025-07-02 06:16:46'),('e01b3e6dd15f75eb11b7b0e313c1c758a17a55e67e1efe93e1399f859118ac14d40b641a3dd5fc55',42,1,'mobile','[]',0,'2024-07-03 14:44:34','2024-07-03 14:44:34','2025-07-03 14:44:34'),('e04cbc1331bd3d0ec526009e4a41a2e8c382a3f5c4272bedc353cf71943c82782ee2190800c8d1ab',2,1,'mobile','[]',0,'2022-10-09 10:33:02','2022-10-09 10:33:02','2023-10-09 13:33:02'),('e0dcb815dec4ac38484028f7a69413fbb35ce1fe984f13103813f9e8c2c7e8d8d585874040a096fc',1,1,'mobile','[]',0,'2022-04-13 12:23:47','2022-04-13 12:23:47','2023-04-13 12:23:47'),('e107f985ed0db9c011058722fdc5abee3852b056b3937441a0df3ee04221a51745c16e0db5c35d05',1,1,'mobile','[]',0,'2022-02-24 09:45:37','2022-02-24 09:45:37','2023-02-24 09:45:37'),('e12f93d5f81a5a30d2312e1575c1a9e03b74fca16adcbd6c2fc76619d5cb28006fd3f027b06f1010',1,1,'mobile','[]',0,'2022-04-20 15:17:26','2022-04-20 15:17:26','2023-04-20 15:17:26'),('e1d4951a075f179c36f41d9fd8e1708f34aee542bfc2937ddb441fc1961ddbba1700653c38d9ee79',16,1,'mobile','[]',1,'2024-07-01 13:30:58','2024-07-01 13:30:58','2025-07-01 13:30:58'),('e1f1e43323eb08b645b2416a3f3ceccffad854e64f8cfa66fc5ce767cd98c06982bc509ce6905414',77,1,'mobile','[]',0,'2022-03-17 11:36:43','2022-03-17 11:36:43','2023-03-17 11:36:43'),('e1f754651049c1c3b7d849f6a31b659f6e29fbe82a49f1038fbc7615fabed24449b67344b3994ce5',76,1,'mobile','[]',1,'2024-07-09 10:04:11','2024-07-09 10:04:11','2025-07-09 10:04:11'),('e21d34ca6de418c385753c9ffa4de7860740da84d6ee4176e3cc8ff5734db961088a594004c90bd7',70,1,'mobile','[]',0,'2022-03-24 07:43:27','2022-03-24 07:43:27','2023-03-24 07:43:27'),('e25d99e410f1198cc42b6d3f10691617fe3bed66613ade0da6ee514d6677f4358dd3a9c8900a81be',1,1,'mobile','[]',0,'2022-03-24 07:51:19','2022-03-24 07:51:19','2023-03-24 07:51:19'),('e2d01fa46f4cbeb23c026d9010cce4b7d1b5466851da2c8199144a26f6f1cabe24262dad9f03e40e',28,1,'mobile','[]',1,'2022-06-30 15:52:41','2022-06-30 15:52:41','2023-06-30 15:52:41'),('e350edd36c4890eed4178ffb09ff83c0c1781ac9cb2f380ac9d6818910ca2c79a58c69ae59f9c68a',50,1,'mobile','[]',0,'2022-03-10 09:08:09','2022-03-10 09:08:09','2023-03-10 09:08:09'),('e3530ecb2f997a18d6978fdac6331fccc295dd5d851d6e1c049f2349181f4292e8f4edcbddc63401',49,1,'mobile','[]',1,'2022-03-10 06:56:44','2022-03-10 06:56:44','2023-03-10 06:56:44'),('e3f92392664f21309dde519013b34e675c1b2dd03457bcb211d36ef580e8be75a400a1195ddde807',3,1,'mobile','[]',0,'2022-04-25 13:29:35','2022-04-25 13:29:35','2023-04-25 13:29:35'),('e46c8605c06e99c470ce2ffca6c799b031970a898bc223a8381a16e80b24e88360b265ea8ee0a661',50,1,'mobile','[]',1,'2022-03-10 09:08:29','2022-03-10 09:08:29','2023-03-10 09:08:29'),('e4b64598df0e734af2827ae12651973027d7b7dd61170f19a810b51d313a59d354d57d86a187a089',8,1,'mobile','[]',0,'2023-06-22 06:44:33','2023-06-22 06:44:33','2024-06-22 09:44:33'),('e4c536a23c0fcdba2b47ce8efdc4cfd839d1666008f9e5baffda387ce4158398b27f992d96d96b5a',54,1,'mobile','[]',1,'2022-03-10 07:57:01','2022-03-10 07:57:01','2023-03-10 07:57:01'),('e5ba77d7387d3cc84fa48e94f48f928b358757b09e0d32a93ced99e8e7f27a623657084b42b46ecb',28,1,'mobile','[]',0,'2024-07-02 12:07:13','2024-07-02 12:07:13','2025-07-02 12:07:13'),('e5e6b89bd52fc3b861a22e99ea9b5ac9630d4c773a04469de789847deed1492c1bfc6ee83b65a1b7',3,1,'mobile','[]',0,'2022-05-10 08:43:35','2022-05-10 08:43:35','2023-05-10 08:43:35'),('e674880dd87d0ba115d0620d614d76d2ae7f7dc2da8f241ebce85714c0d2cf358db8de9ee132ad29',1,1,'mobile','[]',0,'2022-02-17 13:21:44','2022-02-17 13:21:44','2023-02-17 13:21:44'),('e7b512915604b903d5c474c448c297248917a0b112022c00ea9f37bfbe2d390d35ecaeaeb3473f52',30,1,'mobile','[]',1,'2024-07-09 15:07:18','2024-07-09 15:07:18','2025-07-09 15:07:18'),('e7fcdfc130ea7233a78a84f7301fc38074abd2e7418d1416dc4dbd4f7bb005167498f0e5b9fdb168',6,1,'mobile','[]',0,'2022-08-11 07:06:21','2022-08-11 07:06:21','2023-08-11 10:06:21'),('e8f0dd1e9a6f3aa9417ad2e0a700c28a77c63555174a9473dc9bc7b3151998b686bc105c99f936c3',49,1,'mobile','[]',0,'2022-03-10 07:40:47','2022-03-10 07:40:47','2023-03-10 07:40:47'),('e94b65e25e7374c0c558ac91b98d37aa85ae0a4b4de2736be899f5a170bab8e3eda6bcbe77dd0c3d',1,1,'mobile','[]',0,'2022-03-16 13:18:42','2022-03-16 13:18:42','2023-03-16 13:18:42'),('e9c65b9d8608f6929bf8c63ad8d2d3afbaaa85077f3bf1a08a0d3ddc0515f5edc37936ff3d0e87cf',9,1,'mobile','[]',0,'2023-08-04 06:21:43','2023-08-04 06:21:43','2024-08-04 09:21:43'),('e9dfe812d214cfae2e0ab80fa2ff41f3f48a5196646a97ac17019ed3528745d6b3d40d92cef5e104',14,1,'mobile','[]',0,'2022-06-14 10:47:24','2022-06-14 10:47:24','2023-06-14 10:47:24'),('ea26e52eb32853506b74a817f7d6cb74221c5f8cef41d97ccc5221fe0a0e0407d561c038d3868319',15,1,'mobile','[]',1,'2024-06-27 12:21:31','2024-06-27 12:21:31','2025-06-27 12:21:31'),('ea734eebb40ad7bb07e3c2f68651ba85e5005431026c03867ea8c2024f51d280af3a749d2a07d682',1,1,'mobile','[]',1,'2022-03-10 08:54:28','2022-03-10 08:54:28','2023-03-10 08:54:28'),('eaa11465755b9cacc104e205e1a3de2583d879bd1b2ce90b8673ebd6d1de9dfdfa3ad79839d18f4c',13,1,'mobile','[]',0,'2024-07-08 10:59:29','2024-07-08 10:59:29','2025-07-08 10:59:29'),('eb296e1e5df1a8cb75cc2b81c28fa44685b636a37d2c4d703700e6b5843c771cb9b1b8217324cb5e',4,1,'mobile','[]',0,'2022-07-26 10:03:46','2022-07-26 10:03:46','2023-07-26 13:03:46'),('eb4c1df4f3e961bb000df9d75714eb0551580db2f7b5187729de8544d141be7654b813e319f1d3dd',66,1,'mobile','[]',0,'2024-07-04 09:50:27','2024-07-04 09:50:27','2025-07-04 09:50:27'),('eb53e7a10ad208844179d081cc1780bef74e109bc29017efb56526b462fce3987e57789aa28858f2',10,1,'mobile','[]',0,'2022-02-22 11:59:00','2022-02-22 11:59:00','2023-02-22 11:59:00'),('eb6b68aa864d44010f1004639b4ef4a924c7e9921e4ef9743714f41d017eafe5e88d2e23198bf531',1,1,'mobile','[]',0,'2022-02-17 10:27:37','2022-02-17 10:27:37','2023-02-17 10:27:37'),('eb7bed4c4ed67341ad1a4f192c263e635f0598c2fd29656c77455571fe7fbdc3afb98845cd713230',10,1,'mobile','[]',0,'2022-05-10 11:55:31','2022-05-10 11:55:31','2023-05-10 11:55:31'),('ebee157b87ed0681bf256f8b4f9d4735b754c56ae32c397b0152b6c95d68c7935eceb760f0a2a2d6',4,1,'mobile','[]',0,'2022-03-24 08:17:04','2022-03-24 08:17:04','2023-03-24 08:17:04'),('ec404369427e379eff4d02bccae3a49fc6e8052b6d07054b92ad5fc78a889ab070ce8001f98eb40d',67,1,'mobile','[]',0,'2022-03-10 11:59:01','2022-03-10 11:59:01','2023-03-10 11:59:01'),('eca3280247b59e0ac0f074a822082b0ac31eab5e39c20c612ea172454865d944cc22a923e160aee2',4,1,'mobile','[]',0,'2022-07-18 11:36:48','2022-07-18 11:36:48','2023-07-18 14:36:48'),('ed8be1a41b8966daf330d160a34b23623f34c53339cd933e1f833a3e79ff16da4a2e00e078f90fb7',63,1,'mobile','[]',0,'2022-03-10 11:22:38','2022-03-10 11:22:38','2023-03-10 11:22:38'),('edd9ca6d454276e29edd8fbe79bd51802b5e81130711ffd32c32333f9f71dbd243cdc95b6e6a29a7',31,1,'mobile','[]',1,'2022-02-27 07:09:46','2022-02-27 07:09:46','2023-02-27 07:09:46'),('ee7ed6bd560692afe6bde780a7ed2fd23c9d8a9618a4af1715b1303a8b28532f77a36f161321af98',30,1,'mobile','[]',1,'2024-07-09 15:42:12','2024-07-09 15:42:12','2025-07-09 15:42:12'),('ef073382cb9540695abc0764f1681ce72b77eeed194555e0ad51abd1e1b181e8bdaca44872dd8553',9,1,'mobile','[]',0,'2023-07-28 10:53:24','2023-07-28 10:53:24','2024-07-28 13:53:24'),('ef44c355615a5778082c32e8acac399e3de2093a325faba68075ee73222f361a35fe6f8a4d2f77d4',17,1,'mobile','[]',0,'2022-06-22 15:05:30','2022-06-22 15:05:30','2023-06-22 15:05:30'),('f0137d2ff6c0b4717fab56eac3b4f8afd9a29652ff7345b762eed93ec433a7e8f2b4b232554efa7b',2,1,'mobile','[]',1,'2022-10-10 07:03:46','2022-10-10 07:03:46','2023-10-10 10:03:46'),('f099752b58a867860b83f031338ad292b7ac5d97d0e9365e5b1ea58ed2d3f930c94335776984fbd5',7,1,'mobile','[]',0,'2022-10-26 06:03:07','2022-10-26 06:03:07','2023-10-26 09:03:07'),('f125e8bbab4ae471c460b0a278ec1d020d3a3e46105c47e74e89d7e4bd57efa7630e3ecace302036',1,1,'mobile','[]',0,'2022-03-02 12:31:19','2022-03-02 12:31:19','2023-03-02 12:31:19'),('f1d077fe5ef716b40ce3baa9cf1565a70899f40233ee8f33810b2f5c44a66b070599f6a8ccc14b2d',14,1,'mobile','[]',0,'2022-06-19 15:49:16','2022-06-19 15:49:16','2023-06-19 15:49:16'),('f1ee1c2e6791e4992c4d1cdf7644f3f8e25d7215064183b137f1582f3d6e9a9d9338f2a126992f38',41,1,'mobile','[]',0,'2024-07-03 14:28:17','2024-07-03 14:28:17','2025-07-03 14:28:17'),('f32dbc4cb3814b86c607826a2a5c4478887203e4531e255c265b4daf964893cc6441a0f188892150',9,1,'mobile','[]',0,'2023-08-04 05:43:48','2023-08-04 05:43:48','2024-08-04 08:43:48'),('f32dd7fcf8810eea7b2f30d214bca7d76ed605953624c8e998159e878ee0510bbd33827c5b085711',4,1,'mobile','[]',1,'2023-02-15 10:02:32','2023-02-15 10:02:32','2024-02-15 10:02:32'),('f34b264f2ef071fbc65a5d23255079f8c12bb07da89aecdefbd56948f95c8fa28ec3d44b16d9ce62',13,1,'mobile','[]',0,'2022-06-14 12:37:47','2022-06-14 12:37:47','2023-06-14 12:37:47'),('f37d22f47e5fbeb3154849e39573d5ea2ff2f303f8cdc57575388cdaee6e2eeb7a8d06bf25392b71',2,1,'mobile','[]',0,'2022-04-13 11:05:07','2022-04-13 11:05:07','2023-04-13 11:05:07'),('f393240613cb315fc4fcfee46c375ed4e07bf8b812520020aeae1d6e5afd3151b1762196e857a18c',4,1,'mobile','[]',0,'2022-08-29 09:58:13','2022-08-29 09:58:13','2023-08-29 12:58:13'),('f3a7b628ed4cb285b9b43990727a0648514e50315a5af5833a6018de03e026fe44f9e11a244c11c2',2,1,'mobile','[]',0,'2022-10-10 07:26:23','2022-10-10 07:26:23','2023-10-10 10:26:23'),('f3d5bafcad79ca9c14bf4407dee91f878af8453c3b8fcc889a99fa0dfc811a9e829e28e8e15d0f76',3,1,'mobile','[]',0,'2022-06-15 12:15:50','2022-06-15 12:15:50','2023-06-15 12:15:50'),('f4286db1512832c33d2747d73d65f96665ece6389ff82c706d6762744da220e3070939f17548a98d',36,1,'mobile','[]',0,'2022-02-28 09:30:07','2022-02-28 09:30:07','2023-02-28 09:30:07'),('f46bf8f753f8f8032d855959a693736d5419bbc9c6d2df70e3889e0535a2a3969591d8459766fbc6',1,1,'mobile','[]',0,'2022-02-17 10:21:17','2022-02-17 10:21:17','2023-02-17 10:21:17'),('f4c4fe1d9711e9b5474732338ec54e560daf8e21e56c97740368943aa8e66ad2df51c7f13f5daeba',7,1,'mobile','[]',0,'2022-03-24 10:41:15','2022-03-24 10:41:15','2023-03-24 10:41:15'),('f554a5edcf800fdda9812decfc4e1f2cdf1e92d522bd50a2648865101a6795f825de3652f89873ce',3,1,'mobile','[]',0,'2022-05-17 09:55:23','2022-05-17 09:55:23','2023-05-17 09:55:23'),('f66e86268552fd35a0b76afcacde5d5c0b8dba1c258b36e8d45b2827d0a256b6fa0e6c2d5d141f48',1,1,'mobile','[]',0,'2022-10-04 09:03:28','2022-10-04 09:03:28','2023-10-04 12:03:28'),('f67af720141ddf48e0c45336f790c74e590706c8483d107978171c4665783c213b4e2eebe2750709',4,1,'mobile','[]',0,'2022-10-09 10:25:06','2022-10-09 10:25:06','2023-10-09 13:25:06'),('f75d285e27b30031726ea3bb8766a597d5ba3bfc3cbc5baba9430172d1b1ce95fd737e860e9efb9d',2,1,'mobile','[]',1,'2022-03-24 08:29:59','2022-03-24 08:29:59','2023-03-24 08:29:59'),('f773bf41b6b84a3333e6b761a753fd8a2c38b94b9f6bc992a6151cae030af2b459bf591bb65c0eac',1,1,'mobile','[]',0,'2022-03-14 07:28:09','2022-03-14 07:28:09','2023-03-14 07:28:09'),('f7796b75575c611ad043f4ec07132d103ea040d96f41abd2b2e3bed6b8fd9ef448dbf94042160f1b',1,1,'mobile','[]',0,'2022-02-17 10:23:04','2022-02-17 10:23:04','2023-02-17 10:23:04'),('f7c94bdef4f2a75d4387da7d189f08fbd9180f3aca95f3dd8d950bb66b50988728c5e112cfef4008',1,1,'mobile','[]',0,'2022-04-13 16:17:15','2022-04-13 16:17:15','2023-04-13 16:17:15'),('f8297c44a01750eb63db9dd5c3380d913445ac3320034774ca11b546b2eaab817913428571900f52',10,1,'mobile','[]',0,'2022-03-24 13:10:31','2022-03-24 13:10:31','2023-03-24 13:10:31'),('f849d9ce0f7853653fd6ebbada1f3e37bb172bd707906b1f604cd9fb79e5bc5abdcbe98838cae9bf',14,1,'mobile','[]',0,'2022-06-27 08:44:11','2022-06-27 08:44:11','2023-06-27 08:44:11'),('f959757c6667bb5af13c4d3dc345be1d7089966f6dadadd385c76de39354326892f42c47facdb712',40,1,'mobile','[]',0,'2023-08-27 04:41:30','2023-08-27 04:41:30','2024-08-27 07:41:30'),('f992dbcd2ef7985839163761a12bcfc2c972e7af0652de89759f4eb7e3fee96f2a769c9fc02a5a41',7,1,'mobile','[]',1,'2022-10-25 07:09:40','2022-10-25 07:09:40','2023-10-25 10:09:40'),('f99c2400a11af5b623d89e8c694c92c54f4ad0cee66291dd876a3625693e4c2ba65528adff3e0e0e',31,1,'mobile','[]',0,'2022-02-23 10:11:31','2022-02-23 10:11:31','2023-02-23 10:11:31'),('fa165f8d49c97fdfab72fe0e43e2ec33f95c5354fa9a6d1ce4d654ba3a6ee6431b40c73711bc9acd',9,1,'mobile','[]',0,'2023-08-21 04:34:36','2023-08-21 04:34:36','2024-08-21 07:34:36'),('fa32692dec121fa497d074217920291e609644354131b3aabfe5e2c88d730e70caa925b0e20d4d1f',1,1,'mobile','[]',0,'2022-03-15 11:30:17','2022-03-15 11:30:17','2023-03-15 11:30:17'),('fa95d0ebd2e925fe5354d84810fae93670287b425f2c014e3f44ccc9b00c7052f81aad95f08cc418',7,1,'mobile','[]',0,'2024-07-02 12:52:36','2024-07-02 12:52:36','2025-07-02 12:52:36'),('faa7146685ed5d0c0c1578e2774f12dd11babc3215f3d8bf959040166a280df95e73720bf68fad0e',1,1,'mobile','[]',0,'2022-02-17 09:46:01','2022-02-17 09:46:01','2023-02-17 09:46:01'),('fab0e89c873735a7ef504a77a2db8b047cd1b245a82634e10169d44ccaa594c3103138634671786d',6,1,'mobile','[]',0,'2023-09-07 09:19:15','2023-09-07 09:19:15','2024-09-07 12:19:15'),('fb48e3fb83fec5694fa3d4bd31558fa2d7e453d0e21c7195661b2a474b01f82a2bde10126caa4cd8',6,1,'mobile','[]',0,'2023-09-07 09:19:05','2023-09-07 09:19:05','2024-09-07 12:19:05'),('fb5035e3899735229d66bead53397d98337cd30864438369d4d8b240b927123c5d11869cc4d21dc5',80,1,'mobile','[]',0,'2022-03-23 08:01:25','2022-03-23 08:01:25','2023-03-23 08:01:25'),('fb89727c28092b396b6d9db210bfc841d94c350e25dfe3ae3de0465e8bc5794c2821ca1cc8736daf',30,1,'mobile','[]',0,'2024-07-04 13:47:56','2024-07-04 13:47:56','2025-07-04 13:47:56'),('fbb3e19842eebb0417150ab9a245810f1a0917d0d19124a06fe61c8b5ab2ec0d77aeb6933327e4f7',8,1,'mobile','[]',0,'2023-07-23 09:26:58','2023-07-23 09:26:58','2024-07-23 12:26:58'),('fc799e01e8fe2f2afdd8b6834c8ab4d5aa66be37dc28fbec1024e917dcc2f37ed329ef941d5a827b',6,1,'mobile','[]',0,'2022-02-20 11:06:51','2022-02-20 11:06:51','2023-02-20 11:06:51'),('fd4f0380bd394e82e232dd1666202388617d3c52e0342874fe879da322e7f398b29f47e63031904c',13,1,'mobile','[]',1,'2024-06-27 10:20:18','2024-06-27 10:20:18','2025-06-27 10:20:18'),('fda279386cb2271fae5108f3948dd37456ff2cb68675159a84c8a7611203729cc6cd2aaa4cfa3de8',30,1,'mobile','[]',0,'2024-07-11 10:49:25','2024-07-11 10:49:25','2025-07-11 10:49:25'),('fda69b9f2ba201fcc3eabdc4b4fa069c16fd7e063bc5cc64cb783338e680c85b3da77def55a92405',3,1,'mobile','[]',0,'2022-03-24 08:07:57','2022-03-24 08:07:57','2023-03-24 08:07:57'),('fe18959c514a769aa3bfb63790c5e109ef380f51f6a6c31131534a2e6443b68506eca3545271d4e1',6,1,'mobile','[]',0,'2023-09-07 05:42:16','2023-09-07 05:42:16','2024-09-07 08:42:16'),('fe19039e54a7b17f417b696a93e63e9afee9da8c474988d7736df4f37ebe85c3cd6d451b20a6af0c',3,1,'mobile','[]',0,'2022-04-21 12:55:10','2022-04-21 12:55:10','2023-04-21 12:55:10'),('fe6ebac7fec9a546ae513c27cd944a43becd44c04e15717b4e8c72be2bbb80c5c74c2af70f2209df',3,1,'mobile','[]',1,'2022-12-08 08:39:41','2022-12-08 08:39:41','2023-12-08 08:39:41'),('fe70d41fe1d9f35ab4095b37feeb9ed706dfe56ac7cbf48417941b664d710ff6fc5e3c01850ed301',28,1,'mobile','[]',0,'2022-02-23 09:26:39','2022-02-23 09:26:39','2023-02-23 09:26:39'),('fe743ed6895a3303af84eb798ece0c05d83cd90391b93412c8590266040ab6a23a843eb27039bb66',22,1,'mobile','[]',0,'2022-06-25 12:43:55','2022-06-25 12:43:55','2023-06-25 12:43:55'),('ff44f9a2cc8d1f3944be063266130bb03db0ddf275702a2d15a5070a78fb18d8eb565a9f97802b83',7,1,'mobile','[]',0,'2024-07-01 07:22:30','2024-07-01 07:22:30','2025-07-01 07:22:30'),('ff5c9b86d5a0ea7d48f903446bbb227927fa881077307713db15813f20ecdf3a4a11122c67f214fe',1,1,'mobile','[]',0,'2022-02-14 10:51:27','2022-02-14 10:51:27','2023-02-14 12:51:27'),('ff8d09005b32060f3d1ade33f4fabd1cca333d22412edd5a0df8b63a726ade57730c931e44732647',1,1,'mobile','[]',1,'2022-03-10 08:37:26','2022-03-10 08:37:26','2023-03-10 08:37:26'),('ffa7dba42f4f573d1d872908dfca48d75cd0569e918e32f927004b17788f03ca329c3e758ba8534d',7,1,'mobile','[]',0,'2024-07-01 06:14:22','2024-07-01 06:14:22','2025-07-01 06:14:22');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `client_id` int NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Laravel Personal Access Client','b5R7r18pfp92zTbIeNbcAEUnUOKAFj4RF26OQBQ9','http://localhost',1,0,0,'2018-04-04 05:12:13','2018-04-04 05:12:13'),(2,NULL,'Laravel Password Grant Client','8FeNSQNGX4ImJ1IScKBaEi1XzD76DFIifSRBjn9j','http://localhost',0,1,0,'2018-04-04 05:12:13','2018-04-04 05:12:13');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2018-04-04 05:12:13','2018-04-04 05:12:13');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `discount` double DEFAULT '0',
  `price` double NOT NULL,
  `offer_price` double NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_products_order_id_foreign` (`order_id`),
  KEY `order_products_product_id_foreign` (`product_id`),
  CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_products`
--

LOCK TABLES `order_products` WRITE;
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
INSERT INTO `order_products` VALUES (1,11,4,1,0,100,0,'2024-06-04 10:32:37','2024-06-04 10:32:37',NULL),(2,12,4,1,0,100,0,'2024-06-04 12:54:50','2024-06-04 12:54:50',NULL),(3,13,4,1,0,100,0,'2024-06-04 13:05:18','2024-06-04 13:05:18',NULL),(4,14,3,1,0,922,46,'2024-06-05 09:42:17','2024-06-05 09:42:17',NULL),(5,15,3,1,0,922,46,'2024-06-05 11:05:41','2024-06-05 11:05:41',NULL),(6,16,3,1,0,922,46,'2024-06-05 11:10:52','2024-06-05 11:10:52',NULL),(7,17,3,1,0,922,46,'2024-06-05 11:13:57','2024-06-05 11:13:57',NULL),(8,18,3,1,0,922,46,'2024-06-05 12:25:00','2024-06-05 12:25:00',NULL),(9,18,4,1,0,100,0,'2024-06-05 12:25:00','2024-06-05 12:25:00',NULL),(10,19,3,1,0,922,46,'2024-06-05 12:45:07','2024-06-05 12:45:07',NULL),(11,20,3,1,0,922,46,'2024-06-05 12:52:08','2024-06-05 12:52:08',NULL),(12,21,3,1,0,922,46,'2024-06-05 12:52:45','2024-06-05 12:52:45',NULL),(13,22,4,1,0,100,0,'2024-06-05 12:54:10','2024-06-05 12:54:10',NULL),(14,23,4,1,0,100,0,'2024-06-05 12:54:55','2024-06-05 12:54:55',NULL),(15,24,5,1,0,10,2,'2024-06-27 10:21:44','2024-06-27 10:21:44',NULL),(16,26,6,2,0,100,90,'2024-06-27 11:41:40','2024-06-27 11:41:40',NULL),(17,27,6,1,0,100,90,'2024-06-27 12:24:52','2024-06-27 12:24:52',NULL),(18,28,6,1,0,100,90,'2024-06-30 09:34:25','2024-06-30 09:34:25',NULL),(19,29,7,1,0,10,5,'2024-07-01 12:26:50','2024-07-01 12:26:50',NULL),(20,30,7,1,0,10,5,'2024-07-01 12:29:16','2024-07-01 12:29:16',NULL),(21,31,7,1,0,10,5,'2024-07-01 12:42:44','2024-07-01 12:42:44',NULL),(22,32,7,1,0,10,5,'2024-07-01 12:48:51','2024-07-01 12:48:51',NULL),(23,33,7,1,0,10,5,'2024-07-01 12:54:05','2024-07-01 12:54:05',NULL),(24,34,7,1,0,10,5,'2024-07-01 13:09:56','2024-07-01 13:09:56',NULL),(25,35,7,1,0,10,5,'2024-07-02 05:07:03','2024-07-02 05:07:03',NULL),(26,36,7,1,0,10,5,'2024-07-02 05:08:57','2024-07-02 05:08:57',NULL),(27,37,7,1,0,10,5,'2024-07-02 05:22:45','2024-07-02 05:22:45',NULL),(28,38,7,1,0,10,5,'2024-07-02 05:39:33','2024-07-02 05:39:33',NULL),(29,39,7,1,0,10,5,'2024-07-02 05:46:10','2024-07-02 05:46:10',NULL),(30,40,7,1,0,10,5,'2024-07-02 06:09:36','2024-07-02 06:09:36',NULL),(31,41,7,1,0,10,5,'2024-07-02 06:45:52','2024-07-02 06:45:52',NULL),(32,42,6,1,0,100,90,'2024-07-02 07:36:37','2024-07-02 07:36:37',NULL),(33,43,7,1,0,10,5,'2024-07-02 08:42:34','2024-07-02 08:42:34',NULL),(34,44,6,1,0,100,90,'2024-07-02 08:48:55','2024-07-02 08:48:55',NULL),(35,45,7,1,0,10,5,'2024-07-02 08:54:20','2024-07-02 08:54:20',NULL),(36,46,6,1,0,100,90,'2024-07-02 09:10:49','2024-07-02 09:10:49',NULL),(37,47,6,1,0,100,90,'2024-07-02 09:13:45','2024-07-02 09:13:45',NULL),(38,48,7,1,0,10,5,'2024-07-02 10:07:59','2024-07-02 10:07:59',NULL),(39,48,6,1,0,100,90,'2024-07-02 10:07:59','2024-07-02 10:07:59',NULL),(40,49,6,1,0,100,90,'2024-07-03 10:01:36','2024-07-03 10:01:36',NULL),(41,49,5,2,0,10,2,'2024-07-03 10:01:36','2024-07-03 10:01:36',NULL),(42,50,6,1,0,100,90,'2024-07-03 12:56:12','2024-07-03 12:56:12',NULL),(43,51,6,1,0,100,90,'2024-07-03 13:08:53','2024-07-03 13:08:53',NULL),(44,52,6,1,0,100,90,'2024-07-03 13:10:59','2024-07-03 13:10:59',NULL),(45,53,6,1,0,100,90,'2024-07-03 13:14:48','2024-07-03 13:14:48',NULL),(46,54,6,1,0,100,90,'2024-07-03 13:29:34','2024-07-03 13:29:34',NULL),(47,55,6,1,0,100,90,'2024-07-03 13:35:35','2024-07-03 13:35:35',NULL),(48,56,6,1,0,100,90,'2024-07-03 13:39:51','2024-07-03 13:39:51',NULL),(49,57,6,1,0,100,90,'2024-07-03 13:48:06','2024-07-03 13:48:06',NULL),(50,58,6,1,0,100,90,'2024-07-03 13:54:04','2024-07-03 13:54:04',NULL),(51,59,6,1,0,100,90,'2024-07-03 13:58:10','2024-07-03 13:58:10',NULL),(52,60,6,1,0,100,90,'2024-07-03 14:01:54','2024-07-03 14:01:54',NULL),(53,61,6,1,0,100,90,'2024-07-03 14:15:21','2024-07-03 14:15:21',NULL),(54,62,6,1,0,100,90,'2024-07-03 14:21:53','2024-07-03 14:21:53',NULL),(55,63,5,1,0,10,2,'2024-07-03 14:23:44','2024-07-03 14:23:44',NULL),(56,64,5,1,0,10,2,'2024-07-03 14:25:48','2024-07-03 14:25:48',NULL),(57,65,6,1,0,100,90,'2024-07-03 14:28:17','2024-07-03 14:28:17',NULL),(58,66,6,1,0,100,90,'2024-07-03 14:44:34','2024-07-03 14:44:34',NULL),(59,67,6,1,0,100,90,'2024-07-03 14:47:54','2024-07-03 14:47:54',NULL),(60,68,6,1,0,100,90,'2024-07-03 14:51:21','2024-07-03 14:51:21',NULL),(61,69,6,1,0,100,90,'2024-07-03 14:53:12','2024-07-03 14:53:12',NULL),(62,70,6,1,0,100,90,'2024-07-03 15:02:45','2024-07-03 15:02:45',NULL),(63,71,6,1,0,100,90,'2024-07-03 15:19:57','2024-07-03 15:19:57',NULL),(64,72,6,1,0,100,90,'2024-07-03 15:25:31','2024-07-03 15:25:31',NULL),(65,73,6,1,0,100,90,'2024-07-04 06:19:21','2024-07-04 06:19:21',NULL),(66,74,6,1,0,100,90,'2024-07-04 06:25:29','2024-07-04 06:25:29',NULL),(67,75,6,1,0,100,90,'2024-07-04 06:28:55','2024-07-04 06:28:55',NULL),(68,76,6,1,0,100,90,'2024-07-04 06:32:04','2024-07-04 06:32:04',NULL),(69,77,6,1,0,100,90,'2024-07-04 06:37:54','2024-07-04 06:37:54',NULL),(70,78,6,1,0,100,90,'2024-07-04 06:43:13','2024-07-04 06:43:13',NULL),(71,79,6,1,0,100,90,'2024-07-04 06:46:11','2024-07-04 06:46:11',NULL),(72,80,5,1,0,10,2,'2024-07-04 06:57:10','2024-07-04 06:57:10',NULL),(73,81,5,1,0,10,2,'2024-07-04 07:20:14','2024-07-04 07:20:14',NULL),(74,82,5,1,0,10,2,'2024-07-04 07:23:42','2024-07-04 07:23:42',NULL),(75,83,5,1,0,10,2,'2024-07-04 07:42:52','2024-07-04 07:42:52',NULL),(76,84,5,1,0,10,2,'2024-07-04 08:50:17','2024-07-04 08:50:17',NULL),(77,85,5,1,0,10,2,'2024-07-04 08:57:28','2024-07-04 08:57:28',NULL),(78,86,5,1,0,10,2,'2024-07-04 09:03:32','2024-07-04 09:03:32',NULL),(79,87,5,1,0,10,2,'2024-07-04 09:06:55','2024-07-04 09:06:55',NULL),(80,88,5,1,0,10,2,'2024-07-04 09:17:36','2024-07-04 09:17:36',NULL),(81,89,5,1,0,10,2,'2024-07-04 09:23:15','2024-07-04 09:23:15',NULL),(82,90,5,1,0,10,2,'2024-07-04 09:50:27','2024-07-04 09:50:27',NULL),(83,91,5,1,0,10,2,'2024-07-04 09:53:59','2024-07-04 09:53:59',NULL),(84,92,5,1,0,10,2,'2024-07-04 09:59:34','2024-07-04 09:59:34',NULL),(85,93,5,1,0,10,2,'2024-07-04 10:04:26','2024-07-04 10:04:26',NULL),(86,94,5,1,0,10,2,'2024-07-04 10:06:19','2024-07-04 10:06:19',NULL),(87,95,5,1,0,10,2,'2024-07-04 10:07:29','2024-07-04 10:07:29',NULL),(88,96,5,1,0,10,2,'2024-07-04 10:08:57','2024-07-04 10:08:57',NULL),(89,97,6,1,0,100,90,'2024-07-04 10:28:47','2024-07-04 10:28:47',NULL),(90,98,6,1,0,100,90,'2024-07-04 10:29:44','2024-07-04 10:29:44',NULL),(91,99,6,1,0,100,90,'2024-07-04 10:30:25','2024-07-04 10:30:25',NULL),(92,100,6,1,0,100,90,'2024-07-04 10:49:45','2024-07-04 10:49:45',NULL),(93,101,6,1,0,100,90,'2024-07-04 10:50:12','2024-07-04 10:50:12',NULL),(94,102,5,1,0,10,2,'2024-07-04 11:34:43','2024-07-04 11:34:43',NULL),(95,103,5,1,0,100,50,'2024-07-07 06:22:32','2024-07-07 06:22:32',NULL),(96,104,9,1,0,100,0,'2024-07-08 10:32:32','2024-07-08 10:32:32',NULL),(97,105,9,1,0,100,0,'2024-07-08 10:38:48','2024-07-08 10:38:48',NULL),(98,106,10,1,0,100,50,'2024-07-08 10:57:15','2024-07-08 10:57:15',NULL),(99,107,5,1,0,100,50,'2024-07-09 14:30:05','2024-07-09 14:30:05',NULL),(100,108,5,1,0,100,50,'2024-07-09 14:33:13','2024-07-09 14:33:13',NULL),(101,109,5,1,0,100,50,'2024-07-09 14:35:56','2024-07-09 14:35:56',NULL),(102,110,5,1,0,100,50,'2024-07-09 14:38:19','2024-07-09 14:38:19',NULL),(103,111,5,1,0,100,50,'2024-07-09 14:40:10','2024-07-09 14:40:10',NULL),(104,112,5,1,0,100,50,'2024-07-09 14:40:10','2024-07-09 14:40:10',NULL),(105,113,5,1,0,100,50,'2024-07-09 14:46:01','2024-07-09 14:46:01',NULL),(106,114,5,1,0,100,50,'2024-07-09 14:47:57','2024-07-09 14:47:57',NULL),(107,115,5,1,0,100,50,'2024-07-09 14:56:27','2024-07-09 14:56:27',NULL),(108,116,5,1,0,100,50,'2024-07-09 14:58:58','2024-07-09 14:58:58',NULL),(109,117,5,1,0,100,50,'2024-07-09 15:05:15','2024-07-09 15:05:15',NULL),(110,118,5,1,0,100,50,'2024-07-09 15:09:18','2024-07-09 15:09:18',NULL),(111,119,5,1,0,100,50,'2024-07-09 15:21:59','2024-07-09 15:21:59',NULL),(112,120,5,1,0,100,50,'2024-07-09 15:27:38','2024-07-09 15:27:38',NULL),(113,121,10,1,0,100,50,'2024-07-10 09:52:26','2024-07-10 09:52:26',NULL);
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `total` double DEFAULT NULL,
  `vat_percent` double DEFAULT NULL,
  `vat_amount` double DEFAULT NULL,
  `app_percent` double DEFAULT NULL,
  `address_id` int DEFAULT NULL,
  `app_total` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `delivery_cost` double DEFAULT NULL,
  `discount_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `sub_total` double DEFAULT NULL,
  `count_items` int DEFAULT NULL,
  `fcm_token` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_id` int NOT NULL,
  `address_type` int DEFAULT NULL,
  `block` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avenue` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_number` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landmark` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_name` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `availabile_date` date DEFAULT NULL,
  `availabile_time` time DEFAULT NULL,
  `payment_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payment_method` int DEFAULT NULL,
  `payment_status` int DEFAULT '0',
  `status` int NOT NULL DEFAULT '0' COMMENT '0->new , 1->in_process , 2->on Delivery ,3->completed',
  `ordered_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_area_id_foreign` (`area_id`),
  CONSTRAINT `orders_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,162,5,0,NULL,1,NULL,0,2,'',160,1,NULL,'yash','yash@hamiltonkw.com',2,NULL,'007','kuwait',NULL,'01','8209528643',NULL,'yash',NULL,NULL,NULL,NULL,0,2,'2024-07-08 11:01:06','2024-07-08 11:01:06','2024-07-08 11:01:06',NULL),(2,2,12,5,0,NULL,2,NULL,0,4,'',8,1,NULL,'Karina Glenn','ziji@mailinator.com',4,NULL,NULL,'Suscipit aliqua Sed',NULL,NULL,'7845123690',NULL,'Kylynn Hopkins',NULL,NULL,NULL,NULL,0,0,'2023-10-29 07:30:12','2023-10-29 07:30:12','2023-10-29 07:30:12',NULL),(3,3,42,5,0,NULL,3,NULL,0,2,'',40,1,NULL,'test Tailor','yash.tailor23@gmail.com',2,NULL,NULL,'Testing',NULL,NULL,'08209528643',NULL,'Testing',NULL,NULL,NULL,NULL,0,0,'2023-10-30 08:51:19','2023-10-30 08:51:19','2023-10-30 08:51:19',NULL),(4,1,22,5,0,NULL,1,NULL,0,2,'',20,1,NULL,'yash','yash@hamiltonkw.com',2,NULL,'007','kuwait',NULL,'01','8209528643',NULL,'yash',NULL,NULL,NULL,NULL,0,0,'2023-11-05 10:39:18','2023-11-05 10:39:18','2023-11-05 10:39:18',NULL),(5,5,10,5,0,NULL,7,NULL,0,2,'',8,1,NULL,'kuwait','test@test.com',2,NULL,NULL,'kuwait',NULL,NULL,'8547856996595+9595+6',NULL,'kuwait',NULL,NULL,NULL,NULL,0,0,'2023-11-06 06:19:50','2023-11-06 06:19:50','2023-11-06 06:19:50',NULL),(6,6,10553,5,0,NULL,8,NULL,0,1,'',10552,3,NULL,'Gagan Darji','projects@hamiltonkw.com',1,NULL,NULL,'test Address',NULL,NULL,'98825484',NULL,'test Address',NULL,NULL,NULL,NULL,0,0,'2023-11-06 13:12:30','2023-11-06 13:12:30','2023-11-06 13:12:30',NULL),(7,7,1051,5,0,NULL,9,NULL,0,1,'',1050,4,NULL,'Clementine Weaver','kybugazyvy@mailinator.com',1,NULL,NULL,'Voluptatem Voluptat',NULL,NULL,'Rerum tempore aliqu',NULL,'Georgia Copeland',NULL,NULL,NULL,NULL,0,0,'2023-11-20 09:27:21','2023-11-20 09:27:21','2023-11-20 09:27:21',NULL),(8,8,1032,5,0,NULL,10,NULL,0,2,'',1030,3,NULL,'urvik','sdfsd@dsd.com',5,NULL,NULL,'10',NULL,NULL,'7894561230',NULL,'sharq',NULL,NULL,NULL,NULL,0,0,'2024-01-09 11:39:33','2024-01-09 11:39:33','2024-01-09 11:39:33',NULL),(9,9,110,5,0,NULL,11,NULL,0,2,'',108,2,NULL,'Gagan Darji','sales@hamiltonkw.com',2,NULL,NULL,'test Address',NULL,NULL,'98825484',NULL,'test Address',NULL,NULL,NULL,NULL,0,0,'2024-01-09 12:31:09','2024-01-09 12:31:09','2024-01-09 12:31:09',NULL),(10,10,924,5,0,NULL,12,NULL,0,2,'',922,1,NULL,'Gagan Darji','projects+007@hamiltonkw.com',2,NULL,NULL,'dd',NULL,NULL,'98825484',NULL,'test Address',NULL,NULL,NULL,NULL,0,0,'2024-04-23 13:37:31','2024-04-23 13:37:31','2024-04-23 13:37:31',NULL),(11,11,101,5,0,NULL,13,NULL,0,1,'',100,1,'cl8G9mpYSzewkLgVwBaskR:APA91bFOwq7P6Ithd29zJEEclHpz_YtSx4ZcQDMzPPKvZWANQ1Cxush5Fdnfs4_CFujSkoqpPcCi-W0yHk19MT8PXnBg4kr1vJ7-xvS1Jz8yuME6gbBCGHIQ1-EHmxOaVZnuxhx8vidx','Test','vepoho2091@crodity.com',1,NULL,'','33',NULL,NULL,'2580258085',NULL,'2000 N Shoreline Blvd, Mountain View, CA 94043, USA',NULL,NULL,NULL,NULL,0,0,'2024-06-04 10:32:37','2024-06-04 10:32:37','2024-06-04 10:32:37',NULL),(12,11,101,5,0,NULL,13,NULL,0,1,'',100,1,'cl8G9mpYSzewkLgVwBaskR:APA91bFOwq7P6Ithd29zJEEclHpz_YtSx4ZcQDMzPPKvZWANQ1Cxush5Fdnfs4_CFujSkoqpPcCi-W0yHk19MT8PXnBg4kr1vJ7-xvS1Jz8yuME6gbBCGHIQ1-EHmxOaVZnuxhx8vidx','Test','vepoho2091@crodity.com',1,NULL,'','33',NULL,NULL,'2580258085',NULL,'2000 N Shoreline Blvd, Mountain View, CA 94043, USA',NULL,NULL,NULL,NULL,0,0,'2024-06-04 12:54:50','2024-06-04 12:54:50','2024-06-04 12:54:50',NULL),(13,11,101,5,0,NULL,13,NULL,0,1,'',100,1,'cl8G9mpYSzewkLgVwBaskR:APA91bFOwq7P6Ithd29zJEEclHpz_YtSx4ZcQDMzPPKvZWANQ1Cxush5Fdnfs4_CFujSkoqpPcCi-W0yHk19MT8PXnBg4kr1vJ7-xvS1Jz8yuME6gbBCGHIQ1-EHmxOaVZnuxhx8vidx','Test','vepoho2091@crodity.com',1,NULL,'','33',NULL,NULL,'2580258085',NULL,'2000 N Shoreline Blvd, Mountain View, CA 94043, USA',NULL,NULL,NULL,NULL,0,0,'2024-06-04 13:05:18','2024-06-04 13:05:18','2024-06-04 13:05:18',NULL),(14,11,924,5,0,NULL,14,NULL,0,2,'',922,1,'cl8G9mpYSzewkLgVwBaskR:APA91bFOwq7P6Ithd29zJEEclHpz_YtSx4ZcQDMzPPKvZWANQ1Cxush5Fdnfs4_CFujSkoqpPcCi-W0yHk19MT8PXnBg4kr1vJ7-xvS1Jz8yuME6gbBCGHIQ1-EHmxOaVZnuxhx8vidx','Test','vepoho2091@crodity.com',2,NULL,'','007',NULL,NULL,'2580258085',NULL,'8V97+3C نسفوران، استان سیستان و بلوچستان، Iran',NULL,NULL,NULL,NULL,0,0,'2024-06-05 09:42:17','2024-06-05 09:42:17','2024-06-05 09:42:17',NULL),(15,11,924,5,0,NULL,14,NULL,0,2,'',922,1,'cl8G9mpYSzewkLgVwBaskR:APA91bFOwq7P6Ithd29zJEEclHpz_YtSx4ZcQDMzPPKvZWANQ1Cxush5Fdnfs4_CFujSkoqpPcCi-W0yHk19MT8PXnBg4kr1vJ7-xvS1Jz8yuME6gbBCGHIQ1-EHmxOaVZnuxhx8vidx','Test','vepoho2091@crodity.com',2,NULL,'','007',NULL,NULL,'2580258085',NULL,'8V97+3C نسفوران، استان سیستان و بلوچستان، Iran',NULL,NULL,NULL,NULL,0,0,'2024-06-05 11:05:41','2024-06-05 11:05:41','2024-06-05 11:05:41',NULL),(16,11,924,5,0,NULL,14,NULL,0,2,'',922,1,'cl8G9mpYSzewkLgVwBaskR:APA91bFOwq7P6Ithd29zJEEclHpz_YtSx4ZcQDMzPPKvZWANQ1Cxush5Fdnfs4_CFujSkoqpPcCi-W0yHk19MT8PXnBg4kr1vJ7-xvS1Jz8yuME6gbBCGHIQ1-EHmxOaVZnuxhx8vidx','Test','vepoho2091@crodity.com',2,NULL,'','007',NULL,NULL,'2580258085',NULL,'8V97+3C نسفوران، استان سیستان و بلوچستان، Iran',NULL,NULL,NULL,NULL,0,0,'2024-06-05 11:10:52','2024-06-05 11:10:52','2024-06-05 11:10:52',NULL),(17,11,924,5,0,NULL,14,NULL,0,2,'',922,1,'cl8G9mpYSzewkLgVwBaskR:APA91bFOwq7P6Ithd29zJEEclHpz_YtSx4ZcQDMzPPKvZWANQ1Cxush5Fdnfs4_CFujSkoqpPcCi-W0yHk19MT8PXnBg4kr1vJ7-xvS1Jz8yuME6gbBCGHIQ1-EHmxOaVZnuxhx8vidx','Test','vepoho2091@crodity.com',2,NULL,'','007',NULL,NULL,'2580258085',NULL,'8V97+3C نسفوران، استان سیستان و بلوچستان، Iran',NULL,NULL,NULL,NULL,0,0,'2024-06-05 11:13:57','2024-06-05 11:13:57','2024-06-05 11:13:57',NULL),(18,11,1024,5,0,NULL,14,NULL,0,2,'',1022,2,'fERXRRL0TRmQTKXrPLMMst:APA91bECHeS0_e1kTNQM0aRMTVYv0XfelElRO6B9IeG6ZvSSm1KWr5ChClCjzXt2ztudTPxcl6oFqn-QTStHIfbM8zGraNWoTmCqvAQcD4WV5Re7D7S6T9jVxxZSXnm0Ots4m7UGC3o5','Test','vepoho2091@crodity.com',2,NULL,'','007',NULL,NULL,'2580258085',NULL,'8V97+3C نسفوران، استان سیستان و بلوچستان، Iran',NULL,NULL,NULL,NULL,0,0,'2024-06-05 12:25:00','2024-06-05 12:25:00','2024-06-05 12:25:00',NULL),(19,12,923,5,0,NULL,15,NULL,0,1,'',922,1,'dFsbFVhIT52LkWWP-v9F1L:APA91bHsTwQRwWUgxglYYZywY7-nQpD1tG-XujKv4yYvhuBRiW9NST18WFW2kI7ArGU0BXJdqoJJkq6RX3ig_orx45gO6h9Vfmfit6LxeOdi2VF0ak2HStWBXvV2N64EuuNs9g3qxvhF','Ajk','test@gmail.com',3,NULL,'','007',NULL,NULL,'3698523698',NULL,'72J3+VP3, Zahra, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-06-05 12:45:07','2024-06-05 12:45:07','2024-06-05 12:45:07',NULL),(20,12,923,5,0,NULL,15,NULL,0,1,'',922,1,'dFsbFVhIT52LkWWP-v9F1L:APA91bHsTwQRwWUgxglYYZywY7-nQpD1tG-XujKv4yYvhuBRiW9NST18WFW2kI7ArGU0BXJdqoJJkq6RX3ig_orx45gO6h9Vfmfit6LxeOdi2VF0ak2HStWBXvV2N64EuuNs9g3qxvhF','Ajk','test@gmail.com',3,NULL,'','007',NULL,NULL,'3698523698',NULL,'72J3+VP3, Zahra, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-06-05 12:52:08','2024-06-05 12:52:08','2024-06-05 12:52:08',NULL),(21,12,923,5,0,NULL,15,NULL,0,1,'',922,1,'dFsbFVhIT52LkWWP-v9F1L:APA91bHsTwQRwWUgxglYYZywY7-nQpD1tG-XujKv4yYvhuBRiW9NST18WFW2kI7ArGU0BXJdqoJJkq6RX3ig_orx45gO6h9Vfmfit6LxeOdi2VF0ak2HStWBXvV2N64EuuNs9g3qxvhF','Ajk','test@gmail.com',3,NULL,'','007',NULL,NULL,'3698523698',NULL,'72J3+VP3, Zahra, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-06-05 12:52:45','2024-06-05 12:52:45','2024-06-05 12:52:45',NULL),(22,12,101,5,0,NULL,15,NULL,0,1,'',100,1,'dFsbFVhIT52LkWWP-v9F1L:APA91bHsTwQRwWUgxglYYZywY7-nQpD1tG-XujKv4yYvhuBRiW9NST18WFW2kI7ArGU0BXJdqoJJkq6RX3ig_orx45gO6h9Vfmfit6LxeOdi2VF0ak2HStWBXvV2N64EuuNs9g3qxvhF','Ajk','test@gmail.com',3,NULL,'','007',NULL,NULL,'3698523698',NULL,'72J3+VP3, Zahra, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-06-05 12:54:10','2024-06-05 12:54:10','2024-06-05 12:54:10',NULL),(23,12,101,5,0,NULL,15,NULL,0,1,'',100,1,'dFsbFVhIT52LkWWP-v9F1L:APA91bHsTwQRwWUgxglYYZywY7-nQpD1tG-XujKv4yYvhuBRiW9NST18WFW2kI7ArGU0BXJdqoJJkq6RX3ig_orx45gO6h9Vfmfit6LxeOdi2VF0ak2HStWBXvV2N64EuuNs9g3qxvhF','Ajk','test@gmail.com',3,NULL,'','007',NULL,NULL,'3698523698',NULL,'72J3+VP3, Zahra, Kuwait',NULL,NULL,NULL,NULL,1,0,'2024-07-04 09:11:50','2024-07-04 09:11:50','2024-07-04 09:11:50',NULL),(24,13,12,5,0,NULL,112,NULL,0,2,'',10,1,'ctysaxDFSXOEg24SYzo1HG:APA91bFUdxSRl0BZ4U7myrqa0xBq2--Oq2VqUvQ7ciy0b8Z9yRx8BX8EnarbMb-RXQTWR8QbzFI4ejiBBS4BDuSURvEh4b7UZMK279cw4YTWbPYhBtBHms5cHOk5JRlhED8JvxwFKx6Z','yash','yash1@hamiltonkw.com',2,NULL,'yy','hg',NULL,'66','9898986868',NULL,'6, Vastrapur Station Rd, Vejalpur, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-06-27 10:21:44','2024-06-27 10:21:44','2024-06-27 10:21:44',NULL),(25,14,272,5,0,NULL,113,NULL,0,2,'',270,1,NULL,'test Tailor','shiv@hamiltonkw.com',2,NULL,NULL,'kuwait',NULL,NULL,'08209528643',NULL,'Testing',NULL,NULL,NULL,NULL,0,0,'2024-06-27 11:30:51','2024-06-27 11:30:51','2024-06-27 11:30:51',NULL),(26,13,182,5,0,NULL,112,NULL,0,2,'',180,1,'ctysaxDFSXOEg24SYzo1HG:APA91bFUdxSRl0BZ4U7myrqa0xBq2--Oq2VqUvQ7ciy0b8Z9yRx8BX8EnarbMb-RXQTWR8QbzFI4ejiBBS4BDuSURvEh4b7UZMK279cw4YTWbPYhBtBHms5cHOk5JRlhED8JvxwFKx6Z','yash','yash1@hamiltonkw.com',2,NULL,'3','hg',NULL,'66','9898986868',NULL,'6, Vastrapur Station Rd, Vejalpur, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-06-27 11:41:40','2024-06-27 11:41:40','2024-06-27 11:41:40',NULL),(27,15,91,5,0,NULL,114,NULL,0,1,'',90,1,'crUqYOXOQl-fSka3injgg5:APA91bFCtWfEnolfet8xXvALKwkT1hhGoCAOpyVto00_GOdxQluprGOGkWuJnK4eIjFRG__ikuyV7FegS25mQB_j4KrvpVdDZbPZNr57tvt51CIpR6KxFvKbUmoS13ygKZpIIFQi085H','mustan','mustanseer@hamiltonkw.com',3,NULL,'10','10',NULL,'10','77996644',NULL,'450 Ahmad Al Jaber St, Al Kuwayt, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-06-27 12:24:52','2024-06-27 12:24:52','2024-06-27 12:24:52',NULL),(28,16,104,5,0,NULL,115,NULL,0,4,'',100,1,'dWGopW4vQIau72pcHd1qmP:APA91bETwlkBmOXseqFA7VnYz4zLq3RGMo51TQpQvprNN9rzDLrFhTRSNb---re4y0w-W-iqT3_tLqqg-vqWhtdXTU4iLkS-YjbeM53SRQYpddSoDc-YALeLzqRoWsjk196hFtsvPCDX','Test1','terid70498@mposhop.com',4,NULL,'008','bekar street',NULL,'1542','1456327554',NULL,'6XG5+RG Abdullah Al Mubarak Al Sabah, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-06-30 09:34:25','2024-06-30 09:34:25','2024-06-30 09:34:25',NULL),(29,17,6,5,0,NULL,116,NULL,0,1,'',5,1,'c3WrT8OTSzOQBqqZi6RbrB:APA91bFQwJ4nVfeopmJeY9e79ls7rv6yWk4HnUUSGF4bKPed_YaIFe_3QgUYhy7oS4x7rA9gtyttjV4bc-BxZIOwwXKeGqF5gBWIhFejAE9ox5yQRX4cQawj4-6ZzIPBH4zj7RojWJLK','yash','terid704982@mposhop.com',3,NULL,NULL,'jvgi',NULL,NULL,'9865383868',NULL,'1991 Colony St, Mountain View, CA 94043, USA',NULL,NULL,NULL,NULL,0,0,'2024-07-01 12:26:50','2024-07-01 12:26:50','2024-07-01 12:26:50',NULL),(30,18,7,5,0,NULL,117,NULL,0,2,'',5,1,'c3WrT8OTSzOQBqqZi6RbrB:APA91bFQwJ4nVfeopmJeY9e79ls7rv6yWk4HnUUSGF4bKPed_YaIFe_3QgUYhy7oS4x7rA9gtyttjV4bc-BxZIOwwXKeGqF5gBWIhFejAE9ox5yQRX4cQawj4-6ZzIPBH4zj7RojWJLK','yash','terid7049823@mposhop.com',2,NULL,NULL,'gvaag',NULL,NULL,'2596355185',NULL,'XFCH+W4 Ahmedabad, Gujarat, India',NULL,NULL,NULL,NULL,0,0,'2024-07-01 12:29:16','2024-07-01 12:29:16','2024-07-01 12:29:16',NULL),(31,19,7,5,0,NULL,118,NULL,0,2,'',5,1,'fId2AalBR-y9z68MM5SaM7:APA91bGAQhQeJAWh5Zzt61Ae21PMUa8EOslhtJ0SrX4ywqJr23SEoMYsrb2U8AG3Da1uzEvR2Wd7PkWMq-GVyd5gKeucQPq7nTTuGWdh-ER2Zx8Kuae48k5v1hGmqTu1c1AqA0i8QTB1','yash','test95@gmail.com',2,NULL,NULL,'jggu',NULL,NULL,'2580963147',NULL,'2F3X+W6W, Makarba, Ahmedabad, Gujarat 380054, India',NULL,NULL,NULL,NULL,0,0,'2024-07-01 12:42:44','2024-07-01 12:42:44','2024-07-01 12:42:44',NULL),(32,20,7,5,0,NULL,119,NULL,0,2,'',5,1,'fId2AalBR-y9z68MM5SaM7:APA91bGAQhQeJAWh5Zzt61Ae21PMUa8EOslhtJ0SrX4ywqJr23SEoMYsrb2U8AG3Da1uzEvR2Wd7PkWMq-GVyd5gKeucQPq7nTTuGWdh-ER2Zx8Kuae48k5v1hGmqTu1c1AqA0i8QTB1','yash','terid7049832@mposhop.com',2,NULL,NULL,'dhfuff',NULL,NULL,'9658234486',NULL,'168, Baherampura Rd, Calico Mills, Behrampura, Ahmedabad, Gujarat 380022, India',NULL,NULL,NULL,NULL,0,0,'2024-07-01 12:48:51','2024-07-01 12:48:51','2024-07-01 12:48:51',NULL),(33,21,6,5,0,NULL,120,NULL,0,1,'',5,1,'fId2AalBR-y9z68MM5SaM7:APA91bGAQhQeJAWh5Zzt61Ae21PMUa8EOslhtJ0SrX4ywqJr23SEoMYsrb2U8AG3Da1uzEvR2Wd7PkWMq-GVyd5gKeucQPq7nTTuGWdh-ER2Zx8Kuae48k5v1hGmqTu1c1AqA0i8QTB1','yash','terid7049854@mposhop.com',3,NULL,NULL,'chic',NULL,NULL,'8255423556',NULL,'X8HQ+G3 Pinrra, Jharkhand, India',NULL,NULL,NULL,NULL,0,0,'2024-07-01 12:54:05','2024-07-01 12:54:05','2024-07-01 12:54:05',NULL),(34,22,6,5,0,NULL,121,NULL,0,1,'',5,1,'fId2AalBR-y9z68MM5SaM7:APA91bGAQhQeJAWh5Zzt61Ae21PMUa8EOslhtJ0SrX4ywqJr23SEoMYsrb2U8AG3Da1uzEvR2Wd7PkWMq-GVyd5gKeucQPq7nTTuGWdh-ER2Zx8Kuae48k5v1hGmqTu1c1AqA0i8QTB1','yash','test915@gmail.com',3,NULL,NULL,'ha',NULL,NULL,'5124554343',NULL,'WGW9+PV Ahmedabad, Gujarat, India',NULL,NULL,NULL,NULL,0,0,'2024-07-01 13:09:56','2024-07-01 13:09:56','2024-07-01 13:09:56',NULL),(35,16,9,5,0,NULL,115,NULL,0,4,'',5,1,'efnLAZp5SJ-zduX07gxCm5:APA91bHfS77WM17NtJgHMMvtqP7CNF7dY7lcg1HUJvpdWrONhahVpcBOQ4fJxoOCv_tv7_u9k5An41PVPRxGvjBoCY9wR3-Q89nBsf552knAoin9Ra-9Sx503LtKNFFTgkF8zkwNldqz','Test1','terid70498@mposhop.com',4,NULL,'008','bekar street',NULL,'1542','1456327554',NULL,'6XG5+RG Abdullah Al Mubarak Al Sabah, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-02 05:07:03','2024-07-02 05:07:03','2024-07-02 05:07:03',NULL),(36,16,9,5,0,NULL,115,NULL,0,4,'',5,1,'efnLAZp5SJ-zduX07gxCm5:APA91bHfS77WM17NtJgHMMvtqP7CNF7dY7lcg1HUJvpdWrONhahVpcBOQ4fJxoOCv_tv7_u9k5An41PVPRxGvjBoCY9wR3-Q89nBsf552knAoin9Ra-9Sx503LtKNFFTgkF8zkwNldqz','Test1','terid70498@mposhop.com',4,NULL,'008','bekar street',NULL,'1542','1456327554',NULL,'6XG5+RG Abdullah Al Mubarak Al Sabah, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-02 05:08:57','2024-07-02 05:08:57','2024-07-02 05:08:57',NULL),(37,16,9,5,0,NULL,115,NULL,0,4,'',5,1,'efnLAZp5SJ-zduX07gxCm5:APA91bHfS77WM17NtJgHMMvtqP7CNF7dY7lcg1HUJvpdWrONhahVpcBOQ4fJxoOCv_tv7_u9k5An41PVPRxGvjBoCY9wR3-Q89nBsf552knAoin9Ra-9Sx503LtKNFFTgkF8zkwNldqz','Test1','terid70498@mposhop.com',4,NULL,'008','bekar street',NULL,'1542','1456327554',NULL,'6XG5+RG Abdullah Al Mubarak Al Sabah, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-02 05:22:45','2024-07-02 05:22:45','2024-07-02 05:22:45',NULL),(38,16,9,5,0,NULL,115,NULL,0,4,'',5,1,'efnLAZp5SJ-zduX07gxCm5:APA91bHfS77WM17NtJgHMMvtqP7CNF7dY7lcg1HUJvpdWrONhahVpcBOQ4fJxoOCv_tv7_u9k5An41PVPRxGvjBoCY9wR3-Q89nBsf552knAoin9Ra-9Sx503LtKNFFTgkF8zkwNldqz','Test1','terid70498@mposhop.com',4,NULL,'008','bekar street',NULL,'1542','1456327554',NULL,'6XG5+RG Abdullah Al Mubarak Al Sabah, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-02 05:39:33','2024-07-02 05:39:33','2024-07-02 05:39:33',NULL),(39,23,7,5,0,NULL,122,NULL,0,2,'',5,1,'random-fcm27991775','trst','terid70498344@mposhop.com',2,NULL,NULL,'hffu',NULL,NULL,'9854547686',NULL,'1607 Amphitheatre Pkwy, Mountain View, CA 94043, USA',NULL,NULL,NULL,NULL,0,0,'2024-07-02 05:46:10','2024-07-02 05:46:10','2024-07-02 05:46:10',NULL),(40,16,9,5,0,NULL,115,NULL,0,4,'',5,1,'random-fcm27991775','Test1','terid70498@mposhop.com',4,NULL,'008','bekar street',NULL,'1542','1456327554',NULL,'6XG5+RG Abdullah Al Mubarak Al Sabah, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-02 06:09:36','2024-07-02 06:09:36','2024-07-02 06:09:36',NULL),(41,16,9,5,0,NULL,115,NULL,0,4,'',5,1,'efnLAZp5SJ-zduX07gxCm5:APA91bHfS77WM17NtJgHMMvtqP7CNF7dY7lcg1HUJvpdWrONhahVpcBOQ4fJxoOCv_tv7_u9k5An41PVPRxGvjBoCY9wR3-Q89nBsf552knAoin9Ra-9Sx503LtKNFFTgkF8zkwNldqz','Test1','terid70498@mposhop.com',4,NULL,'008','bekar street',NULL,'1542','1456327554',NULL,'6XG5+RG Abdullah Al Mubarak Al Sabah, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-02 06:45:52','2024-07-02 06:45:52','2024-07-02 06:45:52',NULL),(42,24,102,5,0,NULL,123,NULL,0,2,'',100,1,'1231232132121sdffddffdfdg','test','testguest1@yopmail.com',2,NULL,NULL,'jalaa',NULL,NULL,'7755336699',NULL,'address name',NULL,NULL,NULL,NULL,0,0,'2024-07-02 07:36:37','2024-07-02 07:36:37','2024-07-02 07:36:37',NULL),(43,16,9,5,0,NULL,115,NULL,0,4,'',5,1,'efnLAZp5SJ-zduX07gxCm5:APA91bHfS77WM17NtJgHMMvtqP7CNF7dY7lcg1HUJvpdWrONhahVpcBOQ4fJxoOCv_tv7_u9k5An41PVPRxGvjBoCY9wR3-Q89nBsf552knAoin9Ra-9Sx503LtKNFFTgkF8zkwNldqz','Test1','terid70498@mposhop.com',4,NULL,'008','bekar street',NULL,'1542','1456327554',NULL,'6XG5+RG Abdullah Al Mubarak Al Sabah, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-02 08:42:34','2024-07-02 08:42:34','2024-07-02 08:42:34',NULL),(44,25,102,5,0,NULL,124,NULL,0,2,'',100,1,'1231232132121sdffddffdfdg','test','testguest122@yopmail.com',2,NULL,NULL,'jalaa',NULL,NULL,'7755336699',NULL,'address name',NULL,NULL,NULL,NULL,0,0,'2024-07-02 08:48:55','2024-07-02 08:48:55','2024-07-02 08:48:55',NULL),(45,16,9,5,0,NULL,115,NULL,0,4,'',5,1,'efnLAZp5SJ-zduX07gxCm5:APA91bHfS77WM17NtJgHMMvtqP7CNF7dY7lcg1HUJvpdWrONhahVpcBOQ4fJxoOCv_tv7_u9k5An41PVPRxGvjBoCY9wR3-Q89nBsf552knAoin9Ra-9Sx503LtKNFFTgkF8zkwNldqz','Test1','terid70498@mposhop.com',4,NULL,'008','bekar street',NULL,'1542','1456327554',NULL,'6XG5+RG Abdullah Al Mubarak Al Sabah, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-02 08:54:20','2024-07-02 08:54:20','2024-07-02 08:54:20',NULL),(46,26,102,5,0,NULL,125,NULL,0,2,'',100,1,'f1MKTcxWQjyP7IuCHbYx5A:APA91bGRpGOyFoVXmZEOo4yz_YiwTArJTXPaMU4lu8imMkEZOEaUpgzBUFgQlAKmYsKZDanj5aHAsnxXZGMQArDQVktXDw2E1iMJrTT0U3caO4PKRuTzF9IrBAnG8CrwDEXABqf8uTJ2','mush','h@yopmail.com',5,NULL,NULL,'12',NULL,NULL,'664578961',NULL,'450 Ahmad Al Jaber St, Al Kuwayt, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-02 09:10:49','2024-07-02 09:10:49','2024-07-02 09:10:49',NULL),(47,27,104,5,0,NULL,126,NULL,0,4,'',100,1,'f1MKTcxWQjyP7IuCHbYx5A:APA91bGRpGOyFoVXmZEOo4yz_YiwTArJTXPaMU4lu8imMkEZOEaUpgzBUFgQlAKmYsKZDanj5aHAsnxXZGMQArDQVktXDw2E1iMJrTT0U3caO4PKRuTzF9IrBAnG8CrwDEXABqf8uTJ2','main','y@yopmail.com',4,NULL,NULL,'11',NULL,NULL,'12435679',NULL,'Al Kawthar Tower, 3A Jaber Al-Mubarak St, Al Kuwayt, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-02 09:13:45','2024-07-02 09:13:45','2024-07-02 09:13:45',NULL),(48,16,109,5,0,NULL,115,NULL,0,4,'',105,2,'efnLAZp5SJ-zduX07gxCm5:APA91bHfS77WM17NtJgHMMvtqP7CNF7dY7lcg1HUJvpdWrONhahVpcBOQ4fJxoOCv_tv7_u9k5An41PVPRxGvjBoCY9wR3-Q89nBsf552knAoin9Ra-9Sx503LtKNFFTgkF8zkwNldqz','Test1','terid70498@mposhop.com',4,NULL,'008','bekar street',NULL,'1542','1456327554',NULL,'6XG5+RG Abdullah Al Mubarak Al Sabah, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-02 10:07:59','2024-07-02 10:07:59','2024-07-02 10:07:59',NULL),(49,31,124,5,0,NULL,127,NULL,0,4,'',120,2,'clQiyd3GK0MGpgPkfVzLp1:APA91bHWb39CZ9-wWLOh9B1hlCMxABeRBuSeAXrQArnjaJoFuAZZ4J522pQoJjhcX_wan2m28eHZuNVNI_RNc31vF72ZCS3dgsP-ScvBrpLTnvuspWHFRSRoVZuia8gzTA_uryGMJkvV','shiv','shivanshu@hamiltonkw.com',4,NULL,NULL,'hello',NULL,NULL,'9685073815',NULL,'9, Shivaranjani Row houses, Near Shivaranjani Cross Roads, Ambawadi, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 10:01:36','2024-07-03 10:01:36','2024-07-03 10:01:36',NULL),(50,32,104,5,0,NULL,128,NULL,0,4,'',100,1,'e-Ng3DeiTKKXiBigXZqtYg:APA91bGeO_zttHWpRKEHxpAKEwcKQYMdPpcfZeTC8oBnP-6dhpq_h4O6cAC7wuJhhf_C4CyOVi4BsFWfKQKMRxFu4bQbJp75XHaLdz7uvaWSZs-Fa7onGf2Qght100e41h1n40JQ_yEk','mus','ms@yopmail.com',4,NULL,NULL,'st',NULL,NULL,'66457812',NULL,'9XMR+MJ6, Ahmad Al Jaber St, Al Kuwayt, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-03 12:56:12','2024-07-03 12:56:12','2024-07-03 12:56:12',NULL),(51,33,102,5,0,NULL,129,NULL,0,2,'',100,1,'e-Ng3DeiTKKXiBigXZqtYg:APA91bGeO_zttHWpRKEHxpAKEwcKQYMdPpcfZeTC8oBnP-6dhpq_h4O6cAC7wuJhhf_C4CyOVi4BsFWfKQKMRxFu4bQbJp75XHaLdz7uvaWSZs-Fa7onGf2Qght100e41h1n40JQ_yEk','jdjs','hajk@yopmail.com',2,NULL,NULL,'10',NULL,NULL,'66457961',NULL,'Wataniya Telecom, Ahmad Al Jaber St, Al Kuwayt, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-03 13:08:53','2024-07-03 13:08:53','2024-07-03 13:08:53',NULL),(52,34,102,5,0,NULL,130,NULL,0,2,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','yehe','test76@gmail.com',2,NULL,NULL,'sheh',NULL,NULL,'8484616161',NULL,'VFQ4+GQQ, Sama Rd, Bhat, Gujarat 382210, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 13:10:59','2024-07-03 13:10:59','2024-07-03 13:10:59',NULL),(53,35,102,5,0,NULL,131,NULL,0,2,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','uwuhw','test@123gmail.com',5,NULL,NULL,'ywy',NULL,NULL,'6488454848',NULL,'VHP3+R4 Giramtha, Gujarat, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 13:14:48','2024-07-03 13:14:48','2024-07-03 13:14:48',NULL),(54,36,102,5,0,NULL,132,NULL,0,2,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','test','test354665@gmail.com',5,NULL,NULL,'fuj',NULL,NULL,'6576543435',NULL,'139, Jainacharya Surendra Surishwarji Marg, Burusharth Nagar, Nava Vadaj, Ahmedabad, Gujarat 380013, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 13:29:34','2024-07-03 13:29:34','2024-07-03 13:29:34',NULL),(55,37,101,5,0,NULL,133,NULL,0,1,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','ygyg','test@126643gmail.com',3,NULL,NULL,'ctrg5',NULL,NULL,'5828285252',NULL,'Google Building GWC3, 1505 Salado Dr, Mountain View, CA 94043, USA',NULL,NULL,NULL,NULL,0,0,'2024-07-03 13:35:35','2024-07-03 13:35:35','2024-07-03 13:35:35',NULL),(56,38,104,5,0,NULL,134,NULL,0,4,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','gygg','test12345331@gmail.com',4,NULL,NULL,'fc',NULL,NULL,'2828252527',NULL,'WF3F+48 Kasindra, Gujarat, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 13:39:51','2024-07-03 13:39:51','2024-07-03 13:39:51',NULL),(57,39,102,5,0,NULL,135,NULL,0,2,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','tdf','test@34642gmail.com',5,NULL,NULL,'tvyg',NULL,NULL,'2558441266',NULL,'Ode St, Maokeng, Tembisa, 1632, South Africa, Paldi Kankaj, Gujarat 382427, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 13:48:06','2024-07-03 13:48:06','2024-07-03 13:48:06',NULL),(58,40,102,5,0,NULL,136,NULL,0,2,'',100,1,'eT6izlYXSSm4PlpG8L6wo2:APA91bEDtq-pG4Q_cF9kdX9UcLfykApYNvDdsmOlpS0RqrvpSEhEQRm9JvS9VTto_TAmWgiu7fr_Afi5dGhP6fHoeaJ4cMIxk4zKOm3poHyPAGtJv8xac2SSJZODeijMsOuYB1XbN7bH','test','testguest881@yopmail.com',2,NULL,NULL,'jalaa',NULL,NULL,'7755336699',NULL,'address name',NULL,NULL,NULL,NULL,0,0,'2024-07-03 13:54:04','2024-07-03 13:54:04','2024-07-03 13:54:04',NULL),(59,30,104,5,0,NULL,137,NULL,0,4,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','test12','test12@gmail.com',4,NULL,'g','ggg',NULL,'123','9464515181',NULL,'202, Titanium City Centre Mall, near SACHIN TOWER, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 13:58:10','2024-07-03 13:58:10','2024-07-03 13:58:10',NULL),(60,30,104,5,0,NULL,137,NULL,0,4,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','test12','test12@gmail.com',4,NULL,'g','ggg',NULL,'123','9464515181',NULL,'202, Titanium City Centre Mall, near SACHIN TOWER, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 14:01:54','2024-07-03 14:01:54','2024-07-03 14:01:54',NULL),(61,30,104,5,0,NULL,137,NULL,0,4,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','test12','test12@gmail.com',4,NULL,'g','ggg',NULL,'123','9464515181',NULL,'202, Titanium City Centre Mall, near SACHIN TOWER, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 14:15:21','2024-07-03 14:15:21','2024-07-03 14:15:21',NULL),(62,30,104,5,0,NULL,137,NULL,0,4,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','test12','test12@gmail.com',4,NULL,'g','ggg',NULL,'123','9464515181',NULL,'202, Titanium City Centre Mall, near SACHIN TOWER, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 14:21:53','2024-07-03 14:21:53','2024-07-03 14:21:53',NULL),(63,30,14,5,0,NULL,137,NULL,0,4,'',10,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','test12','test12@gmail.com',4,NULL,'g','ggg',NULL,'123','9464515181',NULL,'202, Titanium City Centre Mall, near SACHIN TOWER, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,1,0,'2024-07-03 14:24:23','2024-07-03 14:24:23','2024-07-03 14:24:23',NULL),(64,30,14,5,0,NULL,137,NULL,0,4,'',10,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','test12','test12@gmail.com',4,NULL,'g','ggg',NULL,'123','9464515181',NULL,'202, Titanium City Centre Mall, near SACHIN TOWER, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,1,0,'2024-07-03 14:26:35','2024-07-03 14:26:35','2024-07-03 14:26:35',NULL),(65,41,101,5,0,NULL,138,NULL,0,1,'',100,1,'random-fcm62184138','hfhfhfhcf yyy','test127542@gmail.com',3,NULL,NULL,'hfuf',NULL,NULL,'8854424255',NULL,'VFCH+CC Bhat, Gujarat, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 14:28:17','2024-07-03 14:28:17','2024-07-03 14:28:17',NULL),(66,42,102,5,0,NULL,139,NULL,0,2,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','ugguf','testr22@gamil.com',2,NULL,NULL,'dff',NULL,NULL,'8525844556',NULL,'WGM2+22 Visalpur, Gujarat, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 14:44:34','2024-07-03 14:44:34','2024-07-03 14:44:34',NULL),(67,43,104,5,0,NULL,140,NULL,0,4,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','hshshsh','testr@1gmail.com',4,NULL,NULL,'tfgxf',NULL,NULL,'8668853658',NULL,'VGXV+M2 Paldi Kankaj, Gujarat, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 14:47:54','2024-07-03 14:47:54','2024-07-03 14:47:54',NULL),(68,44,101,5,0,NULL,141,NULL,0,1,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','hahgs','tester1@gmail.com',3,NULL,NULL,'tegw',NULL,NULL,'5454215181',NULL,'VGXP+59 Paldi Kankaj, Gujarat, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 14:51:21','2024-07-03 14:51:21','2024-07-03 14:51:21',NULL),(69,45,102,5,0,NULL,142,NULL,0,2,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','thshhs','tester12@gmail.com',5,NULL,NULL,'hwh',NULL,NULL,'2458464643',NULL,'WG3W+V59, Pirana Dargah Rd, Paldi Kankaj, Gujarat 382427, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 14:53:12','2024-07-03 14:53:12','2024-07-03 14:53:12',NULL),(70,46,101,5,0,NULL,143,NULL,0,1,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','ubyhyh','tester123@gmail.com',3,NULL,NULL,'gsggs',NULL,NULL,'6454278488',NULL,'202, Vrajdham Rd, nr. Ujala circle, Sarkhej, Ahmedabad, Sarkhej-Okaf, Gujarat 382210, India',NULL,NULL,NULL,NULL,0,0,'2024-07-03 15:02:45','2024-07-03 15:02:45','2024-07-03 15:02:45',NULL),(71,47,104,5,0,NULL,144,NULL,0,4,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','ywyygw','tester156@gmail.com',4,NULL,NULL,'ywy',NULL,NULL,'5454848466',NULL,'WG8V+X2 Ahmedabad, Gujarat, India',NULL,NULL,NULL,NULL,1,0,'2024-07-03 15:20:36','2024-07-03 15:20:36','2024-07-03 15:20:36',NULL),(72,48,104,5,0,NULL,145,NULL,0,4,'',100,1,'egGvNvlFSza0Vq3AFeFPdo:APA91bEcRoPnLDWbYpjNl_mvpHtVrPBFqlO90e-6GVe2Tq-PdVdiLJ127FXp9UYHdyOnXNICUgfmoDqZS_rwZxPh-4K6QZZu_jz-opC_8lXYkhCO8_0lez5c-UC7ZZSULU55nSZCBb0Y','guug','terst@12gmail.com',4,NULL,NULL,'tt',NULL,NULL,'5425481464',NULL,'WH39+85 Ode, Gujarat, India',NULL,NULL,NULL,NULL,1,0,'2024-07-03 15:26:11','2024-07-03 15:26:11','2024-07-03 15:26:11',NULL),(73,49,101,5,0,NULL,146,NULL,0,1,'',100,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','hffhf','terter1@gmail.com',3,NULL,NULL,'hdh',NULL,NULL,'6454584943',NULL,'2400 Amphitheatre Pkwy, Mountain View, CA 94043, USA',NULL,NULL,NULL,NULL,1,0,'2024-07-04 06:20:17','2024-07-04 06:20:17','2024-07-04 06:20:17',NULL),(74,50,101,5,0,NULL,147,NULL,0,1,'',100,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','jffjjcgj','testa@123gmail.com',3,NULL,NULL,'gxdg',NULL,NULL,'8898686898',NULL,'WF7C+3P Kasindra, Gujarat, India',NULL,NULL,NULL,NULL,1,0,'2024-07-04 06:26:16','2024-07-04 06:26:16','2024-07-04 06:26:16',NULL),(75,51,102,5,0,NULL,148,NULL,0,2,'',100,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','jgfh','testa@12gamil.com',2,NULL,NULL,'xhfh',NULL,NULL,'8589090875',NULL,'WFMR+QP Ahmedabad, Gujarat, India',NULL,NULL,NULL,NULL,1,0,'2024-07-04 06:29:43','2024-07-04 06:29:43','2024-07-04 06:29:43',NULL),(76,52,102,5,0,NULL,149,NULL,0,2,'',100,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','chfhhf','testa123@gmail.com',2,NULL,NULL,'hffyy',NULL,NULL,'9806853535',NULL,'VFXH+QQ Kasindra, Gujarat, India',NULL,NULL,NULL,NULL,1,0,'2024-07-04 06:32:45','2024-07-04 06:32:45','2024-07-04 06:32:45',NULL),(77,53,101,5,0,NULL,150,NULL,0,1,'',100,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','fhfhhf','testa@1234gmail.com',3,NULL,NULL,'hddgud',NULL,NULL,'8689809085',NULL,'WF9W+Q7 Visalpur, Gujarat, India',NULL,NULL,NULL,NULL,1,0,'2024-07-04 06:38:50','2024-07-04 06:38:50','2024-07-04 06:38:50',NULL),(78,54,102,5,0,NULL,151,NULL,0,2,'',100,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','vnch','testa@132gmail.com',2,NULL,NULL,'hffhhf',NULL,NULL,'8754755454',NULL,'WFJR+MR5, Visalpur, Gujarat 382210, India',NULL,NULL,NULL,NULL,1,0,'2024-07-04 06:44:09','2024-07-04 06:44:09','2024-07-04 06:44:09',NULL),(79,55,102,5,0,NULL,152,NULL,0,2,'',100,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','hshh','test113422@gmail.com',2,NULL,NULL,'gegwg',NULL,NULL,'9948454344',NULL,'XG9H+99 Ahmedabad, Gujarat, India',NULL,NULL,NULL,NULL,1,0,'2024-07-04 06:46:59','2024-07-04 06:46:59','2024-07-04 06:46:59',NULL),(80,56,11,5,0,NULL,153,NULL,0,1,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','hchf','testas1@gmail.com',3,NULL,NULL,'gsg',NULL,NULL,'5845787346',NULL,'WG7W+G97, Ode, Gujarat 382427, India',NULL,NULL,NULL,NULL,1,0,'2024-07-04 06:58:02','2024-07-04 06:58:02','2024-07-04 06:58:02',NULL),(81,57,11,5,0,NULL,154,NULL,0,1,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','jss sh','testy@1gmail.com',3,NULL,NULL,'gsggegs',NULL,NULL,'8454545848',NULL,'WFWJ+HF Ahmedabad, Gujarat, India',NULL,NULL,NULL,NULL,1,0,'2024-07-04 07:21:32','2024-07-04 07:21:32','2024-07-04 07:21:32',NULL),(82,58,11,5,0,NULL,155,NULL,0,1,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','chgjgu','jeetsta@gmail.com',3,NULL,NULL,'hggh',NULL,NULL,'6886689890',NULL,'XFRR+C5Q, LJ St, Makarba, Ahmedabad, Sarkhej-Okaf, Gujarat 380054, India',NULL,NULL,NULL,NULL,0,0,'2024-07-04 07:23:42','2024-07-04 07:23:42','2024-07-04 07:23:42',NULL),(83,59,12,5,0,NULL,156,NULL,0,2,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','yash jholar','ted@gmail.com',2,NULL,NULL,'hfg',NULL,NULL,'5875868857',NULL,'14B, Vejalpur, Ahmedabad, Gujarat 380051, India',NULL,NULL,NULL,NULL,0,0,'2024-07-04 07:42:52','2024-07-04 07:42:52','2024-07-04 07:42:52',NULL),(84,60,12,5,0,NULL,157,NULL,0,2,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','hshe','jeet@ggmail.com',5,NULL,NULL,'gs',NULL,NULL,'5484884819',NULL,'XG6R+3V Ahmedabad, Gujarat, India',NULL,NULL,NULL,NULL,0,0,'2024-07-04 08:50:17','2024-07-04 08:50:17','2024-07-04 08:50:17',NULL),(85,61,11,5,0,NULL,158,NULL,0,1,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','jeet','jeet12@gmail.com',3,NULL,NULL,'gw',NULL,NULL,'5484548644',NULL,'4, 100 Feet Rd, Shyamal, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-04 08:57:28','2024-07-04 08:57:28','2024-07-04 08:57:28',NULL),(86,62,11,5,0,NULL,159,NULL,0,1,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','xhhff','jeet13@gmail.com',3,NULL,NULL,'vh',NULL,NULL,'5858585858',NULL,'Someshwar Pk Ln, Someshwar Bungalows 1, 11, Times Of India Press Rd, Swinagar Society, Nehru Nagar, Satellite, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-04 09:03:32','2024-07-04 09:03:32','2024-07-04 09:03:32',NULL),(87,63,11,5,0,NULL,160,NULL,0,1,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','hffh','treth@gmail.com',3,NULL,NULL,'ffggh',NULL,NULL,'8855885585',NULL,'7, Mahavir Nagar, Meldinagar, Vejalpur, Ahmedabad, Gujarat 380051, India',NULL,NULL,NULL,NULL,0,0,'2024-07-04 09:06:55','2024-07-04 09:06:55','2024-07-04 09:06:55',NULL),(88,64,11,5,0,NULL,161,NULL,0,1,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','jeet','ft@gmail.com',3,NULL,NULL,'gggv',NULL,NULL,'9454843643',NULL,'WGWQ+84 Ahmedabad, Gujarat, India',NULL,NULL,NULL,NULL,0,0,'2024-07-04 09:17:36','2024-07-04 09:17:36','2024-07-04 09:17:36',NULL),(89,65,11,5,0,NULL,162,NULL,0,1,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','gjjg jghf','jeets@gmail.com',3,NULL,NULL,'jfuf',NULL,NULL,'1236868656',NULL,'Bhagwati Kunj, Cooperative Housing Society, A4, Shaivali Society, Vibhavari Society, Jivraj Park, Ahmedabad, Gujarat 380051, India',NULL,NULL,NULL,NULL,1,0,'2024-07-04 09:44:15','2024-07-04 09:44:15','2024-07-04 09:44:15',NULL),(90,66,11,5,0,NULL,163,NULL,0,1,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','jeet','tegh@gmail.com',3,NULL,NULL,'gshs',NULL,NULL,'8454848434',NULL,'WGWP+8H Ahmedabad, Gujarat, India',NULL,NULL,NULL,NULL,0,0,'2024-07-04 09:50:27','2024-07-04 09:50:27','2024-07-04 09:50:27',NULL),(91,67,12,5,0,NULL,164,NULL,0,2,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','uggu','tedgj@gmail.com',5,NULL,NULL,'gfg',NULL,NULL,'2882868686',NULL,'WGRR+RH Ahmedabad, Gujarat, India',NULL,NULL,NULL,NULL,0,0,'2024-07-04 09:53:59','2024-07-04 09:53:59','2024-07-04 09:53:59',NULL),(92,68,12,5,0,NULL,165,NULL,0,2,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','ght','gst@gmail.com',5,NULL,NULL,'vuhu',NULL,NULL,'6868689686',NULL,'XH45+R9M, Shivshaktinagar, Piplaj, Ahmedabad, Gujarat 382405, India',NULL,NULL,NULL,NULL,1,0,'2024-07-04 10:00:44','2024-07-04 10:00:44','2024-07-04 10:00:44',NULL),(93,69,12,5,0,NULL,166,NULL,0,2,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','rhrh','tehdg@gmail.com',5,NULL,NULL,'gsgs',NULL,NULL,'9787848484',NULL,'870/1, Industrial Area, Piplaj, Ahmedabad, Gujarat 382405, India',NULL,NULL,NULL,NULL,1,0,'2024-07-04 10:05:15','2024-07-04 10:05:15','2024-07-04 10:05:15',NULL),(94,30,14,5,0,NULL,137,NULL,0,4,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','test12','test12@gmail.com',4,NULL,'g','ggg',NULL,'123','9464515181',NULL,'202, Titanium City Centre Mall, near SACHIN TOWER, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-04 10:06:19','2024-07-04 10:06:19','2024-07-04 10:06:19',NULL),(95,30,14,5,0,NULL,137,NULL,0,4,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','test12','test12@gmail.com',4,NULL,'g','ggg',NULL,'123','9464515181',NULL,'202, Titanium City Centre Mall, near SACHIN TOWER, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-04 10:07:29','2024-07-04 10:07:29','2024-07-04 10:07:29',NULL),(96,30,14,5,0,NULL,137,NULL,0,4,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','test12','test12@gmail.com',4,NULL,'g','ggg',NULL,'123','9464515181',NULL,'202, Titanium City Centre Mall, near SACHIN TOWER, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,1,0,'2024-07-04 10:09:53','2024-07-04 10:09:53','2024-07-04 10:09:53',NULL),(97,70,101,5,0,NULL,167,NULL,0,1,'',100,1,'e-Ng3DeiTKKXiBigXZqtYg:APA91bGeO_zttHWpRKEHxpAKEwcKQYMdPpcfZeTC8oBnP-6dhpq_h4O6cAC7wuJhhf_C4CyOVi4BsFWfKQKMRxFu4bQbJp75XHaLdz7uvaWSZs-Fa7onGf2Qght100e41h1n40JQ_yEk','mustan','mustanseer11@yopmail.com',3,NULL,'13','st',NULL,'12','423459979',NULL,'Wataniya Telecom, Ahmad Al Jaber St, Al Kuwayt, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-04 10:28:47','2024-07-04 10:28:47','2024-07-04 10:28:47',NULL),(98,70,101,5,0,NULL,167,NULL,0,1,'',100,1,'e-Ng3DeiTKKXiBigXZqtYg:APA91bGeO_zttHWpRKEHxpAKEwcKQYMdPpcfZeTC8oBnP-6dhpq_h4O6cAC7wuJhhf_C4CyOVi4BsFWfKQKMRxFu4bQbJp75XHaLdz7uvaWSZs-Fa7onGf2Qght100e41h1n40JQ_yEk','mustan','mustanseer11@yopmail.com',3,NULL,'13','st',NULL,'12','423459979',NULL,'Wataniya Telecom, Ahmad Al Jaber St, Al Kuwayt, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-04 10:29:44','2024-07-04 10:29:44','2024-07-04 10:29:44',NULL),(99,70,101,5,0,NULL,167,NULL,0,1,'',100,1,'e-Ng3DeiTKKXiBigXZqtYg:APA91bGeO_zttHWpRKEHxpAKEwcKQYMdPpcfZeTC8oBnP-6dhpq_h4O6cAC7wuJhhf_C4CyOVi4BsFWfKQKMRxFu4bQbJp75XHaLdz7uvaWSZs-Fa7onGf2Qght100e41h1n40JQ_yEk','mustan','mustanseer11@yopmail.com',3,NULL,'13','st',NULL,'12','423459979',NULL,'Wataniya Telecom, Ahmad Al Jaber St, Al Kuwayt, Kuwait',NULL,NULL,NULL,NULL,0,2,'2024-07-04 10:33:10','2024-07-04 10:33:10','2024-07-04 10:33:10',NULL),(100,70,101,5,0,NULL,167,NULL,0,1,'',100,1,'e-Ng3DeiTKKXiBigXZqtYg:APA91bGeO_zttHWpRKEHxpAKEwcKQYMdPpcfZeTC8oBnP-6dhpq_h4O6cAC7wuJhhf_C4CyOVi4BsFWfKQKMRxFu4bQbJp75XHaLdz7uvaWSZs-Fa7onGf2Qght100e41h1n40JQ_yEk','mustan','mustanseer11@yopmail.com',3,NULL,'13','st',NULL,'12','423459979',NULL,'Wataniya Telecom, Ahmad Al Jaber St, Al Kuwayt, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-04 10:49:45','2024-07-04 10:49:45','2024-07-04 10:49:45',NULL),(101,70,101,5,0,NULL,167,NULL,0,1,'',100,1,'e-Ng3DeiTKKXiBigXZqtYg:APA91bGeO_zttHWpRKEHxpAKEwcKQYMdPpcfZeTC8oBnP-6dhpq_h4O6cAC7wuJhhf_C4CyOVi4BsFWfKQKMRxFu4bQbJp75XHaLdz7uvaWSZs-Fa7onGf2Qght100e41h1n40JQ_yEk','mustan','mustanseer11@yopmail.com',3,NULL,'13','st',NULL,'12','423459979',NULL,'Wataniya Telecom, Ahmad Al Jaber St, Al Kuwayt, Kuwait',NULL,NULL,NULL,NULL,0,0,'2024-07-04 10:50:12','2024-07-04 10:50:12','2024-07-04 10:50:12',NULL),(102,30,14,5,0,NULL,137,NULL,0,4,'',10,1,'cLjIDFANQCe4zPNXYslXKE:APA91bHXQD2AAX6XVcT1adHbUl9ybSEjZuhCcqXoWoswNiVMVzEjSEE2N-BqCgy06NrpVHmpfk8sVrX3S9MmXsnBsAtKwJVFZOecqw-YfhC8Cov2BUfL0tk2muVUBS_6Wyxim67hnIEf','test12','test12@gmail.com',4,NULL,'g','ggg',NULL,'123','9464515181',NULL,'202, Titanium City Centre Mall, near SACHIN TOWER, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-04 11:34:43','2024-07-04 11:34:43','2024-07-04 11:34:43',NULL),(103,30,52,5,0,NULL,175,NULL,0,2,'',50,1,'f_QZ8MTyTxiPFdJinL7L-r:APA91bFminwibz7XjAF8nIhByKCgiT2t7qpXuLJsxqRBeF8-d76ibZqENp4eKWSB24V8vChTtHmCoJCZbNdYytAXdgNNdqPN1K09SCGmXhYYOWLuBSOG5_V5Y0KlNz69T0PS-awqwyc8','test12','test12@gmail.com',2,NULL,'d','hf',NULL,'12','9464515181',NULL,'4, 132 Feet Ring Rd, Sawaminarayan Society, Satellite, Ayojan Nagar, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-07 06:22:32','2024-07-07 06:22:32','2024-07-07 06:22:32',NULL),(104,1,104,5,0,NULL,1,NULL,0,4,'',100,1,'cEzqhgXHSfSm6RoPXM-_sx:APA91bF_iV1W9gccm2lDuIf2Txa2vVwRBsFpYuJJlBVifkDXBd8-vxyokRTgZEwf-bAL7cVzpGMC2g8YOYxRdPQplPlqQIrOrDvmKpNW2O696CSCJ160D2L18KA5RsRg_xEB8CsM9NvP','yash007','yash@hamiltonkw.com',4,NULL,'007','kuwait',NULL,'01','8209528643',NULL,'CWH7+G5 Mountain View, CA, USA',NULL,NULL,NULL,NULL,1,0,'2024-07-08 10:33:19','2024-07-08 10:33:19','2024-07-08 10:33:19',NULL),(105,73,101,5,0,NULL,176,NULL,0,1,'',100,1,'random-fcm32924651','yash','yash123@gmail.com',3,NULL,NULL,'123',NULL,NULL,'32656532',NULL,'2960 N Shoreline Blvd, Mountain View, CA 94043, USA',NULL,NULL,NULL,NULL,0,0,'2024-07-08 10:38:48','2024-07-08 10:38:48','2024-07-08 10:38:48',NULL),(106,75,51,5,0,NULL,178,NULL,0,1,'',50,1,'cEzqhgXHSfSm6RoPXM-_sx:APA91bF_iV1W9gccm2lDuIf2Txa2vVwRBsFpYuJJlBVifkDXBd8-vxyokRTgZEwf-bAL7cVzpGMC2g8YOYxRdPQplPlqQIrOrDvmKpNW2O696CSCJ160D2L18KA5RsRg_xEB8CsM9NvP','yash','Yash1233@gmail.com',1,NULL,NULL,'123456',NULL,NULL,'65326538',NULL,'WFHQ+CR Visalpur, Gujarat, India',NULL,NULL,NULL,NULL,1,2,'2024-07-10 09:49:53','2024-07-10 09:49:53','2024-07-10 09:49:53',NULL),(107,30,52,5,0,NULL,180,NULL,0,2,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',5,NULL,'d','hdf',NULL,'23','94645151',NULL,'3, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 14:30:05','2024-07-09 14:30:05','2024-07-09 14:30:05',NULL),(108,30,52,5,0,NULL,180,NULL,0,2,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',5,NULL,'d','hdf',NULL,'23','94645151',NULL,'3, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 14:33:13','2024-07-09 14:33:13','2024-07-09 14:33:13',NULL),(109,30,52,5,0,NULL,180,NULL,0,2,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',5,NULL,'d','hdf',NULL,'23','94645151',NULL,'3, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 14:35:56','2024-07-09 14:35:56','2024-07-09 14:35:56',NULL),(110,30,54,5,0,NULL,179,NULL,0,4,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',4,NULL,'f','tfgh',NULL,'25','94645151',NULL,'D 407, Titeniam City Centre, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 14:38:19','2024-07-09 14:38:19','2024-07-09 14:38:19',NULL),(111,30,54,5,0,NULL,179,NULL,0,4,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',4,NULL,'f','tfgh',NULL,'25','94645151',NULL,'D 407, Titeniam City Centre, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 14:40:10','2024-07-09 14:40:10','2024-07-09 14:40:10',NULL),(112,30,54,5,0,NULL,179,NULL,0,4,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',4,NULL,'f','tfgh',NULL,'25','94645151',NULL,'D 407, Titeniam City Centre, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 14:40:10','2024-07-09 14:40:10','2024-07-09 14:40:10',NULL),(113,30,51,5,0,NULL,181,NULL,0,1,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',3,NULL,'d','rt',NULL,'258','94645151',NULL,'C Wing, Shyam Residency 6, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 14:46:01','2024-07-09 14:46:01','2024-07-09 14:46:01',NULL),(114,30,51,5,0,NULL,181,NULL,0,1,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',3,NULL,'d','rt',NULL,'258','94645151',NULL,'C Wing, Shyam Residency 6, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 14:47:57','2024-07-09 14:47:57','2024-07-09 14:47:57',NULL),(115,30,51,5,0,NULL,181,NULL,0,1,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',3,NULL,'d','rt',NULL,'258','94645151',NULL,'C Wing, Shyam Residency 6, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 14:56:27','2024-07-09 14:56:27','2024-07-09 14:56:27',NULL),(116,30,51,5,0,NULL,181,NULL,0,1,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',3,NULL,'d','rt',NULL,'258','94645151',NULL,'C Wing, Shyam Residency 6, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 14:58:58','2024-07-09 14:58:58','2024-07-09 14:58:58',NULL),(117,30,51,5,0,NULL,181,NULL,0,1,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',3,NULL,'d','rt',NULL,'258','94645151',NULL,'C Wing, Shyam Residency 6, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 15:05:15','2024-07-09 15:05:15','2024-07-09 15:05:15',NULL),(118,30,51,5,0,NULL,181,NULL,0,1,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',3,NULL,'d','rt',NULL,'258','94645151',NULL,'C Wing, Shyam Residency 6, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 15:09:18','2024-07-09 15:09:18','2024-07-09 15:09:18',NULL),(119,30,51,5,0,NULL,181,NULL,0,1,'',50,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',3,NULL,'d','rt',NULL,'258','94645151',NULL,'C Wing, Shyam Residency 6, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 15:21:59','2024-07-09 15:21:59','2024-07-09 15:21:59',NULL),(120,30,51,5,0,NULL,181,NULL,0,1,'',50,1,'random-fcm38859949','test12','test12@gmail.com',3,NULL,'d','rt',NULL,'258','94645151',NULL,'C Wing, Shyam Residency 6, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,0,0,'2024-07-09 15:27:38','2024-07-09 15:27:38','2024-07-09 15:27:38',NULL),(121,30,101,5,0,NULL,181,NULL,0,1,'',100,1,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','test12','test12@gmail.com',3,NULL,'d','rt',NULL,'258','94645151',NULL,'C Wing, Shyam Residency 6, Jodhpur Village, Ahmedabad, Gujarat 380015, India',NULL,NULL,NULL,NULL,1,0,'2024-07-10 09:53:15','2024-07-10 09:53:15','2024-07-10 09:53:15',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_translations`
--

DROP TABLE IF EXISTS `page_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int NOT NULL,
  `locale` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_words` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_translations`
--

LOCK TABLES `page_translations` WRITE;
/*!40000 ALTER TABLE `page_translations` DISABLE KEYS */;
INSERT INTO `page_translations` VALUES (1,1,'en','About Us','about-us','\n                    \n                    \n                    \n                    rasmu Is an application that allows you to buy fresh fruits and vegetables with ease via the application and delivered to you wherever you are and at affordable prices. We choose items for you very carefully as if you are buying it yourself.\n                    ',NULL,'2018-08-05 09:29:09','2021-11-06 14:45:47',NULL),(2,1,'ar','من نحن','about-us','\n                    \n                    تطبيق vsld هو أول تطبيق لدعم الأسر المنتجة بتسويق منتجاتها عبر تطبيق مخصص لهذا الغرض\n                    ',NULL,'2018-08-05 09:29:12','2021-11-06 14:45:47',NULL),(3,2,'en','Privacy Policy','privacy-policy','<p><strong>Permission Policy for Data Collection and User Consent</strong></p><p><strong>1. User Consent for Data Collection</strong></p><ul><li>Apps that collect user or usage data must secure user consent for the collection, even if such data is considered to be anonymous at the time of or immediately following collection.</li><li>Paid functionality must not be dependent on or require a user to grant access to this data.</li><li>Apps must provide the customer with an easily accessible and understandable way to withdraw consent.</li><li>Ensure your purpose strings clearly and completely describe your use of the data.</li></ul><p><strong>2. GDPR and Similar Statutes Compliance</strong></p><ul><li>Apps that collect data for a legitimate interest without consent by relying on the terms of the European Union’s General Data Protection Regulation (GDPR) or similar statutes must comply with all terms of that law.</li></ul><p><strong>3. Purpose Strings Requirements</strong></p><ul><li>Purpose strings must clearly describe how an app uses the ability, data, or resource.</li><li>The purpose strings must provide an example of the data\'s use.</li></ul><p><strong>Examples of Clear Purpose Strings</strong></p><ul><li>\"App would like to access your Contacts to help you find friends who are using this app.\"</li><li>\"App needs microphone access to enable voice messaging and voice commands.\"</li><li>\"App needs camera access to allow you to take and share photos within the app.\"</li><li>\"App needs access to your photo library to allow you to upload and share your photos.\"</li><li>\"App requires your username and password to securely log you into your account.\"</li><li>\"App needs access to your payment information to process your transactions.\"</li></ul>',NULL,'2018-08-05 09:30:08','2024-07-15 08:00:19',NULL),(4,2,'ar','الخصوصية','privacy-policy','<p>عند استخدام خدماتنا، فإنك تأتمننا على معلومات حسابك. نحن ندرك أن هذه مسؤولية كبيرة ونعمل بجدية لحماية معلوماتك سياسة الإذن لجمع البيانات وموافقة المستخدم</p><p>&nbsp;</p><p>1. موافقة المستخدم على جمع البيانات</p><p>&nbsp;</p><p>يجب أن تضمن التطبيقات التي تجمع بيانات المستخدم أو الاستخدام موافقة المستخدم على عملية التجميع، حتى لو كانت هذه البيانات تعتبر مجهولة المصدر في وقت التجميع أو بعده مباشرة.</p><p>يجب ألا تعتمد الوظائف المدفوعة على هذه البيانات أو تتطلب من المستخدم منح حق الوصول إليها.</p><p>يجب أن تزود التطبيقات العميل بطريقة يسهل الوصول إليها ومفهومة لسحب الموافقة.</p><p>تأكد من أن سلاسل الغرض الخاصة بك تصف بشكل واضح وكامل استخدامك للبيانات.</p><p>&nbsp;</p><p>2. الالتزام باللائحة العامة لحماية البيانات والقوانين المماثلة</p><p>&nbsp;</p><p>التطبيقات التي تجمع البيانات لمصلحة مشروعة دون موافقة من خلال الاعتماد على شروط اللائحة العامة لحماية البيانات (GDPR) للاتحاد الأوروبي أو القوانين المماثلة يجب أن تمتثل لجميع شروط هذا القانون.</p><p>&nbsp;</p><p>3. متطلبات سلاسل الغرض</p><p>&nbsp;</p><p>يجب أن تصف سلاسل الأغراض بوضوح كيفية استخدام التطبيق للقدرة أو البيانات أو المورد.</p><p>يجب أن توفر سلاسل الغرض مثالاً لكيفية استخدام البيانات.</p><p>&nbsp;</p><p>أمثلة على سلاسل ذات غرض واضح</p><p>&nbsp;</p><p>\"يرغب التطبيق في الوصول إلى جهات الاتصال الخاصة بك لمساعدتك في العثور على الأصدقاء الذين يستخدمون هذا التطبيق.\"</p><p>\"يحتاج التطبيق إلى الوصول إلى الميكروفون لتمكين المراسلة الصوتية والأوامر الصوتية.\"</p><p>\"يحتاج التطبيق إلى الوصول إلى الكاميرا للسماح لك بالتقاط الصور ومشاركتها داخل التطبيق.\"</p><p>\"يحتاج التطبيق إلى الوصول إلى مكتبة الصور الخاصة بك للسماح لك بتحميل صورك ومشاركتها.\"</p><p>\"يتطلب التطبيق اسم المستخدم وكلمة المرور لتسجيل الدخول إلى حسابك بشكل آمن.\"</p><p>\"يحتاج التطبيق إلى الوصول إلى معلومات الدفع الخاصة بك لمعالجة معاملاتك.\"ونمنحك التحكم فيها. \\r\\n\\r\\n</p>',NULL,'2018-08-05 09:30:11','2024-07-15 08:00:19',NULL),(5,3,'en','Terms Of Use','terms-of-use','\n                        \n                        \\r\\nIn order to use the  you must sign up for and maintain an effective personal user account (the \\\"Account\\\"). Account registration requires you to provide some personal information, such as your name, address, and mobile phone number. You agree to a note that may result from your failure to maintain your use of the order, or to the extent that you are able to access your personal information or subscribe to or exit shopping preferences, and your account username and password are at all times responsible.\n                        ',NULL,'2018-08-05 09:31:01','2021-12-08 14:21:36',NULL),(6,3,'ar','سياسة الاستخدام','terms-of-use','\n                        \n                        من أجل استخدام تطبيق ، يتعين عليك التسجيل للحصول على حساب مستخدم شخصي فعَّال والمحافظة عليه (\\\"الحساب\\\"). ويتطلب تسجيل الحساب تقديم بعض المعلومات الشخصية ، مثل اسمك وعنوانك ورقم هاتفك الجوال . وتوافق من جانبك على تدوين معلومات دقيقة وكاملة وحديثة في حسابك الخاص والمحافظة عليها. قد ينجم عن عدم التزامك المحافظة على معلومات حسابك إلى عدم تمكنك من  استخدام التطبيق، بما في ذلك قدرتك على طلب الوصول إلى معلوماتك الشخصية أو الاشتراك في تفضيلات التسوق أو الخروج منها، وتتحمل المسؤولية عن سائر الأنشطة التي تجري في حسابك، وتوافق على الحفاظ على أمان اسم المستخدم وكلمة المرور الخاصين بحسابك وسريتهما في جميع الأوقات. \n                        \n                        \n                        \n                        \n                        ',NULL,'2018-08-05 09:31:03','2021-12-08 14:21:36',NULL);
/*!40000 ALTER TABLE `page_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,NULL,0,'2018-08-05 09:27:40','2021-02-07 04:56:46',NULL),(2,'privacy-policy',0,'2018-08-05 09:27:42','2019-10-30 17:49:12',NULL),(3,NULL,0,'2018-08-05 09:27:49','2019-10-30 17:51:16',NULL);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('yash.tailor23@gmail.com','$2y$10$2ZlD.2Dts6ArNfr3dqYu3.DTc2fDcj5SVCvHlEUyy1uV29jCSKFXC','2023-03-12 10:36:26'),('yash1@hamiltonkw.com','$2y$10$0SRUq8qEaVV4MxwYSwN7lePnuGiyWSkHcjvXnwZjYqwkeouV8SGlu','2024-06-27 09:28:23'),('mustanseer@hamiltonkw.com','$2y$10$v3jv1Ba0Ad2P/cshxzDvueLC0RRZHrRjKMvY52uYNNS8SqT2jU6dC','2024-06-27 12:23:21'),('terid70498@mposhop.com','$2y$10$MxhWw2ZdXVCVqJY8NfhGH.n8WYFxecUTQNU9EZGvOBt4qXIkxYG5W','2024-06-30 09:00:02'),('jass@gmail.com','$2y$10$4KeXGhs9pbJmC8QOYqshZ.LnDu9u8poQiZJzafA8djvS4o3m6IED2','2024-07-09 10:06:50');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `payment_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transaction_id` bigint DEFAULT NULL,
  `track_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ref` bigint DEFAULT NULL,
  `total_price` float NOT NULL,
  `CstFName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `CstEmail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `CstMobile` int NOT NULL,
  `customer_unq_token` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reference` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,63,'100418510000020103',418510001612762,NULL,418510001429,14,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-03 14:24:23','2024-07-03 14:24:23'),(2,64,'100418510000020146',418510001614526,NULL,418510001432,14,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-03 14:26:35','2024-07-03 14:26:35'),(3,23,NULL,NULL,NULL,NULL,10,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-03 14:40:55','2024-07-03 14:40:55'),(4,71,'100418510000020704',418510001663576,NULL,418510001471,104,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-03 15:20:36','2024-07-03 15:20:36'),(5,72,'100418510000020771',418510001667207,NULL,418510001474,104,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-03 15:26:11','2024-07-03 15:26:11'),(6,73,'100418610000003622',418610000807237,NULL,418610000242,101,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-04 06:20:17','2024-07-04 06:20:17'),(7,74,'100418610000003800',418610000811994,NULL,418610000254,101,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-04 06:26:16','2024-07-04 06:26:16'),(8,75,'100418610000003850',418610000815473,NULL,418610000258,102,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-04 06:29:43','2024-07-04 06:29:43'),(9,76,'100418610000003944',418610000820556,NULL,418610000262,102,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-04 06:32:45','2024-07-04 06:32:45'),(10,77,'100418610000004107',418610000826704,NULL,418610000276,101,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-04 06:38:50','2024-07-04 06:38:50'),(11,78,'100418610000004296',418610000831366,NULL,418610000289,102,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-04 06:44:09','2024-07-04 06:44:09'),(12,79,'100418610000004429',418610000835835,NULL,418610000300,102,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-04 06:46:59','2024-07-04 06:46:59'),(13,80,'100418610000004792',418610000846520,NULL,418610000322,11,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-04 06:58:02','2024-07-04 06:58:02'),(14,81,'100418610000005511',418610000873792,NULL,418610000373,11,'TEST@yopmail.com','TEST@yopmail.com',123456,'123456','123456','2024-07-04 07:21:32','2024-07-04 07:21:32'),(15,23,'100325001000013888',325001000706886,NULL,325001000879,101,'325001000879','325001000879',2147483647,'32500100087','3250010008','2024-07-04 09:11:50','2024-07-04 09:11:50'),(16,89,'100418610000009128',418610001082020,NULL,418610000652,11,'gjjg jghf','jeets@gmail.com',1236868656,'1236868656','4186100006','2024-07-04 09:41:20','2024-07-04 09:41:20'),(17,89,'100418610000009128,',418610001082020,NULL,418610000652,11,'gjjg jghf,','jeets@gmail.com,',1236868656,'1236868656,','4186100006','2024-07-04 09:44:15','2024-07-04 09:44:15'),(18,92,'100418610000010485',418610001196050,NULL,418610000758,12,'ght','gst@gmail.com',2147483647,'6868689686','4186100007','2024-07-04 10:00:44','2024-07-04 10:00:44'),(19,93,'100418610000010696',418610001276469,NULL,418610000773,12,'rhrh','tehdg@gmail.com',2147483647,'9787848484','4186100007','2024-07-04 10:05:15','2024-07-04 10:05:15'),(20,96,'100418610000010963',418610001289828,NULL,418610000791,14,'test12','test12@gmail.com',2147483647,'9464515181','4186100007','2024-07-04 10:09:53','2024-07-04 10:09:53'),(21,104,'100419010000009463',419010002166744,NULL,419010000687,104,'yash007','yash@hamiltonkw.com',2147483647,'8209528643','4190100006','2024-07-08 10:33:19','2024-07-08 10:33:19'),(22,106,'100419010000010214',419010002214536,NULL,419010000748,51,'yash','Yash1233@gmail.com',65326538,'65326538','4190100007','2024-07-08 10:57:47','2024-07-08 10:57:47'),(23,107,'100419110000018817',419110002680801,NULL,419110001371,52,'test12','test12@gmail.com',94645151,'94645151','4191100013','2024-07-09 14:30:51','2024-07-09 14:30:51'),(24,108,'100419110000018898',419110002684177,NULL,419110001376,52,'test12','test12@gmail.com',94645151,'94645151','4191100013','2024-07-09 14:34:07','2024-07-09 14:34:07'),(25,109,'100419110000018961',419110002688028,NULL,419110001381,52,'test12','test12@gmail.com',94645151,'94645151','4191100013','2024-07-09 14:36:43','2024-07-09 14:36:43'),(26,111,'100419110000019040',419110002700842,NULL,419110001388,54,'test12','test12@gmail.com',94645151,'94645151','4191100013','2024-07-09 14:41:11','2024-07-09 14:41:11'),(27,113,'100419110000019082',419110002706053,NULL,419110001390,51,'test12','test12@gmail.com',94645151,'94645151','4191100013','2024-07-09 14:46:54','2024-07-09 14:46:54'),(28,115,'100419110000019136',419110002723919,NULL,419110001394,51,'test12','test12@gmail.com',94645151,'94645151','4191100013','2024-07-09 14:58:26','2024-07-09 14:58:26'),(29,116,'100419110000019140',419110002724182,NULL,419110001395,51,'test12','test12@gmail.com',94645151,'94645151','4191100013','2024-07-09 14:59:53','2024-07-09 14:59:53'),(30,121,'100419210000010389',419210001616260,NULL,419210000755,101,'test12','test12@gmail.com',94645151,'94645151','4192100007','2024-07-10 09:53:15','2024-07-10 09:53:15');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_translations`
--

DROP TABLE IF EXISTS `permission_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `permission_id` int NOT NULL,
  `locale` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_translations`
--

LOCK TABLES `permission_translations` WRITE;
/*!40000 ALTER TABLE `permission_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` bigint NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (1,11,'1_t0liac77__1721027070_6634934.jpg','2024-07-15 07:04:31','2024-07-15 07:04:31');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_translations`
--

DROP TABLE IF EXISTS `product_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `locale` varchar(199) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_translations`
--

LOCK TABLES `product_translations` WRITE;
/*!40000 ALTER TABLE `product_translations` DISABLE KEYS */;
INSERT INTO `product_translations` VALUES (1,1,'en','Honey','Honey','2023-10-03 11:21:59','2023-10-03 11:21:59',NULL),(2,1,'ar','Honey','Honey','2023-10-03 11:21:59','2023-10-03 11:21:59',NULL),(3,2,'en','White Honey','White Honey Description','2023-10-29 14:48:15','2023-10-29 14:48:15',NULL),(4,2,'ar','Whiyte Honey','White Honey Description','2023-10-29 14:48:15','2023-10-29 14:48:15',NULL),(5,3,'en','Lawrence Oliver','Facilis voluptatem','2023-10-29 14:48:31','2023-10-29 14:48:31',NULL),(6,3,'ar','Vielka Sellers','Aut nihil sunt a sus','2023-10-29 14:48:31','2023-10-29 14:48:31',NULL),(7,4,'en','honey','test','2023-11-06 06:46:01','2023-11-06 06:46:01',NULL),(8,4,'ar','honey','test','2023-11-06 06:46:01','2023-11-06 06:46:01',NULL),(9,5,'en','Hayley Fulton','Fulton','2024-06-09 08:17:10','2024-06-09 08:17:10',NULL),(10,5,'ar','Fulton','Fulton','2024-06-09 08:17:10','2024-06-09 08:17:10',NULL),(11,6,'en','honey','test','2024-06-27 11:29:33','2024-06-27 11:29:33',NULL),(12,6,'ar','honey','test','2024-06-27 11:29:33','2024-06-27 11:29:33',NULL),(13,7,'en','honey','honey','2024-07-01 06:37:59','2024-07-01 06:37:59',NULL),(14,7,'ar','honey','honey','2024-07-01 06:37:59','2024-07-01 06:37:59',NULL),(15,8,'en','black','black','2024-07-04 12:24:32','2024-07-04 12:24:32',NULL),(16,8,'ar','black','black','2024-07-04 12:24:32','2024-07-04 12:24:32',NULL),(17,9,'en','honey123','test','2024-07-08 06:54:23','2024-07-08 06:54:23',NULL),(18,9,'ar','honey123','te','2024-07-08 06:54:23','2024-07-08 06:54:23',NULL),(19,10,'en','honeyy','test','2024-07-08 10:41:54','2024-07-08 10:41:54',NULL),(20,10,'ar','honeyy','test','2024-07-08 10:41:54','2024-07-08 10:41:54',NULL),(21,11,'en','test','test','2024-07-15 07:04:30','2024-07-15 07:04:30',NULL),(22,11,'ar','test','test','2024-07-15 07:04:30','2024-07-15 07:04:30',NULL),(23,12,'en','test','test','2024-07-15 07:06:17','2024-07-15 07:06:17',NULL),(24,12,'ar','test','test','2024-07-15 07:06:17','2024-07-15 07:06:17',NULL),(25,13,'en','test product','gahahja','2024-07-15 07:08:20','2024-07-15 07:08:20',NULL),(26,13,'ar','twga','hahahja','2024-07-15 07:08:20','2024-07-15 07:08:20',NULL);
/*!40000 ALTER TABLE `product_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_vitamin`
--

DROP TABLE IF EXISTS `product_vitamin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_vitamin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_id` int DEFAULT NULL,
  `title` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title_ar` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_vitamin`
--

LOCK TABLES `product_vitamin` WRITE;
/*!40000 ALTER TABLE `product_vitamin` DISABLE KEYS */;
INSERT INTO `product_vitamin` VALUES (4,'DdqzEUqGBYGq6Bc10521481718284454_9036805.jpg',NULL,'VITAMIN A','VITAMIN A','VITAMIN A','VITAMIN A','2024-06-13 13:14:14','2024-06-13 13:14:14'),(5,'mrzMbZRoOmMaWoY63173891718284905_1106783.jpg',NULL,'Omnis aut dolore','Consectetur dolor q','Aliqua Et dicta ','Quia consequatur mi','2024-06-13 13:21:46','2024-06-13 13:21:46'),(6,'1RyeNd3ElDC267W93114971718285260_5012212.jpg',NULL,'neew','title des','new','title titleAR','2024-06-13 13:27:42','2024-06-13 13:27:42'),(7,'6NX5bmVko5Ou1Nq74844441718286245_3047547.jpg',NULL,'NEWD test','sdfdfsdfdsfsdf','new','sdffgdggghhgh','2024-06-13 13:44:06','2024-06-13 13:44:06'),(8,'i31G2F0leX1o7iX25647611718288821_6891371.jpeg',NULL,'new','sdfdfsdfdsfsdf','new','sdffgdggghhgh','2024-06-13 14:27:01','2024-06-13 14:27:01'),(9,'NvAkvRUPdwYbz7X58026841718289225_4617979.jpg',NULL,'new','sdfdfsdfdsfsdf','new','sdffgdggghhgh','2024-06-13 14:33:46','2024-06-13 14:33:46'),(10,'J5RAn855mGtAYzI36189441718289265_4561930.jpg',NULL,'NEWD test','sdfdfsdfdsfsdf','new','sdffgdggghhgh','2024-06-13 14:34:26','2024-06-13 14:34:26'),(11,'N97RuRl9Z3MgrxE53605201718289307_5537701.jpg',NULL,'NEWD test','sdfdfsdfdsfsdf','new','sdffgdggghhgh','2024-06-13 14:35:07','2024-06-13 14:35:07'),(12,'HtVzP96bdFaQs0Q30667411718289952_4894819.jpg',NULL,'NEWD test','sdfdfsdfdsfsdf','new','sdffgdggghhgh','2024-06-13 14:45:53','2024-06-13 14:45:53'),(13,'E9WCQx8WMmgmEri86991831720103751_7701547.jpg',NULL,'new','sdfdfsdfdsfsdf','new','sdffgdggghhgh','2024-07-04 14:35:51','2024-07-04 14:35:51');
/*!40000 ALTER TABLE `product_vitamin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '1111',
  `category_id` int DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discount_price` double DEFAULT NULL,
  `vender_price` double DEFAULT NULL,
  `offer_end_date` date NOT NULL DEFAULT '2033-04-28',
  `quantity` int DEFAULT NULL,
  `age_id` int DEFAULT NULL,
  `gender` int DEFAULT NULL COMMENT '0->male , 1->female , 2->both',
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `vender_id` int NOT NULL DEFAULT '0' COMMENT ' 0 =admin (default)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_age_id_foreign` (`age_id`),
  CONSTRAINT `products_age_id_foreign` FOREIGN KEY (`age_id`) REFERENCES `ages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'EgTCyhxmlT8ELbV46755061696332119_7043111.jpg','Nihil repellendus A',1,8,2,NULL,'2023-10-03',120,NULL,NULL,'not_active',0,'2023-10-03 11:21:59','2024-07-04 14:22:34',NULL),(2,'yFRXrmxSxc3yqXK15065531698590894_4421575.jpg','wh1',1,20,NULL,NULL,'2033-04-28',15,2,0,'not_active',4,'2023-10-29 14:48:15','2024-07-04 14:22:34',NULL),(3,'TbgRWr54aKEklsl23445901698590911_6777597.jpg','Quae do qui sit iure',1,922,46,NULL,'1988-04-28',926,1,1,'not_active',3,'2023-10-29 14:48:31','2024-07-04 14:22:34',NULL),(4,'8nMbPDkViqHquzr95963331699253160_2367392.jpg','honey',1,100,NULL,NULL,'2023-12-01',99,NULL,NULL,'not_active',5,'2023-11-06 06:46:01','2024-07-04 14:22:34',NULL),(5,'HCMUfTZjOkO8SpU18806521717921030_6330996.jpg','asd',2,100,50,NULL,'2024-07-31',30,NULL,NULL,'active',0,'2024-06-09 08:17:10','2024-07-04 12:10:34',NULL),(6,'u5wxaZNHGwMkjEK66078621719487773_3415704.jpg','honey',3,100,90,0,'2027-10-27',100,NULL,NULL,'active',6,'2024-06-27 11:29:33','2024-07-04 14:21:09',NULL),(7,'VEo6GI1NRtMBvlo48185011719815879_6121426.jpg','honey',2,10,5,0,'2024-07-17',10,NULL,NULL,'active',7,'2024-07-01 06:37:59','2024-07-02 13:57:29','2024-07-02 13:57:29'),(8,'ICP1H0w77TIHq3H53853301720095872_9764334.jpg','black',2,100,80,NULL,'2024-07-31',6,NULL,NULL,'active',9,'2024-07-04 12:24:32','2024-07-04 14:04:44','2024-07-04 14:04:44'),(9,'asSUvfENCbMxAYQ55865811720421663_4575136.jpg','tes',3,100,0,NULL,'2024-07-08',9,1,NULL,'active',0,'2024-07-08 06:54:23','2024-07-08 10:33:19',NULL),(10,'D8Q4rBMlCJR2pdX44960621720435314_2398628.jpg','honey11',2,100,50,0,'2024-07-08',8,1,1,'active',13,'2024-07-08 10:41:54','2024-07-10 09:53:15',NULL),(11,'sbkCIfUcyNfYcwq22013851721027069_3750000.jpg','test',2,10,10,NULL,'2024-07-19',10,1,NULL,'not_active',0,'2024-07-15 07:04:30','2024-07-15 07:04:30',NULL),(12,'zYJqE5aDhYrnEq839525091721027175_4028294.jpg','test',2,10,10,NULL,'2024-07-19',10,1,NULL,'not_active',0,'2024-07-15 07:06:17','2024-07-15 07:06:17',NULL),(13,'vKmRVzxrFN9V1P344360411721027299_6680339.jpg','hah',2,54,10,0,'2024-07-18',10,1,1,'not_active',13,'2024-07-15 07:08:20','2024-07-15 07:08:35','2024-07-15 07:08:35');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions`
--

LOCK TABLES `role_permissions` WRITE;
/*!40000 ALTER TABLE `role_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_translations`
--

DROP TABLE IF EXISTS `role_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_translations`
--

LOCK TABLES `role_translations` WRITE;
/*!40000 ALTER TABLE `role_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting_translations`
--

DROP TABLE IF EXISTS `setting_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setting_translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `setting_id` int NOT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_words` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_translations`
--

LOCK TABLES `setting_translations` WRITE;
/*!40000 ALTER TABLE `setting_translations` DISABLE KEYS */;
INSERT INTO `setting_translations` VALUES (1,1,'ar','ASAL','Pido Description',NULL,NULL,'2023-10-29 14:34:53'),(2,1,'en','ASAL','Pido Description',NULL,NULL,'2023-10-29 14:34:53');
/*!40000 ALTER TABLE `setting_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_amount` double DEFAULT NULL,
  `app_percent` int DEFAULT NULL,
  `points_in_mony` double DEFAULT NULL,
  `mony_in_points` double DEFAULT NULL,
  `app_store_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `play_store_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paginate` int DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linked_in` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tik_tok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_order` double NOT NULL DEFAULT '0',
  `from_hour` time DEFAULT NULL,
  `to_hour` time DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_maintenance_mode` int DEFAULT '0' COMMENT '0->off , 1->on',
  `is_alowed_login` int DEFAULT '0' COMMENT '0->off , 1->on',
  `is_alowed_register` int DEFAULT '0' COMMENT '0->off , 1->on',
  `is_alowed_buying` int DEFAULT '0' COMMENT '0->off , 1->on',
  `is_alowed_cart` int DEFAULT '0' COMMENT '0->off , 1->on',
  `cancel_order_time` int DEFAULT NULL,
  `delivery_cost_per_km` double DEFAULT '10',
  `product_distance` double DEFAULT '40',
  `home_vedio_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_vedio_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `seo_in_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_in_header` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'','fxIAMgbIPGFsZ6t34231841718286340_7735660.png',5,5,1,10,'https://www.apple.com/ios/app-store/','https://play.google.com/store','ASAL@home.com','66457961','',0,'https://facebook.com','https://twitter.com/smpany','','https://www.instagram.com/ss_company','dd',5,'08:00:00','23:00:00','pido address','24.782759385577478','46.6370350187467','','nfEJJIR2BMV81ke33120381635842439_5400095.png',0,0,0,0,0,15,15,15,'8mn5YbWjzLiijjN84699951640868516_3278824.png','https://www.youtube.com/',NULL,'2024-06-13 13:45:41','5','5');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subadmins`
--

DROP TABLE IF EXISTS `subadmins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subadmins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subadmins`
--

LOCK TABLES `subadmins` WRITE;
/*!40000 ALTER TABLE `subadmins` DISABLE KEYS */;
/*!40000 ALTER TABLE `subadmins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribe_emails`
--

DROP TABLE IF EXISTS `subscribe_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscribe_emails` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribe_emails`
--

LOCK TABLES `subscribe_emails` WRITE;
/*!40000 ALTER TABLE `subscribe_emails` DISABLE KEYS */;
INSERT INTO `subscribe_emails` VALUES (4,'yash.tailor23@gmail.com','2023-11-05 10:55:32','2023-11-05 10:55:32',NULL);
/*!40000 ALTER TABLE `subscribe_emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `fcm_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0->android , 1 ->ios',
  `accept` int DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'ar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tokens_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokens`
--

LOCK TABLES `tokens` WRITE;
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
INSERT INTO `tokens` VALUES (1,11,'fERXRRL0TRmQTKXrPLMMst:APA91bECHeS0_e1kTNQM0aRMTVYv0XfelElRO6B9IeG6ZvSSm1KWr5ChClCjzXt2ztudTPxcl6oFqn-QTStHIfbM8zGraNWoTmCqvAQcD4WV5Re7D7S6T9jVxxZSXnm0Ots4m7UGC3o5','0',NULL,'en','2024-06-04 10:27:20','2024-06-05 12:10:28',NULL),(2,12,'73438349349994jfi88','0',NULL,'en','2024-06-05 12:43:10','2024-06-09 06:34:35',NULL),(3,13,'ctysaxDFSXOEg24SYzo1HG:APA91bFUdxSRl0BZ4U7myrqa0xBq2--Oq2VqUvQ7ciy0b8Z9yRx8BX8EnarbMb-RXQTWR8QbzFI4ejiBBS4BDuSURvEh4b7UZMK279cw4YTWbPYhBtBHms5cHOk5JRlhED8JvxwFKx6Z','0',NULL,'en','2024-06-27 09:22:26','2024-06-30 09:08:44',NULL),(4,0,'ctysaxDFSXOEg24SYzo1HG:APA91bFUdxSRl0BZ4U7myrqa0xBq2--Oq2VqUvQ7ciy0b8Z9yRx8BX8EnarbMb-RXQTWR8QbzFI4ejiBBS4BDuSURvEh4b7UZMK279cw4YTWbPYhBtBHms5cHOk5JRlhED8JvxwFKx6Z','0',NULL,'en','2024-06-27 09:41:48','2024-06-27 10:11:57',NULL),(5,15,'','0',NULL,'en','2024-06-27 12:21:31','2024-07-04 14:23:20',NULL),(6,16,'eT6izlYXSSm4PlpG8L6wo2:APA91bEDtq-pG4Q_cF9kdX9UcLfykApYNvDdsmOlpS0RqrvpSEhEQRm9JvS9VTto_TAmWgiu7fr_Afi5dGhP6fHoeaJ4cMIxk4zKOm3poHyPAGtJv8xac2SSJZODeijMsOuYB1XbN7bH','0',NULL,'en','2024-06-30 06:05:16','2024-07-02 12:04:44',NULL),(7,0,'fdiYPGefRWmSBx45II8POm:APA91bEGluZpTuacPso6Bdp8mYAPnF1kdMyOo4iK72LIxvfnLzZ2Cpg3JNHZyTZtlyyv624Q7pZ5yvvvf8-_7kz8yXb4rg82csuf644YTOpeMaI4i55EReeoDeUw9NTnKx704BYjfkNU','0',NULL,'en','2024-06-30 13:25:44','2024-06-30 14:25:35',NULL),(8,0,'dTCNIEMnRJaBweJ66vYgTU:APA91bFdL6Mc61IoRIDQ5Di6jgC7RVhj02qarSae_KNTQ5gbLl3x4j0JLZOW0Fv4VI9jF-LkgJnM2GKgf5eLVUo2nLTmt2S6n1jPxx_y2Oa-LgFMLJnuwVWq4yuJBfhvatWy0_8XxEd3','0',NULL,'en','2024-07-01 06:32:10','2024-07-01 06:32:10',NULL),(9,0,'fId2AalBR-y9z68MM5SaM7:APA91bGAQhQeJAWh5Zzt61Ae21PMUa8EOslhtJ0SrX4ywqJr23SEoMYsrb2U8AG3Da1uzEvR2Wd7PkWMq-GVyd5gKeucQPq7nTTuGWdh-ER2Zx8Kuae48k5v1hGmqTu1c1AqA0i8QTB1','0',NULL,'en','2024-07-01 13:16:33','2024-07-01 13:17:34',NULL),(10,28,'efnLAZp5SJ-zduX07gxCm5:APA91bHfS77WM17NtJgHMMvtqP7CNF7dY7lcg1HUJvpdWrONhahVpcBOQ4fJxoOCv_tv7_u9k5An41PVPRxGvjBoCY9wR3-Q89nBsf552knAoin9Ra-9Sx503LtKNFFTgkF8zkwNldqz','0',NULL,'en','2024-07-02 12:07:13','2024-07-02 12:07:13',NULL),(11,0,'f_QZ8MTyTxiPFdJinL7L-r:APA91bFminwibz7XjAF8nIhByKCgiT2t7qpXuLJsxqRBeF8-d76ibZqENp4eKWSB24V8vChTtHmCoJCZbNdYytAXdgNNdqPN1K09SCGmXhYYOWLuBSOG5_V5Y0KlNz69T0PS-awqwyc8','0',NULL,'en','2024-07-02 14:15:04','2024-07-07 11:47:12',NULL),(12,71,'e-Ng3DeiTKKXiBigXZqtYg:APA91bGeO_zttHWpRKEHxpAKEwcKQYMdPpcfZeTC8oBnP-6dhpq_h4O6cAC7wuJhhf_C4CyOVi4BsFWfKQKMRxFu4bQbJp75XHaLdz7uvaWSZs-Fa7onGf2Qght100e41h1n40JQ_yEk','0',NULL,'en','2024-07-04 10:22:43','2024-07-04 15:16:05',NULL),(13,72,'random-fcm39154308','0',NULL,'en','2024-07-04 15:43:07','2024-07-09 13:11:21',NULL),(14,0,'cEzqhgXHSfSm6RoPXM-_sx:APA91bF_iV1W9gccm2lDuIf2Txa2vVwRBsFpYuJJlBVifkDXBd8-vxyokRTgZEwf-bAL7cVzpGMC2g8YOYxRdPQplPlqQIrOrDvmKpNW2O696CSCJ160D2L18KA5RsRg_xEB8CsM9NvP','0',NULL,'en','2024-07-08 10:22:06','2024-07-08 10:39:19',NULL),(15,1,'cEzqhgXHSfSm6RoPXM-_sx:APA91bF_iV1W9gccm2lDuIf2Txa2vVwRBsFpYuJJlBVifkDXBd8-vxyokRTgZEwf-bAL7cVzpGMC2g8YOYxRdPQplPlqQIrOrDvmKpNW2O696CSCJ160D2L18KA5RsRg_xEB8CsM9NvP','0',NULL,'en','2024-07-08 10:27:37','2024-07-08 10:28:09',NULL),(16,30,'caq7jeHQJ0jrtS6GqdfWfM:APA91bGxPjuNGEcRIwGSGhOjO6esF0zKqvDGzcA6FkdURKliPYqSqdSyThkeoS1g3Bk6O9DU4e7hmENtPNO_MrLqkEiuRvteX6WebQAGxLoVR3ZSTO337zahAqVz0xDc01r8NK7eD40Q','1',NULL,'en','2024-07-08 10:32:31','2024-07-15 13:15:17',NULL),(17,76,'frCWam2dQp-YADLjkTRTT5:APA91bFPuxNNyymUr-FzLJBtIZtWg1ydKYAgWqqdxUptjp4wI49KfrbrczInx4cGjx8g0ALXDMk7-HGZ66BY2J3TQN3NsVYML2EdZbF8FV97txR1AXsPSss3410KR-g2wyfSKNFNfz3C','0',NULL,'en','2024-07-09 09:23:40','2024-07-09 10:04:11',NULL),(18,73,'dcjd1PDxLUVVr4wVoZZ5HG:APA91bFieL6boI3NSXN-Bib1gaISAfF7CA767Q83k3oP1sNmPmzsmX2Z9OAid8-_z9LS-wAf8wU13FqcXnhJyl3CqqOfRmTU-b6WhiC6eWsybYgu_9GfvRp9Ccx4_kqGCsAOY1AIvU5f','1',NULL,'en','2024-07-11 07:06:10','2024-07-11 07:06:10',NULL),(19,0,'dgRvDlAZMk6jpmgxzCBjF4:APA91bHcJgvWVryg2cbzztEjao4s6sV8pe-Af-iPT0kbE1WFbOL3vbITx69r_M9FP8yaBg57eGL-KT07c9CG7Yw7-kSLR9ugYD-QkvR4m0rg6rGvxd3cGHGqp7XnoGEO8zj6hXV4M37a','1',NULL,'en','2024-07-15 11:21:46','2024-07-15 11:23:39',NULL),(20,0,'cML7Upjdl0ImsLsUTa6FLl:APA91bHCuET-gUp2A8EklfuWQcgqS9ql7F_Oz06R3VrO92q0t5W7akMv5a1UI2HLNYtpQ85kMRMW3WU6FU-yYiq1aND_1VOwPXxdSsQ3qaoSup3ruAEMsqsG8EPfBf6hfRLeowizdHMB','1',NULL,'en','2024-07-18 09:43:27','2024-07-18 09:43:27',NULL);
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `use_coupons`
--

DROP TABLE IF EXISTS `use_coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `use_coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `coupons_id` int NOT NULL,
  `user_id` int NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `use_coupons`
--

LOCK TABLES `use_coupons` WRITE;
/*!40000 ALTER TABLE `use_coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `use_coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_addresses`
--

DROP TABLE IF EXISTS `user_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_addresses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `address_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_type` int NOT NULL COMMENT '1=>home, 2=>office',
  `area_id` int DEFAULT NULL,
  `block` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `defult` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1->defult',
  `avenue` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_building` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landmark` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_addresses_user_id_foreign` (`user_id`),
  KEY `user_addresses_area_id_foreign` (`area_id`),
  CONSTRAINT `user_addresses_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_addresses`
--

LOCK TABLES `user_addresses` WRITE;
/*!40000 ALTER TABLE `user_addresses` DISABLE KEYS */;
INSERT INTO `user_addresses` VALUES (1,'CWH7+G5 Mountain View, CA, USA',1,4,'007','kuwait',1,0,'q','01','21113235','123','-122.0870890840888','37.428859387778374','CWH7+G5 Mountain View, CA, USA','2023-10-29 07:21:15','2024-07-08 10:31:56',NULL),(2,'Kylynn Hopkins',0,4,'','Suscipit aliqua Sed',2,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-29 07:30:12','2023-10-29 07:30:12',NULL),(3,'Testing',0,2,'','Testing',3,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-30 08:51:19','2023-11-06 06:18:16','2023-11-06 06:18:16'),(4,'kuwait',0,1,'001','kuwait',1,0,NULL,'001',NULL,NULL,NULL,NULL,NULL,'2023-11-05 10:57:39','2024-07-08 10:23:04','2024-07-08 10:23:04'),(5,'Office',0,4,'7','95',4,0,NULL,'23',NULL,NULL,NULL,NULL,NULL,'2023-11-05 11:12:21','2023-11-05 11:12:21',NULL),(6,'kuwait',0,5,'','001',3,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-06 06:18:27','2023-11-06 06:18:27',NULL),(7,'kuwait',0,2,'','kuwait',5,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-06 06:19:50','2023-11-06 06:19:50',NULL),(8,'test Address',0,1,'','test Address',6,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-06 13:12:30','2023-11-06 13:12:30',NULL),(9,'Georgia Copeland',0,1,'','Voluptatem Voluptat',7,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-20 09:27:21','2023-11-20 09:27:21',NULL),(10,'sharq',0,5,'','10',8,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-09 11:39:33','2024-01-09 11:39:33',NULL),(11,'test Address',0,2,'','test Address',9,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-09 12:31:09','2024-01-09 12:31:09',NULL),(12,'test Address',0,2,'','dd',10,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 13:37:31','2024-04-23 13:37:31',NULL),(13,'2000 N Shoreline Blvd, Mountain View, CA 94043, USA',0,1,'','33',11,0,NULL,NULL,NULL,NULL,'-122.0803550630808','37.42200937252055',NULL,'2024-06-04 10:32:11','2024-06-04 12:53:35',NULL),(14,'8V97+3C نسفوران، استان سیستان و بلوچستان، Iran',0,2,'','007',11,0,NULL,NULL,NULL,NULL,'59.86358530819417','26.317644038306053',NULL,'2024-06-05 09:35:55','2024-06-05 09:35:55',NULL),(15,'6W2H+J3 Abdullah Al Mubarak Al Sabah, Kuwait',1,3,'F','007',12,0,'shyamal','123','8523697412','test 12','47.927636839449406','29.20153706197345','6W2H+J3 Abdullah Al Mubarak Al Sabah, Kuwait','2024-06-05 12:44:47','2024-06-09 08:04:48',NULL),(16,'قطعة ٣ محطة كهرباء تحويل رئيسية, Kuwait',0,2,'','008',12,0,NULL,NULL,NULL,NULL,'47.999047972261906','29.29180360332345',NULL,'2024-06-06 05:58:59','2024-06-06 06:17:22','2024-06-06 06:17:22'),(17,'7X9X+7X9, Faris Abdulrahman Al Waqayan St, Zahra, Kuwait',0,4,'','008',12,0,NULL,NULL,NULL,NULL,'48.0008789151907','29.26784677425069',NULL,'2024-06-06 06:21:57','2024-06-06 06:23:26','2024-06-06 06:23:26'),(18,'7223+4R Sabah Al Salem, Kuwait',0,3,'','008',12,0,NULL,NULL,NULL,NULL,'48.004541136324406','29.250274766498414',NULL,'2024-06-06 06:24:30','2024-06-06 07:04:55','2024-06-06 07:04:55'),(19,'62W4+R5 Sabah Al Salem, Kuwait',0,2,'','008',12,0,NULL,NULL,NULL,NULL,'48.005456775426865','29.24707974440319',NULL,'2024-06-06 07:06:09','2024-06-06 07:09:23','2024-06-06 07:09:23'),(20,'62J8+82Q, Sabah Al Salem, Kuwait',0,2,'','008',12,0,NULL,NULL,NULL,NULL,'48.015527464449406','29.231101967204076',NULL,'2024-06-06 07:12:09','2024-06-06 07:14:03','2024-06-06 07:14:03'),(21,'525R+23 Hadiya, Kuwait',0,3,'','99',12,0,NULL,NULL,NULL,NULL,'48.040246702730656','29.157573081451932',NULL,'2024-06-06 07:16:03','2024-06-06 07:27:11','2024-06-06 07:27:11'),(22,'Hawally، Jassem Mohammad Al-Kharafi Rd, Zahra, Kuwait',0,4,'','009',12,0,NULL,NULL,NULL,NULL,'48.002710193395615','29.267048019066934',NULL,'2024-06-06 07:31:25','2024-06-06 09:40:49','2024-06-06 09:40:49'),(23,'6RFH+64 غرب عبدالله المبارك، Kuwait',0,2,'','Jaat land',12,0,NULL,NULL,NULL,NULL,'47.82784424722195','29.223112436003646',NULL,'2024-06-06 09:43:15','2024-06-06 09:57:47','2024-06-06 09:57:47'),(24,'7HX9HPX2+F6',0,1,'','76',12,0,NULL,NULL,NULL,NULL,'47.70058583468199','29.598749993755792',NULL,'2024-06-06 09:58:41','2024-06-06 10:07:35','2024-06-06 10:07:35'),(25,'7HX9GM4G+G8',0,1,'','007',12,0,NULL,NULL,NULL,NULL,'47.67586659640074','29.50636532274465',NULL,'2024-06-06 10:00:51','2024-06-06 10:07:00','2024-06-06 10:07:00'),(26,'7HX9GM4G+G8',0,1,'','007',12,0,NULL,NULL,NULL,NULL,'47.67586659640074','29.50636532274465',NULL,'2024-06-06 10:03:32','2024-06-06 10:06:58','2024-06-06 10:06:58'),(27,'7HX9GM4G+G8',0,1,'','007',12,0,NULL,NULL,NULL,NULL,'47.67586659640074','29.50636532274465',NULL,'2024-06-06 10:03:32','2024-06-06 10:06:55','2024-06-06 10:06:55'),(28,'5WRC+Q4 Abdullah Al Mubarak Al Sabah, Kuwait',0,2,'','009',12,0,NULL,NULL,NULL,NULL,'47.920312732458115','29.19194654884789',NULL,'2024-06-06 10:18:43','2024-06-06 10:39:28','2024-06-06 10:39:28'),(29,'6Q9C+X3 Al Jahra, Kuwait',0,2,'','009',12,0,NULL,NULL,NULL,NULL,'47.7701660245657','29.219916273430695',NULL,'2024-06-06 10:44:36','2024-06-06 11:11:12','2024-06-06 11:11:12'),(30,'6XW4+GQ Al-Dajeej, Kuwait',0,3,'','007',12,0,NULL,NULL,NULL,NULL,'47.9569336026907','29.24628082702135',NULL,'2024-06-06 11:12:06','2024-06-06 11:12:41','2024-06-06 11:12:41'),(31,'6VCM+74 غرب عبدالله المبارك، Kuwait',0,3,'','009',12,0,NULL,NULL,NULL,NULL,'47.88277588784695','29.22071539657651',NULL,'2024-06-06 11:14:11','2024-06-06 11:19:08','2024-06-06 11:19:08'),(32,'7HX95RVQ+PV',0,2,'','009',12,0,NULL,NULL,NULL,NULL,'47.839746214449406','29.194344261227396',NULL,'2024-06-06 11:25:52','2024-06-06 11:27:45','2024-06-06 11:27:45'),(33,'7R48+MP Al Jahra, Kuwait',0,2,'','009',12,0,NULL,NULL,NULL,NULL,'47.81685791909695','29.256665096370607',NULL,'2024-06-06 11:28:36','2024-06-06 11:40:20','2024-06-06 11:40:20'),(34,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 11:32:00','2024-06-09 05:42:21','2024-06-09 05:42:21'),(35,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 11:34:53','2024-06-06 11:40:25','2024-06-06 11:40:25'),(36,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 12:16:29','2024-06-09 05:40:29','2024-06-09 05:40:29'),(37,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:18:51','2024-06-09 05:40:27','2024-06-09 05:40:27'),(38,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:18:58','2024-06-09 05:40:25','2024-06-09 05:40:25'),(39,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:19:01','2024-06-09 05:40:23','2024-06-09 05:40:23'),(40,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:19:11','2024-06-09 05:40:21','2024-06-09 05:40:21'),(41,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:19:25','2024-06-09 05:40:19','2024-06-09 05:40:19'),(42,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:19:29','2024-06-09 05:40:17','2024-06-09 05:40:17'),(43,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:19:43','2024-06-09 05:40:15','2024-06-09 05:40:15'),(44,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:19:46','2024-06-09 05:40:13','2024-06-09 05:40:13'),(45,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:19:47','2024-06-09 05:40:11','2024-06-09 05:40:11'),(46,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:19:51','2024-06-09 05:40:09','2024-06-09 05:40:09'),(47,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:19:53','2024-06-09 05:40:03','2024-06-09 05:40:03'),(48,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:19:55','2024-06-09 05:40:01','2024-06-09 05:40:01'),(49,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:19:57','2024-06-09 05:39:58','2024-06-09 05:39:58'),(50,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:19:58','2024-06-09 05:39:56','2024-06-09 05:39:56'),(51,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:20:00','2024-06-09 05:39:54','2024-06-09 05:39:54'),(52,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:20:01','2024-06-09 05:39:53','2024-06-09 05:39:53'),(53,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:20:03','2024-06-09 05:39:51','2024-06-09 05:39:51'),(54,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:20:05','2024-06-09 05:39:49','2024-06-09 05:39:49'),(55,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:20:11','2024-06-09 05:39:46','2024-06-09 05:39:46'),(56,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:20:21','2024-06-09 05:39:42','2024-06-09 05:39:42'),(57,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:20:23','2024-06-09 05:39:40','2024-06-09 05:39:40'),(58,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:20:43','2024-06-09 05:39:37','2024-06-09 05:39:37'),(59,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:20:45','2024-06-09 05:39:34','2024-06-09 05:39:34'),(60,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:28:17','2024-06-09 05:39:32','2024-06-09 05:39:32'),(61,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:28:33','2024-06-09 05:39:30','2024-06-09 05:39:30'),(62,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:28:43','2024-06-09 05:39:28','2024-06-09 05:39:28'),(63,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:28:59','2024-06-09 05:39:24','2024-06-09 05:39:24'),(64,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:29:53','2024-06-09 05:39:21','2024-06-09 05:39:21'),(65,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:29:55','2024-06-09 05:39:19','2024-06-09 05:39:19'),(66,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-06 13:29:56','2024-06-09 05:39:17','2024-06-09 05:39:17'),(67,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 05:41:36','2024-06-09 05:41:48','2024-06-09 05:41:48'),(68,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 05:41:52','2024-06-09 05:41:59','2024-06-09 05:41:59'),(69,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 05:42:28','2024-06-09 06:35:15','2024-06-09 06:35:15'),(70,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:15:05','2024-06-09 06:34:35','2024-06-09 06:34:35'),(71,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:26:23','2024-06-09 06:34:34','2024-06-09 06:34:34'),(72,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:26:57','2024-06-09 06:34:32','2024-06-09 06:34:32'),(73,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:29:37','2024-06-09 06:34:29','2024-06-09 06:34:29'),(74,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:29:40','2024-06-09 06:34:27','2024-06-09 06:34:27'),(75,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:30:06','2024-06-09 06:34:25','2024-06-09 06:34:25'),(76,'45 Sayer Abdulla Al Otaibi St, Zahra, Kuwait',0,2,'','33 foot',12,0,NULL,NULL,NULL,NULL,'47.988061644136906','29.27423571367631',NULL,'2024-06-09 06:36:13','2024-06-09 07:29:55','2024-06-09 07:29:55'),(77,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:36:50','2024-06-09 06:45:54','2024-06-09 06:45:54'),(78,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:37:01','2024-06-09 06:45:52','2024-06-09 06:45:52'),(79,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:43:57','2024-06-09 06:45:50','2024-06-09 06:45:50'),(80,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:44:00','2024-06-09 06:45:48','2024-06-09 06:45:48'),(81,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:44:03','2024-06-09 06:45:42','2024-06-09 06:45:42'),(82,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:44:14','2024-06-09 06:45:44','2024-06-09 06:45:44'),(83,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:44:18','2024-06-09 06:45:46','2024-06-09 06:45:46'),(84,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:44:24','2024-06-09 06:45:38','2024-06-09 06:45:38'),(85,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:44:26','2024-06-09 06:45:35','2024-06-09 06:45:35'),(86,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:44:28','2024-06-09 06:45:32','2024-06-09 06:45:32'),(87,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:44:40','2024-06-09 06:45:30','2024-06-09 06:45:30'),(88,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:44:42','2024-06-09 06:45:28','2024-06-09 06:45:28'),(89,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:44:46','2024-06-09 06:45:26','2024-06-09 06:45:26'),(90,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:44:48','2024-06-09 06:45:24','2024-06-09 06:45:24'),(91,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:45:02','2024-06-09 06:45:22','2024-06-09 06:45:22'),(92,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:46:04','2024-06-09 06:46:15','2024-06-09 06:46:15'),(93,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:49:33','2024-06-09 06:54:17','2024-06-09 06:54:17'),(94,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:52:38','2024-06-09 06:54:15','2024-06-09 06:54:15'),(95,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:54:05','2024-06-09 06:54:13','2024-06-09 06:54:13'),(96,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:56:03','2024-06-09 06:56:13','2024-06-09 06:56:13'),(97,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:56:21','2024-06-09 06:57:11','2024-06-09 06:57:11'),(98,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:56:25','2024-06-09 06:57:08','2024-06-09 06:57:08'),(99,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:57:16','2024-06-09 06:59:17','2024-06-09 06:59:17'),(100,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:57:55','2024-06-09 06:59:11','2024-06-09 06:59:11'),(101,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:58:33','2024-06-09 06:59:09','2024-06-09 06:59:09'),(102,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 06:59:39','2024-06-09 07:00:41','2024-06-09 07:00:41'),(103,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 07:01:52','2024-06-09 07:07:28','2024-06-09 07:07:28'),(104,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 07:02:24','2024-06-09 07:07:26','2024-06-09 07:07:26'),(105,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 07:02:29','2024-06-09 07:07:19','2024-06-09 07:07:19'),(106,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 07:02:37','2024-06-09 07:07:24','2024-06-09 07:07:24'),(107,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 07:02:46','2024-06-09 07:07:22','2024-06-09 07:07:22'),(108,'saji new',0,1,'','al jalaa street',12,0,NULL,NULL,NULL,NULL,'23.1','25.69',NULL,'2024-06-09 07:06:21','2024-06-09 07:07:09','2024-06-09 07:07:09'),(109,'saji new',1,1,'f','al jalaa street',12,1,'garden','1123','1234567890','test','23.1','25.69','test address','2024-06-09 07:15:12','2024-06-09 07:31:43','2024-06-09 07:31:43'),(110,'6Q25+JM Al Jahra, Kuwait',0,3,'K','009',12,0,'ahamdabad road','125','9856321470','teat party','47.7591796964407','29.20153706197345','6Q25+JM Al Jahra, Kuwait','2024-06-09 07:33:34','2024-06-09 08:04:48',NULL),(111,'saji new',1,1,NULL,'al jalaa street',12,1,'wer','3','1234423444',NULL,'23.1','25.69','sdfsdfdsfdsfs','2024-06-09 08:04:48','2024-06-09 08:04:48',NULL),(112,'6, Vastrapur Station Rd, Vejalpur, Ahmedabad, Gujarat 380015, India',0,2,'3','hg',13,1,'hh','66','3','h','72.52439707517624','23.00910622688737','6, Vastrapur Station Rd, Vejalpur, Ahmedabad, Gujarat 380015, India','2024-06-27 10:21:14','2024-06-27 11:41:14',NULL),(113,'Testing',0,2,NULL,'kuwait',14,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-06-27 11:30:51','2024-06-27 11:30:51',NULL),(114,'450 Ahmad Al Jaber St, Al Kuwayt, Kuwait',0,3,'10','10',15,1,'an','10','9950100121','no','47.99151364713907','29.384214542562425','450 Ahmad Al Jaber St, Al Kuwayt, Kuwait','2024-06-27 12:22:24','2024-06-27 12:22:24',NULL),(115,'6XG5+RG Abdullah Al Mubarak Al Sabah, Kuwait',0,4,'008','bekar street',16,1,'New town','1542','9635238965','Take care','47.958764880895615','29.227107279520784','6XG5+RG Abdullah Al Mubarak Al Sabah, Kuwait','2024-06-30 09:34:00','2024-06-30 09:34:00',NULL),(116,'1991 Colony St, Mountain View, CA 94043, USA',0,3,NULL,'jvgi',17,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-01 12:26:50','2024-07-01 12:26:50',NULL),(117,'XFCH+W4 Ahmedabad, Gujarat, India',0,2,NULL,'gvaag',18,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-01 12:29:16','2024-07-01 12:29:16',NULL),(118,'2F3X+W6W, Makarba, Ahmedabad, Gujarat 380054, India',0,2,NULL,'jggu',19,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-01 12:42:44','2024-07-01 12:42:44',NULL),(119,'168, Baherampura Rd, Calico Mills, Behrampura, Ahmedabad, Gujarat 380022, India',0,2,NULL,'dhfuff',20,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-01 12:48:51','2024-07-01 12:48:51',NULL),(120,'X8HQ+G3 Pinrra, Jharkhand, India',0,3,NULL,'chic',21,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-01 12:54:05','2024-07-01 12:54:05',NULL),(121,'WGW9+PV Ahmedabad, Gujarat, India',0,3,NULL,'ha',22,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-01 13:09:56','2024-07-01 13:09:56',NULL),(122,'1607 Amphitheatre Pkwy, Mountain View, CA 94043, USA',0,2,NULL,'hffu',23,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-02 05:46:10','2024-07-02 05:46:10',NULL),(123,'address name',0,2,NULL,'jalaa',24,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-02 07:36:37','2024-07-02 07:36:37',NULL),(124,'address name',0,2,NULL,'jalaa',25,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-02 08:48:55','2024-07-02 08:48:55',NULL),(125,'450 Ahmad Al Jaber St, Al Kuwayt, Kuwait',0,5,NULL,'12',26,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-02 09:10:49','2024-07-02 09:10:49',NULL),(126,'Al Kawthar Tower, 3A Jaber Al-Mubarak St, Al Kuwayt, Kuwait',0,4,NULL,'11',27,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-02 09:13:45','2024-07-02 09:13:45',NULL),(127,'9, Shivaranjani Row houses, Near Shivaranjani Cross Roads, Ambawadi, Ahmedabad, Gujarat 380015, India',0,4,NULL,'hello',31,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 10:01:36','2024-07-03 10:01:36',NULL),(128,'9XMR+MJ6, Ahmad Al Jaber St, Al Kuwayt, Kuwait',0,4,NULL,'st',32,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 12:56:12','2024-07-03 12:56:12',NULL),(129,'Wataniya Telecom, Ahmad Al Jaber St, Al Kuwayt, Kuwait',0,2,NULL,'10',33,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 13:08:53','2024-07-03 13:08:53',NULL),(130,'VFQ4+GQQ, Sama Rd, Bhat, Gujarat 382210, India',0,2,NULL,'sheh',34,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 13:10:59','2024-07-03 13:10:59',NULL),(131,'VHP3+R4 Giramtha, Gujarat, India',0,5,NULL,'ywy',35,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 13:14:48','2024-07-03 13:14:48',NULL),(132,'139, Jainacharya Surendra Surishwarji Marg, Burusharth Nagar, Nava Vadaj, Ahmedabad, Gujarat 380013, India',0,5,NULL,'fuj',36,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 13:29:34','2024-07-03 13:29:34',NULL),(133,'Google Building GWC3, 1505 Salado Dr, Mountain View, CA 94043, USA',0,3,NULL,'ctrg5',37,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 13:35:34','2024-07-03 13:35:34',NULL),(134,'WF3F+48 Kasindra, Gujarat, India',0,4,NULL,'fc',38,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 13:39:51','2024-07-03 13:39:51',NULL),(135,'Ode St, Maokeng, Tembisa, 1632, South Africa, Paldi Kankaj, Gujarat 382427, India',0,5,NULL,'tvyg',39,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 13:48:06','2024-07-03 13:48:06',NULL),(136,'address name',0,2,NULL,'jalaa',40,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 13:54:04','2024-07-03 13:54:04',NULL),(137,'202, Titanium City Centre Mall, near SACHIN TOWER, Jodhpur Village, Ahmedabad, Gujarat 380015, India',0,4,'g','ggg',30,0,'gg','123','2588446965','rrff','72.52306502312422','23.012839030812984','202, Titanium City Centre Mall, near SACHIN TOWER, Jodhpur Village, Ahmedabad, Gujarat 380015, India','2024-07-03 13:57:49','2024-07-04 14:58:37','2024-07-04 14:58:37'),(138,'VFCH+CC Bhat, Gujarat, India',0,3,NULL,'hfuf',41,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 14:28:17','2024-07-03 14:28:17',NULL),(139,'WGM2+22 Visalpur, Gujarat, India',0,2,NULL,'dff',42,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 14:44:34','2024-07-03 14:44:34',NULL),(140,'VGXV+M2 Paldi Kankaj, Gujarat, India',0,4,NULL,'tfgxf',43,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 14:47:54','2024-07-03 14:47:54',NULL),(141,'VGXP+59 Paldi Kankaj, Gujarat, India',0,3,NULL,'tegw',44,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 14:51:21','2024-07-03 14:51:21',NULL),(142,'WG3W+V59, Pirana Dargah Rd, Paldi Kankaj, Gujarat 382427, India',0,5,NULL,'hwh',45,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 14:53:12','2024-07-03 14:53:12',NULL),(143,'202, Vrajdham Rd, nr. Ujala circle, Sarkhej, Ahmedabad, Sarkhej-Okaf, Gujarat 382210, India',0,3,NULL,'gsggs',46,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 15:02:45','2024-07-03 15:02:45',NULL),(144,'WG8V+X2 Ahmedabad, Gujarat, India',0,4,NULL,'ywy',47,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 15:19:57','2024-07-03 15:19:57',NULL),(145,'WH39+85 Ode, Gujarat, India',0,4,NULL,'tt',48,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-03 15:25:31','2024-07-03 15:25:31',NULL),(146,'2400 Amphitheatre Pkwy, Mountain View, CA 94043, USA',0,3,NULL,'hdh',49,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 06:19:21','2024-07-04 06:19:21',NULL),(147,'WF7C+3P Kasindra, Gujarat, India',0,3,NULL,'gxdg',50,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 06:25:29','2024-07-04 06:25:29',NULL),(148,'WFMR+QP Ahmedabad, Gujarat, India',0,2,NULL,'xhfh',51,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 06:28:55','2024-07-04 06:28:55',NULL),(149,'VFXH+QQ Kasindra, Gujarat, India',0,2,NULL,'hffyy',52,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 06:32:04','2024-07-04 06:32:04',NULL),(150,'WF9W+Q7 Visalpur, Gujarat, India',0,3,NULL,'hddgud',53,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 06:37:54','2024-07-04 06:37:54',NULL),(151,'WFJR+MR5, Visalpur, Gujarat 382210, India',0,2,NULL,'hffhhf',54,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 06:43:13','2024-07-04 06:43:13',NULL),(152,'XG9H+99 Ahmedabad, Gujarat, India',0,2,NULL,'gegwg',55,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 06:46:11','2024-07-04 06:46:11',NULL),(153,'WG7W+G97, Ode, Gujarat 382427, India',0,3,NULL,'gsg',56,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 06:57:10','2024-07-04 06:57:10',NULL),(154,'WFWJ+HF Ahmedabad, Gujarat, India',0,3,NULL,'gsggegs',57,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 07:20:14','2024-07-04 07:20:14',NULL),(155,'XFRR+C5Q, LJ St, Makarba, Ahmedabad, Sarkhej-Okaf, Gujarat 380054, India',0,3,NULL,'hggh',58,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 07:23:42','2024-07-04 07:23:42',NULL),(156,'14B, Vejalpur, Ahmedabad, Gujarat 380051, India',0,2,NULL,'hfg',59,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 07:42:52','2024-07-04 07:42:52',NULL),(157,'XG6R+3V Ahmedabad, Gujarat, India',0,5,NULL,'gs',60,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 08:50:17','2024-07-04 08:50:17',NULL),(158,'4, 100 Feet Rd, Shyamal, Ahmedabad, Gujarat 380015, India',0,3,NULL,'gw',61,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 08:57:28','2024-07-04 08:57:28',NULL),(159,'Someshwar Pk Ln, Someshwar Bungalows 1, 11, Times Of India Press Rd, Swinagar Society, Nehru Nagar, Satellite, Ahmedabad, Gujarat 380015, India',0,3,NULL,'vh',62,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 09:03:32','2024-07-04 09:03:32',NULL),(160,'7, Mahavir Nagar, Meldinagar, Vejalpur, Ahmedabad, Gujarat 380051, India',0,3,NULL,'ffggh',63,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 09:06:55','2024-07-04 09:06:55',NULL),(161,'WGWQ+84 Ahmedabad, Gujarat, India',0,3,NULL,'gggv',64,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 09:17:36','2024-07-04 09:17:36',NULL),(162,'Bhagwati Kunj, Cooperative Housing Society, A4, Shaivali Society, Vibhavari Society, Jivraj Park, Ahmedabad, Gujarat 380051, India',0,3,NULL,'jfuf',65,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 09:23:15','2024-07-04 09:23:15',NULL),(163,'WGWP+8H Ahmedabad, Gujarat, India',0,3,NULL,'gshs',66,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 09:50:27','2024-07-04 09:50:27',NULL),(164,'WGRR+RH Ahmedabad, Gujarat, India',0,5,NULL,'gfg',67,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 09:53:59','2024-07-04 09:53:59',NULL),(165,'XH45+R9M, Shivshaktinagar, Piplaj, Ahmedabad, Gujarat 382405, India',0,5,NULL,'vuhu',68,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 09:59:34','2024-07-04 09:59:34',NULL),(166,'870/1, Industrial Area, Piplaj, Ahmedabad, Gujarat 382405, India',0,5,NULL,'gsgs',69,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-04 10:04:26','2024-07-04 10:04:26',NULL),(167,'Wataniya Telecom, Ahmad Al Jaber St, Al Kuwayt, Kuwait',0,3,'13','st',70,1,'ago','12','664578961','hshshsh','47.99170944839716','29.38421863255771','Wataniya Telecom, Ahmad Al Jaber St, Al Kuwayt, Kuwait','2024-07-04 10:28:41','2024-07-04 10:28:41',NULL),(168,'19, 132 Feet Ring Rd, opposite Parekh\'s Hospital, Balgayatri Society Part-2, Satellite, Ahmedabad, Gujarat 380015, India',1,3,'g','test',30,1,'hs','1245','8454644694','hshs','72.53120217472315','23.01387775401148','19, 132 Feet Ring Rd, opposite Parekh\'s Hospital, Balgayatri Society Part-2, Satellite, Ahmedabad, Gujarat 380015, India','2024-07-04 14:50:12','2024-07-04 15:03:15','2024-07-04 15:03:15'),(169,'2G5F+WV7, Times Of India Press Rd, Vejalpur, Ahmedabad, Gujarat 380015, India',0,3,'h','jvg',30,0,'uvgu','25','6886872758','ufgu','72.52469178289175','23.009648440350585','2G5F+WV7, Times Of India Press Rd, Vejalpur, Ahmedabad, Gujarat 380015, India','2024-07-04 14:59:14','2024-07-04 15:03:17','2024-07-04 15:03:17'),(170,'شارع 86، مدينة الكويت،، Al Kuwayt, Kuwait',0,4,'10','12',71,1,'hh','12','4578961','hd','47.99149252474308','29.372417435720696','شارع 86، مدينة الكويت،، Al Kuwayt, Kuwait','2024-07-04 15:16:49','2024-07-04 15:16:49',NULL),(171,'C302, Satellite, Jodhpur Village, Ahmedabad, Gujarat 380015, India',1,3,'jvv','hcgh',30,1,'gxgc','25','68866835','fgh','72.52410907298326','23.010857534579856','C302, Satellite, Jodhpur Village, Ahmedabad, Gujarat 380015, India','2024-07-04 15:27:03','2024-07-04 15:31:12','2024-07-04 15:31:12'),(172,'41, Jodhpur Village, Ahmedabad, Gujarat 380015, India',0,3,'hshs','hshs',30,1,'bsbsb','6464','9464994646','hah','72.52543743699789','23.011338021544304','41, Jodhpur Village, Ahmedabad, Gujarat 380015, India','2024-07-04 15:37:05','2024-07-04 15:42:06','2024-07-04 15:42:06'),(173,'Kala Residency, KALA RESIDENCY, Times Of India Press Rd, Vejalpur, Ahmedabad, Gujarat 380015, India',0,3,'t','hc',72,1,'hc','86','5886868368','gx','72.5242106616497','23.009707691775116','Kala Residency, KALA RESIDENCY, Times Of India Press Rd, Vejalpur, Ahmedabad, Gujarat 380015, India','2024-07-04 15:45:14','2024-07-04 15:48:58','2024-07-04 15:48:58'),(174,'P5RV+52 Shenayez, Fars Province, Iran',0,4,'s','gssg',72,1,'gsgs','51','5484548848','gag','53.192608281970024','27.74039025303485','P5RV+52 Shenayez, Fars Province, Iran','2024-07-04 15:53:07','2024-07-04 15:53:07',NULL),(175,'4, 132 Feet Ring Rd, Sawaminarayan Society, Satellite, Ayojan Nagar, Ahmedabad, Gujarat 380015, India',1,2,'d','hf',30,0,'xggs','12','9886544554','gdtd','72.53107946366072','23.013452205575614','4, 132 Feet Ring Rd, Sawaminarayan Society, Satellite, Ayojan Nagar, Ahmedabad, Gujarat 380015, India','2024-07-07 05:53:51','2024-07-09 13:04:31','2024-07-09 13:04:31'),(176,'2960 N Shoreline Blvd, Mountain View, CA 94043, USA',0,3,NULL,'123',73,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-08 10:38:48','2024-07-08 10:38:48',NULL),(177,'Garrett Donaldson',0,5,NULL,'Nihil consequat Num',74,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-08 10:55:06','2024-07-08 10:55:06',NULL),(178,'WFHQ+CR Visalpur, Gujarat, India',0,1,NULL,'123456',75,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-08 10:57:15','2024-07-08 10:57:15',NULL),(179,'D 407, Titeniam City Centre, Jodhpur Village, Ahmedabad, Gujarat 380015, India',0,4,'f','tfgh',30,0,'hf','25','6985236985','fhfhhc','72.52365343272686','23.01161575889356','D 407, Titeniam City Centre, Jodhpur Village, Ahmedabad, Gujarat 380015, India','2024-07-09 13:05:51','2024-07-09 14:42:28','2024-07-09 14:42:28'),(180,'3, Jodhpur Village, Ahmedabad, Gujarat 380015, India',1,5,'d','hdf',30,1,'fhf','23','5545556556','gzdg','72.52414897084236','23.01022922662884','3, Jodhpur Village, Ahmedabad, Gujarat 380015, India','2024-07-09 13:08:22','2024-07-09 14:42:25','2024-07-09 14:42:25'),(181,'C Wing, Shyam Residency 6, Jodhpur Village, Ahmedabad, Gujarat 380015, India',0,3,'d','rt',30,1,'re','258','9868898686','hddhh','72.52427972853184','23.01191602318455','C Wing, Shyam Residency 6, Jodhpur Village, Ahmedabad, Gujarat 380015, India','2024-07-09 14:43:02','2024-07-09 14:43:12',NULL);
/*!40000 ALTER TABLE `user_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `permission` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_permissions_user_id_foreign` (`user_id`),
  CONSTRAINT `user_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permissions`
--

LOCK TABLES `user_permissions` WRITE;
/*!40000 ALTER TABLE `user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_wallet`
--

DROP TABLE IF EXISTS `user_wallet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_wallet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `total_price` double NOT NULL,
  `points` double NOT NULL,
  `points_percent` double NOT NULL,
  `type` int NOT NULL COMMENT '1=in(plus), 2=out(minus)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_wallet_user_id_foreign` (`user_id`),
  KEY `user_wallet_order_id_foreign` (`order_id`),
  CONSTRAINT `user_wallet_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_wallet_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_wallet`
--

LOCK TABLES `user_wallet` WRITE;
/*!40000 ALTER TABLE `user_wallet` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_wallet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_mobile` tinyint(1) DEFAULT NULL COMMENT '0->android , 1->ios',
  `receive_notification` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0->on , 1->off',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `verified` int DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `social_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,0,'yash007','yash@hamiltonkw.com','8209528643',NULL,'$2y$10$wvAN2oTVqMRSlrANspDCNeOT6ZVSvWk4utNBnSO4nOBZbwsXxvWjO','s6ljIh62qjer3SPQMzZWnMHpDGTgxxt14NadA7WYiRh7JA64xHozsVq1t57s','active',1,'2023-10-29 07:08:37','2024-07-08 10:35:35','2024-07-08 10:35:35',NULL,NULL,NULL),(2,NULL,1,'Karina Glenn','ziji@mailinator.com','7845123690',NULL,'$2y$10$jvBe89I1YqpUrXHOu3CryeEU1ohIiulef46yknVDkS03wu.i5IA8G',NULL,'active',1,'2023-10-29 07:30:12','2023-10-29 07:30:12',NULL,NULL,NULL,NULL),(3,NULL,1,'test Tailor001','yash.tailor23@gmail.com','08209528643','62S9TZcKq0AXrTh15700971699251522_8728998.jpg','$2y$10$cxWsF6Zu.UsPhjmo.HOyy.GhKwV/CseZBn3Otw5BvqsybNQL0bo1e',NULL,'active',1,'2023-10-30 08:51:18','2023-11-06 06:18:43',NULL,NULL,NULL,NULL),(4,NULL,1,'mustanseer','mustanseer@yopmail.com','66457961',NULL,'$2y$10$v7neN6Tep38fPHAh2.zKRO6haojM8NiXiqSDI0ewk65rL3lRTEJFi',NULL,'active',1,'2023-11-05 11:11:47','2023-11-06 06:17:32','2023-11-06 06:17:32',NULL,NULL,NULL),(5,NULL,1,'kuwait','test@test.com','8547856996595+9595+65656+',NULL,'$2y$10$VASKbXftQN8VHDC7EVK.mupfTyC9JXPkxNUbU0TmmmYJbyy/Z7WPu',NULL,'active',1,'2023-11-06 06:19:50','2023-11-06 06:19:50',NULL,NULL,NULL,NULL),(6,NULL,1,'Gagan Darji','projects@hamiltonkw.com','98825484',NULL,'$2y$10$IWsZsNFQyDwC7oSmI313vuqV4X2TclxQ4sL.AoMbATUzcuu9aeIiO',NULL,'active',1,'2023-11-06 13:12:30','2023-11-06 13:12:30',NULL,NULL,NULL,NULL),(7,NULL,1,'Clementine Weaver','kybugazyvy@mailinator.com','Rerum tempore aliqu',NULL,'$2y$10$h.cSI0vw7Rtxz6bfUTuWZeDxEbpyGYQd9rGHPIC/.eTCZE5UR7OKG',NULL,'active',1,'2023-11-20 09:27:21','2023-11-20 09:27:21',NULL,NULL,NULL,NULL),(8,NULL,1,'urvik','sdfsd@dsd.com','7894561230',NULL,'$2y$10$CKAQf0h9aLJXHYx21M.T4uic54CQ/mmy6atFZJU2cks7prsySUaS6',NULL,'active',1,'2024-01-09 11:39:33','2024-01-09 11:39:33',NULL,NULL,NULL,NULL),(9,NULL,1,'Gagan Darji','sales@hamiltonkw.com','98825484',NULL,'$2y$10$V8gBp91mr3R1foLBzPyQ.ORl50O6YaXblBkX.VxJ3cPPo8/y3Nv8i',NULL,'active',1,'2024-01-09 12:31:09','2024-01-09 12:31:09',NULL,NULL,NULL,NULL),(10,NULL,1,'Gagan Darji','projects+007@hamiltonkw.com','98825484',NULL,'$2y$10$lIXy9tFZfm1w/9i3qCeP5OX/3VTdY6q2kHX57XzYTyNoFft4dLpTq',NULL,'active',1,'2024-04-23 13:37:31','2024-04-23 13:37:31',NULL,NULL,NULL,NULL),(11,0,1,'Test','vepoho2091@crodity.com','2580258085',NULL,'$2y$10$QzwumEsglmsuZ4fpoK/xTeZQiy9CZN5TmFSPSLLHXAVOlbmIqkgv2',NULL,'active',1,'2024-06-04 10:27:20','2024-06-04 10:27:20',NULL,NULL,NULL,NULL),(12,0,1,'Ajk','test@gmail.com','3698523698',NULL,'$2y$10$OiwEvvroT75m7qbgsGcX3.tgq7lciit9LU2ZMGZm0MHpv/LoL0Anu',NULL,'active',1,'2024-06-05 12:43:10','2024-06-05 12:43:10',NULL,NULL,NULL,NULL),(13,0,1,'yash12','yash1@hamiltonkw.com','9898986868',NULL,'$2y$10$cJL7xdfzzpIRtNF7FWDD4.7mOffQRtoQzEbSfN1NRk5lU8rFxXs5i',NULL,'active',1,'2024-06-27 09:22:26','2024-06-27 12:09:07',NULL,NULL,NULL,NULL),(14,NULL,1,'test Tailor','shiv@hamiltonkw.com','08209528643',NULL,'$2y$10$tpIHN7nFadDYlfhIcMcvmO0RRahwifxcpivy8OanG0WUEcdX7b8zK',NULL,'active',1,'2024-06-27 11:30:51','2024-06-27 11:30:51',NULL,NULL,NULL,NULL),(15,0,1,'mustan','mustanseer@hamiltonkw.com','77996644',NULL,'$2y$10$FUmBOv6MWqJ3FtU5dAkAtOctyf7Qaq4p8vPPAHk7O8PNpPsXiTEp.',NULL,'active',1,'2024-06-27 12:21:31','2024-06-27 12:21:31',NULL,NULL,NULL,NULL),(16,0,1,'Test1','terid70498@mposhop.com','1456327554',NULL,'$2y$10$K0LwKpHDNdTEZVFvQKitTO72LJeelaN/VsN8GkC/LotpPcNmOITxi',NULL,'active',1,'2024-06-30 06:05:16','2024-07-02 12:04:52','2024-07-02 12:04:52',NULL,NULL,NULL),(17,0,1,'yash','terid704982@mposhop.com','9865383868',NULL,'$2y$10$KqXvXcpKPIBPHPqazSl0Vuk6c3ASUXoWX2tfBkl0LCafqK.qdSHb6',NULL,'active',1,'2024-07-01 12:26:50','2024-07-01 12:26:50',NULL,NULL,NULL,NULL),(18,0,1,'yash','terid7049823@mposhop.com','2596355185',NULL,'$2y$10$yt5TS4zf2qlTMRssCCgFDuJQfuZDNxuowwt8CnjdJiwHt0RP2aquC',NULL,'active',1,'2024-07-01 12:29:16','2024-07-01 12:29:16',NULL,NULL,NULL,NULL),(19,0,1,'yash','test95@gmail.com','2580963147',NULL,'$2y$10$Ij2c/4pMzosbwNVQrhw1WePibYOhkwFSQGA2fmj2EG7Y3k02U9Yda',NULL,'active',1,'2024-07-01 12:42:44','2024-07-01 12:42:44',NULL,NULL,NULL,NULL),(20,0,1,'yash','terid7049832@mposhop.com','9658234486',NULL,'$2y$10$JicO0VXUHLLWJhi4ZwQKz.AmhStLuJsZqj4uSmZkjnSHlxHVac0Pq',NULL,'active',1,'2024-07-01 12:48:51','2024-07-01 12:48:51',NULL,NULL,NULL,NULL),(21,0,1,'yash','terid7049854@mposhop.com','8255423556',NULL,'$2y$10$.aZnbNfVXuRU44Qbe.e35.Hiw5dMXjRghAyYlqLVsEyJcmG7Zf.Py',NULL,'active',1,'2024-07-01 12:54:05','2024-07-01 12:54:05',NULL,NULL,NULL,NULL),(22,0,1,'yash','test915@gmail.com','5124554343',NULL,'$2y$10$7DkDasMRS22FPmidacPQlefyX.aR2qgOKkgHaGrxRIQoFOXNuNheS',NULL,'active',1,'2024-07-01 13:09:56','2024-07-01 13:09:56',NULL,NULL,NULL,NULL),(23,0,1,'trst','terid70498344@mposhop.com','9854547686',NULL,'$2y$10$WN6Msm2hmK3BnqU3HJfk0.ZBJ3bBzRN1w3pHubT.ky.zBNSWC9btC',NULL,'active',1,'2024-07-02 05:46:10','2024-07-02 05:46:10',NULL,NULL,NULL,NULL),(24,NULL,1,'test','testguest1@yopmail.com','7755336699',NULL,'$2y$10$nNd9DZJCgQW9ojoKLZMSvuR2s4ojgq0B56XvlLBB/bcqFrLhuRrim',NULL,'active',1,'2024-07-02 07:36:37','2024-07-02 07:36:37',NULL,NULL,NULL,NULL),(25,NULL,1,'test','testguest122@yopmail.com','7755336699',NULL,'$2y$10$GPT9pkd.hUKl4BFYArqqLuHQf23uVs2CwSM4L0wRv95/Lz8CvsdtO',NULL,'active',1,'2024-07-02 08:48:55','2024-07-02 08:48:55',NULL,NULL,NULL,NULL),(26,0,1,'mush','h@yopmail.com','664578961',NULL,'$2y$10$nqVFRYpGcmS36w7Id9CpC.tGg3qh5An3rwgxD1oVCexe9j2hfl/U.',NULL,'active',1,'2024-07-02 09:10:49','2024-07-02 09:10:49',NULL,NULL,NULL,NULL),(27,0,1,'main','y@yopmail.com','12435679',NULL,'$2y$10$tzrWJfHWjBdaTh5bW9mBYuM4J9v9aLYMp.yKxe4i0wF40L9WwkkIS',NULL,'active',1,'2024-07-02 09:13:45','2024-07-02 09:13:45',NULL,NULL,NULL,NULL),(28,0,1,'test','test129@gmail.com','2451394645',NULL,'$2y$10$xsYETOr5Gf8thNJdMAw54uyD9CJfM8R1HxeMlexWotvxX1wwTxvPK',NULL,'active',1,'2024-07-02 12:07:13','2024-07-02 12:46:34','2024-07-02 12:46:34',NULL,NULL,NULL),(29,0,1,'test12','test11@gmail.com','2584864139',NULL,'$2y$10$CTICEUBY2lqYadd37cjOPedBzG4y.4vxftLtNf3OhZOzrwmhckuJq',NULL,'active',1,'2024-07-02 14:15:04','2024-07-03 08:39:06','2024-07-03 08:39:06',NULL,NULL,NULL),(30,0,0,'test12','test12@gmail.com','94645151',NULL,'$2y$10$KiaRJNiPbtYfCGUHwM.5nuR1Y4RM7yPLCVLOvnB/TEirnyk5sfEgq',NULL,'active',1,'2024-07-03 08:40:53','2024-07-15 13:15:21','2024-07-15 13:15:21',NULL,NULL,NULL),(31,1,1,'shiv','shivanshu@hamiltonkw.com','9685073815',NULL,'$2y$10$gy9monlp95R17P0EIPnWRevnOnhUhSY3sec40PWPeIz3MYHxhqnqi',NULL,'active',1,'2024-07-03 10:01:36','2024-07-03 10:01:36',NULL,NULL,NULL,NULL),(32,0,1,'mus','ms@yopmail.com','66457812',NULL,'$2y$10$Qx7zn/dNjiU3QKASyyQpq.Ox5R516w.KZEVukreCV55iH3Lukaba6',NULL,'active',1,'2024-07-03 12:56:12','2024-07-03 12:56:12',NULL,NULL,NULL,NULL),(33,0,1,'jdjs','hajk@yopmail.com','66457961',NULL,'$2y$10$kQnDqloVQrGyhOolPWC9ZurSW9UFDUsY57L.04/yItjf5TsXG4Eiy',NULL,'active',1,'2024-07-03 13:08:53','2024-07-03 13:08:53',NULL,NULL,NULL,NULL),(34,0,1,'yehe','test76@gmail.com','8484616161',NULL,'$2y$10$SKW2iX9cHBIY545TdWclaeJ9hks76qsor2chTtjJZ8L8R5mpwDAB6',NULL,'active',1,'2024-07-03 13:10:59','2024-07-03 13:10:59',NULL,NULL,NULL,NULL),(35,0,1,'uwuhw','test@123gmail.com','6488454848',NULL,'$2y$10$p63d6Q4Z/F1fQEsBk0fAte0pdVhoVzf8cbaOOopGizMuyKnlIAOTS',NULL,'active',1,'2024-07-03 13:14:48','2024-07-03 13:14:48',NULL,NULL,NULL,NULL),(36,0,1,'test','test354665@gmail.com','6576543435',NULL,'$2y$10$UyKtXTKVuDMMcx8U1AwBROg3/v.qAMTnx4Rp1sAsEL8Yo6EjJN4Xi',NULL,'active',1,'2024-07-03 13:29:34','2024-07-03 13:29:34',NULL,NULL,NULL,NULL),(37,0,1,'ygyg','test@126643gmail.com','5828285252',NULL,'$2y$10$iSZJGPqUQkEuWrcweIusO.1Ef9IkY9GPzLtui7vzxg6SXc4f1gWtO',NULL,'active',1,'2024-07-03 13:35:34','2024-07-03 13:35:34',NULL,NULL,NULL,NULL),(38,0,1,'gygg','test12345331@gmail.com','2828252527',NULL,'$2y$10$FKyeaDUSOX372yF9AgvgcO6rD7sUJlLs9tc.Q8GQTd01M/oHjZqq.',NULL,'active',1,'2024-07-03 13:39:51','2024-07-03 13:39:51',NULL,NULL,NULL,NULL),(39,0,1,'tdf','test@34642gmail.com','2558441266',NULL,'$2y$10$8sfB1m8ax6pnOGwTe4WMo.ic6xHlBYY/neIlEJq3F8iPCOPf7cCba',NULL,'active',1,'2024-07-03 13:48:06','2024-07-03 13:48:06',NULL,NULL,NULL,NULL),(40,NULL,1,'test','testguest881@yopmail.com','7755336699',NULL,'$2y$10$TPT9R1DXN/FUPRds0HuYxuo0821laag/Vi.SYtgXC6NwjHLoAP/bK',NULL,'active',1,'2024-07-03 13:54:04','2024-07-03 13:54:04',NULL,NULL,NULL,NULL),(41,0,1,'hfhfhfhcf yyy','test127542@gmail.com','8854424255',NULL,'$2y$10$ZrOjuw4tVQDRGgGC2ekXdum8AJ/rw8tpx274O6qiQBWbhsIg..S.O',NULL,'active',1,'2024-07-03 14:28:17','2024-07-03 14:28:17',NULL,NULL,NULL,NULL),(42,0,1,'ugguf','testr22@gamil.com','8525844556',NULL,'$2y$10$VmEHpAWVnohK8G1sAU1x6.vkbs5kk4FwO8.px4ajJ9u2OoMzfTCTq',NULL,'active',1,'2024-07-03 14:44:34','2024-07-03 14:44:34',NULL,NULL,NULL,NULL),(43,0,1,'hshshsh','testr@1gmail.com','8668853658',NULL,'$2y$10$NeF6w1zCPkVxLEMeJxPK9uI7x0huFbF5x5PXrqTehJM7vSXKI1w2u',NULL,'active',1,'2024-07-03 14:47:54','2024-07-03 14:47:54',NULL,NULL,NULL,NULL),(44,0,1,'hahgs','tester1@gmail.com','5454215181',NULL,'$2y$10$ygQWawtAL/7W5b.bMUceheHhCX/Xx0HzkuFScVc96tVso2u20zPFe',NULL,'active',1,'2024-07-03 14:51:21','2024-07-03 14:51:21',NULL,NULL,NULL,NULL),(45,0,1,'thshhs','tester12@gmail.com','2458464643',NULL,'$2y$10$rSk82.cJuRYfEVBK/u9dIuEDo6c5p8QuFo08Mv0MrfHhxE1MVihV.',NULL,'active',1,'2024-07-03 14:53:12','2024-07-03 14:53:12',NULL,NULL,NULL,NULL),(46,0,1,'ubyhyh','tester123@gmail.com','6454278488',NULL,'$2y$10$GGwkfALM4XrHQPvTSQMIkODETJnZaJfG148mny8bMGA7s7d9agW3i',NULL,'active',1,'2024-07-03 15:02:45','2024-07-03 15:02:45',NULL,NULL,NULL,NULL),(47,0,1,'ywyygw','tester156@gmail.com','5454848466',NULL,'$2y$10$kpYW/sxIbYY/y.r0iqriTeBw1RRrWMEnXIW2kUCgT20XQLohmQqc6',NULL,'active',1,'2024-07-03 15:19:57','2024-07-03 15:19:57',NULL,NULL,NULL,NULL),(48,0,1,'guug','terst@12gmail.com','5425481464',NULL,'$2y$10$5MHcDNTyj05.rvAnb/RjPeGquzd3iR7OiFP63W2zRs4Q090xQReky',NULL,'active',1,'2024-07-03 15:25:31','2024-07-03 15:25:31',NULL,NULL,NULL,NULL),(49,0,1,'hffhf','terter1@gmail.com','6454584943',NULL,'$2y$10$jpDjsQO0itFMlafFYuy6rOiWBrwxmcrDLicbpJv88mquRQIgonCm.',NULL,'active',1,'2024-07-04 06:19:21','2024-07-04 06:19:21',NULL,NULL,NULL,NULL),(50,0,1,'jffjjcgj','testa@123gmail.com','8898686898',NULL,'$2y$10$1ZFYIRQk.Jmm5EGNpKv1nuom5QN.s89XY4n4o7Dc3lp7i7aSCx/mK',NULL,'active',1,'2024-07-04 06:25:29','2024-07-04 06:25:29',NULL,NULL,NULL,NULL),(51,0,1,'jgfh','testa@12gamil.com','8589090875',NULL,'$2y$10$EVnce9t1kRe6Qn7u.APrf.iKanzCC0Z6wcUaxCKkerstWXALNfXDi',NULL,'active',1,'2024-07-04 06:28:55','2024-07-04 06:28:55',NULL,NULL,NULL,NULL),(52,0,1,'chfhhf','testa123@gmail.com','9806853535',NULL,'$2y$10$OCXqfL55URXvfirF7byir.vqjhWmYNmAKagDcKTL7/Amm/Ret3GWC',NULL,'active',1,'2024-07-04 06:32:04','2024-07-04 06:32:04',NULL,NULL,NULL,NULL),(53,0,1,'fhfhhf','testa@1234gmail.com','8689809085',NULL,'$2y$10$jWX2hp9jj/C1KEO0hAlwvecBFc0/S5IoYQSa2rBcCTsFDSaM/KcHO',NULL,'active',1,'2024-07-04 06:37:54','2024-07-04 06:37:54',NULL,NULL,NULL,NULL),(54,0,1,'vnch','testa@132gmail.com','8754755454',NULL,'$2y$10$lySd6xi3Xx6YmXF2KHlXOuYcPEcORTFj3OZ61ZtudSY/HIs79zRkG',NULL,'active',1,'2024-07-04 06:43:13','2024-07-04 06:43:13',NULL,NULL,NULL,NULL),(55,0,1,'hshh','test113422@gmail.com','9948454344',NULL,'$2y$10$YHIc0RR.HhwoHu7jIp1Tt.VjJSWVWbJQ7AfwFKhp8YEE266rtgtZ6',NULL,'active',1,'2024-07-04 06:46:11','2024-07-04 06:46:11',NULL,NULL,NULL,NULL),(56,0,1,'hchf','testas1@gmail.com','5845787346',NULL,'$2y$10$DvhUysxCMJm3aQkpHFqV9.7iPy1Djo743DTIEOBCFEmMj105.kEG.',NULL,'active',1,'2024-07-04 06:57:10','2024-07-04 06:57:10',NULL,NULL,NULL,NULL),(57,0,1,'jss sh','testy@1gmail.com','8454545848',NULL,'$2y$10$2ieUzzMb8jcvtzAvqTJOJu/b7uRjBVk1bCRYOS0bMcZM4lO05xyna',NULL,'active',1,'2024-07-04 07:20:14','2024-07-04 07:20:14',NULL,NULL,NULL,NULL),(58,0,1,'chgjgu','jeetsta@gmail.com','6886689890',NULL,'$2y$10$3wW4T2A6Q1V8TGGG1/Sblesy9KgGg.dBm8hT1ZB/7gJ8uNoDyWRiq',NULL,'active',1,'2024-07-04 07:23:42','2024-07-04 07:23:42',NULL,NULL,NULL,NULL),(59,0,1,'yash jholar','ted@gmail.com','5875868857',NULL,'$2y$10$i1zN3a/VsudymKRuHp4rGOGezamL.8xTCrzfWCz14TW3LR/mLAg7G',NULL,'active',1,'2024-07-04 07:42:52','2024-07-04 07:42:52',NULL,NULL,NULL,NULL),(60,0,1,'hshe','jeet@ggmail.com','5484884819',NULL,'$2y$10$T/qLGPV2qYUWBfiDPHQ2guhIoTiqmY.VlvJZOr3Csx6Ja1QmjmlT2',NULL,'active',1,'2024-07-04 08:50:17','2024-07-04 08:50:17',NULL,NULL,NULL,NULL),(61,0,1,'jeet','jeet12@gmail.com','5484548644',NULL,'$2y$10$3oFRL9fwdDC/toxXFALNJeCDBruCrpQFtvdUh7NCzpCbvsx8K2HNe',NULL,'active',1,'2024-07-04 08:57:28','2024-07-04 08:57:28',NULL,NULL,NULL,NULL),(62,0,1,'xhhff','jeet13@gmail.com','5858585858',NULL,'$2y$10$TLI0ehf.hf.DGrRK0PoVmuLbEUbzln42js03Y4A1nK/fC7//IPl/a',NULL,'active',1,'2024-07-04 09:03:32','2024-07-04 09:03:32',NULL,NULL,NULL,NULL),(63,0,1,'hffh','treth@gmail.com','8855885585',NULL,'$2y$10$ENr527y3WhDPoDJCPZmdUuOfLXA21UMDywCnbs92zBGSWnNAcIH5S',NULL,'active',1,'2024-07-04 09:06:55','2024-07-04 09:06:55',NULL,NULL,NULL,NULL),(64,0,1,'jeet','ft@gmail.com','9454843643',NULL,'$2y$10$f43xba7JotJQ6e3I1pDO.e3jKZWx6IBeiCBn6Xe1LH25sXrJhWHZ2',NULL,'active',1,'2024-07-04 09:17:36','2024-07-04 09:17:36',NULL,NULL,NULL,NULL),(65,0,1,'gjjg jghf','jeets@gmail.com','1236868656',NULL,'$2y$10$WilkD08uN6KR1kAqhxtUxOeBo/eo7gZX7AbAWffj0ABooU8s8kjC6',NULL,'active',1,'2024-07-04 09:23:15','2024-07-04 09:23:15',NULL,NULL,NULL,NULL),(66,0,1,'jeet','tegh@gmail.com','8454848434',NULL,'$2y$10$aL.TulM2XBC.IoCupXQEhOuEi0FfeinLwb4pWrppzumpkeYkKrmL.',NULL,'active',1,'2024-07-04 09:50:27','2024-07-04 09:50:27',NULL,NULL,NULL,NULL),(67,0,1,'uggu','tedgj@gmail.com','2882868686',NULL,'$2y$10$KKpAp4EzeoTc/kWqTufOBuUndzUVMc1t2hfOgDIzYHeTO0086mn8i',NULL,'active',1,'2024-07-04 09:53:59','2024-07-04 09:53:59',NULL,NULL,NULL,NULL),(68,0,1,'ght','gst@gmail.com','6868689686',NULL,'$2y$10$siKM1EkyZ.Q8kd4T0j0l6u6RTzynzB9PMC6GEWwl5HSslez3U.7C6',NULL,'active',1,'2024-07-04 09:59:34','2024-07-04 09:59:34',NULL,NULL,NULL,NULL),(69,0,1,'rhrh','tehdg@gmail.com','9787848484',NULL,'$2y$10$X/GUmTbpH6TDaAx/lqTl2Oxb8v2nCuuGK5EdyYm.hBL..O5PpbyM.',NULL,'active',1,'2024-07-04 10:04:26','2024-07-04 10:04:26',NULL,NULL,NULL,NULL),(70,0,1,'mustan','mustanseer11@yopmail.com','423459979',NULL,'$2y$10$dbC8ddLvnMmTJlxbSQbvvO/I.YywyBEqZetksdvM4fgvSlbjbf6KC',NULL,'active',1,'2024-07-04 10:22:43','2024-07-04 11:10:35','2024-07-04 11:10:35',NULL,NULL,NULL),(71,0,1,'Mustang','mus@yopmail.com','447766588',NULL,'$2y$10$WelfvHMHpKHhVTVzLZx.E.J2sMhu13b0GX2y//u8XmKpGgF9L0U6.',NULL,'active',1,'2024-07-04 15:16:05','2024-07-04 15:16:05',NULL,NULL,NULL,NULL),(72,0,1,'shiv','shiv@gmail.com','5487649946',NULL,'$2y$10$7F6yFO/Vdq0oJ1UcW7xlheymBdqSJJwohPDdkBQ2..hyNR6a7dGqW',NULL,'active',1,'2024-07-04 15:43:07','2024-07-04 15:43:07',NULL,NULL,NULL,NULL),(73,0,1,'yash','yash123@gmail.com','32656532',NULL,'$2y$10$T39DF87if8S5s5OgpWyaQuU2cb1ihgzmX48QhbOdl7z6G07EF2SIO',NULL,'active',1,'2024-07-08 10:38:48','2024-07-11 07:05:57',NULL,NULL,NULL,NULL),(74,NULL,1,'Jonah George','cybile@mailinator.com','Dolores laborum null',NULL,'$2y$10$Cfg8OsSfLb3s48J.ZwYA6.xB0Y31.t1HtAZim61X7qwprHZVrFkPu',NULL,'active',1,'2024-07-08 10:55:06','2024-07-08 10:55:06',NULL,NULL,NULL,NULL),(75,0,1,'yash','Yash1233@gmail.com','65326538',NULL,'$2y$10$txUTnn9.A0aAs8uMwfXUJ.B8QvoYtQaxWGF3kLAXcQgThlQDQQ2gm',NULL,'active',1,'2024-07-08 10:57:15','2024-07-08 10:57:15',NULL,NULL,NULL,NULL),(76,0,1,'jass','jass@gmail.com','6938520852',NULL,'$2y$10$j1viwA449BK3oztrCzWqx.827h8ZVZ1aintB3Y7hkI9Tp3sHPO76.',NULL,'active',1,'2024-07-09 10:04:11','2024-07-09 10:04:11',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vender_requersts`
--

DROP TABLE IF EXISTS `vender_requersts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vender_requersts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `storename` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vender_requersts`
--

LOCK TABLES `vender_requersts` WRITE;
/*!40000 ALTER TABLE `vender_requersts` DISABLE KEYS */;
INSERT INTO `vender_requersts` VALUES (1,'yash','yash.tailor23@gmail.com','kuwait bazar','Test','2023-11-06 06:40:57','2023-11-06 06:40:57',NULL),(2,'mustanseer','mustanseer110@gmail.com','hm','hey this is test','2024-06-27 09:46:25','2024-06-27 09:46:25',NULL),(3,'yash','yash@hamiltonkw.com','kuwait honey','testing','2024-06-27 11:21:03','2024-06-27 11:21:03',NULL),(4,'Jack','terid70498@mposhop.com','Honey com mez','We deliver best honey and we believe in quality.','2024-07-01 05:07:08','2024-07-01 05:07:08',NULL),(5,'mustanseer','mustanseer@yopmail.com','haaf','hekdkdkdkdkdk','2024-07-04 11:11:27','2024-07-04 11:11:27',NULL),(6,'yash','royal80083@carspure.com','Honey com','Best honey','2024-07-07 09:34:29','2024-07-07 09:34:29',NULL),(7,'brad','nathannorth2005@gmail.com','brad','test','2024-07-15 13:17:47','2024-07-15 13:17:47',NULL);
/*!40000 ALTER TABLE `vender_requersts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venders`
--

DROP TABLE IF EXISTS `venders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fcm_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `device_type` tinyint NOT NULL DEFAULT '0' COMMENT '0->android , 1 ->ios',
  `lang` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `status` enum('active','not_active') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `verified` int DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visitor` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venders`
--

LOCK TABLES `venders` WRITE;
/*!40000 ALTER TABLE `venders` DISABLE KEYS */;
INSERT INTO `venders` VALUES (1,'mustan','','vendor@yopmail.com','123456789','A2dqxF6s82axdAt51847301695721214_6580263.jpg','$2y$10$0qJcxnXgT0nntpstigQZY..SVakSH51a1eG5uX4Qm2lgC12MbcSBW',NULL,NULL,0,'en','not_active',1,'2023-09-26 09:40:14','2023-10-03 12:04:18','2023-10-03 12:04:18',NULL,1),(2,'Vendor','','mustanseer@yopmail.com','1222342343','$2y$10$0qJcxnXgT0nntpstigQZY..SVakSH51a1eG5uX4Qm2lgC12MbcSBW','$2y$10$0qJcxnXgT0nntpstigQZY..SVakSH51a1eG5uX4Qm2lgC12MbcSBW',NULL,NULL,0,'en','not_active',1,'2023-09-26 09:48:07','2023-11-06 13:29:16',NULL,NULL,1),(3,'testVendor','','testVendor@yopmail.com','77884512035','9kBA9oTsxtomcM533410931696338057_4182990.jpg','$2y$10$ENW3bxK7dVWknVBj9ApAM.oIysKvfRtU33VFjVvGYLeesvc87fXAO',NULL,NULL,0,'en','not_active',1,'2023-10-03 13:00:57','2024-07-24 21:32:06',NULL,NULL,208),(4,'Gagan Darji','','projects@hamiltonkw.com','98825484','xaHIoK7TNnnsljT84169981698590562_7652774.png','$2y$10$dfVFI/u.BuoK4PvGuL2c1u9qhAIoDrGD1HF8Iigfs6DYNz4v0zq9.',NULL,NULL,0,'en','not_active',1,'2023-10-29 14:42:42','2024-07-24 21:32:10',NULL,NULL,198),(5,'yash','','yash.tailor23@gmail.com','8209528643','JgAeDIVNq1jfNtz29026331699252977_2204798.jpg','$2y$10$k9LEbMyFKKNANpmZ6M/qEu4j8XFrOIh768IjMTh4sS84ZvsxYpcI6',NULL,NULL,0,'en','not_active',1,'2023-11-06 06:42:57','2024-08-03 02:01:59',NULL,NULL,149),(6,'kuwait Honey','','yash@hamiltonkw.com','74859685','bISTKmcX43BOFm914109121719487637_2435016.jpg','$2y$10$RBHWMUVRH3g1gwf49XTDQexIs63MXkmeRjHugsmOs0pp/WsY55kUS',NULL,'dcjd1PDxLUVVr4wVoZZ5HG:APA91bFieL6boI3NSXN-Bib1gaISAfF7CA767Q83k3oP1sNmPmzsmX2Z9OAid8-_z9LS-wAf8wU13FqcXnhJyl3CqqOfRmTU-b6WhiC6eWsybYgu_9GfvRp9Ccx4_kqGCsAOY1AIvU5f',1,'en','active',1,'2024-06-27 11:27:17','2024-08-07 05:54:42',NULL,NULL,358),(7,'jack','','terid70498@mposhop.com','52525252','noIJ5Fr2f1sXMwn81938831719811366_2538511.png','$2y$10$N5xvmbt26K0lTfFy8I.w5uLvgG7ygRPOLVj7oVe8TwYK6bswLQFNm',NULL,'efnLAZp5SJ-zduX07gxCm5:APA91bHfS77WM17NtJgHMMvtqP7CNF7dY7lcg1HUJvpdWrONhahVpcBOQ4fJxoOCv_tv7_u9k5An41PVPRxGvjBoCY9wR3-Q89nBsf552knAoin9Ra-9Sx503LtKNFFTgkF8zkwNldqz',0,'en','not_active',1,'2024-07-01 05:22:46','2024-07-02 13:57:29','2024-07-02 13:57:29',NULL,17),(8,'amarjeet','','terid70497@mposhop.com','74859645','OZifJtKXH3a0rX982924681719924705_3340139.jpg','$2y$10$GgIsud8A7Dm0tLh7sPwtk.EwB7yaEzlwi9axBWB/AqXqlCJfFk9ru',NULL,NULL,0,'en','not_active',1,'2024-07-02 12:51:45','2024-07-02 12:51:45',NULL,NULL,1),(9,'mustan seer','','mustanseer110@yopmail.com','66457961','bjW8B8DtIFOrKLd33350971720091673_5912092.jpg','$2y$10$oof6v/Hk/X7RZufzshp8rOFoI3RcNywSE3IiydxSmEpTUNoEebno.',NULL,'e-Ng3DeiTKKXiBigXZqtYg:APA91bGeO_zttHWpRKEHxpAKEwcKQYMdPpcfZeTC8oBnP-6dhpq_h4O6cAC7wuJhhf_C4CyOVi4BsFWfKQKMRxFu4bQbJp75XHaLdz7uvaWSZs-Fa7onGf2Qght100e41h1n40JQ_yEk',0,'en','active',1,'2024-07-04 11:14:33','2024-07-04 14:04:44','2024-07-04 14:04:44',NULL,6),(10,'','','',NULL,NULL,'',NULL,'random-fcm12015117',0,'ar','active',1,'2024-07-04 14:04:45','2024-07-15 12:38:49','2024-07-04 14:04:44',NULL,95),(11,'','','',NULL,NULL,'',NULL,'e-Ng3DeiTKKXiBigXZqtYg:APA91bGeO_zttHWpRKEHxpAKEwcKQYMdPpcfZeTC8oBnP-6dhpq_h4O6cAC7wuJhhf_C4CyOVi4BsFWfKQKMRxFu4bQbJp75XHaLdz7uvaWSZs-Fa7onGf2Qght100e41h1n40JQ_yEk',0,'en','active',1,'2024-07-04 14:04:47','2024-07-15 12:38:32','2024-07-04 14:04:44',NULL,73),(12,'vender','','vendor11@yopmail.com','124456789','RvMoHLBTwJyokPM19259021720103579_5443580.jpg','$2y$10$tyXgsdCFehUnNmLgvPcz6eKPl2dbe0iHBhpHiWwL.qZ2GEWPjxdTS',NULL,NULL,0,'en','active',1,'2024-07-04 14:32:59','2024-08-07 05:54:01',NULL,NULL,86),(13,'yash','','royal80083@carspure.com','52525251','avQtoJwqxEcxYbz99834251721027320_6291113.jpg','$2y$10$8g4VWDcGxAwL2f551gTPYeKzcX1jm76G3FLto79Kdp1pKZkGp.cQ.',NULL,NULL,1,'en','active',1,'2024-07-07 09:39:02','2024-08-07 05:54:52',NULL,NULL,215),(14,'','','',NULL,NULL,'',NULL,'f_QZ8MTyTxiPFdJinL7L-r:APA91bFminwibz7XjAF8nIhByKCgiT2t7qpXuLJsxqRBeF8-d76ibZqENp4eKWSB24V8vChTtHmCoJCZbNdYytAXdgNNdqPN1K09SCGmXhYYOWLuBSOG5_V5Y0KlNz69T0PS-awqwyc8',0,'ar','active',1,'2024-07-07 09:56:55','2024-07-15 10:25:41','2024-07-04 14:04:44',NULL,41),(15,'','','',NULL,NULL,'',NULL,'f_QZ8MTyTxiPFdJinL7L-r:APA91bFminwibz7XjAF8nIhByKCgiT2t7qpXuLJsxqRBeF8-d76ibZqENp4eKWSB24V8vChTtHmCoJCZbNdYytAXdgNNdqPN1K09SCGmXhYYOWLuBSOG5_V5Y0KlNz69T0PS-awqwyc8',0,'en','active',1,'2024-07-07 10:00:49','2024-07-15 05:44:27','2024-07-04 14:04:44',NULL,37);
/*!40000 ALTER TABLE `venders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venders_address`
--

DROP TABLE IF EXISTS `venders_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venders_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vender_id` int NOT NULL,
  `fulladdress` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `area` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `street` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venders_address`
--

LOCK TABLES `venders_address` WRITE;
/*!40000 ALTER TABLE `venders_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `venders_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verification_codes`
--

DROP TABLE IF EXISTS `verification_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `verification_codes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verification_codes`
--

LOCK TABLES `verification_codes` WRITE;
/*!40000 ALTER TABLE `verification_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `verification_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vitamin_product`
--

DROP TABLE IF EXISTS `vitamin_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vitamin_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `vitamin_id` int NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vitamin_product`
--

LOCK TABLES `vitamin_product` WRITE;
/*!40000 ALTER TABLE `vitamin_product` DISABLE KEYS */;
INSERT INTO `vitamin_product` VALUES (1,5,2,'2024-06-11 07:15:30','2024-06-11 07:15:30'),(2,5,1,'2024-06-11 07:15:30','2024-06-11 07:15:30'),(3,3,1,'2024-06-11 07:15:30','2024-06-11 07:15:30'),(4,5,3,'2024-06-11 07:15:30','2024-06-11 07:15:30'),(5,5,4,'2024-06-11 07:15:30','2024-06-11 07:15:30');
/*!40000 ALTER TABLE `vitamin_product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-07 10:23:58
