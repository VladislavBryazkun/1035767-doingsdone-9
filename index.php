<?php
require_once('data.php');
require_once('function.php');
require_once('helpers.php');

    $main_content = include_template("index.php",
        [
            'project' => $project,
            'tasks' => $tasks,
            'show_complete_tasks' => $show_complete_tasks
        ]
    );

    $layout_content = include_template("layout.php",
        [
            "content" => $content,
            'title' => 'Дела впорядке',
            'my_name' => 'Владислав'
        ]
    );
print ($layout_content);
