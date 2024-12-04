<!DOCTYPE html>
<html lang="en">

<head>
  <title>Todo List</title>
  <link rel="stylesheet" 
          type="text/css" href="style.css" />
</head>

<body>
  <nav>
    <a class="heading" href="#">ToDo App</a>
  </nav>
  <div class="container">
    <div class="input-area">
      <form method="POST" action="add_task.php">
        <input type="text" name="task" 
                 placeholder="write your tasks here..." required />
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
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
                require 'config.php';
                $fetchingtasks = 
mysqli_query($db, "SELECT * FROM `task` ORDER BY `task_id` ASC")
or die(mysqli_error($db));
                $count = 1;
                while ($fetch = $fetchingtasks->fetch_array()) {
                    ?>
        <tr class="border-bottom">
          <td>
            <?php echo $count++ ?>
          </td>
          <td>
            <?php echo $fetch['task'] ?>
          </td>
          <td>
            <?php echo $fetch['status'] ?>
          </td>
          <td colspan="2" class="action">
            <?php
                if ($fetch['status'] != "Done")
                {
                    echo
'<a href="update_task.php?task_id=' . $fetch['task_id'] . '" 
class="btn-completed"></a>';
                }
            ?>
            <a href=
"delete_task.php?task_id=<?php echo $fetch['task_id'] ?>" 
               class="btn-remove">
              
            </a>
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