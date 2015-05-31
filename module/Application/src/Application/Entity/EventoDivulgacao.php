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
 * Evento
 * @ORM\Entity
 * @ORM\Table(name="tb_evento_divulgacao")
 *
 */

class EventoDivulgacao extends AbstractEntity{


    /**
     * @ORM\Id
     * @ORM\Column(name="id_divulgacao",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Pessoa")
     * @ORM\JoinColumn(name="id_pessoa", referencedColumnName="id")
     **/
    private $idPessoa;

    /**
     * @ORM\ManyToOne(targetEntity="Evento")
     * @ORM\JoinColumn(name="id_evento", referencedColumnName="id_evento")
     **/
    private $idEvento;

    /**
     * @var string
     * @ORM\Column(name="txt_divulgacao" ,type="string") **/
    private $txtDivulgacao;

    /**
     * @var \Datetime
     * @ORM\Column(name="data_divulgacao" ,type="datetime") **/
    private $dataDivulgacao;

    /**
     * @var string
     * @ORM\Column(name="usuarios_marcados" ,type="string") **/
    private $usuariosMarcados;

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
    public function getIdEvento()
    {
        return $this->idEvento;
    }

    /**
     * @param mixed $idEvento
     */
    public function setIdEvento($idEvento)
    {
        $this->idEvento = $idEvento;
    }

    /**
     * @return string
     */
    public function getTxtDivulgacao()
    {
        return $this->txtDivulgacao;
    }

    /**
     * @param string $txtDivulgacao
     */
    public function setTxtDivulgacao($txtDivulgacao)
    {
        $this->txtDivulgacao = $txtDivulgacao;
    }

    /**
     * @return \Datetime
     */
    public function getDataDivulgacao()
    {
        return $this->dataDivulgacao;
    }

    /**
     * @param \Datetime $dataDivulgacao
     */
    public function setDataDivulgacao($dataDivulgacao)
    {
        $this->dataDivulgacao = $dataDivulgacao;
    }

    /**
     * @return string
     */
    public function getUsuariosMarcados()
    {
        return $this->usuariosMarcados;
    }

    /**
     * @param string $usuariosMarcados
     */
    public function setUsuariosMarcados($usuariosMarcados)
    {
        $this->usuariosMarcados = $usuariosMarcados;
    }



    public function getInputFilter(){

    }

}