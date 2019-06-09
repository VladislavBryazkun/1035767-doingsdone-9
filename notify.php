<?php
require_once('vendor/autoload.php');


$transport = new Swift_SmtpTransport("phpdemo.ru", 25);
$transport->setUsername("keks@phpdemo.ru");
$transport->setPassword("htmlacademy");
$mailer = new Swift_Mailer($transport);


$tasks = get_today_tasks();

//var_dump($tasks);

if ($tasks) {
    foreach ($tasks as $task) {
        $message = new Swift_Message();
        $message->setSubject("Уведомление от сервиса «Дела в порядке»");
        $message->setFrom(['keks@phpdemo.ru' => 'DoingsDone 1']);
        var_dump($task);
        $message->setto($task['email']);
        $msg_content = include_template('email_message.php', ['tasks' => $task]);
        $message->setBody($msg_content, 'text/plain');
        $result = $mailer->send($message);
        var_dump($result);
        if ($result) {
            task_notify_update($task['id'], 1);
        }
    }
}


