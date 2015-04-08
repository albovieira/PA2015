<?php

namespace Components\MVC\Controller;


use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Components\Model\AbstractModel;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;

abstract class AbstractCrudController extends AbstractActionController{
    protected $formClass;
    protected $modelClass;
    protected $namespaceTableGateway;
    protected $route;
    protected $tableGateway;
    protected $title;
    protected $label = array(
        'add' => 'Add',
        'edit' => 'Edit',
        'yes' => 'Yes',
        'no' => 'No',
    );


    public function indexAction()
    {
        //para funcionar paginacao com o paginator e necessario que se crie um objeto aqui no index de partial loope e o retorne para a view
        $partialLoop = $this->getSM()->get('viewhelpermanager')->get('PartialLoop');
        $partialLoop->setObjectKey('model');

        // cria as urls da pagina
        $urlAdd = $this->url()->fromRoute($this->route, array('action' => 'add'));
        $urlEdit = $this->url()->fromRoute($this->route, array('action' => 'edit'));
        $urlDel = $this->url()->fromRoute($this->route, array('action' => 'delete'));
        $urlHomePage = $this->url()->fromRoute('home');

        // classe place holder pode ser capturada na view sem que seja passad os dados no array view model
        $placeholder = $this->getSM()->get('viewhelpermanager')->get('Placeholder');
        $placeholder('url')->edit = $urlEdit;
        $placeholder('url')->delete= $urlDel;

        $pageAdapter = new DbSelect($this->getTableGateway()->getSelect(),$this->getTableGateway()->getSql());
        $paginator = new Paginator($pageAdapter);
        $paginator->setCurrentPageNumber($this->params()->fromRoute('page',1));


        // retorno com os valores que eu quiser passar para a view
        return new ViewModel(array(
            'paginator' => $paginator,
            'title' => $this->setAndGetTitle('Setores'),
            'urlAdd' => $urlAdd,
            'urlHomepage' => $urlHomePage
        ));
    }

    public function addAction()
    {
        $modelClass = $this->modelClass;
        $model = new $modelClass();
        $formClass = $this->formClass;
        $form = new $formClass();

        $form->get('submit')->setValue($this->label['add']);
        $form->bind($model);

        $urlAction = $this->url()->fromRoute($this->route,array('action' => 'add'));

        return $this->save($model, $form, $urlAction, null);
    }

    public function editAction()
    {
        // valida se possui um codigo
        $key = (int)$this->params()->fromRoute('key', null);

        if (is_null($key)) {

            return $this->redirect()->toRoute($this->route, array(
                'action', 'add'
            ));
        }

        $model = $this->getTableGateway()->get($key);

        $formClass = $this->formClass;
        $form = new $formClass();

        //preenche o form com os dados da tabela
        $form->bind($model);
        $form->get('submit')->setAttribute('value', $this->label['edit']);

        $urlAction = $this->url()->fromRoute($this->route, array(
            'action' => 'edit',
            'key' => $key
        ));

        return $this->save( $model, $form, $urlAction, $key);
    }

    public function save(AbstractModel $model, $form, $urlAction, $key){
        $request = $this->getRequest();
        if ($request->isPost())
        {
            $form->setInputFilter($model->getInputFilter());

            $form->setData($request->getPost());



            if ($form->isValid())
            {
                $this->getTableGateway()->save($form->getData());
                return $this->redirect()->toRoute($this->route);
            }
        }

        return array(
            'key' => $key,
            'form' => $form,
            'urlAction' => $urlAction,
            'title' => $this->setAndGetTitle()
        );
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
                $this->getTableGateway()->delete($key);
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

    public function getTableGateway(){
        if (!$this->tableGateway) {
            $sm = $this->getServiceLocator();
            $this->tableGateway = $sm->get($this->namespaceTableGateway);
        }
        return $this->tableGateway;
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
            ),
        ));

        $form->add(array(
            'name' => 'return',
            'attributes' => array(
                'type'  => 'submit',
                'value' => $this->label['no'],
                'id' => 'return',
            ),
        ));

        return $form;
    }


    protected function getSM()
    {
        return $this->getEvent()->getApplication()->getServiceManager();
    }

    protected function setAndGetTitle(){
        $headTitle = $this->getSM()->get('viewhelpermanager')->get('HeadTitle');
        $headTitle($this->title);
        return $this->title;
    }
}