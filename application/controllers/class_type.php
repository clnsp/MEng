<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class class_type extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('classes');
		$this->load->model('classtype');

	}
	
	/**
	* Add new class type
	*/
	function addClassType(){
		if($this->tank_auth->is_admin()){
			if ($this->input->post('class_type') && $this->input->post('class_description') && $this->input->post('category_id')){
				$data = array(
					'class_type'		=>	$this->input->post('class_type'),
					'class_description'	=>	$this->input->post('class_description'),
					'category_id'		=>	$this->input->post('category_id'),
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
			if ($this->input->post('class_type') && $this->input->post('class_description') && $this->input->post('class_type_id') && $this->input->post('category_id')){	
				$data = array(
					'class_type'	=>	$this->input->post('class_type'),
					'class_description'	=>	$this->input->post('class_description'),
					'category_id'	=>	$this->input->post('category_id')
					);

				if($this->input->post('duration')){
					$data['duration'] = $this->input->post('duration');
				}

				$this->classes->updateClassType($this->input->post('class_type_id'), $data);
				echo "Class type updated";
			}	
		}

	}

	/**
	 * Remove class type
	 */
	function removeClassType(){
		if($this->tank_auth->is_admin()){
			if ($this->input->post('class_type_id')){			
				$this->classes->removeClassType($this->input->post('class_type_id'));
				echo "Class type removed";
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
		
		$types = $this->classtype->getSportClassTypeNameIDs();
		echo json_encode($types);

	}
	
	/**
	* Add new sport type
	*/
	function addSportType(){
		if($this->tank_auth->is_admin()){
			if ($this->input->post('class_type') && $this->input->post('class_description') && $this->input->post('category_id') && $this->input->post('duration')){
				$data = array(
					'class_type'		=>	$this->input->post('class_type'),
					'class_description'	=>	$this->input->post('class_description'),
					'category_id'		=>	$this->input->post('category_id'),
					'is_sport'		=>	true,
					'duration'		=>	$this->input->post('duration')
					);

				$this->classes->addNewClassType($data);
				echo "Class Added";
			}else{
				echo "No values";
			}

		}
	}
	
	/**
	* Get all block booking details
	*/
	function getBlockBookingInformation(){
		if($this->tank_auth->is_admin()){
			echo json_encode($this->classtype->getBlockBookingInformation());
		}
	}
	
	/**
	* Get all block booking dates
	*/
	function getBlockBookingDates($bid){
		if($this->tank_auth->is_admin()){
			echo json_encode($this->classes->getBlockBookingDates($bid));
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

			if ($this->input->post('class_type_id') && $this->input->post('max_attendance') && $this->input->post('class_start_date') && $this->input->post('class_end_date')  && $this->input->post('room_id') && $this->input->post('repeat_dates')){

				/* validate the date formats*/
				if($this->_validDate($this->input->post('class_start_date')) && $this->_validDate($this->input->post('class_end_date'))){
					$start =  new DateTime($this->input->post('class_start_date'));
					$end =  new DateTime($this->input->post('class_end_date'));
				} else {
					echo "Invalid date format";
					return;
				}

				/* check start is before end date */
				if($start > $end){
					echo("Class start time must be before the end time");
					return;
				}
				
				if($start == $end){
					echo("Start and end cannot be the same.");
					return;
				}

				/* check the class type id exists */
				if(!$this->classes->validClassType($this->input->post('class_type_id'))){
					echo("Invalid class type");
					return;
				}

				/* check the room capacity isn't exceeded */
				$this->load->model('rooms');
				if($this->rooms->exceedsClassTypeCapacity($this->input->post('room_id'), $this->input->post('max_attendance'))){
					echo("Exceeds class capacity");
					return;
				}


				$newClass = array(
					'class_type_id' => $this->input->post('class_type_id'),
					'max_attendance' => $this->input->post('max_attendance'),
					'room_id' => $this->input->post('room_id'),
					);

				$start_time = new DateTime($this->input->post('class_start_date'));
				$start_time = $start_time->format('H:i:00');

				$end_time = new DateTime($this->input->post('class_end_date'));
				$end_time = $end_time->format('H:i:00');

				$bid = $this->classtype->addNewBlockBooking($newClass, $start_time, $end_time);

				$newClass['block_booking_id'] = $bid;

				foreach ($this->input->post('repeat_dates') as $key => $date) {
					$date = new DateTime($date);
					$date = $date->format('Y-m-d');

					$newClass['class_start_date'] = "$date $start_time";
					$newClass['class_end_date'] = "$date $end_time";


					$roomBooked = $this->classes->isRoomBookedOut($this->input->post('room_id'), $date, $date, $start_time, $end_time);

					if($roomBooked){
						echo("Room clash with class at $start_time to $end_time on $date<br>");
						continue;
					}

					$this->classes->insertClass($newClass);
				}

				echo("Classes saved");

			}else{
				echo("Missing parameters");	
			}
		}
	}





}

/* End of file welcome.php */
/* Location: ./application/controllers/class_types.php */
