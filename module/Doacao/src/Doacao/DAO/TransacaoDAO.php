<?php
namespace Doacao\Dao;

use Application\Dao\AbstractDao;
class TransacaoDAO extends AbstractDao{
	private static $em;
	
	public function __construc(){
		self::$em = parent::getEntityManager();
	}
	
	public function total($donativo){
		$em = $this->getEntityManager();
		
		$dql = "SELECT SUM(t.quantidadeOferta) FROM Application\Entity\Transacao t
				 WHERE t.id = ?0";
		$count = $em->createQuery($dql)
					->setParameter(0,$donativo)
					->getSingleScalarResult();
		
		return $count;
	}
	
	
}