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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/navbar.css">
  </head>
  <body>
  <nav class="navbar navbar-expand-md" style="background: #00bcd5; ">
    <img src="img/tooth.png" href="/newdental/home.php" width="50" height="45">

    
    <h2><a class="display-8" href="/newdental/home.php">TIEN DENTAL</a></h2>
</nav>

      <form name="frmSearch" method="POST" action="<?php echo $_SERVER['SCRIPT_NAME'];?>"> 
      <div class="container">
            
            
            <div class="text-center">
       <h2>ค้นหา</h2></div>
   
       <table class="table">
          <thead>
              <tr>
              <th>เลขสมาชิก</th>
                  <th>ชื่อ</th>
                  <th>นามสกุล</th>
                  <th>เพศ</th>
                  <th>อายุ</th>
                  
              </tr>
          </thead>
   </div>
   <tbody>
          <?php
         
           

                $sql = "SELECT * FROM customer WHERE Fname LIKE '%".$strKeyword."%'";
                $query = mysqli_query($conn,$sql);
               

               
                    // output data of each row
                    while($row = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $row["Customernum"]. "</td><td>" . $row["Fname"]. "</td><td>" . $row["Lname"]. "</td><td>" . $row["Sex"]. "</td><td>" . $row["Age"]. "</td>";
                        echo "<td><a href='calendar.php?Customernum=$row[0]' class='btn btn-warning' role='button' aria-pressed='true'>เลือก</a></td> ";
                        echo "</tr>";
                       
                    }

                $conn->close();
                ?>

          </tbody>
         
   <br>
   <div class="text-center">
        <label for="uname" ><b>ชื่อ/นามสกุล :</b></label>
        <!-- <b><input type="text" placeholder="กรอกชื่อ/นามสกุล" name="uname" required></b> -->
        
        <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>">
    </div>
        
    <br>
    
    <div class="text-center">
    <input type="submit" class="btn btn-success " role="button" value="Search"></th>
    <br>
            <!-- <a href="/dental/searchname.php" type="submit" class="btn btn-success " role="button">ค้นหา</a> -->
    </div>


    </form>
            </div>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
  
  <script>
  
  </script>
  
  
  
  </body>
  
</html>