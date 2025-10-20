<?php
require_once __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use App\Controllers\HomeController;
// $callback = [HomeController::class, 'index'];


$router = new Router();

$router->get('/', [new HomeController(), "index"]);

$router->run();
