<?php
//birds.php
class Booking extends CI_Controller{

	/*Add a user to a class booking*/
	function add_member(){
		$this->load->model('booking_model');
		$mid= $this->input->post('member_id');
        $bid= $this->input->post('class_booking_id');
        echo('Booking_controller bid['.$bid.'] mid['.$mid);
        
        
        
		if (isset($_POST['member_id']) && isset($_POST['class_booking_id'])){
			$m = strtolower($_POST['member_id']);
			$b = strtolower($_POST['class_booking_id']);
			echo('preparing to visit model with ' . $b . $m);
			$this->booking_model->add_member($b, $m);
		}
		
		
	}
	

	
	
}

?>