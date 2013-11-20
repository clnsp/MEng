<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Source: http://www.codefactorycr.com/login-with-codeigniter-php.html
// Date of Access: 15/11/2013

class VerifyLogin extends CI_Controller {

  public function __construct()
  {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }

 public function index()
 {
   //This method will have the credentials validation
   $this->load->library('form_validation');

   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {

     //Field validation failed.&nbsp; User redirected to login page
    parse_temp('login', $this->load->view('pages/login', '', true));
  }
  else
  {
     //Go to private area
   redirect('home', 'refresh');
 }
}

public function check_database($password)
{
   //Field validation succeeded.&nbsp; Validate against database
 $username = $this->input->post('username');

   //query the database
 $result = $this->user->login($username, $password);

 if($result)
 {
   $sess_array = array();
   foreach($result as $row)
   {
     $sess_array = array(
       'id' => $row->id,
       'username' => $row->username,
       'member_type' => $row->member_type
       );
     $this->session->set_userdata('logged_in', $sess_array);
   }
   return TRUE;
 }
 else
 {
   $this->form_validation->set_message('check_database', 'Invalid username or password');
   return false;
 }
}
}
?>
