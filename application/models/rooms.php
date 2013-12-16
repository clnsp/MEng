<?php

Class Rooms extends CI_Model{

	/*
	 * Function for fetching all rooms 
	 * Returned as an array
	 */
	function getRooms(){


		$this -> db -> select('*');
		$this -> db -> from('room_tbl');
		
		$query = $this -> db -> get();



		return $query->result_array();
	}

	
}
?>

