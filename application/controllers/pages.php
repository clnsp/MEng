<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class Pages extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	/*
	 * Get the template url
	 */
	public function template_url(){
		return 'templates/allan_template/allan_template';
	}

	/**
	 * Generic view for all pages within the /pages folder
	 */
	public function view($page = 'home'){

		$this->load_page_libraries();

		if ( ! file_exists('application/views/pages/'.$page.'.php')){
			// Whoops, we don't have a page for that!
			show_404();
		}
		
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->all_userdata();
			$data['user_type'] = $session_data['username'];  
		}
		else{
		  //If no session, redirect to login page
			$data['user_type'] = 'guest';
			redirect('login', 'refresh');
		}
		
		$data['page_title'] = $page; //difference between slug and title?
		$data['page_slug'] = $page;
		$data['user_name'] = "A. Murray";
		$data['page_body'] = $this->load->view('pages/'.$page, '', true);

		$this->parser->parse($this->template_url(), $data);
	}

	/**
	 * Login to system
	 */
	public function login($page = 'login'){
		$this->load_page_libraries();
		$this->load->helper(array('form'));

		$data['page_slug'] = "login";
		$data['page_body'] = $this->load->view('pages/login', '', true);
		
		$this->parser->parse($this->template_url(), $data);
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
	 * Helper function to load libraries needed for every page.
	 */
	public function load_page_libraries(){
		$this->load->library('session');
		$this->load->library('parser');
		$this->load->helper('url_helper');
	}

}

?>
