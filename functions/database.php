<?php

function get_projects_by_user_id(int $user_id): array
{
    $link = DbConnection::getConnection();
    $query = "SELECT projects.id, projects.name, count(tasks.id) as count 
              FROM projects JOIN tasks ON projects.id = tasks.project_id
              WHERE projects.user_id=? 
              GROUP BY projects.id, projects.name";
    $projects = db_fetch_data($link, $query, [$user_id]);
    return $projects ?? [];
}

function get_tasks_by_user_id(int $user_id): array
{
    $link = DbConnection::getConnection();
    $query = "SELECT * FROM tasks WHERE user_id=?";
    $projects = db_fetch_data($link, $query, [$user_id]);
    return $projects ?? [];
}

function get_task_by_project(int $project_id): array
{
    $link = DbConnection::getConnection();
    $query = "SELECT * FROM tasks WHERE project_id=?";
    $projects = db_fetch_data($link, $query, [$project_id]);
    return $projects ?? [];
}

function add_task(array $task): int
{
    $link = DbConnection::getConnection();
    $query = "INSERT INTO tasks (name, finish_date, project_id, user_id, file, file_name) VALUES (?, ?, ?, ?, ?, ?)";
    $id = db_insert_data($link, $query, [
        $task['name'],
        $task['date'],
        $task['project_id'],
        $task['user_id'],
        $task['file'] ?? '',
        $task['file_name'] ?? ''
    ]);
    return $id;
}

/**
 * Возвращает пользователя с запрашиваемым email,
 * если такой не найден возвращает пустой массив
 * @param string $email
 * @return array
 */
function get_user_by_email (string $email): array
{
    $link = DbConnection::getConnection();
    $query = "SELECT * FROM users WHERE email=?";
    $user = db_fetch_data($link, $query, [$email]);

    return $user[0] ?? [];

}


function create_user (array $users)
{
    $link = DbConnection::getConnection();
    $query = "INSERT INTO users (email, name, password) VALUES (?, ?, ?)";
    db_insert_data($link, $query, [
        $users['email'],
        $users['name'],
        $users['password']
    ]);
}
