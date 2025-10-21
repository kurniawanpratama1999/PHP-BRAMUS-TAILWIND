<?php

namespace App\Controllers;

use App\Layouts\DashboardLayout;

class DashboardController
{
    public function dashboard()
    {
        $content = require_once __DIR__ . '/../Views/dashboard/dashboard.php';
        echo DashboardLayout::render($content);
    }

    // USERS

    public function readUsers()
    {
        $content = require_once __DIR__ . '/../Views/dashboard/users/read-users.php';
        echo DashboardLayout::render($content);
    }
    public function updateUsers()
    {
        $content = require_once __DIR__ . '/../Views/dashboard/users/read-users.php';
        echo DashboardLayout::render($content);
    }

    // PRODUCTS

    public function readProducts()
    {
        $content = require_once __DIR__ . '/../Views/dashboard/products/read-products.php';
        echo DashboardLayout::render($content);
    }
    public function updateProducts()
    {
        $content = require_once __DIR__ . '/../Views/dashboard/products/read-products.php';
        echo DashboardLayout::render($content);
    }


    // CATEGORIES

    public function readCategories()
    {
        $content = require_once __DIR__ . '/../Views/dashboard/categories/read-categories.php';
        echo DashboardLayout::render($content);
    }
    public function updateCategories($cmd)
    {
        require_once __DIR__ . '/../Views/dashboard/categories/update-categories.php';
        $content = updateCategories($cmd);
        echo DashboardLayout::render($content);
    }
}
