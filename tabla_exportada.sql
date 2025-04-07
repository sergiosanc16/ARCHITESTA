-- MySQL dump 10.13  Distrib 9.2.0, for macos14.7 (x86_64)
--
-- Host: localhost    Database: architesta
-- ------------------------------------------------------
-- Server version	9.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `testa_traw`
--

DROP TABLE IF EXISTS `testa_traw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_traw` (
  `id` int NOT NULL AUTO_INCREMENT,
  `classification_id` bigint NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `year` int NOT NULL,
  `month` int NOT NULL,
  `day` int NOT NULL,
  `other_population` tinyint(1) NOT NULL,
  `population_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grantor_surname1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grator_surname2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grantor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_mentioned` tinyint(1) NOT NULL,
  `grantor_office` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relationship_mentioned` tinyint(1) NOT NULL,
  `grantor_relationship` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notary_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notary_surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `protocol_number` int NOT NULL,
  `folio_number` int NOT NULL,
  `second_grantor` tinyint(1) NOT NULL,
  `second_grantor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_grantor_surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `retired` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testa_traw`
--

LOCK TABLES `testa_traw` WRITE;
/*!40000 ALTER TABLE `testa_traw` DISABLE KEYS */;
/*!40000 ALTER TABLE `testa_traw` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-31 22:12:07
