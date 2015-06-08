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
 *@ORM\Entity
 *@ORM\Table(name="tb_transacao")
 */
class Transacao extends AbstractEntity{
	/**
	 * @ORM\Id
	 * @ORM\Column(name="id_transacao", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="quantidade_oferecida", type="integer")
	 */
	private $quantidadeOferta;
	
	/**
	 * @ORM\Column(name="dt_transacao",type="datetime")
	 */
	private $dataTransacao;
	
	/**
	 * @ORM\Column(name="dt_expiracao",type="datetime")
	 */
	private $dataExpiracao;
	
	/**
	 * @ORM\Column(name="dt_finalizacao",type="datetime")
	 */
	private $dataFinalizacao;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Instituicao")
	 * @ORM\JoinColumn(name="id_instituicao",referencedColumnName="id_instituicao")
	 */
	private $instituicao;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Donativos")
	 * @ORM\JoinColumn(name="id_donativo", referencedColumnName="id_dnv")
	 */
	private $donativo;
	
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
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getQuantidadeOferta() {
		return $this->quantidadeOferta;
	}
	
	/**
	 *
	 * @param integer $quantidadeOferta        	
	 */
	public function setQuantidadeOferta($quantidadeOferta) {
		$this->quantidadeOferta = $quantidadeOferta;
	}
	
	/**
	 *
	 * @return the datetime
	 */
	public function getDataTransacao() {
		return $this->dataTransacao;
	}
	
	/**
	 *
	 * @param datetime $dataTransacao        	
	 */
	public function setDataTransacao($dataTransacao) {
		$this->dataTransacao = $dataTransacao;
	}
	
	/**
	 *
	 * @return the datetime
	 */
	public function getDataExpiracao() {
		return $this->dataExpiracao;
	}
	
	/**
	 *
	 * @param datetime $dataExpiracao        	
	 */
	public function setDataExpiracao($dataExpiracao) {
		$this->dataExpiracao = $dataExpiracao;
	}
	
	/**
	 *
	 * @return the datetime
	 */
	public function getDataFinalizacao() {
		return $this->dataFinalizacao;
	}
	
	/**
	 *
	 * @param datetime $dataFinalizacao        	
	 */
	public function setDataFinalizacao($dataFinalizacao) {
		$this->dataFinalizacao = $dataFinalizacao;
	}
	
	/**
	 *
	 * @return the object
	 */
	public function getInstituicao() {
		return $this->instituicao;
	}
	
	/**
	 *
	 * @param object $instituicao        	
	 */
	public function setInstituicao($instituicao) {
		$this->instituicao = $instituicao;
	}
	
	/**
	 *
	 * @return the object
	 */
	public function getDonativo() {
		return $this->donativo;
	}
	
	/**
	 *
	 * @param object $donativo        	
	 */
	public function setDonativo($donativo) {
		$this->donativo = $donativo;
	}

	/* (non-PHPdoc)
	 * @see \Components\Entity\AbstractEntity::getInputFilter()
	 */
	public function getInputFilter() {
		// TODO: Auto-generated method stub

	}

}