<?php include('components/header.view.php'); ?>
<section class="container">
    <div class="alert alert-danger my-5">
        <h2 class="text-center text-uppercase">Ошибка 404 - Страница не найдена</h2>
        <h4>Возможные причины ошибки: </h4>
        <ol>
            <li>ошибка при наборе адреса страницы (URL);</li>
            <li>переход по неработающей или неправильной ссылке;</li>
            <li>отсутствие запрашиваемой страницы на сайте;</li>
        </ol>
        <h4>Возможные причины ошибки: </h4>
        <ol>
            <li>проверить правильность написания адреса страницы (URL);</li>
            <li>перейти на главную страницу сайта (для удобства дайте ссылку на главную страницу);</li>
            <li>воспользоваться картой сайта или поиском;</li>
            <li>посетить предложенные разделы сайта;</li>
        </ol>
    </div>
    <a href="<?= ROOT . '/claim/get_my_claims' ?>" class="btn btn-primary">Назад</a>
</section>

<?php include('components/footer.view.php'); ?>