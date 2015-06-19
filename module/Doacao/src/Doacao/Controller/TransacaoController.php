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
use Application\Entity\Transacao;
use Components\MVC\Controller\AbstractDoctrineCrudController;
use Doacao\Form\TransacaoForm;
use Doacao\Service\DonativoService;
use Doacao\Service\HelperService;
use Doacao\Service\PessoaService;
use Doacao\Service\TransacaoService;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class TransacaoController extends AbstractDoctrineCrudController
{
    private $transacaoService;

    public function __construct(){
        if(!$this->transacaoService){
            $this->transacaoService = new TransacaoService();
        }
    }

    public function indexAction(){
        $this->layout()->setTemplate('layout/layout_menu_instituicao');
        $vm = new ViewModel();
        return $vm;
    }

    public function novaTransacaoAction(){
        $this->layout()->setTemplate('layout/layout_modal');

        $post = $this->getRequest()->getPost();
        $mensagens = null;
        $donativoService = new DonativoService();
        $pessoaService = new PessoaService();
        $donativos = $donativoService->getDonativoById($post['idDonativo']);

        $formTransacao = new TransacaoForm();
        $data = new \DateTime('now');

        /** @var Transacao $jaTemTransacao */
        $jaTemTransacao =  $this->transacaoService->getTransacaoPorPessoaeDonativo($pessoaService->getObjPessoa()->getId(), $donativos->getId());

         if(!empty($post['quantidadeOferecida'])){
            $transacao = new Transacao();
            $formTransacao->setInputFilter($transacao->getInputFilter());
            $formTransacao->setData($post);
            if($formTransacao->isValid()){
                $this->transacaoService->salvar($post,$transacao);
            }
        }
         else if($jaTemTransacao){
             $formTransacao->get('idTransacao')->setValue($jaTemTransacao->getId());
             $formTransacao->get('idDonativo')->setValue($jaTemTransacao->getIdDonativo());
             $formTransacao->get('idInstituicao')->setValue($jaTemTransacao->getIdInstituicao());
             $formTransacao->get('idPessoa')->setValue($jaTemTransacao->getIdPessoa());
             $formTransacao->get('dataTransacao')->setValue($data->format('Y-m-d'));
             $formTransacao->get('quantidadeOferecida')->setValue($jaTemTransacao->getQuantidadeOferta());

             $mensagens = $this->transacaoService->getMensagensTransacao($jaTemTransacao->getId());
         }
         else{
            //seta manualmente os campos hidden
            $formTransacao->get('idDonativo')->setValue($donativos->getId());
            $formTransacao->get('idInstituicao')->setValue($donativos->getInstituicao()->getId());
            $formTransacao->get('idPessoa')->setValue($pessoaService->getObjPessoa()->getId());
            $formTransacao->get('dataTransacao')->setValue($data->format('Y-m-d'));
        }

        return new ViewModel(
            array(
                'form' => $formTransacao,
                'donativo' =>  $donativos,
                'mensagens' => $mensagens,
            )
        );
    }

    public function confirmaRecebimentoAction(){
        $request = $this->getRequest();
        $response = $this->getResponse();
        $id = $request->getPost();

        if ($this->transacaoService->donativoRecebido($id->id)){
            $response =  \Zend\Json\Json::encode(1);
        }else{
            $response = \Zend\Json\Json::encode(0);
        }

        $jm = new JsonModel();
        $jm->setTerminal(true);
        $jm->setVariable('data',$response);

        return $jm;

    }

    public function pendentesAction(){
        $vm = new ViewModel();
        $vm->setTerminal($this->getRequest()->isXmlHttpRequest());
        $offset = 0;
        $limit = 5;

        $request = $this->getRequest();

        if(isset($request)){
            $data = $request->getPost();
            if(isset($data)){
                $limit = $data->limit;
            }
        }

        $pessoa = array();
        $transacao = array();
        $donativo = array();
        $result = $this->transacaoService->buscaTransacaoPendente($pessoa,$donativo,$transacao,$offset, $limit);

        if($result != ""){
            $vm->setVariable('erro',$result);
        }else{
            $vm->setVariables(array('transacao'=>$transacao,'pessoa'=>$pessoa,'donativo'=>$donativo));
        }

        return $vm;
    }

    public function efetivadosAction(){
        $vm = new ViewModel();
        $vm->setTerminal($this->getRequest()->isXmlHttpRequest());
        $pessoa = array();
        $transacao = array();
        $donativo = array();
        $result = $this->transacaoService->buscaTransacaoEfetivadas($pessoa,$donativo,$transacao,0,5);
        if($result != ""){
            $vm->setVariable('erro',$result);
        }else{
            $vm->setVariables(array('transacao'=>$transacao,'pessoa'=>$pessoa,'donativo'=>$donativo));
        }

        return $vm;
    }

    public function expiradosAction(){
        return (new ViewModel())
            ->setTerminal($this->getRequest()->isXmlHttpRequest());
    }


}
