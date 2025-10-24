<?php

use App\Layouts\DefaultLayout;

ob_start();
?>
<main class="h-dvh flex flex-col items-center justify-center gap-y-2 bg-neutral-200">
    <h1 class="text-3xl font-bold text-emerald-500">Point Of Sales 2025</h1>

    <form method="post" class="self_form">
        <label for="username" class="flex flex-col">
            <span>Username :</span>
            <input type="text" name="username" class="self_input" placeholder="Your Username" autocomplete="none">
        </label>

        <label for="password" class="flex flex-col">
            <span>Password :</span>
            <input type="password" name="password" class="self_input" placeholder="Your Password" autocomplete="none">
        </label>

        <button class="btn_login">Login</button>
    </form>
    <div>
        <p class="text-xl font-bold text-emerald-500">Design By Kurniawan Pratama</p>
        <p class="font-bold text-blue-400">Tools : PHP, Bramus, Tailwind, Mysql</p>
    </div>
</main>
<?php echo DefaultLayout::render(ob_get_clean()); ?>