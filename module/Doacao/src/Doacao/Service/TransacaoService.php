<?php
namespace Doacao\Service;

use Application\Entity\Mensagem;
use Application\Service\AbstractService;
use Applicaton\Entity\Transacao;
use Doacao\Dao\TransacaoDAO;

class TransacaoService extends AbstractService{

	const PESSOA = '2';
	const INSTITUICAO = '3';

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

		//adiciona dependencia mensagem



		$mensagem = new Mensagem();
		$arrDependencias['idMensagem'] = $post['idMensagem'];
		$arrDependencias['mensagem'] = $post['mensagem'];

		$perfil = $this->transacaoDao->validaPerfil($this->getUserLogado());
		if($perfil == self::PESSOA){
			$post['idRemetente'] = $arrDependencias['pessoa']->getId();
		}else{
			$post['idRemetente'] = $arrDependencias['instituicao']->getId();
		}
		$arrDependencias['idRemetente'] = $post['idRemetente'];


		$data = new \DateTime('now');
		$arrDependencias['dataEnvioMensagem'] = $data->format('Y-m-d h:m:s');
		$mensagem->exchangeArray($arrDependencias);

		if($transacao->getId()){
			$this->transacaoDao->updateEntity($transacao);
		}else{
			$this->transacaoDao->salvar($transacao);
		}

		$mensagem->setTransacao($transacao);
		$this->transacaoDao->salvar($mensagem);
	}

	public function getDependencias($post){

		$arrObjsDependencia = [];
		$arrObjsDependencia['instituicao'] = $this->transacaoDao->findById($post['idInstituicao'], 'Application\Entity\Instituicao');
		$arrObjsDependencia['pessoa'] = $this->transacaoDao->findById($post['idPessoa'], 'Application\Entity\Pessoa');
		$arrObjsDependencia['donativo'] = $this->transacaoDao->findById($post['idDonativo'], 'Application\Entity\Donativos');

		return $arrObjsDependencia;
	}

	public function getTransacaoPorPessoaeDonativo($idpessoa, $iddonativo){
		return $this->transacaoDao->findTransacaoPorDonativosePessoa($idpessoa, $iddonativo);
	}

	public function getMensagensTransacao($transacao){
		//return $this->transacaoDao->''
	}
	
}