<?php
require_once 'config.php'; // Ensure this file contains your database connection

// Check if 'task_id' is set and is numeric
if (isset($_GET['task_id']) && is_numeric($_GET['task_id'])) {
    $task_id = (int) $_GET['task_id']; // Cast to integer to ensure it's safe

    // Use a prepared statement to prevent SQL injection
    $stmt = $db->prepare("UPDATE `task` SET `status` = ? WHERE `task_id` = ?");
    $status = 'Done'; // The value we want to set for the status
    $stmt->bind_param("si", $status, $task_id); // "si" means string for status, integer for task_id

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to index.php if update was successful
        header('Location: index.php');
        exit(); // Make sure to stop further execution after the header
    } else {
        // Handle query failure
        die('Error updating task: ' . $stmt->error);
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Handle case when task_id is not set or not numeric
    die('Invalid task ID.');
}
?>
