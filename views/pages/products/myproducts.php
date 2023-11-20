<?php

use App\Services\Views\View;
use App\Services\Session\Session;

View::render_header('header', 'Интернет магазин');
$s = new Session();
$products = $s->get_session("products");
$username = $s->get_session("username");
?>

<div class="container">
    <h1 class="text-center mt-1 m-5">Все товары пользователя <?= $username['login'] ?></h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php
        foreach ($products as $product) {
        ?>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card shadow-lg" style="border-radius: 12px;">
                    <img src="../../<?= $product['photo'] ?>" alt="photo" style="border-radius: 12px 12px 0px 0px;">
                    <div class="card-body">
                        <h3><a href="/product/<?= $product['id'] ?>" class="nav-link"><?= $product['name'] ?></a></h3>
                        <p class="card-text"><?= $product['description'] ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light">
                                    <a href="/product/<?= $product['id'] ?>" class="nav-link">Смотреть</a>
                                </button>
                            </div>
                            <span class="fw-bolder text-decoration-underline"><?= $product['price'] ?> руб</span>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
