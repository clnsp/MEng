<?php

Class Dbviews extends CI_Model{

	private $table_name = 'attended_view';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this -> table_name  = $ci -> config -> item('db_table_prefix', 'tank_auth').$this -> table_name;
		$this -> profile_table_name = $ci -> config -> item('db_table_prefix', 'tank_auth').$this -> profile_table_name;
	}

	/*
	 * Function for fetching all rooms 
	 * Returned as an array
	 */
	function getRooms()
	{
		$query = $this -> db -> get('room_tbl');
		return $query -> result();
	}
	
	function getUserByID($id) //was fetchUser($id)
	{
		$this -> db -> select('first_name, second_name, email, home_number, mobile_number, twitter');
		$this -> db -> from($this -> table_name);
		$this -> db -> where('id', $id);
		
		$query = $this -> db -> get();   
		return $query->result();
	}
	
  function getBookingByID($booking_id) // was get_booking_by_id
  {
  	$this->db->where('class_booking_id', $booking_id);

  	$query = $this -> db -> get($this -> table_name);
  	return $query -> result();  
  }
  
  function getClassAttendance($class_id)
  {
  	$this -> db -> where('class_id', $class_id);
  	$query = $this -> db -> get('attended_view');
  	
  	return $query -> result();
  }
  function getUserAttendance($member_id)
  {
  	$this -> db -> where('member_id', $member_id);
  	$query = $this -> db -> get('attended_view');
  	
  	return $query -> result();
  }
  function getUserLastAttendance($member_id)
  {
  	$this->db->select('attended_view.*');
  	$this->db->select_max('class_start_date');
  	$this -> db -> where('member_id', $member_id);
  	$query = $this -> db -> get('attended_view');
  	
  	return $query -> result();
  }
  
  function getClassNonAttendance($class_id)
  {
  	$this -> db -> where('class_id', $class_id);
  	$query = $this -> db -> get('not_attended_view');
  	
  	return $query -> result();
  }
  function getUserNonAttendance($member_id)
  {
  	$this -> db -> where('member_id', $member_id);
  	$query = $this -> db -> get('not_attended_view');
  	
  	return $query -> result();
  }
}
?>





