<?php
if (!app()->auth::check()):
    ?>
    <form method="post" style="display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; background-color: #3c6af7; width: 250px; margin-left: auto; margin-right: auto; height: 220px; border-radius: 15px;">
        <h2 style="margin-bottom: -45px;">Вход</h2>
        <h3 style="font-size: 15px; margin-top: 20px; position: relative; top: 35px;"><?= $message ?? ''; ?></h3>
        <h3><?= app()->auth->user()->name ?? ''; ?></h3>
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <input type="text" name="login" placeholder="Логин" style="margin-bottom: 10px;">
        <input type="password" name="password" placeholder="Пароль" style="margin-bottom: 10px;">
        <button style="width: 95px; margin-bottom: 10px; -webkit-writing-mode: horizontal-tb !important; -webkit-appearance: button; border-color: rgb(216, 216, 216) rgb(209, 209, 209) rgb(186, 186, 186); border-style: solid; border-width: 1px; padding: 1px 7px 2px; text-rendering: auto; color: initial; display: inline-block; text-align: start; margin: 0em; font: 400 11px system-ui; border-radius: 15px; text-align: center; background-color: #3f39f7; color: white;">Войти</button>
    </form>
<?php
else:
    ?>
    <h2>Вы авторизованы!</h2>
<?php
endif;
?>