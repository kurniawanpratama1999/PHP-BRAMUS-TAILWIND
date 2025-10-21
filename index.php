<?php
require_once __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use App\Controllers\{HomeController, DashboardController};

$router = new Router();

$router->get('/', [new HomeController(), "index"]);
$router->get('/dashboard', [new DashboardController(), "dashboard"]);
$router->get('/dashboard/users', [new DashboardController(), "readUsers"]);
$router->get('/dashboard/users/edit', [new DashboardController(), "readUsers"]);
$router->get('/dashboard/users/add', [new DashboardController(), "readUsers"]);

$router->get('/dashboard/products', [new DashboardController(), "readProducts"]);
$router->get('/dashboard/products/edit', [new DashboardController(), "readProducts"]);
$router->get('/dashboard/products/add', [new DashboardController(), "readProducts"]);

$router->get('/dashboard/categories', [new DashboardController(), "readCategories"]);
$router->get('/dashboard/categories/{cmd}', function ($cmd) {
    return (new DashboardController())->updateCategories($cmd);
});


$router->run();
