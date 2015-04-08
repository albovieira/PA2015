<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Despesas\Form;
use Components\Form\AbstractForm;

class RendaForm extends AbstractForm{
    //protected $setorTable;

    public function __construct($name = null)
    {
        parent::__construct('renda');
        $this->setAttribute('method', 'post');

         $this->addElement('valor', 'text', 'Valor');

        $options = array('value_options' => $this->getValueOptions('TipoRenda'));
        $this->addElement('tipoRenda', 'select', 'TipoRenda', null, $options);


        $this->addElement('id', 'hidden');
        $this->addElement('uid', 'hidden');
        $this->addElement('submit', 'submit', 'Gravar');
    }


      public function getValueOptions($model) {
          $valueOptions = array();

          $dql = "select tr from Despesas\Model\\$model tr";
          $em = $GLOBALS['entityManager'];
          $query = $em->createQuery($dql);
          $resultModels = $query->getResult();

          foreach($resultModels as $result)
          {
              $valueOptions[$result->getId()] = $result->getDesc();
          }
          return $valueOptions;
      }
}


