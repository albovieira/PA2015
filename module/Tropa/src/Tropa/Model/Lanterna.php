<?php

namespace Tropa\Model;

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
 * @ORM\Table(name="lanterna")
 *
 */


class Lanterna extends AbstractEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    private $codigo;
    /** @ORM\Column(type="string") **/
    private $nome;
    /**
     * @ORM\OnetoOne(targetEntity="Setor")
     * @ORM\JoinColumn(name="codigo_setor", referencedColumnName="codigo")
     **/
    private $setor;


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

    /**
     * @return Setor
     */
    public function getSetor()
    {
        return $this->setor;
    }

    /**
     * @param Setor $setor
     */
    public function setSetor($setor)
    {
        $this->setor = $setor;
    }

    public function exchangeArray($array)
    {
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

    }

    public function getArrayCopy(){
        return get_object_vars($this);
    }

    public function getInputFilter()
    {
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
    }


}
