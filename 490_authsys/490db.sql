-- MySQL dump 10.13  Distrib 5.7.25, for Linux (i686)
--
-- Host: localhost    Database: 490db
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `api`
--

DROP TABLE IF EXISTS `api`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `api` (
  `event_key` varchar(255) DEFAULT NULL,
  `event_date` varchar(255) DEFAULT NULL,
  `event_time` varchar(255) DEFAULT NULL,
  `event_home_team` varchar(255) DEFAULT NULL,
  `event_away_team` varchar(255) DEFAULT NULL,
  `event_final_result` varchar(255) DEFAULT NULL,
  `event_status` varchar(255) DEFAULT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `league_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api`
--

LOCK TABLES `api` WRITE;
/*!40000 ALTER TABLE `api` DISABLE KEYS */;
INSERT INTO `api` VALUES ('167631','2019-01-19','18:30','Arsenal','Chelsea','2 - 0','Finished','ENGLAND','Premier League'),('114836','2018-08-18','18:30','Chelsea','Arsenal','3 - 2','Finished','ENGLAND','Premier League'),('70876','2018-01-24','21:00','Arsenal','Chelsea','2 - 1','Finished','ENGLAND','Carabao Cup'),('68621','2018-01-10','21:00','Chelsea','Arsenal','0 - 0','Finished','ENGLAND','Carabao Cup'),('68013','2018-01-03','20:45','Arsenal','Chelsea','2 - 2','Finished','ENGLAND','Premier League'),('13324','2017-09-17','14:30','Chelsea','Arsenal','0 : 0','Finished','ENGLAND','Premier League');
/*!40000 ALTER TABLE `api` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bethistory`
--

DROP TABLE IF EXISTS `bethistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bethistory` (
  `id` int(11) DEFAULT NULL,
  `event_key` varchar(255) DEFAULT NULL,
  `event_status` varchar(255) DEFAULT NULL,
  `event_final_result` varchar(255) DEFAULT NULL,
  `teambeton` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `homeoraway` varchar(255) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `bethistory_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bethistory`
--

LOCK TABLES `bethistory` WRITE;
/*!40000 ALTER TABLE `bethistory` DISABLE KEYS */;
INSERT INTO `bethistory` VALUES (1,'167631 ','Finished','2 - 0','Arsenal',5,'Home'),(1,'114836','Finished','3 - 2','Arsenal',5,'Away');
/*!40000 ALTER TABLE `bethistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'andre','password','andre@njit.edu'),(2,'test','test','test@njit.edu'),(3,'test2','test2','test2@njit.edu'),(4,'test3','test3','test3t@test.com'),(5,'test4','test4','test4@test.com'),(6,'andre5','password','andre5@blah.com'),(7,'andre6','password','andre6@blah.com'),(8,'doritos','doritos','doritos@gmail.com'),(9,'doritos2','','doritos2@gmail.com'),(10,'doritos3','doritos','doritos3@gmail.com'),(11,'doritos4','password','doritos4@gmail.com'),(12,'doritos5','doritos','doritos5@gmail.com'),(13,'doritos6','doritos','doritos6@gmail.com'),(14,'doritos7','doritos','doritos7@gmail.com'),(15,'doritos8','password','doritos8@gmail.com'),(16,'doritos9','password','doritos9@gmail.com'),(17,'cheetos','cheetos','cheetos@njit.com'),(18,'realdude','password','realaf@njit.edu'),(19,'realdude2','password','realaf2@njit.edu'),(20,'realdude5','password','real5'),(21,'realdude6','password','real6'),(22,'realdude7','password','real7'),(23,'realdude8','password','real8'),(24,'realdude9','password','real9'),(25,'blah1','password','blah1'),(26,'blah2','password','blah2'),(27,'blah3','password','blah3'),(28,'BLAH7','password','BLAH7'),(29,'andre2','password','andre2'),(30,'andre3','password','andre3'),(32,'bob1','bob','bob'),(33,'yo','password','yo'),(34,'doritos10','password','doritos10'),(35,'doritos11','password','11'),(36,'layschips','password','layschips'),(37,'snickers','password','snickers@gmail.com'),(38,'e','e','e'),(39,'salad','password','salad@gmail.com'),(40,'dog','password','dog@njit.edu'),(41,'cat','password','cat@gmail.com'),(42,'hat','password','hat');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stats`
--

DROP TABLE IF EXISTS `stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stats` (
  `id` int(11) DEFAULT NULL,
  `event_key` varchar(255) DEFAULT NULL,
  `win` int(11) DEFAULT NULL,
  `loss` int(11) DEFAULT NULL,
  `ratio` int(11) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `stats_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stats`
--

LOCK TABLES `stats` WRITE;
/*!40000 ALTER TABLE `stats` DISABLE KEYS */;
INSERT INTO `stats` VALUES (1,'114836',1,1,50);
/*!40000 ALTER TABLE `stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallet`
--

DROP TABLE IF EXISTS `wallet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallet` (
  `id` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallet`
--

LOCK TABLES `wallet` WRITE;
/*!40000 ALTER TABLE `wallet` DISABLE KEYS */;
INSERT INTO `wallet` VALUES (1,35),(23,100),(24,100),(25,100),(26,100),(27,100),(30,100),(32,100),(33,100),(34,100),(35,100),(36,100),(37,100),(38,95),(39,80),(40,100),(41,100),(42,100);
/*!40000 ALTER TABLE `wallet` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-29 20:46:05
