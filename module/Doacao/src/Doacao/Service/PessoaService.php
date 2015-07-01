<?php

namespace Doacao\Service;

use Application\Entity\Instituicao;
use Application\Entity\MinhaInstituicao;
use Application\Service\AbstractService;
use Doacao\Dao\PessoaDao;

//TODO retirar metodos de evento e instituicoes e passar para services especificos

class PessoaService extends AbstractService{

    const QTDREGISTRO = 0;
    private $pessoaDAO;

    public function __construct(){
        $this->pessoaDAO = new PessoaDao();
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
     *
     * @param $idPessoa
     * @param $idInstituicao
     * @return bool|null
     */
    public function jaPossuiInstituicao($idPessoa,$idInstituicao){

        if($idPessoa){
            return $this->pessoaDAO->selectMinhaInstituicao($idPessoa,$idInstituicao)
                ? $this->pessoaDAO->selectMinhaInstituicao($idPessoa,$idInstituicao)
                : null;
        }
        return null;
    }

    /**
     * Autocomplete , instituicoes por nome
     * @param $term
     * @return mixed
     */
    public function getPesquisaInstituicaoPorNome($term){
        return $this->pessoaDAO->selectInstituicaoAutoComplete($term);
    }

    /**
     * Pesquisa instituicoes por nome
     *
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

            if($instituicao instanceof Instituicao) {
                if ($instituicao != null) {
                    $arrInstituicao[$key]['id'] = $instituicao->getId();
                    $arrInstituicao[$key]['nomeFantasia'] = $instituicao->getNomeFantasia();
                    $arrInstituicao[$key]['razaoSocial'] = $instituicao->getRazaoSocial();
                    $arrInstituicao[$key]['foto'] = $instituicao->getFoto();
                    $arrInstituicao[$key]['descricao'] = $instituicao->getDescricao();
                    $arrInstituicao[$key]['email'] = $instituicao->getEmail();
                    $arrInstituicao[$key]['cnpj'] = $instituicao->getCnpj();
                    $arrInstituicao[$key]['site'] = $instituicao->getSite();
                    $arrInstituicao[$key]['telCel'] = $instituicao->getSite();
                    $arrInstituicao[$key]['telFixo'] = $instituicao->getSite();
                }
            }
        }

        return $arrInstituicao;
    }

    /**
     * @return array
     */
    public function naoSegue(){
        $instituicao = null;
        if($this->getObjPessoa()){
            $objInstituicao = $this->pessoaDAO->todasInstituicoesQueNaoSegue($this->getObjPessoa()->getId());
            return $this->bindInstituicao($objInstituicao);
        }
        return $instituicao;
    }

    /**
     * @return array
     */
    public function getObjPessoa(){
        $usuario = $this->getUserLogado();
        return $this->pessoaDAO->selectPorUsuario($usuario);
    }

    /**
     * @return array
     */
    public function instituicoesPessoaSegue(){

        $instituicao = null;
        if($this->getObjPessoa()){
            $objInstituicao = $this->pessoaDAO->instituicoesPessoaSegue($this->getObjPessoa()->getId());
            $instituicao = $this->bindInstituicao($objInstituicao);
        }

        return $instituicao;
    }

    public function quantInstituicoesPessoaSegue(){
        return $this->pessoaDAO->getQuantTotalMinhasInstituicoes($this->getObjPessoa()->getId());
    }


    /**
     * @param $data
     * @return mixed
     */
    public function dateToString($data){
        return $data->format('d/m/Y');
    }

    public function salvar($entidade){
        $this->pessoaDAO->salvar($entidade);
    }

    public function update($entidade){
        $this->pessoaDAO->updateEntity($entidade);
    }
}