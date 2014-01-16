<?php

Class Categories extends CI_Model{


	private $category_tbl = 'category_tbl';

	/**
	 * Function for fetching all category data 
	 * @return array
	 */
	function getCategories(){
		$this -> db -> select('*');
		$this -> db -> from($this -> category_tbl);
		
		$query = $this -> db -> get();

		return $query->result_array();
	}

	/**
	 * Get all the category ids
	 * @return array 
	 */
	function getCategoryIDs(){
		$this->db->select('category_id');
		$this->db->from($this -> category_tbl); 

		return $this -> db -> get()->result_array();
	}

	
}
?>

