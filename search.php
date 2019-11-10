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

$query=mysqli_query($conn,"SELECT COUNT(CusID) FROM customer WHERE Fname LIKE '%".$strKeyword."%'");

$row = mysqli_fetch_row($query);
$rows = $row[0];
$page_rows = 10;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 
$last = ceil($rows/$page_rows);
if($last < 1){
$last = 1;
}
$pagenum = 1;
if(isset($_GET['pn'])){
$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
if ($pagenum < 1) {
$pagenum = 1;
}
else if ($pagenum > $last) {
$pagenum = $last;
}
$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
$nquery = mysqli_query($conn,"SELECT * from  customer WHERE Fname LIKE '%".$strKeyword."%' ORDER BY CusID DESC $limit  ");
$paginationCtrls = '';
if($last != 1){
if ($pagenum > 1) {
$previous = $pagenum - 1;
$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-info">Previous</a> &nbsp; &nbsp; ';
for($i = $pagenum-4; $i < $pagenum; $i++){
if($i > 0){
$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
}
}
}
$paginationCtrls .= ''.$pagenum.' &nbsp; ';
for($i = $pagenum+1; $i <= $last; $i++){
$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-primary">'.$i.'</a> &nbsp; ';
if($i >= $pagenum+4){
break;
}
}
if ($pagenum != $last) {
$next = $pagenum + 1;
$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-info">Next</a> ';
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
<link href="css/cite.css" rel="stylesheet">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Add jQuery library -->
<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>




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

                    <?php @$num++;?>

                <?php


                        while($crow = mysqli_fetch_array($nquery)) {
                        echo "<tr>";
                        echo "<td>" . $crow["Customernum"]. "</td><td>" . $crow["Fname"]. "</td><td>" . $crow["Lname"]. "</td><td>" . $crow["Sex"]. "</td><td>" . $crow["Age"]. "</td>";
                        echo "<td><a href='calendar.php?Customernum=$crow[0]' class='btn btn-warning' role='button' aria-pressed='true'>เลือก</a></td> ";
                        echo "</tr>";
                       
                    }


                ?>



</tbody>
</table> 

<center>
<div id="pagination_controls">
    <?php 
    echo $paginationCtrls; 
    
    ?>
    <br>
</div>
</center>
</form>
            </div>
</div>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>