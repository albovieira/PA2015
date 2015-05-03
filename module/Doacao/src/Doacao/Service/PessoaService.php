<?php

namespace Doacao\Service;

use Application\Entity\MinhaInstituicao;
use Zend\Authentication\AuthenticationService;
use Doacao\Dao\PessoaDao;


class PessoaService {

    const QTDREGISTRO = 0;
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

    public function salvarSeguir($idPessoa,$idInstituicao){

        $minhaInstituicao = new MinhaInstituicao();
        $minhaInstituicao->setIdPessoa($idPessoa);
        $minhaInstituicao->setIdInstituicao($idInstituicao);

        //valida se ja segue uma instituicao, sim sim exclui senao adiciona
        if($this->jaPossuiInstituicao($idPessoa->getId(), $idInstituicao->__get('id'))){
            $this->pessoaDAO->excluir($minhaInstituicao);
            return "nseguido";
        }
        else{
            $this->pessoaDAO->salvar($minhaInstituicao);
            return "seguido";
        }
    }

    public function jaPossuiInstituicao($idPessoa,$idInstituicao){
        $jaSegue = false;
        if($this->pessoaDAO->selectMinhaInstituicao($idPessoa,$idInstituicao)){
            $jaSegue = true;
        }
        return $jaSegue;
    }

    public function instituicoesPessoa(){
        $objInstituicao = $this->pessoaDAO->instituicoesPessoaSegue();
            $arrInstituicao = [];

            foreach($objInstituicao as $key=>$instituicao){
                $arrInstituicao[$key]['id'] = $instituicao->__get('id');
                $arrInstituicao[$key]['nomeFantasia'] = $instituicao->__get('nomeFantasia');
                $arrInstituicao[$key]['razaoSocial'] = $instituicao->__get('razaoSocial');
                $arrInstituicao[$key]['foto'] = $instituicao->__get('foto');
                $arrInstituicao[$key]['descricao'] = $instituicao->__get('descricao');
                $arrInstituicao[$key]['email'] = $instituicao->__get('email');
                $arrInstituicao[$key]['cnpj'] = $instituicao->__get('cnpj');
                $arrInstituicao[$key]['site'] = $instituicao->__get('site');
            }

            return $arrInstituicao;
    }


}