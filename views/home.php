<?php

use App\Services\Views\View;

View::render_header('header', 'Интернет магазин');
?>

<main class="container">
    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
        <div class="col-lg-6 px-0">
            <h1 class="display-4 fst-italic">"SoleSprint" - ваш путь к стильным и комфортным кроссовкам</h1>
            <p class="lead my-3">
                В "SoleSprint" мы предлагаем широкий выбор кроссовок, созданных для вашего активного
                образа жизни. Наш магазин специализируется на кроссовках для бега, спортивных тренировок
                и повседневной носки. Мы собрали лучшие бренды и модели, чтобы вы могли найти идеальную
                пару для любой цели.
            </p>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-md-12">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                О нас
            </h3>

            <article class="blog-post">
                <h2 class="display-5 link-body-emphasis mb-1">Немного о нашем производстве</h2>
                <p class="blog-post-meta">January 1, 2021 by <a href="#">Mark</a></p>

                <p style="font-size: 24px;">
                    У нас вы найдете кроссовки с инновационными технологиями, которые обеспечат вам комфорт
                    и поддержку при каждом шаге. Независимо от того, занимаетесь ли вы бегом, фитнесом или
                    просто ищете стильную обувь, "SoleSprint" поможет вам найти идеальное сочетание стиля и
                    функциональности.
                </p>
                <hr>
                <p style="font-size: 24px;">
                    У нас вы найдете кроссовки с инновационными технологиями, которые обеспечат
                    вам комфорт и поддержку при каждом шаге. Независимо от того, занимаетесь ли вы
                    бегом, фитнесом или просто ищете стильную обувь, "SoleSprint" поможет вам найти
                    идеальное сочетание стиля и функциональности.
                </p>
                <hr>
                <p style="font-size: 24px;">
                    Наши кроссовки подходят как для профессиональных спортсменов, так и для
                    любителей активного образа жизни. Мы гордимся нашей эксклюзивной коллекцией
                    и предлагаем вам высокое качество по доступным ценам.
                </p>
                <hr>
                <p style="font-size: 24px;">
                    Загляните в "SoleSprint" и найдите свою идеальную пару кроссовок для всех ваших
                    приключений. Ваш путь к стилю и комфорту начинается здесь.
                </p>
                <h3 style="font-size: 35px;">Почему "SoleSprint"?</h3>
                <ul>
                    <li style="font-size: 22px;"><b>Широкий ассортимент</b></li>
                    <p style="font-size: 24px;">
                        Мы постоянно обновляем нашу коллекцию,
                        чтобы предоставить вам лучшие и самые актуальные модели кроссовок.
                    </p>
                    <li style="font-size: 22px;"><b>Качество и комфорт</b>
                    </li>
                    <p style="font-size: 24px;">
                        В "SoleSprint" мы делаем ставку на качество.
                        Все наши кроссовки тщательно отобраны и протестированы, чтобы обеспечить
                        вам надежность и комфорт.
                    </p>
                    <li style="font-size: 22px;"><b>Страсть к спорту</b>
                    </li>
                    <p style="font-size: 24px;">
                        Мы разделяем вашу страсть к активному образу жизни.
                        Наши сотрудники - это спортсмены и энтузиасты, готовые помочь вам сделать правильный
                        выбор.
                    </p>
                    <li style="font-size: 22px;"><b>Удобство онлайн-покупок</b>
                    </li>
                    <p style="font-size: 22px;">
                        "SoleSprint" - это удобный интернет-магазин, где вы можете
                        легко найти, заказать и получить свои кроссовки.
                    </p>
                </ul>
            </article>
        </div>
    </div>

</main>

<?php

View::render('layout/footer');

?>
