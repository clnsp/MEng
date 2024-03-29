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
	 * @return	void
	 */
	function setColor($category_id, $color){
	
		$this->db->where('category_id', $category_id);
		$this->db->update($this -> category_tbl, array('color' => $color)); 

	}
	
	/**
	 * Add new category
	 * @param	string - title
	 * @param	string - hex value
	 * @return	void
	 */
	function addCategory($category, $color){
		
		$data = array(
		   'category' => $category ,
		   'color' => $color,
		);
		
		$this->db->insert($this -> category_tbl, $data); 

	}
	
	/**
	 * Remove categories
	 * @param	array
	 * @return 	bool - whether an error occured
	 */
	function removeCategories($categories){	
		$this->db->where_in('category_id', $categories);
		$this->db->delete($this -> category_tbl);

		if ($this->db->_error_number()==1451){
			header("Cannot remove",TRUE,304);
			echo "You cannot remove categories that are assigned to classes\n";
		}

		return $this->db->_error_number() == 0;

	}
	
	/**
	 * Set the name of a category
	 * @param	int
	 * @param	string
	 * @return	void
	 */
	function setName($category_id, $category){		
		$this->db->where('category_id', $category_id);
		$this->db->update($this -> category_tbl, array('category' => $category)); 

	}	

	
}/* End of file categories.php */  
/* Location: ./application/models/categories.php */ 
?>


