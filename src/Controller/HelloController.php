<?php

namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializerBuilder;

class HelloController extends FOSRestController
{
    /**
     * @GET("/hello", name="hello")
     */
    public function getHelloAction()
    {
        return new JsonResponse(['Hello World']);
            
        
    }
    
    /**
     * @GET("/hello/{name}", name="hello_name")
     */
    public function getHelloNAmeAction($name)
    {

        $serializer = SerializerBuilder::create()->build();
        $jsonContent = $serializer->serialize($name, 'json');
        return new JsonResponse(['Hello '.$name]);
    }
}
