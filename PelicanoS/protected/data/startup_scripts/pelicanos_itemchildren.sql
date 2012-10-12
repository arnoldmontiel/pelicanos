CREATE DATABASE  IF NOT EXISTS `pelicanos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pelicanos`;
-- MySQL dump 10.13  Distrib 5.5.15, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: pelicanos
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
INSERT INTO `itemchildren` VALUES ('Administrator','CustomerManage'),('Administrator','NzbManage'),('Administrator','ResellerManage'),('Administrator','SerieManage'),('Administrator','UserManage'),('CustomerManage','CustomerSummary'),('CustomerManage','CustomerSummaryNzb'),('CustomerManage','CustomerSummaryRipped'),('CustomerManage','CustomerViewSummaryRipped'),('CustomerManageOp','CustomerAdmin'),('CustomerManageOp','CustomerCreate'),('CustomerManageOp','CustomerCustomerMovies'),('CustomerManageOp','CustomerCustomerTransaction'),('CustomerManageOp','CustomerIndex'),('CustomerManageOp','CustomerIndexRipped'),('CustomerManageOp','CustomerUpdate'),('CustomerManageOp','CustomerUsersUpdate'),('CustomerManageOp','CustomerView'),('CustomerManageOp','CustomerViewRipped'),('MovieManageOp','NzbIndexEpisodeReseller'),('MovieManageOp','NzbIndexReseller'),('MovieManageOp','NzbViewEpisodeReseller'),('MovieManageOp','NzbViewReseller'),('NzbManage','NzbAdmin'),('NzbManage','NzbCreate'),('NzbManage','NzbCreateEpisode'),('NzbManage','NzbCreateMovie'),('NzbManage','NzbDelete'),('NzbManage','NzbFindSubtitle'),('NzbManage','NzbIndex'),('NzbManage','NzbIndexEpisode'),('NzbManage','NzbUpdate'),('NzbManage','NzbUploadSubtitle'),('NzbManage','NzbView'),('NzbManage','NzbViewEpisode'),('Operator','CustomerManageOp'),('Operator','MovieManageOp'),('Operator','SerieManageOp'),('Operator','UserManageOp'),('ResellerManage','ResellerAdmin'),('ResellerManage','ResellerCreate'),('ResellerManage','ResellerIndex'),('ResellerManage','ResellerUpdate'),('ResellerManage','ResellerView'),('SerieManage','ImdbdataTvIndex'),('SerieManage','ImdbdataTvSetSeason'),('SerieManage','ImdbdataTvView'),('SerieManage','ImdbdataTvViewSeason'),('SerieManageOp','ImdbdataTvIndexReseller'),('SerieManageOp','ImdbdataTvViewReseller'),('SerieManageOp','ImdbdataTvViewSeasonReseller'),('UserManage','UserSummary'),('UserManage','UserSummaryUpdate'),('UserManageOp','UserAdmin'),('UserManageOp','UserCreate'),('UserManageOp','UserDelete'),('UserManageOp','UserIndex'),('UserManageOp','UserUpdate'),('UserManageOp','UserView');
/*!40000 ALTER TABLE `itemchildren` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-10-12 15:08:49
