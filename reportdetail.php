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
<!doctype html>
<html lang="en">
  <head>
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
  </head>
  <body>
  <nav class="navbar navbar-expand-md fixed-top" style="background: #00bcd5; ">
    <img src="img/tooth.png" href="/newdental/home.php" width="50" height="45">

    
    
    <h2><a class="display-8" href="/newdental/home.php">TIEN DENTAL</a></h2>


    <div class="collapse navbar-collapse" id="collapsibleNavbar"></div>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/newdental/searchname.php">เข้าสู่ระบบ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/newdental/movequeue.php">เลื่อนคิว</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/newdental/report.php">Report</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/newdental/singin.php">สมัครสมาชิก</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/newdental/admincalendar.php">ปฏิทิน</a>
      </li>
    </ul>
    </nav>
     
      <div class="container">
      <table class="table">
      
          <thead>
         
              <tr> 
              
                  <th>เลขสมาชิก</th>
                  <th>ชื่อ</th>
                  <th>นามสกุล</th>
                  <th>วันที่</th>
                  <th>เวลา</th>
                  <th>รายละเอียด</th>
              </tr>
              </div>
          </thead>
          <tbody>
          <?php
                

                $Customernum = $_REQUEST["Customernum"];
                $_SESSION['UserID'] = $Customernum;
                $sql = "SELECT *  FROM bookq INNER JOIN customer 
                ON  bookq.CusID = customer.CusID
                where Status ='0' AND BookID  = $Customernum";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        
                        echo "<tr>";
                     
                        echo "<td>" . $row["Customernum"]. "</td><td>" . $row["Fname"]. "</td><td>" . $row["Lname"]. "</td><td>" . $row["start"]. "</td><td>" . $row["Time"]. "</td><td>" . $row["Detail"]. "</td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                
                ?>


          </tbody>
          
      </table>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>