<?php
require_once('boot.php');

$content = include_template('index.php',
    [
        'projects' => $projects,
        'tasks' => $tasks,
        'show_complete_tasks' => $show_complete_tasks
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
