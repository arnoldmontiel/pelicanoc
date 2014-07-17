CREATE DATABASE  IF NOT EXISTS `pelicanoc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pelicanoc`;
-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: pelicanoc
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.12.04.1

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
-- Table structure for table `error_log`
--

DROP TABLE IF EXISTS `error_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `error_log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `error_type` int(11) DEFAULT NULL,
  `has_error` tinyint(4) DEFAULT '0',
  `was_sent` tinyint(4) DEFAULT '0',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '1 - error_players\n2 - error_NAS\n3 - error_NAS_space',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `error_log`
--

LOCK TABLES `error_log` WRITE;
/*!40000 ALTER TABLE `error_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `error_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TMDB_data`
--

DROP TABLE IF EXISTS `TMDB_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TMDB_data` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `poster` varchar(255) DEFAULT NULL,
  `big_poster` varchar(255) DEFAULT NULL,
  `backdrop` varchar(255) DEFAULT NULL,
  `TMDB_id` int(11) DEFAULT NULL COMMENT 'Este campo es el ID de la API\n',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TMDB_data`
--

LOCK TABLES `TMDB_data` WRITE;
/*!40000 ALTER TABLE `TMDB_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `TMDB_data` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `assignments` VALUES ('Administrator','admin','','s:0:\"\";'),('Authority','admin','','s:0:\"\";');
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
-- Table structure for table `bookmark`
--

DROP TABLE IF EXISTS `bookmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookmark` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `start` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `Id_nzb` int(11) DEFAULT NULL,
  `Id_local_folder` int(11) DEFAULT NULL,
  `Id_ripped_movie` int(11) DEFAULT NULL,
  `time_start` varchar(45) DEFAULT NULL,
  `time_end` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_bookmark_nzb1_idx` (`Id_nzb`),
  KEY `fk_bookmark_local_folder1_idx` (`Id_local_folder`),
  KEY `fk_bookmark_ripped_movie1_idx` (`Id_ripped_movie`),
  CONSTRAINT `fk_bookmark_nzb1` FOREIGN KEY (`Id_nzb`) REFERENCES `nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bookmark_local_folder1` FOREIGN KEY (`Id_local_folder`) REFERENCES `local_folder` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_bookmark_ripped_movie1` FOREIGN KEY (`Id_ripped_movie`) REFERENCES `ripped_movie` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookmark`
--

LOCK TABLES `bookmark` WRITE;
/*!40000 ALTER TABLE `bookmark` DISABLE KEYS */;
/*!40000 ALTER TABLE `bookmark` ENABLE KEYS */;
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
  `pid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `command_status`
--

LOCK TABLES `command_status` WRITE;
/*!40000 ALTER TABLE `command_status` DISABLE KEYS */;
INSERT INTO `command_status` VALUES (1,'downloadNzbFiles',0,NULL),(2,'scanDirectory',0,NULL),(3,'downloadAnydvdUpdate',0,NULL),(4,'processExternalStorage',0,NULL),(5,'scanExternalStorage',0,NULL);
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
  `command` int(11) DEFAULT '0' COMMENT '0-> stand by\n1-> stop\n2-> ripp\n3-> eject',
  `read` tinyint(4) DEFAULT '0' COMMENT '0 -> no fue leido aun\n1 -> ya fue leido una vez',
  `percentage` int(11) DEFAULT '0',
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
-- Table structure for table `current_external_storage`
--

DROP TABLE IF EXISTS `current_external_storage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `current_external_storage` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `in_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `out_date` timestamp NULL DEFAULT NULL,
  `is_in` tinyint(4) DEFAULT '1',
  `read` tinyint(4) DEFAULT '0',
  `path` varchar(200) DEFAULT NULL,
  `state` int(11) DEFAULT '1' COMMENT 'States:\n1 -> stand-By\n2 -> on copy\n3 -> finish copy\n4 -> on scan\n5 -> finish scan',
  `soft_scan_ready` tinyint(4) DEFAULT '0' COMMENT 'Solo recorro las carpetas y creo registros en external_storage_data',
  `hard_scan_ready` tinyint(4) DEFAULT '0' COMMENT 'Recorro las carpetas con contenido de video y voy generando el .peli',
  `label` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `current_external_storage`
--

LOCK TABLES `current_external_storage` WRITE;
/*!40000 ALTER TABLE `current_external_storage` DISABLE KEYS */;
/*!40000 ALTER TABLE `current_external_storage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `current_play`
--

