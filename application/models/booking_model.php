<?php

Class Booking_Model extends CI_Model{
	
	/*
	 * Add a user to a class booking
	 */
	function add_member($class_booking_id, $member_id){
				$data = array(
	               'member_id' => $member_id,
	               'class_id' => $class_booking_id,
	               'attended' => 0,
	               
	               );
				echo ('inserting');
				$this->db->insert('class_booking_tbl', $data); 	
	}
	

}