<?php
    session_start();
    include('config.php');
        $task_id=$_SERVER['QUERY_STRING']; 
              $query = $connection->prepare("DELETE FROM task WHERE id=:task_id");
              $query->bindParam(":task_id", $task_id, PDO::PARAM_INT);
              $result = $query->execute();
              if ($result) {
                $_SESSION['message']=' <p class="success">Task Deleted successfully!</p>';
                header('location: task.php ');
              } else {
                $message='<p class="error">Something went wrong!</p>';
              }
        

?>