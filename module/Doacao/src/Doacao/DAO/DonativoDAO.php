<?php
namespace Doacao\DAO;

use Application\Dao\AbstractDao;
use Application\Entity\Donativos;
class DonativoDAO extends AbstractDao{
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
		->findBy(array('instituicao'=>$instituicaoId));
		
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
	
	
}