<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Doacao\Controller;

use Application\Entity\TesteAnexo;
use Components\MVC\Controller\AbstractCrudController;
use Components\MVC\Controller\AbstractDoctrineCrudController;
use Doacao\Filter\PessoaFilter;
use Doacao\Form\PessoaForm;
use Doacao\Service\PessoaService;
use Doacao\Service\ServiceInstituicao;
use Doctrine\DBAL\Schema\View;
use Zend\Authentication\AuthenticationService;
use Zend\Form\Element\DateTime;
use Zend\Mail\Storage\Writable\Maildir;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Helper\Json;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Application\Entity\Pessoa;

class PessoaController extends AbstractDoctrineCrudController
{
    private $pessoaService;

    public function __construct(){

        if(!$this->pessoaService){
            $this->pessoaService = new PessoaService();
        }
    }

     public function indexAction()
     {

         //TODO verificar se user tem pessoa, se nao tiver redirecionar para dashboard editavel;
         $this->layout()->setTemplate('layout/layout_pessoa');

         $doacoes = null;
         if(!$doacoes){
             $doacoes = "Não há doações, siga instituições e doe.<br><a href='/pessoa/instituicao' class='btn btn-success'>Ver Instituicoes </a>";
         }

         $campanhas = $this->pessoaService->getEventosInstituicoesRecentes();
         if(!$campanhas){
             $campanhas = "No momento nenhuma instituicao que voce segue tem campanhas.<br>";
         }

         $dadosPessoa = $this->pessoaService->getObjPessoa();

         return new ViewModel(
             array(
                 'doacoes' => $doacoes,
                 'campanhas' => $campanhas,
                 'dadosPessoa' => $dadosPessoa
             )
         );
     }

    public function minhaContaAction(){
        $this->layout()->setTemplate('layout/layout_pessoa');
        return new ViewModel();
    }

    public function dadosPessoaAction(){
        $this->layout()->setTemplate('layout/layout_modal');
        $formPessoa = new PessoaForm();
        $request = $this->getRequest();

        /** @var Pessoa $pessoa */
        $pessoa = $this->pessoaService->getObjPessoa();

        //preenche o formulario se ja houver pessoa - requisicao ajax
        $img = '/img/data/sem-foto.jpg';
        if(null != $pessoa ){
            $formPessoa->bind($pessoa);
            $formPessoa->get('dataNasc')->setValue($pessoa->getDataNasc()->format('Y-m-d'));
            $img = $pessoa->getFoto();
        }

        if($request->isPost()){
            $post = $request->getPost();
            //var_dump($post);
            if(count($post) > 0){
                //alterar para uma classe somente de filtro
                $pessoa = new Pessoa();

                $formPessoa->setInputFilter($pessoa->getInputFilter());
                $formPessoa->setData($post);

                if($formPessoa->isValid()){
                    if($post['id']){
                        $this->pessoaService->salvarPessoa($formPessoa->getData());
                    }else{
                        $pessoa->exchangeArray($post);
                        $pessoa->setUsuario($this->getModel($this->getIdUserLogado(), 'Application\Entity\User'));
                        $this->pessoaService->salvarPessoa($pessoa);
                    }

                }
            }
        }

        return new ViewModel(
            array(
                'form' => $formPessoa,
                'img' => $img
            )
        );
    }


    //
    public function instituicaoAction(){
        $this->layout()->setTemplate('layout/layout_pessoa');

        $filtro = $this->params()->fromQuery('filtro');
        if($filtro){
            if($filtro == "minhas"){
                $instituicoes = $this->pessoaService->instituicoesPessoaSegue();
            }else{
                //$instituicoes = $instituicoesService->buscaInstituicoes();
                $instituicoes = $this->pessoaService->naoSegue();
            }

            return new JsonModel(
                array(
                    'instituicoes' => $instituicoes
                )
            );
        }
        // senao comportamento padrao, retorna a view
        else{
            $instituicoes = $this->pessoaService->naoSegue();
        }

        return new ViewModel(
            array(
                'instituicoes' => $instituicoes
            )
        );
    }

    public function eventosAction(){
        $this->layout()->setTemplate('layout/layout_pessoa');
        $eventos = $this->pessoaService->getEventosInstituicoes();

        return new ViewModel(
            array(
                'eventos' => $eventos
            )
        );
    }

    //Acao para seguir  instituicao
    public function seguirAction(){
        $seguido = null;
        $request = $this->getRequest();
        if ($request->isPost()) {
            $instituicaoId = $request->getPost('idInstituicao');


            $instituicaoService = new ServiceInstituicao();
            $inst = $instituicaoService->buscaUmaInstituicao($instituicaoId);

            $capturaPessoa = $this->pessoaService->getObjPessoa($this->pessoaService->getUserLogado());

            $seguido = $this->pessoaService->salvarSeguir($capturaPessoa, $inst);
        }

        $json = new JsonModel(
            array(
                "status" => $seguido
            )
        );
        return $json;
    }

    public function listarAutocompleteInstituicaoAction(){

        $termo = $this->params()->fromQuery('term');
        $retorno = $this->pessoaService->getPesquisaInstituicaoPorNome($termo);

        return new JsonModel($retorno);
    }
    public function pesquisarInstituicaoAction(){
        $nomeInstituicao = $this->params()->fromQuery('descricao');
        $instituicoes = $this->pessoaService->getPesquisaRapidaInstituicaoPorNome($nomeInstituicao);
        return new JsonModel(array(
            'instituicoes' => $instituicoes
        ));
    }

    public function listarAutocompleteEventoAction(){

        $termo = $this->params()->fromQuery('term');
        $retorno = $this->pessoaService->getEventosComFiltro($termo);

        return new JsonModel($retorno);
    }
    public function pesquisarEventoAction(){
        /*$nomeInstituicao = $this->params()->fromQuery('descricao');
        $instituicoes = $this->pessoaService->getPesquisaRapidaInstituicaoPorNome($nomeInstituicao);
        return new JsonModel(array(
            'instituicoes' => $instituicoes
        ));*/
    }


    public function testeAnexoAction(){
        $this->layout()->setTemplate('layout/layout_pessoa');
        return new ViewModel();
    }
}
