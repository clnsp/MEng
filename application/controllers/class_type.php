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
			$start_time = $start_time->format(' H:m:00');
			
			$end_time = new DateTime($_POST['class_end_date']);
			$end_time = $end_time->format(' H:m:00');

			foreach ($_POST['repeat_dates'] as $key => $date) {
				$date = new DateTime($date);
				$date = $date->format('Y-m-d');
								
				$newClass['class_start_date'] = $date . $start_time;
				$newClass['class_end_date'] = $date . $end_time;
				
				$this->classes->insertClass($newClass);				

			}
			

			// /* repeat once */
			// if($_POST['repeat'] == '0'){
			// 	$this->classes->insertClass($newClass);
			// 	echo("Inserted single class");
			// }else{
				
			// 	$times = 0;
			// 	if(isset($_POST['times'])){
			// 		$times =intval($_POST['times']);
			// 	}
			// 	//$this->_repeatInsertClass($start, $end, $times, "+1 " . $_POST['repeat'], $newClass);					
			// }
			
		}else{
			echo("Missing parameters");	
		}
	}
}


	/**
	 * Repeatedly inserts a class a number of times between a certain interval
	 * @param	int
	 * @param	string
	 * @param	array
	 */
	
	function _repeatInsertClass($start, $end, $times = 0, $interval, $classInfo) {

		for($i=0; $i < $times; $i++){
		
			$classInfo['class_start_date'] = $start->modify($interval)->format('Y-m-d H:0:0');
			$classInfo['class_end_date'] = $end->modify($interval)->format('Y-m-d H:0:0');
			
			$this->classes->insertClass($classInfo);
			
		}
		echo("Inserted classes");
		

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


}

/* End of file welcome.php */
/* Location: ./application/controllers/class_types.php */