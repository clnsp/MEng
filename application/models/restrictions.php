<?php

Class Restrictions extends CI_Model{

	private $limit_tbl = 'sports_restriction_limit';
	private $limit_view = 'sports_restriction_limit_view';
	private $block_tbl = 'sports_restriction_block';
	private $block_view = 'sports_restriction_block_view';

	/*
   * Add new limit restriction
   * @param int
   * @param int
   * @param int
   * @return	void
   */
	function addLimitRestriction($room_id, $sport_id, $limit){  
		$data = array(
			'sport_id'=>$sport_id,
			'limit' => $limit,
			'room_id' => $room_id,
			);

		$this->db->insert($this -> limit_tbl, $data);
	} 


	/*
   * Remove limit restriction
   * @param int
   * @param int
   * @return	void
   */
	function removeLimitRestriction($room_id, $sport_id){  
		$data = array(
			'sport_id'=>$sport_id,
			'room_id' => $room_id
			);

		$this->db->where($data);
		$this->db->delete($this -> limit_tbl);

	} 


   /* Add new block restriction
   * @param int
   * @param int
   * @param int
   * @return	void
   */
	function addBlockRestriction($room_id, $sport_to_block_id, $occurring_sport_id){  
		$data = array(
			'divisible_room_id'=>$room_id,
			'sport_to_block_id' => $sport_to_block_id,
			'occurring_sport_id' => $occurring_sport_id,
			);

		$this->db->insert($this -> block_tbl, $data);
		
	} 


   /* Remove block restriction
   * @param int
   * @param int
   * @param int
   * @return	void
   */
	function removeBlockRestriction($room_id, $sport_to_block_id, $occurring_sport_id){  
		$data = array(
			'divisible_room_id'=>$room_id,
			'sport_to_block_id' => $sport_to_block_id,
			'occurring_sport_id' => $occurring_sport_id,
			);

		$this->db->where($data);
		$this->db->delete($this -> block_tbl);
	} 

	/**
	 * Fetch the limit restrictions for particular room
	 * @param int
	 * @return array
	 */
	function getLimitRestrictions($room_id){  
		$this -> db -> select('sport_id, limit, class_type');
		$this -> db -> from($this -> limit_view);
		$this -> db -> where('room_id', $room_id);

		$query = $this->db->get();
		return $query ->result_array();
	} 

	/**
	 * Fetch the block restrictions
	 * @param int
	 * @return array
	 */
	function getBlockRestrictions($room_id){  

		$this -> db -> select('sport_to_block, sport_to_block_id, occurring_sport_id, occurring_sport');
		$this -> db -> from($this -> block_view);
		$this -> db -> where('divisible_room_id', $room_id);

		$query = $this->db->get();
		return $query ->result_array();
	} 
	
	
	/**
	 * Fetch the sports that block a specific sport
	 * @param int
	 * @param int
	 * @return array
	 */
	function getSportsThatBlock($room_id, $sport_to_block_id){  

		$this -> db -> select('occurring_sport_id');
		$this -> db -> from($this -> block_view);
		$this -> db -> where('divisible_room_id', $room_id);
		$this -> db -> where('sport_to_block_id', $sport_to_block_id);
		
		$query = $this->db->get();

		$arr = array();

		foreach ($query ->result_array() as $key => $blocked) {
			array_push($arr, $blocked['occurring_sport_id']);
		}

		return $arr;
	} 

}
/* End of file restrictions.php */  
/* Location: ./application/models/restrictions.php */ 
?>