DROP TABLE IF EXISTS `current_play`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `current_play` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_player` int(11) NOT NULL,
  `Id_local_folder` int(11) DEFAULT NULL,
  `Id_ripped_movie` int(11) DEFAULT NULL,
  `Id_nzb` int(11) DEFAULT NULL,
  `Id_current_disc` int(11) DEFAULT NULL,
  `is_playing` tinyint(4) DEFAULT '1' COMMENT '0 -> NO PLAYING\n1 -> PLAYING',
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `fk_current_play_player1_idx` (`Id_player`),
  KEY `fk_current_play_local_folder1_idx` (`Id_local_folder`),
  KEY `fk_current_play_ripped_movie1_idx` (`Id_ripped_movie`),
  KEY `fk_current_play_nzb1_idx` (`Id_nzb`),
  KEY `fk_current_play_current_disc1_idx` (`Id_current_disc`),
  CONSTRAINT `fk_current_play_player1` FOREIGN KEY (`Id_player`) REFERENCES `player` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_current_play_local_folder1` FOREIGN KEY (`Id_local_folder`) REFERENCES `local_folder` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_current_play_ripped_movie1` FOREIGN KEY (`Id_ripped_movie`) REFERENCES `ripped_movie` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_current_play_nzb1` FOREIGN KEY (`Id_nzb`) REFERENCES `nzb` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_current_play_current_disc1` FOREIGN KEY (`Id_current_disc`) REFERENCES `current_disc` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `current_play`
--

LOCK TABLES `current_play` WRITE;
/*!40000 ALTER TABLE `current_play` DISABLE KEYS */;
/*!40000 ALTER TABLE `current_play` ENABLE KEYS */;
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
-- Table structure for table `external_storage_data`
--

DROP TABLE IF EXISTS `external_storage_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `external_storage_data` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_current_external_storage` int(11) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `copy` tinyint(4) DEFAULT '0',
  `status` int(11) DEFAULT '1' COMMENT '1 -> stand by\n2 -> copiying\n3 -> finish copy\n4 -> error on copy\n5 -> cancel copy\n6 -> scaning\n7 -> finish scaning',
  `description` varchar(255) DEFAULT NULL,
  `imdb` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `is_personal` tinyint(4) DEFAULT '0',
  `already_exists` tinyint(4) DEFAULT '0',
  `Id_local_folder` int(11) DEFAULT NULL,
  `size` bigint(20) DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `fk_external_storage_data_current_external_storage1_idx` (`Id_current_external_storage`),
  KEY `fk_external_storage_data_local_folder1_idx` (`Id_local_folder`),
  CONSTRAINT `fk_external_storage_data_current_external_storage1` FOREIGN KEY (`Id_current_external_storage`) REFERENCES `current_external_storage` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_external_storage_data_local_folder1` FOREIGN KEY (`Id_local_folder`) REFERENCES `local_folder` (`Id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `external_storage_data`
--

LOCK TABLES `external_storage_data` WRITE;
/*!40000 ALTER TABLE `external_storage_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `external_storage_data` ENABLE KEYS */;
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
INSERT INTO `itemchildren` VALUES ('Administrator','ImdbdataManage'),('Administrator','ImdbdataTvManage'),('Administrator','NzbManage'),('Administrator','RippedMovieManage'),('Administrator','SabnzbdManage'),('Administrator','SiteManage'),('Administrator','UserManage'),('Customer','ImdbdataManage'),('Customer','ImdbdataTvManage'),('Customer','NzbManage'),('Customer','RippedMovieManage'),('Customer','SabnzbdManage'),('Customer','SiteManage'),('CustomerManage','CustomerCreate'),('CustomerManage','CustomerIndex'),('CustomerManage','CustomerUpdate'),('CustomerManage','CustomerUseCustomer'),('ImdbdataManage','ImdbdataIndex'),('ImdbdataManage','ImdbdataView'),('ImdbdataTvManage','ImdbdataTvIndex'),('ImdbdataTvManage','ImdbdataTvView'),('ImdbdataTvManage','ImdbdataTvViewEpisode'),('Installer','CustomerManage'),('Installer','SettingManager'),('Installer','SiteManage'),('NzbManage','MyMovieMovieIndex'),('NzbManage','MyMovieMovieView'),('NzbManage','NzbRequested'),('NzbManage','NzbViewRequested'),('RippedMovieManage','RippedMovieIndex'),('RippedMovieManage','RippedMovieIndexAdult'),('RippedMovieManage','RippedMovieIndexSerie'),('RippedMovieManage','RippedMovieView'),('RippedMovieManage','RippedMovieViewSerie'),('SabnzbdManage','SabnzbdIndex'),('SettingManager','SettingIndex'),('SettingManager','SettingStartInstallation'),('SettingManager','SettingUpdate'),('SiteManage','SiteDownloads'),('SiteManage','SiteEditMovie'),('SiteManage','SiteStartByPlayer'),('SiteManage','SiteIndex'),('SiteManage','SiteLocalFolderAdmin'),('SiteManage','SiteMarketplace'),('SiteManage','SiteMarketplaceCategory'),('UserManage','UserAdmin'),('UserManage','UserCreate'),('UserManage','UserDelete'),('UserManage','UserIndex'),('UserManage','UserUpdate'),('UserManage','UserView'),('SiteManage','SiteOpenDuneControl');
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
INSERT INTO `items` VALUES ('Authority',2,NULL,NULL,NULL),('NzbManage',1,'','','s:0:\"\";'),('NzbViewRequested',0,'','','s:0:\"\";'),('ImdbdataTvView',0,'','','s:0:\"\";'),('ImdbdataTvManage',1,'','','s:0:\"\";'),('NzbRequested',0,'','','s:0:\"\";'),('ImdbdataIndex',0,'','','s:0:\"\";'),('ImdbdataView',0,'','','s:0:\"\";'),('ImdbdataManage',1,'','','s:0:\"\";'),('ImdbdataTvViewEpisode',0,'','','s:0:\"\";'),('SiteIndex',0,'','','s:0:\"\";'),('SiteManage',1,'','','s:0:\"\";'),('Customer',2,'','','s:0:\"\";'),('RequestView',0,'','','s:0:\"\";'),('SabnzbdIndex',0,'','','s:0:\"\";'),('ImdbdataTvIndex',0,'','','s:0:\"\";'),('SabnzbdManage',1,'','','s:0:\"\";'),('UserIndex',0,'','','s:0:\"\";'),('UserView',0,'','','s:0:\"\";'),('UserAdmin',0,'','','s:0:\"\";'),('UserDelete',0,'','','s:0:\"\";'),('UserUpdate',0,'','','s:0:\"\";'),('UserCreate',0,'','','s:0:\"\";'),('UserManage',1,'','','s:0:\"\";'),('Administrator',2,'','','s:0:\"\";'),('RippedMovieManage',1,'','','s:0:\"\";'),('RippedMovieIndex',0,'','','s:0:\"\";'),('RippedMovieView',0,'','','s:0:\"\";'),('RippedMovieIndexAdult',0,'','','s:0:\"\";'),('Installer',2,'','','s:0:\"\";'),('CustomerManage',1,'','','s:0:\"\";'),('CustomerIndex',0,'','','s:0:\"\";'),('SettingManager',1,'','','s:0:\"\";'),('CustomerUpdate',0,'','','s:0:\"\";'),('CustomerCreate',0,'','','s:0:\"\";'),('SettingIndex',0,'','','s:0:\"\";'),('SettingUpdate',0,'','','s:0:\"\";'),('SettingStartInstallation',0,'','','s:0:\"\";'),('RippedMovieIndexSerie',0,'','','s:0:\"\";'),('RippedMovieViewSerie',0,'','','s:0:\"\";'),('CustomerUseCustomer',0,'','','s:0:\"\";'),('MyMovieMovieIndex',0,'','','s:0:\"\";'),('MyMovieMovieView',0,'','','s:0:\"\";'),('SiteMarketplace',0,'','','s:0:\"\";'),('SiteMarketplaceCategory',0,'','','s:0:\"\";'),('SiteEditMovie',0,'','','s:0:\"\";'),('SiteStartByPlayer',0,'','','s:0:\"\";'),('SiteDownloads',0,'','','s:0:\"\";'),('SiteLocalFolderAdmin',0,'','','s:0:\"\";'),('SiteOpenDuneControl',0,'','','s:0:\"\";');
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
  `hide` tinyint(4) DEFAULT '0',
  `Id_TMDB_data` int(11) DEFAULT NULL,
  `is_personal` tinyint(4) DEFAULT '0',
  `path_original` varchar(255) DEFAULT NULL,
  `ready` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`Id`),
  KEY `fk_local_folder_my_movie_disc1_idx` (`Id_my_movie_disc`),
  KEY `fk_local_folder_file_type1_idx` (`Id_file_type`),
  KEY `fk_local_folder_source_type1_idx` (`Id_source_type`),
  KEY `fk_local_folder_lote1_idx` (`Id_lote`),
  KEY `fk_local_folder_TMDB_data1_idx` (`Id_TMDB_data`),
  CONSTRAINT `fk_local_folder_TMDB_data1` FOREIGN KEY (`Id_TMDB_data`) REFERENCES `TMDB_data` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_local_folder_file_type1` FOREIGN KEY (`Id_file_type`) REFERENCES `file_type` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_local_folder_lote1` FOREIGN KEY (`Id_lote`) REFERENCES `lote` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_local_folder_my_movie_disc1` FOREIGN KEY (`Id_my_movie_disc`) REFERENCES `my_movie_disc` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_local_folder_source_type1` FOREIGN KEY (`Id_source_type`) REFERENCES `source_type` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=520 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `local_folder`
