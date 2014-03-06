<?php

class edit_bookings extends CI_Controller{

  function __construct()
  {
    parent::__construct();
  }

	function cancelBooking(){

		$this->load->Model($page = 'bookings');

		$class_booking_id = $this->input->post('class_booking_id');
		$member_id = $this->input->post('member_id');
		$this->bookings->removeMember($class_booking_id, $member_id);
		
//		echo "member id: ".$member_id." class id: ".$class_booking_id;

			$data['bookings'] = $this->bookings->getClassBookingByMember($member_id);
			$data['bookingsPast'] = $this->bookings->getClassBookingByMember($member_id);
			$data['bookingMember'] = $member_id;

			$rowCount = 0;
			$rowCounter = 0;

			foreach ($data['bookings'] as $row){

				$end = $row['end'];

				if(time() > strtotime($end)){

					unset($data['bookings'][$rowCount]);				
				
				}
				
				$rowCount++;			

			}

			foreach ($data['bookingsPast'] as $row){

				$end = $row['end'];

				if(time() < strtotime($end)){

					unset($data['bookingsPast'][$rowCounter]);				
				
				}
				
				$rowCounter++;			

			}

		parse_temp($page, $this->load->view('pages/member/mybookings', $data, true));

	}

}

?>
