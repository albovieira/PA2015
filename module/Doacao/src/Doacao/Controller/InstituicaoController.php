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

class InstituicaoController extends AbstractDoctrineCrudController
{
    public function __construct(){
        /* $this->formClass = 'Despesas\Form\DespesaForm';
         $this->modelClass = 'Despesas\Model\Despesa';
         $this->route = 'despesa';
         $this->title = 'Cadastro de Despesas';
         $this->label['yes'] = 'Sim';
         $this->label['no'] = 'Não';
         $this->label['add'] = 'Incluir';
         $this->label['edit'] = 'Alterar';
        */
     }

     public function indexAction()
     {
         $this->layout()->setTemplate('layout/layout_menu_Instituicao');
         return new ViewModel();
     }
}
