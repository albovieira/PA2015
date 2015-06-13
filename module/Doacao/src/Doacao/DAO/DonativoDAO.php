<?php
namespace Doacao\DAO;

use Application\Dao\AbstractDao;
use Doctrine\ORM\EntityManager;

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
			throw $e;
		}
		
	}
	
	public function donativosInstituicao($instituicaoId){
		$donativos = $this->em->getRepository('Application\Entity\Donativos')
		->findBy(array('idInstituicao'=>$instituicaoId));

		return $donativos;
	}

	public function categorias(){
		$conn = $this->em->getConnection();
		$categorias = $conn->fetchAll("SELECT id_categoria, desc_categoria FROM tb_categoria_donativo");
		return $categorias;
	}
	
	public function update($table, $associative,$identificador){
		try{
			$conn = $this->em->getConnection();
			$r = $conn->update($table, $associative, $identificador);
			
		}catch(Exception $e){
			$conn->rollback();
			throw $e;
		}
		
		return $r;
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

}