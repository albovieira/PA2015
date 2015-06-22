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

	public function buscaUmaInstituicao($id){
		$instituicao = $this->instituicaoDao->findById($id,'Application\Entity\Instituicao');
		return $instituicao;
	}

	/**
	 * @param Instituicao $object
	 */
	public function listaDonativos(Instituicao $instituicao){
		return $this->decompoeObjeto($instituicao->getDonativos());
	}

	public function recebidos($instituicao){
		return $this->instituicaoDao->sumRecebidos($instituicao);
	}

	public function finalizados($instituicao){
		return $this->instituicaoDao->countFinalizados($instituicao);
	}

	public function donativos($instituicao){
		return $this->instituicaoDao->sumDonativos($instituicao);
	}

	public function pendentes($instituicao){
		return $this->instituicaoDao->countPendentes($instituicao);
	}

	public function donativosAtivos($instituicao){
		return $this->instituicaoDao->countDonativos($instituicao);
	}

}