<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('contact_user'))
{
	function contact_user($id,$message,$service=""){
		if(!is_array($id)){$id = array($id);}
		if(!is_array($message)){$message =  array('email'=>$message,'sms'=>$message,'twitter'=>$message);}
		$ci =& get_instance();
		if(check_admin()){
			$ci->load->model('members');
			//Admin Override
			if($service!="")
			{
				$service = array_map('strtolower', $service);
				//if(in_array('sms',$service)){contact_user_sms($id,$message);}
				//if(in_array('twitter',$service)){contact_user_twitter($id,$message);}
				//if(in_array('email',$service)){contact_user_email($id,$message);}
			}
			else
			{
				// Fetch User Preference
				$list = array('email'=>array(),'sms'=>array(),'twitter'=>array());
				foreach($id as $i)
				{
					$prefD = $ci->members->getUserColumn($i, array('comms_preference','email','twitter','mobile_number'));
					$prefD = $prefD[0];

					if($prefD->comms_preference> 2){
						$list['twitter'][] = $prefD->twitter; 
					}
					
					if($prefD->comms_preference> 1){
						$list['sms'][] = $prefD->mobile_number; 
					}
					$list['email'][] = $prefD->email; 
				}			
				$status=array();
				if($ci->config->item('twitter_allow') &&  isset($message['twitter'])) {$status['twitter'] = contact_twitter(array_unique($list['twitter']),$message['twitter']);}
				if($ci->config->item('sms_allow') &&  isset($message['sms'])) {$status['sms'] = contact_sms(array_unique($list['sms']),$message['sms']);}
				if(isset($message['email'])){$status['email'] = contact_email(array_unique($list['email']),$message['email']);};

				return $status;				
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
if (!function_exists('contact_sms')) // MAX NUMBER OF MESSAGES
{
	function contact_sms($nums,$message){
		$ci =& get_instance();
		$ci->load->helper('sms');
		if($ci->config->item('sms_allow')){
			// GET MOBILE NUMBER
			if(isset($nums)){
				return send_sms_message($nums,$message);
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
if (!function_exists('contact_twitter'))
{
	function contact_twitter($ids,$message){
		$ci =& get_instance();
		$ci->load->helper('twitter');
		if($ci->config->item('twitter_allow')){
			if(isset($ids)){
				return send_dm($ids,$message);
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
if (!function_exists('contact_email'))
{
	function contact_email($ids,$message){
		$ci =& get_instance();
		if(!is_array($ids)){$ids = array($ids);}
		// HEADER / BODY / FOOTER
		//$email_message = 		
		$ci->load->helper('email');
		$fail=array();
		foreach($ids as $id){
			if(!send_email($id, 'Gym Message', $message)){
				$fail[]=$id;
			}
		}
		return $fail;
	}
}
?>