<?php
namespace Doacao\Service;

use Application\Service\AbstractService;
use Applicaton\Entity\Transacao;
use Doacao\Dao\TransacaoDAO;

class TransacaoService extends AbstractService{
	
	private $transacaoDao;
	
	public function __construct(){
		$this->transacaoDao = new TransacaoDAO();
	}
	
	public function criarTransacao(){

	}

	public function totalPorDonativo($id){
		$quant = $this->transacaoDao->total($id);
		return $quant;
	}
	
}