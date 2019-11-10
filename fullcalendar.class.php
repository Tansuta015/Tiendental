<?php
session_start(); 
class Fullcalendar {
    private $host = 'localhost'; //ชื่อ Host 
    private $user = 'root'; //ชื่อผู้ใช้งาน ฐานข้อมูล
    private $password = ''; // password สำหรับเข้าจัดการฐานข้อมูล
    private $database = 'tienden1'; //ชื่อ ฐานข้อมูล

 //function เชื่อมต่อฐานข้อมูล
 protected function connect(){
     
     $mysqli = new mysqli($this->host,$this->user,$this->password,$this->database);
         
         $mysqli->set_charset("utf8");

         if ($mysqli->connect_error) {

             die('Connect Error: ' . $mysqli->connect_error);
		 }
     return $mysqli;
 }

	//function show data in fullcalendar
	public function get_fullcalendar(){
		
		$db = $this->connect();
		$get_calendar = $db->query("SELECT * FROM bookq where Status ='0'");
		
		while($calendar = $get_calendar->fetch_assoc()){
			$result[] = $calendar;
		}
		
		if(!empty($result)){
			
			return $result;
		}
	}
	
	//show data in modal
	public function get_fullcalendar_id($get_id){
		
		$db = $this->connect();
		$get_user = $db->prepare("SELECT BookID,Type,Detail,start,end,Time,Customernum,Fname,Lname,Phone   FROM bookq INNER JOIN customer 
		ON  bookq.CusID = customer.CusID  WHERE BookID = ?");
		$get_user->bind_param('i',$get_id);
		$get_user->execute();
		$get_user->bind_result($BookID,$Type,$Detail,$start,$end,$Time,$Customernum,$Fname,$Lname,$Phone);
		$get_user->fetch();
		
		$result = array(
			'BookID'=>$BookID,
			'Type'=>$Type,
			'Detail'=>$Detail,
			'start'=>$start,
			'end'=>$end,
			'Time'=>$Time,
			'Customernum'=>$Customernum,
			'Fname'=>$Fname,
			'Lname'=>$Lname,
			'Phone'=>$Phone
			
		);
		
		return $result;
	}
	
	//save new data 
	// public function new_calendar($data){
	// 	$db = $this->connect();
		
	// 	$add_user = $db->prepare("INSERT INTO bookq (CusID,Type,Detail,start,end,Time) VALUES(?,?,?,?,?,?)");
		
	// 	$add_user->bind_param("isssss",$_SESSION['UserID'],$_POST["Type"],$_POST["Detail"],$_POST["start"],$_POST["start"],$_POST["Time"]);
		
	// 	if(!$add_user->execute()){
			
	// 		echo $db->error;
			
	// 	}else{
			
	// 		echo "บันทึกข้อมูลเรียบร้อย";
	// 	}
	// }
	
	//edit data 
	public function edit_calendar($data){
		
		$db = $this->connect();
		
		$add_user = $db->prepare("UPDATE bookq SET Type = ? , Detail = ? ,start = ?,end = ?,Time = ? WHERE BookID = ?");
		
		$add_user->bind_param("sssssi",$_POST["Type"],$_POST["Detail"],$_POST["start"],$_POST["start"],$_POST["Time"],$data['edit_calendar_BookID']);
		
		if(!$add_user->execute()){
			
			echo $db->error;
			
		}else{
			
			echo "บันทึกข้อมูลเรียบร้อย";
		}
	}
	
	//delete data
	public function del_calendar($BookID){
		
		$db = $this->connect();
		
		$del_user = $db->prepare("UPDATE bookq SET Status = '1' WHERE BookID=? ");
		
		
		$del_user->bind_param("i",$BookID);
		
		if(!$del_user->execute()){
			
			echo $db->error;
			
		}else{
			echo "ลบข้อมูลเรียบร้อย";
		}
	}	
}
?>