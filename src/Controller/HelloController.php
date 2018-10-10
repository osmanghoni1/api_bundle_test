<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;

class HelloController extends FOSRestController
{
    /**
     * @GET("/api/hello", name="hello")
     */
    public function getHelloAction()
    {
        return new JsonResponse(['Hello World']);
    }
    
    /**
     * @GET("/api/hello/{name}", name="hello_name")
     */
    public function getHelloNameAction($name)
    {
        return new JsonResponse(['Hello '.$name]);
    }
}
