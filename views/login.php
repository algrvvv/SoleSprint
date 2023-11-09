<!DOCTYPE html>
<html lang="en">
<?php

session_start();
use App\Services\Session\Session;

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="assets/style/main.css">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="uploads/favicon.png" type="image/x-icon">

</head>

<style>
    .btn-back {
        background-color: #adb5bd;
        padding: 12px;
        border-radius: 50% 12px 12px 50%;
    }
</style>

<body class="d-flex align-items-center py-4 bg-body-tertiary" style="height: 100vh;">
    <div class="btn-back" style="position: fixed; top:50px; left:50px;">
        <a class="link" href="/" style="color: white">Домой</a>
    </div>
    <main class="form-signin w-50 m-auto" style="margin: 0 auto;">
        <form action="/auth/login" method="post">
            <h1 class="h3 mb-3 fw-normal">Введите данные</h1>

            <div class="form-floating">
                <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
                <label for="email">Электронная почта</label>
            </div>
            <br>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                <label for="password">Пароль</label>
            </div>

            <div class="form-check text-start my-3">
                <input name="remember" class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Запомнить меня
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Войти</button>
            <p class="mt-1 mb-3 text-danger">
                <?php
                    $s = new Session();
                    echo $s->get_session('errors');
                    $s->unset_session('errors');
                ?>
            </p>
            
            <p class="mt-3 mb-3 text-body-secondary">
                Еще нет аккаунта? <a class="link" href="/register">Зарегистрируйся</a>
            </p>
            <p class="mt-5 mb-3 text-body-secondary">© Sole Sprint 2023</p>
        </form>
    </main>
</body>

</html>
