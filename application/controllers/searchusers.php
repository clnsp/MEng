<?Php
//birds.php
class Users extends CI_Controller{

  function get_users(){
    $this->load->model('users');
    if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      $this->birds_model->get_bird($q);
    }
  }
}