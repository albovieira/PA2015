<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Tropa\Form;
use Components\Form\AbstractForm;

class LanternaForm extends AbstractForm{
    protected $setorTable;

    public function __construct($name = null)
    {
        parent::__construct('lanterna');
        $this->setAttribute('method', 'post');

        $this->addElement('nome', 'text', 'Nome');

        $options = array('value_options' => $this->getValueOptions());
        $this->addElement('codigo_setor', 'select', 'Setor', null, $options);

        $this->addElement('codigo', 'hidden');
        $this->addElement('submit', 'submit', 'Gravar');
    }
      public function getValueOptions() {
          $valueOptions = array();

          $dql = "select s from Tropa\Model\Setor s";
          $em = $GLOBALS['entityManager'];
          $query = $em->createQuery($dql);
          $setores = $query->getResult();

          foreach($setores as $setor)
          {
              $valueOptions[$setor->codigo] = $setor->nome;
          }
          return $valueOptions;
      }
}


