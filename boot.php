<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

date_default_timezone_set('Europe/Moscow');

define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('STATIC_DIR', DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR);

require_once('functions/helpers.php');
require_once('functions/task.php');
require_once('functions/database.php');

$projects = get_projects_by_user_id(1);
$tasks = get_tasks_by_user_id(1);

