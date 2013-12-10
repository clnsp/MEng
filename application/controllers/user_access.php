<?php
//birds.php
class User_Access extends CI_Controller{
        /*
         * Get user details for editing
         */
        function get_user_details(){
                $this->load->model('c_user_model');
                
                if (isset($_GET['id'])){
                        $q = strtolower($_GET['id']);
                        echo json_encode($this->c_user_model->fetchUser($q));                
                }                
        }
	}

?>