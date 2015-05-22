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
	
	
	
	public function getInputFilter(){}
	
	/**
	 *
	 * @return the integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 *
	 * @param integer $id        	
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getCnpj() {
		return $this->cnpj;
	}
	
	/**
	 *
	 * @param string $cnpj        	
	 */
	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getNomeFantasia() {
		return $this->nomeFantasia;
	}
	
	/**
	 *
	 * @param string $nomeFantasia        	
	 */
	public function setNomeFantasia($nomeFantasia) {
		$this->nomeFantasia = $nomeFantasia;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getRazaoSocial() {
		return $this->razaoSocial;
	}
	
	/**
	 *
	 * @param string $razaoSocial        	
	 */
	public function setRazaoSocial($razaoSocial) {
		$this->razaoSocial = $razaoSocial;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getDescricao() {
		return $this->descricao;
	}
	
	/**
	 *
	 * @param string $descricao        	
	 */
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 *
	 * @param string $email        	
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getSite() {
		return $this->site;
	}
	
	/**
	 *
	 * @param string $site        	
	 */
	public function setSite($site) {
		$this->site = $site;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getFoto() {
		return $this->foto;
	}
	
	/**
	 *
	 * @param string $foto        	
	 */
	public function setFoto($foto) {
		$this->foto = $foto;
		return $this;
	}
	
	/**
	 *
	 * @return the datetime
	 */
	public function getDataCadastro() {
		return $this->dataCadastro;
	}
	
	/**
	 *
	 * @param datetime $dataCadastro        	
	 */
	public function setDataCadastro($dataCadastro) {
		$this->dataCadastro = $dataCadastro;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getIdUsuario() {
		return $this->idUsuario;
	}
	
	/**
	 *
	 * @param integer $idUsuario        	
	 */
	public function setIdUsuario($idUsuario) {
		$this->idUsuario = $idUsuario;
		return $this;
	}
	
	/**
	 *
	 * @return the object
	 */
	public function getEnderecos() {
		return $this->enderecos;
	}
	
	/**
	 *
	 * @param object $enderecos        	
	 */
	public function setEnderecos($enderecos) {
		$this->enderecos = $enderecos;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getDonativos() {
		return $this->donativos;
	}
	
	/**
	 *
	 * @param unknown_type $donativos        	
	 */
	public function setDonativos($donativos) {
		$this->donativos = $donativos;
		return $this;
	}
	
	
}
?>