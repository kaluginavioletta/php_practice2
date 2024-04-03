<form method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; background-color: #3c6af7; width: 360px; margin-left: auto; margin-right: auto; height: 530px; border-radius: 15px;">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <h2>Новый сотрудник</h2>
    <h3 style="margin-bottom: 0"><?= $message ?? ''; ?></h3>
    <input type="text" name="surname" placeholder="Фамилия" style="margin-bottom: 15px;">
    <input type="text" name="name" placeholder="Имя" style="margin-bottom: 15px;">
    <input type="text" name="patronymic" placeholder="Отчество" style="margin-bottom: 15px;">
    <div style="margin-bottom: 10px">
        <label for="gender">Пол
            <select id="gender" name="gender">
                <?php foreach ($genders as $gender): ?>
                    <option value="<?= $gender ?>"><?= $gender ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </div>
    <label>Дата рождения <input type="date" name="dob" style="margin-bottom: 15px;"></label>
    <label>Адрес прописки <input type="text" name="address" style="margin-bottom: 15px;"></label>

    <label style="margin-bottom: 10px;">Изображение <input type="file" name="img"></label>

    <?php
    if (app()->auth::user()->id_role === 2):
        ?>

        <div style="margin-bottom: 10px">
            <label for="id_post">Должность
                <select id="id_post" name="id_post">
                    <?php foreach ($posts as $post): ?>
                        <option value="<?= $post->id_post ?>"><?= $post->getPost() ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>


    <?php
    elseif (app()->auth::user()->id_role === 1):
        ?>

        <div style="margin-top: 10px">
            <input type="password" name="password" placeholder="Пароль" style="margin-bottom: 15px;">
        </div>
    <?php endif; ?>

    <?php
    if (app()->auth::user()->id_role === 2) :
        ?>

        <div style="margin-bottom: 10px">
            <label for="id_unit">Подразделение
                <select id="id_unit" name="id_unit">
                    <?php foreach ($units as $unit): ?>
                        <option value="<?= $unit['id_unit'] ?>"><?= $unit['unit_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <a href="<?= app()->route->getUrl('/unit') ?>">+</a>
        </div>


        <div style="margin-bottom: 10px">
            <label for="id_composition">Состав
                <select id="id_composition" name="id_composition">
                    <?php foreach ($compositions as $composition): ?>
                        <option value="<?= $composition->id_composition ?>"><?= $composition->getComposition() ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>

        <div style="margin-bottom: 10px">
            <label><input type="checkbox" name="check_unit" style="margin-bottom: 15px;">Прикрепить к подразделению</label>
        </div>
    <?php endif; ?>

    <button style="width: 95px; margin-bottom: 10px; -webkit-writing-mode: horizontal-tb !important; -webkit-appearance: button; border-color: rgb(216, 216, 216) rgb(209, 209, 209) rgb(186, 186, 186); border-style: solid; border-width: 1px; padding: 1px 7px 2px; text-rendering: auto; color: initial; display: inline-block; text-align: start; margin: 0em; font: 400 11px system-ui; border-radius: 15px; text-align: center; background-color: #3f39f7; color: white;">Добавить</button>
</form>
