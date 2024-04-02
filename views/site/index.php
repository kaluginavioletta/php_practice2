<div style="display: flex; flex-direction: row-reverse; gap: 15px; margin-right: 30px;">
    <?php if (app()->auth::user()->id_role === 2) :
        ?>
        <div style="margin-bottom: 40px; display: flex; flex-direction: row-reverse; gap: 15px; margin-right: 30px; align-items: center;">

            <form id="compositionForm" method="POST" action="<?= app()->route->getUrl('/') ?>">
                <div class="css-modal-details">
                    <details>
                        <summary>По составу</summary>
                        <div class="cmc">
                            <div class="cmt">
                                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                                <?php foreach ($compositions as $composition): ?>
                                    <input type="radio" name="id_composition[]" value="<?= $composition['id_composition'] ?>"> <?= $composition['name'] ?><br>
                                <?php endforeach; ?>
                                <button type="submit">Отправить</button>
                            </div>
                        </div>
                    </details>
                </div>
            </form>


            <form id="unitsForm" method="POST" action="<?= app()->route->getUrl('/') ?>">
                <div class="css-modal-details">
                    <details>
                        <summary>По подразделениям</summary>
                        <div class="cmc">
                            <div class="cmt">
                                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                                <?php foreach ($units as $unit): ?>
                                    <input type="checkbox" name="check_unit[]" value="<?= $unit['id_unit'] ?>"> <?= $unit['unit_name'] ?><br>
                                <?php endforeach; ?>
                                <button type="submit" name="filter">Отправить</button>
                            </div>
                        </div>
                    </details>
                </div>
            </form>

            <form id="unitForm" method="POST" action="<?= app()->route->getUrl('/') ?>">
                <div class="css-modal-details">
                    <details>
                        <summary>По подразделению</summary>
                        <div class="cmc">
                            <div class="cmt">
                                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                                <?php foreach ($units as $unit): ?>
                                    <input type="radio" name="check_unit" value="<?= $unit['id_unit'] ?>"> <?= $unit['unit_name'] ?><br>
                                <?php endforeach; ?>
                                <button type="submit">Отправить</button>
                            </div>
                        </div>
                    </details>
                </div>
            </form>
        </div>
    <?php endif; ?>
</div>
<div style="display: flex; flex-wrap: wrap;">
    <?php foreach ($employees as $employee) { ?>
        <div style="background-color: #2771ffa1; display: flex; flex-direction: column; width: 500px; margin-left: 50px; margin-bottom: 200px; position: relative; align-items: baseline; border-radius: 20px; border: 1px solid #2947ec;">
            <div style="display: flex; background-color: #678dff; width: 300px; align-items: center; margin-top: 20px; margin-left: auto; margin-right: auto; text-align: center;">
                <h3><?= $employee->surname ?></h3>&nbsp;
                <h3><?= $employee->name ?></h3>&nbsp;
                <h3><?= $employee->patronymic ?></h3>&nbsp;
            </div>
            <div style="margin-left: 20px">
                <h4>Пол: <?= $employee->gender ?></h4>
                <h4>Дата рождения: <?= $employee->dob ?></h4>
                <h4>Адрес прописки: <?= $employee->address ?></h4>
                <h4>Должность: <?= $employee->post->getPost() ?></h4> <!-- Получение конкретной должности для данного сотрудника -->
<!--                --><?php //if ($employee->check_unit): ?>
                    <h4>Подразделение: <?= $employee->unit->unit_name ?></h4> <!-- Получение названия подразделения для данного сотрудника -->
<!--                --><?php //endif; ?>
                <img src="../../public/images/<?= $employee->img ?>" alt="<?= $employee->surname ?>" style="max-width: 100px; max-height: 100px;">
            </div>
        </div>
    <?php } ?>
</div>

<style>
    /* Контейнер для кнопки, чтобы не прыгал контент, когда она сменит позиционирование */
    .css-modal-details {
        height: 60px;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    /* Кнопка для открытия */
    .css-modal-details summary {
        text-decoration: none;
        position: relative;
        line-height: 20px;
        cursor: pointer;
        overflow: hidden;
        z-index: 1;
        -webkit-appearance: button;
        border-color: rgb(216, 216, 216) rgb(209, 209, 209) rgb(186, 186, 186);
        border-style: solid;
        border-width: 1px;
        margin: 0em;
        font: 400 11px system-ui;
        border-radius: 15px;
        text-align: center;
        color: white;
        background-color: #3f39f7;
        width: 150px;
        height: 18px;
    }
    .css-modal-details summary:hover,
    .css-modal-details summary:active,
    .css-modal-details summary:focus {
        color: #FFF;
    }
    .css-modal-details summary:before {
        content: '';
        position: absolute;
        top: 0;
        right: -50px;
        bottom: 0;
        left: 0;
        border-right: 50px solid transparent;
        border-top: 50px solid #2158fdcc;
        transition: transform 0.5s;
        transform: translateX(-100%);
        z-index: -1;
    }
    .css-modal-details summary:hover:before,
    .css-modal-details summary:active:before,
    .css-modal-details summary:focus:before {
        transform: translateX(0);
    }

    /* Кнопка при открытом окне переходит на весь экран */
    .css-modal-details details[open] summary {
        cursor: default;
        opacity: 0;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 3;
        width: 100%;
        height: 100%;
    }

    /* Контейнер, который затемняет страницу */
    .css-modal-details details .cmc {
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .css-modal-details details[open] .cmc {
        pointer-events: none;
        z-index: 4;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        animation: bg 0.5s ease;
        background: rgba(17, 66, 193, 0.7);
    }

    /* Модальное окно */
    .css-modal-details details .cmt {
        font-family: Verdana, sans-serif;
        font-size: 16px;
        padding: 20px;
        width:80%;
        max-width: 600px;
        max-height: 70%;
        transition: 0.5s;
        border: 6px solid #2158fdcc;
        border-radius: 12px;
        background: #FFF;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2), 0 16px 20px rgba(0,0,0,0.2);
        text-align: center;
        overflow: auto;
    }
    .css-modal-details details[open] .cmt {
        animation: scale 0.5s ease;
        z-index: 4;
        pointer-events: auto;
    }

    /* Декоративная кнопка с крестиком */
    .css-modal-details details[open] .cmc:after {
        content: "";
        width: 50px;
        height: 50px;
        border: 6px solid #2158fdcc;
        border-radius: 12px;
        position: absolute;
        z-index: 10;
        top: 20px;
        right: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2), 0 16px 20px rgba(0,0,0,0.2);
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23337AB7' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3e%3cline x1='18' y1='6' x2='6' y2='18'%3e%3c/line%3e%3cline x1='6' y1='6' x2='18' y2='18'%3e%3c/line%3e%3c/svg%3e");
        background-color: #FFF;
        background-size: cover;
        animation: move 0.5s ease;
    }

    /* Анимации */
    @keyframes scale {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }
    @keyframes move {
        0% {
            right: -80px;
        }
        100% {
            right: 20px;
        }
    }
    @keyframes bg {
        0% {
            background: rgba(51, 122, 183, 0);
        }
        100% {
            background: rgba(24, 43, 145, 0.7);
        }
    }
</style>
