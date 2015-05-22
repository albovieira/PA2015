<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 25/04/2015
 * Time: 18:10
 */

namespace Application\Entity;

use Components\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Pessoa
 * @ORM\Entity
 * @ORM\Table(name="pessoas")
 *
 */

class Pessoa extends AbstractEntity{


    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    private $id;

    /**
     * @var string
     * @ORM\Column(name="nome" ,type="string") **/
    private $nome;

    /**
     * @var date
     * @ORM\Column(name="data_nasc" ,type="date") **/
    private $dataNasc;

    /**
     * @var string
     * @ORM\Column(name="sexo" ,type="string") **/
    private $sexo;

    /**
     * @var date
     * @ORM\Column(name="data_cad" ,type="date") **/
    private $dataCad;

    /**
     * @var string
     * @ORM\Column(name="email" ,type="string") **/
    private $email;

    /**
     * @var User
     * @ORM\OnetoOne(targetEntity="user")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="user_id")
     **/
    private $usuario;

    /**
     * @var string
     * @ORM\Column(name="foto" ,type="string") **/
    private $foto;

    /**
     * @var string
     * @ORM\Column(name="tel_fixo" ,type="string") **/
    private $telFixo;

    /**
     * @var string
     * @ORM\Column(name="tel_cel" ,type="string") **/
    private $telCel;

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
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return date
     */
    public function getDataNasc()
    {
        return $this->dataNasc;
    }

    /**
     * @param date $dataNasc
     */
    public function setDataNasc($dataNasc)
    {
        $this->dataNasc = $dataNasc;
    }

    /**
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param string $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return date
     */
    public function getDataCad()
    {
        return $this->dataCad;
    }

    /**
     * @param date $dataCad
     */
    public function setDataCad($dataCad)
    {
        $this->dataCad = $dataCad;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param string $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @return string
     */
    public function getTelFixo()
    {
        return $this->telFixo;
    }

    /**
     * @param string $telFixo
     */
    public function setTelFixo($telFixo)
    {
        $this->telFixo = $telFixo;
    }

    /**
     * @return string
     */
    public function getTelCel()
    {
        return $this->telCel;
    }

    /**
     * @param string $telCel
     */
    public function setTelCel($telCel)
    {
        $this->telCel = $telCel;
    }


    public function getInputFilter(){

    }

}