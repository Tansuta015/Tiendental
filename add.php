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
<html lang="en">
<title>TIEN DENTAL</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/navbar.css">
    <style>
				
                body {
                min-height: 75rem;
                padding-top: 3.9rem;
}
        </style>
  <body>
  
  <nav class="navbar navbar-expand-md fixed-top" style="background: #00bcd5; " data-spy="affix">
    <img src="img/tooth.png" href="/newdental/home.php" width="50" height="45">

    
    <h2><a class="display-8" href="/newdental/home.php">TIEN DENTAL</a></h2>
</nav>
    <div id="wrapper" class="toggled">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">

                <div class="sidebar-menu">
                    <ul>

                        <li class="sidebar-dropdown">
                            <a href="#">
                                <span>จัดการคิว</span>

                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                               <li>
                                        <a href="/newdental/calendar.php">จองคิว</a>
                                    </li>
                                  
                                </ul>
                            </div>
                        </li>

                        <!-- sidebar-menu  -->

                        <li> <a href="/newdental/appoints.php">ใบนัด</a> </li>
                        <li> <a href="/newdental/history.php">ประวัติการรักษา</a> </li>
                        
                        
                        <li> <a href="/newdental/home.php">ออกจากระบบ</a> </li>

                    </ul>
                </div> <!-- /#sidebar-wrapper -->

        </div> <!-- /#wrapper -->
        <br><br>
        <form action="insertadd.php" method="POST">
      <div class="container">
      <!-- date -->
      
      <div class="form-group col-md-3">
            <label for="input">วัน/เดือน/ปี :</label>
            
            <?php 
            $start = $_POST["start"];
            $_SESSION['start'] = $start;
            //echo $_SESSION['start'];
            //echo $start;
            //echo "<input type='text' name='start' class='form-control' value='$start'>";
            echo "<h2>$start</h2>";
            echo "<input type='hidden' name='start'  value='$start'>";
            ?>
                </div>
<div class="form-group">
			<form id="new_calendar">
				<div class="form-group">
             <label >เลขสมาชิก :</label>
           <?php 
          
          $Customernum = $_SESSION['UserID'];
          $_SESSION['UserID'] = $Customernum;
          
          $sql = "SELECT Customernum FROM customer WHERE CusID = $Customernum";
          $query = mysqli_query($conn,$sql);
          $row = mysqli_fetch_array($query);
          echo "<input type='text' name='mnumber' class='form-control' disabled='disabled' value='$row[0]'>";
      ?>
</div>
             
<!-- ประเภทการรักษา -->
      
       <div class="form-group">
                    <label for="input"  >ประเภทการรักษา :</label>
                    <select id="input" name="Type"  class="form-control">
                        <option selected  >โปรดระบุประเภทการรักษา</option>
                        <option >ทันตกรรมพื้นฐาน</option>
                        <option >ทันตกรรมเพื่อความงาม</option>
                        <option >ทันตกรรมโรคเหงือก</option>
                        <option >ทันตกรรมรากฟันเทียม</option>
                        <option >ทันตกรรมรักษารากฟัน</option>
                        <option >ทันตกรรมอื่นๆ</option>
                    </select>
                </div>
<!-- หมายเหตุ -->
        <div class="form-group">
        <label for="exampleFormControlTextarea1">หมายเหตุการรักษา :</label>
        <textarea class="form-control" name="Detail" id="exampleFormControlTextarea1" rows="5"></textarea>
        </div>
 

<!-- 
                <div class="form-group col-md-3">
                <label for="input">วันสิ้นสุด</label>
                <input id="datepicker1" name="end" width="250"  >
                </div> -->
