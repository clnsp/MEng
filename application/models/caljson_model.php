<?php

Class Caljson_Model extends CI_Model{

	function fetchData($start, $end){


		$this -> db -> select('title, description, start, end');
		$this -> db -> from('allan');
   		$this -> db -> where('start BETWEEN "' . $start . '" AND "' . $end . '"');

//$this->db->where("$accommodation BETWEEN $minvalue AND $maxvalue");

		$query = $this -> db -> get();

		return $query->result();
	}

	function fetchAllData(){


		$this -> db -> select('title, description, start, end');
		$this -> db -> from('allan');
		$query = $this -> db -> get();

		return $query->result();
	}
}
?>

