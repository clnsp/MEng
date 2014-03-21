<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	* Email when a member is added to a class
	* @param int
	* @param array
	*/
	function emailMemberAddedToClass($member_id, $classDetails) {
   $ci = get_instance();
   $ci->load->helper('comms');

   $d = new DateTime($classDetails['class_start_date']);
   $msg = 'You have booked into the following class: ' . $classDetails['class_type'] . ' on '. $d->format("jS F Y") . ' starting at '. $d->format("H:i") . ' in the following room: '. $classDetails['room'];
   contact_user(array($member_id), $msg);

 }

	/**
	* Email when a member is added to waiting list
	* @param int
	* @param array
	*/
	function emailMemberAddedToWaitingList($member_id, $classDetails) {
   $ci = get_instance();
   $ci->load->helper('comms');

   $d = new DateTime($classDetails['class_start_date']);
   $msg = 'You have been added to the waiting list for the following class: ' . $classDetails['class_type'] . ' on '. $d->format("jS F Y") . ' starting at '. $d->format("H:i") . ' in the following room: '. $classDetails['room'] .'. You will be notified when a space becomes available, and  be given the chance to book again. Please note when a space becomes available it will be filled on a first come first serve basis.';
   contact_user(array($member_id), $msg);

 }


  	/**
 	 * Email a member confirmation they've been added to a class
 	 * @param int
 	 * @param array
  	 */
  	function emailMemberRemovedClass($member_id, $classDetails) {

     $ci = get_instance();
     $ci->load->helper('comms');

     $d = new DateTime($classDetails['class_start_date']);
     $msg = 'You have removed from the following class: ' . $classDetails['class_type'] . ' on '. $d->format("jS F Y") . ' starting at '. $d->format("H:i") . ' in the following room: '. $classDetails['room'];
     contact_user(array($member_id), $msg);

   }

  	/**
    * Determines whether a class is fully booked
    * @param int
    * @return bool
    */
  	function isClassBookedOut($class_booking_id){
  		$ci = get_instance();
  		$ci->load->model('bookings');
      $ci->load->model('classes');

      $capacity = $ci->classes->getClassCapacity($class_booking_id);
      $attending = $ci->bookings->countBookingAttendants($class_booking_id);

      return ($attending >= $capacity);
    }


    /**
    * Determines whether a class is in the past or not
    * @param int
    * @return bool
    */
    function isClassInPast($class_booking_id){
    	$ci = get_instance();
    	$end = $ci->classes->getClassEndDate($class_booking_id);

    	return (time() >  strtotime($end));
    }

    /**
    * Check already booked classes
    * @param int
    * @param DateTime
    * @param DateTime
    * @return bool
    */
    function bookedOut($user_id, $start, $end){
      $ci = get_instance();
      $bookedOut = $ci->bookings
      ->isMemberBookedOut($user_id, $start->format("Y-m-d"), $start->format("H:i:s"), $end->format("H:i:s"));

      return count($bookedOut) > 0;
    }






