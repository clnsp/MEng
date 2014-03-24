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
$config['sms_limit'] = 1; // Max Number of texts per Message
$config['sms_allow'] = FALSE;

/*
|--------------------------------------------------------------------------
| Text Local: http://www.textlocal.com/
|
| Use Text Local to SMS (Requires an Account)
|--------------------------------------------------------------------------
*/
$config['sms_txtlocal_sms'] = TRUE;
$config['sms_txtlocal_username'] = 'colin.espie@strath.ac.uk';
$config['sms_txtlocal_hash'] = '644803d2f1c4678d8dc453eb437ac7a95d4269dc';

/*
|--------------------------------------------------------------------------
| Twitter details
|
| These details are used allowing and sending Tweets
|--------------------------------------------------------------------------
*/
$config['twitter_allow'] = TRUE;
$config['twitter_username']	="mengers2013";
$config['twitter_consumerKey']       = '9uo6ym4fGqUzJj1CJignUQ';
$config['twitter_consumerSecret']    = 'qFuZChnvmJSwcZwynm5bQGeeY6awxLdBKkXovOLT0';
$config['twitter_accessToken']       = '2255084299-P7iUK9u3xIVceXv1tpRthR5UfCbxO0JekULhser';
$config['twitter_accessTokenSecret'] = 'aXY0J0fXyecR0W8i95G9gehKTRDztmDnDdZc8CrLkxi7X';

/*
|--------------------------------------------------------------------------
| GOOGLE URL SHORTNER
| https://developers.google.com/url-shortener/v1/
|--------------------------------------------------------------------------
*/
$config['googleshort_key'] = 'AIzaSyDbkNXd0GHXtvqMSHIxGZlGdWBipad09go'; 
?>
