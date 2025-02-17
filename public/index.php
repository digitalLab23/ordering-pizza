<?php
// public/index.php

require_once __DIR__ . '/../vendor/autoload.php';

use app\Helpers\SessionManager;
use app\Controllers\HomeController;
use app\Controllers\ProductController;
use app\Controllers\UserController;

SessionManager::startSession();

// Basis routing logica
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$baseUri = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
$route = strtolower(trim(str_replace($baseUri, '', $requestUri), '/'));

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

    case 'user/register': // Hoofdlettergevoelige fix
        $controller = new UserController();
        $controller->register();
        break;

    default:
        http_response_code(404);
        error_log("404: Route niet gevonden - " . $route);
        echo "<h1>404 - Pagina niet gevonden</h1>";
        break;
}
