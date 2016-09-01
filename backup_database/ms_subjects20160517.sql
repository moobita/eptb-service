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
-- Table structure for table `ms_subjects`
--

DROP TABLE IF EXISTS `ms_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ms_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `name_code` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'รหัสวิชา',
  `name_th` varchar(45) CHARACTER SET utf8 NOT NULL COMMENT 'ชื่อวิชา',
  `name_en` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ชื่อวิชา(อังกฤษ)',
  `test_type_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT 'สถานะ',
  `deleted` tinyint(1) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ms_subjects`
--

LOCK TABLES `ms_subjects` WRITE;
/*!40000 ALTER TABLE `ms_subjects` DISABLE KEYS */;
INSERT INTO `ms_subjects` VALUES (1,'S1','ภาษา','',1,1,0,'2016-04-25 18:43:57',1,'2016-04-25 18:43:57',1),(2,'02','เทคนิคและวิธีการทางกายภาพบำบัด','',1,1,0,'2016-04-25 18:47:34',1,'2016-04-25 18:47:34',1),(13,'S1','ภาษา 2','',3,1,0,'2016-04-27 20:12:09',1,'2016-04-27 20:12:09',1),(14,'0','test','',1,1,0,'2016-04-29 22:54:54',1,'2016-05-14 05:51:44',1),(15,'0','dfasdfasfsafaf','',3,1,0,'2016-05-15 04:04:00',1,'2016-05-15 04:04:00',1),(16,'0','เเเเเเเเเเเเเเเเเเเเเเเ','',2,1,0,'2016-05-15 08:14:56',1,'2016-05-15 08:14:56',1),(17,'0','A03_ทดสอบ','A04_test',1,1,0,'2016-05-15 14:31:31',1,'2016-05-15 14:31:31',1),(18,'0','A04_ทดสอบ','A04_test',2,1,0,'2016-05-15 14:31:58',1,'2016-05-15 14:31:58',1),(19,'0','A05_ทดสอบ','',2,1,0,'2016-05-15 21:43:22',1,'2016-05-16 17:10:14',1),(20,'0','A06_ทดสอบ','',3,1,0,'2016-05-15 21:45:03',1,'2016-05-15 21:45:03',1),(21,'0','A05_ทดสอบ','',1,1,0,'2016-05-16 17:13:26',1,'2016-05-16 17:15:44',1);
/*!40000 ALTER TABLE `ms_subjects` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-17 12:57:55
