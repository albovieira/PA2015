DROP TABLE IF exists `doacao_sistema`.`tb_transacao`;

CREATE TABLE `tb_transacao` (
  `id_transacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_donativo` int(11) NOT NULL,
  `quantidade_oferecida` int(11) NOT NULL,
  `dt_transacao` datetime NOT NULL DEFAULT '1960-01-01 00:00:00',
  `dt_expiracao` datetime NOT NULL DEFAULT '1960-01-01 00:00:00',
  `dt_finalizacao` datetime NOT NULL DEFAULT '1960-01-01 00:00:00',
  `id_instituicao` int(11) NOT NULL,
  `id_pessoa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_transacao`),
  KEY `transacao_donativo_idx` (`id_donativo`),
  KEY `transacao_instituicao_idx` (`id_instituicao`),
  KEY `transacao_pessoa_idx` (`id_pessoa`),
  CONSTRAINT `transacao_pessoa` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transacao_donativo` FOREIGN KEY (`id_donativo`) REFERENCES `tb_donativo` (`id_dnv`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `transacao_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `tb_instbenef` (`id_instituicao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

