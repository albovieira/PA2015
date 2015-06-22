<?php
/**
 * Created by PhpStorm.
 * User: Hebert
 * Date: 14/06/2015
 * Time: 01:02
 */

namespace Doacao\Service;


use Doacao\Dao\StatusDAO;

class StatusService {
    private $dao;

    public function __construct(){
        $this->dao = new StatusDAO();
    }

    public function ativado(){
        return $this->dao->buscaStatus(1);
    }

    public function desativado(){
        return $this->dao->buscaStatus(2);
    }

    public function finalizado(){
        return $this->dao->buscaStatus(3);
    }

}