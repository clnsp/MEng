<?php

class edit_bookings extends CI_Controller{

  function __construct()
  {
    parent::__construct();
  }

	/**
	* Cancel a Booking
	* @return	void
	*/
	function cancelBooking(){

	if(check_member()){

		$this->load->Model($page = 'bookings');
		$this->load->Model($page = 'classes');
		
		$class_booking_id = $this->input->post('class_booking_id');
		$member_id = $this->input->post('member_id');
		$this->bookings->removeMember($class_booking_id, $member_id);
		$this->classes->removeSportClass($class_booking_id);
		
		


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
	
	/**
	* Cancel a waiting pool 
	* @return	void
	*/
	function cancelWaiting(){

	if(check_member()){

		$this->load->Model($page = 'bookings');
		$this->load->Model($page = 'classes');
		
		$class_booking_id = $this->input->post('class_booking_id');
		$member_id = $this->input->post('member_id');
		$this->bookings->removeWaiting($class_booking_id, $member_id);
		

			$data['bookings'] = $this->bookings->getClassBookingByMember($member_id);
			$data['bookingsPast'] = $this->bookings->getClassBookingByMember($member_id);
			$data['waiting'] = $this->bookings->getAllWaiting($member_id);
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

}
/* End of file edit_bookings.php */
/* Location: ./application/controllers/edit_bookings.php */
?>

