<?php
require_once 'config.php'; // Make sure config.php contains your database connection details

// Ensure 'task_id' is set in the URL and is numeric
if (isset($_GET['task_id']) && is_numeric($_GET['task_id'])) {
    // Sanitize and cast task_id to integer to avoid any invalid input
    $task_id = (int) $_GET['task_id'];

    // Prepare SQL query using a prepared statement to prevent SQL injection
    $stmt = $db->prepare("DELETE FROM `task` WHERE `task_id` = ?");
    
    // Bind the parameter
    $stmt->bind_param("i", $task_id);  // "i" means integer (task_id is expected to be an integer)

    // Execute the query
    if ($stmt->execute()) {
        // After deletion, redirect to index.php
        header("Location: index.php");
        exit(); // Ensure the script stops after the redirect
    } else {
        // If there was an error during execution
        die("Error deleting task: " . $stmt->error);
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Handle the case when 'task_id' is not set or is invalid
    die("Invalid task ID.");
}
?>
