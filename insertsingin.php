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

$mnumber  = $_SESSION['time'];
echo $_SESSION['time'];
$name = $_POST["name"];
$lastname = $_POST["lastname"];
$sex = $_POST["sex"];
$age = $_POST["age"];
$idcard = $_POST["idcard"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$disease = $_POST["disease"];
$allergy = $_POST["allergy"];


// echo $mnumber;
// echo $lastname;
// echo $sex;
// echo $age;
// echo $idcard;
// echo $phone;
// echo $address;
// echo $disease;
// echo $allergy;

$sql = "INSERT INTO customer (Customernum,Fname, Lname,Sex, Age,IDcard,Phone,Address,Disease,Allergic)
VALUES ('$mnumber','$name', '$lastname','$sex',$age,'$idcard','$phone','$address','$disease','$allergy')";

if ($conn->query($sql) === TRUE) {
    header( "location: http://localhost/newdental/singin.php");
    echo "บันทึกข้อมูลเรียบร้อย";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;

}   
?>