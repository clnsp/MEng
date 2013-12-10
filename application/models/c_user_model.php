<?php

Class C_User_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
/* Get name and id return array */
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
   }
 ?>	