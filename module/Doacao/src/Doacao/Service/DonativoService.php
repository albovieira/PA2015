<?php
namespace Doacao\Service;

use Application\Entity\Donativos;
use Application\Service\AbstractService;
use Doacao\DAO\DonativoDAO;


class DonativoService extends AbstractService{
	private $dao;
	private $donativo;
	private $instituicao;
	private $helper;
	
	public function __construct(){
		$this->dao = new DonativoDAO();
		$this->donativo = new Donativos();
		$this->instituicao = (new ServiceInstituicao())->getObjInstituicao();
		$this->helper = new HelperService();
	}
	
	public function save($data){
		$resposta = "";

		$dataResposta = $this->helper->retornaData($data->dataInclu);
		$tempo = $data->tempo_maximo;
		$categoria = $this->dao->findById($data->categorias,'\Application\Entity\CategoriaDonativo');


		//Seta todos os dados da entity
		$this->donativo->setTitulo($data->titulo);
		$this->donativo->setDescricao($data->descricao);
		$this->donativo->setQuantidade($data->quantidade);
		$this->donativo->setDataInclu($this->retornaData($data->dataInclu));
		$this->donativo->setInstituicao($this->instituicao);
		$this->donativo->setIdCategoria($categoria);
		$this->donativo->setDataDesa($this->helper->adicionarDias($dataResposta, $tempo));
		$this->donativo->setStatus((new StatusService())->ativado());

		$resposta = $this->dao->save($this->donativo);

		return $resposta;


	}

	public function listaCategorias(){
		$c = $this->dao->categorias();
		$list = array();

		foreach($c as $item){
			$list[$item->getId()] = $item->getDescricao();
		}

		return $list;
	}

	/**
	 * @return array
     */
	public function donativosPorInstituicao(){
		$id = $this->instituicao->getId();
		return $this->dao->donativosInstituicao($id);	
	}

	public function donativoDesativados(){
		$donativos = $this->dao->donativosPorStatus($this->instituicao,(new StatusService())->desativado());
		return $donativos;
	}

	public function  donativosFinalizados(){
		$donativos = $this->dao->donativosPorStatus($this->instituicao,(new StatusService())->finalizado());
		return $donativos;
	}

	/**
	 * @param $id
	 * @return array
     */
	public function donativosInstituicaoById($id){
		/** @var Donativos $objDonativo */
		$objDonativo = $this->dao->donativosInstituicao($id);


		$arrDonativo = [];
		if($objDonativo != null){
			$arrDonativo = [];
			foreach($objDonativo as $key=>$donativo){
				$arrDonativo[$key]['id'] = $donativo->getId();
				$arrDonativo[$key]['descricao'] = $donativo->getDescricao();
				$arrDonativo[$key]['titulo'] = $donativo->getTitulo();
				$arrDonativo[$key]['quantidade'] = $donativo->getQuantidade();
				$arrDonativo[$key]['dataInclu'] = $donativo->getDataInclu()->format('d-m-y');
				$arrDonativo[$key]['dataDesa'] = $donativo->getDataDesa()->format('d-m-y');
				$arrDonativo[$key]['instituicao'] = $donativo->getInstituicao()->getNomeFantasia();
			}
		}

		return $arrDonativo;
	}
	
	public function desativa($id){
		$donativo = $this->dao->buscaDonativo($id);
		$donativo->setStatus((new StatusService())->desativado());
		$response = $this->dao->update($donativo);
		return $response;
	}

	public function ativa($id){
		$donativo = $this->dao->buscaDonativo($id);
		$donativo->setStatus((new StatusService())->ativado());
		$response = $this->dao->update($donativo);
		return $response;
	}
	
	public function exclui($id){
		$response = $this->dao->delete('tb_donativo',array('id_dnv'=>$id));
		return $response;
	}

	public function getDonativoById($id){
		return $this->dao->findDonativo($id);
	}

}