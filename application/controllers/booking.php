<?php

class booking extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		
		$this->load->Model('classes');

	}
	
	
	    /*
	* Get users from associated with a class booking
	*/
	
	
	   /*
	    * Retrieves search results according to search parameters, also sorts date and time into the correct format
	    * for the database queries.
	    */
	   function bookClass(){

	   	if(isset($_POST['classid'])){

	   		$this->load->model('bookings');

	   		$user_id = $this->tank_auth->get_user_id();

	//	     $bookingtype = $this->input->post('bookingtype');
	//	
	//	     if($bookingtype == "btn btn-warning"){
	//	      $bookingtype = "You have been added to the Waiting List for";
	//	    }else{
	//	      $bookingtype = "You will be Attending";
	//	
	//	    }



		 //   echo $classid;
		  //  if (isset($_POST['user_id']) && isset($_POST['class_id'])){
		   //     $m = strtolower($_POST['user_id']);
		    //    $b = strtolower($_POST['class_id']);


		   //     if(!$this->isClassBookedOut($classid) && !$this->isClassInPast($classid)){
	   		$data['user_id'] = $this->tank_auth->get_user_id();
	   		$this->addMember($_POST['classid'], $user_id);


//		    $data['start'] = $start;
//		    $data['end'] = $end;
	//	    $data['bookingtype'] = $bookingtype;

	   	}else{
	   		redirect('booking', 'refresh');
	   	}
	   }
	      //} 



	  /**
	   * Add member to a class
	   */
	  function addMember($classid, $user_id){
	  	$this->load->model('bookings');

	  	$classInfo = $this->classes->getClassInformation($classid);
	  	$m = $user_id;
	  	$b = $classid;

	  	$full = $this->isClassBookedOut($b);
	  	$past = $this->isClassInPast($b);

	  	$start = new DateTime($classInfo['class_start_date']);
	  	$end = new DateTime($classInfo['class_start_date']);

	  	$bookedOut = $this->bookings
	  	->isMemberBookedOut($user_id, $start->format("Y-m-d"), $start->format("H:i:s"), $end->format("H:i:s"));

	  	if(count($bookedOut)>0){
	  		$this->_bookingFail('You are already booked into classes at this time');
	  		return;
	  	}


	  	/* Book them */
	  	if(!$full && !$past){
	  		if($this->bookings->addMember($b, $m)){
	  			$this->_emailMemberAddedToClass($m, $b, $classInfo['class_start_date'], $classInfo['class_end_date']);
	  			$data['classinfo'] = $classInfo;
	  			parse_temp('booking-success', $this->load->view('pages/booking-success', $data, true));
	  		}else{
	  			$this->_bookingFail('You are already booked into this class');
	  		}
	  		return;
	  	}elseif ($full && !$past) {
	  		$this->bookings->addMemberWaitingList($b, $m);
	  		$this->_emailMemberAddedToWaitingList($m, $b, $start, $end);
	  		echo "Give them choice to add to waiting";
	  	}


	  }

	  /**
	   * Handle booking failuires
	   */
	  function _bookingFail($message){
	  	$data['message'] = $message;
	  	parse_temp('booking-fail', $this->load->view('pages/booking-failure', $data, true));

	  }
	  
	  /**
	   * Book user into a sport
	   */
	  function bookSport() {
	  	$this->load->model('bookings');
	  	/*! need to check that you're allowed to make booking !*/

	  	
	  	if(isset($_POST['class_type_id']) && isset($_POST['start']) && isset($_POST['end'])){
	  		//$end = new DateTime($_POST['class_start_date']);
	  		//$end->modify("+60 minutes");
	  		

	  		$data = array(
	  			'class_type_id'		=> $_POST['class_type_id'],
	  			'class_start_date'	=> $_POST['start'],
	  			'class_end_date'	=> $_POST['end'],
	  			'room_id'			=> $_POST['room_id'],
	  			'max_attendance'	=> 1,
	  			);

	  		$id = $this->classes->insertClass($data);



	  		$this->addMember($id, $this->tank_auth->get_user_id());		  	
	  	}
	  }



	  function isClassInPast($class_booking_id){
	  	$end = $this->classes->getClassEndDate($class_booking_id);
//		$end = new DateTime($end);
//		echo($this->db->last_query());
	  	return (time() >  strtotime($end));
	  }

	  function _emailMemberAddedToClass($member_id, $class_id, $start, $end) {
	  	$this->load->model('members');
	  	$this->load->helper('email');

	  	$email = $this->members->getMemberEmail($member_id);
	  	$classDetails = $this->classes->getClassInformation($class_id);
	  	$headers  = 'MIME-Version: 1.0' . "\r\n";
	  	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	  	$msg ='<!DOCTYPE html>
	  	<html>
	  	<head>'; 
	  	$msg .= 'You have booked into the following class: ' . $classDetails['class_type'] . '. <p> Starting: '. $start . ' <p>End: '. $end;

	  	$msg .= '</html> </head>';
	  	mail($email, 'Booked into a Class', $msg, $headers);
	  }


	  function _emailMemberAddedToWaitingList($member_id, $class_id, $start, $end) {
	  	$this->load->model('members');

	  	$this->load->helper('email');

	  	$email = $this->members->getMemberEmail($member_id);
	  	$classDetails = $this->classes->getClassInformation($class_id);
	  	$headers  = 'MIME-Version: 1.0' . "\r\n";
	  	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	  	$msg ='<!DOCTYPE html>
	  	<html>
	  	<head>'; 
	  	$msg .= 'You have been added to the waiting list for the following class: ' . $classDetails['class_type'] . '. <p> Start Time: '. $start . ' <p> End Time: '. $end;
	  	$msg .= ' <p> We will notify you through your chosen method of communication if a space becomes available. </p>';
	  	$msg .= '</html> </head>';
	  	mail($email, 'Booked into a Class', $msg, $headers);
	  }


	  function index() {
	  	parse_temp('user_booking', $this->load->view('pages/user_booking', setupClassSearchForm(), true));
	  }


