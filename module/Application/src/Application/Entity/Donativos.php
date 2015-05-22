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

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getDescricao()
	{
		return $this->descricao;
	}

	/**
	 * @param mixed $descricao
	 */
	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;
	}

	/**
	 * @return mixed
	 */
	public function getTitulo()
	{
		return $this->titulo;
	}

	/**
	 * @param mixed $titulo
	 */
	public function setTitulo($titulo)
	{
		$this->titulo = $titulo;
	}

	/**
	 * @return mixed
	 */
	public function getQuantidade()
	{
		return $this->quantidade;
	}

	/**
	 * @param mixed $quantidade
	 */
	public function setQuantidade($quantidade)
	{
		$this->quantidade = $quantidade;
	}

	/**
	 * @return mixed
	 */
	public function getDataInclu()
	{
		return $this->dataInclu;
	}

	/**
	 * @param mixed $dataInclu
	 */
	public function setDataInclu($dataInclu)
	{
		$this->dataInclu = $dataInclu;
	}

	/**
	 * @return mixed
	 */
	public function getDataDesa()
	{
		return $this->dataDesa;
	}

	/**
	 * @param mixed $dataDesa
	 */
	public function setDataDesa($dataDesa)
	{
		$this->dataDesa = $dataDesa;
	}

	/**
	 * @return mixed
	 */
	public function getIdInstituicao()
	{
		return $this->idInstituicao;
	}

	/**
	 * @param mixed $idInstituicao
	 */
	public function setIdInstituicao($idInstituicao)
	{
		$this->idInstituicao = $idInstituicao;
	}

	/**
	 * @return mixed
	 */
	public function getIdCategoria()
	{
		return $this->idCategoria;
	}

	/**
	 * @param mixed $idCategoria
	 */
	public function setIdCategoria($idCategoria)
	{
		$this->idCategoria = $idCategoria;
	}

	/**
	 * @return mixed
	 */
	public function getInstituicao()
	{
		return $this->instituicao;
	}

	/**
	 * @param mixed $instituicao
	 */
	public function setInstituicao($instituicao)
	{
		$this->instituicao = $instituicao;
	}

	public function getInputFilter(){}

}