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
-- Table structure for table `tb_donativo_oferta`
--

DROP TABLE IF EXISTS `tb_donativo_oferta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_donativo_oferta` (
  `id` int(11) NOT NULL,
  `id_instituicao` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `dt_inclusao` datetime NOT NULL,
  `dt_finalizacao` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `id_msg` int(11) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `quant_dnv` int(11) DEFAULT NULL,
  `descricao_dnv` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_oferta_instituicao_idx` (`id_instituicao`),
  KEY `fk_oferta_pessoa_idx` (`id_pessoa`),
  KEY `fk_oferta_mensagem_idx` (`id_msg`),
  KEY `fk_oferta_status_idx` (`status`),
  CONSTRAINT `fk_oferta_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `tb_instbenef` (`id_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_oferta_mensagem` FOREIGN KEY (`id_msg`) REFERENCES `tb_mensagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_oferta_pessoa` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_oferta_status` FOREIGN KEY (`status`) REFERENCES `tb_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_donativo_oferta`
--

LOCK TABLES `tb_donativo_oferta` WRITE;
/*!40000 ALTER TABLE `tb_donativo_oferta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_donativo_oferta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_mensagem`
--

DROP TABLE IF EXISTS `tb_mensagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_mensagem` (
  `id` int(11) NOT NULL,
  `dt_envio` datetime NOT NULL,
  `mensagem` varchar(500) DEFAULT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id_instituicao` int(11) NOT NULL,
  `id_donativo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mensagem_instituicao_idx` (`id_instituicao`),
  KEY `fk_mensagem_pessoa_idx` (`id_pessoa`),
  KEY `fk_mensagem_donativo_idx` (`id_donativo`),
  CONSTRAINT `fk_mensagem_donativo` FOREIGN KEY (`id_donativo`) REFERENCES `tb_donativo` (`id_dnv`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensagem_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `tb_instbenef` (`id_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensagem_pessoa` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_mensagem`
--

LOCK TABLES `tb_mensagem` WRITE;
/*!40000 ALTER TABLE `tb_mensagem` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_mensagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_transacao`
--

DROP TABLE IF EXISTS `tb_transacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_transacao` (
  `id_transacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_donativo` int(11) NOT NULL,
  `quantidade_oferecida` int(11) NOT NULL,
  `dt_transacao` datetime NOT NULL DEFAULT '1960-01-01 00:00:00',
  `dt_expiracao` datetime DEFAULT '1960-01-01 00:00:00',
  `dt_finalizacao` datetime DEFAULT '1960-01-01 00:00:00',
  `id_instituicao` int(11) NOT NULL,
  `id_pessoa` int(11) DEFAULT NULL,
  `id_mensagem` int(11) NOT NULL,
  PRIMARY KEY (`id_transacao`),
  KEY `transacao_donativo_idx` (`id_donativo`),
  KEY `transacao_instituicao_idx` (`id_instituicao`),
  KEY `transacao_pessoa_idx` (`id_pessoa`),
  KEY `fk_transcao_mensagem_idx` (`id_mensagem`),
  CONSTRAINT `fk_transcao_mensagem` FOREIGN KEY (`id_mensagem`) REFERENCES `tb_mensagem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transacao_donativo` FOREIGN KEY (`id_donativo`) REFERENCES `tb_donativo` (`id_dnv`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transacao_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `tb_instbenef` (`id_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transacao_pessoa` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_transacao`
--

LOCK TABLES `tb_transacao` WRITE;
/*!40000 ALTER TABLE `tb_transacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_transacao` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-13 11:57:57
