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
use Doacao\Service\ServiceInstituicao;
use Doctrine\DBAL\Schema\View;
use Tropa\Form\LanternaForm;
use Tropa\Model\Lanterna;
use Zend\Authentication\AuthenticationService;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Helper\Json;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Doacao\Service;

class InstituicaoController extends AbstractDoctrineCrudController
{
	private $service;
	
    public function __construct(){
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
       	$this->service = new ServiceInstituicao();
       	$id = $this->service->getUserLogado();
       	$instituicao = $this->service->buscaUmaInstituicao($id);
       	$donativo = $this->service->listaDonativos($instituicao);
       	$perfil = $this->service->montaPerfilHtml($instituicao);
       	return new ViewModel(array(
        	'perfil'=> $perfil,
           	'listaDonativos' => $donativo
       	));
    }
    
    public function novoAction(){
    	
    }
    
    
}
