<?php
namespace Doacao\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class TransacaoForm extends Form{

	public function __construct($name = null){
		parent::__construct('donativo');
		$this->setHydrator(new ClassMethods());

		$this->add(array(
			'name'=>'idTransacao',
			'type'=>'Hidden'
		));
		$this->add(array(
			'name'=>'idDonativo',
			'type'=>'Hidden'
		));

		$this->add(array(
			'name'=>'idInstituicao',
			'type'=>'Hidden'
		));

		$this->add(array(
			'name'=>'idPessoa',
			'type'=>'Hidden'
		));

		$this->add(array(
			'name'=>'dataTransacao',
			'type'=>'Hidden'
		));

		$this->add(array(
			'name' => 'quantidadeOferecida',
			'options' => array(
				'label' => 'Quantidade',
				'label_attributes' => array(
					'class' => 'label-control'
				)
			),
			'attributes' => array(
				'type' => 'number',
				'class'=> 'form-control'
			),
		));

	}

}