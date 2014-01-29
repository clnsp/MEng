<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class class_type extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('classes');
	}
	
	/**
	* Add new class type
	*/
	function addClassType(){
		if($this->tank_auth->is_admin()){
			if (isset($_POST['class_type']) && isset($_POST['class_description']) && isset($_POST['category_id'])){
				$this->classes->addNewClassType($_POST['class_type'], $_POST['class_description'], $_POST['category_id']);
				echo "Class Added";
			}else{
				echo "No values";
			}

		}
	}
	
	/**
	 * Get all the class types as json
	 */
	function getClassTypes(){
		if($this->tank_auth->is_admin()){
			$types = $this->classes->getClassTypes();
			
			echo json_encode($types);

		}
	}
	
	/**
	 * Modify class type
	 */
	function updateClassType(){
		if($this->tank_auth->is_admin()){
			if (isset($_POST['class_type']) && isset($_POST['class_description']) && isset($_POST['class_type_id']) && isset($_POST['category_id'])){			
				$this->classes->updateClassType($_POST['class_type_id'], $_POST['class_type'], $_POST['class_description'], $_POST['category_id']);
				echo "Class type updated";
			}	
		}

	}




}

/* End of file welcome.php */
/* Location: ./application/controllers/class_types.php */