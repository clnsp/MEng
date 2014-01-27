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
					echo 'success';
				}else{
					echo 'Cannot alter uncategorised';
				}
			}
			
		}else{
		
			echo 'not admin';
			print_r($_POST);
		}
	}
	
	/**
	* Add new categories
	*/
	function addCategory(){
		if($this->tank_auth->is_admin()){
			if (isset($_POST['category']) && isset($_POST['color'])){
				$this->categories->addCategory($_POST['category'], $_POST['color']);
			}else{
				echo "No post values";
			}
		
		}
	}
	
	/**
	* Remove categories
	*/
	function removeCategories(){
		if($this->tank_auth->is_admin()){
		
			if (isset($_POST['category_id'])){
				
				if(in_array(1, $_POST['category_id'])){
					$_POST['category_id'] = array_diff( $_POST['category_id'], array(1)); //cannot remove the uncategorized category
					echo("You cannot remove the uncategorized category<br>");
				}
				
				if(sizeof($_POST['category_id']) > 0){					
					$this->categories->removeCategories($_POST['category_id']);
				}else{
					echo("No categories were removed<br>");
				}
				
			}
		
		}
	}
	
	/**
	* Set category name
	*/
	function setName(){
		if($this->tank_auth->is_admin()){
		
			if (isset($_POST['category_id']) && isset($_POST['category'])){
				$this->categories->setName($_POST['category_id'], $_POST['category']);
			}else{
				echo "No post values";
			}
		
		}
	}
	
}

	/* End of file welcome.php */
/* Location: ./application/controllers/categories.php */