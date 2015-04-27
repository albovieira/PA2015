<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 26/04/2015
 * Time: 20:32
 */

namespace Doacao\Dao;

class PessoaDao {

    private $em;

    public function __construct(){
        $this->getEntityManager();
    }

    public function getEntityManager(){
        $this->em = $GLOBALS['entityManager'];
        return $this->em;
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
}