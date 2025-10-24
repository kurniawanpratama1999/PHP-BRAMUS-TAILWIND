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
            <button onclick="goTop()" id="go-top"
                class="hidden z-50 w-[50px] aspect-square outline rouded-full shadow bg-emerald-300 rounded-full items-center justify-center rotate-180 fixed bottom-5 right-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="#000" d="m7 10l5 5l5-5z" />
                </svg>
            </button>

            <div id="layout" class="bg-neutral-200 relative p-5 h-dvh">
                <!-- MENU NAV-->
                <div id="menu"
                    class="fixed top-5 left-5 bottom-5 flex flex-col gap-5 bg-neutral-50 rounded shadow p-5 w-[300px] col-start-1 row-span-2">
                    <nav>
                        <h2 class="font-semibold italic text-emerald-500 text-lg">Master Data</h2>
                        <ul class="space-y-1 [&_a]:py-1 px-2 mt-2">
                            <li>
                                <a href="/dashboard/users"
                                    class="text-neutral-700 hover:text-emerald-500 flex items-center gap-2">
                                    <i class="bi bi-person-fill text-2xl"></i>
                                    <span>User Accounts</span>
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/users"
                                    class="text-neutral-700 hover:text-emerald-500 flex items-center gap-2">
                                    <i class="bi bi-person-fill-gear text-2xl"></i>
                                    <span>User Level</span>
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/products"
                                    class="text-neutral-700 hover:text-emerald-500 flex items-center gap-2">
                                    <i class="bi bi-box-seam-fill text-2xl"></i>
                                    <span>Product Lineup</span>
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/categories"
                                    class="text-neutral-700 hover:text-emerald-500 flex items-center gap-2">
                                    <i class="bi bi-backpack-fill text-2xl"></i>
                                    <span>Product Category</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <nav>
                        <h2 class="font-semibold italic text-blue-500 text-lg">Another Data</h2>
                        <ul class="space-y-1 [&_a]:py-1 px-2 mt-2">
                            <li>
                                <a href="/dashboard/users" class="text-neutral-700 hover:text-blue-500 flex items-center gap-2">
                                    <i class="bi bi-receipt text-2xl"></i>
                                    <span>Orders History</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="pl-80">
                    <!-- HEADER -->
                    <header class="bg-neutral-100 flex items-center gap-5 px-4 h-16 shadow rounded">
                        <div class="flex flex-col">
                            <h1 class="font-bold text-left text-blue-500">POINT OF SALES 1.0</h1>
                            <p class="capitalize flex items-center">
                                <?php $ar = explode("/", ltrim($_SERVER['REQUEST_URI'], '/')) ?>
                                <?php foreach ($ar as $k => $v): ?>
                                    <?php if (count($ar) - 1  > $k) {
                                        echo "<span>$v</span>";
                                        echo "
                                        <span>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24'>
                                                <path fill='currentColor' d='M8.59 16.58L13.17 12L8.59 7.41L10 6l6 6l-6 6z'/>
                                            </svg>
                                        </span>
                                        ";
                                    } else {
                                        echo "<span>$v</span>";
                                    } ?>
                                <?php endforeach ?>
                            </p>
                        </div>

                        <button id="btn-menu" class="hidden items-center gap-1">
                            <span>Menu</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="#888888" d="m7 10l5 5l5-5z" />
                                </svg>
                            </span>
                        </button>

                        <button id="btn-profile" class="flex items-center gap-1 ml-auto">
                            <span>Profile</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                    <path fill="#888888" d="m7 10l5 5l5-5z" />
                                </svg>
                            </span>
                        </button>

                        <!-- PROFILE NAV -->
                        <div id="profile"
                            class="hidden flex-col gap-5 absolute right-4 top-24 bg-slate-50 outline p-5 rounded-xl w-[300px]">
                            <nav>
                                <h2 class="font-semibold italic text-blue-500 text-lg">Kurniawan Pratama</h2>
                                <ul class="space-y-1 [&_a]:py-1 px-2">
                                    <li><a href="/dashboard/users" class="text-neutral-700 hover:text-blue-500">User
                                            Accounts</a></li>
                                    <li><a href="/dashboard/products" class="text-neutral-700 hover:text-blue-500">Product
                                            Collection</a></li>
                                    <li><a href="/dashboard/categories" class="text-neutral-700 hover:text-blue-500">Category
                                            of Product</a></li>
                                </ul>
                            </nav>
                        </div>
                    </header>

                    <main class="col-start-2 row-start-2 py-5">
                        <?= $content ?>
                    </main>
                </div>
            </div>
        </body>
        <script>
            const goTop = () => {
                window.scrollTo({
                    top: 0
                })
            }

            const getGoTop = document.querySelector('#go-top')
            window.addEventListener('scroll', (e) => {
                const getScrollY = window.scrollY;

                if (getScrollY > 84) {
                    getGoTop.classList.replace("hidden", "flex")
                } else {
                    getGoTop.classList.replace("flex", "hidden")
                }
            })

            const getMenu = document.querySelector('#menu')
            const handleBtnMenu = document.querySelector('#btn-menu')
            handleBtnMenu.addEventListener('click', () => {
                getMenu.classList.toggle("hidden")
                getMenu.classList.toggle("flex")
            })

            const getProfile = document.querySelector('#profile')
            const handleBtnProfile = document.querySelector('#btn-profile')
            handleBtnProfile.addEventListener('click', () => {
                getProfile.classList.toggle("hidden")
                getProfile.classList.toggle("flex")
            })
        </script>

        </html>

<?php return ob_get_clean();
    }
}
?>