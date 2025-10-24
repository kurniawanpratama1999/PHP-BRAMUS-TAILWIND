<?php

namespace App\Controllers;

use App\Helpers\Flash;
use App\Helpers\Security;
use App\Models\Role;

class UserLevelController
{
    public function index(?int $id = null)
    {
        require_once __DIR__ . "/../Views/dashboard/userlevel/index.php";
        PageIndex($id);
    }
    public function create()
    {
        session_start();
        Security::checkCsrf();

        $role_name = $_POST['role_name'];

        if ($role_name) {
            $result = Role::create([
                'role_name' => $role_name,
            ]);

            if ($result) {
                Flash::set('success', 'Role berhasil ditambahkan!');
            } else {
                Flash::set('error', 'Gagal menambahkan role. Coba lagi.');
            }
        } else {
            Flash::set('error', 'Semua field wajib di isi!');
        }

        header("Location:/dashboard/roles");
        exit;
    }
    public function update($id)
    {
        session_start();
        Security::checkCsrf();

        $role_name = $_POST['role_name'];

        if ($role_name) {
            $result = Role::update($id, [
                'role_name' => $role_name,
            ]);

            if ($result) {
                Flash::set('success', 'Role berhasil diupdate!');
            } else {
                Flash::set('error', 'Gagal update role. Coba lagi.');
            }
        } else {
            Flash::set('error', 'Semua field wajib di isi!');
        }

        header("Location:/dashboard/roles");
        exit;
    }
    public function delete($id)
    {
        session_start();
        Security::checkCsrf();
        $result = Role::destroy($id);

        if ($result) {
            Flash::set('success', 'Role berhasil dihapus!');
        } else {
            Flash::set('error', 'Gagal menghapus role. Coba lagi.');
        }
        header("Location:/dashboard/roles");
        exit;
    }
}
