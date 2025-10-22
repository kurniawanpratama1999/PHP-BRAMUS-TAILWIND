<?php

namespace App\Layouts;

class DashboardLayout
{
    public static function render($content, $title = 'PPKD245')
    {
        ob_start(); ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $title ?></title>
            <link rel="stylesheet" href="/src/assets/css/output.css">
        </head>

        <body>
            <header class="relative z-3 h-16 bg-emerald-400 flex flex-row justify-between items-center px-4 text-white shadow">
                <h1 class="text-3xl font-bold text-center">
                    <a href="/dashboard">POS25 - Selamat Datang User</a>
                </h1>
                <a href="" class="font-bold text-end text-2xl">Logout</a>
            </header>
            <nav class="z-2 absolute h-dvh bg-slate-100 w-[350px] left-0 top-0 pt-14 shadow-xl">
                <ul class=" p-5 space-y-5 text-2xl text-slate-800 font-semibold">
                    <li><a href="/dashboard/users" class="hover:text-slate-700 hover:pl-4 transition-all hover:text-shadow-xs hover:shadow-black">User Accounts</a></li>
                    <li><a href="/dashboard/products" class="hover:text-slate-700 hover:pl-4 transition-all hover:text-shadow-xs hover:shadow-black">Product Collection</a></li>
                    <li><a href="/dashboard/categories" class="hover:text-slate-700 hover:pl-4 transition-all hover:text-shadow-xs hover:shadow-black">Category of Product</a></li>
                </ul>
            </nav>
            <main class="z-1 absolute w-full h-dvh bg-slate-100 top-0 left-0 pl-[360px] pt-16 overflow-y-auto overflow-x-hidden">
                <?= $content ?>
            </main>
        </body>

        </html>

<?php return ob_get_clean();
    }
}
?>