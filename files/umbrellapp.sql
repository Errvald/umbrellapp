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
INSERT INTO `cities` VALUES (1,'Pollichburgh','GR'),(2,'Damonstad','GR'),(3,'Kaleighville','GR'),(4,'Port Angelofurt','GR'),(5,'East Maurinefurt','GR'),(6,'Samirside','GR'),(7,'Kuhicberg','GR'),(8,'Lake Audrafurt','GR'),(9,'New Stephanyborough','GR'),(10,'Oliverfurt','GR');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
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
INSERT INTO `forecast` VALUES (1,1,1,'2017-03-07',24,13,95,68),(2,1,2,'2017-03-08',1,0,93,36),(3,1,3,'2017-03-09',9,3,44,14),(4,1,4,'2017-03-10',24,-1,43,39),(5,1,5,'2017-03-11',13,34,99,21),(6,2,1,'2017-03-07',24,4,45,76),(7,2,2,'2017-03-08',15,39,3,8),(8,2,3,'2017-03-09',34,24,89,40),(9,2,4,'2017-03-10',18,22,46,60),(10,2,5,'2017-03-11',14,30,67,4),(11,3,1,'2017-03-07',30,17,39,36),(12,3,2,'2017-03-08',17,1,74,77),(13,3,3,'2017-03-09',38,8,20,89),(14,3,4,'2017-03-10',38,2,99,62),(15,3,5,'2017-03-11',18,38,91,30),(16,4,1,'2017-03-07',1,2,39,34),(17,4,2,'2017-03-08',30,21,5,49),(18,4,3,'2017-03-09',15,17,23,54),(19,4,4,'2017-03-10',-5,9,98,5),(20,4,5,'2017-03-11',17,11,-4,75),(21,5,1,'2017-03-07',29,11,59,36),(22,5,2,'2017-03-08',30,17,22,41),(23,5,3,'2017-03-09',32,0,38,52),(24,5,4,'2017-03-10',27,-2,61,60),(25,5,5,'2017-03-11',1,11,94,70),(26,6,1,'2017-03-07',35,15,-4,53),(27,6,2,'2017-03-08',27,32,12,73),(28,6,3,'2017-03-09',9,26,72,43),(29,6,4,'2017-03-10',4,22,47,33),(30,6,5,'2017-03-11',37,39,100,13),(31,7,1,'2017-03-07',38,12,-3,57),(32,7,2,'2017-03-08',1,6,64,93),(33,7,3,'2017-03-09',35,20,58,54),(34,7,4,'2017-03-10',10,6,75,10),(35,7,5,'2017-03-11',12,16,43,97),(36,8,1,'2017-03-07',15,25,95,14),(37,8,2,'2017-03-08',-3,9,18,2),(38,8,3,'2017-03-09',35,10,21,82),(39,8,4,'2017-03-10',35,18,43,12),(40,8,5,'2017-03-11',0,9,18,82),(41,9,1,'2017-03-07',24,4,10,9),(42,9,2,'2017-03-08',12,25,82,86),(43,9,3,'2017-03-09',-5,14,15,18),(44,9,4,'2017-03-10',1,37,36,87),(45,9,5,'2017-03-11',23,15,65,12),(46,10,1,'2017-03-07',17,6,58,30),(47,10,2,'2017-03-08',11,27,81,90),(48,10,3,'2017-03-09',12,4,3,62),(49,10,4,'2017-03-10',36,22,70,33),(50,10,5,'2017-03-11',-1,31,14,80);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2017_03_03_145308_create_cities_table',1),(2,'2017_03_03_146824_create_weather_table',1),(3,'2017_03_03_150743_create_forecast_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
INSERT INTO `weather` VALUES (1,'Sit totam est.','2h0k'),(2,'Qui est temporibus.','k20h'),(3,'Perferendis assumenda.','k20h'),(4,'Rem deleniti rerum.','k0h2'),(5,'Fuga quis est.','h0k2');
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

-- Dump completed on 2017-03-06 22:52:43
