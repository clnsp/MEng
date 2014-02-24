<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
				$pref = $ci->members->getUserColumn($id, 'comms_preference');
				// ALL MESSAGES
				if($pref == 2){
					contact_user_twitter($id,$message);
					contact_user_sms($id,$message);
					contact_user_email($id,$message);
				// SMS AND EMAIL ONLY
				}else if($pref == 1){
					contact_user_sms($id,$message);
					contact_user_email($id,$message);
				}
				// EMAIL ONLY
				else{
					contact_user_email($id,$message);
				}			
			}
		}
	}
}
/*
 * SEND SMS Message
 * @access private
 * @param ID
 * @param message
 */
if (!function_exists('contact_user_sms')) // MAX NUMBER OF MESSAGES
{
	private function contact_user_sms($id,$message){
		$ci =& get_instance();
		$ci->load->helper('sms');
		$mobile_number = $ci->members->getUserColumn($id, 'mobile_number');
		if(!$ci->config->item('sms_allow')){
			// GET MOBILE NUMBER
			if(isset($mobile_number[0])){
				echo send_sms($mobile_number[0]->mobile_number,$message);
			}
		}
	}
}

/*
 * SEND Twitter 
 * @access private
 * @param ID
 * @param message
 */
if (!function_exists('contact_user_twitter'))
{
	private function contact_user_twitter($id,$message){
		$ci =& get_instance();
		$ci->load->helper('twitter');
		$twitter_name = $ci->members->getUserColumn($id, 'twitter'); 
		if(!$ci->config->item('twitter_allow')){
			if(isset($twitter_name[0])){
				echo send_tweet($twitter_name[0]->twitter,$message);
			}
		}
	}
}

/*
 * SEND EMAIL
 * @access private
 * @param ID
 * @param message
 */
if (!function_exists('contact_user_email'))
{
	private function contact_user_email($id,$message){
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
