<?php
require_once('boot.php');

$content = include_template('guest.php', []);
$params = $_GET;

if ($is_auth) {
    if (isset($_GET['tab'])) {
        $tab = $_GET['tab'];
        $tabs = ['today', 'tomorrow', 'expired'];
        $tablet[in_array($tab, $tabs) ? $tab : 'all'] = '';
    }

    if (isset($_GET['check']) && isset($_GET['task_id'])) {
        $status = boolval($_GET["check"]);
        $task_id = intval($_GET["task_id"]);
        $task = get_task_by_task_id($task_id);

        if (!empty($task) && $user['id'] === intval($task['user_id'])) {
            task_status_update($task_id, $status ? 1 : 0);
        }
        unset($params['check']);
        unset($params['task_id']);
    }


    if (isset($_GET['project_id']) && !empty($_GET['project_id']) && is_numeric($_GET['project_id'])) {
        $project_id = intval($_GET['project_id']);
        $project_ids = array_column($projects, 'id');

        if (!is_numeric($project_id) || !check_available_project_id($project_id, $projects)) {
            http_response_code(404);
            die('<h1>404 Not Found</h1>');
        }
    }

    $search_text = isset($_GET['search']) ? trim($_GET['search']) : '';

    $tasks = get_tasks_by_user_id(
        $user['id'],
        $project_id ?? 0,
        !empty($search_text) ? $search_text : '',
        $tab ?? ''
    );


    $content = include_template('index.php',
        [
            'tasks' => $tasks,
            'search' => $search_text,
            'show_complete_tasks' => $show_complete_tasks,
            'tab' => $tablet ?? [],
            'tabs_urls' => [
                'all' => http_build_query(array_merge($params, ['tab' => 'all'])),
                'today' => http_build_query(array_merge($params, ['tab' => 'today'])),
                'tomorrow' => http_build_query(array_merge($params, ['tab' => 'tomorrow'])),
                'expired' => http_build_query(array_merge($params, ['tab' => 'expired'])),
            ]
        ]
    );

}


$layout_content = include_template('layout.php',
    [
        'content' => $content,
        'projects' => $projects,
        'project_id' => $project_id ?? 0,
        'title' => 'Дела впорядке',
        'user' => $user,
        'is_auth' => $is_auth
    ]
);

print ($layout_content);
