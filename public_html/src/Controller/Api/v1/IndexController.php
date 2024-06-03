<?php

namespace App\Controller\Api\V1;

use Symfony\Component\HttpFoundation\JsonResponse;

class IndexController
{
    public function index()
    {
        $response = new JsonResponse();
        $response->setData(array(
            'data' => 'Hello'
        ));
        $response->send();
    }

    public function test()
    {
        $response = new JsonResponse();
        $response->setData(array(
            'data' => 'Hello test!'
        ));
        $response->send();
    }

    public function greet($name)
    {
        $response = new JsonResponse();
        $response->setData(array(
            'data' => "Hello $name"
        ));
        $response->send();
    }
}