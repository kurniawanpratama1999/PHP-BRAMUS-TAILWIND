<?php
namespace App\Models;
use App\Config\Database;
class User
{
    public static function create(array $data)
    {
        // Koneksi ke database
        $conn = Database::connect();

        // Gunakan prepared statement agar aman dari SQL Injection
        $stmt = mysqli_prepare($conn, "INSERT INTO users (name, role_id, email, password ) VALUES (?, ?, ?, ?)");

        if ($stmt) {
            $name = $data['name'];
            $role_id = $data['role_id'];
            $email = $data['email'];
            $password = $data['password'];

            mysqli_stmt_bind_param($stmt, 'siss', $name, $role_id, $email, $password);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<script>console.log('Insert User Berhasil')</script>";
            } else {
                echo "<script>console.log('Insert User Gagal')</script>";

            }
            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);

    }
}