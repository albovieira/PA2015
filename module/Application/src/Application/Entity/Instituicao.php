<?php
namespace Application\Entity;


use Components\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tb_instbenef")
 */

class Instituicao extends AbstractEntity{
	/**
	 * @ORM\Id
	 * @ORM\Column(name="id_instituicao", type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="cnpj", type="string")
	 */
	private $cnpj;
	
	/**
	 * @ORM\Column(name="nome_fantasia", type="string")
	 */
	private $nomeFantasia;
	
	/**
	 * @ORM\Column(name="razao_social", type="string")
	 */
	private $razaoSocial;
	
	/**
	 * @ORM\Column(name="descricao", type="string")
	 */
	private $descricao;
	
	/**
	 * @ORM\Column(name="email", type="string")
	 */
	private $email;
	
	/**
	 * @ORM\Column(name="site", type="string")
	 */
	private $site;
	
	/**
	 * @ORM\Column(name="foto", type="string")
	 */
	private $foto;

	/**
	 * @ORM\Column(name="foto_local1", type="string")
	 */
	private $fotoLocal1;

	/**
	 * @ORM\Column(name="foto_local2", type="string")
	 */
	private $fotoLocal2;

	/**
	 * @ORM\Column(name="foto_local3", type="string")
	 */
	private $fotoLocal3;

	/**
	 * @ORM\Column(name="foto_local4", type="string")
	 */
	private $fotoLocal4;

	/**
	 * @ORM\Column(name="data_cadastro", type="datetime")
	 */
	private $dataCadastro;

	/**
	 * @ORM\OneToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="usuarios_id", referencedColumnName="user_id")
	 */
	private $usuario;

	/**
	 * @var Endereco
	 *
	 * @ORM\ManyToOne(targetEntity="Endereco")
	 * @ORM\JoinColumn(name="id_endereco", referencedColumnName="id_enderecos")
	 **/
	private $enderecos;

	/**
	 * @ORM\OneToMany(targetEntity="Donativos",mappedBy="instituicao")
	 */
	private $donativos;

	public function __construct(){
		$this->enderecos = new ArrayCollection();
		$this->donativos = new ArrayCollection();
	}

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
		return $this;
	}

	/**
	 *
	 * @return the string
	 */
	public function getCnpj() {
		return $this->cnpj;
	}

	/**
	 *
	 * @param string $cnpj
	 */
	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
		return $this;
	}

	/**
	 *
	 * @return the string
	 */
	public function getNomeFantasia() {
		return $this->nomeFantasia;
	}

	/**
	 *
	 * @param string $nomeFantasia
	 */
	public function setNomeFantasia($nomeFantasia) {
		$this->nomeFantasia = $nomeFantasia;
		return $this;
	}

	/**
	 *
	 * @return the string
	 */
	public function getRazaoSocial() {
		return $this->razaoSocial;
	}

	/**
	 *
	 * @param string $razaoSocial
	 */
	public function setRazaoSocial($razaoSocial) {
		$this->razaoSocial = $razaoSocial;
		return $this;
	}

	/**
	 *
	 * @return the string
	 */
	public function getDescricao() {
		return $this->descricao;
	}

	/**
	 *
	 * @param string $descricao
	 */
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
		return $this;
	}

	/**
	 *
	 * @return the string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 *
	 * @param string $email
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	/**
	 *
	 * @return the string
	 */
	public function getSite() {
		return $this->site;
	}

	/**
	 *
	 * @param string $site
	 */
	public function setSite($site) {
		$this->site = $site;
		return $this;
	}

	/**
	 *
	 * @return the string
	 */
	public function getFoto() {
		return $this->foto;
	}

	/**
	 *
	 * @param string $foto
	 */
	public function setFoto($foto) {
		$this->foto = $foto;
		return $this;
	}

	/**
	 *
	 * @return the datetime
	 */
	public function getDataCadastro() {
		return $this->dataCadastro;
	}

	/**
	 *
	 * @param datetime $dataCadastro
	 */
	public function setDataCadastro($dataCadastro) {
		$this->dataCadastro = $dataCadastro;
		return $this;
	}

	/**
	 *
	 * @return the integer
	 */
	public function getUsuario() {
		return $this->usuario;
	}

	/**
	 *
	 * @param integer $idUsuario
	 */
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
		return $this;
	}

	public function getFotosLocal(){
		$fotos = array(
			'foto1' => $this->getFotoLocal1(),
			'foto2' => $this->getFotoLocal2(),
			'foto3' => $this->getFotoLocal3(),
			'foto4' => $this->getFotoLocal4(),
		);
		return $fotos;
	}

	/**
	 * @return mixed
	 */
	public function getFotoLocal1()
	{
		return $this->fotoLocal1;
	}

	/**
	 * @param mixed $fotoLocal1
	 */
	public function setFotoLocal1($fotoLocal1)
	{
		$this->fotoLocal1 = $fotoLocal1;
	}

	/**
	 * @return mixed
	 */
	public function getFotoLocal2()
	{
		return $this->fotoLocal2;
	}

	/**
	 * @param mixed $fotoLocal2
	 */
	public function setFotoLocal2($fotoLocal2)
	{
		$this->fotoLocal2 = $fotoLocal2;
	}

	/**
	 * @return mixed
	 */
	public function getFotoLocal3()
	{
		return $this->fotoLocal3;
	}

	/**
	 * @param mixed $fotoLocal3
	 */
	public function setFotoLocal3($fotoLocal3)
	{
		$this->fotoLocal3 = $fotoLocal3;
	}

	/**
	 * @return mixed
	 */
	public function getFotoLocal4()
	{
		return $this->fotoLocal4;
	}

	// retorna todas as fotos do local da instituicao em um array

	/**
	 * @param mixed $fotoLocal4
	 */
	public function setFotoLocal4($fotoLocal4)
	{
		$this->fotoLocal4 = $fotoLocal4;
	}

	public function setFotosLocal($foto1,$foto2,$foto3,$foto4){
		$this->setFotoLocal1($foto1);
		$this->setFotoLocal2($foto2);
		$this->setFotoLocal3($foto3);
		$this->setFotoLocal4($foto4);
	}

	/**
	 *
	 * @return the object
	 */
	public function getEnderecos() {
		return $this->enderecos;
	}
	
	/**
	 *
	 * @return the Object
	 */
	public function getDonativos() {
		return $this->donativos;
	}
	
	public function getArrayCopy(){}
	public function getInputFilter(){}

    /**
     * Set enderecos
     *
     * @param \Application\Entity\Endereco $enderecos
     *
     * @return Instituicao
     */
    public function setEnderecos(\Application\Entity\Endereco $enderecos = null)
    {
        $this->enderecos = $enderecos;
    
        return $this;
    }

    /**
     * Add donativo
     *
     * @param \Application\Entity\Donativos $donativo
     *
     * @return Instituicao
     */
    public function addDonativo(\Application\Entity\Donativos $donativo)
    {
        $this->donativos[] = $donativo;
    
        return $this;
    }

    /**
     * Remove donativo
     *
     * @param \Application\Entity\Donativos $donativo
     */
    public function removeDonativo(\Application\Entity\Donativos $donativo)
    {
        $this->donativos->removeElement($donativo);
    }
}
