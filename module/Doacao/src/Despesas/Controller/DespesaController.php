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
use Doctrine\DBAL\Schema\View;
use Tropa\Form\LanternaForm;
use Tropa\Model\Lanterna;
use Zend\Authentication\AuthenticationService;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Helper\Json;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class DespesaController extends AbstractDoctrineCrudController
{
    public function __construct(){
        $this->formClass = 'Despesas\Form\DespesaForm';
        $this->modelClass = 'Despesas\Model\Despesa';
        $this->route = 'despesa';
        $this->title = 'Cadastro de Despesas';
        $this->label['yes'] = 'Sim';
        $this->label['no'] = 'Não';
        $this->label['add'] = 'Incluir';
        $this->label['edit'] = 'Alterar';
    }

    public function indexAction()
    {
        $partialLoop = $this->getSm()->get('viewhelpermanager')->get('PartialLoop');
        $partialLoop->setObjectKey('model');

        $urlAdd = $this->url()->fromRoute($this->route, array('action'=>'add'));
        $urlEdit = $this->url()->fromRoute($this->route, array('action'=>'edit'));
        $urlDelete = $this->url()->fromRoute($this->route, array('action'=>'delete'));
        $urlHomepage = $this->url()->fromRoute('home');

        $placeHolder = $this->getSm()->get('viewhelpermanager')->get('Placeholder');
        $placeHolder('url')->edit = $urlEdit;
        $placeHolder('url')->delete = $urlDelete;


        $em = $GLOBALS['entityManager'];
        $authentication = new AuthenticationService();
        $user = $authentication->getIdentity();

        $query = $em->createQuery(
            "SELECT des FROM Despesas\Model\Despesa des
                     LEFT JOIN des.salario ren
                     WHERE des.user = :id
                     and
                     des.data BETWEEN
                     CURRENT_DATE()-30 AND CURRENT_DATE()
                     ORDER BY des.data DESC
                ");
        $query->setParameters(
            array(
                'id' => $user->uid,
            ));

        $result = $query->getResult();
        $pageAdapter = new ArrayAdapter($result);
        $paginator = new Paginator($pageAdapter);
        $paginator->setCurrentPageNumber($this->params()->fromRoute('page',1));


        return new ViewModel(array(
            'paginator' => $paginator,
            'title' => $this->setAndGetTitle(),
            'urlAdd' => $urlAdd,
            'urlHomepage' => $urlHomepage,
            'difSalario' => parent::getDifSalario()
        ));
    }

    /*  */
    public function addAction(){

        $modelClass = $this->modelClass;
        $model = new $modelClass(
            $this->getTableGateway()->getPrimaryKey(),
            $this->getTableGateway()->getTable(),
            $this->getTableGateway()->getAdapter(), false);


        $formClass = $this->formClass;

        $form = new $formClass();
        $form->get('submit')->setAttributes(
            array(
                'value' => $this->label['add'],
                'class' => 'btn bt btn-success'
            )
        );


        $form->bind($model);

        $urlAction = $this->url()->fromRoute($this->route, array('action' => 'add'));

        $this->layout()->setTemplate('layout/layout_modal');

        return $this->save($model, $form, $urlAction, null);

    }


    public function editAction()
    {
        $key = (int) $this->params()->fromRoute('key', null);

        if ($key == null)
        {
            return $this->redirect()->toRoute($this->route, array(
                'action' => 'add'
            ));
        }

        $model = $this->getModel($key);
        $formClass = $this->formClass;
        $form  = new $formClass();

        $form->bind($model);
        $valorSelect = $form->get('tipoDespesa')->getValue()->getId();
        $form->get('tipoDespesa')->setValue($valorSelect);

        $form->get('submit')->setAttributes(
            array(
                'value' => $this->label['edit'],
                'class' => 'btn bt btn-primary'
            )
        );

        $urlAction = $this->url()->fromRoute($this->route, array(
            'action' => 'edit',
            'key' => $key
        ));

        $this->layout()->setTemplate('layout/layout_modal');

        return $this->save($model, $form, $urlAction, $key);
    }

    public function deleteAction(){

        $key = (int) $this->params()->fromRoute('key', null);
        if (is_null($key))
        {
            return $this->redirect()->toRoute($this->route);
        }

        $request = $this->getRequest();
        if ($request->isPost())
        {
            $del = $request->getPost('del', $this->label['no']);

            if ($del == $this->label['yes'])
            {
                $em = $GLOBALS['entityManager'];
                $em->remove($this->getModel($key));
                $em->flush();
            }

            return $this->redirect()->toRoute($this->route);
        }

        $urlAction = $this->url()->fromRoute($this->route, array('action' => 'delete','key'=> $key));

        $viewModel = new ViewModel();
        $viewModel->setTemplate('/despesa/despesa/delete');
        $this->layout()->setTemplate('layout/layout_modal');

        return array(
            'form' => $this->getDeleteForm($key),
            'urlAction' => $urlAction,
            'title' => $this->setAndGetTitle()
        );
    }

    public function listarAutoCompleteAction(){

        $this->layout()->setTemplate('layout/layout_modal');


        $em = $GLOBALS['entityManager'];
        $authentication = new AuthenticationService();
        $user = $authentication->getIdentity();

        $term = $this->params()->fromQuery('term');

        $query = $em->createQuery(
            "SELECT des.descDespesa FROM Despesas\Model\Despesa des
                     LEFT JOIN des.salario ren
                     WHERE des.user = :id
                     and
                     des.data BETWEEN
                     CURRENT_DATE()-7 AND CURRENT_DATE()
                     AND
                     des.descDespesa LIKE :termoAuto
                     ORDER BY des.descDespesa ASC
                ");

        $query->setParameters(
            array(
                'id' => $user->uid,
                'termoAuto' => '%' .$term. '%'
            ));


        $resultFim = [];
        $result = $query->getResult();

        foreach($result as $itens){
            foreach($itens as $i){
                $resultFim[] = $i;
            }
        }

        $this->layout()->setTemplate('layout/layout_modal');


        return new JsonModel($resultFim);
    }

    public function pesquisaRapidaAction(){
        $descricao = $this->params()->fromQuery('descricao');
        $this->layout()->setTemplate('layout/layout_modal');

        //var_dump($descricao);
        return new JsonModel($descricao);
    }
}
