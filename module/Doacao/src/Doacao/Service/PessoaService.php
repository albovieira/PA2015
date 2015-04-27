<?php

namespace Doacao\Service;

use Zend\Authentication\AuthenticationService;
use Doacao\Dao\PessoaDao;


class PessoaService {

    private $pessoaDAO;
    public function __construct(){
        $this->pessoaDAO = new PessoaDao();
    }

    public function getUserLogado(){
        $auth = new AuthenticationService();
        return $auth->getIdentity();
    }

    public function dadosPessoa($id){
        if($id){
            return $this->pessoaDAO->selectPorUsuario($id);
        }
    }



}