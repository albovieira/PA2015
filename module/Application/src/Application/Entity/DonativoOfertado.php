<?php
namespace Application\Entity;

use Components\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tb_donativo")
 */

class DonativoOfertado extends AbstractEntity{
	/**
	 * @ORM\Id
	 * @ORM\Column(name="id_dnv",type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="descricao_dnv",type="string")
	 */
	private $descricao;
	
	/**
	 * @ORM\Column(name="titulo_dnv",type="string")
	 */
	private $titulo;
	
	/**
	 * @ORM\Column(name="quant_dnv",type="integer")
	 */
	private $quantidade;
	
	/**
	 * @ORM\Column(name="dt_inclusao_dnv",type="datetime")
	 */
	private $dataInclu;

	/**
	 * @ORM\Column(name="dt_finalizacao",type="datetime")
	 */
	private $dataFinalizacao;

	/**
	 * @ORM\Column(name="id_pessoa",type="integer")
	 */
	private $idPessoa;

	/**
	 * @ORM\ManyToOne(targetEntity="Pessoa")
	 * @ORM\JoinColumn(name="id_pessoa", referencedColumnName="id")
	 **/
	private $pessoa;

	/**
	 * @ORM\Column(name="id_categoria",type="integer")
	 */
	private $idCategoria;

	/**
	 * @ORM\ManyToOne(targetEntity="Application\Entity\CategoriaDonativo" )
	 * @ORM\JoinColumn(name="id_categoria", referencedColumnName="id_categoria")
	 */
	private $categoria;

	/**
	 * @ORM\Column(name="id_instituicao",type="integer")
	 */
	private $idInstituicao;

	/**
	 * @ORM\ManyToOne(targetEntity="Instituicao", inversedBy="donativos")
	 * @ORM\JoinColumn(name="id_instituicao", referencedColumnName="id_instituicao")
	 */
	private $instituicao;

	/**
	 * @ORM\Column(name="id_mensagem",type="string")
	 */
	private $idMensagem;

	/**
	 * @ORM\ManyToOne(targetEntity="Application\Entity\Mensagem" )
	 * @ORM\JoinColumn(name="id_mensagem", referencedColumnName="id")
	 */
	private $mensagem;

	public function getId(){
		return $this->id;
	}
	
	public function setId($value){
		$this->id = $value;
	}
	
	public function getDescricao(){
		return $this->descricao;
	}
	
	public function setDescricao($value){
		$this->descricao = $value;
	}
	
	public function getTitulo(){
		return $this->titulo;
	}
	
	public function setTitulo($value){
		$this->titulo = $value;
	}
	
	public function getQuantidade(){
		return $this->quantidade;
	}
	
	public function setQuantidade($value){
		$this->quantidade = $value;
	}
	
	public function getDataInclu(){
		return $this->dataInclu;
	}
	
	public function setDataInclu($value){
		$this->dataInclu = $value;
	}
	
	public function getDataDesa(){
		return $this->dataDesa;
	}
	
	public function setDataDesa($value){
		$this->dataDesa = $value;
	}
	
	public function getIdInstituicao(){
		return $this->idInstituicao;
	}
	
	public function getIdCategoria(){
		return $this->idCategoria;
	}
	
	public function setIdCategoria($value){
		$this->idCategoria = $value;
	}

	/**
	 * @return mixed
	 */
	public function getDataFinalizacao()
	{
		return $this->dataFinalizacao;
	}

	/**
	 * @param mixed $dataFinalizacao
	 */
	public function setDataFinalizacao($dataFinalizacao)
	{
		$this->dataFinalizacao = $dataFinalizacao;
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
	public function getCategoria()
	{
		return $this->categoria;
	}

	/**
	 * @param mixed $categoria
	 */
	public function setCategoria($categoria)
	{
		$this->categoria = $categoria;
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




	/**
	 * @return mixed
	 */
	public function getInstituicao()
	{
		return $this->instituicao;
	}

	public function setInstituicao(Instituicao $instituicao){
		$this->instituicao = $instituicao;
	}

	public function getInputFilter(){}
	public function getArrayCopy(){}
	
}