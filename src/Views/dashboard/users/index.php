<?php

use App\Layouts\DashboardLayout;
use App\Config\Database;
use App\Helpers\Flash;
use App\Helpers\Security;

function pageIndex()
{
    $connec = Database::connect();
    $users_cmd = "SELECT users.user_id, users.user_name, roles.role_name, users.role_id, users.user_email, users.created_at 
                  FROM users JOIN roles ON users.role_id = roles.role_id 
                  WHERE users.deleted_at IS NULL;";

    $users_query = mysqli_query($connec, $users_cmd);

    $users_fetch = mysqli_fetch_all($users_query, MYSQLI_ASSOC);

    $flash = Flash::get();

    ob_start();
?>

    <div>

        <?php if ($flash): ?>
            <div id="message"
                class="p-2 mb-2 rounded text-center font-semibold
                            <?= $flash['type'] === 'success' ? 'bg-emerald-200 text-emerald-800' : 'bg-red-200 text-red-800' ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="w-fit mx-auto">
            <!-- SEARCH & ADD USER -->
            <div class="flex items-center justify-between my-5 h-10">
                <label for="search" class="flex items-center gap-2 p-2 rounded bg-neutral-100 w-fit h-full">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="#888888"
                                d="M9.5 3A6.5 6.5 0 0 1 16 9.5c0 1.61-.59 3.09-1.56 4.23l.27.27h.79l5 5l-1.5 1.5l-5-5v-.79l-.27-.27A6.52 6.52 0 0 1 9.5 16A6.5 6.5 0 0 1 3 9.5A6.5 6.5 0 0 1 9.5 3m0 2C7 5 5 7 5 9.5S7 14 9.5 14S14 12 14 9.5S12 5 9.5 5" />
                        </svg>
                    </span>
                    <input type="text" placeholder="Search User" class="placeholder:text-neutral-500 border-0 outline-0">
                </label>
                <a href="/dashboard/user/add"
                    class="flex items-center h-full px-5 rounded bg-emerald-300 text-white shadow font-bold">
                    ADD USER
                </a>
            </div>

            <!-- TABLE -->
            <div class="bg-neutral-100 rounded shadow max-h-[calc(100dvh-11.5rem)]">
                <table class="p-2 text-left">
                    <tr class="[&_th]:pb-4 [&_th]:pt-2 [&_th]:px-4">
                        <th class="">Row</th>
                        <th class="">Name</th>
                        <th class="">Email</th>
                        <th class="text-center ">Role</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php foreach ($users_fetch as $key => $user): ?>

                        <tr class="[&_td]:py-2 [&_td]:px-4 hover:bg-neutral-200/70">
                            <td><?= $key + 1 ?></td>
                            <td class="uppercase"><?= $user["user_name"] ?></td>
                            <td><?= $user["user_email"] ?></td>
                            <td>
                                <?php
                                if ($user['role_id'] == 1) {
                                    $bgcl = 'bg-blue-100 text-blue-700 shadow shadow-blue-700';
                                } else if ($user['role_id'] == 2) {
                                    $bgcl = 'bg-red-100 text-red-700 shadow shadow-red-700';
                                } else {
                                    $bgcl = 'bg-yellow-100 text-yellow-700 shadow shadow-yellow-700';
                                } ?>
                                <p class="<?= $bgcl ?> py-1 px-3 rounded-full text-center"><?= $user["role_name"] ?></p>
                            </td>
                            <td class="flex gap-3 items-center justify-center">
                                <form method="POST" action="/dashboard/user/<?= $user['user_id'] ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::generateCsrfToken()) ?>">
                                    <button class="bg-neutral-300 py-2 px-4 rounded">
                                        <i class="bi bi-eraser-fill text-red-800"></i>
                                    </button>
                                </form>
                                <a href="/dashboard/user/<?= $user['user_id'] ?>/edit" class="bg-neutral-300 py-2 px-4 rounded">
                                    <i class="bi bi-vector-pen text-blue-800"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        const getMessage = document.querySelector('#message');

        if (getMessage) {
            setTimeout(() => {
                getMessage.remove();

            }, 2000);
        }
    </script>
<?php echo DashboardLayout::render(ob_get_clean());
} ?>