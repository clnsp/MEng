<?php

Class Rooms extends CI_Model{

	private $table_name = 'room_tbl';
	private $divisible_rooms_tbl = 'divisible_rooms_tbl';

	/**
	 * Function for fetching all descriptions
	 * @return array
	 */
	function retrieve_descriptions(){  
		$this->db->select('description'); 
		$this -> db -> from($this -> table_name); 
		$query = $this -> db ->get();

		return $query->result_array();  
	}             
	
	/**
	 * Function for fetching all titles
	 * @return array
	 */
	function retrieve_titles(){  
		$this->db->select('room'); 
		$this -> db -> from($this -> table_name); 
		$query = $this -> db ->get();

		return $query->result_array();  
	} 

	/**
	 * Function for fetching all ids
	 * @return array
	 */
	function retrieve_ids(){  
		$this->db->select('room_id'); 
		$this -> db -> from($this -> table_name); 
		$query = $this -> db ->get();
		
		return $query->result_array();  
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

	/**
	* Retrieve information about all divisible rooms
	* @return array
	*/
	function getDivisibleRooms(){
		$this->db->select('room_tbl.room_id, cols, rows, room_tbl.room');
		$this->db->from($this -> divisible_rooms_tbl);
		$this->db->join('room_tbl', 'room_tbl.room_id = divisible_rooms_tbl.room_id');

		return $this->db->get()->result_array();  
	}

	/**
	* Retrieve the divisible room information
	* @param int
	* @return array
	*/
	function getDivisibleRoom($room_id){
		$this->db->from($this -> divisible_rooms_tbl);
		$this->db->where('room_id', $room_id);

		return $this->db->get()->result_array();  
	}
	
	/**
	* Determines whether a room is already divisible
	* @param int
	* @return bool
	*/
	function isDivisible($room_id){
		$this->db->select('room_id');
		$this->db->from($this -> divisible_rooms_tbl); 
		$this->db->where('room_id', $room_id);

		return ($this->db->get()->num_rows() > 0);
	}

	/**
	* Updates a divisible room properties
	* @param int
	* @return	void
	*/
	function removeDivisibleRoom($room_id){
		$this->db->delete($this -> divisible_rooms_tbl, array('room_id' => $room_id)); 
	}

	/**
	* Insert or update divisible room
	* @param int
	* @param int
	* @param int
	* @return	void
	*/
	function insertDivisibleRoom($room_id, $rows, $cols){
		$data = array(
			'room_id' => $room_id,
			'rows' => $rows,
			'cols' => $cols
			);

		$sql = $this->db->insert_string($this -> divisible_rooms_tbl, $data) . ' ON DUPLICATE KEY UPDATE rows='.$rows.', cols='.$cols;

		$result = $this->db->query($sql);
		
	}
	
	/**
	 * Fetch the size of a divisivle room
	 * @param int
	 * @return	void
	 */
	function getRoomSize($room_id){

		$this->db->select('rows*cols as size', FAlSE);
		$this->db->from($this -> divisible_rooms_tbl);
        $query = $this->db->get()->result_array();

		 return $query[0]['size'];
	}
	
}
/* End of file rooms.php */  
/* Location: ./application/models/rooms.php */
?>

 
