<?php
namespace Application\Entity;


use Components\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tb_mensagem")
 */

class Mensagem extends AbstractEntity{
	/**
	 * @ORM\Id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\Column(name="mensagem",type="string")
	 */
	private $mensagem;

	/**
	 * @ORM\Column(name="dt_envio", type="string")
	 */
	private $dataEnvio;

	/**
	 * @ORM\Column(name="id_pessoa", type="integer")
	 */
	private $idPessoa;

	/**
	 * @ORM\ManyToOne(targetEntity="Pessoa")
	 * @ORM\JoinColumn(name="id_pessoa", referencedColumnName="id")
	 **/
	private $pessoa;

	/**
	 * @ORM\Column(name="id_instituicao", type="integer")
	 */
	private $idInstituicao;

	/**
	 * @ORM\ManyToOne(targetEntity="Instituicao")
	 * @ORM\JoinColumn(name="id_instituicao", referencedColumnName="id_instituicao")
	 **/
	private $instituicao;

	/**
	 * @ORM\Column(name="id_donativo", type="integer")
	 */
	private $idDonativo;

	/**
	 * @ORM\ManyToOne(targetEntity="Donativos")
	 * @ORM\JoinColumn(name="id_donativo", referencedColumnName="id_dnv")
	 **/
	private $donativo;

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

	/**
	 * @return mixed
	 */
	public function getDataEnvio()
	{
		return $this->dataEnvio;
	}

	/**
	 * @param mixed $dataEnvio
	 */
	public function setDataEnvio($dataEnvio)
	{
		$this->dataEnvio = $dataEnvio;
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
	public function getInstituicao()
	{
		return $this->instituicao;
	}

	/**
	 * @param mixed $instituicao
	 */
	public function setInstituicao($instituicao)
	{
		$this->instituicao = $instituicao;
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
	public function getDonativo()
	{
		return $this->donativo;
	}

	/**
	 * @param mixed $donativo
	 */
	public function setDonativo($donativo)
	{
		$this->donativo = $donativo;
	}

	public function exchangeArray($array)
	{
		$this->id = $array['idMensagem'];
		$this->pessoa = $array['pessoa'];
		$this->instituicao = $array['instituicao'];
		$this->donativo = $array['donativo'];
		$this->mensagem = $array['mensagem'];
		$this->dataEnvio= $array['dataEnvioMensagem'];

	}

	public function getInputFilter(){}
}
?>