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
use Doacao\Service\PessoaService;
use Doctrine\DBAL\Schema\View;
use Tropa\Form\LanternaForm;
use Tropa\Model\Lanterna;
use Zend\Authentication\AuthenticationService;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Helper\Json;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class PessoaController extends AbstractDoctrineCrudController
{
    private $pessoaService;
    public function __construct(){
        $this->pessoaService = new PessoaService();
    }

     public function indexAction()
     {
         //TODO verificar se user tem pessoa, se nao tiver redirecionar para dashboard editavel;
         $this->layout()->setTemplate('layout/layout_pessoa');

         $doacoes = null;
         if(!$doacoes){
             $retorno = "Não há doações, siga instituições e doe.<br><a href='#' class='btn btn-success'>Ver Instituicoes </a>";
         }

         $dadosPessoa = $this->pessoaService->dadosPessoa($this->pessoaService->getUserLogado());

         return new ViewModel(
             array(
                 'retorno' => $retorno,
                 'dadosPessoa' => $dadosPessoa
             )
         );
     }

    //
    public function instituicaoAction(){
        $this->layout()->setTemplate('layout/layout_instituicao');
        return new ViewModel();
    }
}
