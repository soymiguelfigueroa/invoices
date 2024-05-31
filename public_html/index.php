<?php

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

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

$servername = $_ENV['DB_DATABASE'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";