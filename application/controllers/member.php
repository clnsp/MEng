<?php
class Member extends CI_Controller{


	/*
	 * Get user details for editing
	 */
	function getUserDetails(){
		$this->load->model('members');

		if (isset($_GET['id'])){
			$q = strtolower($_GET['id']);
			echo json_encode($this->members->getUserByID($q));                
		}                
	}
	
	/*
	 * Update User details
	 */
	function updateUserDetails(){
		$this->load->model('members');
		if(isset($_POST['id']) && isset($_POST['changes'])){
			echo $this->members->updateUser(strtolower($_POST['id']), array_map('strtolower',$_POST['changes']));
		}
$_POST['first_name'];
	}
	
	/*
	 * Get Memberships for User
	 */
	function getUserMemberships(){
		if(isset($_POST['id']))
		{
			$this->load->model('members');
			$this->members->getMemberships($id);
		}
	}

	/*
	 * User Attend Class
	 */
	function updateAttendance(){
		if(isset($_POST['pid']) && isset($_POST['cid']) &&  isset($_POST['at'])){
			$this->load->model('members');
			$this->members->attendance($_POST['pid'],$_POST['cid'],$_POST['at']);
		}
	}


	
	/*
	 * Update User Membership
	 */
	function updateUserMembership(){
		
	}
	
	/*
	 * Block / unBlock / Delete
	 */
	function alterUserExistance(){
		
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
				if(!$this->config->item('twitter_allow')) 
				{
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

?>
