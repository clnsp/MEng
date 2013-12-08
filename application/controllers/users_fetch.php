<?php
//birds.php
class Users_Fetch extends CI_Controller{


	function get_users(){
		$this->load->model('user_model');
		
		if (isset($_GET['term'])){
			$q = strtolower($_GET['term']);
			$this->user_model->get_user($q);
		}
		
		
	}
	
	/*
	 * Get users from associated with a class booking
	 */
	function get_class_attendants(){
		$this->load->model('caljson_model');
	
	 if (isset($_GET['class'])){
		$q = strtolower($_GET['class']);
		echo json_encode($this->caljson_model->fetchClassAttendants($q));		
	}
	
	}
}

?>