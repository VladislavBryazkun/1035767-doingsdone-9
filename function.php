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

 /*   function date_work($date)
    {
        $ts = time();
        $task_date = strtotime($date);
        $ts_diff = floor($task_date - $ts);
        $sec_in_hour = 3600;
        if (($ts_diff / $sec_in_hour) <= 24) {
            return ("task--important");
        } else {
            return (" ");
        }
    }
    ;
 */
    function important_task($task)
    {
        $sec_in_day = 86400;
        $ts = time();
         if ($task == "Нет") {
            return "Нет";
        } elseif ($task !== "Нет" && strtotime($task) - $ts <= $sec_in_day) {
            return "task--important";
        }
        return "";
    }
    ;

