<?php 
 include('config.php');
 session_start();
 $sqlquery = "SELECT task.* , volunteer.name as v_name FROM task , volunteer where task.volanteer_id = volunteer.id";
   $results = $connection->query($sqlquery);
   $tasks = [];
    if($results->rowCount() > 0){
      while( $row = $results->fetch(PDO::FETCH_ASSOC))
      {
		array_push($tasks,$row);
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
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">



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



      /* for calender */

		.monthly {
			box-shadow: 0 13px 40px rgba(0, 0, 0, 0.5);
			font-size: 1em;
		}
		
		.border-left-5 , .monthly-list-item:after {
			border-left: 5px solid;
		}
		 .monthly-list-item:after {
			text-align: center;
		}
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <link href="assets/css/calender.css" rel="stylesheet">
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
    
    <div class="col-md-9 col-lg-10 row p-0 m-0">

        <div class="d-inline-block col-lg-10 offset-lg-1 px-md-5 py-5">
			<div class="monthly" id="mycalendar"></div>
		</div>
    
	</div>

  

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/calender.js"></script>
	<script>
		var sampleEvents = {
			"monthly": [
				{
				"id": 1,
				"name": "Whole month event",
				"startdate": "2021-4-01",
				"enddate": "2021-4-12",
				"starttime": "12:00",
				"endtime": "2:00",
				"color": "#99CCCC",
				"url": ""
				},
				{
				"id": 2,
				"name": "Test encompasses month",
				"startdate": "2021-4-4",
				"enddate": "2021-4-15",
				"starttime": "12:00",
				"endtime": "2:00",
				"color": "#CC99CC",
				"url": ""
				},
				{
				"id": 3,
				"name": "Test single day",
				"startdate": "2021-4-17",
				"enddate": "",
				"starttime": "",
				"endtime": "",
				"color": "#666699",
				"url": "https://www.google.com/"
				},
				{
				"id": 8,
				"name": "Test single day",
				"startdate": "2021-5-05",
				"enddate": "",
				"starttime": "12:00",
				"endtime": "5:00",
				"color": "#666699",
				"url": "https://www.google.com/"
				},
				{
				"id": 4,
				"name": "Test single day with time",
				"startdate": "2021-5-07",
				"enddate": "",
				"starttime": "12:00",
				"endtime": "02:00",
				"color": "#996666",
				"url": ""
				},
				{
				"id": 5,
				"name": "Test splits month",
				"startdate": "2021-4-30",
				"enddate": "2021-5-6",
				"starttime": "12:00",
				"endtime": "5:00",
				"color": "#999999",
				"url": ""
				},
				{
				"id": 6,
				"name": "Test events on same day",
				"startdate": "2021-5-25",
				"enddate": "",
				"starttime": "",
				"endtime": "",
				"color": "#99CC99",
				"url": ""
				},
				{
				"id": 7,
				"name": "Test events on same day",
				"startdate": "2021-5-27",
				"enddate": "2021-5-30",
				"starttime": "",
				"endtime": "",
				"color": "#669966",
				"url": ""
				},
				{
				"id": 9,
				"name": "Test events on same day",
				"startdate": "2021-5-28",
				"enddate": "",
				"starttime": "",
				"endtime": "",
				"color": "#999966",
				"url": ""
				}
			]
		};
		console.log(sampleEvents.monthly);
		var events = {"monthly":[]};
		
		var list = <?php echo json_encode($tasks) ?> ;
		for(l of list) {
			if(l.status == "still"){
			l['color'] = "#df4759"
			} else {
				l["color"] = "#2d9d7b"
			}
			events.monthly.push(l);
			
		} 
		console.log(events.monthly);
		$(window).load( function() {
			
			
			$('#mycalendar').monthly({
				mode: 'event',
				dataType: 'json',
				events: events
			});
			// $(".monthly-event-indicator").on("click",(e) => {
			// 	console.log(e.currentTarget);
			// });

		});

	</script>

<!-- <script src="assets/js/dashboard.js"></script> -->
  </body>
</html>
