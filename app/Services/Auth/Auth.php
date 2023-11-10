<?php

namespace App\Services\Auth;


use App\Services\Database\DBW;
use App\Services\Helpers\Helpers;

class Auth
{
    private $message;
    private $user;

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param array $credentials
     * @param string $db_name
     * @param bool $remember
     */
    public function attempt(array $credentials, string $db_name, bool $remember = false): bool
    {
        $db = new DBW();
        $data = $db->select(['count(*) as count, password'], $db_name)->where('email', $credentials['email'])->get();
        if ($data['count'] > 0) {
            $user_data = $db->select(['*'], $db_name)->where('email', $credentials['email'])->get();
            $correct_password = $data['password'];
            if ($credentials['password'] === $correct_password) {
                $user_datas = [
                    'id' => $user_data['id'],
                    'login' => $user_data['login'],
                    'email'=> $user_data['email'],
                    'orders_id' => $user_data['orders_id'],
                    'favorites' => $user_data['favorites'],
                    'dop_id' => $user_data['dop_id'],
                    'role' => $user_data['role']
                ];
                $this->setUser($user_datas);
                return true;
            } else {
                $this->setMessage('Введен неправльный пароль');
                return false;
            }
        } else {
            $this->setMessage('Пользователя не найдено. Проверьте данные входа');
            return false;
        }
    }
}
