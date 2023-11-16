<?php

use App\Services\Views\View;
use App\Services\Session\Session;

View::render_header('header', 'Интернет магазин');
$s = new Session();
$product = $s->get_session('product');

$tegs = explode(',', $product['tegs']);

?>

<style>
    .tag {
        color: #764eef;
        background-color: #764eef2a;
        padding: 6px;
        margin-right: 4px;
        border-radius: 12px;
    }
</style>

<div class="container mt-5">
    <div class="row shadow-lg rounded">
        <div class="col-lg-4 d-flex align-items-stretch p-0">
            <div class="card shadow-lg" style="border-radius: 12px;">
                <img src="../../<?= $product['photo'] ?>" alt="photo" style="border-radius: 12px 12px 0px 0px;">
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card-body">
                <h3 class="mt-1"><?= $product['name'] ?></h3>
                <div class="d-flex">
                    <?php
                        foreach ($tegs as $teg) {
                    ?>
                    <p class="tag">#<?= $teg ?></p>
                    <?php
                        }
                    ?>
                </div>
                <p class="card-text"><?= $product['description'] ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light">
                            Добавить в корзину
                            <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.00019C10.2006 3.90317 7.19377 3.2551 4.93923 5.17534C2.68468 7.09558 2.36727 10.3061 4.13778 12.5772C5.60984 14.4654 10.0648 18.4479 11.5249 19.7369C11.6882 19.8811 11.7699 19.9532 11.8652 19.9815C11.9483 20.0062 12.0393 20.0062 12.1225 19.9815C12.2178 19.9532 12.2994 19.8811 12.4628 19.7369C13.9229 18.4479 18.3778 14.4654 19.8499 12.5772C21.6204 10.3061 21.3417 7.07538 19.0484 5.17534C16.7551 3.2753 13.7994 3.90317 12 6.00019Z" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    <span class="fw-bolder text-decoration-underline"><?= $product['price'] ?> руб</span>
                </div>
            </div>
        </div>
    </div>
</div>
