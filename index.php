<?php
require_once('boot.php');

if (!$is_auth) {
    $content = include_template('guest.php', []);
} else {

    if (isset($_GET['tab'])) {
        $tab = $_GET['tab'];
        $tabs = ['today', 'tomorrow', 'expired'];
        $tablet[in_array($tab, $tabs) ? $tab : 'all'] = '';
    }

    if (isset($_GET['check']) && isset($_GET['task_id'])) {
        $status = boolval($_GET["check"]);
        $task_id = intval($_GET["task_id"]);

        if ($task_id != 0) {
            $task = get_task_by_task_id($task_id);
            if ($user['id'] !== intval($task['user_id'])) {
                http_response_code(404);
                die('<h1>404 Not Found</h1>');
            }

            task_status_update($task_id, $status ? 1 : 0);
        }
    }


    if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
        $project_id = $_GET['project_id'];
        $project_ids = array_column($projects, 'id');

        if (!is_numeric($project_id) || !check_available_project_id($project_id, $projects)){
            http_response_code(404);
            die('<h1>404 Not Found</h1>');
        }
    }

    $tasks = isset($project_id) ? get_task_by_project($project_id) : get_tasks_by_user_id($user['id'], $tab ?? '');



    $content = include_template('index.php',
        [
            'tasks' => $tasks,
            'show_complete_tasks' => $show_complete_tasks,
            'tab' => $tablet ?? [] ,
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
