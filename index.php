<?php
// index.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start de sessie
session_start();

// Autoload classes (Composer of custom autoloader)
require_once __DIR__ . '/vendor/autoload.php';

// Gebruik namespaces
use config\AppConfig;
use app\Controllers\HomeController;
use app\Controllers\ProductController;
use app\Controllers\OrderController;
use app\Controllers\UserController;

// Basis routing logica
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$baseUri = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
$route = str_replace($baseUri, '', $requestUri);
$route = trim($route, '/');

// Routing
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

    case 'cart':
        $controller = new OrderController();
        $controller->cart();
        break;

    case 'checkout':
        $controller = new OrderController();
        $controller->checkout();
        break;

    case 'user/login':
        $controller = new UserController();
        $controller->login();
        break;

    case 'user/register':
        $controller = new UserController();
        $controller->register();
        break;

    case 'user/logout':
        $controller = new UserController();
        $controller->logout();
        break;

    default:
        http_response_code(404);
        echo "<h1>404 - Pagina niet gevonden</h1>";
        break;
}
