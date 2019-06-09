<?php
function get_projects_by_user_id(int $user_id): array
{
    $link = DbConnection::getConnection();
    $query = "SELECT projects.id, projects.name, count(tasks.id) as count 
              FROM projects LEFT JOIN tasks ON projects.id = tasks.project_id
              WHERE projects.user_id=? 
              GROUP BY projects.id, projects.name";
    $projects = db_fetch_data($link, $query, [$user_id]);
    return $projects ?? [];
}

/**
 * Получаем проект по ID пользователя, по различным фильтрам (Проект, по продолжительности и по строке поиска)
 * @param int $user_id
 * @param int $project_id
 * @param string $search_query
 * @param string $tab
 * @return array
 */
function get_tasks_by_user_id(int $user_id, int $project_id = 0, string $search_query = '', string $tab = ''): array
{
    switch ($tab) {
        case "today":
            $where = " = CURRENT_DATE";
            break;
        case "tomorrow":
            $where = " = DATE_ADD(CURRENT_DATE, INTERVAL 1 DAY)";
            break;
        case "expired":
            $where = " < CURRENT_DATE";
            break;
    }
    $where_query = isset($where) ? " AND finish_date" . "{$where}" : '';

    if ($project_id !== 0) {
        $where_query .= " AND project_id={$project_id}";
    }



    $link = DbConnection::getConnection();
    if (!empty($search_query)) {
        $where_query .= " AND MATCH (name) AGAINST ('".mysqli_real_escape_string($link, $search_query)."')";
    }
    $query = "SELECT * FROM tasks WHERE user_id=? ".$where_query;
    $projects = db_fetch_data($link, $query, [$user_id]);
    return $projects ?? [];
}


/**
 * @param int $task_id
 * @return array
 */
function get_task_by_task_id(int $task_id): array
{
    $link = DbConnection::getConnection();
    $query = "SELECT * FROM tasks WHERE id=?";
    $task = db_fetch_data($link, $query, [$task_id]);
    return $task[0] ?? [];
}

/**
 * @param int $task_id
 * @param int $status
 */
function task_status_update(int $task_id, int $status)
{
    $link = DbConnection::getConnection();
    $query = "UPDATE tasks SET status=? WHERE id=?";
    $stmt = db_get_prepare_stmt($link, $query, [$status, $task_id]);
    mysqli_stmt_execute($stmt);
}

/**
 * @param int $project_id
 * @return array
 */
function get_task_by_project(int $project_id): array
{
    $link = DbConnection::getConnection();
    $query = "SELECT * FROM tasks WHERE project_id=?";
    $projects = db_fetch_data($link, $query, [$project_id]);
    return $projects ?? [];
}

/**
 * @param array $task
 * @return int
 */
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
 * @param int $user_id
 * @param string $name
 * @return int
 */
function add_project(int $user_id, string $name): int
{
    $link = DbConnection::getConnection();
    $query = "INSERT INTO projects (name, user_id) VALUES (?, ?)";
    $id = db_insert_data($link, $query, [$name, $user_id]);
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
