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
	 * @return the unknown_type
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 *
	 * @param unknown_type $id        	
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getCnpj() {
		return $this->cnpj;
	}
	
	/**
	 *
	 * @param unknown_type $cnpj        	
	 */
	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getNomeFantasia() {
		return $this->nomeFantasia;
	}
	
	/**
	 *
	 * @param unknown_type $nomeFantasia        	
	 */
	public function setNomeFantasia($nomeFantasia) {
		$this->nomeFantasia = $nomeFantasia;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getRazaoSocial() {
		return $this->razaoSocial;
	}
	
	/**
	 *
	 * @param unknown_type $razaoSocial        	
	 */
	public function setRazaoSocial($razaoSocial) {
		$this->razaoSocial = $razaoSocial;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getDescricao() {
		return $this->descricao;
	}
	
	/**
	 *
	 * @param unknown_type $descricao        	
	 */
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 *
	 * @param unknown_type $email        	
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getSite() {
		return $this->site;
	}
	
	/**
	 *
	 * @param unknown_type $site        	
	 */
	public function setSite($site) {
		$this->site = $site;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getFoto() {
		return $this->foto;
	}
	
	/**
	 *
	 * @param unknown_type $foto        	
	 */
	public function setFoto($foto) {
		$this->foto = $foto;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getDataCadastro() {
		return $this->dataCadastro;
	}
	
	/**
	 *
	 * @param unknown_type $dataCadastro        	
	 */
	public function setDataCadastro($dataCadastro) {
		$this->dataCadastro = $dataCadastro;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getIdUsuario() {
		return $this->idUsuario;
	}
	
	/**
	 *
	 * @param unknown_type $idUsuario        	
	 */
	public function setIdUsuario($idUsuario) {
		$this->idUsuario = $idUsuario;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getEnderecos() {
		return $this->enderecos;
	}
	
	/**
	 *
	 * @param unknown_type $enderecos        	
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