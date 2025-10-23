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

        $user_name = $_POST['user_name'] ?? null;
        $role_id = $_POST['role_id'] ?? null;
        $user_email = $_POST['user_email'] ?? null;
        $user_password = $_POST['user_password'] ?? null;

        if ($user_name && $role_id && $user_email && $user_password) {
            $result = User::create([
                'user_name' => $user_name,
                'role_id' => $role_id,
                'user_email' => $user_email,
                'user_password' => $user_password,
            ]);

            if ($result) {
                Flash::set('success', 'User berhasil ditambahkan!');
            } else {
                Flash::set('error', 'Gagal menambahkan user. Coba lagi.');
            }
        } else {
            Flash::set('error', 'Semua field wajib diisi.');
        }

        header("Location:/dashboard/user/add");
        exit;
    }

    public function update($id)
    {
        session_start();
        Security::checkCsrf();

        $user_name = $_POST['user_name'] ?? null;
        $role_id = $_POST['role_id'] ?? null;
        $user_email = $_POST['user_email'] ?? null;
        $user_password = empty($_POST['user_password']) ?? null;

        if ($user_name && $role_id && $user_email) {
            $result = User::update($id, [
                'user_name' => $user_name,
                'role_id' => $role_id,
                'user_email' => $user_email,
                'user_password' => $user_password,
            ]);

            if ($result) {
                Flash::set('success', 'User berhasil diubah!');
            } else {
                Flash::set('error', 'Gagal update user. Coba lagi.');
            }
        } else {
            Flash::set('error', 'Semua field wajib diisi.');
        }

        header("Location:/dashboard/user/$id/edit");
        exit;
    }

    public function destroy($id)
    {
        session_start();
        Security::checkCsrf();

        $result = User::destroy($id);

        if ($result) {
            Flash::set('success', 'User berhasil dihapus!');
        } else {
            Flash::set('error', 'Gagal menghapus user. Coba lagi.');
        }
        header('Location: /dashboard/users');
        exit;
    }
}
