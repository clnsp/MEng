<?php

Class Caljson_Model extends CI_Model{

	/*
	 * Function for fetching all rooms 
	 */
	function fetchData($start, $end){


		$this -> db -> select('title, description, start, end');
		$this -> db -> from('allan');
		$this -> db -> where('start BETWEEN "' . $start . '" AND "' . $end . '"');
		
		$query = $this -> db -> get();

		return $query->result();
	}

	/*
	 * Fetch a rooms spefici fata 
	 */
	function fetchRoomData($start, $end, $room){

		if($room != 'allrooms'){
			$this -> db -> select('title, description, start, end');
			$this -> db -> from('allan');
			$this -> db -> where('room',$room, ' start BETWEEN "' . $start . '" AND "' . $end . '"');

		}else{
			return $this->fetchAllData();
		}

		$query = $this -> db -> get();

		return $query->result();
	}

	/*
	 * Fetch all the data
	 */
	function fetchAllData(){


		$this -> db -> select('title, description, start, end');
		$this -> db -> from('allan');
		$query = $this -> db -> get();

		return $query->result();
	}
}
?>

