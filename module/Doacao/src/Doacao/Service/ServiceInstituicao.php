<?php
namespace Doacao\Service;

use Application\Entity\Instituicao;
use Application\Entity\Donativos;
use Application\Service\AbstractService;
use Doacao\Dao\InstituicaoDao;
use Zend\Console\Charset\Utf8;
use Zend\Mime\Decode;
use Zend\View\Helper\ViewModel;

class ServiceInstituicao extends AbstractService{
	
	private static $em;
	private static $instituicao;
	private $instituicaoDao;

	/** PASSAR ESSES METODOS QUE ACESSAM A ENTIDADE INSTITUICAO PARA A INSTITUICAO DAO
	 O QUE FOR GERAL PASSAR PARA A CLASSE SERVICE
	 *
	 */

	public function __construct(){
		if(!$this->instituicaoDao){
			$this->instituicaoDao = new InstituicaoDao();
		}
	}

	public function getObjInstituicao(){
		$usuario = $this->getUserLogado();
		return $this->instituicaoDao->selectPorUsuario($usuario);
	}
		
	public function save($data){
		
	}
	
	/**
	 * @param Instituicao $object
	 */
	public function listaDonativos(Instituicao $instituicao){
		return $this->decompoeObjeto($instituicao->getDonativos());
	}
	
	protected function decompoeObjeto($objeto){
		$associacao = array();
		foreach($objeto as $instancia):
			array_push($associacao, $instancia);
		endforeach;
		return $associacao;
	}

}