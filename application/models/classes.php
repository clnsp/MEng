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
	private $table_name			= 'class_tbl';	
	private $class_type_tbl			= 'class_type_tbl';	

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
	 * Returns all the possible class type ids
	 * @return array
	 */
	function getClassTypeIDs(){
		$this->db->select('class_type_id');
		$this->db->from($this -> class_type_tbl); 

		return $this -> db -> get()->result_array();
	}
	
	/**
	 * Returns class type information
	 * @return array
	 */
	function getClassTypes(){
		$this->db->from($this -> class_type_tbl); 

		return $this -> db -> get()->result_array();
	}

	/**
	 * Insert a new class
	 * @param array
	 */
	function insertClass($data){
		$this->db->insert($this -> table_name, $data); 
	}
	
	/**
	 * Get class information
	 *
	 * @param	int
	 * @return	object
	 */
	function getClassInformation($class_id){

		$this -> db -> select('class_type, class_start_date, class_end_date, room');
		$this -> db -> from($this -> table_name);
		$this -> db -> where('class_id =' . $class_id);
		$this -> db -> join('class_type_tbl', 'class_type_tbl.class_type_id = class_tbl.class_type_id');
		$this -> db -> join('room_tbl', 'room_tbl.room_id = class_tbl.room_id');

		$query = $this -> db -> get();

		return $query->row_array();
	}
	
	/**
	 * Insert a new class type
	 * @param string
	 * @param string
	 */
	function addNewClassType($class_type, $class_description){
	$data = array(
		'class_type'		=>	$class_type,
		'class_description'	=>	$class_description
	);
	
		$this->db->insert($this -> class_type_tbl, $data); 
	}
	
	/**
	 * Update a class type
	 * @param int
	 * @param string
	 * @param string
	 */
	function updateClassType($class_type_id, $class_type, $class_description){
	
	$data = array(
		'class_type'		=>	$class_type,
		'class_description'	=>	$class_description
	);
	
		$this->db->where('class_type_id', $class_type_id);
		$this->db->update($this -> class_type_tbl, $data); 
	}	

}
