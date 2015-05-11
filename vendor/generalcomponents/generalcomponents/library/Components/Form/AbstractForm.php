<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 16/02/2015
 * Time: 12:11
 */

namespace Components\Form;


use Zend\Form\Element\Date;
use Zend\Form\Element\DateTime;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Form;

abstract class AbstractForm extends Form{

    protected function addElement($name, $type, $label = null,  $attributes = array(), $options = array() ,$value = null, $classe = null, $id = null)
    {

        if(is_null($id))
            $attributes['id'] = $name;


        if ($type == 'select')
        {
            $element = new Select($name);
            $element->setLabel($label);

            $attributes['class'] = 'form-control';
                if(!is_null($attributes)){
                    $element->setAttributes($attributes);
                }
                if(!is_null($options)){
                    $element->setOptions($options);

                }

        }
        else
        {
            $attributes['type'] = $type;

            if ($type == 'submit') {
                $attributes['value'] = $label;
            }
            else {
                $options['label'] = $label;
                $attributes['class'] = 'form-control';
            }

            $element = array(
                'name' => $name,
                'attributes' => $attributes,
                'options' => $options
            );
        }


        if($type == 'hidden'){
            if($name == 'uid'){
                $element = new Hidden($name);
                $element->setValue($value);
            }else{
                $element = new Hidden($name);
            }
        }

        if($type == 'data'){
            $element = new Date($name);
        }

        //var_dump($element);die();

       // $element->setAttribute('class', 'form-control');



        $this->add($element);
    }
}