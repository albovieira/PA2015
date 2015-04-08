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

class SetorForm extends AbstractForm{
   public function __construct($name = null)
   {
       parent::__construct('setor');
       $this->setAttribute('method', 'post');
       $this->addElement('codigo', 'text', 'Código');
       $this->addElement('nome', 'text', 'Nome');
       $this->addElement('submit', 'submit', 'Gravar');
   }
}


