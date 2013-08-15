CREATE DATABASE  IF NOT EXISTS `pelicanos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pelicanos`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: dhcppc2    Database: pelicanos
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
-- Table structure for table `anydvdhd_version`
--

DROP TABLE IF EXISTS `anydvdhd_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anydvdhd_version` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(45) DEFAULT NULL,
  `file_name` varchar(128) DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anydvdhd_version`
--

LOCK TABLES `anydvdhd_version` WRITE;
/*!40000 ALTER TABLE `anydvdhd_version` DISABLE KEYS */;
INSERT INTO `anydvdhd_version` VALUES (2,'7.1.1.0','SetupAnyDVD7110.exe','2012-11-15 04:58:41');
/*!40000 ALTER TABLE `anydvdhd_version` ENABLE KEYS */;
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES ('Operator','installerV','','s:0:\"\";'),('Authority','admin','','s:0:\"\";'),('Administrator','admin','','s:0:\"\";'),('Operator','coco','','s:0:\"\";');
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audio_track`
--

LOCK TABLES `audio_track` WRITE;
/*!40000 ALTER TABLE `audio_track` DISABLE KEYS */;
/*!40000 ALTER TABLE `audio_track` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auto_ripper`
--

DROP TABLE IF EXISTS `auto_ripper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auto_ripper` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_disc` varchar(200) DEFAULT NULL,
  `Id_auto_ripper_state` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `Id_nzb` int(11) DEFAULT NULL,
  `percentage` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `fk_auto_ripper_auto_ripper_state1_idx` (`Id_auto_ripper_state`),
  KEY `fk_auto_ripper_nzb1_idx` (`Id_nzb`),
  CONSTRAINT `fk_auto_ripper_auto_ripper_state1` FOREIGN KEY (`Id_auto_ripper_state`) REFERENCES `auto_ripper_state` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_auto_ripper_nzb1` FOREIGN KEY (`Id_nzb`) REFERENCES `nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auto_ripper`
--

LOCK TABLES `auto_ripper` WRITE;
/*!40000 ALTER TABLE `auto_ripper` DISABLE KEYS */;
/*!40000 ALTER TABLE `auto_ripper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auto_ripper_auto_ripper_state`
--

DROP TABLE IF EXISTS `auto_ripper_auto_ripper_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auto_ripper_auto_ripper_state` (
  `Id_auto_ripper` int(11) NOT NULL,
  `Id_auto_ripper_state` int(11) NOT NULL,
  `change_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id_auto_ripper`,`Id_auto_ripper_state`),
  KEY `fk_auto_ripper_has_auto_ripper_state_auto_ripper_state1_idx` (`Id_auto_ripper_state`),
  KEY `fk_auto_ripper_has_auto_ripper_state_auto_ripper1_idx` (`Id_auto_ripper`),
  CONSTRAINT `fk_auto_ripper_has_auto_ripper_state_auto_ripper1` FOREIGN KEY (`Id_auto_ripper`) REFERENCES `auto_ripper` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_auto_ripper_has_auto_ripper_state_auto_ripper_state1` FOREIGN KEY (`Id_auto_ripper_state`) REFERENCES `auto_ripper_state` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auto_ripper_auto_ripper_state`
--

LOCK TABLES `auto_ripper_auto_ripper_state` WRITE;
/*!40000 ALTER TABLE `auto_ripper_auto_ripper_state` DISABLE KEYS */;
/*!40000 ALTER TABLE `auto_ripper_auto_ripper_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auto_ripper_state`
--

DROP TABLE IF EXISTS `auto_ripper_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auto_ripper_state` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auto_ripper_state`
--

LOCK TABLES `auto_ripper_state` WRITE;
/*!40000 ALTER TABLE `auto_ripper_state` DISABLE KEYS */;
INSERT INTO `auto_ripper_state` VALUES (1,'Iniciando'),(2,'Creando 7zip'),(3,'Creado 7zip'),(4,'Creando RAR'),(5,'Creado RAR'),(6,'Creando Par2'),(7,'Creado Par2'),(8,'Subiendo Usenet'),(9,'Subido Usenet'),(10,'Borrando archivos'),(11,'Borrados archivos'),(12,'Finalizado');
/*!40000 ALTER TABLE `auto_ripper_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_settings`
--

DROP TABLE IF EXISTS `client_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_settings` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_v4` varchar(128) DEFAULT NULL,
  `ip_v6` varchar(128) DEFAULT NULL,
  `port_v4` int(11) DEFAULT NULL,
  `port_v6` int(11) DEFAULT NULL,
  `Id_customer` int(11) NOT NULL,
  `last_update` timestamp NULL DEFAULT NULL,
  `anydvd_version_installed` varchar(128) DEFAULT NULL,
  `anydvd_version_downloaded` varchar(128) DEFAULT NULL,
  `need_update` tinyint(4) NOT NULL DEFAULT '0',
  `Id_device` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_client_settings_customer1` (`Id_customer`),
  KEY `fk_client_settings_device1` (`Id_device`),
  CONSTRAINT `fk_client_settings_customer1` FOREIGN KEY (`Id_customer`) REFERENCES `customer` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_client_settings_device1` FOREIGN KEY (`Id_device`) REFERENCES `device` (`Id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_settings`
--

LOCK TABLES `client_settings` WRITE;
/*!40000 ALTER TABLE `client_settings` DISABLE KEYS */;
INSERT INTO `client_settings` VALUES (1,'186.182.183.6',NULL,NULL,NULL,1,'2013-08-15 13:40:07','7.1.1.0','7.0.9.0',0,'50ed8335ae2ef');
/*!40000 ALTER TABLE `client_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creation_state`
--

DROP TABLE IF EXISTS `creation_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creation_state` (
  `Id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creation_state`
--

LOCK TABLES `creation_state` WRITE;
/*!40000 ALTER TABLE `creation_state` DISABLE KEYS */;
INSERT INTO `creation_state` VALUES (1,'creado'),(2,'con archivo'),(3,'contenido completo'),(4,'verificado'),(5,'publicado');
/*!40000 ALTER TABLE `creation_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `current_points` int(11) DEFAULT '0',
  `Id_reseller` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_customer_reseller1` (`Id_reseller`),
  CONSTRAINT `fk_customer_reseller1` FOREIGN KEY (`Id_reseller`) REFERENCES `reseller` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'Arnol','Montiel','Lobos 1747',0,1);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_device`
--

DROP TABLE IF EXISTS `customer_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_device` (
  `Id_device` varchar(45) NOT NULL,
  `Id_customer` int(11) NOT NULL,
  `need_update` tinyint(4) DEFAULT '1',
  `last_read_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id_device`,`Id_customer`),
  KEY `fk_device_has_customer_customer1` (`Id_customer`),
  KEY `fk_device_has_customer_device1` (`Id_device`),
  CONSTRAINT `fk_device_has_customer_customer1` FOREIGN KEY (`Id_customer`) REFERENCES `customer` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_device_has_customer_device1` FOREIGN KEY (`Id_device`) REFERENCES `device` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_device`
--

LOCK TABLES `customer_device` WRITE;
/*!40000 ALTER TABLE `customer_device` DISABLE KEYS */;
INSERT INTO `customer_device` VALUES ('50ed8335ae2ef',1,0,'2013-08-15 13:38:10');
/*!40000 ALTER TABLE `customer_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_transaction`
--

DROP TABLE IF EXISTS `customer_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_transaction` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_nzb` int(11) DEFAULT NULL,
  `Id_customer` int(11) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `Id_transaction_type` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_customer_transaction_nzb1` (`Id_nzb`),
  KEY `fk_customer_transaction_customer1` (`Id_customer`),
  KEY `fk_customer_transaction_transaction_type1` (`Id_transaction_type`),
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
-- Table structure for table `customer_users`
--

DROP TABLE IF EXISTS `customer_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_users` (
  `username` varchar(128) NOT NULL,
  `Id_customer` int(11) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `adult_section` tinyint(4) DEFAULT '0',
  `email` varchar(128) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `birth_date` date DEFAULT NULL,
  PRIMARY KEY (`username`,`Id_customer`),
  KEY `fk_customer_users_customer1` (`Id_customer`),
  CONSTRAINT `fk_customer_users_customer1` FOREIGN KEY (`Id_customer`) REFERENCES `customer` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_users`
--

LOCK TABLES `customer_users` WRITE;
/*!40000 ALTER TABLE `customer_users` DISABLE KEYS */;
INSERT INTO `customer_users` VALUES ('arnold',1,'Arnold',1,'arnol@gmail.com',0,'1983-08-24');
/*!40000 ALTER TABLE `customer_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device` (
  `Id` varchar(45) NOT NULL,
  `description` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device`
--

LOCK TABLES `device` WRITE;
/*!40000 ALTER TABLE `device` DISABLE KEYS */;
INSERT INTO `device` VALUES ('50ed8335ae2ef','Castelar Norte');
/*!40000 ALTER TABLE `device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_state`
--

DROP TABLE IF EXISTS `device_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_state` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_state`
--

LOCK TABLES `device_state` WRITE;
/*!40000 ALTER TABLE `device_state` DISABLE KEYS */;
INSERT INTO `device_state` VALUES (1,'ripping'),(2,'alive'),(3,'algo');
/*!40000 ALTER TABLE `device_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_type`
--

DROP TABLE IF EXISTS `device_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_type`
--

LOCK TABLES `device_type` WRITE;
/*!40000 ALTER TABLE `device_type` DISABLE KEYS */;
INSERT INTO `device_type` VALUES (1,'Client'),(2,'Ripper');
/*!40000 ALTER TABLE `device_type` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `external_wsdl`
--

LOCK TABLES `external_wsdl` WRITE;
/*!40000 ALTER TABLE `external_wsdl` DISABLE KEYS */;
INSERT INTO `external_wsdl` VALUES (1,'Monitor','monitor','Monit0r357','http://gruposmartliving.com/pelicanoM/index.php?r=wsMonitor/wsdl'),(2,'MyMovie','rdsmart','SmartLiving01','https://api.mymovies.dk/default.asmx?WSDL');
/*!40000 ALTER TABLE `external_wsdl` ENABLE KEYS */;
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
INSERT INTO `itemchildren` VALUES ('Administrator','AnydvdhdVersionManage'),('Administrator','ClientSettingsManage'),('Administrator','CustomerManage'),('Administrator','DeviceManage'),('Administrator','NzbManage'),('Administrator','ResellerManage'),('Administrator','SerieManage'),('Administrator','UserManage'),('Administrator','WsAutoRipperManage'),('AnydvdhdVersionManage','AnydvdhdVersionAdmin'),('AnydvdhdVersionManage','AnydvdhdVersionIndex'),('ClientSettingsManage','ClientSettingsIndex'),('CustomerManage','CustomerSummary'),('CustomerManage','CustomerSummaryNzb'),('CustomerManage','CustomerSummaryRipped'),('CustomerManage','CustomerViewSummaryRipped'),('CustomerManageOp','CustomerAdmin'),('CustomerManageOp','CustomerCreate'),('CustomerManageOp','CustomerCustomerMovies'),('CustomerManageOp','CustomerCustomerTransaction'),('CustomerManageOp','CustomerIndex'),('CustomerManageOp','CustomerIndexRipped'),('CustomerManageOp','CustomerUpdate'),('CustomerManageOp','CustomerUsersUpdate'),('CustomerManageOp','CustomerView'),('CustomerManageOp','CustomerViewRipped'),('DeviceManage','DeviceAdmin'),('DeviceManage','DeviceIndex'),('DeviceManage','DeviceView'),('MovieManageOp','NzbIndexEpisodeReseller'),('MovieManageOp','NzbIndexReseller'),('MovieManageOp','NzbViewEpisodeReseller'),('MovieManageOp','NzbViewReseller'),('NzbManage','NzbAdmin'),('NzbManage','NzbCreate'),('NzbManage','NzbCreateEpisode'),('NzbManage','NzbCreateMovie'),('NzbManage','NzbDelete'),('NzbManage','NzbFindSubtitle'),('NzbManage','NzbIndex'),('NzbManage','NzbIndexEpisode'),('NzbManage','NzbIndexTv'),('NzbManage','NzbUpdate'),('NzbManage','NzbUploadSubtitle'),('NzbManage','NzbView'),('NzbManage','NzbViewEpisode'),('Operator','CustomerManageOp'),('Operator','MovieManageOp'),('Operator','SerieManageOp'),('Operator','UserManageOp'),('ResellerManage','ResellerAdmin'),('ResellerManage','ResellerCreate'),('ResellerManage','ResellerIndex'),('ResellerManage','ResellerUpdate'),('ResellerManage','ResellerView'),('SerieManage','ImdbdataTvIndex'),('SerieManage','ImdbdataTvSetSeason'),('SerieManage','ImdbdataTvView'),('SerieManage','ImdbdataTvViewSeason'),('SerieManageOp','ImdbdataTvIndexReseller'),('SerieManageOp','ImdbdataTvViewReseller'),('SerieManageOp','ImdbdataTvViewSeasonReseller'),('UserManage','UserSummary'),('UserManage','UserSummaryUpdate'),('UserManageOp','UserAdmin'),('UserManageOp','UserCreate'),('UserManageOp','UserDelete'),('UserManageOp','UserIndex'),('UserManageOp','UserUpdate'),('UserManageOp','UserView'),('WsAutoRipperManage','WsAutoRipperWsdl');
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
INSERT INTO `items` VALUES ('UserManage',1,'','','s:0:\"\";'),('ResellerAdmin',0,'','','s:0:\"\";'),('UserIndex',0,'','','s:0:\"\";'),('UserView',0,'','','s:0:\"\";'),('UserCreate',0,'','','s:0:\"\";'),('UserUpdate',0,'','','s:0:\"\";'),('UserAdmin',0,'','','s:0:\"\";'),('UserDelete',0,'','','s:0:\"\";'),('Authority',2,'','','s:0:\"\";'),('Administrator',2,'','','s:0:\"\";'),('ResellerManage',1,'','','s:0:\"\";'),('ResellerIndex',0,'','','s:0:\"\";'),('ResellerView',0,'','','s:0:\"\";'),('ResellerCreate',0,'','','s:0:\"\";'),('CustomerManage',1,'','','s:0:\"\";'),('CustomerSummary',0,'','','s:0:\"\";'),('CustomerManageOp',1,'','','s:0:\"\";'),('CustomerIndex',0,'','','s:0:\"\";'),('CustomerView',0,'','','s:0:\"\";'),('CustomerAdmin',0,'','','s:0:\"\";'),('CustomerIndexRipped',0,'','','s:0:\"\";'),('CustomerSummaryRipped',0,'','','s:0:\"\";'),('CustomerViewRipped',0,'','','s:0:\"\";'),('CustomerViewSummaryRipped',0,'','','s:0:\"\";'),('Operator',2,'','','s:0:\"\";'),('UserManageOp',1,'','','s:0:\"\";'),('UserSummary',0,'','','s:0:\"\";'),('UserSummaryUpdate',0,'','','s:0:\"\";'),('NzbManage',1,'','','s:0:\"\";'),('MovieManageOp',1,'','','s:0:\"\";'),('NzbIndexReseller',0,'','','s:0:\"\";'),('NzbViewReseller',0,'','','s:0:\"\";'),('NzbIndexEpisodeReseller',0,'','','s:0:\"\";'),('NzbViewEpisodeReseller',0,'','','s:0:\"\";'),('SerieManageOp',1,'','','s:0:\"\";'),('NzbCreate',0,'','','s:0:\"\";'),('SerieManage',1,'','','s:0:\"\";'),('ImdbdataTvIndexReseller',0,'','','s:0:\"\";'),('ImdbdataTvViewReseller',0,'','','s:0:\"\";'),('ImdbdataTvViewSeasonReseller',0,'','','s:0:\"\";'),('NzbIndex',0,'','','s:0:\"\";'),('NzbView',0,'','','s:0:\"\";'),('NzbAdmin',0,'','','s:0:\"\";'),('NzbIndexEpisode',0,'','','s:0:\"\";'),('NzbViewEpisode',0,'','','s:0:\"\";'),('NzbCreateMovie',0,'','','s:0:\"\";'),('NzbCreateEpisode',0,'','','s:0:\"\";'),('ImdbdataTvIndex',0,'','','s:0:\"\";'),('ImdbdataTvView',0,'','','s:0:\"\";'),('ImdbdataTvViewSeason',0,'','','s:0:\"\";'),('ImdbdataTvSetSeason',0,'','','s:0:\"\";'),('CustomerCreate',0,'','','s:0:\"\";'),('CustomerUpdate',0,'','','s:0:\"\";'),('CustomerUsersUpdate',0,'','','s:0:\"\";'),('NzbFindSubtitle',0,'','','s:0:\"\";'),('NzbUpdate',0,'','','s:0:\"\";'),('NzbUploadSubtitle',0,'','','s:0:\"\";'),('NzbDelete',0,'','','s:0:\"\";'),('ResellerUpdate',0,'','','s:0:\"\";'),('CustomerSummaryNzb',0,'','','s:0:\"\";'),('CustomerCustomerTransaction',0,'','','s:0:\"\";'),('CustomerCustomerMovies',0,'','','s:0:\"\";'),('ClientSettingsIndex',0,'','','s:0:\"\";'),('ClientSettingsManage',1,'','','s:0:\"\";'),('DeviceManage',1,'','','s:0:\"\";'),('DeviceIndex',0,'','','s:0:\"\";'),('AnydvdhdVersionManage',1,'','','s:0:\"\";'),('AnydvdhdVersionIndex',0,'','','s:0:\"\";'),('AnydvdhdVersionAdmin',0,'','','s:0:\"\";'),('DeviceAdmin',0,'','','s:0:\"\";'),('DeviceView',0,'','','s:0:\"\";'),('WsAutoRipperWsdl',0,'','','s:0:\"\";'),('WsAutoRipperManage',1,'','','s:0:\"\";'),('NzbIndexTv',0,'','','s:0:\"\";');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
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
  `log_date` varchar(45) DEFAULT NULL,
  `description` text,
  `Id_customer` int(11) NOT NULL,
  `Id_log_type` int(11) NOT NULL,
  `Id_log_customer` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_log_customer1` (`Id_customer`),
  KEY `fk_log_log_type1` (`Id_log_type`),
  CONSTRAINT `fk_log_customer1` FOREIGN KEY (`Id_customer`) REFERENCES `customer` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
-- Table structure for table `monitor`
--

DROP TABLE IF EXISTS `monitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monitor` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_device_type` int(11) NOT NULL,
  `Id_device_state` int(11) NOT NULL,
  `Id_device` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `insert_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_monitor_device_type1` (`Id_device_type`),
  KEY `fk_monitor_device_state1` (`Id_device_state`),
  KEY `fk_monitor_device1` (`Id_device`),
  CONSTRAINT `fk_monitor_device1` FOREIGN KEY (`Id_device`) REFERENCES `device` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_monitor_device_state1` FOREIGN KEY (`Id_device_state`) REFERENCES `device_state` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_monitor_device_type1` FOREIGN KEY (`Id_device_type`) REFERENCES `device_type` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitor`
--

LOCK TABLES `monitor` WRITE;
/*!40000 ALTER TABLE `monitor` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitor` ENABLE KEYS */;
UNLOCK TABLES;

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
  `studio` varchar(255) DEFAULT NULL,
  `poster_original` varchar(255) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `backdrop_original` varchar(255) DEFAULT NULL,
  `backdrop` varchar(255) DEFAULT NULL,
  `adult` tinyint(4) DEFAULT '0',
  `Id_parental_control` int(11) NOT NULL,
  `Id_my_movie_serie_header` varchar(200) DEFAULT NULL,
  `is_serie` tinyint(4) DEFAULT '0',
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
  CONSTRAINT `fk_my_movie_has_audio_track_my_movie1` FOREIGN KEY (`Id_my_movie`) REFERENCES `my_movie` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Table structure for table `my_movie_disc_my_movie_episode`
