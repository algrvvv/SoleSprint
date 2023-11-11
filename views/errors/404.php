<?php

session_start();

use App\Services\Session\UserSession;
use App\Services\Database\DBW;

/**
 * проверка сессии
 */
$s = new UserSession();

echo "<pre>";
print_r($s->get_session());
echo "</pre>";

?>

<h1>404</h1>
