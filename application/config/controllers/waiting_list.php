<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class waiting_list extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('classes');
	}

	/**
	* Fetch those waiting list for a particular class
	*/
	public function getWaiting($class_id){
		if($this->tank_auth->is_admin()){
			if(isset($class_id)){
				$waiting = $this->classes->getWaiting($class_id);
				$num_waiting = sizeof($waiting);
				if($num_waiting > 0){
					echo "Number on waiting list: " . $num_waiting . "<br><ul class='list-group'>";
					foreach ($waiting as $key => $person) {
						echo  '<li class="list-group-item">' . $person['first_name'] . " " . $person['second_name'].'</li>'; 
					}
					echo "</uL>";
				}else{
					echo "No one in the waiting pool.";
				}
			}
		}

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/waiting_list.php */