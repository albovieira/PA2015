CREATE DATABASE  IF NOT EXISTS `doacao_sistema` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `doacao_sistema`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: doacao_sistema
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `instituicoes`
--

DROP TABLE IF EXISTS `instituicoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instituicoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razaosocial` varchar(45) NOT NULL,
  `cnpj` varchar(45) NOT NULL,
  `nomefant` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `datacad` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tel_fixo` varchar(13) DEFAULT NULL,
  `tel_cel` varchar(13) DEFAULT NULL,
  `desc` text NOT NULL,
  `site` varchar(100) DEFAULT NULL,
  `foto` varchar(300) DEFAULT 'webroot/img/fotos/fotos_instituicao/sem_foto.jpg',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `cnpj_UNIQUE` (`cnpj`),
  UNIQUE KEY `razaosocial_UNIQUE` (`razaosocial`),
  UNIQUE KEY `nomefant_UNIQUE` (`nomefant`),
  KEY `FK_instituicoes_usuarios_idx` (`id_usuario`),
  CONSTRAINT `FK_instituicoes_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instituicoes`
--

LOCK TABLES `instituicoes` WRITE;
/*!40000 ALTER TABLE `instituicoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `instituicoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `desc_perfil` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `data_nasc` date NOT NULL,
  `sexo` char(1) NOT NULL,
  `data_cad` date DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `foto` varchar(120) DEFAULT NULL,
  `tel_fixo` varchar(13) DEFAULT NULL,
  `tel_cel` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usuarios_usuarios_id_idx` (`id_usuario`),
  CONSTRAINT `fk_usuarios_id` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas`
--

LOCK TABLES `pessoas` WRITE;
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;
/*!40000 ALTER TABLE `pessoas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(5) unsigned DEFAULT NULL,
  `profile` varchar(120) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,NULL,'albovieira@gmail.com',NULL,'$2y$14$iXxrqJafzXGOfqJ5ZLjLWO9yb.bHJsJkdRsoakAX9YLarpZRehXqq',NULL,'');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_provider`
--

DROP TABLE IF EXISTS `user_provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_provider` (
  `user_id` int(11) NOT NULL,
  `provider_id` varchar(50) NOT NULL,
  `provider` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`,`provider_id`),
  UNIQUE KEY `provider_id` (`provider_id`,`provider`),
  CONSTRAINT `user_provider_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_provider`
--

LOCK TABLES `user_provider` WRITE;
/*!40000 ALTER TABLE `user_provider` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(12) NOT NULL,
  `perfil` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','admin@admin.com','admin',0,1,'Administrador'),(2,'iadmin','iadmin@admin.com','admin',1,1,'Instituicao Admin');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-22 18:47:29
