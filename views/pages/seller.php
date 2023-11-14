<?php

use App\Services\Views\View;
use App\Services\Session\Session;

View::render_header('header', 'Станьте продавцом');
?>

<h1 class="text-center mt-2">Заполните форму для создания заявки: </h1>

<div class="container mt-5">
    <form action="/add/seller" method="post" style="width: 70%; margin: 0 auto;">
        <div class="mb-3">
            <label for="name" class="form-label">Имя продавца</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="tel" name="phone" class="form-control" id="phone">
        </div>
        <button type="submit" class="btn btn-primary">Отправить заявку</button>
        <p class="mt-1 mb-3 text-danger">
            <?php
            $s = new Session();
            echo $s->get_session('errors');
            $s->unset_session('errors');
            ?>
        </p>
    </form>
</div>
