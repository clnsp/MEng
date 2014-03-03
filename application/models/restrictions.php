<?php

Class Restrictions extends CI_Model{

	private $limit_tbl = 'sports_restriction_limit';
	private $block_tbl = 'sports_restriction_block';

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

}
?>