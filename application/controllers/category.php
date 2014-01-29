<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('categories');
	}
	
	/**
	* Fetch all the categories as json
	*/
	function fetchAll(){
		$categories = $this->categories->getCategories();
		echo json_encode($categories);
	}
	
	/**
	* Set the color of a category
	*/
	function setColor(){
		
		if($this->tank_auth->is_admin()){
			if (isset($_POST['category_id']) && isset($_POST['color'])){
				if($_POST['category_id'] != 1){
					$this->categories->setColor($_POST['category_id'], $_POST['color']);
					echo 'Color changed';
				}else{
					echo 'Cannot alter "Uncategorised" category';
				}
			}else{
				echo "Missing post values";
			}
			
		}else{

			echo 'not admin';
		}
	}
	
	/**
	* Add new categories
	*/
	function addCategory(){
		if($this->tank_auth->is_admin()){
			if (isset($_POST['category']) && isset($_POST['color'])){
				$this->categories->addCategory($_POST['category'], $_POST['color']);
				echo "Category Added";
			}else{
				echo "No values supplied";
			}

		}
	}

	/**
	* Determines whether an array of categories has any uncategorised
	* @param 	array
	* @param 	array - cleansed array
	*/
	function _cleanseUncategorised($categories){
		if(in_array(1, $categories)){
			echo("You cannot remove the uncategorized category");
			return $categories = array_diff( $categories, array(1)); 
		}

		return $categories;
	}
	
	/**
	* Remove categories
	*/
	function removeCategories(){
		if($this->tank_auth->is_admin()){

			if (isset($_POST['category_id'])){

				$_POST['category_id'] = $this->_cleanseUncategorised($_POST['category_id']);
				
				if(sizeof($_POST['category_id']) > 0){					
					if($this->categories->removeCategories($_POST['category_id']))
						echo("Categories removed");
					else{
						echo "Error removing categories";
					}
				}else{
					echo("No categories were removed");
				}
				
			}

		}
	}

	/**
	* Force remove categories even if assigned to class types.
	* 
	*/
	function forceRemoveCategories(){
		if($this->tank_auth->is_admin()){

			if (isset($_POST['category_id'])){
				$this->load->model('classes');

				$_POST['category_id'] = $this->_cleanseUncategorised($_POST['category_id']);
				
				if(sizeof($_POST['category_id']) > 0){

					$this->classes->uncategoriseClassTypes($_POST['category_id']);

					if($this->categories->removeCategories($_POST['category_id']))
						echo("Categories removed");
					else{
						echo "Error removing categories";
					}
				}else{
					echo("No categories were removed");
				}
				
			}

		}
	}


		/**
	* Force remove categories even if assigned to class types.
	* 
	*/
	function force(){
		$this->load->model('classes');

		$this->classes->uncategoriseClassTypes(array(11));

		
	}
	
	/**
	* Set category name
	*/
	function setName(){
		if($this->tank_auth->is_admin()){
			if (isset($_POST['category_id']) && isset($_POST['category'])){
				if($_POST['category_id'] != 1){
					$this->categories->setName($_POST['category_id'], $_POST['category']);
					echo "Category name changed";
				}else{
					echo "Cannot change name of uncategorized category";
					return false;
				}

			}else{
				echo "No values entered";
			}

		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/categories.php */