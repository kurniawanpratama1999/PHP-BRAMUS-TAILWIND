<?php
use App\Layouts\DashboardLayout;
use App\Config\Database;
function pageIndex()
{
    $connec = Database::connect();
    $users_cmd = "SELECT name, role_id, email FROM users";
    $users_query = mysqli_query($connec, $users_cmd);
    $users_fetch = mysqli_fetch_all($users_query, MYSQLI_ASSOC);

    ob_start();
    ?>

    <div class="p-5">
        <div class="text-center mb-5">
            <h2 class="font-bold text-5xl">VIEW ALL USER</h2>
        </div>
        <a href="/dashboard/user/add"
            class="py-2 px-5 fixed bottom-5 right-5 rounded bg-emerald-300 text-white shadow font-bold">Add
            User</a>
        <table
            class="border border-slate-400 w-full [&_th]:p-2 [&_th]:border [&_th]:border-slate-400 [&_td]:p-2 [&_td]:border [&_td]:border-slate-400">
            <tr class="text-left bg-amber-300 font-semibold">
                <th class="w-[70px]">No</th>
                <th class="">Name</th>
                <th class="">Email</th>
                <th class="w-[200px]">Role</th>
                <th class="w-[100px]">Actions</th>
            </tr>
            <?php if (count($users_fetch) < 1): ?>
                <tr>
                    <td colspan="5" class="text-center">Masih kosong, silahkan tambah user</td>
                </tr>
            <?php endif ?>
            <?php foreach ($users_fetch as $key => $user): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role_id'] ?></td>
                    <td class="flex items-center justify-center gap-3 border-none">
                        <a href="" class="p-1 rounded bg-red-200 text-white">❌</a>
                        <a href="" class="p-1 rounded bg-indigo-200 text-white">🖊</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <?php echo DashboardLayout::render(ob_get_clean());
} ?>