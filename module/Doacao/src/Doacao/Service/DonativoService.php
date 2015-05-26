<?php
namespace Doacao\Service;

use Application\Service\AbstractService;
use Doacao\DAO\DonativoDAO;
use Application\Entity\Donativos;
use Doctrine\ORM\Tools\Pagination\Paginator;

class DonativoService extends AbstractService{
	private $dao;
	private $donativo;
	private $instituicao;
	
	public function __construct(){
		$this->dao = new DonativoDAO();
		$this->donativo = new Donativos();
		$this->instituicao = (new ServiceInstituicao())->getObjInstituicao();
	}
	
	public function retornaData($data){
		return new \DateTime($data, new \DateTimeZone('America/Sao_Paulo'));
	}
	
	private function calculaDataEntrega($data,$tempo){
		return $data->add(new \DateInterval("P{$tempo}D"));
	}
	
	public function save($data){
		$resposta = false;
		$dataResposta = $this->retornaData($data->dataInclu);
		$tempo = $data->tempo_maximo;
		
		//Seta todos os dados da entity
		$this->donativo->setTitulo($data->titulo);
		$this->donativo->setDescricao($data->descricao);
		$this->donativo->setQuantidade($data->quantidade);
		$this->donativo->setDataInclu($dataResposta);
		$this->donativo->setInstituicao($this->instituicao);
		$this->donativo->setIdCategoria($data->categorias);
		$this->donativo->setDataDesa($this->calculaDataEntrega($dataResposta, $tempo));
				
		if($this->dao->save($this->donativo)){
			$resposta = true;
		}
		
		return $resposta;
		
		
	}
	
	public function listaCategorias(){
		$categoriaList = array();
		foreach($this->dao->categorias() as $item){
			array_push($categoriaList,$item);
		}
		return $categoriaList;
	}
	
	public function donativosPorInstituicao(){
		$id = $this->instituicao->getId();
		return $this->dao->donativosInstituicao($id);	
	}
	
	public function getPagedDonativos($offset = 0, $limit = 0){
		$em = $this->dao->getEntityManager();
		$qb = $em->createQueryBuilder();
		
		$qb->select('d')
			->from('\Application\Entity\Donativos','d')
			->where('d.instituicao = ?0')
			->setMaxResults($limit)
			->setFirstResult($offset)
			->setParameter(0,$this->instituicao);
		$query = $qb->getQuery();
		
		$paginator = new Paginator($query);
		
		return $paginator;
	}
	
	public function pagina($page){
		
		$limit = 5;
		$offset = ($page == 0) ? 0 : ($page - 1) * $limit;
		$em = $this->dao->getEntityManager();
		$pagedDonativos = $this->getPagedDonativos($offset,$limit);
		
		return $pagedDonativos;
		
	}
	
	public function desativa($id){
		$response = $this->dao->update('tb_donativo',array('dt_desativacao_dnv'=>'1900-01-01 00:00:00'),array('id_dnv'=>$id));
		return $response;
	}
	
	public function exclui($id){
		$response = $this->dao->delete('tb_donativo',array('id_dnv'=>$id));
		return $response;
	}
	
}