<?php
/**
 * Created by PhpStorm.
 * User: Hebert
 * Date: 14/06/2015
 * Time: 00:56
 */

namespace Doacao\Dao;


use Application\Dao\AbstractDao;

class StatusDAO {
    private $em;

    public function __construct(){
        $this->em = (new AbstractDao())->getEntityManager();
    }

    public function buscaStatus($id)
    {
        return $this->em->getRepository('\Application\Entity\Status')->find($id);
    }


}