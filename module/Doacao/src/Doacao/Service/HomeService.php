<?php

namespace Doacao\Service;


class HomeService {


    public function validaPerfil($id){
        $em = $GLOBALS['entityManager'];
        $objUser = $em->getRepository('Application\Entity\User')->findById($id);
        return $objUser[0]->getPerfil();
    }
}