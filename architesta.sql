-- MySQL dump 10.13  Distrib 9.3.0, for macos14.7 (x86_64)
--
-- Host: localhost    Database: architesta
-- ------------------------------------------------------
-- Server version	9.3.0

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
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20250215105054','2025-03-31 17:03:35',21),('DoctrineMigrations\\Version20250225091614',NULL,NULL),('DoctrineMigrations\\Version20250225155912',NULL,NULL),('DoctrineMigrations\\Version20250225182836',NULL,NULL),('DoctrineMigrations\\Version20250331165156',NULL,NULL),('DoctrineMigrations\\Version20250331170511','2025-03-31 17:05:13',248),('DoctrineMigrations\\Version20250420092052','2025-04-20 09:21:22',100),('DoctrineMigrations\\Version20250420095349',NULL,NULL);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`),
  CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `testa_tuser` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_password_request`
--

LOCK TABLES `reset_password_request` WRITE;
/*!40000 ALTER TABLE `reset_password_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `reset_password_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testa_timagen`
--

DROP TABLE IF EXISTS `testa_timagen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_timagen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `des_imagen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testa_timagen`
--

LOCK TABLES `testa_timagen` WRITE;
/*!40000 ALTER TABLE `testa_timagen` DISABLE KEYS */;
/*!40000 ALTER TABLE `testa_timagen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testa_tnotario`
--

DROP TABLE IF EXISTS `testa_tnotario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_tnotario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `des_notario` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testa_tnotario`
--

LOCK TABLES `testa_tnotario` WRITE;
/*!40000 ALTER TABLE `testa_tnotario` DISABLE KEYS */;
/*!40000 ALTER TABLE `testa_tnotario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testa_toficio`
--

DROP TABLE IF EXISTS `testa_toficio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_toficio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `des_oficio` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testa_toficio`
--

LOCK TABLES `testa_toficio` WRITE;
/*!40000 ALTER TABLE `testa_toficio` DISABLE KEYS */;
/*!40000 ALTER TABLE `testa_toficio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testa_totorgante`
--

DROP TABLE IF EXISTS `testa_totorgante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_totorgante` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_oficio` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D19B56A51DA84AFB` (`id_oficio`),
  CONSTRAINT `FK_D19B56A51DA84AFB` FOREIGN KEY (`id_oficio`) REFERENCES `testa_toficio` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testa_totorgante`
--

