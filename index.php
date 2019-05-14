<?php
require_once('boot.php');

if (isset($_GET['project_id']) && !empty($_GET['project_id'])) {
    $project_id = $_GET['project_id'];
    $project_ids = array_column($projects, 'id');

    if (!is_numeric($project_id) || !in_array($project_id, $project_ids)){
        http_response_code(404);
        die('<h1>404 Not Found</h1>');
    }
}

$tasks = isset($project_id) ? get_task_by_project($project_id) : get_tasks_by_user_id($user_id);

$content = include_template('index.php',
    [
        'projects' => $projects,
        'tasks' => $tasks,
        'show_complete_tasks' => $show_complete_tasks,
        'project_id' => $project_id
    ]
);

$layout_content = include_template('layout.php',
    [
        'content' => $content,
        'title' => 'Дела впорядке',
        'my_name' => 'Владислав'
    ]
);

print ($layout_content);
