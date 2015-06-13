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
INSERT INTO `evento` VALUES (1,1,'Aquisicao de novos brinquedos para as criancas','www.sitebrinquedos.com.br','Bonecos, Jogos','2015-07-20 00:00:00','2015-05-07 00:00:00','Fabrique um sorriso','/img/data/eventos/testedoa.jpg',NULL,NULL),(2,2,'Venha contar historias para nossas criancasVenha contar historias para nossas criancasVenha contar historias para nossas criancasVenha contar historias para nossas criancasVenha contar historias para nossas criancasVenha contar historias para nossas criancasVenha contar historias para nossas criancasVenha contar historias para nossas criancasVenha contar historias para nossas criancasVenha contar ','apae.com.br/livros','Livros, sua presenca','2015-12-23 00:00:00','2015-05-03 00:00:00','Oferenca um final feliz','/img/data/eventos/eventosApae2/doe.jpg','/img/data/eventos/eventosApae2/evento1.jpg','/img/data/eventos/eventosApae2/apae.jpeg'),(3,3,'Evento para aquisicao de novos casacos para as criancas',NULL,'Roupas, casacos','2015-05-23 00:00:00','2015-05-08 00:00:00','Contribua para um pressant mais feliz','/img/data/eventos/agasalho.jpg',NULL,NULL);
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
  `foto` varchar(120) DEFAULT '/img/data/sem-foto.jpg',
  `tel_fixo` varchar(13) DEFAULT NULL,
  `tel_cel` varchar(13) DEFAULT NULL,
  `id_endereco` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id_idx` (`id_usuario`),
  KEY `fk_endereco_idx` (`id_endereco`),
  CONSTRAINT `fk_endereco_pessoa` FOREIGN KEY (`id_endereco`) REFERENCES `tb_enderecos` (`id_enderecos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_id` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoas`
--

LOCK TABLES `pessoas` WRITE;
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;
INSERT INTO `pessoas` VALUES (1,'Albo Borges Vieira','1989-12-26','m','2015-04-26','albovieira@gmail.com',1,'/img/data/albo.jpg','','3192883860',1),(2,'albere','2012-01-01','m',NULL,'dsdadasd@alber.com',6,'/img/data/sem-foto.jpg','','',NULL),(3,'Juliano Silva','1992-02-01','m','2015-05-24','juliano@teste.com.br',8,'/img/data/sem-foto.jpg',NULL,NULL,NULL),(4,'joao','1997-02-01','m','2015-05-24','joao@teste.com.br',10,'/img/data/sem-foto.jpg',NULL,NULL,NULL),(5,'Teste Silva','1992-01-01','f','2015-05-25','teste@teste.com.br',11,'/img/data/sem-foto.jpg',NULL,NULL,NULL),(6,'Teste','1992-01-01','f','2015-05-27','teste@teste.com.br',17,'/img/data/sem-foto.jpg',NULL,NULL,NULL),(7,'Julio Souzaaaa','1990-10-21','m','2015-06-05','emailteste@teste.com.br',18,'/img/data/sem-foto.jpg','','',12),(9,'tetudo da silva','1976-09-09','m','2015-06-05','tetudo@gmail.com',19,'/img/data/sem-foto.jpg',NULL,NULL,14);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_categoria_donativo`
--

LOCK TABLES `tb_categoria_donativo` WRITE;
/*!40000 ALTER TABLE `tb_categoria_donativo` DISABLE KEYS */;
INSERT INTO `tb_categoria_donativo` VALUES (1,'Saude'),(2,'Diversao'),(3,'Eletrodomesticos'),(4,'Utensilios'),(5,'Roupas');
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
  `status` int(11) NOT NULL,
  `id_instituicao` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `dt_desativacao_dnv` datetime NOT NULL,
  PRIMARY KEY (`id_dnv`,`quant_dnv`),
  KEY `instbene_solicitante_idx` (`id_instituicao`),
  KEY `donativo_categoria_idx` (`id_categoria`),
  CONSTRAINT `donativo_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria_donativo` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `instbene_solicitante` FOREIGN KEY (`id_instituicao`) REFERENCES `tb_instbenef` (`id_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_donativo`
--

LOCK TABLES `tb_donativo` WRITE;
/*!40000 ALTER TABLE `tb_donativo` DISABLE KEYS */;
INSERT INTO `tb_donativo` VALUES (4,'Precisamos de 20 unidades de cobertores para ','Cobertores',20,'2015-06-10 00:00:00',2147483647,2,5,'2015-07-10 00:00:00'),(5,'asdasd..','camisas',10,'2015-06-10 00:00:00',2147483647,2,1,'2015-07-10 00:00:00');
/*!40000 ALTER TABLE `tb_donativo` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_enderecos`
--

