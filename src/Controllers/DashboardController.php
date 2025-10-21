<?php

namespace App\Controllers;

use App\Layouts\DashboardLayout;

class DashboardController
{
    public function dashboard()
    {
        require_once __DIR__ . '/../Views/dashboard/index.php';
    }

    // USERS

    public function readUsers()
    {
        require_once __DIR__ . '/../Views/dashboard/users/read-users.php';
    }
    public function updateUsers()
    {
        require_once __DIR__ . '/../Views/dashboard/users/read-users.php';
    }

    // PRODUCTS

    public function readProducts()
    {
        require_once __DIR__ . '/../Views/dashboard/products/read-products.php';
    }
    public function updateProducts()
    {
        require_once __DIR__ . '/../Views/dashboard/products/read-products.php';
    }


    // CATEGORIES

    public function readCategories()
    {
        require_once __DIR__ . '/../Views/dashboard/categories/read-categories.php';
    }

    // public function updateCategories($cmd)
    // {
    //     require_once __DIR__ . '/../Views/dashboard/categories/update-categories.php';
    //     updateCategories($cmd);
    // }
}
