<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 21/02/2015
 * Time: 09:39
 */

namespace Components\MVC\Controller;

use Tropa\Form\SetorForm;
use Zend\Authentication\AuthenticationService;
use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

abstract class AbstractDoctrineCrudController extends AbstractActionController
{
    protected $formClass;
    protected $modelClass;
    protected $namespaceTableGateway;
    protected $route;
    protected $tableGateway;
    protected $title;
    protected $label = array(
        'add' 	=>'Add',
        'edit'	=>'Edit',
        'yes'	=>'Yes',
        'no'	=>'No'
    );

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
        $result = $em->getRepository($this->modelClass)->findAll();


        $pageAdapter = new ArrayAdapter($result);
        $paginator = new Paginator($pageAdapter);
        $paginator->setCurrentPageNumber($this->params()->fromRoute('page',1));

        return new ViewModel(array(
            'paginator' => $paginator,
            'title' => $this->setAndGetTitle(),
            'urlAdd' => $urlAdd,
            'urlHomepage' => $urlHomepage
        ));
    }

    public function addAction()
    {
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
        $form->get('submit')->setAttribute('value', $this->label['edit']);

        $urlAction = $this->url()->fromRoute($this->route, array(
            'action' => 'edit',
            'key' => $key
        ));

        return $this->save($model, $form, $urlAction, $key);
    }

    protected function save($model, $form, $urlAction, $key)
    {

        $request = $this->getRequest();

        if($request->isPost() ){
            $form->setInputFilter($model->getInputFilter());

            $form->setData($request->getPost());

            if ($form->isValid())
            {
                $model->exchangeArray($form->getData());

                $em = $GLOBALS['entityManager'];
                $em->persist($model);
                $em->flush();
                //return $this->redirect()->toRoute($this->route);
                return $this->redirect()->toRoute('despesa');
            }else{
                return new JsonModel(array(
                    'retorno' => 'erro',
                ));
            }

        }
        //}

        return array(
            'key' => $key,
            'form' => $form,
            'urlAction' => $urlAction,
            'title' => $this->setAndGetTitle(),
            'model' => $model,
        );
    }

    public function deleteAction()
    {

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

        return array(
            'form' => $this->getDeleteForm($key),
            'urlAction' => $urlAction,
            'title' => $this->setAndGetTitle()
        );
    }

    public function getDeleteForm($key)
    {
        $form = new Form();

        $form->add(array(
            'name' => 'del',
            'attributes' => array(
                'type'  => 'submit',
                'value' => $this->label['yes'],
                'id' => 'del',
                'class' => 'btn btn-default'
            ),
        ));

        $form->add(array(
            'name' => 'return',
            'attributes' => array(
                'type'  => 'submit',
                'value' => $this->label['no'],
                'id' => 'return',
                'class' => 'btn btn-default'
            ),
        ));

        return $form;
    }

    protected function getModel($key)
    {
        $em = $GLOBALS['entityManager'];
        return $em->getRepository($this->modelClass)->find($key);
    }

    protected function getSm()
    {
        return $this->getEvent()->getApplication()->getServiceManager();
    }

    protected function setAndGetTitle()
    {
        $headTitle = $this->getSm()->get('viewhelpermanager')->get('HeadTitle');
        $headTitle($this->title);
        return $this->title;
    }

}