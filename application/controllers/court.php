<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Court extends CI_Controller{
	function __construct() {
		parent::__construct();

		$this->load->model('courts');
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
			echo("Room: " . $_POST['room_id'] . '<br>');
			foreach ($_POST['data'] as $class_type_id => $div_set) {
				if(!empty($div_set)){
					echo ("Sport: " . $class_type_id);
					
					$possibleSport = array(
						'class_type_id' => $class_type_id,
						'room_id' => $_POST['room_id']
						);
					
					foreach ($div_set as $sport_number => $divs) {

					//	$sport_number['sport_number'] = $key;
					//	$sportID = $this->courts->addPossibleSport($possibleSport);

						if(is_array($divs)){
							foreach ($divs as $key => $div) {
								echo(" ".$div);
							//$div_num = $this->courts->getDivision($_POST['room_id'], $div);
								$this->courts->assignSportToCourt($_POST['room_id'], $div, $class_type_id, $sport_number);						
							}
						}
						
					}
				}
			}
			
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
				//echo(json_encode($rows));
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
	* @param int
	* @param int
	* @param int
	*/
	function removeSportInstance($room_id, $class_type_id, $sport_number) {
		echo $this->courts->removeSportInstance($room_id, $class_type_id, $sport_number);
	}
	
}

/* End of file room.php */
/* Location: ./application/controllers/room.php */