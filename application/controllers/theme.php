<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class theme extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('themes');

	}

	/**
	* Theme Creator page
	*/
	public function index(){
		if(check_admin()){	

			parse_temp('theme', $this->load->view('pages/theme', $this->_getProperties(), true));



		}
	}

	/**
	* Get the properties in a usable array.
	* @return array
	*/
	public function _getProperties(){
		foreach ($this->themes->getThemeProperties() as $key => $value) {
			$data[$value['identifier']] =$value['value'] ;
		}
		return $data;
	}


	/**
	* Bootstrap theme CSS File
	*/
	public function css(){

		$this->load->view('bootstrap-theme', $this->_getProperties());
		
	}

	public function saveTheme(){
		if($this->tank_auth->is_admin()){

			$this->themes->saveTheme($_POST);


			// echo "About to set " . $key . " as " . $value;
			// $this->config->set_item($key, $value);
			// echo "<br> New value: " . $this->config->item($key, 'theme');;

		};




	}
}



/* End of file welcome.php */
/* Location: ./application/controllers/theme.php */