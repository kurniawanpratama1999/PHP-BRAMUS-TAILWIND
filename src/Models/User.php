<?php

namespace App\Models;

use App\Config\Database;

class User
{


    public static function create(array $data)
    {
        $conn = Database::connect();

        $stmt = mysqli_prepare($conn, "INSERT INTO users (user_name, role_id, user_email, user_password) VALUES (?, ?, ?, ?)");

        $success = false;

        if ($stmt) {
            $user_name = $data['user_name'];
            $role_id = $data['role_id'];
            $user_email = $data['user_email'];
            $user_password = $data['user_password'];

            mysqli_stmt_bind_param($stmt, 'siss', $user_name, $role_id, $user_email, $user_password);
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

        $stmt = mysqli_prepare($conn, "UPDATE users SET user_name = ?, role_id = ?, user_email = ? WHERE user_id = $id");

        if ($data['user_password']) {
            $stmt = mysqli_prepare($conn, "UPDATE users SET user_name = ?, role_id = ?, user_email = ?, user_password = ? WHERE user_id = $id");
        }

        if ($stmt) {
            $user_name = $data['user_name'];
            $role_id = $data['role_id'];    
            $user_email = $data['user_email'];

            if ($data['user_password']) {
                $user_password = $data['user_password'];
                mysqli_stmt_bind_param($stmt, 'siss', $user_name, $role_id, $user_email, $user_password);
            } else {
                mysqli_stmt_bind_param($stmt, 'sis', $user_name, $role_id, $user_email);
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

        $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE user_id = ?");

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
