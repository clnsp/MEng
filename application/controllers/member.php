<?php
class Member extends CI_Controller{

	/*
	 * Get user details for editing
	 * @return	void
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
	 * @return	void
	 */
	function updateUserDetails(){
		if(check_admin()){
			$this->load->model('members');
			if(isset($_POST['id']) && isset($_POST['changes'])){
				if(array_key_exists('email', $_POST['changes'])){
					$this->load->library('tank_auth');
					echo $this->tank_auth->change_email($_POST['changes']['email'],$_POST['id']);
					unset($_POST['changes']['email']);
				}

				if(array_key_exists('mobile_number', $_POST['changes'])){
					$this->load->library('tank_auth');
					unset($_POST['changes']['mobile_number']);
				}

				if(array_key_exists('twitter', $_POST['changes'])){
					$this->load->library('tank_auth');
					unset($_POST['changes']['twitter']);
				}
				if(count($_POST['changes'])>0){
					echo $this->members->updateUser(strtolower($_POST['id']), array_map('strtolower',$_POST['changes']));
				}
			}
		}
	}

	/*
	 * Create user settings
	 * @return	void
	 */
	function createUserChanges(){ // ISSET CHECKS 
	if(check_member()){
		$this->load->model('members');
		$this->load->library('tank_auth');
		
		$new_details['first_name']       = $_POST['first_name'];
		$new_details['second_name']      = $_POST['second_name'];
		//$new_details['email']            = $_POST['email'];
			/*if($_POST['comms_preference'] == 2){
			//TWITTER VALIDATION
			}

			if($_POST['comms_preference'] == 1){
			// SMS VALIDATION
			}
			*/
			$new_details['home_number']      = $_POST['home_number'];
			$new_details['mobile_number']    = $_POST['mobile_number'];
			$new_details['twitter']          = $_POST['twitter'];
			//$new_details['comms_preference'] = $_POST['comms_preference'];

			
			$_POST['changes'] = $new_details;
			$this->members->updateCommsPreference(strtolower($this->tank_auth->get_user_id()), $_POST['new_preferences']);
			
			if(isset($_POST['changes'])){
				echo $this->members->updateUser(strtolower($this->tank_auth->get_user_id()), array_map('strtolower',$_POST['changes']));
				redirect('auth/load_details');
			}
		}
	}
	
	/*
	 * Create permission changes
	 * @return	void
	 */
	function createPermissionChanges()
	{
		if(check_admin()){
			$this->load->model('members');
			$this->load->library('tank_auth');
			

			if(isset($_POST['new_admins'])){
				$admins = $_POST['new_admins'];
				$new_details['member_type_id'] = '8';
				$_POST['changes'] = $new_details;
				if(isset($_POST['changes'])){		  
					foreach ($admins as $a) {
						echo $this->members->updateUser($a, $new_details);
					}
				}
			}

			if(isset($_POST['new_supers'])){
				$supers = $_POST['new_supers'];
				$new_details['member_type_id'] = '7';
				$_POST['changes'] = $new_details;
				if(isset($_POST['changes'])){
					foreach ($supers as $s) {
		            	echo $this->members->updateUser($s, $new_details);
					}
				}
			}

			redirect('auth/admin');
		}
	}
	
	/*
	 * Get Memberships for User
	 * @return	void
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
	 * @return	void
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
	 * @return	void
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
	 * @return	void
	 */
	
	function getBookings($page = 'class_booking_view'){
		if(check_admin()){
			if($this->input->get('id'))
			{
				$this->load->Model('Categories');
				$this->load->Model('Bookings');
				
				$bookings = $this->Bookings->getBookingByMemberView($this->input->get('id'));
				$data['categories'] = $this->Categories->getCategories();
				$data['bookings'] = array();
				foreach ($bookings as $book){ 
					if(!isset($data['bookings'][$book->category_id])){
						$data['bookings'][$book->category_id] = array();
					}
					$data['bookings'][$book->category_id][] = $book;		
				}
				$this->load->view('pages/admin/'.$page, $data);
			}
		}
	}
			/*$this->load->helper('comms');
			create_mesage('','https://devweb2013.cis.strath.ac.uk');*/
			
	/*
	 * Update User Membership
	 * @return	void
	 */
	function updateUserMembership(){
		if(check_admin()){
			$this->load->model('members');
			if($this->input->post('id') && $this->input->post('membership') && $this->input->post('options')){ // CUSTOM MEMBERSHIP
$options = $this->input->post('options');
				if($this->input->post('membership')==-1 && $this->_validDate($options['start']) && $this->_validDate($options['end']))
				{
					$start =  new DateTime($options['start']);
					$end =  new DateTime($options['end']);
					$mem = $this->members->createNewMembership('Custom',$start->format('Y-m-d'),$end->format('Y-m-d'));
					echo $this->members->updateUser($this->input->post('id'),array('membership_type_id'=>$mem));
					return;
				}else {
					echo "Invalid date format";
					return;
				}
			}
			else if($this->input->post('id') && $this->input->post('membership')){ // AVAILABLE MEMBERSHIPS
				$avMeb = $this->members->getMembershipTypes($this->input->post('id'));
				foreach ($avMeb as $m){ 
					if (isset($m->id) && $m->id == $this->input->post('membership')) 
						echo $this->members->updateUser($this->input->post('id'),array('membership_type_id'=>$this->input->post('membership')));
				}
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
		
	/*
	 * Delete
	 */
	function deleteUser(){
		if(check_admin()){
			if($this->input->post('id') && $this->input->post('reason')){
				$this->load->model('members');
				$user = $this->members->getUserByID($this->input->post('id'));
				$this->members->deleteUserAccount($this->input->post('id'));			
			}
		}
	}
	
	function createMembership(){
		if(check_admin()){
			if($this->input->post('membership')){
			$Membership = json_decode($this->input->post('membership'));
			$this->load->model('members');
$start = new DateTime($Membership->start);
$end = new DateTime($Membership->end);
			$ID = $this->members->createNewMembership($Membership->name, $start->format('Y-m-d'), $end->format('Y-m-d'));
			for($i=0;$i<count($Membership->types);$i++){
				echo($this->members->createMembertoMembershipLink($Membership->types[$i],$ID));
			}
			}
		}
	}
	
	function deleteMembership(){
		if(check_admin()){
			if($this->input->post('id')){
				$this->load->model('members');
				$this->members->deleteMembership($this->input->post('id'));
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
	 * @param ids: Pass a single id or array of id for the message to be sent to
	 * @param messages: Pass a single message or array of messages 'email','sms','twitter' to send differnt messages using the different options
	 * $ids,$messages
	 */
	function contactUser() {
		if(check_admin()){
			if($this->input->post('id') && $this->input->post('message')){
				$this->load->helper('comms');
				contact_user(array($this->input->post('id')), $this->input->post('message'));
//echo json_encode( )
			}
		}
	}
}
/* End of file member.php */
/* Location: ./application/controllers/member.php */
?>

