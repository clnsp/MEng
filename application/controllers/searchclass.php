<?php

class searchclass extends CI_Controller{

	function __construct()
	{
		parent::__construct();
	}
	
    /*
* Get users from associated with a class booking
*/


/**
* Retrieves search results according to search parameters, also sorts date and time into the correct  *     format
* for the database queries.
*/
function index($page = 'search_results'){


	print_r($_POST);
	$this->load->Model('Classes');
	$this->load->Model('Classtype');
	
				// Retrieve class types for dropdown menu
	// $dbres = $this->Classtype->getClasstype();
	
	// $ddmenu = array();
	// foreach ($dbres as $row) {
	// 	$ddmenu[] = $row['class_type'];
	// }
	// $selected = $ddmenu[0];
	// $data['options'] = $ddmenu;
	
	// 			//retrieve sports types for dropdown menu
	// $sports = $this->Classtype->getActivitytype();
	
	// $sportmenu = array();
	// foreach ($sports as $row) {
	// 	$sportmenu[] = $row['class_type'];
	// }
	// $data['sportsoptions'] = $sportmenu;
	
	$user_id = $this->tank_auth->get_user_id();
	$sportorclass = $this->input->post('sportorclass');
	$date = $this->input->post('date');
	
	$start_time = $this->input->post('starttime');
	$end_time = $this->input->post('endtime');

	// if($sportorclass == "class"){
	// 	for ($i = 0; $i <= $class_type; $i++) {
	// 		$selected = $ddmenu[$i];
	// 	}
	// }else{
	// 	for ($i = 0; $i <= $class_type; $i++) {
	// 		$selected = $sportmenu[$i];
	// 	}
	// }
	
	
	/*all classes*/
	if($date == "" && $start_time == "" && $end_time == ""){

		$data['classes'] = $this->Classes->getFutureClasses($_POST['class_type_id']);	
		
		
	// 	$rowCount = 0;
	// //Make sure results are within a valid date
	// 	foreach ($data['classes'] as $row){

	// 		$startdatecheck = $row['class_start_date'];

	// 		if(time() > strtotime($startdatecheck)){

	// 			unset($data['classes'][$rowCount]);                

	// 		}

	// 		$rowCount++;            

	// 	}
		
		$ddrmenu = array();
		foreach ($data['classes'] as $row) {

			if($this->isClassBookedOut($row['class_id']) != ""){
				$ddrmenu[] = "btn btn-warning";
				
			}else{
				$ddrmenu[] = "btn btn-primary";
			}
			
		//			if($this->isClassBookedOut($bookedout)){
		//				echo $bookedout;
		//			}
			
		}

		
		$data['buttondata'] = $ddrmenu;
		
		
		
	}elseif($date != "" && $start_time == "" && $end_time == ""){

		$dateInput = explode('/',$date);
		$dbDate = $dateInput[2].'-'.$dateInput[0].'-'.$dateInput[1];

		$starttime = $dbDate." 00:00:00";
		$endtime = $dbDate." 23:59:00";
		$data['classes'] = $this->Classes->getClassesWithTypeAndStartTime($selected, $starttime, $endtime);

		$dbresults = $this->Classes->getClassesWithTypeAndStartTime($selected, $starttime, $endtime);
		
		
		
		$data['buttondata'] = $ddrmenu;
		
		//Make sure results are within a valid date
		$rowCount = 0;

		foreach ($data['classes'] as $row){

			$startdatecheck = $row['class_start_date'];

			if(time() > strtotime($startdatecheck)){

				unset($data['classes'][$rowCount]);                
				
			}
			
			$rowCount++;            

		}
		
		$ddrmenu = array();
		foreach ($data['classes'] as $row) {
			$resulted = $row['class_id'];
			$bookedout = $this->isClassBookedOut($resulted);
			if($bookedout != ""){
				$ddrmenu[] = "btn btn-warning";
				
			}else{
				$ddrmenu[] = "btn btn-primary";
			}
			
		//			if($this->isClassBookedOut($bookedout)){
		//				echo $bookedout;
		//			}
			
		}
	}else{	
		


	// 	$startAMorPM = mb_substr($start_time,-2);
	// 	$endAMorPM = mb_substr($end_time,-2);

	// //format date to suit database
	// //works fine
	// 	$dateInput = explode('/',$date);
	// 	$dbDate = $dateInput[2].'-'.$dateInput[0].'-'.$dateInput[1];

	// 	$start_time = mb_substr($start_time,0,-3);
	// 	$end_time = mb_substr($end_time,0,-3);
		
	// 	if($startAMorPM == "PM"){


	// 		$temp = (int)substr($start_time, 0, 2);

	// 		if($temp == 12){

	// 			$start_time = $start_time . ":00";

	// 		}else{

	// 			$temp = $temp + 12;
	// 			$start_time = mb_substr($start_time,2);

	// 		//This is necessary to make sure single digit pm hours work
	// 			if(strlen($start_time) == 3){
	// 				$start_time = $temp . $start_time . ":00";
	// 			}else{
	// 				$start_time = $temp . ":" . $start_time . ":00";
	// 			}
	// 		}

	// 	}

	// 	if($startAMorPM == "AM"){
	// 	//get the hour digits
	// 		$temp = (int)substr($start_time, 0, 2);
	// 		if($temp < 12){

	// 			$start_time = $start_time . ":00";


	// 		}else{
	// 	 	//remove 12 to hour digits to signify AM
	// 			$temp = $temp - 12;
	// 			$start_time = mb_substr($start_time,2);
	// 			$start_time = $temp . $start_time. ":00";

	// 		}

	// 	}
		
	// 	if($endAMorPM == "PM"){
	// 	//get the hour digits
	// 		$temp = (int)substr($end_time, 0, 2);

	// 		if($temp == 12){

	// 			$end_time = $end_time . ":00";


	// 		}else{
	// 	 	//add 12 to hour digits to signify PM
	// 			$temp = $temp + 12;
	// 			$end_time = mb_substr($end_time,2);
	// 			if(strlen($end_time) == 3){
	// 				$end_time = $temp  . $end_time . ":00";

	// 			}else{
	// 				$end_time = $temp  . ":" .$end_time . ":00";
	// 			}



	// 		}

	// 	}
	// 	if($endAMorPM == "AM"){
	// 	//get the hour digits
	// 		$temp = (int)substr($end_time, 0, 2);
	// 		if($temp < 12){

	// 			$end_time = $end_time . ":00";


	// 		}else{
	// 	 	//add 12 to hour digits to signify PM
	// 			$temp = $temp - 12;
	// 			$end_time = mb_substr($end_time,2);
	// 			$end_time = "0".$temp . $end_time . ":00";

	// 		}

	// 	}

		$start_time = new DateTime($_POST['class_start_date']);
		$start_time = $start_time->format('H:m:00');

		$end_time = new DateTime($_POST['class_end_date']);
		$end_time = $end_time->format('H:m:00');

		
		$start_date = $dbDate . " " . $start_time;
		$end_date = $dbDate . " " . $end_time;
		$data['classes'] = $this->Classes->getClassesWithTypeAndStartTime($selected, $start_date, $end_date);
		
		$rowCount = 0;
	//Make sure results are within a valid date
		foreach ($data['classes'] as $row){

			$startdatecheck = $row['class_start_date'];

			if(time() > strtotime($startdatecheck)){

				unset($data['classes'][$rowCount]);                
				
			}
			
			$rowCount++;            

		}
		

		
		$dbresults = $this->Classes->getClassesWithTypeAndStartTime($selected, $start_date, $end_date);
		
		$ddrmenu = array();
		foreach ($dbresults as $row) {
			$resulted = $row['class_id'];
			$bookedout = $this->isClassBookedOut($resulted);
			if($bookedout != ""){
				$ddrmenu[] = "btn btn-warning";
				
			}else{
				$ddrmenu[] = "btn btn-primary";
			}
			
		//			if($this->isClassBookedOut($bookedout)){
		//				echo $bookedout;
		//			}
			
		}
		$data['buttondata'] = $ddrmenu;

	}



	$data['classtype'] = $this->Classtype->getClasstype($data);

	
	
	parse_temp($page, $this->load->view('pages/user_booking', setupClassSearchForm(), true) . $this->load->view('pages/'.$page, $data, true));

}

function isClassBookedOut($class_booking_id){
	$this->load->model('classes');
	$this->load->model('bookings');
	$capacity = $this->classes->getClassCapacity($class_booking_id);
	$attending = $this->bookings->countBookingAttendants($class_booking_id);
	return ($attending >= $capacity);
}

}
?>
