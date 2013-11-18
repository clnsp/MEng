<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();

class Pages extends CI_Controller {
	public function __construct(){
		parent::__construct();
	 }

	public function view($page = 'home'){
		$this->load->library('session');
		$this->load->library('parser');
		$this->load->helper('url_helper');

		if ( ! file_exists('application/views/pages/'.$page.'.php')){
			// Whoops, we don't have a page for that!
			show_404();
		}
		
		if($this->session->userdata('logged_in'))
		{
		  $session_data = $this->session->all_userdata();
		  $data['user_type'] = $session_data['username'];  
		}
		else{
		  //If no session, redirect to login page
		  $data['user_type'] = 'guest';
		  redirect('login', 'refresh');
		}
		
		$data['page_title'] = $page;
		$data['user_name'] = "A. Murray";


		$data['page_body'] = $this->load->view('pages/'.$page, '', true);

		$this->parser->parse('templates/allan_template/allan_template', $data);
	}

public function login($page = 'login'){
$this->load->library('session');
		$this->load->library('parser');
		$this->load->helper('url_helper');
	$this->load->helper(array('form'));
	$data['page_body'] = $this->load->view('pages/login', '', true);
	$this->parser->parse('templates/allan_template/allan_template', $data);
}


 function logout(){
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('login', 'refresh');
 }

}

?>
