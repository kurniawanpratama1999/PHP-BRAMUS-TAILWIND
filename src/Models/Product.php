<?php

namespace App\Models;

use App\Config\Database;

class Product
{


    public static function create(array $data)
    {
        $conn = Database::connect();

        $stmt = mysqli_prepare($conn, "INSERT INTO products (product_name, product_category_id, product_price, product_description, product_photo) VALUES (?, ?, ?, ?, ?)");

        $success = false;

        if ($stmt) {
            $product_name = $data['product_name'];
            $product_category_id = $data['product_category_id'];
            $product_price = $data['product_price'];
            $product_description = $data['product_description'];
            $product_photo = $data['product_photo'];

            $filesend = "/src/assets/img/" . uniqid() . "-" .  $product_photo['name'];
            $filepath = $_SERVER["DOCUMENT_ROOT"] . $filesend;

            if (move_uploaded_file($product_photo['tmp_name'], $filepath)) {
                mysqli_stmt_bind_param(
                    $stmt,
                    'sisss',
                    $product_name,
                    $product_category_id,
                    $product_price,
                    $product_description,
                    $filesend
                );

                mysqli_stmt_execute($stmt);

                $success = mysqli_stmt_affected_rows($stmt) > 0;
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);
        return $success;
    }

    public static function update($id, $data)
    {
        $conn = Database::connect();

        $success = false;

        $product_name = $data['product_name'];
        $product_category_id = $data['product_category_id'];
        $product_price = $data['product_price'];
        $product_description = $data['product_description'];
        $product_photo = $data['product_photo'];

        $stmt = mysqli_prepare($conn, "UPDATE products SET product_name = ?, product_category_id = ?, product_price = ?, product_description = ? WHERE product_id = $id");
        if ($product_photo) {
            $stmt = mysqli_prepare($conn, "UPDATE products SET product_name = ?, product_category_id = ?, product_price = ?, product_description = ?, product_photo = ? WHERE product_id = $id");
        }

        if ($stmt) {
            if ($product_photo) {
                $photo_query = mysqli_query($conn, "SELECT product_photo FROM products WHERE product_id = $id");
                $photo_result = mysqli_fetch_assoc($photo_query);

                $f =__FILE__ . $photo_result['product_photo'];
                if (file_exists($f)) {
                    unlink($f);
                }

                $filesend = "/src/assets/img/" . uniqid() . "-" .  $product_photo['name'];
                $filepath = $_SERVER["DOCUMENT_ROOT"] . $filesend;
                if (move_uploaded_file($product_photo['tmp_name'], $filepath)) {
                    mysqli_stmt_bind_param(
                        $stmt,
                        'sisss',
                        $product_name,
                        $product_category_id,
                        $product_price,
                        $product_description,
                        $filesend
                    );

                    mysqli_stmt_execute($stmt);
                    $success = mysqli_stmt_affected_rows($stmt) > 0;
                }
            } else {
                mysqli_stmt_bind_param(
                    $stmt,
                    'siss',
                    $product_name,
                    $product_category_id,
                    $product_price,
                    $product_description,
                );

                mysqli_stmt_execute($stmt);
                $success = mysqli_stmt_affected_rows($stmt) > 0;
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);
        return $success;
    }

    public static function destroy($id)
    {
        $conn = Database::connect();
        $success = false;

        $stmt = mysqli_prepare($conn, "DELETE FROM products WHERE product_id = ?");

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
