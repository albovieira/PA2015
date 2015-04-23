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
 * @ORM\Table(name="tb_transacao_efetiva")
 *
 */
class TransacaoEfetiva extends AbstractEntity{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", name="id")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Transacao", inversedBy="transacaoEfetiva")
	 * @ORM\JoinColumn(name="id_transacao", referencedColumnName="id_transacao");
	 */
	private $transacao;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Pessoa", inversedBy="transacaoEfetiva")
	 * @ORM\JoinColumn(name="id_pessoa", referencedColumnName="id_pessoa");
	 */
	private $pessoa;
	
	/**
	 * @ORM\Column(type="integer")
	 */
	private $quantidade;
	
	/**
	 * @ORM\Column(name="data_finalizada", type="date")
	 */
	private $dtFim;
	
	public function __construct(){
		$this->transacao = new ArrayCollection();
		$this->pessoa = new ArrayCollection();
	}
	
	public function __get($property){
		return $this->$property;
	}
	
	public function __set($property, $value){
		$this->$property = $value;
	}
	
	public function getArrayCopy(){
		
	}
	
	public function getInputFilter(){
		
	}
	
}
