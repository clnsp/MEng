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
	
	/*
	 * Contact User
	 */
 // TODO TIDY UP ***
	function contactUser() {
	$this->load->model('members');
	//$this->config->load('communication',true);
	if(isset($_POST['id']) && isset($_POST['service']) && isset($_POST['message']))
	{
                $id = $_POST['id'];
		$service = strtolower($_POST['service']);
                $message = $_POST['message'];

		switch ($service) {
		// EMAIL
		case "email":
			$query = $this->members->getUserColumn($id, 'email'); 
			if(count($query[0]) == 1){
				$this->load->helper('email');
				send_email($query[0]->email, 'Gym Message', $message);				
			}
			break;
		// SMS
		case "sms":  
			$this->load->helper('sms');
			$mobile_number = $this->members->getUserColumn($id, 'mobile_number');
			// GET MOBILE NUMBER
			echo send_sms($mobile_number[0]->mobile_number,$message);
			break;
		// TWITTER
		case "twitter":
            $twitter_name = $this->members->getUserColumn($id, 'twitter'); 
			if(!$this->config->item('twitter_allow')) 
			{
				echo "Service Disabled";
			}
			break;
		default:
			echo $service;
		}
	}
	else
	{
		echo "Incomplete";
	}
	}
    }
    ?>
