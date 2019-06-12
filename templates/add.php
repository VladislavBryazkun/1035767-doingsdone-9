<main class="content__main">
    <h2 class="content__main-heading">Добавление задачи</h2>

    <form class="form" enctype="multipart/form-data" action="add.php" method="post" autocomplete="off">
        <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>
            <input class="form__input <?= isset($errors['name']) ? 'form__input--error' : '' ?>" type="text" name="name"
                   id="name" value="<?= $task['name'] ?? '' ?>" placeholder="Введите название">
            <p class="form__message"><?= $errors['name'] ?? '' ?></p>
        </div>

        <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input form__input--select" name="project_id" id="project">
                <?php foreach ($projects as $project): ?>

                    <option value="<?= $project['id'] ?>" <?= isset($task['project_id']) && $project['id'] === $task['project_id'] ? 'selected' : '' ?>><?= htmlspecialchars($project['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form__row">
            <label class="form__label" for="finish_date">Дата выполнения</label>

            <input class="form__input form__input--date <?= isset($errors['date']) ? 'form__input--error' : '' ?> "
                   type="text" name="date" id="date" value="<?= $task['date'] ?? '' ?>"
                   placeholder="Введите дату в формате ГГГГ-ММ-ДД">
            <p class="form__message"><?= $errors['date'] ?? '' ?></p>
        </div>

        <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
                <input class="visually-hidden" type="file" name="file" id="file" value="">

                <label class="button button--transparent" for="file">
                    <span>Выберите файл</span>
                </label>
            </div>
        </div>
        <?php if (count($errors)): ?>
            <p class="form__message">Пожалуйста исправьте ошибки в форме</p>
        <?php endif; ?>
        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
        </div>
    </form>
</main>