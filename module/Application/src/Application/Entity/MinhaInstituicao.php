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
use Doctrine\ORM\Mapping\Annotation;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tb_minhas_instituicoes")
 */

class MinhaInstituicao extends AbstractEntity{
	/**
	 * @ORM\Id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Pessoa")
	 * @ORM\JoinColumn(name="id_pessoa", referencedColumnName="id")
	 **/
	private $idPessoa;

	/**
	 * @ORM\ManyToOne(targetEntity="Instituicao")
	 * @ORM\JoinColumn(name="id_instituicao", referencedColumnName="id_instituicao")
	 **/
	private $idInstituicao;

	public function __construct(){
		//$this->componentes = new \Doctrine\Common\Collections\ArrayCollection();

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
	 * @return Pessoa
	 */
	public function getIdPessoa()
	{
		return $this->idPessoa;
	}

	/**
	 * @param Pessoa $idPessoa
	 */
	public function setIdPessoa($idPessoa)
	{
		$this->idPessoa = $idPessoa;
	}

	/**
	 * @return Instituicao
	 */
	public function getIdInstituicao()
	{
		return $this->idInstituicao;
	}

	/**
	 * @param Instituicao $idInstituicao
	 */
	public function setIdInstituicao($idInstituicao)
	{
		$this->idInstituicao = $idInstituicao;
	}

	public function getInputFilter(){}
	public function getArrayCopy(){}

}
?>