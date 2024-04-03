<form method="post" style="display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; background-color: #3c6af7; width: 320px; margin-left: auto; margin-right: auto; height: 400px; border-radius: 15px;">
<h2 style="text-align: center; margin-bottom: -15px; width: 200px;">Новый сотрудник отдела кадров</h2>
    <h3 style="margin-top: 40px; width: 215px;"><?= $message ?? ''; ?></h3>
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <input type="text" name="name" placeholder="Имя" style="margin-bottom: 15px;">
    <input type="text" name="login" placeholder="Логин" style="margin-bottom: 15px;">

    <input type="password" name="password" placeholder="Пароль" style="margin-bottom: 15px;">

    <button style="width: 95px; margin-bottom: 10px; -webkit-writing-mode: horizontal-tb !important; -webkit-appearance: button; border-color: rgb(216, 216, 216) rgb(209, 209, 209) rgb(186, 186, 186); border-style: solid; border-width: 1px; padding: 1px 7px 2px; text-rendering: auto; color: initial; display: inline-block; text-align: start; margin: 0em; font: 400 11px system-ui; border-radius: 15px; text-align: center; background-color: #3f39f7; color: white;">Вперед</button>
</form>
