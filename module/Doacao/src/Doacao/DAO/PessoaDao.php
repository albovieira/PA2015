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

class PessoaDao extends AbstractDao{

    protected $entity = 'Application\Entity\Pessoa';
    protected $tbalias = 'pes';
    private $em;

    public function __construct(){
        $this->em = $this->getEntityManager();
    }

    public function selectPorUsuario($idUsuario){
            $qb = $this->em
                ->createQueryBuilder()
                ->select($this->getTbAlias(),'endereco')
                ->from($this->getEntity(), $this->getTbAlias())
                ->leftJoin('Application\Entity\Endereco', 'endereco' , 'IN', 'pes.idEndereco = endereco.id')
                ->where('pes.usuario = :id')
                ->setParameter('id',$idUsuario);

        $result = $qb->getQuery()->getResult();

        if($result){
            return $result[0];
        }

        return false;

    }

    public function selectMinhaInstituicao($idPessoa,$idInstituicao){
        $qb = $this->em
                ->createQueryBuilder()
                ->select('minInst')
                ->from('Application\Entity\MinhaInstituicao', 'minInst')
                ->where('minInst.idPessoa = :idPessoa AND
                           minInst.idInstituicao = :idInstituicao')
                ->setParameters(array(
                   'idPessoa' => $idPessoa,
                    'idInstituicao' => $idInstituicao
                ));

        $result = $qb->getQuery()->getResult();
        if(empty($result)){
            return false;
        }
        return $result[0]->getId();
    }

    public function instituicoesPessoaSegue($idpessoa){

        $qb = $this->em
            ->createQueryBuilder()
            ->select('i')
            ->from('Application\Entity\Instituicao', 'i')
            ->innerJoin('Application\Entity\MinhaInstituicao', 'm', 'WITH', 'i.id = m.idInstituicao')
            ->where("m.idPessoa = {$idpessoa}");
        ;
        return $result = $qb->getQuery()->getResult();
    }

    public function getQuantTotalMinhasInstituicoes($idpessoa){
        $qb = $this->em
            ->createQueryBuilder()
            ->select('sum(pes)')
            ->from('Application\Entity\Pessoa', 'pes')
            ->innerJoin('Application\Entity\MinhaInstituicao', 'm', 'WITH', 'pes.id = m.idPessoa')
            ->where("m.idPessoa = {$idpessoa}");
        ;
        return $qb->getQuery()->getSingleScalarResult();
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

    // retorna array
    public function selectInstituicaoAutoComplete($termo){

        $qb = $this->em
            ->createQueryBuilder()
            ->select('tbinst.nomeFantasia')
            ->from('Application\Entity\Instituicao', 'tbinst')
            ->where("tbinst.nomeFantasia LIKE '%{$termo}%'")
            ->orderBy('tbinst.nomeFantasia', 'asc');
        return $qb->getQuery()->getResult();
    }

    // retorna objeto
    public function selectPesquisaRapida($termo){

        $qb = $this->em
            ->createQueryBuilder()
            ->select('tbinst')
            ->from('Application\Entity\Instituicao', 'tbinst')
            ->where("tbinst.nomeFantasia LIKE '%{$termo}%'")
            ->orderBy('tbinst.nomeFantasia', 'asc');
        return $qb->getQuery()->getResult();
    }

}