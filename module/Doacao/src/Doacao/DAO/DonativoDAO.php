<?php
namespace Doacao\DAO;

use Application\Entity\Donativos;
use Application\Service\AbstractService;
use Doacao\Service\ServiceInstituicao;
use Application\DAO\AbstractDAO;

class DonativoDAO extends AbstractDAO{
	private $em;
	private $error;
	
	public function __construct(){
		$this->em = $this->getEntityManager();
		$this->error = "";
	}
	
	public function savedata($data){
			
			try{
				$this->em->getConnection()->beginTransaction();
				$this->em->persist($item);
				$this->em->flush();
				$this->em->getConnection()->commit();//
			}catch(Exception $e){
				$this->em->getConnection()->rollback();
				$this->error =  $e;
			}
	}
	
	public function error(){
		return $this->error;
	}
	
}