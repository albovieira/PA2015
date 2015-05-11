<?php

namespace Despesas\Model;

use Components\Entity\AbstractEntity;
use Components\InputFilter\InputFilter;
use Zend\Filter\Int;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\StringLength;
use Zend\Validator\Digits;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="renda_extra")
 *
 */


class RendaExtra extends AbstractEntity
{
    /** @ORM\Id @ORM\Column(type="integer") **/
    private $id;

    /** @ORM\Column(type="decimal") **/
    private $valor;

    /**
     * @ORM\OnetoOne(targetEntity="TipoRenda")
     * @ORM\JoinColumn(name="tipo_renda", referencedColumnName="id")
     **/
    private $tipoRenda;

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
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    /**
     * @return mixed
     */
    public function getTipoRenda()
    {
        return $this->tipoRenda;
    }

    /**
     * @param mixed $tipoRenda
     */
    public function setTipoRenda($tipoRenda)
    {
        $this->tipoRenda = $tipoRenda;
    }


    

    public function exchangeArray($array)
    {
        var_dump($array);
        /*
        if (is_array($array))
        {
            $this->codigo = $array['codigo'];
            $this->nome = $array['nome'];
            $em = $GLOBALS['entityManager'];
            $this->setor = $this->setor = $em->getRepository('Tropa\Model\Setor')
                ->find($array['codigo_setor']);

        }
        else
        {
            $this->codigo = $array->codigo;
            $this->nome = $array->nome;
            $this->setor = $array->setor;
        }
          */
    }

    public function getArrayCopy(){
        return get_object_vars($this);
    }

    public function getInputFilter()
    {
        /*
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->addFilter('nome', new StripTags());
            $inputFilter->addFilter('nome', new StringTrim());
            $inputFilter->addValidator('nome', new StringLength(array(
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 30,
                    )
                )
            );

            $inputFilter->addFilter('codigo_setor', new Int());
            $inputFilter->addValidator('codigo_setor', new Digits());

            $inputFilter->addChains();
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
        */
    }


}
