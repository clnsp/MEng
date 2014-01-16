<?php

Class Rooms extends CI_Model{

	/**
	 * Function for fetching all rooms 
	 * @return array
	 */
	function getRooms()	{
		$query = $this -> db -> get('room_tbl');

		return $query->result_array();
	}

	/**
	* Function for fetching all room ids
	* @return array
	*/
	function getRoomIDS(){
		$this->db->select('room_id');
		$this->db->from('room_tbl'); 
		
		return $this -> db -> get()->result_array();
	}


	//getRoomByName
	//getRoomById
	//getRoomByCapacity
	
}
?>