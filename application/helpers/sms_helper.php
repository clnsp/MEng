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
 * Send an SMS
 *
 * @access	public
 * @return	bool
 */
if ( ! function_exists('send_sms'))
{
	function send_sms($numbers, $message = 'Hello World')
	{
		$CI =& get_instance();
		if(!$CI->config->item('sms_allow','communication'))
		{
			return "Error: SMS Disabled";
		}
		else if(!empty($numbers) && !empty($message))
		{
			if($CI->config->item('sms_txtlocal_sms','communication')) {	return _txtLocal($numbers, $message);}
			else {return "Error: No SMS Provider Selected";}
		}
		else {
			return "Error: Invalid Number or Message";
		}
	}
}

/**
 * Use Text Local API
 * http://www.textlocal.com/
 *
 * @access private
 * @return bool
 */

/*
|--------------------------------------------------------------------------
| Text Local: http://www.textlocal.com/
|
| Use Text Local to SMS (Requires an Account)
|--------------------------------------------------------------------------
*/

function _txtLocal($numbers, $message)
{
	$CI =& get_instance();
	
	// Textlocal account details
	$username = $CI->config->item('sms_txtlocal_username','communication');
	$hash = $CI->config->item('sms_txtlocal_hash','communication');
	
	// Message details
	$sender = $CI->config->item('sms_sender','communication');
 
	// Prepare data for POST request
	$data = array('username' => $username, 'hash' => $hash, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.txtlocal.com/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	return $response;
}

?>
