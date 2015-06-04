<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 25/04/2015
 * Time: 18:27
 */

namespace Doacao\Form;


use Zend\Form\Element\Hidden;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class EnderecoForm extends Form{

    public function __construct(){
        parent::__construct();
        $this->setHydrator(new ClassMethods);

        $this->setAttributes(
            array(
                //'action' => '/pessoa/dados-pessoa',
                'method' => 'post',
                'class' => 'form form-group',
                'id' => 'endereco-form'
            )
        );

        $element = new Hidden('id_endereco');
        $this->add($element);

        $this->add(array(
            'name' => 'cep',
            'options' => array(
                'label' => 'Cep',
                'label_attributes' => array(
                    'class' => 'label-control'
                )
            ),
            'attributes' => array(
                'type' => 'text',
                'id' => 'cep',
                'class'=> 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'rua',
            'options' => array(
                'label' => 'Rua',
                'label_attributes' => array(
                    'class' => 'label-control'
                )
            ),
            'attributes' => array(
                'type' => 'text',
                'id' => 'rua',
                'class'=> 'form-control',
                'disabled' => 'disabled'
            ),
        ));

        $this->add(array(
            'name' => 'bairro',
            'options' => array(
                'label' => 'Bairro',
                'label_attributes' => array(
                    'class' => 'label-control'
                )
            ),
            'attributes' => array(
                'type' => 'text',
                'id' => 'bairro',
                'class'=> 'form-control',
                'disabled' => 'disabled'
            ),
        ));

        $this->add(array(
            'name' => 'municipio',
            'options' => array(
                'label' => 'Cidade',
                'label_attributes' => array(
                    'class' => 'label-control'
                )
            ),
            'attributes' => array(
                'type' => 'text',
                'id' => 'cidade',
                'class'=> 'form-control',
                'disabled' => 'disabled'
            ),
        ));

        $this->add(array(
            'name' => 'uf',
            'options' => array(
                'label' => 'Estado',
                'label_attributes' => array(
                    'class' => 'label-control'
                )
            ),
            'attributes' => array(
                'type' => 'text',
                'id' => 'estado',
                'class'=> 'form-control',
                'disabled' => 'disabled'
            ),
        ));

        $this->add(array(
            'name' => 'numero',
            'options' => array(
                'label' => 'Número',
                'label_attributes' => array(
                    'class' => 'label-control'
                )
            ),
            'attributes' => array(
                'type' => 'text',
                'id' => 'numero',
                'class'=> 'form-control'
            ),
        ));

        $this->add(array(
            'name' => 'complemento',
            'options' => array(
                'label' => 'Complemento',
                'label_attributes' => array(
                    'class' => 'label-control'
                )
            ),
            'attributes' => array(
                'type' => 'text',
                'id' => 'complemento',
                'class'=> 'form-control'
            ),
        ));

        $this->add(array(
            'name' => 'salvar',
            'options' => array(
                'label' => 'Salvar',
            ),
            'attributes' => array(
                'type' => 'text',
                'class'=> 'btn btn-primary',
                'value' => 'salvar'
            ),
        ));

    }

}