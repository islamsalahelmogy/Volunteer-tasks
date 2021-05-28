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
    
    <div class="col-md-9 col-lg-10">
      <h3 class=" text-center my-4">Tasks</h3>


      <div class="ml-3">
      <a class="btn btn-primary" href="createtask.php"><i class="fa fa-plus mr-1"></i> Create </a>
      </div>
     


      <div class="card my-3 ml-3">
      <?php
      
     
        include('config.php');
        session_start();
      $sql = "SELECT * FROM task";
                    if($result = $connection->query($sql)){
                     // var_dump($result->fetch());
                        if($result->rowCount() > 0){
                            
                                while($row = $result->fetch()){
                                  
                                  echo'<div class="card my-3 ml-3">';
                                  echo '<div class="card-header">'. $row['name'].'</div>';
                                   echo'<div class="card-body">';
                                    echo' <h5 class="card-title">'.$row['name'].'</h5><div class="my-3">Due to  :  '. $row['due_date'].'</div>';
                                      echo '<p class="card-text">'.$row['description'].'</p>';
                                      echo'</div>';
                              
                                      echo'<div class="card-footer">';
                                      if($row['volanteer_id']==$_SESSION['user_id'])
                                      {
                                        echo '<a class="btn btn-success mr-2" href="updatetask.php?'.$row['id'].'" id='.$row['id'].' ><i class="fa fa-edit mr-1"></i>Update</a>';
                                        echo'<a class="btn btn-danger" href="deletetask.php?'.$row['id'].'" id='.$row['id'].' ><i class="fa fa-close mr-1"></i>Delete</a>';
                                      }
                                      
                                    echo'</div>';  
                                    echo'</div>';
                                }
                          
                            // Free result set
                            unset($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close connection
                    unset($pdo);
                    ?>
        
      </div>

      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#">Previous</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
      </nav>

    </div>
    </div>

  </div>
  

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="assets/js/dashboard.js"></script>
  </body>
</html>
