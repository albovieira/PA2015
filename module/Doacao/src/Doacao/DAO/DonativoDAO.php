<?php
namespace Doacao\DAO;

use Application\Dao\AbstractDao;
use Doacao\Service\StatusService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\Expr;

class DonativoDAO extends AbstractDao{
	protected $entity = 'Application\Entity\Donativos';
	protected $tbalias = 'don';
	/** @var EntityManager em */
	private $em;

	public function __construct(){
		$this->em = parent::getEntityManager();
	}
	
	public function save($entity){
		try{
			$this->em->beginTransaction();
			parent::salvar($entity);
			$this->em->commit();
		}catch(ORMException $e){
			$this->em->rollback();
			throw $e;
		}

		return "";
	}

	/**
	 * @param $instituicaoId
	 * @return array
	 * Este metodo retorna os donativos pertencentes a uma instituição
	 * sobre a condição de estarem todos ativos para doação
	 */
	public function donativosInstituicao($instituicaoId){
		$repository = $this->em->getRepository('Application\Entity\Donativos')
		->findBy(array('idInstituicao'=>$instituicaoId,'status'=>(new StatusService())->ativado()));

		return $repository;
	}

	/**
	 * @param $instituicao
	 * @param $status
	 * Este método opera sobre duas condições a primeira é a isntituição pertencente,
	 * e a segunda é o parametro status status (Ativado, Desativado, Finalizado)
	 */
	public function donativosPorStatus($instituicao,$status){
		$repository = $this->em->getRepository('Application\Entity\Donativos')
			->findBy(array('idInstituicao'=>$instituicao,'status'=>$status));

		return $repository;
	}

	public function categorias(){
		$repositoy = $this->em->getRepository('\Application\Entity\CategoriaDonativo');

		$qb = $repositoy->createQueryBuilder('c')->getQuery();
		$categorias = $qb->getResult();
		return $categorias;
	}
	
	public function update($entity){
		try{
			$this->em->beginTransaction();
			$this->updateEntity($entity);
			$this->em->commit();
		}catch(ORMException $e){
			$this->em->rollback();
			throw $e;
		}
	}
	
	public function delete($table,$identificador){
		try{
			$conn = $this->em->getConnection();
			$r = $conn->delete($table,$identificador);
		}catch(Exception $e){
			throw $e;
		}

		return $r;
	}

	public function buscaDonativo($id){
		$donativo = $this->em->getRepository('\Application\Entity\Donativos')->find($id);
		return $donativo;
	}

	public function desativados($instituicao){

	}

	public function findDonativo($id){
		$qb = $this->em
				->createQueryBuilder()
				->select($this->getTbAlias(), 'categoria', 'tbinst')
				->from($this->getEntity(), $this->getTbAlias())
				->leftJoin('Application\Entity\CategoriaDonativo', 'categoria' , 'IN', 'don.idCategoria = categoria.id')
				->leftJoin('Application\Entity\Instituicao', 'tbinst' , 'IN', 'don.idInstituicao = tbinst.id')
				->where($this->getTbAlias(). ".id = {$id}");
		$return = $qb->getQuery()->getResult();
		return $return[0];
	}

	public function sumRecebidos($donativo){
		$qb = $this->getEntityManager()->createQueryBuilder()
			->select((new Expr())->sum('d','d.quantidadeOferta'))
			->from('\Applicaton\Entity\Donativos','d')
			->innerJoin('\Application\Entity\Transacao','t','WITH','d.id = t.donativo')
			->where((new Expr())->isNotNull('t.dataFinalizacao'),(new Expr())->eq('d.id',$donativo));

		return $qb->getQuery()->getScalarResult();
	}

}