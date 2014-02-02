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
				$this->classes->addNewClassType($_POST['class_type'], $_POST['class_description'], $_POST['category_id']);
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
				$this->classes->updateClassType($_POST['class_type_id'], $_POST['class_type'], $_POST['class_description'], $_POST['category_id']);
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

		if (isset($_POST['class_type_id']) && isset($_POST['max_attendance']) && isset($_POST['class_start_date']) && isset($_POST['class_end_date'])  && isset($_POST['room_id'])){
		
			/* validate the date formats*/
			if($this->_validDate($_POST['class_start_date']) && $this->_validDate($_POST['class_end_date'])){
				$start =  date('Y-m-d H:0:0', strtotime($_POST['class_start_date']));
				$end =  date('Y-m-d H:0:0', strtotime($_POST['class_end_date']));
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
				'class_start_date' => $_POST['class_start_date'],
				'class_end_date' => $_POST['class_end_date'],
				'room_id' => $_POST['room_id'],
			);
			
			/* repeat once */
			if($_POST['repeat'] ==0 || $_POST['class_type_id'] == ''){
				$this->classes->insertClass($newClass);
					
			}

			
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
		
		return(!($date["month"] == '' && $date["day"]=='' && $date["year"] =='' && $date["hour"] == '' && $date["minute"]=='' && $date["second"]==''));

	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/class_types.php */