<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| SMS details
|
| These details are used when allowing and sending SMS
|--------------------------------------------------------------------------
*/
$config['sms_sender'] = 'Test Gym';
$config['sms_allow'] = TRUE;

/*
|--------------------------------------------------------------------------
| Text Local: http://www.textlocal.com/
|
| Use Text Local to SMS (Requires an Account)
|--------------------------------------------------------------------------
*/
$config['sms_txtlocal_sms'] = TRUE;
$config['sms_txtlocal_username'] = 'colin.espie@strath.ac.uk';
$config['sms_txtlocal_hash'] = '79c9c60054b672eb9543c572cbb1adf12178f0d3';

/*
|--------------------------------------------------------------------------
| Twitter details
|
| These details are used allowing and sending Tweets
|--------------------------------------------------------------------------
*/
$config['twitter_allow'] = TRUE;
$config['twitter_account'] = 'Your Account ID'; 
