<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('categories');
	}

	function fetchAll(){
		$categories = $this->categories->getCategories();
		echo json_encode($categories);
	}
}

	/* End of file welcome.php */
/* Location: ./application/controllers/categories.php */