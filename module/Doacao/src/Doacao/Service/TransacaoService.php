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

	public function salvar($post, $transacao){

		$arrDependencias = $this->getDependencias($post);
		$transacao->exchangeArray($post);
		$transacao->setInstituicao($arrDependencias['instituicao']);
		$transacao->setDonativo($arrDependencias['donativo']);
		$transacao->setPessoa($arrDependencias['pessoa']);

		$this->transacaoDao->salvar($transacao);
	}

	public function getDependencias($post){

		$arrObjsDependencia = [];
		$arrObjsDependencia['instituicao'] = $this->transacaoDao->findById($post['idInstituicao'], 'Application\Entity\Instituicao');
		$arrObjsDependencia['pessoa'] = $this->transacaoDao->findById($post['idPessoa'], 'Application\Entity\Pessoa');
		$arrObjsDependencia['donativo'] = $this->transacaoDao->findById($post['idDonativo'], 'Application\Entity\Donativos');

		return $arrObjsDependencia;
	}
	
}