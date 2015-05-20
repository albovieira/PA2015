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
    /**
     * Esta função é responsável por retornar um array de um determinado objeto
     * @param mixed $objectArray
     * @param String $association
     * @return multitype:
     */
    protected function decompoeObjeto($objectArray, $association){
        $associationArray = array();
        foreach($objectArray->__get($association) as $decomposte):
            array_push($associationArray,$decomposte);
        endforeach;
        return $associationArray;
    }
}