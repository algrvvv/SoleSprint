<?php

session_start();

use App\Services\Auth\Auth;
use App\Services\Database\DBW;
use App\Services\Session\UserSession;

/**
 * проверка сессии
 */
$s = new UserSession();

echo "<pre>";
print_r($s->get_session());
echo "</pre>";
?>

<h1>404</h1>
