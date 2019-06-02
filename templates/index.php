<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="post" autocomplete="off">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/?<?=http_build_query(array_merge($_GET, ['tab' => 'all']))?>" class="tasks-switch__item <?=isset($tab['all']) || !count($tab) ? 'tasks-switch__item--active' : ''?>">Все задачи</a>
            <a href="?<?=http_build_query(array_merge($_GET, ['tab' => 'today']))?>" class="tasks-switch__item <?=isset($tab['today']) ? 'tasks-switch__item--active' : ''?>">Повестка дня</a>
            <a href="?<?=http_build_query(array_merge($_GET, ['tab' => 'tomorrow']))?>" class="tasks-switch__item <?=isset($tab['tomorrow']) ? 'tasks-switch__item--active' : ''?>">Завтра</a>
            <a href="?<?=http_build_query(array_merge($_GET, ['tab' => 'expired']))?>" class="tasks-switch__item <?=isset($tab['expired']) ? 'tasks-switch__item--active' : ''?>">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда аттрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed"
                   type="checkbox" <?= $show_complete_tasks === 1 ? 'checked' : '' ?>>
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">
        <?php foreach ($tasks as $task) : ?>
            <?php if ($show_complete_tasks || !$task['status']) : ?>
                <tr class="tasks__item task <?= $task['status'] ? 'task--completed' : important_task($task['finish_date']) ?>">
                    <td class="task__select">
                        <label class="checkbox task__checkbox">
                            <input value="<?=$task['id']?>" type="checkbox" class="checkbox__input visually-hidden task__checkbox" <?= $task['status'] ? 'checked' : '' ?>>
                            <span class="checkbox__text"><?= $task['name']; ?></span>
                        </label>
                    </td>
                    <?php if ($task['file']): ?>
                        <td class="task__file">
                            <a class="download-link" target="_blank" href="<?=$task['file']?>"><?=$task['file_name']?></a>
                        </td>
                    <?php endif;?>
                    <td class="task__date"><?= $task['finish_date']; ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</main>