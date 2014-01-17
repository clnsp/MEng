<?php
class Member extends CI_Controller{
  
  /**
   * Get user details for editing
   */
  function getUserDetails(){
    $this->load->model('members');

    if (isset($_GET['id'])){
      $q = strtolower($_GET['id']);
      echo json_encode($this->members->getUserByID($q));                
    }                
  }

}

?>
