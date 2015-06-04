<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Doacao\Controller;

use Application\Entity\Pessoa;
use Application\Entity\TesteAnexo;
use Components\MVC\Controller\AbstractDoctrineCrudController;
use Doacao\Form\DivulgacaoEventoForm;
use Doacao\Form\EnderecoForm;
use Doacao\Form\PessoaForm;
use Doacao\Service\EventoService;
use Doacao\Service\PessoaService;
use Doacao\Service\ServiceInstituicao;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

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
         $this->layout()->setTemplate('layout/layout_pessoa');

         $doacoes = null;
         if(!$doacoes){
             $doacoes = "Não há doações, siga instituições e doe.<br><a href='/pessoa/instituicao' class='btn btn-success'>Ver Instituicoes </a>";
         }

         $eventoService = new EventoService();
         $campanhas = $eventoService->getEventosInstituicoesRecentes();
         if(!$campanhas){
             $campanhas = "No momento nenhuma instituicao que voce segue tem campanhas.<br>";
         }

         $dadosPessoa = $this->pessoaService->getObjPessoa();

         $formDivulgacao = new DivulgacaoEventoForm();

         return new ViewModel(
             array(
                 'doacoes' => $doacoes,
                 'campanhas' => $campanhas,
                 'dadosPessoa' => $dadosPessoa,
                 'formDivulgacao' => $formDivulgacao
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
        $formEndereco = new EnderecoForm();
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
            if(count($post) > 0){
                $pessoa = new Pessoa();
                $formPessoa->setInputFilter($pessoa->getInputFilter());
                $formPessoa->setData($post);

                //valida se o formulario é valido , se tiver id atualiza senao insere um novo
                if($formPessoa->isValid()){
                    if($post['id']){
                        $objpessoa = $formPessoa->getData();
                    }else{
                        $pessoa->exchangeArray($post);
                        $pessoa->setUsuario($this->getEntity($this->getIdUserLogado(), 'Application\Entity\User'));
                        $objpessoa = $pessoa;
                    }
                    $this->pessoaService->salvarPessoa($objpessoa);
                }
            }
        }

        return new ViewModel(
            array(
                'form' => $formPessoa,
                'formEndereco' => $formEndereco,
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

    public function instituicaoPageAction(){
        $this->layout()->setTemplate('layout/layout_pessoa');

        $id = $this->params()->fromQuery('id');
        $instituicaoService = new ServiceInstituicao();
        $instituicao = $instituicaoService->buscaUmaInstituicao($id);
        

        return new ViewModel(
            array(
                'instituicao' => $instituicao
            )
        );
    }

    public function solicitacaoAjaxAction(){



        return new JsonModel(
            array(

            )
        );
    }

}
