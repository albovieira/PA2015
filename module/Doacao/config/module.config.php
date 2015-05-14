<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(

    /*'doctrine' => array(
        'driver' => array(
            'doacao_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Album/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Doacao\Entity' =>  'doacao_driver'
                ),
            ),
        ),
    ),*/

    'router' => array(
        'routes' => array(
            'doacao' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/doacao[/][/:action]',
                    'defaults' => array(
                        'controller' => 'Doacao\Controller\Home',
                        'action'     => 'index',
                    ),
                ),
            ),
            'pessoa' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/pessoa[/:action]',
                    'defaults' => array(
                        'controller' => 'Doacao\Controller\Pessoa',
                        'action'     => 'index',
                    ),
                ),
            ),
            'instituicao' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/instituicao[/][/:action]',
                    'defaults' => array(
                        'controller' => 'Doacao\Controller\Instituicao',
                        'action'     => 'index',
                    ),
                ),
            ),

            'donativo' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/donativo[/][/:action]',
                    'defaults' => array(
                        'controller' => 'Doacao\Controller\Donativo',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '[]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Doacao\Controller',
                        'controller'    => 'Home',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(

        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Doacao\Controller\Home' => 'Doacao\Controller\HomeController',
            'Doacao\Controller\Pessoa' => 'Doacao\Controller\PessoaController',
            'Doacao\Controller\Instituicao' => 'Doacao\Controller\InstituicaoController',
            'Doacao\Controller\Donativo' => 'Doacao\Controller\DonativoController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'home/index' => __DIR__ . '/../view/home/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
        ),
        'template_path_stack' => array(
            'Doacao' => __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