--

LOCK TABLES `local_folder` WRITE;
/*!40000 ALTER TABLE `local_folder` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `lote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `marketplace`
--

DROP TABLE IF EXISTS `marketplace`;
/*!50001 DROP VIEW IF EXISTS `marketplace`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `marketplace` (
  `Id` tinyint NOT NULL,
  `Id_my_movie_disc_nzb` tinyint NOT NULL,
  `source_type` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `title` tinyint NOT NULL,
  `Id_TMDB_data` tinyint NOT NULL,
  `year` tinyint NOT NULL,
  `genre` tinyint NOT NULL,
  `downloaded` tinyint NOT NULL,
  `downloading` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!50001 DROP VIEW IF EXISTS `movies`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `movies` (
  `Id` tinyint NOT NULL,
  `Id_my_movie_disc_nzb` tinyint NOT NULL,
  `Id_my_movie_disc` tinyint NOT NULL,
  `source_type` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `title` tinyint NOT NULL,
  `Id_TMDB_data` tinyint NOT NULL
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
  `is_custom` tinyint(4) DEFAULT '0',
  `certification` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_my_movie_parental_control1` (`Id_parental_control`),
  KEY `fk_my_movie_my_movie_serie_header1` (`Id_my_movie_serie_header`),
  CONSTRAINT `fk_my_movie_my_movie_serie_header1` FOREIGN KEY (`Id_my_movie_serie_header`) REFERENCES `my_movie_serie_header` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_parental_control1` FOREIGN KEY (`Id_parental_control`) REFERENCES `parental_control` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `is_custom` tinyint(4) DEFAULT '0',
  `certification` varchar(45) DEFAULT NULL,
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
  `Id_my_movie_disc_nzb` varchar(200) DEFAULT NULL,
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
  `Id_TMDB_data` int(11) DEFAULT NULL,
  `is_personal` tinyint(4) DEFAULT '0',
  `Id_nzb_type` int(11) NOT NULL,
  `Id_nzb` int(11) DEFAULT NULL,
  `mkv_file_name` varchar(255) DEFAULT NULL,
  `ready_to_play` tinyint(4) DEFAULT '0' COMMENT 'Cuando se han descargado todos los nzb tanto padre como hijos. Solo aplicaria a los padres en realidad.',
  `sabnzbd_size` double DEFAULT NULL,
  `sabnzbd_id` varchar(45) DEFAULT NULL COMMENT 'Id que entrega sabnzbd, con este valor se puede saber que item de sabnzbd fue el último que descargó. Al iniciar una descarga deberia setear a null este valor.',  
  `has_error` tinyint(4) DEFAULT '0' COMMENT 'si hubo un error durante la descarga.',
  `size` BIGINT(20) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `fk_nzb_my_movie_disc_nzb1` (`Id_my_movie_disc_nzb`),
  KEY `fk_nzb_nzb_state1` (`Id_nzb_state`),
  KEY `fk_nzb_resource_type1` (`Id_resource_type`),
  KEY `fk_nzb_TMDB_data1_idx` (`Id_TMDB_data`),
  KEY `fk_nzb_nzb_type1_idx` (`Id_nzb_type`),
  KEY `fk_nzb_nzb1_idx` (`Id_nzb`),
  CONSTRAINT `fk_nzb_my_movie_disc_nzb1` FOREIGN KEY (`Id_my_movie_disc_nzb`) REFERENCES `my_movie_disc_nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nzb_nzb1` FOREIGN KEY (`Id_nzb`) REFERENCES `nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nzb_nzb_state1` FOREIGN KEY (`Id_nzb_state`) REFERENCES `nzb_state` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nzb_nzb_type1` FOREIGN KEY (`Id_nzb_type`) REFERENCES `nzb_type` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nzb_resource_type1` FOREIGN KEY (`Id_resource_type`) REFERENCES `resource_type` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nzb_TMDB_data1` FOREIGN KEY (`Id_TMDB_data`) REFERENCES `TMDB_data` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Table structure for table `nzb_type`
--

DROP TABLE IF EXISTS `nzb_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nzb_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nzb_type`
--

LOCK TABLES `nzb_type` WRITE;
/*!40000 ALTER TABLE `nzb_type` DISABLE KEYS */;
INSERT INTO `nzb_type` VALUES (1,'MAIN'),(2,'EXTRA 1'),(3,'EXTRA 2'),(4,'COMENTARIOS DIRECTOR'),(5,'NO ENVIAR');
/*!40000 ALTER TABLE `nzb_type` ENABLE KEYS */;
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
  `has_error` tinyint(4) DEFAULT '0' COMMENT 'si el player tiene algun tipo de error', 
  `type` int(11) DEFAULT '0' COMMENT '0-Dune 1-Oppo', 
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
/*!40000 ALTER TABLE `player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `playlist` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist`
--

LOCK TABLES `playlist` WRITE;
/*!40000 ALTER TABLE `playlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `playlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist_bookmark`
--

DROP TABLE IF EXISTS `playlist_bookmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `playlist_bookmark` (
  `Id_playlist` int(11) NOT NULL,
  `Id_bookmark` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_playlist`,`Id_bookmark`),
  KEY `fk_playlist_has_bookmark_bookmark1_idx` (`Id_bookmark`),
  KEY `fk_playlist_has_bookmark_playlist1_idx` (`Id_playlist`),
  CONSTRAINT `fk_playlist_has_bookmark_playlist1` FOREIGN KEY (`Id_playlist`) REFERENCES `playlist` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_playlist_has_bookmark_bookmark1` FOREIGN KEY (`Id_bookmark`) REFERENCES `bookmark` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist_bookmark`
--

LOCK TABLES `playlist_bookmark` WRITE;
/*!40000 ALTER TABLE `playlist_bookmark` DISABLE KEYS */;
/*!40000 ALTER TABLE `playlist_bookmark` ENABLE KEYS */;
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
  `Id_TMDB_data` int(11) DEFAULT NULL,
  `is_personal` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `fk_ripped_movie_my_movie_disc1` (`Id_my_movie_disc`),
  KEY `fk_ripped_movie_TMDB_data1_idx` (`Id_TMDB_data`),
  CONSTRAINT `fk_ripped_movie_TMDB_data1` FOREIGN KEY (`Id_TMDB_data`) REFERENCES `TMDB_data` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
