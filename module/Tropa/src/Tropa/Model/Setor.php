<?php

namespace Tropa\Model;
use Doctrine\ORM\Mapping as ORM;
use Components\Entity\AbstractEntity;

use Components\InputFilter\InputFilter;
use Zend\Validator\Between;
use Zend\Filter\Int;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\StringLength;

/**
 * @ORM\Entity
 * @ORM\Table(name="setor")
 *
 */

class Setor extends AbstractEntity
{
    /** @ORM\Id @ORM\Column(type="integer") **/
    public $codigo;
    /** @ORM\Column(type="string") **/
    public $nome;

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
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

    public function getArrayCopy(){
        return get_object_vars($this);
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $inputFilter->addFilter('codigo', new Int());
            $inputFilter->addValidator('codigo', new Between(array(
                        'min'      => 0,
                        'max'      => 3600
                    )
                )
            );

            $inputFilter->addFilter('nome', new StripTags());
            $inputFilter->addFilter('nome', new StringTrim());
            $inputFilter->addValidator('nome', new StringLength(array(
                        'encoding' => 'UTF-8',
                        'min'      => 2,
                        'max'      => 30,
                    )
                )
            );

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }


}