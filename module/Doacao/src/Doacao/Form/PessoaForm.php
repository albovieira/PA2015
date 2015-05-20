<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 25/04/2015
 * Time: 18:27
 */

namespace Doacao\Form;


use Zend\Form\Element\File;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\InputFilter\FileInput;

class PessoaForm extends Form{

    public function __construct(){
        parent::__construct();
        $this->setAttributes(
            array(
                'action' => '/pessoa/salvar-pessoa',
                'method' => 'post',
                'class' => 'form form-group'
            )
        );

        $element = new Hidden('id');
        $this->add($element);

        $this->add(array(
            'name' => 'nomePessoa',
            'options' => array(
                'label' => 'Nome',
                'label_attributes' => array(
                    'class' => 'label-control'
                )
            ),
            'attributes' => array(
                'type' => 'text',
                'class'=> 'form-control'
            ),
        ));

        $this->add(array(
            'type' => 'radio',
            'name' => 'sexo',
            'options' => array(
                'label' => 'Sexo',
                'value_options' => array(
                    'f' => 'Feminino',
                    'm' => 'Masculino',
                ),
            ),
        ));

        $this->add(array(
            'name' => 'dataNasc',
            'options' => array(
                'label' => 'Data Nascimento',
            ),
            'attributes' => array(
                'type' => 'date',
                'class'=> 'form-control'
            ),
        ));

        $this->add(array(
            'name' => 'foto',
            'options' => array(
                'label' => 'Foto',
            ),
            'attributes' => array(
                'type' => 'file',
                'class'=> ''
            ),
        ));

        $this->add(array(
            'name' => 'telCel',
            'options' => array(
                'label' => 'Telefone',
            ),
            'attributes' => array(
                'type' => 'text',
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
                'class'=> 'btn btn-primary'
            ),
        ));

    }

}