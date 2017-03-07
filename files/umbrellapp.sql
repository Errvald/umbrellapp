-- MySQL dump 10.13  Distrib 5.6.35, for Linux (x86_64)
--
-- Host: localhost    Database: umbrellapp
-- ------------------------------------------------------
-- Server version	5.6.35

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
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `country` char(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Cummeratachester','GR'),(2,'Margarettburgh','GR'),(3,'New Emmy','GR'),(4,'Lake Lisette','GR'),(5,'West Gaston','GR'),(6,'Port Dustinfurt','GR'),(7,'West Marge','GR'),(8,'Ramonport','GR'),(9,'New Barrett','GR'),(10,'Bednarside','GR');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `city_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favorites_city_id_foreign` (`city_id`),
  KEY `favorites_user_id_foreign` (`user_id`),
  CONSTRAINT `favorites_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forecast`
--

DROP TABLE IF EXISTS `forecast`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forecast` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int(10) unsigned NOT NULL,
  `weather_id` int(10) unsigned NOT NULL,
  `day` date NOT NULL,
  `c_min` tinyint(4) NOT NULL,
  `c_max` tinyint(4) NOT NULL,
  `f_min` tinyint(4) NOT NULL,
  `f_max` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `forecast_city_id_foreign` (`city_id`),
  KEY `forecast_weather_id_foreign` (`weather_id`),
  CONSTRAINT `forecast_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forecast_weather_id_foreign` FOREIGN KEY (`weather_id`) REFERENCES `weather` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forecast`
--

LOCK TABLES `forecast` WRITE;
/*!40000 ALTER TABLE `forecast` DISABLE KEYS */;
INSERT INTO `forecast` VALUES (1,1,1,'2017-03-08',6,39,39,91),(2,1,2,'2017-03-09',7,4,92,63),(3,1,3,'2017-03-10',26,-4,15,10),(4,1,4,'2017-03-11',33,40,45,27),(5,1,5,'2017-03-12',20,14,98,84),(6,2,1,'2017-03-08',40,0,50,54),(7,2,2,'2017-03-09',11,31,77,22),(8,2,3,'2017-03-10',25,1,32,38),(9,2,4,'2017-03-11',39,7,92,80),(10,2,5,'2017-03-12',31,9,61,69),(11,3,1,'2017-03-08',6,40,-1,55),(12,3,2,'2017-03-09',18,39,3,57),(13,3,3,'2017-03-10',16,37,-3,53),(14,3,4,'2017-03-11',36,6,55,92),(15,3,5,'2017-03-12',-4,18,31,21),(16,4,1,'2017-03-08',31,34,59,12),(17,4,2,'2017-03-09',-2,32,69,80),(18,4,3,'2017-03-10',2,8,96,98),(19,4,4,'2017-03-11',36,3,90,36),(20,4,5,'2017-03-12',34,32,-4,17),(21,5,1,'2017-03-08',9,4,86,80),(22,5,2,'2017-03-09',22,27,81,76),(23,5,3,'2017-03-10',17,9,64,83),(24,5,4,'2017-03-11',26,6,65,65),(25,5,5,'2017-03-12',0,9,27,49),(26,6,1,'2017-03-08',16,6,49,61),(27,6,2,'2017-03-09',24,11,67,13),(28,6,3,'2017-03-10',7,21,61,6),(29,6,4,'2017-03-11',3,1,24,59),(30,6,5,'2017-03-12',34,23,48,62),(31,7,1,'2017-03-08',35,23,90,42),(32,7,2,'2017-03-09',-1,35,12,81),(33,7,3,'2017-03-10',25,13,14,82),(34,7,4,'2017-03-11',13,39,67,49),(35,7,5,'2017-03-12',-4,36,3,5),(36,8,1,'2017-03-08',30,-2,73,35),(37,8,2,'2017-03-09',13,37,59,71),(38,8,3,'2017-03-10',37,39,46,60),(39,8,4,'2017-03-11',32,40,62,29),(40,8,5,'2017-03-12',23,14,62,19),(41,9,1,'2017-03-08',18,23,74,6),(42,9,2,'2017-03-09',11,12,44,57),(43,9,3,'2017-03-10',1,13,14,-1),(44,9,4,'2017-03-11',-1,0,50,53),(45,9,5,'2017-03-12',30,16,23,68),(46,10,1,'2017-03-08',25,19,53,75),(47,10,2,'2017-03-09',29,38,74,-5),(48,10,3,'2017-03-10',31,23,98,0),(49,10,4,'2017-03-11',16,-2,14,45),(50,10,5,'2017-03-12',1,-5,99,55);
/*!40000 ALTER TABLE `forecast` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (26,'2017_03_03_145308_create_cities_table',1),(27,'2017_03_03_146824_create_weather_table',1),(28,'2017_03_03_150743_create_forecast_table',1),(29,'2017_03_06_234008_create_users_table',1),(30,'2017_03_07_000826_create_favorites_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Cordelia Heathcote','user1@example.com','$2y$10$e8.ToRHs/emAXGAj7iunD.DvVPQXU1YL6lKwu2B/svQ8Mlt/faQiG','2017-03-07 16:53:01','2017-03-07 16:53:01'),(2,'Mossie Reinger','user2@example.com','$2y$10$IY1C8xNK8dq494zd5w3ieOqo7QuQIHEK/3fvuGT6rz9eks1cQ39BC','2017-03-07 16:53:02','2017-03-07 16:53:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weather`
--

DROP TABLE IF EXISTS `weather`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weather` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `icon` char(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weather`
--

LOCK TABLES `weather` WRITE;
/*!40000 ALTER TABLE `weather` DISABLE KEYS */;
INSERT INTO `weather` VALUES (1,'Similique quidem ipsa.','h02k'),(2,'Dolore ad.','2k0h'),(3,'Facere omnis vitae.','k0h2'),(4,'Tempore sequi vel.','k02h'),(5,'Sunt consequatur.','2h0k');
/*!40000 ALTER TABLE `weather` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-07 16:57:26
