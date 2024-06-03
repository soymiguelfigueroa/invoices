<?php

use App\Controller\IndexController;
use App\Controller\IndexController as ApiIndexController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

// Loading .env content
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

// Adding debug functions
if ($dotenv->required('APP_DEBUG')->isBoolean()) {
    if (!function_exists('debug')) {
        function debug($expression) {
            if (filter_var($_ENV['APP_DEBUG'], FILTER_VALIDATE_BOOLEAN)) {
                echo '<pre>';
                var_dump($expression);
                echo '</pre>';
            }
        }
    }

    if (!function_exists('dd')) {
        function dd($expression) {
            if (filter_var($_ENV['APP_DEBUG'], FILTER_VALIDATE_BOOLEAN)) {
                debug($expression);
                exit;
            }
        }
    }
}

$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection with database failed: " . $conn->connect_error);
}

// Routing system
$routes = new RouteCollection();

$route = new Route('/', ['_controller' => IndexController::class, '_action' => 'index']);
$routes->add('index', $route);
$route = new Route('/test', ['_controller' => IndexController::class, '_action' => 'test']);
$routes->add('test', $route);
$route = new Route('/greet/{name}', ['_controller' => IndexController::class, '_action' => 'greet']);
$routes->add('greet', $route);

$route = new Route('/api/v1', ['_controller' => ApiIndexController::class, '_action' => 'index']);
$routes->add('index', $route);
$route = new Route('/api/v1/test', ['_controller' => ApiIndexController::class, '_action' => 'test']);
$routes->add('test', $route);
$route = new Route('/api/v1/greet/{name}', ['_controller' => ApiIndexController::class, '_action' => 'greet']);
$routes->add('greet', $route);

$context = new RequestContext();
$context->fromRequest(Request::createFromGlobals());

$matcher = new UrlMatcher($routes, $context);

$parameters = $matcher->match($context->getPathInfo());

$controllerInfo = explode('::', $parameters['_controller']);

$controller = new $controllerInfo[0];

$action = $parameters['_action'];

unset($parameters['_controller'], $parameters['_action'], $parameters['_route']);

$controller->$action(...$parameters);
