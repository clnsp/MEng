<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class waiting_list extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('waiting');

	}

	/**
	* Fetch those waiting list for a particular class
	* @param int
	* @return	void
	*/
	public function getWaiting($class_id){
		if($this->tank_auth->is_admin()){
			if(isset($class_id)){
				$this->load->model('waiting');

				$waiting = $this->waiting->getWaiting($class_id);
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

	/**
	* Add a member to the waiting list
	* @return	void
	*/
	public function addWaiting(){
		if($this->tank_auth->is_admin()){
			if($this->input->post('member_id') && $this->input->post('class_id')){

				$this->load->model('classes');
				$this->load->helper('book');

				$b = $this->input->post('class_id');
				//$m = $this->tank_auth->get_user_id();
				$m = $this->input->post('member_id');
			
				$classInfo = $this->classes->getClassInformation($b);

				if($this->waiting->waitingListFull($b, $classInfo['max_attendance'])){
					echo('There are no more spaces on the waiting list.');
					return;
				}

				if(!isclassBookedOut($b)){
					echo "This class has spaces";
					return;
				}

				if($this->waiting->addMemberWaitingList($b, $m)){
					echo "Added to the list";
					emailMemberAddedToWaitingList($m, $classInfo);
				}else{
					echo('Already on the waiting list for this class.');
				}
			}		

		}

	}
}


/* End of file waiting_list.php */
/* Location: ./application/controllers/waiting_list.php */
