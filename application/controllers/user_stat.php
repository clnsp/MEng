<?php

class user_stat extends CI_Controller{

	function getUserAttendance(){

	if(checkAdmin()){
		
		$this->load->model('members');

		}

	}

}

?>
