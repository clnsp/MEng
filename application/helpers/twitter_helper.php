<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*============================================
 * TWITTER HELPER 
 * CONSTRUCTED FOR USE WITH TWITTER API v1.1
 * MEng Computer Science 13-14
 *=============================================
 */

/*
 * LOADS A TWITTER OBJECT USING THE SUPPLIED KEYS
 * @accesss public 
 *
 */
if (!function_exists('create_session'))
{
	function create_session()
	{
		$ci =& get_instance();
		$param = array('consumer_key' => $ci->config->item('twitter_consumerKey'),'consumer_secret' => $ci->config->item('twitter_consumerSecret'),'oauth_token' => $ci->config->item('twitter_accessToken'),'oauth_token_secret' => $ci->config->item('twitter_accessTokenSecret'));
		$ci->load->library('TwitterOAuth', $param);
	}
}

/**
 * Send an Twwet
 *
 * @access	public
 * @param username or Array of Usernames
 * @param message
 * @return bool
 */
if (!function_exists('send_dm'))
{
	function send_dm($username, $message)
	{
		if(!is_array($username)){$username = array($username);}
		create_session();
		$ci =& get_instance();
		$message = message_length($message);
		$username = user_following($username);
		$sent = array(array(),array());
		foreach($username as $name => $follow)
		{
			if($follow){
				$ci->twitteroauth->post('direct_messages/new', array('user' => $name, 'text' => $message));
				$sent[1][] = $name;
			}
			else{
				$sent[0][] = $name;
			}
		}
		return $sent;
	}
}

if (!function_exists('message_length'))
{
	function message_length($message)
	{
		if(strlen($message) > 140)
		{
			$message = substr($message,0,137);
		}
		return $message;
	}
}

/*
 * SEND TWEET // WITHOUT MEDIA
 * @access public
 * @param String
 * @return --
 */
if (!function_exists('send_tweet'))
{
	function send_tweet($message)
	{
		create_session();
		$ci =& get_instance();
		return $ci->twitteroauth->post('statuses/update', array('status' => $message));
	}
}

/*
 * GET RATES FROM RATE LIMIT
 * @access public
 * @return
 */
if(!function_exists('api_requests'))
{
	function api_requests(){
		$UsedFunctions = array('application'=>'/application/rate_limit_status','friendships'=>'/friendships/lookup','followers'=>'/followers/list');
		create_session();
		$ci =& get_instance();
		$return = $ci->twitteroauth->get('application/rate_limit_status');
		$limits=array();
		foreach ($UsedFunctions as $top => $item){
			$limits[$top] = $return->resources->$top->{$item};
		}		
		return $limits;
	}
}

/*
 * CHECKS IF A USER CAN RECEIVE A DIRECT MESSAGE
 * MAKE USE OF CHECK_USER_FOLLOWING & UPDATE ACCOUNT FOLLOWING TO-
 * OVERCOME RATE LIMITS
 * @access public
 * @param string
 * @return bool
 */
if(!function_exists('users_following'))
{
	function user_following($username){
		create_session();
		$ci =& get_instance();
		$sys_user = $ci->config->item('twitter_username');
		$rates = api_requests();
		if(!is_array($username)){$username = array($username);}
		$is_following=array();
		if((count($username) == 1) && $rates['friendships']->remaining>0)
		{
			return $is_following[$username[0]] = check_user_following($username[0]);
		}
		else
		{
			if($rates['followers']->remaining>0)
			{
				$names = update_account_following($sys_user);
				foreach($username as $us)
				{
					$is_following[$us]=in_array($us,$names);
				}
			}
			else
			{
				// CHECK OLDER COPY -- DB
			}
		}
		return $is_following;
	}	
}

/**
 * Check that the user is following 
 * Uses Twitters FRIENDSHIP/LOOKUP
 * @access public
 * @param string
 * @return bool
 */
if(!function_exists('check_user_following'))
{
	function check_user_following($username)
	{
		create_session();
		$ci =& get_instance();
		$return = $ci->twitteroauth->get('friendships/lookup', array('screen_name' => $username));
		$return = $return[0]; // Get First and Only Element
		if(isset($return->connections))
		{
			return array($username=>in_array('followed_by',$return->connections)); // Is the user following 
		}
		return array($username=>false); // Failure False
	}
}

/*
 * Get a List of all Account Followers
 * Uses Twitters FOLLOWERS/LIST
 * @access public
 */
if(!function_exists('update_account_following'))
{
	function update_account_following($username)
	{
		create_session();
		$ci =& get_instance();
		$return = $ci->twitteroauth->get('followers/list', array('screen_name' => $username,'include_entities'=>false));
		$names = array();
		foreach($return->users as $follow){
			 $names[] = $follow->screen_name;
		}
		return $names;
	}
}
?>
