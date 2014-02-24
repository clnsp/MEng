<?php
class Member extends CI_Controller{


	/*
	 * Get user details for editing
	 */
	function getUserDetails(){
	if(check_admin()){
		$this->load->model('members');

		if (isset($_GET['id'])){
			$q = strtolower($_GET['id']);
			echo json_encode($this->members->getUserByID($q));                
		}      
}		
	}
	
	/*
	 * Update User details
	 */
	function updateUserDetails(){
	if(check_admin()){
		$this->load->model('members');
		if(isset($_POST['id']) && isset($_POST['changes'])){
			echo $this->members->updateUser(strtolower($_POST['id']), array_map('strtolower',$_POST['changes']));
		}
		}

	}
	


	function createUserChanges(){
	if(check_admin()){
		$this->load->model('members');
		$this->load->library('tank_auth');
		
		$new_details['first_name']       = $_POST['first_name'];
		$new_details['second_name']      = $_POST['second_name'];
		//$new_details['email']            = $_POST['email'];
		$new_details['home_number']      = $_POST['home_number'];
		$new_details['mobile_number']    = $_POST['mobile_number'];
		$new_details['twitter']          = $_POST['twitter'];
		$new_details['comms_preference'] = $_POST['comms_preference'];
		
		$_POST['changes'] = $new_details;
		
		echo $this->members->updateUser(strtolower($this->tank_auth->get_user_id()), array_map('strtolower',$_POST['changes']));
		redirect('auth/load_details');
		}
	}
	
	/*
	 * Get Memberships for User
	 */
	function getMembershipOptions(){
	if(check_admin()){
		if(isset($_GET['id'])){
			$this->load->model('members');
			echo json_encode($this->members->getMembershipTypes($_GET['id']));
		}
		}
	}

	/*
	 * User Attend Class
	 */
	function updateAttendance(){
	if(check_admin()){
		if(isset($_POST['pid']) && isset($_POST['cid']) &&  isset($_POST['at'])){
			$this->load->model('members');
			$this->members->attendance($_POST['pid'],$_POST['cid'],$_POST['at']);
		}
		}
	}
	/*
	 * Get User Attendance Record
	 */
	function getAttendance(){
	if(check_admin()){
		if(isset($_GET['id']))
		{
			$this->load->Model('Bookings');
			$vals['show'] = $this->Bookings->countMemberAttendance($_GET['id']);
			$vals['fail'] = $this->Bookings->countMemberAttendance($_GET['id'],0);
			echo json_encode($vals);
		}
		}
	}
	
	/*
	 * Get User Bookings
	 */
	
	function getBookings($page = 'class_booking_view'){
	if(check_admin()){
		if(isset($_GET['id']))
		{
			$this->load->Model('Categories');
			/*$this->load->Model('classes');
			$this->load->Model('Bookings');
			
			$vals['bookings'] = $this->Bookings->getBookingByMember($_GET['id']);*/
			$data['categories'] = $this->Categories->getCategories();
			
			/*foreach ($vals['bookings'] as $book){ 
				$book->cla = $this->classes->getClassInformation($book->class_id)
			}*/
		$this->load->view('pages/admin/'.$page, $data);
		}
		}
	}
	
	/*
	 * Update User Membership
	 */
	function updateUserMembership(){
		$this->load->helper('twitter');
		//send_tweet("Graeme_Clark", "Did it work ?");
		print_r (user_following("StrathCSR"));//("shadowbeam_"));//("Graeme_Clark"));
	}
	
	/*
	 * Delete
	 */
	function deleteUser(){
	if(check_admin()){
		if(isset($_POST['id']) && isset($_POST['reason'])){
			$this->load->model('members');
			$user = $this->members->getUserByID($_POST['id']);
			$this->members->deleteUserAccount($_POST['id']);			
		}
		}
	}
	
	function serverTime()
	{
		$myTime = array('serverTime' =>  date("U"));	
		echo json_encode($myTime);	
	}
	
	/*
	 * Contact User
	 */
	function contactUser() {
	if(check_admin()){
		$this->load->model('members');
		if(isset($_POST['id']) && isset($_POST['service']) && isset($_POST['message']))
		{
			$id = $_POST['id']; // User ID
			$service = strtolower($_POST['service']); // Communication Service
			$message = $_POST['message']; // Message

			switch ($service) {
			// SMS
				case "sms":  
				$this->load->helper('sms');
				$mobile_number = $this->members->getUserColumn($id, 'mobile_number');
				// GET MOBILE NUMBER
				if(isset($mobile_number[0])){
					echo send_sms($mobile_number[0]->mobile_number,$message);
				}
				break;
			// TWITTER
				case "twitter":
				$twitter_name = $this->members->getUserColumn($id, 'twitter'); 
				if(!$this->config->item('twitter_allow')){
					echo "Service Disabled";
				}
				break;
			// EMAIL
				default:
				$query = $this->members->getUserColumn($id, 'email'); 
				if(count($query[0]) == 1){
					$this->load->helper('email');
					send_email($query[0]->email, 'Gym Message', $message);				
				}
				break;
			}
		}
		else
		{
			echo "Incomplete";
		}
	}
	}
}

?>
