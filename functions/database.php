<?php

function get_projects_by_user_id(int $user_id): array
{
    $link = DbConnection::getConnection();
    $query = "SELECT id, name FROM projects WHERE user_id=?";
    $projects = db_fetch_data($link, $query, [$user_id]);
    return $projects ?? [];
}

function get_tasks_by_user_id(int $user_id): array
{
    $link = DbConnection::getConnection();
    $query = "SELECT * FROM tasks WHERE user_id=?";
    $projects = db_fetch_data($link, $query, [$user_id]);
    return $projects ?? [];
}

