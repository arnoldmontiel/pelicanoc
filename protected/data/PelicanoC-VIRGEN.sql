CREATE DATABASE  IF NOT EXISTS `pelicanoc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pelicanoc`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: dhcppc2    Database: pelicanoc
-- ------------------------------------------------------
-- Server version	5.5.24-0ubuntu0.12.04.1

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
-- Table structure for table `anydvd_version`
--

DROP TABLE IF EXISTS `anydvd_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anydvd_version` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(128) DEFAULT NULL,
  `file_name` varchar(128) DEFAULT NULL,
  `download_link` varchar(1024) DEFAULT NULL,
  `downloaded` tinyint(4) DEFAULT '0',
  `installed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anydvd_version`
--

LOCK TABLES `anydvd_version` WRITE;
/*!40000 ALTER TABLE `anydvd_version` DISABLE KEYS */;
/*!40000 ALTER TABLE `anydvd_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignments` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES ('Administrator','admin','','s:0:\"\";'),('Authority','admin','','s:0:\"\";'),('Authority','installer','','s:0:\"\";'),('Customer','arnold',NULL,'s:0:\"\";'),('Customer','hijo','','s:0:\"\";'),('Customer','madre',NULL,'s:0:\"\";'),('Customer','padre',NULL,'s:0:\"\";'),('Customer','root',NULL,'s:0:\"\";'),('Customer','roots',NULL,'s:0:\"\";'),('Installer','installer','','s:0:\"\";');
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audio_track`
--

DROP TABLE IF EXISTS `audio_track`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audio_track` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `chanel` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audio_track`
--

LOCK TABLES `audio_track` WRITE;
/*!40000 ALTER TABLE `audio_track` DISABLE KEYS */;
INSERT INTO `audio_track` VALUES (1,'English','Dolby TrueHD','7.1'),(2,'Arabic','Dolby Digital','5.1'),(3,'Dutch','Dolby Digital','5.1'),(4,'French','Dolby Digital','5.1'),(5,'German','Dolby Digital','5.1'),(6,'Italian','Dolby Digital','5.1'),(7,'Other','Dolby Digital','5.1'),(8,'Portuguese','Dolby Digital','5.1'),(9,'Spanish','Dolby Digital','5.1'),(10,'Thai','Dolby Digital','5.1'),(11,'Turkish','Dolby Digital','5.1'),(12,'English','Dolby Digital','5.1'),(13,'English','DTS-HD Master','5.1'),(14,'French','DTS','2.0'),(15,'Spanish','DTS','2.0'),(16,'Polish','DTS','2.0'),(17,'Spanish','Dolby Digital','2.0'),(18,'Commentary','Dolby Digital','2.0'),(19,'English','DTS','5.1'),(20,'Other','Dolby Surround','3.0'),(21,'English','Dolby Digital Surround EX','5.1'),(22,'English','Dolby TrueHD','5.1'),(23,'Spanish','Dolby Digital Surround EX','5.1'),(24,'English','DTS-HD Master','2.0'),(25,'English','Dolby Digital','2.0'),(26,'French','Dolby Digital Surround EX','5.1'),(27,'Spanish','DTS','5.1'),(28,'French','DTS','5.1'),(29,'English','DTS-HD Master','7.1'),(30,'Other','Dolby Digital','2.0'),(31,'French','DTS-HD High Resolution','7.1'),(32,'English','DTS-HD Master','6.1'),(33,'English','PCM','5.1'),(34,'Spanish','Dolby Digital','1.0'),(35,'English','Dolby Digital','5.0');
/*!40000 ALTER TABLE `audio_track` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `command_status`
--

DROP TABLE IF EXISTS `command_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `command_status` (
  `Id` int(11) NOT NULL,
  `command_name` varchar(45) DEFAULT NULL,
  `busy` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `command_status`
--

LOCK TABLES `command_status` WRITE;
/*!40000 ALTER TABLE `command_status` DISABLE KEYS */;
INSERT INTO `command_status` VALUES (1,'downloadNzbFiles',0),(2,'scanDirectory',0),(3,'downloadAnydvdUpdate',0);
/*!40000 ALTER TABLE `command_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `current_disc`
--

DROP TABLE IF EXISTS `current_disc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `current_disc` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_current_disc_state` int(11) NOT NULL,
  `Id_my_movie_disc` varchar(200) DEFAULT NULL,
  `in_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `out_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_current_disc_current_disc_state1_idx` (`Id_current_disc_state`),
  CONSTRAINT `fk_current_disc_current_disc_state1` FOREIGN KEY (`Id_current_disc_state`) REFERENCES `current_disc_state` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `current_disc`
--

LOCK TABLES `current_disc` WRITE;
/*!40000 ALTER TABLE `current_disc` DISABLE KEYS */;
/*!40000 ALTER TABLE `current_disc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `current_disc_state`
--

DROP TABLE IF EXISTS `current_disc_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `current_disc_state` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `current_disc_state`
--

LOCK TABLES `current_disc_state` WRITE;
/*!40000 ALTER TABLE `current_disc_state` DISABLE KEYS */;
INSERT INTO `current_disc_state` VALUES (1,'Disc Out'),(2,'Pending Data'),(3,'With Data');
/*!40000 ALTER TABLE `current_disc_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `Id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `current_points` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `adult_password` varchar(45) DEFAULT NULL,
  `parental_password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'Arnol','Montiel',NULL,'Lobos 1747',NULL,NULL),(19,'pepe','loco',2,'ssss','hola','hola');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_transaction`
--

DROP TABLE IF EXISTS `customer_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_transaction` (
  `Id` int(11) NOT NULL,
  `Id_nzb` int(11) DEFAULT NULL,
  `Id_transaction_type` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `points` int(11) DEFAULT NULL,
  `Id_customer` int(11) NOT NULL,
  `description` text,
  PRIMARY KEY (`Id`),
  KEY `fk_customer_transaction_nzb1` (`Id_nzb`),
  KEY `fk_customer_transaction_transaction_type1` (`Id_transaction_type`),
  KEY `fk_customer_transaction_customer1` (`Id_customer`),
  CONSTRAINT `fk_customer_transaction_customer1` FOREIGN KEY (`Id_customer`) REFERENCES `customer` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_customer_transaction_nzb1` FOREIGN KEY (`Id_nzb`) REFERENCES `nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_customer_transaction_transaction_type1` FOREIGN KEY (`Id_transaction_type`) REFERENCES `transaction_type` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_transaction`
--

LOCK TABLES `customer_transaction` WRITE;
/*!40000 ALTER TABLE `customer_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disc_episode`
--

DROP TABLE IF EXISTS `disc_episode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disc_episode` (
  `Id_my_movie_disc` varchar(200) NOT NULL,
  `Id_my_movie_episode` int(11) NOT NULL,
  PRIMARY KEY (`Id_my_movie_disc`,`Id_my_movie_episode`),
  KEY `fk_my_movie_disc_has_my_movie_episode_my_movie_episode1` (`Id_my_movie_episode`),
  KEY `fk_my_movie_disc_has_my_movie_episode_my_movie_disc1` (`Id_my_movie_disc`),
  CONSTRAINT `fk_my_movie_disc_has_my_movie_episode_my_movie_disc1` FOREIGN KEY (`Id_my_movie_disc`) REFERENCES `my_movie_disc` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_disc_has_my_movie_episode_my_movie_episode1` FOREIGN KEY (`Id_my_movie_episode`) REFERENCES `my_movie_episode` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disc_episode`
--

LOCK TABLES `disc_episode` WRITE;
/*!40000 ALTER TABLE `disc_episode` DISABLE KEYS */;
/*!40000 ALTER TABLE `disc_episode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disc_episode_nzb`
--

DROP TABLE IF EXISTS `disc_episode_nzb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disc_episode_nzb` (
  `Id_my_movie_disc_nzb` varchar(200) NOT NULL,
  `Id_my_movie_episode` int(11) NOT NULL,
  PRIMARY KEY (`Id_my_movie_disc_nzb`,`Id_my_movie_episode`),
  KEY `fk_my_movie_disc_nzb_has_my_movie_episode_my_movie_episode1` (`Id_my_movie_episode`),
  KEY `fk_my_movie_disc_nzb_has_my_movie_episode_my_movie_disc_nzb1` (`Id_my_movie_disc_nzb`),
  CONSTRAINT `fk_my_movie_disc_nzb_has_my_movie_episode_my_movie_disc_nzb1` FOREIGN KEY (`Id_my_movie_disc_nzb`) REFERENCES `my_movie_disc_nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_disc_nzb_has_my_movie_episode_my_movie_episode1` FOREIGN KEY (`Id_my_movie_episode`) REFERENCES `my_movie_episode` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disc_episode_nzb`
--

LOCK TABLES `disc_episode_nzb` WRITE;
/*!40000 ALTER TABLE `disc_episode_nzb` DISABLE KEYS */;
/*!40000 ALTER TABLE `disc_episode_nzb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `external_wsdl`
--

DROP TABLE IF EXISTS `external_wsdl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `external_wsdl` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `external_wsdl`
--

LOCK TABLES `external_wsdl` WRITE;
/*!40000 ALTER TABLE `external_wsdl` DISABLE KEYS */;
INSERT INTO `external_wsdl` VALUES (1,'Monitor','monitor','Monit0r357','http://gruposmartliving.com/pelicanoM/index.php?r=wsMonitor/wsdl');
/*!40000 ALTER TABLE `external_wsdl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_type`
--

DROP TABLE IF EXISTS `file_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_type`
--

LOCK TABLES `file_type` WRITE;
/*!40000 ALTER TABLE `file_type` DISABLE KEYS */;
INSERT INTO `file_type` VALUES (1,'Folder'),(2,'ISO'),(3,'MKV');
/*!40000 ALTER TABLE `file_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itemchildren`
--

DROP TABLE IF EXISTS `itemchildren`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itemchildren` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itemchildren`
--

LOCK TABLES `itemchildren` WRITE;
/*!40000 ALTER TABLE `itemchildren` DISABLE KEYS */;
INSERT INTO `itemchildren` VALUES ('Administrator','ImdbdataManage'),('Administrator','ImdbdataTvManage'),('Administrator','NzbManage'),('Administrator','RippedMovieManage'),('Administrator','SabnzbdManage'),('Administrator','SiteManage'),('Administrator','UserManage'),('Customer','ImdbdataManage'),('Customer','ImdbdataTvManage'),('Customer','NzbManage'),('Customer','RippedMovieManage'),('Customer','SabnzbdManage'),('Customer','SiteManage'),('CustomerManage','CustomerCreate'),('CustomerManage','CustomerIndex'),('CustomerManage','CustomerUpdate'),('CustomerManage','CustomerUseCustomer'),('ImdbdataManage','ImdbdataIndex'),('ImdbdataManage','ImdbdataView'),('ImdbdataTvManage','ImdbdataTvIndex'),('ImdbdataTvManage','ImdbdataTvView'),('ImdbdataTvManage','ImdbdataTvViewEpisode'),('Installer','CustomerManage'),('Installer','SettingManager'),('Installer','SiteManage'),('NzbManage','MyMovieMovieIndex'),('NzbManage','MyMovieMovieView'),('NzbManage','NzbRequested'),('NzbManage','NzbViewRequested'),('RippedMovieManage','RippedMovieIndex'),('RippedMovieManage','RippedMovieIndexAdult'),('RippedMovieManage','RippedMovieIndexSerie'),('RippedMovieManage','RippedMovieView'),('RippedMovieManage','RippedMovieViewSerie'),('SabnzbdManage','SabnzbdIndex'),('SettingManager','SettingIndex'),('SettingManager','SettingStartInstallation'),('SettingManager','SettingUpdate'),('SiteManage','SiteIndex'),('UserManage','UserAdmin'),('UserManage','UserCreate'),('UserManage','UserDelete'),('UserManage','UserIndex'),('UserManage','UserUpdate'),('UserManage','UserView');
/*!40000 ALTER TABLE `itemchildren` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES ('Authority',2,NULL,NULL,NULL),('NzbManage',1,'','','s:0:\"\";'),('NzbViewRequested',0,'','','s:0:\"\";'),('ImdbdataTvView',0,'','','s:0:\"\";'),('ImdbdataTvManage',1,'','','s:0:\"\";'),('NzbRequested',0,'','','s:0:\"\";'),('ImdbdataIndex',0,'','','s:0:\"\";'),('ImdbdataView',0,'','','s:0:\"\";'),('ImdbdataManage',1,'','','s:0:\"\";'),('ImdbdataTvViewEpisode',0,'','','s:0:\"\";'),('SiteIndex',0,'','','s:0:\"\";'),('SiteManage',1,'','','s:0:\"\";'),('Customer',2,'','','s:0:\"\";'),('RequestView',0,'','','s:0:\"\";'),('SabnzbdIndex',0,'','','s:0:\"\";'),('ImdbdataTvIndex',0,'','','s:0:\"\";'),('SabnzbdManage',1,'','','s:0:\"\";'),('UserIndex',0,'','','s:0:\"\";'),('UserView',0,'','','s:0:\"\";'),('UserAdmin',0,'','','s:0:\"\";'),('UserDelete',0,'','','s:0:\"\";'),('UserUpdate',0,'','','s:0:\"\";'),('UserCreate',0,'','','s:0:\"\";'),('UserManage',1,'','','s:0:\"\";'),('Administrator',2,'','','s:0:\"\";'),('RippedMovieManage',1,'','','s:0:\"\";'),('RippedMovieIndex',0,'','','s:0:\"\";'),('RippedMovieView',0,'','','s:0:\"\";'),('RippedMovieIndexAdult',0,'','','s:0:\"\";'),('Installer',2,'','','s:0:\"\";'),('CustomerManage',1,'','','s:0:\"\";'),('CustomerIndex',0,'','','s:0:\"\";'),('SettingManager',1,'','','s:0:\"\";'),('CustomerUpdate',0,'','','s:0:\"\";'),('CustomerCreate',0,'','','s:0:\"\";'),('SettingIndex',0,'','','s:0:\"\";'),('SettingUpdate',0,'','','s:0:\"\";'),('SettingStartInstallation',0,'','','s:0:\"\";'),('RippedMovieIndexSerie',0,'','','s:0:\"\";'),('RippedMovieViewSerie',0,'','','s:0:\"\";'),('CustomerUseCustomer',0,'','','s:0:\"\";'),('MyMovieMovieIndex',0,'','','s:0:\"\";'),('MyMovieMovieView',0,'','','s:0:\"\";');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `local_folder`
--

DROP TABLE IF EXISTS `local_folder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `local_folder` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_file_type` int(11) NOT NULL,
  `Id_my_movie_disc` varchar(200) NOT NULL,
  `Id_lote` int(11) NOT NULL,
  `Id_source_type` int(11) DEFAULT NULL,
  `read_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_local_folder_my_movie_disc1_idx` (`Id_my_movie_disc`),
  KEY `fk_local_folder_file_type1_idx` (`Id_file_type`),
  KEY `fk_local_folder_source_type1_idx` (`Id_source_type`),
  KEY `fk_local_folder_lote1_idx` (`Id_lote`),
  CONSTRAINT `fk_local_folder_my_movie_disc1` FOREIGN KEY (`Id_my_movie_disc`) REFERENCES `my_movie_disc` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_local_folder_source_type1` FOREIGN KEY (`Id_source_type`) REFERENCES `source_type` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_local_folder_lote1` FOREIGN KEY (`Id_lote`) REFERENCES `lote` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_local_folder_file_type1` FOREIGN KEY (`Id_file_type`) REFERENCES `file_type` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=520 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `local_folder`
--

LOCK TABLES `local_folder` WRITE;
/*!40000 ALTER TABLE `local_folder` DISABLE KEYS */;
INSERT INTO `local_folder` VALUES (427,3,'520bee46f422c',0,1,'2013-08-14 20:53:47','/Gladiator 2000 Remastered Edition BluRay 1080p DTS dxva-LoNeWolf/Gladiator 2000 Remastered Edition BluRay 1080p DTS dxva-LoNeWolf.mkv'),(428,3,'520bee5bc7c5f',0,1,'2013-08-14 20:54:12','/Jack.Reacher.2012.1080p.BluRay.DTS.x264-PublicHD/jack.reacher.2012.1080p.bluray.dts.x264-publichd.mkv'),(429,3,'520bee7449570',0,1,'2013-08-14 20:54:36','/Wall.Street.1987.REMASTERED.720p.BluRay.x264-MySiLU [PublicHD]/Wall.Street.1987.Remastered.BluRay.720p.x264.Dualaudio-MySiLU.mkv'),(430,3,'520bee8d05fe2',0,NULL,'2013-08-14 20:55:02','/51081f2a2a32a/What.To.Expect.When.Youre.Expecting.2012.1080p.BRRiP.x264.AAC-26K/What.To.Expect.When.Youre.Expecting.2012.1080p.BRRiP.x264.AAC-26K.mp4'),(431,3,'520beea66643b',0,1,'2013-08-14 20:55:26','/Hackers/Hackers.1995.ITA.SPA.FRE.GER.ENG.HDTV.1080i.Coffey.mkv'),(432,3,'520beebe3fd76',0,NULL,'2013-08-14 20:55:50','/Django.Unchained.2012.1080p.BluRay.x264-SPARKS [PublicHD]/django.unchained.2012.1080p.bluray.x264-sparks.mkv'),(433,3,'520beed6f2713',0,NULL,'2013-08-14 20:56:14','/51310d4f9ba28/theHobbit/theHobbit.mkv'),(434,1,'520beeee9fb05',0,NULL,'2013-08-14 20:56:32','/5108297cbc262/foof/foof.avi'),(435,3,'520bef00aded5',0,1,'2013-08-14 20:56:56','/Gone.2012.720p.BluRay.X264-BLOW/Gone.720p.BluRay.X264-BLOW.mkv'),(436,3,'520bef187e66a',0,1,'2013-08-14 20:57:20','/Sherlock.Holmes.Game.of.Shadows.2011.1080p.BluRay.DTS.x264-HDMaNiAcS/Sherlock.Holmes.Game.of.Shadows.2011.1080p.BluRay.DTS.x264-HDMaNiAcS.mkv'),(437,3,'520bef3009529',0,NULL,'2013-08-14 20:57:45','/510820d0bcc24/theDictator/theDictator.mkv'),(438,3,'520bef49ae6e5',0,NULL,'2013-08-14 20:58:11','/5128eb489e680/flight/flight.2012.1080p.bluray.dts.x264-publichd.mkv'),(439,3,'520bef6371e74',0,NULL,'2013-08-14 20:58:31','/5108187a8b612/fmf/fmf.mkv'),(440,3,'520bef77f1ac1',0,NULL,'2013-08-14 20:58:56','/51081d10efe56/The.Amazing.Spiderman.2012/The.Amazing.Spiderman.2012.iNTERNAL.1080p.BluRay.x264-BRHD.mkv'),(441,3,'520bef909d6c4',0,NULL,'2013-08-14 20:59:16','/510c337ea44b0/tw/The.Words.2012.BluRay.1080p.AC3.x264-CHD.mkv'),(442,3,'520befa450bdd',0,1,'2013-08-14 20:59:38','/Tron.Legacy.2010.Bluray.1080p.DTS-HD7.1.x264-Grym/Tron.Legacy.2010.Bluray.1080p.DTS-HD7.1.x264-Grym.mkv'),(443,3,'520befba3d7ef',0,NULL,'2013-08-14 21:00:10','/510c332255dec/argo/argo.mkv'),(444,3,'520befdab7a0e',0,NULL,'2013-08-14 21:00:41','/5128f025279bc/Looper.2012.1080p.BluRay.DTS.x264-PublicHD/looper.2012.1080p.bluray.dts.x264-publichd.mkv'),(445,3,'520beff964b04',0,NULL,'2013-08-14 21:01:01','/5147aed050c6f/rlight/rlight.mkv'),(446,3,'520bf00d5663a',0,NULL,'2013-08-14 21:01:20','/510baccb5534c/bb/bb.mkv'),(447,3,'520bf0204886a',0,NULL,'2013-08-14 21:01:37','/Boy.2010.1080p.BluRay.DTS.x264-PublicHD/boy.2010.1080p.bluray.dts.x264-publichd.mkv'),(448,3,'520bf031cdc10',0,NULL,'2013-08-14 21:02:05','/51081bb68aaee/Zombieland/Zombieland.mkv'),(449,1,'520bf04de0ffd',0,NULL,'2013-08-14 21:02:27','/5128e99809958/Beetlejuice/Beetlejuice.mp4'),(450,3,'520bf063a4890',0,NULL,'2013-08-14 21:02:49','/5108181766aa8/frankenweenie/frankenweenie.mkv'),(451,3,'520bf079a9ee1',0,1,'2013-08-14 21:03:11','/Kon-Tiki.2012.1080p.BluRay.DTS.x264-PublicHD/kon-tiki.2012.1080p.bluray.dts.x264-publichd.mkv'),(452,3,'520bf08f29336',0,NULL,'2013-08-14 21:03:42','/514105a88c9a0/Rise.Of.The.Guardians.2012.1080p.BluRay.DTS.x264-PublicHD/rise.of.the.guardians.2012.1080p.bluray.dts.x264-publichd.mkv'),(453,3,'520bf0ae2b904',0,NULL,'2013-08-14 21:04:08','/5108290700f7c/tbl/tbl.mkv'),(454,3,'520bf0c8c68eb',0,1,'2013-08-14 21:04:35','/Savages/Savages 2012 UNRATED REPACK 1080p MULTi BluRay DTS x264 - BoO.mkv'),(455,3,'520bf0e3ab6da',0,NULL,'2013-08-14 21:05:01','/Enter.The.Dragon.1973.REMASTERED.1080p.BluRay.DTS.x264-PublicHD/enter.the.dragon.1973.REMASTERED.1080p.bluray.dts.x264-publichd.mkv'),(456,3,'520bf0fde33cb',0,1,'2013-08-14 21:05:24','/Oblivion.2013.1080p.BluRay.x264-SPARKS [PublicHD]/oblivion.2013.1080p.bluray.x264-sparks.mkv'),(457,3,'520bf114e584c',0,1,'2013-08-14 21:05:43','/The.Iceman.2012.1080p.BluRay.x264-PublicHD/the.iceman.2012.1080p.bluray.x264-publichd.mkv'),(458,3,'520bf127f18be',0,NULL,'2013-08-14 21:06:06','/51082325864a5/taken2/Taken.2.2012.Extra.Alternate.Ending.720p.WEB-DL.DD5.1.H.264-CrazyHDSource.mkv'),(459,3,'520bf13e406d0',0,NULL,'2013-08-14 21:06:34','/50f054e62df8d/tdkr/tdkr.mkv'),(460,3,'520bf15a419c0',0,1,'2013-08-14 21:06:56','/Perfume The Story Of A Murderer.2006 BDRip 1080p DTS-MarGe/Perfume The Story of a Murderer.2006 BDRip 1080p DTS-MarGe.mkv'),(461,3,'520bf170b3bbf',0,1,'2013-08-14 21:07:18','/Red.2010.1080p.BluRay.DTS.x264-ESiR/Red.2010.1080p.BluRay.DTS.x264-ESiR.mkv'),(462,3,'520bf1866bfc5',0,NULL,'2013-08-14 21:07:39','/5128f0c21c275/Madagascar.3.Europe\'s.Most.Wanted.2012.720p.BRRip.XviD.AC3.Audio.Latino-JcGoku21/Madagascar.3.Europe\'s.Most.Wanted.2012.720p.BRRip.XviD.AC3.Audio.Latino-JcGoku21.avi'),(463,3,'520bf19bab5ea',0,1,'2013-08-14 21:08:03','/Shooter 2007 BluRay 1080p AC3 x264-3Li/Shooter 2007 BluRay 3Li 1080p.mkv'),(464,3,'520bf1b399ef1',0,1,'2013-08-14 21:08:29','/Movies/The Blues brothers 1980/The.Blues.Brothers._1980_.720p.AC3.6ch.H264.HDTVRip.mkv'),(465,3,'520bf1cd917af',0,1,'2013-08-14 21:08:51','/Movies/Top Secret 1984 720p HDTV x264 CtrlHD/Top.Secret!.1984.720p.HDTV.x264-CtrlHD.mkv'),(466,3,'520bf1e36d7de',0,1,'2013-08-14 21:09:14','/Movies/Indiana.Jones/The last crusade (1989)/Indiana.Jones.and.the.last.crusade.1989.720p.hdtv.x264-ctrlhd.mkv'),(467,3,'520bf1fab383b',0,1,'2013-08-14 21:09:45','/Movies/Indiana.Jones/The raiders of the lost ark (1981)/Indiana.Jones.And.The.Raiders.Of.The.Lost.Ark.1981.720p.HDTV.x264-THOR.mkv'),(468,3,'520bf21954d44',0,1,'2013-08-14 21:10:08','/Movies/Indiana.Jones/The temple of doom (1984)/Indiana.Jones.and.the.Temple.of.Doom.1984.HDTV.720p.x264.AC3.5.1.mkv'),(469,3,'520bf2308ec32',0,1,'2013-08-14 21:10:37','/Movies/Back.to.the.Future/Part 1 (1985)/Back.to.the.Future.1985.720p.HDTV.x264-ESiR.mkv'),(470,3,'520bf24dc17ef',0,1,'2013-08-14 21:11:05','/Movies/Back.to.the.Future/Part 2 (1989)/Back.to.the.Future.Part.II.1989.720p.HDTV.x264-ESiR.mkv'),(471,3,'520bf269e6022',0,1,'2013-08-14 21:11:27','/Movies/Back.to.the.Future/Part 3 (1990)/Back.to.the.Future.Part.III.1990.720p.HDTV.x264-ESiR.mkv'),(472,3,'520bf27f78498',0,1,'2013-08-14 21:11:52','/Movies/The.Artist.2011.1080p.MKV.x264.AC3.DTS.Eng.Fr.NL.Subs/The.Artist.2011.1080p.MKV.x264.AC3.DTS.Eng.Fr.NL.Subs.mkv'),(473,3,'520bf298824b2',0,1,'2013-08-14 21:12:24','/Movies/Man.on.a.Ledge.2012.720p.BluRay.x264.DTS-HDChina [PublicHD]/Man.on.a.Ledge.2012.720p.BluRay.x264.DTS-HDChina.mkv'),(474,1,'520bf2b8a587f',0,1,'2013-08-14 21:12:48','/Movies/Puss.In.Boots.2011.720p.BRRip.x264.AAC-ViSiON/Puss.In.Boots.2011.720p.BRRip.x264.AAC-ViSiON.mp4'),(475,3,'520bf2d01c3e9',0,1,'2013-08-14 21:13:14','/Movies/Star Wars/Star Wars Episode VI Return of the Jedi/Star Wars Episode VI Return of the Jedi.mkv'),(476,3,'520bf2ea637af',0,1,'2013-08-14 21:13:39','/Movies/Star Wars/Star Wars Episode II Attack Of The Clones/Star.Wars.Episode.II.Attack.Of.The.Clones.2002.720p.HDTV.x264.INTERNAL-hV.mkv'),(477,3,'520bf3035b5f4',0,1,'2013-08-14 21:14:03','/Movies/Star Wars/Star Wars Episode  I The Phantom Menace/Star Wars Episode  I The Phantom Menace.mkv'),(478,3,'520bf31b4d327',0,1,'2013-08-14 21:14:28','/Movies/Star Wars/Star Wars Episode IV A New Hope/Star.Wars.Episode.IV.A.New.Hope.1977.720p.HDTV.x264.INTERNAL-hV.mkv'),(479,3,'520bf3343cfc3',0,1,'2013-08-14 21:14:51','/Movies/Star Wars/Star Wars Episode V The Empire Strikes Back/Star.Wars.Episode.V.The.Empire.Strikes.Back.1980.720p.HDTV.x264.INTERNAL-hV.mkv'),(480,3,'520bf34b78ab5',0,1,'2013-08-14 21:15:17','/Movies/Star Wars/Star Wars Episode III Revenge Of The Sith/Star.Wars.Episode.III.Revenge.Of.The.Sith.2005.720p.HDTV.x264.INTERNAL-hV.mkv'),(481,3,'520bf3650d421',0,1,'2013-08-14 21:15:47','/Movies/Men who stare at goats/men.who.stare.at.goats.x264.mkv'),(482,3,'520bf38383da6',0,NULL,'2013-08-14 21:16:10','/5128f2c48ef64/Skyfall.2012.1080p.BluRay.DTS.x264-PublicHD/skyfall.2012.1080p.bluray.dts.x264-publichd.mkv'),(483,3,'520bf39a9ddff',0,NULL,'2013-08-14 21:16:32','/Die.Welle.2008.720p.BluRay.x264-CiNEFiLE/Die.Welle.2008.720p.BluRay.x264-CiNEFiLE.mkv'),(484,3,'520bf3b0f27c0',0,NULL,'2013-08-14 21:17:24','/Breaking.Bad.S01.720p.BluRay.x264-REWARD/6/breaking.bad.s01e06.720p.bluray.x264-reward.mkv'),(485,3,'520bf3e472a92',0,NULL,'2013-08-14 21:17:29','/Breaking.Bad.S01.720p.BluRay.x264-REWARD/7/breaking.bad.s01e07.720p.bluray.x264-reward.mkv'),(486,3,'520bf3e92a0b5',0,NULL,'2013-08-14 21:17:33','/Breaking.Bad.S01.720p.BluRay.x264-REWARD/2/breaking.bad.s01e02.720p.bluray.x264-reward.mkv'),(487,3,'520bf3edc7310',0,NULL,'2013-08-14 21:17:38','/Breaking.Bad.S01.720p.BluRay.x264-REWARD/3/breaking.bad.s01e03.720p.bluray.x264-reward.mkv'),(488,3,'520bf3f2785af',0,NULL,'2013-08-14 21:17:43','/Breaking.Bad.S01.720p.BluRay.x264-REWARD/5/breaking.bad.s01e05.720p.bluray.x264-reward.mkv'),(489,3,'520bf3f71964a',0,NULL,'2013-08-14 21:17:47','/Breaking.Bad.S01.720p.BluRay.x264-REWARD/4/breaking.bad.s01e04.720p.bluray.x264-reward.mkv'),(490,3,'520bf3fba032b',0,NULL,'2013-08-14 21:17:52','/Breaking.Bad.S01.720p.BluRay.x264-REWARD/1/breaking.bad.s01e01.720p.bluray.x264-reward.mkv'),(491,3,'520bf4005de8d',0,NULL,'2013-08-14 21:18:09','/42.2013.1080p.BluRay.DTS.x264-PublicHD/42.2013.1080p.bluray.dts.x264-publichd.mkv'),(492,3,'520bf4119f4e9',0,1,'2013-08-14 21:18:34','/The.Town.[Extended.Cut].2010.1080p.x264.DTS-LTT/The.Town.[Extended.Cut].2010.1080p.x264.DTS-LTT.mkv'),(493,3,'520bf42a82cc9',0,1,'2013-08-14 21:18:58','/ModernsTimes/MT_1080_HDR.mkv'),(494,3,'520bf4420d1be',0,NULL,'2013-08-14 21:19:28','/5128ed4cc198d/Get.the.Gringo/Get.the.Gringo.1080p.BluRay.x264.DTS-HDChina.mkv'),(495,3,'520bf46057d78',0,1,'2013-08-14 21:19:50','/Wreck-It Ralph/Wreck-It Ralph (2012) 1080p x264 Dual Esapñol Latino-Ingles PeliculasbyMNCR.mkv'),(496,3,'520bf4767f0b1',0,NULL,'2013-08-14 21:20:36','/51505e829f070/Les.Miserables/Les.Miserables.mkv'),(497,3,'520bf4a4159fb',0,NULL,'2013-08-14 21:21:00','/5108216583501/ted/ted.mkv'),(498,1,'520bf4bcd6fb9',0,NULL,'2013-08-14 21:21:26','/51082c22904a2/tdk'),(499,3,'520bf4d646211',0,NULL,'2013-08-14 21:21:51','/5141048905150/Hitchcock.2012.1080p.WEB-DL.H264-IRONCLUB/Hitchcock.2012.1080p.WEB-DL.H264-IRONCLUB.mkv'),(500,3,'520bf4efe7bb0',0,NULL,'2013-08-14 21:22:17','/510816cdc747d/te2/te2.mkv'),(501,3,'520bf50996f3c',0,NULL,'2013-08-14 21:22:41','/51081ec9cc773/Walk.the.Line.2005/Walk.the.Line.2005.Extended.Cut.720p.BluRay.x264-0day.ZACKARY.mkv'),(502,3,'520bf5218249c',0,NULL,'2013-08-14 21:23:03','/51310078c73bf/lifeOfPi/lifeOfPi.mkv'),(503,3,'520bf5374bbe0',0,1,'2013-08-14 21:23:26','/Sherlock.Holmes.2009.Bluray.1080p.DTSMA.x264.dxva-FraMeSToR/Sherlock.Holmes.2009.Bluray.1080p.DTSMA.x264.dxva-FraMeSToR.mkv'),(504,3,'520bf54e8f5ed',0,NULL,'2013-08-14 21:23:44','/510822df6c1c0/brave/brave.mkv'),(505,3,'520bf56099fc6',0,NULL,'2013-08-14 21:23:58','/50f04461e746d/acdc/acdc.mkv'),(506,3,'520bf56ec90b8',0,1,'2013-08-14 21:24:24','/The Departed (2006) BDRip 1080p DTS multisub HighCode-PHD/The Departed (2006) BDRip 1080p DTS multisub HighCode-PHD.mkv'),(507,1,'520bf588b45da',0,NULL,'2013-08-14 21:24:46','/51082099ad6c9/projectx/projectx.mkv'),(508,3,'520bf59e7961f',0,NULL,'2013-08-14 21:25:10','/5128f39e5644b/The.Game.1997.1080p.HDDVD.DTS.x264-CtrlHD/The.Game.1997.1080p.HDDVD.DTS.x264-CtrlHD.mkv'),(509,3,'520bf5b6b2964',0,1,'2013-08-14 21:25:34','/Prometheus.2012.Bluray.1080p.DTS-HD-7.1.x264-Grym/Prometheus.2012.Bluray.1080p.DTS-HD-7.1.x264-Grym.mkv'),(510,3,'520bf5ce973ad',0,1,'2013-08-14 21:25:58','/Gangster.Squad.2013.1080p.BluRay.DTS.x264-PublicHD/gangster.squad.2013.1080p.bluray.dts.x264-publichd.mkv'),(511,3,'520bf5e6d0a7e',0,NULL,'2013-08-14 21:26:23','/American.Gangster.2007.RERIP.Unrated.Extended.Edition.Bluray.1080p.DTS-HD.x264-Grym/American.Gangster.2007.RERIP.Unrated.Extended.Edition.Bluray.1080p.DTS-HD.x264-Grym.mkv'),(512,3,'520bf5ff7f658',0,1,'2013-08-14 21:26:46','/Requiem For A Dream 2000 DC 1080p DTS HighCode- PublicHash/Requiem For A Dream 2000 DC 1080p DTS HighCode- PublicHash.mkv'),(513,3,'520bf61687b21',0,NULL,'2013-08-14 21:27:06','/5128ef9ecfcf0/Juan.of.the.Dead.2011.720p.Bluray.x264-EbP [PublicHD]/Juan.of.the.Dead.2011.720p.Bluray.x264.EbP.mkv'),(514,3,'520bf62a37804',0,NULL,'2013-08-14 21:27:27','/5128edc812fda/Hotel.Transylvania.2012.1080p/hotel.transylvania.2012.1080p.bluray.dts.x264-publichd.mkv'),(515,3,'520bf63fc431f',0,1,'2013-08-14 21:27:49','/Mud.2012.1080p.BluRay.DTS.x264-PublicHD/mud.2012.1080p.bluray.dts.x264-publichd.mkv'),(516,3,'520bf6557218b',0,NULL,'2013-08-14 21:28:18','/American Pie - Reunion (2012) [1080p]/American.Pie.Reunion.2012.Unrated.1080p.BluRay.x264.YIFY.mp4'),(517,3,'520bf67222c5c',0,NULL,'2013-08-14 21:28:39','/Epic.2013.1080p.BluRay.DTS.x264-PublicHD/epic.2013.1080p.bluray.dts.x264-publichd.mkv'),(518,1,'520bf687c1782',0,1,'2013-08-14 21:28:55','/50fe9a611a4c9/queen'),(519,3,'520bf69747970',0,NULL,'2013-08-14 21:29:16','/51082b6993d97/DespicableMe/DespicableMe.mkv');
/*!40000 ALTER TABLE `local_folder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `log_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text,
  `was_sent` tinyint(4) DEFAULT '0',
  `Id_log_type` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_log_log_type1` (`Id_log_type`),
  CONSTRAINT `fk_log_log_type1` FOREIGN KEY (`Id_log_type`) REFERENCES `log_type` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_type`
--

DROP TABLE IF EXISTS `log_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_type`
--

LOCK TABLES `log_type` WRITE;
/*!40000 ALTER TABLE `log_type` DISABLE KEYS */;
INSERT INTO `log_type` VALUES (1,'LOG'),(2,'WARNING'),(3,'ERROR'),(4,'DEBUG');
/*!40000 ALTER TABLE `log_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lote`
--

DROP TABLE IF EXISTS `lote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lote` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lote`
--

LOCK TABLES `lote` WRITE;
/*!40000 ALTER TABLE `lote` DISABLE KEYS */;
INSERT INTO `lote` VALUES (11,'2013-08-13 20:40:42','Successfull'),(12,'2013-08-14 13:42:26',NULL),(13,'2013-08-14 13:47:24','Successfull'),(14,'2013-08-14 20:45:20','Successfull'),(15,'2013-08-14 20:47:43','Successfull'),(16,'2013-08-14 20:48:53','Successfull'),(17,'2013-08-14 20:49:19','Successfull'),(18,'2013-08-14 20:50:29',NULL),(19,'2013-08-14 20:53:26','Successfull');
/*!40000 ALTER TABLE `lote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!50001 DROP VIEW IF EXISTS `movies`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `movies` (
  `Id` int(11),
  `Id_my_movie_disc_nzb` varchar(200),
  `Id_my_movie_disc` varchar(200),
  `source_type` bigint(20),
  `date` timestamp
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `my_movie`
--

DROP TABLE IF EXISTS `my_movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie` (
  `Id` varchar(200) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `bar_code` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `local_title` varchar(100) DEFAULT NULL,
  `original_title` varchar(100) DEFAULT NULL,
  `sort_title` varchar(100) DEFAULT NULL,
  `aspect_ratio` varchar(45) DEFAULT NULL,
  `video_standard` varchar(45) DEFAULT NULL,
  `production_year` varchar(45) DEFAULT NULL,
  `release_date` varchar(45) DEFAULT NULL,
  `running_time` varchar(45) DEFAULT NULL,
  `description` text,
  `extra_features` text,
  `parental_rating_desc` varchar(255) DEFAULT NULL,
  `imdb` varchar(45) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `data_changed` varchar(100) DEFAULT NULL,
  `covers_changed` varchar(100) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `studio` varchar(512) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `poster_original` varchar(255) DEFAULT NULL,
  `backdrop` varchar(255) DEFAULT NULL,
  `backdrop_original` varchar(255) DEFAULT NULL,
  `Id_parental_control` int(11) NOT NULL,
  `adult` tinyint(4) DEFAULT '0',
  `Id_my_movie_serie_header` varchar(200) DEFAULT NULL,
  `media_type` varchar(45) DEFAULT NULL,
  `big_poster` varchar(255) DEFAULT NULL,
  `big_poster_original` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_my_movie_parental_control1` (`Id_parental_control`),
  KEY `fk_my_movie_my_movie_serie_header1` (`Id_my_movie_serie_header`),
  CONSTRAINT `fk_my_movie_parental_control1` FOREIGN KEY (`Id_parental_control`) REFERENCES `parental_control` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_my_movie_serie_header1` FOREIGN KEY (`Id_my_movie_serie_header`) REFERENCES `my_movie_serie_header` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie`
--

LOCK TABLES `my_movie` WRITE;
/*!40000 ALTER TABLE `my_movie` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_movie_audio_track`
--

DROP TABLE IF EXISTS `my_movie_audio_track`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_audio_track` (
  `Id_my_movie` varchar(200) NOT NULL,
  `Id_audio_track` int(11) NOT NULL,
  PRIMARY KEY (`Id_my_movie`,`Id_audio_track`),
  KEY `fk_my_movie_has_audio_track_audio_track1` (`Id_audio_track`),
  KEY `fk_my_movie_has_audio_track_my_movie1` (`Id_my_movie`),
  CONSTRAINT `fk_my_movie_has_audio_track_audio_track1` FOREIGN KEY (`Id_audio_track`) REFERENCES `audio_track` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_has_audio_track_my_movie1` FOREIGN KEY (`Id_my_movie`) REFERENCES `my_movie` (`Id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_audio_track`
--

LOCK TABLES `my_movie_audio_track` WRITE;
/*!40000 ALTER TABLE `my_movie_audio_track` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_audio_track` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_movie_disc`
--

DROP TABLE IF EXISTS `my_movie_disc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_disc` (
  `Id` varchar(200) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `Id_my_movie` varchar(200) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_my_movie_disc_my_movie1` (`Id_my_movie`),
  CONSTRAINT `fk_my_movie_disc_my_movie1` FOREIGN KEY (`Id_my_movie`) REFERENCES `my_movie` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_disc`
--

LOCK TABLES `my_movie_disc` WRITE;
/*!40000 ALTER TABLE `my_movie_disc` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_disc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_movie_disc_nzb`
--

DROP TABLE IF EXISTS `my_movie_disc_nzb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_disc_nzb` (
  `Id` varchar(200) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `Id_my_movie_nzb` varchar(200) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_my_movie_disc_nzb_my_movie_nzb1` (`Id_my_movie_nzb`),
  CONSTRAINT `fk_my_movie_disc_nzb_my_movie_nzb1` FOREIGN KEY (`Id_my_movie_nzb`) REFERENCES `my_movie_nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_disc_nzb`
--

LOCK TABLES `my_movie_disc_nzb` WRITE;
/*!40000 ALTER TABLE `my_movie_disc_nzb` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_disc_nzb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_movie_episode`
--

DROP TABLE IF EXISTS `my_movie_episode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_episode` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_my_movie_season` int(11) NOT NULL,
  `episode_number` int(11) DEFAULT NULL,
  `description` text,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_my_movie_episode_my_movie_season1` (`Id_my_movie_season`),
  CONSTRAINT `fk_my_movie_episode_my_movie_season1` FOREIGN KEY (`Id_my_movie_season`) REFERENCES `my_movie_season` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_episode`
--

LOCK TABLES `my_movie_episode` WRITE;
/*!40000 ALTER TABLE `my_movie_episode` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_episode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_movie_nzb`
--

DROP TABLE IF EXISTS `my_movie_nzb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_nzb` (
  `Id` varchar(200) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `bar_code` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `local_title` varchar(100) DEFAULT NULL,
  `original_title` varchar(100) DEFAULT NULL,
  `sort_title` varchar(100) DEFAULT NULL,
  `aspect_ratio` varchar(45) DEFAULT NULL,
  `video_standard` varchar(45) DEFAULT NULL,
  `production_year` varchar(45) DEFAULT NULL,
  `release_date` varchar(45) DEFAULT NULL,
  `running_time` varchar(45) DEFAULT NULL,
  `description` text,
  `extra_features` text,
  `parental_rating_desc` varchar(255) DEFAULT NULL,
  `imdb` varchar(45) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `data_changed` varchar(100) DEFAULT NULL,
  `covers_changed` varchar(100) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `studio` varchar(512) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `poster_original` varchar(255) DEFAULT NULL,
  `backdrop` varchar(255) DEFAULT NULL,
  `backdrop_original` varchar(255) DEFAULT NULL,
  `adult` tinyint(4) DEFAULT '0',
  `media_type` varchar(45) DEFAULT NULL,
  `is_serie` tinyint(4) DEFAULT '0',
  `Id_my_movie_serie_header` varchar(200) DEFAULT NULL,
  `Id_parental_control` int(11) NOT NULL,
  `big_poster` varchar(255) DEFAULT NULL,
  `big_poster_original` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_my_movie_nzb_my_movie_serie_header1` (`Id_my_movie_serie_header`),
  KEY `fk_my_movie_nzb_parental_control1` (`Id_parental_control`),
  CONSTRAINT `fk_my_movie_nzb_my_movie_serie_header1` FOREIGN KEY (`Id_my_movie_serie_header`) REFERENCES `my_movie_serie_header` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_nzb_parental_control1` FOREIGN KEY (`Id_parental_control`) REFERENCES `parental_control` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_nzb`
--

LOCK TABLES `my_movie_nzb` WRITE;
/*!40000 ALTER TABLE `my_movie_nzb` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_nzb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_movie_nzb_audio_track`
--

DROP TABLE IF EXISTS `my_movie_nzb_audio_track`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_nzb_audio_track` (
  `Id_my_movie_nzb` varchar(200) NOT NULL,
  `Id_audio_track` int(11) NOT NULL,
  PRIMARY KEY (`Id_my_movie_nzb`,`Id_audio_track`),
  KEY `fk_my_movie_nzb_has_audio_track_audio_track1` (`Id_audio_track`),
  KEY `fk_my_movie_nzb_has_audio_track_my_movie_nzb1` (`Id_my_movie_nzb`),
  CONSTRAINT `fk_my_movie_nzb_has_audio_track_audio_track1` FOREIGN KEY (`Id_audio_track`) REFERENCES `audio_track` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_nzb_has_audio_track_my_movie_nzb1` FOREIGN KEY (`Id_my_movie_nzb`) REFERENCES `my_movie_nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_nzb_audio_track`
--

LOCK TABLES `my_movie_nzb_audio_track` WRITE;
/*!40000 ALTER TABLE `my_movie_nzb_audio_track` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_nzb_audio_track` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_movie_nzb_person`
--

DROP TABLE IF EXISTS `my_movie_nzb_person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_nzb_person` (
  `Id_my_movie_nzb` varchar(200) NOT NULL,
  `Id_person` int(11) NOT NULL,
  PRIMARY KEY (`Id_my_movie_nzb`,`Id_person`),
  KEY `fk_my_movie_nzb_has_person_person1` (`Id_person`),
  KEY `fk_my_movie_nzb_has_person_my_movie_nzb1` (`Id_my_movie_nzb`),
  CONSTRAINT `fk_my_movie_nzb_has_person_my_movie_nzb1` FOREIGN KEY (`Id_my_movie_nzb`) REFERENCES `my_movie_nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_nzb_has_person_person1` FOREIGN KEY (`Id_person`) REFERENCES `person` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_nzb_person`
--

LOCK TABLES `my_movie_nzb_person` WRITE;
/*!40000 ALTER TABLE `my_movie_nzb_person` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_nzb_person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_movie_nzb_subtitle`
--

DROP TABLE IF EXISTS `my_movie_nzb_subtitle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_nzb_subtitle` (
  `Id_my_movie_nzb` varchar(200) NOT NULL,
  `Id_subtitle` int(11) NOT NULL,
  PRIMARY KEY (`Id_my_movie_nzb`,`Id_subtitle`),
  KEY `fk_my_movie_nzb_has_subtitle_subtitle1` (`Id_subtitle`),
  KEY `fk_my_movie_nzb_has_subtitle_my_movie_nzb1` (`Id_my_movie_nzb`),
  CONSTRAINT `fk_my_movie_nzb_has_subtitle_my_movie_nzb1` FOREIGN KEY (`Id_my_movie_nzb`) REFERENCES `my_movie_nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_nzb_has_subtitle_subtitle1` FOREIGN KEY (`Id_subtitle`) REFERENCES `subtitle` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_nzb_subtitle`
--

LOCK TABLES `my_movie_nzb_subtitle` WRITE;
/*!40000 ALTER TABLE `my_movie_nzb_subtitle` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_nzb_subtitle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_movie_person`
--

DROP TABLE IF EXISTS `my_movie_person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_person` (
  `Id_person` int(11) NOT NULL,
  `Id_my_movie` varchar(200) NOT NULL,
  PRIMARY KEY (`Id_person`,`Id_my_movie`),
  KEY `fk_person_has_my_movie_my_movie1` (`Id_my_movie`),
  KEY `fk_person_has_my_movie_person1` (`Id_person`),
  CONSTRAINT `fk_person_has_my_movie_my_movie1` FOREIGN KEY (`Id_my_movie`) REFERENCES `my_movie` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_has_my_movie_person1` FOREIGN KEY (`Id_person`) REFERENCES `person` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_person`
--

LOCK TABLES `my_movie_person` WRITE;
/*!40000 ALTER TABLE `my_movie_person` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_movie_season`
--

DROP TABLE IF EXISTS `my_movie_season`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_season` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_my_movie_serie_header` varchar(200) NOT NULL,
  `season_number` int(11) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `banner_original` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_my_movie_serie_season_my_movie_serie_header1` (`Id_my_movie_serie_header`),
  CONSTRAINT `fk_my_movie_serie_season_my_movie_serie_header1` FOREIGN KEY (`Id_my_movie_serie_header`) REFERENCES `my_movie_serie_header` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_season`
--

LOCK TABLES `my_movie_season` WRITE;
/*!40000 ALTER TABLE `my_movie_season` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_season` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_movie_serie_header`
--

DROP TABLE IF EXISTS `my_movie_serie_header`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_serie_header` (
  `Id` varchar(200) NOT NULL,
  `description` text,
  `poster` varchar(255) DEFAULT NULL,
  `poster_original` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sort_name` varchar(255) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `original_network` varchar(255) DEFAULT NULL,
  `original_status` varchar(100) DEFAULT NULL,
  `big_poster` varchar(255) DEFAULT NULL,
  `big_poster_original` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_serie_header`
--

LOCK TABLES `my_movie_serie_header` WRITE;
/*!40000 ALTER TABLE `my_movie_serie_header` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_serie_header` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `my_movie_subtitle`
--

DROP TABLE IF EXISTS `my_movie_subtitle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_subtitle` (
  `Id_my_movie` varchar(200) NOT NULL,
  `Id_subtitle` int(11) NOT NULL,
  PRIMARY KEY (`Id_my_movie`,`Id_subtitle`),
  KEY `fk_my_movie_has_subtitle_subtitle1` (`Id_subtitle`),
  KEY `fk_my_movie_has_subtitle_my_movie1` (`Id_my_movie`),
  CONSTRAINT `fk_my_movie_has_subtitle_my_movie1` FOREIGN KEY (`Id_my_movie`) REFERENCES `my_movie` (`Id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_has_subtitle_subtitle1` FOREIGN KEY (`Id_subtitle`) REFERENCES `subtitle` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_subtitle`
--

LOCK TABLES `my_movie_subtitle` WRITE;
/*!40000 ALTER TABLE `my_movie_subtitle` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_subtitle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nzb`
--

DROP TABLE IF EXISTS `nzb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nzb` (
  `Id` int(11) NOT NULL,
  `Id_my_movie_disc_nzb` varchar(200) NOT NULL,
  `Id_resource` int(11) DEFAULT NULL,
  `Id_nzb_state` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `subt_file_name` varchar(255) DEFAULT NULL,
  `subt_url` varchar(255) DEFAULT NULL,
  `downloading` tinyint(4) DEFAULT '0',
  `downloaded` tinyint(4) DEFAULT '0',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `requested` tinyint(4) DEFAULT '0',
  `points` int(11) DEFAULT '0',
  `ready` tinyint(4) DEFAULT '0',
  `change_state_date` timestamp NULL DEFAULT NULL,
  `sent` tinyint(4) DEFAULT '0',
  `final_content_path` varchar(255) DEFAULT NULL,
  `Id_resource_type` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`),
  KEY `fk_nzb_my_movie_disc_nzb1` (`Id_my_movie_disc_nzb`),
  KEY `fk_nzb_nzb_state1` (`Id_nzb_state`),
  KEY `fk_nzb_resource_type1` (`Id_resource_type`),
  CONSTRAINT `fk_nzb_my_movie_disc_nzb1` FOREIGN KEY (`Id_my_movie_disc_nzb`) REFERENCES `my_movie_disc_nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nzb_nzb_state1` FOREIGN KEY (`Id_nzb_state`) REFERENCES `nzb_state` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nzb_resource_type1` FOREIGN KEY (`Id_resource_type`) REFERENCES `resource_type` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nzb`
--

LOCK TABLES `nzb` WRITE;
/*!40000 ALTER TABLE `nzb` DISABLE KEYS */;
/*!40000 ALTER TABLE `nzb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nzb_state`
--

DROP TABLE IF EXISTS `nzb_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nzb_state` (
  `Id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nzb_state`
--

LOCK TABLES `nzb_state` WRITE;
/*!40000 ALTER TABLE `nzb_state` DISABLE KEYS */;
INSERT INTO `nzb_state` VALUES (1,'Sent'),(2,'Downloading'),(3,'Downloaded'),(4,'Requested'),(5,'Canceled'),(6,'Deleted');
/*!40000 ALTER TABLE `nzb_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parental_control`
--

DROP TABLE IF EXISTS `parental_control`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parental_control` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parental_control`
--

LOCK TABLES `parental_control` WRITE;
/*!40000 ALTER TABLE `parental_control` DISABLE KEYS */;
INSERT INTO `parental_control` VALUES (1,0,'Unrated','mpaa_logo.gif',1000),(2,1,'G','g-rating.gif',1000),(3,2,'G','g-rating.gif',1000),(4,3,'PG','pg-rating.gif',1000),(5,4,'PG-13','pg13-rating.gif',13),(6,5,'PG-13','pg13-rating.gif',13),(7,6,'R','r-rating.gif',18),(8,7,'NC-17','nc17-rating.gif',18),(9,8,'XXX','xxx-rating.gif',18);
/*!40000 ALTER TABLE `parental_control` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `type` varchar(128) DEFAULT NULL,
  `role` varchar(128) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo_original` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1238 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file_protocol` varchar(45) DEFAULT NULL,
  `Id_setting` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_player_setting1` (`Id_setting`),
  CONSTRAINT `fk_player_setting1` FOREIGN KEY (`Id_setting`) REFERENCES `setting` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player`
--

LOCK TABLES `player` WRITE;
/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` VALUES (1,'http://192.168.100.104/','Principal','smb',1);
/*!40000 ALTER TABLE `player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource_type`
--

DROP TABLE IF EXISTS `resource_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource_type` (
  `Id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_type`
--

LOCK TABLES `resource_type` WRITE;
/*!40000 ALTER TABLE `resource_type` DISABLE KEYS */;
INSERT INTO `resource_type` VALUES (1,'BluRay'),(2,'DVD'),(3,'MKV'),(4,'AVI'),(5,'MP4');
/*!40000 ALTER TABLE `resource_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ripped_movie`
--

DROP TABLE IF EXISTS `ripped_movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ripped_movie` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_my_movie_disc` varchar(200) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `parental_control` tinyint(4) DEFAULT '0' COMMENT 'Si esta en true, significa que es para mayores',
  `was_sent` tinyint(4) DEFAULT '0' COMMENT 'Indica si fue o no recibida por el servidor',
  PRIMARY KEY (`Id`),
  KEY `fk_ripped_movie_my_movie_disc1` (`Id_my_movie_disc`),
  CONSTRAINT `fk_ripped_movie_my_movie_disc1` FOREIGN KEY (`Id_my_movie_disc`) REFERENCES `my_movie_disc` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ripped_movie`
--

LOCK TABLES `ripped_movie` WRITE;
/*!40000 ALTER TABLE `ripped_movie` DISABLE KEYS */;
/*!40000 ALTER TABLE `ripped_movie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ripper_status`
--

DROP TABLE IF EXISTS `ripper_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ripper_status` (
  `Id` int(11) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ripper_status`
--

LOCK TABLES `ripper_status` WRITE;
/*!40000 ALTER TABLE `ripper_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `ripper_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ripper_status_log`
--

DROP TABLE IF EXISTS `ripper_status_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ripper_status_log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ripper_status_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_ripper_status_log_ripper_status1` (`ripper_status_Id`),
  CONSTRAINT `fk_ripper_status_log_ripper_status1` FOREIGN KEY (`ripper_status_Id`) REFERENCES `ripper_status` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ripper_status_log`
--

LOCK TABLES `ripper_status_log` WRITE;
/*!40000 ALTER TABLE `ripper_status_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ripper_status_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `series`
--

DROP TABLE IF EXISTS `series`;
/*!50001 DROP VIEW IF EXISTS `series`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `series` (
  `Id` int(11),
  `Id_my_movie_disc_nzb` varchar(200),
  `Id_my_movie_disc` varchar(200),
  `source_type` bigint(20),
  `date` timestamp
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

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
  `mymovies_username` varchar(256) DEFAULT NULL,
  `mymovies_password` varchar(256) DEFAULT NULL,
  `host_file_server` varchar(255) DEFAULT NULL,
  `host_file_server_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,'./nzb',1,NULL,NULL,'http://localhost','./nzbReady','./subtitles','./images',NULL,'/pelicanos',1,'50ed8335ae2ef','186.182.183.6',NULL,NULL,NULL,NULL,NULL,'rdsmart','SmartLiving01','192.168.0.105/','/storage/');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings_ripper`
--

DROP TABLE IF EXISTS `settings_ripper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings_ripper` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `drive_letter` varchar(8) DEFAULT NULL,
  `temp_folder_ripping` varchar(256) DEFAULT NULL,
  `final_folder_ripping` varchar(256) DEFAULT NULL,
  `time_from_reboot` time DEFAULT NULL,
  `time_to_reboot` time DEFAULT NULL,
  `mymovies_username` varchar(256) DEFAULT NULL,
  `mymovies_password` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings_ripper`
--

LOCK TABLES `settings_ripper` WRITE;
/*!40000 ALTER TABLE `settings_ripper` DISABLE KEYS */;
INSERT INTO `settings_ripper` VALUES (1,'E','C:/ripper/','C:/ripper/','01:00:00','12:00:00','rdsmart','SmartLiving01');
/*!40000 ALTER TABLE `settings_ripper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `source_type`
--

DROP TABLE IF EXISTS `source_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `source_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `source_type`
--

LOCK TABLES `source_type` WRITE;
/*!40000 ALTER TABLE `source_type` DISABLE KEYS */;
INSERT INTO `source_type` VALUES (1,'Blu-ray'),(2,'DVD');
/*!40000 ALTER TABLE `source_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subtitle`
--

DROP TABLE IF EXISTS `subtitle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subtitle` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subtitle`
--

LOCK TABLES `subtitle` WRITE;
/*!40000 ALTER TABLE `subtitle` DISABLE KEYS */;
/*!40000 ALTER TABLE `subtitle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_type`
--

DROP TABLE IF EXISTS `transaction_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_type` (
  `Id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_type`
--

LOCK TABLES `transaction_type` WRITE;
/*!40000 ALTER TABLE `transaction_type` DISABLE KEYS */;
INSERT INTO `transaction_type` VALUES (1,'Debito'),(2,'Credito');
/*!40000 ALTER TABLE `transaction_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `Id_customer` int(11) DEFAULT NULL,
  `adult_section` tinyint(4) DEFAULT '0',
  `birth_date` date DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `fk_user_customer1` (`Id_customer`),
  CONSTRAINT `fk_user_customer1` FOREIGN KEY (`Id_customer`) REFERENCES `customer` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('arnold','Arnold','arnol@gmail.com',1,1,'1983-08-24');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `movies`
--

/*!50001 DROP TABLE IF EXISTS `movies`*/;
/*!50001 DROP VIEW IF EXISTS `movies`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `movies` AS select `nzb`.`Id` AS `Id`,`nzb`.`Id_my_movie_disc_nzb` AS `Id_my_movie_disc_nzb`,NULL AS `Id_my_movie_disc`,1 AS `source_type`,`nzb`.`date` AS `date` from ((`nzb` join `my_movie_disc_nzb` `mdn` on((`mdn`.`Id` = `nzb`.`Id_my_movie_disc_nzb`))) join `my_movie_nzb` `mn` on((`mn`.`Id` = `mdn`.`Id_my_movie_nzb`))) where ((`nzb`.`downloaded` = 1) and (`nzb`.`ready` = 1) and isnull(`mn`.`Id_my_movie_serie_header`)) union select `ripped_movie`.`Id` AS `Id`,NULL AS `Id_my_movie_disc_nzb`,`ripped_movie`.`Id_my_movie_disc` AS `Id_my_movie_disc`,2 AS `source_type`,`ripped_movie`.`creation_date` AS `date` from ((`ripped_movie` join `my_movie_disc` `md` on((`md`.`Id` = `ripped_movie`.`Id_my_movie_disc`))) join `my_movie` `m` on((`m`.`Id` = `md`.`Id_my_movie`))) where isnull(`m`.`Id_my_movie_serie_header`) union select `local_folder`.`Id` AS `Id`,NULL AS `Id_my_movie_disc_nzb`,`local_folder`.`Id_my_movie_disc` AS `Id_my_movie_disc`,3 AS `source_type`,`local_folder`.`read_date` AS `date` from ((`local_folder` join `my_movie_disc` `md` on((`md`.`Id` = `local_folder`.`Id_my_movie_disc`))) join `my_movie` `m` on((`m`.`Id` = `md`.`Id_my_movie`))) where isnull(`m`.`Id_my_movie_serie_header`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `series`
--

/*!50001 DROP TABLE IF EXISTS `series`*/;
/*!50001 DROP VIEW IF EXISTS `series`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `series` AS select `nzb`.`Id` AS `Id`,`nzb`.`Id_my_movie_disc_nzb` AS `Id_my_movie_disc_nzb`,NULL AS `Id_my_movie_disc`,1 AS `source_type`,`nzb`.`date` AS `date` from ((`nzb` join `my_movie_disc_nzb` `mdn` on((`mdn`.`Id` = `nzb`.`Id_my_movie_disc_nzb`))) join `my_movie_nzb` `mn` on((`mn`.`Id` = `mdn`.`Id_my_movie_nzb`))) where ((`nzb`.`downloaded` = 1) and (`nzb`.`ready` = 1) and (`mn`.`Id_my_movie_serie_header` is not null)) union select `ripped_movie`.`Id` AS `Id`,NULL AS `Id_my_movie_disc_nzb`,`ripped_movie`.`Id_my_movie_disc` AS `Id_my_movie_disc`,2 AS `source_type`,`ripped_movie`.`creation_date` AS `date` from ((`ripped_movie` join `my_movie_disc` `md` on((`md`.`Id` = `ripped_movie`.`Id_my_movie_disc`))) join `my_movie` `m` on((`m`.`Id` = `md`.`Id_my_movie`))) where (`m`.`Id_my_movie_serie_header` is not null) union select `local_folder`.`Id` AS `Id`,NULL AS `Id_my_movie_disc_nzb`,`local_folder`.`Id_my_movie_disc` AS `Id_my_movie_disc`,3 AS `source_type`,`local_folder`.`read_date` AS `date` from ((`local_folder` join `my_movie_disc` `md` on((`md`.`Id` = `local_folder`.`Id_my_movie_disc`))) join `my_movie` `m` on((`m`.`Id` = `md`.`Id_my_movie`))) where (`m`.`Id_my_movie_serie_header` is not null) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-15 10:39:43
