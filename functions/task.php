<?php
function countTasks($tasks, $project_id)
{
    $category_task = array_filter($tasks, function ($n) use ($project_id) {
        return $n['project_id'] == $project_id;
    });

    return count($category_task);
}

function important_task($date)
{
    if (!$date || empty($date)) {
        return '';
    }
    $date = strtotime($date);
    $hours = floor(($date - time())/3600);
    return $hours <= 24 ? "task--important" : '';
}