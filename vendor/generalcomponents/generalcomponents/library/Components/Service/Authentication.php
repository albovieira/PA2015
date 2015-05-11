<?php
/**
 * Created by PhpStorm.
 * User: Albo
 * Date: 17/02/2015
 * Time: 17:33
 */

namespace Components\Service;

use Zend\Authentication\AuthenticationService;

use Zend\EventManager\EventInterface;

class Authentication
{
    public static function verifyIdentity(EventInterface $e)
    {
        $application = $e->getApplication();

        $request = $application->getRequest();

        $uri = $request->getRequestUri();


        // separamos os segmentos do URL e recuperamos o último
        $segment = explode('/',$uri);
        $uri = end($segment);

        $baseUrl = str_replace('/','', $request->getBaseUrl());

        $uri = empty($uri) ? $baseUrl : $uri;

        //if ($uri == $baseUrl || $uri == 'login' || $uri == 'cadastrar' || $uri == "modal-login")
            return;


        $authentication = new AuthenticationService();

        if (!$authentication->hasIdentity())
        {
            // preparemos um redirecionamento para a página de acesso ao sistema
              $response = $e->getResponse();
              $response->setHeaders($response->getHeaders()->addHeaderLine('Location', $request->getBaseUrl()));
            //$response->setStatusCode(302);


            //var_dump($response->sendHeaders());

            $response->sendHeaders();

            exit ();
        }
    }
}