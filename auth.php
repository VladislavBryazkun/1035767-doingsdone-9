<?php
require_once('boot.php');

if ($is_auth) {
    header("Location: /");
    exit();
}
$errors = [];
$fields = [];

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $required = ['password', 'email'];
    list($errors, $fields) = check_in_data($required);

    if (!isset($errors['email']) && !filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Не корректно введен email';
    }
    if (!isset($errors['email']) && !isset($errors['password'])) {
        $get_user = get_user_by_email($fields['email']);
        if (count($get_user) && password_verify($fields['password'], $get_user['password'])) {

            $_SESSION['user'] = ['id' => intval($get_user['id']), 'name' => $get_user['name']];
            header("Location: /");
            exit();
        }
        $errors['email'] = '';
        $errors['password'] = '';
        $errors['info'] = 'Вы ввели неверный email/пароль';
    }
}


$content = include_template('auth.php',
    [
        'errors' => $errors,
        'fields' => $fields
    ]
);

$layout = include_template('layout.php',
    [
        'content' => $content,
        'projects' => $projects,
        'title' => 'Регистрация аккаунта',
        'is_auth' => $is_auth,
    ]
);

print($layout);