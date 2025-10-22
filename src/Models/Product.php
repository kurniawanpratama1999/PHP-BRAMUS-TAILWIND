<?php

namespace App\Models;

use App\Config\Database;

class Product
{


    public static function create(array $data)
    {
        $conn = Database::connect();

        $stmt = mysqli_prepare($conn, "INSERT INTO products (name, category_id, price, description) VALUES (?, ?, ?, ?)");

        $success = false;

        if ($stmt) {
            $name = $data['name'];
            $category_id = $data['category_id'];
            $price = $data['price'];
            $description = $data['description'];;

            mysqli_stmt_bind_param($stmt, 'siss', $name, $category_id, $price, $description);
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

        $stmt = mysqli_prepare($conn, "UPDATE products SET name = ?, category_id = ?, price = ?, description = ? WHERE id = $id");

        if ($stmt) {
            $name = $data['name'];
            $category_id = $data['category_id'];
            $price = $data['price'];
            $description = $data['description'];

            mysqli_stmt_bind_param($stmt, 'siis', $name, $category_id, $price, $description);
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

        $stmt = mysqli_prepare($conn, "DELETE FROM products WHERE id = ?");

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
