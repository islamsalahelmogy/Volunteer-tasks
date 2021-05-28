<?php
    session_start();
    include('config.php');
    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $is_admin = 'user';
        $password = $_POST['password'];
        if($password!=$_POST['confirmpassword']){
          $confirm_message='pasword not match password confirmation';
          //echo('pasword not match password confirmation');
        }
        else{
          $password_hash = password_hash($password, PASSWORD_BCRYPT);
          $query = $connection->prepare("SELECT * FROM volunteer WHERE email=:email");
          $query->bindParam("email", $email, PDO::PARAM_STR);
          $query->execute();
          if ($query->rowCount() > 0) {
              $email_message= '<p class="error">The email address is already registered!</p>';
          }
          if ($query->rowCount() == 0) {
              $query = $connection->prepare("INSERT INTO volunteer(name,password,email,is_admin) VALUES (:name,:password_hash,:email,:is_admin)");
              $query->bindParam("name", $name, PDO::PARAM_STR);
              $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
              $query->bindParam("email", $email, PDO::PARAM_STR);
              $query->bindParam("is_admin", $is_admin, PDO::PARAM_STR);
              $result = $query->execute();
              if ($result) {
                $_SESSION['message']=' <p class="success">Your registration was successful!</p>';
                header('location: index.php ');
                

              } else {
                $message='<p class="error">Something went wrong!</p>';
              }

          }
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <link href="assets/images/logo.png" rel="short icon">

    <title> Managing Volunteer Tasks </title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-host-cloud.css">
    <link rel="stylesheet" href="assets/css/owl.css">
<!--

Host Cloud Template

https://templatemo.com/tm-541-host-cloud

-->
  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.html"><h2>Manageing <em> Volunteer Tasks</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
             
              <li class="nav-item active">
                <a class="nav-link" href="index.html">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Team</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="about.html">About Us</a>
              </li>
              
              <!-- <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li> -->
            </ul>
          </div>
          <div class="functional-buttons">
            <ul>
              <li><a href="index.php">Login</a></li>
              <li><a href="register.php">Sign Up</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner" id="login">
      <div class="container">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            
             <div id="search-section" class="header-text caption">

             <?php
                 
                
                if(isset($message))
                {
                  echo($message);
                }
                
             ?>

                  <form name="register" action="" method="post">
                    <div class="form-group">
                      <input type="name" name="name" class="form-control searchText" id="name" aria-describedby="emailHelp" placeholder="Enter name">
                      
                    </div>
                    <div class="form-group">
                        <input type="email"name="email" class="form-control searchText" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        
                        <?php
                         if(isset($email_message)){
                           echo($email_message);
                         }
                         
                         ?>
                      </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control searchText" id="Password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirmpassword" class="form-control searchText" id="confirmpassword" placeholder="Confirm Password">
                         <?php
                         if(isset($confirm_message)){
                           echo($confirm_message);
                         }
                         
                         ?>
                      </div>

                    <div class="form-group ">
                      <button type="submit" name="signup" class="btn btn-primary form-control" style="width: 30%;"><a class="text-light">Signup</a></button>
                    </div>
                    
                  </form>

             </div>
           
          
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <!-- Trusted Starts Here -->
    <!-- <div class="trusted-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="trusted-section-heading">
              <h4>Volunteering has a great benefit on society</h4>
            </div>
          </div>
          <div class="col-md-12">
            <div class="owl-trusted owl-carousel">
              <div class="trusted-item">
                <img src="assets/images/logo.png" alt="trusted 1">
              </div>
              <div class="trusted-item">
                <img src="assets/images/logo.png" alt="trusted 2">
              </div>
              <div class="trusted-item">
                <img src="assets/images/logo.png" alt="trusted 3">
              </div>
              <div class="trusted-item">
                <img src="assets/images/logo.png" alt="trusted 4">
              </div>
              <div class="trusted-item">
                <img src="assets/images/logo.png" alt="trusted 5">
              </div>
              <div class="trusted-item">
                <img src="assets/images/logo.png" alt="trusted 6">
              </div>
              <div class="trusted-item">
                <img src="assets/images/logo.png" alt="trusted 7">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- Trusted Ends Here -->


    <!-- Services Starts Here -->
    <div class="services-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <span>Services</span>
              <h2>Services we provide</h2>
              <p>Each Employee in the campaign has a Task that he carries out within a full month and he must enter the site to see the latest coordinates that the campaign manager has set for each employee and for the campaign..</p>
            </div>
          </div>
         
          </div>
        </div>
      </div>
    </div>
    <!-- Services Ends Here -->


    

    <!-- Footer Starts Here -->
    <footer>
      <div class="container">
        <div class="row">
          <!-- <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="footer-item">
              <div class="footer-heading">
                <h2>About Us</h2>
              </div>
              <p>Each Employee in the campaign has a Task that he carries out within a full month and he must enter the site to see the latest coordinates that the campaign manager has set for each employee and for the campaign.</p>
            </div>
          </div>
          
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="footer-item">
              <div class="footer-heading">
                <h2>Audiance</h2>
              </div>
              <ul class="footer-list">
                <li><a href="#">Geography is Kuwait.</a></li>
                <li><a href="#">Educational level is average</a></li>
                <li><a href="#">youth category</a></li>
              </ul>
            </div>
          </div>
          
          
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="footer-item">
              <div class="footer-heading">
                <h2>Useful Links</h2>
              </div>
              <ul class="footer-list">
                <li><a href="#">Cloud Hosting Platform</a></li>
                <li><a href="#">Light Speed Zone</a></li>
                <li><a href="#">Content Delivery Network</a></li>
                <li><a href="#">Customer Support</a></li>
                <li><a href="#">Latest News</a></li>
              </ul>
            </div>
          </div>
          
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="footer-item">
              <div class="footer-heading">
                <h2>More Information</h2>
              </div>
              <ul class="footer-list">
                <li>Phone: <a href="#">010-020-0560</a></li>
                <li>Email: <a href="#">mail@company.com</a></li>
                <li>Support: <a href="#">support@company.com</a></li>
                <li>Website: <a href="#">www.company.com</a></li>
              </ul>
            </div>
          </div> -->
          <div class="col-md-12">
            <div class="sub-footer">
              <p>Copyright &copy; 2021 Managing Volunteer Tasks Team 
				- Designed by <a rel="nofollow" href="#">..</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Ends Here -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/accordions.js"></script>


    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>

  </body>
</html>