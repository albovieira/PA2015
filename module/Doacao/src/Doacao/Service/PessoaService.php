<?php

namespace Doacao\Service;

use Application\Entity\MinhaInstituicao;
use Application\Entity\Evento;
use Application\Service\AbstractService;
use Zend\Authentication\AuthenticationService;
use Doacao\Dao\PessoaDao;

class PessoaService extends AbstractService{

    const QTDREGISTRO = 0;
    private $pessoaDAO;

    public function __construct(){
        $this->pessoaDAO = new PessoaDao();
    }

    public function getObjPessoa(){
        $usuario = $this->getUserLogado();
        return $this->pessoaDAO->selectPorUsuario($usuario);
    }

    public function getUserLogado(){
        $auth = new AuthenticationService();
        return $auth->getIdentity();
    }

    public function salvarSeguir($idPessoa,$idInstituicao){

        //valida se ja segue uma instituicao, sim sim exclui senao adiciona
        $possuiInstituicao = $this->jaPossuiInstituicao($idPessoa->getId(), $idInstituicao->__get('id'));
        if($possuiInstituicao != null){
            $this->pessoaDAO->excluir($this->pessoaDAO->findById($possuiInstituicao, 'Application\Entity\MinhaInstituicao'));
            return "nseguido";
        }
        else{
            $minhaInstituicao = new MinhaInstituicao();
            $minhaInstituicao->setIdPessoa($idPessoa);
            $minhaInstituicao->setIdInstituicao($idInstituicao);

            $this->pessoaDAO->salvar($minhaInstituicao);
            return "seguido";
        }
    }

    public function jaPossuiInstituicao($idPessoa,$idInstituicao){
        return $this->pessoaDAO->selectMinhaInstituicao($idPessoa,$idInstituicao)
                ? $this->pessoaDAO->selectMinhaInstituicao($idPessoa,$idInstituicao)
                : null;
    }

    public function getPesquisaInstituicaoPorNome($term){
        return $this->pessoaDAO->selectAutoComplete($term);
    }

    public function getPesquisaRapidaInstituicaoPorNome($term){
        $objInstituicao = $this->pessoaDAO->selectPesquisaRapida($term);
        $arrInstituicao = [];

        foreach($objInstituicao as $key=>$instituicao){
            if($instituicao != null){
                $arrInstituicao[$key]['id'] = $instituicao->__get('id');
                $arrInstituicao[$key]['nomeFantasia'] = $instituicao->__get('nomeFantasia');
                $arrInstituicao[$key]['razaoSocial'] = $instituicao->__get('razaoSocial');
                $arrInstituicao[$key]['foto'] = $instituicao->__get('foto');
                $arrInstituicao[$key]['descricao'] = $instituicao->__get('descricao');
                $arrInstituicao[$key]['email'] = $instituicao->__get('email');
                $arrInstituicao[$key]['cnpj'] = $instituicao->__get('cnpj');
                $arrInstituicao[$key]['site'] = $instituicao->__get('site');
            }
        }
        return $arrInstituicao;
    }

    public function naoSegue(){
        $objInstituicao = $this->pessoaDAO->todasInstituicoesQueNaoSegue();
        $arrInstituicao = [];

        foreach($objInstituicao as $key=>$instituicao){
            if($instituicao != null){
                $arrInstituicao[$key]['id'] = $instituicao->__get('id');
                $arrInstituicao[$key]['nomeFantasia'] = $instituicao->__get('nomeFantasia');
                $arrInstituicao[$key]['razaoSocial'] = $instituicao->__get('razaoSocial');
                $arrInstituicao[$key]['foto'] = $instituicao->__get('foto');
                $arrInstituicao[$key]['descricao'] = $instituicao->__get('descricao');
                $arrInstituicao[$key]['email'] = $instituicao->__get('email');
                $arrInstituicao[$key]['cnpj'] = $instituicao->__get('cnpj');
                $arrInstituicao[$key]['site'] = $instituicao->__get('site');
            }
        }

        return $arrInstituicao;

    }

    public function instituicoesPessoaSegue(){
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

    public function getEventosInstituicoes(){
        $objEvento = $this->pessoaDAO->selectEventosInstituicao();
        $arrEvento = [];


        foreach($objEvento as $key=>$evento){
            // necessario pois o retorno esta trazendo as instituicoes tbm
            if($evento instanceof Evento){
                $arrEvento[$key]['id'] = $key;
                $arrEvento[$key]['nomeFantasia'] = $evento->getIdInstituicao()->__get('nomeFantasia');
                $arrEvento[$key]['descEvento'] = $evento->getDescEvento();
                $arrEvento[$key]['siteEvento'] = $evento->getSiteEvento();
                $arrEvento[$key]['objetivos'] = $evento->getObjetivos();
                $arrEvento[$key]['tituloEvento'] = $evento->getTituloEvento();
                $arrEvento[$key]['dataInicio'] = $evento->getDataInicio();
                $arrEvento[$key]['dataFim'] = $evento->getDataFim();
                $arrEvento[$key]['imagem1'] = $evento->getImagem1();
                $arrEvento[$key]['imagem2'] = $evento->getImagem2();
                $arrEvento[$key]['imagem3'] = $evento->getImagem3();
          }
        }

        return $arrEvento;
    }


    public function dateToString($data){
        return $data->format('d/m/Y');
    }

}