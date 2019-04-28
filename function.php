<?php
    function countTasks($tasks, $task_name)
    {
        $category_task = array_filter($tasks, function ($n) use ($task_name) {
            return $n['category'] == $task_name;
        }
        );
        return count($category_task);
    }