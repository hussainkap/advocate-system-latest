<?php

declare(strict_types=1);

require_once __DIR__ . '/config/config.php';

$route = $_GET['route'] ?? 'auth/login';
$route = trim((string) $route, '/');

$allowedRoutes = [
    'auth/login' => __DIR__ . '/modules/auth/login.php',
    'auth/register' => __DIR__ . '/modules/auth/register.php',
    'auth/logout' => __DIR__ . '/modules/auth/logout.php',
    'products/index' => __DIR__ . '/modules/products/index.php',
    'products/create' => __DIR__ . '/modules/products/create.php',
    'products/edit' => __DIR__ . '/modules/products/edit.php',
    'products/delete' => __DIR__ . '/modules/products/delete.php',
];

if ($route === '') {
    $route = 'auth/login';
}

if (!array_key_exists($route, $allowedRoutes)) {
    http_response_code(404);
    echo '404 Not Found';
    exit;
}

require $allowedRoutes[$route];
