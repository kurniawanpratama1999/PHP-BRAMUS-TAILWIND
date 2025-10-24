<?php

namespace App\Models;

use App\Config\Database;

class Role
{


    public static function create(array $data)
    {
        $conn = Database::connect();

        $stmt = mysqli_prepare($conn, "INSERT INTO roles (role_name) VALUES (?)");

        $success = false;

        if ($stmt) {
            $role_name = $data['role_name'];

            mysqli_stmt_bind_param($stmt, 's', $role_name);
            mysqli_stmt_execute($stmt);

            $success = mysqli_stmt_affected_rows($stmt) > 0;

            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);
        return $success;
    }

    public static function update($id, $data)
    {
        $conn = Database::connect();

        $stmt = mysqli_prepare($conn, "UPDATE roles SET role_name = ? WHERE role_id = $id");

        $success = false;

        if ($stmt) {
            $role_name = $data['role_name'];

            mysqli_stmt_bind_param($stmt, 's', $role_name);
            mysqli_stmt_execute($stmt);

            $success = mysqli_stmt_affected_rows($stmt) > 0;

            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);
        return $success;
    }

    public static function destroy($id)
    {
        $conn = Database::connect();

        $success = false;

        $stmt = mysqli_prepare($conn, "DELETE FROM roles WHERE role_id = ?");

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $id);

            if (mysqli_stmt_execute($stmt)) {
                $success = true;
            }

            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
        return $success;
    }
}
