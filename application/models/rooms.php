<?php

Class Rooms extends CI_Model{

	/*
	 * Function for fetching all rooms 
	 * Returned as an array
	 */
	function getRooms()
	{
		$query = $this -> db -> get('room_tbl');
		return $query -> result();
	}

	//getRoomByName
	//getRoomById
	//getRoomByCapacity
	
}
?>