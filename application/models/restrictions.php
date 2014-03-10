<?php

Class Restrictions extends CI_Model{

	private $limit_tbl = 'sports_restriction_limit';
	private $limit_view = 'sports_restriction_limit_view';
	private $block_tbl = 'sports_restriction_block';
	private $block_view = 'sports_restriction_block_view';

	/**
	 * Adds a new limit restriction
	 */
	function addLimitRestriction($room_id, $sport_id, $limit){  
		$data = array(
			'sport_id'=>$sport_id,
			'limit' => $limit,
			'room_id' => $room_id,
			);

		$this->db->insert($this -> limit_tbl, $data);
	} 

	/**
	 * Removes a limit restriction
	 */
	function removeLimitRestriction($room_id, $sport_id){  
		$data = array(
			'sport_id'=>$sport_id,
			'room_id' => $room_id
			);

		$this->db->where($data);
		$this->db->delete($this -> limit_tbl);

	} 

	/**
	 * Adds a new block restriction
	 */
	function addBlockRestriction($room_id, $sport_to_block_id, $occurring_sport_id){  
		$data = array(
			'divisible_room_id'=>$room_id,
			'sport_to_block_id' => $sport_to_block_id,
			'occurring_sport_id' => $occurring_sport_id,
			);

		$this->db->insert($this -> block_tbl, $data);
	} 

	/**
	 * Removes a block restriction
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
	 * Fetch the block restriction ids
	 * @param int
	 * @return array
	 */
	function getBlockRestrictionIDs($room_id){  

		$this -> db -> select('sport_to_block, occurring_sport_id');
		$this -> db -> from($this -> block_view);
		$this -> db -> where('divisible_room_id', $room_id);

		$query = $this->db->get();
		return $query ->result_array();
	} 

}
?>