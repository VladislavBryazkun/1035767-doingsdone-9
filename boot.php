<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

$user_id = 1;
$user_name = 'Владислав';
date_default_timezone_set('Europe/Moscow');

define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('STATIC_DIR', DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR);

require_once('functions/helpers.php');
require_once('functions/tasks.php');
require_once('functions/database.php');

$projects = get_projects_by_user_id($user_id);
