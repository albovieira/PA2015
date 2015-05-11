<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 17/02/2015
 * Time: 14:32
 */

namespace Application\Form;


use Zend\Form\Element\Hidden;
use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class LoginForm extends Form{
    public function __construct($name = 'login_form'){
        parent::__construct($name);

        $class = 'form-signin';
        if($name == 'cadastro_form')
            $class = 'form form-group';

        $this->setAttributes(
            array(
                'method' => 'post',
                'class' => $class

            )
        );

        $element = new Hidden('id');
        $this->add($element);


        $element = new Text('lbllogin');
        $element->setLabel('Usuário')
                ->setLabelAttributes(array('class' => 'control-label'));
        $this->add($element);

        $element = new Text('login');
        $element->setAttributes(
            array(
                'class' => 'form-control',
            )
        );
        $this->add($element);




        $element = new Text('lblPass');
        $element->setLabel('Senha')
                ->setLabelAttributes(array('class' => 'control-label'));
        $this->add($element);
        $element = new Password('senha');
        $element->setAttributes(
            array(
                'class' => 'form-control ',
            )
        );
        $this->add($element);

        if($name == 'cadastro_form'){

            $element = new Text('lblNome');
            $element->setLabel('Nome')
                ->setLabelAttributes(array('class' => 'control-label'));
            $this->add($element);

            $element = new Text('nome');
            $element->setAttributes(
                array(
                    'class' => 'form-control',
                )
            );
            $this->add($element);

            $element = new Text('lblPassConfirma');
            $element->setLabel('Confirmar Senha')
                ->setLabelAttributes(array('class' => 'control-label'));
            $this->add($element);

            $element = new Password('confirmarsenha');
            $element->setLabelAttributes(
                array(
                    //'class' => 'col-sm-4'
                )
            );
            $element->setAttributes(
                array(
                    'class' => 'form-control',
                )
            );
            $this->add($element);


            $element = new Submit('cadastrar');
            $element->setAttributes(array('class' => 'btn btn-info'));
            $element->setValue('Cadastrar');
            $this->add($element);

            return;
        }


        $element = new Submit('loginBtn');
        $element->setValue('Entrar');
        $element->setAttributes(array('class' => 'btn btn-info'));

        $this->add($element);


    }
}