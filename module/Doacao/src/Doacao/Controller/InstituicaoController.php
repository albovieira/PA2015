<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Doacao\Controller;

use Components\MVC\Controller\AbstractCrudController;
use Components\MVC\Controller\AbstractDoctrineCrudController;
use Doctrine\DBAL\Schema\View;
use Zend\Authentication\AuthenticationService;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Helper\Json;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Doacao\Model\Instituicao;
use Doacao\Form\InstituicaoForm;

class InstituicaoController extends AbstractDoctrineCrudController
{

	public function __construct(){
        /* $this->formClass = 'Despesas\Form\DespesaForm';
         $this->modelClass = 'Despesas\Model\Despesa';
         $this->route = 'despesa';
         $this->title = 'Cadastro de Despesas';
         $this->label['yes'] = 'Sim';
         $this->label['no'] = 'Não';
         $this->label['add'] = 'Incluir';
         $this->label['edit'] = 'Alterar';
        */
     }
     
     private function instituicaoId($id){
     	$instituicao = new Instituicao();
     	$em = $GLOBALS['entityManager'];
     	
     	$instituicao = $em->find('Doacao\Model\Instituicao',$id);
     	
     	return $instituicao;
     }
           
	 public function indexAction()
     {
     	$instituicao = $this->instituicaoId(1);
        $this->layout()->setTemplate('layout/layout_menu_Instituicao');
        return new ViewModel(array(
        		'instituicao'=>$instituicao,
        		'donativos'=>$this->getDonativos($instituicao->__get('donativos')),
        		'pageTitle'=>'Bem vindo',		
        ));
     }
     
     /**
      * 
      * @param Object $donativos
      * @return Ambigous <multitype:, string>
      */
     public function getDonativos($donativos){
     	$donativoHtml = array();
     	
     	foreach ($donativos as $donativo){
     		$id = $donativo->__get('id');
     		$titulo = $donativo->__get('titulo');
     		$quantidade = $donativo->__get('quantidade');
     		$dtInclusao = $donativo->__get('dataInclusao');
     		$dtExpira = $donativo->__get('dataExpiracao');
     		$descricao = $donativo->__get('descricao');
     		$categoria = $donativo->__get('categoria')->__get('categoria');
     		$link = $this->url('instituicao',array('action'=>'doacao','id'=>$id));
     		$htmlList = "<li class='list-group-item'>{$titulo}<span class='badge'>{$quantidade}</span><br><sub>Pedido em: {$dtInclusao->format('d/m/Y')}</sub>
       					 | <sub>Expira em: {$dtExpira->format('d/m/Y')} | Categoria: {$categoria}</sub>
       					 </li>". 
       		"<ul class='list-flat list-group'>".
       			"<li class='list-group-item'>{$descricao}</li>".
       			"<li class='list-group-item'><a href='/donativo/{$id}'>Gerenciar</a></li>".
       		"</ul>";
     		array_push($donativoHtml,$htmlList);
     	}
     	//var_dump($donativoHtml);exit();
     	return $donativoHtml;
     }
     
     public function addAction(){
     	$this->layout('layout/layout_menu_Instituicao');
     }
     
}
