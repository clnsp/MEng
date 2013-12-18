<?php
class Member extends CI_Controller{
        /*
         * Get user details for editing
         */
        function getUserDetails(){
            $this->load->model('members');

            if (isset($_GET['id'])){
                $q = strtolower($_GET['id']);
                echo json_encode($this->members->getUserByID($q));                
            }                
        }
		
		/*
		 * Update User details
		 */
		 
		 function updateUserDetails(){
			$this->load->model('members');
			if(isset($_POST['id']) && isset($_POST['changes'])){
				//echo updateUser(strtolower($_POST['id'], strtolower($_POST['changes']);
				echo($_POST['changes']);
			}
		 }
		
		/*
		 * Update User Membership
		 */
		function updateUserMembership(){
				
		}
		
		/*
		 * Block / unBlock / Delete
		 */
		function alterUserExistance(){
		
		}
		
		/*
		 * Contact User
		 */
		 
		function contactUser() {
		
		
		}
    }
    ?>
