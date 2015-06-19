<?php
namespace Doacao\Dao;

use Application\Dao\AbstractDao;
use Application\Entity\Donativos;
use Application\Entity\Pessoa;
use Application\Entity\Transacao;
use Doctrine\ORM\ORMException;
use Doctrine\DBAL\Query\ExpressionBuilder;
use Doctrine\ORM\Query\Expr;

class TransacaoDAO extends AbstractDao{
	private static $em;
	protected $entity = 'Application\Entity\Transacao';
	protected $tbalias = 'tran';

	public function __construct(){
		self::$em = parent::getEntityManager();
	}

	public function buscaTransacaoPendente($instituicao,&$pessoa,&$donativo,&$transacao,$offset,$limit){
		$qb = $this->getEntityManager()->createQueryBuilder()
			->select(array('t','p','d'))
			->from('\Application\Entity\Transacao','t')
			->join('Application\Entity\Pessoa','p','WITH','t.pessoa = p.id')
			->join('Application\Entity\Donativos','d','WITH','t.donativo = d.id')
			->andWhere((new Expr())->eq('t.instituicao',$instituicao->getId()),(new Expr())->isNull('t.dataFinalizacao'))
			->setFirstResult($offset)
			->setMaxResults($limit)
			;
		try {
			$stmt = $qb->getQuery()->getResult();
		}catch (ORMException $e){
			throw $e;
		}


		foreach($stmt as $objects){
			if($objects instanceof Transacao){
				array_push($transacao,$objects);
			}elseif($objects instanceof Pessoa){
				array_push($pessoa,$objects);
			}elseif($objects instanceof Donativos){
				array_push($donativo,$objects);
			}
		}

		return "";
	}

	public function buscaTransacaoEfetivada($instituicao,&$pessoa,&$donativo,&$transacao,$offset,$limit){
		$qb = $this->getEntityManager()->createQueryBuilder()
			->select(array('t','p','d'))
			->from('\Application\Entity\Transacao','t')
			->join('Application\Entity\Pessoa','p','WITH','t.pessoa = p.id')
			->join('Application\Entity\Donativos','d','WITH','t.donativo = d.id')
			->andWhere((new Expr())->eq('t.instituicao',$instituicao->getId()),(new Expr())->isNotNull('t.dataFinalizacao'))
			->setFirstResult($offset)
			->setMaxResults($limit)
		;
		try {
			$stmt = $qb->getQuery()->getResult();
		}catch (ORMException $e){
			throw $e;
		}

		foreach($stmt as $objects){
			if($objects instanceof Transacao){
				array_push($transacao,$objects);
			}elseif($objects instanceof Pessoa){
				array_push($pessoa,$objects);
			}elseif($objects instanceof Donativos){
				array_push($donativo,$objects);
			}
		}

		return "";
	}

	public function buscaTransacaoExpirada($instituicao,&$pessoa,&$donativo,&$transacao,$offset,$limit){
		//Para esta função considerar que a data de expiração deve estar preenchida e a data de expiração menor que  hoje já expirou
		//data de finalização NULL
		$qb = $this->getEntityManager()->createQueryBuilder()
			->select(array('t','p','d'))
			->from('\Application\Entity\Transacao','t')
			->join('Application\Entity\Pessoa','p','WITH','t.pessoa = p.id')
			->join('Application\Entity\Donativos','d','WITH','t.donativo = d.id')
			->andWhere((new Expr())->eq('t.instituicao',$instituicao->getId()))
			->setFirstResult($offset)
			->setMaxResults($limit)
		;
		try {
			$stmt = $qb->getQuery()->getResult();
		}catch (ORMException $e){
			throw $e;
		}

		foreach($stmt as $objects){
			if($objects instanceof Transacao){
				array_push($transacao,$objects);
			}elseif($objects instanceof Pessoa){
				array_push($pessoa,$objects);
			}elseif($objects instanceof Donativos){
				array_push($donativo,$objects);
			}
		}

		return "";
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

	public function findTransacaoPorPessoa($idpessoa){
		$qb = $this->getEntityManager()->createQueryBuilder()
			->select($this->getTbAlias(), 'donativo')
			->from($this->getEntity(), $this->getTbAlias())
			->leftJoin('Application\Entity\Donativos', 'donativo' , 'IN', 'tran.idDonativo = donativo.id')
			->where($this->getTbAlias(). ".idPessoa = {$idpessoa}")
			->orderBy($this->getTbAlias(). ".dataTransacao", 'DESC');
		$retorno = $qb->getQuery()->getResult();

		if(count($retorno)){
			return $retorno;
		}
		return false;
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