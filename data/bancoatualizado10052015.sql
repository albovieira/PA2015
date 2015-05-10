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
-- Table structure for table `evento`
--

DROP TABLE IF EXISTS `evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evento` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `id_instituicao` int(11) NOT NULL,
  `desc_evento` varchar(400) NOT NULL,
  `site_evento` varchar(45) DEFAULT NULL,
  `objetivos` varchar(130) NOT NULL,
  `data_final` datetime NOT NULL,
  `data_inicio` datetime NOT NULL,
  `titulo_evento` varchar(45) NOT NULL,
  `imagem1` varchar(100) NOT NULL,
  `imagem2` varchar(100) DEFAULT NULL,
  `imagem3` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_evento`),
  KEY `fk_tbinst_idx` (`id_instituicao`),
  CONSTRAINT `fk_tbinst` FOREIGN KEY (`id_instituicao`) REFERENCES `tb_instbenef` (`id_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evento`
--

LOCK TABLES `evento` WRITE;
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` VALUES (1,1,'Aquisicao de novos brinquedos para as criancas','www.sitebrinquedos.com.br','Bonecos, Jogos','2015-05-20 00:00:00','2015-05-07 00:00:00','Fabrique um sorriso','/img/data/eventos/testedoa.jpg',NULL,NULL),(2,2,'Venha contar historias para nossas crianlas',NULL,'Livros, sua presença','2015-05-23 00:00:00','2015-05-03 00:00:00','Oferença um final feliz','/img/data/eventos/doe.jpg',NULL,NULL),(3,3,'Evento para aquisicao de novos casacos para as criancas',NULL,'Roupas, casacos','2015-05-23 00:00:00','2015-05-08 00:00:00','Contribua para um pressant mais feliz','/img/data/eventos/agasalho.jpg',NULL,NULL);
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;
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
INSERT INTO `perfil` VALUES (1,'Super'),(2,'Pessoa'),(3,'Instituicao'),(4,'Convidado');
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
  KEY `fk_user_id_idx` (`id_usuario`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas`
--

LOCK TABLES `pessoas` WRITE;
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;
INSERT INTO `pessoas` VALUES (1,'Albo Vieira','2015-04-26','M','2015-04-26','albovieira@gmail.com',1,'/img/semImagem.gif','','');
/*!40000 ALTER TABLE `pessoas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `qtd` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_categoria_donativo`
--

DROP TABLE IF EXISTS `tb_categoria_donativo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_categoria_donativo` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `desc_categoria` varchar(45) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_categoria_donativo`
--

LOCK TABLES `tb_categoria_donativo` WRITE;
/*!40000 ALTER TABLE `tb_categoria_donativo` DISABLE KEYS */;
INSERT INTO `tb_categoria_donativo` VALUES (1,'Saude');
/*!40000 ALTER TABLE `tb_categoria_donativo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_donativo`
--

DROP TABLE IF EXISTS `tb_donativo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_donativo` (
  `id_dnv` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_dnv` varchar(45) NOT NULL,
  `titulo_dnv` varchar(45) NOT NULL,
  `quant_dnv` int(11) NOT NULL,
  `dt_inclusao_dnv` datetime NOT NULL,
  `dt_desativacao_dnv` datetime NOT NULL DEFAULT '1960-01-01 00:00:00',
  `id_instituicao` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_dnv`,`quant_dnv`),
  KEY `instbene_solicitante_idx` (`id_instituicao`),
  KEY `donativo_categoria_idx` (`id_categoria`),
  CONSTRAINT `donativo_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria_donativo` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `instbene_solicitante` FOREIGN KEY (`id_instituicao`) REFERENCES `tb_instbenef` (`id_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_donativo`
--

LOCK TABLES `tb_donativo` WRITE;
/*!40000 ALTER TABLE `tb_donativo` DISABLE KEYS */;
INSERT INTO `tb_donativo` VALUES (1,'dasdas','dsadada',1,'2015-04-27 00:00:00','2015-04-27 00:00:00',1,1);
/*!40000 ALTER TABLE `tb_donativo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_enderecos`
--

DROP TABLE IF EXISTS `tb_enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_enderecos` (
  `id_instituicao` int(11) NOT NULL DEFAULT '0',
  `logradouro_endereco` varchar(100) NOT NULL,
  `numero_endereco` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `id_enderecos` int(11) NOT NULL AUTO_INCREMENT,
  `cep` varchar(10) NOT NULL,
  `complemento_endereco` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_enderecos`),
  KEY `endereco_instituicao_idx` (`id_instituicao`),
  CONSTRAINT `endereco_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `tb_instbenef` (`id_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_enderecos`
--

LOCK TABLES `tb_enderecos` WRITE;
/*!40000 ALTER TABLE `tb_enderecos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_instbenef`
--

DROP TABLE IF EXISTS `tb_instbenef`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_instbenef` (
  `id_instituicao` int(11) NOT NULL AUTO_INCREMENT,
  `cnpj` varchar(20) NOT NULL,
  `razao_social` varchar(100) NOT NULL,
  `nome_fantasia` varchar(100) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `site` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`id_instituicao`),
  KEY `fk_tb_instbenef_usuarios1_idx` (`usuarios_id`),
  CONSTRAINT `fk_userid` FOREIGN KEY (`usuarios_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_instbenef`
--

LOCK TABLES `tb_instbenef` WRITE;
/*!40000 ALTER TABLE `tb_instbenef` DISABLE KEYS */;
INSERT INTO `tb_instbenef` VALUES (1,'1234560001','Sao Joao','Sao joao','Instituicao de caridade muito legal','saojoao@gmail.com','saojoao.com.br',NULL,'0000-00-00 00:00:00',2),(2,'1223130001','Apae','Apae','Apae - Instituicao para deficientes mentais','apae@gmail.com','apae.com.br',NULL,'2015-04-27 00:00:00',3),(3,'','','Instituicao','E uma instituicao ai ','instituicao@gmail.com','instituicao.com.br',NULL,'2015-04-27 00:00:00',4);
/*!40000 ALTER TABLE `tb_instbenef` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_minhas_instituicoes`
--

DROP TABLE IF EXISTS `tb_minhas_instituicoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_minhas_instituicoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_instituicao` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pessoa_idx` (`id_pessoa`),
  KEY `fk_instituicao_idx` (`id_instituicao`),
  CONSTRAINT `fk_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `tb_instbenef` (`id_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pessoa` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_minhas_instituicoes`
--

LOCK TABLES `tb_minhas_instituicoes` WRITE;
/*!40000 ALTER TABLE `tb_minhas_instituicoes` DISABLE KEYS */;
INSERT INTO `tb_minhas_instituicoes` VALUES (52,1,1),(55,3,1);
/*!40000 ALTER TABLE `tb_minhas_instituicoes` ENABLE KEYS */;
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
  `dt_expiracao` datetime NOT NULL DEFAULT '1960-01-01 00:00:00',
  `dt_finalizacao` datetime NOT NULL DEFAULT '1960-01-01 00:00:00',
  `id_instituicao` int(11) NOT NULL,
  PRIMARY KEY (`id_transacao`),
  KEY `transacao_donativo_idx` (`id_donativo`),
  KEY `transacao_instituicao_idx` (`id_instituicao`),
  CONSTRAINT `transacao_donativo` FOREIGN KEY (`id_donativo`) REFERENCES `tb_donativo` (`id_dnv`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transacao_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `tb_instbenef` (`id_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_transacao`
--

LOCK TABLES `tb_transacao` WRITE;
/*!40000 ALTER TABLE `tb_transacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_transacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testeanexo`
--

DROP TABLE IF EXISTS `testeanexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testeanexo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testeanexo`
--

LOCK TABLES `testeanexo` WRITE;
/*!40000 ALTER TABLE `testeanexo` DISABLE KEYS */;
INSERT INTO `testeanexo` VALUES (1,'1463162_10201417004079500_1500034198_n.jpg'),(2,'Darth Vader, Star Wars, Mask.jpg'),(3,'Darth Vader, Star Wars, Mask.jpg'),(4,'Darth Vader, Star Wars, Mask.jpg');
/*!40000 ALTER TABLE `testeanexo` ENABLE KEYS */;
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
  `perfil` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_perfil_idx` (`perfil`),
  CONSTRAINT `fk_perfil` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'albovieira','albovieira@gmail.com','Albo Vieira','$2y$14$iXxrqJafzXGOfqJ5ZLjLWO9yb.bHJsJkdRsoakAX9YLarpZRehXqq',NULL,2),(2,'Sao João','saojoao@gmail.com','São Joao','$2y$14$QhRBXRPd7KDEwJ9cAtTJi.nJKCupGPDwVAevPvT6b1FbuZRuIymLq',0,3),(3,'Apae','apae@gmail.com','Apae MG','$2y$14$QhRBXRPd7KDEwJ9cAtTJi.nJKCupGPDwVAevPvT6b1FbuZRuIymLq',NULL,3),(4,'Instituicao','instituicao@gmail.com','Instituicao Mineira','$2y$14$QhRBXRPd7KDEwJ9cAtTJi.nJKCupGPDwVAevPvT6b1FbuZRuIymLq',NULL,3);
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-10 20:07:08
