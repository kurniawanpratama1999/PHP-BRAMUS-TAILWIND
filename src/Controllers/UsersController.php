<?php
namespace App\Controllers;
use App\Helpers\Flash;
use App\Helpers\Security;
use App\Models\User;

class UsersController
{
    public function index()
    {
        require_once __DIR__ . '/../Views/dashboard/users/index.php';
        pageIndex();
    }

    public function add()
    {
        require_once __DIR__ . '/../Views/dashboard/users/add-user.php';
        pageAddUser();
    }

    public function edit($id)
    {
        require_once __DIR__ . '/../Views/dashboard/users/edit-user.php';
        pageEditUser($id);
    }

    public function create()
    {
        session_start();
        Security::checkCsrf();

        $name = $_POST['name'] ?? null;
        $role_id = $_POST['role_id'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if ($name && $role_id && $email && $password) {
            $result = User::create([
                'name' => $name,
                'role_id' => $role_id,
                'email' => $email,
                'password' => $password,
            ]);

            if ($result) {
                Flash::set('success', 'User berhasil ditambahkan!');
            } else {
                Flash::set('error', 'Gagal menambahkan user. Coba lagi.');
            }
        } else {
            Flash::set('error', 'Semua field wajib diisi.');
        }

        header("Location:/dashboard/users/add");
        exit;
    }

    public function update($id)
    {
        session_start();
        Security::checkCsrf();

        // Update data kategori berdasarkan ID
        // Category::update($id, $_POST['name'] ?? '...');
        header('Location: /category');
        exit;
    }

    public function destroy($id)
    {
        session_start();
        Security::checkCsrf();

        // Hapus data kategori berdasarkan ID
        // Category::delete($id);
        header('Location: /category');
        exit;
    }
}
