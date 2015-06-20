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


class InstituicaoDao extends AbstractDao{

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
            "SELECT inst FROM Application\Entity\Instituicao inst
                     WHERE inst.usuario = :id
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

    public function sumRecebidos($instituicao){
        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('SUM(t.quantidadeOferta)')
            ->from('\Application\Entity\Transacao','t')
            ->where('t.instituicao = :instituicao',(new Expr())->isNotNull('t.dataFinalizacao'))
            ->setParameter('instituicao',$instituicao);
        $result = (int)$qb->getQuery()->getSingleScalarResult();
        return $result;
    }

    public function countDonativos($instituicao){
        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select("COUNT(1)")
            ->from('\Application\Entity\Donativos','d')
            ->where('d.instituicao = :instituicao AND d.status = :status')
            ->setParameters(array('instituicao'=>$instituicao,'status'=>1));
        $result = (int)$qb->getQuery()->getSingleScalarResult();
        return $result;
    }

    public function countFinalizados($instituicao){
        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select("COUNT(1)")
            ->from('\Application\Entity\Transacao','t')
            ->where('t.instituicao = :instituicao',(new Expr())->isNotNull('t.dataFinalizacao'))
            ->setParameter('instituicao',$instituicao);
        $result = (int)$qb->getQuery()->getSingleScalarResult();
        return $result;
    }

    public function countPendentes($instituicao){
        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select("COUNT(1)")
            ->from('\Application\Entity\Transacao','t')
            ->where('t.instituicao = :instituicao',(new Expr())->isNull('t.dataFinalizacao'))
            ->setParameter('instituicao',$instituicao);

        $result = (int)$qb->getQuery()->getSingleScalarResult();
        return $result;
    }
    
}