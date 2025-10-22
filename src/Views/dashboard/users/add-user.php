<?php

use App\Config\Database;
use App\Helpers\Security;
use App\Layouts\DashboardLayout;
use App\Helpers\Flash;


function pageAddUser()
{
    $connect = Database::connect();
    $roles_cmd = "SELECT id, name FROM roles WHERE deleted_at IS NULL";
    $roles_query = mysqli_query($connect, $roles_cmd);
    $roles_fetch = mysqli_fetch_all($roles_query, MYSQLI_ASSOC);

    $flash = Flash::get();
    ob_start(); ?>
    <div class="flex flex-col items-center justify-center h-full">
        <div class="bg-slate-100 rounded-2xl shadow p-4">
            <h2 class="font-bold text-3xl text-center">ADD USER</h2>
            <?php if ($flash): ?>
                <div id="message"
                    class="p-2 mb-2 rounded text-center font-semibold
                            <?= $flash['type'] === 'success' ? 'bg-emerald-200 text-emerald-800' : 'bg-red-200 text-red-800' ?>">
                    <?= htmlspecialchars($flash['message']) ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="/dashboard/users" class="flex flex-col gap-2 w-[350px] p-4">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::generateCsrfToken()) ?>">
                <label for="username" class="flex flex-col">
                    <span>Name <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="name" value="" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="Your Name" autocomplete="off">
                </label>
                <label for="role_id" class="flex flex-col">
                    <span>Role User <span class="text-red-500 text-sm">*</span></span>
                    <select name="role_id" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0">
                        <option value="" class="italic" selected>-- Pilih Role --</option>
                        <?php foreach ($roles_fetch as $role): ?>
                            <option value="<?= $role["id"] ?>" class="capitalize"><?= $role["name"] ?></option>
                        <?php endforeach ?>
                    </select>
                </label>
                <label for="email" class="flex flex-col">
                    <span>Email <span class="text-red-500 text-sm">*</span></span>
                    <input type="email" name="email" value=""
                        class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0" placeholder="Your Email"
                        autocomplete="off">
                </label>
                <label for="password" class="flex flex-col">
                    <span>Password <span class="text-red-500 text-sm">*</span></span>
                    <input type="password" name="password" value=""
                        class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0" placeholder="Your Password"
                        autocomplete="off">
                </label>

                <button type="submit" class="py-2 bg-emerald-400 mt-3 text-emerald-100 font-bold">Tambah User</button>
            </form>
        </div>
    </div>

    <script>
        const getMessage = document.querySelector('#message');

        if (getMessage) {
            setTimeout(() => {
                getMessage.remove();

            }, 2000);

            setTimeout(() => {
                getMessage.remove();
                window.location.href = '/dashboard/users'
            }, 2500);
        }
    </script>
    <?php echo DashboardLayout::render(ob_get_clean());
} ?>