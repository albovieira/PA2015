<?php

namespace Components\InputFilter;

use Zend\Filter\FilterChain;
use Zend\Filter\FilterInterface;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter as ZendInputFilter;
use Zend\Validator\ValidatorChain;
use Zend\Validator\ValidatorInterface;

class InputFilter extends ZendInputFilter{
    protected $inputs = array();
    protected $filters = array();
    protected $validators = array();

    public function addInput($name)
    {
        $this->inputs[$name] = new Input($name);
    }

    public function addFilter($name, FilterInterface $filter)
    {
        $this->filters[$name] = isset($this->filters[$name]) ? $this->filters[$name] : new FilterChain();
        $this->filters[$name]->attach($filter);
    }

    public function addValidator($name, ValidatorInterface $validator)
    {
        $this->validators[$name] = isset($this->validators[$name]) ? $this->validators[$name] : new ValidatorChain();
        $this->validators[$name]->addValidator($validator);
    }

    public function addChains()
    {
        foreach($this->inputs as $name)
        {
            $this->inputs[$name]->setFilterChain($this->filters[$name]);
            $this->inputs[$name]->setValidatorChain($this->validators[$name]);
        }
    }


}