<?php
session_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienden1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// $conn2 = new mysqli($servername, $username, $password, $dbname);
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
  </head>
  <body>
  <nav class="navbar navbar-expand-md" style="background: #00bcd5; ">
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
      
      <div class="container">
      <form action="delqueueI.php" method="post">
      <table class="table">
          <thead>
              <tr>
                  <th>ลำดับคิว</th>
                  <th>เลขสมาชิก</th>
                  <th>วันที่</th>
                  <th>เวลา</th>
                  <!-- <th>ประเภทการจอง</th> -->
                  <th></th>
              </tr>
          </thead>
          <tbody>
          <?php
            //  echo  $_SESSION['UserID'];
            //  echo 'ssssss';
            $sql = "SELECT *  FROM bookq INNER JOIN customer 
                    ON  bookqueue.CusID = customer.CusID
                    where Status ='0'" or die("Error:" . mysqli_error());

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["BookID"]. "</td><td>" . $row["Customernum"]. "</td><td>" . $row["Date"]. "</td><td>" . $row["Time"]. "</td>";            
                        echo "<td><a href='delqueue.php?BookID=$row[0]' class='btn btn-danger  active' role='button' aria-pressed='true'>ยกเลิกการจอง</a></td> ";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>

          </tbody>
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
