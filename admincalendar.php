<?php
session_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienden1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8' />
			<link href='http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/fullcalendar.min.css'  rel='stylesheet' />
			<link href='http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/fullcalendar.print.css'  rel='stylesheet' media='print' />
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

			<!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
            
            <link rel="stylesheet" href="css/sidebar.css">
            <link rel="stylesheet" href="css/navbar.css">
            
            <style>
				#calendar{
					margin-top:10px;
				}
			</style>
	</head>
	<body>

    <nav class="navbar navbar-expand-md" style="background: #00bcd5; ">
    <img src="img/tooth.png" href="/newdental/home.php" width="50" height="45">

    
    <h2><a class="display-8" href="/newdental/home.php">TIEN DENTAL</a></h2>

</nav>
   
        <br><br>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
<!-- Button trigger modal New data-->
					
					
					<div id='calendar'></div>
				</div>
			</div>
		</div>
		<!-- Button trigger modal Edit data-->
        <span id="trigger_modal" data-toggle="modal" data-target="#calendar_modal"></span>

<!-- Modal For edit data-->
<div class="modal fade" id="calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
            <div id="get_calendar"></div>
    </div>
  </div>
</div>
<!-- Modal For new data-->
				<div class="modal fade" id="new_calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"></h4>
					  </div>
					  <div class="modal-body">
							<form id="new_calendar">
							 
             
<!-- ประเภทการรักษา -->
      
                <input type="hidden" name="new_calendar_form">
                <br>
							</form>
					  </div>
					  <div class="modal-footer">
							<button type="button" class="btn btn-primary" onclick="return new_calendar();">บันทึกข้อมูล</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
						
					  </div>
					</div>
				  </div>
				</div>
	
			
		<!-- Javascript -->
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		<script src='http://fullcalendar.io/js/fullcalendar-2.4.0/lib/moment.min.js'></script>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/fullcalendar.min.js'></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

     

        <!-- นำเข้า script File -->
        <script src='js/script.js'></script>	

        <script>
                   
                   
                    $('#datepicker').datepicker({
                       format:'yyyy-mm-dd'
                        // uiLibrary: 'bootstrap4'
                    });
                  
                   


                    // $('#timepicker').timepicker();

                    
                   
        </script>
	</body>
</html>