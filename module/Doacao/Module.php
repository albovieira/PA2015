<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Doacao;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\I18n\Translator\Translator;
use Zend\Validator\AbstractValidator;


class Module
{
	const DOCTRINE_BASE_PATH = '/../../vendor/doctrine/orm/lib/Doctrine';	
	
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        // traduz mensagens de erro para portugues
        $translator = new Translator(new \Zend\I18n\Translator\Translator());
        $translator->addTranslationFile(
            'phpArray',
            './vendor/zendframework/zendframework/resources/languages/pt_BR/Zend_Validate.php'
        );
        //$translator->setLocale('pt_BR');
        //AbstractValidator::setDefaultTranslator(new Translator($translator));

        $GLOBALS['sm'] = $e->getApplication()->getServiceManager();

        $this->initializeDoctrine2($e);
    }

    private function initializeDoctrine2($e)
    {
        $conn = $this->getDoctrine2Config($e);
    	$config = new Configuration();
    	$cache = new ArrayCache();
    	$config->setMetadataCacheImpl($cache);
    	$annotationPath	= realpath(__DIR__ . self::DOCTRINE_BASE_PATH . '/ORM/Mapping/Driver/DoctrineAnnotations.php');
    	AnnotationRegistry::registerFile($annotationPath);
    	$driver = new AnnotationDriver(
    			new AnnotationReader(),
    		//	array(__DIR__ . '/src/Doacao/Entity')
    			array(__DIR__ .'\..\Application\src\Application/Entity')
    	);
    	$config->setMetadataDriverImpl($driver);
    	$config->setProxyDir(__DIR__ .'\..\Application\src\Application\Proxy');
    	$config->setProxyNamespace('Application\Proxy');
    	$entityManager = EntityManager::create($conn, $config);
    	$GLOBALS['entityManager'] = $entityManager;

    }

    private function getDoctrine2Config($e)
    {
    	$config = $e->getApplication()->getConfig();
    	return $config['doctrine_config'];
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
                    'Components' => realpath(__DIR__ .'/../../vendor/generalcomponents/generalcomponents/library/Components'),
                	'Doctrine\Common' => realpath(__DIR__ . self::DOCTRINE_BASE_PATH . '/Common'),
                	'Doctrine\DBAL' => realpath(__DIR__ . self::DOCTRINE_BASE_PATH . '/DBAL'),
                	'Doctrine\ORM' => realpath(__DIR__ . self::DOCTRINE_BASE_PATH . '/ORM')
                ),
            ),
        );
    }
    
}
