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
use Components\MVC\Controller\AbstractDoctrineCrudController;
use Doacao\Service\EventoService;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class EventoController extends AbstractDoctrineCrudController
{
    private $eventoService;

    public function __construct(){
        if(!$this->eventoService){
            $this->eventoService = new EventoService();
        }
    }

    // era eventos action
    public function indexAction(){
        $this->layout()->setTemplate('layout/layout_pessoa');
        $eventos = $this->eventoService->getEventosInstituicoes();

        return new ViewModel(
            array(
                'eventos' => $eventos
            )
        );
    }

    public function eventoPageAction(){
        $this->layout()->setTemplate('layout/layout_pessoa');

        $id = $this->params()->fromQuery('id');
        $eventoService = new EventoService();
        $evento = $eventoService->getEventoPorID($id);

        return new ViewModel(
            array(
                'evento' => $evento[0]
            )
        );
    }

    public function publicarAction(){
        $post = $this->getRequest()->getPost();
        return new JsonModel();
    }


    public function listarAutocompleteEventoAction(){

        $termo = $this->params()->fromQuery('term');
        $retorno = $this->eventoService->getEventosComFiltro($termo);

        return new JsonModel($retorno);
    }


}
