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
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#888888"
                                                d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                                        </svg>
                                    </span>
                                    <span>User Accounts</span>
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/users"
                                    class="text-neutral-700 hover:text-emerald-500 flex items-center gap-2">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#888888"
                                                d="m21.1 12.5l1.4 1.41l-6.53 6.59L12.5 17l1.4-1.41l2.07 2.08zM10 17l3 3H3v-2c0-2.21 3.58-4 8-4l1.89.11zm1-13a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4" />
                                        </svg>
                                    </span>
                                    <span>User Level</span>
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/products"
                                    class="text-neutral-700 hover:text-emerald-500 flex items-center gap-2">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#888888"
                                                d="M2 10.96a.985.985 0 0 1-.37-1.37L3.13 7c.11-.2.28-.34.47-.42l7.83-4.4c.16-.12.36-.18.57-.18s.41.06.57.18l7.9 4.44c.19.1.35.26.44.46l1.45 2.52c.28.48.11 1.09-.36 1.36l-1 .58v4.96c0 .38-.21.71-.53.88l-7.9 4.44c-.16.12-.36.18-.57.18s-.41-.06-.57-.18l-7.9-4.44A.99.99 0 0 1 3 16.5v-5.54c-.3.17-.68.18-1 0m10-6.81v6.7l5.96-3.35zM5 15.91l6 3.38v-6.71L5 9.21zm14 0v-3.22l-5 2.9c-.33.18-.7.17-1 .01v3.69zm-5.15-2.55l6.28-3.63l-.58-1.01l-6.28 3.63z" />
                                        </svg>
                                    </span>
                                    <span>Product Lineup</span>
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/categories"
                                    class="text-neutral-700 hover:text-emerald-500 flex items-center gap-2">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#888888"
                                                d="M12 2c-.2 0-.4.1-.6.2L3.5 6.6c-.3.2-.5.5-.5.9v9c0 .4.2.7.5.9l7.9 4.4c.2.1.4.2.6.2s.4-.1.6-.2l.9-.5c-.3-.6-.4-1.3-.5-2v-6.7l6-3.4V13c.7 0 1.4.1 2 .3V7.5c0-.4-.2-.7-.5-.9l-7.9-4.4c-.2-.1-.4-.2-.6-.2m0 2.2l6 3.3l-2 1.1l-5.9-3.4zM8.1 6.3L14 9.8l-2 1.1l-6-3.4zM5 9.2l6 3.4v6.7l-6-3.4zm16.3 6.6l-3.6 3.6l-1.6-1.6L15 19l2.8 3l4.8-4.8z" />
                                        </svg>
                                    </span>
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
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                            <path fill="#888888"
                                                d="M17 2H2v15h2V4h13zm4 20l-2.5-1.68L16 22l-2.5-1.68L11 22l-2.5-1.68L6 22V6h15zM10 10v2h7v-2zm5 4h-5v2h5z" />
                                        </svg>
                                    </span>
                                    <span>Orders History</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="pl-[320px]">
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