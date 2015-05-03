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
use Doacao\Service\HomeService;
use Doctrine\DBAL\Schema\View;
use Tropa\Form\LanternaForm;
use Tropa\Model\Lanterna;
use Zend\Authentication\AuthenticationService;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Helper\Json;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use ZfcUser\Service\User;

class HomeController extends AbstractDoctrineCrudController
{
    const PESSOA = '2';
    const INSTITUICAO = '3';
    private $homeService;

    public function __construct(){


        if(!$this->homeService){
            $this->homeService = new HomeService();
        }
    }

     public function indexAction()
     {

         $rota = null;

         $auth = new AuthenticationService();
         switch($this->homeService->validaPerfil($auth->getIdentity())){
             case self::PESSOA:
                $rota = 'pessoa';
                 break;
             case self::INSTITUICAO:
                 $rota = 'instituicao';
                 break;
         }

         return $this->redirect()->toRoute($rota);
     }

}
