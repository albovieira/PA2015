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
 * @ORM\Table(name="tipo_renda")
 *
 */


class TipoRenda extends AbstractEntity
{
    /** @ORM\Id @ORM\Column(type="integer") **/
    private $id;
    /** @ORM\Column(type="string") **/
    private $desc_renda;

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
        return $this->desc_renda;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->desc_renda = $desc;
    }



    public function exchangeArray($array)
    {
        var_dump($array);
        if (is_array($array))
        {
            $this->id= $array['id'];
            $this->desc_renda = $array['descRenda'];

        }
        else
        {
            $this->id = $array->id;
            $this->desc_renda = $array->descRenda;
        }

    }

    public function getArrayCopy(){
        return get_object_vars($this);
    }

    public function getInputFilter()
    {

        if (!$this->inputFilter) {
            /**/
            $inputFilter = new InputFilter();

                $inputFilter->addFilter('desc_renda', new StripTags());
                $inputFilter->addFilter('desc_renda', new StringTrim());


                $inputFilter->addChains();
                $this->inputFilter = $inputFilter;

            }

            return $this->inputFilter;

    }


}
