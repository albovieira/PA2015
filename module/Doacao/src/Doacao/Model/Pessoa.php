<?php
namespace Doacao\Model;

use Components\Entity\AbstractEntity;
use Components\InputFilter\InputFilter;
use Zend\Filter\Int;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\StringLength;
use Zend\Validator\Digits;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Doacao\Model\Instituicao
 * @ORM\Entity
 * @ORM\Table(name="tb_pessoas")
 *
 */

class Pessoa extends AbstractEntity{
	/**
	 * @ORM\id
	 * @ORM\Column(name="id",type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string")
	 */
	private $nome;
	
	/**
	 * @ORM\Column(type="date", name="data_nasc")
	 */	
	private $dtNascimento;
	
	/**
	 * @ORM\Column(type="string")
	 */
	private $email;
	
	/**
	 * @ORM\Column(type="integer", name="id_usuario")
	 */
	private $usuario;
	
	/**
	 * @ORM\Column(type="")
	 */
	private $foto;
	
	/**
	 * @ORM\Column(type="string", name="tel_fxo")
	 */
	private $telFixo;
	
	/**
	 * @ORM\Column(type="string", name="tel_cel")
	 */
	private $telCel;
	
	/**
	 * @ORM\OneToMany(TargetEntity="TransacaoEfetiva", mappedBy="pessoa")
	 */
	private $transacaoEfetiva;
	
	/**
	 * Metodo mágico de retorno de valores
	 * @param mixed $property
	 */
	public function __get($property){
		return $this->$property;
	}
	
	/**
	 * Metodo mágico set
	 * @param mixed $property
	 * @param mixed $value
	 */
	public function __set($property,$value){
		$this->$property = $value;
	}
	
	public function getArrayCopy(){
	}
	
	public function getInputFilter(){
		
	}
	
}