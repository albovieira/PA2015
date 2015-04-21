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
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Doacao\Model\Donativo
 * @ORM\Entity
 * @ORM\Table(name="tb_categoria_donativo")
 *
 */
class CategoriaDonativo extends AbstractEntity{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", name="id_categoria")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 * @ORM\Column(type="string", name="desc_categoria")
	 */
	protected $categoria;
	
	/**
	 * @ORM\OneToMany(targetEntity="Donativo", mappedBy="categoria")
	 */
	protected $donativos;
	
	public function __construct(){
		$this->donativos = new ArrayCollection();
	}
	
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
?>