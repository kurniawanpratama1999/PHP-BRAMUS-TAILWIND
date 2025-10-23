<?php

namespace App\Controllers;

use App\Helpers\Flash;
use App\Helpers\Security;
use App\Models\{User, Product};

class ProductsController
{
    public function index()
    {
        require_once __DIR__ . '/../Views/dashboard/products/index.php';
        pageIndex();
    }

    public function add()
    {
        require_once __DIR__ . '/../Views/dashboard/products/add-product.php';
        pageAddProduct();
    }

    public function edit($id)
    {
        require_once __DIR__ . '/../Views/dashboard/products/edit-product.php';
        pageEditProduct($id);
    }

    public function create()
    {
        session_start();
        Security::checkCsrf();

        $product_name = $_POST['product_name'] ?? null;
        $product_category_id = $_POST['product_category_id'] ?? null;
        $product_price = $_POST['product_price'] ?? null;
        $product_description = $_POST['product_description'] ?? null;
        $product_photo = $_FILES["product_photo"] ?? null;

        if ($product_name && $product_category_id && $product_price && $product_description && $product_photo) {
            $result = Product::create([
                'product_name' => $product_name,
                'product_category_id' => $product_category_id,
                'product_price' => $product_price,
                'product_description' => $product_description,
                'product_photo' => $product_photo,
            ]);

            if ($result) {
                Flash::set('success', 'Produk berhasil ditambahkan!');
            } else {
                Flash::set('error', 'Gagal menambahkan produk. Coba lagi.');
            }
        } else {
            Flash::set('error', 'Semua field wajib diisi.');
        }

        header("Location:/dashboard/product/add");
        exit;
    }

    public function update($id)
    {
        session_start();
        Security::checkCsrf();

        $product_name = $_POST['product_name'] ?? null;
        $product_category_id = $_POST['product_category_id'] ?? null;
        $product_price = $_POST['product_price'] ?? null;
        $product_description = $_POST['product_description'] ?? null;
        $product_photo = $_FILES["product_photo"] ?? null;

        if ($product_name && $product_category_id && $product_price && $product_description) {
            $result = Product::update($id, [
                'product_name' => $product_name,
                'product_category_id' => $product_category_id,
                'product_price' => $product_price,
                'product_description' => $product_description,
                'product_photo' => $product_photo,
            ]);

            if ($result) {
                Flash::set('success', 'Produk berhasil di update!');
            } else {
                Flash::set('error', 'Gagal mengupdate produk. Coba lagi.');
            }
        } else {
            Flash::set('error', 'Semua field wajib diisi.');
        }

        header("Location:/dashboard/product/$id/edit");
        exit;
    }

    public function destroy($id)
    {
        session_start();
        Security::checkCsrf();

        $result = Product::destroy($id);

        if ($result) {
            Flash::set('success', 'Produk berhasil dihapus!');
        } else {
            Flash::set('error', 'Gagal menghapus Produk. Coba lagi.');
        }
        header('Location: /dashboard/products');
        exit;
    }
}
