<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Court extends CI_Controller{
	function __construct() {
		parent::__construct();

		$this->load->model('courts');
		$this->load->model('restrictions');

	}

	/**
	* Assigns sports to divisions
	* Expect post data in the form:
	* [sport_number]
	* 	=> [division sets] 
	*		=> [1, 2]
	*		=> [1]
	* 		=> [3, 4]
	*/
	function assignSports(){  
		if(isset($_POST['data']) && isset($_POST['room_id'])){
			foreach ($_POST['data'] as $class_type_id => $div_set) {
				if(!empty($div_set)){
					
					$possibleSport = array(
						'class_type_id' => $class_type_id,
						'room_id' => $_POST['room_id']
						);
					
					foreach ($div_set as $sport_number => $divs) {

						if(is_array($divs)){
							foreach ($divs as $key => $div) {
								if(!$this->courts->assignSportToCourt($_POST['room_id'], $div, $class_type_id, $sport_number)){
									echo "<br>Not added<br>";
								}

							}
						}
						
					}
				}
			}

			echo "Saved courts";
			
		}
	} 
	
	/**
	* Fetches all possible sports assigned to a room
	* Creates an xml document
	*/
	function getCourtDirectory($room_id=''){
		if($this->tank_auth->is_admin()){
			if($room_id!=''){

				$dir = array();

			//fetch the possible sports
				$rows = $this->courts->getSportsToDivisions($room_id);
				foreach ($rows as $key => $row) {

					if(!isset($dir[$row['class_type_id']])){
						$dir[$row['class_type_id']] = array();
					}
					
					if(!isset($dir[$row['class_type_id']][$row['sport_number']])){
						$dir[$row['class_type_id']][$row['sport_number']] = array();
					}

					array_push($dir[$row['class_type_id']][$row['sport_number']], $row['division_number']);
				}

				echo(json_encode($dir, true));
			}else{
				echo("Please supply a room id");
			}
		}
	}

	/**
	* Removes a sport instance on a room
	*/
	function removeSportInstance() {
		if($this->tank_auth->is_admin()){
			if(isset($_POST['room_id']) && isset($_POST['class_type_id']) && isset($_POST['sport_number'])){
				$this->courts->removeSportInstance($_POST['room_id'], $_POST['class_type_id'], $_POST['sport_number']);
				echo $this->db->_error_message();
			}
		}
		
	}
	
	/**
	* Add new block restriction
	*/
	function addBlockRestriction() {
		if($this->tank_auth->is_admin()){

			if(isset($_POST['room_id']) && isset($_POST['sport_to_block_id']) && isset($_POST['occurring_sport_id'])){
				if($_POST['room_id'] != '' && $_POST['sport_to_block_id']!='' && $_POST['occurring_sport_id']!='' ){
					$this->restrictions->addBlockRestriction($_POST['room_id'], $_POST['sport_to_block_id'], $_POST['occurring_sport_id']);
					echo "Saved";
				}else{
					echo "Not Saved";
				}
			}
		}
		
	}
	
	/**
	* Add new limit restriction
	*/
	function addLimitRestriction() {
		if($this->tank_auth->is_admin()){
			if(isset($_POST['room_id']) && isset($_POST['sport_id']) && isset($_POST['limit'])){

				if($_POST['room_id']!=''){
					echo "No room selected";
					return;
				}
				if($_POST['sport_id'] != '' && $_POST['limit']!=''){
					$this->restrictions->addLimitRestriction($_POST['room_id'], $_POST['sport_id'], $_POST['limit']);
					echo "Saved";
				}else{
					echo "Missing sport or limit";
				}

			}
		}
		
	}

	/**
	* Remove limit restriction
	*/
	function removeBlockRestriction() {
		if($this->tank_auth->is_admin()){
			if(isset($_POST['room_id']) && isset($_POST['sport_to_block_id']) && isset($_POST['occurring_sport_id'])){
				$this->restrictions->removeBlockRestriction($_POST['room_id'], $_POST['sport_to_block_id'], $_POST['occurring_sport_id'] );
				echo "Removed";
			}
		}
	}

	/**
	* Remove Limiy restriction
	*/
	function removeLimitRestriction() {
		if($this->tank_auth->is_admin()){
			if(isset($_POST['room_id']) && isset($_POST['sport_id'])){
				$this->restrictions->removeLimitRestriction($_POST['room_id'], $_POST['sport_id']);
				echo "Removed";
			}
		}

	}

	/**
	* Get all restrictions
	*/
	function getRestrictions($room_id){
		if($this->tank_auth->is_admin()){
			$restrictions = array(
				'limits' => $this->restrictions->getLimitRestrictions($room_id),
				'blocks' => $this->restrictions->getBlockRestrictions($room_id)
				);
			echo json_encode($restrictions);
		}
	}



}

/* End of file room.php */
/* Location: ./application/controllers/court.php */