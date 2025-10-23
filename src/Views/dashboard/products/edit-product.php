<?php

use App\Config\Database;
use App\Helpers\Flash;
use App\Helpers\Security;
use App\Layouts\DashboardLayout;

function pageEditProduct($id)
{
    $connect = Database::connect();
    $product_cmd = "SELECT * FROM products where product_id = $id";
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

                <label for="product_photo" class="relative h-[150px] bg-neutral-400 flex items-center justify-center shadow rounded overflow-hidden">
                    <img id="image_preview" src="<?= $product["product_photo"] ?? "" ?>" class="<?= file_exists($_SERVER["DOCUMENT_ROOT"] . $product["product_photo"]) ? "block" : "hidden" ?> h-full w-full object-cover">
                    <span id="dumy_image" class="<?= file_exists($_SERVER["DOCUMENT_ROOT"] . $product["product_photo"]) ? "hidden" : "block" ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                            <path fill="#ddd" d="M4 4h3l2-2h6l2 2h3a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2m8 3a5 5 0 0 0-5 5a5 5 0 0 0 5 5a5 5 0 0 0 5-5a5 5 0 0 0-5-5m0 2a3 3 0 0 1 3 3a3 3 0 0 1-3 3a3 3 0 0 1-3-3a3 3 0 0 1 3-3" />
                        </svg>
                    </span>
                    <input type="file" name="product_photo" class="cursor-pointer opacity-0 absolute top-0 left-0 right-0 bottom-0" id="image_input" accept="image/*">
                </label>

                <label for="product_name" class="flex flex-col">
                    <span>Name <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="product_name" value="<?= $product["product_name"] ?>" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="Product Name" autocomplete="off">
                </label>

                <label for="category_id" class="flex flex-col">
                    <span>Product Category<span class="text-red-500 text-sm">*</span></span>
                    <select name="category_id" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="1" <?= $product['product_category_id'] == 1 ? "selected" : "" ?>>Makanan</option>
                        <option value="2" <?= $product['product_category_id'] == 2 ? "selected" : "" ?>>Minuman</option>
                    </select>
                </label>

                <label for="product_price" class="flex flex-col">
                    <span>Price <span class="text-red-500 text-sm">*</span></span>
                    <input type="text" name="product_price" value="<?= $product["product_price"] ?>" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
                        placeholder="00.00" autocomplete="off">
                </label>
                <label for="product_description" class="flex flex-col">
                    <span>Description <span class="text-slate-500 text-sm italic">(optional)</span></span>
                    <input type="text" name="product_description" value="<?= $product["product_description"] ?>" class="border border-slate-300 py-2 px-4 bg-slate-100 outline-0"
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
<?php echo DashboardLayout::render(ob_get_clean());;
} ?>