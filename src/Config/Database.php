<?php

namespace App\Config;

class Database
{
    public static function connect()
    {
        $_HOST = "localhost";
        $_USER = "root";
        $_PASS = "";
        $_DB = "testing";

        $conn = mysqli_connect($_HOST, $_USER, $_PASS, $_DB);

        if (!$conn) {
            die('Koneksi gagal: ' . mysqli_connect_error());
        }

        return $conn;
    }
}
