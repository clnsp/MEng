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
	* @return	void
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
	* @return	void
	*/
	public function css(){

		$this->load->view('bootstrap-theme', '');
		
	}

	/**
	* Save the selected theme
	* @return	void
	*/
	public function saveTheme(){
		if($this->tank_auth->is_admin()){

			$this->themes->saveTheme($_POST);



		};




	}
}



/* End of file theme.php */
/* Location: ./application/controllers/theme.php */