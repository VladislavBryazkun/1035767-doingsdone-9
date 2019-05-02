    <?php
        function countTasks($tasks, $task_name)
        {
            $category_task = array_filter($tasks, function ($n) use ($task_name) {
                return $n['category'] == $task_name;
            }
            );
            return count($category_task);
        }
        ;

    function date_work($date)
    {
        $ts = time();
        $task_date = strtotime($date);
        $ts_diff = $task_date - $ts;
        $sec_in_hour = 3600;
        if (($ts_diff / $sec_in_hour) <= 24 && $date != 'Нет') {
            return ("task--important");
        } else {
            return ('');
        }
    }
    ;