<?php
namespace Doacao\Service;

use Application\Service\AbstractService;
use Doacao\Dao\TransacaoDAO;
use Applicaton\Entity\Transacao;

class TransacaoService extends AbstractService{
	
	private $transacao;
	private $dao;
	
	public function __construc(){
		$this->dao = new TransacaoDAO();
		$this->transacao = new Transacao();
	}
	
	public function totalPorDonativo($id){
		$dao = new TransacaoDAO();
		
		$quant = $dao->total($id);
		return $quant;
	}
	
	
}