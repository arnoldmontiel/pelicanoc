CREATE DATABASE  IF NOT EXISTS `pelicanoc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pelicanoc`;
-- MySQL dump 10.13  Distrib 5.5.15, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: pelicanoc
-- ------------------------------------------------------
-- Server version	5.1.33-community

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
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `path_pending` varchar(255) DEFAULT NULL,
  `Id_customer` int(11) DEFAULT NULL,
  `sabnzb_api_key` varchar(255) DEFAULT NULL,
  `sabnzb_api_url` varchar(255) DEFAULT NULL,
  `host_name` varchar(255) DEFAULT NULL,
  `path_ready` varchar(255) DEFAULT NULL,
  `path_subtitle` varchar(255) DEFAULT NULL,
  `path_images` varchar(255) DEFAULT NULL,
  `path_shared` varchar(255) DEFAULT NULL,
  `host_path` varchar(255) DEFAULT NULL,
  `Id_reseller` int(11) DEFAULT NULL,
  `Id_device` varchar(45) DEFAULT NULL,
  `ip_v4` varchar(128) DEFAULT NULL,
  `ip_v6` varchar(128) DEFAULT NULL,
  `port_v4` int(11) DEFAULT NULL,
  `port_v6` int(11) DEFAULT NULL,
  `path_anydvd_download` varchar(256) DEFAULT NULL,
  `anydvd_version_installed` varchar(128) DEFAULT NULL,
  `anydvd_version_downloaded` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,'./nzb',14,'','','http://localhost','./nzbReady','./subtitles','./images','','/workspace/PelicanoS',1,'abc','186.182.109.106\n',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-10-04 11:34:50
