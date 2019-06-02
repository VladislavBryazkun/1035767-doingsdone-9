<?php
require_once('boot.php');
$errors = [];
$fields = [];

if ($is_auth) {
    header("Location: /");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $required = ['name', 'password', 'email'];
    list($errors, $fields) = check_in_data($required);



    if (!isset($errors['email']) && !filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Не корректно введен email';
    }


    if (!isset($errors['email'])) {
        $user = get_user_by_email($fields['email']);
        if (count($user)) {
            $errors['email'] = 'Указанный email уже используется другим пользователем';
        }
    }

    if (!isset($errors['password']) && strlen($fields['password']) < 6) {
        $errors['password'] = 'Пароль должен быть не менне 6 символов';
    }


    if (empty($errors)) {

        //3. тут нужно с помощью функции password_hash получить хеш пароля, так как небезопасно хранить его в бд в открытом виде
        $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);
        //4. function create_user(array $user_data)
        create_user($fields);

        header("Location: /");

    }
}

$content = include_template('register.php', [
    'errors' => $errors,
    'fields' => $fields,
]);


$layout = include_template('layout.php',
    [
        'content' => $content,
        'projects' => $projects,
        'title' => 'Регистрация аккаунта',
        'is_auth' => $is_auth
    ]
);

print($layout);