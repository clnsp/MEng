	<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start();

	class Pages extends CI_Controller {
		private $route = 'pages/admin/';

		public function __construct(){
			parent::__construct();
		}

		/**
		 * Generic view for all pages within the /pages folder
		 */
		public function view($page = 'home'){

			
			if(check_admin()){

				if ( ! file_exists('application/views/'.$this->route .$page.'.php'))
					show_404();
				

				$data =  getNextClasses(1,2);
				if($data!=null){
					$data['user'] = $this->tank_auth->is_admin();	
					$h = gmdate('H');
					$data['cDate'] = gmdate('l, dS F'); // "Wednesday 29th, Januaray";
					$data['cTimespan'] = "$h:00 - ".($h+1).":00";
					parse_temp($page, $this->load->view($this->route.$page, $data, true));
				}
			}
		}

		/**
		 * Get new updated body for up and coming classes
		 */
		public function updateClasses($page = 'class-list')
		{
			if(check_admin()){	
				$data = getNextClasses(1,2); // Get Class (1hour before current and 2hours after current)	
				if($data!=null){		
					$data['cDate'] = gmdate('l, dS F'); // "Wednesday 29th, Januaray";
					$this->load->view($this->route.$page, $data);
				}
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
		 		$this->load->Model('dbviews');
				// Get all Users
		 		$data['users'] = $this->members->getAllUsers();
		 		foreach($data['users']as $user){
		 			$attended = $this->dbviews->getUserLastAttendance($user->id);
		 			if(isset($attended[0]->member_id))
		 			{
		 				$date = new DateTime($attended[0]->class_start_date);
		 				$user->lastClass = $attended[0]->class_type . " " . $date->format('d/m/y');
		 			}
		 			else
		 			{
		 				$user->lastClass = "None";
		 			}
		 		}
				// Twitter Enabled
		 		$data['twitter'] = $this->config->item('twitter_allow');
				// SMS Enabled
		 		$data['sms'] = $this->config->item('sms_allow');

		 		parse_temp($page, $this->load->view($this->route.$page, $data, true));
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
				
				parse_temp($page, $this->load->view($this->route.$page, $data, true));
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

			parse_temp('room', $this->load->view($route.'room', $data, true));

		}

		/**
		 * Rooms
		 */
		public function rooms(){

			$this->load->Model($page = 'rooms');
			
			$data['rooms'] = $this->rooms->getRooms();
/*
			$data['room_id'] = $this->facilities->retrieve_ids();
			$data['room'] = $this->facilities->retrieve_titles();
			$data['description'] = $this->facilities->retrieve_descriptions();

*/			parse_temp('room', $this->load->view('pages/member/rooms', $data, true));

		}

		/**
		 * Links
		 */
		public function links(){

			$this->load->Model($page = 'links');
			
			$data['links'] = $this->links->get_all();

			parse_temp($page, $this->load->view($route.'user-links', $data, true));


		}

		/**
		 * Footer
		 */
		public function footer(){

			$this->load->Model($page = 'links');
			
			$data['links'] = $this->links->get_all();

			$this->load->view('pages/footer_content', $data, true);

		}


		
		/**
		 * Admin calendar booking page
		 */
		public function manage($page = 'manage'){

			if(check_admin()){
				$this->load->Model('Categories');
				$this->load->Model('classes');


				$this->load->Model('facilities');

				$data['user'] = $this->tank_auth->is_admin();


				$data['categories'] = $this->Categories->getCategories();
				$data['class_types'] = $this->classes->getClassTypes();

				parse_temp($page, $this->load->view($this->route.$page, $data, true));
			}
		}	

	}

	?>
