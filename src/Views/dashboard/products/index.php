<?php

use App\Layouts\DashboardLayout;
use App\Config\Database;
use App\Helpers\Flash;
use App\Helpers\Security;

function pageIndex()
{
    $connec = Database::connect();
    $products_cmd = "SELECT id, category_id, name, photo, price, description FROM products WHERE deleted_at IS NULL";

    $products_query = mysqli_query($connec, $products_cmd);

    $products_fetch = mysqli_fetch_all($products_query, MYSQLI_ASSOC);

    $flash = Flash::get();

    ob_start();
?>

    <div class="p-5">
        <div class="text-center mb-5">
            <h2 class="font-bold text-5xl">VIEW ALL PRODUCT</h2>
        </div>
        <a href="/dashboard/product/add"
            class="py-2 px-5 fixed bottom-5 right-5 rounded bg-emerald-300 text-white shadow font-bold">Add
            Product</a>
        <?php if ($flash): ?>
            <div id="message"
                class="p-2 mb-2 rounded text-center font-semibold
                            <?= $flash['type'] === 'success' ? 'bg-emerald-200 text-emerald-800' : 'bg-red-200 text-red-800' ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>
        <table
            class="border border-slate-400 w-full [&_th]:p-2 [&_th]:border [&_th]:border-slate-400 [&_td]:p-2 [&_td]:border [&_td]:border-slate-400">
            <tr class="text-left bg-amber-300 font-semibold">
                <th class="w-[70px]">No</th>
                <th class="">Name</th>
                <th class="">Category</th>
                <th class="">Price</th>
                <th class="">Desciption</th>
                <th class="">Photo</th>
                <th class="w-[100px]">Actions</th>
            </tr>
            <?php if (count($products_fetch) < 1): ?>
                <tr>
                    <td colspan="7" class="text-center">Masih kosong, silahkan tambah produk</td>
                </tr>
            <?php endif ?>
            <?php foreach ($products_fetch as $key => $product): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['category_id'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td><?= $product['description'] ?></td>
                    <td><?= $product['photo'] ?></td>
                    <td class="flex items-center justify-center gap-3 border-none">
                        <form action="/dashboard/product/<?= $product['id'] ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::generateCsrfToken()) ?>">
                            <button type="submit" class="p-1 rounded bg-red-200 text-white">❌</button>
                        </form>
                        <a href="/dashboard/product/<?= $product['id'] ?>/edit" class="p-1 rounded bg-indigo-200 text-white">🖊</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
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