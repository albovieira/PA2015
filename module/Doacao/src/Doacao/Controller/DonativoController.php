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
use Tropa\Form\LanternaForm;
use Tropa\Model\Lanterna;
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

class DonativoController extends AbstractDoctrineCrudController
{
	private static $service;
	
	public function __construct(){
		self::$service = new DonativoService();
	}
	
	public function init(){
		$contextAjax = $this->_helper->getHelper('AjaxContext');
		$contextAjax->addActionContext('teste','html')
					->initContext();

	}
	
	/**
	 * Seta o layout padrão para as páginas de instituicão
	 */
	private function setLayout(){
		return $this->layout()->setTemplate('layout/layout_menu_Instituicao');
	}
	
	public function indexAction()
	{
		$this->setLayout();
	}
	
	public function novoAction(){
		$form = new DonativoForm();
		$request = $this->getRequest();
		$jsonRequest = true;
		
		return (new ViewModel())
		->setTerminal($this->getRequest()->isXmlHttpRequest())
		->setVariable('form', $form)
		->setVariable('e_json', $jsonRequest)
		->setVariable('userID', (new AbstractService())->getUserLogado())
		->setVariable('now', (new \DateTime("now")))
		->setVariable('old', (new \DateTime("1900-01-01")));
		
	}
	
	public function validaAjaxAction(){
		$form = new DonativoForm();
		$request = $this->getRequest();
		$responde = $this->getResponse();
		
		if($request->isPost()){
			$data = $request->getPost();
			self::$service->save($data);
		}
		
		return "{'insercao':'Ok'}";exit();
	}
	
	public function doarAction(){
		$this->setLayout();
	}
}