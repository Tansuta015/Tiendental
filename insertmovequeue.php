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

$BookID = $_REQUEST["BookID"];
$sql = "SELECT * FROM bookq WHERE BookID=$BookID";


// echo $sql;
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
// $time = $row["Date"];
$time = $row["Time"];

// echo "time" . $time . "<br>";
//$add_min = date("H:i:s", strtotime($time . "+30 minutes"));
//$add_min = date("H:i - H:i", strtotime($time . '+30 minutes'+ $time . '+30 minutes'));
$arr = (explode('-',$time));
//echo $arr[0];
//echo $arr[1];
$add_min1 = date("H:i", strtotime($arr[0] . '+45 minutes'));
$add_min2 = date("H:i", strtotime($arr[1] . '+45 minutes'));
$addresult = $add_min1 . '-' . $add_min2;
echo $add_min1;
echo $add_min2;
echo $addresult;
//$add_min = date("H:i:s", strtotime($time . "+30 minutes"));
// echo $add_min;
$sql = "UPDATE bookq SET Time = '$addresult' WHERE BookID=$BookID ";


if ($conn->query($sql) === TRUE) {
 //header( "location: http://localhost/newdental/movequeue.php");
 //echo "Record updated successfully";
 
} else {
     echo "Error updating record: " . $conn->error;
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
                      
                       ///echo "<td><a href='insertmovequeue.php?BookID=$row[0]' class='btn btn-warning' role='button' aria-pressed='true'>เลื่อนไปอีก 45 นาที</a></td> ";
                       
                                         
                       $postRequest = http_build_query([
                        'api_key' => "a51ccd23",
                        'api_secret' => "WDrGcDCuwkTYM43x",
                        'to' => $row["Phone"],
                        'from' => "Tien Dental",
                        'text' => '"'. $row["Detail"].'"'. $row["start"].'"'. $row["Time"].'"',
                        'type' => 'unicode'
                    ]);
                    echo $postRequest;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://rest.nexmo.com/sms/json?");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postRequest);
                    curl_setopt($ch, CURLOPT_POST, 1);

                    $headers = array();

                    $headers[] = "Content-Type: application/x-www-form-urlencoded";
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    $result = curl_exec($ch);
                    if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                    }
                    curl_close ($ch);


                    
                     
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
