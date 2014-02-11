<?php

Class Comms_Preference extends CI_Model{

	/**
	 * Function for fetching all preferences 
	 * @return array
	 */
	function getPreferences()	{
	
	  $this->db->select('');
		$query = $this -> db -> get('comms_preference_tbl');

		return $query->result_array();
	}
	
}
?>