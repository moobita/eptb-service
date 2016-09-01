-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: swut_sys
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.9-MariaDB

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
-- Table structure for table `trn_edu_testing_subjects`
--

DROP TABLE IF EXISTS `trn_edu_testing_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_edu_testing_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trn_edu_testing_id` int(11) NOT NULL,
  `subjects_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สถานะ',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_edu_testing_subjects`
--

LOCK TABLES `trn_edu_testing_subjects` WRITE;
/*!40000 ALTER TABLE `trn_edu_testing_subjects` DISABLE KEYS */;
INSERT INTO `trn_edu_testing_subjects` VALUES (1,31,2,1,0,'2016-04-25 21:03:01',1,'2016-04-25 21:03:01',1),(4,31,1,1,0,'2016-05-03 16:59:54',1,'2016-05-03 16:59:54',1),(5,31,13,1,0,'2016-05-03 16:59:57',1,'2016-05-03 16:59:57',1),(7,22,2,1,0,'2016-05-03 19:30:58',1,'2016-05-03 19:30:58',1),(8,22,13,1,0,'2016-05-03 19:31:03',1,'2016-05-03 19:31:03',1),(9,31,14,1,0,'2016-05-08 20:41:06',1,'2016-05-08 20:41:06',1),(11,32,1,1,0,'2016-05-09 11:57:11',1,'2016-05-09 11:57:11',1),(12,32,2,1,0,'2016-05-09 11:57:11',1,'2016-05-09 11:57:11',1),(13,32,14,1,0,'2016-05-09 11:57:11',1,'2016-05-09 11:57:11',1),(15,32,13,1,0,'2016-05-09 12:05:19',1,'2016-05-09 12:05:19',1),(16,35,2,1,0,'2016-05-10 05:25:46',1,'2016-05-10 05:25:46',1),(17,35,13,1,0,'2016-05-10 05:25:46',1,'2016-05-10 05:25:46',1),(18,33,2,1,0,'2016-05-15 08:32:14',1,'2016-05-15 08:32:14',1),(19,31,16,1,0,'2016-05-16 00:02:29',1,'2016-05-16 00:02:29',1),(21,37,14,1,0,'2016-05-16 08:09:48',1,'2016-05-16 08:09:48',1),(22,37,2,1,0,'2016-05-16 08:11:09',1,'2016-05-16 08:11:09',1),(23,38,13,1,0,'2016-05-16 08:32:12',1,'2016-05-16 08:32:12',1),(24,39,16,1,0,'2016-05-16 08:34:05',1,'2016-05-16 08:34:05',1);
/*!40000 ALTER TABLE `trn_edu_testing_subjects` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-17 12:58:52
