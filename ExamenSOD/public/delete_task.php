<?php
require_once '../classes/Auth.php';
require_once '../classes/Task.php';

Auth::check();
$task = new Task();

if (isset($_GET['id'])) {
    $taak = $task->getById($_GET['id']);
    if ($taak && $taak['gebruiker_id'] == $_SESSION['user_id']) {
        $task->delete($_GET['id']);
    }
}

header("Location: dashboard.php");
exit;
