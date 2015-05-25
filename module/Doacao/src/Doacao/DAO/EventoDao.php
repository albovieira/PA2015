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


class EventoDao extends AbstractDao{

    private $em;

    public function __construct(){
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

    public function instituicoesPessoaSegue($idpessoa){
        $query = $this->em->createQuery(
            "SELECT tbinst FROM Application\Entity\Instituicao tbinst
                     INNER JOIN Application\Entity\MinhaInstituicao mininst WITH tbinst.id = mininst.idInstituicao
                     WHERE mininst.idPessoa = :idpessoa
            ");
        $query->setParameters(
            array(
                'idpessoa' => $idpessoa
            ));
        $result = $query->getResult();
        return $result;
    }

    public function todasInstituicoesQueNaoSegue($idpessoa){

        $qb  = $this->em->createQueryBuilder();
        $qbSub = $qb;
        $qbSub->select('identity(mininst.idInstituicao)')
            ->from('Application\Entity\MinhaInstituicao', 'mininst')
            ->where($qbSub->expr()->eq('mininst.idPessoa', $idpessoa));

        $qb  = $this->em->createQueryBuilder();
        $qb->select('tbinst')
            ->from('Application\Entity\Instituicao', 'tbinst')
            ->where($qb->expr()->notIn('tbinst.id', $qbSub->getDQL())
            );


        $result = $qb->getQuery()->getResult();
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



    public function selectEventosInstituicao($idpessoa){
        $query = $this->em->createQuery(
            "SELECT evento,tbinst FROM Application\Entity\Evento evento
                     LEFT JOIN Application\Entity\Instituicao tbinst WITH evento.idInstituicao = tbinst.id
                     INNER JOIN Application\Entity\MinhaInstituicao mininst WITH evento.idInstituicao = mininst.idInstituicao
                     WHERE mininst.idPessoa = :idpessoa
                ");
        $query->setParameters(
            array(
                'idpessoa' => $idpessoa
            ));
        $result = $query->getResult();
        return $result;
    }

    public function selectEventosInstituicaoRecente($idpessoa){
        $query = $this->em->createQuery(
            "SELECT evento,tbinst FROM Application\Entity\Evento evento
                     LEFT JOIN Application\Entity\Instituicao tbinst WITH evento.idInstituicao = tbinst.id
                     INNER JOIN Application\Entity\MinhaInstituicao mininst WITH evento.idInstituicao = mininst.idInstituicao
                     WHERE
                     evento.dataFim BETWEEN
                     CURRENT_DATE()-15 AND CURRENT_DATE()
                     AND mininst.idPessoa = :idpessoa
                     ORDER BY evento.dataInicio DESC
                ");
        $query->setParameters(
            array(
                'idpessoa' => $idpessoa
            ));
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
        $result = $query->getResult();
        return $result;
    }

}