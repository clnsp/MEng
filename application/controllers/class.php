	<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start();

	class Class extends CI_Controller {

		public function __construct(){
			parent::__construct();
		}

		public function update($page = 'class-list')
		{
			if(check_admin()){				
				$h = gmdate('H');				
				$s = gmdate('Y-m-d ').($h-1). ':00:00'; // GET FOR CURRENT TIME  
				$e = gmdate('Y-m-d ').($h+4). ':00:00'; 
				
				$this->load->Model('Rooms');
				$this->load->Model('Categories');
				$this->load->Model('classes');
				$this->load->Model('Bookings');
				
				$data['rooms'] = $this->Rooms->getRooms();
				$data['categories'] = $this->Categories->getCategories();
				$data['classes'] = $this->classes->getClassesWithRoomBetween($s, $e, 'allrooms');

				foreach ($data['classes'] as $class){
					$class->attendees = $this->Bookings->getBookingAttendantsNames($class->class_id);
				}				
				$this->load->view('pages/'.$page, $data);
			}

		}


}
