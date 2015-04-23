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
 * Doacao\Model\Donativo
 * @ORM\Entity
 * @ORM\Table(name="tb_donativo")
 *
 */
class Donativo extends AbstractEntity{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", name="id_dnv")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @ORM\Column(type="string", name="titulo_dnv")
	 */
	protected $titulo;
	
	/**
	 * @ORM\Column(type="string", name="descricao_dnv")
	 */
	protected $descricao;
	
	/**
	 * @ORM\Column(type="string", name="quant_dnv")
	 */
	protected $quantidade;
	
	/**
	 * @ORM\Column(type="datetime", name="dt_inclusao_dnv")
	 */
	protected $dataInclusao;
	
	/**
	 * @ORM\Column(type="datetime", name="dt_expiracao_dnv")
	 */
	protected $dataExpiracao;
	
	/**
	 * @ORM\ManyToOne(targetEntity="CategoriaDonativo", inversedBy="donativos")
	 * @ORM\JoinColumn(name="id_categoria", referencedColumnName="id_categoria")
	 */
	protected $categoria;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Instituicao", inversedBy="donativos")
	 * @ORM\JoinColumn(name="id_instituicao", referencedColumnName="id_instituicao")
	 */
	protected $instituicao;
	
	/**
	 * @ORM\OneToOne(targetEntity="Transacao", mappedBy="donativo")
	 */
	protected $transacao;
	
	/**
	 * @return mixed
	 */
	public function __get($property){return $this->$property;}
	
	/**
	 * @param mixed
	 * @param mixed
	 */
	public function __set($property,$value){ $this->$property = $value;}
	
	public function getArrayCopy() {
		return "";
	}
		
	public function getInputFilter(){
	
		return "";
	}
	
	
}