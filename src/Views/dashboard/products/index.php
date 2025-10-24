<?php

use App\Layouts\DashboardLayout;
use App\Config\Database;
use App\Helpers\Flash;
use App\Helpers\Security;

function pageIndex()
{
    $connec = Database::connect();
    $products_cmd = "SELECT p.product_id, pc.product_category_name, p.product_category_id, p.product_name, p.product_photo, p.product_price, p.product_description 
                     FROM products AS p JOIN product_categories AS pc ON p.product_category_id = pc.product_category_id
                     WHERE p.deleted_at IS NULL";

    $products_query = mysqli_query($connec, $products_cmd);

    $products_fetch = mysqli_fetch_all($products_query, MYSQLI_ASSOC);

    $flash = Flash::get();

    ob_start();
?>

    <div class="p-5">
        <?php if ($flash): ?>
            <div id="message"
                class="p-2 mb-2 rounded text-center font-semibold
                            <?= $flash['type'] === 'success' ? 'bg-emerald-200 text-emerald-800' : 'bg-red-200 text-red-800' ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>
        <div class="w-fit mx-auto">

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
                <a href="/dashboard/product/add"
                    class="flex items-center h-full px-5 rounded bg-emerald-300 text-white shadow font-bold">
                    ADD PRODUCT
                </a>
            </div>
            <div class="bg-neutral-100 rounded shadow max-h-[calc(100dvh-11.5rem)]">
                <table
                    class="p-2 text-left">
                    <tr class="[&_th]:pb-4 [&_th]:pt-2 [&_th]:px-4">
                        <th class="w-[70px]">No</th>
                        <th class="">Name</th>
                        <th class="text-center">Category</th>
                        <th class="">Desciption</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Photo</th>
                        <th class="w-[100px] text-center">Actions</th>
                    </tr>
                    <?php if (count($products_fetch) < 1): ?>
                        <tr>
                            <td colspan="7" class="text-center">Masih kosong, silahkan tambah produk</td>
                        </tr>
                    <?php endif ?>
                    <?php foreach ($products_fetch as $key => $product): ?>
                        <tr class="group [&_td]:py-2 [&_td]:px-4 hover:bg-neutral-200/70">
                            <td><?= $key + 1 ?></td>
                            <td class="uppercase"><?= $product['product_name'] ?></td>
                            <td>
                                <?php
                                if ($product['product_category_id'] == 1) {
                                    $bgcl = 'bg-blue-100 text-blue-700 shadow shadow-blue-700';
                                } else if ($product['product_category_id'] == 2) {
                                    $bgcl = 'bg-red-100 text-red-700 shadow shadow-red-700';
                                } else {
                                    $bgcl = 'bg-yellow-100 text-yellow-700 shadow shadow-yellow-700';
                                } ?>
                                <p class="<?= $bgcl ?> py-1 px-3 rounded-full text-center capitalize"><?= $product["product_category_name"] ?></p>
                            </td>
                            <td><?= $product['product_description'] ?></td>
                            <td>
                                <p class="py-1 px-3 rounded-full text-center shadow bg-emerald-200">Rp <?= number_format($product['product_price'], 0, ',', '.') ?></p>
                            </td>
                            <td>
                                <div class="group-hover:hidden w-[100px] text-xs"><?= basename($product['product_photo']) ?></div>
                                <img class="hidden group-hover:block w-[100px] aspect-square object-cover" src="<?= $product['product_photo'] ?>" />
                            </td>
                            <td class="flex items-center group-hover:h-[100px] gap-3">
                                <form class="block" action="/dashboard/product/<?= $product['product_id'] ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::generateCsrfToken()) ?>">
                                    <button type="submit" class="bg-neutral-300 py-2 px-4 rounded">
                                        <i class="bi bi-eraser-fill text-red-800"></i>
                                    </button>
                                </form>
                                <a href="/dashboard/product/<?= $product['product_id'] ?>/edit" class="bg-neutral-300 py-2 px-4 rounded">
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