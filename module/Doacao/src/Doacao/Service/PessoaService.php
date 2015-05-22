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

    /**
     * @return array
     */
    public function getObjPessoa(){
        $usuario = $this->getUserLogado();
        return $this->pessoaDAO->selectPorUsuario($usuario);
    }


    /**
     * @param $idPessoa
     * @param $idInstituicao
     * @return string
     */
    public function salvarSeguir($idPessoa,$idInstituicao){

        //valida se ja segue uma instituicao, sim sim exclui senao adiciona
        $possuiInstituicao = $this->jaPossuiInstituicao($idPessoa->getId(), $idInstituicao->getId());
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

    /**
     * @param $idPessoa
     * @param $idInstituicao
     * @return bool|null
     */
    public function jaPossuiInstituicao($idPessoa,$idInstituicao){
        return $this->pessoaDAO->selectMinhaInstituicao($idPessoa,$idInstituicao)
                ? $this->pessoaDAO->selectMinhaInstituicao($idPessoa,$idInstituicao)
                : null;
    }

    /**
     * @param $term
     * @return mixed
     */
    public function getPesquisaInstituicaoPorNome($term){
        return $this->pessoaDAO->selectAutoComplete($term);
    }

    /**
     * @param $term
     * @return array
     */
    public function getPesquisaRapidaInstituicaoPorNome($term){
        $objInstituicao = $this->pessoaDAO->selectPesquisaRapida($term);
        return $this->bindInstituicao($objInstituicao);
    }

    /**
     * @param $objInstituicao
     * @return array
     */
    public function bindInstituicao($objInstituicao){
        $arrInstituicao = [];

        /** * @var Instituicao $instituicao */
        foreach($objInstituicao as $key=>$instituicao){
            if($instituicao != null){
                $arrInstituicao[$key]['id'] = $instituicao->getId();
                $arrInstituicao[$key]['nomeFantasia'] = $instituicao->getNomeFantasia();
                $arrInstituicao[$key]['razaoSocial'] = $instituicao->getRazaoSocial();
                $arrInstituicao[$key]['foto'] = $instituicao->getFoto();
                $arrInstituicao[$key]['descricao'] = $instituicao->getDescricao();
                $arrInstituicao[$key]['email'] = $instituicao->getEmail();
                $arrInstituicao[$key]['cnpj'] = $instituicao->getCnpj();
                $arrInstituicao[$key]['site'] = $instituicao->getSite();
            }
        }

        return $arrInstituicao;
    }

    /**
     * @return array
     */
    public function naoSegue(){
        $objInstituicao = $this->pessoaDAO->todasInstituicoesQueNaoSegue();
        return $this->bindInstituicao($objInstituicao);
    }

    /**
     * @return array
     */
    public function instituicoesPessoaSegue(){
        $objInstituicao = $this->pessoaDAO->instituicoesPessoaSegue();
        return $this->bindInstituicao($objInstituicao);
    }

    /**
     * @return array
     */
    public function getEventosInstituicoes(){
        $objEvento = $this->pessoaDAO->selectEventosInstituicao();
        return $this->bindEvento($objEvento);
    }

    /**
     * @param $objEvento
     * @return array
     */
    public function bindEvento($objEvento){
        $arrEvento = [];

        foreach($objEvento as $key=>$evento){
            // necessario pois o retorno esta trazendo as instituicoes tbm
            if($evento instanceof Evento){
                $arrEvento[$key]['id'] = $key;
                $arrEvento[$key]['nomeFantasia'] = $evento->getIdInstituicao()->getNomeFantasia();
                $arrEvento[$key]['descEvento'] = $evento->getDescEvento();
                $arrEvento[$key]['siteEvento'] = $evento->getSiteEvento();
                $arrEvento[$key]['objetivos'] = $evento->getObjetivos();
                $arrEvento[$key]['tituloEvento'] = $evento->getTituloEvento();
                $arrEvento[$key]['dataInicio'] = $evento->getDataInicio();
                $arrEvento[$key]['dataFim'] = $this->dateToString($evento->getDataFim());
                $arrEvento[$key]['imagem1'] = $evento->getImagem1();
                $arrEvento[$key]['imagem2'] = $evento->getImagem2();
                $arrEvento[$key]['imagem3'] = $evento->getImagem3();
            }
        }
        return $arrEvento;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function dateToString($data){
        return $data->format('d/m/Y');
    }

    /**
     * @return array
     */
    public function getEventosInstituicoesRecentes(){
        $objEvento = $this->pessoaDAO->selectEventosInstituicaoRecente();
        return $this->bindEvento($objEvento);
    }

    /**
     * @param $termo
     * @return array
     */
    public function getEventosComFiltro($termo){
        $objEvento = $this->pessoaDAO->selectEventosInstituicaoComFiltro($termo);
        return $this->bindEvento($objEvento);
    }

}