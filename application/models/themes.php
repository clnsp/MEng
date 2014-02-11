<?php

Class Themes extends CI_Model{

	private $theme_tbl = 'theme_tbl';


	/**
	 * Retrieves all theme properties stored
	 */
	function getThemeProperties(){  

		$query = $this->db->get($this -> theme_tbl);
		
		return $query->result_array();  
	} 

	/**
	 * Save theme proc_close(process)perties
	 * @param array
	 */
	function saveTheme($theme){  

		foreach ($theme as $key => $value) {
			$this->db->where('identifier', $key);
			$this->db->update($this -> theme_tbl, array('value' => $value)); 
		}

		echo "Updated";

	} 

}
?>