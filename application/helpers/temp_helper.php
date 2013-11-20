<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('parse_temp'))
{

	/* 
	 * Function for parsing template aspects
	 */
    function parse_temp($page = 'home', $page_body)
    {
		
    	$data['page_title'] = $page; //difference between slug and title?
		$data['page_slug'] = $page;
		$data['user_name'] = "A. Murray";
		$data['page_body'] = $page_body;

		$ci = get_instance();
		$ci->parser->parse(template_url(), $data);
    }

    /* 
	 * Function for getting the default template url
	 */
    function template_url(){
    	return 'templates/allan_template/allan_template';
    }


}