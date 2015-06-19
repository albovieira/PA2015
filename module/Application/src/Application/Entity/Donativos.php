<?php
namespace Application\Entity;

use Components\Entity\AbstractEntity;
use Doacao\DAO\DonativoDAO;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tb_donativo")
 */

class Donativos extends AbstractEntity{
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
	 * @ORM\Column(name="dt_desativacao_dnv",type="datetime")
	 */
	private $dataDesa;

	/**
	 * @ORM\Column(name="id_instituicao",type="integer")
	 */
	private $idInstituicao;

	/**
	 * @ORM\OneToOne(targetEntity="Application\Entity\CategoriaDonativo")
	 * @ORM\JoinColumn(name="id_categoria", referencedColumnName="id_categoria")
	 */
	private $idCategoria;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Instituicao", inversedBy="donativos")
	 * @ORM\JoinColumn(name="id_instituicao", referencedColumnName="id_instituicao")
	 */
	private $instituicao;

	/**
	 * @ORM\OneToOne(targetEntity="Application\Entity\Status")
	 * @ORM\JoinColumn(name="status",referencedColumnName="id")
	 */
	private $status;

	/**
	 * @return mixed
     */
	public function getId(){
		return $this->id;
	}

	/**
	 * @param $value
     */
	public function setId($value){
		$this->id = $value;
	}

	/**
	 * @return mixed
     */
	public function getDescricao(){
		return $this->descricao;
	}

	/**
	 * @param $value
     */
	public function setDescricao($value){
		$this->descricao = $value;
	}

	/**
	 * @return mixed
     */
	public function getTitulo(){
		return $this->titulo;
	}

	/**
	 * @param $value
     */
	public function setTitulo($value){
		$this->titulo = $value;
	}

	/**
	 * @return mixed
     */
	public function getQuantidade(){
		return $this->quantidade;
	}

	/**
	 * @param $value
     */
	public function setQuantidade($value){
		$this->quantidade = $value;
	}

	/**
	 * @return mixed
     */
	public function getDataInclu(){
		return $this->dataInclu;
	}

	/**
	 * @param $dataInclusao
     */
	public function setDataInclu($dataInclusao){
		$this->dataInclu = $dataInclusao;
	}

	/**
	 * @return mixed
     */
	public function getDataDesa(){
		return $this->dataDesa;
	}

	/**
	 * @param $value
     */
	public function setDataDesa($value){
		$this->dataDesa = $value;
	}

	/**
	 * @return mixed
     */
	public function getIdInstituicao(){
		return $this->idInstituicao;
	}

	/**
	 * @return mixed
     */
	public function getIdCategoria(){
		return $this->idCategoria;
	}

	/**
	 * @param $value
     */
	public function setIdCategoria($value){
		$this->idCategoria = $value;
	}
	
	/**
	 * @return mixed
	 */
	public function getInstituicao()
	{
		return $this->instituicao;
	}

	/**
	 * @param Instituicao $instituicao
     */
	public function setInstituicao(Instituicao $instituicao){
		$this->instituicao = $instituicao;
	}

	/**
	 * @return mixed
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param mixed $status
	 */
	public function setStatus($status)
	{
		$this->status = $status;
	}

	/**
	 *
     */
	public function getInputFilter(){}

	/**
	 *
     */
	public function getArrayCopy(){}
	

    /**
     * Set idInstituicao
     *
     * @param integer $idInstituicao
     *
     * @return Donativos
     */
    public function setIdInstituicao($idInstituicao)
    {
        $this->idInstituicao = $idInstituicao;
    
        return $this;
    }

	public function totalRecebidoItem(){
		return (new DonativoDAO())->sumRecebidos($this);
	}
}
