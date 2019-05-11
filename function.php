<?php
function countTasks($tasks, $task_name)
{
    $category_task = array_filter($tasks, function ($n) use ($task_name) {
        return $n['category'] == $task_name;
    }
    );
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