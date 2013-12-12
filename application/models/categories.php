<?php

Class Categories extends CI_Model{

	/*
	 * Function for fetching all rooms 
	 * Returned as an array
	 */
	function getCategories(){


		$this -> db -> select('*');
		$this -> db -> from('category_tbl');
		
		$query = $this -> db -> get();

		return $query->result_array();
	}

	
}
?>

