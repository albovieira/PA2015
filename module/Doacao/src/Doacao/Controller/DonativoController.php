<?php
/**
 * Zend Framework (http://framework.zend.com/)
*
* @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
* @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
* @license   http://framework.zend.com/license/new-bsd New BSD License
*/

namespace Doacao\Controller;

use Components\MVC\Controller\AbstractCrudController;
use Components\MVC\Controller\AbstractDoctrineCrudController;
use Doctrine\DBAL\Schema\View;
use Zend\Authentication\AuthenticationService;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Helper\Json;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Application\Entity\Donativos;
use Doacao\Form\DonativoForm;
use Doacao\Service\DonativoService;
use Application\Service\AbstractService;
use Doacao\Service\TransacaoService;

class DonativoController extends AbstractDoctrineCrudController
{
	private static $service;
	
	public function __construct(){
		self::$service = new DonativoService();
	}
	
	public function indexAction()
	{
		$this->layout()->setTemplate('layout/layout_menu_Instituicao');
		$page = $this->params()->fromRoute('page',1);
		$paginacao = self::$service->pagina($page);
		$donativos = self::$service->donativosPorInstituicao();
		
		$vm = new ViewModel();
		$vm->setVariable('page', $page);
		$vm->setVariable('donativos', $paginacao);
		return $vm;
		
	}
	
	public function novoAction(){
		$form = new DonativoForm();
		$jsonRequest = true;
		
		return (new ViewModel())
		->setTerminal($this->getRequest()->isXmlHttpRequest())
		->setVariable('form', $form)
		->setVariable('e_json', $jsonRequest)
		->setVariable('userID', (new AbstractService())->getUserLogado())
		->setVariable('now', self::$service->retornaData("now"));
		
	}
	
	public function validaAjaxAction(){
		$request = $this->getRequest();
		$response = $this->getResponse();

		if($request->isPost()){
			$data = $request->getPost();
			
			$status = self::$service->save($data); 
			
			if($status == ""){
				$response = \Zend\Json\Json::encode(array('success'=>1));
			}else{
				$response = \Zend\Json\Json::encode(array('error'=>$status));
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
	
	public function doarAction(){
		$request = $this->getRequest();
		$response = $this->getRresponse();
		$data = $request->getPost();
		$pessoa = $data->pessoa;
		$instituicao = $data->instituicao;
		$donativo = $data->donativo;
		$dataTransacao = $data->diaAbertura;
		$dataExpiracao = $data->diaAbertura + 30; //Expira em X dias;
		$quantidade = $data->quantidade;
		
	}
	
}