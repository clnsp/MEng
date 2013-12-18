<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Classes
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @author	MEng Project
 */
class Classes extends CI_Model
{
	private $table_name			= 'class_tbl';			// user accounts


	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;

	}


	/**
	 * Get bookings between two dates
	 *
	 * @param	date
	 * @param	date
	 * @return	object
	 */
	function getClassessBetween($start, $end){ //getBookingsBetween used to be

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
	 * Fetch a rooms specific classes 
	 */
	function getClassesWithRoomBetween($start, $end, $room){

		if($room != 'allrooms'){
			$this -> db -> select(' class_type AS title, class_start_date AS start, class_end_date AS end, category, class_id, max_attendance, room, room_tbl.room_id, color');
			$this -> db -> from('class_tbl');
			$this -> db -> where('class_tbl.room_id',$room, ' start BETWEEN "' . $start . '" AND "' . $end . '"');
			$this -> db -> join('room_tbl', 'room_tbl.room_id = class_tbl.room_id');
			$this -> db -> join('category_tbl', 'category_tbl.category_id = class_tbl.category_id');
			$this -> db -> join('class_type_tbl', 'class_type_tbl.class_type_id = class_tbl.class_type_id');

		}else{
			return $this->getClassessBetween($start, $end);
		}

		$query = $this -> db -> get();

		return $query->result();
	}

	/**
	 * Get attendants of a specific booking
	 *
	 * @param	int
	 * @return	object
	 */
	function getClassAttendants($class){ //getBookingAttendants
		$this -> db -> select("member_id, CONCAT_WS(' ', first_name, second_name) AS username", FALSE);
		$this -> db -> from('class_booking_tbl');
		$this -> db -> where('class_id', $class);
		$this -> db -> join('users', 'users.id = class_booking_tbl.member_id');

		$query = $this -> db -> get();

		return $query->result();
	}

	/**
	 * Count attendants of a specific booking
	 *
	 * @param	int
	 * @return	int
	 */
	function countClassAttendants($class){ 
		$this -> db -> select("member_id");
		$this -> db -> from('class_booking_tbl');
		$this -> db -> where('class_id', $class);

		return $this->db->count_all_results();
	}

	/**
	 * Get the maximum attendance for a specific class booking
	 *
	 * @param	int
	 * @return	object
	 */
	function getClassCapacity($class){ 
		$this -> db -> select('max_attendance');
		$this -> db -> from('class_tbl');
		$this -> db -> join('class_type_tbl', 'class_tbl.class_type_id = class_type_tbl.class_type_id');
		$this -> db -> where('class_id', $class);

		$query = $this -> db -> get();

		return $query->row()->max_attendance;
	}

}
