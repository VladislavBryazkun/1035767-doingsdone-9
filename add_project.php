<?php
require_once('boot.php');

if (!$is_auth) {
    header("Location: /");
    exit();
}

$errors = [];
$fields = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required = ['name'];
    list($errors, $fields) = check_in_data($required);

    if (!isset($errors['name'])) {
        if (check_available_project_name($fields['name'], $projects)) {
            $errors['name'] = "Проект с данным названием уже существует!";
        }
    }
    if (!count($errors)) {
        $id = add_project($user['id'], $fields['name']);

        if ($id) {
            header("Location: /?project_id=" . $id);
        }
    }
}


$content = include_template('add_project.php',
    [
        'errors' => $errors,
    ]
);

$layout_content = include_template('layout.php',
    [
        'content' => $content,
        'projects' => $projects,
        'title' => 'Добавление проекта',
        'user' => $user,
        'is_auth' => $is_auth
    ]
);
print $layout_content;