<?php
namespace Doacao\Dao;

use Application\Dao\AbstractDao;

class TransacaoDAO extends AbstractDao{
	private static $em;
	protected $entity = 'Application\Entity\Transacao';
	protected $tbalias = 'tran';

	public function __construct(){
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

	public function findTransacaoPorDonativosePessoa($pessoaId, $donativoId){
		$qb = $this->getEntityManager()->createQueryBuilder()
			->select($this->getTbAlias())
			->from($this->getEntity(), $this->getTbAlias())
			->where($this->getTbAlias(). ".idPessoa = {$pessoaId} AND " . $this->getTbAlias() .".idDonativo = {$donativoId}")
			->andWhere($this->getTbAlias(). '.dataFinalizacao is null');
		$retorno = $qb->getQuery()->getResult();

		if(count($retorno)){
			return $retorno[0];
		}
		return false;
	}

	public function findMensagensTransacao($transacaoID){
		$qb= $this->getEntityManager()->createQueryBuilder()
			 ->select('msg')
			 ->from('Application\Entity\Mensagem', 'msg')
			 ->where("msg.idTransacao = {$transacaoID}");

		return $qb->getQuery()->getResult();
	}

	
	
}