<form method="post" style="display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; background-color: #3c6af7; width: 320px; margin-left: auto; margin-right: auto; height: 250px; border-radius: 15px;">
    <h2 style="text-align: center; margin-bottom: -20px;">Подразделение</h2>
    <h3 style="margin-top: 40px; width: 215px; text-align: center;"><?= $message ?? ''; ?></h3>
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <input type="text" name="unit_name" placeholder="Название" style="margin-bottom: 15px;">

    <div style="margin-bottom: 10px">
        <label for="id_view">Вид подразделения
            <select id="views" name="id_view">
                <?php foreach ($views as $view): ?>
                    <option value="<?= $view->id_view ?>"><?= $view->name ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </div>

    <button style="width: 95px; margin-bottom: 10px; -webkit-writing-mode: horizontal-tb !important; -webkit-appearance: button; border-color: rgb(216, 216, 216) rgb(209, 209, 209) rgb(186, 186, 186); border-style: solid; border-width: 1px; padding: 1px 7px 2px; text-rendering: auto; color: initial; display: inline-block; text-align: start; margin: 0em; font: 400 11px system-ui; border-radius: 15px; text-align: center; background-color: #3f39f7; color: white;">Добавить</button>
</form>
