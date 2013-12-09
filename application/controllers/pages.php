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
			}

			parse_temp($page, $this->load->view('pages/'.$page, '', true));

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
		 * Admin calendar booking page
		 */
		public function admin_calendar($page = 'admin-calendar'){

			if(!$this->tank_auth->is_logged_in()){
			  //If no session, redirect to login page
				$data['user_type'] = 'guest';
				redirect('login', 'refresh');
			}
			else{
				$this->load->Model('Rooms');
				
				$data['rooms'] = $this->Rooms->getRooms();

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



		
		

	}

	?>
