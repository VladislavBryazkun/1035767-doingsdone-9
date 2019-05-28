<?php
require_once ('boot.php');

if (!$is_auth) {
    header("Location: /");
    exit();
}


$errors = [];
$task = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required = ['name', 'project_id', 'date'];
    list($errors, $task) = check_in_data($required);

    if (!isset($errors['project']))
    {
        if (!is_numeric($task['project_id']) || !check_available_project_id($task['project_id'], $projects)) {
            $errors['project_id'] = "Введен не коррктный проект!";
        }
    }

    check_date('date', $errors);

    if (!count($errors)) {
        if (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
            $task['file'] = upload_file('file',   'uploads');
            $task['file_name'] = $_FILES['file']['name'];
        }
        $task['user_id'] = $user['id'];
        $task_id = add_task($task);
        header("Location: /index.php");
    }

}

$content = include_template('add.php',
    [
        'projects' => $projects,
        'errors' => $errors,
        'task' => $task
    ]
);
$layout_content = include_template('layout.php',
    [
        'content' => $content,
        'projects' => $projects,
        'title' => 'Добавление задачи',
        'user' => $user,
        'is_auth' => $is_auth
    ]
);
print $layout_content;