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
  `foto` varchar(120) DEFAULT '/img/data/sem-foto.jpg',
  `tel_fixo` varchar(13) DEFAULT NULL,
  `tel_cel` varchar(13) DEFAULT NULL,
  `id_endereco` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id_idx` (`id_usuario`),
  KEY `fk_endereco_idx` (`id_endereco`),
  CONSTRAINT `fk_endereco_pessoa` FOREIGN KEY (`id_endereco`) REFERENCES `tb_enderecos` (`id_enderecos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas`
--

LOCK TABLES `pessoas` WRITE;
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;
INSERT INTO `pessoas` VALUES (1,'Albo Borges Vieira','1989-12-26','m','2015-04-26','albovieira@gmail.com',1,'/img/data/albo.jpg','','',1),(2,'albere','2012-01-01','m',NULL,'dsdadasd@alber.com',6,'/img/data/sem-foto.jpg','','',NULL),(3,'Juliano Silva','1992-02-01','m','2015-05-24','juliano@teste.com.br',8,'/img/data/sem-foto.jpg',NULL,NULL,NULL),(4,'joao','1997-02-01','m','2015-05-24','joao@teste.com.br',10,'/img/data/sem-foto.jpg',NULL,NULL,NULL),(5,'Teste Silva','1992-01-01','f','2015-05-25','teste@teste.com.br',11,'/img/data/sem-foto.jpg',NULL,NULL,NULL),(6,'Teste','1992-01-01','f','2015-05-27','teste@teste.com.br',17,'/img/data/sem-foto.jpg',NULL,NULL,NULL);
/*!40000 ALTER TABLE `pessoas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_enderecos`
--

DROP TABLE IF EXISTS `tb_enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_enderecos` (
  `logradouro_endereco` varchar(100) NOT NULL,
  `numero_endereco` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `id_enderecos` int(11) NOT NULL AUTO_INCREMENT,
  `cep` varchar(10) NOT NULL,
  `complemento_endereco` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_enderecos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_enderecos`
--

LOCK TABLES `tb_enderecos` WRITE;
/*!40000 ALTER TABLE `tb_enderecos` DISABLE KEYS */;
INSERT INTO `tb_enderecos` VALUES ('Rua Anna Maria de Jesus',104,'Guarani','Belo Horizonte','UF',1,'31814710',NULL);
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
  `foto` varchar(100) DEFAULT '/img/data/sem-foto.jpg',
  `data_cadastro` datetime NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `foto_local1` varchar(100) DEFAULT NULL,
  `foto_local2` varchar(100) DEFAULT NULL,
  `foto_local3` varchar(100) DEFAULT NULL,
  `foto_local4` varchar(100) DEFAULT NULL,
  `id_endereco` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_instituicao`),
  KEY `fk_tb_instbenef_usuarios1_idx` (`usuarios_id`),
  KEY `fk_endereco_idx` (`id_endereco`),
  CONSTRAINT `fk_endereco` FOREIGN KEY (`id_endereco`) REFERENCES `tb_enderecos` (`id_enderecos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_userid` FOREIGN KEY (`usuarios_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_instbenef`
--

LOCK TABLES `tb_instbenef` WRITE;
/*!40000 ALTER TABLE `tb_instbenef` DISABLE KEYS */;
INSERT INTO `tb_instbenef` VALUES (1,'1234560001','Sao Joao','Sao joao','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque odio nisi, aliquet mattis turpis ut, euismod pellentesque tortor. Sed sit amet commodo felis, ac vulputate quam. Nullam scelerisque, purus vel posuere condimentum, lacus arcu convallis ante, eu fringilla sapien massa sed massa. Integer eget mauris eu risus lobortis placerat a hendrerit orci. Vivamus convallis laoreet est, sit amet posuere','saojoao@gmail.com','saojoao.com.br','/img/data/sem-foto.jpg','0000-00-00 00:00:00',2,NULL,NULL,NULL,NULL,NULL),(2,'1223130001','Apae','Apae','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque odio nisi, aliquet mattis turpis ut, euismod pellentesque tortor. Sed sit amet commodo felis, ac vulputate quam. Nullam scelerisque, purus vel posuere condimentum, lacus arcu convallis ante, eu fringilla sapien massa sed massa. Integer eget mauris eu risus lobortis placerat a hendrerit orci. Vivamus convallis laoreet est, sit amet posuere libero condimentum sed. Nunc sodales nulla felis, eget semper elit tempus nec. Vestibulum pret','apae@gmail.com','http://apae.com.br','/img/data/instituicoes/apae-de-guaira-sp.gif','2015-04-27 00:00:00',3,'/img/data/instituicoes/instituicoes-local/foto1.jpg','/img/data/instituicoes/instituicoes-local/foto2.png','/img/data/instituicoes/instituicoes-local/foto3.jpg','/img/data/instituicoes/instituicoes-local/foto4.jpg',NULL),(3,'','','Instituicao','Cras fermentum lectus nunc, vel aliquet lectus aliquam sit amet. Aliquam feugiat sem eu orci auctor, nec suscipit enim porttitor. Morbi sed mauris eget turpis sollicitudin congue. Curabitur accumsan orci non est facilisis, vel laoreet dolor pulvinar. Donec sed ullamcorper neque. Pellentesque molestie pellentesque nisl vitae sollicitudin. Proin sem mi, auctor non felis vel, accumsan posuere eros. Nunc ac fermentum orci. Quisque ultricies arcu bibendum metus pulvinar ultrices. Aenean vitae tellus ','instituicao@gmail.com','instituicao.com.br','/img/data/sem-foto.jpg','2015-04-27 00:00:00',4,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tb_instbenef` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-04 19:50:10
