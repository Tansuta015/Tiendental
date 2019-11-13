<?php
require "fullcalendar.class.php";

//new object
$fullcalendar = new Fullcalendar();

//check data for show fullcalendar

if(isset($_GET['get_json'])){
	
	//call method get_fullcalendar
	$get_calendar = $fullcalendar->get_fullcalendar();
	
	foreach($get_calendar as $calendar){
	
		$json[] = array(

			'BookID'=>$calendar['BookID'],
			'Type'=>$calendar['Type'],
			'title'=>$calendar['Detail'],
			'start'=>$calendar['start'],
			'end'=>$calendar['end'],
			'Time'=>$calendar['Time'],
			'url'=>'javascript:get_modal('.$calendar['BookID'].');'
		);
	}
	
	//return JSON object
	echo json_encode($json);
}

//show edit data modal
if(isset($_POST['CusID'])){
	
	$get_data = $fullcalendar->get_fullcalendar_id($_POST['CusID']);
	
	$output = '<div class="modal-body">
			<form id="edit_fullcalendar">
			<div class="form-group">
			<label >เลขสมาชิก</label>
			<input type="text" class="form-control" disabled="disabled" name="Type" value="'.$get_data['Customernum'].'">
		  </div>
		  <div class="form-group">
					<label >ชื่อ</label>
					<input type="text" class="form-control"  disabled="disabled" name="Type" value="'.$get_data['Fname'].'">
				  </div>
				  <div class="form-group">
				  <label >นามสกุล</label>
				  <input type="text" class="form-control"  disabled="disabled" name="Type" value="'.$get_data['Lname'].'">
				</div>
				<div class="form-group">
					<label >เบอร์โทรศัพท์</label>
					<input type="text" class="form-control" disabled="disabled" name="Type" value="'.$get_data['Phone'].'">
				  </div>
				  <div class="form-group">
					<label >ประเภทการรักษา</label>
					<input type="text" class="form-control" name="Type" value="'.$get_data['Type'].'">
				  </div>
				  <div class="form-group">
					<label >หมายเหตุการรักษา</label>
					<input type="text" class="form-control" name="Detail"  value="'.$get_data['Detail'].'">
				  </div>
				  <div class="form-group">
					<label >วันที่เริ่มต้น</label>
					<input type="text" class="form-control" name="start" id="datepicker" width="250" value="'.$get_data['start'].'">
				  </div>
				 
				  
				  <div class="form-group">
				  <label for="input"  >เวลาการรักษา :</label>
				  <select id="input" name="Time"  class="form-control">';
				  
	$output .=		 '<option>โปรดระบุเวลาการรักษา</option>
					<option value="" disabled >จันทร์-ศุกร์</option>';

							  if(strcmp($get_data['Time'],"17:00-17:45") == 0){
								$output .= '<option value="17:00-17:45" selected>17:00-17:45</option>';
								
							  }
							  else{
								$output .= '<option value="17:00-17:45">17:00-17:45</option>';
							  }
							  
							  
							  if(strcmp($get_data['Time'],"17:45-18:30") == 0){
								$output .= '<option value="17:45-18:30" selected>17:45-18:30</option>';
								
							  }
							  else{
								$output .= '<option value="17:45-18:30">17:45-18:30</option>';
							  }
							  
							  if(strcmp($get_data['Time'],"18:30-19:15") == 0){
								$output .= '<option value="18:30-19:15" selected>18:30-19:15</option>';
								
							  }
							  else{
								$output .= '<option value="18:30-19:15">18:30-19:15</option>';
							  }

							  if(strcmp($get_data['Time'],"19:15-20:00") == 0){
								$output .= '<option value="19:15-20:00" selected>19:15-20:00</option>';
								
							  }
							  else{
								$output .= '<option value="19:15-20:00">19:15-20:00</option>';
							  }

							  $output .=  '<option value="" disabled >เสาร์-อาทิตย์</option>';

							  if(strcmp($get_data['Time'],"9:45-10:30") == 0){
								$output .= '<option value="9:45-10:30" selected>9:45-10:30</option>';
								
							  }
							  else{
								$output .= '<option value="9:45-10:30">9:45-10:30</option>';
							  }

							  if(strcmp($get_data['Time'],"9:45-10:30") == 0){
								$output .= '<option value="9:45-10:30" selected>9:45-10:30</option>';
								
							  }
							  else{
								$output .= '<option value="9:45-10:30">9:45-10:30</option>';
							  }
							  if(strcmp($get_data['Time'],"10:30-11:15") == 0){
								$output .= '<option value="10:30-11:15" selected>10:30-11:15</option>';
								
							  }
							  else{
								$output .= '<option value="10:30-11:15">10:30-11:15</option>';
							  }

							  if(strcmp($get_data['Time'],"11:15-12:00") == 0){
								$output .= '<option value="11:15-12:00" selected>11:15-12:00</option>';
								
							  }
							  else{
								$output .= '<option value="11:15-12:00">11:15-12:00</option>';
							  }
	
							 
							  if(strcmp($get_data['Time'],"13:00-13:45") == 0){
								$output .= '<option value="13:00-13:45" selected>13:00-13:45</option>';
								
							  }
							  else{
								$output .= '<option value="13:00-13:45">13:00-13:45</option>';
							  }
							 
							  if(strcmp($get_data['Time'],"13:45-14:30") == 0){
								$output .= '<option value="13:45-14:30" selected>13:45-14:30</option>';
								
							  }
							  else{
								$output .= '<option value="13:45-14:30">13:45-14:30</option>';
							  }
							 
							  if(strcmp($get_data['Time'],"14:30-15:15") == 0){
								$output .= '<option value="14:30-15:15" selected>14:30-15:15</option>';
								
							  }
							  else{
								$output .= '<option value="14:30-15:15">14:30-15:15</option>';
							  }
							  
							  if(strcmp($get_data['Time'],"15:15-16:00") == 0){
								$output .= '<option value="15:15-16:00" selected>15:15-16:00</option>';
								
							  }
							  else{
								$output .= '<option value="15:15-16:00">15:15-16:00</option>';
							  }
							  
							  if(strcmp($get_data['Time'],"16:00-16:45") == 0){
								$output .= '<option value="16:00-16:45" selected>16:00-16:45</option>';
								
							  }
							  else{
								$output .= '<option value="16:00-16:45">16:00-16:45</option>';
							  }
							  
							  if(strcmp($get_data['Time'],"16:45-17:30") == 0){
								$output .= '<option value="16:45-17:30" selected>16:45-17:30</option>';
								
							  }
							  else{
								$output .= '<option value="16:45-17:30">16:45-17:30</option>';
							  }
	$output .=				  '</select>
			  </div>
			  


				  
					<input type="hidden" name="edit_calendar_BookID" value="'.$get_data['BookID'].'">
					
				</form>
			</div>
		  <div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" onclick="return del_calendar('.$get_data['BookID'].');">Delete</button>
				<button type="button" class="btn btn-primary" onclick="return edit_calendar();">Save changes</button>
				<button type="button" class="btn btn-primary" onclick="return edit_calendar();">Done</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>';
	echo $output;
}

//save new data
if(isset($_POST['new_calendar_form'])){
	
	$fullcalendar->new_calendar($_POST);
}

//edit new data
if(isset($_POST['edit_calendar_BookID'])){
	
	$fullcalendar->edit_calendar($_POST);
}

//delete data
if(isset($_POST['del_id'])){
	
	$fullcalendar->del_calendar($_POST['del_id']);
}

?>
