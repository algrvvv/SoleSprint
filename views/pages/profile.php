<?php

use App\Services\Auth\Auth;
use App\Services\Session\Session;
use App\Services\Views\View;

$s = new Session();

View::render_header('header', 'Профиль пользователя');

$profile_data = $s->get_session('values')['profile_data'];
$owner_data = $s->get_session('values')['owner_data'] ?? null;

?>
<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3"><?= $profile_data['login'] ?></h5>
                        <p class="text-muted mb-1"><?= $profile_data['email'] ?></p>
                        <?php
                        $auth = new Auth();
                        $user_id = $auth->user()['id'] ?? null;
                        if ($profile_data['id'] == $user_id) {
                            if (isset($owner_data)) {
                                if ($owner_data['status'] == 'verified') {
                        ?>
                                    <div class="d-flex justify-content-center mb-2">
                                        <a href="/products/profile/<?= $user_id ?>" type="button" class="btn btn-primary">Мои товары</a>
                                        <a href="/create/product" type="button" class="btn btn-outline-primary ms-1">Добавить товар</a>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="d-flex justify-content-center mb-2">
                                        <a href="/applications" type="button" class="btn btn-primary">Мои заявки</a>
                                        <a href="/getseller" type="button" class="btn btn-outline-primary ms-1">Стать продавцом</a>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="d-flex justify-content-center mb-2">
                                    <a href="/applications" type="button" class="btn btn-primary">Мои заявки</a>
                                    <a href="/getseller" type="button" class="btn btn-outline-primary ms-1">Стать продавцом</a>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Логин</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $profile_data['login'] ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Почта</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $profile_data['email'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <?php
                if (!isset($owner_data) || $owner_data['status'] != 'verified') {
                ?>
                    <span class="text-center">Пользователь не является продавцом</span>
                <?php
                } else {
                ?>
                    <span class="text-center">Информация о продавце:</span>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Имя продавцва</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $owner_data['name'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Телефон</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $owner_data['phone'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Рейтинг</p>
                                </div>
                                <div class="col-sm-9">
                                    <span class="text-muted mb-0" style="display: flex; align-items: center;">
                                        <?= $owner_data['rating'] ?>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M11.2691 4.41115C11.5006 3.89177 11.6164 3.63208 11.7776 3.55211C11.9176 3.48263 12.082 3.48263 12.222 3.55211C12.3832 3.63208 12.499 3.89177 12.7305 4.41115L14.5745 8.54808C14.643 8.70162 14.6772 8.77839 14.7302 8.83718C14.777 8.8892 14.8343 8.93081 14.8982 8.95929C14.9705 8.99149 15.0541 9.00031 15.2213 9.01795L19.7256 9.49336C20.2911 9.55304 20.5738 9.58288 20.6997 9.71147C20.809 9.82316 20.8598 9.97956 20.837 10.1342C20.8108 10.3122 20.5996 10.5025 20.1772 10.8832L16.8125 13.9154C16.6877 14.0279 16.6252 14.0842 16.5857 14.1527C16.5507 14.2134 16.5288 14.2807 16.5215 14.3503C16.5132 14.429 16.5306 14.5112 16.5655 14.6757L17.5053 19.1064C17.6233 19.6627 17.6823 19.9408 17.5989 20.1002C17.5264 20.2388 17.3934 20.3354 17.2393 20.3615C17.0619 20.3915 16.8156 20.2495 16.323 19.9654L12.3995 17.7024C12.2539 17.6184 12.1811 17.5765 12.1037 17.56C12.0352 17.5455 11.9644 17.5455 11.8959 17.56C11.8185 17.5765 11.7457 17.6184 11.6001 17.7024L7.67662 19.9654C7.18404 20.2495 6.93775 20.3915 6.76034 20.3615C6.60623 20.3354 6.47319 20.2388 6.40075 20.1002C6.31736 19.9408 6.37635 19.6627 6.49434 19.1064L7.4341 14.6757C7.46898 14.5112 7.48642 14.429 7.47814 14.3503C7.47081 14.2807 7.44894 14.2134 7.41394 14.1527C7.37439 14.0842 7.31195 14.0279 7.18708 13.9154L3.82246 10.8832C3.40005 10.5025 3.18884 10.3122 3.16258 10.1342C3.13978 9.97956 3.19059 9.82316 3.29993 9.71147C3.42581 9.58288 3.70856 9.55304 4.27406 9.49336L8.77835 9.01795C8.94553 9.00031 9.02911 8.99149 9.10139 8.95929C9.16534 8.93081 9.2226 8.8892 9.26946 8.83718C9.32241 8.77839 9.35663 8.70162 9.42508 8.54808L11.2691 4.41115Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
