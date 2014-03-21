<?php

class booking extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		
		$this->load->Model('classes');
		$this->load->Helper('book');

	}
	

	/**
	* Book a class
	*/
	function bookClass(){
		if(check_member()){

			if(isset($_POST['classid'])){
				$this->load->model('bookings');

				$user_id = $this->tank_auth->get_user_id();
				$classInfo = $this->classes->getClassInformation($_POST['classid']);

				if(!bookedOut($user_id, new DateTime($classInfo['class_start_date']), new DateTime($classInfo['class_end_date']))){
					$this->_addMember($_POST['classid'], $user_id, $classInfo);
				}else{
					$this->_bookingFail('You are already booked into classes at this time');

				}
			}else{
				$this->index();

			}

		}
	}


	/**
	* Add member to a class
	* @param int
	* @param int
	*/
	function _addMember($classid, $user_id, $classInfo){
		$this->load->model('bookings');

		$m = $user_id;
		$b = $classid;

		$full = isclassBooKedouT($b);
		$past = isclassinPast($b);

		$start = new DateTime($classInfo['class_start_date']);
		$end = new DateTime($classInfo['class_start_date']);

		/* Book them */
		if(!$full && !$past){
			if($this->bookings->addMember($b, $m)){

				emailMemberAddedToClass($m, $classInfo);
				$data['classinfo'] = $classInfo;
				parse_temp('booking-success', $this->load->view('pages/booking-success', $data, true));
			}else{
				$this->_bookingFail('You are already booked into this class');
			}
			return;
		}elseif ($full && !$past) {
			parse_temp('booking-wait', $this->load->view('pages/booking-wait', $data, true));

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


			$data = array(
				'class_type_id'		=> $_POST['class_type_id'],
				'class_start_date'	=> $_POST['start'],
				'class_end_date'	=> $_POST['end'],
				'room_id'			=> $_POST['room_id'],
				'max_attendance'	=> 1,
				);


			$uid = $this->tank_auth->get_user_id();
			if(!bookedOut($uid, new DateTime($_POST['start']), new DateTime($_POST['end']))){
				$id = $this->classes->insertClass($data);
				$data = $this->classes->getClassInformation($id);
				$this->_addMember($id, $this->tank_auth->get_user_id(), $data);	
			}else{
				$this->_bookingFail('You are already booked into classes at this time');

			}
		}
	}


	/**
	 * Index page for user booking
	 **/
	function index() {
		parse_temp('user_booking', $this->load->view('pages/user_booking', setupClassSearchForm(), true));
	}


	/**
	* Confirmation page before making a booking
	*/
	function confirm(){
		if(check_member()){
			/* class confirm */
			if(isset($_POST['class_id'])){	
				$data = $this->classes->getClassInformation($_POST['class_id']);
				if(!isclassBookedOut($_POST['class_id'])){
					parse_temp('booking_confirm', $this->load->view('pages/booking-confirm', $data, true));
				}
				else{
					parse_temp('booking_wait', $this->load->view('pages/booking-wait', $data, true));
				}
				/* sports confirm */
			}elseif(isset($_POST['class_type_id'])){
				$_POST['is_sport'] = 1;
				parse_temp('booking-confirm', $this->load->view('pages/booking-confirm', $_POST, true));	
			}else{
				$this->_bookingFail('No class was supplied to book');
				return;
			}
		}
	}
	
	/**
	* Join the waiting list for a class
	*/
	function joinWaiting(){
		if(check_member()){
			$this->load->model('bookings');
			$this->load->model('waiting');

			/* class confirm */
			if(isset($_POST['class_id'])){

				$b = $_POST['class_id'];
				$m = $this->tank_auth->get_user_id();
				
				$classInfo = $this->classes->getClassInformation($b);
				
				if($this->waiting->waitingListFull($b, $classInfo['max_attendance'])){
					$this->_bookingFail('There are unfortunately no more spaces on the waiting list.');
					return;
				}
				
				
				if(!isclassBookedOut($b)){
					parse_temp('booking-confirm', $this->load->view('pages/booking-confirm', $classInfo, true));
					return;
				}
				
				if($this->waiting->addMemberWaitingList($b, $m)){
					emailMemberAddedToWaitingList($m, $classInfo);
					parse_temp('booking-wait-success', $this->load->view('pages/booking-wait-success', $classInfo, true));
				}else{
					$this->_bookingFail('You are already on the waiting list for this class.');
				}
				

			}
			else{
				$this->_bookingFail('No class was supplied');
				return;
			}		

		}
	}

	/**
	* Retrieves search results according to search parameters
	*/
	function search(){
		$this->config->load('gym_settings');

		$user_id = $this->tank_auth->get_user_id();
		$start_date=''; $end_time='';

		if(!isset($_POST['class_type_id'])){
			echo("Missing class to search for");
			return;
		}

		if($_POST['date'] == ''){
			$start_date = new DateTime();
			$end_date = new DateTime();
			$end_date->modify($this->config->item('class_booking_window'));

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

			$data['classes'] = $this->_fetchSportsClasses($_POST['class_type_id'], $start_date, $end_date, $start_time, $end_time);

		}else{
			if($_POST['class_type_id'] == '-1'){
				$classtypes = $this->classes->getClassTypeIDs();
			}else{
				$classtypes = array('class_type_id' => $_POST['class_type_id']);
			}

			$data['classes'] = $this->classes->getClassesWithTypeAndStartTime($classtypes, $start_date, $end_date, $start_time, $end_time);

		}

		echo ($this->load->view('pages/search_results', $data, true));

	}

	/**
	* Retrieve possible sports classes that could be booked out
	* @param int
	* @param string - date
	* @param string - date
	* @param string - time
	* @param string - time
	* @return array
	*/
	function _fetchSportsClasses($class_type_id, $start_date, $end_date, $start_time, $end_time){
		$this->config->load('gym_settings');
		$this->load->model('courts');
		$this->load->model('rooms');
		$this->load->model('classtype');
		$this->load->model('restrictions');

		$info = $this->classtype->getClasstypeInfo($class_type_id);

		$duration = $info['duration']; 

		$start_object = new DateTime($start_date . $start_time);
		$end_object = new DateTime($end_date ." ". $end_time);

		$opening = new DateTime($start_date ." ". $this->config->item('open_'.$start_object->format('l')));
		$closing = new DateTime($start_date ." ".$this->config->item('close_'.$start_object->format('l')));

		$rooms = $this->courts->findRoomsWithSports($class_type_id);
		$now = new DateTime();

		$results =  array();

		foreach ($rooms as $key => $room) {
			$room_id = $room['room_id'];
			$sportInstances = $this->courts->countSportInstances($room_id, $class_type_id);
			$roomSize = $this->rooms->getRoomSize($room_id);
			$targetSportTokenSize = $this->_fetchTokenSize($room_id, $class_type_id);
			$blockedSportIds = $this->restrictions->getSportsThatBlock($room_id, $class_type_id);


			while($start_object <= $end_object){

				$start_dup = clone $start_object;
				$start_dup->modify("+$duration minutes");

				if($start_object < $opening || $start_dup > $closing || $start_object < $now){
					$start_object->modify("+$duration minutes");
					continue;
				}

				$sportInstancesForTime = $sportInstances;
				$roomSizeForTime = $roomSize;

				$alreadyBooked = $this->classes->getSportsBookedOverTime($room_id, $start_date, $end_date, $start_object->format('H:i:s'), $start_dup->format('H:i:s'));		

				foreach ($alreadyBooked as $key => $booked) {

					if(in_array($booked['class_type_id'], $blockedSportIds)){
						$start_object->modify("+$duration minutes");
						continue 2;
					}

					if($booked['class_type_id'] == $class_type_id){
						$sportInstancesForTime--;
						$roomSizeForTime = $roomSizeForTime - $targetSportTokenSize;
					}else{
						$roomSizeForTime = $roomSizeForTime  - $this->_fetchTokenSize($room_id, $booked['class_type_id']);
					}
				}

				if($sportInstancesForTime > 0 && $roomSizeForTime >= $targetSportTokenSize){
					$result['class_start_date'] = $start_object->format('Y-m-d H:i:s');
					$result['class_end_date'] = $start_object->modify("+$duration minutes")->format('Y-m-d H:i:s');
					$result['class_type'] = $info['class_type'];
					$result['room'] = $room['room'];
					$result['room_id'] = $room['room_id'];
					$result['date'] = $start_date;
					$result['available'] = $sportInstancesForTime;
					$result['class_type_id'] = $class_type_id;
					$result['is_sport'] = 1;

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
		$sportInstances = $this->courts->countSportInstances($room_id, $class_type_id);
		$sportCourts = $this->courts->countSportCourts($room_id, $class_type_id);

		if($sportCourts == 0 || $sportInstances==0){
			return 0;
		}

		return $sportCourts / $sportInstances;
	}




}
?>
