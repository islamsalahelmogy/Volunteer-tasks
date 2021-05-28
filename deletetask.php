<?php

    session_start();
    include('config.php');
    if (isset($_POST['deletetask'])) {
        $name = $_POST['name'];
        $due_date = $_POST['due_date'];
        $status=$_POST['status'];
        $description=$_POST['description'];
        $task_id=$_SERVER['QUERY_STRING'];
        
        
              $query = $connection->prepare("UPDATE task SET name=:name, due_date=:due_date, status=:status
               ,description=:description WHERE id=:task_id");
              $query->bindParam(":name", $name, PDO::PARAM_STR);
              $query->bindParam(":due_date", $due_date, PDO::PARAM_STR);
              $query->bindParam(":status", $status, PDO::PARAM_STR);
              $query->bindParam(":description", $description, PDO::PARAM_STR);
              $query->bindParam(":task_id", $task_id, PDO::PARAM_INT);
              $result = $query->execute();
              if ($result) {
                $_SESSION['message']=' <p class="success">Task Updated successfully!</p>';
                header('location: task.php ');
              } else {
                $message='<p class="error">Something went wrong!</p>';
              }

          }
        

?>