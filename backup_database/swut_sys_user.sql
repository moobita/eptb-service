CREATE DATABASE  IF NOT EXISTS `swut_sys` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `swut_sys`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: swut_sys
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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'anurak_jiws','tyoQ8hOlW78YXn41SVGgEi5__n0oXhOK','$2y$13$JV9eKRQizqb7bO4Fx.eDq.TbNeDpL/B0mwDMahp8yvrymZDx617f6',NULL,'anurak.jiw@gmail.com',10,1456817582,1456817582),(2,'user-a','N9F82Mp1uX6NzLX4WL_Ah-kZGpBifX92','$2y$13$fo1IAs5xoDrlqw8dIzFWguTA0N/v0hWyYbrYZ6tckCkaLgMt5h.e.',NULL,'user-a@hotmail.com',10,1457050861,1457050861),(3,'user-b','7ttdSRv7_nsNs8VRBuIEiC_DnsMXLfMW','$2y$13$tQ1Tq8NdgMEuycU7Vmdm7u13q/CSH4ZYxhtlFNIUvSXdq1141.uPG',NULL,'user-b@hotmail.com',10,1457050895,1457050895),(4,'user-c','PpRs2HAWEQRkLY4RhYdU7CoFhE3RKZDb','$2y$13$x7t8RViepZs9CB7wxGZJcOGODacs71tBBa1WN3T4S4VVmGwstskT6',NULL,'user-c@hotmail.com',10,1457050922,1457050922),(5,'user-d','G-W5J59WTkHdQOaTuFdxWR5D7y-HQ8dw','$2y$13$dcb7Smm7dGFePIQTSBWUhuL4RCZLdxjFm7cgqYx74bhrqKRXibm7y',NULL,'user-d@hotmail.com',10,1457050961,1457050961);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-05 23:23:46
