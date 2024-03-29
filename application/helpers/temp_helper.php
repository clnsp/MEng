<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('parse_temp')){



	/**
	 * Function for parsing template aspects
	 */
	function parse_temp($page = 'home', $page_body) {


		$ci = get_instance();
		$session_data = $ci->session->userdata('logged_in');

    	$data['page_title'] = $page; //title should be more descriptive eg. "Sports Hall Bookings"
		$data['page_slug'] = $page; //slug should uniquely id a page eg "sports_hall_bookings"
		$data['page_body'] = $page_body;

		$data['logged_in'] = $ci->tank_auth->is_logged_in(); 
		$data['user'] = $ci->tank_auth->is_admin();


		$data['email'] = $session_data['email'];  
		$data['user_type'] = $ci->tank_auth->get_user_permissions();
		$data['user_name'] = $ci->tank_auth->get_username();

		$ci->load->Model($page = 'links');
		$ci->load->Model($page = 'contact_us');
		$ci->load->Model($page = 'media');
		
		$data['links'] = $ci->links->get_all();
		$data['contacts'] = $ci->contact_us->get_all();
		$data['media'] = $ci->media->get_all();

		
		$ci->parser->parse(template_url(), $data);
		$ci->load->view('templates/allan_template/bricks/footer', $data);

	}


    /**
	 * Function for getting the default template url
     * @return string
	 */
    function template_url(){
    	return 'templates/allan_template/allan_template';
    }

    /**
    * Checks whether an admin is logged in and redirects otherwise
    * @return bool
    */
    function check_admin(){
    	$ci = get_instance();
    	if(!$ci->tank_auth->is_logged_in()){
            //If no session, redirect to login page
    		redirect('login', 'refresh');
    		return false;
    	}
    	elseif($ci->tank_auth->is_member()){
    		parse_temp('home', $ci->load->view('pages/member/home', '', true));
    		return false;
    	}
    	return $ci->tank_auth->is_admin();
    }

    function isSuperAdmin(){
    	$ci = get_instance();

    	return $ci->tank_auth->is_super_admin();
    }

    function check_member(){
    	$ci = get_instance();

    	if(!$ci->tank_auth->is_member() && !$ci->tank_auth->is_admin()){
    		//If no session, redirect to login page
    		redirect('login', 'refresh');
    		return false;
    	}
    	return (true);
    }


	/*
	 * Returns all class information in one array
	 * @param 	int
	 * @param	int
	 * @return 	array[objects]
	 */ 

	function getNextClasses($st=1,$ft=1){
		$ci = get_instance();
		if(check_admin()){				
			$h = gmdate('H');

			$s = gmdate("Y-m-d H:i:s", strtotime("-$st hours"));// GET FOR CURRENT TIME
			$e = gmdate("Y-m-d H:i:s", strtotime("+$ft hours")); 
			
			$ci->load->Model('Rooms');
			$ci->load->Model('Categories');
			$ci->load->Model('classes');
			$ci->load->Model('Bookings');

			$vals['rooms'] = $ci->Rooms->getRooms();
			$vals['categories'] = $ci->Categories->getCategories();
			$vals['classes'] = $ci->classes->getClassesWithRoomBetween($s, $e, 'allrooms',false);

			foreach ($vals['classes'] as $class){
				$class->attendees = $ci->Bookings->getBookingAttendantsNames($class->class_id);
			}
			return $vals;
		}
		return null;
	}

	function notifyWaiting($cid){ // NOTIFY WAITING LIST
		$ci = get_instance();
		if($ci->tank_auth->is_member() || $ci->tank_auth->is_admin()){
			$ci->load->model('waiting');
			$ci->load->helper('comms');
			if($ci->waiting->waitingListCount($cid)>0){
				$ids = array();
				foreach($ci->waiting->getUsers($cid) as $mem){
					$ids[] = $mem['member_id'];
				}
				$message = "A place has become available for a class on your waiting list.";
				contact_user($ids, $message);
			}
		}
	}
	
	/* 
	 *
	 *
	 */

	function verifyAssociation(){
		# We start off with loading a file which registers the simpleSAMLphp classes with the autoloader.
		require_once('/usr/share/simplesamlphp/lib/_autoload.php');

		# We select our authentication source:
		// $as = new SimpleSAML_Auth_Simple('default-sp');
		$as = new SimpleSAML_Auth_Simple('cis-ldap');

		# We then require authentication:
		$as->requireAuth();

		# And as a test we print the attributes:
		$attributes = $as->getAttributes();
		return $attributes;	 
	}

	/**
	* Setup the user class search page
	*/
	function setupClassSearchForm($data =array()){
		//will change this to user	 
		$ci = get_instance();
		$ci->load->Model('Classtype');

		$sportmenu = array();
		foreach ($ci->Classtype->getSportClassTypeNameIDs() as $row) {
			$sportmenu[$row['class_type_id']] = $row['class_type'];
		}

		$data['sportClassTypes'] = $sportmenu;


		$ddmenu = array();
		foreach ($ci->Classtype->getClassTypeNameIDs() as $row) {
			$ddmenu[$row['class_type_id']] = $row['class_type'];
		}

		$data['classTypes'] = $ddmenu;

		// $data['classtype'] = $ci->Classtype->getClasstype();

		return $data;
	}

}
