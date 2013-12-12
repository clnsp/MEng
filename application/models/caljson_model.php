<?php

Class Caljson_Model extends CI_Model{

	/*
	 * Function for fetching all rooms 
	 */
	function fetchData($start, $end){
	
		$this -> db -> select('class_type AS title, class_start_date AS start, class_end_date AS end, category, class_id, max_attendance, room, room_tbl.room_id, color');
		$this -> db -> from('class_tbl');
		$this -> db -> where('class_start_date BETWEEN "' . $start . '" AND "' . $end . '"');
		$this -> db -> join('room_tbl', 'room_tbl.room_id = class_tbl.room_id');
		$this -> db -> join('category_tbl', 'category_tbl.category_id = class_tbl.category_id');
		$this -> db -> join('class_type_tbl', 'class_type_tbl.class_type_id = class_tbl.class_type_id');

		$query = $this -> db -> get();

		return $query->result();
	}

	/*
	 * Fetch those attending a class
	 */
	function fetchClassAttendants($class){
		$this -> db -> select('member_id, username');
		$this -> db -> from('class_booking_tbl');
		$this -> db -> where('class_id', $class);
		$this -> db -> join('users', 'users.id = class_booking_tbl.member_id');

		$query = $this -> db -> get();

		return $query->result();
	}


	/*
	 * Fetch a rooms specific classes 
	 */
	function fetchRoomData($start, $end, $room){

		if($room != 'allrooms'){
		$this -> db -> select(' class_type AS title, class_start_date AS start, class_end_date AS end, category, class_id, max_attendance, room, room_tbl.room_id, color');
			$this -> db -> from('class_tbl');
			$this -> db -> where('class_tbl.room_id',$room, ' start BETWEEN "' . $start . '" AND "' . $end . '"');
			$this -> db -> join('room_tbl', 'room_tbl.room_id = class_tbl.room_id');
			$this -> db -> join('category_tbl', 'category_tbl.category_id = class_tbl.category_id');
			$this -> db -> join('class_type_tbl', 'class_type_tbl.class_type_id = class_tbl.class_type_id');

		}else{
			return $this->fetchData($start, $end);
		}

		$query = $this -> db -> get();

		return $query->result();
	}

	/*
	 * Fetch all the data
	 */
	function fetchAllData(){


		$this -> db -> select('*');
			$this -> db -> from('class_tbl');
		$query = $this -> db -> get();

		return $query->result();
	}
}
?>

