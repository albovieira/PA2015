<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 21/02/2015
 * Time: 09:21
 */

namespace Components\Authentication\Adapter;


use Zend\Authentication\Adapter\AbstractAdapter;
use Zend\Authentication\Result;

class DoctrineTable extends AbstractAdapter
{
    protected $entityManager;
    protected $entityName;
    protected $identityColumn;
    protected $credentialColumn;
    protected $valid = false;
    protected $resultRowObject = null;
    protected $nome;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;
        return $this;
    }

    public function setIdentityColumn($identityColumn)
    {
        $this->identityColumn = $identityColumn;
        return $this;
    }

    public function setCredentialColumn($credentialColumn)
    {
        $this->credentialColumn = $credentialColumn;
        return $this;
    }


    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }

    public function authenticate()
    {
        $identityColumn = $this->identityColumn;
        $credentialColumn = $this->credentialColumn;
        $nome = $this->nome;


        $dql = "select u from {$this->entityName} u where u.$identityColumn = ?1 and u.$credentialColumn = ?2";
        $query = $this->entityManager->createQuery($dql);
        $query->setParameter(1, $this->identity);
        $query->setParameter(2, $this->credential);

        $result = $query->getResult();



        $code = Result::FAILURE;

        if (!empty($result)) {
            $code = Result::SUCCESS;
            $this->resultRowObject = $result[0];
        }

        return new Result($code, $this->identity);
    }
    public function getPerfilUsuario($login)
    {
        $dql = "select u.perfil from {$this->entityName} u where u.login = ?1";
        $query = $this->entityManager->createQuery($dql);
        $query->setParameter(1, $login);

        $resultado = [];
        $resultado = $query->getResult();

        return $resultado[0]["perfil"];

    }


    public function getResultRowObject()
    {
        return $this->resultRowObject;
    }

}