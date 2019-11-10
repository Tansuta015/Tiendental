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

$mnumber  = $_SESSION['UserID'];
$start = $_POST["start"];
$Type = $_POST["Type"];
$Detail = $_POST["Detail"];
$Time = $_POST["Time"];

echo $mnumber;
echo $start;
echo $Type;
echo $Detail;
echo $Time;

$sql = "INSERT INTO bookq (CusID,start,Type,Detail,end,Time)

VALUES ('$mnumber','$start','$Type','$Detail','$start','$Time')";

echo $sql;
if ($conn->query($sql) === TRUE) {
    header( "location: http://localhost/newdental/calendar.php?Customernum=".$mnumber );
} else {
    // echo "Error updating record: " . $conn->error;
}
?>
