<div>
    <h2>Результат поиска сотрудника по ФИО</h2>
    <?php if(empty($filteredEmployees)): ?>
        <h4>Ничего не найдено</h4>
    <?php else: ?>
        <div style="display: flex; flex-wrap: wrap">
            <?php foreach ($filteredEmployees as $employee): ?>
                <div style="background-color: #2771ffa1; display: flex; flex-direction: column; width: 500px; margin-left: 50px; margin-bottom: 200px; position: relative; align-items: baseline; border-radius: 20px; border: 1px solid #2947ec;">
                    <div style="display: flex; background-color: #678dff; width: 300px; align-items: center; margin-top: 20px; margin-left: auto; margin-right: auto; text-align: center;">
                        <h3><?= $employee->surname ?></h3>&nbsp;
                        <h3><?= $employee->name ?></h3>&nbsp;
                        <h3><?= $employee->patronymic ?></h3>&nbsp;
                    </div>
                    <div style="display: flex; gap: 150px;">
                        <div style="margin-left: 20px">
                            <h4>Пол: <?= $employee->gender ?></h4>
                            <h4>Дата рождения: <?= $employee->dob ?></h4>
                            <h4>Адрес прописки: <?= $employee->address ?></h4>
                            <h4>Должность: <?= $employee->post->getPost() ?></h4>
                            <?php if ($employee->check_unit): ?>
                                <h4>Подразделение: <?= $employee->unit->unit_name ?></h4>
                            <?php endif; ?>
                        </div>
                        <div style="margin-top: 90px;">
                            <?php if (!empty($employee->img)): ?>
                                <img src="/php_practice2/public/images/<?= $employee->img ?>" alt="<?= $employee->surname ?>" style="max-width: 100px; max-height: 100px;">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
