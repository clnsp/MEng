<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Send an Twwet
 *
 * @access	public
 * @param username
 * @param message
 * @returnbool
 */
if ( ! function_exists('send_sms'))
{
	function send_tweet($username, $message)
	{
		$ci =& get_instance();
		$param = array('consumer_key' => $ci->config->item('twitter_consumerKey'),'consumer_secret' => $ci->config->item('twitter_consumerSecret'),'oauth_token' => $ci->config->item('twitter_accessToken'),'oauth_token_secret' => $ci->config->item('twitter_accessTokenSecret'));
		$ci->load->library('TwitterOAuth', $param);
		return $ci->twitteroauth->post('direct_messages/new', array('user' => $username, 'text' => $message));
	}
}

/**
 * Check that the user is following 
 *
 * @access public
 * @param username
 * @return bool
 */
if( !function_exists('user_following'))
{
	function user_following($username)
	{
		$ci =& get_instance();
		$param = array('consumer_key' => $ci->config->item('twitter_consumerKey'),'consumer_secret' => $ci->config->item('twitter_consumerSecret'),'oauth_token' => $ci->config->item('twitter_accessToken'),'oauth_token_secret' => $ci->config->item('twitter_accessTokenSecret'));
		$ci->load->library('TwitterOAuth', $param);
		$return = $ci->twitteroauth->get('friendships/lookup', array('screen_name' => $username));
		$return = $return[0]; // Get First and Only Element
		if(isset($return->connections))
		{
			return in_array('followed_by',$return->connections); // Is the user following 
		}
		return false; // Failure False
	}
}
?>
