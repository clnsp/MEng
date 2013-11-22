<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('parse_temp'))
{

	/* 
	 * Function for parsing template aspects
	 */
    function parse_temp($page = 'home', $page_body) {

        $ci = get_instance();
        $session_data = $ci->session->userdata('logged_in');

    	$data['page_title'] = $page; //title should be more descriptive eg. "Sports Hall Bookings"
		$data['page_slug'] = $page; //slug should uniquely id a page eg "sports_hall_bookings"
		$data['page_body'] = $page_body;
        

        $data['logged_in'] = $ci->tank_auth->is_logged_in(); 


        $data['email'] = $session_data['email'];  
        $data['user_type'] = '1';//$session_data['member_type']; 
        $data['user_name'] = 'A. Murray';//$session_data['user_name'];
        
		$ci->parser->parse(template_url(), $data);
    }

    /* 
	 * Function for getting the default template url
	 */
    function template_url(){
    	return 'templates/allan_template/allan_template';
    }

}
