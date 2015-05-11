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
use Zend\Authentication\AuthenticationService;

class DespesaForm extends AbstractForm{
    //protected $setorTable;

    public function __construct($name = null)
    {
        parent::__construct('despesa');
        $this->setAttribute('method', 'post');

        $this->addElement('valor', 'text', 'Valor');

        $this->addElement('descDespesa', 'text', 'Descricao');


        $options = array(
            'value_options' => $this->getValueOptions('TipoDespesa'),
        );
        $this->addElement('tipoDespesa', 'select', 'Tipo', null, $options);

        $this->addElement('id', 'hidden');

        $this->addElement('uid', 'hidden', 'uid', null,null, $this->getUsuarioAtual()->uid);



        $options = array(
            'value_options' => $this->getValueSalarios('Renda'),
        );
        $this->addElement('renda', 'select', 'Renda', null, $options);

        $this->addElement('data', 'date', 'Data', null,null, null);

        $this->addElement('submit', 'submit', 'Salvar');
    }


      public function getValueOptions($model) {
          $valueOptions = array();

          $dql = "select td from Despesas\Model\\$model td order by td.descDespesa ASC";
          $em = $GLOBALS['entityManager'];
          $query = $em->createQuery($dql);
          $resultModels = $query->getResult();

          foreach($resultModels as $result)
          {
              $valueOptions[$result->getId()] = $result->getDesc();
          }

          return $valueOptions;
      }

    public function getValueSalarios($model) {
        $valueOptions = array();

        $dql = "select ren from Despesas\Model\\$model ren order by ren.mes DESC";
        $em = $GLOBALS['entityManager'];
        $query = $em->createQuery($dql);
        $resultModels = $query->getResult();

        foreach($resultModels as $result)
        {
            $valueOptions[$result->getId()] = $result->getMes();
        }

        return $valueOptions;
    }


    public function getUsuarioAtual(){
        $authentication = new AuthenticationService();
        $user = $authentication->getIdentity();
        return $user;
    }

}


