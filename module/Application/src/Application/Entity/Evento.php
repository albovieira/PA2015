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
 * @ORM\Table(name="evento")
 *
 */

class Evento extends AbstractEntity{


    /**
     * @ORM\Id
     * @ORM\Column(name="id_evento",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Instituicao")
     * @ORM\JoinColumn(name="id_instituicao", referencedColumnName="id_instituicao")
     **/
    private $idInstituicao;

    /**
     * @var string
     * @ORM\Column(name="desc_evento" ,type="string") **/
    private $descEvento;

    /**
     * @var date
     * @ORM\Column(name="data_inicio" ,type="datetime") **/
    private $dataInicio;

    /**
     * @var date
     * @ORM\Column(name="data_final" ,type="datetime") **/
    private $dataFim;

    /**
     * @var string
     * @ORM\Column(name="site_evento" ,type="string") **/
    private $siteEvento;

    /**
     * @var string
     * @ORM\Column(name="objetivos" ,type="string") **/
    private $objetivos;

    /**
     * @var string
     * @ORM\Column(name="titulo_evento" ,type="string") **/
    private $tituloEvento;

    /**
     * @var string
     * @ORM\Column(name="imagem1" ,type="string") **/
    private $imagem1;

    /**
     * @var string
     * @ORM\Column(name="imagem2" ,type="string") **/
    private $imagem2;

    /**
     * @var string
     * @ORM\Column(name="imagem3" ,type="string") **/
    private $imagem3;


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
     * @return string
     */
    public function getDescEvento()
    {
        return $this->descEvento;
    }

    /**
     * @param string $descEvento
     */
    public function setDescEvento($descEvento)
    {
        $this->descEvento = $descEvento;
    }

    /**
     * @return date
     */
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * @param date $dataInicio
     */
    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;
    }

    /**
     * @return date
     */
    public function getDataFim()
    {
        return $this->dataFim;
    }

    /**
     * @param date $dataFim
     */
    public function setDataFim($dataFim)
    {
        $this->dataFim = $dataFim;
    }

    /**
     * @return string
     */
    public function getSiteEvento()
    {
        return $this->siteEvento;
    }

    /**
     * @param string $siteEvento
     */
    public function setSiteEvento($siteEvento)
    {
        $this->siteEvento = $siteEvento;
    }

    /**
     * @return string
     */
    public function getObjetivos()
    {
        return $this->objetivos;
    }

    /**
     * @param string $objetivos
     */
    public function setObjetivos($objetivos)
    {
        $this->objetivos = $objetivos;
    }

    /**
     * @return string
     */
    public function getTituloEvento()
    {
        return $this->tituloEvento;
    }

    /**
     * @param string $tituloEvento
     */
    public function setTituloEvento($tituloEvento)
    {
        $this->tituloEvento = $tituloEvento;
    }


    /**
     * @return string
     */
    public function getImagem1()
    {
        return $this->imagem1;
    }

    /**
     * @param string $imagem1
     */
    public function setImagem1($imagem1)
    {
        $this->imagem1 = $imagem1;
    }

    /**
     * @return string
     */
    public function getImagem2()
    {
        return $this->imagem2;
    }

    /**
     * @param string $imagem2
     */
    public function setImagem2($imagem2)
    {
        $this->imagem2 = $imagem2;
    }

    /**
     * @return string
     */
    public function getImagem3()
    {
        return $this->imagem3;
    }

    /**
     * @param string $imagem3
     */
    public function setImagem3($imagem3)
    {
        $this->imagem3 = $imagem3;
    }

    public function getInputFilter(){

    }
    public function getArrayCopy(){

    }

}
