<?php

namespace Doacao\Service;

use Application\Entity\MinhaInstituicao;
use Application\Entity\Evento;
use Application\Entity\Pessoa;
use Application\Service\AbstractService;
use Components\Entity\AbstractEntity;
use Doacao\Dao\EventoDao;
use Zend\Authentication\AuthenticationService;
use Doacao\Dao\PessoaDao;
use Application\Entity\Instituicao;

//TODO retirar metodos de evento e instituicoes e passar para services especificos

class EventoService extends AbstractService{

    const QTDREGISTRO = 0;
    private $eventoDAO;

    public function __construct(){
        $this->eventoDAO = new EventoDao();
    }

}