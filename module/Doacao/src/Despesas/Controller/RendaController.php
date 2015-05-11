<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Despesas\Controller;

use Components\MVC\Controller\AbstractCrudController;
use Components\MVC\Controller\AbstractDoctrineCrudController;
use Tropa\Form\LanternaForm;
use Tropa\Model\Lanterna;

class RendaController extends AbstractDoctrineCrudController
{
    public function __construct(){
        $this->formClass = 'Despesas\Form\RendaForm';
        $this->modelClass = 'Despesas\Model\Renda';
        $this->route = 'renda';
        $this->title = 'Cadastro de Renda';
        $this->label['yes'] = 'Sim';
        $this->label['no'] = 'Não';
        $this->label['add'] = 'Incluir';
        $this->label['edit'] = 'Alterar';
    }

    public function indexAction()
    {
        $viewModel = parent::indexAction();
        $urlHomepage = $this->url()->fromRoute('application', array('controller' => 'index', 'action'=>'menu'));
        $urlAddRendaExtra = $this->url()->fromRoute('renda', array('controller' => 'addRendaExtra', 'action'=>'addRendaExtra'));

        $viewModel->setVariables(
            array(
            'urlHomepage' => $urlHomepage,
            'urlAddRendaExtra' => $urlAddRendaExtra
            )
        );

        // sem essa consulta o proxy não retornará o relacionamento
        $em = $GLOBALS['entityManager'];
        $em->getRepository('Despesas\Model\TipoRenda')->findAll();

        return $viewModel;
    }

    public function addRendaExtraAction(){
        $modelClass = $this->modelClass;
        $model = new $modelClass(
            $this->getTableGateway()->getPrimaryKey(),
            $this->getTableGateway()->getTable(),
            $this->getTableGateway()->getAdapter(), false);


        $formClass = $this->formClass;

        $form = new $formClass();

        $form->get('submit')->setValue($this->label['add']);
        $form->bind($model);
        $urlAction = $this->url()->fromRoute($this->route, array('action' => 'add'));

        return $this->save($model, $form, $urlAction, null);
    }
}
