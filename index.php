<?php
require_once __DIR__ . '/vendor/autoload.php';

use Bramus\Router\Router;
use App\Controllers\{HomeController, DashboardController, ProductsController, UsersController, UserLevelController};

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method'])) {
    $_SERVER['REQUEST_METHOD'] = strtoupper($_POST['_method']);
}


$router = new Router();

$router->get('/', [new HomeController(), "index"]);

$router->get('/dashboard', [new DashboardController(), "dashboard"]);

/* === USERS: START === */
// !1 HALAMAN: INDEX -> /dashboard/users
$router->get('/dashboard/users', [new UsersController(), "index"]);

// !2 HALAMAN: ADD -> /dashboard/user/add
$router->get('/dashboard/user/add', [new UsersController(), "add"]);

// !3 HALAMAN: EDIT -> /dashboard/user/edit
$router->get('/dashboard/user/{id}/edit', function ($id) {
    return (new UsersController())->edit($id);
});

// !4 METHOD: POST -> /dashboard/users/
$router->post('/dashboard/users', [new UsersController(), "create"]);

// !5 METHOD: PUT -> /dashboard/user/{id}/edit
$router->put('/dashboard/user/{id}/edit', function ($id) {
    return (new UsersController())->update($id);
});

// !6 METHOD: DELETE -> /dashboard/user/{id}
$router->delete('/dashboard/user/{id}', function ($id) {
    return (new UsersController())->destroy($id);
});
/* === USERS: END === */

/* === ROLES: START === */
$router->get('/dashboard/roles', [new UserLevelController(), "index"]);
$router->get('/dashboard/roles/{id}/edit', function ($id) {
    return (new UserLevelController())->index($id);
});
$router->post('/dashboard/roles', [new UserLevelController(), "create"]);
$router->put('/dashboard/roles/{id}/edit', function ($id) {
    return (new UserLevelController())->update($id);
});
$router->delete('/dashboard/roles/{id}', function ($id) {
    return (new UserLevelController())->delete($id);
});
/* === ROLES: END === */

/* === PRODUCTS: START === */
// !1 HALAMAN: INDEX -> /dashboard/products
$router->get('/dashboard/products', [new ProductsController(), "index"]);

// !2 HALAMAN: ADD -> /dashboard/product/add
$router->get('/dashboard/product/add', [new ProductsController(), "add"]);

// !3 HALAMAN: EDIT -> /dashboard/product/edit
$router->get('/dashboard/product/{id}/edit', function ($id) {
    return (new ProductsController())->edit($id);
});

// !4 METHOD: POST -> /dashboard/products
$router->post('/dashboard/products', [new ProductsController(), "create"]);

// !5 METHOD: PUT -> /dashboard/product/{id}/edit
$router->put('/dashboard/product/{id}/edit', function ($id) {
    return (new ProductsController())->update($id);
});

// !6 METHOD: DELETE -> /dashboard/product/{id}
$router->delete('/dashboard/product/{id}', function ($id) {
    return (new ProductsController())->destroy($id);
});
/* === PRODUCTS: END === */

$router->run();
