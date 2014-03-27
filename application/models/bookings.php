<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Bookings
 *
 * This model represents member bookings into classes
 *
 * @author	MEng Project
 */
class Bookings extends CI_Model
{
	private $class_booking_tbl	= 'class_booking_tbl';			// user accounts
	private $waiting_pool_tbl	= 'waiting_pool_tbl';			// user accounts

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->class_booking_tbl = $ci->config->item('db_table_prefix', 'tank_auth').$this->class_booking_tbl;

	}

	/**
	 * Get booking by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function getBookingByID($booking_id){// was get_booking_by_id
		if(check_admin()){
			$this->db->where('class_booking_id', $booking_id);

			$query = $this -> db -> get($this -> class_booking_tbl);
			return $query -> result();  
		}
	}

	/**
	 * Get booking by Member
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function getBookingByMember($member_id){ // was get_booking_by_member
		if(check_admin()){
			$this -> db -> where('member_id', $member_id);

			$query = $this -> db -> get($this -> class_booking_tbl);
			return $query -> result();
		}
	}
	
	function getBookingByMemberView($member_id){
		if(check_admin()){
			$this -> db -> where('member_id', $member_id);

			$query = $this -> db -> get('member_attendance_view');
			return $query -> result();
		}
	}

	/**
	 * Get class bookings by Member
	 *
	 * @return	object
	 */
	function getClassBookingByMember($member_id){

		$this -> db -> select("*");
		$this -> db -> from($this -> class_booking_tbl);
		$this -> db -> where('member_id', $member_id);
		$this -> db -> join('class_info_view', 'class_info_view.class_id = class_booking_tbl.class_id');
		$query = $this -> db -> get();

		return $query -> result_array();

	}

	/**
	 * Get specific class bookings by Member
	 *
	 * @return	object
	 */
	function getClassForMember($member_id, $class_id){

		$this -> db -> select("*");
		$this -> db -> from($this -> class_booking_tbl);
		$this -> db -> where('member_id', $member_id);
		$this -> db -> where('class_id', $class_id);
		$query = $this -> db -> get();

		return $query -> result_array();

	}

	/**
	 * Get booking by Class Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function getBookingByClassID($class_id){
		$this->db->where('class_id', $class_id);

		$query = $this -> db -> get($this -> class_booking_tbl);
		return $query -> result();
		
	}
	
	/**
	 * Add a user to a class
	 * @param int
	 * @param int 
	 * @param bool
	 */
	function addMember($class_booking_id, $member_id){ // was add_member

		$data = array(
			'member_id' => $member_id,
			'class_id' => $class_booking_id,
			'attended' => 0,

			);

		$this->db->insert($this -> class_booking_tbl, $data); 	

		return ($this->db->_error_number() == 0);
		
	}
	
	/**
	 * Remove a user from a class booking
	 * @param int
	 * @param int
	 */
	function removeMember($class_booking_id, $member_id){ // was remove_member

		$data = array(
			'member_id' => $member_id,
			'class_id' => $class_booking_id,				   
			);
		$this->db->delete($this -> class_booking_tbl, $data); 	
		
	}
	
	/**
	 * Count attendants of a specific booking
	 *
	 * @param	int
	 * @return	int
	 */
	function countBookingAttendants($class_id){ 

	//Removed check admin so i can reuse it for searching for classes
	//if(check_admin()){
		$this -> db -> select("member_id");
		$this -> db -> from($this -> class_booking_tbl);
		$this -> db -> where('class_id', $class_id);

		return $this->db->count_all_results();
	//	}
	}
	
	/**
	 * Count attendance of a specific member
	 *
	 * @param	int
	 * @param	int
	 * @return	int
	 */
	function countMemberAttendance($member_id, $att=1){
		if(check_admin()){	
			$this -> db -> select("class_id");
			$this -> db -> from($this -> class_booking_tbl);
			$this -> db -> where('member_id', $member_id);
			$this -> db -> where('attended', $att);

			return $this->db->count_all_results();
		}
	}

	/**
	 * Get attendants of bookings for a specific class
	 *
	 * @param	int
	 * @return	object
	 */
	function getBookingAttendants($class_id){
		if(check_admin()){
			$this -> db -> select("member_id, CONCAT_WS(' ', first_name, second_name) AS username", FALSE);
			$this -> db -> from($this -> class_booking_tbl);
			$this -> db -> where('class_id', $class_id);
			$this -> db -> join('users', 'users.id = class_booking_tbl.member_id');

			$query = $this -> db -> get();

			return $query->result();
		}
	}

	/**
	 * Get attendants of bookings for a specific class by name -- Colin
	 *
	 * @param	int
	 * @return	object
	*/
	function getBookingAttendantsNames($class_id){
		if(check_admin()){
			$this -> db -> select("member_id, first_name, second_name, attended, email ", FALSE);
			$this -> db -> from($this -> class_booking_tbl);
			$this -> db -> where('class_id', $class_id);
			$this -> db -> join('users', 'users.id = class_booking_tbl.member_id');
			$query = $this -> db -> get();

			return $query->result();
		}
	}

	/**
	 * Get ids of attendants for class
	 *
	 * @param	int
	 * @return	array
	*/
	function getBookingAttendantsIDs($class_id){
		$this -> db -> select("member_id");
		$this -> db -> from($this -> class_booking_tbl);
		$this -> db -> where('class_id', $class_id);
		$query = $this -> db -> get();

		return $query->result_array();

	}

	/**
	 * Get email addresses associated with bookings for a class
	 *
	 * @param	int
	 * @return	array
	 */
	function getBookingEmails($class_id){
		if(check_admin()){
			$this -> db -> select("email");
			$this -> db -> from($this -> class_booking_tbl);
			$this -> db -> where('class_id', $class_id);
			$this -> db -> join('users', 'users.id = class_booking_tbl.member_id');

			$query = $this -> db -> get();

			return $query->result_array();
		}
	}



 	/**
 	* Determine whether a user is already booked into a class or sport at particular time
 	* @param int
 	* @param string - date
 	* @param string - time
 	* @param string - time
 	* @return bool
 	*/
 	function isMemberBookedOut($member_id, $date, $start_time, $end_time){
 		$this -> db -> select('*');

 		$this -> db -> where('member_id', $member_id);
 		$this -> db -> where('cancelled', 0);

 		$this -> db -> where("DATE(class_start_date) >= '$date'");
 		$this -> db -> where("DATE(class_end_date) <= '$date'");

 		$this->db->where("((TIME(class_start_date) <= '$start_time' AND TIME(class_end_date) > '$start_time') OR (TIME(class_end_date) < '$end_time' AND TIME(class_start_date) >= '$end_time'))");

 		// $this->db->or_where("");
 		// $this->db->where("");

 		$this->db->from($this->class_booking_tbl);
 		$this -> db -> join('class_tbl', 'class_booking_tbl.class_id = class_tbl.class_id');
 		
 		$query = $this -> db -> get();
 		// echo $this->db->last_query();
 		// echo $this->db->_error_message();
 		return $query->result_array();
 	}
 	
	// May need check if member
 	function getAllWaiting($member_id){

 		$this -> db -> select('*');


 		$this -> db -> where('member_id', $member_id);

 		$this -> db -> from($this->waiting_pool_tbl);

 		$this -> db -> join('class_info_view', 'class_info_view.class_id = waiting_pool_tbl.class_id');

 		$query = $this -> db -> get();

 		return $query -> result_array();

 	}

	// May need check if member
 	function removeWaiting($class_booking_id, $member_id){

 		$data = array(
 			'member_id' => $member_id,
 			'class_id' => $class_booking_id,				   
 			);
 		$this->db->delete($this -> waiting_pool_tbl, $data);

 	}
 	
 }
