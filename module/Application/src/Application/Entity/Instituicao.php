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