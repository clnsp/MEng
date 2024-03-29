<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Waiting
 *
 * This model represents the waiting list
 *
 * @author	MEng Project
 */
class Waiting extends CI_Model
{
    private $waiting_pool_tbl	= 'waiting_pool_tbl';		//waiting list

    function __construct()
    {
    	parent::__construct();
    }



     /**
    * Returns an array of those waiting for a position
    * @param int
    * @return array
    */
     function getWaiting($class_id){
     	$this -> db -> select('first_name, second_name');

     	$this->db->from($this -> waiting_pool_tbl);

     	$this->db->join('users', 'users.id = waiting_pool_tbl.member_id');
     	$this->db->where('class_id', $class_id);

     	$query = $this -> db -> get();
     	return $query->result_array();
     }

   

	/**
	* Add a member to the waiting list
	* @param int
	* @param int
	* @return bool
	*/
	function addMemberWaitingList($class_id, $member_id){ 
		
		$this->db->insert($this -> waiting_pool_tbl, array('member_id' => $member_id, 'class_id' => $class_id)); 	

		return ($this->db->_error_number() == 0);
	}	

    /**
    * check if waiting list is full
    * @param int
    * @param int
    * @return bool 
    */
    function waitingListFull($class_id, $max_attendance) {
    	$this->config->load('gym_settings');
    	
    	$this->db->where('class_id', $class_id);
    	$this->db->from($this -> waiting_pool_tbl);
    	$this -> db -> join('class_tbl', 'waiting_pool_tbl.class_id = class_tbl.class_id');
    	$query = $this -> db -> get();
    	
    	$max = round($max_attendance/100 * $this->config->item('max_waiting'), 0, PHP_ROUND_HALF_UP);
    	if($max < 3){
        $max = 3;
      }


      return $this->db->count_all_results() >= $max;

    }
    
      /**
      * Is a user already in a waiting list
      * @param int
      * @param int
      * @return bool 
      */
      function onWaitingList($member_id, $class_id) {
      	$this->config->load('gym_settings');
      	
      	$this->db->where('class_id', $class_id);
      	$this->db->where('member_id', $member_id);
      	$this->db->from($this -> waiting_pool_tbl);
      	$query = $this -> db -> get();
      	
      	return $this->db->count_all_results() > 0;  
      }


      function waitingListCount($class_id) {
	$this->db->select('id');      	
      	$this->db->where('class_id', $class_id);
      	$this->db->from($this -> waiting_pool_tbl);
 $this -> db -> get();
      	return $this->db->count_all_results();
 
      }
/*
  			 * Cancel a booking
  			 * @return	void
  			 */
        function cancelWaitingg(){

          if(check_member()){


            if(isset($_POST['class_booking_id'])){

              $class_booking_id = $_POST['class_booking_id'];
              $member_id = $this->tank_auth->get_user_id();


              $this->bookings->removeMember($class_booking_id, $member_id);

      }
      $this->mybookings();
    }
  }

function getUsers($class_id){ // GET USER IDS
	 if(check_member()){
		$this->db->select('member_id');
	     	$this->db->where('class_id', $class_id);
      		$this->db->from($this -> waiting_pool_tbl);
      		$query = $this -> db -> get();
     		return $query->result_array();
	}
}
}

/* End of file waiting.php */  
/* Location: ./application/models/waiting.php */ 
