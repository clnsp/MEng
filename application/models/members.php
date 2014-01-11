<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Model
{
	private $table_name			    = 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this -> table_name			    = $ci -> config -> item('db_table_prefix', 'tank_auth').$this -> table_name;
		$this -> profile_table_name	= $ci -> config -> item('db_table_prefix', 'tank_auth').$this -> profile_table_name;
	}

	/**
	 * Get list of members
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function getAllUsers() //was get_all_user()
	{
		$query = $this -> db -> get($this -> table_name);
		return $query -> result();
	}
	
	/*
   * Fetch users details
   */
  function getUserByID($id) //was fetchUser($id)
  {
  	$this -> db -> select('first_name, second_name, email, home_number, mobile_number, twitter');
  	$this -> db -> from($this -> table_name);
  	$this -> db -> where('id', $id);

  	$query = $this -> db -> get();   
  	return $query->result();
  }

   /**
   * Add a new user
   * @param string
   */
  function addUser($user) // was get_user_name
  {
  
  	$data = array(
  	   'title' => 'My title' ,
  	   'name' => 'My Name' ,
  	   'date' => 'My date'
  	);
  	
    $this->db->insert("(LOWER(first_name) LIKE '%{$q}%' OR LOWER(second_name) LIKE '%{$q}%')");

    $query = $this -> db -> get($this -> table_name);

    return $query;
  }
  

}