<!-- time -->
               <br>
               <!-- <div class="form-group col-md-3">
                <label for="input"> เวลา :</label>
                <input id="timepicker" name="Time" width="250">
                </div> -->
               
       <!-- <div class="form-group">
                    <label for="input"  >เวลาการรักษา :</label>
                    <select id="input" name="Time"  class="form-control">
                    <option selected  >โปรดระบุเวลาการรักษา</option>
                                <option value="" disabled >จันทร์-ศุกร์</option>
                                <option value="17:00-17:45" >17:00-17:45</option>
                                <option value="17:45-18:30" >17:45-18:30</option>
                                <option value="18:30-19:15" >18:30-19:15</option>
                                <option value="19:15-20:00" >19:15-20:00</option>
                                <option value="" disabled >เสาร์-อาทิตย์</option>
                                <option value="9:00-9:45" >9:00-9:45</option>
                                <option value="9:45-10:30" >9:45-10:30</option>
                                <option value="10:30-11:15" >10:30-11:15</option>
                                <option value="11:15-12:00" >11:15-12:00</option>
                                <option value="13:00-13:45" >13:00-13:45</option>
                                <option value="13:45-14:30" >13:45-14:30</option>
                                <option value="14:30-15:15" >14:30-15:15</option>
                                <option value="15:15-16:00" >15:15-16:00</option>
                                <option value="16:00-16:45" >16:00-16:45</option>
                                <option value="16:45-17:30" >16:45-17:30</option>
                               
                    </select>
                </div> -->
                 <?php
                 $start = $_POST["start"];
                 $dayofweek = date('w', strtotime($start));
               // echo $dayofweek;
                $sql = "SELECT Time FROM bookq WHERE start='$start'";
                //$time = $row["Time"];
                //echo $sql;
                $query = mysqli_query($conn,$sql);
                $a = array();
                while($row = mysqli_fetch_array($query)){
                    $time = $row["Time"];  
                      
                    array_push($a, $time);
                    //print_r($a);
                 }
                
              // echo $time;
                
                // $arr = array("17:00-17:45","17:45-18:30","18:30-19:15","19:15-20:00",
                //            "9:00-9:45","9:45-10:30","10:30-11:15","11:15-12:00",
                //            "13:00-13:45","13:45-14:30","14:30-15:15","15:15-16:00",
                //            "16:00-16:45","16:45-17:30");

                $mon = array("17:00-17:45","17:45-18:30","18:30-19:15","19:15-20:00");

                $sat = array("9:00-9:45","9:45-10:30","10:30-11:15","11:15-12:00",
                           "13:00-13:45","13:45-14:30","14:30-15:15","15:15-16:00",
                           "16:00-16:45","16:45-17:30");
                           
                
                 //print_r ($arr);
                //print_r(array_splice($arr,1,13,$row["Time"]));
                if($dayofweek ==  0 ||$dayofweek == 6){
                    echo '<label for="input"  >เวลาการรักษา :</label>
                    <select id="input" name="Time"  class="form-control">
                    <option selected  >โปรดระบุเวลาการรักษา</option> 
                    <option value="" disabled >เสาร์-อาทิตย์</option>';
                    $arr=$sat;
                }else{
                    echo '<label for="input"  >เวลาการรักษา :</label>
                    <select id="input" name="Time"  class="form-control">
                    <option selected  >โปรดระบุเวลาการรักษา</option> 
                    <option value="" disabled >จันทร์-ศุกร์</option>';
                    $arr=$mon;
                }

               $mix = array_diff($arr,$a);

                // if (($key = array_search($a, $arr)) !== false) {
                //     unset($arr[$key]);
                //  }
               // print_r ($arr); 

               
                
                foreach ($mix as $value) {
                    
                    echo "<option value='$value'>$value</option>";
                    
                }
               echo '</select>';
                ?>

                 <input type="hidden" name="new_calendar_form">
                <br>
							</form>
					  </div>
					  <div class="modal-footer">
							<button type="submit" class="btn btn-primary"  >บันทึกข้อมูล</button>
							<!-- <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button> -->
						
					  </div>
					</div>
				  </div>
				</div>
                </form>
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

        </script>
</body>
</html>