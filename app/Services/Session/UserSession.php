<?php

namespace App\Services\Session;

class UserSession
{

    /**
     * @param array $user_data
     */
    public function create_session(array $user_data)
    {
        session_start();
        $_SESSION['user'] = $user_data;
    }

    public function get_session()
    {
        session_start();
        return $_SESSION['user'];
    }

    public function delete_session()
    {
        unset($_SESSION['user']);
    }
}
