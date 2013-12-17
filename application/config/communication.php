<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| SMS details
|
| These details are used when allowing and sending SMS
|--------------------------------------------------------------------------
*/
$config['sms_sender'] = 'Your project';
$config['sms_allow'] = FALSE;

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
$config['twitter_allow'] = FALSE;
