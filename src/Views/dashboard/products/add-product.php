<?php

use App\Config\Database;
use App\Helpers\Security;
use App\Layouts\DashboardLayout;
use App\Helpers\Flash;


function pageAddProduct()
{
    $connect = Database::connect();
    $categories_cmd = "SELECT id, name FROM product_categories WHERE deleted_at IS NULL";
    $categories_query = mysqli_query($connect, $categories_cmd);
    $categories_fetch = mysqli_fetch_all($categories_query, MYSQLI_ASSOC);

    $flash = Flash::get();
    ob_start(); ?>
    <div class="flex flex-col items-center justify-center h-full">
        <div class="bg-slate-100 rounded-2xl shadow p-4">
            <h2 class="font-bold text-3xl text-center">ADD PRODUCT</h2>
            <?php if ($flash): ?>
                <div id="message"
                    class="p-2 mb-2 rounded text-center font-semibold
                            <?= $flash['type'] === 'success' ? 'bg-emerald-200 text-emerald-800' : 'bg-red-200 text-red-800' ?>">
                    <?= htmlspecialchars($flash['message']) ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="/dashboard/products" class="flex flex-col gap-2 w-[350px] p-4">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::generateCsrfToken()) ?>">

                <label for="name" class="flex flex-col">
                    <span>Name <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="name" value="" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="Product Name" autocomplete="off">
                </label>

                <label for="category_id" class="flex flex-col">
                    <span>Category Product <span class="text-red-500 text-sm">*</span></span>
                    <select name="category_id" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0">
                        <option value="" class="italic" selected>-- Pilih Kategori --</option>
                        <?php foreach ($categories_fetch as $category): ?>
                            <option value="<?= $category["id"] ?>" class="capitalize"><?= $category["name"] ?></option>
                        <?php endforeach ?>
                    </select>
                </label>

                <label for="price" class="flex flex-col">
                    <span>Price <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="price" value="" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="00.00" autocomplete="off">
                </label>

                <label for="description" class="flex flex-col">
                    <span>Description <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="description" value="" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="product description" autocomplete="off">
                </label>

                <button type="submit" class="py-2 bg-emerald-400 mt-3 text-emerald-100 font-bold">Tambah Produk</button>
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
                window.location.href = '/dashboard/products'
            }, 2500);
        }
    </script>
<?php echo DashboardLayout::render(ob_get_clean());
} ?>