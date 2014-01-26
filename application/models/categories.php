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
	
	/**
	 * Set the color of a category
	 * @param	int
	 * @param	string - hex value
	 */
	function setColor($category_id, $color){
		echo ('updating ' + $category_id + ' ' + $color);
		
		$this->db->where('category_id', $category_id);
		$this->db->update($this -> category_tbl, array('color' => $color)); 

	}
	
	/**
	 * Add new category
	 * @param	string - title
	 * @param	string - hex value
	 */
	function addCategory($category, $color){
		echo ('inserting ' + $category + ' ' + $color);
		
		$data = array(
		   'category' => $category ,
		   'color' => $color,
		);
		
		$this->db->insert($this -> category_tbl, $data); 

	}
	
	/**
	 * Remove categories
	 * @param	array 
	 */
	function removeCategories($categories){	
		$this->db->where_in('category_id', $categories);
		$this->db->delete($this -> category_tbl);

	}
	
	/**
	 * Set the name of a category
	 * @param	int
	 * @param	string
	 */
	function setName($category_id, $category){
		echo ('updating ' + $category_id + ' ' + $category);
		
		$this->db->where('category_id', $category_id);
		$this->db->update($this -> category_tbl, array('category' => $category)); 

	}	
}
?>