--

DROP TABLE IF EXISTS `my_movie_disc_my_movie_episode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_disc_my_movie_episode` (
  `Id_my_movie_episode` int(11) NOT NULL,
  `Id_my_movie_disc` varchar(200) NOT NULL,
  PRIMARY KEY (`Id_my_movie_episode`,`Id_my_movie_disc`),
  KEY `fk_my_movie_episode_has_my_movie_disc_my_movie_disc1` (`Id_my_movie_disc`),
  KEY `fk_my_movie_episode_has_my_movie_disc_my_movie_episode1` (`Id_my_movie_episode`),
  CONSTRAINT `fk_my_movie_episode_has_my_movie_disc_my_movie_disc1` FOREIGN KEY (`Id_my_movie_disc`) REFERENCES `my_movie_disc` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_episode_has_my_movie_disc_my_movie_episode1` FOREIGN KEY (`Id_my_movie_episode`) REFERENCES `my_movie_episode` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `my_movie_disc_my_movie_episode`
--

LOCK TABLES `my_movie_disc_my_movie_episode` WRITE;
/*!40000 ALTER TABLE `my_movie_disc_my_movie_episode` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_disc_my_movie_episode` ENABLE KEYS */;
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
-- Table structure for table `my_movie_disc_nzb_my_movie_episode`
--

DROP TABLE IF EXISTS `my_movie_disc_nzb_my_movie_episode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `my_movie_disc_nzb_my_movie_episode` (
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
-- Dumping data for table `my_movie_disc_nzb_my_movie_episode`
--

LOCK TABLES `my_movie_disc_nzb_my_movie_episode` WRITE;
/*!40000 ALTER TABLE `my_movie_disc_nzb_my_movie_episode` DISABLE KEYS */;
/*!40000 ALTER TABLE `my_movie_disc_nzb_my_movie_episode` ENABLE KEYS */;
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
  KEY `fk_my_movie_episode_my_movie_season2` (`Id_my_movie_season`),
  CONSTRAINT `fk_my_movie_episode_my_movie_season2` FOREIGN KEY (`Id_my_movie_season`) REFERENCES `my_movie_season` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `Id_parental_control` int(11) NOT NULL,
  `local_title` varchar(100) DEFAULT NULL,
  `original_title` varchar(100) DEFAULT NULL,
  `sort_title` varchar(100) DEFAULT NULL,
  `production_year` varchar(45) DEFAULT NULL,
  `running_time` varchar(45) DEFAULT NULL,
  `description` text,
  `parental_rating_desc` varchar(255) DEFAULT NULL,
  `imdb` varchar(45) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `studio` varchar(512) DEFAULT NULL,
  `poster_original` varchar(255) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `backdrop_original` varchar(255) DEFAULT NULL,
  `backdrop` varchar(255) DEFAULT NULL,
  `adult` tinyint(4) DEFAULT '0',
  `extra_features` text,
  `country` varchar(45) DEFAULT NULL,
  `video_standard` varchar(45) DEFAULT NULL,
  `release_date` varchar(45) DEFAULT NULL,
  `bar_code` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `media_type` varchar(45) DEFAULT NULL,
  `aspect_ratio` varchar(45) DEFAULT NULL,
  `data_changed` varchar(45) DEFAULT NULL,
  `covers_changed` varchar(45) DEFAULT NULL,
  `Id_my_movie_serie_header` varchar(200) DEFAULT NULL,
  `is_serie` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `fk_my_movie_parental_control1` (`Id_parental_control`),
  KEY `fk_my_movie_nzb_my_movie_serie_header1` (`Id_my_movie_serie_header`),
  CONSTRAINT `fk_my_movie_nzb_my_movie_serie_header1` FOREIGN KEY (`Id_my_movie_serie_header`) REFERENCES `my_movie_serie_header` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_parental_control10` FOREIGN KEY (`Id_parental_control`) REFERENCES `parental_control` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `Id_my_movie` varchar(200) NOT NULL,
  `Id_person` int(11) NOT NULL,
  PRIMARY KEY (`Id_my_movie`,`Id_person`),
  KEY `fk_my_movie_has_person_person1` (`Id_person`),
  KEY `fk_my_movie_has_person_my_movie1` (`Id_my_movie`),
  CONSTRAINT `fk_my_movie_has_person_my_movie1` FOREIGN KEY (`Id_my_movie`) REFERENCES `my_movie` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_my_movie_has_person_person1` FOREIGN KEY (`Id_person`) REFERENCES `person` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  KEY `fk_my_movie_season_my_movie_serie_header1` (`Id_my_movie_serie_header`),
  CONSTRAINT `fk_my_movie_season_my_movie_serie_header1` FOREIGN KEY (`Id_my_movie_serie_header`) REFERENCES `my_movie_serie_header` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  CONSTRAINT `fk_my_movie_has_subtitle_my_movie1` FOREIGN KEY (`Id_my_movie`) REFERENCES `my_movie` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_resource_type` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `subt_url` varchar(255) DEFAULT NULL,
  `subt_file_name` varchar(255) DEFAULT NULL,
  `subt_original_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `points` int(11) DEFAULT '0',
  `file_original_name` varchar(255) DEFAULT NULL,
  `is_draft` tinyint(4) DEFAULT '1',
  `Id_my_movie_disc_nzb` varchar(200) NOT NULL,
  `final_content_path` varchar(255) DEFAULT NULL,
  `file_password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_nzb_resource_type1` (`Id_resource_type`),
  KEY `fk_nzb_my_movie_disc_nzb1` (`Id_my_movie_disc_nzb`),
  CONSTRAINT `fk_nzb_my_movie_disc_nzb1` FOREIGN KEY (`Id_my_movie_disc_nzb`) REFERENCES `my_movie_disc_nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nzb_resource_type1` FOREIGN KEY (`Id_resource_type`) REFERENCES `resource_type` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nzb`
--

LOCK TABLES `nzb` WRITE;
/*!40000 ALTER TABLE `nzb` DISABLE KEYS */;
/*!40000 ALTER TABLE `nzb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nzb_creation_state`
--

DROP TABLE IF EXISTS `nzb_creation_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nzb_creation_state` (
  `Id_nzb` int(11) NOT NULL,
  `Id_creation_state` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_username` varchar(128) NOT NULL,
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`),
  KEY `fk_nzb_creation_state_nzb1` (`Id_nzb`),
  KEY `fk_nzb_creation_state_creation_state1` (`Id_creation_state`),
  KEY `fk_nzb_creation_state_user1` (`user_username`),
  CONSTRAINT `fk_nzb_creation_state_creation_state1` FOREIGN KEY (`Id_creation_state`) REFERENCES `creation_state` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nzb_creation_state_nzb1` FOREIGN KEY (`Id_nzb`) REFERENCES `nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nzb_creation_state_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nzb_creation_state`
--

LOCK TABLES `nzb_creation_state` WRITE;
/*!40000 ALTER TABLE `nzb_creation_state` DISABLE KEYS */;
/*!40000 ALTER TABLE `nzb_creation_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nzb_device`
--

DROP TABLE IF EXISTS `nzb_device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nzb_device` (
  `Id_nzb` int(11) NOT NULL,
  `Id_device` varchar(45) NOT NULL,
  `need_update` tinyint(1) DEFAULT '0',
  `date_sent` timestamp NULL DEFAULT NULL,
  `date_downloading` timestamp NULL DEFAULT NULL,
  `date_downloaded` timestamp NULL DEFAULT NULL,
  `Id_nzb_state` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_nzb`,`Id_device`),
  KEY `fk_nzb_has_device_device1` (`Id_device`),
  KEY `fk_nzb_has_device_nzb1` (`Id_nzb`),
  KEY `fk_nzb_device_nzb_state1` (`Id_nzb_state`),
  CONSTRAINT `fk_nzb_device_nzb_state1` FOREIGN KEY (`Id_nzb_state`) REFERENCES `nzb_state` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nzb_has_device_device1` FOREIGN KEY (`Id_device`) REFERENCES `device` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nzb_has_device_nzb1` FOREIGN KEY (`Id_nzb`) REFERENCES `nzb` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nzb_device`
--

LOCK TABLES `nzb_device` WRITE;
/*!40000 ALTER TABLE `nzb_device` DISABLE KEYS */;
/*!40000 ALTER TABLE `nzb_device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nzb_state`
--

DROP TABLE IF EXISTS `nzb_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nzb_state` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
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
-- Table structure for table `open_subtitle`
--

DROP TABLE IF EXISTS `open_subtitle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `open_subtitle` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `MatchedBy` varchar(45) DEFAULT NULL,
  `IDSubMovieFile` varchar(45) DEFAULT NULL,
  `MovieHash` varchar(45) DEFAULT NULL,
  `MovieByteSize` varchar(45) DEFAULT NULL,
  `MovieTimeMS` varchar(45) DEFAULT NULL,
  `IDSubtitleFile` varchar(45) DEFAULT NULL,
  `SubFileName` varchar(100) DEFAULT NULL,
  `SubActualCD` varchar(45) DEFAULT NULL,
  `SubSize` varchar(45) DEFAULT NULL,
  `SubHash` varchar(100) DEFAULT NULL,
  `IDSubtitle` varchar(45) DEFAULT NULL,
  `UserID` varchar(45) DEFAULT NULL,
  `SubLanguageID` varchar(45) DEFAULT NULL,
  `SubFormat` varchar(45) DEFAULT NULL,
  `SubSumCD` varchar(45) DEFAULT NULL,
  `SubAuthorComment` varchar(45) DEFAULT NULL,
  `SubAddDate` varchar(45) DEFAULT NULL,
  `SubBad` varchar(45) DEFAULT NULL,
  `SubRating` varchar(45) DEFAULT NULL,
  `SubDownloadsCnt` varchar(45) DEFAULT NULL,
  `MovieReleaseName` varchar(45) DEFAULT NULL,
  `IDMovie` varchar(45) DEFAULT NULL,
  `IDMovieImdb` varchar(45) DEFAULT NULL,
  `MovieName` varchar(255) DEFAULT NULL,
  `MovieNameEng` varchar(255) DEFAULT NULL,
  `MovieYear` varchar(45) DEFAULT NULL,
  `MovieImdbRating` varchar(45) DEFAULT NULL,
  `SubFeatured` varchar(45) DEFAULT NULL,
  `UserNickName` varchar(45) DEFAULT NULL,
  `ISO639` varchar(45) DEFAULT NULL,
  `LanguageName` varchar(45) DEFAULT NULL,
  `SubComments` varchar(45) DEFAULT NULL,
  `SubHearingImpaired` varchar(45) DEFAULT NULL,
  `UserRank` varchar(45) DEFAULT NULL,
  `SeriesSeason` int(11) DEFAULT NULL,
  `SeriesEpisode` int(11) DEFAULT NULL,
  `MovieKind` varchar(45) DEFAULT NULL,
  `QueryNumber` varchar(45) DEFAULT NULL,
  `SubDownloadLink` varchar(255) DEFAULT NULL,
  `ZipDownloadLink` varchar(255) DEFAULT NULL,
  `SubtitlesLink` varchar(255) DEFAULT NULL,
  `Id_user` varchar(128) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_open_subtitle_user1` (`Id_user`),
  CONSTRAINT `fk_open_subtitle_user1` FOREIGN KEY (`Id_user`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `open_subtitle`
--

LOCK TABLES `open_subtitle` WRITE;
/*!40000 ALTER TABLE `open_subtitle` DISABLE KEYS */;
/*!40000 ALTER TABLE `open_subtitle` ENABLE KEYS */;
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
  `url_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parental_control`
--

LOCK TABLES `parental_control` WRITE;
/*!40000 ALTER TABLE `parental_control` DISABLE KEYS */;
INSERT INTO `parental_control` VALUES (1,0,'Unrated','mpaa_logo.gif'),(2,1,'G','g-rating.gif'),(3,2,'G','g-rating.gif'),(4,3,'PG','pg-rating.gif'),(5,4,'PG-13','pg13-rating.gif'),(6,5,'PG-13','pg13-rating.gif'),(7,6,'R','r-rating.gif'),(8,7,'NC-17','nc17-rating.gif'),(9,8,'XXX','mpaa_logo.gif');
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
) ENGINE=InnoDB AUTO_INCREMENT=1692 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reseller`
--

DROP TABLE IF EXISTS `reseller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reseller` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reseller`
--

