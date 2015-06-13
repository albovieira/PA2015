<?php
namespace Application\Entity;

use Components\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

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
	 * @ORM\Column(name="id_instituicao",type="integer")
	 */
	private $idInstituicao;

	/**
	 * @ORM\ManyToOne(targetEntity="Pessoa")
	 * @ORM\JoinColumn(name="id_pessoa",referencedColumnName="id")
	 */
	private $pessoa;

	/**
	 * @ORM\Column(name="id_pessoa",type="integer")
	 */
	private $idPessoa;

	/**
	 * @ORM\Column(name="id_donativo",type="integer")
	 */
	private $idDonativo;

	/**
	 * @ORM\ManyToOne(targetEntity="Donativos")
	 * @ORM\JoinColumn(name="id_donativo", referencedColumnName="id_dnv")
	 */
	private $donativo;

	/**
	 * @ORM\Column(name="id_mensagem",type="integer")
	 */
	private $idMensagem;

	/**
	 * @ORM\ManyToOne(targetEntity="Donativos")
	 * @ORM\JoinColumn(name="id_mensagem", referencedColumnName="id")
	 */
	private $mensagem;
	
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

	/**
	 * @return mixed
	 */
	public function getPessoa()
	{
		return $this->pessoa;
	}

	/**
	 * @param mixed $pessoa
	 */
	public function setPessoa($pessoa)
	{
		$this->pessoa = $pessoa;
	}

	/**
	 * @return mixed
	 */
	public function getIdPessoa()
	{
		return $this->idPessoa;
	}

	/**
	 * @param mixed $idPessoa
	 */
	public function setIdPessoa($idPessoa)
	{
		$this->idPessoa = $idPessoa;
	}

	/**
	 * @return mixed
	 */
	public function getIdDonativo()
	{
		return $this->idDonativo;
	}

	/**
	 * @param mixed $idDonativo
	 */
	public function setIdDonativo($idDonativo)
	{
		$this->idDonativo = $idDonativo;
	}

	/**
	 * @return mixed
	 */
	public function getIdInstituicao()
	{
		return $this->idInstituicao;
	}

	/**
	 * @param mixed $idInstituicao
	 */
	public function setIdInstituicao($idInstituicao)
	{
		$this->idInstituicao = $idInstituicao;
	}

	/**
	 * @return mixed
	 */
	public function getIdMensagem()
	{
		return $this->idMensagem;
	}

	/**
	 * @param mixed $idMensagem
	 */
	public function setIdMensagem($idMensagem)
	{
		$this->idMensagem = $idMensagem;
	}

	/**
	 * @return mixed
	 */
	public function getMensagem()
	{
		return $this->mensagem;
	}

	/**
	 * @param mixed $mensagem
	 */
	public function setMensagem($mensagem)
	{
		$this->mensagem = $mensagem;
	}




	/* (non-PHPdoc)
	 * @see \Components\Entity\AbstractEntity::getInputFilter()
	 */
	public function getInputFilter(){
		if (!$this->inputFilter) {
			$inputFilter = new \Zend\InputFilter\InputFilter();
			$this->inputFilter = $inputFilter;
		}

		$this->inputFilter->add(array(
			'name' => 'quantidadeOferecida',
			'required' => true,
			'validators' => array(
				array(
					'name' => 'NotEmpty',
				)
			)
		));


		return $this->inputFilter;

	}

	public function exchangeArray($array)
	{
		$this->id = $array['idTransacao'];
		$this->quantidadeOferta = $array['quantidadeOferecida'];
		$this->dataTransacao = new \DateTime($array['dataTransacao']) ;
		$this->idDonativo = $array['idDonativo'];
		$this->idPessoa = $array['idPessoa'];
		$this->idInstituicao = $array['idInstituicao'];

	}

}