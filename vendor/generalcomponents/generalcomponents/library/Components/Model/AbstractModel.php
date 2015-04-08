<?php

namespace Components\Model;


abstract class AbstractModel {
    protected $inputFilter;

    public function exchangeArray(array $data){
        // seeta os valores
        foreach($data as $attribute => $value){
            $this->$attribute = $value;
        }
    }

    // obriga as classes herdeiras terem uma implementação deste método
    abstract function getInputFilter();

    public function getArrayCopy(){
        return get_object_vars($this);
    }

    public function toArray(){
        return get_object_vars($this);
    }


}