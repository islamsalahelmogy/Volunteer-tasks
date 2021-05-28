<?php

    session_start();
    include('config.php');
    if (isset($_POST['createtask'])) {
        $name = $_POST['name'];
        $due_date = $_POST['due_date'];
        $volanteer_id=$_SESSION['user_id'];
        $status=$_POST['status'];
        $description=$_POST['description'];
    
        
              $query = $connection->prepare("INSERT INTO task(name,due_date,volanteer_id,status,description) VALUES (:name,:due_date,:volanteer_id,:status,:description)");
              $query->bindParam("name", $name, PDO::PARAM_STR);
              $query->bindParam("due_date", $due_date, PDO::PARAM_STR);
              $query->bindParam("volanteer_id", $volanteer_id, PDO::PARAM_STR);
              $query->bindParam("status", $status, PDO::PARAM_STR);
              $query->bindParam("description", $description, PDO::PARAM_STR);
              $result = $query->execute();
              if ($result) {
                $_SESSION['message']=' <p class="success">Task Created successfully!</p>';
                header('location: task.php ');
              } else {
                $message='<p class="error">Something went wrong!</p>';
              }

          }
        

?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <link href="assets/images/logo.png" rel="short icon">

    <title> Managing Volunteer Tasks </title>



    

    <!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/fontawesome.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link href="assets/css/chat.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow" >
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Dashboard</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  
</header>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 col-lg-2">
    <?php
           include('sidebar.php');
      ?>
    </div>
    
    <div class="col-sm-4 offset-sm-3">
      <h3 class=" text-center my-4">Create Task</h3>

     
      <form name="createtask" action="" method="post" class="">
                    <div class="form-group">
                      <input type="name" name="name" class="form-control searchText" id="name" aria-describedby="" placeholder="Task name">
                      
                    </div>
                    
                    <div class="form-group">
                      <input type="date" name="due_date" class="form-control searchText" id="due_date" aria-describedby="" placeholder="Due Date">
                      
                    </div>
                    <div class="form-group">
                      <input type="text" name="description" class="form-control searchText" id="description" aria-describedby="" placeholder="Description">
                      
                    </div>

                    <div class="form-group row ">
                        <div class="col-sm-4 offset-sm-4" >
                             <input id="still" type="radio" name="status" value="still"> <lable  for="still" style="padding-right:15px;">Still</lable>
                             <input id="done" type="radio" name="status" value="done"> <lable for="done">Done</lable>
                        </div>
                    
                    </div>
                    
                    
                    <div class="form-group row">

                    <div class="col-sm-4 offset-sm-4" >
                      <button type="submit" name="createtask" class="btn btn-success form-control"><a class="text-light">Create</a></button>
                      <?php

                            if(isset($message))
                            {
                            echo($message);
                            }  
                      
                      ?>
                    </div>


                    
                  </form>


      

    </div>
    </div>

  </div>
  

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="assets/js/dashboard.js"></script>
  </body>
</html>
