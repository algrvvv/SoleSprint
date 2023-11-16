<?php

use App\Services\Session\Session;
use App\Services\Views\View;

View::render_header('header', 'Наши кроссовки');
$s = new Session();
$products = $s->get_session("products");
?>

<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
        <h1 class="display-3 fw-bold">"SoleSprint" - ваш путь к стильным и комфортным кроссовкам</h1>
        <h3 class="fw-normal text-muted mb-3">
            Присоединяйтесь к нам и сделайте свой выбор с "SoleSprint". Мы верим, что правильная
            пара кроссовок может вдохновить вас на новые достижения и придать уверенности на каждом шагу.
        </h3>
        <div class="d-flex gap-3 justify-content-center lead fw-normal">
            <a class="icon-link" href="#">
                Learn more
            </a>
            <a class="icon-link" href="#">
                Buy
            </a>
        </div>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>


<div class="container">
    <h1 class="text-center mt-1 m-5">Все товары: </h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php
        foreach ($products as $product) {
        ?>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card shadow-lg" style="border-radius: 12px;">
                    <img src="<?= $product['photo'] ?>" alt="photo" style="border-radius: 12px 12px 0px 0px;">
                    <div class="card-body">
                        <h3><a href="/product/<?= $product['id'] ?>" class="nav-link"><?= $product['name'] ?></a></h3>
                        <p class="card-text"><?= $product['description'] ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light">
                                    <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.00019C10.2006 3.90317 7.19377 3.2551 4.93923 5.17534C2.68468 7.09558 2.36727 10.3061 4.13778 12.5772C5.60984 14.4654 10.0648 18.4479 11.5249 19.7369C11.6882 19.8811 11.7699 19.9532 11.8652 19.9815C11.9483 20.0062 12.0393 20.0062 12.1225 19.9815C12.2178 19.9532 12.2994 19.8811 12.4628 19.7369C13.9229 18.4479 18.3778 14.4654 19.8499 12.5772C21.6204 10.3061 21.3417 7.07538 19.0484 5.17534C16.7551 3.2753 13.7994 3.90317 12 6.00019Z" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-sm btn-light">View</button>
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

<?php

View::render('layout/footer');

?>
