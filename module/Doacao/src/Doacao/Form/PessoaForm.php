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
use Zend\Stdlib\Hydrator\ClassMethods;

class PessoaForm extends Form{

    public function __construct(){
        parent::__construct();
        $this->setHydrator(new ClassMethods);

        $this->setAttributes(
            array(
                //'action' => '/pessoa/dados-pessoa',
                'method' => 'post',
                'class' => 'form form-group',
                'id' => 'pessoa-form'
            )
        );

        $element = new Hidden('id');
        $this->add($element);

        $this->add(array(
            'name' => 'nome',
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
            'name' => 'dataNasc',
            'type' => 'Date',
            'options' => array(
                'label' => 'Data Nascimento',
            ),
            'attributes' => array(
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
            'name' => 'dataCad',
            'options' => array(
                'label' => 'Data Cadastro',
            ),
            'attributes' => array(
                'type' => 'date',
                'class'=> 'form-control'
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'type' => 'text',
                'class'=> 'form-control'
            ),
        ));

        $element = new Hidden('usuario');
        $this->add($element);


        $this->add(array(
            'name' => 'foto',
            'options' => array(
                'label' => 'Foto',
            ),
            'attributes' => array(
                'type' => 'file',
                'class'=> 'input-foto'
            ),
        ));

        $this->add(array(
            'name' => 'telCel',
            'options' => array(
                'label' => 'Celular',
            ),
            'attributes' => array(
                'type' => 'text',
                'class'=> 'form-control'
            ),
        ));

        $this->add(array(
            'name' => 'telFixo',
            'options' => array(
                'label' => 'Telefone Fixo',
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
                'class'=> 'btn btn-primary',
                'value' => 'salvar'
            ),
        ));

    }

}