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
 * @ORM\Table(name="tipo_despesas")
 *
 */


class TipoDespesa extends AbstractEntity
{
    /** @ORM\Id @ORM\Column(type="integer") **/
    private $id;
    /** @ORM\Column(name="desc_despesas", type="string") **/
    private $descDespesa;

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
    public function getDesc()
    {
        return $this->descDespesa;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->descDespesa = $desc ;
    }



    public function exchangeArray($array)
    {
        var_dump($array);

        if (is_array($array))
        {
            $this->id = $array['id'];
            $this->descDespesa = $array['descDespesa'];
        }
        else
        {
            $this->id = $array->id;
            $this->descDespesa = $array->descDespesa;
        }

    }

    public function getArrayCopy(){
        return get_object_vars($this);
    }

    public function getInputFilter()
    {

        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->addFilter('descDespesa', new StripTags());
            $inputFilter->addFilter('descDespesa', new StringTrim());
        }

        return $this->inputFilter;

    }


}
