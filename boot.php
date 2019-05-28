<?php
session_start();
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);


$show_complete_tasks = rand(0, 1);
$is_auth = false;
$user = [];

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $is_auth = true;
}

date_default_timezone_set('Europe/Moscow');

define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('STATIC_DIR', DIRECTORY_SEPARATOR . 'static' . DIRECTORY_SEPARATOR);

require_once('functions/helpers.php');
require_once('functions/tasks.php');
require_once('functions/database.php');


$projects = $is_auth ? get_projects_by_user_id($user['id']) : [];
