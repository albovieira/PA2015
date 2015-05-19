<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 08/05/2015
 * Time: 21:26
 */

namespace Application\Service;


use Zend\Authentication\AuthenticationService;

class AbstractService {

    public function getUserLogado(){
        $auth = new AuthenticationService();
        return $auth->getIdentity();
    }
}