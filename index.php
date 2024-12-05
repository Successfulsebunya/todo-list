<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo List</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

  <div class="container">

  <nav>
    <a class="heading" href="#">To Do List</a>
  </nav>
    <div class="input-area">
      <form method="POST" action="add_task.php">
        <input type="text" name="task" placeholder="Write your tasks here..." required />
        <button class="btn" name="add">
          Add Task
        </button>
      </form>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Tasks</th>
          <th>Status</th>
          <th>Date Closed</th>
          <th>Action</th>
          
        </tr>
      </thead>
      <tbody>
        <?php
        $fetchingtasks = mysqli_query($db, "SELECT * FROM `task` ORDER BY `task_id` ASC") or die(mysqli_error($db));
        $count = 1;
        while ($fetch = $fetchingtasks->fetch_array()) {
        ?>
          <tr class="border-bottom">
            <td>
              <?php echo $count++; ?>
            </td>
            <td>
              <?php echo htmlspecialchars($fetch['task']); ?>
            </td>
            <td>
              <?php echo htmlspecialchars($fetch['status']); ?>
            </td>
            <td>
        <?php echo $fetch['status'] == 'Done' ? htmlspecialchars($fetch['date_completed']) : '—'; ?>
      </td>
            <td colspan="2" class="action">
              <?php if ($fetch['status'] != "Done") { ?>
                <a href="update_task.php?task_id=<?= $fetch['task_id'] ?>" class="btn-completed" title="Mark as Done">Done
                  
                </a>
                <a href="delete_task.php?task_id=<?= $fetch['task_id'] ?>" class="btn-remove" title="Delete">
                                Delete
                </a>
              <?php } else { ?>
                <a class="btn-completed disabled">Done</a>
                <a class="btn-remove disabled">Delete</a>
              <?php } ?>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>
