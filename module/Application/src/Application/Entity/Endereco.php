<?php
namespace Application\Entity;

use Components\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tb_enderecos")
 */
class Endereco extends AbstractEntity{
	/**
	 * @ORM\ID
	 * @ORM\Column(name="id_enderecos",type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="logradouro_endereco",type="string")
	 */
	private $logradouro;
	
	/**
	 * @ORM\Column(name="numero_endereco",type="string")
	 */
	private $numero;
	
	/**
	 * @ORM\Column(name="bairro",type="string")
	 */
	private $bairro;
	
	/**
	 * @ORM\Column(name="municipio",type="string")
	 */
	private $municipio;
	/**
	 * @ORM\Column(name="uf",type="string")
	 */
	private $uf;
	
	/**
	 * @ORM\Column(name="cep",type="string")
	 */
	private $cep;
	
	/**
	 * @ORM\Column(name="complemento",type="string")
	 */
	private $complemento;

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
	public function getLogradouro()
	{
		return $this->logradouro;
	}

	/**
	 * @param mixed $logradouro
	 */
	public function setLogradouro($logradouro)
	{
		$this->logradouro = $logradouro;
	}

	/**
	 * @return mixed
	 */
	public function getNumero()
	{
		return $this->numero;
	}

	/**
	 * @param mixed $numero
	 */
	public function setNumero($numero)
	{
		$this->numero = $numero;
	}

	/**
	 * @return mixed
	 */
	public function getBairro()
	{
		return $this->bairro;
	}

	/**
	 * @param mixed $bairro
	 */
	public function setBairro($bairro)
	{
		$this->bairro = $bairro;
	}

	/**
	 * @return mixed
	 */
	public function getMunicipio()
	{
		return $this->municipio;
	}

	/**
	 * @param mixed $municipio
	 */
	public function setMunicipio($municipio)
	{
		$this->municipio = $municipio;
	}

	/**
	 * @return mixed
	 */
	public function getUf()
	{
		return $this->uf;
	}

	/**
	 * @param mixed $uf
	 */
	public function setUf($uf)
	{
		$this->uf = $uf;
	}

	/**
	 * @return mixed
	 */
	public function getCep()
	{
		return $this->cep;
	}

	/**
	 * @param mixed $cep
	 */
	public function setCep($cep)
	{
		$this->cep = $cep;
	}

	/**
	 * @return mixed
	 */
	public function getComplemento()
	{
		return $this->complemento;
	}

	/**
	 * @param mixed $complemento
	 */
	public function setComplemento($complemento)
	{
		$this->complemento = $complemento;
	}

	public function getInputFilter(){}
}
?>