-- Table structure for table `sabnzbd_config`
--

DROP TABLE IF EXISTS `sabnzbd_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sabnzbd_config` (
  `Id` int(11) NOT NULL,
  `server_name` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `enable` tinyint(4) DEFAULT '0',
  `name` varchar(128) DEFAULT NULL,
  `fill_server` varchar(128) DEFAULT NULL,
  `connections` int(11) DEFAULT NULL,
  `ssl` tinyint(4) DEFAULT '0',
  `host` varchar(128) DEFAULT NULL,
  `timeout` int(11) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `optional` tinyint(4) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `retention` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sabnzbd_config`
--

LOCK TABLES `sabnzbd_config` WRITE;
/*!40000 ALTER TABLE `sabnzbd_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `sabnzbd_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `series`
--

DROP TABLE IF EXISTS `series`;
/*!50001 DROP VIEW IF EXISTS `series`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `series` (
  `Id` tinyint NOT NULL,
  `Id_my_movie_disc_nzb` tinyint NOT NULL,
  `Id_my_movie_disc` tinyint NOT NULL,
  `source_type` tinyint NOT NULL,
  `date` tinyint NOT NULL
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
  `sabnzb_pwd_file_path` varchar(255) DEFAULT NULL,
  `shared_online_path` varchar(255) DEFAULT NULL,
  `path_shared_pelicano_root` varchar(255) DEFAULT NULL,
  `path_shared_copied` varchar(255) DEFAULT NULL,
  `path_shared_ripped` varchar(255) DEFAULT NULL,
  `path_sabnzbd_download` varchar(255) DEFAULT NULL,
  `is_movie_tester` tinyint(4) DEFAULT 0,
  `path_sabnzbd_temp` varchar(255) DEFAULT NULL COMMENT 'debe apuntar a donde sabnzbd esta configurado como " Temporary Download Folder"',
  `host_file_server_user` varchar(45) DEFAULT NULL COMMENT 'Usuario para acceder al NAS desde el Player',
  `host_file_server_passwd` varchar(45) DEFAULT NULL COMMENT 'Password para acceder al NAS desde el Player',     
  `michael_jackson` varchar(256) DEFAULT NULL,
  `host_file_server_name` varchar(255) DEFAULT NULL COMMENT 'Es el nombre con el que se identifica el servidor SMB/NFS',
  `version` varchar(45) DEFAULT NULL COMMENT 'version de instalacion',     
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,'./nzb',NULL,NULL,'http://localhost:8080/sabnzbd/api?','http://gruposmartliving.com','./nzbReady','./subtitles','./images','/media/NAS/','/pelicanos',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'/home/pelicano/passwords',NULL,'/pelicano','/copied','/ripped',"/media/NAS/",0,"","","","","","1.0");
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
-- Table structure for table `system_status`
--

DROP TABLE IF EXISTS `system_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_status` (
  `Id` int(11) NOT NULL,
  `error_players` tinyint(4) DEFAULT '0',
  `error_NAS` tinyint(4) DEFAULT '0',
  `error_NAS_space` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_status`
--

LOCK TABLES `system_status` WRITE;
/*!40000 ALTER TABLE `system_status` DISABLE KEYS */;
INSERT INTO `system_status` VALUES(1,0,0,0);
/*!40000 ALTER TABLE `system_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmdb`
--

DROP TABLE IF EXISTS `tmdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmdb` (
  `Id` int(11) NOT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `lang` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tmdb`
--

LOCK TABLES `tmdb` WRITE;
/*!40000 ALTER TABLE `tmdb` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmdb` ENABLE KEYS */;
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
-- Table structure for table `market_category`
--

DROP TABLE IF EXISTS `market_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `market_category` (
  `Id` int(11) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `hide` tinyint(4) DEFAULT '0',
  `order` int(11) DEFAULT NULL COMMENT ' ',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `market_category`
--

LOCK TABLES `market_category` WRITE;
/*!40000 ALTER TABLE `market_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `market_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `market_category_nzb`
--

DROP TABLE IF EXISTS `market_category_nzb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `market_category_nzb` (
  `Id_market_category` int(11) NOT NULL,
  `Id_nzb` int(11) NOT NULL,
  PRIMARY KEY (`Id_market_category`,`Id_nzb`),
  KEY `fk_market_category_has_nzb_nzb1_idx` (`Id_nzb`),
  KEY `fk_market_category_has_nzb_market_category1_idx` (`Id_market_category`),
  CONSTRAINT `fk_market_category_has_nzb_market_category1` FOREIGN KEY (`Id_market_category`) REFERENCES `market_category` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_market_category_has_nzb_nzb1` FOREIGN KEY (`Id_nzb`) REFERENCES `nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `market_category_nzb`
--

LOCK TABLES `market_category_nzb` WRITE;
/*!40000 ALTER TABLE `market_category_nzb` DISABLE KEYS */;
/*!40000 ALTER TABLE `market_category_nzb` ENABLE KEYS */;
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
-- Final view structure for view `marketplace`
--

/*!50001 DROP TABLE IF EXISTS `marketplace`*/;
/*!50001 DROP VIEW IF EXISTS `marketplace`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`pelicano`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `marketplace` AS select `nzb`.`Id` AS `Id`,`nzb`.`Id_my_movie_disc_nzb` AS `Id_my_movie_disc_nzb`,1 AS `source_type`,`nzb`.`date` AS `date`,`mn`.`original_title` AS `title`,`nzb`.`Id_TMDB_data` AS `Id_TMDB_data`,`mn`.`production_year` AS `year`,`mn`.`genre` AS `genre`,if((`nzb`.`ready_to_play` = 1),1,0) AS `downloaded`,if((((`nzb`.`ready_to_play` = 0) and (`nzb`.`downloaded` = 1)) or (`nzb`.`downloading` = 1)),1,0) AS `downloading` from ((`nzb` join `my_movie_disc_nzb` `mdn` on((`mdn`.`Id` = `nzb`.`Id_my_movie_disc_nzb`))) join `my_movie_nzb` `mn` on((`mn`.`Id` = `mdn`.`Id_my_movie_nzb`))) where ((`nzb`.`ready` = 1) and isnull(`nzb`.`Id_nzb`)and (`nzb`.`deleted` = 0)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

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
/*!50013 DEFINER=`pelicano`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `movies` AS select `nzb`.`Id` AS `Id`,`nzb`.`Id_my_movie_disc_nzb` AS `Id_my_movie_disc_nzb`,NULL AS `Id_my_movie_disc`,1 AS `source_type`,`nzb`.`date` AS `date`,`mn`.`original_title` AS `title`,`nzb`.`Id_TMDB_data` AS `Id_TMDB_data`,`mn`.`production_year` AS `year`,`mn`.`genre` AS `genre`,(not(exists(select 1 from `current_play` `cp` where (`cp`.`Id_nzb` = `nzb`.`Id`)))) AS `is_new` from ((`nzb` join `my_movie_disc_nzb` `mdn` on((`mdn`.`Id` = `nzb`.`Id_my_movie_disc_nzb`))) join `my_movie_nzb` `mn` on((`mn`.`Id` = `mdn`.`Id_my_movie_nzb`))) where ((`nzb`.`downloaded` = 1) and (`nzb`.`ready_to_play` = 1) and isnull(`nzb`.`Id_nzb`) and isnull(`mn`.`Id_my_movie_serie_header`)) union select `ripped_movie`.`Id` AS `Id`,NULL AS `Id_my_movie_disc_nzb`,`ripped_movie`.`Id_my_movie_disc` AS `Id_my_movie_disc`,2 AS `source_type`,`ripped_movie`.`creation_date` AS `date`,`m`.`original_title` AS `title`,`ripped_movie`.`Id_TMDB_data` AS `Id_TMDB_data`,`m`.`production_year` AS `year`,`m`.`genre` AS `genre`,(not(exists(select 1 from `current_play` `cp` where (`cp`.`Id_ripped_movie` = `ripped_movie`.`Id`)))) AS `is_new` from ((`ripped_movie` join `my_movie_disc` `md` on((`md`.`Id` = `ripped_movie`.`Id_my_movie_disc`))) join `my_movie` `m` on((`m`.`Id` = `md`.`Id_my_movie`))) where isnull(`m`.`Id_my_movie_serie_header`) union select `local_folder`.`Id` AS `Id`,NULL AS `Id_my_movie_disc_nzb`,`local_folder`.`Id_my_movie_disc` AS `Id_my_movie_disc`,3 AS `source_type`,`local_folder`.`read_date` AS `date`,`m`.`original_title` AS `title`,`local_folder`.`Id_TMDB_data` AS `Id_TMDB_data`,`m`.`production_year` AS `year`,`m`.`genre` AS `genre`,(not(exists(select 1 from `current_play` `cp` where (`cp`.`Id_local_folder` = `local_folder`.`Id`)))) AS `is_new` from ((`local_folder` join `my_movie_disc` `md` on((`md`.`Id` = `local_folder`.`Id_my_movie_disc`))) join `my_movie` `m` on((`m`.`Id` = `md`.`Id_my_movie`))) where (isnull(`m`.`Id_my_movie_serie_header`) and (`local_folder`.`hide` = 0) and (`local_folder`.`ready` = 1)) */;
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
/*!50013 DEFINER=`pelicano`@`localhost` SQL SECURITY DEFINER */
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

UPDATE `pelicanoc`.`setting` set version="2" where Id=1;

-- Dump completed on 2014-01-23 11:16:11
