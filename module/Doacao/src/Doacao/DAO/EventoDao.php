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

    public function selectEventosInstituicao($idpessoa){

        $qb = $this->em
            ->createQueryBuilder()
            ->select($this->getTbAlias())
            ->from($this->getEntity(), $this->getTbAlias())
            ->leftJoin('Application\Entity\Instituicao', 'tbinst' , 'WITH', 'evento.idInstituicao = tbinst.id')
            ->innerJoin('Application\Entity\MinhaInstituicao', 'mininst', 'WITH', 'evento.idInstituicao = mininst.idInstituicao')
            ->where("mininst.idPessoa = {$idpessoa}");
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
                     AND mininst.idPessoa = {$idpessoa}")
            ->orderBy('evento.dataInicio', 'DESC');

        //var_dump($qb->getQuery()->getResult());die;
        return $qb->getQuery()->getResult();
      /*
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
      */
    }

    public function selectEventosInstituicaoComFiltro($termo){

        $qb = $this->em
            ->createQueryBuilder()
            ->select($this->getTbAlias(), 'tbinst')
            ->from($this->getEntity(), $this->getTbAlias())
            ->leftJoin('Application\Entity\Instituicao', 'inst','WITH', 'evento.idInstituicao = tbinst.id')
            ->innerJoin('Application\Entity\MinhaInstituicao' ,'mininst','WITH', 'evento.idInstituicao = mininst.idInstituicao')
            ->where("tbinst.nomeFantasia LIKE '%{$termo}%'")
            ->orderBy('tbinst.nomeFantasia', 'ASC');
        $qb->getQuery()->getResult();
    }

}