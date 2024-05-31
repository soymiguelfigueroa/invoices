<?php

namespace App\Controller;

class IndexController
{
    public function index()
    {
        echo 'Hello!';
    }

    public function test()
    {
        echo 'Hello test!';
    }

    public function greet($name)
    {
        debug($name);
    }
}