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
        <a class="nav-link" href="/newdental/alert.php">การแจ้งเตือน</a>
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
                  <th><a href='sent.php' class='btn btn-warning btn-sm' role='button' aria-pressed='true'>แจ้งเตือน</a></th>
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
                        echo "<td>" . $row["Customernum"]. "</td><td>" . $row["Fname"]. "</td><td>" . $row["Lname"]. "</td><td>" . $row["start"]. "</td><td>" . $row["Time"]. "</td><td>" . $row["Detail"]. "</td>";
                      
                                            
                        $postRequest = http_build_query([
                            'api_key' => "a51ccd23",
                            'api_secret' => "WDrGcDCuwkTYM43x",
                            'to' => $row["Phone"],
                            'from' => "Tien Dental",
                            'text' => '"รายละเอียด: '. $row["Detail"].'"วันที่: '. $row["start"].'"เวลา: '. $row["Time"].'"',
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



<?php


$postRequest = http_build_query([
        'api_key' => "a51ccd23",
        'api_secret' => "WDrGcDCuwkTYM43x",
        'to' => "66622425193",
        'from' => "Tien Dental",
        'text' => 'Hello from Nexmo',
        'type' => 'unicode'
]);
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


?>
