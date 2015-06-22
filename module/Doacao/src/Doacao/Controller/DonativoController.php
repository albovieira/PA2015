<?php
/**
 * Zend Framework (http://framework.zend.com/)
*
* @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
* @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
* @license   http://framework.zend.com/license/new-bsd New BSD License
*/

namespace Doacao\Controller;

use Components\MVC\Controller\AbstractDoctrineCrudController;
use Doacao\Form\DonativoForm;
use Doacao\Service\DonativoService;
use Doacao\Service\HelperService;
use Doacao\Service\ServiceInstituicao;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Application\Service\AbstractService;

class DonativoController extends AbstractDoctrineCrudController
{
	private static $service;
	
	public function __construct(){
		self::$service = new DonativoService();
	}
	
	public function indexAction()
	{
		$this->layout()->setTemplate('layout/layout_menu_Instituicao');
		$donativos = self::$service->donativosPorInstituicao();
		$desativados = self::$service->donativoDesativados();
		$finalizados = self::$service->donativosFinalizados();

		$vm = new ViewModel();
		$vm->setVariable('donativos', $donativos);
		$vm->setVariable('desativados',$desativados);
		$vm->setVariable('finalizados',$finalizados);
		return $vm;
		
	}
	
	public function novoAction(){
		$form = new DonativoForm();
		
		return (new ViewModel())
		->setTerminal($this->getRequest()->isXmlHttpRequest())
		->setVariable('form', $form)
		->setVariable('userID', (new AbstractService())->getUserLogado())
		->setVariable('now', (new HelperService())->retornaData("now"));
		
	}
	
	public function insereAction(){
		$request = $this->getRequest();
		$response = $this->getResponse();

		if($request->isPost()){
			$data = $request->getPost();
			
			$status = self::$service->save($data); 
			
			if($status == ""){
				$response = \Zend\Json\Json::encode('success');
			}else{
				$response = \Zend\Json\Json::encode($status);
			}
			
			$jm = new JsonModel();
			$jm->setTerminal(true);
			$jm->setVariable('data',$response);
		}
		
		return $jm;
	}
	
	public function desativarAction(){
		$request = $this->getRequest();
		$response = $this->getResponse();
		$id = $request->getPost();
		
		if (self::$service->desativa($id->id)){
			$response =  \Zend\Json\Json::encode(array("success"=>1));
		}
		
		$jm = new JsonModel();
		$jm->setTerminal(true);
		$jm->setVariable('data',$response);
		
		return $jm;
	}

	public function ativarAction(){
		$request = $this->getRequest();
		$response = $this->getResponse();
		$id = $request->getPost();

		if (self::$service->ativa($id->id)){
			$response =  \Zend\Json\Json::encode(array("success"=>1));
		}

		$jm = new JsonModel();
		$jm->setTerminal(true);
		$jm->setVariable('data',$response);

		return $jm;
	}
	
	public function editarAction(){
		
	}
	
	public function excluirAction(){
		$request = $this->getRequest();
		$response = $this->getResponse();
		$id = $request->getPost();
		
		if(self::$service->exclui($id->id)){
			$response = \Zend\Json\Json::encode(array("success"=>1));
		}

		$jm = new JsonModel();
		$jm->setTerminal(true);
		$jm->setVariable('data',$response);
		
		return $jm;
	}

	public function getDonativosAction(){
		$filtro = $this->params()->fromQuery('id');


		//busca a instituicao vinda do get para buscar donativos
		$instituicaoService = new ServiceInstituicao();
		$instituicao = $instituicaoService->buscaUmaInstituicao($filtro);

		$donativos = self::$service->donativosInstituicaoById($instituicao);

		return new JsonModel($donativos);
	}

}