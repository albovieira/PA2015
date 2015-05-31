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

class DivulgacaoEventoForm extends Form{

    public function __construct(){
        parent::__construct();
        $this->setHydrator(new ClassMethods);

        $this->setAttributes(
            array(
                //'action' => '/pessoa/dados-pessoa',
                'method' => 'post',
                'class' => 'form form-group',
                'id' => 'divulgacao-form'
            )
        );

        $element = new Hidden('idDivulgacao');
        $this->add($element);

        $element = new Hidden('idEvento');
        $this->add($element);

        $element = new Hidden('idPessoa');
        $this->add($element);

        $element = new Hidden('dataDivulgacao');
        $this->add($element);


        $this->add(array(
            'name' => 'txtDivulgacao',
            'type' => 'textarea',
            'attributes' => array(
                'class'=> 'form-control',
                'rows' => '5'
            ),
        ));

        $this->add(array(
            'name' => 'publicar',
            'type' => 'button',
                'options' => array(
                    'label' => 'Publicar',
                ),
                'attributes' => array(
                    'class'=> 'btn btn-primary',
                    'id' => 'btnPublicar'
                ),
            )
        );

        //TODO faltou usuarios marcados
    }

}