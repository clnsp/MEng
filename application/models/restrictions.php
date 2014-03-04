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
	 * @return array
	 */
	function getBlockRestrictions($room_id){  
		$this->db->where('divisible_room_id', $room_id);
		return $this->db->get($this-> block_view)->result_array();

		$this -> db -> select('sport_id, limit, class_type');
		$this -> db -> from($this -> limit_view);
		$this -> db -> where('room_id', $room_id);

		$query = $this->db->get();
		return $query ->result_array();
	} 

}
?>