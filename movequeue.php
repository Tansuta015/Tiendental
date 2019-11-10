<?php
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
<title>TIEN DENTAL</title>
    <!-- Required meta tags -->
    <head>
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
				#calendar{
					margin-top:10px;
				}
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
  
      <div class="container">

    <form name="insertmovequeue.php" method="POST">  
      <table class="table">
          <thead>
              <tr>
                  
                  <th>เลขสมาชิก</th>
                  <th>ชื่อ</th>
                  <th>นามสกุล</th>
                  <th>วันที่</th>
                  <th>เวลา</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
          <?php
                
                $sql = "SELECT * FROM bookq INNER JOIN customer 
                ON  bookq.CusID = customer.CusID 
                where Status ='0' AND start = CURDATE()" or die("Error:" . mysqli_error());
                $result1 = $conn->query($sql);

                if ($result1->num_rows > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_array($result1)) {
                        echo "<tr>";
                        echo "<td>" . $row["Customernum"]. "</td><td>" . $row["Fname"]. "</td><td>" . $row["Lname"]. "</td><td>" . $row["start"]. "</td><td>" . $row["Time"]. "</td>";
                      
                       echo "<td><a href='insertmovequeue.php?BookID=$row[0]' class='btn btn-warning' role='button' aria-pressed='true'>เลื่อนไปอีก 45 นาที</a></td> ";
                       
                      // echo "<td><a class='btn btn-warning' data-toggle='modal' data-target='#exampleModal'>
                      //   เลื่อนไปอีก 45 นาที
                      //   </a></td>";
 
                      //  echo' <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      //   <div class="modal-dialog" role="document">
                      //      <div class="modal-content">
                      //       <div class="modal-header">
                      //         <h5 class="modal-title" id="exampleModalLabel">ยืนยันการเลื่อนคิว</h5>
                      //         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      //       <span aria-hidden="true">&times;</span>
                      //       </button>
                      //      </div>
                      //       <div class="modal-body">
                      //         หากคุณยืนยันเวลาของคุณจะพวกเพิ่มไป 45 นาที
                      //      </div>
                      //       <div class="modal-footer">
                      //    <button class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                      //      <button  id="okbtn" onclick="okClick('. $row["BookID"].')" class="btn btn-danger" data-dismiss="modal" >ตกลง</button>
                      //     </div>
                      //    </div>
                      //    </div>
                      //   </div>';
                    
                     
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

  <script>
  // function okClick(rowId){
  //  // $('#exampleModal').modal('toggle')
  //   console.log("ok");
  //   window.location.href="insertmovequeue.php?BookID=" + rowId;
 
  // }
  </script>
  </body>
</html>