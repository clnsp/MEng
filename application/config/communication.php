<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| SMS details
|
| These details are used when allowing and sending SMS
|--------------------------------------------------------------------------
*/
$config['sms_sender'] = 'Your project Sender';
$config['sms_allow'] = TRUE;

/*
|--------------------------------------------------------------------------
| Text Local: http://www.textlocal.com/
|
| Use Text Local to SMS (Requires an Account)
|--------------------------------------------------------------------------
*/
$config['sms_txtlocal_sms'] = FALSE;
$config['sms_txtlocal_username'] = 'youremail@address.com';
$config['sms_txtlocal_hash'] = 'Your API hash';

/*
|--------------------------------------------------------------------------
| Twitter details
|
| These details are used allowing and sending Tweets
|--------------------------------------------------------------------------
*/
$config['twitter_allow'] = TRUE;
$config['twitter_account'] = 'Your Account ID'; 
