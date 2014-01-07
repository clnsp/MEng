<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Classes
 *
 * This model represents functions for classes. 
 * Classes are an instance of a specific class type.
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

		$this -> db -> select('class_type AS title, class_start_date AS start, class_end_date AS end, category, class_tbl.category_id, class_id, max_attendance, room, room_tbl.room_id, color, cancelled');
		$this -> db -> from($this -> table_name);
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
			$this -> db -> select(' class_type AS title, class_start_date AS start, class_end_date AS end, category, class_tbl.category_id, class_id, max_attendance, room, room_tbl.room_id, color, cancelled');
			$this -> db -> from($this -> table_name);
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
	 * Get the maximum attendance for a specific class
	 *
	 * @param	int
	 * @return	object
	 */
	function getClassCapacity($class_id){ 
		$this -> db -> select('max_attendance');
		$this -> db -> from($this -> table_name);
		$this -> db -> join('class_type_tbl', 'class_tbl.class_type_id = class_type_tbl.class_type_id');
		$this -> db -> where('class_id', $class_id);

		$query = $this -> db -> get();

		return $query->row()->max_attendance;
	}

	/**
	 * Get the end date of a specific class
	 *
	 * @param	int
	 * @return	string
	 */
	function getClassEndDate($class_id){
		$this -> db -> select("class_end_date");
		$this -> db -> from($this -> table_name);
		$this -> db -> where('class_id', $class_id);

		$query = $this -> db -> get();
		$arr = $query->result_array();

		return $arr[0]["class_end_date"];
	}

	/**
	 * Cancel a class
	 *
	 * @param	int
	 * @param 	int
	 */
	function cancelClass($class_id, $cancel){

		$data = array(
			'cancelled' => $cancel,
			);

		$this->db->where('class_id', $class_id);
		$this->db->update($this -> table_name, $data); 

	}
	
	/**
	 * Check whether a class is cancelled
	 *
	 * @param	int
	 * @return	bool
	 */
	function isClassCancelled($class_id){
		$this->db->select('cancelled');
		$this->db->from($this -> table_name); 
		$this -> db -> where('class_id', $class_id);
		
		$query = $this -> db -> get();
		if ($query->num_rows() == 1){
			$cancelled = $query->row(1)->cancelled;

			return  $cancelled == "1";
		}
		
		return false;
	}

	/**
	 * Populate a number of random classes into the database.
	 * eg. addRandomClasses(10, 60*60*24*7, 2) generates 10 classes between a week from today and the next two months
	 * 
	 * @param int - number of classes to generate
	 * @param int - offset is the time in seconds from now to start generating the classes
	 * @param int - number of months you want to generate classes for
	 */
	function addRandomClasses($num, $offset, $months){

		// Get all the class types
		$this->db->select('class_type_id');
		$this->db->from('class_type_tbl'); 
		$classTypes = $this -> db -> get()->result_array();
		$maxCTindex = count($classTypes)-1;

		//get all the room ids
		$this->db->select('room_id');
		$this->db->from('room_tbl'); 
		$roomIds = $this -> db -> get()->result_array();
		$maxRindex = count($roomIds)-1;

		//get all categories
		$this->db->select('category_id');
		$this->db->from('category_tbl'); 
		$categoryIds = $this -> db -> get()->result_array();
		$maxCatindex = count($categoryIds)-1;

		$now = time('Y-m-d h:i:s') + $offset;

		

		for ($i = 1; $i <= $num; $i++) {

			//select random class type
			$class_type_id = $classTypes[rand(0, $maxCTindex)]['class_type_id'];

			//start and end date one hour apart
			$randtime = $now + rand(30, 60 * 60 * 24 * 30 * $months);
			$class_start_date = date('Y-m-d h:0:0',  $randtime);
			$class_end_date = date('Y-m-d h:0:0', strtotime('+1 hours', $randtime));

			//max attendance random no. between 5 and 50
			$max_attendance = rand(5, 50);
			$max_attendance = $max_attendance - ($max_attendance%10);

			//select random room
			$room_id = $roomIds[rand(0, $maxRindex)]['room_id'];

			//select random category
			$category_id = $categoryIds[rand(0, $maxCatindex)]['category_id'];

			echo $i . 'Inserting: class_type_id: ' . $class_type_id . ' start: '. $class_start_date . ' end: ' .  $class_end_date  . ' room_id: ' . $room_id . ' category_id:' . $category_id . ' max_attendance: '. $max_attendance .  ' cancelled: 0' . "<br/>";

			$data = array(
				'class_type_id' => $class_type_id ,
				'class_start_date' => $class_start_date ,
				'class_end_date' => $class_end_date ,
				'room_id' => $room_id,
				'category_id' => $category_id,
				'max_attendance' => $max_attendance,
				'cancelled' => 0,
				);

			$this->db->insert($this -> table_name, $data); 
			

		}


		



		
	}
}
