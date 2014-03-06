<?php

class searchclass extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Classes');
		$this->load->Model('Classtype');

	}

/**
* Retrieves search results according to search parameters, also sorts date and time into the correct format
* for the database queries.
*/
function index($page = 'search_results'){
	
	$user_id = $this->tank_auth->get_user_id();
	$sportorclass = $this->input->post('sportorclass');
	$date = $this->input->post('date');
	
	$start_time = $this->input->post('starttime');
	$end_time = $this->input->post('endtime');

	if($date == "" && $start_time == "" && $end_time == ""){
		$data['classes'] = $this->Classes->getFutureClasses($_POST['class_type_id']);		
	}

	elseif($date != "" && $start_time == "" && $end_time == ""){

		$date = new DateTime($date);

		$starttime = $date->format('Y-m-d 00:00:00');
		$endtime = $date->format('Y-m-d 23:59:00');

		$data['classes'] = $this->Classes->getClassesWithTypeAndStartTime($_POST['class_type_id'], $starttime, $endtime);

	}
	else{	
		$start_time = new DateTime($_POST['starttime']);
		$end_time = new DateTime($_POST['endtime']);

		$date = new DateTime($date);

		$start_date = $date->format('Y-m-d ') . $start_time->format('H:i:00');
		$end_date = $date->format('Y-m-d ') . $end_time->format('H:i:00');

		$data['classes'] = $this->Classes->getClassesWithTypeAndStartTime($_POST['class_type_id'], $start_date, $end_date);

	}
	
	$ddrmenu = array();
	foreach ($data['classes'] as $row) {

		if($this->isClassBookedOut($row['class_id'])){
			$ddrmenu[] = "btn btn-warning";
		}else{
			$ddrmenu[] = "btn btn-primary";
		}

	}
	$data['buttondata'] = $ddrmenu;
	
	parse_temp($page, $this->load->view('pages/user_booking', setupClassSearchForm(), true) . $this->load->view('pages/'.$page, $data, true));

}

/**
* Retrieve possible *sports classes that could be booked out
*/
function fetchSportsClasses(){
	echo json_encode($this->Classtype->getActivityType());
}


function isClassBookedOut($class_booking_id){
	$this->load->model('Bookings');

	$capacity = $this->Classes->getClassCapacity($class_booking_id);
	$attending = $this->Bookings->countBookingAttendants($class_booking_id);
	
	return ($attending >= $capacity);
}

}
?>
