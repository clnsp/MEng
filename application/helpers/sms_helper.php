<?php
/**
 * Validate Mobile number
 *
 * @access	public
 * @return	bool
 * http://regexlib.com/REDetails.aspx?regexp_id=593
 */
if ( ! function_exists('valid_uk_number'))
{
	function valid_uk_number($number)
	{
		return ( ! preg_match("^(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$", $number)) ? FALSE : TRUE;
	}
}

/**
 *
 *
 *
 *
 */
if (!function_exists('createObject'))
{
	function createObject()
	{
		$ci =& get_instance();
		$param = array('username' => $ci->config->item('sms_txtlocal_username'),'hash' => $ci->config->item('sms_txtlocal_hash'));
		$ci->load->library('Textlocal', $param);
	}
}

/**
 *
 *
 *
 *
 */
if (!function_exists('getBalance'))
{
	function getBalance()
	{
		createObject();
		$ci =& get_instance();

		try {
			$result = $ci->textlocal->getBalance();
			return $result['sms'];
		} catch (Exception $e) {
			die('Error: ' . $e->getMessage());
		}
	}
}

/**
 * Send SMS Messages
 *
 *
 *
 */
 if (!function_exists('send_sms_message'))
{
	function send_sms_message($numbers, $message)
	{
		createObject();
		$ci =& get_instance();
		if(!is_array($numbers)){$numbers = array($numbers);}
		$message = message_length($message, $ci->config->item('sms_limit'));
		// CHECK CREDITS
		if(cost_est(strlen($message),count($numbers))){
			$sender = $ci->config->item('comms_name');
			try {
				// INSERT 1000 Limit Per Cycle
				$result = $ci->textlocal->sendSms($numbers, $message, $sender);
				return ($result);
			} catch (Exception $e) {
				return ('Error: ' . $e->getMessage());
				//die('Error: ' . $e->getMessage());
			}
		}else{
			return "Not Enough Credits";
		}
	}
}

/**
 * Cost Message to Require Length
 *
 *
 *
 */
if (!function_exists('message_length'))
{
	function message_length($message,$lim=1)
	{
		$lim=$lim*160;
		if(strlen($message) > $lim)
		{
			$message = substr($message,0,$lim);
		}
		return $message;
	}
}

/**
 * Get Estimated Cost of Sending Messages
 *
 *
 *
 */
if (!function_exists('cost_est'))
{
	function cost_est($len, $numbers)
	{
		$len = ceil($len/160);
		$total = $len*$numbers;
		return (getBalance()-$total>=0);
	}
}
?>
