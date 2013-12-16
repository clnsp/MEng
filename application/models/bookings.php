<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Bookings
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
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
	
	/*
	 * Add a user to a class booking
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
	
	/*
	 * Remove a user from a class booking
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
	 * Get attendants of a specific bookings
	 *
	 * @param	int
	 * @return	object
	 */
	function getBookingAttendants($class){
		$this -> db -> select('member_id, username');
		$this -> db -> from('class_booking_tbl');
		$this -> db -> where('class_id', $class);
		$this -> db -> join('users', 'users.id = class_booking_tbl.member_id');

		$query = $this -> db -> get();

		return $query->result();
	}


}
