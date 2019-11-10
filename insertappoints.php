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

$num = $_SESSION['UserID'];
$start = $_POST["start"];
$time = $_POST["time"];
$type = $_POST["type"];
$detail = $_POST["detail"];

echo $start;
echo $time;
echo $type;
echo $detail;

// $date_old = '23-5-2016 23:15:23'; 
// //Date for database
// $date_for_database = date ("Y-m-d H:i:s", strtotime($date_old));
$start=date('Y-m-d');

$sql = "INSERT INTO bookq (start,Time,Type,Detail,CusID)

VALUES ('$start','$time','$type','$detail','$num')";

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
    header( "location: http://localhost/newdental/history.php?Customernum=".$mnumber );
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}   

?>
