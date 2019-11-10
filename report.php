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

ini_set('display_errors', 1);
error_reporting(~0);
$strKeyword = null;
if(isset($_POST["txtKeyword"]))
{
    $strKeyword = $_POST["txtKeyword"];
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
        <a class="nav-link" href="/newdental/search.php">เข้าสู่ระบบ</a>
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

      <form name="frmSearch" method="POST" action="<?php echo $_SERVER['SCRIPT_NAME'];?>"> 
      <div class="container">
      <br>
      <br>
      <div class="text-center">
       <h2>ค้นหา</h2>
       </div>
<br>
      <table class="table">
          <thead>
              <tr>
                  <th>เลขสมาชิก</th>
                  <th>ชื่อ</th>
                  <th>นามสกุล</th>
                  <th>ประเภทการรักษา</th>
                  <th>วันที่</th>
                  <th>เวลา</th>
                  <th>รายละเอียด</th>
                  <th></th>

              </tr>
          </thead>
          <tbody>

          <?php
            $sql = "SELECT *  FROM bookq INNER JOIN customer 
            ON  bookq.CusID = customer.CusID
            where Status ='0'  AND Fname LIKE '%".$strKeyword."%' AND start = CURDATE()";
            
           $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["Customernum"]. "</td><td>" . $row["Fname"]. "</td><td>" . $row["Lname"]. "</td><td>". $row["Type"]. "</td><td>". $row["Time"]. "</td><td>" . $row["start"]. "</td>";
                      
                       echo "<td><a href='reportdetail.php?Customernum=$row[0]' class='btn btn-warning' role='button' aria-pressed='true'>รายละเอียด</a></td> ";
                       
                       echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();

          ?>
         
      
          </tbody>
          <div class="text-center">
        <label for="uname" ><b>ชื่อ :</b></label>
      
        <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>">
    </div>
        
    <br>
    
    <div class="text-center">
    <input type="submit" class="btn btn-success " role="button" value="Search"></th>
    <br>
    <br><br>
    </div>
      </table>
      </form>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>