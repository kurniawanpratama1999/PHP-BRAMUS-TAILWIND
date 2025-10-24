<?php

namespace App\Controllers;

use App\Layouts\DashboardLayout;

class DashboardController
{
    public function dashboard()
    {
        require_once __DIR__ . '/../Views/dashboard/index.php';
    }
}
