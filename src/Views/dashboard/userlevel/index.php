<?php

use App\Config\Database;
use App\Helpers\Flash;
use App\Helpers\Security;
use App\Layouts\DashboardLayout;

function PageIndex(?int $id = null)
{
    $connec = Database::connect();

    $roles_cmd = "SELECT role_id, role_name
                  FROM roles 
                  WHERE deleted_at IS NULL;";

    $roles_query = mysqli_query($connec, $roles_cmd);

    $roles_fetch = mysqli_fetch_all($roles_query, MYSQLI_ASSOC);

    if ($id) {
        $get_role_cmd = "SELECT role_id, role_name FROM roles WHERE role_id = $id";
        $get_role_query = mysqli_query($connec, $get_role_cmd);
        $get_role_assoc = mysqli_fetch_assoc($get_role_query);
    }

    $flash = Flash::get();

    ob_start(); ?>
    <div>
        <?php if ($flash): ?>
            <div id="message"
                class="p-2 mb-2 rounded text-center font-semibold
                            <?= $flash['type'] === 'success' ? 'bg-emerald-200 text-emerald-800' : 'bg-red-200 text-red-800' ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="w-fit mx-auto">
            <!-- SEARCH & ADD USERLEVEL -->
            <div class="gap-4 my-5 h-10">
                <form action="<?= $id ? "/dashboard/roles/$id/edit" : "/dashboard/roles" ?>" method="POST" class="h-full flex gap-3">
                    <input type="hidden" name="csrf_token" value="<?= Security::generateCsrfToken() ?>">
                    <?php
                    if ($id) {
                        echo "<input type='hidden' name='_method' value='PUT'>";
                    }
                    ?>
                    <label for="role_name" class="flex items-center gap-2 p-2 rounded bg-neutral-100 w-full h-full">
                        <input type="text" name="role_name" value="<?= $get_role_assoc['role_name'] ?? "" ?>" placeholder="User Level Name" class="placeholder:text-neutral-500 border-0 outline-0 w-full">
                    </label>
                    <button class="flex items-center text-nowrap text-sm h-full px-5 rounded bg-emerald-300 text-white shadow font-bold"><?= $id ? "EDIT" : "ADD" ?> LEVEL</button>
                </form>
            </div>

            <!-- TABLE -->
            <div class="bg-neutral-100 rounded shadow max-h-[calc(100dvh-11.5rem)]">
                <table class="p-2 text-left">
                    <tr class="[&_th]:pb-4 [&_th]:pt-2 [&_th]:px-4">
                        <th class="">Row</th>
                        <th class="">Name</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php foreach ($roles_fetch as $key => $role): ?>

                        <tr class="[&_td]:py-2 [&_td]:px-4 hover:bg-neutral-200/70">
                            <td><?= $key + 1 ?></td>
                            <td>
                                <?php
                                if ($role['role_id'] == 1) {
                                    $bgcl = 'bg-blue-100 text-blue-700 shadow shadow-blue-700';
                                } else if ($role['role_id'] == 2) {
                                    $bgcl = 'bg-red-100 text-red-700 shadow shadow-red-700';
                                } else {
                                    $bgcl = 'bg-yellow-100 text-yellow-700 shadow shadow-yellow-700';
                                } ?>
                                <p class="<?= $bgcl ?> py-1 px-3 rounded-full text-center"><?= $role["role_name"] ?></p>
                            </td>
                            <td class="flex gap-3 items-center justify-center">
                                <form method="POST" action="/dashboard/roles/<?= $role['role_id'] ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::generateCsrfToken()) ?>">
                                    <button class="bg-neutral-300 py-2 px-4 rounded">
                                        <i class="bi bi-eraser-fill text-red-800"></i>
                                    </button>
                                </form>
                                <a href="/dashboard/roles/<?= $role['role_id'] ?>/edit" class="bg-neutral-300 py-2 px-4 rounded">
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
        if (getMessage) {
            setTimeout(() => {
                getMessage.remove();

            }, 2000);
        }
    </script>
<?php echo DashboardLayout::render(ob_get_clean());
} ?>