<?php

class userbook extends CI_Controller{

function __construct()
    {
        parent::__construct();
    }
	
    /*
* Get users from associated with a class booking
*/


   /*
    * Retrieves search results according to search parameters, also sorts date and time into the correct format
    * for the database queries.
    */
   function index($page = 'bookingsuccess'){
	
	  $this->load->Model('Classes');
	  $this->load->Model('Classtype');
     $this->load->model('bookings');
				
				
				
	$user_id = $this->tank_auth->get_user_id();
//	$username = $this->tank_auth->get_username();
 //   $class_type = $this->input->post('classname1');
    $classid = $this->input->post('classid');
	
	//echo $user_id;

 //   echo $classid;
  //  if (isset($_POST['user_id']) && isset($_POST['class_id'])){
   //     $m = strtolower($_POST['user_id']);
    //    $b = strtolower($_POST['class_id']);


   //     if(!$this->isClassBookedOut($classid) && !$this->isClassInPast($classid)){
   	$idtest = "31";
         $this->addMember($classid, $user_id);
          echo "Added";
		  $data['user_id'] = $this->tank_auth->get_user_id();
		  $data['class_id'] = $classid;

        $data['classinfo'] = $this->classes->getClassInformation($classid);

		parse_temp($page, $this->load->view('pages/'.$page, $data, true));
        }
      //} 


	

  function addMember($classid, $user_id){
      $this->load->model('bookings');

   
        $m = strtolower($user_id);
        $b = strtolower($classid);
        echo "Member id " . $m . ' class id ' . $b; 

        if(!$this->isClassBookedOut($b) && !$this->isClassInPast($b)){
          $this->bookings->addMember($b, $m);
          $this->_emailMemberAddedToClass($m, $b);
          echo "Added";

        } 
		//could add a condition to check if booked out and not in past and wait list not full to add to wait list
            
    }
    
     function isClassBookedOut($class_booking_id){
      $this->load->model('classes');
      $this->load->model('bookings');
      $capacity = $this->classes->getClassCapacity($class_booking_id);
      $attending = $this->bookings->countBookingAttendants($class_booking_id);

      return ($attending >= $capacity);
    }
    
      function isClassInPast($class_booking_id){
      $this->load->model('classes');
      $end = $this->classes->getClassEndDate($class_booking_id);

      return (time() >  strtotime($end));
    }
    
    function _emailMemberAddedToClass($member_id, $class_id) {
   $this->load->model('members');
   $this->load->model('classes');
   $this->load->helper('email');
   
   $email = $this->members->getMemberEmail($member_id);
   echo $email;
   $classDetails = $this->classes->getClassInformation($class_id);
   
   $msg = 'You have booked into the following class: ' . $classDetails['class_type'] . '. \r\nStarting: '. $classDetails['class_type'] . '\r\nEnd: '. $classDetails['class_type'];
   
   send_email($email, 'Booked into a Class', $msg);
 }
 
 
 
}

?>
