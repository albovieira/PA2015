<?php
namespace Application\Entity;

use Components\Entity\AbstractEntity;
use Components\InputFilter\InputFilter;
use Zend\Filter\Int;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\Digits;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tb_donativo")
 */

class Donativos extends AbstractEntity{
	/**
	 * @ORM\Id
	 * @ORM\Column(name="id_dnv",type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="descricao_dnv",type="string")
	 */
	private $descricao;
	
	/**
	 * @ORM\Column(name="titulo_dnv",type="string")
	 */
	private $titulo;
	
	/**
	 * @ORM\Column(name="quant_dnv",type="integer")
	 */
	private $quantidade;
	
	/**
	 * @ORM\Column(name="dt_inclusao_dnv",type="datetime")
	 */
	private $dataInclu;
	
	/**
	 * @ORM\Column(name="dt_desativacao_dnv",type="datetime")
	 */
	private $dataDesa;

	/**
	 * @ORM\Column(name="id_instituicao",type="integer")
	 */
	private $idInstituicao;
	
	/**
	 * @ORM\Column(name="id_categoria",type="integer")
	 */
	private $idCategoria;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Instituicao", inversedBy="donativos")
	 * @ORM\JoinColumn(name="id_instituicao", referencedColumnName="id_instituicao")
	 */
	private $instituicao;
	
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($value){
		$this->id = $value;
	}
	
	public function getDescricao(){
		return $this->descricao;
	}
	
	public function setDescricao($value){
		$this->descricao = $value;
	}
	
	public function getTitulo(){
		return $this->titulo;
	}
	
	public function setTitulo($value){
		$this->titulo = $value;
	}
	
	public function getQuantidade(){
		return $this->quantidade;
	}
	
	public function setQuantidade($value){
		$this->quantidade = $value;
	}
	
	public function getDataInclu(){
		return $this->dataInclu;
	}
	
	public function setDataInclu($value){
		$this->dataInclu = $value;
	}
	
	public function getDataDesa(){
		return $this->dataDesa;
	}
	
	public function setDataDesa($value){
		$this->dataDesa = $value;
	}
	
	public function getIdInstituicao(){
		return $this->idInstituicao;
	}
	
	public function getIdCategoria(){
		return $this->idCategoria;
	}
	
	public function setIdCategoria($value){
		$this->idCategoria = $value;
	}
	
	/**
	 * @return mixed
	 */
	public function getInstituicao()
	{
		return $this->instituicao;
	}

	public function setInstituicao(Instituicao $instituicao){
		$this->instituicao = $instituicao;
	}

	public function getInputFilter(){}
	public function getArrayCopy(){}
	
}