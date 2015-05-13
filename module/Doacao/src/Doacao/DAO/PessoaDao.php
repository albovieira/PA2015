<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 26/04/2015
 * Time: 20:32
 */

namespace Doacao\Dao;

use Application\Dao\AbstractDao;
use Doctrine\DBAL\Query\QueryBuilder;
use Components\Entity\AbstractEntity;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Expr;


class PessoaDao extends AbstractDao{

    private $em;

    public function __construct(){

        /** @var  em */
        $this->em = $this->getEntityManager();
    }

    //retorna querybuilder
    public function createQueryBuilder(){
        return $qb = $this->em->createQueryBuilder();
    }


    public function selectPorUsuario($idUsuario){
        $query = $this->em->createQuery(
            "SELECT pes FROM Application\Entity\Pessoa pes
                     WHERE pes.usuario = :id
                ");

        $query->setParameters(
            array(
                'id' => $idUsuario,
            ));

        $arrayObjs = [];
        $result = $query->getResult();

        foreach($result as $itens){
            $arrayObjs = $itens;
        }

        return $arrayObjs;
    }

    public function select(){
        //$this->entityManager
    }

    public function selectMinhaInstituicao($idPessoa,$idInstituicao){
       $query = $this->em->createQuery(
            "SELECT minInst FROM Application\Entity\MinhaInstituicao minInst
                     WHERE minInst.idPessoa = :idPessoa AND
                           minInst.idInstituicao = :idInstituicao
            ");

        $query->setParameters(
            array(
                'idPessoa' => $idPessoa,
                'idInstituicao' => $idInstituicao
            ));
        $result = $query->getResult();
        if(empty($result)){
            return false;
        }
        return $result[0]->getId();
    }

    public function instituicoesPessoaSegue(){
        $query = $this->em->createQuery(
            "SELECT tbinst FROM Application\Entity\Instituicao tbinst
                     INNER JOIN Application\Entity\MinhaInstituicao mininst WITH tbinst.id = mininst.idInstituicao
            ");
        $result = $query->getResult();
        return $result;
    }

    public function todasInstituicoesQueNaoSegue(){

        $query = $this->em->createQuery(
            "SELECT tbinst,mininst FROM Application\Entity\Instituicao tbinst
                     LEFT JOIN Application\Entity\MinhaInstituicao mininst WITH tbinst.id = mininst.idInstituicao
                WHERE mininst.idPessoa is null
            ");
//        echo $query->getSql();exit;
        $result = $query->getResult();
        return $result;
    }

    public function selectAutoComplete($termo){
        $query = $this->em->createQuery(
            "SELECT tbinst.nomeFantasia FROM Application\Entity\Instituicao tbinst
                     WHERE tbinst.nomeFantasia LIKE :termoAuto
                     ORDER BY tbinst.nomeFantasia ASC
                ");
        $query->setParameters(
            array(
                'termoAuto' => '%' .$termo. '%'
            ));
        //echo $query->getSql();exit;
        $result = $query->getResult();
        return $result;
    }

    public function selectPesquisaRapida($termo){
        $query = $this->em->createQuery(
            "SELECT tbinst FROM Application\Entity\Instituicao tbinst
                     WHERE tbinst.nomeFantasia LIKE :termoAuto
                     ORDER BY tbinst.nomeFantasia ASC
                ");
        $query->setParameters(
            array(
                'termoAuto' => '%' .$termo. '%'
            ));
        //echo $query->getSql();exit;
        $result = $query->getResult();
        return $result;
    }

    public function selectEventosInstituicao(){
        $query = $this->em->createQuery(
            "SELECT evento,tbinst FROM Application\Entity\Evento evento
                     LEFT JOIN Application\Entity\Instituicao tbinst WITH evento.idInstituicao = tbinst.id
                     INNER JOIN Application\Entity\MinhaInstituicao mininst WITH evento.idInstituicao = mininst.idInstituicao
                ");
        //echo $query->getSql();exit;
        //var_dump($query->getResult());exit;
        $result = $query->getResult();
        return $result;
    }

    public function selectEventosInstituicaoRecente(){
        $query = $this->em->createQuery(
            "SELECT evento,tbinst FROM Application\Entity\Evento evento
                     LEFT JOIN Application\Entity\Instituicao tbinst WITH evento.idInstituicao = tbinst.id
                     INNER JOIN Application\Entity\MinhaInstituicao mininst WITH evento.idInstituicao = mininst.idInstituicao
                     WHERE
                     evento.dataFim BETWEEN
                     CURRENT_DATE()-15 AND CURRENT_DATE()
                     ORDER BY evento.dataInicio DESC
                ");
        //echo $query->getSql();exit;
        //var_dump($query->getResult());exit;
        $result = $query->getResult();
        return $result;
    }

    public function selectEventosInstituicaoComFiltro($termo){
        $query = $this->em->createQuery(
            "SELECT evento,tbinst FROM Application\Entity\Evento evento
                     LEFT JOIN Application\Entity\Instituicao tbinst WITH evento.idInstituicao = tbinst.id
                     INNER JOIN Application\Entity\MinhaInstituicao mininst WITH evento.idInstituicao = mininst.idInstituicao
                     WHERE tbinst.nomeFantasia LIKE :termoAuto
                     ORDER BY tbinst.nomeFantasia ASC
                ");
        $query->setParameters(
            array(
                'termoAuto' => '%' .$termo. '%'
            ));
        //echo $query->getSql();exit;
        //var_dump($query->getResult());exit;
        $result = $query->getResult();
        return $result;
    }

}