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

    public function getIdUserLogado(){
        $auth = new AuthenticationService();
        return $auth->getIdentity();
    }

    protected function getModel($key, $model)
    {
        $em = $GLOBALS['entityManager'];
        return $em->getRepository($model)->find($key);
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