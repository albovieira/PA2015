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


}