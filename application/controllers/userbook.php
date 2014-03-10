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


     $start = $this->input->post('start');
     $end = $this->input->post('end');
     $bookingtype = $this->input->post('bookingtype');

     if($bookingtype == "btn btn-warning"){
      $bookingtype = "You have been added to the Waiting List for";
    }else{
      $bookingtype = "You will be Attending";

    }

 //   echo $classid;
  //  if (isset($_POST['user_id']) && isset($_POST['class_id'])){
   //     $m = strtolower($_POST['user_id']);
    //    $b = strtolower($_POST['class_id']);


   //     if(!$this->isClassBookedOut($classid) && !$this->isClassInPast($classid)){

    $this->addMember($classid, $user_id, $start, $end);
    $data['user_id'] = $this->tank_auth->get_user_id();
    $data['class_id'] = $classid;
    $data['start'] = $start;
    $data['end'] = $end;
    $data['bookingtype'] = $bookingtype;

    $data['classinfo'] = $this->classes->getClassInformation($classid);

    parse_temp($page, $this->load->view('pages/'.$page, $data, true));
  }
      //} 



  function addMember($classid, $user_id, $start, $end){
    $this->load->model('bookings');


    $m = strtolower($user_id);
    $b = strtolower($classid);

    if(!$this->isClassBookedOut($b) && !$this->isClassInPast($b)){
      $this->bookings->addMember($b, $m);
      $this->_emailMemberAddedToClass($m, $b, $start, $end);


    }elseif ($this->isClassBookedOut($b) && !$this->isClassInPast($b)) {
      $this->bookings->addMemberWaitingList($b, $m);
      $this->_emailMemberAddedToWaitingList($m, $b, $start, $end);

    }


  }
  
  /**
   * Book user into a sport
   */
  function bookSport() {
	  $this->load->model('bookings');
	  $this->load->model('classes');
  	/*! need to check that you're allowed to make booking !*/
  	
  	if(isset($_POST['class_type_id']) && isset($_POST['class_start_date']) && isset($_POST['room_id'])){
  		$end = new DateTime($_POST['class_start_date']);
  		$end->modify("+60 minutes");
  	
  		$data = array(
  			'class_type_id'		=> $_POST['class_type_id'],
  			'class_start_date'	=> $_POST['class_start_date'],
  			'class_end_date'	=> $end->format('Y-m-d H:i:00'),
  			'room_id'			=> $_POST['room_id'],
  		);

	  	$id = $this->classes->insertClass($data);

	  	$this->bookings->addMember($id, $this->tank_auth->get_user_id());
	  	
	  	if($this->db->_error_number() == 0){
	  		echo("You have been booked in");
	  	}
	  	
	}
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

  function _emailMemberAddedToClass($member_id, $class_id, $start, $end) {
   $this->load->model('members');
   $this->load->model('classes');
   $this->load->helper('email');
   
   $email = $this->members->getMemberEmail($member_id);
   $classDetails = $this->classes->getClassInformation($class_id);
   $headers  = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $msg ='<!DOCTYPE html>
   <html>
   <head>'; 
   $msg .= 'You have booked into the following class: ' . $classDetails['class_type'] . '. <p> Starting: '. $start . ' <p>End: '. $end;

   $msg .= '</html> </head>';
   mail($email, 'Booked into a Class', $msg, $headers);
 }
 
 
 function _emailMemberAddedToWaitingList($member_id, $class_id, $start, $end) {
   $this->load->model('members');
   $this->load->model('classes');
   $this->load->helper('email');
   
   $email = $this->members->getMemberEmail($member_id);
   $classDetails = $this->classes->getClassInformation($class_id);
   $headers  = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $msg ='<!DOCTYPE html>
   <html>
   <head>'; 
   $msg .= 'You have been added to the waiting list for the following class: ' . $classDetails['class_type'] . '. <p> Start Time: '. $start . ' <p> End Time: '. $end;
   $msg .= ' <p> We will notify you through your chosen method of communication if a space becomes available. </p>';
   $msg .= '</html> </head>';
   mail($email, 'Booked into a Class', $msg, $headers);
 }
 

 
}

?>
