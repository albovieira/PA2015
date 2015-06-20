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
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Service\ViewHelperManagerFactory;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Helper\Json;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Doacao\Service;

class InstituicaoController extends AbstractDoctrineCrudController
{
	private $service;
	private $instituicao;
	
    public function __construct(){
    	$this->service = new ServiceInstituicao();
		$this->instituicao = $this->service->getObjInstituicao();
    }

    public function indexAction()
    {
    	$this->layout()->setTemplate('layout/layout_menu_Instituicao');
		$estatisticas['totalRecebido'] = $this->service->recebidos($this->instituicao);
       	return new ViewModel(array(
        	'perfil'=> $this->instituicao,
           	'estatisticas' => $estatisticas
       	));
    }

	public function totaisAction(){
		$jm = new JsonModel();
		$totais['recebidos'] = \Zend\Json\Json::encode($this->service->recebidos($this->instituicao));
		$totais['finalizados'] = \Zend\Json\Json::encode($this->service->finalizados($this->instituicao));
		$totais['pendentes'] = \Zend\Json\Json::encode($this->service->pendentes($this->instituicao));
		$totais['donativos'] = \Zend\Json\Json::encode($this->service->donativosAtivos($this->instituicao));
		return $jm->setVariable("totais",$totais);
	}
    
    public function novoAction(){
    	
    }

}
