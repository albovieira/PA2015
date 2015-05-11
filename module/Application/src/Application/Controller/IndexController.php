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
}
