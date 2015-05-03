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
use Doacao\Service\ServiceInstituicao;
use Doctrine\DBAL\Schema\View;
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
        $this->layout()->setTemplate('layout/layout_pessoa');
        $instituicoesService = new ServiceInstituicao();


        //$instituicoes = null;
        $filtro = $this->params()->fromQuery('filtro');

        if($filtro){
            if($filtro == "minhas"){
                $instituicoes = $this->pessoaService->instituicoesPessoa();
            }else{
                $instituicoes = $instituicoesService->buscaInstituicoes();
            }

            return new JsonModel(
                array(
                    'instituicoes' => $instituicoes
                )
            );
        }

        else{
            $instituicoes = $instituicoesService->buscaInstituicoes();
        }

        return new ViewModel(
            array(
                'instituicoes' => $instituicoes
            )
        );
    }

    public function seguirAction(){
        //$view = new ViewModel();
        //$view->setTerminal(true);

        //$this->request();
        $seguido = null;
        $request = $this->getRequest();
        if ($request->isPost()) {
            $instituicaoId = $request->getPost('idInstituicao');
            $instituicaoService = new ServiceInstituicao();
            $inst = $instituicaoService->buscaUmaInstituicao($instituicaoId);

            $capturaPessoa = $this->pessoaService->dadosPessoa($this->pessoaService->getUserLogado());

            $seguido = $this->pessoaService->salvarSeguir($capturaPessoa, $inst);
        }

        //var_dump($seguido);die;
        //$view->setVariables(array('teste' => 'teste'));
        //return $view;

        $json = new JsonModel(
            array(
                "status" => $seguido
            )
        );
        return $json;
    }
}
