<?php
/**
 * Created by PhpStorm.
 * User: Hebert
 * Date: 14/06/2015
 * Time: 01:05
 */

namespace Doacao\Service;

/**
 * Class HelperService
 * @package Doacao\Service
 * Este Helper é um conjunto de funções mixadas que podem ser usadas em qualquer parte do código fonte
 */
class HelperService {
    /**
     * @param $data
     * @return \DateTime
     * Esta função tem por responsabilidade retornar um objeto tipo datetime
     * a partir de uma string de date fornecida
     */
    public function retornaData($data){
        return new \DateTime($data, new \DateTimeZone('America/Sao_Paulo'));
    }

    public function adicionarDias($data,$dias){
        return $data->add(new \DateInterval("P{$dias}D"));
    }

}