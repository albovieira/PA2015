<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Authentication\AuthenticationService;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $this->initAcl($e);
        $e->getApplication()->getEventManager()->attach('route', array($this, 'checkAcl'));


        $translator = $e->getApplication()->getServiceManager()->get('MvcTranslator');
        $translator->addTranslationFile(
            'phpArray',
            'vendor/zendframework/zendframework/resources/languages/pt_BR/Zend_Validate.php'
        );

        \Zend\Validator\AbstractValidator::setDefaultTranslator($translator);


        $this->personalizaLoginForm($e);
    }

    public function initAcl(MvcEvent $e) {

        $acl = new \Zend\Permissions\Acl\Acl();
        $roles = include __DIR__ . '/config/module.acl.roles.php';
        $allResources = array();
        foreach ($roles as $role => $resources) {

            $role = new \Zend\Permissions\Acl\Role\GenericRole($role);
            $acl -> addRole($role);
            $allResources = array_merge($resources, $allResources);

            foreach ($resources as $resource) {
                if(!$acl ->hasResource($resource))
                    $acl -> addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resource));
            }

            foreach ($allResources as $resource) {
                $acl -> allow($role, $resource);
            }
        }

        $e -> getViewModel() -> acl = $acl;

    }

    public function personalizaLoginForm(MvcEvent $e){
        $events = $e->getApplication()->getEventManager()->getSharedManager();
        $events->attach('ZfcUser\Form\Register','init', function($e) {
            /** @var \ZfcUser\Form\Register $form */
            $form = $e->getTarget();
            $form->get('email')->setAttributes(array(
                'class' => 'form-control'
            ));

            $form->get('password')->setLabel('Senha');
            $form->get('password')->setAttributes(array(
                'class' => 'form-control'
            ));

            $form->get('passwordVerify')->setLabel('Confirmar Senha');
            $form->get('passwordVerify')->setAttributes(array(
                'class' => 'form-control'
            ));

            $form->add(
                array(
                    'name' => 'perfil',
                    'options' => array(
                        'label' => 'Cadastrar como instituicao?',
                    ),
                    'attributes' => array(
                        'type'  => 'radio',
                    ),
                )
            );
            $form->get('submit')->setAttributes(array(
                'class' => 'btn btn-success'
            ));
            // Do what you please with the form instance ($form)
        });
        $events->attach('ZfcUser\Form\RegisterFilter','init', function($e) {
            $filter = $e->getTarget();
            // Do what you please with the filter instance ($filter)
        });
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                'Components' => realpath(__DIR__ . '/../../vendor/generalcomponents/generalcomponents/library/Components'),
                ),
            ),
        );
    }

    public function checkAcl(MvcEvent $e) {
        $route = $e->getRouteMatch()->getMatchedRouteName();
        $userRole = 'guest';
        $auth = new AuthenticationService();
        if($auth->getIdentity() != null){
            $userRole = 'admin';
        };

        if ($e->getViewModel()->acl->hasResource($route) && !$e->getViewModel()->acl->isAllowed($userRole, $route)) {

            $e->getRouteMatch()
                ->setParam('controller', 'Application\Controller\Index')
                ->setParam('action', 'index');
        }
    }
}