LOCK TABLES `tb_enderecos` WRITE;
/*!40000 ALTER TABLE `tb_enderecos` DISABLE KEYS */;
INSERT INTO `tb_enderecos` VALUES ('Rua Anna Maria de Jesus',104,'Guarani','Belo Horizonte','UF',1,'31.814-710','Apartamento'),('Rua Anna Maria de Jesus',104,'AarÃ£o Reis','Belo Horizonte','MG',12,'31.814-710','Apartamento'),('Rua 3',12,'SaÃºde','Rio Claro','SP',14,'13.500-313','');
/*!40000 ALTER TABLE `tb_enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_evento_divulgacao`
--

DROP TABLE IF EXISTS `tb_evento_divulgacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_evento_divulgacao` (
  `id_divulgacao` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `txt_divulgacao` varchar(400) NOT NULL,
  `data_divulgacao` datetime NOT NULL,
  `usuarios_marcados` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_divulgacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_evento_divulgacao`
--

LOCK TABLES `tb_evento_divulgacao` WRITE;
/*!40000 ALTER TABLE `tb_evento_divulgacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_evento_divulgacao` ENABLE KEYS */;
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

--
-- Table structure for table `tb_mensagem`
--

DROP TABLE IF EXISTS `tb_mensagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_mensagem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt_envio` datetime NOT NULL,
  `mensagem` varchar(500) DEFAULT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id_instituicao` int(11) NOT NULL,
  `id_transacao` int(11) NOT NULL,
  `id_remetente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mensagem_pessoa_idx` (`id_pessoa`),
  KEY `fk_mensagem_instituicao_idx` (`id_instituicao`),
  KEY `fk_mensagem_transacao_idx` (`id_transacao`),
  CONSTRAINT `fk_mensagem_transacao` FOREIGN KEY (`id_transacao`) REFERENCES `tb_transacao` (`id_transacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensagem_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `tb_instbenef` (`id_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensagem_pessoa` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_mensagem`
--

LOCK TABLES `tb_mensagem` WRITE;
/*!40000 ALTER TABLE `tb_mensagem` DISABLE KEYS */;
INSERT INTO `tb_mensagem` VALUES (5,'2015-06-13 08:06:20','dsdadsaadas',1,2,12,1);
/*!40000 ALTER TABLE `tb_mensagem` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_minhas_instituicoes`
--

LOCK TABLES `tb_minhas_instituicoes` WRITE;
/*!40000 ALTER TABLE `tb_minhas_instituicoes` DISABLE KEYS */;
INSERT INTO `tb_minhas_instituicoes` VALUES (55,2,2),(56,3,2),(61,2,1),(62,1,6),(63,3,6),(64,1,1);
/*!40000 ALTER TABLE `tb_minhas_instituicoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_status`
--

DROP TABLE IF EXISTS `tb_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL,
  `desc` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_status`
--

LOCK TABLES `tb_status` WRITE;
/*!40000 ALTER TABLE `tb_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_status` ENABLE KEYS */;
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
  PRIMARY KEY (`id_transacao`),
  KEY `transacao_donativo_idx` (`id_donativo`),
  KEY `transacao_instituicao_idx` (`id_instituicao`),
  KEY `transacao_pessoa_idx` (`id_pessoa`),
  CONSTRAINT `transacao_donativo` FOREIGN KEY (`id_donativo`) REFERENCES `tb_donativo` (`id_dnv`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transacao_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `tb_instbenef` (`id_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transacao_pessoa` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_transacao`
--

LOCK TABLES `tb_transacao` WRITE;
/*!40000 ALTER TABLE `tb_transacao` DISABLE KEYS */;
INSERT INTO `tb_transacao` VALUES (10,4,11,'2015-06-13 00:00:00',NULL,NULL,2,1),(12,4,11,'2015-06-13 00:00:00',NULL,NULL,2,1);
/*!40000 ALTER TABLE `tb_transacao` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'albovieira','albovieira@gmail.com','Albo Vieira','$2y$14$iXxrqJafzXGOfqJ5ZLjLWO9yb.bHJsJkdRsoakAX9YLarpZRehXqq',NULL,2),(2,'Sao João','saojoao@gmail.com','São Joao','$2y$14$QhRBXRPd7KDEwJ9cAtTJi.nJKCupGPDwVAevPvT6b1FbuZRuIymLq',0,3),(3,'Apae','apae@gmail.com','Apae MG','$2y$14$QhRBXRPd7KDEwJ9cAtTJi.nJKCupGPDwVAevPvT6b1FbuZRuIymLq',NULL,3),(4,'Instituicao','instituicao@gmail.com','Instituicao Mineira','$2y$14$QhRBXRPd7KDEwJ9cAtTJi.nJKCupGPDwVAevPvT6b1FbuZRuIymLq',NULL,3),(5,'alboborges','albovieira@outlook.com','Albo VBorges','$2y$14$Dv26bDuKUGkBCX/hG0bTlOrDSbR83jUnMzBkVIRP0iorxV4S8mi8S',NULL,2),(6,NULL,'albovieira@teste.com',NULL,'$2y$14$teY8YpAkVD6voWMJCICEweW.BC8rv51NsZpX3mZNNesYpFMVbV/gm',NULL,2),(7,NULL,'camila@teste.com',NULL,'$2y$14$lrbSn4/G/plF9ysP/AjWTeFzXOs3NeBgAnE8XPgYd3kPlLjNSoldK',NULL,2),(8,NULL,'juliano@teste.com.br',NULL,'$2y$14$/dJm6J0NRS13rvX3zPaV8OYQ0u7EBciVLvmsfknzq9fesukTnnPki',NULL,2),(9,NULL,'instituicao@saojoao.com.br',NULL,'$2y$14$EAtYXGB4Bmt6cAnQ3ThUf.hjlKIiFo1JHMHlGA/ELksawE45ZCHCO',NULL,3),(10,NULL,'joao@teste.com.br',NULL,'$2y$14$qlwi5AF4ycS.UzjVQUlS3uPGDY6mDBHNfdCxftSvybCpxkcCJ11fG',NULL,2),(11,NULL,'teste@teste.com.br',NULL,'$2y$14$h6bPdszB39nVjAn9853gdu2WCnasZOxmryg2//obcSdamyJPnoyWK',NULL,2),(12,NULL,'naldo@teste.com.br',NULL,'$2y$14$wgiaiItG9ROsiRRdczhIeeQ56K8KoZ03Vy/vOK/Q2RzCjQ8eQHfPq',NULL,2),(13,NULL,'naldo@teste2.com.br',NULL,'$2y$14$zyb5w13pN9j835VOsEIngufw4SxSSMRgs3tnNb6zgxD4XFtwxzaDe',NULL,2),(14,NULL,'wesley@teste.com.br',NULL,'$2y$14$DlFUmL/HoGB5bfEtvfB38e1udjhCgExkM7fsdY7QQltX8Lvv4ZyLO',NULL,2),(15,NULL,'mario@gmail.com',NULL,'$2y$14$ci89yL/6KVnLdzPyY3EN5.hW0VUQ4nN4KPZdZrjPAvH0ObQM918xu',NULL,2),(16,NULL,'mariov@teste.com.br',NULL,'$2y$14$fk5CL0DdUUyX71tYNtjTMOibHVgSwnL1GbIeMp/tUJY/2aAQInAfC',NULL,2),(17,NULL,'umai@teste.com.br',NULL,'$2y$14$M./HggPdMSFHI60Qo6/mvuK5P2crdFwhhTKXGvRX6jch4QrJdhIZC',NULL,2),(18,NULL,'emailteste@teste.com.br',NULL,'$2y$14$wF1Z8m.YgFIoY0a1m/uN.uxFVstX7KQB9QA8uaNgos.a4vs5yK1/.',NULL,2),(19,NULL,'tetudo@gmail.com',NULL,'$2y$14$YFdWxi9FO6WQ/u84NokIB.sDsVHdqUigzOFukfKb2/bp5n74VKkcu',NULL,2);
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
INSERT INTO `user_provider` VALUES (1,'10205116848653302','facebook');
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

-- Dump completed on 2015-06-13 15:19:25
