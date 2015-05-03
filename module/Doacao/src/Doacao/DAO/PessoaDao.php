<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 26/04/2015
 * Time: 20:32
 */

namespace Doacao\Dao;

use Doctrine\DBAL\Query\QueryBuilder;
use Components\Entity\AbstractEntity;

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

    public function salvar(AbstractEntity $entity){
        $em = $this->getEntityManager();
        $em->persist($entity);
        $em->flush();
    }

    public function excluir(AbstractEntity $entity){
        $em = $this->getEntityManager();
        $em->remove($entity);
        $em->flush();
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
        $arrayObjs = [];
        foreach($result as $itens){
            $arrayObjs = $itens;
        }

        return $arrayObjs;
    }

    public function instituicoesPessoaSegue(){
        $query = $this->em->createQuery(
            "SELECT tbinst FROM Application\Entity\Instituicao tbinst
                     INNER JOIN Application\Entity\MinhaInstituicao mininst WITH tbinst.id = mininst.idInstituicao
            ");

        $result = $query->getResult();

        return $result;

    }

}