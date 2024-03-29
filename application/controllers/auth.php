<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
	}

	function index()
	{
		if ($message = $this->session->flashdata('message')) {
			//$this->load->view('auth/general_message', array('message' => $message));
			parse_temp('', $this->load->view('auth/general_message', array('message' => $message), true));

		} else {
			redirect('/auth/login/');
		}
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */
	function login()
	{	

		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			$data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
				$this->config->item('use_username', 'tank_auth'));
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

			$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Remember me', 'integer');

			// Get login for counting attempts to login
			if ($this->config->item('login_count_attempts', 'tank_auth') AND
				($login = $this->input->post('login'))) {
				$login = $this->security->xss_clean($login);
		} else {
			$login = '';
		}

		$data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
		if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
			if ($data['use_recaptcha'])
				$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
			else
				$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
		}
		$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->login(
					$this->form_validation->set_value('login'),
					$this->form_validation->set_value('password'),
					$this->form_validation->set_value('remember'),
					$data['login_by_username'],
						$data['login_by_email'])) {								// success
					redirect('');

			} else {
				$errors = $this->tank_auth->get_error_message();
					if (isset($errors['banned'])) {								// banned user
						$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

					} elseif (isset($errors['not_activated'])) {				// not activated user
						redirect('/auth/send_again/');

					} else {													// fail
						foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
					}
				}
			}
			$data['show_captcha'] = FALSE;
			if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
				$data['show_captcha'] = TRUE;
				if ($data['use_recaptcha']) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}

			//$this->load->view('auth/login_form', $data);
			/* 
			 * There must be a way to easily call the login form from other controllers.
			 * Below I'm just concatenating two page bodies together
			 * Could move the code in pages/login to the top of auth/login though
			 * Doesn't feel very modular. ~AW
			 */
			parse_temp('login', $this->load->view('pages/login', $data, true) . $this->load->view('auth/login_form', $data, true));
		}
	}

	/**
	 * Logout user
	 *
	 * @return void
	 */
	function logout()
	{
		$this->tank_auth->logout();
		
		$this->_show_message($this->lang->line('auth_message_logged_out'));
	}

	/**
	 * Register user on the site
	 *
	 * @return void
	 */
	function register()
	{

	  
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} elseif (!$this->config->item('allow_registration', 'tank_auth')) {	// registration is off
			$this->_show_message($this->lang->line('auth_message_registration_disabled'));

		} else {
			$ver = verifyAssociation(); // University Association Check
			$use_username = $this->config->item('use_username', 'tank_auth');
			if ($use_username) {
				//$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_numeric');
			}
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean|alpha_dash');
			$this->form_validation->set_rules('second_name', 'Second Name', 'trim|required|xss_clean|alpha_dash');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
			$this->form_validation->set_rules('home_number', 'Home Number', 'trim|xss_clean|alpha_dash');
			$this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|xss_clean|alpha_dash');
			$this->form_validation->set_rules('twitter', 'Twitter Name', 'trim|xss_clean|alpha_dash');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
			$this->form_validation->set_rules('member_type', 'Member Type', 'required|xss_clean');
			$this->form_validation->set_rules('new_preferences', 'Communication Preferences');

			$captcha_registration	= $this->config->item('captcha_registration', 'tank_auth');
			$use_recaptcha			= $this->config->item('use_recaptcha', 'tank_auth');
			if ($captcha_registration) {
				if ($use_recaptcha) {
					$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
				} else {
					$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
				}
			}
			$data['errors'] = array();
			
			$email_activation = $this->config->item('email_activation', 'tank_auth');	
			//$this->input->post('some_data');


			if ($this->form_validation->run()) {// validation ok
					$det['uid'] = $ver['uid'][0];
				if(intval($this->form_validation->set_value('member_type'))>2){ // SPOUSE OR PARTNER
					$det['uid'] = $det['uid'].'SP';
					$det['fn'] = $this->form_validation->set_value('first_name');
					$det['sn'] = $this->form_validation->set_value('second_name');
				}else{ // STUDENT OR STAFF
					$det['fn'] = $ver['givenName'][0];
					$det['sn'] = $ver['sn'][0];
				}
			
				if (!is_null($data = $this->tank_auth->create_user(
					$det['uid'],
					$det['fn'],
					$det['sn'],
					$this->form_validation->set_value('home_number'),
					$this->form_validation->set_value('mobile_number'),
					$this->form_validation->set_value('email'),
					$this->form_validation->set_value('twitter'),
					$this->form_validation->set_value('password'),
					$this->form_validation->set_value('member_type'),
					$_POST['new_preferences'],
					2,					// GUEST
					$email_activation,
					1))) {									// success
					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					if ($email_activation) {									// send "activate" email
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);

						unset($data['password']); // Clear password (just for any case)

						//$this->_show_message($this->lang->line('auth_message_registration_completed_1'));

					} else {
						if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email

						$this->_send_email('welcome', $data['email'], $data);
					}
						unset($data['password']); // Clear password (just for any case)

						//$this->_show_message($this->lang->line('auth_message_registration_completed_2').' '.anchor('/auth/login/', 'Login'));
					}
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			if ($captcha_registration) {
				if ($use_recaptcha) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}
			$data['captcha_registration'] = $captcha_registration;
			$data['use_recaptcha'] = $use_recaptcha;

			$this->load->Model('Comms_Preference');
	  		$prefs = $this->Comms_Preference->getPreferences();
      		$data['comm_prefs'] = $prefs;
      		
			if($ver)
			{
				$data['fname'] = $ver['givenName'][0];
				$data['sname'] = $ver['sn'][0];
				$data['mail'] = $ver['mail'][0];
				parse_temp('DS Registration', $this->load->view('auth/register_form', $data, true));
			}			
		}
	}

	/**
	 * ask register
	 *
	 * @return void
	 */
	function ask_register()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} elseif (!$this->config->item('allow_registration', 'tank_auth')) {	// registration is off
			$this->_show_message($this->lang->line('auth_message_registration_disabled'));

		} else {
			$use_username = $this->config->item('use_username', 'tank_auth');
			if ($use_username) {
				//$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_dash');
			}
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean|alpha_dash');
			$this->form_validation->set_rules('second_name', 'Second Name', 'trim|required|xss_clean|alpha_dash');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
			$this->form_validation->set_rules('home_number', 'Home Number', 'trim|xss_clean|alpha_dash');
			$this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|xss_clean|alpha_dash');
			$this->form_validation->set_rules('twitter', 'Twitter Name', 'trim|xss_clean|alpha_dash');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
			$this->form_validation->set_rules('member_type', 'Member Type', 'required|xss_clean');
			$this->form_validation->set_rules('comms_preference', 'Communication Preferences', 'trim|xss_clean');

			$captcha_registration	= $this->config->item('captcha_registration', 'tank_auth');
			$use_recaptcha			= $this->config->item('use_recaptcha', 'tank_auth');
			if ($captcha_registration) {
				if ($use_recaptcha) {
					$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
				} else {
					$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
				}
			}
			$data['errors'] = array();

			$email_activation = $this->config->item('email_activation', 'tank_auth');

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->create_user(
					"", // No Username
					$this->form_validation->set_value('first_name'),
					$this->form_validation->set_value('second_name'),
					$this->form_validation->set_value('home_number'),
					$this->form_validation->set_value('mobile_number'),
					$this->form_validation->set_value('email'),
					$this->form_validation->set_value('twitter'),
					$this->form_validation->set_value('password'),
					$this->form_validation->set_value('member_type'),
					2,					// GUEST
					$this->form_validation->set_value('comms_preference'),
					$email_activation,
					0))) {									// requires verification

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					if ($email_activation) {									// send "activate" email
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);
						unset($data['password']); // Clear password (just for any case)

						$this->_show_message($this->lang->line('auth_message_registration_completed_1'));

					} else {
						if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email

						$this->_send_email('welcome', $data['email'], $data);
					}
						unset($data['password']); // Clear password (just for any case)

						$this->_show_message($this->lang->line('auth_message_registration_completed_2').' '.anchor('/auth/login/', 'Login'));
					}
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			if ($captcha_registration) {
				if ($use_recaptcha) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}
			$data['use_username'] = $use_username;
			$data['captcha_registration'] = $captcha_registration;
			$data['use_recaptcha'] = $use_recaptcha;
			parse_temp('register', $this->load->view('auth/ask_register_form', $data, true));
		}
	}

	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		if (!$this->tank_auth->is_logged_in(FALSE)) {							// not logged in or activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->change_email(
						$this->form_validation->set_value('email')))) {			// success

					$data['site_name']	= $this->config->item('website_name', 'tank_auth');
				$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

				$this->_send_email('activate', $data['email'], $data);

				$this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));

			} else {
				$errors = $this->tank_auth->get_error_message();
				foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
			}
		}
		//$this->load->view('auth/send_again_form', $data);
		parse_temp('Send Again', $this->load->view('auth/send_again_form', $data, true));
	}
}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Activate user
		if ($this->tank_auth->activate_user($user_id, $new_email_key)) {		// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_activation_completed').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_activation_failed'));
		}
	}
	
	function admin()
	{
	  if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
	  	redirect('/auth/login/');

	  } else {
	  	$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
	  	
	  	$data['errors'] = array();

	  	$this->load->Model('Members');

	  	$member = $this->Members->getStaffUsers();
	  	$data['member'] = $member;

	  	$admin = $this->Members->getAdminUsers();
	  	$data['admin'] = $admin;

	  	$super = $this->Members->getSuperAdminUsers();
	  	$data['super'] = $super; 

	// GET ALL POSSIBLE MEMBERSHIPS
 		$data['memberships'] = $this->Members->getAllMemberships();
$data['memberTypes'] = $this->Members->getAllMemberTypes();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_password(
					$this->form_validation->set_value('old_password'),
						$this->form_validation->set_value('new_password'))) {	// success
					$this->_show_message($this->lang->line('auth_message_password_changed'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			//$this->load->view('auth/change_password_form', $data);
			parse_temp('Change Password', $this->load->view('auth/account_settings', '', true) . $this->load->view('auth/administrator_select_form', $data, true));
		}
	}
	
	 /**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function load_details()
	{
	  if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('second_name', 'Surname', 'trim|required|xss_clean');
			$this->form_validation->set_rules('home_number', 'Home Phone Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mobile_number', 'Mobile Phone Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('comms_preference', 'Communications', 'trim|required|xss_clean');
			
			$data['errors'] = array();

            $this->load->Model('Members');
            $this->load->Model('Comms_Preference');
            
            $members = $this->Members->getUserByID($this->tank_auth->get_user_id());
            $data['member'] = $members['0'];

            $member_prefs = $this->Members->getCommsPref($this->tank_auth->get_user_id());
            $data['member_prefs'] = $member_prefs;
            
            $prefs = $this->Comms_Preference->getPreferences();
            $data['comm_prefs'] = $prefs;

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_password(
					$this->form_validation->set_value('old_password'),
						$this->form_validation->set_value('new_password'))) {	// success
					$this->_show_message($this->lang->line('auth_message_password_changed'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			//$this->load->view('auth/change_password_form', $data);
			parse_temp('Change Password', $this->load->view('auth/account_settings', '', true) . $this->load->view('auth/detail_form', $data, true));
		}
	}

	/**
	 * Generate reset code (to change password) and send it to user
	 *
	 * @return void
	 */
	function forgot_password()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			$this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->forgot_password(
					$this->form_validation->set_value('login')))) {

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with password activation link
				$this->_send_email('forgot_password', $data['email'], $data);

				$this->_show_message($this->lang->line('auth_message_new_password_sent'));

			} else {
				$errors = $this->tank_auth->get_error_message();
				foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
			}
		}
			//$this->load->view('auth/forgot_password_form', $data);
		parse_temp('Forgot Password', $this->load->view('auth/forgot_password_form', $data, true));
		
	}
}

	/**
	 * Replace user password (forgotten) with a new one (set by user).
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_password()
	{
		$user_id		= $this->uri->segment(3);
		$new_pass_key	= $this->uri->segment(4);

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

		$data['errors'] = array();

		if ($this->form_validation->run()) {								// validation ok
			if (!is_null($data = $this->tank_auth->reset_password(
				$user_id, $new_pass_key,
					$this->form_validation->set_value('new_password')))) {	// success

				$data['site_name'] = $this->config->item('website_name', 'tank_auth');

				// Send email with new password
			$this->_send_email('reset_password', $data['email'], $data);

			$this->_show_message($this->lang->line('auth_message_new_password_activated').' '.anchor('/auth/login/', 'Login'));

			} else {														// fail
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		} else {
			// Try to activate user by password key (if not activated yet)
			if ($this->config->item('email_activation', 'tank_auth')) {
				$this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
			}

			if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		}
		//$this->load->view('auth/reset_password_form', $data);
		parse_temp('Reset Password', $this->load->view('auth/reset_password_form', $data, true));
	}

	/**
	 * Change user password
	 *
	 * @return void
	 */
	function change_password()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_password(
					$this->form_validation->set_value('old_password'),
						$this->form_validation->set_value('new_password'))) {	// success
					$this->_show_message($this->lang->line('auth_message_password_changed'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			//$this->load->view('auth/change_password_form', $data);
			parse_temp('Change Password', $this->load->view('auth/account_settings', '', true) . $this->load->view('auth/change_password_form', $data, true));
		}
	}

	/**
	 * Change user email
	 *
	 * @return void
	 */
	function change_email()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->set_new_email(
					$this->form_validation->set_value('email'),
						$this->form_validation->set_value('password')))) {			// success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with new email address and its activation link
				$this->_send_email('change_email', $data['new_email'], $data);

				$this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));

			} else {
				$errors = $this->tank_auth->get_error_message();
				foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
			}
		}
		parse_temp('Change Email', $this->load->view('auth/account_settings', '', true) . $this->load->view('auth/change_email_form', $data, true));
	}
}

	/**
	 * Replace user email with a new one.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_email()
	{
		$user_id	= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Reset email
		if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) {	// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_new_email_failed'));
		}
	}

	
	

   /**
	 * Replace user mobile number with a new one.
	 *
	 * @return void
	 */
	function change_mobile_number()
	{
		if (!$this->tank_auth->is_logged_in()) {				// not logged in or not activated
			redirect('/auth/login/');
		} else {



		}
	}

	/**
	 * Reset user mobile number.
	 *
	 * @return void
	 */
	function reset_mobile_number()
	{
		$user_id	= $this->uri->segment(3);
		$new_mobile_key	= $this->uri->segment(4);

		// Reset Mobile Number
		if ($this->tank_auth->activate_new_mobile_number($user_id, $new_mobile_key)) {	// success
			$this->_show_message($this->lang->line('auth_message_mobile_number_activated').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_new_mobile_number_failed'));
		}
	}


	/**
	 * Change user twitter account.
	 *
	 * @return void
	 */
	function change_twtter()
	{


	}

	/**
	 * Reset user twitter account.
	 *
	 * @return void
	 */
	function reset_twitter()
	{
		$user_id	= $this->uri->segment(3);
		$new_twitter_key	= $this->uri->segment(4);

		// Reset Twitter
		if ($this->tank_auth->activate_new_twitter($user_id, $new_twitter_key)) {	// success
			$this->_show_message($this->lang->line('auth_message_new_twitter_activated').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_new_twitter_failed'));
		}
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @return void
	 */
	function unregister()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->delete_user(
						$this->form_validation->set_value('password'))) {		// success
					$this->_show_message($this->lang->line('auth_message_unregistered'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			//$this->load->view('auth/unregister_form', $data);
			parse_temp('unregister', $this->load->view('auth/account_settings', '', true) . $this->load->view('auth/unregister_form', $data, true));
		}
	}

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$this->session->set_flashdata('message', $message);
		redirect('/auth/');
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$fromEmail = "ouremail@sent.com";
//		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
//		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->from($fromEmail, 'Email Test');
		$this->email->to($email);
		$this->email->subject('Registration Confirmation');
//		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
//		$this->email->message('This is to confirm that your account registraion has been successful congratulations ya rocket.'); 
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
//		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();

//		echo $this->email->print_debugger(); // Useful email debugger
	}

	/**
	 * Create CAPTCHA image to verify user as a human
	 *
	 * @return	string
	 */
	function _create_captcha()
	{
		$this->load->helper('captcha');

		$cap = create_captcha(array(
			'img_path'		=> './'.$this->config->item('captcha_path', 'tank_auth'),
			'img_url'		=> base_url().$this->config->item('captcha_path', 'tank_auth'),
			'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
			'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
			'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
			'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
			'show_grid'		=> $this->config->item('captcha_grid', 'tank_auth'),
			'expiration'	=> $this->config->item('captcha_expire', 'tank_auth'),
			));

		// Save captcha params in session
		$this->session->set_flashdata(array(
			'captcha_word' => $cap['word'],
			'captcha_time' => $cap['time'],
			));

		return $cap['image'];
	}

	/**
	 * Callback function. Check if CAPTCHA test is passed.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_captcha($code)
	{
		$time = $this->session->flashdata('captcha_timeEmergeAdapt');
		$word = $this->session->flashdata('captcha_word');

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float)$usec + (float)$sec);

		if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
			return FALSE;

		} elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
			$code != $word) OR
		strtolower($code) != strtolower($word)) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Create reCAPTCHA JS and non-JS HTML to verify user as a human
	 *
	 * @return	string
	 */
	function _create_recaptcha()
	{
		$this->load->helper('recaptcha');

		// Add custom theme so we can get only image
		$options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

		// Get reCAPTCHA JS and non-JS HTML
		$html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

		return $options.$html;
	}

	/**
	 * Callback function. Check if reCAPTCHA test is passed.
	 *
	 * @return	bool
	 */
	function _check_recaptcha()
	{
		$this->load->helper('recaptcha');

		$resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
			$_SERVER['REMOTE_ADDR'],
			$_POST['recaptcha_challenge_field'],
			$_POST['recaptcha_response_field']);

		if (!$resp->is_valid) {
			$this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * User profile page get account settings
	 * @return	void
	 */
	function account_settings(){

	if (!$this->tank_auth->is_logged_in()) {									// logged in
		redirect('');

	}	
	parse_temp('login', $this->load->view('auth/account_settings', '', true));
}



}


/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
