<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $task = mysqli_real_escape_string($db, $_POST['task']);
    $query = "INSERT INTO `task` (`task`, `status`) VALUES ('$task', 'Pending')";
    mysqli_query($db, $query) or die(mysqli_error($db));
    header('Location: index.php');
    exit();
}
?>
