<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController
{
    private $twig;
    
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('src/templates/');

        $this->twig = new \Twig\Environment($loader);
    }
    
    public function index()
    {
        $this->render();
    }

    private function render()
    {
        echo $this->twig->render('home/index.twig');

        return;
    }
}