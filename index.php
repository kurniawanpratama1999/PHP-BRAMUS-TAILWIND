<?php
require_once __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use App\Controllers\{HomeController, DashboardController, UsersController};

// ✅ Middleware override method (TARUH DI SINI)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method'])) {
    $_SERVER['REQUEST_METHOD'] = strtoupper($_POST['_method']);
}


$router = new Router();

$router->get('/', [new HomeController(), "index"]);
$router->get('/dashboard', [new DashboardController(), "dashboard"]);

/* === USERS: START === */
// #1 HALAMAN: INDEX -> /dashboard/users
$router->get('/dashboard/users', [new UsersController(), "index"]);

// #2 HALAMAN: ADD -> /dashboard/user/add
$router->get('/dashboard/user/add', [new UsersController(), "add"]);

// #3 HALAMAN: EDIT -> /dashboard/user/edit
$router->get('/dashboard/user/{id}/edit', [new UsersController(), "edit"]);

// #4 METHOD: POST -> /dashboard/users/
$router->post('/dashboard/users', [new UsersController(), "create"]);

// #5 METHOD: PUT -> /dashboard/user/{id}/edit
$router->put('/dashboard/user/{id}/edit', [new UsersController(), "update"]);

// #6 METHOD: DELETE -> /dashboard/user/{id}
$router->delete('/dashboard/user/{id}', [new UsersController(), "delete"]);
/* === USERS: END === */

$router->run();
