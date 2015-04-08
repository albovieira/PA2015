<?php

namespace Despesas\Model;

use Components\Entity\AbstractEntity;
use Components\InputFilter\InputFilter;
use Zend\Filter\Int;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;
use Zend\Validator\Digits;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="despesas")
 *
 */


class Despesa extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    private $id;

    /**
     * @ORM\Column(type="integer")
     **/
    private $user;

    /** @ORM\Column(name="desc_despesa" ,type="string") **/
    private $descDespesa;

    /** @ORM\Column(name="mes_ref" ,type="string") **/
    private $mesRef;


    /** @ORM\Column(type="decimal") **/
    private $valor;

    /**
     * @ORM\OnetoOne(targetEntity="TipoDespesa")
     * @ORM\JoinColumn(name="tipo", referencedColumnName="id")
     **/
    private $tipoDespesa;

    /** @ORM\Column(type="boolean") **/
    private $despesa_fixa;

    /** @ORM\Column(name = "data" ,type="date") **/
    private $data;

    /** @ORM\Column(name = "data_termino" ,type="date") **/
    private $dataFim;

    /**
     * @ORM\OnetoOne(targetEntity="Renda")
     * @ORM\JoinColumn(name="salario", referencedColumnName="id")
     **/
    private $salario;

    /**
     * @return mixed
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * @param mixed $salario
     */
    public function setSalario($salario)
    {
        $this->salario = $salario;
    }

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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
    public function getDescDespesa()
    {
        return $this->descDespesa;
    }

    /**
     * @param mixed $descDespesa
     */
    public function setDescDespesa($descDespesa)
    {
        $this->descDespesa = $descDespesa;
    }



    /**
     * @return mixed
     */
    public function getTipoDespesa()
    {
        return $this->tipoDespesa;
    }

    /**
     * @param mixed $tipoDespesa
     */
    public function setTipoDespesa($tipoDespesa)
    {
        $this->tipoDespesa = $tipoDespesa;
    }

    /**
     * @return mixed
     */
    public function getDespesaFixa()
    {
        return $this->despesa_fixa;
    }

    /**
     * @param mixed $despesa_fixa
     */
    public function setDespesaFixa($despesa_fixa)
    {
        $this->despesa_fixa = $despesa_fixa;
    }

    /**
     * @return mixed
     */
    public function getData($format = null)
    {
        if(!is_null($format)){

            return $mes = date_format($this->data,'Y-m-d');
        }
        else{
            $mes = date_format($this->data,'d/m/Y');
        }
        return $mes;

    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data =  date_format($this->data, 'Y-m-d');
    }

    /**
     * @return mixed
     */
    public function getDataFim()
    {
        if(!is_null($this->dataFim) ) {
            $mes = date_format($this->dataFim, 'Y-m-d');
            return $mes;
        }
        return $this->dataFim;
    }

    /**
     * @param mixed $dataFim
     */
    public function setDataFim($dataFim)
    {
        $this->dataFim = $dataFim;
    }

    /**
     * @return mixed
     */
    public function getMesRef()
    {
        return $this->mesRef;
    }

    /**
     * @param mixed $mesRef
     */
    public function setMesRef($mesRef)
    {
        $this->mesRef = $mesRef;
    }


    public function exchangeArray($array)
    {
        if (is_array($array))
        {
            //var_dump($array);
            $this->id = !empty($array['id']) ? $array['id'] : null;
            $this->descDespesa= $array['descDespesa'];

            $date = new \DateTime($array['data']);
            $this->data= $date;

            $this->user= $array['uid'];
            $this->dataFim= !empty($array['dataFim']) ? $array['dataFim'] : null;
            $this->mesRef= !empty($array['mesRef']) ? $array['mesRef'] : null;
            $this->valor = $array['valor'];

            //$this->salario = $this->salario = $em->getRepository('Despesas\Model\Renda')
             //   ->find($array['id']);

            $em = $GLOBALS['entityManager'];
            $this->tipoDespesa =  $em->getRepository('Despesas\Model\TipoDespesa')->find($array['tipoDespesa']);
            $this->salario = $em->getRepository('Despesas\Model\Renda')->find($array['renda']);


            //$this->tipoDespesa = !empty($array['tipoDespesa']) ? $array['tipoDespesa'] : null;

        }
        else
        {
            $em = $GLOBALS['entityManager'];
            $this->id = $array->id;
            $this->user = $array->user;
            $this->descDespesa= $array->descDespesa;
            $this->data= $array->data;
            $this->dataFim= $array->dataFim;
            $this->mesRef= $array->mesRef;
            $this->valor = $array->valor;
            $this->tipoDespesa = $array->tipoDespesa;
            //$this->tipoDespesa =  $em->getRepository('Despesas\Model\TipoDespesa')->find($array['tipoDespesa']);
            //$this->salario = $array->renda;
        }

    }

    public function getArrayCopy(){
        return get_object_vars($this);
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();


            $inputFilter->add(array(
                'name' => 'valor',
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'option' => array(
                            'messages' => array(
                                NotEmpty::IS_EMPTY => 'Campo Obrigatorio'
                            )
                        )
                    )
                )
                //'filters' =>
            ));

          /*  $inputFilter->addFilter('descDespesa', new StripTags());
            $inputFilter->addFilter('descDespesa', new StringTrim());

            $inputFilter->addFilter('valor', new Int());
            $inputFilter->addValidator('valor', new Digits());

            $inputFilter->addValidator('valor', new NotEmpty());

            $inputFilter->addValidator('tipoDespesa', new NotEmpty());

            $inputFilter->addValidator('descDespesa', new NotEmpty());

            $inputFilter->addChains();

          */



            $this->inputFilter = $inputFilter;
        }

        //var_dump($this->inputFilter);die();
        return $this->inputFilter;

    }



}