/**
* Retrieves search results according to search parameters, also sorts date and time into the correct format
* for the database queries.
*/
function search(){

	$user_id = $this->tank_auth->get_user_id();
	$start_date=''; $end_time='';

	if(!isset($_POST['class_type_id'])){
		echo("Missing class to search for");
		return;
	}

	if($_POST['date'] == ''){
		$start_date = new DateTime();
		$end_date = new DateTime();
		$end_date->modify("+1 weeks");
		
	}else{
		$start_date = new DateTime($_POST['date']);
		$end_date = new DateTime($_POST['date']);
	}
	
	$end_date = $end_date->format("Y-m-d");
	$start_date = $start_date->format("Y-m-d");

	if($_POST['starttime']!=''){
		$start_time = new DateTime($_POST['starttime']);
		$start_time = $start_time->format('H:i:00');
	}else{
		$start_time = '00:00:00';
	}
	
	if($_POST['endtime']!=''){
		$end_time = new DateTime($_POST['endtime']);
		$end_time = $end_time->format('H:i:00');
	}else{
		$end_time = '23:59:59';
	}
	
	if(isset($_POST['is_sport'])){
		$end_date = new DateTime($_POST['date']);
		$end_date = $end_date->format("Y-m-d");
		$data['classes'] = $this->_fetchSportsClasses($_POST['class_type_id'], $start_date, $end_date, $start_time, $end_time);
		
	}else{
		$data['classes'] = $this->classes->getClassesWithTypeAndStartTime($_POST['class_type_id'], $start_date, $end_date, $start_time, $end_time);
		foreach ($data['classes'] as $key => $row) {
			$data['classes'][$key]['fully_booked'] = $this->isClassBookedOut($row['class_id']);
		}
	}

//
//
//	print_r($data['classes'] );
	echo ($this->load->view('pages/search_results', $data, true));

}

/**
* Retrieve possible sports classes that could be booked out
*/
function _fetchSportsClasses($class_type_id, $start_date, $end_date, $start_time, $end_time){
	
	$this->load->model('courts');
	$this->load->model('rooms');
	$this->load->model('classtype');
	$this->load->model('restrictions');

	$info = $this->classtype->getClasstypeInfo($class_type_id);

	$duration = $info['duration']; 

	$start_object = new DateTime($start_date . $start_time);
	$end_object = new DateTime($end_date ." ". $end_time);
	$start_time = new DateTime($start_time);

	$results =  array();

	$rooms = $this->courts->findRoomsWithSports($class_type_id);
	$now = new DateTime();

	foreach ($rooms as $key => $room) {
		$room_id = $room['room_id'];
		$sportInstances = $this->courts->countSportInstances($room_id, $class_type_id);
		$roomSize = $this->rooms->getRoomSize($room_id);
		$targetSportTokenSize = $this->_fetchTokenSize($room_id, $class_type_id);
		$blockedSportIds = $this->restrictions->getSportsThatBlock($room_id, $class_type_id);

		print_r($blockedSportIds);

		while($start_object <= $end_object){

				//	echo($start_object < $now);		
			if($start_object < $now){
				$start_object->modify("+$duration minutes");
				continue;
			}
			
			$sportInstancesForTime = $sportInstances;
			$roomSizeForTime = $roomSize;

			$alreadyBooked = $this->classes->getSportsBookedOverTime($room_id, $start_date, $end_date, $start_time->format('H:i:s'), $end_time);		

				//if intersect then this sport is blocked and can't be booked
//				if(count(array_intersect($array1, $array2)) > 0){
//					$start_time->modify("+60 minutes");
//					continue;
//				}
				//print_r($alreadyBooked);
			foreach ($alreadyBooked as $key => $booked) {
				if($booked['class_type_id'] == $class_type_id){
					$sportInstancesForTime--;
					$roomSizeForTime = $roomSizeForTime - $targetSportTokenSize;
				}else{
					$roomSizeForTime = $roomSizeForTime  - $this->_fetchTokenSize($room_id, $booked['class_type_id']);
				}
			}

			if($sportInstancesForTime > 0 && $roomSizeForTime >= $targetSportTokenSize){
				$result['class_start_date'] = $start_object->format('H:i:s');
				$result['class_end_date'] = $start_object->modify("+$duration minutes")->format('H:i:s');
				$result['class_type'] = $info['class_type'];
				$result['room'] = $room['room'];
				$result['room_id'] = $room['room_id'];
				$result['date'] = $start_date;
				$result['available'] = $sportInstancesForTime;
				$result['class_type_id'] = $class_type_id;

				array_push($results, $result);
			}else{
				$start_object->modify("+$duration minutes");
			}

		}
	}

	return $results;

}


/**
 * Get token size for class in room
 * @param int
 * @param int
 * @return int
 */
function _fetchTokenSize($room_id, $class_type_id){
//	echo($class_type_id);
	$sportInstances = $this->courts->countSportInstances($room_id, $class_type_id);
	$sportCourts = $this->courts->countSportCourts($room_id, $class_type_id);
	
//	echo("courts ($sportCourts) instances ($sportInstances)" );
	
	if($sportCourts == 0 || $sportInstances==0){
		return 0;
	}
	return $sportCourts / $sportInstances;
}



function isClassBookedOut($class_booking_id){
	$this->load->model('Bookings');

	$capacity = $this->classes->getClassCapacity($class_booking_id);
	$attending = $this->Bookings->countBookingAttendants($class_booking_id);

	return ($attending >= $capacity);
}

}
?>
