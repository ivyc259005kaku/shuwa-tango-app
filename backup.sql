-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
--
-- Host: localhost    Database: shuwa_tango
-- ------------------------------------------------------
-- Server version	8.0.46

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_07_13_000001_add_role_to_users_table',2),(5,'2026_07_13_000002_create_signs_table',2),(6,'2026_07_13_000003_create_sign_words_table',2),(7,'2026_07_13_000004_create_quiz_options_table',2),(8,'2026_07_13_000005_create_quiz_results_table',2),(9,'2026_07_13_000006_create_user_progress_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_options`
--

DROP TABLE IF EXISTS `quiz_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quiz_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sign_id` bigint unsigned NOT NULL,
  `word` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_options_sign_id_foreign` (`sign_id`),
  CONSTRAINT `quiz_options_sign_id_foreign` FOREIGN KEY (`sign_id`) REFERENCES `signs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_options`
--

LOCK TABLES `quiz_options` WRITE;
/*!40000 ALTER TABLE `quiz_options` DISABLE KEYS */;
INSERT INTO `quiz_options` VALUES (5,2,'まわす',0,'2026-07-14 06:40:54','2026-07-14 06:40:54'),(6,2,'置く',0,'2026-07-14 06:40:54','2026-07-14 06:40:54'),(7,2,'お茶',1,'2026-07-14 06:40:54','2026-07-14 06:40:54'),(8,2,'飲む',0,'2026-07-14 06:40:54','2026-07-14 06:40:54'),(13,3,'屋根',0,'2026-08-01 10:14:24','2026-08-01 10:14:24'),(14,3,'船',0,'2026-08-01 10:14:24','2026-08-01 10:14:24'),(15,3,'サーカス',0,'2026-08-01 10:14:24','2026-08-01 10:14:24'),(16,3,'テント',1,'2026-08-01 10:14:24','2026-08-01 10:14:24'),(25,4,'洗面器',0,'2026-08-01 10:19:07','2026-08-01 10:19:07'),(26,4,'部屋',1,'2026-08-01 10:19:07','2026-08-01 10:19:07'),(27,4,'ハンドル',0,'2026-08-01 10:19:07','2026-08-01 10:19:07'),(28,4,'丸',0,'2026-08-01 10:19:07','2026-08-01 10:19:07'),(29,6,'手術',0,'2026-08-01 13:59:56','2026-08-01 13:59:56'),(30,6,'側面',0,'2026-08-01 13:59:56','2026-08-01 13:59:56'),(31,6,'向こう',0,'2026-08-01 13:59:56','2026-08-01 13:59:56'),(32,6,'予定',1,'2026-08-01 13:59:56','2026-08-01 13:59:56'),(33,7,'養成',1,'2026-08-01 14:04:30','2026-08-01 14:04:30'),(34,7,'マンション',0,'2026-08-01 14:04:30','2026-08-01 14:04:30'),(35,7,'エレベーター',0,'2026-08-01 14:04:30','2026-08-01 14:04:30'),(36,7,'予定',0,'2026-08-01 14:04:30','2026-08-01 14:04:30'),(37,8,'歌う',0,'2026-08-01 14:08:19','2026-08-01 14:08:19'),(38,8,'やさしい、親切',1,'2026-08-01 14:08:19','2026-08-01 14:08:19'),(39,8,'波',0,'2026-08-01 14:08:19','2026-08-01 14:08:19'),(40,8,'事故',0,'2026-08-01 14:08:19','2026-08-01 14:08:19'),(41,9,'遊ぶ',0,'2026-08-01 14:13:27','2026-08-01 14:13:27'),(42,9,'ライン',0,'2026-08-01 14:13:27','2026-08-01 14:13:27'),(43,9,'レクリエーション',1,'2026-08-01 14:13:27','2026-08-01 14:13:27'),(44,9,'会社',0,'2026-08-01 14:13:27','2026-08-01 14:13:27'),(45,10,'元気',0,'2026-08-01 14:16:10','2026-08-01 14:16:10'),(46,10,'了承',1,'2026-08-01 14:16:10','2026-08-01 14:16:10'),(47,10,'楽しい',0,'2026-08-01 14:16:10','2026-08-01 14:16:10'),(48,10,'わかった',0,'2026-08-01 14:16:10','2026-08-01 14:16:10'),(49,11,'切れる',0,'2026-08-01 14:19:21','2026-08-01 14:19:21'),(50,11,'（約束を）やぶる',1,'2026-08-01 14:19:21','2026-08-01 14:19:21'),(51,11,'結ぶ',0,'2026-08-01 14:19:21','2026-08-01 14:19:21'),(52,11,'外れる',0,'2026-08-01 14:19:21','2026-08-01 14:19:21'),(53,12,'お金',0,'2026-08-01 14:21:58','2026-08-01 14:21:58'),(54,12,'どける',0,'2026-08-01 14:21:58','2026-08-01 14:21:58'),(55,12,'利用',1,'2026-08-01 14:21:58','2026-08-01 14:21:58'),(56,12,'外れる',0,'2026-08-01 14:21:58','2026-08-01 14:21:58'),(57,13,'家',0,'2026-08-01 14:24:41','2026-08-01 14:24:41'),(58,13,'宿',1,'2026-08-01 14:24:41','2026-08-01 14:24:41'),(59,13,'電話',0,'2026-08-01 14:24:41','2026-08-01 14:24:41'),(60,13,'三角',0,'2026-08-01 14:24:41','2026-08-01 14:24:41'),(61,14,'見る',0,'2026-08-01 14:28:00','2026-08-01 14:28:00'),(62,14,'（手話を）読み取る',1,'2026-08-01 14:28:00','2026-08-01 14:28:00'),(63,14,'取る',0,'2026-08-01 14:28:00','2026-08-01 14:28:00'),(64,14,'明日',0,'2026-08-01 14:28:00','2026-08-01 14:28:00'),(65,15,'用事、必要',1,'2026-08-01 14:30:58','2026-08-01 14:30:58'),(66,15,'全部',0,'2026-08-01 14:30:58','2026-08-01 14:30:58'),(67,15,'貰う',0,'2026-08-01 14:30:58','2026-08-01 14:30:58'),(68,15,'自分',0,'2026-08-01 14:30:58','2026-08-01 14:30:58'),(69,16,'上がる',0,'2026-08-01 14:33:51','2026-08-01 14:33:51'),(70,16,'たとえば',0,'2026-08-01 14:33:51','2026-08-01 14:33:51'),(71,16,'エレベーター',0,'2026-08-01 14:33:51','2026-08-01 14:33:51'),(72,16,'有名',1,'2026-08-01 14:33:51','2026-08-01 14:33:51'),(73,17,'顔',0,'2026-08-01 14:37:01','2026-08-01 14:37:01'),(74,17,'会う',0,'2026-08-01 14:37:01','2026-08-01 14:37:01'),(75,17,'面接',1,'2026-08-01 14:37:01','2026-08-01 14:37:01'),(76,17,'来る',0,'2026-08-01 14:37:01','2026-08-01 14:37:01'),(77,18,'ふさぐ',0,'2026-08-01 14:39:29','2026-08-01 14:39:29'),(78,18,'イヤホン',0,'2026-08-01 14:39:29','2026-08-01 14:39:29'),(79,18,'耳',0,'2026-08-01 14:39:29','2026-08-01 14:39:29'),(80,18,'やかましい',1,'2026-08-01 14:39:29','2026-08-01 14:39:29'),(81,19,'なくす',0,'2026-08-01 14:42:17','2026-08-01 14:42:17'),(82,19,'無料',1,'2026-08-01 14:42:17','2026-08-01 14:42:17'),(83,19,'土',0,'2026-08-01 14:42:17','2026-08-01 14:42:17'),(84,19,'はやい',0,'2026-08-01 14:42:18','2026-08-01 14:42:18'),(85,20,'作る',0,'2026-08-01 14:45:13','2026-08-01 14:45:13'),(86,20,'痛い',0,'2026-08-01 14:45:13','2026-08-01 14:45:13'),(87,20,'面倒',1,'2026-08-01 14:45:13','2026-08-01 14:45:13'),(88,20,'時計',0,'2026-08-01 14:45:13','2026-08-01 14:45:13'),(89,21,'盲導犬',1,'2026-08-01 14:48:12','2026-08-01 14:48:12'),(90,21,'予定',0,'2026-08-01 14:48:12','2026-08-01 14:48:12'),(91,21,'犬',0,'2026-08-01 14:48:12','2026-08-01 14:48:12'),(92,21,'見る',0,'2026-08-01 14:48:12','2026-08-01 14:48:12'),(93,22,'関節',0,'2026-08-01 14:51:42','2026-08-01 14:51:42'),(94,22,'もっと',1,'2026-08-01 14:51:42','2026-08-01 14:51:42'),(95,22,'成長',0,'2026-08-01 14:51:42','2026-08-01 14:51:42'),(96,22,'上る',0,'2026-08-01 14:51:42','2026-08-01 14:51:42'),(97,23,'上下',0,'2026-08-01 14:54:53','2026-08-01 14:54:53'),(98,23,'３３',0,'2026-08-01 14:54:53','2026-08-01 14:54:53'),(99,23,'くわ',0,'2026-08-01 14:54:53','2026-08-01 14:54:53'),(100,23,'ルール',1,'2026-08-01 14:54:53','2026-08-01 14:54:53'),(101,24,'落ちる',0,'2026-08-01 14:57:11','2026-08-01 14:57:11'),(102,24,'（お金が）安い',1,'2026-08-01 14:57:11','2026-08-01 14:57:11'),(103,24,'拾う',0,'2026-08-01 14:57:11','2026-08-01 14:57:11'),(104,24,'持っていく',0,'2026-08-01 14:57:11','2026-08-01 14:57:11'),(105,25,'計算',0,'2026-08-01 15:00:10','2026-08-01 15:00:10'),(106,25,'自分',0,'2026-08-01 15:00:10','2026-08-01 15:00:10'),(107,25,'易い、簡単',1,'2026-08-01 15:00:10','2026-08-01 15:00:10'),(108,25,'置く',0,'2026-08-01 15:00:10','2026-08-01 15:00:10'),(109,26,'ダンベル',0,'2026-08-01 15:02:13','2026-08-01 15:02:13'),(110,26,'持つ',1,'2026-08-01 15:02:13','2026-08-01 15:02:13'),(111,26,'力',0,'2026-08-01 15:02:13','2026-08-01 15:02:13'),(112,26,'置く',0,'2026-08-01 15:02:13','2026-08-01 15:02:13'),(113,27,'ダーツ',0,'2026-08-01 15:05:27','2026-08-01 15:05:27'),(114,27,'当てる',0,'2026-08-01 15:05:27','2026-08-01 15:05:27'),(115,27,'目的',1,'2026-08-01 15:05:27','2026-08-01 15:05:27'),(116,27,'遠いところ',0,'2026-08-01 15:05:27','2026-08-01 15:05:27'),(117,28,'眼精疲労',0,'2026-08-01 15:07:51','2026-08-01 15:07:51'),(118,28,'迷惑、困る',1,'2026-08-01 15:07:51','2026-08-01 15:07:51'),(119,28,'悲しい',0,'2026-08-01 15:07:51','2026-08-01 15:07:51'),(120,28,'感動する',0,'2026-08-01 15:07:51','2026-08-01 15:07:51'),(121,29,'無理',1,'2026-08-01 15:10:06','2026-08-01 15:10:06'),(122,29,'嫌い',0,'2026-08-01 15:10:06','2026-08-01 15:10:06'),(123,29,'遅い',0,'2026-08-01 15:10:06','2026-08-01 15:10:06'),(124,29,'速い',0,'2026-08-01 15:10:06','2026-08-01 15:10:06'),(125,30,'無理',0,'2026-08-01 15:13:08','2026-08-01 15:13:08'),(126,30,'向こう',0,'2026-08-01 15:13:08','2026-08-01 15:13:08'),(127,30,'見る',0,'2026-08-01 15:13:08','2026-08-01 15:13:08'),(128,30,'無視される',1,'2026-08-01 15:13:08','2026-08-01 15:13:08'),(129,31,'捕まる',0,'2026-08-01 15:16:13','2026-08-01 15:16:13'),(130,31,'ひっかける',0,'2026-08-01 15:16:13','2026-08-01 15:16:13'),(131,31,'約束',1,'2026-08-01 15:16:13','2026-08-01 15:16:13'),(132,31,'つなぐ',0,'2026-08-01 15:16:13','2026-08-01 15:16:13'),(133,32,'歴史',1,'2026-08-01 15:19:35','2026-08-01 15:19:35'),(134,32,'手品',0,'2026-08-01 15:19:35','2026-08-01 15:19:35'),(135,32,'広げる',0,'2026-08-01 15:19:35','2026-08-01 15:19:35'),(136,32,'波',0,'2026-08-01 15:19:35','2026-08-01 15:19:35'),(137,33,'人々',0,'2026-08-01 15:22:19','2026-08-01 15:22:19'),(138,33,'家族',0,'2026-08-01 15:22:19','2026-08-01 15:22:19'),(139,33,'地球',0,'2026-08-01 15:22:19','2026-08-01 15:22:19'),(140,33,'世の中、社会、世間',1,'2026-08-01 15:22:19','2026-08-01 15:22:19'),(141,5,'うらやましい',1,'2026-08-02 06:22:00','2026-08-02 06:22:00'),(142,5,'口',0,'2026-08-02 06:22:00','2026-08-02 06:22:00'),(143,5,'ほほ',0,'2026-08-02 06:22:00','2026-08-02 06:22:00'),(144,5,'赤い',0,'2026-08-02 06:22:00','2026-08-02 06:22:00');
/*!40000 ALTER TABLE `quiz_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_results`
--

DROP TABLE IF EXISTS `quiz_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quiz_results` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `sign_id` bigint unsigned NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `answered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `quiz_results_user_id_foreign` (`user_id`),
  KEY `quiz_results_sign_id_foreign` (`sign_id`),
  CONSTRAINT `quiz_results_sign_id_foreign` FOREIGN KEY (`sign_id`) REFERENCES `signs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quiz_results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_results`
--

LOCK TABLES `quiz_results` WRITE;
/*!40000 ALTER TABLE `quiz_results` DISABLE KEYS */;
INSERT INTO `quiz_results` VALUES (1,3,7,1,'2026-08-02 06:15:41'),(2,3,29,0,'2026-08-02 06:16:16'),(3,3,16,0,'2026-08-02 06:16:50'),(4,3,19,1,'2026-08-02 06:17:07'),(5,3,4,1,'2026-08-02 06:17:33'),(6,3,30,0,'2026-08-02 06:18:33'),(7,3,32,1,'2026-08-02 06:18:50'),(8,3,5,0,'2026-08-02 06:19:08'),(9,2,27,1,'2026-08-02 07:57:25'),(10,2,9,1,'2026-08-02 07:57:38'),(11,2,9,1,'2026-08-02 08:04:18'),(12,2,9,1,'2026-08-02 08:04:21'),(13,3,31,1,'2026-08-02 08:05:09'),(14,3,26,1,'2026-08-02 08:05:14'),(15,3,28,1,'2026-08-02 08:05:17'),(16,3,5,1,'2026-08-02 08:05:20'),(17,3,30,1,'2026-08-02 08:05:24'),(18,3,23,1,'2026-08-02 08:05:26'),(19,3,33,1,'2026-08-02 08:05:29'),(20,3,7,1,'2026-08-02 08:05:33'),(21,3,8,1,'2026-08-02 08:05:35'),(22,3,29,1,'2026-08-02 08:05:40');
/*!40000 ALTER TABLE `quiz_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('FWTMxAxCiA76JrPNt0Y0sNK1lUnljURxmBkBmXcj',NULL,'172.19.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0','eyJfdG9rZW4iOiJkSDAwWXFOSzBIUExteUh3MmZUdkE5b0E2ekF1aml1TE1IcXB5ZHlEIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FkbWluXC93b3JkcyJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FkbWluXC93b3JkcyIsInJvdXRlIjoiYWRtaW4ud29yZHMifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1785651159),('ICM6rIQmTWhtUsxzNfzgmbl7m837HbCEjNcBt1r6',NULL,'172.19.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0','eyJfdG9rZW4iOiJ5TDhqUGM4R1RnQjQ4VXN1NDRubzhPaFpORElhRmVoTmRySk9YaHo5IiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FkbWluXC93b3JkcyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1785651159),('MYJtWgcj2m0QOvfSjJ5uM2TyTO7uskwW9phfyuAv',3,'172.19.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0','eyJfdG9rZW4iOiJacjFsbGZOaXF1Y1NPVkJjOVdmbHZTZmxMUWNKMHpSbzI1WEx1ZjBtIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL3Byb2dyZXNzIiwicm91dGUiOiJwcm9ncmVzcy5pbmRleCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MywicXVpeiI6eyJxdWV1ZSI6WzIzLDMyLDE5LDksNSw0LDEyLDExLDI5LDhdLCJpbmRleCI6MCwiY29ycmVjdCI6MH19',1785667382),('OevaXCv4UzNYsZmuh7VdClYIiKRU0UIECLqzUcuY',2,'172.19.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0','eyJfdG9rZW4iOiJWcHJLdnAwdzRYc1ZDN0ozbldNaTF1czFkNkZGR1I5cVNOWGJhaGw0IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FkbWluXC93b3JkcyIsInJvdXRlIjoiYWRtaW4ud29yZHMifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjJ9',1785719981),('SxZeyx45yG49VG2AXHPI9LmVRBRy5gv3XxJFs0FV',NULL,'172.19.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0','eyJfdG9rZW4iOiJUNmNrYlk3UHo2SnFoUHVuWjNNaG9QZ2thQlM0SVk0MFo1QVE0VzRxIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FkbWluXC93b3JkcyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1785651159),('xPJ8g6Iix0ugDgdSKKincrrT9iaOCxQIoWOdrHhq',NULL,'172.19.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0','eyJfdG9rZW4iOiJ4emphbFhyZjRwejA0RmU2b3BnNkkxQVJEOTRSZTlEUjVwRXJIa3poIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2FkbWluXC93b3JkcyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1785651163);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sign_words`
--

DROP TABLE IF EXISTS `sign_words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sign_words` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sign_id` bigint unsigned NOT NULL,
  `word` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sign_words_sign_id_foreign` (`sign_id`),
  CONSTRAINT `sign_words_sign_id_foreign` FOREIGN KEY (`sign_id`) REFERENCES `signs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sign_words`
--

LOCK TABLES `sign_words` WRITE;
/*!40000 ALTER TABLE `sign_words` DISABLE KEYS */;
INSERT INTO `sign_words` VALUES (14,2,'お茶','2026-07-14 06:40:54','2026-07-14 06:40:54'),(15,2,'湯呑','2026-07-14 06:40:54','2026-07-14 06:40:54'),(17,3,'テント','2026-08-01 10:14:24','2026-08-01 10:14:24'),(20,4,'部屋','2026-08-01 10:19:07','2026-08-01 10:19:07'),(21,6,'予定','2026-08-01 13:59:56','2026-08-01 13:59:56'),(22,7,'養成','2026-08-01 14:04:30','2026-08-01 14:04:30'),(23,8,'優しい','2026-08-01 14:08:19','2026-08-01 14:08:19'),(24,8,'親切','2026-08-01 14:08:19','2026-08-01 14:08:19'),(25,9,'レクリエーション','2026-08-01 14:13:27','2026-08-01 14:13:27'),(26,10,'了承','2026-08-01 14:16:10','2026-08-01 14:16:10'),(27,11,'（約束を）やぶる','2026-08-01 14:19:21','2026-08-01 14:19:21'),(28,12,'利用','2026-08-01 14:21:58','2026-08-01 14:21:58'),(29,13,'宿','2026-08-01 14:24:41','2026-08-01 14:24:41'),(30,14,'（手話を）読み取る','2026-08-01 14:28:00','2026-08-01 14:28:00'),(31,15,'用事','2026-08-01 14:30:58','2026-08-01 14:30:58'),(32,15,'必要','2026-08-01 14:30:58','2026-08-01 14:30:58'),(33,16,'有名','2026-08-01 14:33:51','2026-08-01 14:33:51'),(34,17,'面接','2026-08-01 14:37:00','2026-08-01 14:37:00'),(35,18,'やかましい','2026-08-01 14:39:29','2026-08-01 14:39:29'),(36,19,'無料','2026-08-01 14:42:17','2026-08-01 14:42:17'),(37,20,'面倒','2026-08-01 14:45:13','2026-08-01 14:45:13'),(38,21,'盲導犬','2026-08-01 14:48:12','2026-08-01 14:48:12'),(39,22,'もっと','2026-08-01 14:51:42','2026-08-01 14:51:42'),(40,23,'ルール','2026-08-01 14:54:53','2026-08-01 14:54:53'),(41,24,'（お金が）安い','2026-08-01 14:57:11','2026-08-01 14:57:11'),(42,25,'易い','2026-08-01 15:00:10','2026-08-01 15:00:10'),(43,25,'簡単','2026-08-01 15:00:10','2026-08-01 15:00:10'),(44,26,'持つ','2026-08-01 15:02:13','2026-08-01 15:02:13'),(45,27,'目的','2026-08-01 15:05:27','2026-08-01 15:05:27'),(46,28,'迷惑','2026-08-01 15:07:51','2026-08-01 15:07:51'),(47,28,'困る','2026-08-01 15:07:51','2026-08-01 15:07:51'),(48,29,'無理','2026-08-01 15:10:06','2026-08-01 15:10:06'),(49,30,'無視される','2026-08-01 15:13:08','2026-08-01 15:13:08'),(50,31,'約束','2026-08-01 15:16:13','2026-08-01 15:16:13'),(51,32,'歴史','2026-08-01 15:19:35','2026-08-01 15:19:35'),(52,33,'世の中','2026-08-01 15:22:19','2026-08-01 15:22:19'),(53,33,'社会','2026-08-01 15:22:19','2026-08-01 15:22:19'),(54,33,'世間','2026-08-01 15:22:19','2026-08-01 15:22:19'),(55,5,'うらやましい','2026-08-02 06:22:00','2026-08-02 06:22:00');
/*!40000 ALTER TABLE `sign_words` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `signs`
--

DROP TABLE IF EXISTS `signs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `signs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `signs`
--

LOCK TABLES `signs` WRITE;
/*!40000 ALTER TABLE `signs` DISABLE KEYS */;
INSERT INTO `signs` VALUES (2,'signs/kBj07z9vi2U66dm0thnXLGvgQTONHkStYNJ1SKPb.png','手話技能検定','2026-07-14 05:02:02','2026-07-14 05:02:02'),(3,'signs/sAW8MRhY3opJaTXCFkrzQs6nJCeQ7OLjBg4Ebf66.png','手話技能検定','2026-07-14 05:44:27','2026-07-14 05:44:27'),(4,'signs/3Y8905OVYnF89v7nHkkVkXyMH02STTywAbXJOyDM.png','手話技能検定','2026-07-14 05:46:16','2026-08-01 10:19:07'),(5,'signs/IJzBo7qIjcnWVw2QOdyT8aQo02MiDNCKiy3nsbl2.png','手話技能検定','2026-07-14 05:46:46','2026-08-01 10:18:45'),(6,'signs/EHbFbkivLBbaDnus4bFhBplRwzCqZIN0KclxIlyZ.png','手話技能検定','2026-08-01 13:59:55','2026-08-01 13:59:55'),(7,'signs/8ecB3LcjFRFJZ6hqyE9f5a30rHb8M2Pxcj1xhPI4.png','手話技能検定','2026-08-01 14:04:30','2026-08-01 14:04:30'),(8,'signs/vbW0GwG6z25Zaws44sjEBCLzkz8e4AhyNHYkNnvf.png','手話技能検定','2026-08-01 14:08:19','2026-08-01 14:08:19'),(9,'signs/KZ2Xx79Qr2BGmViWAwNdb419yt2i2fc0nnD0WIh4.png','手話技能検定','2026-08-01 14:13:27','2026-08-01 14:13:27'),(10,'signs/6ob4n8uJzMZhaCnr6uNSaH3BMFSgL3DCoOBoqqDU.png','手話技能検定','2026-08-01 14:16:10','2026-08-01 14:16:10'),(11,'signs/SRJK5tqKwChtpPIej8gLI7qHtihnBnv3huPut37u.png','手話技能検定','2026-08-01 14:19:21','2026-08-01 14:19:21'),(12,'signs/U4sw0Nexx2DHlitW7vfuArjj5QTQt5YhOE5g68Va.png','手話技能検定','2026-08-01 14:21:58','2026-08-01 14:21:58'),(13,'signs/A6zDvp4qZ6ZWuCaEWI6dgXEkhlKece9EeOGuIXaT.png','手話技能検定','2026-08-01 14:24:41','2026-08-01 14:24:41'),(14,'signs/QOSfvc8jVIs381pCERYqt8Sap7ZN7qoiugnt78UH.png','手話技能検定','2026-08-01 14:28:00','2026-08-01 14:28:00'),(15,'signs/Bli1RNieaYnHqqBZAwqs03zAsc5K7DadCEFp87aH.png','手話技能検定','2026-08-01 14:30:57','2026-08-01 14:30:57'),(16,'signs/GJrYz1dUfqDomIh1pdiAY77b46avhODqJyiKJJFu.png','手話技能検定','2026-08-01 14:33:51','2026-08-01 14:33:51'),(17,'signs/29HVRyuHFwQ5xS1oghlol13refTr3LNy3b4P4i2N.png','手話技能検定','2026-08-01 14:37:00','2026-08-01 14:37:00'),(18,'signs/YUg1oVBT3AsD1GhSZR8QYPiKXfIaixF3yqtaT73a.png','手話技能検定','2026-08-01 14:39:29','2026-08-01 14:39:29'),(19,'signs/VTubipwfN4tLe1jADfoI7RjFgdIHx44eogD5ElmH.png','手話技能検定','2026-08-01 14:42:17','2026-08-01 14:42:17'),(20,'signs/EVoRqDlbWPqfgkn9qJuMZU2zGJDaagh0nv3YoWXJ.png','手話技能検定','2026-08-01 14:45:12','2026-08-01 14:45:12'),(21,'signs/pIqzry7XiGJWQyiCFi0C5DTxlq0SAX2wTnlZcpQo.png','手話技能検定','2026-08-01 14:48:12','2026-08-01 14:48:12'),(22,'signs/fIT0KaUnhBHbHx5LgnTiAAdcAqwBHxpphT7z0BHF.png','手話技能検定','2026-08-01 14:51:42','2026-08-01 14:51:42'),(23,'signs/Gb6KNVHJdg7XI0xjMMwtykJnUf5Mjrg3nTl1Wfcf.png','手話技能検定','2026-08-01 14:54:52','2026-08-01 14:54:52'),(24,'signs/lBu7LON4z1055Rh9qQGgKDQJWrGpcJ3KQS4H45Nr.png','手話技能検定','2026-08-01 14:57:11','2026-08-01 14:57:11'),(25,'signs/xDgaPqXp6dxwkRWrSozFx8hdV7GFLMYnNxUtWOno.png','手話技能検定','2026-08-01 15:00:10','2026-08-01 15:00:10'),(26,'signs/CG2s8LawjE2ZfaTjTU4dHiqLzfXGZxACpIWdOPQP.png','手話技能検定','2026-08-01 15:02:13','2026-08-01 15:02:13'),(27,'signs/uQO3YaezguFhFUDrH8a6s5gITMkUvzdkNBvGiANr.png','手話技能検定','2026-08-01 15:05:26','2026-08-01 15:05:26'),(28,'signs/e8H7v8CvkLotWeUVBRxxMeqlbvT6PwOiLYifiUvC.png','手話技能検定','2026-08-01 15:07:51','2026-08-01 15:07:51'),(29,'signs/VXyFDvLfAqE6cI9JkgObrHyKS6dOuu0Lhyk1N2AV.png','手話技能検定','2026-08-01 15:10:05','2026-08-01 15:10:05'),(30,'signs/cx7Ysmf70oEy2Th9fqPLQXYkIRvLuRmdrQaOFqlt.png','手話技能検定','2026-08-01 15:13:08','2026-08-01 15:13:08'),(31,'signs/krlZasevN0uaaqNFDdycaOd31yoCVapawEXQtj9D.png','手話技能検定','2026-08-01 15:16:12','2026-08-01 15:16:12'),(32,'signs/yLI42CR2KZZCT9wIZwaicmmWAe6z2on5EYTVZ0Qb.png','手話技能検定','2026-08-01 15:19:35','2026-08-01 15:19:35'),(33,'signs/hpoJYmKBjxUQenoWYKiJe1qv0jmEtdZUKJMYnQ9U.png','手話技能検定','2026-08-01 15:22:19','2026-08-01 15:22:19');
/*!40000 ALTER TABLE `signs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_progress`
--

DROP TABLE IF EXISTS `user_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_progress` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `sign_id` bigint unsigned NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_progress_user_id_sign_id_unique` (`user_id`,`sign_id`),
  KEY `user_progress_sign_id_foreign` (`sign_id`),
  CONSTRAINT `user_progress_sign_id_foreign` FOREIGN KEY (`sign_id`) REFERENCES `signs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_progress_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_progress`
--

LOCK TABLES `user_progress` WRITE;
/*!40000 ALTER TABLE `user_progress` DISABLE KEYS */;
INSERT INTO `user_progress` VALUES (1,3,7,'習得済み','2026-08-02 06:15:42','2026-08-02 06:15:42'),(2,3,29,'習得済み','2026-08-02 06:16:16','2026-08-02 08:05:40'),(3,3,16,'学習中','2026-08-02 06:16:50','2026-08-02 06:16:50'),(4,3,19,'習得済み','2026-08-02 06:17:07','2026-08-02 06:17:07'),(5,3,4,'習得済み','2026-08-02 06:17:33','2026-08-02 06:17:33'),(6,3,30,'習得済み','2026-08-02 06:18:33','2026-08-02 08:05:24'),(7,3,32,'習得済み','2026-08-02 06:18:50','2026-08-02 06:18:50'),(8,3,5,'習得済み','2026-08-02 06:19:08','2026-08-02 08:05:20'),(9,2,27,'習得済み','2026-08-02 07:57:25','2026-08-02 07:57:25'),(10,2,9,'習得済み','2026-08-02 07:57:38','2026-08-02 07:57:38'),(11,3,31,'習得済み','2026-08-02 08:05:09','2026-08-02 08:05:09'),(12,3,26,'習得済み','2026-08-02 08:05:14','2026-08-02 08:05:14'),(13,3,28,'習得済み','2026-08-02 08:05:17','2026-08-02 08:05:17'),(14,3,23,'習得済み','2026-08-02 08:05:26','2026-08-02 08:05:26'),(15,3,33,'習得済み','2026-08-02 08:05:29','2026-08-02 08:05:29'),(16,3,8,'習得済み','2026-08-02 08:05:35','2026-08-02 08:05:35');
/*!40000 ALTER TABLE `user_progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'テスト太郎','test@example.com',NULL,'$2y$12$VTOk.SK6ON7gR8zdljO.yO5F2L9STIwSsbNpMSunIus.l8Anb0LtW','user',NULL,'2026-07-13 05:22:28','2026-07-13 05:22:28'),(2,'管理者','admin@example.com',NULL,'$2y$12$9Gg/0RQC00VxsRJt6FZr8eklJHbQP6WOnCHQxYJ5m1a2btSW4UIC6','admin',NULL,'2026-07-13 05:46:25','2026-07-13 06:34:07'),(3,'賀来　らら','c259005@ivy.ac.jp',NULL,'$2y$12$u1cP42Fge/OgOYcG2TWzROJSsc.b7yjyOvbM9PYZWICOzPoInZ78K','user',NULL,'2026-08-01 10:20:34','2026-08-01 10:20:34');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-03  1:51:35
