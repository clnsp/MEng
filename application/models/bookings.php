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
	private $table_name			= 'class_booking_tbl';			// user accounts


	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;

	}

	/**
	 * Get booking by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function getBookingByID($booking_id) // was get_booking_by_id
	{
		$this->db->where('class_booking_id', $booking_id);

		$query = $this -> db -> get($this -> table_name);
		return $query -> result();  
	}

	/**
	 * Get booking by Member
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function getBookingByMember($member_id) // was get_booking_by_member
	{
		$this -> db -> where('member_id', $member_id);

		$query = $this -> db -> get($this -> table_name);
		return $query -> result();
	}

	/**
	 * Get booking by Class Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function getBookingByClassID($class_id)
	{
		$this->db->where('class_id', $class_id);

		$query = $this -> db -> get($this -> table_name);
		return $query -> result();
	}
	
	/**
	 * Add a user to a class
	 * @param int
	 * @param int 
	 */
	function addMember($class_booking_id, $member_id) // was add_member
	{
		$data = array(
			'member_id' => $member_id,
			'class_id' => $class_booking_id,
			'attended' => 0,

			);
		echo ('inserting');
		$this->db->insert($this -> table_name, $data); 	
	}
	
	/**
	 * Remove a user from a class booking
	 * @param int
	 * @param int
	 */
	function removeMember($class_booking_id, $member_id) // was remove_member
	{
		$data = array(
			'member_id' => $member_id,
			'class_id' => $class_booking_id,				   
			);
		$this->db->delete($this -> table_name, $data); 	
	}


	/**
	 * Count attendants of a specific booking
	 *
	 * @param	int
	 * @return	int
	 */
	function countBookingAttendants($class_id){ 
		$this -> db -> select("member_id");
		$this -> db -> from($this -> table_name);
		$this -> db -> where('class_id', $class_id);

		return $this->db->count_all_results();
	}


	/**
	 * Get attendants of bookings for a specific class
	 *
	 * @param	int
	 * @return	object
	 */
	function getBookingAttendants($class_id){
		$this -> db -> select("member_id, CONCAT_WS(' ', first_name, second_name) AS username", FALSE);
		$this -> db -> from($this -> table_name);
		$this -> db -> where('class_id', $class_id);
		$this -> db -> join('users', 'users.id = class_booking_tbl.member_id');

		$query = $this -> db -> get();

		return $query->result();
	}
	
	
	/**
	 * Get email addresses associated with bookings for a class
	 *
	 * @param	int
	 * @return	array
	 */
	function getBookingEmails($class_id){
		$this -> db -> select("email");
		$this -> db -> from($this -> table_name);
		$this -> db -> where('class_id', $class_id);
		$this -> db -> join('users', 'users.id = class_booking_tbl.member_id');

		$query = $this -> db -> get();

		return $query->result_array();
	}


}
