<?php
namespace Doacao\Form;

use Zend\Form\Form;
use Doacao\Service\DonativoService;
use Zend\Form\Element;

class DonativoForm extends Form{
	protected $entityManager;
	
	public function __construct($name = null){
		parent::__construct('donativo');
		
		$this->add(array(
			'name'=>'id',
			'type'=>'Hidden'
		));
		$this->add(array(
			'name'=>'dataInclu',
			'type'=>'Hidden'
		));
		$this->add(array(
			'name'=>'idInstituicao',
			'type'=>'Hidden'
		));
		$this->add(array(
			'name'=>'titulo',
			'type'=>'Text',
			'options'=>array(
				'label'=>'Título',
			),
			'attributes'=>array(
				'class'=>'form-control',
				'required'=>'true',
				'size'=>'55',
			),
		));
		$this->add(array(
			'name'=>'quantidade',
			'type'=>'number',
			'options'=>array(
				'label'=>'Quantidade'
		),
			'attributes'=>array(
				'class'=>'form-control',
				'min'=>'1',
				'value'=>'1'
		)
		));
		$this->add(array(
			'name'=>'descricao',
			'type'=>'TextArea',
			'options'=>array(
				'label'=>'Descrição',
			),
			'attributes'=>array(
				'class'=>'form-control',
				'required'=>'true',
				'cols'=>'100',
				'rows'=>'5',
		),
		));
		$this->add($this->selecaoCategoria());
		$this->add(array(
			'name'=>'tempo_maximo',
			'type'=>'number',
			'options'=>array(
					'label'=>'Tempo de arrecadação'
			),
			'attributes'=>array(
				'class'=>'form-control',
				'min'=>'30',
				'value'=>'30'
			)
		));
		$this->add(array(
			'name'=>'submit',
			'type'=>'Submit',
			'attributes'=>array(
				'value'=>'Savar',
				'id'=>'submitbutton',
				'class'=>'btn btn-info',
			),
		));
		
	}
	
	private function selecaoCategoria(){
		$categorias = (new DonativoService())->listaCategorias();
		$newArray = array();
		
		foreach ($categorias as $one):
				$newArray[$one['id_categoria']] = $one['desc_categoria'];
		endforeach;
		
		$select = new Element\Select('categorias');
		$select->setLabel('Categoria');
		$select->setValueOptions($newArray);
		$select->setAttributes(array(
				'class'=>'form-control',
		));
		
		return $select;
	}
	
}