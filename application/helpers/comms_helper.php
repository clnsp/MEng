<?php
if (!function_exists('contact_user'))
{
	function contact_user($id,$message,$service=[]){
		$ci =& get_instance();
		if(check_admin()){
			$ci->load->model('members');
			
			//Admin Override
			if($service!=[])
			{
				$service = array_map('strtolower', $service);
				if(in_array('sms',$service)){contact_user_sms($id,$message);}
				if(in_array('twitter',$service)){contact_user_twitter($id,$message);}
				if(in_array('email',$service)){contact_user_email($id,$message);}
			}
			else
			// Fetch User Preference
			{
			
			
			
			
			
			}
		}
	}
}

if (!function_exists('contact_user_sms')) // MAX NUMBER OF MESSAGES
{
	function contact_user_sms($id,$message){
		$ci =& get_instance();
		$ci->load->helper('sms');
		$mobile_number = $ci->members->getUserColumn($id, 'mobile_number');
		// GET MOBILE NUMBER
		if(isset($mobile_number[0])){
			echo send_sms($mobile_number[0]->mobile_number,$message);
		}
	}
}

if (!function_exists('contact_user_twitter'))
{
	function contact_user_twitter($id,$message){
		$ci =& get_instance();
		$twitter_name = $ci->members->getUserColumn($id, 'twitter'); 
		if(!$ci->config->item('twitter_allow')){
			echo "Service Disabled";
		}
	
	}
}

if (!function_exists('contact_user_email'))
{
	function contact_user_email($id,$message){
		$ci =& get_instance();
		$query = $ci->members->getUserColumn($id, 'email'); 
		if(count($query[0]) == 1){
			// HEADER / BODY / FOOTER
			//$email_message = 		
			$ci->load->helper('email');
			send_email($query[0]->email, 'Gym Message', $message);				
		}
	
	}
}
?>