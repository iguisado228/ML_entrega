-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: markatzelengoaiak
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `entrega`
--

DROP TABLE IF EXISTS `entrega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entrega` (
  `izena` varchar(45) DEFAULT NULL,
  `mota` varchar(45) DEFAULT NULL,
  `prezioa` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrega`
--

LOCK TABLES `entrega` WRITE;
/*!40000 ALTER TABLE `entrega` DISABLE KEYS */;
INSERT INTO `entrega` VALUES ('Esnea','Edaria',1.2),('Ogia','Elikagaia',1.5),('Arrautza','Elikagaia',2.4),('Gazta','Elikagaia',3.8),('Ur Botila','Edaria',0.8),('Marrubiak','Fruta',2.9),('Sagarra','Fruta',1.1),('Mahatsak','Fruta',3.2),('Txokolatea','Gozoa',1.8),('Zukua','Edaria',2),('Olioa','Espeziak',6.9),('Azukrea','Elikagaia',1.4),('Artoa','Elikagaia',1.6),('Arroza','Elikagaia',2.1),('Pasta','Elikagaia',1.9),('Tea','Edaria',3),('Izozkia','Gozoa',2.5),('Patatak','Barazkia',1.7),('Letxuga','Barazkia',1.3),('Tomatea','Barazkia',2.2),('Piperra','Barazkia',1.9),('Zanahoria','Barazkia',1.5),('Babarruna','Barazkia',3),('Txorizoa','Haragia',4.2),('Oilaskoa','Haragia',5.5),('Txekorra','Haragia',7.9),('Arraina','Itsaskia',6.5),('Olagarroa','Itsaskia',8.7),('Gambak','Itsaskia',9.2);
/*!40000 ALTER TABLE `entrega` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-27 14:42:33