LOCK TABLES `testa_totorgante` WRITE;
/*!40000 ALTER TABLE `testa_totorgante` DISABLE KEYS */;
/*!40000 ALTER TABLE `testa_totorgante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testa_totorgante_testa_ttestaotorgante`
--

DROP TABLE IF EXISTS `testa_totorgante_testa_ttestaotorgante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_totorgante_testa_ttestaotorgante` (
  `testa_totorgante_id` int NOT NULL,
  `testa_ttestaotorgante_id` int NOT NULL,
  PRIMARY KEY (`testa_totorgante_id`,`testa_ttestaotorgante_id`),
  KEY `IDX_AE8C0ADE32CEEA74` (`testa_totorgante_id`),
  KEY `IDX_AE8C0ADE59A61DFE` (`testa_ttestaotorgante_id`),
  CONSTRAINT `FK_AE8C0ADE32CEEA74` FOREIGN KEY (`testa_totorgante_id`) REFERENCES `testa_totorgante` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_AE8C0ADE59A61DFE` FOREIGN KEY (`testa_ttestaotorgante_id`) REFERENCES `testa_ttestaotorgante` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testa_totorgante_testa_ttestaotorgante`
--

LOCK TABLES `testa_totorgante_testa_ttestaotorgante` WRITE;
/*!40000 ALTER TABLE `testa_totorgante_testa_ttestaotorgante` DISABLE KEYS */;
/*!40000 ALTER TABLE `testa_totorgante_testa_ttestaotorgante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testa_tparentesco`
--

DROP TABLE IF EXISTS `testa_tparentesco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_tparentesco` (
  `id` int NOT NULL AUTO_INCREMENT,
  `des_parentesco` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testa_tparentesco`
--

LOCK TABLES `testa_tparentesco` WRITE;
/*!40000 ALTER TABLE `testa_tparentesco` DISABLE KEYS */;
/*!40000 ALTER TABLE `testa_tparentesco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testa_tpoblacion`
--

DROP TABLE IF EXISTS `testa_tpoblacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_tpoblacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `des_poblacion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testa_tpoblacion`
--

LOCK TABLES `testa_tpoblacion` WRITE;
/*!40000 ALTER TABLE `testa_tpoblacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `testa_tpoblacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testa_traw`
--

DROP TABLE IF EXISTS `testa_traw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_traw` (
  `id` int NOT NULL AUTO_INCREMENT,
  `classification_id` bigint NOT NULL,
  `year` int NOT NULL,
  `month` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `protocol_number` int NOT NULL,
  `folio_number` int NOT NULL,
  `second_grantor` tinyint(1) NOT NULL,
  `second_grantor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

--
-- Table structure for table `testa_ttestamento`
--

DROP TABLE IF EXISTS `testa_ttestamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_ttestamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_poblacion` int DEFAULT NULL,
  `id_notario` int DEFAULT NULL,
  `id_imagen` int DEFAULT NULL,
  `anno` smallint NOT NULL,
  `mes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia` smallint NOT NULL,
  `mancomunado` tinyint(1) NOT NULL,
  `textoilegible` tinyint(1) NOT NULL,
  `num_protocolo` int NOT NULL,
  `num_folio` int NOT NULL,
  `id_parentesco` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_393EEADA52E675E` (`id_imagen`),
  UNIQUE KEY `UNIQ_393EEAD3B94B0C1` (`id_parentesco`),
  KEY `IDX_393EEAD7EE3862E` (`id_poblacion`),
  KEY `IDX_393EEADD0553A49` (`id_notario`),
  CONSTRAINT `FK_393EEAD3B94B0C1` FOREIGN KEY (`id_parentesco`) REFERENCES `testa_tparentesco` (`id`),
  CONSTRAINT `FK_393EEAD7EE3862E` FOREIGN KEY (`id_poblacion`) REFERENCES `testa_tpoblacion` (`id`),
  CONSTRAINT `FK_393EEADA52E675E` FOREIGN KEY (`id_imagen`) REFERENCES `testa_timagen` (`id`),
  CONSTRAINT `FK_393EEADD0553A49` FOREIGN KEY (`id_notario`) REFERENCES `testa_tnotario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testa_ttestamento`
--

LOCK TABLES `testa_ttestamento` WRITE;
/*!40000 ALTER TABLE `testa_ttestamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `testa_ttestamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testa_ttestaotorgante`
--

DROP TABLE IF EXISTS `testa_ttestaotorgante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_ttestaotorgante` (
  `id` int NOT NULL AUTO_INCREMENT,
  `num_orden` smallint NOT NULL,
  `id_testamento` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_97BD8E3FEF4B25C0` (`id_testamento`),
  CONSTRAINT `FK_97BD8E3FEF4B25C0` FOREIGN KEY (`id_testamento`) REFERENCES `testa_ttestamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testa_ttestaotorgante`
--

LOCK TABLES `testa_ttestaotorgante` WRITE;
/*!40000 ALTER TABLE `testa_ttestaotorgante` DISABLE KEYS */;
/*!40000 ALTER TABLE `testa_ttestaotorgante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testa_ttestaotorgante_testa_totorgante`
--

DROP TABLE IF EXISTS `testa_ttestaotorgante_testa_totorgante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_ttestaotorgante_testa_totorgante` (
  `testa_ttestaotorgante_id` int NOT NULL,
  `testa_totorgante_id` int NOT NULL,
  PRIMARY KEY (`testa_ttestaotorgante_id`,`testa_totorgante_id`),
  KEY `IDX_577FA3459A61DFE` (`testa_ttestaotorgante_id`),
  KEY `IDX_577FA3432CEEA74` (`testa_totorgante_id`),
  CONSTRAINT `FK_577FA3432CEEA74` FOREIGN KEY (`testa_totorgante_id`) REFERENCES `testa_totorgante` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_577FA3459A61DFE` FOREIGN KEY (`testa_ttestaotorgante_id`) REFERENCES `testa_ttestaotorgante` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testa_ttestaotorgante_testa_totorgante`
--

LOCK TABLES `testa_ttestaotorgante_testa_totorgante` WRITE;
/*!40000 ALTER TABLE `testa_ttestaotorgante_testa_totorgante` DISABLE KEYS */;
/*!40000 ALTER TABLE `testa_ttestaotorgante_testa_totorgante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testa_tuser`
--

DROP TABLE IF EXISTS `testa_tuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testa_tuser` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testa_tuser`
--

LOCK TABLES `testa_tuser` WRITE;
/*!40000 ALTER TABLE `testa_tuser` DISABLE KEYS */;
/*!40000 ALTER TABLE `testa_tuser` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-20 13:04:06
