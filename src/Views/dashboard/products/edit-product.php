<?php

use App\Config\Database;
use App\Helpers\Flash;
use App\Helpers\Security;
use App\Layouts\DashboardLayout;

function pageEditProduct($id)
{
    $connect = Database::connect();
    $product_cmd = "SELECT * FROM products where id = $id";
    $product_query = mysqli_query($connect, $product_cmd);
    $product = mysqli_fetch_assoc($product_query);

    $flash = Flash::get();
    ob_start(); ?>
    <div class="flex flex-col items-center justify-center h-full">
        <div class="bg-slate-100 rounded-2xl shadow p-4">
            <h2 class="font-bold text-3xl text-center">UPDATE PRODUCT</h2>
            <?php if ($flash): ?>
                <div id="message"
                    class="p-2 mb-2 rounded text-center font-semibold
                            <?= $flash['type'] === 'success' ? 'bg-emerald-200 text-emerald-800' : 'bg-red-200 text-red-800' ?>">
                    <?= htmlspecialchars($flash['message']) ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="/dashboard/product/<?= $id ?>/edit" class="flex flex-col gap-2 w-[350px] p-4" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::generateCsrfToken()) ?>">
                <img src="<?= $product['photo'] ?>" alt="<?= $product["name"] ?>" class="w-[200px] h-[150px]">
                <label for=" name" class="flex flex-col">
                    <span>Name <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="name" value="<?= $product["name"] ?>" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="Product Name" autocomplete="off">
                </label>
                <label for="category_id" class="flex flex-col">
                    <span>Product Category<span class="text-red-500 text-sm">*</span></span>
                    <select name="category_id" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="1" <?= $product['category_id'] == 1 ? "selected" : "" ?>>Makanan</option>
                        <option value="2" <?= $product['category_id'] == 2 ? "selected" : "" ?>>Minuman</option>
                    </select>
                </label>
                <label for="price" class="flex flex-col">
                    <span>Price <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="price" value="<?= $product["price"] ?>" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="00.00" autocomplete="off">
                </label>
                <label for="description" class="flex flex-col">
                    <span>Description <span class="text-slate-500 text-sm italic">(optional)</span></span>
                    <input type="description" name="description" value="<?= $product["description"] ?>" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="Description of Product" autocomplete="off">
                </label>

                <button type="submit" class="py-2 bg-blue-400 mt-3 text-emerald-100 font-bold">Update Produk</button>
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
<?php echo DashboardLayout::render(ob_get_clean());;
} ?>