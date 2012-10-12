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
INSERT INTO `items` VALUES ('UserManage',1,'','','s:0:\"\";'),('ResellerAdmin',0,'','','s:0:\"\";'),('UserIndex',0,'','','s:0:\"\";'),('UserView',0,'','','s:0:\"\";'),('UserCreate',0,'','','s:0:\"\";'),('UserUpdate',0,'','','s:0:\"\";'),('UserAdmin',0,'','','s:0:\"\";'),('UserDelete',0,'','','s:0:\"\";'),('Authority',2,'','','s:0:\"\";'),('Administrator',2,'','','s:0:\"\";'),('ResellerManage',1,'','','s:0:\"\";'),('ResellerIndex',0,'','','s:0:\"\";'),('ResellerView',0,'','','s:0:\"\";'),('ResellerCreate',0,'','','s:0:\"\";'),('CustomerManage',1,'','','s:0:\"\";'),('CustomerSummary',0,'','','s:0:\"\";'),('CustomerManageOp',1,'','','s:0:\"\";'),('CustomerIndex',0,'','','s:0:\"\";'),('CustomerView',0,'','','s:0:\"\";'),('CustomerAdmin',0,'','','s:0:\"\";'),('CustomerIndexRipped',0,'','','s:0:\"\";'),('CustomerSummaryRipped',0,'','','s:0:\"\";'),('CustomerViewRipped',0,'','','s:0:\"\";'),('CustomerViewSummaryRipped',0,'','','s:0:\"\";'),('Operator',2,'','','s:0:\"\";'),('UserManageOp',1,'','','s:0:\"\";'),('UserSummary',0,'','','s:0:\"\";'),('UserSummaryUpdate',0,'','','s:0:\"\";'),('NzbManage',1,'','','s:0:\"\";'),('MovieManageOp',1,'','','s:0:\"\";'),('NzbIndexReseller',0,'','','s:0:\"\";'),('NzbViewReseller',0,'','','s:0:\"\";'),('NzbIndexEpisodeReseller',0,'','','s:0:\"\";'),('NzbViewEpisodeReseller',0,'','','s:0:\"\";'),('SerieManageOp',1,'','','s:0:\"\";'),('NzbCreate',0,'','','s:0:\"\";'),('SerieManage',1,'','','s:0:\"\";'),('ImdbdataTvIndexReseller',0,'','','s:0:\"\";'),('ImdbdataTvViewReseller',0,'','','s:0:\"\";'),('ImdbdataTvViewSeasonReseller',0,'','','s:0:\"\";'),('NzbIndex',0,'','','s:0:\"\";'),('NzbView',0,'','','s:0:\"\";'),('NzbAdmin',0,'','','s:0:\"\";'),('NzbIndexEpisode',0,'','','s:0:\"\";'),('NzbViewEpisode',0,'','','s:0:\"\";'),('NzbCreateMovie',0,'','','s:0:\"\";'),('NzbCreateEpisode',0,'','','s:0:\"\";'),('ImdbdataTvIndex',0,'','','s:0:\"\";'),('ImdbdataTvView',0,'','','s:0:\"\";'),('ImdbdataTvViewSeason',0,'','','s:0:\"\";'),('ImdbdataTvSetSeason',0,'','','s:0:\"\";'),('CustomerCreate',0,'','','s:0:\"\";'),('CustomerUpdate',0,'','','s:0:\"\";'),('CustomerUsersUpdate',0,'','','s:0:\"\";'),('NzbFindSubtitle',0,'','','s:0:\"\";'),('NzbUpdate',0,'','','s:0:\"\";'),('NzbUploadSubtitle',0,'','','s:0:\"\";'),('NzbDelete',0,'','','s:0:\"\";'),('ResellerUpdate',0,'','','s:0:\"\";'),('CustomerSummaryNzb',0,'','','s:0:\"\";'),('CustomerCustomerTransaction',0,'','','s:0:\"\";'),('CustomerCustomerMovies',0,'','','s:0:\"\";');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-10-12 15:08:51
