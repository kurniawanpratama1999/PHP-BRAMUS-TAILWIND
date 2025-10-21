<?php

namespace App\Controllers;

use App\Layouts\DefaultLayout;

class HomeController
{
    public function index()
    {
        require_once __DIR__ . '/../Views/home.php';
    }
    public function contact()
    {
        require_once __DIR__ . '/../Views/contact.php';
    }

}
