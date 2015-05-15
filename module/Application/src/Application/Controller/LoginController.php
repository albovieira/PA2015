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
use ZfcUser\Controller\UserController;

class LoginController //extends UserController//extends UserController
{

    public function __construct(){

    }

    public function loginAction(){
        //echo 'eessssssssssssssssss';
        //$this->layout()->setTemplate('layout_modal.phtml');
        //parent::loginAction();
    }

}
