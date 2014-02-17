<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Website details
|
| These details are used in emails sent by authentication library.
|--------------------------------------------------------------------------
*/
$config['website_name'] = 'CSR Project';
$config['comms_name'] = 'CSR Gym';
$config['webmaster_email'] = 'no-reply@csr.ac.uk';

/*
|--------------------------------------------------------------------------
| EMAIL Settings
|
| These details are used when allowing and sending SMS
|--------------------------------------------------------------------------
*/
$config['email_header'] = "THIS IS A HEADER \r\n Dear User";

$config['email_footer'] = "THIS IS A FOOTER \r\n Regards CSR";

/*
|--------------------------------------------------------------------------
| SMS details
|
| These details are used when allowing and sending SMS
|--------------------------------------------------------------------------
*/
$config['sms_limit'] = 2; // Max Number of texts per Message
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



?>
