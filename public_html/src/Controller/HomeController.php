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
        $this->twig->addGlobal('app_name', $_ENV['APP_NAME']);
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