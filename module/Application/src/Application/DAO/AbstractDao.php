<?php

namespace Application\Dao;

use Components\Entity\AbstractEntity;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Expr;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;


class AbstractDao
{
    private $entityManager;

    public function __construct(){
        $this->getEntityManager();
    }

    public function getEntityManager(){
        $this->entityManager = $GLOBALS['entityManager'];
        return $this->entityManager;
    }
    public function salvar(AbstractEntity $entity){
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function excluir(AbstractEntity $entity){
        $this->entityManager->remove($entity->getId());
        $this->entityManager->flush();
    }

}