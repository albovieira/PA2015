<?php
namespace Doacao\Service;

use Application\Service\AbstractService;
use Doacao\DAO\DonativoDAO;
use Application\Entity\Donativos;

class DonativoService extends AbstractService{
	
	private $dao;
	private $data;
	
	public function __construct(){
		$this->dao = new DonativoDAO();
	}
	
	//A função abaixo deve ser alocada em algum helperClass
	public function getTimeZoneBrasil(){
		$br = new \DateTimeZone('America/Sao_Paulo');
		return $br;
	}
	
	/**
	 * Constroi o objeto Donativos e verifica potênciais erros nos dados passados
	 * @param unknown $data
	 */
	private function setData($data){
		$donativo = new Donativos();
		
		$data_desativacao = $this->calculaDataEntregaDias(new \DateTime($data->dataInclu, $this->getTimeZoneBrasil()),$data->tempo_maximo);
		
		$donativo->setId($data->id);
		$donativo->setTitulo($data->titulo);
		$donativo->setDescricao($data->descricao);
		$donativo->setQuantidade($data->quantidade);
		$donativo->setDataInclusao(new \DateTime($data->dataInclu, $this->getTimeZoneBrasil()));
		$donativo->setDataDesativacao($data_desativacao);
		$donativo->setInstituicao((new ServiceInstituicao())->getObjInstituicao($data->idInstituicao));
		$donativo->setIdCategoria($data->categorias);
		
		return $donativo;
	}
	
	private function calculaDataEntregaDias($dateTimeInicio, $intervalo){
		$dataEntrega = $dateTimeInicio->add(new \DateInterval("P{$intervalo}D"));
		return new \DateTime($dataEntrega->format('Y-m-d'), $this->getTimeZoneBrasil());
	}
	
	public function listaCategorias(){
		$categorias = $this->dao->queryNativa(array('id_categoria','desc_categoria'),'tb_categoria_donativo');
		return $categorias;
	}
	
	public function save($data){
		$this->dao->savedata($this->setData($data));
		$erro = $this->dao->error();
		
		if($erro !== "")
			throw $erro;
		else
			return "";
	}
	
	public function desativa($id){
		if($this->dao->desativar($id)){
			return true;
		}else{
			return false;
		}
	}
	
	public function donativosPorInstituicao($idInstituicao){
		return $this->dao->listaTodosDonativos($idInstituicao);
	}
	
}