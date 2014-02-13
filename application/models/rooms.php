<?php

Class Rooms extends CI_Model{

	private $table_name = 'room_tbl';
	private $divisible_rooms_tbl = 'divisible_rooms_tbl';


	function retrieve_descriptions(){  
		$this->db->select('description'); 

		$this -> db -> from($this -> table_name); 

		$query = $this -> db ->get();

		return $query->result_array();  
	}             
	

	function retrieve_titles(){  
		$this->db->select('room'); 

		$this -> db -> from($this -> table_name); 

		$query = $this -> db ->get();

		return $query->result_array();  
	} 


	function retrieve_ids(){  
		$this->db->select('room_id'); 

		$this -> db -> from($this -> table_name); 

		$query = $this -> db ->get();
		

		return $query->result_array();  
	}

	/**
	* Retrieve the divisible room information
	* @return array
	*/
	function getDivisibleRooms(){
		$this -> db -> from($this -> divisible_rooms_tbl); 
		return $this -> db ->get()->result_array();  
	}


	/**
	 * Function for fetching all rooms 
	 * @return array
	 */
	function getRooms()	{
		$query = $this -> db -> get($this -> table_name);

		return $query->result_array();
	}

	/**
	* Function for fetching all room ids
	* @return array
	*/
	function getRoomIDS(){
		$this->db->select('room_id');
		$this->db->from($this -> table_name); 
		
		return $this -> db -> get()->result_array();
	}

	/**
	* Function for fetching all room ids and names
	* @return array
	*/
	function getRoomNameIDS(){
		$this->db->select('room_id, room');
		$this->db->from($this -> table_name);
		
		return $this -> db -> get()->result_array();
	}
	
	/**
	 * Determines whether a value exceeds the capacity of the room
	 * @param	int
	 * @param	int
	 * @return	bool
	 */
	function exceedsClassTypeCapacity($room_id, $numberOfMembers){
		
		return $numberOfMembers =='';
		
		$this->db->select('max_capacity');
		$this->db->where('room_id', $room_id);
		$this->db->from($this -> table_name);

		return $numberOfMembers > $query[0]['max_capacity'];
		
	}	
	
}
?>
