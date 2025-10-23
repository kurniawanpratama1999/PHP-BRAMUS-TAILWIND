<?php

use App\Config\Database;
use App\Helpers\Flash;
use App\Helpers\Security;
use App\Layouts\DashboardLayout;

function pageEditUser($id)
{
    $connect = Database::connect();
    $user_cmd = "SELECT user_id, user_name, user_email, role_id FROM users where user_id = $id";
    $user_query = mysqli_query($connect, $user_cmd);
    $user = mysqli_fetch_assoc($user_query);

    $flash = Flash::get();
    ob_start(); ?>
    <div class="flex flex-col items-center justify-center h-full">
        <div class="bg-slate-100 rounded-2xl shadow p-4">
            <h2 class="font-bold text-3xl text-center">UPDATE USER</h2>
            <?php if ($flash): ?>
                <div id="message"
                    class="p-2 mb-2 rounded text-center font-semibold
                            <?= $flash['type'] === 'success' ? 'bg-emerald-200 text-emerald-800' : 'bg-red-200 text-red-800' ?>">
                    <?= htmlspecialchars($flash['message']) ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="/dashboard/user/<?= $id ?>/edit" class="flex flex-col gap-2 w-[350px] p-4">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::generateCsrfToken()) ?>">

                <label for="user_name" class="flex flex-col">
                    <span>Name <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="user_name" value="<?= $user["user_name"] ?>" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="Your Name" autocomplete="off">
                </label>

                <label for="role_id" class="flex flex-col">
                    <span>Role User <span class="text-red-500 text-sm">*</span></span>
                    <select name="role_id" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0">
                        <option value="">-- Pilih Role --</option>
                        <option value="1" <?= $user['role_id'] == 1 ? "selected" : "" ?>>Administrator</option>
                        <option value="2" <?= $user['role_id'] == 2 ? "selected" : "" ?>>Admin</option>
                        <option value="3" <?= $user['role_id'] == 3 ? "selected" : "" ?>>Operator</option>
                    </select>
                </label>

                <label for=user_email" class="flex flex-col">
                    <span>Email <span class="text-red-500 text-sm">*</span></span>
                    <input type="email" name="user_email" value="<?= $user["user_email"] ?>" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="Your Email" autocomplete="off">
                </label>

                <label for="user_password" class="flex flex-col">
                    <span>Password <span class="text-red-500 text-sm">blank for no changes</span></span>
                    <input type="password" name="user_password" value="" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="Your Password" autocomplete="off">
                </label>

                <button type="submit" class="py-2 bg-blue-400 mt-3 text-emerald-100 font-bold">Update User</button>
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
<?php echo DashboardLayout::render(ob_get_clean());;
} ?>