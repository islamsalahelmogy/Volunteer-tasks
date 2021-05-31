 <?php 
  
   //session_start();

   $user_id=$_SESSION['user_id'];
   $sqlquery = "SELECT * FROM volunteer WHERE id=".$user_id;
   $results = $connection->query($sqlquery);
   $data = [];
    if($results->rowCount() > 0){
      while( $row = $results->fetch())
      {
          array_push($data,$row['name']);
          array_push($data,$row['email']);
      } 
    
  }


?> 


<nav id="sidebarMenu" class=" d-md-block bg-light sidebar collapse" style=" width: 224.83px;">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column ">
            <li class="nav-item" style="display:block;">
              <a class="nav-link ">
  
              <img src="assets/images/Asset 1@2x-50.jpg" width="80px" height="80px" style="border:1px solid black; display: block;" class="rounded-circle mx-auto">
              <div class="name text-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $data[0]; ?></div>
              <div class="email text-center"><?php echo $data[1]; ?></div>
  
              </a>
    
            </li>
  
            <hr style="width: 100%;background-color: black;opacity: 50%;">
            
            <li class="nav-item">
              <a class="nav-link" href="home.php">
                <span data-feather="home"></span>
                Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="inbox.php">
                <span data-feather="mail"></span>
                Inbox
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="task.php">
                <span data-feather="clipboard"></span>
                Tasks
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="logout.php">
                <span data-feather="log-out"></span>
                Logout
              </a>
            </li>
          </ul>
  
        
        </div>
      </nav>