	<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start();

	class Pages extends CI_Controller {

		public function __construct(){
			parent::__construct();
		}

		/**
		 * Generic view for all pages within the /pages folder
		 */
		public function view($page = 'home'){

			if ( ! file_exists('application/views/pages/'.$page.'.php')){
				// Whoops, we don't have a page for that!
				show_404();
			}
	

			if(!$this->tank_auth->is_logged_in()){
			  //If no session, redirect to login page
				$data['user_type'] = 'guest';
				redirect('login', 'refresh');
			}else{
				$data['user'] = $this->tank_auth->is_admin();
			}

			if(check_admin()){
		 		$data['user'] = $this->tank_auth->is_admin();
				
				$h = gmdate('H');
				//$s = gmdate("Y-m-d H:i:s", 1390176000); // GET FOR CURRENT TIME  date('Y-m-d H:') . ':00:00';
				//$e = gmdate("Y-m-d H:i:s", 1390780800);
				
				$s = gmdate('Y-m-d ').($h-1). ':00:00'; // GET FOR CURRENT TIME  
			$e = gmdate('Y-m-d ').($h+8). ':00:00'; 
				
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
				$data['cDate'] = gmdate('l, dS F'); // "Wednesday 29th, Januaray";
				
				$data['cTimespan'] = "$h:00 - ".($h+1).":00";
				
				parse_temp($page, $this->load->view('pages/'.$page, $data, true));
			}

		}

		/**
		 * Login to system
		 */
		public function login($page = 'login'){

			$this->load->helper(array('form'));

			$this->load->view('auth/login_form', $data);
			parse_temp($page, $this->load->view('pages/'.$page, '', true));

		}
		

		 /**
		 * Admin User Mangement
		 */
		 public function users($page = 'users'){

		 	if(check_admin()){
		 		$data['user'] = $this->tank_auth->is_admin();
		 		$this->load->Model('members');
				// Get all Users
		 		$data['users'] = $this->members->getAllUsers();
				// Twitter Enabled
		 		$data['twitter'] = $this->config->item('twitter_allow');
				// SMS Enabled
		 		$data['sms'] = $this->config->item('sms_allow');

		 		parse_temp($page, $this->load->view('pages/'.$page, $data, true));
		 	}
		 }

		/**
		 * Admin calendar booking page
		 */
		public function admin_calendar($page = 'admin-calendar'){

			if(check_admin()){
				$data['user'] = $this->tank_auth->is_admin();
				$this->load->Model('Rooms');
				$this->load->Model('Categories');
				
				$data['rooms'] = $this->Rooms->getRooms();
				$data['categories'] = $this->Categories->getCategories();
				
				parse_temp($page, $this->load->view('pages/'.$page, $data, true));
			}
		}



		/**
		 * Logout of system
		 */
		public function logout(){
			$this->session->unset_userdata('logged_in');
			session_destroy();
			redirect('login', 'refresh');
		}

		/**
		 * 404 Error
		 */
		public function error(){
			$this->session->unset_userdata('logged_in');
			session_destroy();
			redirect('login', 'refresh');
		}

		/**
		 * Room
		 */
		public function room($id=1){
			$data['room_id'] = $id;

			parse_temp('room', $this->load->view('pages/room', $data, true));

		}
		
		/**
		 * Admin calendar booking page
		 */
		public function manage($page = 'manage'){

			if(check_admin()){
				$this->load->Model('Categories');
				$this->load->Model('classes');
				
				$data['user'] = $this->tank_auth->is_admin();
	
				$data['categories'] = $this->Categories->getCategories();
				$data['class_types'] = $this->classes->getClassTypes();
							
				parse_temp($page, $this->load->view('pages/'.$page, $data, true));
			}
		}
		


	}

	?>