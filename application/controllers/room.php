<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Room extends CI_Controller{
	function __construct() {
		parent::__construct();

		$this->load->model('rooms');
	}

	/**
	 * Get room names and ids
	 * @return	void
	 */
	function getRoomIDs(){ 
		
		$rooms = $this->rooms->getRoomNameIDs();
		echo json_encode($rooms);
	}

}

/* End of file room.php */
/* Location: ./application/controllers/room.php */