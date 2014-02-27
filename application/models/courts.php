<?php

Class Courts extends CI_Model{

	private $sports_playing_area_tbl = 'sports_playing_area_tbl';
	private $sports_to_divisions_tbl = 'sports_to_divisions_tbl';



	/**
	* Add a new division for a room
	* @param int
	* @param int
	* @return int
	*/
	function addDivision($room_id, $division_number) {
		$this->db->insert($this->sports_playing_area_tbl, array('room_id'=>$room_id, 'division_number'=>$division_number )); 
		return $this->db->insert_id();
	}

	/**
	* Clear divisions associated with a room
	* @param int
	*/
	function clearDivisions($room_id){
		$this->db->where('room_id', $room_id);

		$this->db->delete($this->sports_playing_area_tbl); 
	}
	


	/**
	* Removes a sport instance on a room
	* @param int
	* @param int
	* @param int
	* @return bool
	*/
	function removeSportInstance($room_id, $class_type_id, $sport_number) {
		$this->db->where('room_id', $room_id);
		$this->db->where('class_type_id', $class_type_id);
		$this->db->where('sport_number', $sport_number);

		echo $room_id . " " . $class_type_id . " " . $sport_number;

		$this->db->delete($this->sports_to_divisions_tbl); 
		echo $this->db->_error_message();
		return $this->db->affected_rows() > 0;
	}
	

	
	/**
	* Get all the sport instances mapped to divisions
	* @param array
	*/
	function getSportsToDivisions($room_id) {

		$this -> db -> where('room_id', $room_id);
		
		return $this->db->get($this->sports_to_divisions_tbl)->result_array();

	}	
	/**
	* Get all divisions for a room
	* @param array
	*/
	function getDivisions($room_id) {

		$this->db->select('id');
		$this -> db -> where('room_id', $room_id);
		
		return $this->db->get($this->sports_playing_area_tbl)->result_array();

	}
	

	/**
	* Assign a sport to a court
	* @param int
	* @param int
	* @param int
	* @param int
	* @return bool
	*/
	function assignSportToCourt($room_id, $division_number, $class_type_id, $sport_number) {

		$data = array(
			'room_id'=>$room_id, 
			'division_number'=>$division_number,
			'class_type_id'=>$class_type_id,
			'sport_number'=>$sport_number,
			);
		
		$this->db->insert($this->sports_to_divisions_tbl, $data); 

		return ($this->db->_error_number() != 1062);

	}

 	/**
 	* Remove any divisions that are outwith range
 	* eg. max_court 4 would remove exisiting courts 5, 6
 	* @param int
 	* @param int
 	*/
 	function clearExcessDivisions($room_id, $max_court){
 		$this->db->where('room_id', $room_id);
 		$this->db->where('division_number >', $max_court);

 		$this->db->delete($this->sports_playing_area_tbl); 
 	}

 }
 ?>
