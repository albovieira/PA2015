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
 * @ORM\Table(name="tb_instbenef")
 */

class Instituicao extends AbstractEntity{
	/**
	 * @ORM\Id
	 * @ORM\Column(name="id_instituicao", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="cnpj", type="string")
	 */
	private $cnpj;
	
	/**
	 * @ORM\Column(name="nome_fantasia", type="string")
	 */
	private $nomeFantasia;
	
	/**
	 * @ORM\Column(name="razao_social", type="string")
	 */
	private $razaoSocial;
	
	/**
	 * @ORM\Column(name="descricao", type="string")
	 */
	private $descricao;
	
	/**
	 * @ORM\Column(name="email", type="string")
	 */
	private $email;
	
	/**
	 * @ORM\Column(name="site", type="string")
	 */
	private $site;
	
	/**
	 * @ORM\Column(name="foto", type="string")
	 */
	private $foto;
	
	/**
	 * @ORM\Column(name="data_cadastro", type="datetime")
	 */
	private $dataCadastro;
	
	/**
	 * @ORM\Column(name="usuarios_id",type="integer")
	 */
	private $idUsuario;
	/*
	/**
	 * @ORM\OneToOne(targetEntity="Usuario", mappedBy="usuario")
	 /*/
//	private $usuario;
	
	/**
	 * @ORM\OneToMany(targetEntity="Enderecos", mappedBy="instituicao")
	 */
	private $enderecos;
	
	/**
	 * @ORM\OneToMany(targetEntity="Donativos",mappedBy="instituicao")
	 */
	private $donativos;

	
	public function __construct(){
		$this->enderecos = new ArrayCollection();
		$this->donativos = new ArrayCollection();
	}

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
	public function getCnpj()
	{
		return $this->cnpj;
	}

	/**
	 * @param mixed $cnpj
	 */
	public function setCnpj($cnpj)
	{
		$this->cnpj = $cnpj;
	}

	/**
	 * @return mixed
	 */
	public function getNomeFantasia()
	{
		return $this->nomeFantasia;
	}

	/**
	 * @param mixed $nomeFantasia
	 */
	public function setNomeFantasia($nomeFantasia)
	{
		$this->nomeFantasia = $nomeFantasia;
	}

	/**
	 * @return mixed
	 */
	public function getRazaoSocial()
	{
		return $this->razaoSocial;
	}

	/**
	 * @param mixed $razaoSocial
	 */
	public function setRazaoSocial($razaoSocial)
	{
		$this->razaoSocial = $razaoSocial;
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
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getSite()
	{
		return $this->site;
	}

	/**
	 * @param mixed $site
	 */
	public function setSite($site)
	{
		$this->site = $site;
	}

	/**
	 * @return mixed
	 */
	public function getFoto()
	{
		return $this->foto;
	}

	/**
	 * @param mixed $foto
	 */
	public function setFoto($foto)
	{
		$this->foto = $foto;
	}

	/**
	 * @return mixed
	 */
	public function getDataCadastro()
	{
		return $this->dataCadastro;
	}

	/**
	 * @param mixed $dataCadastro
	 */
	public function setDataCadastro($dataCadastro)
	{
		$this->dataCadastro = $dataCadastro;
	}

	/**
	 * @return mixed
	 */
	public function getIdUsuario()
	{
		return $this->idUsuario;
	}

	/**
	 * @param mixed $idUsuario
	 */
	public function setIdUsuario($idUsuario)
	{
		$this->idUsuario = $idUsuario;
	}

	/**
	 * @return mixed
	 */
	public function getEnderecos()
	{
		return $this->enderecos;
	}

	/**
	 * @param mixed $enderecos
	 */
	public function setEnderecos($enderecos)
	{
		$this->enderecos = $enderecos;
	}

	/**
	 * @return mixed
	 */
	public function getDonativos()
	{
		return $this->donativos;
	}

	/**
	 * @param mixed $donativos
	 */
	public function setDonativos($donativos)
	{
		$this->donativos = $donativos;
	}


	
	/**
	 * @param mixed $property
	 */
	public function __get($property){
		
		return $this->$property;
	}
	
	public function __set($property, $value){
		$this->$property = $value;
	}
	
	/**
	 * Captura um array de objetos e decompoe na especificade
	 * @param array $objectArray
	 * @param string $association
	 */
	public function listaDoacao($objectArray, $association){
		$associationArray = array();
		foreach($objectArray->__get($association) as $decomposte):
			array_push($associationArray,$decomposte);
		endforeach;
		return $associationArray;
	}
	
	public function getInputFilter(){}
	public function getArrayCopy(){}
	
}
?>