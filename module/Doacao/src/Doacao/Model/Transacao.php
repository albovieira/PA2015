<?php
namespace Doacao\Model;

use Components\Entity\AbstractEntity;
use Components\InputFilter\InputFilter;
use Zend\Filter\Int;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\StringLength;
use Zend\Validator\Digits;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="tb_transacao")
 * @ORM\Entity
 *
 */

class Transacao extends AbstractEntity{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", name="id_transacao")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\OneToOne(targetEntity="Donativo",inversedBy="transacao")
	 * @ORM\JoinColumn(name="id_donativo",referencedColumnName="id_dnv")
	 */
	private $donativo;
	
	/**
	 * @ORM\Column(type="datetime", name="dt_expiracao")
	 */
	private $dtExpira;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Instituicao", inversedBy="transacoes")
	 * @ORM\JoinColumn(name="id_instituicao", referencedColumnName="id_instituicao")
	 */
	private $instituicao;
	
	/**
	 * @ORM\OneToMany(targetEntity="TransacaoEfetiva", mappedBy="transacao")
	 */
	private $transacaoEfetiva;
	
	/**
	 * @param mixed $property
	 */
	public function __get($property){
		return $this->$property;
	}
	
	/**
	 * @param mixed $property
	 * @param mixed $value
	 */
	public function __set($property, $value){
		$this->$property = $value;
	}
	
	public function getArrayCopy(){
		
	}
	
	public function getInputFilter(){
		
	}
}