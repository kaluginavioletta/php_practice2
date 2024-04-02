<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
</head>
<body style="margin: 0; padding: 0; background-color: #2158fdcc;">
<header>
    <nav style="position: relative; display: flex; gap: 15px; align-items: center; justify-content: space-around; margin-bottom: 50px;">
        <?php
        if (app()->auth::user()->id_role === 1) :
            ?>
            <a href="<?= app()->route->getUrl('/logout') ?>" style="color: white; text-decoration: none;">Выход (<?= app()->auth::user()->name ?>)</a>
        <?php
        elseif (app()->auth::user()->id_role === 2) :
            ?>
            <a href="<?= app()->route->getUrl('/') ?>" style="color: white; text-decoration: none;">Главная</a>
            <a href="<?= app()->route->getUrl('/employee') ?>" style="color: white; text-decoration: none;">Добавить сотрудника</a>
            <a href="<?= app()->route->getUrl('/unit') ?>" style="color: white; text-decoration: none;">Добавить подразделение</a>
            <form method="GET" action="<?= app()->route->getUrl('/search') ?>">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <input type="text" name="query" placeholder="Поиск по ФИО">
                <button type="submit" style="-webkit-writing-mode: horizontal-tb !important; -webkit-appearance: button; border-color: rgb(216, 216, 216) rgb(209, 209, 209) rgb(186, 186, 186); border-style: solid; border-width: 1px; padding: 1px 7px 2px; text-rendering: auto; color: initial; display: inline-block; margin: 0em; font: 400 11px system-ui; border-radius: 15px; text-align: center; background-color: #3f39f7; width: 110px; height: 20px;"><a href="#" style="color: white; text-decoration: none;">Искать</button>
            </form>
            <a href="<?= app()->route->getUrl('/logout') ?>" style="color: white; text-decoration: none;">Выход (<?= app()->auth::user()->name ?>)</a>
        <?php
        endif;
        ?>
    </nav>
</header>
<main style="margin-left: 100px;">
    <?= $content ?? '' ?>
</main>

</body>
</html>
