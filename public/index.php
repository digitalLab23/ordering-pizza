<?php
// public/index.php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use app\Controllers\HomeController;
use app\Controllers\ProductController;

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$baseUri = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
$route = trim(str_replace($baseUri, '', $requestUri), '/');

switch ($route) {
    case '':
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    case 'menu':
        $controller = new ProductController();
        $controller->index();
        break;

    default:
        http_response_code(404);
        echo "<h1>404 - Pagina niet gevonden</h1>";
        break;
}
