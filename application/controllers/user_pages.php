	<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start();

	class user_pages extends CI_Controller {
		private $route = 'pages/member/';

		public function __construct(){
			parent::__construct();
		}

		/**
		 * Generic view for all pages within the /pages folder
		 * @return	void
		 */
		public function view($page = 'home'){


			if(check_member()){

				if ( ! file_exists('application/views/'.$this->route .$page.'.php'))
					show_404();

				echo('WORKS');

			}
		}

	}
/* End of file user_pages.php */
/* Location: ./application/controllers/user_pages.php */
	?>

	
