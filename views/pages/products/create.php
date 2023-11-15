<?php

use App\Services\Views\View;
use App\Services\Session\Session;

View::render_header('header', 'Интернет магазин');
?>

<div class="container">
    <h1 class="text-center mt-2 mb-5">Форма для создания товара</h1>
    <form action="/action/create/product" method="post" style="width: 70%; margin: 0 auto;" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Название товара</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание товара</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        
        <div class="mb-3">
            <label for="photo" class="form-label">Фото товара</label>
            <input type="file" class="form-control" name="photo" id="photo" >
        </div>
        
        <div class="mb-3">
            <label for="price" class="form-label">Цена товара</label>
            <input type="text" class="form-control" name="price" id="price" >
        </div>
        
        <div class="mb-3">
            <label for="tegs" class="form-label">Добавьте теги товару</label>
            <textarea name="tegs" id="tegs" class="form-control"></textarea>
            <small class="form-label text-primary">
                Введите один или более тегов через запятую
            </small>
        </div>

        <button type="submit" class="btn btn-primary">Добавить товар</button>
        <p class="mt-1 mb-3 text-danger">
            <?php
            $s = new Session();
            echo $s->get_session('errors');
            $s->unset_session('errors');
            ?>
        </p>
    </form>
</div>
