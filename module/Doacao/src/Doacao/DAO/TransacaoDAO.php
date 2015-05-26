<?php
namespace Doacao\Dao;

use Application\Dao\AbstractDao;
class TransacaoDAO extends AbstractDao{
	private static $em;
	
	public function __construc(){
		self::$em = parent::getEntityManager();
	}
	
	public function total($donativo){
		$em = parent::getEntityManager();
		
		$dql = "SELECT SUM(quantidadeOfertada) FROM Application\Entity\Transacao t
				 WHERE t.id_donativo = ?0";
		$count = $em->createQuery($dql)
					->setParameter(0,$donativo)
					->getSingleScalarResult();
		
		return $count;
	}
	
	
}