<?php
namespace Doacao\DAO;

use Application\Entity\Donativos;
use Application\Service\AbstractService;
use Doacao\Service\ServiceInstituicao;
use Application\Dao\AbstractDao;

class DonativoDAO extends AbstractDao{
	private $em;
	private $error;
	
	public function __construct(){
		$this->em = $this->getEntityManager();
		$this->error = "";
	}
	
	public function listaTodosDonativos($idInstituicao){
		$donativos = $this->em->getRepository('Application\Entity\Donativos')
		->findBy(array('idInstituicao'=>$idInstituicao));
		
		return $donativos;
	}
	
	
	public function savedata($data){
			
			try{
				$this->em->getConnection()->beginTransaction();
				$this->salvar($data);
				$this->em->getConnection()->commit();
			}catch(Exception $e){
				$this->em->getConnection()->rollback();
				$this->error =  $e;
			}
	} 
	
	public function desativar($id){
		$conn = $this->em->getConnection();
		$sql = "UPDATE tb_donativo SET dt_desativacao_dnv = '1900-01-01 00:00:00' WHERE id_dnv = {$id}";
		return $conn->exec($sql);
	}
	
	public function error(){
		$this->error = $this->error === null ? "" : $this->error;
		return $this->error;
	}
	
}