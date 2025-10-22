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

        $name = $_POST['name'] ?? null;
        $category_id = $_POST['category_id'] ?? null;
        $price = $_POST['price'] ?? null;
        $description = $_POST['description'] ?? null;

        echo "$name - $category_id - $price - $description";

        if ($name && $category_id && $price && $description) {
            $result = Product::create([
                'name' => $name,
                'category_id' => $category_id,
                'price' => $price,
                'description' => $description,
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

        $name = $_POST['name'] ?? null;
        $category_id = $_POST['category_id'] ?? null;
        $price = $_POST['price'] ?? null;
        $description = $_POST['description'] ?? null;

        if ($name && $category_id && $price && $description) {
            $result = Product::update($id, [
                'name' => $name,
                'category_id' => $category_id,
                'price' => $price,
                'description' => $description,
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
