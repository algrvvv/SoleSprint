<?php
/**
 * проверка сессии
 */
session_start();
use App\Services\Session\UserSession;

$s = new UserSession();

echo "<pre>";
print_r($s->get_session());
echo "</pre>";

?>

<h1>404</h1>

