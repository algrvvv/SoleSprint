<?php

namespace App\Services;

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
