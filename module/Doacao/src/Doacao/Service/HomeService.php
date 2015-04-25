<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 25/04/2015
 * Time: 11:52
 */

namespace Doacao\Service;


class HomeService {


    public function validaPerfil($id){
        $em = $GLOBALS['entityManager'];
        $objUser = $em->getRepository('Application\Entity\User')->findById($id);
        return $objUser[0]->getPerfil();
    }
}