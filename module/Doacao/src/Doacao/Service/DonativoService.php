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
	
	/**
	 * Constroi o objeto Donativos e verifica potênciais erros nos dados passados
	 * @param unknown $data
	 */
	private function setData($data){
		$donativo = new Donativos();
		
		$item->setId($novoItem->id);
		$item->setTitulo($novoItem->titulo);
		$item->setDescricao($novoItem->descricao);
		$item->setQuantidade($novoItem->quantidade);
		$item->setDataInclusao(new \DateTime($novoItem->dataInclu));
		$item->setDataDesativacao(new \DateTime($novoItem->dataDesa));
		$item->setInstituicao((new ServiceInstituicao())->buscaUmaInstituicao($novoItem->idInstituicao));
		$item->setIdCategoria(1);
		
		return $donativo;
	}
	
	public function save($data){
		
		$error = $this->dao->savedata($this->setData($data));
	}
	
}