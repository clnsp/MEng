<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * CONTACT A USER BASED ON THEIR PREFERNECES
 * @access public
 * @param LIST OF IDS
 * @param LIST OF MESSAGES OR SINGLE MESSAGE
 * @param SEND ONLY BY EMAIL
 * @return LIST OF STATUS
 */

if (!function_exists('contact_user'))
{
	function contact_user($id,$message,$service=false){


		if(!is_array($id)){$id = array($id);}
		if(!is_array($message)){$message =  array('email'=>$message,'sms'=>$message,'twitter'=>$message);}
		$ci =& get_instance();
		if(check_member()){
			$ci->load->model('members');
			// Fetch User Preference
			$list = array('email'=>array(),'sms'=>array(),'twitter'=>array());
			foreach($id as $i)
			{
				$prefD = $ci->members->getUserColumn($i, array('email','twitter','valid_twitter','mobile_number','valid_mobile_number'));
				$prefD = $prefD[0];

				if($ci->members->haveCommsPref($i,3)>0 && $prefD->valid_twitter){
					$list['twitter'][] = $prefD->twitter; 
				}
				
				if($ci->members->haveCommsPref($i,2)>0 && $prefD->valid_mobile_number){
					$list['sms'][] = $prefD->mobile_number; 
				}
				if($ci->members->haveCommsPref($i,1)>0){
				$list['email'][] = $prefD->email; 
				}
			}			
			$status=array();
			if(!$service){ // ADMIN -- EMAIL ONLY
				if($ci->config->item('twitter_allow') &&  isset($message['twitter'])) {$status['twitter'] = contact_twitter(array_unique($list['twitter']),$message['twitter']);}
				if($ci->config->item('sms_allow') &&  isset($message['sms'])) {$status['sms'] = contact_sms(array_unique($list['sms']),$message['sms']);}
			}
			if(isset($message['email'])){$status['email'] = contact_email(array_unique($list['email']),$message['email']);};
			return $status;	
		}
	}
}

/*
 * SEND SMS Message
 * @access public
 * @param ID
 * @param message
 * @return sms status
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
 * @access public
 * @param ID
 * @param message
 * @return twitter status
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
 * @access public
 * @param ID
 * @param message
 * @return email status
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
/*
		$this->load->library('email');
		$this->email->clear();
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->send();
*/

/*
if (!function_exists('load_message'))
{
	function load_message($service, $type, &$data)
	{
		switch($service){
			$data = array();
			case 'sms': // LOAD SMS MESSAGE
				$data['message'] = $this->load->view('sms/'.$type.'-txt', $data, TRUE);
				break;
			case 'twitter': // LOAD TWITTER MESSAGE
				$data['message'] = $this->load->view('twitter/'.$type.'-txt', $data, TRUE);
				break;
			case 'email': // LOAD EMAIL MESSAGE
				$data['subject'] = sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth'));
				$data['message'] = $this->load->view('email/'.$type.'-html', $data, TRUE);
				$data['alt_message'] = $this->load->view('email/'.$type.'-txt', $data, TRUE);
				break;
			}
		return $data;
	}
}
*/

if(!function_exists('create_mesage'))
{
	function create_mesage($message,$url)
	{
		$ci =& get_instance();
		$param = array('key' => $ci->config->item('googleshort_key'));
		$ci->load->library('GoogleUrlApi', $param);
		echo($ci->googleurlapi->shorten($url));
	}
}
?>
