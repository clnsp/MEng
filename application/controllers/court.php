<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Court extends CI_Controller{
	function __construct() {
		parent::__construct();

		$this->load->model('courts');
	}

	/**
	* Assigns sports to divisions
	* Expect post data in the form:
	* [sport_id]
	* 	=> [division sets] 
	*		=> [1, 2]
	*		=> [1]
	* 		=> [3, 4]
	*/
	function assignSports(){  
		if(isset($_POST['data']) && isset($_POST['room_id'])){
			echo("Room: " . $_POST['room_id'] . '<br>');
			
			foreach ($_POST['data'] as $sport_id => $div_set) {
				if(!empty($div_set)){
					echo ("Sport: " . $sport_id);
					
					$possibleSport = array(
					   'class_type_id' => $sport_id,
					   'room_id' => $_POST['room_id']
					);
					
					foreach ($div_set as $key => $divs) {
						echo("<br>");
						
						$possibleSport['sport_id'] = $key;
						$sportID = $this->courts->addPossibleSport($possibleSport);

						foreach ($divs as $key => $div) {
							echo(" ".$div);
							$div_num = $this->courts->getDivision($_POST['room_id'], $div);
							$this->courts->assignSportToCourt($sportID, $div_num);
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
			
			foreach ($rows as $key => $row) {
			
				if(isset($dir[$row['class_type_id']])){
					if(isset($dir[$row['class_type_id']][$row['sport_id']])){
						array_push($dir[$row['class_type_id']][$row['sport_id']], $row['division_number']);
					}else{
						$dir[$row['class_type_id']][$row['sport_id']] = array($row['division_number']);
					}
				}else{
					$dir[$row['class_type_id']] = array();
				}
				
			}
			
			//print_r($dir);
			echo(json_encode($dir, true));
			}else{
				echo("Please supply a room id");
			}
		}
	}
	
}

/* End of file room.php */
/* Location: ./application/controllers/room.php */