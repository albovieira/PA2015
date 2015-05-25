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

class EventoController extends AbstractDoctrineCrudController
{
    private $eventoService;

    public function __construct(){

        if(!$this->eventoService){
            $this->eventoService = new PessoaService();
        }
    }

}
