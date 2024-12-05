<?php
require 'config.php';

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    $date_completed = date('Y-m-d H:i:s');
    $query = "UPDATE `task` SET `status` = 'Done', `date_completed` = '$date_completed' WHERE `task_id` = $task_id";
    mysqli_query($db, $query) or die(mysqli_error($db));
    header('Location: index.php');
    exit();
}
?>
