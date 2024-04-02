<?php
session_start();
$request = $_SERVER['REQUEST_URI'];
$viewDir = '/views/';
$controllerDir = '/controller/';

switch ($request) {
    case '':
    case '/':
        require __DIR__ . $viewDir . 'home.php';
        break;

    case '/api':
        require __DIR__ . $controllerDir . 'api.php';
        break;

    case '/result':
        require __DIR__ . $viewDir . 'result.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . $viewDir . 'result.php';
}