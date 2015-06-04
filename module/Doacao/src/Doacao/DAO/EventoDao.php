<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 26/04/2015
 * Time: 20:32
 */

namespace Doacao\Dao;

use Application\Dao\AbstractDao;
use Doctrine\ORM\Query\Expr;


class EventoDao extends AbstractDao{

    protected  $entity = 'Application\Entity\Evento';
    protected $tbalias = 'evento';
    private $em;

    public function __construct(){
        $this->em = $this->getEntityManager();
    }

    //retorna querybuilder
    public function createQueryBuilder(){
        return $qb = $this->em->createQueryBuilder();
    }

    public function findEventoByID($id){
        $qb = $this->em
            ->createQueryBuilder()
            ->select($this->getTbAlias(), 'tbinst')
            ->from($this->getEntity(), $this->getTbAlias())
            ->leftJoin('Application\Entity\Instituicao', 'tbinst' , 'WITH', 'evento.idInstituicao = tbinst.id')
            ->where("evento.id = {$id}");
        return $qb->getQuery()->getResult();
    }

    public function selectEventosInstituicao($idpessoa){

        $qb = $this->em
            ->createQueryBuilder()
            ->select($this->getTbAlias())
            ->from($this->getEntity(), $this->getTbAlias())
            ->leftJoin('Application\Entity\Instituicao', 'tbinst' , 'WITH', 'evento.idInstituicao = tbinst.id')
            ->innerJoin('Application\Entity\MinhaInstituicao', 'mininst', 'WITH', 'evento.idInstituicao = mininst.idInstituicao')
            ->where("mininst.idPessoa = {$idpessoa}")
            ->andWhere("evento.dataFim >= CURRENT_DATE()")
        ;
        return $qb->getQuery()->getResult();
    }

    public function selectEventosInstituicaoRecente($idpessoa){

        $qb = $this->em
            ->createQueryBuilder()
            ->select($this->getTbAlias(), 'tbinst')
            ->from($this->getEntity(),$this->getTbAlias())
            ->leftJoin('Application\Entity\Instituicao', 'tbinst' , 'WITH', 'evento.idInstituicao = tbinst.id')
            ->innerJoin('Application\Entity\MinhaInstituicao', 'mininst', 'WITH', 'evento.idInstituicao = mininst.idInstituicao')
            ->where("evento.dataFim BETWEEN
                     CURRENT_DATE()-15 AND CURRENT_DATE()
                     AND mininst.idPessoa = {$idpessoa}
                     AND evento.dataFim >= CURRENT_DATE()
            ")
            ->orderBy('evento.dataInicio', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function selectEventosInstituicaoComFiltro($termo){

        $qb = $this->em
            ->createQueryBuilder()
            ->select($this->getTbAlias(), 'tbinst')
            ->from($this->getEntity(), $this->getTbAlias())
            ->leftJoin('Application\Entity\Instituicao', 'inst','WITH', 'evento.idInstituicao = tbinst.id')
            ->innerJoin('Application\Entity\MinhaInstituicao' ,'mininst','WITH', 'evento.idInstituicao = mininst.idInstituicao')
            ->where("tbinst.nomeFantasia LIKE '%{$termo}%'
                     AND evento.dataFim >= CURRENT_DATE()
            ")
            ->orderBy('tbinst.nomeFantasia', 'ASC');

       return $qb->getQuery()->getResult();
    }

}