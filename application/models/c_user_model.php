<?php

Class C_User_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	/* 
	* Get name and id return array 	
	*/
  function get_all_user(){
    $this->db->select('id,first_name,second_name,email,activated,banned');
    $query = $this->db->get('Colinusers');

	if($query -> num_rows() > 0)
    {
     return $query->result();
    }
    else
    {
     return false;
    }
	}	
	        /*
         * Fetch users details
         */
        function fetchUser($id){
                $this -> db -> select('first_name,second_name,email,home_number,mobile_number,twitter');
                $this -> db -> from('Colinusers');
                $this -> db -> where('id', $id);
                $query = $this -> db -> get();
                return $query->result();
        }
   }
 ?>	