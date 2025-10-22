<?php

namespace App\Models;

use App\Config\Database;

class User
{


    public static function create(array $data)
    {
        $conn = Database::connect();

        $stmt = mysqli_prepare($conn, "INSERT INTO users (name, role_id, email, password) VALUES (?, ?, ?, ?)");

        $success = false;

        if ($stmt) {
            $name = $data['name'];
            $role_id = $data['role_id'];
            $email = $data['email'];
            $password = $data['password'];

            mysqli_stmt_bind_param($stmt, 'siss', $name, $role_id, $email, $password);
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

        $success = false;

        $stmt = mysqli_prepare($conn, "UPDATE users SET name = ?, role_id = ?, email = ? WHERE id = $id");

        if ($data['password']) {
            $stmt = mysqli_prepare($conn, "UPDATE users SET name = ?, role_id = ?, email = ?, password = ? WHERE id = $id");
        }

        if ($stmt) {
            $name = $data['name'];
            $role_id = $data['role_id'];
            $email = $data['email'];

            if ($data['password']) {
                $password = $data['password'];
                mysqli_stmt_bind_param($stmt, 'siss', $name, $role_id, $email, $password);
            } else {
                mysqli_stmt_bind_param($stmt, 'sis', $name, $role_id, $email);
            }

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

        $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");

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
