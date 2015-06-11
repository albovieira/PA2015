<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Doacao\Controller;

use Application\Entity\Donativos;
use Application\Entity\TesteAnexo;
use Components\MVC\Controller\AbstractDoctrineCrudController;
use Doacao\Form\TransacaoForm;
use Doacao\Service\DonativoService;
use Doacao\Service\PessoaService;
use Doacao\Service\TransacaoService;
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
        return new ViewModel();
    }

    public function novaTransacaoAction(){
        $this->layout()->setTemplate('layout/layout_modal');

        $donativoService = new DonativoService();
        $pessoaService = new PessoaService();

        $post = $this->getRequest()->getPost();
        if(isset($post['id_donativo'])){
            /** @var Donativos $donativos */
            $donativos = $donativoService->getDonativoById($post['id_donativo']);
        }
        $formTransacao = new TransacaoForm();

        //seta manualmente os campos hidden
        $data = new \DateTime('now');
        $formTransacao->get('idDonativo')->setValue($donativos->getId());
        $formTransacao->get('idInstituicao')->setValue($donativos->getInstituicao()->getId());
        $formTransacao->get('idPessoa')->setValue($pessoaService->getObjPessoa()->getId());
        $formTransacao->get('dataTransacao')->setValue($data->format('Y-m-d'));

        return new ViewModel(
            array(
                'form' => $formTransacao,
                'donativo' =>  $donativos
            )
        );
    }
}
