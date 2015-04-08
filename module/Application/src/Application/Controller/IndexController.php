<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Form\LoginForm;
use Application\Model\Usuario;
use Components\MVC\Controller\AbstractDoctrineCrudController;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractDoctrineCrudController
{

    public function __construct(){
        $this->modelClass = 'Application\Model\Usuario';
    }

   public function indexAction()
    {
        return new ViewModel();
    }

    public function modalLoginAction(){

         $urlAdd = $this->url()->fromRoute($this->route, array('action'=>'cadastrar'));
         $form = new LoginForm();
         $form->setAttribute('action', $this->getRequest()->getBaseUrl() . '/application/index/login');
         $messages = '';
         if ($this->flashMessenger()->getMessages())
         {
             $messages = implode(',', $this->flashMessenger()->getMessages());
         }

        $this->layout()->setTemplate('layout/layout_modal');

        return array(
            'form'=>$form,
            'messages'=>$messages,
            'urlAdd' => $urlAdd
        );
    }


    public function loginAction()
    {
        $request = $this->getRequest();

        $login = $request->getPost('login');
        $senha = $request->getPost('senha');

        $usuario = new Usuario($login, $senha);


        if ($usuario->authenticate())
        {
            // valida se o usuario é instituição ou pessoa
            if($usuario->getPerfilUsuario($usuario->getLogin()) == 0){
                //return $this->redirect()->toRoute('doacao');
                return $this->redirect()->toRoute('pessoa');
            }else{
                return $this->redirect()->toRoute('instituicao');
            }

        }
        $this->flashMessenger()->addMessage(implode(',',$usuario->messages));
        return $this->redirect()->toRoute('home');
    }

    public function menuAction()
    {

        $authentication = new AuthenticationService();
        if($authentication->hasIdentity()){
            return array('usuario'=>$authentication->getIdentity());
        }
        return $this->redirect()->toRoute('home');
    }

    public function logoutAction()
    {
        $authentication = new AuthenticationService();
        $authentication->clearIdentity();

        return $this->redirect()->toRoute('home');
    }

    public function cadastrarAction(){
        $form = new LoginForm('cadastro_form');

        $request = $this->getRequest();
        $login = $request->getPost('login');

        $senha = $request->getPost('senha');
        $confirmaSenha = $request->getPost('confirmarCredencial');

        if($senha !== $confirmaSenha){
            $messages = 'Senhas não conferem';
            return array(
                'form'=>$form,
                'messages'=>$messages,
            );

        }

        $model = new Usuario($login, $senha);
        $urlAction = $this->url()->fromRoute($this->route, array('action' => 'cadastrar'));

        return $this->save($model, $form, $urlAction, null);

    }

    public function accountAction(){
        $form = new LoginForm('cadastro_form');

        $form->get('cadastrar')->setValue($this->label['add']);
        $authentication = new AuthenticationService();
        if($authentication->hasIdentity()){
            $id = $authentication->getIdentity()->id;
        }

        $model = $this->getModel($id);

        $form->bind($model);

        $urlAction = $this->url()->fromRoute($this->route, array('action' => 'account'));

        return $this->save($model, $form, $urlAction, $id);
    }
}
