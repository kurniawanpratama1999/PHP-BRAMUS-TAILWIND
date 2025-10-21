<?php
namespace App\Helpers;

class Flash
{
    public static function set($type, $message)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['flash'] = [
            'type' => $type, // success | error | warning
            'message' => $message
        ];
    }

    public static function get()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']); // hapus setelah ditampilkan (flash)
            return $flash;
        }

        return null;
    }
}
