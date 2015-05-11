<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 21/02/2015
 * Time: 01:05
 */

namespace Components\Entity;


 abstract class AbstractEntity {
     protected $inputFilter;

    abstract function getInputFilter();

     public function exchangeArray($array)
     {
         foreach($array as $attribute => $value)
         {
             $this->$attribute = $value;
         }
     }

     abstract public function getArrayCopy();
}