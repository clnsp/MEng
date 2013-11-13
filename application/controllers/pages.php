<?php

class Pages extends CI_Controller {

	

	public function view($page = 'home'){
		$this->load->library('parser');
		$this->load->helper('url_helper');

		if ( ! file_exists('application/views/pages/'.$page.'.php')){
			// Whoops, we don't have a page for that!
			show_404();
		}
		
		$data['page_title'] = $page;
		$data['user-name'] = "A. Murray";

		$data['page_body'] = $this->load->view('pages/'.$page, '', true);

		
	
		$this->parser->parse('templates/allan_template/allan_template', $data);


	}
}

