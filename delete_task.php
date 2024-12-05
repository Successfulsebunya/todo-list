<?php
require 'config.php';

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    $query = "DELETE FROM `task` WHERE `task_id` = $task_id AND `status` != 'Done'";
    mysqli_query($db, $query) or die(mysqli_error($db));
    header('Location: index.php');
    exit();
}
?>
