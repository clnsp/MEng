<?php

Class Courts extends CI_Model{

	private $possible_sports_tbl = 'possible_sports_tbl';
	private $sports_divisions_tbl = 'sports_divisions_tbl';
	private $sports_to_divisions_view = 'sports_to_divisions_view';
	private $sports_playing_area_tbl = 'sports_playing_area_tbl';


//id	int(11)			No	None	AUTO_INCREMENT	 Change Change	 Drop Drop	 More Show more actions
// 2	room_id	int(11)			No	None		 Change Change	 Drop Drop	 More Show more actions
// 3	class_type_id	int(11)			No	None		 Change Change	 Drop Drop	 More Show more actions
// 4	description
 
 	/**
 	* Add a new possible sport to the databasepossible_sports_tbl
 	* @param array
 	*/
	function addPossibleSport($data) {
	
		$this->db->insert($this->possible_sports_tbl, $data); 
		return $this->db->insert_id();
	}
	
	/**
	* Add a new division for a room
	* @param int
	* @param int
	* @param int
	*/
	function addCourt($room_id, $division_number) {
		$this->db->insert($this->sports_playing_area_tbl, array('room_id'=>$room_id, 'division_number'=>$division_number )); 
		return $this->db->insert_id();
	}
	
	/**
	* Get a division id for a room
	* @param array
	*/
	function getDivision($room_id, $division_number) {
	
		$this->db->select('id');
		$this -> db -> where('division_number', $division_number);
		$theid = $this->db->get($this->sports_playing_area_tbl)->row('id');
		echo "The id for division_numer ". $division_number ." is ". $theid;
		return $theid;

	}
	
	/**
	* Get all possible sports for a room
	* @param array
	*/
	function getPossibleSports($room_id) {
	
		$this->db->select('id, class_type_id');
		$this -> db -> where('room_id', $room_id);
		
		return $this->db->get($this->possible_sports_tbl)->result_array();

	}
	
	/**
	* Get all the sport instances mapped to divisions
	* @param array
	*/
	function getSportsToDivisions($room_id) {
	
		$this -> db -> where('room_id', $room_id);
		
		return $this->db->get($this->sports_to_divisions_view)->result_array();

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
	* Add a new possible sport to the databasepossible_sports_tbl
	* @param array
	* @return int - new id
	*/
	function removeSportToCourt($possible_sports_id, $sports_playing_area_id) {
	echo "Assigning [" .$possible_sports_id ."] [".  $sports_playing_area_id. "] <br>";
		$data = array(
			'possible_sports_id'=>$possible_sports_id, 
			'sports_playing_area_id'=>$sports_playing_area_id
		);
		$this->db->insert($this->sports_divisions_tbl, $data); 
		
		echo $this->db->_error_message();
		
	}
	
	/**
 	* Add a new possible sport to the databasepossible_sports_tbl
 	* @param array
 	* @return int - new id
 	*/
	function assignSportToCourt($possible_sports_id, $sports_playing_area_id) {
	echo "Assigning [" .$possible_sports_id ."] [".  $sports_playing_area_id. "] <br>";
		$data = array(
			'possible_sports_id'=>$possible_sports_id, 
			'sports_playing_area_id'=>$sports_playing_area_id
		);
		$this->db->insert($this->sports_divisions_tbl, $data); 
		
		echo $this->db->_error_message();
		
	}
	


}
?>
