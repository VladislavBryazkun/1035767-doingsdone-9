<?php
function important_task($date)
{
    if (!$date || empty($date)) {
        return '';
    }
    $date = strtotime($date);
    $hours = floor(($date - time())/3600);
    return $hours <= 24 ? "task--important" : '';
}

/**
 * Проверяет заполнены ли необходимые поля
 * @param array $required
 * @param array $current_array
 * @return array
 */
function check_in_data (array $required)
{
    $errors = [];
    $current_array = [];
    foreach ($required as $field) {
        if (isset($_POST[$field]) && !empty(trim($_POST[$field]))) {
            $current_array[$field] = trim($_POST[$field]);
        } else {
            $errors[$field] = 'Это поле необходимо заполнить';
        }
    }
    return [$errors, $current_array];
}

function check_available_project_id(int $id, array $projects): bool
{
    return in_array($id, array_column($projects, 'id'));
}

/**
 * Проверка соответствия даты
 * @param $key
 * @param $errors
 */
function check_date ($key, &$errors)
{
    if (!isset($errors[$key])) {
        if (!is_date_valid($_POST[$key])) {
            $errors[$key] = 'Дата не соответствует формату ГГГГ-ММ-ДД';
        } else if (strtotime($_POST[$key]) < strtotime('today')) {
            $errors[$key] = 'Дата должна быть больше или равна текущей';
        }
    }
}