<?php
function important_task($date)
{
    if (!$date || empty($date)) {
        return '';
    }
    $date = strtotime($date);
    $hours = floor(($date - time())/3600);
    return $hours <= 24 ? "task--important" : '';
}