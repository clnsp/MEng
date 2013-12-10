<?php
//birds.php
class Users_Access extends CI_Controller{


        function get_users(){
                $this->load->model('user_model');
                
                if (isset($_GET['term'])){
                        $q = strtolower($_GET['term']);
                        $this->user_model->get_user($q);
                }
                
                
        }
}

?>