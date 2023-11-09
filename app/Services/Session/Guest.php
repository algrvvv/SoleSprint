<?php

namespace App\Services\Session;

class Guest
{
    public static function guest(): bool
    {
        session_start();
        $sess = $_SESSION['user'] ?? null;

        if (isset($sess)) {
            return true;
        } else {
            return false;
        }
    }
}
