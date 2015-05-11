<?php

//use PDO;

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
  'service_manager' => array(
      'invokables' => array(
          'Zend\Session\SessionManager' => 'Zend\Session\SessionManager',
      ),
      'factories' => array(
          'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
      ),
   ),
   'doctrine_config' => array(
       'driver' => 'pdo_mysql',
       'user' => 'root',
       'password' => '',
       'dbname' => 'doacao_sistema'
   ) ,

);
