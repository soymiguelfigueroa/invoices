<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController
{
    public function index()
    {
        $response = new JsonResponse();
        $response->setData(array(
            'data' => 'Hello'
        ));
        $response->send();
    }
}