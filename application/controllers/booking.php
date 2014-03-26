<?php

class booking extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('session');
		$this->load->Model('classes');
		$this->load->Model('bookings');
		$this->load->Helper('book');

	}
	

	/**
	* Book a class
	*/
	function bookClass(){
			if(isset($_POST['classid'])&& isset($_POST['userid'])){
				$user_id = $_POST['userid'];
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


	/**
	* Add member to a class
	* @param int
	* @param int
	*/
	function _addMember($classid, $user_id, $classInfo){

		$m = $user_id;
		$b = $classid;

		$full = isclassBooKedouT($b);
		$past = isclassinPast($b);

		$start = new DateTime($classInfo['class_start_date']);
		$end = new DateTime($classInfo['class_start_date']);

		/* Book them */
		if(!$full && !$past){
			if($this->bookings->addMember($b, $m)){

				$data['classinfo'] = $classInfo;
											$data2 = array(
			'uid' => $m,
			'classid' => $b,
			'success' => 2,);
		$this->db->insert('COLIN_STRESS_TEST', $data2); 
				parse_temp('booking-success', $this->load->view('pages/booking-success', $data, true));
				emailMemberAddedToClass($m, $classInfo);

			}else{
														$data3 = array(
			'uid' => $m,
			'classid' => $b,
			'success' => 0,);
		$this->db->insert('COLIN_STRESS_TEST', $data3); 
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
		if(check_member()){
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
			/* class confirm */
			if(isset($_GET['class_id'])){
				$userids = array(1,5,6,7,9,10,12,14,19,20,21,22,23,28,30,31,694,696,697,698,699,701,702,703,705,707,710,713,716,717,720,726,727,729,730,731,732,734,737,742,744,745,747,748,749,750,755,756,757,761,762,765,766,769,771,775,776,777,778,780,783,786,791,792,794,799,800,801,802,803,807,811,814,815,816,818,820,822,824,827,828,829,830,831,833,834,835,838,839,840,841,842,844,847,848,849,852,855,858,860,863,868,871,878,880,881,885,886,888,890,892,893,896,898,900,901,903,904,909,913,916,917,918,922,927,928,929,930,931,934,935,938,940,943,944,945,946,947,949,953,954,956,957,958,959,960,965,966,969,974,975,987,989,992,993,996,997,998,999,1002,1003,1004,1005,1009,1013,1014,1015,1017,1019,1020,1021,1022,1024,1027,1028,1031,1032,1033,1034,1035,1037,1038,1039,1042,1044,1045,1048,1049,1050,1051,1054,1057,1060,1061,1063,1065,1066,1067,1069,1070,1073,1074,1076,1078,1080,1088,1089,1090,1094,1096,1097,1098,1100,1101,1104,1107,1110,1111,1112,1113,1114,1115,1116,1117,1121,1126,1127,1129,1132,1134,1135,1136,1140,1141,1142,1143,1145,1149,1151,1153,1155,1161,1162,1163,1164,1166,1167,1170,1173,1174,1177,1178,1179,1180,1181,1182,1183,1185,1186,1187,1191,1192,1193,1195,1196,1198,1202,1203,1205,1211,1212,1213,1216,1217,1218,1219,1220,1222,1224,1225,1226,1228,1231,1232,1233,1251,695,700,704,706,708,709,711,712,714,715,718,719,721,722,723,724,725,728,733,735,736,738,739,740,741,743,746,751,752,753,754,758,759,760,763,764,767,768,770,772,773,774,779,781,782,784,785,787,788,789,790,793,795,796,797,798,805,806,808,809,810,812,813,817,819,821,823,825,826,832,836,837,843,845,846,850,851,853,854,856,857,859,861,862,864,865,866,867,869,870,872,873,874,875,876,877,879,882,884,887,889,891,894,895,897,899,902,905,906,907,908,910,911,912,914,915,919,920,921,923,924,925,926,932,933,936,937,939,941,942,948,950,951,952,955,961,962,963,964,967,968,970,971,972,973,976,977,978,979,980,981,982,983,984,985,986,988,990,991,994,995,1000,1001,1006,1007,1008,1010,1011,1012,1016,1018,1023,1025,1026,1029,1030,1036,1040,1041,1043,1046,1047,1052,1053,1055,1056,1058,1059,1062,1064,1068,1071,1072,1075,1077,1079,1081,1082,1083,1084,1085,1086,1087,1091,1092,1093,1095,1099,1102,1103,1105,1106,1108,1109,1118,1119,1120,1122,1123,1124,1125,1128,1130,1131,1133,1137,1138,1139,1144,1146,1147,1148,1150,1152,1154,1156,1157,1158,1159,1160,1165,1168,1169,1171,1172,1175,1176,1184,1188,1189,1190,1194,1197,1199,1200,1201,1204,1206,1207,1208,1209,1210,1215,1221,1223,1227,1229,1230,1234,1235,1241,1245,1246,1252,1253,1254,1282,1284,1286,1287,1288,1289,1290,1291,1293,1323,1324,2,804);

				$user = $userids[array_rand($userids)];
				
				$this->session->sess_destroy();
				$this->session->set_userdata(array('user_id'=>  $user, 'username'	=> "TEST", 'usertype'	=> 1, 'userpermission'	=> 1, 'status'	=> 1,));
				
				$data = $this->classes->getClassInformation($_GET['class_id']);
				$data['uid'] = $user;
				
															$data2 = array(
			'uid' => $user,
			'classid' => $_GET['class_id'],
			'success' => -1,);
		$this->db->insert('COLIN_STRESS_TEST', $data2); 
				
				if(!isclassBookedOut($_GET['class_id'])){
					parse_temp('booking_confirm', $this->load->view('pages/booking-confirm', $data, true));
				}
				else{
					parse_temp('booking_wait', $this->load->view('pages/booking-wait', $data, true));
				}
				/* sports confirm */
			}elseif(isset($_GET['class_type_id'])){
				$_POST['is_sport'] = 1;
				parse_temp('booking-confirm', $this->load->view('pages/booking-confirm', $_POST, true));	
			}else{
				$this->_bookingFail('No class was supplied to book');
				return;
			}
	}	
	
	/**
	* Join the waiting list for a class
	*/
	function joinWaiting(){
			$this->load->model('waiting');

			/* class confirm */
			if(isset($_POST['class_id']) && isset($_POST['user_id'])){

				$b = $_POST['class_id'];
				$m = $_POST['user_id'];
				
				$classInfo = $this->classes->getClassInformation($b);
				
				if($this->waiting->waitingListFull($b, $classInfo['max_attendance'])){
<<<<<<< HEAD
															$data3 = array(
			'uid' => $m,
			'classid' => $b,
			'success' => 0,);
		$this->db->insert('COLIN_STRESS_TEST', $data3); 
=======

>>>>>>> 182e0fd69d2e889b63a1aa54360cef685e439ee0
					$this->_bookingFail('There are unfortunately no more spaces on the waiting list.');
					return;
				}
				
				
				if(!isclassBookedOut($b)){ 
					parse_temp('booking-confirm', $this->load->view('pages/booking-confirm', $classInfo, true));
					return;
				}
				
				if($this->waiting->addMemberWaitingList($b, $m)){
							$data3 = array(
			'uid' => $m,
			'classid' => $b,
			'success' => 1,);
		$this->db->insert('COLIN_STRESS_TEST', $data3); 
					emailMemberAddedToWaitingList($m, $classInfo);
					parse_temp('booking-wait-success', $this->load->view('pages/booking-wait-success', $classInfo, true));
				}else{
											$data3 = array(
			'uid' => $m,
			'classid' => $b,
			'success' => 0,);
		$this->db->insert('COLIN_STRESS_TEST', $data3); 
					$this->_bookingFail('You are already on the waiting list for this class.');
				}
				

			}
			else{
				$this->_bookingFail('No class was supplied');
				return;
			}
	}

	/**
	* Retrieves search results according to search parameters
	*/
	function search(){
		if(check_member()){
			$this->config->load('gym_settings');

			$user_id = $this->tank_auth->get_user_id();
			$start_date=''; $end_time='';

			if(!isset($_POST['class_type_id'])){
				echo("Missing class to search for");
				return;
			}

			if(!isset($_POST['date']) || $_POST['date'] == ''){
				$start_date = new DateTime();
				$end_date = new DateTime();


				$end_date->modify($this->config->item('class_booking_window'));
				

			}else{
				$start_date = new DateTime($_POST['date']);
				$end_date = new DateTime($_POST['date']);

				$today = new DateTime();
				$todaySports = new DateTime();
				if(!isset($_POST['is_sport']) && $start_date > $today->modify($this->config->item('class_booking_window'))){
					echo "<td colspan='6'><b>Classes can only be booked a day in advance</b></td>";
					return;
				}
				
				else if(isset($_POST['is_sport']) && $start_date > $todaySports->modify($this->config->item('sports_booking_window'))){
					echo "<td colspan='6'><b>Sports can only be booked a week in advance</b></td>";
					return;
				}

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

		echo "$start_date $end_date";

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


	/**
	 * Cancel a booking
	 */
	function cancelBooking(){

		if(check_member()){


			if(isset($_POST['class_booking_id'])){

				$class_booking_id = $_POST['class_booking_id'];
				$member_id = $this->tank_auth->get_user_id();


				$this->bookings->removeMember($class_booking_id, $member_id);
				$this->classes->removeSportClass($class_booking_id); //if class is a sport need to remove the class as well

			}
			$this->mybookings();
		}

	}

	/**
	 * Cancel a booking
	 */
	function cancelWaiting(){

		if(check_member()){


			if(isset($_POST['class_booking_id'])){

				$class_booking_id = $_POST['class_booking_id'];
				$member_id = $this->tank_auth->get_user_id();

				$this->bookings->removeWaiting($class_booking_id, $member_id);

			}
			$this->mybookings();
		}

	}

	/**
	 * User Past Bookings List
	 */
	public function mybookings(){

		if(check_member()){

			$member_id = $this->tank_auth->get_user_id();

			$this->load->Model($page = 'bookings');

			$data['bookings'] = $this->bookings->getClassBookingByMember($member_id);
			$data['bookingsPast'] = $this->bookings->getClassBookingByMember($member_id);
			$data['waiting'] = $this->bookings->getAllWaiting($member_id);
			$data['bookingMember'] = $member_id;

			$rowCount = 0;
			$rowCounter = 0;

			foreach ($data['bookings'] as $row){

				$end = $row['end'];

				if(time() > strtotime($end)){

					unset($data['bookings'][$rowCount]);				

				}

				$rowCount++;			

			}

			foreach ($data['bookingsPast'] as $row){

				$end = $row['end'];

				if(time() < strtotime($end)){

					unset($data['bookingsPast'][$rowCounter]);				

				}

				$rowCounter++;			

			}

			parse_temp($page, $this->load->view('pages/member/mybookings', $data, true));

		}

	}
}
?>
