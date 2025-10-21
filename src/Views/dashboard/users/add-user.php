<?php

use App\Helpers\Security;
use App\Layouts\DashboardLayout;

function pageAddUser()
{
    ob_start(); ?>
    <div class="flex flex-col items-center justify-center h-full">
        <div class="bg-slate-100 rounded-2xl shadow p-4">
            <h2 class="font-bold text-3xl text-center">ADD USER</h2>
            <form method="POST" action="/dashboard/users" class="flex flex-col gap-2 w-[350px] p-4">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::generateCsrfToken()) ?>">
                <label for="username" class="flex flex-col">
                    <span>Name <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="name" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="Your Name" autocomplete="none">
                </label>
                <label for="role_id" class="flex flex-col">
                    <span>Role User <span class="text-red-500 text-sm">*</span></span>
                    <select name="role_id" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0">
                        <option value="">-- Pilih Role --</option>
                        <option value="1">Administrator</option>
                        <option value="2">Admin</option>
                        <option value="3">Operator</option>
                    </select>
                </label>
                <label for="email" class="flex flex-col">
                    <span>Email <span class="text-red-500 text-sm">*</span></span>
                    <input type="email" name="email" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="Your Email" autocomplete="none">
                </label>
                <label for="password" class="flex flex-col">
                    <span>Password <span class="text-red-500 text-sm">*</span></span>
                    <input type="password" name="password" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="Your Password" autocomplete="none">
                </label>

                <button type="submit" class="py-2 bg-emerald-400 mt-3 text-emerald-100 font-bold">Tambah User</button>
            </form>
        </div>
    </div>
    <?php echo DashboardLayout::render(ob_get_clean());
} ?>