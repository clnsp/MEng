<?php
//birds.php
class Users_Auto extends CI_Controller{

 
  function get_users(){
    $this->load->model('user');
    if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      $this->user->get_user($q);
    }
  }
}

?>