<?php

use App\Config\Database;
use App\Helpers\Security;
use App\Layouts\DashboardLayout;
use App\Helpers\Flash;


function pageAddProduct()
{
    $connect = Database::connect();
    $categories_cmd = "SELECT product_category_id, product_category_name FROM product_categories WHERE deleted_at IS NULL";
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
            <form method="POST" action="/dashboard/products" class="flex flex-col gap-2 w-[350px] p-4" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::generateCsrfToken()) ?>">

                <label for="product_photo" class="relative h-[150px] bg-neutral-400 flex items-center justify-center shadow rounded overflow-hidden">
                    <img id="image_preview" class="hidden h-full w-full object-cover">
                    <span id="dumy_image" class="block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                            <path fill="#ddd" d="M4 4h3l2-2h6l2 2h3a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2m8 3a5 5 0 0 0-5 5a5 5 0 0 0 5 5a5 5 0 0 0 5-5a5 5 0 0 0-5-5m0 2a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3" />
                        </svg>
                    </span>
                    <input type="file" name="product_photo" class="cursor-pointer opacity-0 absolute top-0 left-0 right-0 bottom-0" id="image_input" accept="image/*" required>
                </label>
                <label for="product_name" class="flex flex-col">
                    <span>Name <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="product_name" value="" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="Product Name" autocomplete="off">
                </label>

                <label for="product_category_id" class="flex flex-col">
                    <span>Category Product <span class="text-red-500 text-sm">*</span></span>
                    <select name="product_category_id" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0">
                        <option value="" class="italic" selected>-- Pilih Kategori --</option>
                        <?php foreach ($categories_fetch as $category): ?>
                            <option value="<?= $category["product_category_id"] ?>" class="capitalize"><?= $category["product_category_name"] ?></option>
                        <?php endforeach ?>
                    </select>
                </label>

                <label for="product_price" class="flex flex-col">
                    <span>Price <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="product_price" value="" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="00.00" autocomplete="off">
                </label>

                <label for="product_description" class="flex flex-col">
                    <span>Description <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="product_description" value="" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
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

        const getImageInput = document.querySelector("#image_input");

        getImageInput.addEventListener("change", (e) => {
            const [file] = e.target.files;

            if (file) {
                const image_preview = document.querySelector('#image_preview');
                const dumy_image = document.querySelector('#dumy_image');
                image_preview.src = URL.createObjectURL(file);
                dumy_image.classList.replace('block', 'hidden')
                image_preview.classList.replace('hidden', 'block')

            }
        })
    </script>
<?php echo DashboardLayout::render(ob_get_clean());
} ?>