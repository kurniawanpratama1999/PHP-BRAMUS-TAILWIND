<?php ob_start(); ?>
<main class="h-dvh flex flex-col items-center justify-center gap-y-2 bg-neutral-200">
    <h1 class="text-3xl font-bold text-emerald-500">Point Of Sales 2025</h1>
    <form method="post" class="flex flex-col gap-2 w-[350px] bg-slate-100 rounded-2xl shadow p-4">
        <label for="username" class="flex flex-col">
            <span>Username :</span>
            <input type="text" name="username" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0" placeholder="Your Username" autocomplete="none">
        </label>
        <label for="password" class="flex flex-col">
            <span>Password :</span>
            <input type="password" name="password" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0" placeholder="Your Password" autocomplete="none">
        </label>

        <button class="py-2 bg-emerald-400 mt-3 text-emerald-100 font-bold">Login</button>
    </form>
    <div>
        <p class="text-xl font-bold text-emerald-500">Design By Kurniawan Pratama</p>
        <p class="font-bold text-blue-400">Tools : PHP, Bramus, Tailwind, Mysql</p>
    </div>
</main>
<?php return ob_get_clean(); ?>