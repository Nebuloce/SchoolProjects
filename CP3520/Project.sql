-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: Project
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

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
-- Table structure for table `Contracts`
--

DROP TABLE IF EXISTS `Contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Contracts` (
  `Supervisor` varchar(32) DEFAULT NULL,
  `PCN` varchar(32) NOT NULL,
  `PName` varchar(32) NOT NULL,
  `StartD` date DEFAULT NULL,
  `EndD` date DEFAULT NULL,
  PRIMARY KEY (`PName`,`PCN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contracts`
--

LOCK TABLES `Contracts` WRITE;
/*!40000 ALTER TABLE `Contracts` DISABLE KEYS */;
INSERT INTO `Contracts` VALUES ('Paul','Globacure','Happys','2001-01-16','2001-01-20'),('Steve','Venarue','Happys','2017-10-30','2017-11-30'),('Billy','Globacure','Lewtons','2001-01-16','2001-01-18'),('Rick','Frankl','Sappers','2001-02-16','2011-01-20'),('Cindy','Globacure','Sappers','2001-01-17','2001-01-20'),('Franklin','Venarue','Sappers','2017-11-27','2019-11-27');
/*!40000 ALTER TABLE `Contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Doctors`
--

DROP TABLE IF EXISTS `Doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Doctors` (
  `Name` varchar(32) DEFAULT NULL,
  `SIN` varchar(12) NOT NULL,
  `YExp` int(11) DEFAULT NULL,
  `Specialty` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`SIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Doctors`
--

LOCK TABLES `Doctors` WRITE;
/*!40000 ALTER TABLE `Doctors` DISABLE KEYS */;
INSERT INTO `Doctors` VALUES ('Ben Carson','456825941',12,'Otolaryngology'),('Liara TSoni','754689357',34,'Oncologist'),('Jim Jones','874695324',21,'Proctologist');
/*!40000 ALTER TABLE `Doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Drugs`
--

DROP TABLE IF EXISTS `Drugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Drugs` (
  `TName` varchar(32) NOT NULL,
  `Formula` varchar(32) NOT NULL,
  PRIMARY KEY (`Formula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Drugs`
--

LOCK TABLES `Drugs` WRITE;
/*!40000 ALTER TABLE `Drugs` DISABLE KEYS */;
INSERT INTO `Drugs` VALUES ('Avlin','BiSodium Carbonate'),('Canara','Carbonite Adamntite'),('Tardis','DiCarbon Flouride'),('Desaprin','MonoHydrogen DiOxide'),('Oxynotine','Oxide Perchlorate');
/*!40000 ALTER TABLE `Drugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Dusers`
--

DROP TABLE IF EXISTS `Dusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Dusers` (
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Dusers`
--

LOCK TABLES `Dusers` WRITE;
/*!40000 ALTER TABLE `Dusers` DISABLE KEYS */;
INSERT INTO `Dusers` VALUES ('Jones','ee7e4705dd4ac06adfe650c2cdc39bdd'),('TSoni','f3c8c16d390c39e0d25b7e1076d2bd08'),('Carson','b42b26a4fe27d81af37d52b9c4f6ba71');
/*!40000 ALTER TABLE `Dusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Makes`
--

DROP TABLE IF EXISTS `Makes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Makes` (
  `DTN` varchar(32) NOT NULL,
  `PCN` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`DTN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Makes`
--

LOCK TABLES `Makes` WRITE;
/*!40000 ALTER TABLE `Makes` DISABLE KEYS */;
INSERT INTO `Makes` VALUES ('Avlin','Globacure'),('Canara','Venarue'),('Desaprin','Globacure'),('Oxynotine','Frankl'),('Tardis','Venarue');
/*!40000 ALTER TABLE `Makes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PCusers`
--

DROP TABLE IF EXISTS `PCusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PCusers` (
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PCusers`
--

LOCK TABLES `PCusers` WRITE;
/*!40000 ALTER TABLE `PCusers` DISABLE KEYS */;
INSERT INTO `PCusers` VALUES ('Venarue','29107fb3e909f71e2aeb6d78be71de1b'),('Frankl','ff9387efc3c4f931e364486766584bda'),('Globacure','e53859934112e281439596af91042b2e');
/*!40000 ALTER TABLE `PCusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PHusers`
--

DROP TABLE IF EXISTS `PHusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PHusers` (
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PHusers`
--

LOCK TABLES `PHusers` WRITE;
/*!40000 ALTER TABLE `PHusers` DISABLE KEYS */;
INSERT INTO `PHusers` VALUES ('Lewtons','d3fe6bcc63fc352ecc267457f357b0be'),('Sappers','41d86e8a1cc8856a2f753c99451ba648'),('Happys','ceadf0ed870de83385528d36c97b898b');
/*!40000 ALTER TABLE `PHusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Patients`
--

DROP TABLE IF EXISTS `Patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Patients` (
  `Name` varchar(32) DEFAULT NULL,
  `SIN` varchar(12) NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Address` varchar(32) DEFAULT NULL,
  `Physician` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`SIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Patients`
--

LOCK TABLES `Patients` WRITE;
/*!40000 ALTER TABLE `Patients` DISABLE KEYS */;
INSERT INTO `Patients` VALUES ('Adam Driver','154367589',23,'1 Ridge Road','Jim Jones'),('Clark Kent','15478249',121,'1 Krypton Place','Jim Jones'),('Olivia Percy','622114883',25,'8 Street Avenue','Ben Carson'),('Lucy Murin','743689521',35,'121 Road Place','Liara TSoni'),('Andrew Mar','951753258',72,'12 Mire Place','Jim Jones'),('Steve Noble','963236252',25,'31 Street Avenue','Ben Carson');
/*!40000 ALTER TABLE `Patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pharmaceutical`
--

DROP TABLE IF EXISTS `Pharmaceutical`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pharmaceutical` (
  `Name` varchar(32) NOT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pharmaceutical`
--

LOCK TABLES `Pharmaceutical` WRITE;
/*!40000 ALTER TABLE `Pharmaceutical` DISABLE KEYS */;
INSERT INTO `Pharmaceutical` VALUES ('Frankl','905-552-9866'),('Globacure','894-364-8975'),('Venarue','709-458-9952');
/*!40000 ALTER TABLE `Pharmaceutical` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pharmacy`
--

DROP TABLE IF EXISTS `Pharmacy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pharmacy` (
  `Name` varchar(32) DEFAULT NULL,
  `Address` varchar(32) NOT NULL,
  `Phone` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`Address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pharmacy`
--

LOCK TABLES `Pharmacy` WRITE;
/*!40000 ALTER TABLE `Pharmacy` DISABLE KEYS */;
INSERT INTO `Pharmacy` VALUES ('Sappers','1 Garland Street','709-747-1248'),('Happys','18 Water Street','709-368-5289'),('Lewtons','89 Empire Avenue','709-364-5248');
/*!40000 ALTER TABLE `Pharmacy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Prescriptions`
--

DROP TABLE IF EXISTS `Prescriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Prescriptions` (
  `DTN` varchar(32) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `PSIN` varchar(12) NOT NULL,
  `DSIN` varchar(12) NOT NULL,
  `Date` date NOT NULL,
  `Filled` varchar(6) NOT NULL DEFAULT 'No',
  PRIMARY KEY (`DTN`,`Date`,`PSIN`,`DSIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Prescriptions`
--

LOCK TABLES `Prescriptions` WRITE;
/*!40000 ALTER TABLE `Prescriptions` DISABLE KEYS */;
INSERT INTO `Prescriptions` VALUES ('Avlin',35,'743689521','754689357','2001-01-17','No'),('Avlin',125,'154367589','874695324','2017-11-29','No'),('Avlin',35,'154367589','874695324','2018-11-17','No'),('Avlin',35,'154367589','874695324','2018-11-27','No'),('Avlin',39,'622114883','456825941','2031-12-16','No'),('Canara',125,'951753258','874695324','2017-11-28','No'),('Canara',12,'743689521','754689357','2017-11-30','No'),('Canara',18,'154367589','874695324','2018-11-17','No'),('Canara',19,'743689521','754689357','2030-05-17','No'),('Desaprin',4,'963236252','456825941','2012-10-17','No'),('Desaprin',12,'154367589','874695324','2017-12-17','No'),('Oxynotine',125,'154367589','874695324','2018-11-17','No');
/*!40000 ALTER TABLE `Prescriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pusers`
--

DROP TABLE IF EXISTS `Pusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pusers` (
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pusers`
--

LOCK TABLES `Pusers` WRITE;
/*!40000 ALTER TABLE `Pusers` DISABLE KEYS */;
INSERT INTO `Pusers` VALUES ('Adam','1d7c2923c1684726dc23d2901c4d8157'),('Nicole','fc63f87c08d505264caba37514cd0cfd'),('Blake','3aa49ec6bfc910647fa1c5a013e48eef'),('Amanda','6209804952225ab3d14348307b5a4a27');
/*!40000 ALTER TABLE `Pusers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sells`
--

DROP TABLE IF EXISTS `Sells`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sells` (
  `Price` varchar(32) DEFAULT NULL,
  `PName` varchar(32) NOT NULL,
  `DTN` varchar(32) NOT NULL,
  PRIMARY KEY (`PName`,`DTN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sells`
--

LOCK TABLES `Sells` WRITE;
/*!40000 ALTER TABLE `Sells` DISABLE KEYS */;
INSERT INTO `Sells` VALUES ('$19.00','Happys','Avlin'),('$82.00','Happys','Desaprin'),('$130.00','Lewtons','Avlin'),('$17.00','Lewtons','Canara'),('$12.00','Lewtons','Desaprin'),('$212.00','Sappers','Avlin'),('$15.00','Sappers','Canara'),('$86.00','Sappers','Desaprin'),('$11.00','Sappers','Oxynotine');
/*!40000 ALTER TABLE `Sells` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-05 10:04:48
