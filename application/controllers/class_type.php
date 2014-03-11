<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class class_type extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('classes');
	}
	
	/**
	* Add new class type
	*/
	function addClassType(){
		if($this->tank_auth->is_admin()){
			if (isset($_POST['class_type']) && isset($_POST['class_description']) && isset($_POST['category_id'])){
				$data = array(
				    'class_type'		=>	$_POST['class_type'],
				    'class_description'	=>	$_POST['class_description'],
				    'category_id'		=>	$_POST['category_id'],
				    'is_sport'			=>	false,
				);
			
				$this->classes->addNewClassType($data);
				echo "Class Added";
			}else{
				echo "No values";
			}

		}
	}
	
	/**
	 * Get all the class types as json
	 */
	function getClassTypes(){
		if($this->tank_auth->is_admin()){
			$types = $this->classes->getClassTypes();
			
			echo json_encode($types);

		}
	}
	

	
	/**
	 * Modify class type
	 */
	function updateClassType(){
		if($this->tank_auth->is_admin()){
			if (isset($_POST['class_type']) && isset($_POST['class_description']) && isset($_POST['class_type_id']) && isset($_POST['category_id'])){	
				$data = array(
				    'class_type'	=>	$_POST['class_type'],
				    'class_description'	=>	$_POST['class_description'],
				    'category_id'	=>	$_POST['category_id']
				    );
				    
				   if(isset($_POST['duration'])){
				   	$data['duration'] = $_POST['duration'];
				   }
					
				$this->classes->updateClassType($_POST['class_type_id'], $data);
				echo "Class type updated";
			}	
		}

	}

	/**
	 * Remove class type
	 */
	function removeClassType(){
		if($this->tank_auth->is_admin()){
			if (isset($_POST['class_type_id'])){			
				$this->classes->removeClassType($_POST['class_type_id']);
				echo "Class type removed";
			}	
		}

	}
	
	/**
	 * Add instances of a class type as classes
	 * The following values are mapped to the repeat types
	 *
	 * 0 None (run once)
	 * 1 Hourly
	 * 2 Daily
	 * 3 Weekly
	 * 4 Monthly
	 * 5 Yearly
	 */
	function addInstances(){
		if($this->tank_auth->is_admin()){

			if (isset($_POST['class_type_id']) && isset($_POST['max_attendance']) && isset($_POST['class_start_date']) && isset($_POST['class_end_date'])  && isset($_POST['room_id']) && isset($_POST['repeat_dates'])){

				/* validate the date formats*/
				if($this->_validDate($_POST['class_start_date']) && $this->_validDate($_POST['class_end_date'])){
					$start =  new DateTime($_POST['class_start_date']);
					$end =  new DateTime($_POST['class_end_date']);
				} else {
					echo "Invalid date format";
					return;
				}

				/* check start is before end date */
				if($start > $end){
					echo("Class start time must be before the end time");
					return;
				}

				/* check the class type id exists */
				if(!$this->classes->validClassType($_POST['class_type_id'])){
					echo("Invalid class type");
					return;
				}

				/* check the room capacity isn't exceeded */
				$this->load->model('rooms');
				if($this->rooms->exceedsClassTypeCapacity($_POST['room_id'], $_POST['max_attendance'])){
					echo("Exceeds class capacity");
					return;
				}

				$newClass = array(
					'class_type_id' => $_POST['class_type_id'],
					'max_attendance' => $_POST['max_attendance'],
					'room_id' => $_POST['room_id'],
					);

				$start_time = new DateTime($_POST['class_start_date']);
				$start_time = $start_time->format('H:m:00');

				$end_time = new DateTime($_POST['class_end_date']);
				$end_time = $end_time->format('H:m:00');

				foreach ($_POST['repeat_dates'] as $key => $date) {
					$date = new DateTime($date);
					$date = $date->format('Y-m-d');

					$newClass['class_start_date'] = $date . $start_time;
					$newClass['class_end_date'] = $date . $end_time;

					$this->classes->insertClass($newClass);
				}

				echo("Classes added");



			}else{
				echo("Missing parameters");	
			}
		}
	}



	/**
	 * Checks whether supplied string is a valid date
	 * @param	string
	 * @return	bool
	 */
	
	function _validDate($string) {
		$date = date_parse($string);	
		
		return(!($date["month"] == '' && $date["day"]=='' && $date["year"] =='' && $date["hour"] == '' && $date["minute"]==''));

	}

	/**
	 * Get all the sports class types as json
	 */
	function getSportsClassTypes(){
		$this->load->model('classtype');
		
		$types = $this->classtype->getSportClassTypeNameIDs();
		echo json_encode($types);

	}
	
	/**
	* Add new sport type
	*/
	function addSportType(){
		if($this->tank_auth->is_admin()){
			if (isset($_POST['class_type']) && isset($_POST['class_description']) && isset($_POST['category_id']) && isset($_POST['duration'])){
				$data = array(
				    'class_type'		=>	$_POST['class_type'],
				    'class_description'	=>	$_POST['class_description'],
				    'category_id'		=>	$_POST['category_id'],
				    'is_sport'			=>	true,
				    'duration'			=>	$_POST['duration']
			    );
			    
				$this->classes->addNewClassType($data);
				echo "Class Added";
			}else{
				echo "No values";
			}

		}
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/class_types.php */