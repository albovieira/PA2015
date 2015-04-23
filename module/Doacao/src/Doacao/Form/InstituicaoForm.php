<?php
namespace Doacao\Form;

use Zend\Form\Form;

class InstituicaoForm extends Form{
	public function __construct($name = null){
		parent::__construct('instituicao');
		
		$this->add(array(
			'name'=>'id',
			'type'=>'Hidden',
		));
		$this->add(array(
			'name'=>'razaoSocial',
			'type'=>'Text',
			'options'=>array(
				'label'=>'Razão Social',
		),
		));
		$this->add(array(
			'name'=>'nomeFantasia',
			'type'=>'Text',
			'options'=>array(
				'label'=>'Nome Fantasia',
		),
		));
		$this->add(array(
			'name'=>'descricao',
			'type'=>'Textarea',
			'attributes'=>array(
				'maxlenght'=>'500',
				'size'
		),
			'options'=>array(
				'label'=>'Descrição',
		),
		));
		$this->add(array(
			'name'=>'email',
			'type'=>'Email',
			'options'=>array(
				'label'=>'E-mail',
		)
		));
		$this->add(array(
			'name'=>'submit',
			'type'=>'Submit',
			'attributes'=>array(
				'value'=>'Alterar',
				'id'=>'submitbutton',
		)
		));
	}
}