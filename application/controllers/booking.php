<?php
//birds.php
class Booking extends CI_Controller{

	/*Add a user to a class booking*/
	function add_member(){
		$this->load->model('booking_model');

		if (isset($_POST['member_id']) && isset($_POST['class_booking_id'])){
			$m = strtolower($_POST['member_id']);
			$b = strtolower($_POST['class_booking_id']);
			$this->booking_model->add_member($b, $m);
		}
		
		
	}


	/*Add a user to a class booking*/
	function remove_member(){
		$this->load->model('booking_model');



		if (isset($_POST['member_id']) && isset($_POST['class_booking_id'])){

			foreach($_POST['member_id'] as $mid){
				$m = strtolower($mid);
				$b = strtolower($_POST['class_booking_id']);
				$this->booking_model->remove_member($b, $m);
			}

		}
		
		
	}


	
	
}

?>