LOCK TABLES `reseller` WRITE;
/*!40000 ALTER TABLE `reseller` DISABLE KEYS */;
INSERT INTO `reseller` VALUES (1,'Venezuela');
/*!40000 ALTER TABLE `reseller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource_type`
--

DROP TABLE IF EXISTS `resource_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resource_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
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
-- Table structure for table `ripped_customer`
--

DROP TABLE IF EXISTS `ripped_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ripped_customer` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ripped_date` timestamp NULL DEFAULT NULL,
  `Id_device` varchar(45) NOT NULL,
  `Id_my_movie_disc` varchar(200) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_ripped_customer_my_movie_disc1` (`Id_my_movie_disc`),
  CONSTRAINT `fk_ripped_customer_my_movie_disc1` FOREIGN KEY (`Id_my_movie_disc`) REFERENCES `my_movie_disc` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ripped_customer`
--

LOCK TABLES `ripped_customer` WRITE;
/*!40000 ALTER TABLE `ripped_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `ripped_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `Id` int(11) NOT NULL,
  `path_anydvd_download` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,'./downloads/');
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
  `Id_device` varchar(45) NOT NULL,
  `drive_letter` varchar(45) DEFAULT NULL,
  `temp_folder_ripping` varchar(256) DEFAULT NULL,
  `final_folder_ripping` varchar(256) DEFAULT NULL,
  `time_from_reboot` time DEFAULT NULL,
  `time_to_reboot` time DEFAULT NULL,
  `mymovies_username` varchar(45) DEFAULT NULL,
  `mymovies_password` varchar(45) DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_settings_ripper_device1` (`Id_device`),
  CONSTRAINT `fk_settings_ripper_device1` FOREIGN KEY (`Id_device`) REFERENCES `device` (`Id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings_ripper`
--

LOCK TABLES `settings_ripper` WRITE;
/*!40000 ALTER TABLE `settings_ripper` DISABLE KEYS */;
INSERT INTO `settings_ripper` VALUES (1,'50ed8335ae2ef','E','C:/ripper/','C:/ripper/','01:00:00','12:00:00','rdsmart','SmartLiving01','2012-11-15 14:44:04');
/*!40000 ALTER TABLE `settings_ripper` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subtitle`
--

LOCK TABLES `subtitle` WRITE;
/*!40000 ALTER TABLE `subtitle` DISABLE KEYS */;
INSERT INTO `subtitle` VALUES (1,'English'),(2,'French'),(3,'Portuguese'),(4,'Spanish'),(5,'ssss'),(6,'BrazilianPortuguese'),(11,'German'),(12,'Italian'),(13,'Mandarin'),(14,'Japanese'),(15,'Korean'),(16,'Swedish'),(17,'Danish'),(18,'Finnish'),(19,'Dutch'),(20,'Norwegian');
/*!40000 ALTER TABLE `subtitle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_type`
--

DROP TABLE IF EXISTS `transaction_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_type`
--

LOCK TABLES `transaction_type` WRITE;
/*!40000 ALTER TABLE `transaction_type` DISABLE KEYS */;
INSERT INTO `transaction_type` VALUES (1,'Debit'),(2,'Credit');
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
  `Id_reseller` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `fk_user_reseller1` (`Id_reseller`),
  CONSTRAINT `fk_user_reseller1` FOREIGN KEY (`Id_reseller`) REFERENCES `reseller` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('admin','admin','a@b.com',NULL),('coco','coco','aa@a.coma',1);
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

-- Dump completed on 2013-08-15 10:41:48
