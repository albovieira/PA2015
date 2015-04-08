<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Tropa\Controller;

use Components\MVC\Controller\AbstractCrudController;
use Components\MVC\Controller\AbstractDoctrineCrudController;
use Tropa\Form\LanternaForm;
use Tropa\Model\Lanterna;

class LanternaController extends AbstractDoctrineCrudController
{
    public function __construct(){
        $this->formClass = 'Tropa\Form\LanternaForm';
        $this->modelClass = 'Tropa\Model\Lanterna';
        $this->namespaceTableGateway = 'Tropa\Model\LanternaTable';
        $this->route = 'lanterna';
        $this->title = 'Cadastro de Lanternas Verdes';
        $this->label['yes'] = 'Sim';
        $this->label['no'] = 'Não';
        $this->label['add'] = 'Incluir';
        $this->label['edit'] = 'Alterar';
    }

    public function indexAction()
    {
        $viewModel = parent::indexAction();
        $urlHomepage = $this->url()->fromRoute('application', array('controller' => 'index', 'action'=>'menu'));

        $viewModel->setVariable('urlHomepage', $urlHomepage);

        // sem essa consulta o proxy não retornará o relacionamento
        $em = $GLOBALS['entityManager'];
        $em->getRepository('Tropa\Model\Setor')->findAll();

        return $viewModel;
    }
}
