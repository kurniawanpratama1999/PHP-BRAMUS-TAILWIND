<?php

namespace App\Controllers;

use App\Layouts\DefaultLayout;

class HomeController
{
    public function index()
    {
        $content = require_once __DIR__ . '/../Views/home.php';
        echo DefaultLayout::render($content);
    }
    public function contact()
    {
        $content = require_once __DIR__ . '/../Views/contact.php';
        echo DefaultLayout::render($content);
    }
    
}
